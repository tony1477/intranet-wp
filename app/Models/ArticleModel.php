<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Article;
class ArticleModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'article';
    protected $primaryKey       = 'articleid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Article::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['categoryid,title,content,images,page,slug,publish,status,creatorid,updaterid'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';    

    public function getData()
    {
        return $this->db->table('article a')
            ->select('a.*, b.categoryname')
            ->join('article_category b','b.categoryid=a.categoryid')
            ->get();
    }
}
