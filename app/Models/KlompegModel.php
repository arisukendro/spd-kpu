<?php
namespace App\Models;

use CodeIgniter\Model;

class KlompegModel extends Model 
{
    protected $table = 'klompeg';
    protected $primaryKey = 'id_klompeg';
    
    protected $allowedFields = ['id_klompeg','nama_klompeg'];
    
    protected $useSoftDeletes = false;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}