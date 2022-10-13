<?php

namespace App\Controllers\Meeting;

use App\Controllers\BaseController;
use Config\Services as Config;

class MeetingSchedule extends BaseController
{
    protected $request;
    public function __construct() {
        $this->request = \Config\Services::request();
    }
    public function index()
    {
        helper(['admin_helper']);
        helper(['meeting_helper']);
        $menu = getMenu($user='Admin');
        $data = getListSchedule();
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Room']),
			'page_title' => view('partials/page-title', ['title' => 'Meeting_Room', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Schedule']),
			'modules' => $menu,
            'data' => $data,
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
}
