<?php namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DivisiModel;
use App\Models\DepartmentModel;
use App\Models\PositionModel as JabatanModel;

class CommonApi extends ResourceController {
    use ResponseTrait;
    private $table;
    // private $model;

    public function setTable($tablename='tablename')
    {
        $this->table = $tablename;
    }

    public function getTable()
    {
        return $this->table;
    }

    private function getAuthorized()
    {
        $headers = getallheaders();
        if(!isset($headers['Authorization'])) return $this->failUnauthorized('NOT AUTHORIZED!');
        $hash = hash('sha256',(getenv('SECRET_KEY').date('Y-m-d H:i')));
        $request = substr($headers['Authorization'],7);
        if($hash !== $request) return $this->failUnauthorized('NOT AUTHORIZED!');
        return true;
    }

    private function getAuthorizedCustom()
    {
        $headers = getallheaders();
        if(!isset($headers['Authorization'])) return $this->failUnauthorized('NOT AUTHORIZED!');
        if($headers===null) return $this->failUnauthorized('NOT AUTHORIZED!');
        $hash = hash('sha256',(getenv('SECRET_KEY').date('Y-m-d')));
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

    public function getDepartment($id=0) {
        // if($this->getAuthorized()===true) 
        // {
            $model = new DepartmentModel();
            $data = $model->select('iddepartment,dep_nama')->where('iddivisi',$id)->findAll();
            $data = array_merge(['status'=>'success'],$data);
            return $this->respond($data,200);
        // }
        // return $this->failUnauthorized('NOT AUTHORIZED!');
    }

    public function getJabatan() {
        if($this->getAuthorized()===true) 
        {
            $model = new JabatanModel();
            $data = $model->select('idjabatan,jab_nama')->orderBy('no_urut','asc')->findAll();
            $data = array_merge(['status'=>'success'],$data);
            return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }

    public function getKaryawan() {
        if($this->getAuthorizedCustom()===true) 
        {
            $model = new \App\Models\UserModel();
            $data = $model->select('ifnull(fullname,"") as fullname,id')->where('active',1)->whereNotIn('fullname',['Administrator'])->orderBy('fullname','asc')->findAll();
            // $data = array_merge(['status'=>'success'],$data)
            return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }

    public function getInfoKaryawanbyId($id) {
        if($this->getAuthorizedCustom()===true) 
        {
            $model = new \App\Models\UserModel();
            $data = $model->select('fullname,id,dep_nama,email')->join('tbl_ifmdepartemen a','a.iddepartment = users.iddepartment')->where('users.active',1)->where('id',$id)->orderBy('fullname','asc')->find();
            // $data = array_merge(['status'=>'success'],$data)
            return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }

    public function getInfoKaryawanbyIdName($name,$id)
    {
        if($this->getAuthorizedCustom()===true) 
        {
            $fullname = str_replace('_',' ',$name);
            $model = new \App\Models\UserModel();
            if($model->where('fullname',$fullname)->where('id',$id)->find()):
                $data = $model->select('fullname,id,dep_nama,email')->join('tbl_ifmdepartemen a','a.iddepartment = users.iddepartment')->where('users.active',1)->where('id',$id)->orderBy('fullname','asc')->find();
                $data = array_merge(['status'=>'success'],$data);
            else:
                $model = new \App\Models\ExtParticipantModel();
                $data = $model->asObject()->select('name as fullname, description as dep_nama, email,recordstatus')->where('participantid',$id)->find();
                $data = array_merge(['status'=>'success'],$data);
            endif;
            return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }

    public function getKaryawanwithExt() {
        if($this->getAuthorizedCustom()===true) 
        {
            $model = new \App\Models\UserModel();
            $builder = $model->builder();
            // $db = \Config\Database::connect();

            $builder->select('ifnull(fullname,"") as fullname, id, "Internal"')
                // ->from('users')
                ->where('active',1)
                ->whereNotIn('fullname',['Administrator']);
            $firstQuery = $builder->getCompiledSelect();
            
            $external = $model->builder('external_participant');
            $external->select('name, participantid, "Eksternal"')
                // ->from('external_participant')
                ->where('recordstatus',1);
            
            $secondQuery = $external->getCompiledSelect();
            $unionQuery = $firstQuery.' UNION ALL '.$secondQuery.' order by fullname asc';
            $data = $model->query($unionQuery)->getResult();
            return $this->respond($data,200);
            
            // $data = $model->select('ifnull(fullname,"") as fullname,id')->where('active',1)->whereNotIn('fullname',['Administrator'])->orderBy('fullname','asc')->findAll();
            // // $data = array_merge(['status'=>'success'],$data)
            // return $this->respond($data,200);
        }
        return $this->failUnauthorized('NOT AUTHORIZED!');
    }
}