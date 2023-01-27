<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/album.css" />
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
                            <h5 class="card-title"><?=lang('Files.Gallery')?><span class="text-muted fw-normal ms-2"><!-- INI DIISI NANTI --></span></h5>
                        </div>
                    </div>

                </div>
                <!-- end row -->

                <div class="row">
                    <?php foreach($data as $row):
                        if($row->categoryid==99):
                            if(!has_permission('gallery-permission')) continue;
                        endif;
                    ?>
                    <div class="col-md-6 container">
                        <h4 class="text-center"><?=$row->categoryname?></h4>
                        <div class="card-stack">
                            <!-- <a class="buttons prev" href="#"><</a> -->
                            <?php if($row->cover !== null):
                            $exp = explode(',',$row->cover); ?>
                            <ul class="card-list" onclick="openAlbum(<?=$row->categoryid?>)">
                            <?php for($i=0; $i<count($exp); $i++):?>
                                <li><img src="<?=base_url()?>/assets/images/gallery/foto/<?=$exp[$i]?>" class="img-stack" alt="<?=$row->categoryname?>" /></li>
                            <?php endfor;?>
                            </ul>
                            <a class="buttons next" href="#">></a>
                            <?php
                            else : ?>
                            <ul class="card-list" onclick="openAlbum(<?=$row->categoryid?>)">
                            <li>
                                <h3 style="position:absolute; left:50%; top:50%; transform: translate(-50%, -50%) rotate(-45deg); color: rgba(10,20,10,.5)"><?=lang('Files.Empty')?></h3>
                                <img src="<?=base_url()?>/assets/images/gallery/default.jpeg" class="img-stack" alt="<?=lang('Files.Empty')?>"/></li>
                            </ul>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <!--
                    <div class="col-md-6 container">
                        <div class="card-stack">
                            <a class="buttons prev" href="#"><</a>
                            <ul class="card-list">
                                <li class="cards-li" style="background-color: #4CD964;"></li>
                                <li class="cards-li" style="background-color: #FFCC00;"></li>
                                <li class="cards-li" style="background-color: #FF3B30;"></li>
                                <li class="cards-li" style="background-color: #34AADC;"></li>					
                                <li class="cards-li" style="background-color: #FF9500;"></li>
                            </ul>	
                            <a class="buttons next" href="#">></a>
                        </div>
                    </div> -->
                </div>
                
                <!-- DI KOMEN SEMENTARA WAKTU -->
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
<script type="text/javascript">
     
    function openAlbum(id)
    {
        location.href = "<?=base_url()?>/gallery-foto/open-album/"+id
    }
    const nextBtn = document.querySelectorAll('.next');
    for(let i=0; i < nextBtn.length; i++) {
        nextBtn[i].addEventListener('click', function(e){
            let lastEl = this.previousElementSibling.lastElementChild
            let ulEl = this.previousElementSibling
            lastEl.classList.remove('transformPrev')
            lastEl.classList.add('transformThis')
            lastEl.previousElementSibling.classList.add('activeNow')

            let prependList = function() {
                lastEl.classList.remove('transformThis')
                lastEl.classList.remove('activeNow')
                // var slicedCard = lastEl.classList.remove('transformThis')
                ulEl.prepend(lastEl)
            }

            setTimeout(function(){prependList(); }, 150);           
        })
    }
    
    // // $('.prev').click(function() {
    // //     var appendToList = function() {
    // //         if( $('.cards-li').hasClass('activeNow') ) {
    // //             var $slicedCard = $('.cards-li').slice(0, 1).addClass('transformPrev');
    // //             $('ul.card-list').append($slicedCard);
    // //         }}
        
    // //     $('li.cards-li').removeClass('transformPrev').last().addClass('activeNow').prevAll().removeClass('activeNow');
    // //     setTimeout(function(){appendToList();}, 150);
    // // });

</script>
</body>

</html>