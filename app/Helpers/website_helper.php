<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}

function getProfile($profileid) {
  // $user = $_SESSION['users'];
  $db = db_connect('website');
  return $result = $db->query("select * from article order by urutan asc")->getResult();
}

// bx bxs-card, bx bxs-report, bx bxs-bar-chart-alt-2, bx bx-trending-up, bx bx-bar-chart-square, bx bx-laptop, 
?>