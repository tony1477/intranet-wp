<?php

namespace App\Controllers\Helpdesk;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\HelpdeskCategoryModel;
use App\Models\DivisiModel;
use App\Models\DepartmentModel;

class Ticketing extends BaseController
{
    private $ticketing;
    private $category;
    private $divisi;
    private $department;
    public function __construct()
    {
        $this->ticketing = new HelpdeskModel();
        $this->category = new HelpdeskCategoryModel();
        // $this->divisi = new DivisiModel();
        // $this->department = new DepartmentModel();
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
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $limit = 8;
        $offset = 0;
        // $gallery = $this->gallery->where(['gallerytype'=>1,'categoryid'=>$id,'status'=>1]);
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Create_Ticket']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
			'modules' => $menu,
            'route'=>'create-helpdesk',
            'menuname' => 'IT_Helpdesk',
            // 'data' => $gallery->paginate($limit,'gallery'),
            // 'pager' => $gallery->pager,
            // 'categoryid' => $id,
		];
		
		return view('helpdesk/create', $data);
    }
}
