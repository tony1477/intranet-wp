<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\UserModel;
use App\Entities\User;

class Article extends Entity
{
    protected $datamap = [
        'Id' => 'articleid',
        'Name_Category' => 'categoryid',
        'Title' => 'title',
        'Content' => 'content',
        'Image' => 'image',
        'Page' => 'page',        
        'Slug' => 'slug',
        'Name_Category' => 'categoryname',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    // public function getContent()
    // {
    //     return substr(strip_tags($this->attributes['content']),0,200);
    // }

    public function getPage()
    {
        return $this->attributes['page'] == 'F' ? 'YES' : 'NO';
    }

    public function getPublish()
    {
        return $this->attributes['publish'] == 1 ? 'YES' : 'NO';
    }

    public function getStatus()
    {
        return $this->attributes['status'] == 1 ? 'YES' : 'NO';
    }

}
