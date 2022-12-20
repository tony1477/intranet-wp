<!DOCTYPE html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <?= $page_title ?>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Slider Foto Kegiatan WPG</h4>
                                <p class="card-title-desc">You can also add the indicators to the
                                    carousel, alongside the controls, too.</p>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php for($i=0; $i<count($data['foto']); $i++):?>
                                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$i?>" class="<?=($i==0 ? 'active' : '')?>"></li>
                                        <?php endfor;?>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <?php $i=0;
                                        foreach($data['foto'] as $foto): ?>

                                            <div class="carousel-item <?=$i==0 ? 'active' : ''?>">
                                            <img class="d-block img-fluid mx-auto" src="<?=base_url()?>/assets/images/gallery/foto/<?=$foto->url?>" alt="<?=$foto->title?>">
                                            <?php $i++;?>
                                        </div>
                                        <?php endforeach;?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div><!-- end carousel -->
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 fs-3 text-center"><?=lang('Files.Meeting_Schedule')?></h4>
                                <!-- <div class="flex-shrink-0">
                                    <select class="form-select form-select-sm mb-0 my-n1" onchange="changeFunc()" id="select_day">
                                        <option value="Today">Today</option>
                                        <option value="Yesterday">Yesterday</option>
                                        <option value="Tomorrow">Tomorrow</option>
                                    </select>
                                </div> -->
                            </div><!-- end card header -->
                            <div class="card-body px-0">
                                <div class="px-3" data-simplebar="init" style="max-height: 35vh;"><div class="simplebar-wrapper" style="margin: 0px -16px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -15px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 16px;">
                                    <ul class="list-unstyled activity-wid mb-0" id="ulMeeting">

                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-report font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                    <p class="text-truncate text-muted font-size-13">Bapak Purwantoro, Ibu Lainy, Bapak Hermansyah, Ibu Ocni, Ibu Widiyati, Bapak Daud</p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13">Bapak Errry Wilian</div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    
                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-report font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                    <p class="text-truncate text-muted font-size-13">Bapak Purwantoro, Ibu Lainy, Bapak Hermansyah, Ibu Ocni, Ibu Widiyati, Bapak Daud</p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13">Bapak Errry Wilian</div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-report font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                    <p class="text-truncate text-muted font-size-13">Bapak Purwantoro, Ibu Lainy, Bapak Hermansyah, Ibu Ocni, Ibu Widiyati, Bapak Daud</p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13">Bapak Errry Wilian</div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-report font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                    <p class="text-truncate text-muted font-size-13">Bapak Purwantoro, Ibu Lainy, Bapak Hermansyah, Ibu Ocni, Ibu Widiyati, Bapak Daud</p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13">Bapak Errry Wilian</div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-report font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                    <p class="text-truncate text-muted font-size-13">Bapak Purwantoro, Ibu Lainy, Bapak Hermansyah, Ibu Ocni, Ibu Widiyati, Bapak Daud</p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13">Bapak Errry Wilian</div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-report font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                    <p class="text-truncate text-muted font-size-13">Bapak Purwantoro, Ibu Lainy, Bapak Hermansyah, Ibu Ocni, Ibu Widiyati, Bapak Daud</p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13">Bapak Errry Wilian</div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-report font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1">24/05/2021, 18:24:56</h5>
                                                    <p class="text-truncate text-muted font-size-13">Bapak Purwantoro, Ibu Lainy, Bapak Hermansyah, Ibu Ocni, Ibu Widiyati, Bapak Daud</p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13">Bapak Errry Wilian</div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>

                                    <li class="activity-list activity-border">
                                        <div class="timeline-list-item">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <a href="<?=base_url()?>/meeting-schedule" class="font-size-14 mb-1">Lihat Semua Jadwal</a>
                                            </div>
                                        </div>
                                    </li>


                                      
                                    </ul>
                                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 539px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 229px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>    
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/vendor-scripts') ?>

<!-- App js -->
<script src="assets/js/app.js"></script>
</body>

</html>