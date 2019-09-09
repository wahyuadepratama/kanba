<!-- Modal -->
<div class="modal fade" id="addJadwal" tabindex="-1" role="dialog" aria-labelledby="addJadwalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addJadwalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="index.html" method="post" id="scheduleForm">
      <div class="modal-body">
        <div class="form-group">
          <!-- <input id="jadwals" placeholder="Actual Coaching" class="form-control" type="date" required name="schedule"> -->
          <div class="input-group date" id="datetimepicker11" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" id="jadwals" data-target="#datetimepicker11"/>
              <div class="input-group-append" data-target="#datetimepicker11" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="addButton" type="button" class="btn btn-primary" data-dismiss="modal">Tambahkan</button>
      </div>
    </form>
    </div>
  </div>
</div>
