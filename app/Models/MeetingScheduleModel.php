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
    protected $allowedFields    = ['userid','idruangan','tgl_mulai','jam_mulai','tgl_selesai','jam_selesai','iddepartment','jumlah_peserta','asal_peserta','agenda','pemateri','nama_peserta','kebutuhan','status'];

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
}
