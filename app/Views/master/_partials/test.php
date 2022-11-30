<div class="modal" id="<?=$id?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?=$id?>Label" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?=$id?>Label"><?=$title?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
          <div class="col-xs-5 col-md-5">
              <select name="from[]" id="search" class="form-control fromuserbydoc" size="8" multiple="multiple">
                  <!-- <option value="">--</option> -->
              </select>
          </div>
    
          <div class="col-xs-2 col-md-2">
              <button type="button" id="search_rightAll" class="btn btn-block"><i class=" fas fa-forward"></i></button>
              <button type="button" id="search_rightSelected" class="btn btn-block"><i class="fas fa-chevron-right"></i></button>
              <button type="button" id="search_leftSelected" class="btn btn-block"><i class="fas fa-chevron-left"></i></button>
              <button type="button" id="search_leftAll" class="btn btn-block"><i class="fas fa-backward"></i></button>
          </div>
    
          <div class="col-xs-5 col-md-5">
              <select name="to[]" id="search_to" class="form-control touserbydoc" size="8" multiple="multiple"></select>
          </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="savedata()">Save changes</button>
      </div>
    </div>
  </div>
</div>