<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class Divisi extends BaseController
{
    public function __construct()
    {
        $this->model = new \App\Models\DivisiModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $divisi = getDivisi();
        $group = getGroupDivisi();
        //$submenu = getSubmenu($moduleid=0);
        
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Divisi']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Divisi']),
			'modules' => $menu,
            'route'=>'divisi',
            'menuname' => 'Divisi',
            'data' => $divisi,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_GroupDivisi','Code_Divisi','Name_Divisi','Name_Divisi2','User_Created','User_Modified'),
            'crudScript' => view('partials/script/divisi',['menuname' => 'Divisi']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'iddivisi' => array('type'=>'hidden','idform'=>'id','field'=>'iddivisi'), 
                'iddivisigroup' => array(
                    'label'=>'Name_GroupDivisi',
                    'field'=>'iddivisigroup',
                    'type'=>'select',
                    'idform'=>'idgroup',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $group,
                        'id' => 'Id',
                        'value' => 'Name_GroupDivisi',
                    ),
                ),
                'div_kode' => array(
                    'label'=>'Code_Divisi',
                    'field'=>'div_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'div_nama' => array(
                    'label'=>'Name_Divisi',
                    'field'=>'div_nama',
                    'type'=>'text',
                    'idform'=>'namadivisi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'div_nama2' => array(
                    'label'=>'Name_Divisi2',
                    'field'=>'div_nama2',
                    'type'=>'text',
                    'idform'=>'namadivisi2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		// print_r($group);
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
                $this->model->where('iddivisi',$id)->delete();
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
                    'iddivisigroup' => $datas['idgroup'],
                    'div_kode' => $datas['kode'],
                    'div_nama' => $datas['namadivisi'],
                    'div_nama2' => $datas['namadivisi2'],
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
                    'code' => 400
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }
}
