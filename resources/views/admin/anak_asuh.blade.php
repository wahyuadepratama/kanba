@extends('layout.core_admin')

@section('title','Data Anak Asuh')

@section('active-anak','active')

@section('css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h4 mb-2 text-gray-800"><i class="fas fa-users"></i>&nbsp; Data Anak Asuh</h1>
<div class="row">
  <div class="col">
    <a class="btn btn-primary btn-sm btn-icon-split float-right" href="#" data-toggle="modal" data-target="#addAnakAsuh">
       <span class="icon text-white-50">
         <i class="fas fa-plus"></i>
       </span>
       <span class="text">Anak Asuh</span>
     </a>
  </div>
</div>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <!-- <div class="card-header py-3">
    <button type="button" name="button">Load All Data</button>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered mycustom" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Anak Asuh</th>
            <th>NIK</th>
            <th>Bergabung Sejak</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tableCoach">
          @php $no=1 @endphp
          @forelse($trainee as $c)
          <tr>
            <td data-th="No  &#xa;">{{ $no++ }}</td>
            <td data-th="Nama Anak Asuh &#xa;">{{ $c->name }}</td>
            <td data-th="NIK  &#xa;">{{ $c->nik }}</td>
            <td data-th="Bergabung Sejak  &#xa;">{{ \Carbon\Carbon::parse($c->created_at)->diffForHumans() }}</td>
            <td>
              <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm('{{ $c->nik }}', '{{ $c->name }}')"> Hapus</a>
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

@include('admin.modal.add_anak_asuh')
@include('admin.modal.edit_anak_asuh')


<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('vendor/taginputs/tagsinput.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript">

  $( document ).ready(function() {
    console.log( "ready!" );
  });

  function storeTrainee() {
    var name = $('#name').val();
    var nik = $('#nik').val();
    var phone = $('#phone').val();

    if (name == "" || nik == "") {
      swal({
        icon: "warning",
        text: "Nama dan NIK tidak boleh kosong!",
        buttons: false,
        timer: 2000
      });
    }else {
      swal({
        text: "Please waiting...",
        buttons: false
      });

      $('#name').val('');
      $('#nik').val('');

      $.ajax({ /* THEN THE AJAX CALL */
        url: "/admin/anak-asuh/store",
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
  }

  function showModal(name, nik, phone) {
    $('#editname').val(name);
    $('#editnik').val(nik);
    $('#editphone').val(phone);
    $('#savedata').attr('onclick', 'updateCoach(\''+nik+'\')');
  }

  function updateCoach(currentNik) {
    var name = $('#editname').val();
    var nik = $('#editnik').val();
    var phone = $('#editphone').val();

    if (name == "" || nik == "") {
      swal({
        icon: "warning",
        text: "Nama dan NIK tidak boleh kosong!",
        buttons: false,
        timer: 2000
      });
    }else{
      swal({
        text: "Please waiting...",
        buttons: false
      });

      $('#editname').val('');
      $('#editnik').val('');
      $('#editphone').val('');

      $.ajax({ /* THEN THE AJAX CALL */
        url: "/admin/anak-asuh/update",
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
  }

  function destroyConfirm(nik, name){
    swal({
      title: "Apakah kamu yakin?",
      text: "Menghapus data anak asuh "+name+" akan menghapus semua jadwal yang pernah dibuat oleh bapak asuh ini.",
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

  function destroyTrainee(nik) {
    swal({
      text: "Please waiting...",
      buttons: false
    });

    $.ajax({ /* THEN THE AJAX CALL */
      url: "/admin/anak-asuh/destroy/"+ nik,
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
