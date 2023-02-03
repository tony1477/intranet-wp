<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- DataTables -->
    <link href="<?=base_url()?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?=base_url()?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=base_url()?>/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/index.css" />

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
                                <th scope="col"><?=lang('Files.Room_Name')?></th>
                                <th scope="col"><?=lang('Files.Meeting_Date')?></th>
                                <th scope="col"><?=lang('Files.Event')?></th>
                                <th scope="col"><?=lang('Files.Name_Department')?></th>
                                <th scope="col"><?=lang('Files.Date_Request')?></th>
                                <th scope="col"><?=lang('Files.Status')?></th>
                                <th style="width: 80px; min-width: 80px;"><?=lang('Files.Action')?></th>
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
                                    <img src="<?=base_url()?>/assets/images/meeting-rooms/<?=$list->foto_ruangan?>" alt="" class="avatar-sm rounded-circle me-2">
                                    <a href="<?=base_url()?>/meeting-schedule/detail/<?=$list->idpeminjaman?>" class="text-body"><?=$list->nama_ruangan?></a>
                                </td>
                                <td><?=date('d F Y H:i', strtotime($list->tgl_mulai.' '.$list->jam_mulai))?></td>
                                <td><?=$list->agenda?></td>
                                <td>
                                    <a href="#" class="badge badge-soft-primary font-size-11"><?=$list->dep_kode?></a>
                                </td>
                                <td><?=date('d F Y H:i', strtotime($list->created_at))?></td>
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
                                            <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/detail/<?=$list->idpeminjaman?>"><i class="btn-primary btn-rounded  bx bx-chevrons-right label-icon waves-effect waves-light"></i> <?=lang('Files.View_Detail')?></a></li>
                                            <?php if($list->status == 1):?>
                                                <?php if(has_permission('approval-meeting')):?>
                                                <div class="dropdown-divider"></div>
                                                <!-- <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/approve/<?=$list->idpeminjaman?>"><i class="btn-success btn-rounded bx bx-check label-icon waves-effect waves-light"></i> Approve</a></li> -->
                                                <li><a class="dropdown-item" href="javascript:;" onclick="approveMeeting(<?=$list->idpeminjaman?>)"><i class="btn-success btn-rounded bx bx-check label-icon waves-effect waves-light" ></i> Approve</a></li>
                                                <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/batal/<?=$list->idpeminjaman?>"><i class="btn-danger btn-rounded bx bx-block label-icon waves-effect waves-light"></i> Batal</a></li>
                                            <?php endif;?>
                                            <?php elseif($list->status == 2): ?>
                                                <?php if(has_permission('approval-meeting') || $list->userid === user_id()):?>
                                                <div class="dropdown-divider"></div>
                                                <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/selesai/<?=$list->idpeminjaman?>"><i class="btn-success btn-rounded bx bx-check-double label-icon waves-effect waves-light"></i> Selesai</a></li>
                                                <li><a class="dropdown-item" href="<?=base_url()?>/meeting-schedule/batal/<?=$list->idpeminjaman?>"><i class="btn-danger btn-rounded bx bx-block label-icon waves-effect waves-light"></i> Batal</a></li>
                                                <?php endif;?>
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
        <div class="modal fade" tabindex="-1" id="approvemeeting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Peminjaman Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                        <div class="mb-3">
                            <label for="choices-text-remove-button" class="form-label font-size-13 text-muted">Daftar Blast Email </label>
                            <input class="form-control pesertameeting" id="choices-text-remove-button" type="text" value="" placeholder="Enter something" />
                            <input class="idmeeting" type="hidden" value="" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary kirimEmail">Approve dan Kirim Email</button>
                </div>
                </div>
            </div>
        </div>

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?=base_url()?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="<?=base_url()?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- init js -->
<script src="<?=base_url()?>/assets/js/pages/datatable-pages.init.js"></script>

<script src="<?=base_url()?>/assets/js/app.js"></script>
<script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
// new Choices(document.getElementById("choices-text-remove-button"), { delimiter: ",", editItems: !0, removeItemButton: !0, duplicateItemsAllowed: !1});
const btnKirim = document.querySelector('.kirimEmail')
function approveMeeting(id)
{
    fetch(`<?=base_url()?>/meeting-schedule/approveMeeting/${id}`,{
        method:'GET',
        mode:'cors',
        cache:'no-cache',
        creadentials:'same-origin',
        headers: {
            'Content-Type':'application/json',
            'X-Requested-With': "XMLHttpRequest",
        }
    })
    .then((response) => response.json())
    .then(data => {
        const pesertameeting = document.querySelector('#choices-text-remove-button')
        const idmeeting = document.querySelector('.idmeeting')
        const myModal = new bootstrap.Modal(document.getElementById('approvemeeting'), {
            keyboard: false
        })
        myModal.show()
        // let emailAddress;
        // data.forEach(item => {
        //     emailAddress =  (emailAddress == undefined ? item.email : `${emailAddress},${item.email}`)
        // })
        // document.querySelector('#choices-text-remove-button').value = emailAddress
        const daftarPeserta = new Choices(document.getElementById("choices-text-remove-button"))
        daftarPeserta.setValue(data);
        idmeeting.value = id
    })
}

btnKirim.addEventListener('click', e => {
    const listEmail = document.querySelector('.pesertameeting')
    const id = document.querySelector('.idmeeting')
    data = {
        'email':listEmail.value,
        'idpeminjaman' : id.value
    }
    fetch('<?=base_url()?>/meeting-schedule/sendmeeting',{
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': "XMLHttpRequest",
        },
        body: JSON.stringify(data)
    })
    .then((response) => response.json())
    .then(result => {
        const myModal = new bootstrap.Modal(document.getElementById('approvemeeting'), {
            keyboard: false
        })
        console.log(myModal.hide)
        if(result.status == 'success') {
            const myModal = new bootstrap.Modal(document.getElementById('approvemeeting'))
            myModal.hide()
        }
    })
})


</script>

</body>
</html>