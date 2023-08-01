<?php

namespace App\Controllers;
use App\Models\GalleryModel as Gallery;
use App\Models\MeetingScheduleModel as Meeting;
use App\Models\ArticleModel as Article;
use Exception;

class Home extends BaseController
{

	protected $auth;
	private $gallery;
	private $article;

    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
	protected $session;
	private $model;
	private $meeting;

	public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
		$this->gallery = new Gallery();
		$this->meeting = new Meeting();
		$this->article = new Article();
    }
	
	public function index()
	{
		// check credentials
		if(user()->isguest==1) return $this->guest();
		// getMenu
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
		$sess = $this->session;
		if($sess->meeting_day == null) {
			$sess->set(['meeting_day' => 'Today']);
		}
		$status = [1,2];
		$foto = $this->gallery->where(['ishighlight'=>1,'gallerytype'=>1])->findAll();
		$curdate = date('Y-m-d');
		$meeting = $this->meeting->where("tgl_mulai >= ", "{$curdate}")->whereIn('status',$status)->orderBy('tgl_mulai', 'desc')->findAll(5,0);
		$article = $this->article->where(['page'=>'F','publish'=>1,'status'=>1])->findAll(0,1);
        //$submenu = getSubmenu($moduleid=0);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Dashboard']),
			'modules' => $menu,
			'data' => [
				'foto' => $foto,
				'meeting' => $meeting,
				'article' => $article,
			],
			// 'data_meeting' => 
			// 'session' => $sess
		];
		
		return view('index', $data);
	}

	public function guest() {
		helper(['admin_helper']);
        $menu = getMenu($user='Admin');
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Intranet', 'li_2' => 'Dashboard']),
			'modules' => $menu,
			// 'data_meeting' => 
			// 'session' => $sess
		];
		return view('guest', $data);
	}

	public function login() {
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard']),
			// 'config' => $this->config,
		];
		
		return view('auth/login', $data);
	}

	public function viewbyfile($name,$file,$field) {
		if(!file_exists(getcwd().'/assets/protected/'.$name.'/'.$file)) return redirect()->route('pages-404');
		$next=0;
		switch($name) {
			case "struktur-organisasi":
				$this->model = new \App\Models\StrukturorgModel(); $next=1;
				break;
			case "dokumen-sop":
				$this->model = new \App\Models\DokumenModel(); $next=1;
				break;
			default:
				$this->model = null;
		}

		if(!$next) return redirect()->route('pages-404');

		try {
			$row=$this->model->where($field,$file)->first();
			$data = [
				'title_meta' => view('partials/title-meta', ['title' => 'Structure-Org']),
				'data' => $row[$field],
				'dir' => $name,
			];
			return view('master/bpo/view_dokumen',$data);
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	public function uploadfile($dir) {
        header("Content-Type: application/json");
        $arr = array(
            'status' => 'failed',
            'code' => 400,
            'message' => 'Error'
        );
        
        $loc = getcwd().'/public/assets/protected/'.$dir;
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
            $location = $this->getName($dir,$name,$ext);
        }
        
        /* Save the uploaded file to the local filesystem */
        try {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $char = $dir.'/';
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
	
	private function getName($dir,$name,$ext,$urut=0) {
        $loc = getcwd().'/public/assets/protected/'.$dir;
        $location = $loc.'/'.$name.'.'.$ext;
        if($urut>=2) {
            $name = substr($name,0,-2);
        }
        if(file_exists($location)) {
            $urut++;
            return $this->getName($dir,$name.($urut==1 ? ' copy' : ' '.$urut),$ext,$urut);
        }
        // var_dump($loca);
        return $location;
    }

	public function register() {
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('auth/register', $data);
	}
}
