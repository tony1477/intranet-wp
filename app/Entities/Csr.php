<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Csr extends Entity
{
    protected $datamap = [
        'Id' => 'Id',
        'Title' => 'title',
        'Content' => 'content',
        'Order' => 'order',    
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
