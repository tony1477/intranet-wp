<div class="modal fade" id="detailnotulen" aria-hidden="true" aria-labelledby="detailNotulenLabel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" data-notulenid="">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailNotulenLabel"><?=lang('Files.Notulen_Detail')?></h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <form name="detailnotulen" onsubmit="return false;" >
            <div class="mb-3 row">
                <label for="agendaInput" class="col-form-label col-sm-3"><?=lang('Files.Agenda_Topic_Others')?></label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="agendaInput" rows="3" name="agenda" required></textarea>
                    <input type="hidden" name="headerid" id="headerid" value="">
                    <input type="hidden" name="detailid" id="detailid" value="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-3"><?=lang('Files.Classification')?></label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="klasifikasi" id="pk-choice" value="1" required>
                        <label class="form-check-label" for="pk-choice"><?=lang('Files.PK')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="klasifikasi" id="utl-choice" value="2" required>
                        <label class="form-check-label" for="utl-choice"><?=lang('Files.UTL')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="klasifikasi" id="si-choice" value="3" required>
                        <label class="form-check-label" for="si-choice"><?=lang('Files.SI')?></label>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="dariInput" class="col-form-label col-sm-3"><?=lang('Files.From')?></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control w-50" id="dariInput" name="pic_dari" required />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="untukInput" class="col-form-label col-sm-3"><?=lang('Files.To')?></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control w-50" id="untukInput" name="pic_untuk" required />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="untukTanggal" class="col-form-label col-sm-3"><?=lang('Files.Feedback_Date')?></label>
                <div class="col-sm-9">
                    <input type="date" class="form-control w-50" id="untukTanggal" name="tanggal_fu" required />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="agendaKeterangan" class="col-form-label col-sm-3"><?=lang('Files.Description')?></label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="agendaKeterangan" rows="3" name="keterangan"></textarea>
                </div>
            </div>
            <div class="mb-3 mx-3 d-flex justify-content-end gap-3">
                <button class="btn btn-primary justify-content-end submitnotes" type="submit">Submit</button>
                <button class="d-none btn btn-secondary justify-content-end cancelnotes" type="button">Cancel Edit</button>
                <button class="d-none btn btn-primary justify-content-end updatenotes" type="submit">Update</button>
            </div>
        </form>
        <hr class="mt-5"/>
        <!-- <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
        </table> -->
        <table id="dt-detailNotulen" class="table table-bordered dt-responsive w-100">
            <thead>
                <tr>
                    <th><?=lang('Files.Number')?></th>
                    <th><?=lang('Files.Action')?></th>
                    <th><?=lang('Files.Id')?></th>
                    <th><?=lang('Files.Agenda')?></th>
                    <th><?=lang('Files.Classification')?></th>
                    <th><?=lang('Files.From')?></th>
                    <th><?=lang('Files.To')?></th>
                    <th><?=lang('Files.Date')?></th>
                    <th><?=lang('Files.Description')?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <!-- <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button class="btn btn-primary" data-bs-target="#editNotulen_Meeting" data-bs-toggle="modal" data-bs-dismiss="modal"><?=lang('Files.Back')?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="feedbackModalLabel"><?=lang('Files.Feedback_Detail')?></h5>
      </div>
      <div class="modal-body">
        <form name="feedbackform" onsubmit="return false;">
            <div class="mb-3 row">
                <label for="agendafeedback" class="col-form-label col-sm-3"><?=lang('Files.Agenda_Topic_Others')?></label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="agendafeedback" rows="3" name="keteranganfeedback" disabled></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="statusFeedback" class="col-form-label col-sm-3"><?=lang('Files.Status')?></label>
                <div class="col-sm-9">
                    <select class="form-select" aria-label=".form-select" id="statusFeedback">
                        <option value="1">Done</option>
                        <option value="2">Pending</option>
                        <option value="3">Cancel</option>
                    </select>
                    <input type="hidden" name="detailid" id="detailid" value="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="keteranganFeedback" class="col-form-label col-sm-3"><?=lang('Files.Description').'/'.lang('Files.Note')?></label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="keteranganFeedback" rows="3" name="keteranganfeedback" required></textarea>
                </div>
            </div>
            <div class="mb-3 mx-3 d-flex justify-content-end gap-3">
                <button class="btn btn-primary justify-content-end submitfeedback" type="submit">Submit</button>
            </div>
        </form>
      </div>
      <div class="modal-footer">

        <button class="btn btn-primary" data-bs-target="#detailnotulen" data-bs-toggle="modal" data-bs-dismiss="modal"><?=lang('Files.Back')?></button>
      </div>
    </div>
  </div>
</div>