<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;

class Gallery extends BaseController
{
    public function index()
    {
        //
    }

    public function foto()
    {
        helper(['admin_helper']);
        helper(['master_helper']);
        $menu = getMenu($user='Admin');
        $department = getDepartment();
        $divisi = getDivisi();
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Gallery_Foto']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Gallery_Foto']),
			'modules' => $menu,
            'route'=>'department',
            'menuname' => 'Department',
            'data' => $department,
            
		];
		
		return view('company/gallery-foto', $data);
    }

    public function video()
    {

    }
}
