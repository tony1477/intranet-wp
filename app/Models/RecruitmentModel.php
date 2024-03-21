<?php

namespace App\Models;

use App\Entities\RecruitmentEntity;
use CodeIgniter\Model;
use PhpParser\Node\Stmt\Catch_;

class RecruitmentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'emp_recruitment';
    protected $primaryKey       = 'emp_recruitid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = RecruitmentEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['api_employeeid','positionname'];

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

    public function getLastStatus(int $recruitid) :?array
    {
        return $this->db->table('emp_recruitment a')
            ->select('a.emp_recruitid, a.api_employeeid, a.positionname, b.apply_date, b.statusid, c.statusname, b.notes, a.isprocess, a.isbanned')
            ->join('recruitment_detail b','b.emp_recruitid = a.emp_recruitid','left')
            ->join('recruitment_status c','c.recruit_statusid = b.statusid','left')
            ->where('a.api_employeeid',$recruitid)
            ->orderBy('recruit_detailid','desc')
            ->get()
            ->getRowArray();
    }

    public function getAllStatus() :array
    {
        return $this->db->table('recruitment_status a')->get()->getResultArray();
    }

    public function processRecruit(array $data) :void
    {
        // try {
            $this->db->query('call processRecruit(:employeeid:,:statusid:,:position:)',['employeeid'=>$data['api_employeeid'],'statusid'=>$data['statusid'],'position'=>$data['positionname']]);
        // }
        // catch(\Exception $e) {
        //     ;
        // }
    }

    public function notProcessRecruit(array $data)
    {
        // try {
            $this->db->query('call notProcessRecruit(:recruitid:,:statusid:,:message:)',['recruitid'=>$data['recruitid'],'statusid'=>$data['statusid'],'message'=>$data['message']]);
        // }
        // catch(\Exception $e) {
        //     ;
        // }
    }

    public function considerRecruit(array $data)
    {
        $this->db->query('call considerRecruit(:recruitid:,:statusid:,:message:)',['recruitid'=>$data['recruitid'],'statusid'=>$data['statusid'],'message'=>$data['message']]);
    }

    public function addNotes(array $data) 
    {
        // try {
            return $this->db->query('call recruitmentAddNotes(:notes:,:recruitid:,:statusid:)',['notes'=>$data['message'],'recruitid'=>$data['recruitid'],'statusid'=>$data['statusid']]);
        // }
        // catch (\Exception $e) {            
        //     return $e->getMessage();
        // }

    }

    public function blacklist(array $data)
    {
        return $this->db->query('call recruitmentBlacklist(:api_employeeid:,:position:,:message:)',['api_employeeid'=>$data['api_employeeid'],'position'=>$data['position'],'message'=>$data['message']]);
    }

    public function getDataBlacklist(int $id)
    {
        return $this->db->table('recruitment_blacklist')->select('emp_recruitid, api_employeeid, notes, apply_date')->where('api_employeeid',$id)->get()->getRowArray();
    }
}
