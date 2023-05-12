<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/_home-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/lightgallery/css/lightgallery.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/lightgallery/css/custom.css" />
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
                            <h5 class="card-title"><?=lang('Files.Video')?><span class="text-muted fw-normal ms-2"><!-- INI DIISI NANTI --></span></h5>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <?php $i=1; foreach($data as $row):?>
                    <!-- Hidden video div -->
                    <div style="display:none;" id="video<?=$i?>">
                        <video class="lg-video-object lg-html5" controls preload="none">
                            <source src="<?=base_url()?>/public/assets/videos/<?=$row->url?>" type="video/mp4">
                            <?php if($row->title=='Mars Wilian Perkasa'):?>
                            <track src="<?=base_url()?>/public/assets/videos/subtitle/EN_file.vtt" label="English" kind="subtitles" srclang="EN-US" >
                            <track src="<?=base_url()?>/public/assets/videos/subtitle/ID_file.vtt" label="Indonesia" kind="subtitles" srclang="ID" default>
                            <?php endif;?>
                            Your browser does not support HTML5 video.
                        </video>
                    </div>
                    <?php $i++; endforeach;?>

                    <div class="demo-gallery">
                        <ul id="lightgallery" class="list-unstyled row">
                        <?php $j=1; foreach($data as $row):?>
                            <li class="col-xs-6 col-sm-4 col-md-4 col-lg-4 col-xl4" data-sub-html="<?=$row->title?>" data-html="#video<?=$j?>" data-poster="<?=base_url()?>/public/assets/videos/poster/<?=$row->sampul_video?>">
                                <img class="img-responsive bg-secondary border border-primary border rounded opacity-25 w-100" src="<?=base_url()?>/public/assets/videos/poster/<?=$row->sampul_video?>" />
                                <div class="text-center">
                                <h5><?=$row->title?></h5></div>
                            </li>                            
                            <?php $j++; endforeach;?>
                        </ul>
                    </div>
                </div>
                
                <!-- DI KOMEN SEMENTARA WAKTU -->
                <!-- <div class="row justify-content-center mb-4 mt-3">
                    <div class="col-md-3">
                        <div class="">
                            <ul class="pagination mb-sm-0">
                                <li class="page-item disabled">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">4</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">5</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
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

<?= $this->include('partials/_home-js') ?>

<script src="<?=base_url()?>/public/assets/lightgallery/js/lightgallery.min.js"></script>
<script src="<?=base_url()?>/public/assets/lightgallery/js/lg-pager.min.js"></script>
<script src="<?=base_url()?>/public/assets/lightgallery/js/lg-fullscreen.min.js"></script>
<script src="<?=base_url()?>/public/assets/lightgallery/js/lg-share.min.js"></script>
<script src="<?=base_url()?>/public/assets/lightgallery/js/lg-video.min.js"></script>
<script src="<?=base_url()?>/public/assets/lightgallery/js/lg-thumbnail.min.js"></script>
<script>
    lightGallery(document.getElementById('lightgallery'),{
        mode: 'lg-fade',
        cssEasing : 'cubic-bezier(0.25, 0, 0.25, 1)',
        width: '100%',
    });
</script>
</body>
</html>