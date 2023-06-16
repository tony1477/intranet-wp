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
        return explode(',',$list['@list']);
    }

    public function getSummStatusbyType(int $userid, ?string $status) 
    {
        $usersid = $this->getUsersbyId($userid);
        $recordstatus = explode(',',$status);
        $this->select('ifnull(count(1),0) as total');
        $this->whereIn('recordstatus',$recordstatus);
        $this->whereIn('userid_req',$usersid);
        return $this->get();
    }

    public function getDataFromDT(int $userid, ?string $status) 
    {
        $usersid = $this->getUsersbyId($userid);
        $recordstatus = explode(',',$status);
        $sql = $this->db->table('ithelpdesk a')
            ->select('a.helpdeskid, a.ticketdate, ifnull(a.user_attachment,"") as attachment, a.user_reason, a.user_request, user_phone,(select b.categoryname from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid and c.parentid is null) as categoryname, (select group_concat(b.categoryname separator " > ") from helpdesk_issue b
            join helpdesk_choice c on c.choiceid = b.categoryid
            where b.helpdeskid = a.helpdeskid ) as level, (select fullname from users u where u.id=a.userid_req) as user_fullname, (select fullname from users u where u.id=a.userid_head) as head_user, a.user_phone')
            ->whereIn('a.recordstatus',$recordstatus)
            ->whereIn('a.userid_req',$usersid);
        return $sql->get();
    }

    public function getDataListTicket(int $userid)
    {
        $usersid = $this->getUsersbyId($userid);
        $usersid = implode(',',$usersid);
        return $this->query("select helpdeskid, sum(newticket) as newticket, sum(waiting) as waiting, sum(onprogress) as onprogress, sum(`close`) as `close`, sum(cancel) as cancel
        from (select z.*, 
            (select if(recordstatus=1,1,0)) as newticket, 
            (select if(recordstatus=2 or recordstatus=3,1,0)) as waiting,
            (select if(recordstatus=4 or recordstatus=5 or recordstatus=6 or recordstatus=7 or recordstatus=8 or recordstatus=9,1,0)) as onprogress,
            (select if(recordstatus=10,1,0)) as `close`,
            (select if(recordstatus=0,1,0)) as cancel
            from (select helpdeskid,ticketdate,recordstatus
        from ithelpdesk i 
        where i.userid_req in({$usersid})) z ) zz")->getRow();
    }

    public function approveHelpdesk($data)
    {
        $sql = 'call approveItHelpdesk(:vid:,:vuserid:)';
        return $this->db->query($sql,['vid'=>$data['id'],'vuserid'=>$data['userid']]);
    }
}
