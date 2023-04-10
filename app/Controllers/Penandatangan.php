<?php

namespace App\Controllers;
use App\Models\PenandatanganModel;
use App\Models\PegawaiModel;

class Penandatangan extends BaseController
{
    public function __construct(){
         $this->mPenandatangan = new PenandatanganModel;
         $this->mPegawai = new PegawaiModel;

    }
    public function index() {            
        $row = $this->mPenandatangan-> orderBy('id_penandatangan','desc') -> find(1); 
                
            $data = [
                'title_page' => 'Pengaturan: Pejabat Penandatangan',
                'data_pegawai' => $this->mPegawai -> where('aktif',1) -> orderBy('nama','ASC') ->findAll(), 
                'id_penandatangan' => $row['id_penandatangan'],
                'ketua' => $row['ketua'],
                'plt_ketua' => $row['plt_ketua'],
                'plh_ketua' => $row['plh_ketua'],
                'sekretaris' => $row['sekretaris'],
                'nip_sekretaris' => $row['nip_sekretaris'],
                'plt_sekretaris' => $row['plt_sekretaris'],
                'nip_plt_sekretaris' => $row['nip_plt_sekretaris'],
                'plh_sekretaris' => $row['plh_sekretaris'],
                'nip_plh_sekretaris' => $row['nip_plh_sekretaris'],
                'ppkom' => $row['ppkom'],
                'nip_ppkom' => $row['nip_ppkom'],
                'bendahara' => $row['bendahara'],
                'nip_bendahara' => $row['nip_bendahara'],
            ];
        return view('penandatangan/home', $data);
    }

    public function home(){
        if($this->request->isAJAX()){          
            
            $row = $this->mPenandatangan-> orderBy('id_penandatangan','desc') -> find(1); 
                
            $data = [
                'title_page' => 'Pengaturan: Pejabat Penandatangan',
                'data_pegawai' => $mPegawai -> where('aktif',1) -> orderBy('nama','ASC') ->findAll(), 
                'id_penandatangan' => $row['id_penandatangan'],
                'ketua' => $row['ketua'],
                'plt_ketua' => $row['plt_ketua'],
                'plh_ketua' => $row['plh_ketua'],
                'sekretaris' => $row['sekretaris'],
                'nip_sekretaris' => $row['nip_sekretaris'],
                'plt_sekretaris' => $row['plt_sekretaris'],
                'nip_plt_sekretaris' => $row['nip_plt_sekretaris'],
                'plh_sekretaris' => $row['plh_sekretaris'],
                'nip_plh_sekretaris' => $row['nip_plh_sekretaris'],
                'ppkom' => $row['ppkom'],
                'nip_ppkom' => $row['nip_ppkom'],
                'bendahara' => $row['bendahara'],
                'nip_bendahara' => $row['nip_bendahara'],
            ];
            
            $msg = [
                'data' => view('penandatangan/home', $data)                
            ];

            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function update(){
        if($this->request->isAJAX()){
            $id_penandatangan = $this->request->getVar('id_penandatangan');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'ketua' => [
                    'label' => 'Ketua',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'plt_ketua' => [
                    'label' => 'Plt Ketua',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'plh_ketua' => [
                    'label' => 'Plh Ketua',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'sekretaris' => [
                    'label' => 'Sekretaris',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'nip_sekretaris' => [
                    'label' => 'NIP Sekretaris',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'plt_sekretaris' => [
                    'label' => 'Plt Sekretaris',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'nip_plt_sekretaris' => [
                    'label' => 'NIP Plt. Sekretaris',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'plh_sekretaris' => [
                    'label' => 'Plh Sekretaris',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'nip_plh_sekretaris' => [
                    'label' => 'NIP Plh. Sekretaris',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'ppkom' => [
                    'label' => 'Pejabat Pembuat Komitmen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'nip_ppkom' => [
                    'label' => 'NIP Pejabat Pembuat Komitmen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'bendahara' => [
                    'label' => 'Bendahara',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                'nip_bendahara' => [
                    'label' => 'NIP Bendahara',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} * Harus diisi',
                    ],
                ],
                
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'ketua' => $validation->getError('ketua'),
                        'plt_ketua' => $validation->getError('plt_ketua'),
                        'plh_ketua' => $validation->getError('plh_ketua'),
                        'sekretaris' => $validation->getError('sekretaris'),
                        'nip_sekretaris' => $validation->getError('nip_sekretaris'),
                        'plt_sekretaris' => $validation->getError('plt_sekretaris'),
                        'nip_plt_sekretaris' => $validation->getError('nip_plt_sekretaris'),
                        'plh_sekretaris' => $validation->getError('plh_sekretaris'),
                        'nip_plh_sekretaris' => $validation->getError('nip_plh_sekretaris'),
                        'ppkom' => $validation->getError('ppkom'),
                        'nip_ppkom' => $validation->getError('nip_ppkom'),
                        'bendahara' => $validation->getError('bendahara'),
                        'nip_bendahara' => $validation->getError('nip_bendahara'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'ketua' => $this->request->getVar('ketua'),
                        'plt_ketua' => $this->request->getVar('plt_ketua'),
                        'plh_ketua' => $this->request->getVar('plh_ketua'),
                        'sekretaris' => $this->request->getVar('sekretaris'),
                        'nip_sekretaris' => $this->request->getVar('nip_sekretaris'),
                        'plt_sekretaris' => $this->request->getVar('plt_sekretaris'),
                        'nip_plt_sekretaris' => $this->request->getVar('nip_plt_sekretaris'),
                        'plh_sekretaris' => $this->request->getVar('plh_sekretaris'),
                        'nip_plh_sekretaris' => $this->request->getVar('nip_plh_sekretaris'),
                        'ppkom' => $this->request->getVar('ppkom'),
                        'nip_ppkom' => $this->request->getVar('nip_ppkom'),
                        'bendahara' => $this->request->getVar('bendahara'),
                        'nip_bendahara' => $this->request->getVar('nip_bendahara'),
                    ];
                
                $this->mPenandatangan->update($id_penandatangan, $simpandata);

                $msg = [
                    'sukses' => 'Data telah diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

}