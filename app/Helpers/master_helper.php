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
    return $db->query("select a.idstrukturorg as Id, a.stg_kode as Code_Structureorg, a.stg_nama as Name_Structureorg, a.stg_nama2 as Name_Structureorg2, a.stg_nmfile as Name_File, a.stg_cover as Cover, a.stg_publish as Publish, a.stg_aktif as Status, a.stg_default as Cover2, b.dep_nama as Name_Department
    from sop_ifmstrukturorg a
    join tbl_ifmdepartemen b on b.iddepartment = a.iddepartment")->getResult();
}

function getKategory() {
    $db = db_connect();
    return $db->query("select a.idkategory as Id, kat_kode as Code_Category, kat_nama as Name_Category, kat_nama2 as Name_Category2
    from sop_ifmkategori a")->getResult();
}

function getPosition() {
    $db = db_connect();
    return $db->query("select idjabatan as Id, jab_kode as Code_Position, jab_nama as Name_Position, jab_nama2 as Name_Position2
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