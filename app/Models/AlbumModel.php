<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\GalleryCategory as Categories;

class AlbumModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gallerycategories';
    protected $primaryKey       = 'categoryid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Categories::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['categoryname','description','status','created_by','updated_by','created_at','updated_at'];

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

    public function getAlbum()
    {
        return $this->db->table('gallerycategories')
            ->select('categoryname,description,categoryid,status, GetGallery(categoryid,3) as cover')
            ->get();
        // return $this->db->query($sql);
    }
}
