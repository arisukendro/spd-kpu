<?php
namespace App\Models;

use CodeIgniter\Model;

class PenandatanganModel extends Model 
{
    protected $table = 'penandatangan';
    protected $primaryKey = 'id_penandatangan';
    
    protected $allowedFields = ['id_penandatangan','ketua','plt_ketua','plh_ketua','sekretaris','nip_sekretaris'
                                    ,'plt_sekretaris','nip_plt_sekretaris' ,'plh_sekretaris','nip_plh_sekretaris'
                                    ,'ppkom','nip_ppkom','bendahara','nip_bendahara'];
    
    protected $useSoftDeletes = false;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function selectOne()
    {
         return $this->db->table($this->table)
         ->orderBy($this->primaryKey, 'DESC')
         ->limit(1)
         ->get()
         ->getRowArray();  
    }

    
}