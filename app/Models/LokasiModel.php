<?php
namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model 
{
    protected $table = 'lokasi';
    protected $primaryKey = 'id_lokasi';
    
    protected $allowedFields = ['id_lokasi','nama_lokasi','alamat','kota_lokasi'];
    
    protected $useSoftDeletes = false;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


}