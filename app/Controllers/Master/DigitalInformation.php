<?php

namespace App\Controllers\Master;

use App\Models\DigitalInformationModel;
use App\Models\DisplayInfo\EventsModel;
use App\Models\DisplayInfo\GalleryModel;
use App\Models\DisplayInfo\QutoesModel;
use App\Models\DisplayInfo\RunTextModel;
use App\Models\DisplayInfo\VideosModel;
use App\Models\EmployeeModel;
use CodeIgniter\RESTful\ResourceController;

class DigitalInformation extends ResourceController
{
    protected $eventsModel;
    protected $galleriesModel;
    protected $quotesModel;
    protected $runTextModel;
    protected $videosModel;
    protected $employeeModel;
    public function __construct()
    {
        $this->model = new DigitalInformationModel();
        $this->eventsModel = new EventsModel();
        $this->galleriesModel = new GalleryModel();
        $this->quotesModel = new QutoesModel();
        $this->runTextModel = new RunTextModel();
        $this->videosModel = new VideosModel();
        $this->employeeModel = new EmployeeModel();
    }
    
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index() :string
    {
        helper(['admin_helper','auth']);
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Dashboard']),
			'modules' => getMenu('Admin'),
            'route' => 'digital-information',
            'menuname' => 'Digital Information',
            'columns_hidden' => array('Action'),
            'data' => $this->model->findAll(),
            'columns' => array('Action','Id','Title','Icon','Content','Url','Status'),
        ];
        return view('master/m_view',$data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = 'v1') :string
    {
        helper('admin_helper');
       

		$data = [
			'quotes' => $this->quotesModel->asArray()->where('recordstatus',1)->findAll(),
			'galleries' => $this->galleriesModel->asArray()->where('recordstatus',1)->findAll(),
			'videos' => $this->videosModel->asArray()->where('recordstatus',1)->findAll(),
			'runtext' => $this->runTextModel->asArray()->where('recordstatus',1)->findAll(),
			'bestemployees' => $this->employeeModel->getPointLevel()->getResultArray(),
			'events' => $this->eventsModel->asArray()->where('recordstatus',1)->findAll(),
			'title' => 'Digital Display Information - WILIAN PERKASA',
		];
        return view('display/main_'.$id,$data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
