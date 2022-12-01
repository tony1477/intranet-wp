<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sop_ifmdokumen';
    protected $primaryKey       = 'iddokumen';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['dok_nosop','dok_nmsop','dok_nmsop2','dep_kode','iddepartment','dok_nmfile','dok_nmfile2','dok_nmfile3','dok_nmfile4','dok_nmfile5','kat_kode','dok_cover','dok_cover2','dep_key','dok_publish','dok_aktif','user_c','user_m','time_c','time_m','tgl_c','tgl_m'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_c';
    protected $updatedField  = 'tgl_m';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getUserbyDoc(string $docId)
    {
        /*
        ***
        $sql = "select * from (select a.user_kode,a.dok_nosop
            from sop_ifmdokumenuser a
            left join tbl_ifmuser b on b.user_kode = a.user_kode 
            where b.user_blokir = 'Tidak'
            and a.dok_nosop = '001.SKM.MNGT.I.2022/salah'
            union 
            select user_kode,null from tbl_ifmuser c
            where c.user_blokir = 'Tidak'
            ) z group by z.user_kode
            order by dok_nosop desc, user_kode asc";
        // $this->db->query($sql,);
        ***
        */
        $sql = "select * from (select c.username, c.fullname, c.id, b.dok_nosop
            from userdokumen a
            left join sop_ifmdokumen b on b.iddokumen = a.iddokumen
            left join users c on c.id = a.idusers
            where b.dok_nosop = '".$docId."'
            and a.status=1 and c.active=1
            union
            select username,fullname,d.id,null 
            from users d
            where d.active=1 ) z group by z.username
            order by dok_nosop desc, username asc";
        return $this->db->query($sql)->getResult();
    }

    public function getViewDoc(array $data)
    {
        $sql = "select dok_nmfile
            from sop_ifmdokumen a
            join userdokumen b on b.iddokumen = a.iddokumen
            join users c on c.id = b.idusers
            where c.username = '".$data['username']."'
            and a.dok_nosop = '".$data['dok_nosop']."' 
            and a.dok_aktif = '".$data['dok_aktif']."'
            and a.dok_publish = '".$data['dok_publish']."'
            and b.status = 1";
        return $this->db->query($sql);
    }

    public function postUserDoc(array $data) 
    {
        var_dump($data);
    }
}
