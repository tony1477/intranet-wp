<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
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
                    <!-- <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title"><?=lang('Files.Read_Article')?> <span class="text-muted fw-normal ms-2"></span></h5>
                        </div>
                    </div> -->

                </div>
                <!-- end row -->

                <?php $article=$data['article']?>
                    
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <div class="text-center mb-3">
                                        <h4><?=$article->title?></h4>
                                    </div>
                                    <div class="mb-4">
                                    <input type="hidden" id="articleid" value="<?=$article->articleid?>" />
                                        <img src="<?=base_url()?>/assets/images/gallery/article/<?=$article->image?>" alt="" class="img-thumbnail mx-auto d-block">
                                    </div>
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>
                                                    <h6 class="mb-2">Categories</h6>
                                                    <p class="text-muted font-size-15"><?=$article->categoryname?></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <h6 class="mb-2">Date</h6>
                                                    <p class="text-muted font-size-15"><?=date('d M, Y',strtotime($article->posted_date))?></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="text-muted mb-2">Post by</p>
                                                    <h5 class="font-size-15"><?=$article->name?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="mt-4">
                                        <?=$article->content?>

                                        <?php if($article->can_comment==1):?>
                                        <hr>
                                        <div class="mt-5">
                                                <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Comments :</h5>

                                                <div class="comment-section"></div>
                                            </div>

                                            <hr>
                                            <button type="submit" class="btn btn-primary w-sm my-3" data-bs-toggle="collapse" data-bs-target="#reply-section" aria-expanded="false" aria-controls="reply-section"><?=lang('Files.Leave_Response')?></button>
                                            <div class="collapse" id="reply-section">
                                                <div class="mt-5 reply-section">
                                                <h5 class="font-size-16 mb-3">Leave a Reply:</h5>

                                                <form>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="commentname-input" class="form-label">Name</label>
                                                                <input type="text" class="form-control" id="commentname-input" placeholder="Enter name" value="<?=user()->fullname?>" readonly >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="commentemail-input" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="commentemail-input" placeholder="Enter email" value="<?=user()->email?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="commentmessage-input" class="form-label">Message</label>
                                                        <textarea class="form-control text_response" id="commentmessage-input" name="text_response" placeholder="Your message..." rows="3"></textarea>
                                                    </div>

                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary w-sm submitResponse">Submit</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            <?php endif?>
                                            <hr>
                                        <button type="button" class="btn btn-soft-primary waves-effect waves-light"><i class="bx bx-left-arrow-alt font-size-16 align-middle me-2"></i> Sebelumnya</button>

                                        <button type="button" class="btn btn-soft-primary waves-effect waves-light float-end">Selanjutnya <i class="bx bx-right-arrow-alt font-size-16 align-middle me-2"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!--end col-->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="search-box">
                                    <h5 class="mb-3">Search</h5>
                                    <div class="position-relative px-2">
                                        <input type="text" class="form-control rounded bg-light border-light" placeholder="Search...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                                <?php if(count($data['upcoming'])>0):?>
                                <div class="mt-5">
                                    <h5 class="mb-3">Upcoming Post</h5>
                                    <div class="list-group list-group-flush">
                                        <?php foreach($data['upcoming'] as $upcoming):?>
                                        <a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img src="<?=base_url()?>/assets/images/gallery/article/<?=$upcoming->image?>" alt="" class="avatar-lg h-auto d-block rounded">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate"><?=$upcoming->title?></h5>
                                                    <p class="mb-0 text-truncate"><?=$upcoming->created_at?><span class="">/ 05:00 AM</span></p>
                                                </div>
                                                <div class="fs-1">
                                                    <i class="mdi mdi-calendar"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(count($data['popular'])>0):?>
                                <div class="mt-5">
                                    <h5 class="mb-3">Popular Post</h5>
                                    <div class="list-group list-group-flush">
                                        <?php foreach($data['popular'] as $popular):?>
                                        <a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img src="<?=base_url()?>/assets/images/gallery/article/<?=$popular->image?>" alt="" class="avatar-xl h-auto d-block rounded">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate"><?=$popular->title?></h5>
                                                    <p class="mb-0 text-truncate"><?=$popular->created_at?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <!-- <div class="mt-5">
                                    <h5 class="mb-3">Tag Clouds</h5>
                                    <div class="px-2">
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Design</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Development</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Wordpress</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">HTML</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Project</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Business</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Travel</span></a>
                                        <a href="#" class="font-size-17"><span class="badge badge-soft-primary">Photography</span></a>
                                    </div>
                                </div> -->

                                <!-- <div class="mt-5">
                                    <h5 class="mb-3">Instagram Post</h5>
                                    <div class="gap-2 hstack flex-wrap px-2">
                                        <img src="assets/images/small/img-3.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-1.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-2.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-4.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-5.jpg" alt="" class="avatar-xl rounded">
                                        <img src="assets/images/small/img-6.jpg" alt="" class="avatar-xl rounded">
                                    </div>
                                </div> -->

                                <div class="mt-5">
                                    <h5 class="mb-3">Email Newsletter</h5>
                                    <div class="">
                                        <div class="input-group mb-0 px-2">
                                            <input type="text" class="form-control" placeholder="Sedang dalam pengembangan" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-send-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div>
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

<?= $this->include('partials/sweetalert') ?>

<script src="<?=base_url()?>/assets/js/app.js"></script>
<?php if($article->can_comment==1):?>
<script>
    const articleId = document.querySelector('#articleid')
    async function getCommentbyArticleId() {
        const id = document.querySelector('#articleid').value;
        // console.log(id)
        let i = 0;
        const response = await fetch(`<?=base_url()?>/article/getCommentbyArticle/${id}`)
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            const commentSection = document.querySelector('.comment-section');
            // for(let row of data) {
            data.forEach(row => {
                // console.log(row.text)
                let div = document.createElement('div')
                div.className = 'd-flex py-3 headerReply'
                if(i>0) div.className = 'd-flex py-3 headerReply border-top'
                div.innerHTML = `
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-xs">
                            <img src="<?=base_url()?>/assets/images/users/${row.image}" alt="" class="img-fluid d-block rounded-circle">
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="font-size-14 mb-1">${row.user} <small class="text-muted float-end">${row.tgl}</small></h5>
                        <p class="text-muted">${row.comment}</p>
                        <div class="reply-button">
                            <a href="javascript: void(0);" class="text-success" onclick="replyComment(this,${row.commentid})"><i class="mdi mdi-reply"></i> Reply</a>
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
                                <img src="<?=base_url()?>/assets/images/users/${child.image}" alt="" class="img-fluid d-block rounded-circle">
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
            })
        })
    }
    document.addEventListener('DOMContentLoaded', getCommentbyArticleId,false)

    function replyComments($id)
    {
        const replyHeader = document.querySelector('.reply-section')
        replyHeader.classList.add('d-none')
        
        const replyBtn = document.querySelectorAll('.reply-button')
        const divReply = document.createElement('div')
        divReply.className = 'mb-3 reply-form'
        divReply.innerHTML = `<label for="commentmessage-input" class="form-label">Message</label>
            <textarea class="form-control" id="commentmessage-input" placeholder="Your message..." rows="3"></textarea>`
        divBtn = document.createElement('div')
        divBtn.className = 'text-end reply-btn'
        divBtn.innerHTML = `<button type="submit" class="btn btn-primary w-sm">Submit</button>`
               
        for(let i=0; i<replyBtn.length; i++)
        {
            replyBtn[i].addEventListener('click', function(e) {
                // console.log(replyBtn[i])
                const repForm = document.querySelectorAll('.reply-form')
                const repBtn = document.querySelectorAll('.reply-btn')
                // document.querySelectorAll('.reply-form').remove()
                // document.querySelectorAll('.reply-btn').remove()
                const headerReply = replyBtn[i].closest('.headerReply')
                if(repForm.length==0) {
                    console.log(0)
                    headerReply.after(divReply,divBtn)
                    return;
                }
                else {
                    console.log(repForm.length)
                    let el1 = document.querySelectorAll('.reply-form')
                    // console.log(typeof(coll))
                    Array.prototype.forEach.call( el1, function( node ) {
                        node.parentNode.removeChild( node );
                    });

                    let el2 = document.querySelectorAll('.reply-btn')
                    Array.prototype.forEach.call( el2, function( node ) {
                        node.parentNode.removeChild( node );
                    });
                    
                    return;
                }
                
                
            //    replyBtn[i].innerHTML += replyForm
            })
            // console.log(repBtn)
        }
        // replyButton.innerHTML += replyForm
    }

    function replyComment($id,commentid)
    {
        const parentEl = $id.parentElement
        const childEl = parentEl.querySelector('.reply-form')
        const childEl2 = parentEl.querySelector('.reply-btn')
        
        // clear all comment form

        let allForm = document.querySelectorAll('.reply-form');
        let allBtn = document.querySelectorAll('.reply-btn');
        allForm.forEach(el => {
            el.remove()
        })

        allBtn.forEach(el => {
            el.remove()
        })
        // check is element has created before
        // with child element wih classname
        if(!childEl) {
            const divReply = document.createElement('div')
            
            divReply.className = 'mb-3 reply-form'
            divReply.innerHTML = `<label for="commentmessage-input" class="form-label">Message</label>
                <textarea class="form-control text_reply" id="commentmessage-input" placeholder="Your message..." rows="3"></textarea>`
            divBtn = document.createElement('div')
            divBtn.className = 'text-end reply-btn'
            divBtn.innerHTML = `<button type="submit" class="btn btn-primary w-sm" onclick="submitReply(${commentid})">Submit</button>`
            parentEl.appendChild(divReply)
            parentEl.appendChild(divBtn)
        }
    }

    const submitResponse = document.querySelector('.submitResponse');
    submitResponse.addEventListener('click',function(e){
        e.preventDefault();
        const respText = document.querySelector('.text_response').value
        if(respText == '') {
            Swal.fire('Info!','Pesan masih kosong','info'); 
            return;
        }
        const data = {
            'id': articleId.value,
            'userid': <?=user_id()?>,
            'text': respText,
            'parentid': null,
        };
        postComment(data);
    })

    async function postComment(data)
    {
        await fetch(`<?=base_url()?>/article/postComment`,{
            'method': 'POST',
            'mode': 'cors',
            'cache': 'no-cache',
            'credentials': 'same-origin',
            'headers': {
                'Content-Type': 'application/json',
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            if(data.status=='success') {
                Swal.fire('Success','Pesan sudah terkirim, komentar anda akan segera tayang','success')
                .then((result)=> {
                    if(result.isConfirmed) location.reload()
                })
                // console.log('here')
            }
            // else Swal.fire('Error','Ada kesalahan system, harap hubungi IT','error')
            else console.log('ini')
        })
    }

    function submitReply(parentId)
    {
        const respText = document.querySelector('.text_reply').value
        if(respText == '') {
            Swal.fire('Info!','Pesan masih kosong','info'); 
            return;
        }
        const data = {
            'id': articleId.value,
            'userid': <?=user_id()?>,
            'text': respText,
            'parentid': parentId,
        }
        postComment(data);
        // if(post.status)
    }
</script>
<?php endif;?>
</body>

</html>