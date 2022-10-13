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
                            <div class="card-header">
                               <div class="row">
                                <div class="col-7">
                                <h4 class=" card-title mt-2">Jadwal Ruangan <?=$nama?></h4>
                                </div>
                                <div class="col-5 text-end">
                                <button class="btn btn-light waves-effect waves-light" onclick="history.back()"><i class="bx bx-arrow-back font-size-16 align-middle me-2"></i>Kembali</button>
                                </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">

                                <div class="row justify-content-center">
                                    <div class="col-xl-10">
                                        <div class="timeline">
                                            <div class="timeline-container">
                                                <div class="timeline-end">
                                                    <p>Latest</p>
                                                </div>
                                                <div class="timeline-continue">
                                                    <?php $i=1; foreach($data as $row):
                                                        if($i%2==1) { ?>
                                                    <div class="row timeline-right">
                                                        <div class="col-md-6">
                                                            <div class="timeline-icon">
                                                                <!-- <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="timeline-box">
                                                                <div class="timeline-date bg-primary text-center rounded">
                                                                    <h3 class="text-white mb-0"><?=date('d',strtotime($row->tgl_mulai))?></h3>
                                                                    <p class="mb-0 text-white-50"><?=date('M',strtotime($row->tgl_mulai))?></p>
                                                                </div>
                                                                <div class="event-content">
                                                                    <div class="timeline-text">
                                                                        <h3 class="font-size-18"><?=$row->agenda?></h3><p class="mb-0 mt-2 pt-1 text-muted">Pemateri : <?=$row->pemateri?></p>
                                                                        <p class="mb-0 mt-2 pt-1 text-muted">Peserta : <?=$row->nama_peserta?><br />Jam Meeting : <?=date('H:i',strtotime($row->jam_mulai))?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }
                                                    if($i%2==0) { ?>
                                                    <div class="row timeline-left">
                                                        <div class="col-md-6 d-md-none d-block">
                                                            <div class="timeline-icon">
                                                                <!-- <i class="bx bx-user-pin text-primary h2 mb-0"></i> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="timeline-box">
                                                                <div class="timeline-date bg-primary text-center rounded">
                                                                    <h3 class="text-white mb-0"><?=date('d',strtotime($row->tgl_mulai))?></h3>
                                                                    <p class="mb-0 text-white-50"><?=date('M',strtotime($row->  tgl_mulai))?></p>
                                                                </div>
                                                                <div class="event-content">
                                                                    <div class="timeline-text text-start">
                                                                        <h3 class="font-size-18"><?=$row->agenda?></h3>
                                                                        <p class="mb-0 mt-2 pt-1 text-muted">Pemateri : <?=$row->pemateri?></p>
                                                                        <p class="mb-0 mt-2 pt-1 text-muted">Peserta: <?=$row->nama_peserta?><br />Jam Meeting : <?=date('H:i',strtotime($row->jam_mulai))?></p>

                                                                        <div class="d-flex flex-wrap align-items-start event-img mt-3 gap-2">
                                                                            <img src="assets/images/small/img-2.jpg" alt="" class="img-fluid rounded" width="60">
                                                                            <img src="assets/images/small/img-5.jpg" alt="" class="img-fluid rounded" width="60">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 d-md-block d-none">
                                                            <div class="timeline-icon">
                                                                <!-- <i class="bx bx-user-pin text-primary h2 mb-0"></i> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }
                                                    $i++; 
                                                    endforeach;?>
                                                </div>
                                                <div class="timeline-start">
                                                    <p>End</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
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