
<!doctype html>
<html lang="en">
<head>
    <?=$title_meta?>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/fonts/icomoon/style.css">

    <!-- preloader css -->
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/preloader.min.css" type="text/css" />

    <!-- Icons Css -->
    <link href="<?=base_url()?>/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url()?>/public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?= $this->include('partials/sweetalert-css') ?>

    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/recruitment.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/index.css" />
</head>
<?=$this->include('partials/body')?>
<div id="layout-wrapper">
    <?=$this->include('partials/menu')?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <?=$page_title?>
                <div class="row">
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="<?=base_url()?>/public/assets/images/4922953.jpg" alt="Image" class="img-fluid">
                                </div>
                                <div class="col-md-6 contents">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="mb-4">
                                                <h3>Sign In</h3>
                                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                                            </div>
                                            <form id="loginForm" method="post">
                                                <div class="form-group first">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" name="username" id="username">
                                                </div>
                                                <div class="form-group last mb-4">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control" id="password">
                                                </div>
                                                <div class="d-flex mb-5 align-items-center">
                                                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                                        <input type="checkbox" checked="checked" />
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                                </div>
                                                <input type="submit" value="Log In" class="btn btn-block btn-login btn-primary">
                                                <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>
                                                <div class="social-login">
                                                    <a href="#" class="facebook">
                                                        <span class="icon-facebook mr-3"></span>
                                                    </a>
                                                    <a href="#" class="twitter">
                                                        <span class="icon-twitter mr-3"></span>
                                                    </a>
                                                    <a href="#" class="google">
                                                        <span class="icon-google mr-3"></span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->include('partials/footer') ?>
    </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- JAVASCRIPT -->
<script src="<?=base_url()?>/public/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/node-waves/waves.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="<?=base_url()?>/public/assets/libs/pace-js/pace.min.js"></script>
<!-- Pusher.js -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<!-- Alertify -->
<script src="<?=base_url()?>/public/assets/libs/alertifyjs/build/alertify.min.js"></script>
<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>
<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script>
    $(function() {
	'use strict';
	
        $('.form-control').on('input', function() {
        var $field = $(this).closest('.form-group');
        if (this.value) {
            $field.addClass('field--not-empty');
        } else {
            $field.removeClass('field--not-empty');
        }
        });

    });

    let loginBtn = document.querySelector('.btn-login')
    loginBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = document.querySelector('#loginForm')
        const data = {
            username:form.querySelector('#username').value,
            password:form.querySelector('#password').value
        }

        fetch('<?=API_WEBSITE?>/auth',{
            method:'POST',
            mode:'cors',
            cache:'no-cache',
            headers:{
                'Content-Type' : 'application/x-www-form-urlencoded',
            },
            body:new URLSearchParams(data)
        })
        .then(response => response.json())
        .then(data => {
            if(data.status=='unauthorized') return Swal.fire('error',data.message,'error')
            if(data.data.hasOwnProperty('token')) {
                let expires = new Date();
                expires.setTime(expires.getTime() + 8*60*60*1000)
                // document.cookie = `X-WPG-Recruitment=${data.data.userId}; expires=${expires}; path=/`;
                document.cookie = `X-WPG-Recruitment=${data.data.token}; expires=${expires}; path=/`;
                Swal.fire('success','Berhasil login','success')
                .then(res => {
                    return window.location.href = '../'
                })
            } 
        })
        .catch(error => {
            Swal.fire('error','error',error.message)
        })
    });
   
</script>
</body>
</html>