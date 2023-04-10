<?php

namespace App\Controllers;
use App\Models\JabatanModel;
use App\Models\KlompegModel;

class Jabatan extends BaseController
{
    public function __construct(){
            $this->mKlompeg = new KlompegModel;
            $this->mJabatan= new JabatanModel;
    }
    
    public function index() {        
        $data = [
            'title_page' => "Data Jabatan"
        ];
        return view('jabatan/index', $data);
    }

    public function list(){
        if($this->request->isAJAX()){
            $data = [
                'tampildata' => $this->mJabatan->tampilSemua(), 
            ]; 

            $msg = [
                'data' => view('jabatan/list', $data)                
            ];

            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function add(){
        if($this->request->isAJAX()){

            $data = [
               'dataKlompeg' => $this->mKlompeg->findAll(),
            ];
                        
            $msg = [
                'data' => view('jabatan/add', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function store(){
        if($this->request->isAJAX()){            
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'klompeg' => [
                    'label' => 'klompeg',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih bagian terlebih dahulu',
                    ],
                ],
                'nama_jabatan' => [
                    'label' => 'Nama Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'urutan_tampil' => [
                    'label' => 'Urutan',
                    'rules' => 'required|is_unique[jabatan.urutan_tampil]',
                    'errors' => [
                        'is_unique' => 'Nomor urut ini sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'klompeg' => $validation->getError('klompeg'),
                        'nama_jabatan' => $validation->getError('nama_jabatan'),
                        'urutan_tampil' => $validation->getError('urutan_tampil'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'klompeg_id' => $this->request->getVar('klompeg'),
                        'nama_jabatan' => $this->request->getVar('nama_jabatan'),
                        'urutan_tampil' => $this->request->getVar('urutan_tampil'),
                    ];
                
                $this->mJabatan->insert($simpandata);

                $msg = [
                    'sukses' => 'Data telah disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function edit(){
        if($this->request->isAJAX()){
            $id_jabatan = $this->request->getVar('id_jabatan');
            $row = $this->mJabatan->tampilId($id_jabatan);

            $data = [
                'id_jabatan' => $row['id_jabatan'],
                'klompeg_id' => $row['klompeg_id'],
                'nama_jabatan' => $row['nama_jabatan'],
                'urutan_tampil' => $row['urutan_tampil'],
                'dataKlompeg' => $this->mKlompeg->findAll(),
            ];

            $msg = [
                'sukses' => view('jabatan/edit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function update(){
        if($this->request->isAJAX()){
            $id_jabatan = $this->request->getVar('id_jabatan');
            
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'klompeg' => [
                    'label' => 'Bagian Kelompok Pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih {field} terlebih dahulu',
                    ],
                ],
                'nama_jabatan' => [
                    'label' => 'Nama Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'urutan_tampil' => [
                    'label' => 'Urutan',
                    'rules' => 'required|is_unique[jabatan.urutan_tampil]',
                    'errors' => [
                        'is_unique' => 'Nomor urut ini sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'klompeg' => $validation->getError('klompeg'),
                        'nama_jabatan' => $validation->getError('nama_jabatan'),
                        'urutan_tampil' => $validation->getError('urutan_tampil'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_jabatan' => $this->request->getVar('nama_jabatan'),
                        'klompeg_id' => $this->request->getVar('klompeg'),
                        'urutan_tampil' => $this->request->getVar('urutan_tampil'),
                    ];
                            
                $this->mJabatan->update($id_jabatan, $simpandata);

                $msg = [
                    'sukses' => 'Data telah diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function delete(){
        if($this->request->isAJAX()){
            $id_jabatan = $this->request->getVar('id_jabatan');
            $this->mJabatan->delete($id_jabatan);

            $msg = [
                'sukses' => '[$id_jabatan] Data telah dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}