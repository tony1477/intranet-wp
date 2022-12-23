<?php namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DivisiModel;
use App\Models\DepartmentModel;
use App\Models\PositionModel as JabatanModel;

class CommonApi extends ResourceController {
    use ResponseTrait;
    // private $table;
    // private $model;

    public function setTable($tablename='tablename')
    {
        $this->table = $tablename;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getAuthorized()
    {
        $headers = getallheaders();
        $hash = hash('sha256',(getenv('SECRET_KEY').date('Y-m-d H:i')));
        $request = substr($headers['Authorization'],7);
        if($hash !== $request) return $this->failUnauthorized('NOT AUTHORIZED!');
        return true;
    }

    public function getDivisi() {
        if($this->getAuthorized()===true) 
        {
            $model = new DivisiModel();
            $data = $model->select('iddivisi,div_nama')->findAll();
            $data = array_merge(['status'=>'success'],$data);
            return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }

    public function getDepartment() {
        if($this->getAuthorized()===true) 
        {
            $model = new DepartmentModel();
            $data = $model->select('iddepartment,dep_nama')->findAll();
            $data = array_merge(['status'=>'success'],$data);
            return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }

    public function getJabatan() {
        if($this->getAuthorized()===true) 
        {
            $model = new JabatanModel();
            $data = $model->select('idjabatan,jab_nama')->findAll();
            $data = array_merge(['status'=>'success'],$data);
            return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }
}