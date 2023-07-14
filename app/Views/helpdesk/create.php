<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
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
                                <div class="row justify-content-center">
                                    <div class="col-lg-6 col-xl-6 col-12">
                                    <?=form_open_multipart('create-helpdesk/user/'.user()->username.'/form');?>
                                    <?=csrf_field()?>
                                        <div>
                                            <div class="mb-3">
                                                <label for="input-username" class="form-label">Nama Pengguna</label>
                                                <input class="form-control" type="text" value="<?=user()->username?>" name="username" id="input-username" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="input-userdate" class="form-label">Tanggal Request</label>
                                                <input class="form-control" type="datetime" value="<?=date('d-M-y H:i')?>" name="userdate" id="input-userdate" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="input-usertelp" class="form-label">No Telepon</label>
                                                <input class="form-control" type="tel" value="<?=user()->phoneno?>" name="usertelp" id="input-usertelp">
                                            </div>
                                            <div class="d-flex align-items-center loadingQuestion flex-column d-none">
                                                <div class="spinner-border text-primary mx-auto" role="status" aria-hidden="true"></div>
                                                <strong>Loading...</strong>
                                            </div>
                                            <div class="mb-3 questionHelpdesk" data-parentid="null">
                                                <h3>Pilih Jenis Permintaan Bantuan : </h3>
                                                <?php foreach($listhelpdesk as $row):?>
                                                <div class="form-check">
                                                    <input class="form-check-input form-check-input-helpdesk" type="radio" name="parentoption" id="radio<?=$row->choiceid?>" value="<?=$row->choiceid?>" data-question="question1" />
                                                    <label class="form-check-label d-flex align-items-center position-relative" for="radio<?=$row->choiceid?>">
                                                        <span class="position-relative fs-3"><?=$row->choicename?></span>
                                                        <span class="badge  info-btn btn-rounded position-relative mx-1 mt-n3" style="width:1.5em; height:1.5em"  onmouseover="showthis(this)" onmouseout="hidethis(this)">
                                                            <i class="fas fa-info"></i>
                                                        </span>
                                                    </label>
                                                    <div class="radio-info my-3 fw-bold d-none" data-show-info="hidden">Meliputi <?=$row->next_choice?></div>
                                                </div>
                                                <?php endforeach;?>
                                            </div>
                                            <div class="d-flex justify-content-between nextPage">
                                                <button type="button" class="btn btn-primary waves-effect waves-light btnPrev mt-3 d-none" data-number="-1">
                                                <i class="bx bx-left-arrow-alt font-size-16 align-middle me-2"></i>Prev</button>
                                                <button type="button" class="btn btn-primary waves-effect waves-light btnNext mt-3" data-number="1">
                                                <i class="bx bx-right-arrow-alt font-size-16 align-middle me-2"></i> Next</button>
                                            </div>
                                            <div class="d-none justify-content-center submitForm">
                                                <button type="submit" class="btn btn-lg btn-primary waves-effect waves-light btnSubmit mt-3">
                                                <i data-feather="check-circle"></i> Submit</button>
                                            </div>
                                        </div>
                                    <?=form_close()?>
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
<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>

<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/helpdesk/create-ticket.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        sessionStorage.clear();
    }, false);

    document.addEventListener('DOMContentLoaded', function() {
      const infoButtons = document.querySelectorAll('.info-btn');

      const radioInfo = document.querySelectorAll('.radio-info');
     })
    
    function showthis(el) {
        // el.style.display='block'
        const radioInfo = el.parentNode.nextElementSibling
        radioInfo.classList.toggle('d-none')
    }

    function hidethis(el) {
        // el.style.display='none'
        const radioInfo = el.parentNode.nextElementSibling
        radioInfo.classList.toggle('d-none')
    }
</script>
</body>

</html>