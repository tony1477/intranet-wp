<?php

namespace App\Entities\Auth;

use CodeIgniter\Entity\Entity;

class Wfstatus extends Entity
{
    protected $datamap = [
        'Id' => 'workflowid',
        'Wf_Name' => 'wfname',
        'Wf_Id' => 'workflowid',
        'Wf_Stat' => 'wfstat',
        'Wf_Status_Name' => 'wfstatusname',
        'Wf_Status_User' => 'wfstatususer',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

}
