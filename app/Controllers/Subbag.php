<?php

namespace App\Controllers;
use App\Models\SubbagModel;
use App\Models\KlompegModel;

class Subbag extends BaseController
{
    public function index() {        
        $data = [
            'title_page' => 'Data Subbag/Divisi'
        ];
        return view('subbag/tampildata', $data);
    }

    public function ambildata(){
        if($this->request->isAJAX()){
            $mSubbag = new SubbagModel; 
            
            $data = [
                'tampildata' => $mSubbag->tampilSemua(), 
            ]; 

            $msg = [
                'data' => view('subbag/tabeldata', $data)                
            ];

            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formtambah(){
        if($this->request->isAJAX()){

            $mKlompeg = new KlompegModel;
            
            $data = [
               'dataKlompeg' => $mKlompeg->findAll(),
            ];
                        
            $msg = [
                'data' => view('subbag/formtambah', $data)                
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
                'klompeg' => [
                    'label' => 'klompeg',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih bagian terlebih dahulu',
                    ],
                ],
                'nama_subbag' => [
                    'label' => 'Nama Subbag',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'klompeg' => $validation->getError('klompeg'),
                        'nama_subbag' => $validation->getError('nama_subbag'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'klompeg_id' => $this->request->getVar('klompeg'),
                        'nama_subbag' => $this->request->getVar('nama_subbag'),
                    ];
                
                $msubbag = new SubbagModel;
            
                $msubbag->insert($simpandata);

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
            
            $mKlompeg = new KlompegModel;
            $msubbag = new SubbagModel;
            
            $id_subbag = $this->request->getVar('id_subbag');
            $row = $msubbag->tampilId($id_subbag);

            $data = [
                'id_subbag' => $row['id_subbag'],
                'klompeg_id' => $row['klompeg_id'],
                'nama_subbag' => $row['nama_subbag'],
                'dataKlompeg' => $mKlompeg->findAll(),
            ];

            $msg = [
                'sukses' => view('subbag/formedit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function updatedata($id_subbag){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'klompeg' => [
                    'label' => 'Bagian Klompeg',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih {field} terlebih dahulu',
                    ],
                ],
                'nama_subbag' => [
                    'label' => 'Nama Subbag',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'klompeg' => $validation->getError('klompeg'),
                        'nama_subbag' => $validation->getError('nama_subbag'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_subbag' => $this->request->getVar('nama_subbag'),
                        'klompeg_id' => $this->request->getVar('klompeg'),
                    ];
                
                $msubbag = new SubbagModel;                
                $msubbag->update($id_subbag, $simpandata);

                $msg = [
                    'sukses' => 'Data telah diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapusdata($id_subbag){
        if($this->request->isAJAX()){
            $mSubbag = new SubbagModel;

            $mSubbag->delete($id_subbag);

            $msg = [
                'sukses' => '[$id_subbag] Data telah dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}