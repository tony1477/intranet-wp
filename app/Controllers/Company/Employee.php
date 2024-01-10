<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use CodeIgniter\API\ResponseTrait;
use Exception;

class Employee extends BaseController
{
    use ResponseTrait;
    private $model;
    
    public function __construct()
    {
        $this->model = new EmployeeModel();
    }
    public function index()
    {
        //
    }

    public function showPoints()
    {
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Recap_Point']),
			'page_title' => view('partials/page-title', ['title' => 'Employee', 'li_1' => 'Intranet', 'li_2' => 'Recap_Point']),
			'modules' => $menu,
            'route' => 'employee',
            'menuname' => 'Notulen_Meeting',
            'data' => $this->model->getPoints()->getResult(),
        ];
        return view('company/employee-points',$data);
    }

    public function getPoint($id)
    {
        try {
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $code = 200;
            $data = $this->model->getPointEmployee($id)->getResultArray();
            $response = [
                'draw' => $_REQUEST['draw'],
                "recordsTotal" => intval(count($data)),
                "recordsFiltered" => intval(count($data)),
                'status' => 'success',
                'data' => [],
            ];
            $pagedata = array_slice($data, $start, $length);
            foreach($pagedata as $row):
                $response['data'][] = [
                    'monthlyid' => $row['monthlyabsid'],
                    'periode' => date('M Y',strtotime($row['periode'])),
                    'point' => $row['point'],
                    'detail' => '<a href="javascript:void(0)"><i class="fas fa-info btn btn-secondary rounded-circle"></i> Detail</a>',
                ];
            endforeach;
        }
        catch (Exception $e) {
            $code = 400;
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return $this->response->setJSON($response)->setStatusCode($code);
    }

    public function getDetailPoint($id)
    {
        try {
            $code = 200;
            $data = $this->model->getPointDetailbyPeriode($id)->getRowArray();
            $response = [
                'status' => 'success',
                'data' => $data
            ];
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
}
