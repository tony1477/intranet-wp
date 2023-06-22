<?php

namespace App\Models\Auth;

use App\Entities\Auth\Wfstatus;
use CodeIgniter\Model;

class WfstatusModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wfstatus';
    protected $primaryKey       = 'wfstatusid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Wfstatus::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['workflowid','wfstat','wfstatusname','wfstatususer'];

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
        return $this->query('select wfstatusid as Id, workflowid as Workflow_Id, (select wfdesc from workflow a where a.workflowid = wf.workflowid) as Wf_Desc, wfstat as Wf_Stat, wfstatusname as Wf_Status_Name, wfstatususer as Wf_Status_User
        from wfstatus wf
        order by workflowid asc,wfstat asc')->getResult();
    }
}
