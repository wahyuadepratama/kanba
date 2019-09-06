@extends('coach.parts.coach_page')

@section('title','Status')

@section('css')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/taginputs/tagsinput.css') }}" rel="stylesheet">
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<style media="screen">
  .custom-file-label{
    text-align: left;
  }
</style>
@endsection

@section('image-menu')
<img src="{{asset('img/Picture1.png')}}" alt="" height="70">
@endsection

@section('active-status','active')

@section('menu-title','Status')
@section('menu-desc','Status anak asuh dapat dilihat di menu ini.
Upload foto selfie Bersama anak  asuh setelah coaching sebagai bukti anda sudah melakukan coaching.
')

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

  @if (session('success'))
  <small><div style="margin: 2%" class="alert alert-success"> {{ session('success') }} </div></small>
  @endif

  @if ($errors->any())
  <br><small>
    <div class="alert alert-danger" style="margin: 2%">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
  </small>
  @endif

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto Coaching</th>
            <th>Anak Asuh</th>
            <th>Jadwal Coaching</th>
            <th>Actual Coaching</th>
            <th class="text-center">Upload Foto</th>
          </tr>
        </thead>
        <tbody>
          @php $no=1 @endphp
          @forelse($trainee as $t)
            <tr>
              <td>{{ $no++ }}</td>
              <td class="td-img"> <img src="{{ asset('coaching/'. $t->photo)}}" alt="" class="mx-auto d-block img-fluid img-thumbnail" width="250"></td>
              <td data-th="Anak Asuh  &#xa;">{{ $t->name }}</td>
              <td data-th="Jadwal Coaching  &#xa;">{{ $t->datetime }}</td>
              <td data-th="Actual Coaching &#xa;">
                @if($t->status == 'ongoing')
                  -
                @else
                  <p class="text text-success text-weight-bold">{{ $t->actual }}</p>
                @endif
              </td>
              <td>
                @if($t->status == 'ongoing')
                  <form action="{{ url('coach-status/upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <button type="submit" class="input-group-text">Upload</button>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input input-sm" id="inputGroupFile01" name="file"
                          aria-describedby="inputGroupFileAddon01" required accept="image/*" capture>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                      </div>
                    </div><br>
                    <div class="form-group">
                      <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                        <input placeholder="Actual Coaching" class="form-control input-sm" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" required name="schedule">
                      </div>
                     </div>
                    <input type="hidden" name="id" value="{{ $t->id }}">
                  </form>
                @else
                  <p style="text-align:center">Sudah Diupload !</p>
                @endif
                <hr class="d-md-none"><br>
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

<!-- mdb -->
<script src="{{ asset('vendor/mdb/js/mdb.min.js') }}"></script>
<script src="{{ asset('vendor/mdb/js/modules/bs-custom-file-input.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- datetime picker -->
<script src="https://momentjs.com/downloads/moment-with-locales.js" charset="utf-8"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <script type="text/javascript">

    var d = new Date();
    $('#month').val(d.getMonth()+1);
    $('#year').val(d.getFullYear());

    function changeYearMonth() {
      var month = $('#month').val();
      var year = $('#year').val();

      $.ajax({ /* THEN THE AJAX CALL */
        url: "/coach-status/filter",
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
