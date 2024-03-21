<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- DataTables -->
    <?= $this->include('partials/_datatables-css') ?>

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?=$menuname?></h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 e-recruitment">
                                    <thead>
                                        <tr>
                                            <th>Aksi</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Posisi</th>
                                            <th>No HP</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div> <!-- end col -->
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
<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/recruitment/app.js"></script>
<script>
    
    const view = function(target) {
        const props = {
            id: target.dataset.id,
            name: target.dataset.name
        }
        viewDoc(props)
    }

    let dtTable = $('#datatable-buttons').DataTable({
        processing:true,
        serverSide: true,
        ajax : {
            url: '<?=API_WEBSITE?>/api/employee',
            type:'GET',
            "headers": {
                "Authorization": `Bearer ${getCookie('X-WPG-Recruitment')}`
            },
            "dataSrc": "data"
        },
        columns: [
            { data: 'null', render: function(data,type,row,meta){
                return meta.row+1;
            }},
            { data:'fullname' },
            { data:'sex' },
            { 
                data:'birthdate',
                render: function(data, type, row) {
                    // Ubah format tanggal dari API di sini
                    if (type === 'display' || type === 'filter') {
                        return formatDate(data);
                    }
                    return data;
                } 
            },
            { data:'position' },
            { data:'mobilephone' },
            { 
                data:null,
                orderable:false,
                className:'details-control',
                render: function(data,type,row) {
                    if(type === 'display') {
                        return '<button type="button" class="btn btn-sm btn-primary detail-btn waves-effect"><i class="fas fa-check-circle"></i> Detail</button>'
                    }
                    return data;
                }
            },
        ],
        rowCallback: function(row,data,index) {
            const childRow = dtTable.row(index).child
            if(childRow.isShown()) {
                childRow.hide()
                $(row).removeClass('shown')
            }
        }
    })

    $(document).off('click','#datatable-buttons tbody td.details-control').on('click','#datatable-buttons tbody td.details-control', function() {
        const table = $(this).closest('table').DataTable();
        const tr = $(this).closest('tr');
        const row = table.row(tr);
        
        const data = row.data()
        // const monthlyid = row.data().monthlyid
        if (row.child.isShown()) {
            table.rows().every(function () {
                this.child.hide()
            })
        } else {
            table.rows().every(function() {
                this.child.hide();
            })

            let fullname = data.fullname.replace(/\s+/g, '-').toLowerCase();

            const detailHtml = `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
                <tr>
                <td>Question 1</td>
                <td>: Berapa lama waktu pemberitahuan pengunduran diri Anda yang perlu disampaikan ke pemberi kerja Anda? <span class="fw-bold">${data.question1}</span></span></td>
                </tr>
                <tr>
                <td>Question 2</td>
                <td>: Apakah Anda bersedia menjalani pemeriksaan latar belakang sebelum diterima bekerja? <span class="fw-bold">${data.question2}</span></td>
                </tr>
                <tr>
                <td>Question 3</td>
                <td>: Apakah Anda bersedia menjalani pemeriksaan kesehatan sebelum diterima bekerja? <span class="fw-bold">${data.question3}</span></td>
                </tr>
                <tr>
                <td>Question 4</td>
                <td>: Apakah Anda memiliki riwayat penyakit tertentu? Jika Ya, sebutkan nama penyakitnya. <span class="fw-bold">${data.question4}</span></td>
                </tr>
                <tr>
                <td>Question 5</td>
                <td>: Apakah Anda memiliki buta warna ? <span class="fw-bold">${data.question5}</span></td>
                </tr>
                <tr>
                <td>Foto</td>
                <td><button type="button" class="btn btn-primary waves-effect waves-light photo-employee" data-id="${data.employeeid}"><i class="bx bx-smile font-size-16 align-middle me-2"></i> Lihat Foto</button></td>
                </tr>
                <tr>
                <td>Ijazah</td>
                <td><a href="#" data-id="${data.employeeid}" data-name="ijazah" onclick="view(this)">Dokumen Ijazah ${data.fullname}</a></td>
                </tr>
                <tr>
                <td>CV</td>
                <td><a href="#" data-id="${data.employeeid}" data-name="cv" onclick="view(this)">Dokumen CV ${data.fullname}</a></span></td>
                </tr>
                <tr>
                <td></td>
                <td><a href="e-recruitment/${data.employeeid}/detail" class="fw-semibold">Lihat semua informasi <i class="fas fa-chevron-circle-right"></i></a></td>
                </tr>
                </table>`;
            row.child(detailHtml).show()
            // fetch(`../employee/point/${monthlyid}/detail`,{
            //     method: 'GET',
            //     mode: 'cors',
            //     cache: 'no-cache',
            //     headers: {
            //         'Content-Type' : 'application/json',
            //         'X-Requested-With': 'XMLHttpRequest'
            //     },
            // })
            // .then(response => response.json())
            // .then(data => {                    
            //     console.log(data)
                
            //     row.child(detailHtml).show();  
            // })
        }
    });
    
    $(document).on('click','#datatable-buttons tbody button.photo-employee',async function(e){
        const props = { id: e.target.dataset.id }
        await viewPhoto(props)
    })
</script>

</body>

</html>