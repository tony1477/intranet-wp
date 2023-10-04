<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="mb-4">
                                                <img src="<?=base_url()?>/public/assets/images/logo-baru.jpg" alt="" height="32"><span class="logo-txt"> IT Helpdesk Ticket Detail</span>
                                                <p class="mx-5">Status : <span class="fw-bold text-info"><?=strtoupper($detail->status)?></span></p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="mb-4">
                                                <h4 class="float-end font-size-16">ID Ticket # <span id="idticket"><?=$detail->helpdeskid?></span></h4>
                                            </div>
                                            <div class="mt-5">
                                                <a href="#" onclick="history.back()" class="btn btn-primary"><i class="bx bx-arrow-back me-1"></i> Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1">No Ticket : <span class="fw-bold font-size-14"><?=$detail->ticketno?></span></p>
                                    <p class="mb-1 fw-bold"><i class="mdi mdi-account-tie align-middle mr-1"></i> <?=$detail->fullname?></p>
                                    <p><i class="mdi mdi-phone align-middle mr-1"></i> <?=$detail->user_phone?></p>
                                </div>
                                <hr class="my-4">
                                <div class="row mb-5">
                                    <div class="col-sm-6">
                                        <div>
                                            <div>
                                                <h5 class="font-size-15">Detail Permohonan:</h5>
                                                <p><?=$detail->user_request?></p>
                                            </div>
                                            
                                            <div class="mt-4">
                                                <h5 class="font-size-15">Kategori:</h5>
                                                <p class="mb-1"><?=$detail->category?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>
                                            <div>
                                                <h5 class="font-size-15">Ticket Dibuat / Ticket Open:</h5>
                                                <p><?=date('d M Y',strtotime($detail->ticketdate))?> / <?=$detail->ticketopen!='' ? date('d M Y',strtotime($detail->ticketopen)) : '-'?></p>
                                            </div>

                                            <div class="mt-4">
                                                <h5 class="font-size-15">Alasan Pembuatan/ Permohonan:</h5>
                                                <p class="mb-1"><?=$detail->user_reason?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>
                                            <div>
                                                <h5 class="font-size-15">Lampiran:</h5>
                                                <p><a href="<?=base_url()?>/public/assets/protected/helpdesk/<?=$detail->user_attachment?>" alt="Link Attachment" target="_blank"><?=$detail->user_attachment?></a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php $sr = getWfAuthByUserid('apphelpdesk',$detail->recordstatus);
                                        $display='disabled';
                                        if($sr) {
                                            if(($sr->bacess)-1 == 8) $display='';
                                        }
                                        ?>
                                        <div>
                                            <div>
                                                <h5 class="font-size-15">Staff IT : </h5>
                                                <div class="mb-3">
                                                    <label class="d-none form-label" for="user_it"><span class="visually-hidden">Pilih Pelaksana</span></label>
                                                    <select id="user_it" class="w-50 form-select" <?=$display?>>
                                                        <option>Select</option>
                                                        <?php $merge_arr = array_merge($list_itinfra,$list_itsystem);
                                                        foreach($merge_arr as $row):?>
                                                        <option value="<?=$row['id']?>" <?=$detail->userid_itadmin == $row['id'] ? 'selected':''?>><?php echo $row['fullname'];?></option>
                                                    <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class=" form-label" for="urgency">Status Pengerjaan</label>
                                                    <select id="urgency" class="w-50 form-select" <?=$display?>>
                                                        <option>Select</option>
                                                        <option value="urgent" <?=$detail->urgency == 'urgent' ? 'selected':''?>>Urgent</option>
                                                        <option value="normal" <?=$detail->urgency == 'normal' ? 'selected':''?>>Normal</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 <?=$display=='disabled' ? 'd-none' : ''?>">
                                                    <button type="button" class="btn btn-success waves-effect waves-light mr-1" id="approvehelpdesk"><i class="fa fa-check"></i> Approve </button>

                                                    <button type="button" class="btn btn-warning waves-effect waves-light mr-1" id="rejectticket" <?=getWfAuthByUserid('rejhelpdesk',$detail->recordstatus)!=NULL ? '' : 'disabled="disabled"' ?>><i class="fa fa-times"></i> Reject/ Cancel Ticket</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php $writereview = [4,5,6]; $writeconfirm=[9,10,11];
                                ?>
                                <div class="mt-2 d-flex justify-content-end flex-column <?php if(!in_array($detail->recordstatus,$writereview)) echo 'd-none'?>">
                                    Write Review
                                    <?=form_open('resp-helpdesk/submit/review')?>
                                    <textarea class="form-control" rows="3" cols="5" aria-label="Feedback" name="form_review" <?=$detail->recordstatus==5 ? 'readonly' : ''?>></textarea><button type="submit" class="w-25 mt-2 btn-review btn btn-primary" role="button" <?=$detail->recordstatus==5 ? 'disabled' : ''?>>Submit Review</button>
                                    <?=form_hidden('helpdeskid',$detail->helpdeskid);?>
                                    <?=form_hidden('status',$detail->recordstatus);?>
                                    <?=form_close()?>
                                </div>
                                <hr/>
                                <div class="mt-2 d-flex justify-content-end flex-column <?php if(!in_array($detail->recordstatus,$writeconfirm)) echo 'd-none'?>">
                                    <?=form_open('resp-helpdesk/submit/confirm')?>
                                    <div class="row">          
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="form-confirm-input">Konfirmasi ke User :</label>
                                                <textarea class="form-control" rows="3"  aria-label="Confirmation" id="form-confirm-input" name="form_confirm" placeholder="Teks konfirmasi pengerjaan IT"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="form-type-helpdesk">Jenis Helpdesk :</label>
                                                <div class="form-group">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="helpdesktype" id="system-error" value="system" <?=($detail->helpdesktype=='system' ? 'checked' : '')?> required>
                                                        <label class="form-check-label" for="system-error">System Error</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="helpdesktype" id="hardware-error" value="hardware" <?=($detail->helpdesktype=='hardware' ? 'checked' : '')?> required>
                                                        <label class="form-check-label" for="hardware-error">Hardware Error</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="helpdesktype" id="human-error" value="human" <?=($detail->helpdesktype=='human' ? 'checked' : '')?> required>
                                                        <label class="form-check-label" for="human-error">Human Error</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="helpdesktype" id="service" value="service" <?=($detail->helpdesktype=='service' ? 'checked' : '')?> required>
                                                        <label class="form-check-label" for="service">Service IT</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="helpdesktype" id="others" value="others" required>
                                                        <label class="form-check-label" for="others">Others</label>
                                                    </div>
                                                </div>
                                                <input class="mx-4 mt-3 form-control w-75 helpdesktype-input d-none" type="text" name="helpdesktype-input" aria-label="others-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">          
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="form-problem-input">Penjelasan Pengerjaan</label>
                                                <textarea class="form-control" id="form-problem-input" placeholder="Penjelasan mengapa terjadi kesalahan / permintaan helpdesk [opsional]" rows="4" name="form-problem" <?=($detail->recordstatus==12 ? 'readonly':'')?>><?=$detail->resp_text?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="form-reason-input">Alasan </label>
                                                <textarea class="form-control" id="form-reason-input" placeholder="Alasan / penyebab terjadi kesalahan/bantuan [opsional]" rows="4" name="form-reason" <?=($detail->recordstatus==12 ? 'readonly':'')?>><?=$detail->resp_reason?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="form-recommend-input">Rekomendasi / saran</label>
                                        <textarea class="form-control" id="form-recommend-input" placeholder="Rekomendasi dari team IT [jika diperlukan]" rows="4" name="form-recommend" <?=($detail->recordstatus==12 ? 'readonly':'')?>><?=$detail->resp_recommendation?></textarea>
                                    </div>
                                    <button type="submit" class="w-25 mt-2 btn btn-primary btnConfirm" role="button">Submit Confirmation</button>
                                    <?=form_hidden('helpdeskid',$detail->helpdeskid);?>
                                    <?=form_hidden('status',$detail->recordstatus);?>
                                    <?=form_close()?>
                                </div>
                                <div class="py-2 mt-3">
                                    <h5 class="font-size-15">Feedback &amp; Confirmation</h5>
                                </div>
                                <?=$detail->feedback!=0 ? '<hr>' : ''?>
                                <div class="mt-2 feedback-section <?=$detail->feedback==0 ? 'd-none' : ''?>">
                                    <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Feedback</h5>
                                    <div>
                                        <?php if($detail->feedback):
                                            $i=1;
                                            foreach($feedback as $row):
                                        ?>
                                        <div class="d-flex py-3 <?=$i>=2 ? 'border-top' : ''?>">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                        <i class="bx bxs-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-1"><?=$row->fullname?> <small class="text-muted float-end"><?=date('d/m/Y H:i',strtotime($row->created_at))?></small></h5>
                                                <p class="text-muted"><?=$row->responsetext?></p>
                                            </div>
                                        </div>
                                        <?php $i++;
                                        endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <?=$detail->confirm!=0 ? '<hr>' : ''?>
                                <div class="mt-2 confirm-section <?=$detail->confirm==0 ? 'd-none' : ''?>">
                                    <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Confirmation</h5>
                                    <div>
                                        <?php if($detail->confirm):
                                            $i=1;
                                            foreach($confirm as $row):
                                        ?>
                                        <div class="d-flex py-3">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                        <i class="bx bxs-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-1"><?=$row->fullname?> <small class="text-muted float-end"><?=date('d/m/Y H:i',strtotime($row->created_at))?></small></h5>
                                                <p class="text-muted"><?=$row->responsetext?></p>
                                                
                                            </div>
                                        </div>
                                        <?php $i++;
                                        endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                
                                <?php if(count($confirm)>0):?>
                                <div class="mt-2 confirm-section <?=$detail->helpdesktype=='' ? 'd-none' : ''?>">
                                    <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Notes from IT</h5>
                                    <div>
                                        <div class="d-flex py-3">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                        <i class="bx bxs-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-1"><?=$confirm[0]->fullname?><small class="text-muted float-end"><?=date('d/m/Y H:i',strtotime($confirm[0]->created_at))?></small></h5>
                                                <strong>Penjelasan / Problem : </strong>
                                                <p class="text-muted"><?=$detail->resp_text?></p>
                                                <strong>Alasan / Penyebab: </strong>
                                                <p class="text-muted"><?=$detail->resp_reason?></p>
                                                <strong>Saran / Tindak Lanjut : </strong>
                                                <p class="text-muted"><?=$detail->resp_recommendation?></p>
                                                <strong>Jenis Kesalahan : </strong>
                                                <p class="text-muted"><?=$detail->helpdesktype?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif?>
                                <div class="d-print-none mt-3">
                                    <div class="float-end <?=$display!='disabled' ? 'd-none' : ''?>">
                                        <button type="button" class="btn btn-success waves-effect waves-light mr-1 <?=$detail->recordstatus<9 ? '' : 'd-none'?>" id="approveticket" <?=getWfAuthByUserid('apphelpdesk',$detail->recordstatus)!=NULL ? '' : 'disabled="disabled"' ?>><i class="fa fa-check"></i> Approve </button>

                                        <button type="button" class="btn btn-warning waves-effect waves-light mr-1 <?=$detail->recordstatus<9 ? '' : 'd-none'?>" id="rejticket" <?=getWfAuthByUserid('rejhelpdesk',$detail->recordstatus)!=NULL ? '' : 'disabled="disabled"' ?>><i class="fa fa-times"></i> Reject/ Cancel Ticket</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
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

<script src="<?=base_url()?>/public/assets/js/app.js"></script>
<script src="<?=base_url()?>/public/assets/js/helpdesk/resp_detail.js"></script>
<script>
    const review = document.querySelector('textarea[name="form_review"]')
    const btnreview = document.querySelector('.btn-review')
    const othersOpt = document.querySelector('input[id="others"]')
    const handleRadio = () => {
        if(othersOpt.checked) inputForm.classList.remove('d-none')
        else inputForm.classList.add('d-none')
    }
    const radioOpt = document.querySelectorAll('input[name="helpdesktype"]')
    radioOpt.forEach(btn => {
        btn.addEventListener('change',handleRadio)
    })
    const inputForm = document.querySelector('.helpdesktype-input')
    
    if(review.hasAttribute('readonly'))  review.style.cursor = 'not-allowed'
    if(appBtn.hasAttribute('disabled'))  {
        appBtn.style.cssText = 'cursor: not-allowed; pointer-events:all'
    }
    if(rejBtn.hasAttribute('disabled'))  {
        rejBtn.style.cssText = 'cursor: not-allowed; pointer-events:all'
    }
    
</script>
</body>

</html>