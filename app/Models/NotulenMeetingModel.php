<?php

namespace App\Models;

use App\Entities\NotulenMeeting;
use CodeIgniter\Model;

class NotulenMeetingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'notulen';
    protected $primaryKey       = 'notulenid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = NotulenMeeting::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idpeminjaman','title','starttime','endtime','notulis','sign_notulis','keyperson','recordstatus'];

    // Dates
    protected $useTimestamps = false;   
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getdata(int $userid=0,int $id=0)
    {
        return $this->db->table('notulen a')
            ->select("a.notulenid, b.agenda, a.title, a.starttime , a.endtime, a.notulis , a.sign_notulis,a.keyperson, if(a.recordstatus=1,'Input By User','Approved') as status,(select nama_ruangan from data_ruangan a where a.idruangan = b.idruangan) as nama_ruangan")
            ->join('peminjaman_ruangan b','b.idpeminjaman = a.idpeminjaman')
            ->join('peserta_meeting c','c.idpeminjaman = b.idpeminjaman')
            ->where(($userid!=0 ? 'c.userid' : 'a.notulenid'),($userid!=0 ? $userid : $id))
            ->whereNotIn('a.recordstatus',[0])
            ->get();
    }

    public function countdata(int $userid)
    {
        return $this->db->table('notulen a')
            ->select('ifnull(count(1),0) as total')
            ->join('peminjaman_ruangan b','b.idpeminjaman = a.idpeminjaman')
            ->join('peserta_meeting c','c.idpeminjaman = b.idpeminjaman')
            ->where('c.userid' ,$userid)
            ->get();
    }

    public function getdetailbyId(int $id)
    {
        // return $this->db->table('notulendetail a')
        //     ->select('isheader, content, 
        //         case 
        //             when classification = 1 then "PERLU KEPUTUSAN"
        //             when classification = 2 then "UNTUK TINDAK LANJUT"
        //             when classification = 3 then "SEBAGAI INFORMASI"
        //             else "-"
        //             END as classification
        //     , pic_from, pic_to, targetdate, description')
        //     ->join('notulen b','b.notulenid = a.notulenid')
        //     ->where('a.notulenid',$id)
        //     ->get();
        $sql = 'select a.notulendetailid as detailid, b.notulenid, isheader, content, b.recordstatus,
                case 
                    when classification = 1 then "PERLU KEPUTUSAN"
                    when classification = 2 then "UNTUK TINDAK LANJUT"
                    when classification = 3 then "SEBAGAI INFORMASI"
                    else "-"
                    end as classification,
                    classification type,
                pic_from, pic_to, targetdate, description,status,reason,
                case
                    when status=1 then "Done"
                    when status=2 then "Pending"
                    when status=3 then "Cancel"
                end as statfeedback
                from notulendetail a
                join notulen b on b.notulenid = a.notulenid
                where a.notulenid = :id:';
        return $this->query($sql,['id'=>$id]);
                
    }

    public function getMeetingbyUser($userid)
    {
        $userid = explode(',',$userid);
        return $this->db->table('peminjaman_ruangan a')
        // ->select('a.idpeminjaman as Id, concat(a.agenda," (",date_format(tgl_mulai, "%d/%M/%Y"),")") as Agenda')
        ->select('a.idpeminjaman as Id, agenda as Agenda')
        ->distinct('Id, Agenda')
        ->join('peserta_meeting pm', 'a.idpeminjaman = pm.idpeminjaman')
        ->whereIn('pm.userid',$userid) 
        ->where('a.status',3)
        ->orderBy('a.idpeminjaman','desc')
        ->orderBy('tgl_mulai','desc')
        ->get();
    }

    public function checkPermittedUser(int $userid, int $id)
    {
        $query = $this->db->table('notulen a')
            ->select('ifnull(count(1),0) as total')
            ->join('peminjaman_ruangan b','b.idpeminjaman = a.idpeminjaman')
            ->join('peserta_meeting c','c.idpeminjaman = b.idpeminjaman')
            ->where('c.userid',$userid)
            ->where('a.notulenid',$id)
            ->get();
        if($query->getRow()) return $query->getRow()->total;
        return false;
        
    }

    public function getPeserta(int $id)
    {
        return $this->db->table('peserta_meeting a')
            ->select('nama_peserta,bagian,email')
            ->join('notulen b','b.idpeminjaman = a.idpeminjaman')
            ->where('b.notulenid',$id)
            ->get();
    }

    public function saveNotes($data)
    {
        $sql = 'insert into notulendetail(notulenid,isheader,content,classification,pic_from,pic_to,targetdate,description)
        values(:notulenid:,:isheader:,:content:,:classification:,:pic_from:,:pic_to:,:targetdate:,:description:)';
        return $this->query($sql,[
            'notulenid'=>$data['notulenid'],
            'isheader'=>$data['isheader'],
            'content'=>$data['content'],
            'classification'=>$data['classification'],
            'pic_from'=>$data['pic_from'],
            'pic_to'=>$data['pic_to'],
            'targetdate'=>$data['targetdate'],
            'description'=>$data['description'],
        ]);
    }

    public function updateNotes($data)
    {
        $sql = 'update notulendetail set isheader=:isheader:, content=:content:, classification=:classification:, pic_from=:pic_from:, pic_to=:pic_to:, targetdate=:targetdate:, description=:description: where notulendetailid=:notulendetailid:';
        return $this->query($sql,[
            'isheader'=>$data['isheader'],
            'content'=>$data['content'],
            'classification'=>$data['classification'],
            'pic_from'=>$data['pic_from'],
            'pic_to'=>$data['pic_to'],
            'targetdate'=>$data['targetdate'],
            'description'=>$data['description'],
            'notulendetailid'=>$data['notulendetailid'],
        ]);
    }

    public function deleteDetail($id)
    {
        $sql = 'delete from notulendetail where notulendetailid = :id:';
        return $this->query($sql,['id'=>$id]);
    }

    public function approve(int $id, int $userid)
    {
        $this->db->transStart(); 
        $sql = 'call approveNotulen(:id:,:userid:)';
        $this->db->query($sql,['id'=>$id, 'userid'=>$userid]);
        $this->db->transComplete();
        if($this->db->transStatus() === false) return false;
        return true;
    }

    public function cancel(int $id, int $userid)
    {
        $this->db->transStart(); 
        $sql = 'call deleteNotulen(:id:,:userid:)';
        $this->db->query($sql,['id'=>$id, 'userid'=>$userid]);
        $this->db->transComplete();
        if($this->db->transStatus() === false) return false;
        return true;
    }

    public function updatefeedback(array $data)
    {
        $this->db->transStart();
        $sql = 'call updateFeedback(:id:,:status:,:reason:)';
        $this->db->query($sql,['id'=>$data['id'], 'status'=>$data['status'], 'reason'=>$data['reason']]);
        $this->db->transComplete();
        if($this->db->transStatus() === false) return false;
        return true;
    }

}
