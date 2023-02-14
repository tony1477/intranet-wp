<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\EmailSubs;

class ArticleSubsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'article_subscriber';
    protected $primaryKey       = 'subs_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = EmailSubs::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['subs_date','userid','fullname','subs_email','status'];

}
