<?php

namespace App\Models;

use App\Entities\ItHelpdesk;
use CodeIgniter\Model;

class ItHelpdeskModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ithelpdesk';
    protected $primaryKey       = 'helpdeskid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = ItHelpdesk::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ticketdate','ticketopen','ticketclose','userid_req','userid_head','userid_itadmin','userid_head','userid_itresp','user_phone','categoryid','categoryname','user_request','user_reason','user_attachment','resp_text','resp_reason','resp_recommendation','isemailcreate','isemaildone','recordstatus'];

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
    protected $afterInsert    = [];

    public function savedata($data)
    {
        $this->db->transStart();
        $attachment = null;
        $sql1 = 'insert into ithelpdesk (ticketdate,userid_req,user_phone,user_request,user_reason,user_attachment) values(?,?,?,?,?,?)';
        if(array_key_exists('user_attachment',$data)) $attachment = $data['user_attachment'];
        $param = [$data['ticketdate'],$data['userid_req'],$data['user_phone'],$data['user_request'],$data['user_reason'],$attachment];
        $this->db->query($sql1,$param);
        $insertID = $this->db->insertID();
        $sql2 = "CALL generateHelpdesk(?,?,?)";
        $this->db->query($sql2, [$insertID,$data['categoryid'],$data['categoryname']]);
        $exp_catid = explode(',',$data['categoryid']);
        $exp_catnm = explode(',',$data['categoryname']);
        for($i=0; $i<count($exp_catid); $i++)
        {
            $sql3 = 'insert into helpdesk_issue(helpdeskid,categoryid,categoryname)values(?,?,?)';
            $param = [$insertID,$exp_catid[$i],$exp_catnm[$i]];
            $this->db->query($sql3,$param);
        }
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return false;
        }
        return $insertID;
    }
    
    public function getAllDatabyType(int $type)
    {
        $this->select('ifnull(count(1),0) as total');
        $this->where('recordstatus',$type);
        return $this->get();
    }

    public function getDataFromDT(int $type)
    {
        $sql = $this->db->table('ithelpdesk a')
            ->select('a.ticketdate, ifnull(a.user_attachment,"") as attachment, a.user_reason, a.user_request, user_phone,(select b.categoryname from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid and c.parentid is null) as categoryname, (select group_concat(b.categoryname separator " > ") from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid ) as level, (select fullname from users u where u.id=a.userid_req) as user_fullname, (select fullname from users u where u.id=a.userid_head) as head_user, a.user_phone')
            ->where('a.recordstatus',$type);
        return $sql->get();

        // $where = '';
        // $sql = $this->query("select * from (select a.ticketdate, ifnull(a.user_attachment,'') as attachment, a.user_reason, a.user_request, user_phone,(select b.categoryname from helpdesk_issue b
        //     join helpdesk_choice c on c.choiceid = b.categoryid
        //     where b.helpdeskid = a.helpdeskid and c.parentid is null) as categoryname, (select fullname from users u where u.id=a.userid_head) as head_user
        // from ithelpdesk a 
        // where a.recordstatus = {$type}) z {$where}");
        
        // // if($filtered!='') $where = " where z.fullname like '%{$filtered}%'";
        // return $sql->getResultArray();
    }
}
