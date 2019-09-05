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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width:20px !important">No</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Anak Asuh</th>
                      <th>Terjadwal</th>
                      <th>Terlaksana</th>
                      <th>Achievement</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @for ($i=0; $i < count($rank); $i++)
                    <tr>
                      <td class="td-ranking" data-th="#">{{ $no++ }}</td>
                      <td class="td-ranking">{{ $rank[$i]['coach'] }}</td>
                      <td class="td-ranking">{{ $rank[$i]['nik'] }}</td>
                      <td class="td-ranking">{{ $rank[$i]['trainee'] }} orang</td>
                      <td class="td-ranking">{{ $rank[$i]['plan'] }} x</td>
                      <td class="td-ranking">{{ $rank[$i]['coaching'] }} x</td>
                      <td class="td-ranking">{{ number_format($rank[$i]['archivement'], 1) }}%</td>
                    </tr>
                    @endfor
                  </tbody>
                </table>
              </div>
            </div>
            <!-- end chart -->
            <div class="performa-form">
              <div class="form-group">
                <select class="form-control btn-sm" id="year" onchange="changeYearMonth()">
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control btn-sm" id="type">
                  <option value="monthly" selected>Monthly Grafik</option>
                  <option value="ranking">Ranking</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control btn-sm" id="month" onchange="changeYearMonth()">
                  <option value="all">Semua Bulan</option>
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
                @php $no=1; $totalArchivement = 0; @endphp
                @for ($i=0; $i < count($rank); $i++)
                  @php $totalArchivement = $totalArchivement + $rank[$i]['archivement'] @endphp
                @endfor
                <h6>Achievement : {{ number_format($totalArchivement/count($rank), 1) }}%</h6>
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
        label: "Total",
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
        data: [<?php echo '"'.implode('","', $data).'"' ?>],
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

    @if($_GET['month'] == null)
        $('#month').val("all");
    @else
        $('#month').val('{{ $_GET['month'] }}');
    @endif

    @if($_GET['year'] == null)
        var d = new Date();
        $('#year').val(d.getFullYear());
    @else
        $('#year').val('{{ $_GET['year'] }}');
    @endif
  @else
    var d = new Date();
    $('#year').val(d.getFullYear());
  @endif

  // var d = new Date();
  // $('#month').val(d.getMonth()+1);
  // $('#year').val(d.getFullYear());

  $(document).ready(function(){
      $("#myRanking").hide();
      $("#type").change(function(){

        var selected = $(this). children("option:selected"). val();
        switch (selected) {
          case "ranking":
              $(".chart-area").hide();
              $("#myRanking").show();
            break;
          case "monthly":
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

  function changeYearMonth() {
    var month = $('#month').val();
    var year = $('#year').val();
    window.location.href = "/coach-performa?month="+month+"&year="+year;
  }
</script>

@endsection
