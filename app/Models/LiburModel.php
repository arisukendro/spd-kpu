<?php
namespace App\Models;

use CodeIgniter\Model;

class LiburModel extends Model 
{
    protected $table = 'libur';
    protected $primaryKey = 'id_libur';
    
    protected $allowedFields = ['id_libur','tanggal_libur','keterangan'];
    
    protected $useSoftDeletes = false;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function selectRange($startDate, $endDate)
    {
         return $this->db->table($this->table)
         ->where('tanggal_libur BETWEEN \''.$startDate.'\' AND \''.$endDate.'\'') 
         ->get()
         ->getResultArray();  
    }

    public function tampilId($id)
    {
         return $this->db->table($this->table)
         ->where($this->primaryKey, $id)
         ->get()
         ->getRowArray();  
    }

}