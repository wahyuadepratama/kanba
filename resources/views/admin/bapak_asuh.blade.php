@extends('layout.core_admin')

@section('title','Data Bapak Asuh')

@section('active-bapak','active')

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
<h1 class="h4 mb-2 text-gray-800"><i class="fas fa-user-tie"></i> &nbsp; Data Bapak Asuh</h1>
<div class="row">
  <div class="col">
    <a class="btn btn-primary btn-sm btn-icon-split float-right" href="#" data-toggle="modal" data-target="#addBapakAsuh">
       <span class="icon text-white-50">
         <i class="fas fa-plus"></i>
       </span>
       <span class="text">Bapak Asuh</span>
     </a>
  </div>
</div>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered mycustom" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bapak Asuh</th>
            <th>NIK</th>
            <th>No WhatsApp</th>
            <th>Bergabung Sejak</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tableCoach">
          @php $no=1 @endphp
          @forelse($coach as $c)
          <tr>
            <td data-th="No  &#xa;">{{ $no++ }}</td>
            <td data-th="Nama  &#xa;">{{ $c->name }}</td>
            <td data-th="NIK  &#xa;">{{ $c->nik }}</td>
            <td data-th="No. WhatsApp  &#xa;">{{ $c->phone }}</td>
            <td data-th="Bergabung Sejak  &#xa;">{{ \Carbon\Carbon::parse($c->created_at)->diffForHumans() }}</td>
            <td>
              <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm('{{ $c->nik }}', '{{ $c->name }}')">Hapus</a>
              <a class="btn btn-warning btn-sm" href="#" onclick="showModal('{{ $c->name }}', '{{ $c->nik }}', '{{ $c->phone }}')" data-toggle="modal" data-target="#editBapakAsuh">Edit</a>
<hr class="d-md-none">
            </td>
          </tr>
          @empty
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('javascript')

@include('admin.modal.add_bapak_asuh')
@include('admin.modal.edit_bapak_asuh')

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

  function storeCoach() {
    swal({
      text: "Please waiting...",
      buttons: false
    });

    var name = $('#name').val();
    var nik = $('#nik').val();
    var phone = $('#phone').val();
    $('#name').val('');
    $('#nik').val('');
    $('#phone').val('');

    $.ajax({ /* THEN THE AJAX CALL */
      url: "/admin/bapak-asuh/store",
      method : "POST",
      data:{'name': name, 'nik': nik, 'phone': phone, _token: '{{csrf_token()}}'},
      async : true,
      dataType : 'text',
      success: function(data){
        $('#dataTable').dataTable().fnClearTable();
        $('#dataTable').DataTable().destroy();
        $('#dataTable').find('tbody').append(data);
        $('#dataTable').DataTable().draw();
        swal({
          icon: "success",
          text: "Data baru berhasil ditambahkan !",
          buttons: false,
          timer: 2000
        });
      }
    });
  }

  function showModal(name, nik, phone) {
    $('#editname').val(name);
    $('#editnik').val(nik);
    $('#editphone').val(phone);
    $('#savedata').attr('onclick', 'updateCoach(\''+nik+'\')');
  }

  function updateCoach(currentNik) {
    swal({
      text: "Please waiting...",
      buttons: false
    });

    var name = $('#editname').val();
    var nik = $('#editnik').val();
    var phone = $('#editphone').val();
    $('#editname').val('');
    $('#editnik').val('');
    $('#editphone').val('');

    $.ajax({ /* THEN THE AJAX CALL */
      url: "/admin/bapak-asuh/update",
      method : "POST",
      data:{'current': currentNik, 'name': name, 'nik': nik, 'phone': phone, _token: '{{csrf_token()}}'},
      async : true,
      dataType : 'text',
      success: function(data){
        $('#dataTable').dataTable().fnClearTable();
        $('#dataTable').DataTable().destroy();
        $('#dataTable').find('tbody').append(data);
        $('#dataTable').DataTable().draw();
        swal({
          icon: "success",
          text: "Data berhasil diupdate !",
          buttons: false,
          timer: 2000
        });
      }
    });
  }

  function destroyConfirm(nik, name){
    swal({
      title: "Apakah kamu yakin?",
      text: "Menghapus data bapak asuh "+name+" akan menghapus semua jadwal yang pernah dibuat oleh bapak asuh ini.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        destroyCoach(nik);
      }
    });
  }

  function destroyCoach(nik) {
    swal({
      text: "Please waiting...",
      buttons: false
    });

    $.ajax({ /* THEN THE AJAX CALL */
      url: "/admin/bapak-asuh/destroy/"+ nik,
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
</script>

@endsection
