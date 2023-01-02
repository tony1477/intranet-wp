<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

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
                    <!-- <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title"><?=lang('Files.Read_Article')?> <span class="text-muted fw-normal ms-2"></span></h5>
                        </div>
                    </div> -->

                </div>
                <!-- end row -->

                <?php $article=$data['article']?>
                    
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <div class="text-center mb-3">
                                        <h4><?=$article->title?></h4>
                                    </div>
                                    <div class="mb-4">
                                        <img src="<?=base_url()?>/assets/images/gallery/article/<?=$article->image?>" alt="" class="img-thumbnail mx-auto d-block">
                                    </div>
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>
                                                    <h6 class="mb-2">Categories</h6>
                                                    <p class="text-muted font-size-15"><?=$article->categoryname?></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <h6 class="mb-2">Date</h6>
                                                    <p class="text-muted font-size-15"><?=date('d M, Y',strtotime($article->posted_date))?></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="text-muted mb-2">Post by</p>
                                                    <h5 class="font-size-15"><?=$article->name?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="mt-4">
                                        <?=$article->content?>
                                        <hr>

                                        <!-- <div class="mt-5">
                                            <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Comments :</h5>

                                            <div>
                                                <div class="d-flex py-3">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                                <i class="bx bxs-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-1">Delores Williams <small class="text-muted float-end">1 hr Ago</small></h5>
                                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual</p>
                                                        <div>
                                                            <a href="javascript: void(0);" class="text-success"><i class="mdi mdi-reply"></i> Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex py-3 border-top">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid d-block rounded-circle">
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-1">Clarence Smith <small class="text-muted float-end">2 hrs Ago</small></h5>
                                                        <p class="text-muted">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet</p>
                                                        <div>
                                                            <a href="javascript: void(0);" class="text-success"><i class="mdi mdi-reply"></i> Reply</a>
                                                        </div>

                                                        <div class="d-flex pt-3">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-xs">
                                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                                        <i class="bx bxs-user"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="flex-grow-1">
                                                                <h5 class="font-size-14 mb-1">Silvia Martinez <small class="text-muted float-end">2 hrs Ago</small></h5>
                                                                <p class="text-muted">To take a trivial example, which of us ever undertakes laborious physical exercise</p>
                                                                <div>
                                                                    <a href="javascript: void(0);" class="text-success"><i class="mdi mdi-reply"></i> Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex py-3 border-top">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                                <i class="bx bxs-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-1">Keith McCoy <small class="text-muted float-end">12 Aug</small></h5>
                                                        <p class="text-muted">Donec posuere vulputate arcu. phasellus accumsan cursus velit</p>
                                                        <div>
                                                            <a href="javascript: void(0);" class="text-success"><i class="mdi mdi-reply"></i> Reply</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>
                                        <div class="mt-5">
                                            <h5 class="font-size-16 mb-3">Leave a Reply:</h5>

                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="commentname-input" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="commentname-input" placeholder="Enter name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="commentemail-input" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="commentemail-input" placeholder="Enter email">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="commentmessage-input" class="form-label">Message</label>
                                                    <textarea class="form-control" id="commentmessage-input" placeholder="Your message..." rows="3"></textarea>
                                                </div>

                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary w-sm">Submit</button>
                                                </div>
                                            </form>
                                        </div> -->
                                        <button type="button" class="btn btn-soft-primary waves-effect waves-light"><i class="bx bx-left-arrow-alt font-size-16 align-middle me-2"></i> Sebelumnya</button>

                                        <button type="button" class="btn btn-soft-primary waves-effect waves-light float-end">Selanjutnya <i class="bx bx-right-arrow-alt font-size-16 align-middle me-2"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!--end col-->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="search-box">
                                    <h5 class="mb-3">Search</h5>
                                    <div class="position-relative px-2">
                                        <input type="text" class="form-control rounded bg-light border-light" placeholder="Search...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h5 class="mb-3">Categories</h5>
                                    <ul class="list-unstyled fw-medium px-2">
                                        <?php foreach($data['category'] as $category):?>
                                        <li><a href="javascript: void(0);" class="text-dark py-3 d-block border-bottom"><?=$category->categoryname?><span class="badge badge-soft-primary badge-pill float-end ms-1 font-size-12"><?=$category->jum?></span></a></li>
                                        
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                                <?php if(count($data['upcoming'])>0):?>
                                <div class="mt-5">
                                    <h5 class="mb-3">Upcoming Post</h5>
                                    <div class="list-group list-group-flush">
                                        <?php foreach($data['upcoming'] as $upcoming):?>
                                        <a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img src="<?=base_url()?>/assets/images/gallery/article/<?=$upcoming->image?>" alt="" class="avatar-lg h-auto d-block rounded">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate"><?=$upcoming->title?></h5>
                                                    <p class="mb-0 text-truncate"><?=$upcoming->created_at?><span class="">/ 05:00 AM</span></p>
                                                </div>
                                                <div class="fs-1">
                                                    <i class="mdi mdi-calendar"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(count($data['popular'])>0):?>
                                <div class="mt-5">
                                    <h5 class="mb-3">Popular Post</h5>
                                    <div class="list-group list-group-flush">
                                        <?php foreach($data['popular'] as $popular):?>
                                        <a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img src="<?=base_url()?>/assets/images/gallery/article/<?=$popular->image?>" alt="" class="avatar-xl h-auto d-block rounded">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate"><?=$popular->title?></h5>
                                                    <p class="mb-0 text-truncate"><?=$popular->created_at?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <!-- <div class="mt-5">
                                    <h5 class="mb-3">Tag Clouds</h5>
                                    <div class="px-2">
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Design</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Development</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Wordpress</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">HTML</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Project</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Business</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Travel</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Photography</span></a>
                                    </div>
                                </div> -->

                                <!-- <div class="mt-5">
                                    <h5 class="mb-3">Instagram Post</h5>
                                    <div class="gap-2 hstack flex-wrap px-2">
                                        <img src="assets/images/small/img-3.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-1.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-2.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-4.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-5.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-6.jpg" alt="" class="avatar-xl rounded">
                                    </div>
                                </div> -->

                                <div class="mt-5">
                                    <h5 class="mb-3">Email Newsletter</h5>
                                    <div class="">
                                        <div class="input-group mb-0 px-2">
                                            <input type="text" class="form-control" placeholder="Sedang dalam pengembangan" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-send-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
                <!-- end row -->

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

<script src="<?=base_url()?>/assets/js/app.js"></script>
</body>

</html>