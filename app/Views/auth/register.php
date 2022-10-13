<?= $this->extend('auth/template')?>
<?= $this->section('content')?>
    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0"><?=lang('Auth.register')?></h5>
            <p class="text-muted mt-2">Get your free Minia account now.</p>
        </div>

        <?= view('Myth\Auth\Views\_message_block') ?>

        <form class="needs-validation custom-form mt-4 pt-2" action="<?= url_to('register') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="useremail" class="form-label"><?=lang('Auth.email')?></label>
                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= old('email') ?>" required>  
                <div class="invalid-feedback">
                    Please Enter Email
                </div>
                <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label"><?=lang('Auth.username')?></label>
                <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Enter username" value="<?= old('username') ?>" required>
                <div class="invalid-feedback">
                    Please Enter Username
                </div>  
            </div>

            <div class="mb-3">
                <label for="userpassword" class="form-label"><?=lang('Auth.password')?></label>
                <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Enter password" autocomplete="off" required>
                <div class="invalid-feedback">
                    Please Enter Password
                </div>       
            </div>

            <div class="mb-3">
                <label for="pass_confirm" class="form-label"><?=lang('Auth.repeatPassword')?></label>
                <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off" required>
                <div class="invalid-feedback">
                    Repeat Password
                </div>       
            </div>
            <!-- <div class="mb-4">
                <p class="mb-0">By registering you agree to the Minia <a href="#" class="text-primary">Terms of Use</a></p>
            </div> -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100 waves-effect waves-light" type="submit"><?=lang('Auth.register')?></button>
            </div>
        </form>

        <div class="mt-5 text-center">
            <p class="text-muted mb-0">Already have an account ? <a href="<?= url_to('login')?>" class="text-primary fw-semibold"> Login </a> </p>
        </div>
    </div>
<?= $this->endSection()?>

<?= $this->section('customjs')?>
<script type="text/javascript">
    (function() {
	'use strict';
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		const forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		const validation = Array.prototype.filter.call(forms, function(form) {
		form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
		});
	}, false);
})();

</script>
<?= $this->endSection()?>