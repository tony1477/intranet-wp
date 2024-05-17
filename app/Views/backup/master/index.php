<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- DataTables -->
    <?= $this->include('partials/_datatables-css') ?>

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/index.css" />
    <link href="<?=base_url()?>/public/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
    <style>
        .dt-buttons.btn-group {
            padding-bottom: .5rem;
        }

        .choices__list--multiple .choices__item {
            background: var(--bs-primary);
            border: 1px solid var(--bs-primary);
        }
    </style>
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

                                <table id="datatable-buttons" class="table table-bordered dt-responsive w-100 e-backup">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Divisi</th>
                                            <!-- <th>Created By</th> -->
                                            <th>Last Updated By</th>
                                            <!-- <th>Created At</th> -->
                                            <th>Last Update At</th>
                                            <th>Detail</th>
                                            <th>Aksi</th>
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
    <div class="modal fade" id="masterFormFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticmasterFormFileLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticmasterFormFileLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate method="post" name="masterFormFile">
                            <input type="hidden" name="id" id="idfrm" value="" />
                            <div class="col-md-10 col-xl-10">
                                <div class="form-group mb-3">
                                    <label>Divisi</label>
                                    <input type="text" name="divisi" id="divisi" class="form-control" required value="" />
                                </div>
                            </div>
                            <div class="col-md-10 col-xl-10">
                                <div class="form-group mb-3">
                                    <label>Files</label>
                                    <input type="text" name="files" id="choices_files" class="form-control" />
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
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?=base_url()?>/public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/2.0.3/api/processing().js"></script>
<!-- SweetAlert -->
<?= $this->include('partials/sweetalert') ?>
<script src="<?=base_url()?>/public/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script>
    let choices;
    const cstModal = document.querySelector('#masterFormFile')
    const saveBtn = document.querySelector('button.save');
    function dateISOtoString(param) {
        const date = new Date(param);
        let year = date.getFullYear();
        let month = date.getMonth() + 1;
        let day = date.getDate();
        let hour = date.getUTCHours()+7;
        let minute = date.getMinutes()

        // if (day < 10) day = "0" + day;
        day < 10 ? `0${day}` : day
        minute < 10 ? `0${minute}` : hour
        month < 10 ? `0${month}` : month
        
        return `${day}/${month}/${year} ${hour}:${minute}`;
    }

    const URL = 'http://127.0.0.1:3000'
    let masterTable = $('.e-backup').DataTable({
        processing: true,
        serverSide: false,
        dom: "<'row align-items-end'<'col-sm-6'Bl><'col-sm-6'f>>" + 
               "<'row'<'col-sm-12'tr>>" +             
               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        ajax :{
            url : `<?=base_url('e-backup/master/show')?>`,
            type:'GET'
        },
        columns:[
            {
                data:"null",
                render: function(data,type,row,meta) {
                    return meta.row + 1
                }
            },
            {data:"divisi"},
            // {data:"createdby"},
            {data:"updatedby"},
            // {
            //     data:"created_at",
            //     render: function(data,type,row) {
            //         return dateISOtoString(data)
            //     }
            // },
            {
                data:"updated_at",
                render: function(data,type,row) {
                    return dateISOtoString(data)
                }
            },
            {
                data: "null",
                className: "details-control",
                orderable: false,
                render: function(data,type,row) {
                    return `<button type="button" class="waves-effect btn btn-primary btn-sm btn-round">Detail</button>`
                }
            },
            {
                data:"null",
                render: function(data,type,row) {
                    return `<button type="button" class="btn btn-soft-success waves-effect waves-light edit-button"><i class="bx bx-edit font-size-16 align-middle"></i></button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light delete-button"><i class="bx bx-trash font-size-16 align-middle"></i></button>`
                }
            }
        ],
        buttons: [
            {
                text: '<?= lang('Files.Add')?>',
                action: function ( e, dt, node, config ) {
                    const h5 = document.querySelector('h5#staticmasterFormFileLabel')
                    h5.innerText = '<?=lang('Files.Add')?> Divisi'
                    const id = document.querySelector('#idfrm');
                    $('#masterFormFile').modal('show')
                    resetForm();
                }
            },
            'excel','pdf'],
        pageLength:10,
        lengthMenu:[10,25,50,100],
        rowCallback: function (row, data, index) {
            const childRow = masterTable.row(index).child;
            if (childRow.isShown()) {
                childRow.hide();
                $(row).removeClass("shown");
            }
        },
        // createdRow: function (row, data, index) {
        //     $(row).addClass("details-row");
        //     const detailHtml =
        //         '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        //         "<tr>" +
        //         "<td>Alasan Permintaan:</td>" +
        //         "<td>test" 
        //         "</td>" +
        //         "</tr>" +
        //         "</table>";
        //     masterTable.row(index).child(detailHtml).show();
        // },
    })

    $(document).off('click','#datatable-buttons tbody td.details-control')
    .on('click','#datatable-buttons tbody td.details-control', function() {
        const table = $(this).closest('table').DataTable()
        const tr = $(this).closest('tr')
        const row = table.row(tr)
        
        if (row.child.isShown()) {
          row.child.hide();
          tr.removeClass("shown");
        } else {
          masterTable.processing(true);
          fetch(`<?=base_url('e-backup/master')?>/${row.data().divisi.toLowerCase()}`)
          .then(resp => resp.json())
          .then(data => {
                const files = data.data[0].File
                const fields = ['No','Nama File']
                const table = createTable(fields,files)
                masterTable.processing(false)
                row.child(table).show()
                tr.addClass("shown")
          })
        }
    })

    $(document).off('click','#datatable-buttons tbody button.edit-button')
    .on('click','#datatable-buttons tbody button.edit-button', async function() {
        const rowData = masterTable.row($(this).closest('tr')).data()
        // console.log(rowData)
        const h5 = document.querySelector('h5#staticmasterFormFileLabel')
        h5.innerText = `<?=lang('Files.Update')?> Divisi`
        await fillForm(rowData).then($('#masterFormFile').modal('show'))
    })

    $(document).off('click','#datatable-buttons tbody button.delete-button')
    .on('click','#datatable-buttons tbody button.delete-button', async function() {
        const rowData = masterTable.row($(this).closest('tr')).data()
        // console.log(rowData)
        const url = '<?=base_url('e-backup/master')?>';
        Swal.fire({
            title: '<?=lang('Files.are_you_sure?')?>',
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                deleteData(`${url}/${rowData._id}`).then(data => {
                    if(data.status == 'success') {
                        return Swal.fire('Deleted!','<?=lang('Files.Delete_Success')?>','success').then(() => {
                            masterTable.ajax.reload();
                        })
                    }
                    return Swal.fire('Error!','<?=lang('Files.Delete_Error')?>','error');
                });
            }
        })
        // await deleteRow(rowData).then($('#masterFormFile').modal('show'))
    })

    const createTable = (fields,data) => {
        const div = document.createElement('div')
        div.setAttribute('class','col-lg-6 col-sm-12')
        const table = document.createElement('table')
        table.setAttribute('class','table table-striped')
    
        const thead = document.createElement('thead')
        const trHead = document.createElement('tr')
        for (let field of fields) {
            const th = document.createElement('th')
            th.textContent = field
            trHead.appendChild(th)
        }

        thead.appendChild(trHead)
        table.appendChild(thead)

        const tbody = document.createElement('tbody')
        data.forEach((item, index) => {
            const trBody = document.createElement('tr')
            const tdNumber = document.createElement('td')
            tdNumber.textContent = ++index
            const tdColumn = document.createElement('td')
            tdColumn.textContent = item

            trBody.appendChild(tdNumber)
            trBody.appendChild(tdColumn)
            
            tbody.appendChild(trBody)
        })
        table.appendChild(tbody)
        div.appendChild(table)
        return div
    }

    const fillForm = async (data) => {
        const form = document.querySelector("form[name='masterFormFile']")
        const id = form.querySelector('#idfrm');
        const divisi = form.querySelector('#divisi');
        id.value = data._id
        divisi.value = data.divisi
        const url = fetch(`<?=base_url('e-backup/master')?>/${data.divisi.toLowerCase()}`)
        const response = await url.then(resp => resp.json())
        const result = await response.data;
        initChoice(result[0].File)
    }

    const resetForm = async () => {
        const form = document.querySelector("form[name='masterFormFile']");
        form.reset();
        $('input[type="hidden"]').val('');
        const choiceEl = document.querySelector('#choices_files')
        choiceEl.dataset.choice!='active' ? initChoice([]) : choices.clearStore()
    }

    const postData = async (url,data) => {
        const response = await fetch(url,{
            method:'POST',
            cache: 'no-cache',
            headers: {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify(data)
        })
        return response.json()
    }

    const putData = async (url,data) => {
        const response = await fetch(`${url}/${data.divisi.toLowerCase()}`,{
            method:'PATCH',
            cache: 'no-cache',
            headers: {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify(data)
        })
        return response.json()
    }

    const deleteData = async(url) => {
        const response = await fetch(url,{
            method:'DELETE',
            cache: 'no-cache',
            headers: {
                'Content-Type' : 'application/json'
            },
        })
        return response.json()
    }

    // cstModal.addEventListener('show.bs.modal', function(e) {
    //     const choiceEl = document.querySelector('#choices_files')
    //     if(choiceEl.dataset.choice!='active') initChoice();
    // })

    const initChoice = (items) => {
        const choiceEl = document.querySelector('#choices_files')
        if(choiceEl.dataset.choice!='active') {
            return choices = new Choices($('#choices_files')[0],{
                removeItemButton:true,
                editItems:true,
                duplicateItemsAllowed:false,
                delimiter:';',
                items: items,
            })
        }
        choices.clearStore();
        return choices.setValue(items);
    }

    saveBtn.addEventListener('click', () => {
        const id = document.querySelector('#idfrm').value;
        const divisi = document.querySelector('#divisi').value
        const files = choices.getValue(true);
        
        const method = id.value != '' ? 'PATCH' : 'POST';
        const data = {id,divisi,File:files}
        const url = '<?=base_url('e-backup/master')?>';

        const result = id !='' ? putData(url,data) : postData(url,data);
        
        result.then(data => {
            if(data.status == 'success') {
                return Swal.fire('Success!',
                '<?=lang('Files.Save_Success')?>','success').then(async function(){
                    await masterTable.ajax.reload();
                    $('#masterFormFile').modal('hide');
                })
            }
            return Swal.fire('Info!',data.message,'info');
            
        })
    })
</script>
</body>

</html>