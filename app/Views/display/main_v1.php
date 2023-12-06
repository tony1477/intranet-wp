<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="<?=base_url()?>/public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/display-info.css">
</head>
<body>
    <header>
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                <img src="<?=base_url()?>/public/assets/images/logo-baru.jpg" alt="Logo"  height="24" class="d-inline-block align-text-top mx-3"><?=$title?></a>
            </div>
        </nav>
    </header>
    
    <main id="mainLayout">
        <div class="container-fluid bg-dark">
            <div class="row">
                <div class="sidebar-left col-lg-3 px-0">
                    <div class="card border-0">
                        <h5 class="card-header primary-bg" style="padding-top:.85rem"><small class="text-center fst-italic d-block mt-2">"Quotes of the Day"</small></h5>
                        <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                            <div class="d-none carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <?php 
                                $quote = array_map(function ($img, $index) {
                                    $classes = ($index == 0) ? 'active' : '';
                                    return '<div class="carousel-item '.$classes.'">
                                    <div class="card">
                                    <img src="'.base_url().'/public/assets/images/quotes/'.$img.'" class="card-img-top " alt="quotes-'.($index+1).'" style="height:45vh"></div></div>';
                                }, $quotes, array_keys($quotes));
                                echo implode('', $quote);
                                ?>
                            </div>
                            <button class="d-none carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="d-none carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="card border-0 py-2">
                        <h5 class="primary-bg card-header text-center"><small>Gallery Foto</small></h5>
                        <div class="card-body slider-image">
                            <div class="auto-slider">
                                <div class="auto-slider__content">
                                    <?php array_map(function($img){
                                        echo '<img src="'.base_url().'/public/assets/images/gallery/foto/'.$img.'" width="100%">';
                                    }, $galleries);
                                    ?>
                            </div>
                            </div>
                        </div>
                        <!-- <div class="card-footer text-muted">&nbsp;</div> -->
                    </div>
                </div>
                <div class="centerbar col-lg-6 px-0">
                    <div class="card">
                        <h3 class="card-header text-center primary-bg">Cuplikan Video Aktifitas Wilian Perkasa</h3>
                        <div class="card-body">
                            <video controls="controls" width="100%" id="mainvideo" data-id="1">
                                <source id="srcVideo" src="<?=base_url()?>/public/assets/videos/<?=$videos[0]['main']?>" type="video/mp4" />
                            </video>
                            <div id="content"><?=$videos[0]['content']?></div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-right col-lg-3 px-0">
                    <div class="card px-0">
                        <h5 class="card-header primary-bg" style="padding-top:.85rem"><small class="d-block text-center mt-2">Best of 3 Employee</small></h5>
                        <div class="card-body">
                            <div class="list-group">
                                <?php array_map(function($employee){
                                    echo '<a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="d-flex ">
                                        <img src="'.base_url().'/public/assets/images/users/'.$employee['photo'].'" class="rounded-circle img-thumbnail" alt="..." style="height:5rem; width:5rem">
                                        <p class="mx-3 " style="margin-top:1.5rem">'.$employee['name'].'<br><span class="text-muted">'.$employee['division'].'</span></p>
                                    </div>
                                    </a>';
                                }, $bestemployees);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card px-0">
                        <h5 class="card-header primary-bg text-center"><small>Wilian Perkasa Events</small></h5>
                            <div class="card-body px-0">
                                <div class="px-3" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px -16px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -15px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 16px;">
                                    <ul class="list-unstyled activity-wid mb-0" id="ulMeeting">
                                    <?php 
                                        array_map(function($event){
                                            echo '<li class="activity-list activity-border" id="liMeeting">
                                                <div class="activity-icon avatar-md">
                                                    <span class="avatar-title secondary-bg color-text rounded-circle">
                                                    <i class="'.$event['icon'].' font-size-24"></i>
                                                    </span>
                                                </div>
                                                <div class="timeline-list-item">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 overflow-hidden me-4">
                                                            <h5 class="font-size-14 mb-1">'.$event['date'].'</h5>
                                                            <p class="text-truncate text-muted">'.$event['desc'].'</p>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </li>';
                                        },$events);
                                    ?>                                      
                                    </ul>
                                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 25vh;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 229px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>    
                            </div>
                    </div>
                    <div class="card text-dark primary-bg d-flex py-2">
                    <div class="card-body">
                            <h3 class="card-title text-center"><?=getDayIndo(date('D')). date(', d M Y')?></h3>
                            <p class="card-text text-center fs-2 fw-bold disp-time" id="clock">14:40:35</p>
                        <p class=""></p></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="secondary-bg footer-text pt-1">
        <div class="row mx-0">
            <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <marquee class="color-text fw-bold">Selamat Pagi Bapak / Ibu, Di reminder kembali, bahwa Wilian Perkasa mempunyai aplikasi http://peduliwp.odoo.com. Sebagai sarana Bapak /Ibu untuk menyampaikan Saran, keluhan yang dapat di isi oleh seluruh karyawan WP.</marquee>
                </div>
            <div class="col-lg-3"></div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/mntn-dev/t.js/t.min.js"></script>
    <script src="<?=base_url()?>/public/assets/js/display-script.js"></script>
    <script>
        const videos = [
            {
                id:1,
                main:'video1.mov',
                content:'<p>Wilian Perkasa berdiri pada tanggal 10 Juli 2019, Wilian Perkasa merupakan perusahaan induk yang terlibat, baik secara langsung maupun melalui anak perusahaannya, dalam produksi dan penjualan minyak sawit mentah, inti sawit, produk Agronomi, serta produk bahan makanan dan minuman.</p><p>Sebagai salah satu perusahaan yang berdiri dan bertujuan sebagai perusahaan Multi industri yang di percaya oleh stakeholder, kami beraspirasi untuk menjadi bagian perusahaan yang bertanggung jawab, mendorong era baru yang berkelanjutan di industri ini dengan inovasi-inovasi di lini bisnis.</p>',
            },{
                id:2,
                main:'video2.mp4',
                content:'<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et illo voluptatum nulla maiores doloremque neque expedita, quis minus voluptatem voluptas nesciunt. Fugiat quaerat aperiam obcaecati minima assumenda, corrupti adipisci! Reiciendis beatae ex aliquam sit saepe deserunt quis hic rem velit eaque! Nesciunt praesentium facilis quam architecto, quos repellat animi qui?</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga expedita eligendi assumenda, omnis optio, rem quos aperiam adipisci esse sunt voluptatibus. Facere, corporis dolor? Incidunt, aperiam eligendi. Molestias iusto est at repellat, autem tempora dolorem iste quibusdam, suscipit omnis, modi ratione animi distinctio ad quasi culpa dolor? Quas, neque odio.</p>',
            }
        ]
        const mainVideo = document.querySelector('#mainvideo')
        const startVideo = async () => {
            const video = document.querySelector('#mainvideo');
            // video.muted = true
            try {
                await video.play();
                video.setAttribute('autoplay', true);
                // await video.muted = false;
                console.log('video started playing successfully');
            } catch (err) {
                console.log(err, 'video play error');
                // do stuff in case your video is unavailable to play/autoplay
            }
        }
        setTimeout(startVideo, 2500)
        const playNextVideo = function() {
            mainVideo.poster = '<?=base_url()?>/public/assets/images/loading-video.jpg'

            const returnFirstVideo = function() {
                srcVideo.src = `<?=base_url()?>/public/assets/videos/${videos[0].main}`
                mainVideo.dataset.id = 1
                const content = document.querySelector('#content')
                content.innerHTML = videos[0].content
                // content.classList.add('d-none')
                // mainVideo.addEventListener('timeupdate', showText)
                mainVideo.load()
            }
            const nextPlayList = function(video) {
                srcVideo.src = `<?=base_url()?>/public/assets/videos/${video.main}`
                mainVideo.dataset.id = video.id
                const content = document.querySelector('#content')
                content.innerHTML = video.content
                // content.classList.add('d-none')
                // mainVideo.addEventListener('timeupdate', showText)
                mainVideo.load()
                // setTimeout(mainVideo.load(),2500)
            }
            let id = mainVideo.dataset.id
            const maxPlaylist = videos.length
            id++
            if(id > maxPlaylist) return setTimeout(returnFirstVideo,2500);
            videos.forEach(video => {
                if(video.id == id) return setTimeout(nextPlayList,2500,video)
            })
        }
        mainVideo.addEventListener('ended',function(){
            // setTimeout(playNextVideo,2500)
            playNextVideo();
        },false);

        // mainVideo.addEventListener('playing', function() {
        //     // console.log('playing')
        //     if(mainVideo.duration > 3.5) console.log('tampil teks')
        //     setTimeout(function() {
        //         console.log('show teks after video play 3 seconds')
        //     }, 3500)
        // })
        const showText = function() {
            if(mainVideo.currentTime > 3.5) {
                document.querySelector('#content').classList.remove('d-none')
                $('#content').t({
                    blink:false,
                    repeat:true,
                    delay:2,
                    caret:false,
                });
                mainVideo.removeEventListener('timeupdate',showText)
            }
        }
        // mainVideo.addEventListener('timeupdate', showText)
    </script>
</body>
</html>