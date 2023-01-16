<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Users extends Entity
{
    protected $datamap = [
        'Id' => 'id',
        'Name_User' => 'username',
        'Fullname' => 'fullname',
        'Email' => 'email',
        'Name_Divisi' => 'div_nama',
        'Location_PT' => 'div_nama',
        'Name_Department' => 'dep_nama',
        'Department_Division' => 'dep_nama',
        'Name_Position' => 'jab_nama',
        'Phone' => 'phoneno',
        // 'Pwd_User' => 'password_hash',
        'Photo_User' => 'user_image',
        'Active' => 'aktif',
    ];

    // protected $attributes = [
    //     'fullname' => 'Guest'
    // ];

    // public function getName()
    // {
    //     return trim(trim($this->attributes['fullname']));
    // }
}
