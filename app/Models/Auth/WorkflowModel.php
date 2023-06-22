<?php

namespace App\Models\Auth;

use App\Entities\Auth\Workflow;
use CodeIgniter\Model;

class WorkflowModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'workflow';
    protected $primaryKey       = 'workflowid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Workflow::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['wfname','wfdesc','wfminstat','wfmaxstat','recordstatus'];

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
