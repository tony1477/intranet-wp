<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Comment;

class CommentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'article_comment';
    protected $primaryKey       = 'commentid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Comment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['articleid','userid','posted_date','text','parentid'];

    // Dates
    protected $useTimestamps = false;
   
    // public function getCommentbyArticle($id)
    // {
    //     $this->db->table('article_comment a')
    //         ->select('userid,posted_date,text,parentid')
    // }

    public function getComment($articleid,$parentid=null)
    {
        $where = ['articleid'=>$articleid,'parentid'=>$parentid,'a.status'=>'publish'];
        if($parentid == null) $where['parentid'] = null;
        
        return $this->db->table('article_comment a')
            ->select('a.*,ifnull(fullname,username) as name, b.user_image')
            ->join('users b','b.id=a.userid')
            ->where($where)
            ->get();
    }
}
