@extends('coach.parts.coach_page')

@section('title','Buat Jadwal')

@section('css')
<!-- Custom styles for this page -->
<link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ url('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" /> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    <div class="col-md-6 pd-bottom"></div>
    <div class="col-md-6 ">
      <div class="row">
        <div class="col-md-3 offset-md-6 pd-bottom">
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
        <div class="col-md-3">
          <select class="form-control btn-sm" id="year" onchange="changeYearMonth()">
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
          </select>
        </div>

      </div>
    </div>
  </div>
  <br>
<!-- DataTales Example -->

<div class="card shadow mb-4">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <script type="text/javascript">
        var d = new Date();
        alert(d.getMonth()+1);
      </script>
    </h6>
  </div> -->

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Anak Asuh</th>
            <th>NIK</th>
            <th>Jadwal Coaching</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1 @endphp
          @forelse($data as $d)
            <tr>
              <td data-th="No &#xa;">{{ $no++ }}</td>
              <td data-th="Nama &#xa;">{{ $d->name }}</td>
              <td data-th="NIK &#xa;">{{ $d->nik }}</td>
              <td data-th="Jadwal &#xa;">
                @php $data = \App\Models\Schedule::where('relationship_id', $d->id)->whereMonth('datetime', date('m'))->whereYear('datetime', date('Y'))->first() @endphp
                @if($data == null)
                <div class="text text-danger font-weight-bold">
                  Belum Dibuat!
                </div>
                @else
                  <div class="text text-success font-weight-bold">
                    {{ date('d F Y', strtotime($data->datetime)) }}
                  </div>
                @endif
              </td>
              <td style="position:relative !important">
                @if($data == null)
                  <a class="btn btn-primary btn-sm btn-icon-split" href="#" data-toggle="modal" data-target="#addJadwal"
                  onclick="addSchedule('{{ $d->id }}')">
                     <span class="icon text-white-50">
                       <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">Buat Jadwal</span>
                   </a>
                @else
                <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm('{{ $data->id }}')"><i class="fas fa-trash"></i> Hapus Jadwal</a>
                @endif
                <hr class="d-md-none">
              </td>
            </tr>
          @empty
          @endforelse
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
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('vendor/taginputs/tagsinput.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- datetime picker -->
<script src="https://momentjs.com/downloads/moment-with-locales.js" charset="utf-8"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script> -->

  <script type="text/javascript">

      var d = new Date();
      $('#month').val(d.getMonth()+1);
      $('#year').val(d.getFullYear());

      function addSchedule(id) {
        var month = $('#month').val();
        var year = $('#year').val();

        var months = ["","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $('#addJadwalTitle').html('Buat jadwal bulan '+months[month]);
        $('#jadwals').val('');
        $('#addButton').attr('onclick', "storeUpdate('"+ id +"', '"+ month +"', '"+ year +"')")
      }

      function storeUpdate(id, month, year) {
        var sch = $('#jadwals').val();
        var date = new Date($('#jadwals').val());
        day = date.getDate();
        month = date.getMonth() + 1;

        if (sch == "") {
          swal({
            icon: "warning",
            text: "Jadwal belum diisi !",
            buttons: false,
            timer: 2000
          });
        }else{

          if (month != $('#month').val()) {
            swal({
              icon: "warning",
              text: "Pastikan anda memilih bulan yang sesuai !",
              buttons: false,
              timer: 2000
            });
          }else{
            $.ajax({ /* THEN THE AJAX CALL */
              url: '/coach-schedule/store',
              method : "POST",
              data:{'id': id, 'sch': sch, 'month': month, 'year': year, _token: '{{csrf_token()}}'},
              async : true,
              dataType : 'text',
              success: function(data){
                $('#dataTable').dataTable().fnClearTable();
                $('#dataTable').DataTable().destroy();
                $('#dataTable').find('tbody').append(data);
                $('#dataTable').DataTable().draw();
                swal({
                  icon: "success",
                  text: "Jadwal baru berhasil ditambahkan!",
                  buttons: false,
                  timer: 2000
                });
              }
            });
          }

        }
      }

      function destroyConfirm(id){
        swal({
          title: "Apakah kamu yakin?",
          text: "Jadwal yang sudah ada akan dihapus!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var month = $('#month').val();
            var year = $('#year').val();
            destroySchedule(id, month, year);
          }
        });
      }

      function destroySchedule(id, month, year){
        $.ajax({ /* THEN THE AJAX CALL */
          url: "/coach-schedule/destroy/"+ id,
          method : "POST",
          data:{'month': month, 'year': year, _token: '{{csrf_token()}}'},
          async : true,
          dataType : 'text',
          success: function(data){console.log(data);
            $('#dataTable').dataTable().fnClearTable();
            $('#dataTable').DataTable().destroy();
            $('#dataTable').find('tbody').append(data);
            $('#dataTable').DataTable().draw();
            swal({
              icon: "success",
              text: "Penghapusan berhasil !",
              buttons: false,
              timer: 2000
            });
          }
        });
      }

      function changeYearMonth() {
        var month = $('#month').val();
        var year = $('#year').val();

        $.ajax({ /* THEN THE AJAX CALL */
          url: "/coach-schedule/filter",
          method : "POST",
          data:{'month': month, 'year': year, _token: '{{csrf_token()}}'},
          async : true,
          dataType : 'text',
          success: function(data){
            $('#dataTable').dataTable().fnClearTable();
            $('#dataTable').DataTable().destroy();
            $('#dataTable').find('tbody').append(data);
            $('#dataTable').DataTable().draw();
            swal({
              text: "Please waiting...",
              buttons: false,
              timer: 3000
            });
          }
        });
      }

  </script>



@endsection
