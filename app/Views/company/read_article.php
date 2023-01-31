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
                                        <?php if($article->pdffile != ''):?>
                                        <div class="row justify-content-end">
                                            <div class="col-xl-2 col-6">
                                                <div class="card">
                                                    <i class="bx bxs-download fs-1 text-center"></i>
                                                    <div class="py-2 text-center">
                                                        <a download="<?=$article->pdffile?>" href="<?=base_url()?>/assets/protected/article/<?=$article->pdffile?>" class="fw-medium">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif;?>

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

                    <?= view('company/sidebar',
                        ['data' =>$data,'periode'=>$data['periode'],'title'=>str_replace(' ','-',$data['title'])
                        ]
                    )?>
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