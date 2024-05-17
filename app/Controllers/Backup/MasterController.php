<?php

namespace App\Controllers\Backup;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;

class MasterController extends ResourcePresenter
{
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    private $client;
    public function __construct()
    {
        $this->client = \Config\Services::curlrequest(['baseURI'=>BASE_URI]);
    }
    
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        // $position = getPosition();
        
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'E-Backup']),
			'page_title' => view('partials/page-title', ['title' => 'E-Backup', 'li_1' => 'Intranet', 'li_2' => 'List_Master']),
			'modules' => $menu,
            'route' => 'e-backup',
            'menuname' => 'Master Backup File',
            
		];
		return view('backup/master/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $uri = 'master_file';
        if($id!==null) $uri = 'master_file/'.$id;

        $response = $this->client->get($uri);
        if (strpos($response->header('content-type'), 'application/json') !== false) { 
            $result = json_decode($response->getBody())->data;
        }
        $data = [
            'draw' => 1,
            'recordsTotal' => $result->totalRows,
            'recordsFiltered' => $result->totalRows,
            'data' => $result->rowData,
        ];

        return $this->respond($data,null,'Data retrived successful');
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $uri = 'master_file';

        try {
            $divisi = $this->request->getVar('divisi');
            $file = join(';',$this->request->getVar('File'));
            $data = [        
                'divisi' => $divisi,
                'File' => $file,
                'createdby' => user()->fullname,
                'updatedby' => user()->fullname,
            ];
            $response = $this->client->post($uri,['form_params'=>$data,'http_errors' => false]);

        if (strpos($response->header('content-type'), 'application/json') !== false) { 
            $result = json_decode($response->getBody());
        }
        $result = json_decode($response->getBody());
        $data = [
            'status' => $result->status,
            'message' => $result->message,
        ];
        return $this->respond($data,null,'Data save successful');
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $uri = 'master_file';

        $id = $this->request->getVar('id');
        $divisi = $this->request->getVar('divisi');
        $file = join(';',$this->request->getVar('File'));
        $data = [
            'id' => $id,
            'divisi' => $divisi,
            'File' => $file,
            'updatedby' => user()->fullname,
        ];
        $response = $this->client->patch($uri,['form_params'=>$data]);
        if (strpos($response->header('content-type'), 'application/json') !== false) { 
            $result = json_decode($response->getBody());
        }
        $data = [
            'status' => $result->status,
            'message' => $result->message,
        ];

        return $this->respond($data,null,'Data save successful');
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $uri = 'master_file/'.$id;
        
        $response = $this->client->delete($uri,['http_errors' => false]);
        if (strpos($response->header('content-type'), 'application/json') !== false) { 
            $result = json_decode($response->getBody());
        }
        $data = [
            'status' => $result->status,
            'message' => $result->message,
        ];

        return $this->respond($data,null,'Data save successful');
    }
}
