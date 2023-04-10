<?php

namespace App\Controllers;
use App\Models\SuratTugasModel;
use App\Models\SpdModel;
use App\Models\TemplateModel;
use App\Models\SuratTugasPersonilModel;
use App\Models\SuratTugasLokasiModel;
use App\Models\LokasiModel;
use App\Models\PegawaiModel;
use App\Models\PenandatanganModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->mSuratTugas = new SuratTugasModel;
        $this->mSpd = new SpdModel;
        $this->mTemplate= new TemplateModel;
        $this->mSTPersonil = new SuratTugasPersonilModel;
        $this->mSTLokasi = new SuratTugasLokasiModel;
        $this->mLokasi = new LokasiModel;
        $this->mPegawai = new PegawaiModel;
        $this->mPenandatangan = new PenandatanganModel;
    }  
    public function index()
    {
        
        $data = [
            'title_page' => "Dashboard",
            'st_terbaru' => $this->mSuratTugas->orderBy('tanggal_st','desc')->limit(5)->findAll(),
            'jml_pegawai' => $this->mPegawai->countAllResults(),
            'jml_lokasi' => $this->mLokasi->countAllResults(),
            'jml_st' => $this->mSuratTugas->like('tanggal_st', date('Y'), 'right')->countAllResults(),
            'jml_st_bulan_ini' => $this->mSuratTugas->like('tanggal_st', date('Y-m'), 'right')->countAllResults(),
            'jml_spd' => $this->mSpd->like('tanggal_ttd_spd', date('Y'), 'right')->countAllResults(),
            'jml_spd_bulan_ini' => $this->mSpd->like('tanggal_ttd_spd', date('Y-m'), 'right')->countAllResults(),
            'jml_lokasi' => $this->mLokasi->countAllResults(),
        ];


        return view('dashboard', $data);
    }



}