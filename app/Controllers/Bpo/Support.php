<?php

namespace App\Controllers\Bpo;

use App\Controllers\BaseController;

class Support extends BaseController
{
    public $model = null;
    public function __construct()
    {
        $this->model = new \App\Models\DokumenModel();
    }

    public function kebijakan()
    {
        helper(['admin_helper']);
        helper(['user_helper']);
        $menu = getMenu($user='Admin');
        $kebijakan = getKebijakanData();

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Category']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Category']),
			'modules' => $menu,
            'route' => 'kebijakan',
            'menuname' => 'Policy',
            'data' => $kebijakan,
            'bpo' => true,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Id','No_SOP','Name_Document','Name_Document2','Name_Department','Action'),
            //'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idkategory' => array('type'=>'hidden','idform'=>'id','field'=>'idkategory'), 
                'kat_kode' => array(
                    'label'=>'Code_Category',
                    'field'=>'kat_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama' => array(
                    'label'=>'Name_Category',
                    'field'=>'kat_nama',
                    'type'=>'text',
                    'idform'=>'namakategory',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama2' => array(
                    'label'=>'Name_Category2',
                    'field'=>'kat_nama2',
                    'type'=>'text',
                    'idform'=>'namakategory2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		
		return view('master/m_view', $data);
    }

    public function manual()
    {
        helper(['admin_helper']);
        helper(['user_helper']);
        $menu = getMenu($user='Admin');
        $manual = getManualData();

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Category']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Category']),
			'modules' => $menu,
            'route' => 'manual',
            'menuname' => 'Manual',
            'data' => $manual,
            'bpo' => true,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Id','No_SOP','Name_Document','Name_Document2','Name_Department','Action'),
            //'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idkategory' => array('type'=>'hidden','idform'=>'id','field'=>'idkategory'), 
                'kat_kode' => array(
                    'label'=>'Code_Category',
                    'field'=>'kat_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama' => array(
                    'label'=>'Name_Category',
                    'field'=>'kat_nama',
                    'type'=>'text',
                    'idform'=>'namakategory',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama2' => array(
                    'label'=>'Name_Category2',
                    'field'=>'kat_nama2',
                    'type'=>'text',
                    'idform'=>'namakategory2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		
		return view('master/m_view', $data);
    }

    public function sop()
    {
        helper(['admin_helper']);
        helper(['user_helper']);
        $menu = getMenu($user='Admin');
        $sop = getSOPData();

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Category']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Category']),
			'modules' => $menu,
            'route' => 'sop',
            'menuname' => 'SOP',
            'data' => $sop,
            'bpo' => true,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Id','No_SOP','Name_Document','Name_Document2','Name_Department','Action'),
            //'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idkategory' => array('type'=>'hidden','idform'=>'id','field'=>'idkategory'), 
                'kat_kode' => array(
                    'label'=>'Code_Category',
                    'field'=>'kat_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama' => array(
                    'label'=>'Name_Category',
                    'field'=>'kat_nama',
                    'type'=>'text',
                    'idform'=>'namakategory',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama2' => array(
                    'label'=>'Name_Category2',
                    'field'=>'kat_nama2',
                    'type'=>'text',
                    'idform'=>'namakategory2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		
		return view('master/m_view', $data);
    }

    public function intruksikerja()
    {
        helper(['admin_helper']);
        helper(['user_helper']);
        $menu = getMenu($user='Admin');
        $intruksi = getInstruksiKerjaData();

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Category']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Category']),
			'modules' => $menu,
            'route' => 'kebijakan',
            'menuname' => 'Work_Instruction',
            'data' => $intruksi,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Id','No_SOP','Name_Document','Name_Document2','Name_Department','Action'),
            'bpo' => true,
            //'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idkategory' => array('type'=>'hidden','idform'=>'id','field'=>'idkategory'), 
                'kat_kode' => array(
                    'label'=>'Code_Category',
                    'field'=>'kat_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama' => array(
                    'label'=>'Name_Category',
                    'field'=>'kat_nama',
                    'type'=>'text',
                    'idform'=>'namakategory',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama2' => array(
                    'label'=>'Name_Category2',
                    'field'=>'kat_nama2',
                    'type'=>'text',
                    'idform'=>'namakategory2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		
		return view('master/m_view', $data);
    }

    public function lainnya()
    {
        helper(['admin_helper']);
        helper(['user_helper']);
        $menu = getMenu($user='Admin');
        $lainnya = getLainnyaData();

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Category']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Category']),
			'modules' => $menu,
            'route' => 'lainnya',
            'menuname' => 'Others',
            'data' => $lainnya,
            'bpo' => true,
            //'options' => array('option1' => $group),
            'columns_hidden' => array('Action'),
            'columns' => array('Id','No_SOP','Name_Document','Name_Document2','Name_Department','Action'),
            //'crudScript' => view('partials/script/groupdivisi',['menuname' => 'Divisi_Group','forms'=>'forms']),
            'forms' => [
                # rule
                # column_name => array(type,'name and id','class','style')
                'idkategory' => array('type'=>'hidden','idform'=>'id','field'=>'idkategory'), 
                'kat_kode' => array(
                    'label'=>'Code_Category',
                    'field'=>'kat_kode',
                    'type'=>'text',
                    'idform'=>'kode',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama' => array(
                    'label'=>'Name_Category',
                    'field'=>'kat_nama',
                    'type'=>'text',
                    'idform'=>'namakategory',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
                'kat_nama2' => array(
                    'label'=>'Name_Category2',
                    'field'=>'kat_nama2',
                    'type'=>'text',
                    'idform'=>'namakategory2',
                    'form-class'=>'form-control',
                    'style' => 'col-md-8 col-xl-8'
                ),
            ]
		];
		
		return view('master/m_view', $data);
    }

    public function viewpdf($type,$file) 
    {
        // $type = 'dokumen'
        $cond = [
            'dok_nosop' => $file,
            'dok_aktif' =>'Y',
            'dok_publish'=>'Y',
            'username' => user()->username,
        ];
        if($row = $this->model->getViewDoc($cond)->getRowArray()) {
            $_SESSION['filePdf'] = $row['dok_nmfile'];
            return view('master/bpo/viewpdf');
        }
        $data = ['message'=>lang('Files.Sorry').' '.lang('Files.Data').' '.$file.' '.lang('Files.Not_Found')];
        return view('pages-404',$data);
    }

    public function downloadform($type,$file,$urut)
    {
        $urut++;
        $cond = [
            'dok_nosop' => $file,
            'dok_aktif' =>'Y',
            'dok_publish'=>'Y'
        ];
        if($row = $this->model->where($cond)->first()) {
            // $_SESSION['filePdf'] = $row['dok_nmfile'];
            // return view('master/bpo/viewpdf');
            $name = $row['dok_nmfile'.$urut];
            $loc = getcwd().'/assets/protected/dokumen-sop/form';
            $filename = $loc.'/'.$name;
            if(file_exists($filename)) {

                //Define header information
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header("Cache-Control: no-cache, must-revalidate");
                header("Expires: 0");
                header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                header('Content-Length: ' . filesize($filename));
                header('Pragma: public');
                
                //Clear system output buffer
                flush();
                
                //Read the size of the file
                readfile($filename);
                
                //Terminate from the script
                die();
            }
            $data = ['message'=>lang('Files.Sorry').' '.lang('Files.Data').' '.$file.' '.lang('Files.Not_Found')];
            return view('pages-404',$data);
        }
        $data = ['message'=>lang('Files.Sorry').' '.lang('Files.Data').' '.$file.' '.lang('Files.Not_Found')];
        return view('pages-404',$data);
    }

}
