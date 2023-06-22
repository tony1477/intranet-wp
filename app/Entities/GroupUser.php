<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class GroupUser extends Entity
{
    protected $datamap = [
        'Id' => 'usergroupid',
        'Group_Name' => 'groupname',
        'Group_Id' => 'group_id',
        'User_Id' => 'user_id',
        'User_Name' => 'username',
        'User_Created' => 'created_by',
        'User_Modified' => 'updated_by',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
