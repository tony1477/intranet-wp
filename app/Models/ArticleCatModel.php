<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\ArticleCategory;

class ArticleCatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'article_category';
    protected $primaryKey       = 'categoryid';
    protected $returnType       = ArticleCategory::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['categoryname','status','created_by','updated_by'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function sumPerCategory()
    {
        return $this->db->table('article_category a')
                ->select('a.categoryname, (select ifnull(count(1),0) from article b where b.categoryid=a.categoryid) as jum')
                ->get()->getResult();
    }
   
}
