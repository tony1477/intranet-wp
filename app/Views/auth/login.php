<?= $this->extend('auth/template')?>
<?= $this->section('content')?>
    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0">Welcome Back !</h5>
            <p class="text-muted mt-2">Sign in to continue to Intranet.</p>
        </div>

        <?= view('Myth\Auth\Views\_message_block') ?>

        <form class="custom-form mt-4 pt-2" action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>

            <?php if ($config->validFields === ['email']): ?>
            <div class="mb-3">
                <label class="form-label" for="login"><?=lang('Auth.email')?></label>
                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.email')?>">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
            </div>
            <?php else: ?>
                <div class="mb-3">
                <label class="form-label" for="login"><?=lang('Auth.emailOrUsername')?></label>
                <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <label class="form-label">Password</label>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="">
                            <a href="<?=url_to('forgot')?>" class="text-muted">Forgot password?</a>
                        </div>
                    </div>
                </div>
                
                <div class="input-group auth-pass-inputgroup">
                    <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?=lang('Auth.password')?>" aria-label="Password" aria-describedby="password-addon">
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                    <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                </div>
            </div>
            <?php if ($config->allowRemembering): ?>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?> type="checkbox" name="remember">
                        <label class="form-check-label" for="remember-check">
                            <?=lang('Auth.rememberMe')?>
                        </label>
                    </div>  
                </div>
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
            </div>
        </form>

        <div class="mt-5 text-center">
            <p class="text-muted mb-0">Don't have an account ? <a href="<?=url_to('register')?>" class="text-primary fw-semibold"> Signup now </a> </p>
        </div>
    </div>
<?= $this->endSection()?>

<?= $this->section('customjs')?>
<script type="text/javascript">
    $("#password-addon").on('click', function () {
        if ($(this).siblings('input').length > 0) {
            $(this).siblings('input').attr('type') == "password" ? $(this).siblings('input').attr('type', 'input') : $(this).siblings('input').attr('type', 'password');
        }
    })
</script>
<?= $this->endSection()?>