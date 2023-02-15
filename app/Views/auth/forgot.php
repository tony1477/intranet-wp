<?= $this->extend('auth/template')?>
<?= $this->section('content')?>
    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0">Reset Password</h5>
            <!-- <p class="text-muted mt-2">Relax, enter your email below, and we will send instruction to reset your password!</p> -->
        </div>
        <div class="alert alert-success text-center mb-4 mt-4 pt-2" role="alert">
            Enter your Email and instructions will be sent to you!
        </div>

        <?= view('Myth\Auth\Views\_message_block') ?>

        <form class="custom-form mt-4 pt-2" action="<?= url_to('forgot') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" placeholder="Enter email" name="email" >
            </div>
            <div class="mb-3 mt-4">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset</button>
            </div>
        </form>

        <div class="mt-5 text-center">
            <p class="text-muted mb-0">Remember It ?  <a href="<?=url_to('login')?>"
                    class="text-primary fw-semibold"> Sign In </a> </p>
        </div>
    </div>
<?= $this->endSection()?>