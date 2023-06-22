<?php

namespace App\Entities\Auth;

use CodeIgniter\Entity\Entity;

class Workflow extends Entity
{
    protected $datamap = [
        'Id' => 'workflowid',
        'Wf_Name' => 'wfname',
        'Wf_Desc' => 'wfdesc',
        'Wf_Min_Status' => 'wfminstat',
        'Wf_Max_Status' => 'wfmaxstat',
        'Recordstatus' => 'recordstatus',
        'Status' => 'recordstatus',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getRecordstatus()
    {
        return $this->attributes['recordstatus'] == 1 ? 'YES' : 'NO';
    }
}
