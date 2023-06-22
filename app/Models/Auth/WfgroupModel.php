<?php

namespace App\Models\Auth;

use App\Entities\Auth\Wfgroup;
use CodeIgniter\Model;

class WfgroupModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wfgroup';
    protected $primaryKey       = 'wfgroupid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Wfgroup::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['workflowid','groupid','wfbefstat','wfrecstat'];

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

    public function getData()
    {
        return $this->query('select wfgroupid as Id, workflowid as Workflow_Id, groupid as Group_Id, (select wfdesc from workflow a where a.workflowid = wf.workflowid) as Wf_Desc, (select `description` from auth_groups g where g.id = wf.groupid) as Group_Name, wfbefstat as Wf_Bef_Status, wfrecstat as Wf_Rec_Status 
        from wfgroup wf')->getResult();
    }


    public function getWfstatbyUserId(string $wfname, int $userid) :?string
    {
        $sql = "select group_concat(wfrecstat) as recstat
        from wfgroup a
        join workflow w on w.workflowid = a.workflowid 
        join auth_groups_users b on b.group_id = a.groupid 
        where b.user_id = :userid: and w.wfname = :wfname:";
        $query = $this->query($sql,['userid'=>$userid, 'wfname'=>$wfname])->getRow();
        return $query->recstat;
    }

    public function getWfAuthbyUserId(string $wfname, int $userid, int $recordstatus)
    {
        $sql = 'select b.wfgroupid
            from auth_groups_users a
            inner join users d on d.id = a.user_id
            inner join wfgroup b on b.groupids = a.group_id
            inner join workflow c on c.workflowid = b.workflowid
            where d.id = :userid: and upper(c.wfname) = upper(:wfname:) and b.wfbefstat = :recstat: ';
        return $this->query($sql,['userid' => $userid, 'wfname'=>$wfname, 'recstat' => $recordstatus]);
    }
}
