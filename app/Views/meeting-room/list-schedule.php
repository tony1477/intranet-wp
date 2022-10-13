<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                            <h5 class="card-title"> <span class="text-muted fw-normal ms-2">List_Schedule_of_Meeting</span></h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3 ">
                            <!-- <div class="dropdown">
                                <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div> -->
                        </div>

                    </div>
                </div>
                <!-- end row -->

                <div class="table-responsive mb-4">
                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th scope="col"><?=lang('Files.Name')?></th>
                                <th scope="col"><?=lang('Files.Date')?></th>
                                <th scope="col"><?=lang('Files.Event')?></th>
                                <th scope="col"><?=lang('Files.Name_Department')?></th>
                                <th scope="col"><?=lang('Files.Status')?></th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach($data as $list): ?>
                                <th scope="row">
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" class="form-check-input" id="contacusercheck2">
                                        <label class="form-check-label" for="contacusercheck2"></label>
                                    </div>
                                </th>
                                <td>
                                    <img src="assets/images/meeting-rooms/<?=$list->foto_ruangan?>" alt="" class="avatar-sm rounded-circle me-2">
                                    <a href="#" class="text-body"><?=$list->nama_ruangan?></a>
                                </td>
                                <td><?=date('d F Y H:i', strtotime($list->tgl_mulai.' '.$list->jam_mulai))?></td>
                                <td><?=$list->agenda?></td>
                                <td>
                                    <a href="#" class="badge badge-soft-primary font-size-11"><?=$list->dep_kode?></a>
                                </td>
                                <td>
                                <?php 
                                if($list->status==1) {
                                    $icon = 'bx bx-check';
                                    $btn  = 'info';
                                }
                                elseif($list->status==2) {
                                    $icon = 'bx bx-hourglass';
                                    $btn  = 'light';
                                }
                                elseif($list->status==3) {
                                    $icon = 'bx bx-check-double';
                                    $btn  = 'success';
                                }
                                else {
                                    $icon = 'bx bx-block';
                                    $btn  = 'dark';
                                }
                                ?>
                                    <button type="button" class="btn btn-<?=$btn?> waves-effect waves-light">
                                                <i class="<?=$icon?> font-size-16 align-middle me-2"></i><?=$list->status_kode?>
                                    </button>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/detail/<?=$list->idpeminjaman?>"><i class="btn-primary btn-rounded  bx bx-chevrons-right label-icon waves-effect waves-light"></i> Lihat Detail</a></li>
                                            <?php if($list->status == 1):?>
                                                <div class="dropdown-divider"></div>
                                                <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($list->nama_ruangan))?>"><i class="btn-success btn-rounded bx bx-check label-icon waves-effect waves-light"></i> Approve</a></li>
                                                <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($list->nama_ruangan))?>"><i class="btn-danger btn-rounded bx bx-block label-icon waves-effect waves-light"></i> Batal</a></li>
                                            <?php elseif($list->status == 2): ?>
                                                <div class="dropdown-divider"></div>
                                                <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($list->nama_ruangan))?>"><i class="btn-success btn-rounded bx bx-check-double label-icon waves-effect waves-light"></i> Selesai</a></li>
                                                <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($list->nama_ruangan))?>"><i class="btn-danger btn-rounded bx bx-block label-icon waves-effect waves-light"></i> Batal</a></li>
                                            <?php endif;?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
                <!-- end table responsive -->

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
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- init js -->
<script src="assets/js/pages/datatable-pages.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>