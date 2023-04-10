<?php
namespace App\Models;

use CodeIgniter\Model;

class SpdPengeluaranModel extends Model 
{
    protected $table = 'spd_pengeluaran';
    protected $primaryKey = 'id_spd_pengeluaran';
    
    protected $allowedFields = ['id_spd_pengeluaran','spd_id','uang_harian','ket_uang_harian','uang_tiket','ket_uang_tiket'
                            ,'uang_transport','ket_uang_transport','uang_penginapan','uang_lain', 'ket_uang_lain'
                            ,'ket_uang_penginapan','uang_muka','ket_uang_muka','bendahara','nip_bendahara','ppkom'
                        ,'nip_ppkom'];
    
    protected $useSoftDeletes = false;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function selectAll()
    {
        return $this->db->table($this->table)
            ->join('spd','spd.id_spd = '.$this->table.'.id_spd_pengeluaran')
            ->join('surat_tugas_personil stp','stp.id_st_personil = spd.st_personil_id')
            ->join('surat_tugas st','st.id_st = stp.surat_tugas_id')
            ->get()
            ->getRowArray();  
    }
    
}