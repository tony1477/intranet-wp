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
<p>Bersama ini kami sampaikan bahwa dengan adanya permohonan bantuan kepada Dept. IT. Untuk itu kami informasikan kepada Bapak/Ibu Kepala Divisi/Departemen untuk melakukan review dan approval permohonan bantuannya. Dengan detail dibawah ini sebagai berikut : </p><br />
<table>
    <tbody>
        <tr>
            <td>Hari / Tanggal </td>
            <td>: <span class="bold"><?=hariIndo(date('D',strtotime($data['ticketdate'])))?> / <?=date('d F Y',strtotime($data['ticketdate']))?></span></td>
        </tr>
        <tr>
            <td>Permohonan</td>
            <td>: <span class="bold"><?=$data['request']?></span></td>
        </tr>
        <tr>
            <td>Alasan</td>
            <td>: <span class="bold"><?=$data['reason']?></span></td>
        </tr>
    </tbody>
</table><br />
Untuk melakukan review / approval dapat mengunjungi link berikut : <a href="<?=base_url()?>/list-helpdesk" target="_blank" alt="Review dan Approval Helpdesk">Review & Approval IT Helpdesk</a>
<p>Demikian hal ini disampaikan, atas perhatian dan kerjasama dari Bapak/Ibu saya ucapkan terimakasih.</p><br />

<p class="italic">Regards,</p><br />

<p>Intranet Service</p>
<p class="bold">Wilian Perkasa</p>
<p class="italic">be Wise be Excellent</p>
</body>
</html>