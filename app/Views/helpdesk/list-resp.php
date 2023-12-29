<!doctype html>
<html lang="en">
<head>
    <?= $title_meta ?>
    <!-- DataTables -->
    <link href="<?=base_url()?>/public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>/public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?=base_url()?>/public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/index.css" />
    <style>
        .accordion-button:not(.collapsed)::after {
            font-family: "Font Awesome 5 Free";
            content: "\f078";
            background-image: url();
            transform: rotate(90deg);
        }

        .accordion-button::after {
            background-image: url();
            content: "\f054";
            font-family: "Font Awesome 5 Free";
            transform: rotate(90deg);
        }

        .accordion-item {
            border-radius: .5rem;
        }

        .btn-feedback {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .btn-feedback:hover {
            width: auto;
        }

        .btn-number {
            margin-left:.5rem;
        }

        .btn-feedback-text {
            display: none;
            margin-left: .25rem;
        }

        .btn-feedback:hover .btn-feedback-text {
            display: inline;
            animation: expandText 0.3s forwards;
            opacity: 1;
        }

        @keyframes expandText {
            0% {
            width: 0;
            opacity: 0;
            }
            100% {
            width: auto;
            opacity: 1;
            }
        }
    </style>
</head>
<?= $this->include('partials/body') ?>
<!-- <body data-layout="horizontal"> -->
<!-- Begin page -->
<div id="layout-wrapper">
    <?= $this->include('partials/menu') ?>
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
                <?php if(isset($_SESSION['message'])):?>
                    <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                    <i class="mdi mdi-alert-outline label-icon"></i><strong>Warning</strong> - <?=$_SESSION['message']?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                <?php endif;?>
                <div class="accordion" id="accordionPanelsStayOpen">
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header position-relative" id="panelsOpenTicket">
                            <div class="d-none bg-warning rounded-3 infoReject btn-feedback position-absolute" style="left: 30%;z-index: 4;color: var(--bs-white);top: .75rem;font-size: 18px;cursor: pointer;padding: .5rem;" data-bs-toggle="collapse" data-bs-target="#panelsOpenTicket-collapse" aria-expanded="false"><i class="mdi mdi-circle-edit-outline"></i> 
                                <span class="btn-number"></span>
                                <span class="btn-feedback-text"> Need Revisied</span>
                            </div>
                            <div class="d-none bg-primary rounded-3 infoReject btn-feedback position-absolute " style="left: 60%;z-index: 4;color: var(--bs-white);top: .75rem;font-size: 18px;cursor: pointer;padding: .5rem;" data-bs-toggle="collapse" data-bs-target="#panelsOpenTicket-collapse" aria-expanded="false"><i class="mdi mdi-information-variant"></i>
                                <span class="btn-number"></span>
                                <span class="btn-feedback-text"> Feedback</span>
                            </div>
                            <div class="position-absolute" style="right: 5rem;z-index: 4;color: var(--bs-white);top: 1.25rem;font-size: 18px;"><i class="mdi mdi-ticket"></i>  Ticket</div>
                            <button class="accordion-button bg-info text-light fs-3 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsOpenTicket-collapse" aria-expanded="true" aria-controls="panelsOpenTicket-collapse">
                            Open Ticket
                            </button>
                        </h2>
                        <div id="panelsOpenTicket-collapse" class="accordion-collapse collapse show" aria-labelledby="panelsOpenTicket">
                            <div class="accordion-body table-responsive">
                                <table id="datatable-OpenTicket" class="table table-bordered dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Tiket</th>
                                            <th>Tanggal Open Tiket</th>
                                            <th class="d-none">Tanggal Close Tiket</th>
                                            <th>Kategori</th>
                                            <th>Urgensi</th>
                                            <th>Diajukan Oleh</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header position-relative" id="panelsCloseTicket">
                            <div class="position-absolute" style="right: 5rem;z-index: 4;color: var(--bs-white);top: 1.25rem;font-size: 18px;"><i class="mdi mdi-ticket"></i>  Ticket</div>
                            <button class="accordion-button bg-success text-white fs-3 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsCloseTicket-collapse" aria-expanded="false" aria-controls="panelsCloseTicket-collapse">
                            Close Ticket
                            </button>
                        </h2>
                        <div id="panelsCloseTicket-collapse" class="accordion-collapse collapse" aria-labelledby="panelsCloseTicket">
                            <div class="accordion-body table-responsive">
                                <table id="datatable-CloseTicket" class="table table-bordered dt-responsive  w-100">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Nomor Tiket</th>
                                        <th>Tanggal Open Tiket</th>
                                        <th>Tanggal Close Tiket</th>
                                        <th>Kategori</th>
                                        <th>Urgensi</th>
                                        <th>Diajukan Oleh</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
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
<!-- Required datatable js -->
<script src="<?=base_url()?>/public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>
<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/helpdesk/list-resp.js"></script>
<script>
    $(document).ready(function() {
        getDtTable('panelsOpenTicket')
    });
    
    document.addEventListener('shown.bs.collapse', function (event) {
        let accordionItem = event.target.closest('.accordion-item');
        let accordionItemId = accordionItem.childNodes[1].getAttribute('id');        
        getDtTable(accordionItemId)
    });
</script>
</body>
</html>