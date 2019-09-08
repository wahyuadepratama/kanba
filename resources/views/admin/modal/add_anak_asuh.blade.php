<!-- Modal -->
<div class="modal fade" id="addAnakAsuh" tabindex="-1" role="dialog" aria-labelledby="addAnakAsuhTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAnakAsuhTitle">Tambah Anak Asuh Baru </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="index.html" method="post">
      <div class="modal-body">
          <div class="form-group">
            <input class="form-control" type="text" required id="name" placeholder="Nama"/>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" required id="nik" placeholder="NIK"/>
          </div>
          <div class="form-group">
            <input class="form-control" type="number" required id="phone" placeholder="No WhatsApp | Format: +628******* | Optional"/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="storeTrainee()" data-dismiss="modal">Tambahkan</button>
      </div>
      </form>
    </div>
  </div>
</div>
