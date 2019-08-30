@extends('layout.core_coach')
@section('banner-menu')
  <div class="container-fluid">
    <div class="banner-menu d-block-none">
      <div class="area-banner-1">
       @yield('image-menu')
      </div>
      <div class="area-banner-2">
        <span style="font-weight:bold">@yield('menu-title')</span><br>
        <span>@yield('menu-desc')</span>
      </div>
    </div>
  </div>
@endsection
