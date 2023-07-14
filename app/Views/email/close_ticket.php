<!DOCTYPE html>
<head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');
</style>
<style>
    table {
        width: 75vw;
    }
    p,b,em,h1,h2,h3,h4,h5,table,thead,tbody,tr,th,td {
        margin:0;
        padding:0;
        /* line-height:auto; */
        border:0;
        font-size: 100%;
    	font: inherit;
    	vertical-align: baseline;
    }
    div {
        display: inline;
    }
    .bold {
        font-weight: bold;
    }

    .italic {
        font-style: italic;
    }
</style>
</head>
<body>
<?php
    // $date = '2023-02-03';

    function hariIndo(string $hari): string {
        switch($hari) {
            case 'Sun':
            $str = 'Minggu';
            break;

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
        }
        return $str;
    }
?>
<p class="bold">Kepada Yth</p>
<p class="bold">Bapak/ Ibu Kepala Divisi/Departemen</p>
<p>di Tempat</p><br />

<p>Dengan hormat,</p><br />
<p>Bersama ini kami sampaikan bahwa permohonan bantuan kepada Dept. IT pada case <strong>"<?=$data['user_request']?>"</strong> telah berhasil diselesaikan pada tanggal <?=date('d/M/Y')?> jam <?=date('H:i')?> </p>

<p>Demikian hal ini disampaikan, atas perhatian dan kerjasama dari Bapak/Ibu kami ucapkan terimakasih.</p><br />
<?php //print_r($data['mailtoUser'])?>
<p class="italic">Regards,</p><br />

<p>Intranet Service</p>
<p class="bold">Wilian Perkasa</p>
<p class="italic">be Wise be Excellent</p>
</body>
</html>