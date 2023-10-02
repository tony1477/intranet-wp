<!DOCTYPE html>
<html>
    <head>
        <title>Doc Notulen Meeting</title>
    </head>
<body>
    <img src="<?=base_url()?>/public/assets/images/logo.png" class="img-logo" /> 
    <div class="title">
        <h3>NOTULEN RAPAT DAN CATATAN TINDAK LANJUT</h3>
    </div>
    
    <table class="table-no-border">
        <tr>
            <td>TANGGAL</td>
            <td>: <?=date('d-m-Y',strtotime($data->starttime))?></td>
        </tr>
        <tr>
            <td>TEMPAT</td>
            <td>: <?=$data->nama_ruangan?></td>
        </tr>
        <tr>
            <td>WAKTU</td>
            <td>: <?=date('H:i',strtotime($data->starttime))?> s/d <?=date('H:i',strtotime($data->endtime))?></td>
        </tr>
        <tr>
            <td>TINGKAT PERTEMUAN</td>
            <td>: 
                <span class="checklist-box">&nbsp; &nbsp; &nbsp; </span> 
                <span class="text-checklist"> &nbsp; &nbsp; &nbsp; Rutin &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                <span class="checklist-box">&nbsp; &nbsp; &nbsp; </span> 
                <span class="text-checklist">&nbsp; &nbsp; &nbsp; Insidentil</span>
            </td>
        </tr>
    </table>
    <h4 style="text-decoration: underline; font-weight:bold">AGENDA RAPAT</h4>
    <div class="agenda">Meeting kordinasi kinerja department</div>
</div>
    <table class="table-no-border" style="margin-top:10px">
        <tr>
            <td style="font-weight: bold; text-decoration: underline">Pimpinan Rapat </td>
            <td width="65%">: Purwantoro</td>
        </tr>
    </table>
    <div style="margin-top:10px;"></div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" rowspan="2">No.</th>
                <th scope="col" rowspan="2">Agenda / Topik, Penjelasan dan Hasil Rapat</th>
                <th scope="col" colspan="3">KLASIFIKASI</th>
                <th scope="col" colspan="2">PIC</th>
                <th scope="col" colspan="2">REVIEW / FOLLOW UP</th>
            </tr>
            <tr>
                <th>PK</th>
                <th>UTL</th>
                <th>SI</th>
                <th>DARI</th>
                <th>UNTUK</th>
                <th>TGL</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($details as $row):?>
            <tr>
                <td scope="row"></td>
                <td <?=$row['isheader']==1 ? 'style="font-weight:bold"' : ''?>><?=$row['content']?></td>
                <td align="center"><?=($row['type']==1 ? "√" : '')?></td>
                <td align="center"><?=($row['type']==2 ? '√' : '')?></td>
                <td align="center"><?=($row['type']==3 ? "√" : '')?></td>
                <td><?=$row['pic_from']?></td>
                <td><?=$row['pic_to']?></td>
                <td><?=$row['targetdate']?></td>
                <td><?=$row['description']?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <p>Peserta Hadir Rapat ;<br/>
    <?php
    $i=1;
    foreach($peserta as $row):
        echo sprintf('%s. %s <br/>',$i,$row['nama_peserta']);
        $i++;
    endforeach;?>
    <br/>
    <table width="100%">
        <tr>
            <td width="50%">Diketahui Oleh</td>
            <td width="50%">Notulen Rapat,</td>
        </tr>
        <tr>
            <td style="padding-top:6rem"><?=$data->sign_notulis?></td>
            <td style="padding-top:6rem"><?=$data->notulis?></td>
        </tr>
    </table>
    </p>
</body>
</html>