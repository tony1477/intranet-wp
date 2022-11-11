<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Manajemen extends Entity
{
    protected $datamap = [
        'Id' => 'managementid',
        'Name' => 'profilename',
        'Position' => 'profileposition',
        'Photo' => 'profilephoto',
        'Description' => 'profiledesc',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
