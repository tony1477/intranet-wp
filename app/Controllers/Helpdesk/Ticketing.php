<?php

namespace App\Controllers\Helpdesk;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\HelpdeskCategoryModel;
use App\Models\DivisiModel;
use App\Models\DepartmentModel;
use App\Models\HelpdeskChoiceModel;
use App\Models\ItHelpdeskModel;
use CodeIgniter\Files\File;
use Exception;

class Ticketing extends BaseController
{
    private $ticketing;
    private $category;
    private $divisi;
    private $department;
    private $listservice;
    private $model;
    public function __construct()
    {
        $this->ticketing = new HelpdeskModel();
        $this->category = new HelpdeskCategoryModel();
        $this->listservice = new HelpdeskChoiceModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $ticketing = $this->ticketing->getListHelpdesk()->getResult();
        $categories = $this->category->findAll();
        $divisi = $divisi = getDivisi();
        $department = getDepartment();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Ticketing']),
			'page_title' => view('partials/page-title', ['title' => 'Ticketing', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
			'modules' => $menu,
            'route'=>'list-helpdesk',
            'menuname' => 'IT_Helpdesk',
            'data' => $ticketing,
            'bpo' => true,
            'modal' => 'modal-lg',
            'columns_hidden' => array('Action'),
            'columns' => array('Id','Fullname','TicketDate','Name_Category','No_Telp','Location','Name_Department','Email_Head','Issue','Status'),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'helpdeskid' => array('type'=>'hidden','idform'=>'id','field'=>'helpdeskid'),
                'nama' => array(
                    'label'=>'Fullname',
                    'field'=>'userid',
                    'type'=>'text',
                    'idform'=>'nama_request',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'tgl' => array(
                    'label'=>'Date_Request',
                    'field'=>'ticketdate',
                    'type'=>'text',
                    'idform'=>'tgl_request',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'telp' => array(
                    'label'=>'No_Telp',
                    'field'=>'notelp',
                    'type'=>'text',
                    'idform'=>'no_telp',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'lokasi' => array(
                    'label'=>'Location',
                    'field'=>'iddivisi',
                    'type'=>'select',
                    'idform'=>'idlokasi',
                    'form-class'=>'form-select',
                    'style' => 'col-md-10 col-xl-10',
                    'options' => array(
                        'list' => $divisi,
                        'id' => 'Id',
                        'value' => 'Name_Divisi',
                    ),
                ),
                'departemen' => array(
                    'label'=>'Name_Department',
                    'field'=>'iddepartment',
                    'type'=>'select',
                    'idform'=>'iddepartemen',
                    'form-class'=>'form-select',
                    'style' => 'col-md-10 col-xl-10',
                    'options' => array(
                        'list' => $department,
                        'id' => 'Id',
                        'value' => 'Name_Department',
                    ),
                ),
                'email' => array(
                    'label'=>'Email_Head',
                    'field'=>'emailatasan',
                    'type'=>'text',
                    'idform'=>'email_atasan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'kendala' => array(
                    'label'=>'Issue',
                    'field'=>'issue',
                    'type'=>'textarea',
                    'idform'=>'isu',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
            ]
            
		];
		
		return view('master/m_view', $data);
    }

    public function create()
    {
        helper(['admin_helper','master_helper','form']);
        $menu = getMenu($user='Admin');
        $list = $this->listservice->getChoiceHelpdesk($id=null);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Create_Ticket']),
			'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
			'modules' => $menu,
            'route'=>'create-helpdesk',
            'menuname' => 'IT_Helpdesk',           
            'listhelpdesk' => $list,
		];
		
		return view('helpdesk/create', $data);
    }

    public function form($user)
    {
        if ($this->request->getMethod(true)!=='POST') return redirect()->to('create-helpdesk');
        if(csrf_hash() !== $this->request->getVar(csrf_token())) return redirect()->to('create-helpdesk');

        $this->model = new ItHelpdeskModel();
        $datas = $this->request->getPost();
        $user = $datas['username'];
        $phone = $datas['usertelp'];
        $req = $datas['requesttext'];
        $reason = $datas['reasontext'];
        
        /* 
        $type = $datas['type'];
        switch($type) {
            case 1:
                $filename = 'hsm-4';
                break;

            case 2:
                $filename = 'hsm-10';
                break;
            
            case 3:
                $filename = 'hsm-12';
                break;

            case 4:
                $filename = 'hsm-15';
                break;

            case 5:
                $filename = 'hsd-7';
                break;

            default:
                $filename = 'hsm-15';
                break;
        } 
        */
        helper(['admin_helper','master_helper','myth_auth_helper']);
        $files = $this->request->getFiles('formFile');
        $attachment=null;
        if(!$files['formFile']->hasMoved() && $files['formFile']->isValid()) {
            //$filepath = WRITEPATH . 'uploads/' . $files['formFile']->store();
            $nameFile= strlen($files['formFile']->getName())<100 ? $files['formFile']->getName() : $files['formFile']->getRandomName();
            $files['formFile']->store(ROOTPATH.'public/assets/protected/helpdesk',$nameFile);      
            $attachment=$nameFile;
        }
        
        // save to db
        $data = [
            'ticketdate' => date('Y-m-d H:i:s'),
            'userid_req' => get_id($user),
            'user_phone' => $phone,
            'categoryid' => '',
            'categoryname' => '',
            'user_request' => $req,
            'user_reason' => $reason
        ];
        if($attachment!==null) $data['user_attachment']=$attachment;
        var_dump($data);
        // if($this->model->save($data)) echo 'berhasil';
        // $menu = getMenu($user='Admin');
        // $data = [
        //     'title_meta' => view('partials/title-meta', ['title' => 'IT_Form']),
		// 	'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
		// 	'modules' => $menu,
        //     'route'=>'create-helpdesk',
        //     'menuname' => 'IT_Helpdesk',
        //     'data' => $datas,
        //     'filename' => $filename,
        // ];
        // return view('helpdesk/'.$filename,$data);
    }

    public function nextquestion()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        $list=[];
        try {
            $datas = (array) $this->request->getVar('data');
            $id = $datas['opt'];
            $list = $this->listservice->getChoiceHelpdesk($id);

            // check if list was last choice
            if(count($list)===0) $list=['last'=>1];

            $message = lang('Files.Save_Success');
            $arr = array(
                'status' => 'success',
                'code' => 200,
                'message'=> $message,
                'data' => $list
            );
        }
        catch(Exception $e) {
            $arr = array(
                'code' => '400',
                'message'=> $e->getMessage(),
            );
        }
        return json_encode($arr);
    }

    public function prevquestion()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        try {
            $datas = (array) $this->request->getVar('data');
            $id = $datas['opt'];
            $list = $this->listservice->getChoiceHelpdesk($id);
            

            $message = lang('Files.Save_Success');
            $arr = array(
                'status' => 'success',
                'code' => 200,
                'message'=> $message,
                'data' => $list
            );
        }
        catch(Exception $e) {
            $arr = array(
                'code' => '400',
                'message'=> $e->getMessage(),
            );
        }
        return json_encode($arr);
    }
}
