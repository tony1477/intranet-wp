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
            <div class="row content">
                <div class="sidebar-left col-lg-3 px-0">
                    <div class="card border-top-0 border-end-0">
                        <h5 class="card-header primary-bg text-center"><small>"Quotes of the Day"</small>
                        </h5>
                        <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                            <div class="d-none carousel-indicators">
                                <?php
                                $quoteBtn = array_map(function ($value,$index) {
                                    $class = ($index == 0) ? 'active' : '';
                                    return '<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="'.$index.'" class="'.$class.'" aria-current="true" aria-label="Slide '.($index+1).'"></button>';
                                },$quotes, array_keys($quotes));
                                echo implode('',$quoteBtn);
                                ?>
                            </div>
                            <div class="carousel-inner">
                                <?php 
                                $quote = array_map(function ($img, $index) {
                                    $classes = ($index == 0) ? 'active' : '';
                                    return '<div class="carousel-item '.$classes.'">
                                    <div class="card">
                                    <img src="'.base_url().'/public/assets/images/quotes/'.$img['img_url'].'" class="card-img-top " alt="quotes-'.($index+1).'" style="height:45vh"></div></div>';
                                    // return $img;
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
                    <div class="card px-0 card-employee position-relative">
                        <h5 class="card-header primary-bg text-center position-relative" style="z-index:2"><small>Best of 3 Employee</small></h5>
                        <div class="card-body px-0 py-0">
                            <div class="list-group">
                                <?php array_map(function($employee){
                                    echo '<a href="#" class="list-group-item list-group-item-action py-2">
                                    <div class="d-flex align-items-center">
                                        <img src="'.base_url().'/public/assets/images/users/'.$employee['user_image'].'" class="rounded-circle img-thumbnail" alt="..." style="height:5rem; width:5rem">
                                        <p class="mx-3" style="margin-top:1rem; font-size:.85rem">'.$employee['name'].'<br><span class="text-muted">'.$employee['dep_kode'].'</span></p>
                                    </div>
                                    </a>';
                                }, $bestemployees);
                                // var_dump($bestemployees);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="centerbar col-lg-6 px-0">
                    <div class="card border-top-0 border-end-0 border-start-0">
                        <h5 class="card-header text-center primary-bg">About Wilian Perkasa</h5>
                        <div class="card-body pb-0">
                            <video controls="controls" width="100%" id="mainvideo" data-id="1" style="border-radius: .35rem; -webkit-border-radius:.35rem">
                                <source id="srcVideo" src="<?=base_url()?>/public/assets/videos/<?=$videos[0]['video_url']?>" type="video/mp4" />
                            </video>
                            <div id="content"><?=$videos[0]['content']?></div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-right col-lg-3 px-0">
                    <div class="card px-0 border-top-0 border-start-0">
                        <h5 class="card-header primary-bg text-center"><small>Wilian Perkasa Events</small></h5>
                        <div class="card-body px-0 border border-end-0 border-bottom-0">
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
                                                        <h5 class="font-size-14 mb-1 '.$event['class'].'">'.date('M d, Y',strtotime($event['ev_date'])).'. '.$event['name'].'</h5>
                                                        <p class="text-truncate text-muted">'.$event['subtext'].'</p>
                                                    </div>
                                                </div>
                                            </div> 
                                        </li>';
                                    },$events);
                                ?>                                      
                                </ul>
                            </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 22vh;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 229px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>    
                        </div>
                    </div>
                    <div class="card pb-1">
                        <h5 class="primary-bg card-header text-center"><small>Gallery Foto</small></h5>
                        <div class="card-body slider-image px-0 py-1">
                            <div class="auto-slider">
                                <div class="auto-slider__content">
                                    <?php array_map(function($img){
                                        echo '<img src="'.base_url().'/public/assets/images/gallery/gallery/'.$img['img_url'].'" width="100%" alt="Image\'s of'.$img['img_url'].'" class="photo-gallery">';
                                    }, $galleries);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card-footer text-muted">&nbsp;</div> -->
                    </div>
                    <div class="card text-dark primary-bg d-flex" style="padding-bottom: .4rem;">
                        <div class="card-body">
                            <h3 class="card-title text-center"><?=getDayIndo(date('D')). date(', d M Y')?></h3>
                            <p class="card-text text-center fs-2 fw-bold disp-time" id="clock">14:40:35</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="secondary-bg footer-text pt-1">
        <div class="row mx-0">
            <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <marquee class="color-text fw-bold">
                    <?php array_map(function($values,$index) {
                        $class = ($index > 0) ? '<span style="display: inline-block; width: 635px;"></span>' : '';
                        echo $class.'<span>'.$values['content'].'</span>';
                    },$runtext, array_keys($runtext));
                    ?>
                    </marquee>
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
        const videos = []
        <?php $i=1; 
        foreach($videos as $video):?>
            videos.push({
                id:<?=$i?>,
                main:'<?=$video['video_url']?>',
                content:'<?=$video['content']?>'
            })
        <?php $i++; endforeach;?>
        
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