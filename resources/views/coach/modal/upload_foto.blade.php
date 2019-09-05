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

      <div class="modal-body">
        <div class="form-group">
          <form action="{{ url('coach-status/upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <div class="input-group-prepend">
                <button type="submit" class="input-group-text">Upload</button>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" name="file"
                  aria-describedby="inputGroupFileAddon01" required accept="image/*" capture>
                <label class="custom-file-label" for="inputGroupFile01"></label>
              </div>
            </div><br>
            <div class="form-group">
              <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                 <input type="date" id="jadwal" class="form-control datetimepicker-input" placeholder="Actual Coaching" required name="schedule"/>                 
               </div>
             </div>
            <input type="hidden" name="id" value="{{ $t->id }}">
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="addButton" type="button" class="btn btn-primary" data-dismiss="modal">Tambahkan</button>
      </div>

    </div>
  </div>
</div>
