@extends('coach.parts.coach_page')

@section('css')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="vendor/taginputs/tagsinput.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('image-menu')
<img src="{{asset('img/Picture2.png')}}" alt="" height="70">
@endsection

@section('active-performa','active')

@section('menu-title','Performa')
@section('menu-desc','Lihat performa dan ranking coach anda.')

@section('content')
<div class="container-fluid">
  <br>
  <!-- start row -->
  <div class="row">
    <!-- start col -->
    <div class="col-md-12">
      <!-- start card -->
      <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div> -->

        <div class="card-body">
          <!-- start grid -->
          <div class="grid-performa-coach">
            <div class="performa-chart">
              <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
              </div>
              <div class="table-responsive" id="myRanking">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width:20px !important">No</th>
                      <th>Nama</th>
                      <th>Achievement</th>
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
                    <tr class="tr-ranking" style="border:1px solid black;">
                      <td class="td-ranking" data-th="#">1</td>
                      <td class="td-ranking">Wahyu Adee Pratama</td>
                      <td class="td-ranking float-right">80% </td>
                    </tr>
                    <tr>
                      <td class="td-ranking" data-th="#">2</td>
                      <td class="td-ranking">Yolanda Parawita</td>
                      <td class="td-ranking float-right">80% </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <!-- end chart -->
            <div class="performa-form">
              <div class="form-group">
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option>2019</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="performa-click">
                  <option value="monthly" selected>Monthly</option>
                  <option value="weekly">Weekly</option>
                  <option value="ranking">Ranking</option>
                </select>
              </div>
              <div class="form-group">
                  <select class="form-control" id="selectWeekMonth">
                    <option>Week 33</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
              </div>
              <div class="form-group" id="achievementResult">
                <h6>Achievement : 80%</h6>
              </div>
            </div>
            <!-- end performa form -->
          </div>
          <!-- end grid -->
            <hr>
          Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file.
        </div>
      </div>
      <!-- end card -->
    </div>
    <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <br>

</div>


@endsection

@section('javascript')

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
      $("#myRanking").hide();
      $("#performa-click").change(function(){
        var selected = $(this). children("option:selected"). val();
        console.log(selected);
        switch (selected) {
          case "ranking":
              console.log("tampilkan ranking");
              $(".chart-area").hide();
              $("#myRanking").show();
              $("#selectWeekMonth").hide();
              $("#achievementResult").hide();
            break;
          case "weekly":
              console.log("tampilkan nilai weekly");
              $(".chart-area").show();
              $("#myRanking").hide();
              $("#selectWeekMonth").show();
              $("#achievementResult").show();
            break;
          case "monthly":
            console.log("tampilkan nilai monthly");
              $(".chart-area").show();
              $("#myRanking").hide();
              $("#selectWeekMonth").show();
              $("#achievementResult").show();
            break;
          default:
           console.log("tampilkan nilai monthly");
           break;
        }
    });
  });
</script>



@endsection
