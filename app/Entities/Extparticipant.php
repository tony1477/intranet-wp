<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Extparticipant extends Entity
{
    protected $datamap = [
        'Id' => 'participantid',
        'Name' => 'name',
        'Description' => 'description',
        'Email' => 'email',
        'Requisite' => 'requisite',
        'Status' => 'recordstatus',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getRecordstatus()
    {
        return $this->attributes['recordstatus'] == 1 ? 'YES' : 'NO';
    }

}
