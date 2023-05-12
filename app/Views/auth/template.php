<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Login | Intranet Wilian Perkasa Group</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Intranet Web for Wilian Perkasa Group" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta content="Martoni F" name="creator" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>/public/assets/images/logo.png">

        <?= $this->include('partials/head-css') ?>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/template.css" />

</head>

<?= $this->include('partials/body') ?>

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center justify-content-center">
                                        <img src="<?=base_url() ?>/public/assets/images/logo-baru.png" alt="Logo WP" height="88">
                                        <a href="<?=base_url()?>" class="d-block auth-logo mt-3">
                                             <span class="logo-txt text-center">WILIAN PERKASA</span>
                                        </a>
                                        <span id="slogan" class="text-end">" be Wise be Excellent "</span>
                                    </div>

                                    <?= $this->renderSection('content')?>

                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© 2022 . All Right Reserved</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="card d-flex">
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                                <div class="carousel-indicators">
                                    <?php $i=0; 
                                    helper('admin');
                                    $image_slide = getImageSlider();
                                    foreach($image_slide as $indicator):?>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$i?>" class="<?=$i==0 ?'active' : ''?>" aria-label="Slide <?=$i+1?>" aria-current="true"></button>
                                    <?php $i++; endforeach;?>
                                </div>
                                <div class="carousel-inner">
                                    <?php 
                                    $i=0;
                                    foreach($image_slide as $inner):?>
                                    <div class="carousel-item <?=$i==0 ?'active' : ''?>">
                                    <img src="<?=base_url()?>/public/assets/images/gallery/foto/<?=$inner->url?>" class="d-block w-100" style="min-height:100vh;" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 class="judul"><?=$inner->title?></h5>
                                        <?=$inner->description?>
                                    </div>
                                    </div>
                                    <?php 
                                    $i++;
                                    endforeach;?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="bg-overlay" style="background: rgba(0,0,0,.4);"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- end bubble effect -->
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>

        <audio controls autoplay="true" id="myAudio" style="display:none">
            <source src="<?=base_url()?>/public/assets/mars.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
        </audio>
        <!-- JAVASCRIPT -->
       <?= $this->include('partials/vendor-scripts') ?>

       <?=$this->renderSection('customjs')?>

       <script>
        window.onload = (event) => {
            const form = document.querySelector('input[name="login"]')
            form.addEventListener('click', e => {
                myAudio.play();
            })
        };
       </script>

    </body>

</html>