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

    public function getUserbyDoc($docId)
    {
        $sql = "select * from (select a.user_kode,a.dok_nosop
            from sop_ifmdokumenuser a
            left join tbl_ifmuser b on b.user_kode = a.user_kode 
            where b.user_blokir = 'Tidak'
            and a.dok_nosop = '001.SKM.MNGT.I.2022'
            union 
            select user_kode,null from tbl_ifmuser c
            where c.user_blokir = 'Tidak'
            ) z group by z.user_kode
            order by dok_nosop desc, user_kode asc";
        // $this->db->query($sql,);
        return $this->db->query($sql)->getResult();
    }
}
