<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class Position extends BaseController
{
    public $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\PositionModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $position = getPosition();
        //$submenu = getSubmenu($moduleid=0);
		// $data = [
		// 	'title_meta' => view('partials/title-meta', ['title' => 'Group_Divisi']),
		// 	'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Group_Divisi']),
		// 	'modules' => $menu,
        //     'groupdivisi' => $getgroupdivisi,
		// ];
		
		// return view('master/grupdivisi', $data);

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Position']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'Position']),
			'modules' => $menu,
            'route' => 'jabatan',
            'menuname' => 'Position',
            'data' => $position,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','No_Urut','Code_Position','Name_Position','Name_Position2','User_Created','User_Modified'),
            // 'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idjabatan' => array('type'=>'hidden','idform'=>'id','field'=>'idjabatan'), 
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
                'nomor' => array(
                    'label'=>'No_Urut',
                    'field'=>'no_urut',
                    'type'=>'text',
                    'idform'=>'urutan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'jab_kode' => array(
                    'label'=>'Code_Position',
                    'field'=>'jab_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'jab_nama' => array(
                    'label'=>'Name_Position',
                    'field'=>'jab_nama',
                    'type'=>'text',
                    'idform'=>'namajabatan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'jab_nama2' => array(
                    'label'=>'Name_Position2',
                    'field'=>'jab_nama2',
                    'type'=>'text',
                    'idform'=>'namajabatan2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		// var_dump($position);
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
                $this->model->where('idjabatan',$id)->delete();
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
                    'no_urut' => $datas['urutan'],
                    'jab_kode' => $datas['kode'],
                    'jab_nama' => $datas['namajabatan'],
                    'jab_nama2' => $datas['namajabatan2'],
                    'user_m' => user()->username,
                    'tgl_m'=>date('Y-m-d'),
                    'time_m'=>date("h:i:s a")
                ];
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        'user_c' => user()->username,
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
