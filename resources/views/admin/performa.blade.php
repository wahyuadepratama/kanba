@extends('layout.core_admin')

@section('title','Performa')

@section('active-performa','active')

@section('css')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h4 mb-2 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Performa </h1><br>
<div class="grid-performa">
  <div class="grid-performa-1">
    <select class="form-control btn-sm" id="type" onchange="filter()">
      <option value="yearly">Yearly Grafik</option>
      <option value="monthly">Monthly Grafik</option>
      <option value="compliance">Compliance</option>
      <option value="ranking">Ranking</option>
    </select>
  </div>
  <div class="grid-performa-2">
    <select class="form-control btn-sm" id="year" onchange="filter()">
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
    </select>
  </div>
  <div class="grid-performa-3 text-center">
    <a class="form-control btn btn-primary btn-sm btn-icon-split" href="#">
      @php $no=1; $rencana=0; $terlaksana=0; $tepatwaktu=0 @endphp
      @for ($i=0; $i < count($rank); $i++)
        @php $rencana = $rencana + $rank[$i]['plan'] @endphp
        @php $terlaksana = $terlaksana + $rank[$i]['coaching'] @endphp
        @php $tepatwaktu = $tepatwaktu + $rank[$i]['actual'] @endphp
      @endfor

      @if($terlaksana != 0 && $rencana != 0)
      <span class="text">Achievement : {{ number_format($terlaksana/$rencana * 100, 1) }}%</span>
      @else
      <span class="text">Achievement : 0 %</span>
      @endif
    </a>
  </div>
  <div class="grid-performa-4">
    <select class="form-control btn-sm" id="coach" onchange="filter()">
      <option value="all">Semua Coach</option>
      @foreach(\App\Models\User::where('role_id', 2)->orderBy('name')->get() as $coach)
        <option value="{{ $coach->nik }}">{{ $coach->name }} ({{ $coach->nik }})</option>
      @endforeach
    </select>
    @if($_GET)
      @if($_GET['type'] == 'yearly')
      <a class="form-control btn btn-success btn-sm btn-icon-split"
        href="{{ url('/admin/performa/export?month=all'. '&year='. $_GET['year']) }}" id="export">
        <span class="text"><i class="fa fa-file-download"></i> &nbsp; Download Excel</span>
      </a>
      @elseif($_GET['type'] == 'monthly')
      <a class="form-control btn btn-success btn-sm btn-icon-split"
        href="{{ url('/admin/performa/export?month='. $_GET['month'] . '&year='. $_GET['year']) }}" id="export">
        <span class="text"><i class="fa fa-file-download"></i> &nbsp; Download Excel</span>
      </a>
      @endif
    @else
      <a class="form-control btn btn-success btn-sm btn-icon-split"
        href="{{ url('/admin/performa/export?month=all&year='. date('Y')) }}" id="export">
        <span class="text"><i class="fa fa-file-download"></i> &nbsp; Download Excel</span>
      </a>
    @endif
  </div>
  <div class="grid-performa-5">
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
  <div class="grid-performa-6 text-center">
    <a class="form-control btn btn-primary btn-sm btn-icon-split" href="#">
      @if($terlaksana != 0 && $tepatwaktu != 0)
      <span class="text">Compliance : {{ number_format($tepatwaktu/$terlaksana * 100, 1) }}%</span>
      @else
      <span class="text">Compliance : 0 %</span>
      @endif
    </a>
  </div>

</div>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">

    <div id="statusFilter"></div><br>

    <div class="chart-area">
      <canvas id="myAreaChart"></canvas>
    </div>
    <div class="table-responsive" id="myRanking">
      <table class="table table-bordered mycustom" id="dataTable1" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="width:20px !important">No</th>
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
            <td class="td-ranking" data-th="#">{{ $no++ }}</td>
            <td class="td-ranking">{{ $rank[$i]['coach'] }}</td>
            <td class="td-ranking">{{ $rank[$i]['nik'] }}</td>
            <td class="td-ranking">{{ $rank[$i]['plan'] }} x</td>
            <td class="td-ranking">{{ $rank[$i]['coaching'] }} x</td>
            <td class="td-ranking">{{ number_format($rank[$i]['archivement'], 1) }}%</td>
          </tr>
          @endfor
        </tbody>
      </table>
    </div>
    <div class="table-responsive" id="compliance">
      <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="width:20px !important">No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Terjadwal</th>
            <th>Terlaksana</th>
            <th>Sesuai Jadwal</th>
            <th>Compliance</th>
          </tr>
        </thead>
        <tbody>
          @php
            $no=1;
            usort($rank, function($a, $b) { //Sort the array using a user defined function
                return $a['compliance'] > $b['compliance'] ? -1 : 1; //Compare the scores
            });
          @endphp
          @for ($i=0; $i < count($rank); $i++)
          <tr>
            <td class="td-ranking" data-th="#">{{ $no++ }}</td>
            <td class="td-ranking">{{ $rank[$i]['coach'] }}</td>
            <td class="td-ranking">{{ $rank[$i]['nik'] }}</td>
            <td class="td-ranking">{{ $rank[$i]['plan'] }} x</td>
            <td class="td-ranking">{{ $rank[$i]['coaching'] }} x</td>
            <td class="td-ranking">{{ $rank[$i]['actual'] }} x</td>
            <td class="td-ranking">{{ number_format($rank[$i]['compliance'], 1) }}%</td>
          </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
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
      },{
        data: [<?php echo '"'.implode('","', $ontimes).'"' ?>],
        label: "Persentase Compliance",
        borderColor: "#f44336",
        fill: false
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      title: {
          display: true,
          text: 'https://coachingbuma.com'
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
    $('#coach').val('{{ $_GET['coach'] }}');
    $('#year').val('{{ $_GET['year'] }}');
    if ($('#type').val() == 'yearly') {
      $('#statusFilter').html('Hasil Pencarian: ' + $('#year option:selected').html());
    }else if ($('#type').val() == 'monthly') {
      $('#statusFilter').html('Hasil Pencarian: ' + $('#month option:selected').html() + ', ' + $('#year option:selected').html());
    }
  @else
    var d = new Date();
    $('#month').val(d.getMonth()+1);
    $('#year').val(d.getFullYear());

    $('#statusFilter').html('Hasil Pencarian: '+d.getFullYear());
  @endif

  // var d = new Date();
  // $('#month').val(d.getMonth()+1);
  // $('#year').val(d.getFullYear());

  $(document).ready(function(){
      $("#myRanking").hide();
      $("#compliance").hide();
      $('#export').hide();
      @if(isset($_GET['type']))
        @if($_GET['type'] == 'yearly')
          $('#month').hide();
        @else
          $('#month').show();
        @endif
      @else
        $('#month').hide();
      @endif
      var type = $('#export').attr('href');

      $("#type").change(function(){

        var selected = $(this). children("option:selected"). val();
        switch (selected) {
          case "yearly":
              $(".chart-area").show();
              $('#month').hide();
              $('#export').hide();
              $("#coach").show();
              $("#myRanking").hide();
              $("#compliance").hide();
              $("#selectWeekMonth").show();
              $("#achievementResult").show();
            break;
          case "monthly":
              $(".chart-area").show();
              $('#month').show();
              $('#export').hide();
              $("#coach").show();
              $("#myRanking").hide();
              $("#compliance").hide();
              $("#selectWeekMonth").show();
              $("#achievementResult").show();
            break;
          case "ranking":
              $(".chart-area").hide();
              $('#month').hide();
              $('#year').hide();
              $('#export').show();
              $('#export').attr('href', type + '&type=archivement');
              $("#coach").hide();
              $("#myRanking").show();
              $("#compliance").hide();
            break;
          case "compliance":
              $("#compliance").show();
              $('#month').hide();
              $('#year').hide();
              $('#export').show();
              $('#export').attr('href', type + '&type=compliance');
              $("#coach").hide();
              $(".chart-area").hide();
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

  function filter() {
    var month = $('#month').val();
    var year = $('#year').val();
    var coach = $('#coach').val();
    var type = $('#type').val();
    if (type == "yearly") {
      window.location.href = "/admin/performa?type=yearly&coach="+coach+"&year="+year+"&month="+month;
    }else if (type == "monthly") {
      window.location.href = "/admin/performa?type=monthly&coach="+coach+"&year="+year+"&month="+month;
    }
  }

  $(document).ready(function() {
    $('#dataTable1').DataTable();
  });

  $(document).ready(function() {
    $('#dataTable2').DataTable();
  });
</script>
@endsection
