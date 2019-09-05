<!-- Modal -->
<div class="modal fade" id="remindermanual" tabindex="-1" role="dialog" aria-labelledby="remindermanual" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="remindermanualtittle">Send Message Manual</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdate" action="" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Tulis pesan anda</label>
                <textarea id="dataTextWhatsapp" name="name" rows="8" cols="80" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" data-dismiss="modal" onclick="" id="sendManualButton" class="btn btn-primary">Send Message via Whatsapp</button>
        </div>
      </form>
    </div>
  </div>
</div>
