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
   
    
}
