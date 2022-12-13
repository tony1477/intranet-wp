<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;
use Myth\Auth\Config\Auth as AuthConfig;

class Users extends BaseController
{
    public $model = null;
    protected $config;
    public function __construct()
    {
        $this->model = new \App\Models\UsersModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $users = getUsers();
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
            'columns' => array('Action','Id','Name_User','Fullname','Email','Pwd_User','Photo_User','Active'),
            'button' => array(
                'Active' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                    // 'icon' => 'bx bx-check-double label-icon',
                ],
            ),
            'custombutton' => array(
                'Button1' => [
                    'toggle' => true,
                    'id' => 'docByUser',
                    'name' => 'docByUser',
                    'title' => lang('Files.DocByUser'),
                    'class' => 'btn btn-soft-primary waves-effect waves-light btn-sm',
                    'icon-class' => 'dripicons-document',
                    'loadfile' => 'master/_partials/docbyuser',
                    'scriptfile' => 'master/_partials/script/docbyuser',

                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'iduser' => array('type'=>'hidden','idform'=>'id','field'=>'iduser'), 
                'username' => array(
                    'label'=>'Name_User',
                    'field'=>'username',
                    'type'=>'text',
                    'idform'=>'nama',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'fullname' => array(
                    'label'=>'Fullname',
                    'field'=>'fullname',
                    'type'=>'text',
                    'idform'=>'namalengkap',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'email' => array(
                    'label'=>'Email',
                    'field'=>'email',
                    'type'=>'email',
                    'idform'=>'emailuser',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'pwd' => array(
                    'label' => 'Pwd_User',
                    'field' => 'hash_password',
                    'type' => 'password',
                    'idform' => 'userpwd',
                    'form-class' => 'form-control',
                    'style' => 'col-md-8 col-xl-8',   
                ),
                'user_fhoto' => array(
                    'label'=>'Photo_User',
                    'field'=>'user_image',
                    'type'=>'text',
                    'idform'=>'photouser',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'user_blokir' => array(
                    'label'=>'Active',
                    'field'=>'active',
                    'type'=>'switch',
                    'idform'=>'statususer',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8',
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
                // $this->model->where('iddivisigroup',$id)->delete();
                // if($this->model->find($id)) {
                //     $arr = array(
                //         'status' => 'warning',
                //         'code' => 200,
                //         'message' => 'Terjadi kesalahan dalam menghapus data',
                //         // 'data' => $this->model->findAll()
                //     );
                //     return json_encode($arr);
                // }
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
        $hash=null;
        if($this->request->isAJAX()) {
            try {
                $this->config = config('Auth');
                $user = new \Myth\Auth\Entities\User();
                $datas = $this->request->getVar('data');
                if(is_object($datas)) {
                    $datas = (array) $datas;
                }

                if($datas['userpwd']!=='********'):
                    $user->setPassword($datas['userpwd']);
                    $hash = $user->password_hash;
                else:
                    $id = $this->model->find($datas['id']);
                    $hash = $id->password_hash;
                endif;

                $data = [
                    'username' => $datas['nama'],
                    'fullname' => $datas['namalengkap'],
                    'email' => ($datas['emailuser'] == '' ? null : $datas['emailuser']),
                    'active' => ($datas['statususer'] == 'Y' ? 1 : 0),
                    // 'user_m' => $this->session->user_kode,
                    // 'tgl_m'=>date('Y-m-d'),
                    // 'time_m'=>date("h:i:s a")
                ];
                if($datas['id']!=='') {
                    $newdata = ['id' => $datas['id'], 'password_hash' => $hash];
                    $data = array_merge($data,$newdata);
                    $this->model->save($data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        // 'user_c' => $this->session->user_kode,
                        // 'tgl_c'=>date('Y-m-d'),
                        // 'time_c'=>date("h:i:s a")
                        'password_hash' => $hash,
                    ];
                    $data = array_merge($data,$newdata);
                    $this->model->withGroup($this->config->defaultUserGroup);
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

    public function uploadImage()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 400,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        if($this->request->isAJAX()) {
            try {

                $loc = getcwd().'/assets/images/users';
                // var_dump($_FILES);
                $filename = $_FILES['file']['name'];
                $newname = user()->username.'-'.$filename;

                if(move_uploaded_file($_FILES['file']['tmp_name'], $loc.'/'.$newname)):
                    $data = ['user_image' => $newname];
                    $this->model->update(user()->id,$data);
                    $arr = array(
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'OK'
                    );
                endif;
            } catch (\Exception $e) {
                $arr = array(
                    'status' => $e->getMessage(),
                    'code' => 400
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }
    
    public function docbyuser()
    {
        $username = $_POST['username'];
        $query = $this->model->getDocbyUser($username);
        $result = [
            'status' => 'success',
            'code' => 200,
            'nmuser' => $username,
            'data' => $query
        ];

        return json_encode($result);
    }

    public function saveDocByUser()
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
                    'username' => $datas['nmuser'],
                    'iddokumen' => $datas['iddokumen'],
                    // 'user_m' => $this->session->user_kode,
                    // 'tgl_m'=>date('Y-m-d'),
                    // 'time_m'=>date("h:i:s a")
                ];
                                
                $this->model->postDocUser($data);

                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'OK'
                );
            } catch (\Exception $e) {
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
