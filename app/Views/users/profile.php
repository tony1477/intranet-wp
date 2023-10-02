<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <link href="<?=base_url()?>/public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>/public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?=base_url()?>/public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/home.css" />
    <?= $this->include('partials/_home-css') ?>
    
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
                                        <img src="<?=base_url()?>/public/assets/images/users/<?=user()->user_image?>" class="img-fluid rounded-circle border border-light img-upload" alt="">
                                        <input type="file" id="user_image" name="user_image" style="display: none;" />
                                        <div>
                                            <button class="btn btn-info mt-4" id="uploadfoto">Upload Foto</button>
                                            <button class="btn btn-success mt-4 updateprofile">Update Data</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <form id="form-profile">
                                        <div class="row mb-3">
                                            <label for="fullname" class="col-form-label col-sm-4 text-end"><?=lang('Files.Fullname')?></label>
                                            <div class="col-sm-8">
                                                <input type="hidden" value="<?=user_id()?>" id="id" />
                                                <input type="text" name="fullname" id="fullname" value="<?=user()->fullname?>" class="form-control" placeholder="Silahkan isi Nama Lengkap Anda" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="username" class="col-form-label col-sm-4 text-end"><?=lang('Files.Username')?></label>
                                            <div class="col-sm-8">    
                                                <input type="text" name="username" id="username" value="<?=user()->username?>" class="form-control" placeholder="Silahkan isi username Anda" />
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
                                            <input type="password" id="password" name="password" value="********" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Password tidak boleh kosong!" />
                                            <div id="passwordHelpBlock" class="form-text">
                                            Jika tidak diganti, maka password tetap yang sebelumnya. <br />Note : Password diatas hanya sekedar symbol.
                                            </div>
                                            </div>
                                        </div>
                                    </form>
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
                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 fs-3 text-center">My Points</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 g-0">
                                <table id="datatable-empPoint" class="table table-bordered dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>Periode</th>
                                            <th>Point</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                </div>
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

<!-- Required datatable js -->
<script src="<?=base_url()?>/public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>

<?= $this->include('partials/_home-js') ?>

<script type="text/javascript">
    $(document).ready(function() {
        const id = <?= user_id()?>;
        let table = $('#datatable-empPoint').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `../employee/point/${id}`,
                type: 'GET'
            },
            columns: [
                {data:'periode'},
                {data:'point'},
                {
                    data:'detail',
                    className: 'details-control',
                    orderable: false,
                    defaultContent: '',
                },
            ],
            rowCallback: function(row, data, index) {
                const childRow = table.row(index).child;
                if (childRow.isShown()) {
                    childRow.hide();
                    $(row).removeClass('shown');
                }
            },
            lengthMenu: [10,25,50,100],
        });

        $(document).off('click','#datatable-empPoint tbody td.details-control').on('click','#datatable-empPoint tbody td.details-control',
        function() {
            const table = $(this).closest('table').DataTable();
            const tr = $(this).closest('tr');
            const row = table.row(tr);
            const monthlyid = row.data().monthlyid
            if (row.child.isShown()) {
                // row.child.hide();
                // tr.removeClass('shown');
                table.rows().every(function () {
                    this.child.hide()
                })
            } else {
                // row.child.show();
                // tr.addClass('shown');
                table.rows().every(function() {
                    this.child.hide();
                })
                fetch(`../employee/point/${monthlyid}/detail`,{
                    method: 'GET',
                    mode: 'cors',
                    cache: 'no-cache',
                    headers: {
                        'Content-Type' : 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(data => {                    
                    console.log(data)
                    const detailHtml = `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
                    <tr>
                    <td>Point Kehadiran</td>
                    <td >: ${data.data.point1}</td>
                    </tr>
                    <tr>
                    <td>Point Konsistensi</td>
                    <td >: ${data.data.point2}</td>
                    </tr>
                    </table>`;
                    row.child(detailHtml).show();  
                })
            }
        });
    })

    const uploadButton = document.querySelector('#uploadfoto')
    const updateBtn = document.querySelector('.updateprofile')
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

    updateBtn.addEventListener('click', (e) => {
        const form = document.querySelector('form#form-profile')
        const id = form.querySelector('#id')
        const fullname = form.querySelector('#fullname')
        const username = form.querySelector('#username')
        const password = form.querySelector('#password')

        const data = {
            'id': id.value,
            'username': username.value,
            'fullname': fullname.value
        }
        if(password.value != '********') data.password = password.value;
        fetch('<?=base_url()?>/profile/update',{
            method : 'POST',
            mode : 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type' : 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if(data.status=='success') {
                Swal.fire('success!','Data Berhasil di Perbaharui','success')
                .then((res) => {
                    if(res.isConfirmed) location.reload();
                })
            }
        })
    })
</script>
</body>
</html>