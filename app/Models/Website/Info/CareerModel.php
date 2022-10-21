<?php

namespace App\Models\Website\Info;

use CodeIgniter\Model;

class CareerModel extends Model
{
    protected $DBGroup          = 'website';
    protected $table            = 'career';
    protected $primaryKey       = 'careerid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\Career';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['postdate','lastdate','title','position','location','requirement','jobdesc','notes','status'];

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

    public function getData() {
        $query = $this->db->table('career a')
            ->select("a.*, a.careerid as Id, b.locationname as lokasi")
            ->join('location b','b.locationid = a.locationid')
            ->get();

        return $query;
    }
    
}
