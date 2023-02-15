<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EmailSubs extends Entity
{
    protected $datamap = [
        'Id' => 'subs_id',
        'Fullname' => 'fullname',
        'Email' => 'subs_email',
        // 'Status' => 'status',
        // 'Subs_Date' => 'subs_date'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getStatus()
    {
        return ($this->attributes['status'] == 1 ? 'YES' : 'NO');
    }

    public function getSubsdate()
    {
        return date('d-m-Y',strtotime($this->attributes['subs_date']));
    }
}
