<?php

namespace App\Controllers\Meeting;

use App\Controllers\BaseController;

class MeetingRoom extends BaseController
{

    public $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\MeetingRoomModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        helper(['meeting_helper']);
        $menu = getMenu($user='Admin');
        $meetingroom = getRoom();
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Room']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Room']),
			'modules' => $menu,
            'data' => $meetingroom,
        ];
        return view('meeting-room/list-room',$data);
    }

    public function detail() {
        helper(['admin_helper']);
        helper(['meeting_helper']);
        $request = \Config\Services::request();
        $param = $request->uri->getSegment(3);
        $meetingroom = getRoomByName($param);
        $model = new \App\Models\MeetingScheduleModel();
        $statusroom = $model->where(['status' => 2, 'idruangan'=>$meetingroom[0]->idruangan])->first();
        $menu = getMenu($user='Admin');
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Room']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Room']),
			'modules' => $menu,
            'data' => $meetingroom,
            'param' => $param,
            'statusroom' => $statusroom,
        ];
        
        return view('meeting-room/detail-room',$data);
    }
}
