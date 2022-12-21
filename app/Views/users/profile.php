<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/home.css" />
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

        <div class="page-content">
            <div class="container-fluid">

                 <!-- start page title -->
                 <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 fs-3 text-center">Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 g-0">
                                    <div class="col-sm-4">
                                        <img src="<?=base_url()?>/assets/images/users/<?=user()->user_image?>" class="img-fluid rounded-circle border border-light img-upload" alt="">
                                        <input type="file" id="user_image" name="user_image" style="display: none;" />
                                        <div>
                                            <button class="btn btn-info mt-4" id="uploadfoto">Upload</button>
                                            <button class="btn btn-success mt-4">Update Data</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row mb-3">
                                            <label for="fullname" class="col-form-label col-sm-4 text-end"><?=lang('Files.Fullname')?></label>
                                            <div class="col-sm-8">    
                                                <input type="text" name="fullname" value="<?=user()->fullname?>" class="form-control" placeholder="Silahkan isi Nama Lengkap Anda" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="username" class="col-form-label col-sm-4 text-end"><?=lang('Files.Username')?></label>
                                            <div class="col-sm-8">    
                                                <input type="text" name="username" value="<?=user()->username?>" class="form-control" placeholder="Silahkan isi username Anda" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-form-label col-sm-4 text-end"><?=lang('Files.Email')?></label>
                                            <div class="col-sm-8">    
                                            <input type="email" name="email" value="<?=user()->email?>" class="form-control" aria-describedby="emailHelpBlock" readonly/>
                                            <div id="emailHelpBlock" class="form-text">
                                            Hubungi IT jika ada kesalahan alamat email.
                                            </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="password" class="col-form-label col-sm-4 text-end"><?=lang('Files.Password')?></label>
                                            <div class="col-sm-8">    
                                            <input type="password" name="password" value="********" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Password tidak boleh kosong!" />
                                            <div id="passwordHelpBlock" class="form-text">
                                            Jika tidak diganti, maka password tetap yang sebelumnya. <br />Note : Password diatas hanya sekedar symbol.
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-6 col-form-label text-end">Password</label>
                                    <div class="col-sm-6 col-6">   
                                        <input type="password" name="password" value="********" class="form-control" aria-describedby="passwordHelpBlock"/>
                                        <div id="passwordHelpBlock" class="form-text">
                                        Jika tidak diganti, maka password tetap yang sebelumnya. <br />Note : Password diatas hanya sekedar symbol.
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="username" class="col-sm-4 col-6 col-form-label text-end">Fullname</label>
                                    <div class="col-sm-6 col-6">   
                                        <input type="text" name="fullname" value="" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="username" class="col-sm-4 col-6 col-form-label text-end">Email</label>
                                    <div class="col-sm-6 col-6">   
                                        <input type="email" name="email" value="" class="form-control" aria-describedby="emailHelpBlock" readonly/>
                                        <div id="emailHelpBlock" class="form-text">
                                        Hubungi IT jika ada kesalahan alamat email.
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-6 col-6">   
                                        <input type="submit" name="email" value="Update!" class="form-control btn btn-success" />
                                    </div>
                                </div> -->
                                <!-- <div class="col-6"><input type="text" class="form-control" name="username" value="" /></div> -->
                            </div>
                        </div>
                    </div>
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

<script src="<?=base_url()?>/assets/js/app.js"></script>
<script type="text/javascript">
const uploadButton = document.querySelector('#uploadfoto')
$(".img-upload").click(function() {
    $("input[id='user_image']").click();
});

uploadButton.addEventListener('click',(e) => {
    const datafile = document.querySelector('#user_image').files[0];
    const namefile = datafile.name
    const formData = new FormData()
    formData.append('file',datafile)
    try {
        console.log('uploading...')
        $.ajax({
            url: "<?=base_url()?>/users/uploadimage",
            enctype: 'multipart/form-data',
            type: 'POST',
            data: formData,
            dataType: 'json',
            async: false,
            success: function(resp) {
                console.log(resp)
                if(resp.status=='success') 
                Swal.fire("Success!", resp.message, resp.status).then(function(e){
                    location.reload()
                })
            },
            cache: false,
            contentType:false,
            processData: false
        });
    }
    catch(e) {
        console.log('Err: ',e)
        Swal.fire("Failed!", e, 400);
    }
    // console.log(datafile)
});

function changeFunc() {
    const select = document.querySelector('#select_day')
    const optionValue = select.options[select.selectedIndex].value
    // console.log(optionValue)

}
</script>
</body>
</html>