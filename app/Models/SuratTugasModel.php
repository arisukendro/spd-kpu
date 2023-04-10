<?php
namespace App\Models;

use CodeIgniter\Model;

class SuratTugasModel extends Model 
{
    protected $table = 'surat_tugas';
    protected $primaryKey = 'id_st';
    
    protected $allowedFields = ['id_st','perihal_st','jenis_st','nomor_st','tanggal_st','dasar_st','tanggal_berangkat'
                              ,'tanggal_kembali','kota_ttd','jabatan_ttd','nama_ttd','created_by'
                              ,'updated_by','deleted_by'];
    
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
            ->where('tanggal_st BETWEEN \''.$startDate.'\' AND \''.$endDate.'\'')  
            ->orderBy('tanggal_st', 'DESC')
            ->orderBy('id_st', 'DESC')
            ->get()
            ->getResultArray();  
    }

    public function tampilWhere($where)
    {
        return $this->db->table($this->table)
            ->where($where)       
            ->get()
            ->getResultArray();  
    }

    public function tampilId($id)
    {
        return $this->db->table($this->table)
            ->join('surat_tugas_lokasi stl','stl.surat_tugas_id = '.$this->table.'.id_st')
            ->join('surat_tugas_personil stp','stp.surat_tugas_id = '.$this->table.'.id_st')
            ->where($this->primaryKey, $id)
            ->get()
            ->getRowArray();  
    }

    public function dataTerakhir()
    {
        return $this->db->table($this->table)
            ->like('tanggal_st', date('Y'),'right')
            ->orderBy('id_st','desc')
            ->limit(1)
            ->get()
            ->getRowArray();  
    }
    
}