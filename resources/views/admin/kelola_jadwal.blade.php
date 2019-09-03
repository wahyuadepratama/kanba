@extends('layout.core_admin')

@section('title','Kelola Jadwal')

@section('active-jadwal','active')

@section('css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h4 mb-2 text-gray-800"><i class="fas fa-calendar-day"></i> &nbsp; Kelola Jadwal</h1>
<div class="row">
  <div class="col">
    <a class="btn btn-primary btn-icon-split btn-sm float-right" href="#" data-toggle="modal" data-target="#addHubungan">
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
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3 offset-md-6">
        <select class="form-control" id="exampleFormControlSelect1">
          <option>2019</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-control" id="exampleFormControlSelect1">
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
          <tr>
            <td>1</td>
            <td>Nikmatulla</td>
            <td>
              <ul>
                <li>Anak Asuh 1</li>
                <li>Anak Asuh 2</li>
                <li>Anak Asuh 3</li>
                <li>Anak Asuh 4</li>
              </ul>
            </td>
            <td>
              <a class="btn btn-google btn-sm" href="#" >Reminder Otomatis</a>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter">Reminder Manual</a>
          </td>
          </tr>

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

@endsection
