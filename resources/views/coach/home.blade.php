@extends('layout.core_coach')

@section('title','Home')

@section('content')

<div class="container-fluid">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('img/Picture4.png')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('img/Picture4.png')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('img/Picture4.png')}}" alt="First slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<div class="container home-coach">
  <br>
  <div class="row">
    <div class="col-md-4">
      <div class="box-menu">
        <div class="grid-box-menu">
          <div class="area-bm-1">
            <img src="{{asset('img/Picture3.png')}}" alt="" height="50">
          </div>
          <div class="area-bm-2">
            <span>Buat Jadwal</span>
            <p>Buat jadwal agar coaching anda lebih mudah
</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box-menu">
        <div class="grid-box-menu">
          <div class="area-bm-1">
            <img src="{{asset('img/Picture1.png')}}" alt="" height="50">
          </div>
          <div class="area-bm-2">
            <span>Status</span>
            <p>Lihat status coaching anak asuh anda</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box-menu">
        <div class="grid-box-menu">
          <div class="area-bm-1">
              <img src="{{asset('img/Picture2.png')}}" alt="" height="50">
          </div>
          <div class="area-bm-2">
            <span>Performa</span>
            <p>Lihat performa dan ranking coaching anda</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
