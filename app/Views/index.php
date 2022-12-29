<!DOCTYPE html>
<html lang="en">

<head>

    <?= $title_meta ?>
    <link rel="stylesheet" href="assets/css/main.css">

    <?= $this->include('partials/head-css') ?>
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/index.css" type="text/css" />
    
</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <?= $page_title ?>

                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="card slider-front">
                            <div class="card-header">
                                <h4 class="card-title flex-grow-1 fs-3 text-center">Slider Foto Kegiatan WPG</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php for($i=0; $i<count($data['foto']); $i++):?>
                                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$i?>" class="<?=($i==0 ? 'active' : '')?>"></li>
                                        <?php endfor;?>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <?php $i=0;
                                        foreach($data['foto'] as $foto): ?>

                                            <div class="carousel-item <?=$i==0 ? 'active' : ''?>">
                                            <img class="d-block img-fluid mx-auto" src="<?=base_url()?>/assets/images/gallery/foto/<?=$foto->url?>" alt="<?=$foto->title?>">
                                            <?php $i++;?>
                                        </div>
                                        <?php endforeach;?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div><!-- end carousel -->
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="card meeting-list">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 fs-3 text-center"><?=lang('Files.Meeting_Schedule')?></h4>
                                <!-- <div class="flex-shrink-0">
                                    <select class="form-select form-select-sm mb-0 my-n1" onchange="changeFunc()" id="select_day">
                                        <option value="Today">Today</option>
                                        <option value="Yesterday">Yesterday</option>
                                        <option value="Tomorrow">Tomorrow</option>
                                    </select>
                                </div> -->
                            </div><!-- end card header -->
                            <div class="card-body px-0">
                                <div class="px-3" data-simplebar="init" style="max-height: 355px;"><div class="simplebar-wrapper" style="margin: 0px -16px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -15px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 16px;">
                                    <ul class="list-unstyled activity-wid mb-0" id="ulMeeting">
                                    <?php foreach($data['meeting'] as $meeting):?>
                                    <li class="activity-list activity-border" id="liMeeting">
                                        <div class="activity-icon avatar-md">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                            <i class="bx bxs-bookmark font-size-24"></i>
                                            </span>
                                        </div>
                                        <div class="timeline-list-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                    <h5 class="font-size-14 mb-1"><?=date('d-M-Y',strtotime($meeting->tgl_mulai))?>, <?=$meeting->jam_mulai?></h5>
                                                    <p class="text-truncate text-muted font-size-13"><?=$meeting->nama_peserta?></p>
                                                </div>
                                                <div class="flex-shrink-0 text-end me-3">
                                                    <h6 class="mb-1">Pemateri </h6>
                                                    <div class="font-size-13"><?=$meeting->pemateri?></div>
                                                </div>

                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="<?=base_url().'/meeting-schedule/detail/'.$meeting->idpeminjaman?>">Lihat Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Selesai Meeting</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </li>
                                    <?php endforeach;?>
                                    
                                    <li class="activity-list activity-border">
                                        <div class="timeline-list-item">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <a href="<?=base_url()?>/meeting-schedule" class="font-size-14 mb-1">Lihat Semua Jadwal</a>
                                            </div>
                                        </div>
                                    </li>


                                      
                                    </ul>
                                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 539px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 229px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>    
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <div class="row justify-content-xl-center justify-content-md-start">
                        <div class="col-xl-12 col-lg-12">
                            <?php foreach($data['article'] as $article):?>
                                <input type="hidden" id="articleid" value="<?=$article->articleid?>" />
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
                                            <!-- <div class="row">
                                                <div class="col-sm-4">
                                                    <div>
                                                        <h6 class="mb-2">Categories</h6>
                                                        <p class="text-muted font-size-15">Project</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mt-4 mt-sm-0">
                                                        <h6 class="mb-2">Date</h6>
                                                        <p class="text-muted font-size-15">20 June, 2022</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mt-4 mt-sm-0">
                                                        <p class="text-muted mb-2">Post by</p>
                                                        <h5 class="font-size-15">Gilbert Smith</h5>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <hr>

                                        <div class="mt-4">
                                            <div class="text-muted font-size-14">
                                                <?=$article->content?>
                                                <!-- <blockquote class="p-4 border-light border rounded mb-4">
                                                    <div class="d-flex">
                                                        <div class="me-3">
                                                            <i class="bx bxs-quote-alt-left text-dark font-size-24"></i>
                                                        </div>
                                                        <div>
                                                            <p class="mb-0"> At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium deleniti atque corrupti quos dolores et quas molestias excepturi sint quidem rerum facilis est</p>
                                                        </div>
                                                    </div>

                                                </blockquote> -->
                                            </div>

                                            <hr>

                                            <div class="mt-5">
                                                <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Comments :</h5>

                                                <div class="comment-section"></div>
                                            </div>

                                            <hr>
                                            <div class="mt-5 reply-section">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                            <?php endforeach;?>
                        </div>
                    </div>                   
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/vendor-scripts') ?>

<!-- App js -->
<script src="assets/js/app.js"></script>
<script>
    async function getCommentbyArticleId() {
        const id = document.querySelector('#articleid').value;
        // console.log(id)
        let i = 0;
        const response = await fetch(`<?=base_url()?>/article/getCommentbyArticle/${id}`)
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            const commentSection = document.querySelector('.comment-section');
            for(let row of data) {
                let div = document.createElement('div')
                div.className = 'd-flex py-3'
                if(i>0) div.className = 'd-flex py-3 border-top'
                div.innerHTML = `
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-light text-primary">
                                <i class="bx bxs-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="font-size-14 mb-1">${row.user} <small class="text-muted float-end">${row.tgl}</small></h5>
                        <p class="text-muted">${row.comment}</p>
                        <div class="reply-button">
                            <a href="javascript: void(0);" class="text-success" onclick="replyComment(${row.commentid})"><i class="mdi mdi-reply"></i> Reply</a>
                        </div>
                        <div class="mb-3">
                            <label for="commentmessage-input" class="form-label">Message</label>
                            <textarea class="form-control" id="commentmessage-input" placeholder="Your message..." rows="3"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary w-sm">Submit</button>
                        </div>
                    </div>
                `;
                commentSection.appendChild(div);
                i++;
                if(row.has_reply==true) {
                    let findCl = div.querySelector('.reply-button')
                    for(let child of row.child_comment) {
                        let divChild = document.createElement('div')
                        divChild.className = "d-flex pt-3"
                        divChild.innerHTML = `
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-xs">
                                <div class="avatar-title rounded-circle bg-light text-primary">
                                    <i class="bx bxs-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-14 mb-1">${child.user} <small class="text-muted float-end">${child.tgl}</small></h5>
                            <p class="text-muted">${child.comment}</p>
                        </div>
                        `;
                        findCl.appendChild(divChild)
                    }
                }
            }
        })
    }
    document.addEventListener('DOMContentLoaded', getCommentbyArticleId,false)

    function replyComment($id)
    {
        const replyHeader = document.querySelector('.reply-section')
        replyHeader.classList.add('d-none')

    }
</script>
</body>

</html>