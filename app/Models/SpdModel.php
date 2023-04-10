<?php
namespace App\Models;

use CodeIgniter\Model;

class SpdModel extends Model 
{
    protected $table = 'spd';
    protected $primaryKey = 'id_spd';
    
    protected $allowedFields = ['id_spd','nomor_spd','st_personil_id','kendaraan','tingkat_spd','sumber_dana','jenis_formulir'
                              ,'akun_anggaran','kota_ttd_spd','tanggal_ttd_spd','jabatan_ttd_spd','nama_ttd_spd','nip_ttd_spd','created_by'
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
            ->where('tanggal_ttd_spd BETWEEN \''.$startDate.'\' AND \''.$endDate.'\'')  
            ->orderBy('tanggal_ttd_spd', 'DESC')
            ->orderBy('id_spd', 'DESC')
            ->get()
            ->getResultArray();  
    }
    
    public function selectAll($where=NULL)
    {
        return $this->db->table($this->table)
            ->join('surat_tugas st','st.id_st = '.$this->table.'.surat_tugas_id')
            ->where($this->primaryKey, $id)
            ->get()
            ->getRowArray();  
    }
    
    public function selectByYear($year)
    {
        return $this->db->table($this->table)
            ->like('tanggal_ttd_spd', $year, 'right')  
            ->orderBy('tanggal_ttd_spd', 'DESC')
            ->orderBy('id_spd', 'DESC')
            ->get()
            ->getResultArray();  
    }
    public function dataTerakhir()
    {
        return $this->db->table($this->table)
            ->like('tanggal_ttd_spd', date('Y'),'right')
            ->orderBy('id_spd','desc')
            ->limit(1)
            ->get()
            ->getRowArray();  
    }
    
}