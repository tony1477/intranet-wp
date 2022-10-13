<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    
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
                                <h4 class="card-title"><?= Lang('Files.Divisi')?></h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 divisi">
                                    <thead>
                                        <tr>
                                            <th><?= lang('Files.Action')?></th>
                                            <th><?= lang('Files.Id')?></th>
                                            <th><?= lang('Files.Name_GroupDivisi')?></th>
                                            <th><?= lang('Files.Code_Divisi')?></th>
                                            <th><?= lang('Files.Name_Divisi')?></th>
                                            <th><?= lang('Files.User_Created')?></th>
                                            <th><?= lang('Files.User_Modified')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($divisi as $list):?>
                                            <tr>
                                                <td>
                                                    <a class="btn btn-soft-secondary waves-effect waves-light btn-sm editDivisi" title="Edit" data-bs-toggle="modal" data-bs-target="#editDivisi"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                    <a class="btn btn-soft-danger waves-effect waves-light btn-sm deleteDivisi" title="Hapus" ><i class="fas fa-trash-alt" title="Hapus"></i></a>
                                                </td>
                                                <td><?=$list->iddivisi?></td>
                                                <td><?=$list->gdiv_nama?></td>
                                                <td><?=$list->div_kode?></td>
                                                <td><?=$list->div_nama?></td>
                                                <td><?=$list->user_c?></td>
                                                <td><?=$list->user_m?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="editDivisi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticdivisiLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticDivisiLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form novalidate method="post" name="divisi">
                                                    <input type="hidden" />
                                                    <div class="col-xl-8 col-md-8">
                                                        <div class="form-group mb-3">
                                                            <label><?=lang('Files.Code_GroupDivisi')?></label>
                                                            <input type="hidden" name="id" id="id" class="form-control" required value="" />
                                                            <select name="idgroup" id="idgroup" class="form-select">
                                                                <option value="">-</option>
                                                                <?php foreach($group as $opt):?>
                                                                    <option value="<?=$opt->iddivisigroup?>"><?=$opt->gdiv_nama?></option>
                                                                <?php endforeach;?>
                                                            <!-- <div class="pristine-error text-help">Kode Divisi Harus Diisi</div>  -->
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-8 col-md-8">
                                                        <div class="form-group mb-3">
                                                            <label><?=lang('Files.Code_Divisi')?></label>
                                                        <input type="hidden" name="id" id="id" class="form-control" required value="" />
                                                        <input type="text" name="kode" id="kode" class="form-control" required value="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-8 col-md-8">
                                                        <div class="form-group mb-3">
                                                            <label><?=lang('Files.Name_Divisi')?></label>
                                                            <input type="text" required data-pristine-required-message="Isikan Nama Divisi" class="form-control" value="" id="namadivisi" />
                                                        <!-- <div class="pristine-error text-help">Nama Divisi Harus Diisi</div> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?=lang('Files.Close')?></button>
                                                <button type="submit" class="btn btn-primary save"><?=lang('Files.Save')?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="assets/js/app.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: [
            {
                text: '<?= lang('Files.Add')?>',
                action: function ( e, dt, node, config ) {
                    let str = document.querySelector('#staticDivisiLabel')
                    str.innerHTML = '<?=  lang('Files.Add'),' ',lang('Files.Divisi')  ?>'
                    document.getElementById("id").value = '';
                    document.getElementById("kode").value = '';
                    document.getElementById("namadivisi").value = '';
                    $('#editDivisi').modal('show')
                }
            },
            'excel', 'pdf', 'colvis',
            ]
        });

        // var column = table.column('ID'.attr('data-column'));
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        // table.columns(1).visible(false)
        $(".dataTables_length select").addClass('form-select form-select-sm');
    })

    // const table = $('#datatable').DataTable()
    async function deleteData(url='',data={}) {
        const response = await fetch(url, {
            method:'POST',
            mode:'cors',
            cache:'no-cache',
            creadentials:'same-origin',
            headers: {
                'Content-Type':'application/json',
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(data)
        })        
        return response.json()
    }

    async function postData(url='',data={}) {
        const response = await fetch(url,{
            method:'POST',
            mode:'cors',
            cache:'no-cache',
            creadentials:'same-origin',
            headers: {
                'Content-Type':'application/json',
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(data)
        })

        return response.json()
    }
    const editButton = document.querySelectorAll(".editDivisi");
    const deleteButton = document.querySelectorAll('.deleteDivisi')
    const saveButton = document.querySelector('.save');
    const selected = document.querySelectorAll("input#kode");
    const $select = document.querySelector('#idgroup')
    const $option = Array.from($select.options)

    for (let i = 0; i < editButton.length; i++) {
        console.log(editButton[i])
        editButton[i].addEventListener("click", function() {
            
            let id = document.querySelector('table.divisi').rows.item(i+1).cells.item(1).innerHTML
            let group = document.querySelector('table.divisi').rows.item(i+1).cells.item(2).innerHTML
            let kode = document.querySelector('table.divisi').rows.item(i+1).cells.item(3).innerHTML
            let nama = document.querySelector('table.divisi').rows.item(i+1).cells.item(4).innerHTML
            // console.log(group)
            let selectedOpt = $option.find(item => item.text == group)
            selectedOpt.selected = true

            let str = document.querySelector('#staticDivisiLabel')
                    // console.log(str.html)
            str.innerHTML = '<?=lang('Files.Edit'),' ',lang('Files.Divisi')?>'
            document.getElementById("id").value = id;
            document.getElementById("kode").value = kode;
            document.getElementById("namadivisi").value = nama;
        });
    }

    for(let i=0; i< deleteButton.length; i++) {
        deleteButton[i].addEventListener("click", function() {
        let kode = document.querySelector('table.divisi').rows.item(i+1).cells.item(2).innerHTML
        Swal.fire({
            title: "<?=lang('Files.Deleted_Confirm')?>",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "<?=lang('Files.Yes')?>"
        }).then(function (result) {
            const reqbody = {'kode':kode}
            if (result.value) {
                deleteData('<?=base_url()?>/divisi/delete', {'kode':kode})
                .then(data => {
                    // console.log(data)
                    if(data.code === 200) 
                    Swal.fire("Deleted!", data.message, data.status)
                    // table.ajax.reload()
                    // Swal.clickConfirm()
                    setTimeout(() => location.reload(), 1500)
                })
                .catch(err => {
                    console.log('Error',err)
                })
                // console.log(table)
            }
        });
        });
    }

    saveButton.addEventListener("click", function(){
        const id =  document.forms["divisi"]["id"].value;
        const kode =  document.forms["divisi"]["kode"].value;
        const nama =  document.forms["divisi"]["namadivisi"].value;
        const data = [id, kode, nama]
        postData('<?=base_url()?>/divisi/post',{'data':data})
        .then(data => {
            // console.log(data)
            if(data.code === 200) $('#editDivisi').modal('hide'); Swal.fire("Success!", data.message, data.status);
                    // table.ajax.reload()
                    // Swal.clickConfirm()
            setTimeout(() => location.reload(), 1500)
        })
        
    })
</script>
</body>

</html>