<?php

namespace App\Models;

use App\Entities\UserNotifEntity;
use CodeIgniter\Model;

class UserNotifModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'notifuser';
    protected $primaryKey       = 'notifuserid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = UserNotifEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['notifid','userid','viewdate','recordstatus'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addUserNotif($id,$type)
    {
        $sql = "call notifUser(:id:,:type:)";
        if($type==='all') $sql = "call addNotifUser(:id:,:type:)";
        return (bool) $this->db->query($sql,['id'=>$id,'type'=>$type]);
        // return true;
    }

    public function getNotif()
    {
        $sql = 'select a.notifid,b.notifuserid,a.notifdate,a.notiftitle,a.notificon,a.notiftext,a.url
                from notif a
                join notifuser b on b.notifid = a.notifid
                where b.userid = :id: and b.recordstatus=:status: limit 3';
        return $this->db->query($sql,['id'=>user_id(),'status'=>0]);
    }

    public function getNotifbyUser()
    {
        $sql = "select ifnull(count(1),0) as total from notifuser where userid = :id: and recordstatus=0";
        return $this->db->query($sql,['id'=>user_id()]);
    }
}
