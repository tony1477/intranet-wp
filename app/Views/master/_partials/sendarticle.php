<div class="modal" id="<?=$id?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?=$id?>Label" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?=$id?>Label"><?=$title?> <div id="namauser"></div></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <form > -->
        <div class="row">
          <div class="col-md-12">
            <div>                          
              <div class="form-check mb-3">
                  <input type="hidden" name="idarticle" value="">
                  <input class="form-check-input" type="radio" name="formRadios" id="formRadios1" checked="" value="subs">
                  <label class="form-check-label" for="formRadios1">Email Subscription</label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="formRadios" id="formRadios2" value="custom">
                  <label class="form-check-label" for="formRadios2">Custom Email</label>
              </div>
              <div class="mt-3 customemail" style="display:none">
                <input class="form-control" id="custom-email" type="text" value="" placeholder="" />
              </div>
            </div>
          </div>
        <!-- </form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="savedata()">Send Subscription</button>
      </div>
    </div>
  </div>
</div>