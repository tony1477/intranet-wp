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

    public function updatedata($data) :?bool
    {
        $this->db->transStart();
        $attachment=null;
        if(array_key_exists('user_attachment',$data)) $attachment = $data['user_attachment'];
        $sql = 'call updateItHelpdesk(:vid:,:vcategoryid:,:vcategoryname:,:vuser_phone:,:vuser_request:,:vuser_reason:,:vuser_attachment:,:vupdater:)';
        $this->db->query($sql,['vid'=>$data['id'],'vcategoryid'=>$data['categoryid'], 'vcategoryname'=>$data['categoryname'],'vuser_phone'=>$data['user_phone'],'vuser_request'=>$data['user_request'],'vuser_reason'=>$data['user_reason'],'vuser_attachment'=>$attachment,'vupdater'=>$data['updater']]);
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return false;
        }
        return true;
    }
    
    private function getUsersbyId(int $userid) :?array
    {
        // $this->query("call getUsersStructurebyUserid(".$userid.",@list)");
        $sql = "call getUsersStructurebyUserid(?,@?)";
        $this->query($sql,[$userid,"list"]);
        $list = $this->query('select @list')->getRowArray();
        $exp = explode(',',$list['@list']);
        array_push($exp,$userid);
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
        if(!has_permission('list-ithelpdesk')) $this->whereIn('userid_req',$usersid);
        // if($addedCond!==false) $this->whereIn('recordstatus',$this->getWfbyUserid($addedCond,user_id()));
        return $this->get();
    }

    public function getDataFromDT(int $userid, ?string $status, $addedCond) 
    {
        helper('helpdesk_helper');
        $usersid = $this->getUsersbyId($userid);
        $recordstatus = explode(',',$status);
        $sql = $this->db->table('ithelpdesk a')
            ->select('a.helpdeskid, a.ticketdate, ticketno, ifnull(isfeedback,0) as isfeedback, ifnull(isconfirmation,0) as isconfirmation, ifnull(isrevisied,0) as isrevisied, ifnull(a.user_attachment,"") as attachment, a.user_reason, if(recordstatus=-1,1,0) as iscancel, a.user_request, user_phone,(select b.categoryname from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid and c.parentid is null) as categoryname, a.recordstatus, (select ws.wfstatususer from wfstatus ws where ws.wfstat = a.recordstatus) as status, (select group_concat(b.categoryname separator " > ")
             from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid ) as level, (select fullname from users u where u.id=a.userid_req) as user_fullname, (select fullname from users u where u.id=a.userid_head) as head_user, a.user_phone, (select ifnull(responsetext,"") from helpdeskdetail hd where hd.helpdeskid = a.helpdeskid order by helpdeskdetailid desc limit 1) as responsetext');
            $sql->whereIn('a.recordstatus',$recordstatus);
            if(!has_permission('list-ithelpdesk')) $sql->whereIn('a.userid_req',$usersid);
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
                $sql->where('recordstatus',12);
                break;

            case 'cancel':
                $sql->where('recordstatus',0);
                break;

            case 'progress':
                $sql->whereIn('recordstatus',[4,5,6,7,8,9,10,11,-1]);
                break;

            case 'done':
                $sql->whereIn('recordstatus',[12]);
                break;

            default :
                $list = getWfbyUserid($wfname,user_id());
                $sql->whereIn('recordstatus',explode(',',$list));
                $sql->whereNotIn('recordstatus',[1,5,10]);
                break;
        }
        // if($wfname=='new') $sql->where('recordstatus',1);
        return $sql->get();
        // return $sql->getCompiledSelect();
    }

    public function getAllSummaryTicketbyType(string $wfname)
    {
        $sql = $this->select('ifnull(count(1),0) as total');
        switch($wfname) {
            case 'new':
                $sql->where('recordstatus',1);
                break;

            case 'waiting':
                $sql->whereIn('recordstatus',[2,3]);
                break;

            case 'progress':
                $sql->whereIn('recordstatus',[4,5,6,7,8,9,10,11]);
                break;
                
            case 'done':
                $sql->whereIn('recordstatus',[12]);
                break;

            case 'cancel':
                $sql->where('recordstatus',0);
                break;

            default :
                // $list = getWfbyUserid($wfname,user_id());
                // $sql->whereIn('recordstatus',explode(',',$list));
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
        return $this->query("select helpdeskid, sum(newticket) as newticket, sum(waiting) as waiting, sum(onprogress) as onprogress, sum(`close`) as `close`, sum(cancel) as iscancel, sum(feedback) as isfeedback, sum(confirmation) as isconfirmation, sum(revisied) as isrevisied
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

    public function getAllDataListTicket()
    {
        return $this->query("select helpdeskid, sum(newticket) as newticket, sum(waiting) as waiting, sum(onprogress) as onprogress, sum(`close`) as `close`, sum(cancel) as cancel, sum(feedback) as isfeedback, sum(confirmation) as isconfirmation, sum(revisied) as isrevisied, sum(iscancel) as iscancel
        from (select z.*, 
            if(recordstatus=1,1,0) as newticket, 
            if(recordstatus=2 or recordstatus=3,1,0) as waiting,
            if(recordstatus=4 or recordstatus=5 or recordstatus=6 or recordstatus=7 or recordstatus=8 or recordstatus=9 or recordstatus=9,1,0) as onprogress,
            if(recordstatus=11,1,0) as `close`,
            if(recordstatus=0,1,0) as cancel,
            if(recordstatus=-1,1,0) as iscancel,
            if(isfeedback=1,1,0) as feedback,
            if(isconfirmation=1,1,0) as confirmation,
            if(isrevisied=1,1,0) as revisied
            from (select helpdeskid,ticketdate,recordstatus,ifnull(isfeedback,0) as isfeedback,ifnull(isconfirmation,0) as isconfirmation,isrevisied
        from ithelpdesk i 
        ) z ) zz")->getRow();
    }

    public function approveHelpdesk($data)
    {
        $this->db->transStart();
        $sql = 'call approveItHelpdesk(:vid:,:vuserid:)';
        $this->db->query($sql,['vid'=>$data['id'],'vuserid'=>$data['userid']]);
        $this->db->transComplete();
        return true;
        if ($this->db->transStatus() === false) {
            return false;
        }
    }

    public function doHelpdesk($data)
    {
        $this->db->transStart();
        $sql = 'call doItHelpdesk(:vid:,:vpetugas:,:vurgency:,:vuserid:)';
        $this->db->query($sql,['vid'=>$data['id'],'vpetugas'=>$data['petugas'],'vurgency'=>$data['urgency'],'vuserid'=>$data['userid']]);
        $this->db->transComplete();
        return true;
        if ($this->db->transStatus() === false) {
            return false;
        }
    }

    public function rejectHelpdesk($data)
    {
        $this->db->transStart();
        $sql = 'call rejectItHelpdesk(:vid:,:vuserid:,:vreason:)';
        $this->db->query($sql,['vid'=>$data['id'],'vuserid'=>$data['userid'], 'vreason'=>$data['reason']]);
        $this->db->transComplete();
        return true;
        if ($this->db->transStatus() === false) {
            return false;
        }
    }

    public function getRespDT(string $status)
    {
        $exp_status = explode(',',$status);
        $sql = $this->db->table('ithelpdesk a')
        ->select("helpdeskid, ticketno, ticketopen, ticketclose, urgency as urgency, (select categoryname from helpdesk_issue b join helpdesk_choice c on c.choiceid = b.categoryid where b.helpdeskid = a.helpdeskid and c.parentid is null limit 1) as category, (select fullname from users u where u.id = a.userid_req) as fullname, (select wfstatusname from wfstatus d where d.workflowid=1 and d.wfstat=a.recordstatus) as status");
        $sql->whereIn('recordstatus',$exp_status)
        ->orderBy('a.ticketno','desc');
        return $sql->get();
    }

    public function getSummResp(string $status)
    {
        $recordstatus = explode(',',$status);
        $this->select('ifnull(count(1),0) as total');
        $this->whereIn('recordstatus',$recordstatus);
        return $this->get();
    }

    public function getDetailResp(int $id) :?object
    {
        $sql = $this->db->table('ithelpdesk a')
        ->select("helpdeskid, ticketno, ticketdate, ticketopen, ticketclose, user_phone, user_request, user_reason, user_attachment, resp_text, resp_recommendation, resp_reason, ifnull(helpdesktype,'') as helpdesktype, ifnull(urgency,0) as urgency, recordstatus, updated_at, (select wf.wfstatusname from wfstatus wf where wf.wfstat=a.recordstatus and workflowid=1) as status, (select ifnull(count(1),0) from helpdeskdetail hs where hs.helpdeskid={$id} and hs.respondtypeid = 1) as revisied,
        (select ifnull(count(1),0) from helpdeskdetail hs where hs.helpdeskid={$id} and hs.respondtypeid in (2,3)) as feedback,
        (select ifnull(count(1),0) from helpdeskdetail hs where hs.helpdeskid={$id} and hs.respondtypeid in(4,5)) as confirm, (select fullname from users u where u.id = a.userid_req) as fullname, a.userid_itadmin, (select group_concat(categoryname separator ' > ') from helpdesk_issue hi where hi.helpdeskid = a.helpdeskid) as category");
        $sql->where('helpdeskid',$id);
        return $sql->get();
    }

    public function getDataFeedbackResp(int $id, string $responstype) :?object
    {
        switch($responstype) {

            case 'feedback':
                $where = [2,3];
                break;

            case 'confirmation':
                $where = [4,5];
                break;
            
            default:
                $where = [1];
                break;
        }
        return $this->db->table('helpdeskdetail a')
        ->select('a.responsetext, attachment, a.created_at, (select fullname from users u where u.id=a.creator_id) as fullname, b.description as responsetype, c.resp_text, c.resp_reason, c.resp_recommendation, ifnull(c.helpdesktype,"") as helpdesktype')
        ->join('responsetype b','b.respondtypeid = a.respondtypeid')
        ->join('ithelpdesk c','c.helpdeskid = a.helpdeskid')
        ->whereIn('a.respondtypeid',$where)
        ->where('a.helpdeskid',$id)
        ->orderBy('created_at', 'asc')
        ->get();
    }

    public function submitFormReviewFeedback($data)
    {
        $this->db->transStart();
        if(array_key_exists('helpdesktype',$data) || array_key_exists('resp_recommendation',$data) || array_key_exists('resp_reason',$data) || array_key_exists('resp_text',$data)) :
            $sql = 'call submitformconfirm(:id:, :respondtypeid:, :responsetext:, :status:, :userid:,:resp_text:,:resp_reason:,:resp_recommendation:,:helpdesktype:)';
            $this->query($sql,['id'=>$data['id'],'respondtypeid'=>$data['respondtypeid'],'responsetext'=>$data['responsetext'],'status'=>$data['status'], 'userid'=>$data['creator_id'],'resp_text'=>$data['resp_text'],'resp_reason'=>$data['resp_reason'],'resp_recommendation'=>$data['resp_recommendation'],'helpdesktype'=>$data['helpdesktype']]);
        else :
            $sql = 'call submitformfeedback(:id:, :respondtypeid:, :responsetext:, :status:, :userid:)';
            $this->query($sql,['id'=>$data['id'],'respondtypeid'=>$data['respondtypeid'],'responsetext'=>$data['responsetext'],'status'=>$data['status'], 'userid'=>$data['creator_id']]);
        endif;

        if ($this->db->transStatus() === false) {
            return false;
        }
        $this->db->transComplete();
        return true;        
    }
	
	public function addToNotification($data)
    {
        // $this->db->transStart();
        $sql = 'call insertNotif(:notiftitle:,:notificon:,:notiftext:,:url:,:notiftype:)';

        $notiftitle = 'Ticket IT Helpdesk';
        $notificon = 'mdi mdi-clipboard-check';
        $notiftext = 'Ada permintaan Ticketing IT Helpdesk yang diajukan oleh '.$data['username'].' pada tanggal '.date('d/M/Y').' dengan pesan sebagai berikut : '.$data['user_request'];
        $url = 'http://wilianperkasa.synology.me:88/intranet-wp/list-helpdesk';
        $notiftype = 'ithelpdesk';

        $bool = (bool) $this->db->query($sql,[
            'notiftitle'=>$notiftitle,
            'notificon'=>$notificon,
            'notiftext'=>$notiftext,
            'url'=>$url,
            'notiftype'=>$notiftype,
        ]);
        if($bool) $sql1 = $this->db->query("SELECT LAST_INSERT_ID() as notifid;")->getRow();

        // if ($this->db->transStatus() === false) {
            // return 0;
        // }
        // $this->db->transComplete();
        return $sql1;
    }
}
