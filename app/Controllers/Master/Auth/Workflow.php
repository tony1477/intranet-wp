<?php

namespace App\Controllers\Master\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\WorkflowModel;

class Workflow extends BaseController
{
    private $model=null;
    public function __construct()
    {
        $this->model = new WorkflowModel();
    }
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $workflow = $this->model->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Workflow']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'Group_User']),
			'modules' => $menu,
            'route' => 'auth/workflow',
            'menuname' => 'Workflow',
            'data' => $workflow,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Wf_Name','Wf_Desc','Wf_Min_Status','Wf_Max_Status','Status'),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idgroupuser' => array('type'=>'hidden','idform'=>'id','field'=>'workflowid'), 
                'wfname' => array(
                    'label'=>'Wf_Name',
                    'field'=>'wfname',
                    'type'=>'text',
                    'idform'=>'wf_name',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'wfdesc' => array(
                    'label'=>'Wf_Desc',
                    'field'=>'wfdesc',
                    'type'=>'text',
                    'idform'=>'wf_desc',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'wfminstat' => array(
                    'label'=>'Wf_Min_Status',
                    'field'=>'wfminstat',
                    'type'=>'text',
                    'idform'=>'wf_min',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'wfmaxstat' => array(
                    'label'=>'Wf_Max_Status',
                    'field'=>'wfmaxstat',
                    'type'=>'text',
                    'idform'=>'wf_max',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'status' => array(
                    'label'=>'Status',
                    'field'=>'recordstatus',
                    'type'=>'switch',
                    'idform'=>'isaktif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
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
                $this->model->where('workflowid',$id)->delete();
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
                    'workflowid' => $datas['id'],
                    'wfname' => $datas['wf_name'],
                    'wfdesc' => $datas['wf_desc'],
                    'wfminstat' => $datas['wf_min'],
                    'wfmaxstat' => $datas['wf_max'],                    
                    'recordstatus' => ($datas['isaktif']=='Y' ? 1 : 0),
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
