<p>Informasi peminjaman ruangan meeting.</p>

Mohon di lakukan review dan approval<br />
Meeting Tanggal : <?=$data['startdate']?> <br />
Pembicara : <?=$data['speaker']?><br />
Peserta Meeting :  <br />
<?php 
    $i=1;
    $peserta = json_decode($data['table']);
    foreach($peserta as $row):?>
        <?=$i.'. '.$row->nama.'('.$row->bagian.')'?><br />
    <?php $i++; endforeach;?>
Agenda Meeting : <?=$data['agenda']?><br />
Ruangan : Intellectual<br />