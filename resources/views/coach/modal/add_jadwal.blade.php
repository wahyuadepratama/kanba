<!-- Modal -->
<div class="modal fade" id="addJadwal" tabindex="-1" role="dialog" aria-labelledby="addJadwalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addJadwalTitle">Buat Jadwal (November) </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="index.html" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Pilih Bapak Asuh</label>
          <select class="form-control" id="exampleFormControlSelect1">
            <option disabled selected>Nama Bapak Asuh</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="form-group">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Jadwal</label>
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                 <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                 <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                     <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                 </div>
             </div>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Tambahkan</button>
      </div>
    </form>
    </div>
  </div>
</div>
