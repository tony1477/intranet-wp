<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/index.css" />
    <?= $this->include('partials/sweetalert-css') ?>
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
                            <h5 class="card-title"><?=lang('Files.List_Article')?> <span class="text-muted fw-normal ms-2"></span></h5>
                        </div>
                    </div>

                    <?php //if(has_permission('article')):?>
                    <!-- <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?=lang('Files.Manage').' '.lang('Files.Article')?> <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <li><a class="dropdown-item" href="#"><?=lang('Files.Category')?></a></li>
                                    <li><a class="dropdown-item" href="#"><?=lang('Files.Article')?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
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

                    <?= view('company/sidebar',
                        ['data' =>$data,'periode'=>$periode,'title'=>$title
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

<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>
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

    const emailSubsBtn = document.querySelector('.emailsubs')
    emailSubsBtn.addEventListener('click', (e) => {
        let parentEl = e.target.parentElement.parentElement.previousElementSibling
        fetch('<?=base_url()?>/article/addemailsubs',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type' : 'application/json',
            },
            body: JSON.stringify({'data':parentEl.value})
        })
        .then(response => response.json())
        .then(data => {
            if(data.status=='warning') return Swal.fire("Info!", data.message, data.status)
            if(data.status=='success') return Swal.fire("Success!", data.message, data.status)
        })
    })
</script>
</body>
</html>