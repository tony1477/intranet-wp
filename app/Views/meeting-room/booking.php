<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="/assets/libs/twitter-bootstrap-wizard/prettify.css">
    <link href="/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="/assets/libs/flatpickr/flatpickr.min.css"> -->

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
       <?php if(logged_in()==TRUE): ?>
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Form Peminjaman Ruang <?=$nama != '' ? $nama : 'Meeting'?></h4>
                            </div>
                            <div class="card-body" style="border:0px solid #000; height:70vh">
                                <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                    <ul class="twitter-bs-wizard-nav">
                                        <li class="nav-item">
                                            <a href="#seller-details" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Diri">
                                                    <i class="bx bx-list-ul"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#company-document" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Peserta">
                                                    <i class="bx bx-book-bookmark"></i>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Ruangan">
                                                    <i class="bx bxs-bank"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- wizard-nav -->

                                    <form>
                                    <div class="tab-content twitter-bs-wizard-tab-content">
                                        <div class="tab-pane" id="seller-details">
                                            <div class="text-center mb-4">
                                                <h5>Data Diri</h5>
                                                <p class="card-title-desc">Lengkapi Data Peminjaman</p>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-firstname-input" class="form-label"><?=lang('Files.First_Name')?></label>
                                                            <input type="text" class="form-control" name="fullname" value="<?=user()->fullname?>"  <?= (user()->fullname != '') ? 'readonly' : ''?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-lastname-input" class="form-label"><?=lang('Files.Position')?></label>
                                                            <input type="text" class="form-control" name="position">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-phoneno-input" class="form-label"><?=lang('Files.Department')?></label>
                                                            <select class="form-select" id="choices-single-no-sorting" name="iddepartment">
                                                                <option selected>- Pilih -</option>
                                                                <?php foreach($department as $list): ?>
                                                                <option value="<?=$list->Id?>"><?=$list->Name_Department.' ('.$list->Name_Divisi.')'?>
                                                            <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-email-input" class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" value="<?=user()->email?>" <?=(user()->email != '') ? 'readonly' : ''?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- tab pane -->
                                        <div class="tab-pane" id="company-document">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Data Peserta</h5>
                                                    <p class="card-title-desc">Lengkapi Data Peserta</p>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-pancard-input" class="form-label"><?=lang('Files.Date')?></label>
                                                                <input type="date" class="form-control" name="startdate" >
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-vatno-input" class="form-label"><?=lang('Files.Time')?></label>
                                                                <input type="time" class="form-control" name="starttime">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-cstno-input" class="form-label"><?=lang('Files.Time')?></label>
                                                                <input type="time" class="form-control" name="endtime">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-cstno-input" class="form-label"><?=lang('Files.Amount_Participant')?></label>
                                                                <input type="number" class="form-control" name="participant">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-servicetax-input" class="form-label"><?=lang('Files.ParticipantBase')?></label>
                                                                <select class="form-select">
                                                                    <option selected>- Pilih -</option>
                                                                    <option value="HO">HO</option>
                                                                    <option value="Unit PS">Unit PKS</option>
                                                                    <option value="Unit Kebun">Unit Kebun</option>
                                                                    <option value="External">Pihak Eksternal</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-servicetax-input" class="form-label"><?=lang('Files.Speaker')?></label>
                                                                <input type="text" class="form-control" name="speaker">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-companyuin-input" class="form-label"><?=lang('Files.Name_Participant')?></label>
                                                                <input class="form-control" id="choices-text-unique-values"type="text" value="" placeholder="This is a placeholder" class="custom class" name="nameparti" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- tab pane -->
                                        <div class="tab-pane" id="bank-detail">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Data Ruangan</h5>
                                                    <p class="card-title-desc">Lengkapi Kebutuhan</p>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><?=lang('Files.Choose')?></label>
                                                                <select class="form-select">
                                                                    <option selected>- Pilih -</option>
                                                                    <?php foreach($room as $list)  : ?>
                                                                    <option value="<?=$list->idruangan?>"><?=$list->nama_ruangan?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-namecard-input" class="form-label"><?=lang('Files.Kebutuhan')?></label>
                                                                <input type="text" class="form-control" name="kebutuhan" >
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-cardno-input" class="form-label"><?=lang('Files.Notulen_Meeting')?></label>
                                                                <input type="text" class="form-control" name="notulen" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".confirmModal">Save
                                                            Changes</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- tab pane -->
                                    </div>
                                    </form>
                                    <!-- end tab content -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <!-- Modal -->
        <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bx bx-check-circle display-4 text-success"></i>
                            </div>
                            <h5>Confirm Save Changes</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-md" data-bs-dismiss="modal" >Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <?= $this->include('partials/footer') ?>
    <?php endif;?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- twitter-bootstrap-wizard js -->
<script src="/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="/assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- form wizard init -->
<script src="/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<?= $this->include('partials/script/booking') ?>

<script src="/assets/js/app.js"></script>

</body>

</html>