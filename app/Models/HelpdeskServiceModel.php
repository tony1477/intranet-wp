<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\HelpdeskService;

class HelpdeskServiceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'helpdesk_service';
    protected $primaryKey       = 'serviceid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = HelpdeskService::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['servicecode','servicename','recordstatus'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
