<?php

namespace App\Controllers;
use App\Models\KlompegModel;

class Klompeg extends BaseController
{
    public function index() {        
        $config = new \Config\Site();
        
        $data = [
            'title_page' => 'Data Kelompok Pegawai'
        ];
        return view('klompeg/index', $data);
    }

    public function ambildata(){
        if($this->request->isAJAX()){
            $mKlompeg = new KlompegModel; 
            $data = [
                'tampildata' => $mKlompeg->findAll(), 
            ]; 
            $msg = [
                'data' => view('klompeg/list', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formtambah(){
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('klompeg/add')                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function simpandata(){
        if($this->request->isAJAX()){
            
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_klompeg' => [
                    'label' => 'Nama Klompeg',
                    'rules' => 'required|is_unique[klompeg.nama_klompeg]',
                    'errors' => [
                        'is_unique' => 'Nama ini sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nama_klompeg' => $validation->getError('nama_klompeg'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_klompeg' => $this->request->getVar('nama_klompeg'),
                    ];
                
                $mKlompeg = new KlompegModel;
            
                $mKlompeg->insert($simpandata);

                $msg = [
                    'sukses' => 'Data telah disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formedit(){
        if($this->request->isAJAX()){
            $id_klompeg = $this->request->getVar('id_klompeg');
            
            $mKlompeg = new KlompegModel;
            $row = $mKlompeg->find($id_klompeg);

            $data = [
                'id_klompeg' => $row['id_klompeg'],
                'nama_klompeg' => $row['nama_klompeg'],
            ];

            $msg = [
                'sukses' => view('klompeg/edit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function updatedata($id_klompeg){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_klompeg' => [
                    'label' => 'Nama Klompeg',
                    'rules' => 'required|is_unique[klompeg.nama_klompeg]',
                    'errors' => [
                        'is_unique' => 'Nama ini sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nama_klompeg' => $validation->getError('nama_klompeg'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_klompeg' => $this->request->getVar('nama_klompeg'),
                    ];
                
                $mKlompeg = new KlompegModel;                
                $mKlompeg->update($id_klompeg, $simpandata);

                $msg = [
                    'sukses' => 'Data telah diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapusdata($id_klompeg){
        if($this->request->isAJAX()){
            $mKlompeg = new KlompegModel;

            $mKlompeg->delete($id_klompeg);

            $msg = [
                'sukses' => '[$id_klompeg] Data telah dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}