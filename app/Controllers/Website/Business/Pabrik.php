<?php

namespace App\Controllers\Website\Business;

use App\Controllers\BaseController;
use App\Models\Website\PageModel;

class Pabrik extends BaseController
{
    private $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\Website\Business\PabrikModel();
        // $this->profile = new \App\Entities\Profile;
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        // $pageModel = new PageModel;
        $menu = getMenu($user='Admin');
        $mill = $this->model->getData()->getResult('\App\Entities\Pabrik');
        // $page = $pageModel->findAll();
        //$divisi = getDivisi();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Pabrik']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Website', 'li_2' => 'Pabrik']),
			'modules' => $menu,
            'route'=>'bisnis/pabrik',
            'menuname' => 'Pabrik',
            'data' => $mill,
            'modal' => 'modal-lg',
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Title','Content','Order'),
            //'crudScript' => view('partials/script/department',['menuname' => 'Department']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'articleid' => array('type'=>'hidden','idform'=>'id','field'=>'articleid'), 
                'title' => array(
                    'label'=>'Title',
                    'field'=>'title',
                    'type'=>'text',
                    'idform'=>'judul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'content' => array(
                    'label'=>'Content',
                    'field'=>'content',
                    'type'=>'textarea',
                    'idform'=>'isi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-12 col-xl-12'
                ),
                'position' => array(
                    'label' => 'Order',
                    'field' => 'position',
                    'type' => 'number',
                    'idform' => 'urutan',
                    'form-class' => 'form-control',
                    'style' => 'col-md-8 col-xl-8',
                )
            ]
		];
		
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
                $this->model->where('articleid',$id)->delete();
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
                    'articleid' => $datas['id'],
                    'title' => $datas['judul'],
                    'pageid' => 8   ,
                    'order' => $datas['urutan'],
                    'content' => $datas['isi'],
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
            } 
            catch (\Exception $e) {
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
