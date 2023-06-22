<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class GroupUser extends BaseController
{
    public $model = null;
    private $users;
    public function __construct()
    {
        $this->model = new \App\Models\GroupUserModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $groupuser = $this->model->getData();
        $this->users = new UserModel();
        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();
        $users = $this->users->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Group_User']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'Group_User']),
			'modules' => $menu,
            'route' => 'user-group',
            'menuname' => 'Group_User',
            'data' => $groupuser,
            'customsearch' => 'master/_partials/usergroup',
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','User_Name','Group_Name','User_Created','User_Modified'),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idgroupuser' => array('type'=>'hidden','idform'=>'id','field'=>'usergroupid'), 
                'userid' => array(
                    'label'=>'User_Name',
                    'field'=>'user_id',
                    'type'=>'select',
                    'idform'=>'id_user',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $users,
                        'id' => 'id',
                        'value' => 'Fullname',
                    ),
                ),
                'groupid' => array(
                    'label'=>'Group_Name',
                    'field'=>'group_id',
                    'type'=>'select',
                    'idform'=>'id_group',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $groups,
                        'id' => 'id',
                        'value' => 'description',
                    ),
                ),
            ],
            'additionalScript' => 'master/_partials/script/usergroup.js'
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
                $this->model->where('usergroupid',$id)->delete();
                if($this->model->find($id)) {
                    $arr = array(
                        'status' => 'warning',
                        'code' => 200,
                        'message' => 'Terjadi kesalahan dalam menghapus data',
                        // 'data' => $this->model->findAll()
                    );
                    return json_encode($arr);
                }
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Data Berhasil di Hapus',
                    // 'data' =>  $this->model->findAll()
                );
            }catch (\Exception $e) {
                $arr = array(
                    'status' => $e->getMessage(),
                    'code' => 400,
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
                    'group_id' => $datas['id_group'],
                    'user_id' => $datas['id_user'],
                    'updater_id' => user()->username,
                    // 'tgl_m'=>date('Y-m-d'),
                    // 'time_m'=>date("h:i:s a")
                ];
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        'creator_id' => user()->username,
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
                    'code' => 400,
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }
}
