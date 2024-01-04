<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?> 

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/_home-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">
    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <hr class="my-4"> -->
                                <?php foreach($data as $row):
                                switch($row->status) {
                                    case '1' :
                                    $text = '<span class="text-info">[NEED APPROVAL] </span>';
                                    break;
                                    case '2' :
                                    $text = '<span class="text-primary">[IN-USE] </span>';
                                    break;
                                    case '3' :
                                    $text = '<span class="text-success">[SELESAI] </span>';
                                    break;
                                    default: 
                                    $text = '<span class="text-danger">[CANCEL] </span>';
                                } ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <h5 class="font-size-15 mb-3"><?=lang('Files.Event')?> : </h5>
                                            <h5 class="font-size-14 mb-2"><?=$row->agenda?> (<?=$row->nama_ruangan?>) <?=$text?>
                                            
                                            </h5>
                                            <p class="mb-1"><?=lang('Files.Date')?> : <?=date('d-m-Y',strtotime($row->tgl_mulai))?></p>
                                            <p><?=lang('Files.Time')?> : <?=$row->jam_mulai?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div>
                                            <div>
                                                <h5 class="font-size-15"><?=lang('Files.Speaker')?> :</h5>
                                                <p><?=$row->pemateri?></p>
                                            </div>

                                            <div class="mt-4">
                                                <h5 class="font-size-15">Kebutuhan:</h5>
                                                <p class="mb-1"><?=$row->kebutuhan?></p>
                                            </div>
                                            <div class="float-end">
                                                <a href="#" onclick="history.back()" class="btn btn-light w-md waves-effect waves-light "> <i class="bx bx-arrow-back font-size-16 align-middle me-2"></i><?=lang('Files.Back')?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="py-2 mt-3">
                                    <h5 class="font-size-15"><?=lang('Files.Participant')?></h5>
                                </div>
                                <div class="p-4 border rounded">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 70px;">No.</th>
                                                    <th>Nama</th>
                                                    <th>Bagian</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                // if($row->nama_peserta!=null) $arr = explode(',',$row->nama_peserta);
                                                $i=1;
                                                foreach($participant as $person) : ?>
                                                <tr>
                                                    <th scope="row"><?=$i?></th>
                                                    <td><?=$person->nama_peserta?></td>
                                                    <td><?=$person->bagian?></td>
                                                    <td><?=$person->email?></td>
                                                </tr>
                                                <?php $i++; endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<?= $this->include('partials/_home-js') ?>


</body>

</html>