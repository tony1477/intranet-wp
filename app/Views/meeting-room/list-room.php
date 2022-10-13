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
                            <h5 class="card-title">Room List </span></h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="<?=base_url()?>/meeting-schedule/booking/" class="btn btn-light"><i class="bx bx-plus me-1"></i> Buat Peminjaman Ruangan</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->

                <div class="table-responsive mb-4">
                    <table class="table align-middle datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Room Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Status</th>
                                <th scope="col">Peminjam</th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $row):?>
                            <tr>
                                <td><?=$row->idruangan?></td>
                                <td>
                                    <a href="<?=base_url().'/room-meeting/detail/'.str_replace(' ','-',strtolower($row->nama_ruangan))?>" class="text-body">
                                    <img src="assets/images/meeting-rooms/<?=$row->foto_ruangan?>" alt="" class="avatar-md rounded-circle me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Lihat Detail Ruangan">
                                    <?=$row->nama_ruangan?></a>
                                </td>
                                <td><?=$row->lokasi_ruangan?></td>
                                <td>Available</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#" class="badge badge-soft-primary">IA&CC</a>
                                        <a href="#" class="badge badge-soft-primary">IT</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/<?=str_replace(' ','-',strtolower($row->nama_ruangan))?>"><i class="btn-primary btn-rounded  bx bx-chevrons-right label-icon waves-effect waves-light"></i> Lihat Jadwal</a></li>
                                            <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($row->nama_ruangan))?>"><i class="btn-light btn-rounded bx bx-purchase-tag-alt label-icon waves-effect waves-light"></i> Ajukan Peminjaman</a></li>
                                            <div class="dropdown-divider"></div>
                                            <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/booking/<?=str_replace(' ','-',strtolower($row->nama_ruangan))?>"><i class="btn-success btn-rounded bx bx-check-double label-icon waves-effect waves-light"></i> Selesai Meeting</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <!-- <tr>
                                <td>
                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-sm rounded-circle me-2">
                                    <a href="#" class="text-body">Martoni Firman</a>
                                </td>
                                <td>Web Design</td>
                                <td>martonif1107@minia.com</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#" class="badge badge-soft-primary">php</a>
                                        <a href="#" class="badge badge-soft-primary">html5</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Lihat Jadwal</a></li>
                                            <li><a class="dropdown-item" href="#">Ajukan Peminjaman</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr> -->
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