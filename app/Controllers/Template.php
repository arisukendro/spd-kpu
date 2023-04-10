<?php

namespace App\Controllers;
use App\Models\TemplateModel;

class Template extends BaseController
{
    public function index() {        
        $data = [
            'title_page' => 'Template: Dasar Surat Tugas',
            'themes' => $this->siteConfig->themes,
        ];
        return view('template/tampildata', $data);
    }

    public function ambildata(){
        if($this->request->isAJAX()){
            $mTemplate = new TemplateModel; 
            $data = [
                'tampildata' => $mTemplate->findAll(), 
            ]; 
            $msg = [
                'data' => view('template/tabeldata', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formtambah(){
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('template/formtambah')                
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
                'nomor_urut' => [
                    'label' => 'Nomor Urut',
                    'rules' => 'required|is_unique[template_surat_tugas.nomor_urut]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => 'Nomor ini sudah ada',
                    ],
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nomor_urut' => $validation->getError('nomor_urut'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nomor_urut' => $this->request->getVar('nomor_urut'),
                        'keterangan' => $this->request->getVar('keterangan'),
                    ];
                
                $mtemplate = new TemplateModel;
            
                $mtemplate->insert($simpandata);

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
            $id_template_st = $this->request->getVar('id_template_st');
            
            $mtemplate = new TemplateModel;
            $row = $mtemplate->find($id_template_st);

            $data = [
                'id_template_st' => $row['id_template_st'],
                'nomor_urut' => $row['nomor_urut'],
                'keterangan' => $row['keterangan'],
            ];

            $msg = [
                'sukses' => view('template/formedit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function updatedata($id_template_st){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nomor_urut' => [
                    'label' => 'Nomor Urut',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nomor_urut' => $validation->getError('nomor_urut'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nomor_urut' => $this->request->getVar('nomor_urut'),
                        'keterangan' => $this->request->getVar('keterangan'),
                    ];
                
                $mtemplate = new TemplateModel;                
                $mtemplate->update($id_template_st, $simpandata);

                $msg = [
                    'sukses' => 'Data telah diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapusdata($id_template_st){
        if($this->request->isAJAX()){
            $mTemplate = new TemplateModel;

            $mTemplate->delete($id_template_st);

            $msg = [
                'sukses' => '[$id_template] Data telah dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}