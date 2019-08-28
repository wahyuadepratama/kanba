@extends('layout.core-admin')

@section('title','Kelola Slider')

@section('active-slider','active')

@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <th>No</th>
          <th>Image</th>
          <th>Name</th>
          <th>Action</th>
        </thead>
        <tr>
          <td></td>
          <td class="img-column">
            <img src="https://cdn.pixabay.com/photo/2017/08/12/10/13/background-2633962_960_720.jpg" alt="" class="img-slider-table">
          </td>
          <td>slider1.png</td>
          <td>
            <a class="btn btn-google  btn-sm" href="#">File</a>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter">Update Image</a>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <img src="https://cdn.pixabay.com/photo/2016/10/20/18/35/sunrise-1756274__340.jpg" alt="" class="img-slider-table">
          </td>
          <td>slider2.png</td>
          <td>
            <a class="btn btn-google  btn-sm" href="#">File</a>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter">Update Image</a>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <img src="{{ asset('img/Picture4.png')}}" alt="" class="img-slider-table">
          </td>
          <td>slider3.png</td>
          <td>
            <a class="btn btn-google  btn-sm" href="#">File</a>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter">Update Image</a>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <img src="{{ asset('img/Picture4.png')}}" alt="" class="img-slider-table">
          </td>
          <td>slider3.png</td>
          <td>
            <a class="btn btn-google  btn-sm" href="#">File</a>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter">Update Image</a>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

@endsection
