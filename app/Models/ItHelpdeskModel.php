<?php

namespace App\Models;

use App\Entities\ItHelpdesk;
use CodeIgniter\Model;

class ItHelpdeskModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ithdelpdesk';
    protected $primaryKey       = 'helpdeskid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = ItHelpdesk::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ticketdate','ticketopen','ticketclose','userid_req','userid_head','userid_itadmin','userid_head','userid_itresp','user_phone','categoryid','categoryname','user_request','user_reason','user_attachment','resp_text','resp_reason','resp_recommendation','recordstatus'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
