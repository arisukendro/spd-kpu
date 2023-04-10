<?php
namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model 
{
    protected $table = 'template_surat_tugas';
    protected $primaryKey = 'id_template_st';
    
    protected $allowedFields = ['id_template_st','nomor_urut','keterangan'];
    
    protected $useSoftDeletes = false;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}