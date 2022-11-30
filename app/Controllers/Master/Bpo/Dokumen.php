<?php

namespace App\Controllers\Master\Bpo;

use App\Controllers\BaseController;

class Dokumen extends BaseController
{
    public function __construct()
    {
        $this->model = new \App\Models\DokumenModel();
    }
    
    public function index()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $document = getDocument();
        $group = getDepartment();
        $category = getKategory();
        //$submenu = getSubmenu($moduleid=0);
        
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Document']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Document']),
			'modules' => $menu,
            'route'=>'dokumen-sop',
            'menuname' => 'Document',
            'data' => $document,
            'modal' => 'modal-lg',
            //'options' => array('option1' => $group),
            'custombutton' => array(
                'Button1' => [
                    'toggle' => true,
                    'id' => 'userByDoc',
                    'name' => 'userByDoc',
                    'title' => lang('Files.UserByDoc'),
                    'class' => 'btn btn-soft-primary waves-effect waves-light btn-sm',
                    'icon-class' => 'mdi mdi-file-compare',
                    'loadfile' => 'master/_partials/test',
                    'scriptfile' => 'master/_partials/script/userbydoc',

                ],
                // 'Button2' => [
                //     'name' => 'docByUser',
                //     'class' => 'btn btn-soft-primary waves-effect waves-light btn-sm',
                //     'icon-class' => 'fas fa-users',
                //     'title' => lang('Files.User'),
                //     // 'loadfile' => 'master/_partials/test'
                // ],
            ),
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_Department','No_SOP','Name_Document','Name_Document2','Name_Category','Name_File','Name_File2','Name_File3','Publish','Status','Cover2'),
            'button' => array(
                'Publish' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,                ],
                'Cover2' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ]
            ),
            // 'columns_link' => array('Name_File','Name_File2','Name_File3'),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style','option',etc)
                'iddokumen' => array('type'=>'hidden','idform'=>'id','field'=>'iddokumen'),
                'iddepartment' => array(
                    'label'=>'Name_Department',
                    'field'=>'iddepartment',
                    'type'=>'select',
                    'idform'=>'idgroup',
                    'form-class'=>'form-select',
                    'style' => 'col-md-10 col-xl-10',
                    'options' => array(
                        'list' => $group,
                        'id' => 'Id',
                        'value' => 'Name_Department',
                    ),
                ),
                'dok_nosop' => array(
                    'label'=>'No_SOP',
                    'field'=>'dok_nosop',
                    'type'=>'text',
                    'attr' => 'readonly',
                    'idform'=>'nosop',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10',
                ),
                'dok_nmsop' => array(
                    'label'=>'Nama_SOP',
                    'field'=>'dok_nmsop',
                    'type'=>'text',
                    'idform'=>'nmsop1',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'dok_nmsop2' => array(
                    'label'=>'Nama_SOP2',
                    'field'=>'dok_nmsop2',
                    'type'=>'text',
                    'idform'=>'nmsop2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'idkategory' => array(
                    'label'=>'Name_Category',
                    'field'=>'idkategory',
                    'type'=>'select',
                    'idform'=>'idsubgroup',
                    'form-class'=>'form-select',
                    'style' => 'col-md-10 col-xl-10',
                    'options' => array(
                        'list' => $category,
                        'id' => 'Id',
                        'value' => 'Name_Category',
                    ),
                ),
                'dok_nmfile' => array(
                    'label'=>'Name_File',
                    'label2'=>'Full_Name_File',
                    'field'=>'dok_nmfile',
                    'type'=>'file',
                    'idform'=>'nmfile',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'dok_nmfile2' => array(
                    'label'=>'Name_File2',
                    'label2'=>'Full_Name_File2',
                    'field'=>'dok_nmfile2',
                    'type'=>'file',
                    'idform'=>'nmfile2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'dok_nmfile3' => array(
                    'label'=>'Name_File3',
                    'label2'=>'Full_Name_File3',
                    'field'=>'dok_nmfile3',
                    'type'=>'file',
                    'idform'=>'nmfile3',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'dok_publish' => array(
                    'label'=>'Publish',
                    'field'=>'dok_publish',
                    'type'=>'switch',
                    'idform'=>'dokpublish',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'dok_aktif' => array(
                    'label'=>'Status',
                    'field'=>'dok_aktif',
                    'type'=>'switch',
                    'idform'=>'dokstatus',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'dok_default' => array(
                    'label'=>'Cover2',
                    'field'=>'dok_cover',
                    'type'=>'switch',
                    'idform'=>'dokcover',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
            ],
		];
		
		return view('master/m_view', $data);
    }

    public function delete()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        if($this->request->isAJAX()) {
            try {
                $id = $this->request->getVar('id');
                $this->model->where('iddokumen',$id)->delete();
                if($this->model->find($id)) {
                    $arr = array(
                        'status' => 'warning',
                        'code' => 200,
                        'message' => lang('Files.Delete_Error'),
                        // 'data' => $this->model->findAll()
                    );
                    return json_encode($arr);
                }
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => lang('Files.Delete_Success'),
                    // 'data' =>  $this->model->findAll()
                );
            }catch (\Exception $e) {
                $arr = array(
                    'status' => $e->getMessage(),
                    'code' => 400
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }

    public function save()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        if($this->request->isAJAX()) {
            try {
                $datas = $this->request->getVar('data');
                if(is_object($datas)) {
                    $datas = (array) $datas;
                }
                $data = [
                    'iddokumen' => $datas['id'],
                    'dok_nosop' => $datas['nosop'],
                    'dok_nmsop' => $datas['nmsop1'],
                    'dok_nmsop2' => $datas['nmsop2'],
                    'iddepartment' => $datas['idgroup'],
                    'idkategory' => $datas['idsubgroup'],
                    'dok_cover' => $datas['dokcover'],
                    'dok_publish' => $datas['dokpublish'],
                    'dok_aktif' => $datas['dokstatus'],
                    // 'user_m' => $this->session->user_kode,
                    'tgl_m'=>date('Y-m-d'),
                    'time_m'=>date("h:i:s a")
                ];
                if(isset($datas['nmfile'])) $data = array_merge($data,['dok_nmfile' => $datas['nmfile']]);
                if(isset($datas['nmfile2'])) $data = array_merge($data,['dok_nmfile2' => $datas['nmfile2']]);
                if(isset($datas['nmfile3'])) $data = array_merge($data,['dok_nmfile3' => $datas['nmfile3']]);
                
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        // 'user_c' => $this->session->user_kode,
                        'tgl_c'=>date('Y-m-d'),
                        'time_c'=>date("h:i:s a")
                    ];
                    $data = array_merge($data,$newdata);
                    $this->model->insert($data);
                    $message = lang('Files.Save_Success');
                }
                
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => $message
                );
            }catch (\Exception $e) {
                $arr = array(
                    'status' => $e->getMessage(),
                    'code' => 400
                );
            }
        }
        $response = json_encode($arr);
        return $response;
    }

    public function display()
    {
    }

    public function view($code) 
    {
        // $uri = service('uri');
        // echo $uri->getSegment(3);

        // check param from db
        
        if($this->model->where('stg_kode',$code)->first()) {
            helper(['admin_helper']);
            helper(['master_helper']);
            $menu = getMenu($user='Admin');
            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'Structure-Org']),
                'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Structure-Org']),
                'modules' => $menu,
                'menuname' => 'Structure-Org',
            ];
            return view('master/bpo/view_struktur',$data);
        }
    }

    public function viewbyfile($field,$urlfile) 
    {
        // $uri = service('uri');
        // echo $uri->getSegment(3);

        // check param from db
        
        if($this->model->where($field,$urlfile)->first()) {
            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'Structure-Org']),                
            ];
            return view('master/bpo/view_struktur',$data);
        }
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Error_404'])
        ];
        return view('pages-404',$data);
    }

    public function uploadfile() {
        header("Content-Type: application/json");
        $arr = array(
            'status' => 'failed',
            'code' => 400,
            'message' => 'Error'
        );
        
        $loc = getcwd().'/assets/protected/struktur';
        // var_dump($_FILES);
        $filename = $_FILES['file']['name'];

        /* Choose where to save the uploaded file */
        $location = $loc.'/'.$filename;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $name = pathinfo($filename, PATHINFO_FILENAME);

        // check if file exists 
        if(file_exists($location)) {
            // $name = $this->getName($name,$ext);
            // $location = $loc.'/'.$name;
            $location = $this->getName($name,$ext);
        }
        
        /* Save the uploaded file to the local filesystem */
        try {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $char = 'struktur/';
                $str = strpos($location,$char,0);
                $filename = substr($location,$str+(strlen($char)));
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Uploaded File!',
                    'filename' => $filename
                );
            }
        }
        catch(Exception $e) {
            $arr = array(
                'status' => 'failed',
                'code' => 400,
                'message' => $e->getMessage(),
            );
        }
        $response = json_encode($arr);
        return $response;
    }

    public function tes() {
        return view('master/bpo/tes');
    }

    private function getName($name,$ext,$urut=0) {
        $loc = getcwd().'/assets/protected/struktur';
        $location = $loc.'/'.$name.'.'.$ext;
        if($urut>=2) {
            $name = substr($name,0,-2);
        }
        if(file_exists($location)) {
            $urut++;
            return $this->getName($name.($urut==1 ? ' copy' : ' '.$urut),$ext,$urut);
        }
        // var_dump($loca);
        return $location;
    }

    public function upload() {

        $loc = getcwd().'/assets/protected/upload';
        // var_dump($_FILES);
        $filename = $_FILES['namafile']['name'];

        /* Choose where to save the uploaded file */
        $location = $loc.'/'.$filename;

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $info = pathinfo($filename);
        echo $info['filename'].$ext;

        /* Save the uploaded file to the local filesystem */
        // if ( move_uploaded_file($_FILES['namafile']['tmp_name'], $location) ) { 
        // echo 'Success'; 
        // } else { 
        // echo 'Failure'; 
        // }
    }

    public function userbydoc()
    {
        // $id = '001.SKM.MNGT.I.2022';
        $doksop = $_POST['dok_nosop'];
        $query = $this->model->getUserbyDoc($doksop);
        $result = [
            'status' => 'success',
            'code' => 200,
            'data' => $query
        ];

        return json_encode($result);

    }
}
