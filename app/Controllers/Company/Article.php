<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\ArticleCatModel as CategoryModel;
use App\Entities\Article as ArticleEntity;
use App\Models\CommentModel;
use CodeIgniter\API\ResponseTrait;
class Article extends BaseController
{
    use ResponseTrait;
    private $model;
    private $category;
    private $comment;

    public function __construct()
    {
        $this->model = new ArticleModel();
        $this->category = new CategoryModel();
        $this->comment = new CommentModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
        $article = $this->model->where(['publish'=>1,'status'=>1])->findAll(0,3);
        $categories = $this->category->sumPerCategory();
        $upcoming = $this->model->where(['publish'=>0,'status'=>1])->findAll();
        $popular = $this->model->findAll(0,3);
        $tags = $this->model->findAll();
        // $articles = $this->model->getArticles()->getResult(ArticleEntity::class);
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Articles']),
			'page_title' => view('partials/page-title', ['title' => 'Articles', 'li_1' => 'Intranet', 'li_2' => 'Articles']),
			'modules' => $menu,
            'route'=>'articles',
            'menuname' => 'Articles',
            'data' => [
                'article' => $article,
                'category' => $categories,
                'upcoming' => $upcoming,
                'popular' => $popular,
                'tags' => $tags,
            ],
		];
        // $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);

        return view('company/articles',$data);
    }

    public function getData($id)
    {
        // $data = $this->model->select('content')->find($id);
        $db = db_connect();
        $data = $db->query("select * from article where articleid={$id}")->getResult();

        return json_encode(['data' => $data]);
    }

    public function categories()
    {
        if(!has_permission('article')) return redirect()->route('articles');
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
        $categories = $this->category->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Category']),
			'page_title' => view('partials/page-title', ['title' => 'Category', 'li_1' => 'Intranet', 'li_2' => 'Category']),
			'modules' => $menu,
            'route'=>'article/category',
            'menuname' => 'Category',
            'data' => $categories,
            'modal' => 'modal-md',
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_Category','Status','User_Created','User_Modified'),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
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
        // $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);

        return view('master/m_view',$data);
    }

    public function postCategories()
    {
        if(!has_permission('article')) return redirect()->route('articles');
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
                    'status' => ($datas['isaktif']=='Y' ? 1 : 0),
                    'updated_by' => user()->username,
                    // 'updated_at'=>date('Y-m-d H:i:s'),
                ];
                if($datas['id']!=='') {
                    $this->category->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        'created_by' => user()->username,
                        // 'created_at'=>date('Y-m-d H:i:s'),
                    ];
                    $data = array_merge($data,$newdata);
                    $this->category->insert($data);
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

    public function article()
    {
        if(!has_permission('article')) return redirect()->route('articles');
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
        $article = $this->model->getData();
        // if($article!=null) $article = $this->model->getData();
        $categories = $this->category->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Article']),
			'page_title' => view('partials/page-title', ['title' => 'Article', 'li_1' => 'Intranet', 'li_2' => 'Article']),
			'modules' => $menu,
            'route'=>'article',
            'menuname' => 'Article',
            'data' => $article,
            'modal' => 'modal-lg',
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Name_Category','Title','Content','Image','Page','Slug','Publish','Status','User_Created','User_Modified'),
            'button' => array(
                'Page' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
                'Publish' => [
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
                'articleid' => array('type'=>'hidden','idform'=>'id','field'=>'articleid'),
                'categoryid' => array(
                    'label'=>'Name_Category',
                    'field'=>'categoryid',
                    'type'=>'select',
                    'idform'=>'category',
                    'form-class'=>'form-select',
                    'style' => 'col-md-8 col-xl-8',
                    'options' => array(
                        'list' => $categories,
                        'id' => 'Id',
                        'value' => 'Name_Category',
                    ),
                ),
                'judul' => array(
                    'label'=>'Title',
                    'field'=>'title',
                    'type'=>'text',
                    'idform'=>'judul',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'isi' => array(
                    'label'=>'Content',
                    'field'=>'content',
                    'type'=>'textarea',
                    'idform'=>'isi',
                    'form-class'=>'form-control',
                    'style' => 'col-md-12 col-xl-12'
                ),
                'image' => array(
                    'label'=>'Link_File',
                    'field'=>'image',
                    'type'=>'file-image',
                    'idform'=>'link_image',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10',
                    'url_upload' => 'upload_image',
                ),
                'page' => array(
                    'label'=>'Page',
                    'field'=>'page',
                    'type'=>'switch',
                    'idform'=>'isfront',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'tag' => array(
                    'label'=>'Slug',
                    'field'=>'slug',
                    'type'=>'text',
                    'idform'=>'tag',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'publish' => array(
                    'label'=>'Publish',
                    'field'=>'publish',
                    'type'=>'switch',
                    'idform'=>'ispublish',
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
        // $gallery = $this->model->where('gallerytype',1)->findAll($limit,$offset);

        return view('master/w_view',$data);
    }

    public function postArticle()
    {
        if(!has_permission('article')) return redirect()->route('articles');
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
                    'categoryid' => $datas['category'],
                    'title' => $datas['judul'],
                    'content' => $datas['isi'],
                    // 'image' => ($datas['isaktif']=='Y' ? 1 : 0),
                    'page' => ($datas['isfront']=='Y' ? 'F' : 'A'),
                    'slug' => $datas['tag'],
                    'publish' => ($datas['ispublish']=='Y' ? 1 : 0),
                    'status' => ($datas['isaktif']=='Y' ? 1 : 0),
                    'updaterid' => user_id(),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ];
                if(isset($datas['link_image'])) $data = array_merge($data,['image' => $datas['link_image']]);
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    $newdata = [
                        'creatorid' => user_id(),
                        'created_at'=>date('Y-m-d H:i:s'),
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

    public function uploadImg()
    {
        if(!has_permission('article')) return redirect()->route('articles');
        header("Content-Type: application/json");
        $arr = array(
            'status' => 'failed',
            'code' => 400,
            'message' => 'Error'
        );
        
        $loc = getcwd().'/assets/images/gallery/article';
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
    
    public function getCommentbyArticle($id=0,$parentid=null)
    {
        // $data = [
        //     [
        //         'commentid' => 1,
        //         'comment' => 'koment ke-1',
        //         'user' => 'USER-1',
        //         'tgl' => '09 Desember 2022',
        //         'has_reply' => true,
        //         'parentid' => null,
        //         'child_comment' => [
        //             [
        //                 'commentid' => 3,
        //                 'comment' => 'koment reply pertama',
        //                 'user' => 'USER-2',
        //                 'tgl' => '11 Desember 2022',
        //                 'has_reply' => false,
        //                 'parentid' => 1,
        //             ],
        //             [
        //                 'commentid' => 4,
        //                 'comment' => 'koment reply kedua',
        //                 'user' => 'USER-1',
        //                 'tgl' => '11 Desember 2022',
        //                 'has_reply' => false,
        //                 'parentid' => 1,
        //             ],
        //         ]     
        //     ],
        //     [
        //         'commentid' => 2,
        //         'comment' => 'koment ke-2',
        //         'user' => 'USER-2',
        //         'tgl' => '10 Desember 2022',
        //         'has_reply' => false,
        //         'parentid' => null,
        //     ],
        //     [
        //         'commentid' => 5,
        //         'comment' => 'koment ke-3 ',
        //         'user' => 'USER-3',
        //         'tgl' => '12 Desember 2022',
        //         'has_reply' => false,
        //         'parentid' => null,
        //     ]
        // ];
       
        $arr = [];
        $find = $this->comment->getComment($id,null)->getResult();
        $i=0;
        foreach($find as $row):
            // check child
            array_push($arr,[
                'commentid' => $row->commentid,
                'comment' => $row->text,
                // 'userid' => $row->userid,
                'user' => $row->name,
                'image' => $row->user_image,
                'tgl' => date('d M Y',strtotime($row->posted_date)),
                'parentid' => null,
                'has_reply' => false,
                ]
            );
            
            if($getChild=$this->comment->getComment($id,$row->commentid)->getResult()):
                $childs=[];
                foreach($getChild as $child):
                    array_push($childs,[
                        'commentid' => $child->commentid,
                        'comment' => $child->text,
                        'user' => $child->name,
                        'image' => $child->user_image,
                        'tgl' => date('d M Y',strtotime($child->posted_date)),
                        'parentid' => null,
                        'has_reply' => false,
                    ]);
                endforeach;
                // $charr = array_merge($arr,['child_comment'=>$childs]);
                $arr[$i]['child_comment'] = $childs;
                // $arr = array_replace($charr,['has_reply'=>true]);
                $arr[$i]['has_reply'] = true;
            endif;
            // if($i==0) {
            //     $arr[$i]['has_reply'] = true;
            // }
            $i++;
        endforeach;
        return $this->respond($arr,200);
    }

    public function postComment()
    {
        header("Content-Type: application/json");
        $arr = array(
            'fail' => 500,
            'code' => 'FAILED',
            'message'=>'NOT ALLOWED'
        );
        if($this->request->isAJAX()) {
            try {
                $datas = $this->request->getVar();
                if(is_object($datas)) {
                    $datas = (array) $datas;
                }

                $data = [
                    'articleid' => $datas['id'],
                    'userid' => $datas['userid'],
                    'text' => $datas['text'],
                    'posted_date' => date('Y-m-d H:i:s'),
                    // 'image' => ($datas['isaktif']=='Y' ? 1 : 0),
                    'status' => 'publish',
                ];
                
                if($datas['parentid']!='') $data = array_merge($data,['parentid' => $datas['parentid']]);
                $this->comment->insert($data);
                $message = lang('Files.Save_Success');
                
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

    public function readArticle($title,$id)
    {
        $title = str_replace('-',' ',$title);
        //check article
        if(!$article=$this->model->getArticle($id,$title)->getRow()) return redirect()->to('/articles');
        
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
        $categories = $this->category->sumPerCategory();
        $upcoming = $this->model->where(['publish'=>0,'status'=>1])->findAll();
        $popular = $this->model->findAll(0,3);
        $tags = $this->model->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Read_Article']),
			'page_title' => view('partials/page-title', ['title' => 'Read_Articles', 'li_1' => 'Intranet', 'li_2' => 'Read_Articles']),
			'modules' => $menu,
            'route'=>'articles',
            'menuname' => 'Read_Article',
            'data' => [
                'article' => $article,
                'category' => $categories,
                'upcoming' => $upcoming,
                'popular' => $popular,
                'tags' => $tags,
            ],
		];
        return view('company/read_article',$data);
    }
}
