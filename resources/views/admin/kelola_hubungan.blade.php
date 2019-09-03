@extends('layout.core_admin')

@section('title','Kelola Hubungan')

@section('active-hubungan','active')


@section('css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

@if (session('success'))
<small><div class="alert alert-success"> {{ session('success') }} </div></small>
@endif

<!-- Page Heading -->
<h4 class="h4 mb-2 text-gray-800"><i class="fas fa-handshake"></i> &nbsp; Kelola Hubungan</h4>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Bapak Asuh</th>
            <th>No WhatsApp</th>
            <th>Anak Asuh</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1 @endphp
          @foreach($coach as $d)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $d->nik }}</td>
              <td>{{ $d->name }}</td>
              <td>{{ $d->phone }}</td>
              <td>
                <ul>
                  @forelse(\App\Models\CoachTrainee::where('coach_nik', $d->nik)->get(); as $trainee)
                  <li>{{ $trainee->trainee->name }}</li>
                  @empty
                  <p>Belum ada anak asuh !</p>
                  @endforelse
                </ul>
              </td>
              <td>
                <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm('{{ $d->nik }}', '{{ $d->name }}')" ><i class="fas fa-trash"></i> Hapus</a>
                <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter"
                  onclick="updateTrainee('{{ $d->nik }}')"><i class="fas fa-user-edit"></i> Update</a>
                <hr class="d-md-none">
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

@include('admin.modal.edit_hubungan')

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
  function destroyConfirm(nik, name){
    swal({
      title: "Apakah kamu yakin?",
      text: "Menghapus anak asuh juga akan ikut menghapus semua jadwal yang pernah mereka buat bersama bapak asuh "+ name,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        destroyTrainee(nik);
      }
    });
  }

  function destroyTrainee(nik){
    $.ajax({ /* THEN THE AJAX CALL */
      url: "/admin/kelola-hubungan/destroy/"+ nik,
      method : "GET",
      async : true,
      dataType : 'text',
      success: function(data){
        $('#dataTable').dataTable().fnClearTable();
        $('#dataTable').DataTable().destroy();
        $('#dataTable').find('tbody').append(data);
        $('#dataTable').DataTable().draw();
        swal({
          icon: "success",
          text: "Penghapusan berhasil !",
          buttons: false,
          timer: 2000
        });
      }
    });
  }

  function updateTrainee(nik) {
    $.ajax({ /* THEN THE AJAX CALL */
      url: "/admin/kelola-hubungan/trainee/get",
      method : "POST",
      data:{'nik': nik, _token: '{{csrf_token()}}'},
      async : true,
      success: function(data){
        $('#traineeData').val(data).trigger('change');
        $('#saveChanges').attr('onclick', 'storeUpdate(\''+ nik +'\')');
      }
    });
  }

  function storeUpdate(nik) {
    var trainee = $('#traineeData').val();
    $.ajax({ /* THEN THE AJAX CALL */
      url: '/admin/kelola-hubungan/update'+ '/' + nik,
      method : "POST",
      data:{'trainee': trainee, 'nik': nik, _token: '{{csrf_token()}}'},
      async : true,
      success: function(data){
        $('#dataTable').dataTable().fnClearTable();
        $('#dataTable').DataTable().destroy();
        $('#dataTable').find('tbody').append(data);
        $('#dataTable').DataTable().draw();
        swal({
          icon: "success",
          text: "Update data berhasil!",
          buttons: false,
          timer: 2000
        });
      }
    });
  }

  $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
  });
</script>

@endsection
