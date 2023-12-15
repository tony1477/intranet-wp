<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/index.css" />

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
                    <div class="col-12">
                        <!-- Right Sidebar -->
                        <div >
                            <div class="card">
                                <!-- <div class="btn-toolbar p-3" role="toolbar">
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Updates</a>
                                            <a class="dropdown-item" href="#">Social</a>
                                            <a class="dropdown-item" href="#">Team Manage</a>
                                        </div>
                                    </div>
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Updates</a>
                                            <a class="dropdown-item" href="#">Social</a>
                                            <a class="dropdown-item" href="#">Team Manage</a>
                                        </div>
                                    </div>

                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            More <i class="mdi mdi-dots-vertical ms-2"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Mark as Unread</a>
                                            <a class="dropdown-item" href="#">Mark as Important</a>
                                            <a class="dropdown-item" href="#">Add to Tasks</a>
                                            <a class="dropdown-item" href="#">Add Star</a>
                                            <a class="dropdown-item" href="#">Mute</a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="btn-toolbar p-3" role="toolbar">
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-secondary waves-light waves-effect mark-read">Mark as Read <i class="fa fa-inbox"></i></button>
                                    </div>
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-danger waves-light waves-effect mark-delete">Delete Notification <i class="fa fa-trash"></i> 
                                        </button>
                                    </div>
                                </div>
                                <ul class="message-list">
                                    <!-- <li>
                                        <div class="col-mail col-mail-1">
                                            <div class="checkbox-wrapper-mail">
                                                <input type="checkbox" id="chk19">
                                                <label for="chk19" class="toggle"></label>
                                            </div>
                                            <a href="#" class="title">Peter, me (3)</a><span class="star-toggle far fa-star"></span>
                                        </div>
                                        <div class="col-mail col-mail-2">
                                            <a href="#" class="subject">Hello – <span class="teaser">Trip home from Colombo has been arranged, then Jenna will come get me from Stockholm. :)</span>
                                            </a>
                                            <div class="date">Mar 6</div>
                                        </div>
                                    </li> -->
                                    <?php foreach($data as $row):?>
                                    <li <?=($row->recordstatus==1 ? 'class="bg-light"' : '')?> >
                                        <div class="col-mail col-mail-1">
                                            <div class="checkbox-wrapper-mail">
                                                <input type="checkbox" id="chk<?=$row->notifid?>" data-id="<?=$row->notifuserid?>">
                                                <label for="chk<?=$row->notifid?>" class="toggle"></label>
                                            </div>
                                            <a href="#" class="title"><?=$row->notiftitle?></a>
                                        </div>
                                        <div class="col-mail col-mail-2">
                                            <a href="#" class="subject" onclick="viewnotif(this)" data-id="<?=$row->notifuserid?>" data-href="<?=$row->url?>"><span class="teaser"><?=$row->notiftext?></span>
                                            </a>
                                            <div class="date"><?=date('d/M/Y',strtotime($row->notifdate))?></div>
                                        </div>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div> <!-- card -->

                            <!-- <div class="row">
                                <div class="col-7">
                                    Showing 1 - 20 of 1,524
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>
                                        <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            </div> -->
                        </div> <!-- end Col-9 -->

                    </div>

                </div><!-- End row -->
                <!-- End Page-content -->
            </div>
        </div>
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
    const arr = []
    // const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked')
    const readBtn = document.querySelector('.mark-read')
    const deleteBtn = document.querySelector('.mark-delete')

    readBtn.addEventListener('click', function(){
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked')
        let arr = [...checkboxes]
        let id = arr.map(btn => {
            return btn.dataset.id
        })
        markAsRead(id)
    })

    deleteBtn.addEventListener('click', function(){
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked')
        let arr = [...checkboxes]
        let id = arr.map(btn => {
            return btn.dataset.id
        })
        deletedNotif(id)
    })

    let markAsRead = function(ids) {
        fetch('reads',{
            method:'PATCH',
            mode:'cors',
            cache:'no-cache',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify({'id':ids})
        })
        .then(resp => resp.json())
        .then(data => {
            if(data.status==='success') return location.reload()
            return Swal.fire('Warning',data.message,'warning');
        })
    }

    let deletedNotif = function(ids) {
        fetch('deletes',{
            method:'DELETE',
            mode:'cors',
            cache:'no-cache',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify({'id':ids})
        })
        .then(resp => resp.json())
        .then(data => {
            if(data.status==='success') return location.reload()
            return Swal.fire('Warning',data.message,'warning');
        })
    }
</script>
</body>
</html>