<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Gallery extends Entity
{
    protected $datamap = [
        'Id' => 'galleryid',
        'Name_Category' => 'categoryid',
        'Title' => 'title',
        'Description' => 'description',
        'Link_File' => 'url',
        'Cover_File' => 'sampul_video',
        'IsHighlight' => 'ishighlight',
        'Status' => 'status',
        'IsLogin' => 'islogin',
        'User_Created' => 'created_by',
        'User_Modified' => 'updated_by',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getStatus()
    {
        return ($this->attributes['status'] == 1 ? 'YES' : 'NO');
    }

    public function getIshighlight()
    {
        return ($this->attributes['ishighlight'] == 1 ? 'YES' : 'NO');
    }

    public function getIsLogin()
    {
        return ($this->attributes['islogin'] == 1 ? 'YES' : 'NO');
    }

}
