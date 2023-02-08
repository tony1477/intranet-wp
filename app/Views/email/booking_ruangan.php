<!DOCTPYE html>
<head>
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
<h4>Kepada Yth</h3>
<h4>GA Division</h4>

Berikut informasi peminjaman ruangan meeting yang diajukan oleh : <strong><?=$data['fullname']?></strong><br />
untuk melakukan peminjaman ruangan meeting pada : <br /><br />

Tanggal Meeting  : <?=hariIndo(date('D',strtotime($data['startdate'])))?>, <?=date('d-m-Y',strtotime($data['startdate']))?> <br />
Jam Meeting : <?=date('H:i',strtotime($data['starttime']))?> <br />
Pembicara : <?=$data['speaker']?><br />
Peserta Meeting :  <br />
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Bagian/Department</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
<?php 
    $i=1;
    $peserta = json_decode($data['table']);
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
            <td><?=$row->nama?></td>
            <td><?=$row->bagian?></td>
            <td><?=$row->email?></td>
        </tr>
    <?php $i++; endforeach;?>
    </tbody>
</table>
Agenda Meeting : <strong><?=$data['agenda']?></strong><br />
Ruangan : <?=$data['roomname']?><br />
Kebutuhan : <?=($data['requirement']!='undefined' ? $data['requirement'] : '')?><br />
Link untuk Review dan Approval : <a href="<?=base_url()?>/meeting-schedule">Disini</a>
<br /><br />

Kindly Regards,<br /></br /><br />

Intranet Service Wilian Perkasa<br />
<h4>Wilian Perkasa</h4>
<em>be Wise be Excellent</em>
</body>
</html>