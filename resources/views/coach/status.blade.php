@extends('coach.parts.coach_page')

@section('css')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="vendor/taginputs/tagsinput.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('image-menu')
<img src="{{asset('img/Picture1.png')}}" alt="" height="70">
@endsection

@section('menu-title','Status')
@section('menu-desc','Status anak asuh dapat dilihat di menu ini.
Upload foto selfie Bersama anak  asuh setelah coaching sebagai bukti anda sudah melakukan coaching.
')

@section('content')
<div class="container-fluid">
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3 offset-md-6">
          <select class="form-control" id="exampleFormControlSelect1">
            <option>November</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="col-md-3 ">
          <select class="form-control" id="exampleFormControlSelect1">
            <option>2019</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>

      </div>
    </div>
  </div>
  <br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div> -->

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto Coaching</th>
            <th>Anak Asuh</th>
            <th>Jadwal Coaching</th>
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
            <td> <img src="{{ asset('img/Picture4.png')}}" alt="" class="img-slider-table"></td>
            <td>Badu</td>
            <td>10 November 2019 </td>
            <td>0812131213</td>
            <td>
              <a class="btn btn-google  btn-sm" href="#">File</a>
              <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter">Update Image</a>
          </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@include('coach.modal.add_jadwal')

@endsection

@section('javascript')
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


<!-- datetime picker -->
<script src="https://momentjs.com/downloads/moment-with-locales.js" charset="utf-8"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript">
      $(function () {
          $('#datetimepicker4').datetimepicker({
              format: 'L'
          });
      });
  </script>



@endsection
