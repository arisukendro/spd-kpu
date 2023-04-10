<?php
namespace App\Models;

use CodeIgniter\Model;

class SuratTugasPersonilModel extends Model 
{
    protected $table = 'surat_tugas_personil';
    protected $primaryKey = 'id_st_personil';
    
    protected $allowedFields = ['id_st_personil','surat_tugas_id','pegawai_id','nama','nip','golongan','klompeg','jabatan'
                              ];
    
    protected $useSoftDeletes = false;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
}