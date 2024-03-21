<?php

namespace App\Controllers\Recruitment;

use App\Controllers\BaseController;
use App\Libraries\WebAPI;
use App\Models\RecruitmentModel;


class CandidateEmployee extends BaseController
{
    private RecruitmentModel $model;
    
    public function index()
    {
        $verify = json_decode(WebAPI::verify(API_WEBSITE.'/auth/checkToken'));
        if($verify->status!='success') return redirect()->to('e-recruitment/login', null, 'refresh');
        return $this->home();
        // var_dump($verify);  
    }
    
    public function login()
    {
        helper(['admin_helper','master_helper','form']);
        $menu = getMenu($user='Admin');
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Login']),
			'page_title' => view('partials/page-title', ['title' => 'E-Recruitment', 'li_1' => 'Intranet', 'li_2' => 'Login']),
			'modules' => $menu,
            'route'=>'e-recruitment',
            'menuname' => 'Recruitment',
		];
        return view('recruitment/login',$data);
    }

    public function home()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        // $position = getPosition();
        
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'E-Recruitment']),
			'page_title' => view('partials/page-title', ['title' => 'E-Recruitment', 'li_1' => 'Intranet', 'li_2' => 'List_Employee']),
			'modules' => $menu,
            'route' => 'e-recruitment',
            'menuname' => 'recruitment',            
            
		];
		// var_dump($position);
		return view('recruitment/home', $data);
    }

    public function detail(int $id)
    {
        helper(['admin_helper','master_helper','form']);
        $this->model = new RecruitmentModel();
        $menu = getMenu($user='Admin');
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Detail_New_Employee']),
			'page_title' => view('partials/page-title', ['title' => 'E-Recruitment', 'li_1' => 'Intranet', 'li_2' => 'Detail']),
			'modules' => $menu,
            'route'=>'e-recruitment',
            'menuname' => 'Recruitment',
            'id' => $id,
            'data' => json_decode(WebAPI::get(API_WEBSITE.'/api/employee/'.$id)),
            'last_status' => $this->model->getLastStatus($id),
            'status' => $this->model->getAllStatus(),
            'blacklist' => $this->model->getDataBlacklist($id),
            // 'data' => $data,
		];
        return view('recruitment/detail',$data);
    }

    public function process()
    {
        try {
            $emp_recruitid = $this->request->getVar('employeeid');
            $statusid = $this->request->getVar('statusid');
            $position = $this->request->getVar('position');
            $data = [
                'api_employeeid' => $emp_recruitid,
                'positionname' => $position,
                'statusid' => $statusid
            ];

            $this->model = new RecruitmentModel();
            $this->model->processRecruit($data);
            return json_encode([
                'message' => 'Data was recorded!',
                'status' => 'success',
            ]);
        }
        catch(\Exception $e) {
            $msg = $e->getMessage();
            return json_encode([
                'status' => 'failed',
                'message' => $msg
            ]);
        }
    }

    public function consider()
    {
        $this->model = new RecruitmentModel();
        try {
            $data = [
                'recruitid' => $this->request->getVar('recruitid'),
                'statusid' => $this->request->getVar('statusid'),
                'message' => $this->request->getVar('message'),
            ];

            $this->model->considerRecruit($data);
            $response = [
                'status' => 'success',
                'message' => 'Notes was recorded!',
            ];
            return $this->response->setJSON($response)->setStatusCode(200);
        }
        catch(\Exception $e) {
            $response = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
            return $this->response->setJSON($response)->setStatusCode(400);
        }
    }

    public function notProcess(int $id)
    {
        try {
            $this->model = new RecruitmentModel();
            $data = [
                'recruitid' => $this->request->getVar('recruitid'),
                'statusid' => $this->request->getVar('statusid'),
                'message' => $this->request->getVar('message'),
            ];

            $this->model->notProcessRecruit($data);
            $response = [
                'status' => 'success',
                'message' => 'Notes was recorded!',
            ];
            return $this->response->setJSON($response)->setStatusCode(200);
        }
        catch(\Exception $e) {
            $response = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
            return $this->response->setJSON($response)->setStatusCode(400);
        }
    }

    public function addNotes(int $id)
    {
        $this->model = new RecruitmentModel();
        try {
            $data = [
                'recruitid' => $this->request->getVar('recruitid'),
                'statusid' => $this->request->getVar('statusid'),
                'message' => $this->request->getVar('message'),
            ];
            
            $this->model->addNotes($data);
            $response = [
                'status' => 'success',
                'message' => 'Notes was recorded!',
            ];
            return $this->response->setJSON($response)->setStatusCode(200);
        }
        catch(\Exception $e) {
            $response = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
            return $this->response->setJSON($response)->setStatusCode(400);
        }
    }

    public function blacklist(int $id)
    {
        $this->model = new RecruitmentModel();
        try {
            $data = [
                'api_employeeid' => $this->request->getVar('employeeid'),
                'position' => $this->request->getVar('position'),
                'message' => $this->request->getVar('message'),
            ];
            
            $this->model->blacklist($data);
            $response = [
                'status' => 'success',
                'message' => 'Data was recorded!',
            ];
            return $this->response->setJSON($response)->setStatusCode(200);
        }
        catch(\Exception $e) {
            $response = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
            return $this->response->setJSON($response)->setStatusCode(400);
        }
    }
}
