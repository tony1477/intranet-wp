<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;

class Gallery extends BaseController
{
    private $gallery;
    private $album;
    private $entity;
    public function __construct()
    {
        $this->gallery = new \App\Models\GalleryModel();
        $this->album = new \App\Models\AlbumModel();
    }
    public function index()
    {
        helper(['admin_helper']);
        // helper(['master_helper']);
        $album = $this->album->getAlbum()->getResult();
        $menu = getMenu($user='Admin');
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Gallery', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'department',
            'menuname' => 'Department',
            'data' => $album,
            
		];
        // $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);

        return view('company/album',$data);
    }

    public function foto($id)
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $limit = 8;
        $offset = 0;
        $gallery = $this->gallery->where(['gallerytype'=>1,'categoryid'=>$id,'status'=>1])->findAll($limit,$offset);
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'department',
            'menuname' => 'Department',
            'data' => $gallery,
            'categoryid' => $id,
		];
		
		return view('company/gallery-foto', $data);
    }

    public function video()
    {

    }

    public function manageAlbum()
    {
        $this->entity = new \App\Entities\GalleryCategory();
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $album = $this->album->findAll();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'gallery-foto/manage-album',
            'menuname' => 'Gallery',
            'data' => $album,
            'modal' => 'modal-md',
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_Category','Description','Status','User_Created','User_Modified'),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'categoryid' => array('type'=>'hidden','idform'=>'id','field'=>'categoryid'),
                'cat_name' => array(
                    'label'=>'Name_Category',
                    'field'=>'categoryname',
                    'type'=>'text',
                    'idform'=>'nama',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'desc' => array(
                    'label'=>'Description',
                    'field'=>'description',
                    'type'=>'text',
                    'idform'=>'deskripsi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'status' => array(
                    'label'=>'Status',
                    'field'=>'status',
                    'type'=>'switch',
                    'idform'=>'isaktif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
            ]
            
		];
		
		return view('master/m_view', $data);
    }

    public function manageFoto($id)
    {
        $this->entity = new \App\Entities\GalleryCategory();
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $gallery = $this->gallery->getGallery($id)->getResult();
        $categories = $this->album->where('categoryid',$id)->findAll();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Album', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'gallery-foto/manage-foto',
            'menuname' => 'Gallery',
            'data' => $gallery,
            'modal' => 'modal-md',
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_Category','Title','Description','Link_File','IsHighlight','Status','User_Created','User_Modified'),
            'button' => array(
                'IsHighlight' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'galleryid' => array('type'=>'hidden','idform'=>'id','field'=>'galleryid'),
                'categoryid' => array(
                    'label'=>'Name_Category',
                    'field'=>'categoryid',
                    'type'=>'select',
                    'idform'=>'idkategori',
                    'form-class'=>'form-select',
                    'disabled' => 'disabled',
                    'style' => 'col-md-10 col-xl-10',
                    'options' => array(
                        'list' => $categories,
                        'id' => 'Id',
                        'value' => 'Name_Category',
                    ),
                ),
                'title' => array(
                    'label'=>'Title',
                    'field'=>'title',
                    'type'=>'text',
                    'idform'=>'judul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'desc' => array(
                    'label'=>'Description',
                    'field'=>'description',
                    'type'=>'text',
                    'idform'=>'deskripsi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'link' => array(
                    'label'=>'Link_File',
                    'field'=>'url',
                    'type'=>'file-image',
                    'idform'=>'nama_url',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'highlight' => array(
                    'label'=>'IsHighlight',
                    'field'=>'ishighlight',
                    'type'=>'switch',
                    'idform'=>'istampil',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'status' => array(
                    'label'=>'Status',
                    'field'=>'status',
                    'type'=>'switch',
                    'idform'=>'isaktif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
            ]
            
		];
		
		return view('master/m_view', $data);
    }
    
    public function postAlbum()
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
                    'categoryname' => $datas['nama'],
                    'description' => $datas['deskripsi'],
                    'status' => ($datas['isaktif']=='Y' ? 1 : 0),
                    'updated_by' => user()->username,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ];
                if($datas['id']!=='') {
                    $this->album->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        'created_by' => user()->username,
                        'created_at'=>date('Y-m-d H:i:s'),
                    ];
                    $data = array_merge($data,$newdata);
                    $this->album->insert($data);
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
    
    public function postFoto()
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
                    'gallerytype' => 1,
                    'categoryid' => $datas['idkategori'],
                    'title' => ($datas['judul']),
                    'description' => $datas['deskripsi'],
                    'ishighlight' => ($datas['istampil']=='Y' ? 1 : 0),
                    'status' => ($datas['isaktif']=='Y' ? 1 : 0),
                    'updatedby' => user()->username,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ];
                if(isset($datas['nama_url'])) $data = array_merge($data,['url' => $datas['nama_url']]);
                if($datas['id']!=='') {
                    $this->gallery->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        'createdby' => user()->username,
                        'created_at'=>date('Y-m-d H:i:s'),
                    ];
                    $data = array_merge($data,$newdata);
                    $this->gallery->insert($data);
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

    public function uploadfile($dir)
    {
        header("Content-Type: application/json");
        $arr = array(
            'status' => 'failed',
            'code' => 400,
            'message' => 'Error'
        );
        
        $loc = getcwd().'/assets/images/gallery/foto';
        $filename = $_FILES['file']['name'];

        /* Choose where to save the uploaded file */
        $location = $loc.'/'.$filename;
        
        /* Save the uploaded file to the local filesystem */
        try {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
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
}
