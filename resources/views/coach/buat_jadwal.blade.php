@extends('coach.parts.coach_page')

@section('css')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="vendor/taginputs/tagsinput.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('image-menu')
<img src="{{asset('img/Picture3.png')}}" alt="">
@endsection

@section('active-jadwal','active')

@section('menu-title','Buat Jadwal')
@section('menu-desc','Buat jadwal dengan anak asuh, agar coaching anda lebih teratur')

@section('content')
<div class="container-fluid">
  <br>
  <div class="row">
    <div class="col-md-6 pd-bottom">
      <a class="btn btn-primary btn-icon-split" href="#" data-toggle="modal" data-target="#addJadwal">
         <span class="icon text-white-50">
           <i class="fas fa-plus"></i>
         </span>
         <span class="text">Buat Jadwal Baru</span>
       </a>
    </div>
    <div class="col-md-6 ">
      <div class="row">
        <div class="col-md-3 offset-md-6 pd-bottom">
          <select class="form-control" id="exampleFormControlSelect1">
            <option>November</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="col-md-3">
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
            <td data-th="No &#xa;">1</td>
            <td data-th="Nama &#xa;">Badu</td>
            <td data-th="Jadwal &#xa;">10 November 2019 </td>
            <td data-th="No Handphone/WhatsApp &#xa;">0812131213</td>
            <td>
              <a class="btn btn-google btn-sm" href="#" ><i class="fas fa-trash"></i> Hapus Jadwal</a>
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
