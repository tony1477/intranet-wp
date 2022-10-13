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
        $menu = getMenu($user='Admin');
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Meeting_Room']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Meeting_Room']),
			'modules' => $menu,
            'data' => $meetingroom,
            'param' => $param,
        ];
        
        return view('meeting-room/detail-room',$data);
    }
}
