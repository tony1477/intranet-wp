<?php

namespace App\Controllers\Helpdesk;
use App\Entities\ItHelpdesk;
use App\Controllers\BaseController;
use App\Models\HelpdeskCategoryModel;
use App\Models\DivisiModel;
use App\Models\DepartmentModel;
use App\Models\HelpdeskChoiceModel;
use App\Models\HelpdeskDetailModel;
use App\Models\ItHelpdeskModel;
use App\Models\UserModel;
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
        helper(['helpdesk_helper']);
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

    private function notAllowed()
    {
        $menu = getMenu($user='Admin');
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Create_Ticket']),
			'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
			'modules' => $menu,
            'route'=>'create-helpdesk',
            'menuname' => 'IT_Helpdesk',           
		];
        
        $data['message'] = 'Not Allowed';
        return view('helpdesk/create', $data);
        
    }
    private function listallticket()
    {
        helper(['admin_helper','master_helper','form']);
        $menu = getMenu($user='Admin');
        $listticket = $this->ticketing->getAllDataListTicket();
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Create_Ticket']),
            'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
            'modules' => $menu,
            'route'=>'create-helpdesk',
            'menuname' => 'IT_Helpdesk',
            'listticket' => $listticket,
            'summary_ticket' => [
                'new' => $this->ticketing->getAllSummaryTicketbyType('new')->getRow(),
                'waiting' => $this->ticketing->getAllSummaryTicketbyType('waiting')->getRow(),
                'onprogress' => $this->ticketing->getAllSummaryTicketbyType('progress')->getRow(),
                'done' => $this->ticketing->getAllSummaryTicketbyType('done')->getRow(),
                'cancel' => $this->ticketing->getAllSummaryTicketbyType('cancel')->getRow(),
            ],
        ];
        return view('helpdesk/list_to_it',$data);
    }

    private function listuserticket()
    {
        helper(['admin_helper','master_helper','form']);
        $menu = getMenu($user='Admin');
        if(getWfbyUserid('apphelpdesk',user_id())=='') return $this->notAllowed();
        $listticket = $this->ticketing->getDataListTicket(user_id());
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Create_Ticket']),
            'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
            'modules' => $menu,
            'route'=>'create-helpdesk',
            'menuname' => 'IT_Helpdesk',
            'listticket' => $listticket,
            'summary_ticket' => [
                'new' => $this->ticketing->getSummaryTicketbyType(user_id(),'new')->getRow(),
                'waiting' => $this->ticketing->getSummaryTicketbyType(user_id())->getRow(),
                'onprogress' => $this->ticketing->getSummaryTicketbyType(user_id(),'progress')->getRow(),
                'done' => $this->ticketing->getSummaryTicketbyType(user_id(),'done')->getRow(),
                'cancel' => $this->ticketing->getSummaryTicketbyType(user_id(),'cancel')->getRow(),
            ],
        ];
        return view('helpdesk/list',$data);
    }
    public function listHelpdesk()
    {
        if(has_permission('list-ithelpdesk')) return $this->listallticket();
        return $this->listuserticket();
    }

    public function create()
    {
        helper(['admin_helper','master_helper','form']);
        $menu = getMenu($user='Admin');
        if(getWfbyUserid('apphelpdesk',user_id())=='') return $this->notAllowed();
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

    public function getFirstCategory()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        $list=[];
        try {
            $list = $this->listservice->getChoiceHelpdesk($id=null);
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
                'code' => 400,
                'message' => $e->getMessage()
            );
        }
        return json_encode($arr);
    }
    public function editTicket($id=0)
    {
        // $id = $this->request->getVar('id');       
        if($recordstatus=$this->ticketing->find($id)->recordstatus):
            $mayedit = [1,2,3,5];
            
            $_SESSION['edited_helpdesk'] = false;
            if(!in_array($recordstatus,$mayedit)) return redirect()->to('list-helpdesk',301)->with('message',"Tiket tidak dapat di edit kembali");
        
            $_SESSION['edited_helpdesk'] = true;
            $_SESSION['idhelpdesk'] = $id;
            helper(['admin_helper','master_helper','form','myth_auth_helper']);
            $menu = getMenu($user='Admin');
            $data = $this->ticketing->find($id);
            $list = $this->listservice->getChoiceHelpdesk($id=null);
            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'Edit_Ticket']),
                'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Ticketing']),
                'modules' => $menu,
                'route'=>'edit-helpdesk',
                'menuname' => 'IT_Helpdesk',           
                'listhelpdesk' => $list,
                'data' => $data
            ];
            return view('helpdesk/edit',$data);
        endif;
        return redirect()->back(302)->with('message', "Data Tidak ditemukan");
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

        try {
            $datas = $this->request->getPost();
            $user = $datas['username'];
            $phone = $datas['usertelp'];
            $req = $datas['requesttext'];
            $reason = $datas['reasontext'];
            $dataid = $datas['data_id'];
            $datavalue = $datas['data_value'];
            // $attach = $datas['user_attachment'];
            $send = service('email');
            if(isset($datas['helpdeskid']) && $datas['helpdeskid']!='') $id = $datas['helpdeskid'];
            else $id = 0;
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
                'user_reason' => $reason,
                'id' => $id
            ];
            if($attachment!==null) $data['user_attachment']=$attachment;
            else if(isset($datas['user_attachment']) && $datas['user_attachment']!='') $data['user_attachment'] = $datas['user_attachment'];
            
            if(isset($datas['action']) && $datas['action']=='edit') {
                $save = $this->ticketing->updatedata($data);
            }
            else {
                if(!$save=$this->ticketing->savedata($data)) {
                    $message = lang('Files.Save_Failed');
                    $arr = array(
                        'status' => 'error',
                        'code' => 400,
                        'message'=> $message,
                    );
                    return redirect()->to('salahurls');
                }
            
                // send email to head_of_user
                // $send->setFrom('it@wilianperkasa.com','IT Helpdesk');
                // $send->setTo('martoni.firman@wilianperkasa.com');
                // $send->setSubject('Permohonan Bantuan IT Helpdesk');
                // $send->setMessage('Pesan dalam Email');

                // $email = $this->ticketing->find($save);
                // if($send->send()) $email->isemailcreate = 1;
                // else $email->isemailcreate=0;
                // $this->ticketing->save($email);
            }        
        }
        catch(Exception $e) {
            $arr = array(
                'status' => 'error',
                'code' => 400,
                'message'=> $e->getMessage(),
            );
            return redirect()->to('list-helpdesk')->with('message', $e->getMessage());
            // var_dump($arr);
        }
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
        $addedstatus = false;
        switch($type) {
            case 'new':
                $stt = '1';
                $addedstatus = false;
                break;

            case 'waiting':
                $stt = '2,3';
                $addedstatus = 'listhelpdesk';
                // $addedstatus = false;
                break;

            case 'onprogress':
                $stt='-1,4,5,6,7,8,9,10,11';
                $addedstatus = false;
                break;

            case 'close':
                $stt = '12,13';
                $addedstatus = false;
                break;

            case 'cancel':
                $stt = 0;
                $addedstatus = false;
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
            $data = $this->ticketing->getDataFromDT(user_id(),$stt,$addedstatus); // Example: No filtering applied
            $alldata = $this->ticketing->getSummStatusbyType(user_id(),$stt,$addedstatus);

            // Prepare the data to be sent as a response
            $response = [
                "draw" => intval($draw),
                "recordsTotal" => intval($alldata->getRow()->total),
                "recordsFiltered" => count($data->getResultArray()),
                "data" => [],
                // "list" => getWfbyUserid('listhelpdesk',user_id())
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
            $canedit=true;
            foreach ($pagedData as $row) {
                switch($row['recordstatus']){
                    case '-1':
                        if(getWfAuthByUserid('rejhelpdesk',$row['recordstatus'])) {
                            $action = '<a href="javascript:void(0)"><button type="button" class="btn btn-danger cancel-button waves-effect btn-label waves-light"><i class="fas fa-times label-icon"></i> Cancel Ticket</button></a>';         
                            break;
                        }
                    case '1' :
                        if(getWfAuthByUserid('apphelpdesk',$row['recordstatus'])) {
                            $action = '<a href="edit-helpdesk/'.$row['helpdeskid'].'"><button type="button" class="btn btn-light edit-button waves-effect btn-label waves-light"><i class="far fa-edit label-icon"></i> Edit</button></a>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success approve-button waves-effect btn-label waves-light"><i class="fas fa-check label-icon"></i> Approve</button></a>';         
                            break;
                        }
                    case '2':
                    case '3':
                    case '4':
                        if(getWfAuthByUserid('apphelpdesk',$row['recordstatus'])) {
                            $action = '<a href="edit-helpdesk/'.$row['helpdeskid'].'"><button type="button" class="btn btn-light edit-button waves-effect btn-label waves-light"><i class="far fa-edit label-icon"></i> Edit</button></a>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success approve-button waves-effect btn-label waves-light"><i class="fas fa-check label-icon"></i> Approve</button></a>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-danger reject-button waves-effect btn-label waves-light"><i class="fas fa-times label-icon"></i> Reject</button></a>';
                        }
                        else $action = '';
                        $canedit=false;
                        break;
                    case '5':
						$action = '<a href="edit-helpdesk/'.$row['helpdeskid'].'"><button type="button" class="btn btn-light edit-button waves-effect btn-label waves-light"><i class="far fa-edit label-icon"></i> Edit</button></a>
						<a href="javascript:void(0)"><button type="button" class="btn btn-light feedback-button waves-effect btn-label waves-light"><i class="mdi mdi-reply label-icon"></i> Reply</button></a>';
						break;
                    case '6':
                    // case '7':
                    // case '8':
                        $action = '<a href="javascript:void(0)"><button type="button" class="btn btn-light feedback-button waves-effect btn-label waves-light"><i class="mdi mdi-reply label-icon"></i> Reply</button></a>';
                        break;
                    // case '9':
                    case '10':
                        $action = '<a href="javascript:void(0)"><button type="button" class="btn btn-info confirm-button waves-effect btn-label waves-light"><i class="mdi mdi-reply label-icon"></i> Reply</button></a><a href="javascript:void(0)"><button type="button" class="btn btn-success done-button waves-effect btn-label waves-light"><i class="fas fa-check-double label-icon"></i> Done</button></a>';
                        break;
                    case '11' :
                    case '0' :
                        $action ='';
                        break;
                    default :
                        $action = '';
                        break;
                }
                $response['data'][] = [
                    "id" => $row['helpdeskid'],
                    "tanggal" => date('d/m/Y H:i',strtotime($row['ticketdate'])),
                    "tiketno" => $row['ticketno'],
                    "phone" => $row['user_phone'],
                    "nama" => $row['user_fullname'],
                    "request" => $row['user_request'],
                    "atasan" => $row['head_user'],
                    "attachment" => $row['attachment'], 
                    "level" => $row['level'], 
                    "reason" => $row['user_reason'], 
                    "isfeedback" => $row['isfeedback'],
                    "isconfirmation" => $row['isconfirmation'],
                    "isrevisied" => $row['isrevisied'],
                    "responsetext" => $row['responsetext'],
                    "status" => $row['status'],
                    "detail" => '<a href="javascript:void(0)"><i class="fas fa-info btn btn-secondary rounded-circle"></i> Detail</a>',
                    "action" => $action,
                    "canedit" => $canedit,
                    "iscancel" => $row['iscancel']
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
            try {
                $id = $this->request->getVar('id');
                $userid = user_id();
                $data = ['id'=>$id,'userid'=>$userid];
                $app = $this->approveHelpdesk($data);
                $parentid = $this->ticketing->getParentLevel(user_id());
                $userModel = new UserModel();
                $user = $userModel->find($parentid[0]);
                $mailheads = ['martoni.firman@wilianperkasa.com','it@wilianperkasa.com'];
                $name = $userModel->find(user_id())->getFullname();
                if($user) $mailhead=$user->getEmail();
                $helpdesk = $this->ticketing->find($id);
                $details = new HelpdeskDetailModel();
                // $detail = $details->where('helpdeskid',$id)->findAll();
                $datas = [
                    'nama' => $name,
                    // 'issue' => $detail,
                    'request' => $helpdesk->user_request,
                    'reason' => $helpdesk->user_reason,
                    'ticketno' => $helpdesk->ticketno,
                    'ticketdate' => $helpdesk->ticketdate,
                    // 'email' => $mailhead,
                ];
                $email = service('email');
                if($user && in_array($helpdesk->recordstatus,[2,3])) {
                    $mailto = $mailhead;
                    $fromEmail = env('Email.fromEmail');
                    $fromName = env('Email.fromName');
                    $sent = $email->setFrom($fromEmail,$fromName)
                        ->setTo($mailto)
                        ->setSubject('Permohonan Bantuan IT')
                        ->setMessage(view('email/create_ticket',['data' => $datas]))
                        ->setMailType('html')
                        ->send();
                
                    $isemailcreate=0;
                    if($sent) $isemailcreate = 1;
                    $this->ticketing->update($id,['isemailcreate'=>$isemailcreate]);
                }

                if($helpdesk->recordstatus==12) {
                    $userid = $helpdesk->userid_req;
                    $quser = $userModel->find($userid);
                    $user_email = $quser->getEmail();

                    $spv = $this->ticketing->getParentLevel($userid);
                    $qspv = $userModel->find($parentid[0]);
                    $spv_email = $qspv->getEmail();

                    $man = $this->ticketing->getParentLevel($qspv->id);
                    $qman = $userModel->find($man[0]);
                    $man_email = $qman->getEmail();

                    $mailToUser = [$man_email,$spv_email,$user_email];
                    $mailTo = 'martoni.firman@wilianperkasa.com';

                    $datas = [
                        'user_request' => $helpdesk->user_request,
                        'mailtoUser' => $mailToUser,
                    ];
                    $fromEmail = env('Email.fromEmail');
                    $fromName = env('Email.fromName');
                    $sent = $email->setFrom($fromEmail,$fromName)
                        ->setTo($mailToUser)
                        ->setSubject('Closed Ticket IT Helpdesk')
                        // ->setCC(['purwantoro@wilianperkasa.com','marianto@wilianperkasa.com','it@wilianperkasa.com'])
                        ->setMessage(view('email/close_ticket',['data' => $datas]))
                        ->setMailType('html')
                        ->send();
                }

                $response = [
                    'message' => 'Data Berhasil di Approve',
                    'status' => 'success',
                    'code' => 200
                ];
            }
            catch(Exception $e)
            {
                $response = [
                    'message' => $e->getMessage(),
                    'status' => 'fail',
                    'code' => 400
                ];
            }
            
        }
        return json_encode($response);
    }

    private function approveHelpdesk($data)
    {
        return $this->ticketing->approveHelpdesk($data);
    }

    public function rejectTicket()
    {
        header('Content-Type: application/json');
        if($this->request->getMethod()==='post')
        {
            try {
                $id = $this->request->getVar('id');
                $reason = $this->request->getVar('reason');
                $userid = user_id();
                $data = ['id'=>$id,'userid'=>$userid,'reason'=>$reason];
                $this->ticketing->rejectHelpdesk($data);
                
                // if($user) $mailhead=$user->getEmail();
                $response = [
                    'message' => 'Simpan Data Berhasil',
                    'status' => 'success',
                    'code' => 200
                ];
            }
            catch(Exception $e)
            {
                $response = [
                    'message' => $e->getMessage(),
                    'status' => 'fail',
                    'code' => 400
                ];
            }
            
        }
        return json_encode($response);
    }

    public function confirmTicket()
    {
        header('Content-Type: application/json');
        if($this->request->getMethod()==='post')
        {
            try {
                $id = $this->request->getVar('id');
                $qstatus = $this->ticketing->find($id);
                $status = $qstatus->recordstatus;
                $reason = $this->request->getVar('text');
                $userid = user_id();
                $data = ['id'=>$id,'creator_id'=>$userid,'respondtypeid'=>5,'responsetext'=>$reason,'status'=>$status];
                $this->ticketing->submitFormReviewFeedback($data);
                
                $email = service('email');

                $helpdesk = $this->ticketing->find($id);
                $emailTo = 'it@wilianperkasa.com';
                $datas = [
                    'name' => 'Team IT',
                    'response' => $reason,
                    'title' => $helpdesk->user_request,
                ];
                // $mailto = $mailheads;
                $fromEmail = env('Email.fromEmail');
                $fromName = env('Email.fromName');
                $sent = $email->setFrom($fromEmail,$fromName)
                    ->setTo($emailTo)
                    ->setSubject('Reply Konfirmasi Ticket IT Helpdesk')
                    ->setMessage(view('email/confirmation',['data' => $datas]))
                    ->setMailType('html')
                    ->send();
                // if($user) $mailhead=$user->getEmail();
                $response = [
                    'message' => 'Simpan Data Berhasil',
                    'status' => 'success',
                    'code' => 200
                ];
            }
            catch(Exception $e)
            {
                $response = [
                    'message' => $e->getMessage(),
                    'status' => 'fail',
                    'code' => 400
                ];
            }
        }
        return json_encode($response);
    }

    public function feedbackTicket()
    {
        header('Content-Type: application/json');
        if($this->request->getMethod()==='post')
        {
            try {
                $id = $this->request->getVar('id');
                $qstatus = $this->ticketing->find($id);
                $status = $qstatus->recordstatus;
                $reason = $this->request->getVar('text');
                $userid = user_id();
                $data = ['id'=>$id,'creator_id'=>$userid,'respondtypeid'=>3,'responsetext'=>$reason,'status'=>$status];
                $this->ticketing->submitFormReviewFeedback($data);
                
                // if($user) $mailhead=$user->getEmail();
                $email = service('email');

                $helpdesk = $this->ticketing->find($id);
                $emailTo = 'it@wilianperkasa.com';
                $datas = [
                    'name' => 'Team IT',
                    'response' => $reason,
                    'title' => $helpdesk->user_request,
                ];
                // $mailto = $mailheads;
                $fromEmail = env('Email.fromEmail');
                $fromName = env('Email.fromName');
                $sent = $email->setFrom($fromEmail,$fromName)
                    ->setTo($emailTo)
                    ->setSubject('Reply Feedback Ticket IT Helpdesk')
                    ->setMessage(view('email/feedback',['data' => $datas]))
                    ->setMailType('html')
                    ->send();

                $response = [
                    'message' => 'Simpan Data Berhasil',
                    'status' => 'success',
                    'code' => 200
                ];
            }
            catch(Exception $e)
            {
                $response = [
                    'message' => $e->getMessage(),
                    'status' => 'fail',
                    'code' => 400
                ];
            }
        }
        return json_encode($response);
    }
}