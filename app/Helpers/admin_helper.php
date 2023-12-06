<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}

function getDayIndo(string $date) :string {
  $str = '';
  switch($date) {
    case 'Mon':
      $str = 'Senin';
      break;

    case 'Tue':
      $str = 'Selasa';
      break;
    
    case 'Wed':
      $str = 'Rabu';
      break;
    
    case 'Thu':
      $str = 'Kamis';
      break;

    case 'Fri':
      $str = 'Jumat';
      break;

    case 'Sat':
      $str = 'Sabtu';
      break;

    default:
      $str = 'Minggu';
  }
  return $str;
}

function getMenu($user) {
  // $user = $_SESSION['users'];
  $db = db_connect();
  return $result = $db->query("select * from module order by urutan asc")->getResult();
}

function getSubmenu($moduleid) {
  $db = db_connect();
  return $db->query("select * from menu where moduleid = {$moduleid} and recordstatus = 1 order by urutan asc")->getResult();
}

function getDetailMenu($menuid) {
  $db = db_connect();
  return $db->query("select * from menu where moduleid = {$menuid} and recordstatus = 1 order by urutan asc")->getResult();
}

function getImageSlider()
{
  $db = db_connect();
  return $db->query("select * from gallery where islogin=1 and status=1")->getResult();
}

// bx bxs-card, bx bxs-report, bx bxs-bar-chart-alt-2, bx bx-trending-up, bx bx-bar-chart-square, bx bx-laptop, 
?>