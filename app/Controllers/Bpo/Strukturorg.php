<?php

namespace App\Controllers\Bpo;

use App\Controllers\BaseController;

class Strukturorg extends BaseController
{
    public function __construct()
    {
        $this->model = new \App\Models\StrukturorgModel();
    }
    
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $structure = getStrukturOrg();
        $group = getDepartment();
        //$submenu = getSubmenu($moduleid=0);
        
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Structure-Org']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Structure-Org']),
			'modules' => $menu,
            'route'=>'struktur-organisasi',
            'menuname' => 'Structure-Org',
            'data' => $structure,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_Department','Code_Structureorg','Name_Structureorg','Name_Structureorg2','Name_File','Cover','Publish','Status','Cover2'),
            //'crudScript' => view('partials/script/divisi',['menuname' => 'Divisi']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idstrukturorg' => array('type'=>'hidden','idform'=>'id','field'=>'iddivisi'), 
                'iddepartment' => array(
                    'label'=>'Name_Department',
                    'field'=>'iddepartment',
                    'type'=>'select',
                    'idform'=>'idgroup',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $group,
                        'id' => 'Id',
                        'value' => 'Name_Department',
                    ),
                ),
                'stg_kode' => array(
                    'label'=>'Code_Structureorg',
                    'field'=>'stg_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'stg_nama' => array(
                    'label'=>'Name_Structureorg',
                    'field'=>'stg_nama',
                    'type'=>'text',
                    'idform'=>'namastg',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'stg_nama2' => array(
                    'label'=>'Name_Structureorg2',
                    'field'=>'stg_nama2',
                    'type'=>'text',
                    'idform'=>'namastg2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'stg_nmfile' => array(
                    'label'=>'Name_File',
                    'field'=>'stg_file',
                    'type'=>'text',
                    'idform'=>'stgfile',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'stg_cover' => array(
                    'label'=>'Cover',
                    'field'=>'stg_cover',
                    'type'=>'text',
                    'idform'=>'stgcover',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'stg_publish' => array(
                    'label'=>'Publish',
                    'field'=>'stg_publish',
                    'type'=>'text',
                    'idform'=>'stgpublish',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'stg_aktif' => array(
                    'label'=>'Status',
                    'field'=>'stg_aktif',
                    'type'=>'text',
                    'idform'=>'stgstatus',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'stg_default' => array(
                    'label'=>'Cover2',
                    'field'=>'stg_default',
                    'type'=>'text',
                    'idform'=>'stgcover2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		
		return view('master/m_view', $data);
		// var_dump($group);
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
