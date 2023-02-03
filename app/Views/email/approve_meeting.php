
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');
</style>
<style>
    body {
        font-family: 'Nunito', sans-serif !important;
    }
    table {
        max-width: 75vw;
    }
</style>
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
<h4>Kepada Yth Bapak/Ibu Peserta Meeting</h3>


Berikut informasi penggunaan ruangan meeting yang telah disetujui oleh GA.<br />

Tanggal Meeting  : <?=hariIndo(date('D',strtotime($data->tgl_mulai)))?>, <?=date('d-m-Y',strtotime($data->tgl_mulai))?> <br />
Jam Meeting : <?=date('H:i',strtotime($data->jam_mulai))?> <br />
Pembicara : <?=$data->pemateri?><br />
Peserta Meeting :  <br />
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Bagian/Department</th>
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
            <td><?=$i?></td>
            <td><?=$row->nama_peserta?></td>
            <td><?=$row->bagian?></td>
        </tr>
    <?php $i++; endforeach;?>
    </tbody>
</table>
Agenda Meeting : <strong><?=$data->agenda?></strong><br />
Ruangan : <?=$room['nama_ruangan']?><br />
Kebutuhan : <?=$data->kebutuhan?><br />
<br /><br />

Kindly Regards,<br /></br /><br />

Intranet Service Wilian Perkasa<br />
<h4>Wilian Perkasa</h4><br />
<h5><em>be Wise be Excellent</em></h5>