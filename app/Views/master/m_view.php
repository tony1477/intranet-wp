<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/_datatables-css') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/sweetalert-css') ?>
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
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
                                <h4 class="card-title"><?= lang('Files.'.$menuname)?></h4>
                            </div>
                            <div class="card-body">
                                <?php if(isset($customsearch) && $customsearch !==null):
                                    echo view($customsearch);
                                endif;?>
                                <table id="datatable-buttons" class="table table-bordered dt-responsive w-100 <?=$menuname?>">
                                    <thead>
                                        <?php 
                                            $rows = array_diff($columns,$columns_hidden);
                                            $key = array_keys($rows);
                                        ?>
                                        <tr>
                                            <?php foreach($columns as $column):?>
                                            <th><?= lang('Files.'.$column)?></th>
                                            <?php endforeach;?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data as $list):?>
                                            <tr>
                                                <?php if($key[0]!==0):?>
                                                <td>
                                                    <a class="btn btn-soft-secondary waves-effect waves-light btn-sm edit<?=$menuname?>" title="Edit" data-bs-toggle="modal" href="#edit<?=$menuname?>"><i class="fas fa-pencil-alt" title="<?=lang('Files.Edit')?>"></i></a>
                                                    <a class="btn btn-soft-danger waves-effect waves-light btn-sm delete<?=$menuname?>" title="Hapus" ><i class="fas fa-trash-alt" title="<?=lang('Files.Delete')?>"></i></a>
                                                    <?php 
                                                    if(isset($custombutton)):
                                                        foreach($custombutton as $btn):
                                                        if(!empty($btn['toggle'])):?>
                                                        <a class="<?=$btn['class']?> <?=$btn['name']?>" data-bs-toggle="modal" data-bs-target="#<?=$btn['id']?>" title="<?=$btn['title']?>"><i class="<?=$btn['icon-class']?>" title="<?=$btn['title']?>"></i></a>
                                                    <?php else: ?>
                                                        <a class="<?=$btn['class']?>" title="<?=$btn['title']?>"><i class="<?=$btn['icon-class']?>" title="<?=$btn['title']?>"></i></a>
                                                    <?php endif;
                                                    endforeach;
                                                    endif;?>
                                                </td>
                                                <?php endif;?>
                                                <?php foreach($rows as $row):?>
                                                <td><?php if(isset($mark_column) && in_array($row,$mark_column)) {
                                                    echo '********';
                                                }
                                                if(isset($columns_link) && in_array($row,$columns_link)) {
                                                    echo "<a href='".base_url()."/dokumen/".$route."/viewbyfile/".$list->$row."' target='blank'>".$list->$row."</a>";
                                                }
                                                if(isset($button) && array_key_exists($row,$button)) {  
                                                    $btnclass = $list->$row=='YES' ? 'btn-success ' : 'btn-danger ';
                                                    $iconclass = ($list->$row=='YES' ? 'bx bx-check' : 'bx bx-block'); 
                                                    echo '<button type="button" class="btn '.$btnclass.$button[$row]['class'].'" id="btn'.$row.'"><i class="'.$iconclass.' label-icon"></i> '.($button[$row]['text'] == true ? $list->$row : '').'</button>';
                                                }
                                                else {echo $list->$row;}?></td>
                                                <?php endforeach;?>
                                                <?php if($key[0]!==1):
                                                    $bpo = ['kebijakan','manual','sop','instruksi-kerja','lainnya'];
                                                    
                                                    if(in_array($route,$bpo)):?>
                                                <td>
                                                    <a class="btn btn-soft-danger waves-effect waves-light btn-sm edit<?=$menuname?>" title="<?=lang('Files.View')?>" target="_blank" href="<?=base_url()?>/bpo/<?=$route?>/viewpdf/<?=$list->No_SOP?>" ><i class="fas fa-file-pdf" title="<?=lang('Files.View')?>"></i></a>
                                                    <?php for($i=1; $i<=$list->hit; $i++):?>
                                                    <a class="btn btn-soft-info waves-effect waves-light btn-sm download<?=$menuname?>" title="<?=lang('Files.Download').' '.lang('Files.Form'.$i)?>" href="<?=base_url()?>/bpo/<?=$route?>/downloadform/<?=$list->No_SOP.'/'.$i?>"><i class="bx bxs-download" title="<?=lang('Files.Download').' '.lang('Files.Form'.$i)?>"></i></a>
                                                    <?php endfor;?>
                                                </td>
                                               <?php endif;endif;?>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                                <?php
                                if(!empty($custombutton)):
                                foreach($custombutton as $button):
                                if(isset($button['loadfile']) && $button['loadfile']!==null && $button['toggle'])
                                    $data['id'] = $button['id'];
                                    $data['title'] = $button['title'];
                                    echo view($button['loadfile'],$data);
                                endforeach;
                                endif;
                                ?>
                                <?php if(empty($bpo)):?>
                                <div class="modal fade" id="edit<?=$menuname?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="static<?=$menuname?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered <?php echo $modal=$modal??'';?>" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="static<?=$menuname?>Label"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form novalidate method="post" name="<?=$menuname?>" enctype="multipart/form-data">
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
                                                            <select name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>" <?php echo $form['disabled']=$form['disabled']??'';?>>
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
                                                        <input type="text" name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>" required value="" <?=$form['attr']??''?>/>
                                                        </div>
                                                    </div>
                                                    <?php }
                                                    if($form['type']=='textarea') { ?>
                                                        <div class="<?=$form['style']?>">
                                                            <div class="form-group mb-3">
                                                                <label><?=lang('Files.'.$form['label'])?></label>
                                                            <textarea id="<?=$form['idform']?>" name="<?=$form['idform']?>" class=<?=$form['form-class']?>></textarea>
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
                                                    if($form['type']=='date') { ?>
                                                        <div class="<?=$form['style']?>">
                                                            <div class="form-group mb-3">
                                                                <label><?=lang('Files.'.$form['label'])?></label>
                                                            <input type="date" name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>" required value="" />
                                                            </div>
                                                        </div>
                                                        <?php }
                                                    if($form['type']=='datetime') { ?>
                                                            <div class="<?=$form['style']?>">
                                                                <div class="form-group mb-3">
                                                                    <label><?=lang('Files.'.$form['label'])?></label>
                                                                <input type="datetime-local" name="<?=$form['idform']?>" id="<?=$form['idform']?>" class="<?=$form['form-class']?>" required value="" />
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
                                                    if($form['type']=='file') { $f = $form['label2'];?>
                                                        <div class="<?=$form['style']?>">
                                                            <div class="form-group mb-3">
                                                                <label><?=lang('Files.'.$form['label'])?></label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                <button class="btn btn-success d-none" type="button" id="download<?=$form['idform']?>"><i class="fa fa-download"></i></button>
                                                                </div>
                                                            <input type="file" name="file<?=$form['idform']?>" id="file<?=$form['idform']?>" class="<?=$form['form-class']?>" /> 
                                                            <input type="hidden" name="full<?=$form['idform']?>" id="full<?=$form['idform']?>" value="<?=$data[0]->$f?>" />
                                                            </div>
                                                            FILE : <span id="<?=$form['idform']?>"><a id="f<?=$form['idform']?>"></a></span><br />
                                                            <!-- <span id="download">DOWNLOAD : <button class="btn btn-sm btn-success" style="border-radius:50%"><i class="fa fa-download"></i> </button>
                                                            </span> -->
                                                            </div>
                                                        </div>
                                                        <?php }
                                                    if($form['type']=='file-image') {;?>
                                                        <div class="<?=$form['style']?>">
                                                            <div class="form-group mb-3">
                                                                <label><?=lang('Files.'.$form['label'])?></label>
                                                            <div class="input-group mb-3">
                                                            <input type="file" name="file<?=$form['idform']?>" id="file<?=$form['idform']?>" class="<?=$form['form-class']?> img-upload" /> 
                                                            </div>
                                                            IMAGE : <br />
                                                            <img class="f<?=$form['idform']?>" style="width:100%"/>
                                                            </div>
                                                        </div>
                                                        <?php }
                                                    if($form['type']=='switch'): ?>
                                                    <div class="<?=$form['style']?>">
                                                        <div class="form-group mb-3">
                                                            <label><?=lang('Files.'.$form['label'])?></label>
                                                        <!-- </div> -->
                                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                            <input type="checkbox" class="form-check-input" id="<?=$form['idform']?>">
                                                        </div>
                                                        <!-- <label class="form-check-label" for="customSwitchsizemd"></label> -->
                                                    </div>
                                                    <?php endif;
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
                                <?php endif;?>
                                <!-- HERE -->
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
<script src="<?=base_url()?>/public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?=base_url()?>/public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/multiselect.min.js"></script>
<?php //echo $crudScript;?>
<script src="<?=base_url()?>/public/assets/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

        //Buttons examples
        <?php if(!isset($bpo)):?>
        var table = $('#datatable-buttons').DataTable({
            // scrollX: true,
            lengthChange: true,
            // lengthMenu: [ 10, 25, 50, 75, 100,200 ],
            buttons: [
            {
                text: '<?= lang('Files.Add')?>',
                action: function ( e, dt, node, config ) {
                    let str = document.querySelector('#static<?=$menuname?>Label')
                    str.innerHTML = '<?=  lang('Files.Add'),' ',lang('Files.'.$menuname)  ?>'
                    <?php foreach($forms as $form):
                        switch($form['type']) {
                        case 'textarea' : ?>
                            let instanceCKeditor<?=$form['idform']?> = CKEDITOR.instances['<?=$form['idform']?>'];
                            // if(instanceCKeditor) CKEDITOR.remove(CKEDITOR.instances['<?=$form['idform']?>']);
                            if(instanceCKeditor<?=$form['idform']?>) CKEDITOR.instances.<?=$form['idform']?>.destroy();
                            CKEDITOR.replace('<?=$form['idform']?>')
                            CKEDITOR.instances.<?=$form['idform']?>.setData('');
                        <?php break; 
                        case 'file': ?>
                        document.getElementById("file<?=$form['idform']?>").value = '';
                        document.getElementById("f<?=$form['idform']?>").innerHTML = '';
                        <?php break; ?>
                        <?php case 'file-image': ?>
                        document.getElementById("file<?=$form['idform']?>").value='';
                        document.querySelector(".f<?=$form['idform']?>").src = '';
                        <?php break; ?>
                        <?php case 'select':?>
                            let select<?=$form['idform']?> = document.getElementById("<?=$form['idform']?>").removeAttribute('disabled')
                        <?php default: ?>
                        document.getElementById("<?=$form['idform']?>").value = '';
                    <?php } endforeach;?>
                    $('#edit<?=$menuname?>').modal('show')
                }
            },
            'excel', 'pdf', 'colvis',
            ],
            <?=isset($scriptdatatable) ? $scriptdatatable:''?>
        });
        <?php else: ?>
            var table = $('#datatable-buttons').DataTable({
            // scrollX: true,
            lengthChange: true,
            <?=isset($scriptdatatable) ? $scriptdatatable:''?>
        });
        <?php endif;?> 
        // var column = table.column('ID'.attr('data-column'));
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        // table.columns(1).visible(false)
        $(".dataTables_length select").addClass('form-select form-select-sm');

        // let table = $('#datatable-buttons').DataTable;

        // EDIT
        $('#datatable-buttons tbody').on( 'click', 'tr', function () {
            let i=1;
            let rowData = table.row( this ).data();
            let ix = table.row( this ).index();
            // console.log(rowData)

            <?php foreach($forms as $form): ?>
                <?php switch($form['type']) {
                    case 'select': ?>
                    let <?=$form['idform']?> = rowData[i].replace('&amp;','&');
                    let select<?=$form['idform']?> = document.querySelector('#<?=$form['idform']?>');
                    let option<?=$form['idform']?> = Array.from(select<?=$form['idform']?>.options);
                    let selectedOpt<?=$form['idform']?> = option<?=$form['idform']?>.find(item => item.text == <?=$form['idform']?>);
                    if(selectedOpt<?=$form['idform']?>!=undefined)
                    selectedOpt<?=$form['idform']?>.selected = true;
                    // console.log(<?=$form['idform']?>)
                <?php break; ?>
                <?php case 'file': ?>
                    let <?=$form['idform']?> = rowData[i].replace('&amp;','&');
                    let full<?=$form['idform']?> = document.querySelector('#full<?=$form['idform']?>').value;
                    // console.log(full<?=$form['idform']?>)
                    let dwn<?=$form['idform']?> = document.querySelector('#download<?=$form['idform']?>');
                    document.getElementById("file<?=$form['idform']?>").value = '';
                    document.getElementById("f<?=$form['idform']?>").innerHTML = '';
                    dwn<?=$form['idform']?>.classList.add("d-none");
                    if(<?=$form['idform']?>!='') {
                        dwn<?=$form['idform']?>.classList.remove("d-none");
                        document.getElementById("f<?=$form['idform']?>").innerHTML = <?=$form['idform']?>;
                        document.getElementById("f<?=$form['idform']?>").setAttribute('target','_blank');
                        document.getElementById("f<?=$form['idform']?>").href = "<?=base_url()?>/dokumen/<?=$route?>/viewbyfile/"+full<?=$form['idform']?>+"/<?=$form['field']?>"
                    }
                <?php break; ?>
                <?php case 'file-image': ?>
                    let <?=$form['idform']?> = rowData[i].replace('&amp;','&');
                    document.getElementById("file<?=$form['idform']?>").value = '';
                    if(<?=$form['idform']?>!='') {
                        document.querySelector(".f<?=$form['idform']?>").src = "<?=base_url()?>/public/assets/images/gallery/foto/"+<?=$form['idform']?>;
                    }
                <?php break; ?>
                <?php case 'switch':  ?>
                    let s<?=$form['idform']?> = document.querySelector('#<?=$form['idform']?>')
                    s<?=$form['idform']?>.checked = false
                    let <?=$form['idform']?> = rowData[i]
                    let dom<?=$form['idform']?> = new DOMParser().parseFromString(<?=$form['idform']?>, "text/html");
                    let id<?=$form['idform']?> = dom<?=$form['idform']?>.getElementsByClassName('btn btn-success').length;
                    if(id<?=$form['idform']?> == 1) s<?=$form['idform']?>.checked = true
                <?php break;  ?>
                <?php case 'textarea': ?>
                    // get full content
                    // fetch(`<?=base_url().'/'.$route?>/getData/${rowData[1]}`)
                    // .then(response => response.json())
                    // .then(data => {
                    //     console.log(data)
                    // })
                    CKEDITOR.replace('<?=$form['idform']?>')
                    let <?=$form['idform']?>TextArea = rowData[i];
                    CKEDITOR.instances.<?=$form['idform']?>.setData(<?=$form['idform']?>TextArea);
                <?php break; ?>
                <?php default: ?>
                    let <?=$form['idform']?> = rowData[i].replace('&amp;','&');
                <?php } ?>
                i++;
            <?php endforeach;?>
                let str = document.querySelector('#static<?=$menuname?>Label')
            // console.log(str.html)
            <?php if(!isset($bpo)): ?>
            str.innerHTML = '<?=lang('Files.Edit'),' ',lang('Files.'.$menuname)?>'
            <?php foreach($forms as $form) :
                if($form['type']!='select' && $form['type']!='file' && $form['type']!='file-image' && $form['type']!='switch') { ?>
                    // console.log(<?=$form['idform']?>)
                    document.getElementById("<?=$form['idform']?>").value = <?=$form['idform']?>;
                <?php } ?>
            <?php endforeach;?>
            ix++;
            <?php endif;?>
        });
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

    async function uploadFile(url='',data={}) {
        const response = await fetch(url, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            creadentials: 'same-origin',
            body: data
        })

        return response.json()
    }

    const editButton = document.querySelectorAll(".edit<?=$menuname?>");
    const deleteButton = document.querySelectorAll('.delete<?=$menuname?>')
    const saveButton = document.querySelector('.save');
    const uploadBtn = document.querySelector('.img-upload')
    
    if(uploadBtn!==null) {
        uploadBtn.addEventListener('change',function(e){
            const charlength = e.target.value.length - 12;
            if(charlength>=100) Swal.fire("Error","Filename too long!!","error")
        })
    }
    
    // const selected = document.querySelectorAll("input#kode");
    // const $select = document.querySelector('#idgroup')
    // const $option = Array.from($select.options)
    let ix; let offset=10;

    for(let i=0; i< deleteButton.length; i++) {
        deleteButton[i].addEventListener("click", function() {
            // let id = document.querySelector('table.<?=$menuname?>').rows.item(i+1).cells.item(1).innerHTML;
            let t1 = $('#datatable-buttons').DataTable();
            $('#datatable-buttons tbody').on( 'click', 'tr', function (e) {
                let idx = t1.row( this ).data()[1]
                if(e.target.classList.contains('delete<?=$menuname?>') || (e.target.classList.contains('fa-trash-alt'))){
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
                        deleteData('<?=base_url()?>/<?=$route?>/delete', {'id':idx})
                        .then(data => {
                            console.log(data)
                            if(data.code === 200) 
                            Swal.fire("Deleted!", data.message, data.status)
                            .then((res) => {
                                if(res.isConfirmed) location.reload();
                            })
                            // table.ajax.reload()
                            // Swal.clickConfirm()
                            
                        })
                        .catch(err => {
                            console.log('Error',err)
                        })
                        // console.log(table)
                    }
                });
                }
            })
        });
    }

    <?php if(empty($bpo)):?>
    saveButton.addEventListener("click", function(e){
        e.preventDefault()
        const data = {}
        let status = 1;
        <?php foreach($forms as $form):
            if($form['type']=='switch') { ?>
                let value<?=$form['idform']?> = 'N';
                let val<?=$form['idform']?> = document.querySelector('#<?=$form['idform']?>').checked;
                val<?=$form['idform']?> ? value<?=$form['idform']?> = 'Y' : 'N';
                data.<?=$form['idform']?> = value<?=$form['idform']?>
                // console.log(value<?=$form['idform']?>);
            <?php } 
            elseif($form['type']!='file' && $form['type']!='switch' && $form['type']!='file-image') { ?>
                let <?=$form['field']?> = <?=$form['idform']?>;
                let value<?=$form['idform']?> = document.forms["<?=$menuname?>"]["<?=$form['idform']?>"].value;
                // console.log(value<?=$form['idform']?>);
                //data[<?=$form['idform']?>] = value<?=$form['idform']?>;
                data.<?=$form['idform']?> = value<?=$form['idform']?>;
            <?php }
            if($form['type']=='file') { ?>
                status=0;
                let datafile<?=$form['idform']?> = document.getElementById('file<?=$form['idform']?>').files[0];
                if(datafile<?=$form['idform']?>!=undefined) {
                    let name<?=$form['idform']?> = datafile<?=$form['idform']?>.name;
                    let <?=$form['field']?> = <?=$form['idform']?>;
                    const formData<?=$form['idform']?> = new FormData();
                    formData<?=$form['idform']?>.append('file',datafile<?=$form['idform']?>)
                    try {
                        console.log('uploading...');
                        $.ajax({
                            url: "<?=base_url()?>/dokumen/uploadfile/<?=$route?>",
                            enctype: 'multipart/form-data',
                            type: 'POST',
                            data: formData<?=$form['idform']?>,
                            dataType: 'json',
                            async: false,
                            success: function (res) {
                                data.<?=$form['idform']?> = res.filename;
                                console.log(res.status)
                                // $('.filesToUpload').empty();
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                    // data. = datafile;
                    catch(e) {
                        console.log('Error :',e);
                        Swal.fire("Failed!", e, 400);
                    }
                }
            <?php } 
            if($form['type']=='file-image') { ?>
                let datafile<?=$form['idform']?> = document.getElementById('file<?=$form['idform']?>').files[0];
                if(datafile<?=$form['idform']?>!=undefined) {
                    let name<?=$form['idform']?> = datafile<?=$form['idform']?>.name;
                    const formData<?=$form['idform']?> = new FormData();
                    formData<?=$form['idform']?>.append('file',datafile<?=$form['idform']?>)
                    try {
                        console.log('uploading...');
                        $.ajax({
                            url: "<?=base_url()?>/foto/uploadfile/<?=$route?>",
                            enctype: 'multipart/form-data',
                            type: 'POST',
                            data: formData<?=$form['idform']?>,
                            dataType: 'json',
                            async: false,
                            success: function (res) {
                                data.<?=$form['idform']?> = res.filename;
                                console.log(res.status)
                                // $('.filesToUpload').empty();
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                    // data. = datafile;
                    catch(e) {
                        console.log('Error :',e);
                        Swal.fire("Failed!", e, 400);
                    }
                }
            <?php } ?>
        <?php endforeach;?>
        // console.log(data)
        postData('<?=base_url()?>/<?=$route?>/post',{'data':data})
        .then(data => {
            if(data.code === 200) {
                $('#editDivisi').modal('hide'); 
                Swal.fire("Success!", data.message, data.status)
                .then(function(){
                    location.reload();
                });
            }
            // table.ajax.reload()
            // Swal.clickConfirm()
            // setTimeout(() => location.reload(), 1500)
        })        
    })
    <?php endif;?>
</script>
<?php if(isset($custombutton) && $custombutton!==''):
    foreach($custombutton as $button):
        $data['class'] = $button['name'];
        echo view($button['scriptfile'],$data);
    endforeach;
    endif;
?>
<?php if(isset($additionalScript) && $additionalScript!==null):
    echo view($additionalScript);
endif;?>
</body>

</html>