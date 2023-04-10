<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model 
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['username','realname','email','password_hash','active'];
    
    protected $useSoftDeletes = true ;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

   public function selectId($id)
    {
        return $this->db->table($this->table)
            ->select('users.id user_id, password_hash, username,realname, email, active, agu.group_id, ag.id group_id, ag.name group_name, ag.description group_description')
            ->join('auth_groups_users agu','agu.user_id= '.$this->table.'.id')
            ->join('auth_groups ag','ag.id = agu.group_id')
            ->where('users.id', $id)
            ->get()
            ->getRowArray();  
    }

    public function selectAll()
    {
        return $this->db->table($this->table)
            ->select('users.id id, username, realname, email, active, agu.group_id, ag.id group_id, ag.name group_name, ag.description group_description')
            ->join('auth_groups_users agu','agu.user_id= '.$this->table.'.id')
            ->join('auth_groups ag','ag.id = agu.group_id')
            ->where('users.deleted_at IS NULL')
            ->orderBy('realname','ASC')
            ->get()
            ->getResultArray();
    }

    public function selectGroup(){
        return $this->db->table('auth_groups ag')
            ->where ('name !=', 'super')
            ->get()
            ->getResultArray();
    }

    public function updateLevel($group_id, $user_id) {
        return $this->db->table('auth_groups_users')
            ->set('group_id', $group_id)
            ->where('user_id', $user_id)
            ->update();
    }
    
}