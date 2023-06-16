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
                <div class="accordion" id="accordionPanelsStayOpen">
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header position-relative" id="panelsNewTicket">
                            <div class="position-absolute" style="right: 5rem;z-index: 4;color: var(--bs-white);top: 1.25rem;font-size: 18px;"><i class="mdi mdi-ticket"></i> <?=$listticket->newticket?> Ticket<?=($listticket->newticket>1 ? 's' : '')?></div>
                            <button class="accordion-button bg-secondary text-light fs-3 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsNewTicket-collapse" aria-expanded="true" aria-controls="panelsNewTicket-collapse">
                            New Ticket
                            </button>
                        </h2>
                        <div id="panelsNewTicket-collapse" class="accordion-collapse collapse show" aria-labelledby="panelsNewTicket">
                            <div class="accordion-body">
                                <table id="datatable-NewTicket" class="table table-bordered dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Nama Pemohon</th>
                                            <th width="35%">Permohonan</th>
                                            <th>Atasan Langsung</th>
                                            <th width="10%">Detail</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header position-relative" id="panelsWaitingHead">
                            <div class="position-absolute" style="right: 5rem;z-index: 4;color: var(--bs-white);top: 1.25rem;font-size: 18px;"><i class="mdi mdi-ticket"></i> <?=$listticket->waiting?> Ticket<?=($listticket->waiting>1 ? 's' : '')?></div>
                            <button class="accordion-button bg-primary text-white fs-3 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsWaitingHead-collapse" aria-expanded="false" aria-controls="panelsWaitingHead-collapse">
                            Waiting Approval
                            </button>
                        </h2>
                        <div id="panelsWaitingHead-collapse" class="accordion-collapse collapse" aria-labelledby="panelsWaitingHead">
                            <div class="accordion-body">
                                <table id="datatable-WaitingHead" class="table table-bordered dt-responsive  w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Nama Pemohon</th>
                                            <th width="35%">Permohonan</th>
                                            <th>Atasan Langsung</th>
                                            <th width="10%">Detail</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header position-relative" id="panelsOnProgress">
                        <div class="position-absolute" style="right: 5rem;z-index: 4;color: var(--bs-white);top: 1.25rem;font-size: 18px;"><i class="mdi mdi-ticket"></i> <?=$listticket->onprogress?> Ticket<?=($listticket->onprogress>1 ? 's' : '')?></div>
                        <button class="accordion-button bg-info text-white fs-3 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsOnProgress-collapse" aria-expanded="false" aria-controls="panelsOnProgress-collapse">
                            On Progress IT
                        </button>
                        </h2>
                        <div id="panelsOnProgress-collapse" class="accordion-collapse collapse" aria-labelledby="panelsOnProgress">
                            <div class="accordion-body">
                                <table id="datatable-OnProgress" class="table table-bordered dt-responsive  w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Nama Pemohon</th>
                                            <th width="35%">Permohonan</th>
                                            <th>Atasan Langsung</th>
                                            <th width="10%">Detail</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header position-relative" id="panelsSuccess">
                        <div class="position-absolute" style="right: 5rem;z-index: 4;color: var(--bs-white);top: 1.25rem;font-size: 18px;"><i class="mdi mdi-ticket"></i> <?=$listticket->close?> Ticket<?=($listticket->close>1 ? 's' : '')?></div>
                        <button class="accordion-button bg-success text-white fw-bold fs-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsSuccess-collapse" aria-expanded="false" aria-controls="panelsSuccess-collapse">
                            Ticket Closed
                        </button>
                        </h2>
                        <div id="panelsSuccess-collapse" class="accordion-collapse collapse" aria-labelledby="panelsSuccess">
                            <div class="accordion-body">
                                <table id="datatable-Success" class="table table-bordered dt-responsive  w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Nama Pemohon</th>
                                            <th width="35%">Permohonan</th>
                                            <th>Atasan Langsung</th>
                                            <th width="10%">Detail</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header position-relative" id="panelsCancel">
                        <div class="position-absolute" style="right: 5rem;z-index: 4;color: var(--bs-white);top: 1.25rem;font-size: 18px;"><i class="mdi mdi-ticket"></i> <?=$listticket->cancel?> Ticket<?=($listticket->cancel>1 ? 's' : '')?></div>
                        <button class="accordion-button bg-danger text-white fw-bold fs-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsCancel-collapse" aria-expanded="false" aria-controls="panelsCancel-collapse">
                            Ticket Reject/Cancel
                        </button>
                        </h2>
                        <div id="panelsCancel-collapse" class="accordion-collapse collapse" aria-labelledby="panelsCancel">
                            <div class="accordion-body">
                                <table id="datatable-Cancel" class="table table-bordered dt-responsive  w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Nama Pemohon</th>
                                            <th width="35%">Permohonan</th>
                                            <th>Atasan Langsung</th>
                                            <th width="10%">Detail</th>
                                            <th width="15%">Aksi</th>
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
<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/helpdesk/list-helpdesk.js"></script>
<script>
    $(document).ready(function() {
        getDtTable('panelsNewTicket')
    });
    
    document.addEventListener('shown.bs.collapse', function (event) {
        let accordionItem = event.target.closest('.accordion-item');
        let accordionItemId = accordionItem.childNodes[1].getAttribute('id');        
        getDtTable(accordionItemId)
    });

    
</script>
</body>
</html>