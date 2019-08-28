@extends('layout.core-admin')

@section('title','Performa')

@section('active-performa','active')

@section('css')



@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Kelola Jadwal</h1>
<div class="grid-performa">
  <div class="grid-performa-1">
    <select class="form-control" id="exampleFormControlSelect1">
      <option>2019</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="grid-performa-2">
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Week 33</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="grid-performa-3">
    <center>
    <a class="btn btn-primary btn-icon-split" href="#" data-toggle="modal" data-target="#addHubungan">
       <span class="icon text-white-50">
        <i class="fas fa-file-download"></i>
       </span>
       <span class="text">Download Excel</span>
     </a>
   </center>
  </div>
  <div class="grid-performa-4">
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Weekly</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="grid-performa-5">
    <select class="form-control" id="exampleFormControlSelect1">
      <option>All Coach</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="grid-performa-6 align-middle">
    <span class="align-middle">Achievement : 80%</span>
  </div>
</div>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div>
  <div class="card-body">
    <div class="chart-area">
      <canvas id="myAreaChart"></canvas>
    </div>
    <hr>
    Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file.
  </div>
</div>

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
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/chart-bar-demo.js"></script>
@endsection
