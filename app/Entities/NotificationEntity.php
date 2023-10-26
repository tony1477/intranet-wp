<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class NotificationEntity extends Entity
{
    protected $datamap = [
        'Id' => 'notifid',
        'Title' => 'notiftitle',
        'Icon' => 'notificon',
        'Content' => 'notiftext',
        'Url' => 'url',
        // 'Status' => 'recordstatus',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    public function getStatus()
    {
        return $this->attributes['recordstatus'] == 1 ? 'YES' : 'NO';
    }
}
