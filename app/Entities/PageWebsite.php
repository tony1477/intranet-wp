<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PageWebsite extends Entity
{
    protected $attributes = [
        'pageid' => null,
        'pagename' => null
    ];

    protected $datamap = [
        'Id' => 'pageid',
        'Page' => 'pagename'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
