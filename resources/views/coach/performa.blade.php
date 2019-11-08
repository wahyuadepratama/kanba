@extends('coach.parts.coach_page')

@section('title','Performa')

@section('css')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                <table class="table table-bordered  mycustom" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Terjadwal</th>
                      <th>Terlaksana</th>
                      <th>Achievement</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @for ($i=0; $i < count($rank); $i++)
                    <tr>
                      <td data-th="Rangking">{{ $no }}</td>
                      <td data-th="Rangking {{ $no++ }} &#xa;">{{ $rank[$i]['coach'] }}</td>
                      <td data-th="NIK &#xa;">{{ $rank[$i]['nik'] }}</td>
                      <td data-th="Terjadwal &#xa;">{{ $rank[$i]['plan'] }} x</td>
                      <td data-th="Terlaksana &#xa;">{{ $rank[$i]['coaching'] }} x</td>
                      <td style="border-bottom: 1px solid #e3e6f0;" data-th="Archivement &#xa;">{{ number_format($rank[$i]['archivement'], 1) }}%</td>
                    </tr>
                    @endfor
                  </tbody>
                </table>
              </div>
              <div class="table-responsive" id="myMaterial">
                <table class="table table-bordered  mycustom" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Jadwal</th>
                      <th>Actual</th>
                      <th>Materi Coaching</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @foreach($sch as $sch_)
                    <tr>
                      <td data-th="No ">{{ $no++ }}</td>
                      <td data-th="Name">{{ $sch_->name }}</td>
                      <td data-th="Jadwal  &#xa;">{{ date('d F Y', strtotime($sch_->datetime)) }}</td>
                      <td data-th="Actual  &#xa;">{{ date('d F Y', strtotime($sch_->actual)) }}</td>
                      <td data-th="Materi  &#xa;">{{ $sch_->photo }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- end chart -->
            <div class="performa-form">
              <div class="form-group">
                <select class="form-control btn-sm" id="year" onchange="filter()">
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control btn-sm" id="type" onchange="filter()">
                  <option value="yearly" selected>Yearly Grafik</option>
                  <option value="monthly">Monthly Grafik</option>
                  <option value="ranking">Ranking</option>
                  <option value="material">Materi Coaching</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control btn-sm" id="month" onchange="filter()">
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
              <div class="form-group" id="achievementResult">
                <a class="form-control btn btn-primary btn-sm btn-icon-split" href="#">
                @for ($i=0; $i < count($rank); $i++)
                  @if($rank[$i]['nik'] == session('login')->nik)
                    <span class="text">Achievement : {{ number_format($rank[$i]['archivement'], 1) }}%</span>
                  @endif
                @endfor
                </a>
              </div>
            </div>
            <!-- end performa form -->
          </div>
          <!-- end grid -->
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
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

<script type="text/javascript">

  // Area Chart Example
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [<?php echo '"'.implode('","', $label).'"' ?>],
      datasets: [{
        label: "Persentase Pelaksanaan",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [<?php echo '"'.implode('","', $actuals).'"' ?>],
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 16
          }
        }],
        yAxes: [{
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
          }
        }
      }
    }
  });

  @if($_GET)
    $('#type').val('{{ $_GET['type'] }}');
    $('#month').val('{{ $_GET['month'] }}');
    $('#year').val('{{ $_GET['year'] }}');
  @else
    var d = new Date();
    $('#month').val(d.getMonth()+1);
    $('#year').val(d.getFullYear());

  @endif

  // var d = new Date();
  // $('#month').val(d.getMonth()+1);
  // $('#year').val(d.getFullYear());

  $(document).ready(function(){
      $("#myRanking").hide();
      $("#myMaterial").hide();
      @if(isset($_GET['type']))
        @if($_GET['type'] == 'yearly')
          $('#month').hide();
        @else
          $('#month').show();
        @endif
      @else
        $('#month').hide();
      @endif
      $("#type").change(function(){

        var selected = $(this). children("option:selected"). val();
        switch (selected) {
          case "ranking":
              $(".chart-area").hide();
              $('#month').hide();
              $('#year').hide();
              $("#myRanking").show();
              $("#myMaterial").hide();
            break;
          case "monthly":
              $(".chart-area").show();
              $("#myRanking").hide();
              $('#month').show();
              $('#year').show();
              $("#selectWeekMonth").show();
              $("#achievementResult").show();
              $("#myMaterial").hide();
            break;
          case "yearly":
              $(".chart-area").show();
              $('#month').hide();
              $('#year').show();
              $("#myRanking").hide();
              $("#myMaterial").hide();
              $("#selectWeekMonth").show();
              $("#achievementResult").show();
            break;
          case "material":
              $(".chart-area").hide();
              $('#month').hide();
              $('#year').hide();
              $("#myRanking").hide();
              $("#myMaterial").show();
            break;
          default:
           console.log("tampilkan nilai monthly");
           break;
        }
    });
  });

  function filter() {
    var month = $('#month').val();
    var year = $('#year').val();
    var type = $('#type').val();
    if (type == "yearly") {
      window.location.href = "/coach-performa?type=yearly&year="+year+"&month="+month;
    }else if (type == "monthly") {
      window.location.href = "/coach-performa?type=monthly&year="+year+"&month="+month;
    }
  }
</script>

@endsection
