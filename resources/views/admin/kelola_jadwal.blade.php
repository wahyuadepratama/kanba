@extends('layout.core_admin')

@section('title','Kelola Jadwal')

@section('active-jadwal','active')

@section('css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">
@endsection

@section('content')

@if (session('success'))
<small><div class="alert alert-success"> {{ session('success') }} </div></small>
@endif

<!-- Page Heading -->
<h1 class="h4 mb-2 text-gray-800"><i class="fas fa-calendar-day"></i> &nbsp; Kelola Jadwal</h1>
<div class="row">
  <div class="col">
    <a class="btn btn-success btn-icon-split btn-sm float-right" href="#">
       <span class="icon text-white-50">
        <i class="fas fa-file-download"></i>
       </span>
       <span class="text">Download Excel</span>
     </a>
  </div>
</div>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-3 offset-md-6">
        <select class="form-control btn-sm" id="exampleFormControlSelect1">
          <option>2019</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-control btn-sm" id="exampleFormControlSelect1">
          <option>November</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
    </div>
    <br>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bapak Asuh</th>
            <th>Anak Asuh</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1 @endphp
          @foreach($coach as $c)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $c->name }}</td>
              <td>
                <ul>
                  @php $find = false @endphp
                  @forelse($relationship as $r)
                    @if($r->coach_nik == $c->nik)
                      <li>

                        {{ $r->trainee->name }}

                        @php $found = false @endphp
                        @forelse($schedule as $s)
                          @if($s->relationship_id == $r->id)
                            @if($s->status == "ongoing")
                              <b class="text text-danger">({{ $s->datetime }})</b>
                            @else
                              <b class="text text-success">({{ $s->actual }})</b>
                            @endif
                            @php $found = true @endphp
                          @endif
                        @empty
                        @endforelse

                        @if($found == false)
                          <b class="text text-warning">(Belum dibuat!)</b>
                        @endif

                      </li>
                      @php $find = true @endphp
                    @endif
                  @empty
                  @endforelse

                  @if($find == false)
                    <p>Belum ada anak asuh !</p>
                  @endif
                </ul>
              </td>
              <td>
                <a class="btn btn-google btn-sm" href="{{ url('/admin/kelola-jadwal/reminder-otomatis/'. $c->nik) }}">
                  Reminder Otomatis</a>
                <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#remindermanual" onclick="manual('{{ $c->nik }}')">
                  Reminder Manual</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection


@section('javascript')

@include('admin.modal.send_reminder')

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('vendor/taginputs/tagsinput.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript">
  function manual(id) {
    $('#sendManualButton').attr('onclick', 'sendManual(\''+ id +'\')');
  }

  function sendManual(id) {
    var text = $('#dataTextWhatsapp').val();
    $.ajax({ /* THEN THE AJAX CALL */
      url: '/admin/kelola-jadwal/reminder-manual',
      method : "POST",
      data:{'nik': id, 'text': text, _token: '{{csrf_token()}}'},
      async : true,
      success: function(data){
        swal({
          icon: "success",
          text: "Pesan berhasil dikirim! Harap menunggu beberapa menit jika pesan belum masuk.",
          buttons: false,
          timer: 3000
        });
      }
    });
  }
</script>

@endsection
