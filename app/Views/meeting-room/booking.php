<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/libs/twitter-bootstrap-wizard/prettify.css">
    <link href="<?=base_url()?>/public/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="/assets/libs/flatpickr/flatpickr.min.css"> -->

    <?= $this->include('partials/head-css') ?>
    <?= $this->include('partials/_home-css') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/assets/css/booking.css" />
    <!-- Sweet Alert-->
    <link href="<?=base_url()?>/public/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .choices__list--dropdown .choices__item--selectable {
            padding-right: 0;
        }

        .choices__heading {
            font-size: 16px;
            color: var(--bs-primary);
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
       <?php if(logged_in()==TRUE): ?>
        <div class="page-content">
            <div class="container-fluid">
            
                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0"><?=lang('Files.Form_Request_Room')?> <?=$nama != '' ? $nama : ''?></h4>
                            </div>
                            <div class="card-body" style="border:0px solid #000;">
                                <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                    <ul class="twitter-bs-wizard-nav">
                                        <li class="nav-item">
                                            <a href="#seller-details" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Diri">
                                                    <i class="bx bx-list-ul"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#company-document" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Peserta">
                                                    <i class="bx bx-book-bookmark"></i>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Ruangan">
                                                    <i class="bx bxs-bank"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- wizard-nav -->

                                    <form>
                                    <div class="tab-content twitter-bs-wizard-tab-content">
                                        <div class="tab-pane" id="seller-details">
                                            <div class="text-center mb-4">
                                                <h5><?=lang('Files.Data_Personal')?></h5>
                                                <p class="card-title-desc"><?=lang('Files.Fill_Data')?> <?=lang('Files.Data_Personal')?></p>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-firstname-input" class="form-label"><?=lang('Files.Fullname')?></label>
                                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?=user()->fullname?>"  <?= (user()->fullname != '') ? 'readonly' : ''?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-lastname-input" class="form-label"><?=lang('Files.Position')?></label>
                                                            <select disabled class="form-select" id="position">
                                                                <option>-</option>
                                                                <?php foreach($position as $list):?>
                                                                    <option value="" <?=($list->Id==user()->idjabatan ? 'selected' : '')?>><?=$list->Name_Position?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-phoneno-input" class="form-label"><?=lang('Files.Department')?></label>
                                                            <select disabled class="form-select iddepartment" id="" name="iddepartment">
                                                                <option selected>- Pilih -</option>
                                                                <?php foreach($department as $list): ?>
                                                                <option value="<?=$list->Id?>" <?=($list->Id==user()->iddepartment ? 'selected' : '')?>><?=$list->Name_Department.' ('.$list->Name_Divisi.')'?>
                                                            <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-email-input" class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" id="email" value="<?=user()->email?>" <?=(user()->email != '') ? 'readonly' : ''?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab1()"><?=lang('Files.Next')?> <i class="bx bx-chevron-right ms-1"></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- tab pane -->
                                        <div class="tab-pane" id="company-document">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5><?=lang('Files.Data_Participant')?></h5>
                                                    <p class="card-title-desc"><?=lang('Files.Fill_Data')?> <?=lang('Files.Data_Participant')?></p>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="startdate" class="form-label"><?=lang('Files.Date')?></label>
                                                                <input type="date" class="form-control" name="startdate" id="startdate" value="<?=($edited==true ? $data[0]->tgl_mulai : '')?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="starttime" class="form-label"><?=lang('Files.Start_Time')?></label>
                                                                <input type="time" class="form-control" name="starttime" id="starttime" value="<?=($edited==true ? date('H:i',strtotime($data[0]->jam_mulai)) : '')?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="endtime" class="form-label"><?=lang('Files.End_Time')?></label>
                                                                <input type="time" class="form-control" name="endtime" id="endtime" value="<?=($edited==true ? date('H:i',strtotime($data[0]->jam_selesai)) : '')?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="participant" class="form-label"><?=lang('Files.Amount_Participant')?></label>
                                                                <input type="number" class="form-control" name="participant" id="participant" value="<?=($edited==true ? count($participant) : '')?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-servicetax-input" class="form-label"><?=lang('Files.ParticipantBase')?></label>
                                                                <div class="d-flex justify-content-start gap-3">
                                                                    <input class="form-check-input lokasi" type="checkbox" name="asalpeserta" id="kantorho" value="kantorho" <?=($edited==true && $data[0]->asal_peserta == 'kantorho' ? 'checked' : '')?> >
                                                                    <label class="form-check-label" for="kantorho">Head Office</label>

                                                                    <input class="form-check-input lokasi" type="checkbox" name="asalpeserta" id="pabrik" value="pabrik" <?=($edited==true && $data[0]->asal_peserta == 'pabrik' ? 'checked' : '')?> >
                                                                    <label class="form-check-label" for="pabrik">Unit PKS</label>

                                                                    <input class="form-check-input lokasi" type="checkbox" name="asalpeserta" id="kebun" value="kebun" <?=($edited==true && $data[0]->asal_peserta == 'kebun' ? 'checked' : '')?> >
                                                                    <label class="form-check-label" for="kebun">Unit Kebun</label>

                                                                    <input class="form-check-input lokasi" type="checkbox" name="asalpeserta" id="eksternal" value="eksternal" <?=($edited==true && $data[0]->asal_peserta == 'eksternal' ? 'checked' : '')?> >
                                                                    <label class="form-check-label" for="eksternal">Pihak External</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    <label for="speaker" class="form-label"><?=lang('Files.Speaker_Name')?></label>
                                                                    <input type="text" class="form-control" name="speaker" id="speaker" value="<?=($edited==true ? $data[0]->pemateri : '')?>">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="speakeremail" class="form-label"><?=lang('Files.Speaker_Email')?></label>
                                                                    <input type="email" class="form-control" name="speakeremail" id="speakeremail" value="<?=($edited==true ? $data[0]->ccemail : '')?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-cstno-input"class="form-label"><?=lang('Files.Meeting_Participant')?></label>
                                                                <button type="button" class="btn-rounded btn-sm btn-soft-primary waves-effect waves-light addParticipant"><i class="fas fa-plus font-size-12"></i></button>
                                                            </div>
                                                            <div class="row formParticipant" style="display:none">                                   
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                    <label for="namapeserta">Nama Peserta</label>
                                                                    <select class="form-control" name="namapeserta" id="namapeserta">
                                                                        <option value=""><?=lang('Files.Type_Name')?></option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="bagian"><?=lang('Files.Department')?></label>
                                                                        <input type="text" class="form-control bagianpeserta" id="bagian" placeholder="Bagian/Department" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="email-peserta"><?=lang('Files.Email')?></label>
                                                                        <input type="email" class="form-control emailpeserta" id="emailpeserta" placeholder='Jika tidak ada email diisi "-"' disabled>
                                                                        <input type="hidden" id="isexternal" value=""/>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-4 d-flex justify-content-end">
                                                                    <button type="submit" class="btn btn-primary w-md submitParticipant"><?=lang('Files.Add_Participant')?></button>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table align-middle mb-0 daftarpeserta">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><?=lang('Files.Fullname')?></th>
                                                                            <th><?=lang('Files.Department')?></th>
                                                                            <th><?=lang('Files.Email')?></th>
                                                                            <th><?=lang('Files.Action')?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="tbodydata">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="agenda" class="form-label"><?=lang('Files.Agenda')?></label>
                                                                <textarea id="agenda" class="form-control" placeholder="Agenda Meeting" rows="3"><?=($edited==true ? $data[0]->agenda : '')?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> <?=lang('Files.Previous')?></a></li>
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab2()"><?=lang('Files.Next')?> <i class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- tab pane -->
                                        <div class="tab-pane" id="bank-detail">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5><?=lang('Files.Data_Room')?></h5>
                                                    <p class="card-title-desc"><?=lang('Files.Fill_Data')?> <?=lang('Files.Data_Room')?></p>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><?=lang('Files.Room_Name')?></label>
                                                                <select class="form-select" id="room">
                                                                    <option selected>- Pilih -</option>
                                                                    <?php foreach($room as $list)  : ?>
                                                                    <option value="<?=$list->idruangan?>" <?=($edited == true && $list->idruangan == $data[0]->idruangan ? 'selected' : '')?> ><?=$list->nama_ruangan?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-cardno-input" class="form-label"><?=lang('Files.Notulis')?></label>
                                                                <input type="text" class="form-control" name="notulen" id="notulen" value="<?=$edited==true ? $data[0]->notulis : ''?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <?php 
                                                            $exp=null;
                                                            if($edited==true):
                                                            if($data[0]->kebutuhan!='') $exp = explode(',',$data[0]->kebutuhan);
                                                        endif;?>
                                                        <fieldset class="form-group border p-3">
                                                            <legend class="form-group px-2 " style="font-size:14px; font-weight:600">- <?=lang('Files.Needed_Item')?> - </legend>
                                                            <div class="form-check">
                                                                <input class="form-check-input requirement" type="checkbox" name="kebutuhan" id="zoom" value="Zoom" <?=($exp!=null && in_array('Zoom',$exp) ? 'checked' : '')?> >
                                                                <label class="form-check-label" for="zoom">Zoom Meeting Lengkap (Kamera,Link Zoom, Speaker, Mic)</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input requirement" type="checkbox" name="kebutuhan" id="laptop" value="Laptop" <?=($exp!=null && in_array('Laptop',$exp) ? 'checked' : '')?> >
                                                                <label class="form-check-label" for="laptop">Laptop</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input requirement" type="checkbox" name="kebutuhan" id="proyektor" value="Proyektor" <?=($exp!=null && in_array('Proyektor',$exp) ? 'checked' : '')?> >
                                                                <label class="form-check-label" for="proyektor">Proyektor</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input requirement" type="checkbox" name="kebutuhan" id="link" value="Link Zoom" <?=($exp!=null && in_array('Link Zoom',$exp) ? 'checked' : '')?> >
                                                                <label class="form-check-label" for="link">Link Zoom (Tanpa Ruangan)</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input requirement" type="checkbox" name="kebutuhan" id="others" value="others" <?=($exp!=null && in_array('others',$exp) ? 'checked' : '')?> >
                                                                <label class="form-check-label" for="others">Lainnya</label> 
                                                                <input type="text" class="form-control" name="notulen" id="notulen" style="border-top:0px;
                                                                border-right:0px; border-left:0px; display:none">
                                                            </div>
                                                        </fieldset>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> <?=lang('Files.Previous')?></a></li>
                                                    <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".confirmModal"><?=($edited==true ? lang('Files.Update') : lang('Files.Save'))?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- tab pane -->
                                    </div>
                                    </form>
                                    <!-- end tab content -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <!-- Modal -->
        <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bx bx-check-circle display-4 text-success"></i>
                            </div>
                            <h5>Confirm Save Changes</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-md submitted" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade loadingModal" tabindex="-1" aria-hidden="true" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="staticBackdropLabel">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Sedang Menyiapkan Permintaan Anda</h5>
                    </div>
                    <div class="modal-body text-center text-primary">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <br />
                        <strong>Loading...</strong>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <?= $this->include('partials/footer') ?>
    <?php endif;?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- twitter-bootstrap-wizard js -->
<script src="<?=base_url()?>/public/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- form wizard init -->

<?= $this->include('partials/script/booking') ?>

<!-- Sweet Alerts js -->
<script src="<?=base_url()?>/public/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?=base_url()?>/public/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<?=$this->include('partials/_home-js')?>
<script text="text/javascript">
    const fullname = document.querySelector('#fullname')
    const position = document.querySelector('#position')
    const department = document.querySelector('.iddepartment')
    const email = document.querySelector('#email')
    const startdate = document.querySelector('#startdate')
    const starttime = document.querySelector('#starttime')
    const endtime = document.querySelector('#endtime')
    const participant = document.querySelector('#participant')
    // const lokasi = document.querySelectorAll('.lokasi')
    const speaker = document.querySelector('#speaker')
    const speakeremail = document.querySelector('#speakeremail')
    const nameparti = document.querySelector('.nameparti')
    const agenda = document.querySelector('#agenda')
    const room = document.querySelector('#room')
    const requirement = document.querySelector('#requirement')
    const notulen = document.querySelector('#notulen')
    const submitted = document.querySelector('.submitted')
    // const el = new Choices(nameparti)
    
    function nextTab1()
    {
        sessionStorage.setItem('fullname',fullname.value)
        sessionStorage.setItem('position',position.value)
        sessionStorage.setItem('department',department.value)
        sessionStorage.setItem('email',email.value)
    }

    function nextTab2()
    {
        // const items = { ...localStorage };
        // let mrkcheckbox = document.getElementsByName('asalpeserta')
        let mrkcheckbox = document.querySelectorAll('.lokasi')
        let lokasi;
        mrkcheckbox.forEach((item)=> {
            if(item.checked) lokasi = (lokasi != undefined ? lokasi +','+item.value : item.value)
            // console.log(item.checked)
        })
        sessionStorage.setItem('startdate',startdate.value)
        sessionStorage.setItem('starttime',starttime.value)
        sessionStorage.setItem('endtime',endtime.value)
        sessionStorage.setItem('participant',participant.value)
        sessionStorage.setItem('location',lokasi)
        sessionStorage.setItem('speaker',speaker.value)
        sessionStorage.setItem('speakeremail',speakeremail.value)
        // localStorage.setItem('nameparti',nameparti.val())
        // localStorage.setItem('nameparti',el.getValue(true))
        sessionStorage.setItem('agenda',agenda.value)
    }

    submitted.addEventListener('click', (e) => {
        sessionStorage.setItem('room',room.value)
        sessionStorage.setItem('roomname',room.options[room.selectedIndex].text)
        sessionStorage.setItem('notulen',notulen.value)
        let reqcheckbox = document.querySelectorAll('.requirement')
        let requirement;
        if(speakeremail.value=='' || speakeremail.value == undefined) {
            return Swal.fire("Info",'Email Pemateri Harus diisi','warning');
        }
        reqcheckbox.forEach((item)=> {
            if(item.checked) requirement = (requirement != undefined ? requirement +','+item.value : item.value)
        })
        sessionStorage.setItem('requirement',requirement)
        
        const items = { ...sessionStorage};        
        const loadingModal = new bootstrap.Modal(document.getElementById('myModal'), {
            keyboard: false
        })
        loadingModal.show()
        console.log(items)
        postData('<?=base_url()?>/meeting-schedule/booking/request',{'data':items})
        .then(data => {
            console.log(data)
            if(data.code === 200) {
                // release localstorage
                Swal.fire("Success!",data.message, data.status).then(function(){
                    sessionStorage.clear()
                    loadingModal.hide()
                    setTimeout((e) => {
                        location.href = '<?=base_url()?>/meeting-schedule';
                    }, 1000)
                });
            }
            else {
                Swal.fire("Warning!",data.message, data.status).then(function(){
                    loadingModal.hide()
                });
            }
        })
    })

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
</script>
</body>
</html>