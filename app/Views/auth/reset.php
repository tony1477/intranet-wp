<?= $this->extend('auth/template')?>
<?= $this->section('content')?>
    <div class="auth-content my-auto">
        <div class="text-center">

            <div class="avatar-lg mx-auto">
                <div class="avatar-title rounded-circle bg-light">
                    <i class="bx bxs-check-shield h2 mb-0 text-primary"></i>
                </div>
            </div>
            <div class="p-2 mt-4">

                <h4>Reset Password</h4>

                <form action="<?= url_to('reset-password') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3 text-start">
                        <label for="token"><?=lang('Auth.token')?></label>
                        <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>"
                                name="token" placeholder="<?=lang('Auth.token')?>" value="<?= old('token', $token ?? '') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.token') ?>
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="email"><?=lang('Auth.email')?></label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                name="password">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="pass_confirm">Confirm Password</label>
                        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                name="pass_confirm">
                        <div class="invalid-feedback">
                            <?= session('errors.pass_confirm') ?>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="mt-5 text-center">
            <!-- <p class="text-muted mb-0">Didn't receive an email ? <a href="#" -->
                <!-- class="text-primary fw-semibold"> Resend </a> </p> -->
        </div>
    </div>
<?= $this->endSection() ?>