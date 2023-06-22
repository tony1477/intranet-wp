<?php

namespace App\Controllers\Master\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\WfstructureModel;
use Myth\Auth\Models\GroupModel;

class Wfstructure extends BaseController
{
    private $model=null;
    public function __construct()
    {
        $this->model = new WfstructureModel();
    }
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $wfstructure = $this->model->getData();
        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Wf_Structure']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'Group_User']),
			'modules' => $menu,
            'route' => 'auth/wfstructure',
            'menuname' => 'Wfstructure',
            'data' => $wfstructure,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Group_Name','Parent_Name','Recstatus'),
            'button' => array(
                'Recstatus' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'wfstructureid' => array('type'=>'hidden','idform'=>'id','field'=>'wfstructureid'), 
                'groupid' => array(
                    'label'=>'Group_Name',
                    'field'=>'groupid',
                    'type'=>'select',
                    'idform'=>'group_id',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $groups,
                        'id' => 'id',
                        'value' => 'description',
                    )
                ),
                'parentid' => array(
                    'label'=>'Parent_Name',
                    'field'=>'parentid',
                    'type'=>'select',
                    'idform'=>'parent_id',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $groups,
                        'id' => 'id',
                        'value' => 'description',
                    )
                ),
                'status' => array(
                    'label'=>'Recstatus',
                    'field'=>'recordstatus',
                    'type'=>'switch',
                    'idform'=>'isaktif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
            ],
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
                $this->model->where('wfstructureid',$id)->delete();
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
                    'wfstructureid' => $datas['id'],
                    'groupid' => $datas['group_id'],
                    'parentid' => $datas['parent_id'],
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
