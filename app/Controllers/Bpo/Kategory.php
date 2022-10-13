<?php

namespace App\Controllers\Bpo;

use App\Controllers\BaseController;

class Kategory extends BaseController
{
    public $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\KategoryModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $kategory = getKategory();
        //$submenu = getSubmenu($moduleid=0);
		// $data = [
		// 	'title_meta' => view('partials/title-meta', ['title' => 'Group_Divisi']),
		// 	'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Group_Divisi']),
		// 	'modules' => $menu,
        //     'groupdivisi' => $getgroupdivisi,
		// ];
		
		// return view('master/grupdivisi', $data);

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Category']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Category']),
			'modules' => $menu,
            'route' => 'kategory',
            'menuname' => 'Category',
            'data' => $kategory,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Code_Category','Name_Category','Name_Category2'),
            //'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idkategory' => array('type'=>'hidden','idform'=>'id','field'=>'idkategory'), 
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
                'kat_kode' => array(
                    'label'=>'Code_Category',
                    'field'=>'kat_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama' => array(
                    'label'=>'Name_Category',
                    'field'=>'kat_nama',
                    'type'=>'text',
                    'idform'=>'namakategory',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama2' => array(
                    'label'=>'Name_Category2',
                    'field'=>'kat_nama2',
                    'type'=>'text',
                    'idform'=>'namakategory2',
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
                $this->model->where('idkategory',$id)->delete();
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
                    'gdiv_kode' => $datas['kode'],
                    'kat_nama' => $datas['namakategory'],
                    'kat_nama2' => $datas['namakategory2'],
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
