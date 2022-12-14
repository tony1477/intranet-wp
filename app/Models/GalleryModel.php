<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Gallery;

class GalleryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gallery';
    protected $primaryKey       = 'galleryid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Gallery::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['gallerytype','url','title','description','ishighlight','status','createdby','updatedby'];

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
