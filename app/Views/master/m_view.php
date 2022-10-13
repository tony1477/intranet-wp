<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/_datatables-css') ?>
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
                                <h4 class="card-title"><?= lang('Files.'.$menuname)?></h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable-buttons" class="table table-bordered dt-responsive  w-100 <?=$menuname?>">
                                    <thead>
                                        <?php $rows = array_diff($columns,$columns_hidden);?>
                                        <tr>
                                            <?php foreach($columns as $column):?>
                                            <th><?= lang('Files.'.$column)?></th>
                                            <?php endforeach;?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data as $list):?>
                                            <tr>
                                                <td>
                                                    <a class="btn btn-soft-secondary waves-effect waves-light btn-sm edit<?=$menuname?>" title="Edit" data-bs-toggle="modal" data-bs-target="#edit<?=$menuname?>"><i class="fas fa-pencil-alt" title="<?=lang('Files.Edit')?>"></i></a>
                                                    <a class="btn btn-soft-danger waves-effect waves-light btn-sm delete<?=$menuname?>" title="Hapus" ><i class="fas fa-trash-alt" title="<?=lang('Files.Delete')?>"></i></a>
                                                </td>
                                               
                                                <?php foreach($rows as $row):?>
                                                <td><?php if(isset($mark_column) && in_array($row,$mark_column)) {
                                                    echo '*****';
                                                }
                                                else {echo $list->$row; }?></td>
                                                <?php endforeach;?>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="edit<?=$menuname?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="static<?=$menuname?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="static<?=$menuname?>Label"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form novalidate method="post" name="<?=$menuname?>">
                                                <?php foreach($forms as $form):
                                                    if($form['type']=='hidden') { ?>
                                                        <input type="<?=$form['type']?>" name="<?=$form['idform']?>" id="<?=$form['idform']?>" value="" />
                                                    <?php }
                                                    if($form['type'] == 'select') {
                                                        $id = $form['options']['id'];
                                                        $value = $form['options']['value'];
                                                     ?>
                                                    <div class="<?=$form['style']?>">
                                                        <div class="form-group mb-3">
                                                            <label><?=lang('Files.'.$form['label'])?></label>
                                                            <select name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>">
                                                                <option value="">-</option>
                                                                <?php foreach($form['options']['list'] as $opt):?>
                                                                  <option value="<?=$opt->$id?>"><?=$opt->$value?></option>
                                                                <?php endforeach;?>
                                                            <!-- <div class="pristine-error text-help">Kode Divisi Harus Diisi</div>  -->
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <?php } 
                                                    if($form['type']=='text') { ?>
                                                    <div class="<?=$form['style']?>">
                                                        <div class="form-group mb-3">
                                                            <label><?=lang('Files.'.$form['label'])?></label>
                                                        <input type="text" name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>" required value="" />
                                                        </div>
                                                    </div>
                                                    <?php }
                                                    if($form['type']=='password') { ?>
                                                        <div class="<?=$form['style']?>">
                                                            <div class="form-group mb-3">
                                                                <label><?=lang('Files.'.$form['label'])?></label>
                                                            <input type="password" name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>" required value="" />
                                                            </div>
                                                        </div>
                                                        <?php }
                                                    if($form['type']=='email') { ?>
                                                        <div class="<?=$form['style']?>">
                                                            <div class="form-group mb-3">
                                                                <label><?=lang('Files.'.$form['label'])?></label>
                                                            <input type="email" name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>" required value="" />
                                                            </div>
                                                        </div>
                                                        <?php }
                                                    if($form['type'] == 'option') { ?>
                                                    <div class="<?=$form['style']?>">
                                                        <div class="form-group mb-3">
                                                            <label><?=lang('Files.'.$form['label'])?></label>
                                                            <select name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>">
                                                                <option value="">-</option>
                                                                <?php foreach($form['value'] as $key => $value):?>
                                                                  <option value="<?=$key?>"><?=$value?></option>
                                                                <?php endforeach;?>
                                                            <!-- <div class="pristine-error text-help">Kode Divisi Harus Diisi</div>  -->
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <?php }
                                                    endforeach; ?>
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
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/libs/jszip/jszip.min.js"></script>
<script src="/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="/assets/js/app.js"></script>
<?php //echo $crudScript;?>
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
                    let str = document.querySelector('#static<?=$menuname?>Label')
                    str.innerHTML = '<?=  lang('Files.Add'),' ',lang('Files.'.$menuname)  ?>'
                    <?php foreach($forms as $form): ?>
                        document.getElementById("<?=$form['idform']?>").value = '';
                    <?php endforeach;?>
                    $('#edit<?=$menuname?>').modal('show')
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
    const editButton = document.querySelectorAll(".edit<?=$menuname?>");
    const deleteButton = document.querySelectorAll('.delete<?=$menuname?>')
    const saveButton = document.querySelector('.save');
    
    // const selected = document.querySelectorAll("input#kode");
    // const $select = document.querySelector('#idgroup')
    // const $option = Array.from($select.options)
    let ix; let offset=10;
    for (let i = 0; i < editButton.length; i++) {
        editButton[i].addEventListener("click", function() {
            
            // let id = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(1).innerHTML
            // let group = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(2).innerHTML
            // let kode = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(3).innerHTML
            // let nama = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(4).innerHTML
            ix = Math.floor(i/offset);
            let j = i - (offset*ix);
            let n=1; 
    

            <?php foreach($forms as $form): ?>
                let <?=$form['idform']?> = document.querySelector('table.<?=$menuname?>').rows.item(j+1).cells.item(n).innerText;


                <?php if($form['type']=='select' ) { ?>
                    let select<?=$form['idform']?> = document.querySelector('#<?=$form['idform']?>');
                    let option<?=$form['idform']?> = Array.from(select<?=$form['idform']?>.options);
                    let selectedOpt<?=$form['idform']?> = option<?=$form['idform']?>.find(item => item.text == <?=$form['idform']?>);
                    selectedOpt<?=$form['idform']?>.selected = true;
                    
                    // console.log(option<?=$form['idform']?>)    
                    <?php } ?>
                n++;
            <?php endforeach;?>

            let str = document.querySelector('#static<?=$menuname?>Label')
                    // console.log(str.html)
            str.innerHTML = '<?=lang('Files.Edit'),' ',lang('Files.'.$menuname)?>'
            <?php foreach($forms as $form) :
                if($form['type']!='select') { ?>
                    document.getElementById("<?=$form['idform']?>").value = <?=$form['idform']?>;
                <?php } ?>
            <?php endforeach;?>
            ix++;
        });
    }

    for(let i=0; i< deleteButton.length; i++) {
        deleteButton[i].addEventListener("click", function() {
        let id = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(1).innerHTML
        Swal.fire({
            title: "<?=lang('Files.Deleted_Confirm')?>",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "<?=lang('Files.Yes')?>"
        }).then(function (result) {
            // const reqbody = {'kode':kode}
            if (result.value) {
                // console.log(id)
                deleteData('<?=base_url()?>/<?=$route?>/delete', {'id':id})
                .then(data => {
                    console.log(data)
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
        const data = {}
        <?php foreach($forms as $form): ?>
            let <?=$form['field']?> = <?=$form['idform']?>;
            let value<?=$form['idform']?> = document.forms["<?=$menuname?>"]["<?=$form['idform']?>"].value;
            //data[<?=$form['idform']?>] = value<?=$form['idform']?>;
            data.<?=$form['idform']?> = value<?=$form['idform']?>;
        <?php endforeach;?>
        // const id =  document.forms["<?=$menuname?>"]["id"].value;
        // const kode =  document.forms["<?=$menuname?>"]["kode"].value;
        // const nama =  document.forms["<?=$menuname?>"]["namadivisi"].value;
        // data = [id, kode, nama]
        postData('<?=base_url()?>/<?=$route?>/post',{'data':data})
        .then(data => {
            if(data.code === 200) {
                $('#editDivisi').modal('hide'); 
                Swal.fire("Success!", data.message, data.status);
            }
            // table.ajax.reload()
            // Swal.clickConfirm()
            //setTimeout(() => location.reload(), 1500)
        })
    })
</script>
</body>

</html>