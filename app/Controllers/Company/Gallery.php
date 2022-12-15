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
        $gallery = $this->gallery->where(['gallerytype'=>1,'categoryid'=>$id])->findAll($limit,$offset);
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'department',
            'menuname' => 'Department',
            'data' => $gallery,
            
		];
		
		return view('company/gallery-foto', $data);
    }

    public function video()
    {

    }
}
