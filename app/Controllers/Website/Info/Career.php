<?php

namespace App\Controllers\Website\Info;

use App\Controllers\BaseController;
use App\Models\Website\Info\LocationModel as Location;

class Career extends BaseController
{
    private $model;
    // private $entities;
    public function __construct()
    {
        $this->model = new \App\Models\Website\Info\CareerModel();
        // $this->entities = new \App\Entities\Career;
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $career = $this->model->getData()->getResult('App\Entities\Career');
        $objlocation = new Location();
        $location = $objlocation->findAll();
        // $profile = $this->model->getDataProfile()->getResult('\App\Entities\Profile');
        // $page = $pageModel->findAll();
        //$divisi = getDivisi();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Career']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Website', 'li_2' => 'Career']),
			'modules' => $menu,
            'route'=>'informasi/karir',
            'menuname' => 'Career',
            'data' => $career,
            'modal' => 'modal-lg',
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Title','Position','Lokasi','Requirement','Jobdesc','Catatan','User_Created','User_Modified'),
            //'crudScript' => view('partials/script/department',['menuname' => 'Department']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'careerid' => array('type'=>'hidden','idform'=>'id','field'=>'careerid'), 
                'title' => array(
                    'label'=>'Title',
                    'field'=>'title',
                    'type'=>'text',
                    'idform'=>'judul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'position' => array(
                    'label'=>'Position',
                    'field'=>'position',
                    'type'=>'text',
                    'idform'=>'jabatan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'location' => array(
                    'label'=>'Location',
                    'field'=>'location',
                    'type'=>'select',
                    'idform'=>'lokasi',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $location,
                        'id' => 'Id',
                        'value' => 'Name',
                    ),
                ),
                'requirement' => array(
                    'label'=>'Requirement',
                    'field'=>'requirement',
                    'type'=>'textarea',
                    'idform'=>'kualifikasi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-12 col-xl-12'
                ),
                'jobdesc' => array(
                    'label'=>'Job_Description',
                    'field'=>'jobdesc',
                    'type'=>'textarea',
                    'idform'=>'persyaratan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-12 col-xl-12'
                ),
                'notes' => array(
                    'label'=>'Notes',
                    'field'=>'notes',
                    'type'=>'textarea',
                    'idform'=>'catatan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-12 col-xl-12'
                ),
                // 'location' => array(
                //     'label'=>'Page',
                //     'field'=>'pageid',
                //     'type'=>'select',
                //     'idform'=>'page_id',
                //     'form-class'=>'form-select',
                //     'style' => 'col-md-8 col-xl-8',
                //     'options' => array(
                //         'list' => $location,
                //         'id' => 'Id',
                //         'value' => 'Page',
                //     ),
                // ),
            ]
		];
        // var_dump($location);
		return view('master/w_view', $data);
    }

    public function delete()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        if($this->request->isAJAX()) {
            try {
                $id = $this->request->getVar('id');
                $this->model->where('iddepartment',$id)->delete();
                if($this->model->find($id)) {
                    $arr = array(
                        'status' => 'warning',
                        'code' => 200,
                        'message' => lang('Files.Delete_Error'),
                        // 'data' => $this->model->findAll()
                    );
                    return json_encode($arr);
                }
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => lang('Files.Delete_Success'),
                    // 'data' =>  $this->model->findAll()
                );
            }catch (\Exception $e) {
                $arr = array(
                    'status' => $e->getMessage(),
                    'code' => 400
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }

    public function save()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        if($this->request->isAJAX()) {
            try {
                $datas = $this->request->getVar('data');
                if(is_object($datas)) {
                    $datas = (array) $datas;
                }
                $data = [
                    'careerid' => $datas['id'],
                    'title' => $datas['judul'],
                    'position' => $datas['jabatan'],
                    'locationid' => $datas['lokasi'],
                    'requirement' => $datas['kualifikasi'],
                    'jobdesc' => $datas['persyaratan'],
                    'notes' => $datas['catatan'],
                    'status' => 1,
                    // 'user_m' => $this->session->user_kode,
                    // 'tgl_m'=>date('Y-m-d'),
                    // 'time_m'=>date("h:i:s a")
                ];
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        // 'user_c' => $this->session->user_kode,
                        // 'tgl_c'=>date('Y-m-d'),
                        // 'time_c'=>date("h:i:s a")
                    ];
                    $data = array_merge($data,$newdata);
                    $this->model->insert($data);
                    $message = lang('Files.Save_Success');
                }
                
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => $message
                );
            }catch (\Exception $e) {
                $arr = array(
                    'status' => $e->getMessage(),
                    'code' => 400
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }
}
