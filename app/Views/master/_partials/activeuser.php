<div class="modal" id="<?=$id?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?=$id?>Label" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?=$id?>Label"><?=$title?> <div id="namauser"></div></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <h3 class="confirmtext"></h3>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary approveUser"><?=lang('Files.Yes')?></button>
      </div>
    </div>
  </div>
</div>