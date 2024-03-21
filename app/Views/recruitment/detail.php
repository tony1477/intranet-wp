<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/index.css" />
    <style>
        .nav-tabs-custom .nav-item .nav-link.active {
            color: #fff;
            background: #5156c4;
        }
        .popover {
            max-width: 400px;
        }
    </style>
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
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm order-2 order-sm-1">
                                        <div class="d-flex align-items-start mt-3 mt-sm-0">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img src="<?=API_WEBSITE?>/public/assets/img/career/jobseeker/<?=$data->data->personal->photo?>" alt="" class="img-fluid d-block h-100">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-16 mb-1 fullname"><?=$data->data->personal->fullname?>
                                                    <span class="<?=is_null($last_status) ? 'd-none ' : ''?>top badge rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" title="<?=is_null($last_status) ? '' : $last_status['apply_date']?>" data-id=<?=is_null($last_status)? 0 : $last_status['statusid']?>><?=is_null($last_status) ? '' : $last_status['statusname']?></span>
                                                    <?php if(!is_null($last_status)):?>
                                                        <a tabindex="0" class="<?=($last_status['isbanned']=='1' ? '' : 'd-none')?> badge rounded-pill bg-dark blacklist-badge" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Notes at <?=is_null($blacklist) ? '' : date('d/m/Y',strtotime($blacklist['apply_date']))?>" data-bs-content="<?=is_null($blacklist) ? 'Notes here' : $blacklist['notes']?>">Blacklist</a>

                                                        <a tabindex="0" class="<?=($last_status['notes']=='' ? 'd-none' : '')?> badge rounded-pill bg-soft-primary text-dark note-badge" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Notes at <?=is_null($last_status) ? '' : date('d/m/Y',strtotime($last_status['apply_date']))?>" data-bs-content="<?=($last_status['notes']=='' ? 'Notes here' : $last_status['notes'])?>">Notes</a>
                                                    <?php endif?>
                                                    <!-- <button type="button" class="btn btn-light position-relative p-0 avatar-sm rounded">
                                                        <span class="avatar-title bg-transparent text-reset">
                                                            <i class="bx bx-notepad"></i>
                                                        </span>
                                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">unread messages</span></span>
                                                    </button> -->
                                                    </h5>
                                                    <p class="text-muted font-size-13 position"><?=$data->data->personal->position?></p>

                                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?=$data->data->personal->mobilephone?></div>
                                                        <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?=$data->data->personal->email?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto order-1 order-sm-2">
                                        <div class="d-flex align-items-start justify-content-end gap-2">
                                            <div>
                                                <!-- <button type="button" class="process btn btn-soft-light bg-primary text-white" data-id="<?php //is_null($last_status)? 0 : $last_status['statusid']?>">Process <i class="me-1 fas fa-arrow-right"></i></button> -->
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle <?=is_null($last_status)? 0 : ($last_status['isprocess'] == 1 ? '' : 'btn-secondary disabled')?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Process <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu recruitment-list" aria-labelledby="btnGroupDrop1" data-id="<?=is_null($last_status)? 0 : $last_status['statusid']?>">
                                                        <li><a class="dropdown-item next-process" href="#">YES</a></li>
                                                        <li><a class="dropdown-item not-process disabled" href="#">NO</a></li>
                                                        <hr>
                                                        <li><a class="dropdown-item consider-jobseeker disabled" href="#">Consider</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="dropdown">
                                                    <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" data-id="<?=is_null($last_status)? 0 : $last_status['statusid']?>">
                                                        <li><a class="dropdown-item addnotes <?=is_null($last_status)? 'disabled' : ($last_status['isprocess']== 1 ? '' : 'disabled')?>" href="#" data-id="<?=is_null($last_status)? 0 : $last_status['statusid']?>">Add Notes</a></li>
                                                        <hr>
                                                        <li><a class="dropdown-item blacklist" href="#">Blacklist</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 active" data-id="personalTab" data-bs-toggle="tab"  href="#personal" role="tab">Personal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-id="identityTab" data-bs-toggle="tab" href="#identity" role="tab">Identity Card</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-id="educationTab" data-bs-toggle="tab" href="#education" role="tab">Education</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-id="experienceTab" data-bs-toggle="tab" href="#experience" role="tab">Work Experience</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-id="familyTab" data-bs-toggle="tab" href="#family" role="tab">Family Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-id="emergencyTab" data-bs-toggle="tab" href="#emergency" role="tab">Emergency Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-id="organizationTab" data-bs-toggle="tab" href="#organization" role="tab">Organization</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link px-3" data-id="question" data-bs-toggle="tab" href="#" role="tab">Question</a>
                                    </li> -->
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Overview</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Tempat / Tanggal Lahir </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <?=$data->data->personal->birthcity.' / '.date('d-m-Y',strtotime($data->data->personal->birthdate))?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Status </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <?=$data->data->personal->status?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Alamat Saat Ini </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <?=$data->data->personal->address_real?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Agama </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <?=$data->data->personal->religion?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Pertanyaan 2 </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: Apakah Anda bersedia menjalani pemeriksaan latar belakang sebelum diterima bekerja? <?=$data->data->personal->question2?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Pertanyaan 4</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: Apakah Anda memiliki riwayat penyakit tertentu? Jika Ya, sebutkan nama penyakitnya. <?=$data->data->personal->question4?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">CV </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <a href="#" class="lookupcv" data-id="<?=$data->data->personal->employeeid?>" data-name="cv">CV <?=$data->data->personal->fullname?></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Jenis Kelamin </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <?=$data->data->personal->sex?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Kewarganegaraan </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <?=$data->data->personal->nationally?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Alamat KTP </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <?=$data->data->personal->address_ktp?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Pertanyaan 1 </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: Berapa lama waktu pemberitahuan pengunduran diri Anda yang perlu disampaikan ke pemberi kerja Anda? <?=$data->data->personal->question1?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Pertanyaan 3 </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: Apakah Anda bersedia menjalani pemeriksaan kesehatan sebelum diterima bekerja? <?=$data->data->personal->question3?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Pertanyaan 5 </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: Apakah Anda memiliki buta warna?  <?=$data->data->personal->question5?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12">
                                                            <div>
                                                                <h5 class="font-size-15">Ijazah </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <div class="text-muted">
                                                                <p class="mb-0">: <a href="#" class="lookupijazah" data-id="<?=$data->data->personal->employeeid?>" data-name="ijazah">Ijazah <?=$data->data->personal->fullname?></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="identity" role="tabpanel">
                                <!-- <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">About</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="pb-3">
                                                <h5 class="font-size-15">Bio :</h5>
                                                <div class="text-muted">
                                                    <p class="mb-2">Hi I'm Phyllis Gatlin, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                                                    <p class="mb-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at it has a more-or-less normal distribution of letters</p>
                                                    <p>It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.</p>

                                                    <ul class="list-unstyled mb-0">
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec vitae sapien ut libero venenatis faucibus</li>
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque rutrum aenean imperdiet</li>
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer ante a consectetuer eget</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="pt-3">
                                                <h5 class="font-size-15">Experience :</h5>
                                                <div class="text-muted">
                                                    <p>If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages. It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc</p>

                                                    <ul class="list-unstyled mb-0">
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec vitae sapien ut libero venenatis faucibus</li>
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque rutrum aenean imperdiet</li>
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer ante a consectetuer eget</li>
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Phasellus nec sem in justo pellentesque</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Identity</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="p-4 border rounded">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle mb-0" id="identityTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70px;">No.</th>
                                                                <th>Jenis Identitas</th>
                                                                <th>No Kartu </th>
                                                                <th>Penerbit </th>
                                                                <th>Tanggal Kadaluarsa </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="education" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Education</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="p-4 border rounded">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle mb-0" id="educationTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70px;">No.</th>
                                                                <th>Gelar</th>
                                                                <th>Jurusan</th>
                                                                <th>Nama Institusi</th>
                                                                <th>Tahun Masuk</th>
                                                                <th>Tahun Selesai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="experience" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Work Experience</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="p-4 border rounded">
                                                <div class="table-responsive">
                                                    <table class="table table-wrap align-middle mb-0" id="experienceTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70px;">No.</th>
                                                                <th>Nama Perusahaan</th>
                                                                <th>Jabatan</th>
                                                                <th>Tanggal Bergabung</th>
                                                                <th>Tanggal Berhenti</th>
                                                                <th>Tugas dan Tanggung Jawab</th>
                                                                <th>Alasan Berhenti</th>
                                                                <th>Penghasilan Terakhir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="family" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Family</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="p-4 border rounded">
                                                <div class="table-responsive">
                                                    <table class="table table-wrap align-middle mb-0" id="familyTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70px;">No.</th>
                                                                <th>Hubungan Keluarga</th>
                                                                <th>Nama</th>
                                                                <th>Pendidikan Terakhir</th>
                                                                <th>Pekerjaan</th>
                                                                <th>Tempat Lahir</th>
                                                                <th>Tanggal Lahir</th>
                                                                <th>Almarhum?</th>
                                                                <th>Perusahaan</th>
                                                                <th>Alamat Perusahaan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="emergency" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Emergency Contact</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="p-4 border rounded">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle mb-0" id="emergencyTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70px;">No.</th>
                                                                <th>Hubungan</th>
                                                                <th>Nama</th>
                                                                <th>No Telp</th>
                                                                <th>Alamat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="organization" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Organization</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="p-4 border rounded">
                                                <div class="table-responsive">
                                                    <table class="table table-wrap align-middle mb-0" id="organizationTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70px;">No.</th>
                                                                <th>Nama Organisasi</th>
                                                                <th>Jabatan</th>
                                                                <th>Periode Mulai</th>
                                                                <th>Periode Selesai</th>
                                                                <th>Tugas / Kegiatan Organisasi</th>                              
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end col -->
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

<?= $this->include('partials/sweetalert') ?>
<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/recruitment/app.js"></script>
<script>
    $(document).ready(function(){
        const getColorSpan = function() {
            const spanBtn = document.querySelector('span.top')
            const id = spanBtn.dataset.id
            // const color = processList[id].bg_color
            const rules = processList.find(item => item.statusid.includes(+id));
            if(rules!=undefined) {
                spanBtn.classList.add(rules.bg_color)
                rules.liOptions.forEach(function(value,index) {
                    $(`ul.recruitment-list li:eq(${index}) a`).removeClass('disabled')
                })
            }
        }
        getColorSpan()
    })
    // var tabEl = document.querySelectorAll('a[data-bs-toggle="tab"]')
    // tabEl.forEach(el => {
    //     el.addEventListener('show.bs.tab', function(e){
    //         // console.log(e.target)
    //         // console.log(event.relatedTarget)
    //         e.preventDefault()
    //         const selectTab = e.target.dataset.id
    //         const el = document.querySelector(`a[href="${selectTab}"]`)
    //         // el.classList.add('active')
    //         var tab = new bootstrap.Tab(el)
    //         tab.show()
    //         // console.log(el)
            
    //     })
    // })    
    // $('.top').tooltip({
    //     placement:'top'
    // })
    // const processList = ['calling','interview-hr','interview-user','offering'];
    
    async function fetchContent(tabId,fields) {
        try {
            const props =  {
                method: 'GET',
                // mode:'no-cors',
                headers: {
                    'Authorization': `Bearer ${getCookie('X-WPG-Recruitment')}`
                },
            }
            const url = `<?=API_WEBSITE?>/api/employee/<?=$id?>/${tabId}`
            const response = await fetch(url,props);
            const data = await response.json();
            const divEl = document.querySelector(`#${tabId}`)
            let tableName = document.querySelector(`#${tabId}Table`)
            let tbody = await tableName.querySelector('tbody')
            tbody.innerHTML = '' 
            let str;
            if(data.status == 'success') {
                data.data.forEach(function(item,index) {
                    const row = document.createElement('tr');
                    // row.innerHTML = `
                    // <th scope="row">${index+1}</th>
                    // <td>${item.card_type}</td>
                    // <td>${item.card_number}</td>
                    // <td>${item.card_publisher}</td>
                    // <td>${item.card_expired}</td>
                    // `
                    str = `<th scope="row">${index+1}</th>`
                    fields.forEach(field => {
                        str = `${str}<td>${item[field]}</td>`
                    })
                    row.innerHTML = str
                    tbody.appendChild(row);
                    // console.log(row)
                })
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    // new
    const tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('click', async function(e) {
            const id = e.target.dataset.id
            const apiUrl = ''; // Masukkan URL API Anda di sini
            if(id==='personalTab') return;
            const url = {
                'identity' : ['card_type','card_number','card_publisher','card_expired'],
                'education' :['title','major','institute','start_year','end_year'],
                'experience':['company','position','start_date','end_date','job_desc','reason_leave','last_wage'],
                'family' : ['relation','name','last_education','occupation','birthcity','birthdate','isalmarhum','company','address_company'],
                'emergency' : ['relation','name','phone','address'],
                'organization': ['name','position','startdate','enddate','jobdesc'],
            }

            // if (profileTabContent.innerHTML === '') {
            const element = $(this).attr('href')
            const tabId = element.slice(1)
            await fetchContent(tabId,url[tabId]);
            // }
        });
    })

    const lookupIjazah = document.querySelector('.lookupijazah')
    const lookupCv = document.querySelector('.lookupcv')
    const processBtn = document.querySelector('.next-process')
    const notProcessBtn = document.querySelector('.not-process')
    const considerBtn = document.querySelector('.consider-jobseeker')
    const addNotes = document.querySelector('.addnotes')
    const blacklist = document.querySelector('.blacklist')
    
    lookupCv.addEventListener('click', (e) => {
        const props = {
            id: e.target.dataset.id,
            name: e.target.dataset.name
        }
        viewDoc(props)
    })

    lookupIjazah.addEventListener('click', (e) => {
        const props = {
            id: e.target.dataset.id,
            name: e.target.dataset.name
        }
        viewDoc(props)
    })

    processBtn.addEventListener('click', function(e) {
        const ul = e.target.closest('.dropdown-menu')
        const id = ul.dataset.id
        const list = processList.find(process => process.statusid.includes(+id));
        let nextprocess, nextid;
        if(list!=undefined) {
            nextprocess = list.next_status_name
            nextid = list.next_status
        }
        else {
            nextprocess = processList[id].next_status_name
            nextid = processList[id].next_status
        }
        Swal.fire({
            title:"Info",
            // text:`Apakah anda yakin untuk melanjutkan process ${processList[id].next_status_name} ?`,
            html:`Apakah anda yakin untuk <b>melanjutkan</b> proses ${nextprocess} ?`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        })
        .then(result => {
            if(result.isConfirmed) {
                const props = {
                    statusid:nextid,
                    employeeid:<?=$id?>,
                    position:'<?=$data->data->personal->position?>'
                }
                processRecruitment(props)
            }
        });
        console.log(nextprocess,nextid)
    })

    notProcessBtn.addEventListener('click', function(e) {
        const ul = e.target.closest('.dropdown-menu')
        const id = ul.dataset.id
        const list = processList.find(process => process.statusid.includes(+id));
        Swal.fire({
            title:"Info",
            // text:`Apakah anda yakin untuk <b>tidak melanjutkan</b> process ${processList[id].next_status_name} ?`,
            html:`Apakah anda yakin untuk <b>tidak melanjutkan</b> proses ini?`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        })
        .then(result => {
            if(result.isConfirmed) {
                Swal.fire({
                    title: 'Add Notes',
                    input: "text",  
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Batal',
                    showLoaderOnConfirm:true,
                    preConfirm: async (text) => {
                        try {
                            const data = {
                                statusid: list.stop_status,
                                recruitid: <?=($last_status['emp_recruitid']??0)?>,
                                message: text
                            }
                            const url = `../${id}/notprocess`
                            const response = await fetch(url,{
                                method:'POST',
                                headers: {
                                    Authorization: `Bearer ${getCookie("X-WPG-Recruitment")}`,"Content-Type": "application/json",
                                },
                                body: JSON.stringify(data)
                            })
                            if (!response.ok) {
                                return Swal.showValidationMessage(`
                                ${JSON.stringify(await response.json())}
                                `);
                            }
                            return response.json();
                        }
                        catch(error) {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        }
                    },
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        console.log(result)
                        location.reload()
                    }
                })
                // let nextid = +id+1
                // const props = {
                //     statusid:nextid,
                //     employeeid:<?=$id?>,
                //     positon:'<?=$data->data->personal->position?>'
                // }
                // processRecruitment(props)
            }
        });
    })

    considerBtn.addEventListener('click', function(e) {
        const ul = e.target.closest('.dropdown-menu')
        const id = ul.dataset.id
        Swal.fire({
            title:"Info",
            // text:`Apakah anda yakin untuk <b>tidak melanjutkan</b> process ${processList[id].next_status_name} ?`,
            html:`Daftarkan jobseeker sebagai calon <b>yang dipertimbangkan</b>?`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        })
        .then(result => {
            if(result.isConfirmed) {
                let nextid = +id+1
                const props = {
                    statusid:nextid,
                    recruitid: <?=($last_status['emp_recruitid']??0)?>,
                }
                Swal.fire({
                    title: 'Add Notes for Considering',
                    input: "text",  
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Batal',
                    showLoaderOnConfirm:true,
                    preConfirm: async (text) => {
                        try {
                            props.message = text
                            const url = `../${id}/consider`
                            const response = await fetch(url,{
                                method:'POST',
                                headers: {
                                    Authorization: `Bearer ${getCookie("X-WPG-Recruitment")}`,"Content-Type": "application/json",
                                },
                                body: JSON.stringify(props)
                            })
                            if (!response.ok) {
                                return Swal.showValidationMessage(`
                                ${JSON.stringify(await response.json())}
                                `);
                            }
                            return response.json();
                        }
                        catch(error) {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        }
                    },
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        console.log(result)
                        location.reload()
                    }
                })
                // processRecruitment(props)
            }
        });
    })

    addNotes.addEventListener('click', function(e) {
        const ul = e.target.closest('.dropdown-menu')
        const id = ul.dataset.id
        const data = {
            statusid:+id,
            recruitid:<?=($last_status['emp_recruitid']??0)?>,
        }
        Swal.fire({
            title: 'Add Notes',
            input: "text",  
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm:true,
            // backdrop:true,
            preConfirm: async (text) => {
                try {
                    data.message = text
                    const url = `../${id}/addnotes`
                    const response = await fetch(url,{
                        method:'POST',
                        headers: {
                            Authorization: `Bearer ${getCookie("X-WPG-Recruitment")}`,"Content-Type": "application/json",
                        },
                        body: JSON.stringify(data)
                    })
                    if (!response.ok) {
                        return Swal.showValidationMessage(`
                        ${JSON.stringify(await response.json())}
                        `);
                    }
                    return response.json();
                }
                catch(error) {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                }
            },
            // allowOutsideClick: () => !Swal.isLoading()
        })
        .then((result) => {
            if (result.isConfirmed) {
                location.reload()
            }
        })
    })

    blacklist.addEventListener('click', function(e) {
        const ul = e.target.closest('.dropdown-menu')
        const id = ul.dataset.id
        const data = {
            employeeid:<?=$id?>,
            position:'<?=$data->data->personal->position?>',
            statusid:+id,
        }
        Swal.fire({
            title: 'Add Notes Blacklist',
            input: "text",  
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm:true,
            // backdrop:true,
            preConfirm: async (text) => {
                try {
                    data.message = text
                    const url = `../${id}/blacklist`
                    const response = await fetch(url,{
                        method:'POST',
                        headers: {
                            Authorization: `Bearer ${getCookie("X-WPG-Recruitment")}`,"Content-Type": "application/json",
                        },
                        body: JSON.stringify(data)
                    })
                    if (!response.ok) {
                        return Swal.showValidationMessage(`
                        ${JSON.stringify(await response.json())}
                        `);
                    }
                    return response.json();
                }
                catch(error) {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                }
            },
            // allowOutsideClick: () => !Swal.isLoading()
        })
        .then((result) => {
            if (result.isConfirmed) {
                location.reload()
            }
        })
    })
</script>
</body>

</html>