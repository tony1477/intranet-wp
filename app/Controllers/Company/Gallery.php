<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;

class Gallery extends BaseController
{
    private $model;
    private $entity;
    public function __construct()
    {
        $this->model = new \App\Models\GalleryModel();
    }
    public function index()
    {
        helper(['admin_helper']);
        // helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Gallery', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'department',
            'menuname' => 'Department',
            
		];
        // $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);

        return view('company/album',$data);
    }

    public function foto()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $limit = 6;
        $offset = 0;
        $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);
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
