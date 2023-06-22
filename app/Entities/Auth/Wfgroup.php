<?php

namespace App\Entities\Auth;

use CodeIgniter\Entity\Entity;

class Wfgroup extends Entity
{
    protected $datamap = [
        'Id' => 'wfgroupid',
        'Workflow_Id' => 'workflowid',
        'Group_Id' => 'groupid',
        'Wf_Bef_Status' => 'wfbefstat',
        'Wf_Rec_Status' => 'wfrecstat',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    
}
