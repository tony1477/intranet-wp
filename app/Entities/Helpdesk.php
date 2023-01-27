<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Helpdesk extends Entity
{
    protected $datamap = [
        // 'Id' => 'helpdeskid',
        // ''
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
