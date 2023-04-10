<?php

namespace App\Controllers;
use App\Models\SpdModel;
use App\Models\SpdPengeluaranModel;
use App\Models\SuratTugasModel;
use App\Models\TemplateModel;
use App\Models\SuratTugasPersonilModel;
use App\Models\SuratTugasLokasiModel;
use App\Models\LokasiModel;
use App\Models\PegawaiModel;
use App\Models\KlompegModel;
use App\Models\PenandatanganModel;

class Spd extends BaseController
{
    public function __construct()
    {
        $this->mSpd = new SpdModel;
        $this->mSpdPengeluaran = new SpdPengeluaranModel;
        $this->mSuratTugas = new SuratTugasModel;
        $this->mTemplate= new TemplateModel;
        $this->mSTPersonil = new SuratTugasPersonilModel;
        $this->mSTLokasi = new SuratTugasLokasiModel;
        $this->mLokasi = new LokasiModel;
        $this->mPegawai = new PegawaiModel;
        $this->mKlompeg = new KlompegModel;
        
        $this->mPenandatangan = new PenandatanganModel;
    }   
        
    public function index() {        
        $data = [
            'title_page' => 'SPD'
        ];
        
        return view('spd/list_data', $data);
    }

    public function listData(){
        if($this->request->isAJAX()){

            $startDate = $this->request->getVar('tgl_filter_1');
            $endDate = $this->request->getVar('tgl_filter_2');
            
            if( $startDate != NULL  ? $startDate = $startDate : $startDate = date('Y-01-01')  );
            if( $endDate != NULL  ? $endDate = $endDate : $endDate = date('Y-12-31')  );

            $data_spd = $this->mSpd->selectRange($startDate, $endDate);
            
            $buka_tabel = "
                <table id=\"tabeldata\" class=\"table table-condensed table-bordered table-striped\">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perihal</th>
                            <th>Tujuan</th>
                            <th>Personil</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                
            $tutup_tabel = "</tbody></table>";

            $isi_tabel = "";
            
            foreach ($data_spd as $row):                
                $nomor_spd = $row['nomor_spd']; 
                $ambil_angka = explode("/",$nomor_spd) [0];
                $bersihkan_dot  = explode(".",$ambil_angka);	
                $no_agenda	= $bersihkan_dot [0];

                $row_st_personil = $this->mSTPersonil->where('id_st_personil', $row['st_personil_id'])->first();
                $row_st = $this->mSuratTugas->where('id_st', $row_st_personil['surat_tugas_id'])->first();
                
                $isi_tabel .= "
                        <tr>
                            <td class=\"\">".$no_agenda."</td>                           
                            <td class=\"text-default\">".$row_st['perihal_st']."<br>
                                <span class=\"badge badge-primary\">".$row['jenis_formulir']."</span> 
                                <span class=\"badge badge-success\">Nomor: ".$row['nomor_spd']."</span> 
                                 <span class=\"badge badge-secondary\">Masa Tugas: ".$row_st['tanggal_berangkat']." s.d. ".$row_st['tanggal_berangkat'].
                                "</span>
                            </td>
                            <td>";                            
                                //dapetin lokasi
                                $st_lokasi = $this->mSTLokasi->like('surat_tugas_id' , $row_st['id_st'])->findAll();
                                
                                foreach ($st_lokasi as $lok) :
                                    $isi_tabel .= "<span class=\"badge badge-info\">". $lok['nama_lokasi']. "</span> ";
                                endforeach;
                            
                $isi_tabel .="</td>
                            <td>
                                ". $row_st_personil ['nama']. "
                            </td>       
                            <td align=\"center\">
                                <div class=\"btn-group\">
                                <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                    Aksi
                                </button>
                                <div class=\"dropdown-menu\">
                                    <a class=\"dropdown-item\"  href=\"".site_url('spd/cetak/').base64_encode($row['id_spd']). "\" target=\"blank\">Cetak SPD</a>
                                    <div class=\"dropdown-divider\"></div>
                                    <a type=\"button\" class=\"dropdown-item\" onclick=\"ubahSpd(".$row['id_spd'].")\"> Ubah Data</a>
                                    <a type=\"button\" class=\"dropdown-item\"  onclick=\"hapusSpd(".$row['id_spd'].")\">Hapus Data</a>
                                    <div class=\"dropdown-divider\"></div>
                                    <a type=\"button\" class=\"dropdown-item\"  onclick=\"pengeluaranSpd(".$row['id_spd'].")\">Pengeluaran</a>

                                </div>
                                </div>                                
                            </td>";

                $isi_tabel .="
                        </tr>";
                             
            endforeach;
            
            $msg = [
                'periode' => 'Periode '.tgl_id($startDate).' s.d. '.tgl_id($endDate),
                'startDate' => $startDate,
                'endDate' => $endDate,
                'buka_tabel' => $buka_tabel,                
                'isi_tabel' => $isi_tabel,                
                'tutup_tabel' => $tutup_tabel,                
            ];
            
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formTambah(){
        if($this->request->isAJAX()){
            $id_st_personil = $this->request->getVar('id_st_personil');
            $row = $this->mSTPersonil->find($id_st_personil);
            
            $id_st = $this->request->getVar('id_st');
            $row_st = $this->mSuratTugas->find($id_st);
            
            $data = [
                'id' => $id_st_personil,
                'perihal' =>  $row_st['perihal_st'],
                'nama' => $row['nama'],
                'kota_ttd' => $row_st['kota_ttd'],
                'tgl_ttd' => $row_st['tanggal_st'],
            ];

            $msg = [
                'sukses' => view('spd/form_tambah', $data)                
            ];
            
            echo json_encode($msg);   
        }
    }
    
    public function nomorSpd(){

        $row_spd = $this->mSpd->dataTerakhir();

        if( !empty($row_spd['id_spd']) )
        {
            $no_terakhir        = $row_spd['nomor_spd']; 
            $expl_no_terakhir 	= explode("/",$no_terakhir);	
            $ambil_agenda 			= $expl_no_terakhir [0];
            $bersihkan_dot			= explode(".",$ambil_agenda);	
            $no_agenda_terakhir		= $bersihkan_dot [0];
            $agenda_skg				= $no_agenda_terakhir + 1;
            
        }else {
            $no_agenda_terakhir = '-';
            $agenda_skg 	= 1;
        }

        $data = [
            'no_agenda_lalu' =>  $no_agenda_terakhir,
            'no_agenda' => $agenda_skg.'/'.config('site')->kodeSpd.'/'.date('Y'),
        ];

        echo json_encode($data);
            
    } 
    
    public function simpan(){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nomor_spd' => [
                    'rules' => 'required|is_unique[spd.nomor_spd]',
                    'errors' => [
                        'required' => '* harus diisi ',
                        'is_unique' => 'Nomor ini sudah terdaftar. Klik reload untuk mendapatkan saran nomor baru',
                    ],
                ],
                'tgl_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'kota_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],
                
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nomor_spd' => $validation->getError('nomor_spd'),
                        'tgl_ttd' => $validation->getError('tgl_ttd'),
                        'kota_ttd' => $validation->getError('kota_ttd'),
                    ]
                ];
                
            }else{
                $penandatangan = $this->mPenandatangan->first();
                
                $simpandata = [
                    'nomor_spd' => $this->request->getVar('nomor_spd'),
                    'st_personil_id' => $this->request->getVar('id_personil'),
                    'kendaraan' => $this->request->getVar('kendaraan'),
                    'tingkat_spd' => $this->request->getVar('tingkat_spd'),
                    'sumber_dana' => $this->request->getVar('sumber_dana'),
                    'jenis_formulir' => $this->request->getVar('formulir'),
                    'akun_anggaran' => $this->request->getVar('akun'),
                    'kota_ttd_spd' => $this->request->getVar('kota_ttd'),
                    'tanggal_ttd_spd' => $this->request->getVar('tgl_ttd'),
                    'jabatan_ttd_spd' => 'Pejabat Pembuat Komitmen',
                    'nama_ttd_spd' => $penandatangan['ppkom'],    
                    'nip_ttd_spd' => $penandatangan['nip_ppkom'],     
                    'created_by' => 1 //ganti dengan session                    
                ];
                    
                // var_dump($simpandata);
                $this->mSpd->insert($simpandata);

                $msg = [
                    'sukses' => 'Data telah disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapus($id){
        if($this->request->isAJAX()){
            $this->mSpd->delete($id);
            $msg = [
                'sukses' => 'Data telah dihapus',
            ];
            
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
    
    public function formEdit(){
        if($this->request->isAJAX()){
            $id_spd = $this->request->getVar('id');
            $row_spd = $this->mSpd->find($id_spd);

            $row_person = $this->mSTPersonil->find($row_spd['st_personil_id']);
            
            $row_st = $this->mSuratTugas->find($row_person['surat_tugas_id']);

            $data = [
                'perihal' => $row_st['perihal_st'],
                'nama' => $row_person['nama'],
                'id_spd' => $id_spd,
                'nomor_spd' => $row_spd['nomor_spd'],
                'tingkat_spd' => $row_spd['tingkat_spd'],
                'sumber_dana' => $row_spd['sumber_dana'],
                'akun' => $row_spd['akun_anggaran'],
                'kendaraan' => $row_spd['kendaraan'],
                'jenis_formulir' => $row_spd['jenis_formulir'],
                'kota_ttd' => $row_spd['kota_ttd_spd'],
                'tgl_ttd' => $row_spd['tanggal_ttd_spd'],
            ];

            $msg = [
                'sukses' => view('spd/form_edit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function update($id){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tgl_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'kota_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],
                
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nomor_spd' => $validation->getError('nomor_spd'),
                        'tgl_ttd' => $validation->getError('tgl_ttd'),
                        'kota_ttd' => $validation->getError('kota_ttd'),
                    ]
                ];
                
            }else{
                $penandatangan = $this->mPenandatangan-> orderBy('id_penandatangan','desc') -> find(1); 

                $simpandata = [
                    'nomor_spd' => $this->request->getVar('nomor_spd'),
                    'kendaraan' => $this->request->getVar('kendaraan'),
                    'tingkat_spd' => $this->request->getVar('tingkat_spd'),
                    'sumber_dana' => $this->request->getVar('sumber_dana'),
                    'jenis_formulir' => $this->request->getVar('formulir'),
                    'akun_anggaran' => $this->request->getVar('akun'),
                    'kota_ttd_spd' => $this->request->getVar('kota_ttd'),
                    'tanggal_ttd_spd' => $this->request->getVar('tgl_ttd'),
                    'nama_ttd_spd' => $penandatangan['ppkom'],    
                    'nip_ttd_spd' => $penandatangan['nip_ppkom'],     
                    'updated_by' => 2 //ganti dengan session                    
                ];
                    
                // var_dump($simpandata);
                $this->mSpd->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Data telah disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
    
    public function laporan(){
        $data = [
            'title_page' => 'SPD',
            'klompeg' => $this->mKlompeg->findall(),
        ];
        
        return view('spd/laporan', $data);
    
    }
    
    
    public function cetak($id)
    {
        $row_spd = $this->mSpd->find(base64_decode($id));
        $row_person = $this->mSTPersonil->find($row_spd['st_personil_id']);
        $row_st = $this->mSuratTugas->find($row_person['surat_tugas_id']);
        $row_penandatangan = $this->mPenandatangan->first();
 
        $date1=date_create($row_st['tanggal_berangkat']);
        $date2=date_create($row_st['tanggal_kembali']);        
        $diff=date_diff($date1,$date2)->format('%d') ;

        $data = [
            'instansi' => config('site')->instansi,
            'instansi_singkat' => config('site')->instansi_singkat,
            'kabkota' => config('site')->kabkota,
            'kabkota_singkat' => config('site')->kabkota_singkat,
            'ibukota' => config('site')->ibukota,
            
            'nomor_st' => $row_st['nomor_st'],
            'perihal' => $row_st['perihal_st'],
            'masa_tugas' => $diff+1,  
            'tgl_berangkat' => $row_st['tanggal_berangkat'],  
            'tgl_kembali' => $row_st['tanggal_kembali'],  
            
            'nama' => $row_person['nama'],
            'nip' => $row_person['nip'],
            'pangkat' => $row_person['pangkat'],
            'golongan' => $row_person['golongan'],
            'klompeg' => $row_person['klompeg'],
            'jabatan' => $row_person['jabatan'],
            
            'nomor_spd' => $row_spd['nomor_spd'],
            'tingkat_spd' => $row_spd['tingkat_spd'],
            'sumber_dana' => $row_spd['sumber_dana'],
            'akun' => $row_spd['akun_anggaran'],
            'kendaraan' => $row_spd['kendaraan'],
            'kota_ttd' => $row_spd['kota_ttd_spd'],
            'tgl_ttd' => $row_spd['tanggal_ttd_spd'],

            'tgl_ttd' => $row_spd['tanggal_ttd_spd'],  
            'jabatan_ttd' => $row_spd['jabatan_ttd_spd'],  
            'nama_ttd' => $row_spd['nama_ttd_spd'],  
            'nip_ttd' => $row_spd['nip_ttd_spd'],  
            
            'st_lokasi' => $this->mSTLokasi->like('surat_tugas_id' , $row_st['id_st'])->findAll(),
            'lokasi_pertama' => $this->mSTLokasi->like('surat_tugas_id' , $row_st['id_st'])->orderBy('id_st_lokasi',"ASC")->first(),
            'jml_lokasi' => $this->mSTLokasi->like('surat_tugas_id' , $row_st['id_st'])->countAllResults(),
            'kepala' => $row_penandatangan['sekretaris'],
            'nip_kepala' => $row_penandatangan['nip_sekretaris'],
            
        ];
        
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter("<small>".$row_spd['nomor_spd'].'</small>||'.'#{PAGENO}');
		
        if($row_spd['jenis_formulir'] == 'SPD') {
            $formulir = 'spd/cetak_spd';
        }else{
            $formulir = 'spd/cetak_lk';
        };
        
        $html = view($formulir, $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('SPD_LK '.time(),'I'); // I=opens in browser; D=downloads
		
    }

    public function pengeluaran(){
        if($this->request->isAjax()){
            
            $id_spd = $this->request->getVar('id_spd');
            $row_spd = $this->mSpd->find($id_spd);
            
            $row_st_personil = $this->mSTPersonil->where('id_st_personil',$row_spd['st_personil_id'])->first();
            
            $row_st = $this->mSuratTugas->where('id_st',$row_st_personil['surat_tugas_id'])->first();
            $date1=date_create($row_st['tanggal_berangkat']);
            $date2=date_create($row_st['tanggal_kembali']);        
            $diff=date_diff($date1,$date2)->format('%d') ;

            $count_spd_pengeluaran = $this->mSpdPengeluaran->where('spd_id', $id_spd)->countAllResults();
            // var_dump($count_spd_pengeluaran);die;
            
            if ($count_spd_pengeluaran != 0 ) :
                
                $row_spd_pengeluaran = $this->mSpdPengeluaran->where('spd_id', $id_spd)->first();
                
                $data1 = [
                    'id_spd_pengeluaran' => $row_spd_pengeluaran['id_spd_pengeluaran'],
                    'masa_tugas' => $diff+1, 
                    'uang_harian' => $row_spd_pengeluaran['uang_harian'],
                    'ket_uang_harian' => $row_spd_pengeluaran['ket_uang_harian'],
                    'uang_tiket' => $row_spd_pengeluaran['uang_tiket'],
                    'ket_uang_tiket' => $row_spd_pengeluaran['ket_uang_tiket'],
                    'uang_transport' => $row_spd_pengeluaran['uang_transport'],
                    'ket_uang_transport' => $row_spd_pengeluaran['ket_uang_transport'],
                    'uang_penginapan' => $row_spd_pengeluaran['uang_penginapan'],
                    'ket_uang_penginapan' => $row_spd_pengeluaran['ket_uang_penginapan'],
                    'uang_lain' => $row_spd_pengeluaran['uang_lain'],
                    'ket_uang_lain' => $row_spd_pengeluaran['ket_uang_lain'],
                    'uang_muka' => $row_spd_pengeluaran['uang_muka'],
                    'ket_uang_muka' => $row_spd_pengeluaran['ket_uang_muka'],
                ];
            else:
                $data1 = [];
            endif;
            
            $data2 = [
                'id_spd' => $id_spd,
                'perihal' =>  $row_st['perihal_st'],
                'nomor_spd' =>  $row_spd['nomor_spd'],
                'tanggal_spd' =>  $row_spd['tanggal_ttd_spd'],
                'jenis_formulir' =>  $row_spd['jenis_formulir'],
                'tgl_ttd' => $row_st['tanggal_st'],
                'nama' => $row_st_personil['nama'],
                'ibukota' => config('site')->ibukota,
            ];

            $data = array_merge($data1, $data2);
            
            $msg = [
                'sukses' => view('spd/pengeluaran', $data)                
            ];
            
            echo json_encode($msg);  
        }
    }
    
    public function simpanPengeluaran(){
        if($this->request->isAjax()):
            $pejabat = $this->mPenandatangan->first();
            
            $data = [
                'spd_id' => $this->request->getVar('id_spd'),
                'uang_harian' => $this->request->getVar('uang_harian'),
                'ket_uang_harian' => $this->request->getVar('ket_uang_harian'),
                'uang_tiket' => $this->request->getVar('uang_tiket'),
                'ket_uang_tiket' => $this->request->getVar('ket_uang_tiket'),
                'uang_transport' => $this->request->getVar('uang_transport'),
                'ket_uang_transport' => $this->request->getVar('ket_uang_transport'),
                'uang_penginapan' => $this->request->getVar('uang_penginapan'),
                'ket_uang_penginapan' => $this->request->getVar('ket_uang_penginapan'),
                'uang_lain' => $this->request->getVar('uang_lain'),
                'ket_uang_lain' => $this->request->getVar('ket_uang_lain'),
                'uang_muka' => $this->request->getVar('uang_muka'),
                'ket_uang_muka' => $this->request->getVar('ket_uang_muka'),
                'bendahara' => $pejabat['bendahara'],
                'nip_bendahara' => $pejabat['nip_bendahara'],
                'ppkom' => $pejabat['ppkom'],
                'nip_ppkom' =>$pejabat['nip_ppkom'],
            ];

            $id_spd_pengeluaran = $this->request->getVar('id_spd_pengeluaran');
            
            if($this->request->getVar('id_spd_pengeluaran') == null):                
                $this->mSpdPengeluaran->insert($data);
            elseif($this->request->getVar('id_spd_pengeluaran') != null):
                $this->mSpdPengeluaran->update($id_spd_pengeluaran, $data );
            
            endif;    
            
            $spd_pengeluaran = $this->mSpdPengeluaran->orderBy('id_spd_pengeluaran', 'desc')->limit(1)->first();
            
            $data = [
                'id_spd_pengeluaran' => $spd_pengeluaran['id_spd_pengeluaran'],
                'sukses' => "Data telah disimpan",
            ];
            
            echo json_encode($data);  
        endif;
        
    }

    public function cetakKuitansi(){   
        // if($this->request->isAjax()):
            $spd_pengeluaran_id = $this->request->getVar('id_spd_pengeluaran2');
            // $spd_pengeluaran_id = base64_decode($id);     
            
            $row_spd_pengeluaran = $this->mSpdPengeluaran ->find($spd_pengeluaran_id);
            $row_spd = $this->mSpd->find($row_spd_pengeluaran['spd_id']);        
            
            $st_personil = $this->mSTPersonil->where('id_st_personil', $row_spd['st_personil_id'])->first();
            
            $row_st = $this->mSuratTugas->where('id_st', $st_personil['surat_tugas_id'])->first();
            $pejabat = $this->mPenandatangan->first();
            
            $data = [
                'instansi' => config('site')->instansi,
                'instansi_singkat' => config('site')->instansi_singkat,
                'kabkota' => config('site')->kabkota,
                'kabkota_singkat' => config('site')->kabkota_singkat,
                'ibukota' => config('site')->ibukota,
                'email' => config('site')->email,
                'website' => config('site')->website,
                'alamat' => config('site')->alamat,
                
                'spd_id' => $row_spd['id_spd'],
                'nomor_spd' => $row_spd['nomor_spd'],
                'nama_pelaksana_spd' => $st_personil['nama'],
                'nip_pelaksana_spd' => $st_personil['nip'],
                'tanggal_spd' => tgl_id($row_spd['tanggal_ttd_spd']),
                'perihal_st' => $row_st['perihal_st'],
                
                'uang_harian' =>$row_spd_pengeluaran ['uang_harian'],
                'ket_uang_harian' => $row_spd_pengeluaran ['ket_uang_harian'],
                'uang_tiket' => $row_spd_pengeluaran ['uang_tiket'],
                'ket_uang_tiket' => $row_spd_pengeluaran ['ket_uang_tiket'],
                'uang_transport' => $row_spd_pengeluaran ['uang_transport'],
                'ket_uang_transport' => $row_spd_pengeluaran ['ket_uang_transport'],
                'uang_penginapan' => $row_spd_pengeluaran ['uang_penginapan'],
                'ket_uang_penginapan' => $row_spd_pengeluaran ['ket_uang_penginapan'],
                'uang_lain' => $row_spd_pengeluaran ['uang_lain'],
                'ket_uang_lain' => $row_spd_pengeluaran ['ket_uang_lain'],
                'uang_muka' => $row_spd_pengeluaran ['uang_muka'],
                'ket_uang_muka' => $row_spd_pengeluaran ['ket_uang_muka'],
                'tanggal_kuitansi' => $this->request->getVar('tanggal_kuitansi'),
                'bendahara' => $pejabat['bendahara'],
                'nip_bendahara' => $pejabat['nip_bendahara'],
                'ppkom' => $pejabat['ppkom'],
                'nip_ppkom' =>$pejabat['nip_ppkom'],
            ];

            
            $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);		//Folio-L;
            $mpdf->defaultfooterline = 0.2;
            $mpdf->defaultfooterfontsize=10;
            $mpdf->defaultfooterfontstyle='I';
            // $mpdf->setFooter('SPD Rampung||'.'#{PAGENO}');
            
            if($this->request->getVar('jenis_cetak') == 'spd-rampung') {
                $view = 'spd/cetak_kuitansi_rampung';
            }else{
                $view  = 'spd/cetak_kuitansi_um';
            };
            
            $html = view($view, $data);
            // return $html;
            
            $mpdf->WriteHTML($html);
            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output('SPD_Rampung '.time(),'I'); // I=opens in browser; D=downloads
        // endif;
    
    }
    
    
}