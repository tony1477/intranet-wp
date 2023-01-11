<?php

function getGroupDivisi() {
    $db = db_connect();
    return $db->query("select a.iddivisigroup as Id, a.gdiv_kode as Code_GroupDivisi, a.gdiv_nama as Name_GroupDivisi, a.gdiv_nama2 as Name_GroupDivisi2,user_c as User_Created, a.user_m as User_Modified from tbl_ifmdivisigroup a ")->getResult();
}

function getDivisi() {
    $db = db_connect();
    return $db->query("select a.iddivisi as Id, a.div_kode as Code_Divisi, a.div_nama as Name_Divisi, a.div_nama2 as Name_Divisi2, a.user_c as User_Created, a.user_m as User_Modified, b.iddivisigroup, b.gdiv_nama as Name_GroupDivisi
    from tbl_ifmdivisi a 
    join tbl_ifmdivisigroup b on b.iddivisigroup = a.iddivisigroup")->getResult();
}

function getDepartment() {
    $db = db_connect();
    return $db->query("select a.iddepartment as Id, a.dep_kode as Code_Department, a.dep_nama as Name_Department, a.dep_nama2 as Name_Department2,a.user_c as User_Created, a.user_m as User_Modified, b.div_nama as Name_Divisi, b.iddivisi
    from tbl_ifmdepartemen a 
    join tbl_ifmdivisi b on b.iddivisi = a.iddivisi")->getResult();
}

function getStrukturOrg() {
    $db = db_connect();
    return $db->query("select a.idstrukturorg as Id, a.stg_kode as Code_Structureorg, a.stg_nama as Name_Structureorg, a.stg_nama2 as Name_Structureorg2, concat(substr(a.stg_nmfile,1,10),'...',substr(a.stg_nmfile,-8,8)) as Name_File, a.stg_nmfile as Full_Name_File, a.stg_cover as Cover, if(a.stg_publish='Y','YES','NO') as Publish, if(a.stg_aktif='Y','YES','NO') as Status, if(a.stg_default='Y','YES','NO') as Cover2, b.dep_nama as Name_Department
    from sop_ifmstrukturorg a
    join tbl_ifmdepartemen b on b.iddepartment = a.iddepartment")->getResult();
}

function getKategory() {
    $db = db_connect();
    return $db->query("select a.idkategory as Id, kat_kode as Code_Category, kat_nama as Name_Category, kat_nama2 as Name_Category2
    from sop_ifmkategori a")->getResult();
}

function getDocument() {
    $db = db_connect();
    return $db->query("select a.iddokumen as Id, dok_nosop as No_SOP, dok_nmsop as Name_Document, dok_nmsop2 as Name_Document2, c.dep_kode as Code_Department, c.dep_nama as Name_Department, 
    if(dok_nmfile<>'',concat(substr(dok_nmfile,1,10),'...',substr(dok_nmfile,-5,5)),'') as Name_File, dok_nmfile as Full_Name_File, 
    if(dok_nmfile2<>'',concat(substr(dok_nmfile2,1,10),'...',substr(dok_nmfile2,-5,5)),'') as Name_File2, dok_nmfile2 as Full_Name_File2, 
    if(dok_nmfile3<>'',concat(substr(dok_nmfile3,1,10),'...',substr(dok_nmfile3,-5,5)),'') as Name_File3,dok_nmfile3 as Full_Name_File3, b.kat_kode as Code_Category,kat_nama as Name_Category, if(dok_publish='Y','YES','NO') as Publish, if(dok_aktif='Y','YES','NO') as Status, dok_cover as Cover2
    from sop_ifmdokumen a
    join sop_ifmkategori b on b.idkategory = a.idkategory
    join tbl_ifmdepartemen c on c.iddepartment = a.iddepartment")->getResult();
}

function getPosition() {
    $db = db_connect();
    return $db->query("select idjabatan as Id, no_urut as No_Urut, jab_kode as Code_Position, jab_nama as Name_Position, jab_nama2 as Name_Position2,user_c User_Created, user_m as User_Modified
    from tbl_ifmjabatan a")->getResult();
}

function getGroupUser() {
    $db = db_connect();
    return $db->query("select idgroupuser as Id, guser_kode as Code_GroupUser, guser_nama as Name_GroupUser, guser_nama2 as Name_GroupUser2
    from tbl_ifmusergroup a")->getResult();
}

function getUser() {
    $db = db_connect();
    return $db->query("select a.iduser as Id, user_kode as Code_User, user_nama as Name_User, user_pwd as Pwd_User, user_email as Email_User, if(user_blokir='Tidak','NO','YES') 
    as Blokir_User, user_fhoto as Photo_User
    from tbl_ifmuser a")->getResult();
}

function getUsers() {
    $db = db_connect();
    return $db->query("select id as Id, username as Name_User, fullname as Fullname, user_image as Photo_User, if(active=1,'YES','NO') as Active, email as Email, '***' as Pwd_User
    from users ")->getResult();
}