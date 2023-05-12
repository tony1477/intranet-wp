<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/_datatables-css') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>    
    <?= $this->include('partials/_home-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/visimisi.css" />
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
                                            <img src="<?=base_url()?>/public/assets/images/3.png" class="card-img-top" alt="Vision Image" title="Image of Visi"/>
                                            <div class="card-body">
                                                <h5 class="card-title text-visi-misi"><?=lang('Files.visi')?></h5>
                                                <p class="card-text text-visi"><?=$session->get('lang') == 'en' ? $visi['EN'][0] : $visi['ID'][0]?></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="card visi-misi border-0" style="width:35vw; align-items:center">
                                            <img src="<?=base_url()?>/public/assets/images/4.png" class="card-img-top" alt="Mission Image" title="Image of Mission">
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
                                        <img src="<?=base_url()?>/public/assets/images/core-values/w.png" class="imgmodal" id="wisdom" onclick="showModal(this)" alt="Wisdom's Image">
                                        <img src="<?=base_url()?>/public/assets/images/core-values/i.png" class="imgmodal" id="intellectual" onclick="showModal(this)" alt="Intellectual's Image">
                                        <img src="<?=base_url()?>/public/assets/images/core-values/l.png" class="imgmodal" id="loyal" onclick="showModal(this)" alt="Loyal's Image">
                                        <img src="<?=base_url()?>/public/assets/images/core-values/in.png" class="imgmodal" id="integrity" onclick="showModal(this)" alt="Integrity's Image">
                                        <img src="<?=base_url()?>/public/assets/images/core-values/a.png" class="imgmodal" id="accomplished" onclick="showModal(this)" alt="Accomplished's Image">
                                        <img src="<?=base_url()?>/public/assets/images/core-values/n.png" class="imgmodal" id="noble" onclick="showModal(this)" alt="Noble's Image">
                                    </div>

                                    <?php 
                                    foreach($values as $key => $value):?>
                                        <div class="modal fade" id="<?=$key?>Modal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content modal-values">
                                                    <div class="modal-body">
                                                    <div class='content'>
                                                        <img src="<?=base_url()?>/public/assets/images/core-values/<?=$value['image']?>" class="img-content" />
                                                        <h3 class="text-underline values-title"><?=ucfirst($key)?></h3>
                                                        <p class="text-highlights"><?=$value['title']?></p>
                                                        <p class="values-description"><?=$session->get('lang') == 'en' ? $values[$key]['en'] : $values[$key]['id']?></p>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php endforeach;?>
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

<!-- Datatables -->
<?= $this->include('partials/_datatable-js') ?>

<?= $this->include('partials/_home-js') ?>

<script>
    const imgmodal = document.querySelectorAll('.imgmodal')
   
    function showModal(el) {
        const modalName = el.id+'Modal'
        $('#'+modalName).modal('show')
    }
</script>