@extends('layout.core_admin')

@section('title','Home')

@section('active-home','active')

@section('content')
<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kelola Hubungan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kelolaHubungan }}</div>
          </div>
          <div class="col-auto">
              <i class="fas fa-handshake fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Jadwal</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kelolaJadwal }}</div>
          </div>
          <div class="col-auto">
              <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jadwal Belum Dilaksanakan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $scheduled }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-fw fa-tachometer-alt fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data Bapak Asuh</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bapakAsuh }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data Anak Asuh</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anakAsuh }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('javascript')




@endsection
