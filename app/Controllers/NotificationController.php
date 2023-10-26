<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotificationModel;
use App\Models\UserNotifModel;
use Config\Pusher as PusherConfig;
use Pusher\Pusher as Pusher;

class NotificationController extends BaseController
{
    private $model;
    public function __construct()
    {
        $this->model = new NotificationModel();
    }

    public function index()
    {
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Notification']),
			'page_title' => view('partials/page-title', ['title' => 'Notification', 'li_1' => 'Intranet', 'li_2' => 'Notification']),
			'modules' => $menu,
            'route'=>'notification',
            'menuname' => 'Notification',
            'data' => $this->model->findAll(),
            // 'modal' => 'modal-lg',
            'columns_hidden' => array('Action'),
            'columns' => array('Action','Id','Title','Icon','Content','Url','Status'),
            'custombutton' => array(
                'Button1' => [
                    'toggle' => false,
                    'id' => 'sendNotif',
                    'title' => lang('Files.SendNotif'),
                    'class' => 'btn btn-soft-primary waves-effect waves-light btn-sm sendNotif',
                    'name' => 'sendNotif',
                    'scriptfile' => 'partials/script/sendnotif',
                    'loadfile' => 'empty',
                    'icon-class' => 'dripicons-direction',
                ],
            ),
            'button' => array(
                'Status' => [
                    'class' => 'btn-sm waves-effect waves-light',
                    'text' => false,
                ],
            ),
            'forms' => [
                'notifid' => array('type'=>'hidden','idform'=>'id','field'=>'notifid'),
                'notiftitle' => array(
                    'label'=>'Title',
                    'field'=>'notiftitle',
                    'type'=>'text',
                    'idform'=>'judulnotif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'notificon' => array(
                    'label'=>'Icon',
                    'field'=>'notificon',
                    'type'=>'text',
                    'idform'=>'iconnotif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'notiftext' => array(
                    'label'=>'Content',
                    'field'=>'notiftext',
                    'type'=>'text',
                    'idform'=>'isinotif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                'url' => array(
                    'label'=>'Url',
                    'field'=>'url',
                    'type'=>'text',
                    'idform'=>'urlnotif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
                // 'notiftype' => array(
                //     'label'=>'Notif_Type',
                //     'field'=>'notiftype',
                //     'type'=>'text',
                //     'idform'=>'jenisnotif',
                //     'form-class'=>'form-control',
                //     'style' => 'col-md-10 col-xl-10'
                // ),
                'status' => array(
                    'label'=>'Status',
                    'field'=>'recordstatus',
                    'type'=>'switch',
                    'idform'=>'isaktif',
                    'form-class'=>'form-control',
                    'style' => 'col-md-10 col-xl-10'
                ),
            ],
            'pager' => $this->model->pager,
        ];

        return view('master/m_view',$data);
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
                $this->model->where('notifid',$id)->delete();
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
                    'notiftitle' => $datas['judulnotif'],
                    'notificon' => $datas['iconnotif'],
                    'notiftext' => $datas['isinotif'],
                    'url' => $datas['urlnotif'],
                    'notiftype' => 'all',
                    'recordstatus' => ($datas['isaktif']=='Y' ? 1 : 0),
                    // 'tgl_m'=>date('Y-m-d'),
                    // 'time_m'=>date("h:i:s a")
                ];
                if($datas['id']!=='') {
                    $this->model->update($datas['id'],$data);
                    $message = lang('Files.Update_Success');
                }
                
                if($datas['id']==='') {
                    // $newdata = [
                    //     'user_c' => user()->username,
                    //     'tgl_c'=>date('Y-m-d'),
                    //     'time_c'=>date("h:i:s a")
                    // ];
                    // $data = array_merge($data,$newdata);
                    $ins = $this->model->insert($data);
                    $message = lang('Files.Save_Success');
                }
                
                $arr = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => $message,
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

    public function sendNotif()
    {
        $pusherConfig = new PusherConfig();
        $pusher = new Pusher($pusherConfig->key, $pusherConfig->secret, $pusherConfig->app_id, [
            'cluster' => $pusherConfig->cluster,
            // 'useTLS' => $pusherConfig->useTLS
        ]);

        $id = $this->request->getVar('id');
        $find = $this->model->find($id);
        $model = new UserNotifModel();
        if($model->addUserNotif($id,'all')):
            $pusher->trigger('my-channel','new-notifications',[
                'data' => [
                    'img' => $find->notificon,
                    'title' => $find->notiftitle,
                    'content' => $find->notiftext,
                    'date' => $find->notifdate,
                    'url' => $find->url
                ]
            ]);
        endif;
        $resp = [
            'message' => 'OK',
            'status' => 'success',
            'data' => $find
        ];
        return $this->response->setJSON($resp)->setStatusCode(200);
    }

    public function getNotifData()
    {
        $model = new UserNotifModel();
        $data = $model->getNotif()->getResult();
        $resp = [
            'status' => 'success',
            'data' => $data
        ];
        return $this->response->setJSON($resp)->setStatusCode(200);
    }

    public function getNotifNumber()
    {
        $model = new UserNotifModel();
        $number = $model->getNotifbyUser()->getRow();
        $resp = [
            'status' => 'success',
            'number' => $number->total
        ];
        return $this->response->setJSON($resp)->setStatusCode(200);
    }

    public function notifPage()
    {
        helper(['admin_helper']);
        $model = new UserNotifModel();
        $menu = getMenu($user='Admin');
        // $tags = $this->model->findAll();
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Notification']),
			'page_title' => view('partials/page-title', ['title' => 'Notification', 'li_1' => 'Intranet', 'li_2' => 'View_Notif']),
			'modules' => $menu,
            'route'=>'notification',
            'menuname' => 'View_Notif',
            'page'=>'',
            'data' => $model->getNotif()->getResult()
                // 'title' => '$title',
                // 'periode' => '$periode'
		];
        return view('v_notif',$data);
    }
}
