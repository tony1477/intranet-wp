<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex mh-100">
            <!-- LOGO -->
            <div class="navbar-brand-box h-100">
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?=base_url()?>/assets/images/logo-baru.png" alt="" height="33">
                    </span>
                    <span class="logo-lg text-center">
                        <div class="w-100 mt-2">
                        <img src="<?=base_url()?>/assets/images/logo-baru.png" alt="" height="65"> <div class="logo-txt" style="margin-top:-15px">WILIAN PERKASA</div>
                        <div style="margin-top:-45px" class="slogan">be Wise be Excellent</div>
                    </div>
                    </span>
                </a>

                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?=base_url()?>/assets/images/logo-white.png" alt="" height="33">
                    </span>
                    <span class="logo-lg">
                        <img src="<?=base_url()?>/assets/images/logo-white.png" alt="" height="88"> <span class="logo-txt">WILIAN PERKASA</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="<?= lang('Files.Search') ?>...">
                    <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="<?= lang('Files.Search') ?>..." aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $session = \Config\Services::session();
                    $lang = $session->get('lang');
                    switch ($lang) {
                        case 'id':
                            echo '<img src="'.base_url().'/assets/images/flags/id.jpg" alt="Header Language" height="16">';
                            break;
                        case 'en':
                            echo '<img src="'.base_url().'/assets/images/flags/us.jpg" alt="Header Language" height="16">';
                            break;
                        default:
                            echo '<img src="'.base_url().'/assets/images/flags/id.jpg" alt="Header Language" height="16">';
                    }
                    ?>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    
                        <a href="<?= base_url('lang/id'); ?>" class="dropdown-item notify-item language" data-lang="id">
                            <img src="<?=base_url()?>/assets/images/flags/id.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Bahasa</span>
                        </a>

                        <a href="<?= base_url('lang/en'); ?>" class="dropdown-item notify-item language" data-lang="en">
                            <img src="<?=base_url()?>/assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                        </a>

                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell" class="icon-lg"></i>
                    <span class="badge bg-danger rounded-pill">5</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> <?= lang('Files.Notifications') ?> </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small text-reset text-decoration-underline"> <?= lang('Files.Unread') ?> (3)</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="<?=base_url()?>/assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= lang('Files.James_Lemire') ?></h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1"><?= lang('Files.It_will_seem_like_simplified_English') ?>.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span><?= lang('Files.1_hours_ago') ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-sm me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="bx bx-cart"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= lang('Files.Your_order_is_placed') ?></h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1"><?= lang('Files.If_several_languages_coalesce_the_grammar') ?></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span><?= lang('Files.3_min_ago') ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-sm me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= lang('Files.Your_item_is_shipped') ?></h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1"><?= lang('Files.If_several_languages_coalesce_the_grammar') ?></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span><?= lang('Files.3_min_ago') ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="<?=base_url()?>/assets/images/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= lang('Files.Salena_Layfield') ?></h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1"><?= lang('Files.As_a_skeptical_Cambridge_friend_of_mine_occidental') ?>.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span><?= lang('Files.1_hours_ago') ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span><?= lang('Files.View_More') ?>..</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div> -->

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?=base_url()?>/assets/images/users/<?=user()->user_image?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= (user()->fullname != '') ? user()->fullname : 'Isi Nama Anda';?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="<?=base_url().'/'.user()->username.'/profile'?>"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> <?= lang('Files.Profile') ?></a>
                   <a class="dropdown-item" href="#"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> <?= lang('Files.Lock_screen') ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=base_url()?>/logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> <?= lang('Files.Logout') ?></a>
                </div>
            </div>

        </div>
    </div>
</header>