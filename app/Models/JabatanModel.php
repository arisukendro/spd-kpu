<?php
namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model 
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    
    protected $allowedFields = ['id_jabatan','nama_jabatan','klompeg_id','urutan_tampil'];
    
    protected $useSoftDeletes = false;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function tampilSemua()
    {
         return $this->db->table($this->table)
         ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
         ->get()
         ->getResultArray();  
    }

    public function tampilId($id)
    {
         return $this->db->table($this->table)
         ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
         ->where($this->primaryKey, $id)
         ->get()
         ->getRowArray();  
    }

    public function tampilKriteria($id)
    {
         return $this->db->table($this->table)
         ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
         ->where('klompeg_id', $id)
         ->get()
         ->getResultArray();  
    }
}