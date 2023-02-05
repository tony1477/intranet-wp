<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/_datatables-css') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/index.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/visimisi.css" />
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

                <div class="row">
                    <?php
                    $session = session();
                        $visi = [
                            'ID' => ['Meningkatkan kualitas hidup melalui pengembangan multi industri dan menjadi perusahaan yang dipercaya.'],
                            'EN' => ['To Improve stakeholders lives through multi-industry expansion and be the must trusted corporation.']
                        ];
                        $misi = [
                            'ID' => [
                                ['Menyediakan produk alami untuk bisnis maupun pelanggan dengan memberikan harga yang kompetitif dan mutu yang baik.'],
                                ['Menyediakan berbagai kesempatan bagi karyawan dan komunitas lokal agar mereka mempunyai standar kehidupan yang lebih baik.'],
                                ['Bertransformasi menjadi perusahaan dengan manajemen yang profesional dan sistem yang terintegrasi.']
                            ],
                            'EN' => [
                                ['To provide natural product for both business and customer by providing competitive price and in acceptable quality.'],
                                ['Providing more opportunities for our employees and local communities to have a better standard of living.'],
                                ['Transform into a professional management and an integrated system.']
                            ]
                        ];
                        $values = [
                            'wisdom' => [
                                'id' => 'Bersikap BIJAKSANA, sehingga mampu memahami dan membedakan tindakan yang benar atau salah dalam menangani pekerjaan ataupun masalah.',
                                'en' => 'Bersikap BIJAKSANA, sehingga mampu memahami dan membedakan tindakan yang benar atau salah dalam menangani pekerjaan ataupun masalah.(EN)',
                                'image' => 'w.png',
                                'title' => 'Bijaksana',
                            ],
                            'intellectual' => [
                                'id' => 'Berpikir POSITIF dalam bertindak sehingga menciptakan profesionalisme dalam menghadapi orang ataupun situasi.',
                                'en' => 'Berpikir POSITIF dalam bertindak sehingga menciptakan profesionalisme dalam menghadapi orang ataupun situasi.(EN)',
                                'image' => 'i.png',
                                'title' => 'Intellectual',
                                'title' => 'Rasional'
                            ],
                            'loyal' => [
                                'id' => 'Memiliki sifat SETIA dan bangga menjadi bagian dari Wilian Perkasa Group.',
                                'en' => 'Memiliki sifat SETIA dan bangga menjadi bagian dari Wilian Perkasa Group.(EN)',
                                'image' => 'l.png',
                                'title' => 'Setia'
                            ],
                            'integrity' => [
                                'id' => 'JUJUR dalam setiap tindakan dan memiliki etika dalam melakukan perbuatan tersebut.',
                                'en' => 'JUJUR dalam setiap tindakan dan memiliki etika dalam melakukan perbuatan tersebut.(EN)',
                                'image' => 'in.png',
                                'title' => 'Jujur',
                            ],
                            'accomplished' => [
                                'id' => 'Memiliki skill (ketrampilan) yang kompeten dan selalu berusaha meningkatkan ketrampilan tersebut agar menjadi lebih sempurna dan semakin unggul di bidangnya.',
                                'en' => 'Memiliki skill (ketrampilan) yang kompeten dan selalu berusaha meningkatkan ketrampilan tersebut agar menjadi lebih sempurna dan semakin unggul di bidangnya.(EN)',
                                'image' => 'a.png',
                                'title' => 'Unggul & Terampil',
                            ],
                            'noble' => [
                                'id' => 'Memiliki jiwa yang saling MENGHORMATI dan MENGHARGAI untuk menciptakan suasana nyaman di dalam pekerjaan.',
                                'en' => 'Memiliki jiwa yang saling MENGHORMATI dan MENGHARGAI untuk menciptakan suasana nyaman di dalam pekerjaan.(EN)',
                                'image' => 'n.png',
                                'title' => 'Terhormat'
                            ]
                        ];
                    ?>
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                                <h4 class="card-title"><?= lang('Files.'.$menuname)?></h4>
                            </div>
                            <div class="card-body">
                                <div class="px-4 py-5 mb-5 text-center">                                    
                                    <div class="row d-flex justify-content-center">
                                        <div class="card visi-misi border-0" style="width:35vw; align-items:center">
                                            <img src="<?=base_url()?>/assets/images/3.png" class="card-img-top" alt="Vision Image" title="Image of Visi"/>
                                            <div class="card-body">
                                                <h5 class="card-title text-visi-misi"><?=lang('Files.visi')?></h5>
                                                <p class="card-text text-visi"><?=$session->get('lang') == 'en' ? $visi['EN'][0] : $visi['ID'][0]?></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="card visi-misi border-0" style="width:35vw; align-items:center">
                                            <img src="<?=base_url()?>/assets/images/4.png" class="card-img-top" alt="Mission Image" title="Image of Mission">
                                            <div class="card-body">
                                                <h5 class="card-title text-visi-misi"><?=lang('Files.misi')?></h5>
                                                <ul class="text-misi">
                                                <?php 
                                                $txt = ($session->get('lang') == 'en' ? $misi['EN'] : $misi['ID']);
                                                foreach($txt as $row):?>
                                                <li><?=$row[0]?></li>
                                                <?php endforeach;?>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row values justify-content-center">
                                        <h3 class="text-center"><?=lang('Files.Core_Values')?></h3>
                                        <img src="<?=base_url()?>/assets/images/core-values/w.png" class="imgmodal" id="wisdom" onclick="showModal(this)" alt="Wisdom's Image">
                                        <img src="<?=base_url()?>/assets/images/core-values/i.png" class="imgmodal" id="intellectual" onclick="showModal(this)" alt="Intellectual's Image">
                                        <img src="<?=base_url()?>/assets/images/core-values/l.png" class="imgmodal" id="loyal" onclick="showModal(this)" alt="Loyal's Image">
                                        <img src="<?=base_url()?>/assets/images/core-values/in.png" class="imgmodal" id="integrity" onclick="showModal(this)" alt="Integrity's Image">
                                        <img src="<?=base_url()?>/assets/images/core-values/a.png" class="imgmodal" id="accomplished" onclick="showModal(this)" alt="Accomplished's Image">
                                        <img src="<?=base_url()?>/assets/images/core-values/n.png" class="imgmodal" id="noble" onclick="showModal(this)" alt="Noble's Image">
                                    </div>

                                    <?php 
                                    foreach($values as $key => $value):?>
                                        <div class="modal fade" id="<?=$key?>Modal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content modal-values">
                                                    <div class="modal-body">
                                                    <div class='content'>
                                                        <img src="<?=base_url()?>/assets/images/core-values/<?=$value['image']?>" class="img-content" />
                                                        <h3 class="text-underline values-title"><?=ucfirst($key)?></h3>
                                                        <p class="text-highlights"><?=$value['title']?></p>
                                                        <p class="values-description"><?=$session->get('lang') == 'en' ? $values[$key]['en'] : $values[$key]['id']?></p>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php endforeach;?>
                                    <!-- <div class="modal fade" id="wisdomModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-values">
                                                <div class="modal-body">
                                                <div class='content'>
                                                    <img src="<?=base_url()?>/assets/images/core-values/w.png" class="img-content" />
                                                    <h3 class="text-underline values-title">Wisdom</h3>
                                                    <p class="text-highlights">Bijaksana</p>
                                                    <p class="values-description"><?=$session->get('lang') == 'en' ? $values['wisdom']['en'] : $values['wisdom']['id']?></p>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal fade" id="intellectualModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-values">
                                                <div class="modal-body">
                                                <div class='content'>
                                                    <img src="<?=base_url()?>/assets/images/core-values/i.png" class="img-content" />
                                                    <h3 class="text-underline values-title">Intellectual</h3>
                                                    <p class="text-highlights">Rasional</p>
                                                    <p class="values-description">Berpikir POSITIF dalam bertindak sehingga menciptakan profesionalisme dalam menghadapi orang ataupun situasi.</p>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal fade" id="loyalModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-values">
                                                <div class="modal-body">
                                                <div class='content'>
                                                    <img src="<?=base_url()?>/assets/images/core-values/l.png" class="img-content" />
                                                    <h3 class="text-underline values-title">Loyal</h3>
                                                    <p class="text-highlights">Setia</p>
                                                    <p class="values-description">Memiliki sifat SETIA dan bangga menjadi bagian dari Wilian Perkasa Group.</p>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal fade" id="integrityModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-values">
                                                <div class="modal-body">
                                                <div class='content'>
                                                    <img src="<?=base_url()?>/assets/images/core-values/in.png" class="img-content" />
                                                    <h3 class="text-underline values-title">Integrity</h3>
                                                    <p class="text-highlights">Jujur</p>
                                                    <p class="values-description">JUJUR dalam setiap tindakan dan memiliki etika dalam melakukan perbuatan tersebut.</p>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal fade" id="accomplishedModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-values">
                                                <div class="modal-body">
                                                <div class='content'>
                                                    <img src="<?=base_url()?>/assets/images/core-values/a.png" class="img-content" />
                                                    <h3 class="text-underline values-title">Accomplished</h3>
                                                    <p class="text-highlights">Unggul & Terampil</p>
                                                    <p class="values-description">Memiliki skill (ketrampilan) yang kompeten dan selalu berusaha meningkatkan ketrampilan tersebut agar menjadi lebih sempurna dan semakin unggul di bidangnya.</p>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>       
                                    <div class="modal fade" id="nobleModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-values">
                                                <div class="modal-body">
                                                <div class='content'>
                                                    <img src="<?=base_url()?>/assets/images/core-values/n.png" class="img-content" />
                                                    <h3 class="text-underline values-title">Noble</h3>
                                                    <p class="text-highlights">Terhormat</p>
                                                    <p class="values-description">Memiliki jiwa yang saling MENGHORMATI dan MENGHARGAI untuk menciptakan suasana nyaman di dalam pekerjaan.</p>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> -->
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
    const imgmodal = document.querySelectorAll('.imgmodal')
   
    function showModal(el) {
        const modalName = el.id+'Modal'
        $('#'+modalName).modal('show')
    }
</script>