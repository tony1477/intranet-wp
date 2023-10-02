<?php

namespace App\Controllers\Meeting;

use App\Controllers\BaseController;
use App\Models\NotulenMeetingModel;
use App\Libraries\PdfLib;
use App\Models\MeetingScheduleModel;
use DateTime;
use Exception;

class NotulenMeeting extends BaseController
{
    private $model;
    private $meeting;
    protected $pdf;
    public function __construct()
    {
        $this->model = new NotulenMeetingModel();
        $this->meeting = new MeetingScheduleModel();
    }
    
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');        
        $peserta = $this->model->findAll();
        $peminjamanbyUser = $this->model->getMeetingbyUser(user_id())->getResult();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Notulen_Meeting']),
			'page_title' => view('partials/page-title', ['title' => '', 'li_1' => 'Intranet', 'li_2' => 'Notulen_Meeting']),
			'modules' => $menu,
            'route' => 'notulen',
            'menuname' => 'Notulen_Meeting',
            'dataSrc' => "master/_partials/script/notulen.js",
            "additionalScript" => "partials/script/notulendetail",
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Agenda','Title','Start_Time','End_Time','Notulen','Head_Notulen','Key_Person','Status','Detail'),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'detail' => [
                'access' => true,
                'view' => view('meeting-room/detail-notulen'),
                'idmodal' => 'detailnotulen',
                'classname' => 'detailnotulen',
            ],
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'notulenid' => array('type'=>'hidden','idform'=>'id','field'=>'notulenid'),
                'agenda' => array(
                    'label'=>'Agenda',
                    'field'=>'idpeminjaman',
                    'type'=>'select',
                    'idform'=>'agenda',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $peminjamanbyUser,
                        'id' => 'Id',
                        'value' => 'Agenda',
                    )
                ),
                'judul' => array(
                    'label'=>'Title',
                    'field'=>'title',
                    'type'=>'text',
                    'idform'=>'judul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8',                    
                ),
                'starttime' => array(
                    'label'=>'Start_Time',
                    'field'=>'starttime',
                    'type'=>'datetime',
                    'idform'=>'mulai',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'endtime' => array(
                    'label'=>'End_Time',
                    'field'=>'endtime',
                    'type'=>'datetime',
                    'idform'=>'selesai',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8',
                ),
                'notulen' => array(
                    'label'=>'Notulen',
                    'field'=>'user_notulen',
                    'type'=>'text',
                    'idform'=>'notulen1',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8',                    
                ),
                'notulen_head' => array(
                    'label'=>'Head_Notulen',
                    'field'=>'head_notulen',
                    'type'=>'text',
                    'idform'=>'notulen2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8',
                ),
                'pimpinanrapat' => array(
                    'label'=>'Key_Person',
                    'field'=>'keyperson',
                    'type'=>'text',
                    'idform'=>'pimpinan',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                
            ],
		];
        return view('master/m_view_ajax',$data);
    }

    public function getdata()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET' && !isset($_REQUEST['draw'])) 
                throw new Exception('Wrong Method');
            
                $draw = $_REQUEST['draw'];
                $start = $_REQUEST['start'];
                $length = $_REQUEST['length'];
                $searchValue = $_REQUEST['search']['value'];
                $filteredData = [];
                
                // Apply any necessary filtering or searching to your data
                $data = $this->model->getdata(user_id()); // Example: No filtering applied
                $alldata = $this->model->countdata(user_id());

                // Prepare the data to be sent as a response
                $response = [
                    "draw" => intval($draw),
                    "recordsTotal" => intval($alldata->getRow()->total),
                    "recordsFiltered" => count($data->getResultArray()),
                    "data" => [],
                ];

                if (!empty($searchValue)) {
                    foreach ($data->getResultArray() as $row) {
                        if (stripos($row['agenda'], $searchValue) !== false || stripos($row['notulis'], $searchValue) !== false || stripos($row['sign_notulis'], $searchValue) !== false || stripos($row['keyperson'], $searchValue) !== false) {
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
                $code=200;
                foreach ($pagedData as $row) {
                    $response['data'][] = [
                        "id" => $row['notulenid'],
                        "agenda" => $row['agenda'],
                        "title" => $row['title'],
                        "starttime" => $row['starttime'],
                        "endtime" => $row['endtime'],
                        "notulen" => $row['notulis'],
                        "head_notulen" => $row['sign_notulis'],
                        "key_person" => $row['keyperson'],
                        "status" => $row['status'],
                        "detail" => '<a href="javascript:void(0)"><i class="fas fa-info btn btn-secondary rounded-circle"></i> Detail</a>',
                        // "action" => $action,
                        // "canedit" => $canedit
                    ];
                }
                
                // Send the JSON response
                // return json_encode($response);
        }
        catch(Exception $e) {
            $code = 400;
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    public function updatedata($id)
    {
        $code = 400;
        try {
            if($_SERVER['REQUEST_METHOD']!=='PUT') 
                throw new Exception("BAD REQUEST", 1);
            
            $data = (array) $this->request->getVar('data');
            if(!$res=$this->store($data,$id)) {
                $response = [
                    'status' => 'error',
                    'message' => $res
                ];
            }
            $code=200;
            $response = [
                'status' => 'success',
                'message' => lang('Files.Update_Success'),
            ];
        }
        catch(Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    public function postdata()
    {
        $code = 400;
        try {
            if($_SERVER['REQUEST_METHOD']!=='POST') 
                throw new Exception("BAD REQUEST", 1);
            
            $datas = (array) $this->request->getVar('data');
            $code=200;
            $response = [
                'status' => 'success',
                'message' => lang('Files.Save_Success'),
            ];
            if(!$res=$this->store($datas)) {
                $response = [
                    'status' => 'error',
                    'message' => $res
                ];
            }
        }
        catch(Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    private function store($data,$id=0)
    {
        try {
            $response=false;
            $format = 'Y-m-d\TH:i';
            $startdate = DateTime::createFromFormat($format, $data['mulai']);
            $enddate = DateTime::createFromFormat($format, $data['selesai']);
            $data = [
                'idpeminjaman' => $data['agenda'],
                'title' => $data['judul'],
                'starttime' => $startdate->format('Y-m-d H:i:s'),
                'endtime' => $enddate->format('Y-m-d H:i:s'),
                'notulis' => $data['notulen1'],
                'sign_notulis' => $data['notulen2'],
                'keyperson' => $data['pimpinan'],
                'recordstatus' => 1
            ];
            if($id!==0) $data['notulenid'] = $id;
            if($this->model->save($data)) return $response = true;
        }
        catch(Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    public function getDetails(int $id)
    {
        $data = [];$action=true;
        $details = $this->model->getdetailbyId($id)->getResultArray();
        foreach($details as $row):
            if($row['recordstatus']==2) $action=false;
            $data[] = [
                'detailid' => $row['detailid'],
                'notulenid' => $row['notulenid'],
                'isheader' => $row['isheader'],
                'content' => $row['content'],
                'classification' => $row['classification'],
                'type' => $row['type'],
                'pic_from' => $row['pic_from'],
                'pic_to' => $row['pic_to'],
                'targetdate' => $row['targetdate'],
                'description' => $row['description'],
                'status' => $row['status'],
                'reason' => $row['reason'],
                'statfeedback' => $row['statfeedback']
            ];
        endforeach;
        $response = [
            'message' => 'success',
            'data' => $data,
            'canedit' => $action
        ];
        return $this->response->setJSON($response)->setStatusCode(200);
    }

    public function postDetail($idheader)
    {
        $code = 400;
        try {
            if($_SERVER['REQUEST_METHOD']!=='POST') 
                throw new Exception("BAD REQUEST", 1);
            
            $datas = (array) $this->request->getVar();
            $datas['notulenid'] = $idheader;
            $code=200;
            $response = [
                'status' => 'success',
                'message' => lang('Files.Save_Success'),
            ];
            if(!$res=$this->storeDetail($datas)) {
                $response = [
                    'status' => 'error',
                    'message' => $res
                ];
            }
        }
        catch(Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    public function updateDetail($idheader,$iddetail)
    {
        $code = 400;
        try {
            if($_SERVER['REQUEST_METHOD']!=='PUT') 
                throw new Exception("BAD REQUEST", 1);
            
            $datas = (array) $this->request->getVar();
            $datas['notulenid'] = $idheader;
            if(!$this->storeDetail($datas,$iddetail)) {
                throw new Exception('Failed to Save');
            }
            $code=200;
            $response = [
                'status' => 'success',
                'message' => lang('Files.Update_Success'),
            ];
        }
        catch(Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    private function storeDetail($data,$id=0)
    {
        try {
            $response=false;
            $data = [
                'notulenid' => $data['notulenid'],
                'isheader' => 0,
                'content' => $data['agenda'],
                'classification' => $data['klasifikasi'],
                'pic_from' => $data['picFrom'],
                'pic_to' => $data['picTo'],
                'targetdate' => $data['tanggal'],
                'description' => $data['keterangan'],
            ];
            if($id!==0) {
                $data['notulendetailid'] = $id;
                $this->model->updateNotes($data);
            }
            else { 
                $this->model->saveNotes($data);
            }
            return $response = true;
        }
        catch(Exception $e) {
            $response = false;
        }
        return $response;
    }

    private function storeFeedback($data,$id=0)
    {
        try {
            $response=false;
            $data = [
                'id' => $id,
                'status' => $data['status'],
                'reason' => $data['reason'],
            ];
            if($id!==0) {
                $this->model->updatefeedback($data);
            }
            
            return $response = true;
        }
        catch(Exception $e) {
            $response = false;
        }
        return $response;
    }

    public function purgeDetail($idheader,$iddetail)
    {
        $code = 400;
        try {
            if($_SERVER['REQUEST_METHOD']!=='DELETE') 
                throw new Exception("BAD REQUEST", 1);
            
            $code=200;
            $response = [
                'status' => 'success',
                'message' => lang('Files.Delete_Success'),
            ];
            if(!$res=$this->model->deleteDetail($iddetail)) {
                $response = [
                    'status' => 'error',
                    'message' => $res
                ];
            }
        }
        catch(Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    public function approve(int $id)
    {
        $userid = user_id();
        try {
            $this->model->approve($id,$userid);
            $code = 200;
            $response = [
                'message' => 'Data berhasil di approve',
            ];
        }
        catch(Exception $e) {
            $code = 400;
            $response = [
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    public function delete(int $id)
    {
        $userid = user_id();
        try {
            $this->model->cancel($id,$userid);
            $code = 200;
            $response = [
                'message' => 'Data berhasil di hapus',
            ];
        }
        catch(Exception $e) {
            $code = 400;
            $response = [
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    public function updateFeedback(int $id)
    {
        $code = 400;
        try {
            if($_SERVER['REQUEST_METHOD']!=='PATCH') 
                throw new Exception("BAD REQUEST", 1);
            
            $datas = (array) $this->request->getVar();
            
            if(!$this->storeFeedback($datas,$id)) {
                throw new Exception('Failed to Save');
            }
            $code=200;
            $response = [
                'status' => 'success',
                'message' => lang('Files.Update_Success'),
            ];
        }
        catch(Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
        // $datas = (array) $this->request->getVar();
        // var_dump($datas);
    }

    public function print(int $id)
    {
        // check user if permitted
        if(!$this->model->checkPermittedUser(user_id(),$id)) return redirect()->to('notulen');
        
        $pdfLib = new PdfLib();
        $this->response->setContentType('application/pdf');
        $data = $this->model->getdata(0,$id)->getRow();
        $details = $this->model->getdetailbyId($id)->getResultArray();
        $stylesheet = file_get_contents(base_url().'/public/assets/css/pdf/style.css');
        $peserta = $this->model->getPeserta($id)->getResultArray();
        $pdfLib->setCss($stylesheet);
        $html = view('pdf/notulen',['id'=>$id,'data'=>$data,'details'=>$details,'peserta'=>$peserta]);
        $pdfLib->generate($html, 'notulen.pdf');
        // echo $html;
        // var_dump($peserta);
    }

    public function generatePDF()
    {
        $pdfLib = new PdfLib();
        $this->response->setContentType('application/pdf');
        $html = '<html><body><h1>Hello, PDF!</h1></body></html>';
        // $this->pdf->WriteHTML($html);
		// $this->pdf->Output('arjun.pdf','I');
        $pdfLib->generate($html, 'output.pdf');
    }
}