<?php

namespace App\Controllers;
use App\Models\PegawaiModel;
use App\Models\SuratTugasModel;
use App\Models\LokasiModel;

class Chaindata extends BaseController
{
    public function dataKlompeg(){
        if($this->request->isAJAX()){
            $klompeg = $this->request->getVar('klompeg');
            
            $dataSubbag = $this->db->table('subbag')->LIKE('klompeg_id', $klompeg)->get();
            
            $isiSubbag = "";            
            foreach($dataSubbag->getResultArray() as $row):
                $isiSubbag .='<option value="'. $row['id_subbag'].'">'.$row['nama_subbag'].'</option>';
            endforeach;

            $dataJabatan = $this->db->table('jabatan')->LIKE('klompeg_id', $klompeg)->get();
            
            $isiJabatan = "";
            foreach($dataJabatan->getResultArray() as $row):
                $isiJabatan .='<option value="'. $row['id_jabatan'].'">'.$row['nama_jabatan'].'</option>';
            endforeach;
            
            $msg = [
                'dataSubbag' => $isiSubbag,
                'dataJabatan' => $isiJabatan,
            ];
            
            echo json_encode($msg);
        }
    }

    public function getLokasi(){
        if($this->request->isAJAX()){
            $mLokasi = new LokasiModel;
            $data_lokasi = $mLokasi->orderBy('nama_lokasi','ASC')->findAll();
            $isiLokasi = "";
            
            foreach($data_lokasi as $rlokasi): 
                $isiLokasi .="<option value=\"".$rlokasi['id_lokasi']."\"><b>".$rlokasi['nama_lokasi']."</b> | ".$rlokasi['kota_lokasi']. "</option>";
            endforeach;
            $msg = [
                'isi_lokasi' => $isiLokasi,
            ];

            echo json_encode($msg); 
        }
    }
    
}