<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Location extends Entity
{
    protected $datamap = [
        'Id' => 'locationid',
        'Code' => 'locationcode',
        'Name' => 'locationname',
        'Status' => 'recordstatus',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
