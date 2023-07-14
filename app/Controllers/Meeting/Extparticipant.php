<?php

namespace App\Controllers\Meeting;

use App\Controllers\BaseController;
use App\Models\ExtParticipantModel;

class Extparticipant extends BaseController
{
    public $model = null;
    public function __construct()
    {
        $this->model = new ExtParticipantModel();
    }
 
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');        
        $participants = $this->model->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'External_Participant']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'External_Participant']),
			'modules' => $menu,
            'route' => 'ext-participant',
            'menuname' => 'External_Participant',
            'data' => $participants,
            // 'customsearch' => 'master/_partials/usergroup',
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name','Description','Email','Requisite','Status'),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'participant' => array('type'=>'hidden','idform'=>'id','field'=>'participantid'),
                'name' => array(
                    'label'=>'Name',
                    'field'=>'name',
                    'type'=>'text',
                    'idform'=>'nama',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'desc' => array(
                    'label'=>'Description',
                    'field'=>'description',
                    'type'=>'text',
                    'idform'=>'asal',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'emails' => array(
                    'label'=>'Email',
                    'field'=>'email',
                    'type'=>'text',
                    'idform'=>'alamatemail',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'requisite' => array(
                    'label'=>'Requisite',
                    'field'=>'requisite',
                    'type'=>'text',
                    'idform'=>'kebutuhan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'status' => array(
                    'label'=>'Status',
                    'field'=>'status',
                    'type'=>'switch',
                    'idform'=>'isaktif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                
            ],
		];
        return view('master/m_view',$data);
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
                $this->model->where('participantid',$id)->delete();
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
                    'name' => $datas['nama'],
                    'description' => $datas['asal'],
                    'email' => $datas['alamatemail'],
                    'requisite' => $datas['kebutuhan'],
                    'recordstatus' => ($datas['isaktif']=='Y' ? 1 : 0)
                ];
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
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