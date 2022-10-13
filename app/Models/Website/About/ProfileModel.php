<?php

namespace App\Models\Website\About;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $DBGroup          = 'website';
    protected $table            = 'article';
    protected $primaryKey       = 'articleid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'App\Entities\Profile';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title','content','pageid','status','order','creatorid','updaterid'];

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

    public function getDataProfile() {
        $query = $this->db->table('article a')
            ->select("a.*, a.pageid as Id, concat(b.pagename,' urutan ',position) as page, a.creatorid, a.updaterid")
            ->join('webpage b','b.pageid = a.pageid')
            ->get();

        return $query;
    }
}
