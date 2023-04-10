<?php
namespace App\Models;

use CodeIgniter\Model;

class SuratTugasLokasiModel extends Model 
{
    protected $table = 'surat_tugas_lokasi';
    protected $primaryKey = 'id_st_lokasi';
    
    protected $allowedFields = ['id_st_personil','surat_tugas_id','nama_lokasi','alamat_lokasi','kota_lokasi'
                              ];
    
    protected $useSoftDeletes = false;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


}