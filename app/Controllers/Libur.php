<?php

namespace App\Controllers;
use App\Models\LiburModel;

class Libur extends BaseController
{
    public function __construct(){
            $this->mLibur = new LiburModel;
    }
    
    public function index() {        
        $data = [
            'title_page' => "Data Libur"
        ];
        return view('libur/index', $data);
    }

    public function list(){
        if($this->request->isAJAX()){
            $data = [
                'tampildata' => $this->mLibur->orderBy('tanggal_libur', 'DESC')->findAll(), 
            ]; 

            $msg = [
                'data' => view('libur/list', $data)                
            ];

            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function add(){
        if($this->request->isAJAX()){

            $data = [
                ];
                        
            $msg = [
                'data' => view('libur/add', $data)                
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
                'tglLibur' => [
                    'label' => 'Tanggal Libur',
                    'rules' => 'required|is_unique[libur.tanggal_libur]',
                    'errors' => [
                        'is_unique' => 'Tanggal sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'keterangan' => [
                    'label' => 'Keterangan Libur',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'tglLibur' => $validation->getError('tglLibur'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'tanggal_libur' => $this->request->getVar('tglLibur'),
                        'keterangan' => $this->request->getVar('keterangan'),
                    ];
                
                $this->mLibur->insert($simpandata);

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
            $id_libur = $this->request->getVar('id_libur');
            $row = $this->mLibur->tampilId($id_libur);

            $data = [
                'id_libur' => $row['id_libur'],
                'tglLibur' => $row['tanggal_libur'],
                'keterangan' => $row['keterangan'],
            ];

            $msg = [
                'sukses' => view('libur/edit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function update(){
        if($this->request->isAJAX()){
            $id_libur = $this->request->getVar('id_libur');
            
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tglLibur' => [
                    'label' => 'Tanggal Libur',
                    'rules' => 'required|is_unique[libur.tanggal_libur]',
                    'errors' => [
                        'is_unique' => 'Tanggal sudah terdaftar',
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'keterangan' => [
                    'label' => 'Keterangan Libur',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'tglLibur' => $validation->getError('tglLibur'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'tanggal_libur' => $this->request->getVar('tglLibur'),
                        'keterangan' => $this->request->getVar('keterangan'),
                    ];
                            
                $this->mLibur->update($id_libur, $simpandata);

                $msg = [
                    'sukses' => 'Data telah diperbarui',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function delete(){
        if($this->request->isAJAX()){
            $id_libur = $this->request->getVar('id_libur');
            $this->mLibur->delete($id_libur);

            $msg = [
                'sukses' => '[$id_libur] Data telah dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}