<?php

namespace App\Models;

use App\Entities\HelpdeskChoice;
use CodeIgniter\Model;

class HelpdeskChoiceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'helpdesk_choice';
    protected $primaryKey       = 'choiceid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = HelpdeskChoice::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['choicecode','choicename','parentid','description','ordered','recordstatus'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getChoiceHelpdesk($id) {
        $where = ' and parentid = '.$id;
        if($id==null) $where = ' and parentid is null';
        
        return $this->db->query('select choiceid,choicecode,choicename,description,ordered,parentid,(select distinct b.parentid from helpdesk_choice b where b.choiceid=a.parentid) as prevparent, (select group_concat(choicename separator " , ") from helpdesk_choice x where x.parentid=a.choiceid and x.recordstatus=1) as next_choice from helpdesk_choice a where a.recordstatus=1'.$where.' order by `ordered` asc')->getResult();
    }
}
