<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" href="/assets/libs/glightbox/css/glightbox.min.css">
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

        <?php foreach($data as $row):?>
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-sm order-2 order-sm-1">
                                        <div class="d-flex align-items-start mt-3 mt-sm-0">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img src="/assets/images/meeting-rooms/<?=$row->foto_ruangan?>" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-16 mb-1"><?=$row->nama_ruangan?></h5>
                                                    <p class="text-muted font-size-13"><?=$row->lokasi_ruangan?></p>

                                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                        <?php if($row->fitur != '') {
                                                            $arr = explode(',',$row->fitur);
                                                            foreach($arr as $fitur) : ?>
                                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?=$fitur?></div>
                                                        <?php endforeach; } ?>
                                                        <a href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($row->nama_ruangan))?>">
                                                        <!-- 
                                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>phyllisgatlin@minia.com</div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto order-1 order-sm-2">
                                        <div class="d-flex align-items-start justify-content-end gap-2">
                                            <div><a href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($row->nama_ruangan))?>">
                                                <button type="button" class="btn btn-soft-light"><i class="me-1"></i> Ajukan Peminjaman</button></a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start justify-content-start gap-2 mt-2 mx-2">
                                            <div><a href="javascript:void()" onclick="history.back()">
                                                <button type="button" class="btn btn-soft-light"><i class="bx bx-arrow-back font-size-16 align-middle me-2"></i> Kembali </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">Overview</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="tab-content">
                            <div class="tab-pane active" id="overview" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <div class="pb-3">
                                                <div class="row">
                                                    <div class="col-xl-2">
                                                        <div>
                                                            <h5 class="font-size-15"></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl">
                                                        <div class="text-muted">
                                                            <p class="mb-2"><?=$row->keterangan?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="py-3">
                                                <div class="row">
                                                    <div class="col-xl-2">
                                                        <div>
                                                            <h5 class="font-size-15">Foto :</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl">
                                                        <div class="text-muted">
                                                        <a href="/assets/images/meeting-rooms/<?=$row->foto_ruangan?>" class="image-popup">
                                                        <img src="/assets/images/meeting-rooms/<?=$row->foto_ruangan?>" class="img-fluid me-2">
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->

                                
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Pengguna Terakhir</h5>
                                <div class="d-flex flex-wrap gap-2 font-size-16">
                                    <?php if($row->dep_kode!='') {
                                        $arr = explode(',',$row->dep_kode);
                                        foreach($arr as $list): ?>
                                        <a href="#" class="badge badge-soft-primary"><?=$list?></a>
                                    <?php endforeach; } ?>
                                    <?php if($row->dep_kode == '') { ?>
                                        <a href="#" class="badge badge-soft-primary">No History</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Status Ruangan</h5>

                                <div>
                                    <button class="btn btn-success "> Available</button>
                                    <ul class="list-unstyled mb-0">
                                        <!-- <li>
                                            <span class="font-size-14  mb-1">IACC</span> - 10:30</a>
                                        </li>
                                        <li>
                                            <span class="font-size-14  mb-1">IT</span> - 10:30</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="#" class="py-2 d-block text-muted"><i class="mdi mdi-web text-primary me-1"></i> IT - 13:30</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <?php endforeach;?>
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
<script src="/assets/libs/glightbox/js/glightbox.min.js"></script>
<script type="text/javascript">
    var lightbox=GLightbox({selector:".image-popup",title:!1})
</script>

</body>

</html>