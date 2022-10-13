<?php
function getRoom() {
    $db = db_connect();
    return $db->query("select a.idruangan,nama_ruangan,lokasi_ruangan,jumlah_peserta,keterangan,foto_ruangan
    from data_ruangan a 
    where a.status=1 order by idruangan asc ")->getResult();
}

function getRoomByName($name) {
    if(strpos($name,'-')==TRUE) {
        $name = str_replace('-',' ',$name);
    }
    $db = db_connect();
    return $db->query("select a.idruangan,nama_ruangan,lokasi_ruangan,jumlah_peserta,keterangan,foto_ruangan, fitur, (
        select group_concat(kode) from (select (x.dep_kode) as kode, idruangan,tgl_mulai
        from tbl_ifmdepartemen x
        join peminjaman_ruangan y on y.iddepartment = x.iddepartment 
        group by x.iddepartment
        limit 5) z where z.idruangan = a.idruangan 
        order by tgl_mulai desc
        ) as dep_kode
    from data_ruangan a 
    where a.status=1 and nama_ruangan = '{$name}'order by idruangan asc ")->getResult();
}

function getScheduleByName($name) {
    if(strpos($name,'-')==TRUE) {
        $name = str_replace('-',' ',$name);
    }
    $db = db_connect();
    return $db->query("select a.tgl_mulai,jam_mulai,tgl_selesai,jam_selesai,a.jumlah_peserta, asal_peserta,agenda,pemateri,nama_peserta,kebutuhan, b.nama_ruangan
    from peminjaman_ruangan a
    join data_ruangan b on b.idruangan = a.idruangan
    where b.nama_ruangan = '{$name}' order by tgl_mulai desc")->getResult();
}

function getListSchedule() {
    $db = db_connect();
    return $db->query("select a.*, b.foto_ruangan, b.nama_ruangan, c.dep_nama, dep_kode,
    case when a.status = 1 then 'Menunggu Approval' when a.status = 2 then 'Sedang Digunakan' when a.status = 3 then 'Selesai' else 'Batal' end as status_kode
    from peminjaman_ruangan a 
    join data_ruangan b on b.idruangan = a.idruangan
    join tbl_ifmdepartemen c on c.iddepartment = a.iddepartment
    order by tgl_mulai desc")->getResult();
}

function getListSchedulebyDay($day=1) {
    $db = db_connect();
    
}

function getDetailSchedule($id) {
    $db = db_connect();
    return $db->query("select a.*, b.nama_ruangan
    from peminjaman_ruangan a
    join data_ruangan b on b.idruangan = a.idruangan
    where a.idpeminjaman = {$id}")->getResult();
}