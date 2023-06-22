<?php

namespace App\Models\Auth;

use App\Entities\Auth\Wfstructure;
use CodeIgniter\Model;

class WfstructureModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wfstructure';
    protected $primaryKey       = 'wfstructureid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Wfstructure::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['groupid','parentid','status'];

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

    public function getData()
    {
        return $this->query('select wfstructureid as Id, groupid as Group_Id, parentid as Parent_Id, (select `description` from auth_groups a where a.id = ws.groupid) as Group_Name, (select `description` from auth_groups g where g.id = ws.parentid) as Parent_Name, if(recordstatus=1,"YES","NO") as `Recstatus`
        from wfstructure ws')->getResult();
    }
}
