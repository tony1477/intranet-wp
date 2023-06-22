<?php

namespace App\Models;

use App\Entities\GroupUser;
use CodeIgniter\Model;

class GroupUserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_groups_users';
    protected $primaryKey       = 'usergroupid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = GroupUser::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id','user_id','creator_id','updater_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
 
    public function getData()
    {
        return $this->query('select usergroupid as Id, user_id as User_Id, group_id as Group_Id, (select fullname from users a where a.id = ug.user_id) as User_Name, (select `description` from auth_groups g where g.id = ug.group_id) as Group_Name, creator_id as User_Created, updater_id User_Modified 
        from auth_groups_users ug
        order by ug.user_id asc')->getResult();
    }
}
