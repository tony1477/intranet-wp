<?php

namespace App\Models;

use App\Entities\HelpdeskDetail;
use CodeIgniter\Model;

class HelpdeskDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'helpdesk_issue';
    protected $primaryKey       = 'issueid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = HelpdeskDetail::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['helpdeskid','categoryid','categoryname'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
