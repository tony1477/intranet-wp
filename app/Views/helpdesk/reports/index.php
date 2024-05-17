<!doctype html>
<html lang="en">
<head>
    <?= $title_meta ?>
    <?= $this->include('partials/_datatables-css') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-sm-12 col-xl-3 col-lg-3"></div>
                                    <div class="col-sm-12 col-xl-6 col-lg-6 mt-3 mt-lg-0">
                                        <div class="row mb-3">
                                            <label for="reporttype" class="col-sm-12 col-xl-3 col-lg-3 col-form-label text-end"><?=lang('Files.Report_Type')?></label>
                                            <div class="col-9">
                                                <select class="form-select" id="reporttype">
                                                <?php foreach($report['reportType'] as $index => $type):?>
                                                    <option value="<?=$index?>"><?=$type?></option>
                                                <?php endforeach?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="location" class="col-sm-12 col-xl-3 col-lg-3 col-form-label text-end"><?=lang('Files.Location_PT')?></label>
                                            <div class="col-9">
                                                <select class="form-select" id="location">
                                                    <option value="all">All PT</option>
                                                <?php foreach($report['location'] as $location):?>
                                                    <option value="<?=$location['iddivisi']?>"><?=$location['div_nama']?></option>
                                                <?php endforeach?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="category" class="col-sm-12 col-xl-3 col-lg-3 col-form-label text-end"><?=lang('Files.Category')?></label>
                                            <div class="col-9">
                                                <select class="form-select" id="category">
                                                    <option value="all">All Category</option>
                                                <?php foreach($report['category'] as $category):?>
                                                    <option value="<?=$category['choiceid']?>"><?=$category['choicename']?></option>
                                                <?php endforeach?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="responder" class="col-sm-12 col-xl-3 col-lg-3 col-form-label text-end"><?=lang('Files.Responder')?></label>
                                            <div class="col-9">
                                                <select class="form-select" id="responder">
                                                    <option value="all">All Responder</option>
                                                <?php foreach($report['responder'] as $responder):?>
                                                    <option value="<?=$responder['id']?>"><?=$responder['fullname']?></option>
                                                <?php endforeach?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="date_start" class="col-sm-12 col-xl-3 col-lg-3 col-form-label text-end"><?=lang('Files.Start_Date')?></label>
                                            <div class="col-9">
                                                <input class="form-control" type="date" name="startdate" id="date_start">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="date_end" class="col-sm-12 col-xl-3 col-lg-3 col-form-label text-end"><?=lang('Files.End_Date')?></label>
                                            <div class="col-9">
                                                <input class="form-control" type="date" name="enddate" id="date_end">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-xl-3 col-lg-3"></div> 
                                                <div class="col-9 d-flex justify-content-end"> 
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bxs-report font-size-16 align-middle me-2"></i>  Generate Report
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <li><a class="dropdown-item" href="#" onclick="generate(this)" data-type="pdf"><i class="mdi mdi-file-pdf-box font-size-16 align-middle me-2"></i> PDF</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="generate(this)" data-type="xls"><i class="mdi mdi-microsoft-excel font-size-16 align-middle me-2"></i> Excel</a></li>
                                                        </ul>
                                                    </div>
                                                    <!-- <button type="button" class="btn btn-primary waves-effect waves-light generate-report">
                                                    <i class="bx bxs-report font-size-16 align-middle me-2"></i> Generate Report
                                                    </button> -->
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xl-3 col-lg-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end  row -->
            </div> <!-- container fluid -->
        </div> <!-- end page content -->
        <?=$this->include('partials/footer')?>
    </div> <!-- end main content -->    

</div> <!-- end layout wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>

<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/helpdesk/report.js"></script>
</html>