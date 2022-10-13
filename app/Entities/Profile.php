<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Profile extends Entity
{
    protected $datamap = [
        'Title' => 'title',
        'Content' => 'content',
        'Page' => 'page',
        'User_Created' => 'creatorid',
        'User_Modified' => 'updaterid',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
