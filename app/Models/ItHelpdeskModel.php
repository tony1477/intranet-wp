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

    public function savedata($data) :?int
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
    
    private function getUsersbyId(int $userid) :?array
    {
        // $this->query("call getUsersStructurebyUserid(".$userid.",@list)");
        $sql = "call getUsersStructurebyUserid(?,@?)";
        $this->query($sql,[$userid,"list"]);
        $list = $this->query('select @list')->getRowArray();
        $exp = explode(',',$list['@list']);
        return array_unique($exp);
    }

    public function getDataUser(int $userid)
    {
        return $this->getUsersbyId($userid);
    }

    public function getParentLevel(int $userid) :?array
    {
        $sql = $this->query("select getUserParentLevel({$userid}) as userid")->getRow();
        return explode(',',$sql->userid);
    }

    public function getSummStatusbyType(int $userid, ?string $status, bool $addedCond) 
    {
        helper('helpdesk_helper');
        $usersid = $this->getUsersbyId($userid);
        $recordstatus = explode(',',$status);
        $this->select('ifnull(count(1),0) as total');
        $this->whereIn('recordstatus',$recordstatus);
        $this->whereIn('userid_req',$usersid);
        // if($addedCond!==false) $this->whereIn('recordstatus',$this->getWfbyUserid($addedCond,user_id()));
        return $this->get();
    }

    public function getDataFromDT(int $userid, ?string $status, $addedCond) 
    {
        helper('helpdesk_helper');
        $usersid = $this->getUsersbyId($userid);
        $recordstatus = explode(',',$status);
        $sql = $this->db->table('ithelpdesk a')
            ->select('a.helpdeskid, a.ticketdate, ifnull(isfeedback,0) as isfeedback, ifnull(isconfirmation,0) as isconfirmation, ifnull(isrevisied,0) as isrevisied, ifnull(a.user_attachment,"") as attachment, a.user_reason, a.user_request, user_phone,(select b.categoryname from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid and c.parentid is null) as categoryname, a.recordstatus, (select ws.wfstatususer from wfstatus ws where ws.wfstat = a.recordstatus) as status, (select group_concat(b.categoryname separator " > ")
             from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid ) as level, (select fullname from users u where u.id=a.userid_req) as user_fullname, (select fullname from users u where u.id=a.userid_head) as head_user, a.user_phone, (select ifnull(responsetext,"") from helpdeskdetail hd where hd.helpdeskid = a.helpdeskid order by helpdeskdetailid desc limit 1) as responsetext');
            $sql->whereIn('a.recordstatus',$recordstatus);
            $sql->whereIn('a.userid_req',$usersid);
            if($addedCond!==false) {
                $lists = getWfbyUserid($addedCond,user_id());
                $list = explode(',',$lists);
                $sql->whereIn('a.recordstatus',$list);
            }
        return $sql->get();
    }

    public function getSummaryTicketbyType(int $userid, string $wfname='listhelpdesk')
    {
        $usersid = $this->getUsersbyId($userid);
        // $usersid = implode(',',$usersid);
        $sql = $this->select('ifnull(count(1),0) as total');
        $sql->whereIn('userid_req',$usersid);
        switch($wfname) {
            case 'new':
                $sql->where('recordstatus',1);
                break;

            case 'close':
                $sql->where('recordstatus',11);
                break;

            case 'cancel':
                $sql->where('recordstatus',0);
                break;

            case 'progress':
                $sql->whereIn('recordstatus',[4,5,6,7,8,9,10]);
                break;

            case 'done':
                $sql->whereIn('recordstatus',[11]);
                break;

            default :
                $list = getWfbyUserid($wfname,user_id());
                $sql->whereIn('recordstatus',explode(',',$list));
                break;
        }
        // if($wfname=='new') $sql->where('recordstatus',1);
        return $sql->get();
        // return $sql->getCompiledSelect();
    }
    public function getDataListTicket(int $userid, string $wfname='listhelpdesk')
    {
        $usersid = $this->getUsersbyId($userid);
        $usersid = implode(',',$usersid);
        return $this->query("select helpdeskid, sum(newticket) as newticket, sum(waiting) as waiting, sum(onprogress) as onprogress, sum(`close`) as `close`, sum(cancel) as cancel, sum(feedback) as isfeedback, sum(confirmation) as isconfirmation, sum(revisied) as isrevisied
        from (select z.*, 
            if(recordstatus=1,1,0) as newticket, 
            if(recordstatus=2 or recordstatus=3,1,0) as waiting,
            if(recordstatus=4 or recordstatus=5 or recordstatus=6 or recordstatus=7 or recordstatus=8 or recordstatus=9 or recordstatus=9,1,0) as onprogress,
            if(recordstatus=11,1,0) as `close`,
            if(recordstatus=0,1,0) as cancel,
            if(isfeedback=1,1,0) as feedback,
            if(isconfirmation=1,1,0) as confirmation,
            if(isrevisied=1,1,0) as revisied
            from (select helpdeskid,ticketdate,recordstatus,ifnull(isfeedback,0) as isfeedback,ifnull(isconfirmation,0) as isconfirmation,isrevisied
        from ithelpdesk i 
        where i.userid_req in($usersid)
        -- and i.recordstatus in(".getWfbyUserid($wfname,user_id()).")
        ) z ) zz")->getRow();
    }

    public function approveHelpdesk($data)
    {
        $sql = 'call approveItHelpdesk(:vid:,:vuserid:)';
        return $this->db->query($sql,['vid'=>$data['id'],'vuserid'=>$data['userid']]);
    }

    public function rejectHelpdesk($data)
    {
        $sql = 'call rejectItHelpdesk(:vid:,:vuserid:,:vreason:)';
        return $this->db->query($sql,['vid'=>$data['id'],'vuserid'=>$data['userid'], 'vreason'=>$data['reason']]);
    }
}
