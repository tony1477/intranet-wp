<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?> 

    <?= $this->include('partials/head-css') ?>

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
                                <?php foreach($data as $row): ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <h5 class="font-size-15 mb-3"><?=lang('Files.Event')?> : </h5>
                                            <h5 class="font-size-14 mb-2"><?=$row->agenda?> (<?=$row->nama_ruangan?>)</h5>
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
                                                <p class="mb-1"><?=$row->kebutuhan?>, Zoom Meeting</p>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $arr = explode(',',$row->nama_peserta);
                                                $i=1;
                                                foreach($arr as $person) : ?>
                                                <tr>
                                                    <th scope="row"><?=$i?></th>
                                                    <td>
                                                        <h5 class="font-size-15 mb-1"></h5>
                                                        <p class="font-size-13 mb-0"><?=$person?> </p>
                                                    </td>
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


<script src="/assets/js/app.js"></script>

</body>

</html>