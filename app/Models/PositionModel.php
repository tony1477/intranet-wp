<?php

namespace App\Models;

use CodeIgniter\Model;

class PositionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_ifmjabatan';
    protected $primaryKey       = 'idjabatan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jab_kode','jab_nama','jab_nama2','user_c','user_m','time_c','time_m','tgl_c','tgl_m'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'date';
    protected $createdField  = 'tgl_c';
    protected $updatedField  = 'tgl_m';
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
