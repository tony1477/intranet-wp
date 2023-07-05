<?php

namespace App\Controllers\Helpdesk;

use App\Controllers\BaseController;
use App\Models\ItHelpdeskModel;
use Exception;

class Response extends BaseController
{
    private $respModel;
    private $ticketing;
    public function __construct()
    {
        $this->respModel = new ItHelpdeskModel();
    }
    
    public function index()
    {
        helper(['admin_helper','master_helper']);
        $menu = getMenu($user='Admin');
        // $listticket = 
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Response_Ticket']),
            'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Response_Ticketing']),
            'modules' => $menu,
            'route'=>'list-resp',
            'menuname' => 'IT_Helpdesk',
            // 'listticket' => $listticket,
        ];
        return view('helpdesk/list-resp',$data);
    }

    public function listResponse(string $type)
    {
        header('Content-Type: application/json');
        $addedstatus = false;
        switch($type) {
            case 'open':
                $stt = '4,5,6,7,8,9,10';
                break;

            case 'close':
                $stt = '0,11';
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
            $data = $this->respModel->getRespDT($stt); // Example: No filtering applied
            $alldata = $this->respModel->getSummResp($stt);

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
                    if (stripos($row['ticketno'], $searchValue) !== false || stripos($row['ticketopen'], $searchValue) !== false || stripos($row['ticketclose'], $searchValue) !== false || stripos($row['category'], $searchValue) !== false || stripos($row['urgency'], $searchValue) !== false || stripos($row['fullname'], $searchValue) !== false || stripos($row['status'], $searchValue) !== false) {
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
                // switch($row['recordstatus']){
                //     case '1' :
                //         if(getWfAuthByUserid('apphelpdesk',$row['recordstatus'])) {
                //             $action = '<a href="edit-helpdesk/'.$row['helpdeskid'].'"><button type="button" class="btn btn-light edit-button waves-effect btn-label waves-light"><i class="far fa-edit label-icon"></i> Edit</button></a>
                //             <a href="javascript:void(0)"><button type="button" class="btn btn-success approve-button waves-effect btn-label waves-light"><i class="fas fa-check label-icon"></i> Approve</button></a>';         
                //             break;
                //         }
                //     case '2':
                //     case '3':
                //     case '4':
                //         if(getWfAuthByUserid('apphelpdesk',$row['recordstatus'])) {
                //             $action = '<a href="edit-helpdesk/'.$row['helpdeskid'].'"><button type="button" class="btn btn-light edit-button waves-effect btn-label waves-light"><i class="far fa-edit label-icon"></i> Edit</button></a>
                //             <a href="javascript:void(0)"><button type="button" class="btn btn-success approve-button waves-effect btn-label waves-light"><i class="fas fa-check label-icon"></i> Approve</button></a>
                //             <a href="javascript:void(0)"><button type="button" class="btn btn-danger reject-button waves-effect btn-label waves-light"><i class="fas fa-times label-icon"></i> Reject</button></a>';
                //         }
                //         else $action = '';
                //         $canedit=false;
                //         break;
                //     case '5':
                //     case '6':
                //     case '7':
                //     case '8':
                //     case '9':
                //     case '10':
                //         $action = '<a href="javascript:void(0)"><button type="button" class="btn btn-info reject-button waves-effect btn-label waves-light"><i class="fas fa-times label-icon"></i> Reply Confirmation</button></a>';
                //         break;
                //     case '11' :
                //     case '0' :
                //         $action ='';
                //         break;
                //     default :
                //         $action = '';
                //         break;
                // }
                $response['data'][] = [
                    "id" => $row['helpdeskid'],
                    "ticketno" => $row['ticketno'],
                    "ticketdate" => date('d/m/Y H:i',strtotime($row['ticketopen'])),
                    "ticketclose" => date('d/m/Y H:i',strtotime($row['ticketclose'])),
                    "category" => $row['category'],
                    "urgencytype" => $row['urgency'],
                    "userrequest" => $row['fullname'],
                    "status" => $row['status'],
                ];
            }
            
            // Send the JSON response
            return json_encode($response);
        }
    }

    public function detailResponse(int $id)
    {
        helper(['admin_helper','master_helper','form','helpdesk_helper']);
        $authorize = service('authorization');
        $menu = getMenu($user='Admin');
        $detail = $this->respModel->getDetailResp($id)->getRow();
        $feedback = $this->respModel->getDataFeedbackResp($id,'feedback')->getResult();
        $confirm = $this->respModel->getDataFeedbackResp($id,'confirmation')->getResult();
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Response_Ticket']),
            'page_title' => view('partials/page-title', ['title' => 'Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Response_Ticketing']),
            'modules' => $menu,
            'route'=>'resp-detail',
            'menuname' => 'IT_Helpdesk',
            'detail' => $detail,
            'feedback' => $feedback,
            'confirm' => $confirm,
            'list_itsystem' => $authorize->usersInGroup('wfitsystem'),
            'list_itinfra' => $authorize->usersInGroup('wfitinfra'),
        ];
        return view('helpdesk/resp-detail',$data);
    }

    public function submitForm($submit)
    {
        switch($submit) {
            case 'review':
                $form='form_review';
                $typeid=2;
                break;

            case 'confirm':
                $form='form_confirm';
                $typeid=3;
                break;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'):
            $id = $_POST['helpdeskid'];
            $resp_text = $_POST[$form];
            $status = $_POST['status'];
            $data = [
                'id' => $id,
                'responsetext' => $resp_text,
                'creator_id' => user_id(),
                'respondtypeid' => $typeid,
                'status' => $status
            ];
            $this->respModel->submitFormReviewFeedback($data);
            return redirect()->to('resp-helpdesk/detail/'.$id)->with('success',lang('Files.Save_Success'));
        endif;
        return redirect()->back()->withInput();
    }

    public function approveHelpdesk()
    {
        header('Content-Type: application/json');
        $response = [
            'message' => 'Not Allowed',
            'status' => 'fail',
            'code' => 400
        ];
        if($this->request->getMethod()==='post'):
            try {
                $id = $this->request->getVar('id');
                $data = ['id' => $id, 'userid'=>user_id()];
                $this->respModel->approveHelpdesk($data);
                $response = [
                    'message' => 'Data Berhasil di Approve',
                    'status' => 'success',
                    'code' => 200
                ];
            }
            catch(Exception $e) {
                $response = [
                    'message' => $e->getMessage(),
                    'status' => 'fail',
                    'code' => 400
                ];
            }
        endif;
        return json_encode($response);
    }
}
