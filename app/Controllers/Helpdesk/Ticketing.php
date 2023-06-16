<?php

namespace App\Controllers\Helpdesk;
use App\Entities\ItHelpdesk;
use App\Controllers\BaseController;
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
        $this->ticketing = new ItHelpdeskModel();
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

    public function listHelpdesk()
    {
        helper(['admin_helper','master_helper','form']);
        $menu = getMenu($user='Admin');
        $listticket = $this->ticketing->getDataListTicket(user_id());
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Create_Ticket']),
			'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
			'modules' => $menu,
            'route'=>'create-helpdesk',
            'menuname' => 'IT_Helpdesk',
            'listticket' => $listticket
		];
        return view('helpdesk/list',$data);
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

        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );

        $datas = $this->request->getPost();
        $user = $datas['username'];
        $phone = $datas['usertelp'];
        $req = $datas['requesttext'];
        $reason = $datas['reasontext'];
        $dataid = $datas['data_id'];
        $datavalue = $datas['data_value'];
        $send = service('email');
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
            $files['formFile']->move(ROOTPATH.'public/assets/protected/helpdesk',$nameFile);
            $attachment=$files['formFile']->getName();
        }
        
        // save to db
        $data = [
            'ticketdate' => date('Y-m-d H:i:s'),
            'userid_req' => get_id($user),
            'user_phone' => $phone,
            'categoryid' => $dataid,
            'categoryname' => $datavalue,
            'user_request' => $req,
            'user_reason' => $reason
        ];
        if($attachment!==null) $data['user_attachment']=$attachment;
        if(!$save=$this->ticketing->savedata($data)) {
            $message = lang('Files.Save_Failed');
            $arr = array(
                'status' => 'error',
                'code' => 400,
                'message'=> $message,
            );
            return redirect()->to('salahurl');
        }
        
        // send email to head_of_user
        $send->setFrom('it@wilianperkasa.com','IT Helpdesk');
        $send->setTo('martoni.firman@wilianperkasa.com');
        $send->setSubject('Permohonan Bantuan IT Helpdesk');
        $send->setMessage('Pesan dalam Email');

        $email = $this->ticketing->find($save);
        if($send->send()) $email->isemailcreate = 1;
        else $email->isemailcreate=0;
        $this->ticketing->save($email);        

        $message = lang('Files.Save_Success');
        $arr = array(
            'status' => 'success',
            'code' => 200,
            'message'=> $message,
        );
        return redirect()->to('list-helpdesk');
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

    public function listTicket(string $type) :?string
    {
        header('Content-Type: application/json');
        switch($type) {
            case 'new':
                $stt = 1;
                break;

            case 'waiting':
                $stt = '2,3';
                break;

            case 'onprogress':
                $stt='4,5,6,7,8,9';
                break;

            case 'close':
                $stt = 10;
                break;

            case 'cancel':
                $stt = 0;
                break;
            
            default:
                $stt = '1';
                break;
        }
        // Process the AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['draw'])) {
            $draw = $_POST['draw'];
            $start = $_POST['start'];
            $length = $_POST['length'];
            $searchValue = $_POST['search']['value'];
            $filteredData = [];
            
            // Apply any necessary filtering or searching to your data
            $data = $this->ticketing->getDataFromDT(user_id(),$stt); // Example: No filtering applied
            $alldata = $this->ticketing->getSummStatusbyType(user_id(),$stt);

            // Prepare the data to be sent as a response
            $response = [
                "draw" => intval($draw),
                "recordsTotal" => intval($alldata->getRow()->total),
                "recordsFiltered" => count($data->getResultArray()),
                "data" => []
            ];

            if (!empty($searchValue)) {
                foreach ($data->getResultArray() as $row) {
                    if (stripos($row['ticketdate'], $searchValue) !== false || stripos($row['categoryname'], $searchValue) !== false || stripos($row['head_user'], $searchValue) !== false || stripos($row['user_request'], $searchValue) !== false) {
                        $filteredData[] = $row;
                    }
                }
            } else {
                $filteredData = $data->getResultArray(); // If no search value, use the original data
            }           

            // Slice the data based on the requested start and length
            $pagedData = array_slice($filteredData, $start, $length);

            // Loop through the sliced data and format it for the response
            foreach ($pagedData as $row) {
                $response['data'][] = [
                    "id" => $row['helpdeskid'],
                    "tanggal" => date('d/m/Y H:i',strtotime($row['ticketdate'])),
                    "phone" => $row['user_phone'],
                    "nama" => $row['user_fullname'],
                    "request" => $row['user_request'],
                    "atasan" => $row['head_user'],
                    "attachment" => $row['attachment'], 
                    "level" => $row['level'], 
                    "reason" => $row['user_reason'], 
                    "detail" => '<a href="javascript:void(0)"><i class="fas fa-info btn btn-secondary rounded-circle"></i> Detail</a>',
                    "action" => '<a href="javascript:void(0)"><button type="button" class="btn btn-light edit-button waves-effect btn-label waves-light"><i class="far fa-edit label-icon"></i> Edit</button></a> <a href="javascript:void(0)"><button type="button" class="btn btn-success approve-button waves-effect btn-label waves-light"><i class="fas fa-check label-icon"></i> Approve</button></a>'
                ];
            }
            
            // Send the JSON response
            return json_encode($response);
        }
    }

    public function approveTicket()
    {
        header('Content-Type: application/json');
        if($this->request->getMethod()==='post')
        {
            $id = $this->request->getVar('id');
            $userid = user_id();
            $data = ['id'=>$id,'userid'=>$userid];
            $app = $this->approveHelpdesk($data)->getResult();
            
        }
    }

    private function approveHelpdesk($data)
    {
        return $this->ticketing->approveHelpdesk($data);
    }
}
