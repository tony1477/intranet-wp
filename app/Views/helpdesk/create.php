<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/index.css" />
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
                            <h5 class="card-title"><?=lang('Files.Create_Ticket')?><span class="text-muted fw-normal ms-2"><!-- INI DIISI NANTI --></span></h5>
                        </div>
                    </div>
                </div>
                <!-- end row -->                

                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form IT Helpdesk</h4>
                                <p class="card-title-desc">Mohon diisi dengan lengkap dan sejelas-jelasnya.</p>
                            </div>
                            <div class="card-body p-4">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Nama Pengguna</label>
                                                <input class="form-control" type="text" value="" id="example-text-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-date-input" class="form-label">Tanggal Request</label>
                                                <input class="form-control" type="date" value="" id="example-date-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">No Telepon</label>
                                                <input class="form-control" type="tel" value="" id="example-text-input">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Masalah</label>
                                                <select class="form-select">
                                                    <option>Select</option>
                                                    <option value="1">Komputer</option>
                                                    <option value="2">Printer</option>
                                                    <option value="3">Program ERP/WB</option>
                                                    <option value="4">Zoom Meeting</option>
                                                    <option value="5">Email</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                                <label class="form-label">Lokasi</label>
                                                <select class="form-select">
                                                    <option>Select</option>
                                                    <option value="1">Kantor Pusat</option>
                                                    <option value="2">Mill</option>
                                                    <option value="3">Estate</option>    
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Department</label>
                                                <select class="form-select">
                                                    <option>Select</option>
                                                    <option value="1">MGT</option>
                                                    <option value="2">IACC</option>
                                                    <option value="3">HRGA</option>
                                                    <option value="4">FIN</option>
                                                    <option value="4">LGL</option>
                                                    <option value="5">COMM</option>
                                                    <option value="6">IT</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-email-input" class="form-label">Email Atasan</label>
                                                <input class="form-control" type="email" value="" placeholder="@wilianperkasa.com" id="example-email-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-email-input" class="form-label">Issue/Kendala</label>
                                                <textarea name="" id="" class="form-control" rows="3" placeholder="Jelaskan masalah dengan jelas"></textarea>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
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

<script src="<?=base_url()?>/public/assets/js/app.js"></script>
</body>

</html>