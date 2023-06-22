<?php

namespace App\Entities\Auth;

use CodeIgniter\Entity\Entity;

class Wfstructure extends Entity
{
    protected $datamap = [
        'Id' => 'wfstructureid',
        'Group_Id' => 'groupid',
        'Parent_Id' => 'parentid',
        // 'Group_Name' => 'wfbefstat',
        'Recordstatus' => 'recordstatus',
        'Recstatus' => 'recordstatus',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getRecordstatus()
    {
        return $this->attributes['recordstatus'] == 1 ? 'YES' : 'NO';
    }
    
}
