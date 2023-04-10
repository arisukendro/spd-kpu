<?php

namespace App\Controllers;
use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    public function __construct(){
        $this->mLokasi = new LokasiModel; 
    }
    public function index() {        
        
        $data = [
            'title_page' => 'Data Lokasi'
        ];
        return view('lokasi/index', $data);
    }

    public function list(){
        if($this->request->isAJAX()){
            
            $data = [
                'tampildata' => $this->mLokasi ->orderBy('nama_lokasi', 'ASC')->findAll(), 
            ]; 
            $msg = [
                'data' => view('lokasi/list', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function add(){
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('lokasi/add')                
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
                'nama_lokasi' => [
                    'label' => 'Nama Lokasi',
                    'rules' => 'required|is_unique[lokasi.nama_lokasi]',
                    'errors' => [
                        'is_unique' => 'Lokasi sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'kota_lokasi' => [
                    'label' => 'Kota Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nama_lokasi' => $validation->getError('nama_lokasi'),
                        'kota_lokasi' => $validation->getError('kota_lokasi'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_lokasi' => $this->request->getVar('nama_lokasi'),
                        'alamat' => $this->request->getVar('alamat'),
                        'kota_lokasi' => $this->request->getVar('kota_lokasi'),
                    ];
                
                $this->mLokasi->insert($simpandata);

                $msg = [
                    'sukses' => 'Data Lokasi telah ditambahkan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function edit(){
        if($this->request->isAJAX()){
            $id_lokasi = $this->request->getVar('id_lokasi');
            
            $row = $this->mLokasi->find($id_lokasi);

            $data = [
                'id_lokasi' => $row['id_lokasi'],
                'nama_lokasi' => $row['nama_lokasi'],
                'alamat' => $row['alamat'],
                'kota_lokasi' => $row['kota_lokasi'],
            ];

            $msg = [
                'sukses' => view('lokasi/edit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function update(){
        if($this->request->isAJAX()){
            $id_lokasi = $this->request->getVar('id_lokasi');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_lokasi' => [
                    'label' => 'Nama Lokasi',
                   'rules' => 'required|is_unique[lokasi.nama_lokasi]',
                    'errors' => [
                        'is_unique' => 'Lokasi sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'kota_lokasi' => [
                    'label' => 'Kota Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nama_lokasi' => $validation->getError('nama_lokasi'),
                        'kota_lokasi' => $validation->getError('kota_lokasi'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_lokasi' => $this->request->getVar('nama_lokasi'),
                        'alamat' => $this->request->getVar('alamat'),
                        'kota_lokasi' => $this->request->getVar('kota_lokasi'),
                    ];
                
                $mlokasi = new LokasiModel;                
                $mlokasi->update($id_lokasi, $simpandata);

                $msg = [
                    'sukses' => 'Data telah diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function remove(){
        if($this->request->isAJAX()){
            $id_lokasi = $this->request->getVar('id_lokasi');
            
            $this->mLokasi->delete($id_lokasi);
            $msg = [
                'sukses' => '[$id_lokasi] Data telah dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}