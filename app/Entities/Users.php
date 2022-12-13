<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Users extends Entity
{
    protected $attributes = [
        'fullname' => 'Guest'
    ];

    public function getName()
    {
        return trim(trim($this->attributes['fullname']));
    }
}
