<?php

namespace App\Controllers;
use App\Models\SuratTugasModel;
use App\Models\SpdModel;
use App\Models\SuratTugasPersonilModel;
use App\Models\SuratTugasLokasiModel;
use App\Models\LokasiModel;
use App\Models\PegawaiModel;
use App\Models\KlompegModel;
use App\Models\LiburModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->mSuratTugas = new SuratTugasModel;
        $this->mSpd = new SpdModel;
        $this->mSTPersonil = new SuratTugasPersonilModel;
        $this->mSTLokasi = new SuratTugasLokasiModel;
        $this->mLokasi = new LokasiModel;
        $this->mPegawai = new PegawaiModel;
        $this->mKlompeg = new KlompegModel;
        $this->mLibur = new LiburModel;
    }   
        
    public function index() {        
        
        $data = [
            'title_page' => 'Laporan',
            'klompeg' => $this->mKlompeg->findall(),
        ];
        
        return view('laporan/home', $data);
    }

    public function rincianSpdBulanan() {        
        $klompegId = $this->request->getPost('klompeg');
        $bulan = $this->request->getPost('bulan_1');
        
        // $pegawai = $this->mPegawai->where('klompeg_id', $klompegId)->findAll();        
        $where= "jabatan.klompeg_id=$klompegId";
        $pegawai = $this->mPegawai->tampilUrutJabatan($where);
        
        $view = "<p style=\"font-size:10pt; font-weight:bold;\">RINCIAN SPD PEGAWAI PERIODE:  ".strtoupper(bulan(substr($bulan,5,2))).' '.substr($bulan,0,4)."  </p>
                <table class=\"main-table \" width=\"100%\">
                    <thead>
                    <tr>
                        <th>No</th> 
                        <th>Nama dan Rincian</th> 
                    </tr>
                    </thead>
                    ";
        
        $no = 1;
        foreach ($pegawai as $rowPegawai):
            $view .="
                    <tr>
                        <td rowspan=\"2\" align=\"center\">".$no++."</td>
                        <td style=\"border-bottom:0px solid\">".$rowPegawai['nama']."</td>
                    </tr>
                    <tr>
                        <td style=\"border-top:0px solid\">
                        <table width=\"100%\" class=\"table-border-0\" >
                            <tr style=\"background-color:#dfdfdf; \">
                                <td width=\"0.6cm\">No</td>
                                <td>Keperluan</td>
                                <td width=\"4cm\">Masa Dinas</td>
                                <td width=\"3cm\">Formulir</td>
                            </tr>
                        ";
            
                        $stPersonil = $this->mSTPersonil->where('pegawai_id', $rowPegawai['id_pegawai'])->findAll();
                        $i=1;
                        foreach($stPersonil as $rowSTPersonil):
                            $spd =  $this->mSpd->where('st_personil_id', $rowSTPersonil['id_st_personil'])->findAll();
                            $st = $this->mSuratTugas->where('id_st', $rowSTPersonil['surat_tugas_id'])->first();
                            foreach($spd as $spd):
                                if ($i % 2 == 0){ $color = "style=\"background-color:#80ff80\"";}else{$color=NULL;}
                            $view .="<tr ".$color." >
                                        <td>".$i++."</td>
                                        <td>".$st['perihal_st']."</td>
                                        <td>".$st['tanggal_berangkat']." s.d ".$st['tanggal_kembali'] ."</td>
                                        <td>".$spd['jenis_formulir']."</td>
                                    </tr>
                            ";

                            endforeach;
                        endforeach;
                
            $view .="   </table>
                        </td>
                    </tr>
                   ";
            
        endforeach;

        $view .=" </table>
                    ";

        $data = [
            'instansi' => config('site')->instansi,
            'kabkota' => config('site')->kabkota,
            'ibukota' => config('site')->ibukota,
            'email' => config('site')->email,
            'website' => config('site')->website,
            'alamat' => config('site')->alamat,
            'view'=>$view,
            'bulan' => $bulan,
        ];

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter('<small>Rincian SPD Bulanan: '.$bulan.'</small>||'.'#{PAGENO} ');
		$html = view('laporan/laporan_portrait', $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('Rincian SPD - '.time(),'I'); // I=opens in browser; D=downloads
        
    }

    public function matriksSpdBulanan() {        
        $klompegId = $this->request->getPost('klompeg');
        $bulan = $this->request->getPost('bulan');
        $tgl_awal = $bulan.'-01';
        $tgl_akhir = date("Y-m-t", strtotime($tgl_awal));
        $tgl_terakhir_bulan = substr($tgl_akhir,-2);
        
        //simpan data libur ke array
        $arr_libur = [];        
        $rLibur = $this->mLibur->selectRange($tgl_awal, $tgl_akhir);         
        foreach ($rLibur as $libur):
            array_push($arr_libur, $libur['tanggal_libur']);
        endforeach;
        
        $hari_awal_smp_akhir = [];
        for ($a = 1; $a <= (int)$tgl_terakhir_bulan; $a++):            
            // tambahkan angka 0 di depan untuk angka 1-9
            strlen($a) == 1 ?  $a = "0".$a : $a = $a;
            
            //simpan ke array $hari_awal_smp_akhir
            array_push($hari_awal_smp_akhir, $a);

            // jika hari sabtu minggu, tambahkan ke $arr_libur
            if(date('l', strtotime($bulan.'-'.$a) ) == "Saturday"
            OR date('l', strtotime($bulan.'-'.$a) ) == "Sunday" ):
                array_push($arr_libur, $bulan.'-'.$a);
            endif;
            
        endfor;
                
        $wh_st = "tanggal_berangkat between '".$tgl_awal."' and '".$tgl_akhir."' OR tanggal_kembali between '".$tgl_awal."' and '".$tgl_akhir."'";
        $st = $this->mSuratTugas->where($wh_st)->findAll();

        $view = "<p style=\"font-size:10pt; font-weight:bold;\">REKAPITULASI SPD PERIODE: ".strtoupper(bulan(substr($bulan,5,2))).' '.substr($bulan,0,4)." </p>
                    
                    <table class=\"main-table\" width=\"100%\">
                    <thead>
                        <tr>
                            <th width=\"3%\" class=\"text-center\" rowspan=\"2\" valign=\"middle\"><b>NO</b></th>
                            <th width=\"15%\" class=\"text-center\" rowspan=\"2\" valign=\"middle\"><b>NAMA</b></th>
                            <th class=\"text-center\" colspan=\"".(int)$tgl_terakhir_bulan ."\" valign=\"middle\"><b>".bulan(substr($bulan,5,2)).' '.substr($bulan,0,4)."</b></th>
                            <th width=\"5%\" class=\"text-center\" rowspan=\"2\" valign=\"middle\"><b>KET.</b></th>
                        </tr>

                        <tr> ";	
                            
                for ($a =0; $a < (int)$tgl_terakhir_bulan; $a++):                    
                    if(in_array($bulan.'-'.$hari_awal_smp_akhir[$a], $arr_libur ))
                    {
                        $view .= "<th style=\"background-color:red\" align=\"center\">".($a + 1)."</th>";
                    }else {
                        $view .= "<th align=\"center\">".($a + 1)."</th>";
                    }
                endfor;
                
                $view .="
                        </tr>
                    </thead>
                    ";
        
        $no = 1;
        $where= "jabatan.klompeg_id=$klompegId";
        $pegawai = $this->mPegawai->tampilUrutJabatan($where);
        
        foreach ($pegawai as $rowPegawai):
            
            $id_pegawai = $rowPegawai['id_pegawai'];
            // $id_pegawai = 9;
            $peg_dl = [];//array kosong buat nampung tgl dl
            $peg_dl[$id_pegawai] = [];
            $peg_dl[$id_pegawai]['dl_kerja'] = [];
            $peg_dl[$id_pegawai]['dl_libur'] = [];
            
            $isiKet = "";
            $isiDinas = "";
            
            $no % 2 == 0 ? $color = "style=\"background-color:#ccccb3\"" : $color=NULL;
            $view .="
                    <tr ".$color.">
                        <td align=\"center\">".$no++."</td>
                        <td style=\"border-bottom:0px solid\">".$rowPegawai['nama']."</td>
                        ";
                        
                        //pegawai terdapat DL
                        $pegawaiBertugas = $this->mSTPersonil->where('pegawai_id', $id_pegawai)->findAll();
                        
                        foreach($pegawaiBertugas as $rowSTPersonil):
                            
                            $spd = $this->mSpd->where('st_personil_id', $rowSTPersonil['id_st_personil'])->findAll();
                            
                            $st = $this->mSuratTugas->where('id_st', $rowSTPersonil['surat_tugas_id'])->first();
                            
                            foreach($spd as $spd):
                                $spd['jenis_formulir'] == "SPD" ? $jenis_formulir_singkat="SP": $jenis_formulir_singkat="LK";
                                $berangkat 	= new \DateTime($st['tanggal_berangkat']);
                                $kembali 	= new \DateTime($st['tanggal_kembali']);
                                
                                //menambahkan 1 hari hitungan agar tanggal kembali terhitung hari dinas
                                $kembali_1 	= $kembali->modify('+1 day');
                                
                                $daterange 	= new \DatePeriod($berangkat, new \DateInterval('P1D'), $kembali_1);
                                
                                foreach($daterange as $date)
                                {
                                    //hanya tanggal di range tgl awal-akhir saja yang ditampilkan
                                    if ( (strtotime($date->format("Y-m-d")) >= strtotime($tgl_awal) )
                                            AND (strtotime($date->format("Y-m-d")) <= strtotime($tgl_akhir) ) )
                                    {
                                        //DL di hari libur
                                        if (in_array($date->format('Y-m-d'), $arr_libur) )
                                        {
                                            array_push($peg_dl[$id_pegawai]['dl_libur'], $date->format('Y-m-d'));
                                        }else
                                        {
                                            //DL di hari kerja
                                            array_push($peg_dl[$id_pegawai]['dl_kerja'], $date->format('Y-m-d'));
                                        }
                                    }
                                }
                                             
                                for ($a = 0; $a < $tgl_terakhir_bulan; $a++)
                                {
                                    //DL di tanggal libur
                                    if( in_array($bulan.'-'.$hari_awal_smp_akhir[$a], $arr_libur) 
                                        and ( in_array($bulan.'-'.$hari_awal_smp_akhir[$a], $peg_dl[$id_pegawai]['dl_kerja'] )
                                        OR in_array($bulan.'-'.$hari_awal_smp_akhir[$a], $peg_dl[$id_pegawai]['dl_libur'] ) )
                                        ){
                                        $view .= "<td style='background-color:green;' align='center'>".$jenis_formulir_singkat."</td>";
                                    
                                    //DL di hari kerja
                                    }elseif ( in_array($bulan.'-'.$hari_awal_smp_akhir[$a], $peg_dl[$id_pegawai]['dl_kerja'] )
                                        or in_array($bulan.'-'.$hari_awal_smp_akhir[$a], $peg_dl[$id_pegawai]['dl_libur'] ) 
                                        ){
                                        $view .= "<td style='background-color:green' align='center'>".$jenis_formulir_singkat."</td>";
                                    
                                    //tidak ada DL di hari libur, buat kolom kosong
                                    }elseif (in_array($bulan.'-'.$hari_awal_smp_akhir[$a], $arr_libur))
                                        {
                                        $view .= "<td style='background-color:red'></td>";
                                    
                                        //tidak ada DL di hari kerja, buat kolom kosong
                                    }else{
                                        $view .= "<td ></td>";
                                    }
                                }
                                
                                $view .= '<td align="left">';
                                $view .= count($peg_dl[$id_pegawai]['dl_kerja']) + count($peg_dl[$id_pegawai]['dl_libur']) ." hari <br/>(<i style='color:green'>"
                                .count($peg_dl[$id_pegawai]['dl_kerja']) ."</i>+<i style='color:red'>"
                                .count($peg_dl[$id_pegawai]['dl_libur']) .'</i>)';
                                $view .= '</td>';
                                
                         
                            endforeach;
                        endforeach;
                $view .="</tr>";
            
        endforeach;
        
        $view .="
                </table>                
                <p><b>KETERANGAN: </b><i>SP=SPD | LK=Lembar Konfirmasi | Kolom merah=hari libur | Kolom hijau=dinas luar</i></p>
                ";

        $data = [
            'instansi' => config('site')->instansi,
            'kabkota' => config('site')->kabkota,
            'ibukota' => config('site')->ibukota,
            'email' => config('site')->email,
            'website' => config('site')->website,
            'alamat' => config('site')->alamat,
            'view'=>$view,
            'bulan' => $bulan,
        ];

        $mpdf = new \Mpdf\Mpdf(['format' => 'Folio-L']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter('<small>Rekapitulasi SPD Bulan: '.bulan(substr($bulan,5,2)).' '.substr($bulan,0,4).'</small>||'.'#{PAGENO} ');
		$html = view('laporan/laporan_landscape', $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('Rekap SPD - '.time(),'I'); // I=opens in browser; D=downloads
        
    }

    public function agendaSpdBulanan() {        
        $bulan = $this->request->getPost('bulan_3');
        
        $view = "<p style=\"font-size:10pt; font-weight:bold;\">AGENDA SPD BULAN: ".strtoupper(bulan(substr($bulan,5,2))).' '.substr($bulan,0,4)."  </p>
                    <table class=\"main-table \" width=\"100%\">
                    <thead>
                        <tr>
                            <th>No</th> 
                            <th>No Agenda</th>
                            <th>Tanggal</th>
                            <th>Formulir</th>
                            <th>Perihal</th>
                            <th>Personil</th>
                        </tr>
                    </thead>
                    <tbody>
                    ";
        $no=1;                
        $spd = $this->mSpd->like('tanggal_ttd_spd', $bulan.'%')
                ->orderBy('tanggal_ttd_spd','ASC')
                ->orderBy('id_spd','ASC')
                ->findAll();
                
        foreach ($spd as $rowSpd):
            $stPersonil = $this->mSTPersonil->where('id_st_personil', $rowSpd['st_personil_id'])->first();
            $st = $this->mSuratTugas->where('id_st', $stPersonil['surat_tugas_id'])->first();

            $view .="
                    <tr>
                        <td align=\"center\">".$no++."</td>
                        <td >".$rowSpd['nomor_spd']."</td>
                        <td align=\"center\">".$rowSpd['tanggal_ttd_spd']."</td>
                        <td >".$rowSpd['jenis_formulir']."</td>
                        <td style=\"border-bottom:0px solid\">".$st['perihal_st']."</td>
                        <td style=\"border-bottom:0px solid\">".$stPersonil['nama']."</td>
                    </tr>
                   ";
            
        endforeach;

        $view .="   </tbody>
                    </table>
                    ";

        $data = [
            'instansi' => config('site')->instansi,
            'kabkota' => config('site')->kabkota,
            'ibukota' => config('site')->ibukota,
            'email' => config('site')->email,
            'website' => config('site')->website,
            'alamat' => config('site')->alamat,
            'view'=>$view,
            'bulan' => $bulan,
        ];

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter('<small>Agenda SPD Bulanan: '.$bulan.'</small>||'.'#{PAGENO} ');
		$html = view('laporan/laporan_landscape', $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('Agenda SPD - '.$bulan. time(),'I'); // I=opens in browser; D=downloads
        
    }
    
}