<?php

namespace App\Controllers\Meeting;

use App\Controllers\BaseController;
use Config\Services as Config;

class MeetingSchedule extends BaseController
{
    protected $request;
    protected $model;
    public function __construct() {
        $this->request = \Config\Services::request();
        $this->model = new \App\Models\MeetingScheduleModel();
    }
    public function index()
    {
        helper(['admin_helper']);
        helper(['meeting_helper']);
        $menu = getMenu($user='Admin');
        $list = getListSchedule();
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Schedule']),
			'page_title' => view('partials/page-title', ['title' => 'Meeting_Schedule', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Schedule']),
			'modules' => $menu,
            'data' => $list,
        ];
        return view('meeting-room/list-schedule',$data);
    }

    public function schedule() {
        helper(['admin_helper']);
        helper(['meeting_helper']);
        $menu = getMenu($user='Admin');
        $param = $this->request->uri->getSegment(2);
        $getRoom = getRoomByName($param);
        $schedule = getScheduleByName($param);
        if($getRoom==null) return redirect()->to('room-meeting'); 
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Room']),
			'page_title' => view('partials/page-title', ['title' => 'Meeting_Room', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Schedule']),
			'modules' => $menu,
            'data' => $schedule,
            'nama' => ucwords(str_replace('-room',' ',$param)),
        ];
        return view('meeting-room/schedule',$data);
    }

    public function booking() {
        helper(['admin_helper','meeting_helper','master_helper']);
        $menu = getMenu($user='Admin');
        $param = $this->request->uri->getSegment(3);
        $getDepartment = getDepartment();
        $getPosition = getPosition();
        $rooms = getRoom();
        if($param!='') {
            $getRoom = getRoomByName($param);
            if($getRoom==null) return redirect()->to('room-meeting'); 
        }
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Room']),
			'page_title' => view('partials/page-title', ['title' => 'Meeting_Room', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Schedule']),
			'modules' => $menu,
            // 'data' => $schedule,
            'nama' => ucwords(str_replace('-room',' ',$param)),
            'department' => $getDepartment,
            'position' => $getPosition,
            'room' => $rooms,
        ];
        return view('meeting-room/booking',$data);
    }

    public function detail() {
        helper(['admin_helper','meeting_helper']);
        $menu = getMenu($user='Admin');
        $param = $this->request->uri->getSegment(3);
        $detail = getDetailSchedule($param) ;
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Room']),
			'page_title' => view('partials/page-title', ['title' => 'Meeting_Room', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Schedule']),
			'modules' => $menu,
            'data' => $detail,
        ];
        return view('meeting-room/detail-meeting',$data);
    }

    public function requestRoom()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        $hash=null;
        if($this->request->isAJAX()) {
            try {
                $datas = $this->request->getVar('data');
                if(is_object($datas)) {
                    $datas = (array) $datas;
                }

                // $participant = explode(',',$datas['parti']);
                $data = [
                    'idruangan' => $datas['room'],
                    'userid' => user()->id,
                    'tgl_mulai' => $datas['startdate'],
                    'jam_mulai' => $datas['starttime'],
                    'jam_selesai' => $datas['endtime'],
                    'iddepartment' => $datas['department'],
                    'jumlah_peserta' => $datas['participant'],
                    'asal_peserta' => $datas['location'],
                    'agenda' => $datas['agenda'],
                    'pemateri' => $datas['speaker'],
                    'nama_peserta' => $datas['nameparti'],
                    'kebutuhan' => $datas['requirement'],
                    'notulis' => $datas['notulen'],
                    'status' => 1,
                    // 'user_m' => $this->session->user_kode,
                    // 'tgl_m'=>date('Y-m-d'),
                    // 'time_m'=>date("h:i:s a")
                ];
                // var_dump($data);
                $this->model->insert($data);
                $message = lang('Files.Save_Success');
                // if($datas['id']!=='') {
                //     $newdata = ['id' => $datas['id'], 'password_hash' => $hash];
                //     $data = array_merge($data,$newdata);
                //     $this->model->save($data);
                //     $message = lang('Files.Update_Success');
                // }
                
                // if($datas['id']==='') {
                //     $newdata = [
                //         // 'user_c' => $this->session->user_kode,
                //         // 'tgl_c'=>date('Y-m-d'),
                //         // 'time_c'=>date("h:i:s a")
                //         'password_hash' => $hash,
                //     ];
                //     $data = array_merge($data,$newdata);
                //     $this->model->withGroup($this->config->defaultUserGroup);
                //     $this->model->insert($data);
                //     $message = lang('Files.Save_Success');
                // }
                
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

    public function action(string $action, int $id)
    {
        if(!has_permission('approval-meeting')):
            return redirect()->to('/meeting-schedule');
        endif;

        $status=null;
        $arr=null;
        switch ($action) {
            case "approve":
                $status=2;
                $arr = ['approveby'=>user_id()];
                break;
            case "selesai":
                $status=3;
                $arr = ['act_tgl_selesai' => date('Y-m-d'), 'act_jam_selesai' => date('H:i:s')];
                break;
            default:
                $status=0;
                $arr = ['rejectedby'=>user_id()];
        }
        $data = ['status'=>$status];
        if($arr!=null) $data = array_merge($data,$arr);
        $this->model->update($id,$data);
        return redirect()->to('/meeting-schedule');
    }
}
