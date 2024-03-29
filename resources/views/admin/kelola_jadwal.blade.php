@extends('layout.core_admin')

@section('title','Kelola Jadwal')

@section('active-jadwal','active')

@section('css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">
@endsection

@section('content')

@if (session('success'))
<small><div class="alert alert-success"> {{ session('success') }} </div></small>
@endif

<!-- Page Heading -->
<h1 class="h4 mb-2 text-gray-800"><i class="fas fa-calendar-day"></i> &nbsp; Kelola Jadwal</h1>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-2 offset-md-8">
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
    </div>
    <br>
    <div class="table-responsive">
      <table class="table table-bordered mycustom" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bapak Asuh</th>
            <th>Anak Asuh</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1 @endphp
          @foreach($coach as $c)
            <tr>
              <td data-th="No  &#xa;">{{ $no++ }}</td>
              <td data-th="Nama Bapak Asuh  &#xa;">{{ $c->name }} ({{ $c->nik }})</td>
              <td data-th="Anak Asuh  &#xa;">
                <ul>
                  {!! $c->result !!}
                </ul>
              </td>
              <td>
                <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#remindermanual"
                onclick="manual('{{ $c->nik }}','{{ $c->name }}')">
                  Reminder</a>
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

@include('admin.modal.send_reminder')


<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('vendor/taginputs/tagsinput.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript">
  function manual(id, name) {
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({ /* THEN THE AJAX CALL */
      url: '/admin/kelola-jadwal/get-data-coaching/'+id+'/'+month+'/'+year,
      method : "GET",
      async : true,
      type: 'text',
      success: function(data){
        $('#sendManualButton').attr('onclick', 'sendManual(\''+ id +'\')');
        $('#dataTextWhatsapp').val('Hello '+ name +', berikut adalah jadwal coaching anda bulan ini: \n\n'+ data + '\nJangan lupa untuk mengingatkan anak asuh anda ya ^_^ dan jangan lupa juga untuk upload foto setelah coaching di https://coachingbuma.com' + '\n\nTerima Kasih');
      }
    });
  }

  function sendManual(id) {
    var text = $('#dataTextWhatsapp').val();
    $.ajax({ /* THEN THE AJAX CALL */
      url: '/admin/kelola-jadwal/reminder-manual',
      method : "POST",
      data:{'nik': id, 'text': text, _token: '{{csrf_token()}}'},
      async : true,
      success: function(data){
        swal({
          icon: "success",
          text: "Pesan berhasil dikirim! Harap menunggu beberapa menit jika pesan belum masuk.",
          buttons: false,
          timer: 3000
        });
      }
    });
  }

  @if($_GET)
    $('#month').val("{{ $_GET['month'] }}");
    $('#year').val("{{ $_GET['year'] }}");
  @else
    var d = new Date();
    $('#month').val(d.getMonth()+1);
    $('#year').val(d.getFullYear());
  @endif

  function changeYearMonth() {
    var month = $('#month').val();
    var year = $('#year').val();
    window.location.href = "/admin/kelola-jadwal?month="+month+"&year="+year;
  }
</script>

@endsection
