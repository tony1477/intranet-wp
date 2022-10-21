<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Career extends Entity
{
    protected $datamap = [
        'Id' => 'careerid',
        'Title' => 'title',
        'Position' => 'position',
        'Location' => 'location',
        'Lokasi' => 'lokasi',
        'Requirement' => 'requirement',
        'Jobdesc' => 'jobdesc',
        'Catatan' => 'notes',
        'Status' => 'status', 
        'User_Created' => 'created_by',
        'User_Modified' => 'updated_by',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
