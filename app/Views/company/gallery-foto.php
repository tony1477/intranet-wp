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

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">Gallery Foto <span class="text-muted fw-normal ms-2"><!-- INI DIISI NANTI --></span></h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="#" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add New</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="">
                                <img src="assets/images/small/img-3.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">10 Apr, 2022</p>
                                <h5 class=""><a href="#" class="text-dark">Beautiful Day with Friends</a></h5>
                                <p class="mb-0 font-size-15">Contrary to popular belief, Lorem Ipsum is not simply random text,a Latin professor at Hampden-Sydney College in Virginia.</p>
                                <div class="mt-3">
                                    <a href="#" class="align-middle font-size-15">Read more <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="">
                                <img src="assets/images/small/img-2.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">24 May, 2022</p>
                                <h5 class=""><a href="#" class="text-dark">Drawing a sketch</a></h5>
                                <p class="mb-0 font-size-15">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                <div class="mt-3">
                                    <a href="#" class="align-middle font-size-15">Read more <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="">
                                <img src="assets/images/small/img-1.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">12 june, 2022</p>
                                <h5 class=""><a href="#" class="text-dark">Project discussion with team</a></h5>
                                <p class="mb-0 font-size-15">Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words.</p>
                                <div class="mt-3">
                                    <a href="#" class="align-middle font-size-15">Read more <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="">
                                <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">10 July, 2022</p>
                                <h5 class=""><a href="#" class="text-dark">Morning with Photoshoot</a></h5>
                                <p class="mb-0 font-size-15">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                <div class="mt-3">
                                    <a href="#" class="align-middle font-size-15">Read more <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="">
                                <img src="assets/images/small/img-3.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">16 June, 2022</p>
                                <h5 class=""><a href="#" class="text-dark">Coffee with friends</a></h5>
                                <p class="mb-0 font-size-15">Contrary to popular belief, Lorem Ipsum is not simply random text,a Latin professor at Hampden-Sydney College in Virginia.</p>
                                <div class="mt-3">
                                    <a href="#" class="align-middle font-size-15">Read more <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="">
                                <img src="assets/images/small/img-5.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">22 May, 2022</p>
                                <h5 class=""><a href="#" class="text-dark">Working day with our new ideas</a></h5>
                                <p class="mb-0 font-size-15">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                <div class="mt-3">
                                    <a href="#" class="align-middle font-size-15">Read more <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->                            
                </div>
                <!-- end row -->

                <div class="row justify-content-center mb-4">
                    <div class="col-md-3">
                        <div class="">
                            <ul class="pagination mb-sm-0">
                                <li class="page-item disabled">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">4</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">5</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
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

<script src="assets/js/app.js"></script>

</body>

</html>