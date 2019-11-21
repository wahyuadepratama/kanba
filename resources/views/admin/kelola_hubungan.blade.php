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
<div class="card shadow">
  <div class="card-body">
    <p>Keterangan:</p>
    <ul>
      <li>Pilih bulan dan tahun sebelum memasukan data anak asuh</li>
      <li>Pilih <b>update</b> untuk menambahkan anak asuh sesuai dengan bapak asuhnya</li>
      <li><b>Tambah Data</b> digunakan untuk menjadikan anak asuh sebagai bapak asuh sehingga dapat dibuatkan jadwalnya</li>
    </ul>
  </div>
</div><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
      <div class="row">
        <div class="col-md-2">
          <button type="button" class="btn btn-sm btn-primary form-control" data-toggle="modal" data-target="#exampleModal">+ Tambah Data</button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form action="{{ url('/admin/kelola-hubungan/store') }}" method="post">@csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Bapak Asuh</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <select name="coach" class="js-example-basic-single form-control" style="width: 100% !important" name="state">
                    @foreach($trainee as $tr)
                    <option value="{{ $tr->nik }}">{{ $tr->name }} ({{ $tr->nik }})</option>
                    @endforeach
                  </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-2 offset-md-6">
          <select class="form-control btn-sm" id="month" onchange="changeYearMonth()">
            <option value="1">Januari</option>
            <option value="2">Febuari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>
        <div class="col-md-2">
          <select class="form-control btn-sm" id="year" onchange="changeYearMonth()">
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
          </select>
        </div>
    </div><br>

    <div class="table-responsive">
      <table class="table table-bordered mycustom" id="dataTable" width="100%" cellspacing="0">
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
              <td data-th="No  &#xa;">{{ $no++ }}</td>
              <td data-th="NIK  &#xa;">{{ $d->nik }}</td>
              <td data-th="Nama Bapak Asuh  &#xa;">{{ $d->name }}</td>
              <td data-th="No WhatsApp  &#xa;">{{ $d->phone }}</td>
              <td data-th="Anak Asuh  &#xa;">
                <ul>
                  {!! $d->trainee_result !!}
                </ul>
              </td>
              <td>
                <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter"
                  onclick="updateTrainee('{{ $d->nik }}')">Update</a>
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

  swal({
    text: "Sinkronisasi data ...",
    buttons: false,
    timer: 5000
  });

  function updateTrainee(nik) {

    swal({
      text: "Sinkronisasi data ...",
      buttons: false,
      timer: 2000
    });

    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({ /* THEN THE AJAX CALL */
      url: "/admin/kelola-hubungan/trainee/get",
      method : "POST",
      data:{'nik': nik, 'month': month, 'year': year , _token: '{{csrf_token()}}'},
      async : true,
      success: function(data){

        $("#traineeData option:selected").remove();
        for (var i = 0; i < data[1].length; i++) {
          $('#traineeData').append( '<option value="'+data[0][i]+'">'+data[1][i]+'</option>' );
        }
        $('#traineeData').val(data[0]).trigger('change');
        $('#saveChanges').attr('onclick', 'storeUpdate(\''+ nik +'\')');
      }
    });
  }

  function storeUpdate(nik) {
    var trainee = $('#traineeData').val();
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({ /* THEN THE AJAX CALL */
      url: '/admin/kelola-hubungan/update'+ '/' + nik,
      method : "POST",
      data:{'trainee': trainee, 'month': month, 'year': year, 'nik': nik, _token: '{{csrf_token()}}'},
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

  function changeYearMonth() {
    var month = $('#month').val();
    var year = $('#year').val();
    window.location.href = "/admin/kelola-hubungan?month="+month+"&year="+year;
  }

  $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
  });

  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });

  @if($_GET)
    $('#month').val("{{ $_GET['month'] }}");
    $('#year').val("{{ $_GET['year'] }}");
  @else
    var d = new Date();
    $('#month').val(d.getMonth()+1);
    $('#year').val(d.getFullYear());
  @endif
</script>

@endsection
