<!-- Modal -->


<div class="modal fade" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="uploadPhotoTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadPhotoTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('coach-status/upload') }}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">

                @csrf
                <label>Materi Coaching:</label>
                <div class="form-group">
                  <div class="file-upload">
                      <div class="file-select">
                        <!-- <div class="file-select-button" id="fileName">Choose File</div> -->
                        <!-- <div class="file-select-name" id="noFile">No file chosen...</div>
                        <input type="file" name="file" id="chooseFile" required> -->
                        <input type="text" name="description" placeholder="Contoh: Implementasi dasar K3 yang benar" class="form-control">
                      </div>
                    </div>
                </div>

                <input type="hidden" name="id" id="no_id">

                <label>Jadwal Actual:</label>
                <div class="form-group">
                  <div class="input-group date" id="datetimepicker11" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" id="jadwal" data-target="#datetimepicker11" name="schedule" required/>
                      <div class="input-group-append" data-target="#datetimepicker11" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="form-control btn btn-sm btn-success">Konfirmasi Pelaksanaan</button>
                </div>

                <input type="hidden" name="id" id="idhidden">

            </div>
          </div>
      </form>
    </div>
  </div>
</div>
