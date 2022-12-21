<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/gallery.css" />
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
                            <h5 class="card-title"><?=lang('Files.Gallery_Photo')?><span class="text-muted fw-normal ms-2"><!-- INI DIISI NANTI --></span></h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="#" onclick="history.back()" class="btn btn-primary"><i class="bx bx-arrow-back me-1"></i> <?=lang('Files.Back')?></a>
                                <?php if(has_permission('gallery-permission')): ?>
                                <a href="<?=base_url()?>/gallery-foto/manage-foto/<?=$categoryid?>" class="btn btn-light"><i class="bx bxs-photo-album me-1"></i> <?=lang('Files.Manage_Photo')?></a>
                                <?php endif;?>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->

                <!-- <div class="row">
                    <?php foreach($data as $row):?>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="">
                                <img src="<?=base_url()?>/assets/images/gallery/foto/<?=$row->url?>" alt="" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2"><?=$row->updated_at?></p>
                                <h5 class=""><a href="#" class="text-dark"><?=$row->title?></a></h5>
                                <p class="mb-0 font-size-15"><?=$row->description?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>     
                </div> -->

                <div class="row">
                    <section id="portfolio">
                        <?php foreach($data as $row):?>
                        <div class="project">
                            <img class="project__image" src="<?=base_url().'/assets/images/gallery/foto/'.$row->url?>" alt="Foto-<?=$row->title?>" />
                            <p class="img-title"><?=$row->title?></p>
                            <h3 class="grid__title d-none"> <?=$row->description?></h3>
                            <div class="grid__overlay">
                                <button class="viewbutton"><?=lang('Files.open_details')?></button>
                            </div>
                        </div>
                        <?php endforeach;?>
                        
                        <div class="overlay">
                        <div class="overlay__inner">
                            <button class="close"><?=lang('Files.Close')?> X</button>
                            <img>
                            <div id="img-caption"></div>
                        </div>
                        </div>
                    </section>
                </div>
                <!-- end row -->

                <div class="row justify-content-center mb-4 mt-3">
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

<script src="<?=base_url()?>/assets/js/app.js"></script>
<script type="text/javascript">
const buttons = document.querySelectorAll('.project');
const overlay = document.querySelector('.overlay');
const overlayImage = document.querySelector('.overlay__inner img');
const imgCaption = document.querySelector('#img-caption')

function open(e) {
  overlay.classList.add('open');
  const src= e.currentTarget.querySelector('img').src;
  const imgTitle = e.currentTarget.querySelector('.img-title');
  const deskripsi = e.currentTarget.querySelector('.grid__title').innerText
  imgCaption.innerText = deskripsi
  overlayImage.src = src;
  overlayImage.alt = imgTitle.innerText
}

function close() {
  overlay.classList.remove('open');
}

buttons.forEach(button => button.addEventListener('click', open));
overlay.addEventListener('click', close);



</script>
</body>

</html>