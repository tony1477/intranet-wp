<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class User extends BaseController
{
    public $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\User1Model();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $users = getUser();
        //$submenu = getSubmenu($moduleid=0);
		// $data = [
		// 	'title_meta' => view('partials/title-meta', ['title' => 'Group_Divisi']),
		// 	'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Group_Divisi']),
		// 	'modules' => $menu,
        //     'groupdivisi' => $getgroupdivisi,
		// ];
		
		// return view('master/grupdivisi', $data);

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'User']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'User']),
			'modules' => $menu,
            'route' => 'users',
            'menuname' => 'User',
            'data' => $users,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'mark_column' => array('Pwd_User'),
            'columns' => array('Action','Id','Code_User','Name_User','Pwd_User','Email_User','Blokir_User','Photo_User'),
            //'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'iduser' => array('type'=>'hidden','idform'=>'id','field'=>'iduser'), 
                // 'iddivisigroup' => array(
                //     'label'=>'Name_GroupDivisi',
                //     'type'=>'select',
                //     'idform'=>'idgroup',
                //     'form-class'=>'form-select',
                //     'style' => 'col-md-8 col-xl-8',
                //     'options' => array(
                //         'list' => $group,
                //         'id' => 'iddivisigroup',
                //         'value' => 'gdiv_nama',
                //     ),
                // ),
                'user_kode' => array(
                    'label'=>'Code_User',
                    'field'=>'user_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'user_nama' => array(
                    'label'=>'Name_User',
                    'field'=>'user_nama',
                    'type'=>'text',
                    'idform'=>'namauser',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'user_pwd' => array(
                    'label'=>'Pwd_User',
                    'field'=>'user_pwd',
                    'type'=>'password',
                    'idform'=>'pwd',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'user_email' => array(
                    'label'=>'Email_User',
                    'field'=>'user_email',
                    'type'=>'email',
                    'idform'=>'email',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'user_blokir' => array(
                    'label'=>'Blokir_User',
                    'field'=>'user_blokir',
                    'type'=>'option',
                    'value'=> array('Ya'=>'Yes','Tidak'=>'No'),
                    'idform'=>'statususer',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'user_fhoto' => array(
                    'label'=>'Photo_User',
                    'field'=>'user_fhoto',
                    'type'=>'text',
                    'idform'=>'photouser',
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
                $this->model->where('iddivisigroup',$id)->delete();
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
                    'user_kode' => $datas['kode'],
                    'user_nama' => $datas['namauser'],
                    'user_pwd' => $datas['pwd'],
                    'user_email' => $datas['email'],
                    'user_blokir' => $datas['statususer'],
                    'user_fhoto' => $datas['photouser'],
                    // 'user_m' => $this->session->user_kode,
                    'tgl_m'=>date('Y-m-d'),
                    'time_m'=>date("h:i:s a")
                ];
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        // 'user_c' => $this->session->user_kode,
                        'tgl_c'=>date('Y-m-d'),
                        'time_c'=>date("h:i:s a")
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
