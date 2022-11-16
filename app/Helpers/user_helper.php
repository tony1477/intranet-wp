<?php
function getKebijakanData(){
    $db = db_connect();
    return $result = $db->query("select Id,No_SOP,Name_Document,Name_Document2,Code_Department,Name_Department,Name_File,Name_File2,Name_File3,(f2+f3+f4+f5) as hit from (select a.iddokumen as Id, dok_nosop as No_SOP, dok_nmsop as Name_Document, dok_nmsop2 as Name_Document2, c.dep_kode as Code_Department, c.dep_nama as Name_Department, dok_nmfile as Name_File, dok_nmfile2 as Name_File2, dok_nmfile3 as Name_File3, b.kat_kode as Code_Category,kat_nama as Name_Category,
    (select if(dok_nmfile<>'',1,0)) as f1,(select if(dok_nmfile2<>'',1,0)) as f2,(select if(dok_nmfile3<>'',1,0)) as f3,
    (select if(dok_nmfile4<>'',1,0)) as f4,(select if(dok_nmfile5<>'',1,0)) as f5
      from sop_ifmdokumen a
      join sop_ifmkategori b on b.idkategory = a.idkategory 
      join tbl_ifmdepartemen c on c.iddepartment = a.iddepartment
      where b.idkategory = 1 and a.dok_aktif=1 and a.dok_publish=1) z
      order by Id asc")->getResult();
}

function getManualData(){
    $db = db_connect();
    return $result = $db->query("select Id,No_SOP,Name_Document,Name_Document2,Code_Department,Name_Department,Name_File,Name_File2,Name_File3,(f2+f3+f4+f5) as hit from (select a.iddokumen as Id, dok_nosop as No_SOP, dok_nmsop as Name_Document, dok_nmsop2 as Name_Document2, c.dep_kode as Code_Department, c.dep_nama as Name_Department, dok_nmfile as Name_File, dok_nmfile2 as Name_File2, dok_nmfile3 as Name_File3, b.kat_kode as Code_Category,kat_nama as Name_Category,
    (select if(dok_nmfile<>'',1,0)) as f1,(select if(dok_nmfile2<>'',1,0)) as f2,(select if(dok_nmfile3<>'',1,0)) as f3,
    (select if(dok_nmfile4<>'',1,0)) as f4,(select if(dok_nmfile5<>'',1,0)) as f5
      from sop_ifmdokumen a
      join sop_ifmkategori b on b.idkategory = a.idkategory 
      join tbl_ifmdepartemen c on c.iddepartment = a.iddepartment
      where b.idkategory = 2 and a.dok_aktif=1 and a.dok_publish=1) z
      order by Id asc")->getResult();
}

function getSOPData(){
  $db = db_connect();
  return $result = $db->query("select Id,No_SOP,Name_Document,Name_Document2,Code_Department,Name_Department,Name_File,Name_File2,Name_File3,(f2+f3+f4+f5) as hit from (select a.iddokumen as Id, dok_nosop as No_SOP, dok_nmsop as Name_Document, dok_nmsop2 as Name_Document2, c.dep_kode as Code_Department, c.dep_nama as Name_Department, dok_nmfile as Name_File, dok_nmfile2 as Name_File2, dok_nmfile3 as Name_File3, b.kat_kode as Code_Category,kat_nama as Name_Category,
  (select if(dok_nmfile<>'',1,0)) as f1,(select if(dok_nmfile2<>'',1,0)) as f2,(select if(dok_nmfile3<>'',1,0)) as f3,
  (select if(dok_nmfile4<>'',1,0)) as f4,(select if(dok_nmfile5<>'',1,0)) as f5
    from sop_ifmdokumen a
    join sop_ifmkategori b on b.idkategory = a.idkategory 
    join tbl_ifmdepartemen c on c.iddepartment = a.iddepartment
    where b.idkategory = 3 and a.dok_aktif=1 and a.dok_publish=1) z
    order by Id asc")->getResult();
}

function getInstruksiKerjaData(){
  $db = db_connect();
  return $result = $db->query("select Id,No_SOP,Name_Document,Name_Document2,Code_Department,Name_Department,Name_File,Name_File2,Name_File3,(f2+f3+f4+f5) as hit from (select a.iddokumen as Id, dok_nosop as No_SOP, dok_nmsop as Name_Document, dok_nmsop2 as Name_Document2, c.dep_kode as Code_Department, c.dep_nama as Name_Department, dok_nmfile as Name_File, dok_nmfile2 as Name_File2, dok_nmfile3 as Name_File3, b.kat_kode as Code_Category,kat_nama as Name_Category,
  (select if(dok_nmfile<>'',1,0)) as f1,(select if(dok_nmfile2<>'',1,0)) as f2,(select if(dok_nmfile3<>'',1,0)) as f3,
  (select if(dok_nmfile4<>'',1,0)) as f4,(select if(dok_nmfile5<>'',1,0)) as f5
    from sop_ifmdokumen a
    join sop_ifmkategori b on b.idkategory = a.idkategory 
    join tbl_ifmdepartemen c on c.iddepartment = a.iddepartment
    where b.idkategory = 4 and a.dok_aktif=1 and a.dok_publish=1) z
    order by Id asc")->getResult();
}

function getLainnyaData(){
  $db = db_connect();
  return $result = $db->query("select Id,No_SOP,Name_Document,Name_Document2,Code_Department,Name_Department,Name_File,Name_File2,Name_File3,(f2+f3+f4+f5) as hit from (select a.iddokumen as Id, dok_nosop as No_SOP, dok_nmsop as Name_Document, dok_nmsop2 as Name_Document2, c.dep_kode as Code_Department, c.dep_nama as Name_Department, dok_nmfile as Name_File, dok_nmfile2 as Name_File2, dok_nmfile3 as Name_File3, b.kat_kode as Code_Category,kat_nama as Name_Category,
  (select if(dok_nmfile<>'',1,0)) as f1,(select if(dok_nmfile2<>'',1,0)) as f2,(select if(dok_nmfile3<>'',1,0)) as f3,
  (select if(dok_nmfile4<>'',1,0)) as f4,(select if(dok_nmfile5<>'',1,0)) as f5
    from sop_ifmdokumen a
    join sop_ifmkategori b on b.idkategory = a.idkategory 
    join tbl_ifmdepartemen c on c.iddepartment = a.iddepartment
    where b.idkategory = 5 and a.dok_aktif=1 and a.dok_publish=1) z
    order by Id asc")->getResult();
}

// bx bxs-card, bx bxs-report, bx bxs-bar-chart-alt-2, bx bx-trending-up, bx bx-bar-chart-square, bx bx-laptop, 
?>