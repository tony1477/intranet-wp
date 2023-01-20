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
    protected $allowedFields    = ['gallerytype','categoryid','url','title','description','ishighlight','islogin','status','sampul_video','createdby','updatedby'];

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

    public function getGallery($id)
    {
        // $where = ['g.galleryid' => '>0'];
        // if($id!==null) $where=['a.categoryid' => $id];
        return $this->db->table('gallery g')
            ->select('galleryid as Id, `url` as Full_Link_File, `url` as Link_File, title as Title, g.description as Description, if(ishighlight=1,"YES","NO") as IsHighlight, if(g.status=1,"YES","NO") as Status, g.createdby as User_Created, g.updatedby as User_Modified, categoryname as Name_Category, if(islogin=1,"YES","NO") as IsLogin')
            ->join('gallerycategories a','a.categoryid=g.categoryid')
            ->where('gallerytype',1)
            ->get();
    }

    public function getGalleryVideo($id)
    {
        // $where = ['g.galleryid' => '>0'];
        // if($id!==null) $where=['a.categoryid' => $id];
        return $this->db->table('gallery g')
            ->select('galleryid as Id, `url` as Full_Link_File, `url` as Link_File, title as Title, g.description as Description, if(ishighlight=1,"YES","NO") as IsHighlight, if(g.status=1,"YES","NO") as Status, g.createdby as User_Created, g.updatedby as User_Modified, categoryname as Name_Category, sampul_video as Cover_File, if(islogin=1,"YES","NO") as IsLogin')
            ->join('gallerycategories a','a.categoryid=g.categoryid')
            ->where('gallerytype',2)
            ->get();
    }
}
