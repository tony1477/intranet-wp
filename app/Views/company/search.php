<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/index.css" />
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
                            <h5 class="card-title"><?=lang('Files.Search_Result').' : <span class="text-muted">'.ucfirst($data['judul']).'</span>'?> <span class="text-muted fw-normal ms-2"></span></h5>
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
                        <?php 
                        $periode='';
                        if(count($data['article'])>0):?>
                        <?php foreach($data['article'] as $article):
                         $periode = ($article->posted_date != '' ? date('Y-m',strtotime($article->posted_date)) : '-');
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
                                    <img src="<?=base_url()?>/public/assets/images/gallery/article/<?=$article->image?>" alt="Gambar Article <?=$article->title?>" class="rounded" width="75%">
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?= $pager->links('search','custom_pager')?>
                        <?php else:?>
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                            </svg>

                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                            <div>
                                <?=lang('Files.No_Find_Article').' <strong>'.$data['judul'].'</strong>'?>
                            </div>
                            </div>
                        <?php endif?>
                    </div>
                    <!--end col-->

                    <?php if($data['article']!==''):?>
                    <?=view('company/sidebar',
                        ['data' =>$data,'periode'=>$periode,'title'=>$title
                        ]
                    )?>
                    <?php endif?>
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
<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script>
    window.addEventListener('load', (e)=>{
        const datas = document.querySelectorAll('#category')
        for(let i of datas) {
            if(i.dataset.name == i.dataset.page) {
                i.classList.remove('text-dark')
                i.classList.add('text-primary')
            }
        }
    })
</script>
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