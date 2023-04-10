<?php

namespace App\Controllers;
use App\Models\SuratTugasModel;
use App\Models\SpdModel;
use App\Models\TemplateModel;
use App\Models\SuratTugasPersonilModel;
use App\Models\SuratTugasLokasiModel;
use App\Models\LokasiModel;
use App\Models\PegawaiModel;
use App\Models\KlompegModel;

use App\Models\PenandatanganModel;

class Surattugas extends BaseController
{
    public function __construct()
    {
        $this->mSuratTugas = new SuratTugasModel;
        $this->mSpd = new SpdModel;
        $this->mTemplate= new TemplateModel;
        $this->mSTPersonil = new SuratTugasPersonilModel;
        $this->mSTLokasi = new SuratTugasLokasiModel;
        $this->mLokasi = new LokasiModel;
        $this->mKlompeg = new KlompegModel;
        $this->mPegawai = new PegawaiModel;
        $this->mPenandatangan = new PenandatanganModel;
    }   
        
    public function index() {        
        $data = [
            'title_page' => 'Data Surat Tugas',
        ];
        
        return view('surattugas/index', $data);
    }

    public function laporan(){
        $data = [
            'title_page' => 'Surat Tugas',
            'klompeg' => $this->mKlompeg->findall(),
        ];
        
        return view('surattugas/laporan', $data);
    
    }
    
    public function listData(){
        if($this->request->isAJAX()){
            $startDate = $this->request->getVar('tgl_filter_1');
            $endDate = $this->request->getVar('tgl_filter_2');
            
            if( $startDate != NULL  ? $startDate = $startDate : $startDate = date('Y-01-01')  );
            if( $endDate != NULL  ? $endDate = $endDate : $endDate = date('Y-12-31')  );

            $data_st = $this->mSuratTugas->selectRange($startDate, $endDate);
           
            $bukaTabel = "
                <table id=\"tabeldata\" class=\"table table-striped projects\">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perihal Tugas</th>
                            <th>Tujuan</th>
                            <th>Personil</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                
            $tutupTabel = "</tbody></table>";

            $isiTabel = "";
            
            foreach ($data_st as $row):                
                $nomor_st = $row['nomor_st']; 
                $ambil_angka = explode("/",$nomor_st) [0];
                $bersihkan_dot  = explode(".",$ambil_angka);	
                $no_agenda	= $bersihkan_dot [0];

                $isiTabel .= "
                        <tr>
                            <td class=\"\">".$no_agenda."</td>                           
                            <td>".$row['perihal_st']."<br>
                                <span class=\"badge badge-success\">ST ".ucfirst($row['jabatan_ttd'])." Nomor: ".$row['nomor_st']."</span> 
                                <span class=\"badge badge-warning\">Tanggal ST: ".$row['tanggal_st']."</span>
                                <span class=\"badge badge-secondary\">Masa Tugas: ".$row['tanggal_berangkat']." s.d. ".$row['tanggal_kembali'].
                                "</span>
                            </td>
                            <td>";                            
                                //dapetin lokasi
                                $st_lokasi = $this->mSTLokasi->like('surat_tugas_id' , $row['id_st'])->findAll();
                                
                                foreach ($st_lokasi as $lok) :
                                    $isiTabel .= "<span class=\"badge badge-info\">". $lok['nama_lokasi']. "</span> ";
                                endforeach;
                            
                $isiTabel .="</td>
                            <td>";
                                //ambil personil
                                $st_personil = $this->mSTPersonil->like('surat_tugas_id' , $row['id_st'])->findAll();
                                foreach ($st_personil as $personil) :
                                        $isiTabel .= "<span class=\"badge badge-dark\">". $personil['nama']. "</span> ";                                    
                                endforeach;
                                
                $isiTabel .="</td>       
                            <td align=\"center\">
                                <div class=\"btn-group\">
                                <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                    Aksi
                                </button>
                                <div class=\"dropdown-menu\">
                                    <a class=\"dropdown-item\"  href=\"".site_url('surattugas/cetak/').base64_encode($row['id_st']). "\" target=\"blank\">Cetak ST</a>
                                    <a  class=\"dropdown-item\" href=\"".site_url('surattugas/detil/').base64_encode($row['id_st'])."\">Form SPD</a>
                                    <div class=\"dropdown-divider\"></div>
                                    <a class=\"dropdown-item\" href=\"".site_url('surattugas/ubah/').base64_encode($row['id_st']). "\">Ubah Data</a>
                                    <a type=\"button\" class=\"dropdown-item\"  onclick=\"hapus(". $row['id_st'].")\">Hapus Data</a>
                                </div>
                                </div>                                
                            </td>";

                $isiTabel .="
                        </tr>";
                             
            endforeach;
            
            $msg = [
                'periode' => 'Periode '.tgl_id($startDate).' s.d. '.tgl_id($endDate),
                'startDate' => $startDate,
                'endDate' => $endDate,
                'buka_tabel' => $bukaTabel,                
                'isi_tabel' => $isiTabel,                
                'tutup_tabel' => $tutupTabel,                
            ];
            
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function detil($id){
        $data = [
            'id_st' => base64_decode($id),  
            'title_page' => 'Detil Surat Tugas',
        ];
        
        return view('surattugas/detil', $data);
    }
    
    public function dataDetil(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('id');
            $row = $this->mSuratTugas->find($id);

            $st_personil = $this->mSTPersonil->like('surat_tugas_id' , $row['id_st'])->orderby('nama','ASC')->findAll();
            $isiPersonil = "<table class=\"table table-striped table-hover p-0 \">";
            foreach($st_personil as $personil):
                //cek apakah personil sudah dibuatkan SPD
                $cek_spd = $this->mSpd->like('st_personil_id', $personil['id_st_personil'])->countAllResults();
                     
                if($cek_spd == 0){
                    $isiPersonil .= "
                                <tr>
                                    <td class=\"text-bold\">".$personil['nama']."</td>
                                    <td>".$personil['jabatan']."</td>
                                    <td><button type=\"button\" class=\"btn btn-sm btn-primary buatSpd\" onclick=\"buatSpd(". $personil['id_st_personil'].")\">Buat SPD</button></td> 
                                </tr>
                                ";
                }else{
                    $row_spd = $this->mSpd->where('st_personil_id',$personil['id_st_personil'])->first();
                    $isiPersonil .= "
                                <tr>
                                    <td class=\"text-bold\">".$personil['nama']."</td>
                                    <td>".$personil['jabatan']."</td>
                                    <td>
                                    <div class=\"btn-group\">
                                        <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                            Aksi
                                        </button>
                                        <div class=\"dropdown-menu\">
                                            <a class=\"dropdown-item\"  href=\"".site_url('spd/cetak/').base64_encode($row_spd['id_spd']). "\" target=\"blank\">Cetak SPD/LK</a>
                                            <div class=\"dropdown-divider\"></div>
                                            <a type=\"button\" class=\"dropdown-item\" onclick=\"ubahSpd(".$row_spd['id_spd'].")\"> Ubah Data</a>
                                            <a type=\"button\" class=\"dropdown-item\"  onclick=\"hapusSpd(".$row_spd['id_spd'].")\">Hapus Data</a>
                                        </div>
                                    </div>  
                                    </td> 
                                </tr>
                                ";
                };
            endforeach;
            $isiPersonil .="</table>";

            
            $st_lokasi = $this->mSTLokasi->like('surat_tugas_id' , $row['id_st'])->findAll();
            $st_lokasi_numrows = $this->mSTLokasi->like('surat_tugas_id' , $row['id_st'])->countAllResults();

            $isiLokasi = "";
            if ($st_lokasi_numrows == 1) : 
                $no=1;
                foreach ($st_lokasi as $lokasi): 
                    $isiLokasi .= $lokasi['nama_lokasi'].' ('.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi'] .' - ': NULL).$lokasi['kota_lokasi'].')';
                endforeach;
                endif; 
                
                if ($st_lokasi_numrows > 1) : 
                $no=1;
                foreach ($st_lokasi as $lokasi): 
                    $isiLokasi .= $no++ . '. ' .$lokasi['nama_lokasi'].' ('.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi']
                                    .' - ': NULL).$lokasi['kota_lokasi'].')<br>';
                endforeach;
            endif;
            

            $date1 = date_create($row['tanggal_berangkat']);
            $date2 = date_create($row['tanggal_kembali']);        
            $diff = date_diff($date1,$date2) ->format('%d') ;
            $masa_hari = $diff + 1;

            $masa_tugas = $masa_hari.' ('.terbilang($masa_hari).' ) hari <br>'
                            .tgl_id($row['tanggal_berangkat']). ' s.d. '.tgl_id($row['tanggal_kembali']);
            $msg = [
                'id_st' => 'id_st',
                'perihal_st' => $row['perihal_st'],
                'nomor_st' => $row['nomor_st'],
                'tanggal_st' => tgl_id($row['tanggal_st']),
                'tanggal_buat' => $row['created_at'],
                'masa_tugas' => $masa_tugas,  
                'personil' => $isiPersonil,
                'lokasi' => $isiLokasi,
            ];

            echo json_encode($msg);
        }     
    }

    public function tambah() {               
        $data = [
            'st_terakhir' => $this->mSuratTugas->dataTerakhir(),
            'title_page' => 'Data Surat Tugas',
        ];
        
        return view('surattugas/add', $data);
    }
    
    public function dataTambah(){
        if($this->request->isAJAX()){
            $jenis_st = $this->request->getVar('jenis_st');
            
            $start_table ="";
            $start_table .='<p><span  class="text-bold">Personil Ditugaskan</span> <span class="text-danger text-sm" id="error_personil"> </span></p>
                            <div class="border rounded  p-2"  > 
                            <table class="table table-hover" id="tabel_personil" >
                            <thead>
                            <tr><th>#</th><th>Nama</th><th>Jabatan</th></tr>
                            </thead>
                            <tbody >';  
                            
            $dataPegawai = $this->mPegawai->pegawaiSetkomAktif($jenis_st);
            
            $isiPegawai = "";            
            foreach($dataPegawai as $row):
                $isiPegawai .='
                            <tr>
                                <td>'.$row['id_pegawai'].'</td>
                                <td>'.$row['nama'].'</td>
                                <td>'.$row['nama_jabatan'].'</td>
                            </tr>
                ';
            endforeach;
            
            $end_table="";
            $end_table .= '</tbody></table></div>';
            
            if($jenis_st == 'ketua'){
                $isi_jabatan_ttd = "";
                $isi_jabatan_ttd .='
                                <option value="Ketua">Ketua</option>
                                <option value="Plt. Ketua">Plt. Ketua</option>
                                <option value="Plh. Ketua">Plh. Ketua</option>
                            ';
                            
            } 
            
            if($jenis_st == 'sekretaris'){
                $isi_jabatan_ttd = "";
                $isi_jabatan_ttd .='
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Plt. Sekretaris">Plt. Sekretaris</option>
                                <option value="Plh. Sekretaris">Plh. Sekretaris</option>
                            ';
            }
            
            $msg = [
                'jenis_st' => $jenis_st,
                'start_table' => $start_table,
                'row_pegawai' => $isiPegawai,
                'end_table' => $end_table,
                'jabatan_ttd' => $isi_jabatan_ttd,
            ];

            echo json_encode($msg);
            
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function nomor_st(){
        if($this->request->isAJAX()){
            $jenis_st = $this->request->getVar('jenis_st');
            
            if($jenis_st == 'ketua'){
                $kode_pejabat = config('site')->kodePejabatKetua;            
            } 
            
            if($jenis_st == 'sekretaris'){
                $kode_pejabat = config('site')->kodePejabatSekretaris;
            }
            
            if (config('site')->nomor_bulan == true ) {
                $bulan = angka_romawi(date('n')).'/';					
            } else $bulan = NULL;

            $st_terakhir = $this->mSuratTugas->dataTerakhir();

            if( !empty($st_terakhir['id_st']) )
            {
                $agenda_terakhir        = $st_terakhir['nomor_st']; 
                $expl_agenda_terakhir 	= explode("/",$agenda_terakhir);	
                $ambil_angka 			= $expl_agenda_terakhir [0];
                $bersihkan_dot			= explode(".",$ambil_angka);	
                $no_agenda_terakhir		= $bersihkan_dot [0];
                $agenda_skg				= $no_agenda_terakhir + 1;
                
            }else {
                $agenda_skg 	= 1;
                $no_agenda_terakhir = '-';
            }
            
            $data = [
                'nomor_st_skg' =>  $agenda_skg.'/'.config('site')->kodeWilSt.'/'.$kode_pejabat.'/'.$bulan.date('Y'),
                'nomor_lalu' => $no_agenda_terakhir
            ];

            echo json_encode($data);
        }
    }
    
    public function simpandata(){
        if($this->request->isAJAX()){
            // var_dump(($_POST['personil']));
            
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'jenis_st' => [
                    'label' => 'Jenis ST',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus dipilih',
                    ],
                ],
                'nomor_st' => [
                    'label' => 'Nomor ST',
                    'rules' => 'required|is_unique[surat_tugas.nomor_st]',
                    'errors' => [
                        'required' => '* harus diisi ',
                        'is_unique' => 'Nomor ini sudah terdaftar. Klik reload untuk mendapatkan saran nomor baru',
                    ],
                ],

                'perihal' => [
                    'label' => 'Perihal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'dasar_st' => [
                    'label' => 'Dasar ST',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'lokasi.*' => [
                    'label' => 'Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'tgl_st' => [
                    'label' => 'Tanggal ST',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'tgl_berangkat' => [
                    'label' => 'Tanggal Berangkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'tgl_kembali' => [
                    'label' => 'Tanggal Kembali',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'kota_ttd' => [
                    'label' => 'Tanggal Kembali',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'nama_ttd' => [
                    'label' => 'Nama Penandatangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'jabatan_ttd' => [
                    'label' => 'Jabatan Penandatangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'personil.*' => [
                    'label' => 'Personil',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* belum ada yang dipilih',
                    ],
                ],
                
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'jenis_st' => $validation->getError('jenis_st'),
                        'nomor_st' => $validation->getError('nomor_st'),
                        'perihal' => $validation->getError('perihal'),
                        'dasar_st' => $validation->getError('dasar_st'),
                        'lokasi' => $validation->getError('lokasi.*'),
                        'tgl_st' => $validation->getError('tgl_st'),
                        'tgl_berangkat' => $validation->getError('tgl_berangkat'),
                        'tgl_kembali' => $validation->getError('tgl_kembali'),
                        'kota_ttd' => $validation->getError('kota_ttd'),
                        'nama_ttd' => $validation->getError('nama_ttd'),
                        'jabatan_ttd' => $validation->getError('jabatan_ttd'),
                        'personil' => $validation->getError('personil.*'),
                    ]
                ];
                
            }else{
                $simpandata = [
                    'perihal_st' => $this->request->getVar('perihal'),
                    'jenis_st' => $this->request->getVar('jenis_st'),
                    'nomor_st' => $this->request->getVar('nomor_st'),
                    'dasar_st' => $this->request->getVar('dasar_st'),
                    'tanggal_st' => $this->request->getVar('tgl_st'),
                    'tanggal_berangkat' => $this->request->getVar('tgl_berangkat'),
                    'tanggal_kembali' => $this->request->getVar('tgl_kembali'),
                    'kota_ttd' => $this->request->getVar('kota_ttd'),
                    'jabatan_ttd' => $this->request->getVar('jabatan_ttd'),
                    'nama_ttd' => $this->request->getVar('nama_ttd'),    
                    'created_by' => 1 //ganti dengan session                    
                ];
                    
                $this->mSuratTugas->insert($simpandata);

                //###ambil id_st terakhir dari tabel st_kom --//
                $st_disimpan = $this->mSuratTugas->dataTerakhir();
                
                //masukkan personil 
                $jumlah = count($_POST["personil"]); 			
                
                for($i=0; $i < $jumlah; $i++) 
                {
                    $id_pegawai=$_POST["personil"][$i];
                    $personil = $this->mPegawai->selectId($id_pegawai);
                    
                    $simpan_personil = [
                        'surat_tugas_id' =>  $st_disimpan['id_st'],
                        'pegawai_id' =>  $personil['id_pegawai'],
                        'nama' => $personil['nama'],
                        'nip' => $personil['nip'],
                        'golongan' => $personil['golongan'],
                        'klompeg' => $personil['nama_klompeg'],
                        'jabatan' => $personil['nama_jabatan'].' ('.$personil['nama_subbag'].')',
                    ];		
                    
                    $this->mSTPersonil->insert($simpan_personil);
                }

                //memasukkan lokasi ke tabel st_lokasi
                foreach ($_POST['lokasi'] as $lok)
                {
                    $sel_lokasi = $this->mLokasi->find($lok);
                    
                    $simpan_lokasi = [
                        'surat_tugas_id' => $st_disimpan['id_st'],
                        'nama_lokasi' => $sel_lokasi['nama_lokasi'], 
                        'alamat_lokasi' => $sel_lokasi['alamat'], 
                        'kota_lokasi' => $sel_lokasi['kota_lokasi'], 
                    ];		
                    
                    $this->mSTLokasi->insert($simpan_lokasi);
                }

                $msg = [
                    'sukses' => 'Data telah disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
    
    public function ambilPejabatTtd(){
        if($this->request->isAJAX()){
                        
            $jabatan_ttd = $this->request->getVar('jabatan_ttd');
           
            if ($jabatan_ttd === 'Ketua') {
                $jabatan_ttd = 'ketua';
            }elseif ($jabatan_ttd === 'Plt. Ketua') {
                $jabatan_ttd = 'plt_ketua';
            }elseif ($jabatan_ttd === 'Plh. Ketua') {
                $jabatan_ttd = 'plh_ketua';
            }elseif ($jabatan_ttd === 'Plh. Ketua') {
                $jabatan_ttd = 'plh_ketua';
            }elseif ($jabatan_ttd === 'Sekretaris') {
                $jabatan_ttd = 'sekretaris';
            }elseif ($jabatan_ttd === 'Plt. Sekretaris') {
                $jabatan_ttd = 'plt_sekretaris';
            }else {
                $jabatan_ttd = 'plh_sekretaris';
            };

            $penandatangan = $this->mPenandatangan->selectOne(); 
            // $penandatangan = $this->mPenandatangan->orderBy('id_penandatangan', 'DESC')->limit(1)->find(); 
            
            $data = [
                'nama_ttd' => $penandatangan[$jabatan_ttd],
            ];

            echo json_encode($data);
            
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function tambahlokasi(){
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('surattugas/tambahlokasi')                
            ];
            echo json_encode($msg);   

        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function ubah($id){
        $data = [
            'id_st' => base64_decode($id),  
            'title_page' => 'Data Surat Tugas',
        ];
        
        return view('surattugas/edit', $data);

    }

    public function dataEdit(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('id');
            $row = $this->mSuratTugas->find($id);
                        
            $data_lokasi = $this->mLokasi->orderBy('nama_lokasi','ASC')->findAll();
            $r_lokasi = $this->mSTLokasi->like('surat_tugas_id',$id)->findAll();
            $isiLokasi = "";
            
            $arr_lokasi = array();            
            foreach($r_lokasi as $r_lok) :
                array_push($arr_lokasi, $r_lok['nama_lokasi']);
            endforeach;
            
            foreach($data_lokasi as $all_lokasi): 
                if (in_array($all_lokasi['nama_lokasi'], $arr_lokasi) )
                {
                    $selected = " selected"; 
                }else{
                    $selected = NULL; 	
                }

                $isiLokasi .="<option value=\"".$all_lokasi['id_lokasi']."\" ".$selected.">".$all_lokasi['nama_lokasi']."</option>";
                  
            endforeach;
          
            $table_header ="";
            $table_header .='<p><span  class="text-bold">Personil Ditugaskan</span> <span class="text-danger text-sm" id="error_personil"> </span></p>
                            <div class="border rounded  p-2"  > 
                            <table class="table table-hover" id="tabel_personil" width="100%">
                            <thead>
                                <tr><th>#</th><th>Nama</th><th>Jabatan</th></tr>
                            </thead>
                            <tbody >';  
            
            $dataPegawai = $this->mPegawai->pegawaiSetkomAktif($row['jenis_st'],1);
            $r_personil = $this->mSTPersonil->like('surat_tugas_id',$id)->findAll();            
            
            $arr_personil = array();            
            foreach($r_personil as $row_personil):
                array_push($arr_personil, $row_personil['nama']);                 
            endforeach;
            
            $isiPegawai = "";            
            foreach($dataPegawai as $r_peg):
                if (in_array($r_peg['nama'], $arr_personil) )
                {
                    $checked = " checked"; 
                }else{
                    $checked = NULL; 	
                }

                $isiPegawai .='
                            <tr>
                            <td><input class="minimal" type="checkbox" id="personil" name="personil[]" value="'.$r_peg['id_pegawai'].'" '.$checked.' >
                            </td>
                            <td>'.$r_peg['nama'].'</td>
                            <td>'.$r_peg['nama_jabatan'].'</td>
                            </tr>
                ';
            endforeach;

            $end_table="";
            $end_table .= '</tbody></table></div>';
            
            if($row['jenis_st'] === 'ketua'){
                $kode_pejabat= config('site')->kodePejabatKetua;
                $isi_jabatan_ttd = "";
                $isi_jabatan_ttd .='
                                <option value="Ketua" ';
                                if($row['jabatan_ttd'] == "Ketua") {
                                    $isi_jabatan_ttd .=' selected';
                                };
                                $isi_jabatan_ttd .='>Ketua</option>
                                <option value="Plt. Ketua" ';
                                if($row['jabatan_ttd'] == "Plh. Ketua") {
                                    $isi_jabatan_ttd .=' selected';
                                };
                                $isi_jabatan_ttd .='>Plt. Ketua</option>
                                <option value="Plh. Ketua" ';
                                if($row['jabatan_ttd'] == "Plt. Ketua") {
                                    $isi_jabatan_ttd .=' selected';
                                };
                                $isi_jabatan_ttd .='>Plh. Ketua</option>
                            ';
                            
            } else {
                $kode_pejabat= config('site')->kodePejabatSekretaris;
                $isi_jabatan_ttd = "";
                $isi_jabatan_ttd .='
                                    <option value="Sekretaris" ';
                                    if($row['jabatan_ttd'] == "Sekretaris") {
                                        $isi_jabatan_ttd .=' selected';
                                    };
                                    $isi_jabatan_ttd .='>Sekretaris</option>
                                    <option value="Plt. Sekretaris" '; 
                                        if($row['jabatan_ttd'] == "Plt. Sekretaris") {
                                            $isi_jabatan_ttd .=' selected';
                                        };
                                        $isi_jabatan_ttd .='>Plt. Sekretaris</option>
                                    <option value="Plh. Sekretaris" ';
                                    if($row['jabatan_ttd'] == "Plh. Sekretaris") {
                                        $isi_jabatan_ttd .=' selected';
                                    };
                                    $isi_jabatan_ttd .='>Plh. Sekretaris</option>
                                    ' ;
            }
            
            if (config('site')->nomor_bulan == true ) {
                $bulan = angka_romawi(date('n')).'/';					
            } else $bulan = NULL;

            
            $msg = [
                'id_st' => $row['id_st'],
                'jenis_st' => $row['jenis_st'],
                'nomor_st' => $row['nomor_st'],
                'perihal' => $row['perihal_st'],
                'dasar_st' => $row['dasar_st'],
                'tanggal_st' => $row['tanggal_st'],
                'tanggal_berangkat' => $row['tanggal_berangkat'],
                'tanggal_kembali' => $row['tanggal_kembali'],
                'kota_ttd' => $row['kota_ttd'],
                'jabatan_ttd' => $row['jabatan_ttd'],
                'nama_ttd' => $row['nama_ttd'],         
                
                'row_pegawai' => $isiPegawai,
                'table_header' => $table_header,
                'end_table_header' => $end_table,
                'jabatan_ttd' => $isi_jabatan_ttd,
                'isi_lokasi' => $isiLokasi,
            ];

            echo json_encode($msg);
            
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public function simpanupdate(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('idst');
            
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'perihal' => [
                    'label' => 'Perihal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'dasar_st' => [
                    'label' => 'Dasar ST',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'lokasi.*' => [
                    'label' => 'Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'tgl_st' => [
                    'label' => 'Tanggal ST',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'tgl_berangkat' => [
                    'label' => 'Tanggal Berangkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'tgl_kembali' => [
                    'label' => 'Tanggal Kembali',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'kota_ttd' => [
                    'label' => 'Tanggal Kembali',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'nama_ttd' => [
                    'label' => 'Nama Penandatangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'jabatan_ttd' => [
                    'label' => 'Jabatan Penandatangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'personil.*' => [
                    'label' => 'Personil',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* belum ada yang dipilih',
                    ],
                ],
                
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'perihal' => $validation->getError('perihal'),
                        'dasar_st' => $validation->getError('dasar_st'),
                        'lokasi' => $validation->getError('lokasi.*'),
                        'tgl_st' => $validation->getError('tgl_st'),
                        'tgl_berangkat' => $validation->getError('tgl_berangkat'),
                        'tgl_kembali' => $validation->getError('tgl_kembali'),
                        'kota_ttd' => $validation->getError('kota_ttd'),
                        'nama_ttd' => $validation->getError('nama_ttd'),
                        'jabatan_ttd' => $validation->getError('jabatan_ttd'),
                        'personil' => $validation->getError('personil.*'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'perihal_st' => $this->request->getVar('perihal'),
                        'jenis_st' => $this->request->getVar('jenis_st'),
                        'nomor_st' => $this->request->getVar('nomor_st'),
                        'dasar_st' => $this->request->getVar('dasar_st'),
                        'tanggal_st' => $this->request->getVar('tgl_st'),
                        'tanggal_berangkat' => $this->request->getVar('tgl_berangkat'),
                        'tanggal_kembali' => $this->request->getVar('tgl_kembali'),
                        'kota_ttd' => $this->request->getVar('kota_ttd'),
                        'jabatan_ttd' => $this->request->getVar('jabatan_ttd'),
                        'nama_ttd' => $this->request->getVar('nama_ttd'),                        
                    ];
                    
                $this->mSuratTugas->update($id, $simpandata);

                //hapus dulu surat tugas lokasi lama
                $r_lokasi = $this ->mSTLokasi ->like('surat_tugas_id', $id) ->findAll();
                foreach ($r_lokasi as $r_lok):
                    $this->mSTLokasi ->delete($r_lok['id_st_lokasi']);
                endforeach;
                
                //memasukkan lokasi baru ke tabel st_lokasi
                foreach ($_POST['lokasi'] as $lok)
                {
                    $sel_lokasi = $this->mLokasi->find($lok);
                    
                    $simpan_lokasi = [
                        'surat_tugas_id' => $id,
                        'nama_lokasi' => $sel_lokasi['nama_lokasi'], 
                        'alamat_lokasi' => $sel_lokasi['alamat'], 
                        'kota_lokasi' => $sel_lokasi['kota_lokasi'], 
                    ];		
                    
                    $this->mSTLokasi->insert($simpan_lokasi);
                }

                //UPDATE ST_PERSONIL ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // Simpan personil update ke array
                // bandingkan data lama dengan array
                // jika ada baru tambahkan
                // personil lama dihapus

                    
                $personil_lama = $this->mSTPersonil ->like('surat_tugas_id', $id) ->findAll();
                //simpan personil lama dalam array
                $id_person_lama = array();	
                foreach($personil_lama as $terdaftar)
                {
                    array_push($id_person_lama, $terdaftar['pegawai_id']);
                }
                
                //simpan personil baru ke array 
                $jumlah_baru= count($_POST["personil"]); 
                $id_person_baru=array();
                for($i=0; $i < $jumlah_baru; $i++) 
                {
                    array_push($id_person_baru, $_POST["personil"][$i]);
                }

                //bandingkan PERSONIL BARU dalam array dengan personil lama
                foreach ($id_person_baru as $new)
                {
                    // yg belum ada daftarkan baru
                    if (!in_array($new, $id_person_lama))
                    {
                        $personil = $this->mPegawai->selectId($new);
                    
                        $data_personil=array (
                              'surat_tugas_id' =>  $id
                            , 'pegawai_id' => $personil['id_pegawai']
                            , 'nama' => $personil['nama']
                            , 'nip' => $personil['nip']
                            , 'golongan' => $personil['golongan']
                            , 'klompeg' => $personil['nama_klompeg']
                            , 'jabatan' => $personil['nama_jabatan'].' ('.$personil['nama_subbag'].')'
                        );		
                        $this->mSTPersonil->insert($data_personil);
                        reset($data_personil);
                    }
                }

                //bandingkan personil LAMA dengan yg post baru
                foreach ($id_person_lama as $old) 
                {
                    if(!in_array($old, $id_person_baru))  //jika person lama tidak ada dalam person baru
                    {
                        //personil lama yg sudah tidak masuk di daftar baru, dihapus dari daftar personil dan SPD
                        $row_st_person = $this->mSTPersonil->WHERE('surat_tugas_id', $id)->WHERE('pegawai_id', $old)->findAll();
                        foreach($row_st_person as $row_st_person ):
                            // var_dump($row_st_person['id_st_personil']);exit;
                            $row_spd = $this->mSpd->where('st_personil_id',$row_st_person['id_st_personil'])->findAll();
                            foreach($row_spd as $row_spd ):                        
                                $this->mSpd->delete($row_spd['id_spd']); 
                            endforeach;
                            $this->mSTPersonil->delete($row_st_person['id_st_personil']); 
                        endforeach;
                    }
                }

                $msg = [
                    'sukses' => 'Data telah disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    
    public function cetak($id)
    {
        $row = $this->mSuratTugas->find(base64_decode($id));
        $date1=date_create($row['tanggal_berangkat']);
        $date2=date_create($row['tanggal_kembali']);        
        $diff=date_diff($date1,$date2)->format('%d') ;
        
        $data = [
            'id' => $id,
            'jenis_st' => $row['jenis_st'],
            'instansi' => config('site')->instansi,
            'kabkota' => config('site')->kabkota,
            'ibukota' => config('site')->ibukota,
            'email' => config('site')->email,
            'website' => config('site')->website,
            'alamat' => config('site')->alamat,
            'nomor_st' => $row['nomor_st'],
            'template' => $this->mTemplate->findAll(),
            'masa_tugas' => $diff+1, 
            
            'dasar_st' => $row['dasar_st'],
            'st_personil' => $this->mSTPersonil->like('surat_tugas_id' , $row['id_st'])->findAll(),
            'st_personil_numrows' => $this->mSTPersonil->like('surat_tugas_id',$row['id_st'])->countAllResults(),
            'perihal_st' => $row['perihal_st'],
            'tgl_st' => $row['tanggal_st'],  
            'jabatan_ttd' => $row['jabatan_ttd'],  
            'nama_ttd' => $row['nama_ttd'],  
            'tgl_berangkat' => $row['tanggal_berangkat'],  
            'tgl_kembali' => $row['tanggal_kembali'],  
            'st_lokasi' => $this->mSTLokasi->like('surat_tugas_id' , $row['id_st'])->findAll(),
            'st_lokasi_numrows' => $this->mSTLokasi->like('surat_tugas_id' , $row['id_st'])->countAllResults(),
            
        ];
        
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter('<small>'.$row['nomor_st'].'</small>||'.'#{PAGENO} ');
		$html = view('surattugas/cetak', $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('ST-'.time(),'I'); // I=opens in browser; D=downloads
		
    }
    
    public function hapusdata($id){
        if($this->request->isAJAX()){

            //hapus dulu surat tugas lokasi
            $r_lokasi = $this ->mSTLokasi ->like('surat_tugas_id', $id) ->findAll();
            foreach ($r_lokasi as $r_lok):
                $this->mSTLokasi ->delete($r_lok['id_st_lokasi']);
            endforeach;

            //hapus surat tugas personil & SPD
            $r_personil = $this->mSTPersonil ->like('surat_tugas_id', $id) ->findAll();
            foreach ($r_personil as $r_person):
                $r_spd = $this->mSpd->where('st_personil_id', $r_person['id_st_personil'])->findAll();
                foreach ( $r_spd as $r_spd):
                    $this->mSpd->delete($r_spd['id_spd']);
                endforeach;
                $this->mSTPersonil ->delete($r_person['id_st_personil']);
            endforeach;
            
            //hapus surat tugas
            $this->mSuratTugas->delete($id);
            
            $msg = [
                'sukses' => 'Data telah dihapus',
            ];
            
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }


    
}