<?= $this->extend('auth/template')?>
<?= $this->section('content')?>
    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0"><?=lang('Auth.register')?></h5>
            <p class="text-muted mt-2">Silahkan Isi data-data dibawah ini :</p>
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
                <label for="fullname" class="form-label"><?=lang('Auth.fullname')?></label>
                <input type="text" class="form-control <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" placeholder="Enter Fullname" value="<?= old('fullname') ?>" required>
                <div class="invalid-feedback">
                    Please Enter Fullname
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

            <div class="mb-3">
                <label for="divisi" class="form-label"><?=lang('Files.Location_PT')?></label>
                <select name="iddivisi" class="form-select divisi" placeholder="<?=lang('Files.Location_PT')?>" autocomplete="off" required>
                    <option value=""></option>
                </select>
                <div class="invalid-feedback">
                    Choose Location
                </div>       
            </div>

            <div class="mb-3">
                <label for="department" class="form-label"><?=lang('Files.Department_Division')?></label>
                <select name="iddepartment" class="form-select department" placeholder="<?=lang('Files.Department_Division')?>" autocomplete="off" required>
                    <option value=""></option>
                </select>
                <div class="invalid-feedback">
                    Choose Location
                </div>       
            </div>

            <div class="mb-3">
                <label for="jabatan" class="form-label"><?=lang('Files.Level_Position')?></label>
                <select name="idjabatan" class="form-select jabatan" placeholder="<?=lang('Files.Level_Position')?>" autocomplete="off" required>
                    <option value=""></option>
                </select>
                <div class="invalid-feedback">
                    Choose Location
                </div>       
            </div>

            <div class="mb-3">
                <label for="nm_jabatan" class="form-label"><?=lang('Files.Name_Position')?></label>
                <input type="text" class="form-control" name="nama_jabatan" placeholder="ex:Environment Staff, Asisten Proses, Kepala Gudang" value="<?= old('nm_jabatan') ?>" required>
            </div>

            <div class="mb-3">
                <label for="mobilephone" class="form-label"><?=lang('Files.phone')?></label>
                <input type="text" class="form-control" name="phoneno" placeholder="Enter Mobile Phone (optional)" value="<?= old('phoneno') ?>" >
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
    const listDivisi = document.querySelector('.divisi')
    const listDepartment = document.querySelector('.department')
    const listJabatan = document.querySelector('.jabatan')
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
        getApiData('<?=base_url()?>/api/getDivisi')
        .then(resp => {
            // console.log(resp)
            const key = Object.keys(resp)
            const data = Object.values(resp)
            const lengthdata = data.length-1;

            let opt = []
            if(data[lengthdata]=='success') {
                const index = data.indexOf(data[lengthdata]);
                if (index > -1) data.splice(index, 1); 
                for(let i of data) {
                    opt[i] = new Option(i.div_nama,i.iddivisi);
                    listDivisi.add(opt[i]);
                }
            }
        });

        getApiData('<?=base_url()?>/api/getJabatan')
        .then(resp => {
            // console.log(resp)
            const key = Object.keys(resp)
            const data = Object.values(resp)
            const lengthdata = data.length-1;

            let opt = []
            if(data[lengthdata]=='success') {
                const index = data.indexOf(data[lengthdata]);
                if (index > -1) data.splice(index, 1); 
                for(let i of data) {
                    opt[i] = new Option(i.jab_nama,i.idjabatan);
                    listJabatan.add(opt[i]);
                }
            }
        });

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

    listDivisi.addEventListener('change', (e) => {
        let options = document.querySelectorAll('.department option');
        options.forEach(o => o.remove());
        let val = e.currentTarget.value

        getApiData(`<?=base_url()?>/api/getDepartment/${val}`)
        .then(resp => {
            const key = Object.keys(resp)
            const data = Object.values(resp)
            const lengthdata = data.length-1;
            console.log(lengthdata)

            let opt = []
            if(data[lengthdata]=='success') {
                const index = data.indexOf(data[lengthdata]);
                if (index > -1) data.splice(index, 1); 
                for(let i of data) {
                    opt[i] = new Option(i.dep_nama,i.iddepartment);
                    listDepartment.add(opt[i]);
                }
            }
        });
    })
})();

</script>
<script>
    async function getApiData(url='') 
    {
        const resp = await fetch(url, {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            creadentials: 'same-origin',
            headers: {
                'Content-Type':'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization' : 'Bearer <?=hash('sha256',getenv('SECRET_KEY').date('Y-m-d H:i'))?>',
            },  
        })
        return resp.json()
    }

    async function getDepartmentById() 
    {
        const resp = await fetch(url, {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            creadentials: 'same-origin',
            headers: {
                'Content-Type':'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization' : 'Bearer <?=hash('sha256',getenv('SECRET_KEY').date('Y-m-d H:i'))?>',
            },  
        })
        return resp.json()
    }
</script>
<?= $this->endSection()?>