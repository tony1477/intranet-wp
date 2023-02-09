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
    public function GalleryFoto()
    {
        helper(['admin_helper']);
        // helper(['master_helper']);
        $album = $this->album->getAlbum()->getResult();
        $menu = getMenu($user='Admin');
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Gallery', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'gallery-foto',
            'menuname' => 'Foto',
            'data' => $album,
            
		];
        // $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);

        return view('company/album',$data);
    }

    public function GalleryVideo()
    {
        helper(['admin_helper']);
        // helper(['master_helper']);
        $video = $this->gallery->where(['gallerytype'=>2,'status'=>1])->get()->getResult();
        $menu = getMenu($user='Admin');
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Gallery', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'gallery-foto',
            'menuname' => 'Foto',
            'data' => $video,
            
		];
        // $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);

        return view('company/video',$data);
    }

    public function foto($id)
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $limit = 10;
        $offset = 0;
        $gallery = $this->gallery->where(['gallerytype'=>1,'categoryid'=>$id,'status'=>1]);
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'department',
            'menuname' => 'Department',
            'data' => $gallery->paginate($limit,'gallery'),
            'pager' => $gallery->pager,
            'categoryid' => $id,
		];
		
		return view('company/gallery-foto', $data);
    }

    public function video()
    {

    }

    public function manageAlbum()
    {
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
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

    public function manageFoto()
    {
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
        $this->entity = new \App\Entities\GalleryCategory();
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $gallery = $this->gallery->getGallery($id=null)->getResult();
        $categories = $this->album->findAll();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Album', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'gallery-foto/manage-foto',
            'menuname' => 'Gallery',
            'data' => $gallery,
            'modal' => 'modal-lg',
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_Category','Title','Description','Link_File','IsHighlight','Status','IsLogin','IsCover','User_Created','User_Modified'),
            'button' => array(
                'IsHighlight' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
                'IsLogin' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
                'IsCover' => [
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
                    'type'=>'textarea',
                    'idform'=>'judul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'desc' => array(
                    'label'=>'Description',
                    'field'=>'description',
                    'type'=>'textarea',
                    'idform'=>'deskripsi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'link' => array(
                    'label'=>'Link_File',
                    'field'=>'url',
                    'type'=>'file-image',
                    'asset-folder' => 'images/gallery/foto',
                    'idform'=>'nama_url',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10',
                    'url_upload' => 'upload_image',
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
                'isbackground' => array(
                    'label'=>'IsLogin',
                    'field'=>'islogin',
                    'type'=>'switch',
                    'idform'=>'isbackground',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'sampul' => array(
                    'label'=>'IsCover',
                    'field'=>'iscover',
                    'type'=>'switch',
                    'idform'=>'issampul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
            ]
            
		];
		
		return view('master/w_view', $data);
    }

    public function manageVideo()
    {
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
        $this->entity = new \App\Entities\GalleryCategory();
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $gallery = $this->gallery->getGalleryVideo($id=null)->getResult();
        $categories = $this->album->findAll();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Video']),
			'page_title' => view('partials/page-title', ['title' => 'Album', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Video']),
			'modules' => $menu,
            'route'=>'gallery-foto/manage-video',
            'menuname' => 'Video',
            'data' => $gallery,
            'modal' => 'modal-md',
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Title','Description','Link_File','Cover_File','Status','User_Created','User_Modified'),
            'button' => array(
                // 'IsHighlight' => [
                //     'class' => 'btn-sm waves-effect waves-light',
                //     'text' => false,
                // ],
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'galleryid' => array('type'=>'hidden','idform'=>'id','field'=>'galleryid'),
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
                'url' => array(
                    'label'=>'Link_File',
                    'field'=>'url',
                    'type'=>'text',
                    'idform'=>'link_file',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'sampul' => array(
                    'label'=>'Cover_File',
                    'field'=>'sampul_video',
                    'type'=>'file-image',
                    'asset-folder' => 'videos/poster',
                    'idform'=>'nama_sampul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10',
                    'url_upload' => 'upload_sampul',
                ),
                // 'highlight' => array(
                //     'label'=>'IsHighlight',
                //     'field'=>'ishighlight',
                //     'type'=>'switch',
                //     'idform'=>'istampil',
                //     'form-class'=>'form-control',
                //     'style' => 'col-md-10 col-xl-10'
                // ),
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
		
		return view('master/w_view', $data);
    }
    
    public function postAlbum()
    {
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
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
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
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
                    'islogin' => ($datas['isbackground']=='Y' ? 1 : 0),
                    'iscover' => ($datas['issampul']=='Y' ? 1 : 0),
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

    public function postVideo()
    {
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
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
                    'gallerytype' => 2,
                    'title' => ($datas['judul']),
                    'url' => ($datas['link_file']),
                    'description' => $datas['deskripsi'],
                    'status' => ($datas['isaktif']=='Y' ? 1 : 0),
                    'updatedby' => user()->username,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ];

                if(isset($datas['nama_sampul'])) $data = array_merge($data,['sampul_video' => $datas['nama_sampul']]);
                
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

    public function deleteFoto()
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
                $this->gallery->where('galleryid',$id)->delete();
                if($this->gallery->find($id)) {
                    $arr = array(
                        'status' => 'warning',
                        'code' => 200,
                        'message' => 'Terjadi kesalahan dalam menghapus data',
                        // 'data' => $this->model->findAll()
                    );
                    return json_encode($arr);
                }
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Data Berhasil di Hapus',
                    // 'data' =>  $this->model->findAll()
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

    public function deleteAlbum()
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
                $this->album->where('categoryid',$id)->delete();
                if($this->album->find($id)) {
                    $arr = array(
                        'status' => 'warning',
                        'code' => 200,
                        'message' => 'Terjadi kesalahan dalam menghapus data',
                        // 'data' => $this->model->findAll()
                    );
                    return json_encode($arr);
                }
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Data Berhasil di Hapus',
                    // 'data' =>  $this->model->findAll()
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

    public function deleteVideo()
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
                // get filename to move to trash folder
                $oldFile = $this->gallery->find($id);
                $loc = getcwd().'/assets/videos/';
                // move videos
                rename($loc.$oldFile->Link_File,$loc.'trash/'.$oldFile->Link_File);
                // move poster
                rename($loc.'poster/'.$oldFile->Cover_File,$loc.'trash/poster/'.$oldFile->Cover_File);

                // echo $loc.$oldFile->Link_File;

                $this->gallery->where('galleryid',$id)->delete();

                if($this->album->find($id)) {
                    $arr = array(
                        'status' => 'warning',
                        'code' => 200,
                        'message' => 'Terjadi kesalahan dalam menghapus data',
                        // 'data' => $this->model->findAll()
                    );
                    return json_encode($arr);
                }
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Data Berhasil di Hapus',
                    // 'data' =>  $this->model->findAll()
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

    public function uploadfile()
    {
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
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
    
    public function uploadCover()
    {
        if(!has_permission('gallery-permission')) return redirect()->route('gallery-foto');
        header("Content-Type: application/json");
        $arr = array(
            'status' => 'failed',
            'code' => 400,
            'message' => 'Error'
        );
        
        $loc = getcwd().'/assets/videos/poster';
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
