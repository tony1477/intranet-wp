<!DOCTYPE html>
<head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');
</style>
<style>
    body {
        /* font-family: 'Nunito', sans-serif !important; */
    }
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
<p class="bold">Bapak/ Ibu Peserta Meeting</p>
<p>di Tempat</p><br />

<p>Dengan hormat,</p><br />
<p>Bersama ini saya undang Bapak/Ibu untuk dapat hadir pada meeting yang akan dilaksanakan pada : </p><br />
<table>
    <tbody>
        <tr>
            <td>Hari / Tanggal </td>
            <td>: <span class="bold"><?=hariIndo(date('D',strtotime($data->tgl_mulai)))?> / <?=date('d F Y',strtotime($data->tgl_mulai))?></td>
        </tr>
        <tr>
            <td>Jam</td>
            <td>: <?=date('H:i',strtotime($data->jam_mulai))?> s/d <?=date('H:i',strtotime($data->jam_selesai))?></td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: <?=$room['nama_ruangan']?></td>
        </tr>
        <tr>
            <td>Pemateri</td>
            <td>: <?=$data->pemateri?></td>
        </tr>
        <tr>
            <td>Agenda</td>
            <td>: <span class="bold"><?=$data->agenda?></span></td>
        </tr>
    </tbody>
</table><br />
Untuk peserta yang mengikuti meeting, antara lain : <br />
</table>
<table>
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
<?php 
    $i=1;
    // $roomname = 'Intellectual';
    // $peserta[] = (object) array(
    //     'nama' => 'Test',
    //     'bagian' => 'IT',
    //     'email' => 'it@wilianperkasa.com'
    // );
    // $peserta[] = (object) array(
    //     'nama' => 'Test',
    //     'bagian' => 'IT',
    //     'email' => 'it@wilianperkasa.com'
    // );
    foreach($peserta as $row):?>
        <tr>
            <td style="text-align:right"><?=$i?>.</td>
            <td><?=$row->nama_peserta?>&nbsp;&nbsp;(<?=$row->bagian?>)</span></td>
        </tr>
    <?php $i++; endforeach;?>
    </tbody>
</table>
<br />
<p class="bold">Notulis : <?=$data->notulis?></p>
<?php if($data->kebutuhan!= '' || $data->kebutuhan!='undefined'):?>
<p>Note untuk Tim IT : <?=$data->kebutuhan?></p><br />
<?php endif;?>
<p>Demikian hal ini disampaikan, atas perhatian dan kerjasama dari Bapak/Ibu saya ucapkan terimakasih.</p><br />

<p class="italic">Regards,</p><br />

<p>Intranet Service</p>
<p class="bold">Wilian Perkasa</p>
<p class="italic">be Wise be Excellent</p>
</body>
</html>