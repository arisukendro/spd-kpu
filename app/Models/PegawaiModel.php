<?php
namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model 
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    
    protected $allowedFields = ['id_pegawai','nama','nip','golongan','pangkat','klompeg_id','setkom'
                        ,'jabatan_id','subbag_id','aktif'];
    
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
         ->join('klompeg','klompeg.id_klompeg = '.$this->table.'.klompeg_id')
         ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
         ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
         ->get()
         ->getResultArray();  
    }

    public function tampilUrutJabatan($where=null)
    {
         if(isset($where)):
            return $this->db->table($this->table)
                  ->join('klompeg','klompeg.id_klompeg = '.$this->table.'.klompeg_id')
                  ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
                  ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
                  ->where($where)
                  ->orderBy('jabatan.urutan_tampil', 'ASC')
                  ->orderBy('pegawai.nama', 'ASC')
                  ->get()
                  ->getResultArray();  
         else:
            return $this->db->table($this->table)
                  ->join('klompeg','klompeg.id_klompeg = '.$this->table.'.klompeg_id')
                  ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
                  ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
                  ->orderBy('jabatan.urutan_tampil', 'ASC')
                  ->orderBy('pegawai.nama', 'ASC')
                  ->get()
                  ->getResultArray();  
         endif;
    }

    public function selectId($id)
    {
         return $this->db->table($this->table)
         ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
         ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
         ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
         ->where($this->primaryKey, $id)
         ->get()
         ->getRowArray();  
    }

    public function pegawaiSetkom($setkom)
    {
          return $this->db->table($this->table)
          ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
          ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
          ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
          ->like('setkom', $setkom, 'both')
          ->get()
          ->getResultArray();  
    }

    public function pegawaiSetkomAktif($setkom)
    {
          return $this->db->table($this->table)
          ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
          ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
          ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
          ->like('setkom', $setkom, 'both')
          ->where('aktif', 1)
          ->get()
          ->getResultArray();  
    }
    
    public function pegawaiNonAktif()
    {
          return $this->db->table($this->table)
          ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
          ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
          ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
          ->where('aktif', 0)
          ->get()
          ->getResultArray();  
    }
}