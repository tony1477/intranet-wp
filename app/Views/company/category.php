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
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title"><?=lang('Files.List_Category').' : <span class="text-muted">'.ucfirst($data['judul']).'</span>'?> <span class="text-muted fw-normal ms-2"></span></h5>
                        </div>
                    </div>

                    <?php //if(has_permission('article')):?>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <a href="#" onclick="history.back()" class="btn btn-primary"><i class="bx bx-arrow-back me-1"></i> Kembali</a>
                        </div>
                    </div>
                    <?php //endif;?>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-8">
                        <?php foreach($data['article'] as $article):
                         $periode = date('Y-m',strtotime($article->posted_date));
                         $title = str_replace(' ','-',$article->title);    
                        ?>
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class=""><a href="<?=base_url()?>/article/read/<?=$periode.'/'.$title?>" class="text-dark"><?=$article->title?></a></h5>
                                        <p class="mb-0 font-size-15"><?=substr(strip_tags($article->content,['br','p']),0,100)?>...</p>
                                        <div class="mt-3">
                                            <p class="text-muted mb-2"><?=$article->created_at?></p>
                                            <a href="<?=base_url()?>/article/read/<?=$periode.'/'.$title?>" class="align-middle font-size-15">Read more <i class="mdi mdi-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php if($article->image != ''):?>
                                <div class="col-md-4 d-flex justify-content-center" style="flex-direction: column;">
                                    <img src="<?=base_url()?>/assets/images/gallery/article/<?=$article->image?>" alt="Gambar Article <?=$article->title?>" class="rounded" width="75%">
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php endforeach;?>
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
                                        <li><a href="javascript:;" class="text-dark py-3 d-block border-bottom" id="category" data-value="<?=$category->jum?>" data-name="<?=strtolower($category->categoryname)?>"><?=$category->categoryname?><span class="badge badge-soft-primary badge-pill float-end ms-1 font-size-12"><?=$category->jum?></span></a></li>
                                        <?php endforeach;?>
                                            <div class="toast fade hide" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true" id="toastcategory">
                                                <div class="toast-header">
                                                    <img src="assets/images/logo-baru.png" alt="" class="me-2" height="18">
                                                    <strong class="me-auto">Notifikasi</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                                <div class="toast-body"></div>
                                            </div>
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
                                        <a href="<?=base_url()?>/article/read/<?=$periode.'/'.$title?>" class="list-group-item text-muted pb-3 pt-0 px-2">
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
<script>
    const category = document.querySelectorAll('#category')
    for(let i of category) {
        i.addEventListener('click',(e)=> {
            // console.log(e.target)
            const jumlah = e.target.dataset.value
            if(jumlah > 0) location.href = `<?=base_url()?>/article/${e.target.dataset.name}`
            // Swal.fire({
            //     position: 'top-end',
            //     icon: 'info',
            //     title: 'Belum ada berita di kategori ini',
            //     showConfirmButton: false,
            //     timer: 1500
            //     })
            else { 
                const toastcategory = document.querySelector('#toastcategory')
                const toastBody = document.querySelector('.toast-body')
                toastcategory.classList.remove('hide')
                toastcategory.classList.add('show')
                toastBody.innerText = `Maaf belum tersedia berita dalam kategori ${e.target.dataset.name}`
            }
            // $('#toastcategory').show('slow')
        })
    }
</script>
</body>

</html>