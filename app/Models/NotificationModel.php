<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'notif';
    protected $primaryKey       = 'notifid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = \App\Entities\NotificationEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['notiftitle','notificon','notiftext','url','notiftype'];

    // Dates
    protected $useTimestamps = true;
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

    protected function addToDetail($data)
    {
        if ($data['data']['notiftype']=='all') {
            $usernotif = model(UserNotifModel::class);
            $usernotif->addUserNotif($data['id'], $data['data']['notiftype']);
        }

        return $data;
    }

    public function getNotificationbyUser()
    {
        return $this->db->table('notif a')->select('a.notifid, notiftitle, notificon, notiftext, url, notifdate, b.notifuserid, b.recordstatus')
        ->join('notifuser b','a.notifid = b.notifid')
        ->where('b.userid ='.user_id())
        ->get();
    }
}
