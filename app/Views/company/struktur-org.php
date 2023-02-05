<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/_datatables-css') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
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
        <?php $session = session()?>
        <div class="page-content">
            <div class="container-fluid">

                 <!-- start page title -->
                 <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                                <h4 class="card-title"><?= lang('Files.'.$menuname)?></h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <?php foreach($data as $row):?>
                                    <button type="button" class="btn btn-secondary">
                                        <a href="javascript:;" onclick="changedoc(this)" class="text-light doc-<?=$row['idstrukturorg']?>">
                                        <?php if($row['idstrukturorg']==1):?>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                                            <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3Zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Z"></path>
                                        </svg> -->
                                        <?php endif;?>
                                        <?=$row['stg_kode']?>
                                        </a>
                                    </button>
                                    <?php endforeach;?>
                                </div>
                                <!-- <br /> -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <!-- <p>KODE STRUKTUR ORGANISASI : WPG.GROUP</p> -->
                                            <p id="namastruktur"></p>
                                        </div>
                                        <div class="card-body">
                                            <embed id="docStruktur" scrolling="no" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" allowtransparency="true" style="border: none; height: 600px; width: 100%; overflow: hidden;" type="application/pdf">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
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

<!-- Required datatable js -->
<script src="<?=base_url()?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/assets/libs/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url()?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?=base_url()?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="<?=base_url()?>/assets/js/app.js"></script>
<script>

    window.addEventListener("load", (event) => {
        const embedded = document.querySelector('#docStruktur')
        const ptitle = document.querySelector('p#namastruktur')
        getDoc('doc-1')
        .then(data => {
            embedded.src=`<?=base_url()?>/assets/protected/struktur-organisasi/${data.file}#toolbar=0&navpanes=0&scrollbar=0`
            ptitle.innerText = data.<?=$session->get('lang') == 'en' ? 'nama_struktur2' : 'nama_struktur1'?>
        })
        console.log("page is fully loaded");
    });

    function changedoc(el)
    {
        const embedded = document.querySelector('#docStruktur')
        const ptitle = document.querySelector('p#namastruktur')
        let docId = el.classList[1]
        getDoc(docId)
        .then(data => {
            // embedded.src = `<?=base_url()?>/assets/protected/struktur-organisasi/${data}#toolbar=0&navpanes=0&scrollbar=0`
            let clone = embedded.cloneNode(true)
            clone.setAttribute('src',`<?=base_url()?>/assets/protected/struktur-organisasi/${data.file}#toolbar=0&navpanes=0&scrollbar=0`)
            embedded.parentNode.replaceChild(clone,embedded)
            ptitle.innerText = data.<?=$session->get('lang') == 'en' ? 'nama_struktur2' : 'nama_struktur1'?>
            // console.log(embedded)
        })
    }

    async function getDoc(id) {
        const response = await fetch(`<?=base_url()?>/struktur-organisasi/getDoc/${id}`,{
            method:'GET',
            mode:'cors',
            cache:'no-cache',
            creadentials:'same-origin',
            headers: {
                'Content-Type':'application/json',
                "X-Requested-With": "XMLHttpRequest"
            },
        })

        return response.json()
    }
</script>