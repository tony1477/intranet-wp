<?php

namespace App\Models;

use App\Entities\Extparticipant;
use CodeIgniter\Model;

class ExtParticipantModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'external_participant';
    protected $primaryKey       = 'participantid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Extparticipant::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name','description','email','requisite','recordstatus'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


}
