<?php

// **************************************** //
// Developer    : Ari Sukendro              //
// Email        : arisukendro@gmail.com     // 
// App          : SPD KPU                   //
// **************************************** //

namespace Config;

use Codeigniter\Config\BaseConfig;

class Site extends BaseConfig {
    // Sesuaikan dengan wilayah KPU kab/kota
    public $instansi = 'Komisi Pemilihan Umum'; 
    public $instansi_singkat = 'KPU'; 
    public $kabkota = 'Kabupaten Cilacap'; 
    public $kabkota_singkat = 'Kab. Cilacap';     
    public $ibukota = 'Cilacap';
    public $alamat = 'Jln. MT. Haryono No 75 Kel. Donan, Kec. Cilacap Tengah';
    public $website = 'kab-cilacap.kpu.go.id';
    public $email = 'kab_cilacap@kpu.go.id';
    
    
    // Ubah kode ini jika diperlukan, sesuaikan dengan tata naskah dinas
    // Nomor agenda, bulan dan tahun otomatis 
    // Contoh output format di bawah ini adalah: 1/RT.02.01-ST/3301/KPU-Kab/2023
    public $kodeWilSt = 'RT.02.01-ST/3301'; 
    public $kodePejabatKetua = 'KPU-Kab';  
    public $kodePejabatSekretaris = 'Ses-Kab'; 
    public $nomor_bulan = false;  // nilai TRUE atau FALSE untuk memunculkan/tidak angka romawi bulan dalam format nomor ST
    public $kodeSpd = 'RT.02.01-SPD.LK/3301';

    //Dilarang merubah apapun mulai baris ini     
    public $app_name = "SPD";
    public $app_version = '2.0';
    public $themes = 'AdminLTE';
}