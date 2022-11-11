<?php

namespace App\Controllers\Website\About;

use App\Controllers\BaseController;
use App\Models\Website\PageModel;

class Manajemen extends BaseController
{
    private $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\Website\About\ManajemenModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        // $pageModel = new PageModel;
        $menu = getMenu($user='Admin');
        $config = config('CustomConfig');
        // $manajemen = $this->model->getData()->getResult('App\Entities\Manajemen');
        $manajemen = $this->model->findAll();
        //$divisi = getDivisi();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Manajemen']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Website', 'li_2' => 'Manajemen']),
			'modules' => $menu,
            'route'=>'tentang/manajemen',
            'menuname' => 'Manajemen',
            'data' => $manajemen,
            'modal' => 'modal-lg',
            'link' => array('Photo'),
            'urlLink' => array('Photo' => $config->getPublicImg('team')),
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name','Position','Description','User_Created','User_Modified'),
            //'crudScript' => view('partials/script/department',['menuname' => 'Department']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'articleid' => array('type'=>'hidden','idform'=>'id','field'=>'managementid'), 
                'profilename' => array(
                    'label'=>'Name',
                    'field'=>'profilename',
                    'type'=>'text',
                    'idform'=>'nama',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'profileposition' => array(
                    'label'=>'Position',
                    'field'=>'profileposition',
                    'type'=>'text',
                    'idform'=>'posisi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                // 'photo' => array(
                //     'label' => 'Photo',
                //     'field' => 'profilephoto',
                //     'type' => 'text',
                //     'url' => $config->getUrlWebsite(),
                //     'idform' => 'foto',
                //     'form-class' => 'form-control',
                //     'style' => 'col-md-8 col-xl-8',
                // ),
                'profiledesc' => array(
                    'label' => 'Description',
                    'field' => 'profiledesc',
                    'type' => 'textarea',
                    'idform' => 'deskripsi',
                    'form-class' => 'form-control',
                    'style' => 'col-md-12 col-xl-12',
                ),
            ]
		];
		// var_dump($strategi);
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
                $this->model->where('managementid',$id)->delete();
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
                    'managementid' => $datas['id'],
                    'profilename' => $datas['nama'],
                    'profileposition' => $datas['posisi'],
                    // 'profilephoto' => $datas['foto'],
                    'profiledesc' => $datas['deskripsi'],
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
                    'code' => 400
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }
}
