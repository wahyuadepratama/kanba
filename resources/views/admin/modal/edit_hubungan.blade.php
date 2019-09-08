<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update Anak Asuh</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdate" action="" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Data anak asuh</label>
                <select id="traineeData" class="js-example-basic-multiple" style="width: 100% !important" name="trainee[]" multiple="multiple">
                  @forelse(\App\Models\User::where('role_id', 3)->orWhere('role_id', 2)->get(); as $trainee)
                  <option value="{{ $trainee->nik }}">{{ $trainee->name }} ({{ $trainee->nik }})</option>
                  @empty
                  <p>Belum ada anak asuh !</p>
                  @endforelse
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" data-dismiss="modal" id="saveChanges" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
