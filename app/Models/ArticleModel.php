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
    protected $allowedFields    = ['categoryid','title','content','image','page','slug','publish','status','sum_comment','sum_read','can_comment','articletype','creatorid','updaterid'];

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
            // ->where('a.articletype',$articletype)
            ->get()->getResult(Article::class);
    }

    // public function getUpcoming()
    // {
    //     return $this->db->table('article a')
    //         ->select
    // }

    // public function getPopularArticle()
    // {

    // }

    public function sumPerTag()
    {
        return $this->db->select('slug')
        ->groupBy('slug')->get()->getResult();
    }

    public function getArticle(string $periode,?string $title)
    {
        $periode = $periode.'-01';
        // $where = ['articleid'=>$id];
        // if($title!==null) array_merge($where,['title'=>$title]);
        $where = ['title'=>$title];
       
        return $this->db->query("select a.*, ifnull(fullname,username) as name, categoryname 
        from article a
        join users b on b.id = a.creatorid
        left join article_category c on c.categoryid = a.categoryid
        where month(posted_date) = month('{$periode}') and year(posted_date) = year('{$periode}') and title = '{$title}'");
    }

    public function updateRead(int $id)
    {
        $query = 'call upadateReadArticle(?)';
        if($this->db->query($query,[$id]))
            return true;
        
        return false;
    }
}
