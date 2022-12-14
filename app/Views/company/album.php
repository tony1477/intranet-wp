<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/album.css" />
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
                            <h5 class="card-title"><?=lang('Files.Album_Photo')?><span class="text-muted fw-normal ms-2"><!-- INI DIISI NANTI --></span></h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="#" class="btn btn-light"><i class="bx bx-plus me-1"></i> <?=lang('Files.Add').' '.lang('Files.New')?></a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-6 container">
                        <h4 class="text-center">ALBUM 1</h4>
                        <div class="card-stack">
                            <a class="buttons prev" href="#"><</a>
                            <ul class="card-list">
                                <li class="cards-li" style="background-color: #4CD964;"></li>
                                <li class="cards-li" style="background-color: #FFCC00;"></li>
                                <li class="cards-li" style="background-color: #FF3B30;"></li>
                            </ul>	
                            <a class="buttons next" href="#">></a>
                        </div>
                    </div>
                    <div class="col-md-6 container">
                        <h4 class="text-center">ALBUM 2</h4>
                        <div class="card-stack">
                            <a class="buttons prev" href="#" onclick="prevSlide(this)"><</a>
                            <ul class="card-list">
                                <li class="cards-li" style="background-color: #4CD964;"></li>
                                <li class="cards-li" style="background-color: #FFCC00;"></li>
                                <li class="cards-li" style="background-color: #FF3B30;"></li>
                            </ul>	
                            <a class="buttons next" href="#">></a>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 container">
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
                    </div>
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

<script src="assets/js/app.js"></script>
<script type="text/javascript">
    const $card = $('.cards-li');
    const lastCard = $(".card-list .card").length - 1;

    function nextSlide() {
        var prependList = function() {
            if($('.cards-li').hasClass('activeNow')) {
                var $slicedCard = $('.cards-li').slice(lastCard).removeClass('transformThis activeNow');
                $('ul.card-list').prepend($slicedCard);
            }
        }
        $('li.cards-li').last().removeClass('transformPrev').addClass('transformThis').prev().addClass('activeNow');
        setTimeout(function(){prependList(); }, 150);
    }

    // const nextBtn = document.querySelectorAll('.next');
    // for(let i=0; i < nextBtn.length; i++) {
    //     nextBtn[i].addEventListener('click', function(e){
    //         let prevSib = this.previousElementSibling;
    //         // console.log(this.previousElementSibling)
    //         let prependList = function() {
    //             if(prevSib.querySelector('.cards-li').classList.contains('activeNow') ) {
    //                 let $slicedCard = prevSib.querySelector('.cards-li').slice(lastCard).removeClass('transformThis activeNow');
    //                 prevSib.querySelector('ul.card-list').prepend($slicedCard);
    //             }
    //         }

            
    //         prevSib.querySelector('li.cards-li').last().removeClass('transformPrev').addClass('transformThis').prev().addClass('activeNow');
    //             setTimeout(function(){prependList(); }, 150);
    //         // });
    //         // console.log(prevSib.querySelector('.cards-li').classList.contains('activeNow'))
    //         // console.log(e)
    //     })
    // }
    // // $('.next').click(function(){ 
    // //     // console.log($('.cards-li').hasClass('activeNow'))
    // //     var prependList = function() {
    // //         if($('.cards-li').hasClass('activeNow')) {
    // //             var $slicedCard = $('.cards-li').slice(lastCard).removeClass('transformThis activeNow');
    // //             $('ul.card-list').prepend($slicedCard);
    // //         }
    // //     }
    // //     $('li.cards-li').last().removeClass('transformPrev').addClass('transformThis').prev().addClass('activeNow');
    // //     setTimeout(function(){prependList(); }, 150);
    // // });

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