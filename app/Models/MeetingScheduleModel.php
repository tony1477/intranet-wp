<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\MeetingSchedule;

class MeetingScheduleModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'peminjaman_ruangan';
    protected $primaryKey       = 'idpeminjaman';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = MeetingSchedule::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['userid','idruangan','tgl_mulai','jam_mulai','jam_selesai','act_tgl_selesai','act_jam_selesai','iddepartment','jumlah_peserta','asal_peserta','agenda','pemateri','ccemail','nama_peserta','kebutuhan','notulis','status','approveby','rejectedby'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
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

    public function insertPeserta($id,$datas)
    {
        $sql='';
        foreach($datas as $data):
            $sql = ($sql != '' ? $sql.",(".$id.",'".$data->nama."','".$data->bagian."','".$data->email."')" : "(".$id.",'".$data->nama."','".$data->bagian."','".$data->email."')");
        endforeach;

        $values = "VALUES".$sql;
        // var_dump($values);
        $this->db->query("insert into peserta_meeting(idpeminjaman,nama_peserta,bagian,email) {$values}");
    }

    public function getPesertaMeeting($idpeminjaman)
    {
        return $this->db->query("select nama_peserta,bagian,email from peserta_meeting where idpeminjaman = ".$idpeminjaman);
    }

    public function checkAvailableRoom($idroom,$startdate,$starttime,$endtime)
    {
        $query = 'select checkAvailableRoom(?,?,?,?) as status';
        $check = $this->db->query($query,[$idroom,$startdate,$starttime,$endtime]);
        
        return $check;
    }
}
