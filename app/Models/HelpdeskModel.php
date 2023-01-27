<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Helpdesk as Ticketing;

class HelpdeskModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'helpdesk';
    protected $primaryKey       = 'helpdeskid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Ticketing::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['userid','ticketdate','notelp','iddivisi','iddepartment','categoryid','emailatasan','issue','status','image','isemailcreate','isemaildone','ticketclose','reasonclosed'];

    // Dates
    protected $useTimestamps = false;
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

    public function getListHelpdesk()
    {
        // $where = ['g.galleryid' => '>0'];
        // if($id!==null) $where=['a.categoryid' => $id];
        return $this->db->table('helpdesk a')
            ->select('helpdeskid as Id, fullname as Fullname, ticketdate as TicketDate, e.categoryname as Name_Category, notelp as No_Telp, c.div_nama as Location, d.dep_nama as Name_Department, emailatasan as Email_Head, issue as Issue, a.status as Status')
            ->join('users b','b.id = a.userid')
            ->join('tbl_ifmdivisi c','c.iddivisi = a.iddivisi')
            ->join('tbl_ifmdepartemen d','d.iddepartment = a.iddepartment')
            ->join('helpdesk_category e','e.categoryid = a.categoryid')
            // ->where('gallerytype',1)
            ->get();
    }
}
