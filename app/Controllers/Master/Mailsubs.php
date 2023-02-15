<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class Mailsubs extends BaseController
{
    public $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\ArticleSubsModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $mailsubs = $this->model->findAll();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Department']),
			'page_title' => view('partials/page-title', ['title' => 'master_data', 'li_1' => 'Intranet', 'li_2' => 'Mailsubs']),
			'modules' => $menu,
            'route'=>'mailsubs',
            'menuname' => 'Newsletter',
            'data' => $mailsubs,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Fullname','Email','Subs_Date','Status'),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idsubs' => array('type'=>'hidden','idform'=>'id','field'=>'subs_id'), 
                'nama' => array(
                    'label'=>'Fullname',
                    'field'=>'fullname',
                    'type'=>'text',
                    'attr' => 'readonly',
                    'idform'=>'namalengkap',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10',
                ),
                'email' => array(
                    'label'=>'Email',
                    'field'=>'subs_email',
                    'type'=>'text',
                    'attr' => 'readonly',
                    'idform'=>'emailsubs',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'subsdate' => array(
                    'label'=>'Subs_Date',
                    'field'=>'subs_date',
                    'type'=>'text',
                    'attr' => 'readonly',
                    'idform'=>'tanggalsubs',
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
            ]
		];
		
		return view('master/m_view', $data);
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
                    'status' => ($datas['isaktif']=='Y' ? 1 : 0),
                ];
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
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
