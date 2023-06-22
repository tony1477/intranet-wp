<?php

namespace App\Controllers\Master\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\WfgroupModel;
use App\Models\Auth\WorkflowModel;
use Myth\Auth\Models\GroupModel;

class Wfgroup extends BaseController
{
    private $model=null;
    public function __construct()
    {
        $this->model = new WfgroupModel();
    }
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $wfgroups = $this->model->getData();
        $workflowModel = new WorkflowModel();
        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();
        $workflows = $workflowModel->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Wf_Group']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'Group_User']),
			'modules' => $menu,
            'route' => 'auth/wfgroup',
            'menuname' => 'Wfgroup',
            'data' => $wfgroups,
            'customsearch' => 'master/_partials/wfgroup',
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Wf_Desc','Group_Name','Wf_Bef_Status','Wf_Rec_Status'),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'wfgroupid' => array('type'=>'hidden','idform'=>'id','field'=>'wfgroupid'), 
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
                'groupname' => array(
                    'label'=>'Group_Name',
                    'field'=>'groupid',
                    'type'=>'select',
                    'idform'=>'wf_desc',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $groups,
                        'id' => 'id',
                        'value' => 'description',
                    )
                ),
                'wfbefstat' => array(
                    'label'=>'Wf_Bef_Status',
                    'field'=>'wfbefstat',
                    'type'=>'text',
                    'idform'=>'wf_befstat',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'wfrecstat' => array(
                    'label'=>'Wf_Rec_Status',
                    'field'=>'wfrecstat',
                    'type'=>'text',
                    'idform'=>'wf_recstat',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ],
            'additionalScript' => 'master/_partials/script/wfgroup.js'
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
                $this->model->where('wfgroupid',$id)->delete();
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
                    'wfgroupid' => $datas['id'],
                    'workflowid' => $datas['wf_name'],
                    'groupid' => $datas['wf_desc'],
                    'wfbefstat' => $datas['wf_befstat'],
                    'wfrecstat' => $datas['wf_recstat'],                    
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
