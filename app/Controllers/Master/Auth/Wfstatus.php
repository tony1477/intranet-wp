<?php

namespace App\Controllers\Master\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\WfstatusModel;
use App\Models\Auth\WorkflowModel;

class Wfstatus extends BaseController
{
    private $model=null;
    public function __construct()
    {
        $this->model = new WfstatusModel();
    }
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $workflowModel = new WorkflowModel();
        $workflows = $workflowModel->findAll();
        $wfstatus = $this->model->getData();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Wf_Status']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'Group_User']),
			'modules' => $menu,
            'route' => 'auth/wfstatus',
            'menuname' => 'Wfstatus',
            'data' => $wfstatus,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Wf_Desc','Wf_Stat','Wf_Status_Name','Wf_Status_User'),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'wfstatusid' => array('type'=>'hidden','idform'=>'id','field'=>'wfstatusid'), 
                'wfname' => array(
                    'label'=>'Wf_Desc',
                    'field'=>'workflowid',
                    'type'=>'select',
                    'idform'=>'wf_name',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $workflows,
                        'id' => 'Id',
                        'value' => 'Wf_Desc',
                    )
                ),
                'wfstat' => array(
                    'label'=>'Wf_Stat',
                    'field'=>'wfstat',
                    'type'=>'text',
                    'idform'=>'wf_stat',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'wfstatusnm' => array(
                    'label'=>'Wf_Status_Name',
                    'field'=>'wfstatusname',
                    'type'=>'text',
                    'idform'=>'wf_statname',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'wfstatuser' => array(
                    'label'=>'Wf_Status_User',
                    'field'=>'wfstatususer',
                    'type'=>'text',
                    'idform'=>'wf_statuser',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		
		return view('master/m_view', $data);
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
                $this->model->where('wfstatusid',$id)->delete();
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
                    'wfstatusid' => $datas['id'],
                    'workflowid' => $datas['wf_name'],
                    'wfstat' => $datas['wf_stat'],
                    'wfstatusname' => $datas['wf_statname'],
                    'wfstatususer' => $datas['wf_statuser'],                    
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
