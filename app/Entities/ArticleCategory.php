<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ArticleCategory extends Entity
{
    protected $datamap = [
        'Id' => 'categoryid',
        'Name_Category' => 'categoryname',
        'Status' => 'status',
        'User_Created' => 'created_by',
        'User_Modified' => 'updated_by',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function setStatus()
    {
        $this->attributes['status'] == 'YES' ? 1 : 0;
        return $this;
    }
    
    public function getStatus()
    {
        return ($this->attributes['status'] == 1 ? 'YES' : 'NO');
    }
}
