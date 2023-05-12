<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/_datatables-css') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
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
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                                <h4 class="card-title"><?= lang('Files.'.$menuname)?></h4>
                            </div>
                            <div class="card-body">
                                <div class="px-4 py-5 my-5 text-center">
                                    <img class="d-block mx-auto mb-4" src="<?=base_url()?>/public/assets/images/logo-baru.png" alt="Logo WP" title="Logo Wilian Perkasa" width="72" >
                                    <h1 class="display-5 fw-bold">VISI</h1>
                                    <div class="col-lg-6 mx-auto">
                                    <p class="lead mb-4 fs-2">Meningkatkan kualitas hidup melalui pengembangan multi industri dan menjadi perusahaan yang dipercaya. <i class="fas fa-quote-right"></i></p>
                                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                        <button type="button" class="btn btn-primary btn-lg px-4 gap-3" data-bs-toggle="collapse" data-bs-target="#misi" aria-expanded="false" aria-controls="misi">MISI</button>
                                        </div>
                                    </div>
                                    <div class="collapse " id="misi">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                        <p class="mb-4 mt-4 misi">
                                            <ul class="list-misi">
                                                <li>Menyediakan produk alami untuk bisnis maupun pelanggan dengan memberikan harga yang kompetitif dan mutu yang baik</li>
                                                <li>Menyediakan berbagai kesempatan bagi karyawan dan komunitas local agar mereka mempunyai standar kehidupan yang lebih baik</li>
                                                <li>Bertansformasi menjadi perusahaan dengan manajemen yang professional dan system yang terintegrasi</li>
                                        </p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
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

<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>

<!-- Datatables Full -->
<?= $this->include('partials/_datatable-js') ?>

<?= $this->include('partials/_home-js') ?>