<?php

namespace App\Models;

use Myth\Auth\Models\UserModel as MythModel;
use App\Entities\Users;

class UsersModel extends MythModel
{
    protected $returnType = Users::class;
    protected $allowedFields = ['email', 'username','password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
    'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at','fullname','user_image','iddivisi','iddepartment','idjabatan','phoneno','nama_jabatan'];

    protected $validationRules = [
        'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];

    protected $beforeDelete    = ['deactived'];

    public function getUsers()
    {
        return $this->db->table('users a')
            ->select('a.*, if(a.active=1,"YES","NO") as aktif, b.dep_nama, div_nama, jab_nama','left')
            ->join('tbl_ifmdepartemen b','b.iddepartment = a.iddepartment','left')
            ->join('tbl_ifmdivisi c','c.iddivisi = a.iddivisi','left')
            ->join('tbl_ifmjabatan d','d.idjabatan = a.idjabatan','left')
            ->where('deleted_at',null)
            ->get();
    }

    public function deactived($data)
    {
        $update = [
            'id' => $data['id'][0],
            'active' => 0
        ];

        $this->db->table('users')
            ->set('active',0)
            ->where('id',$data['id'][0])
            ->update();
        
        return $data;
        // var_dump($data['id'][0]);
    }

    /**
     * Tambahan / Custom model
     * untuk dari table user join ke dokumen
     * mendapatkan dokumen-dokumen per user
     */

     public function getDocbyUser(string $username)
     {
         $sql = "select * from (select b.dok_nosop, b.dok_nmsop, b.iddokumen, c.username
         from userdokumen a
         left join sop_ifmdokumen b on b.iddokumen = a.iddokumen
         left join users c on c.id = a.idusers
         where c.username = '".$username."'
         and a.status=1 and c.active=1
         union
         select dok_nosop,dok_nmsop,d.iddokumen,null 
         from sop_ifmdokumen d
         where d.dok_publish=1 and d.dok_aktif=1) z group by z.dok_nosop
         order by username desc, dok_nmsop asc";
 
         return $this->db->query($sql)->getResult();
     }
 
     public function postDocUser(array $array) 
     {
         $db = \Config\Database::connect();
         $user = $db->table('users');
         $a = $db->table('userdokumen a');
         
         $cond = ['username' => $array['username']];
         // $return=false;
         try {
             $userRow = $user->select('id')->where($cond)->get()->getRow();
             //update all status to 0 
             $db->table('userdokumen')->set('status',0)->where('idusers',$userRow->id)->update();
             foreach($array as $key => $data):
                 // check if user active
                 if($key==='iddokumen'):
                     for($i=0; $i<count($data); $i++):
                         $d = $db->table('sop_ifmdokumen');
                         if($d->getWhere(['iddokumen' => $data[$i]])):
                             // echo $data[$i];
                             // check if exists in userdokumen's table
                             $a->select('b.iddokumen,a.iduserdokumen,a.idusers');
                             $a->join('sop_ifmdokumen b','a.iddokumen = b.iddokumen');
                             $a->where('a.idusers',$userRow->id);
                             $a->where('b.iddokumen',$data[$i]);
                             // echo $a->getCompiledSelect();
                             $docuser = $a->get()->getRow();
                             
                             // if exists update
                             if($docuser):
                                     $datas = [
                                         'status' => 1,
                                         'iddokumen' => $docuser->iddokumen,
                                     ];
                                     $db->table('userdokumen')->set($datas)->where('iduserdokumen',$docuser->iduserdokumen)->update();
                                     $message = lang('Files.Save_Success');
                             else:
                                 $datas = [
                                         'status' => 1,
                                         'iddokumen' => $data[$i],
                                     ];
                                 $newdata = ['idusers' => $userRow->id];
                                 $insert = array_merge($datas,$newdata);
                                 $db->table('userdokumen')->set($insert)->insert();
                                 // echo $b->getCompiledInsert();
                                 $message = lang('Files.Save_Success');
                             endif;
                         endif;
                     endfor;
                 endif;
                 // $u->find($data['idusers'])
             endforeach;
 
             $arr = array(
                 'status' => 'success',
                 'code' => 200,
                 'message' => 'OK'
             );
         }
         catch (\Exception $e) {
             $arr = array(
                 'status' => $e->getMessage(),
                 'code' => 400
             );
         }
         $response = json_encode($arr);
         return $response;
     }
}

