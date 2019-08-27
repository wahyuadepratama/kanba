@extends('layout.core-admin')

@section('title','Data Anak Asuh')

@section('active-anak','active')

@section('css')
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="vendor/taginputs/tagsinput.css" rel="stylesheet">
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Anak Asuh</h1>
<div class="row">
  <div class="col">
    <a class="btn btn-primary btn-icon-split float-right" href="#" data-toggle="modal" data-target="#addAnakAsuh">
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
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Anak Asuh</th>
            <th>NIK</th>
            <th>No WhatsApp</th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- <tfoot>
          <tr>
            <th>No</th>
            <th>Nama Bapak Asuh</th>
            <th>Anak Asuh</th>
            <th>No WhatsApp</th>
            <th>Action</th>
          </tr>
        </tfoot> -->
        <tbody>
          <tr>
            <td>1</td>
            <td>Nikmatulla</td>
            <td>132325436</td>
            <td>0812131213</td>
            <td>
              <a class="btn btn-google btn-sm" href="#" ><i class="fas fa-trash"></i> Hapus</a>
            </td>
          </tr>
          <tr>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>
              <a class="btn btn-google  btn-sm" href="#"><i class="fas fa-trash"></i> Hapus</a>
              </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('javascript')

@include('admin.modal.add_anak_asuh')

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script src="vendor/taginputs/tagsinput.js"></script>

@endsection
