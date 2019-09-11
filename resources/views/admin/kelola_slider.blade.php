@extends('layout.core_admin')

@section('title','Kelola Slider')

@section('active-slider','active')

@section('content')

@section('css')
    <style media="screen">
      /* Style the Image Used to Trigger the Modal */
      #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      }

      #myImg:hover {opacity: 0.7;}

      /* The Modal (background) */
      .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
      }

      /* Modal Content (Image) */
      .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      }

      /* Caption of Modal Image (Image Text) - Same Width as the Image */
      #caption {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      text-align: center;
      color: #ccc;
      padding: 10px 0;
      height: 150px;
      }

      /* Add Animation - Zoom in the Modal */
      .modal-content, #caption {
      animation-name: zoom;
      animation-duration: 0.6s;
      }

      @keyframes zoom {
      from {transform:scale(0)}
      to {transform:scale(1)}
      }

      /* The Close Button */
      .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
      }

      .close:hover,
      .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
      }

      /* 100% Image Width on Smaller Screens */
      @media only screen and (max-width: 700px){
      .modal-content {
      width: 100%;
      }
      }
    </style>
@endsection

@if (session('success'))
<small><div class="alert alert-success"> {{ session('success') }} </div></small>
@endif

@if ($errors->any())
<br><small>
  <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </div>
</small>
@endif

<h1 class="h4 mb-2 text-gray-800"><i class="fas fa-images"></i> &nbsp; Kelola Slider</h1><br>
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table mycustom">
        <thead>
          <th>No</th>
          <th>Image</th>
          <th>Name</th>
          <th>Update</th>
          <th>Action</th>
        </thead>
        @php $no=1 @endphp
        @forelse($images as $img)
          <form action="{{ url('admin/kelola-slider/update/'. $img->photo) }}" method="post" enctype="multipart/form-data">
            @csrf
            <tr>
              <td data-th="No  &#xa;">{{ $no++ }}</td>
              <td class="img-column">
                <img id="myImg{{ $img->id }}" src="{{ url('img/'. $img->photo) }}" alt="" class="img-slider-table">
              </td>
              <td data-th="Name  &#xa;">{{ $img->name }}</td>
              <td data-th="Update">
                <div class="custom-file">
                  <input type="file" name="file" required>
                </div>
              </td>
              <td>
                <button type="submit" class="btn btn-sm btn-warning form-control" name="button">Upload</button>
                <hr class="d-md-none">
              </td>
            </tr>
          </form>

          <div id="myModal{{ $img->id }}" class="modal">
            <!-- The Close Button -->
            <span class="close {{ $img->id }}">&times;</span>
            <!-- Modal Content (The Image) -->
            <img class="modal-content" id="img01{{ $img->id }}">
            <!-- Modal Caption (Image Text) -->
            <div id="caption{{ $img->id }}"></div>
          </div>

          <script type="text/javascript">
            // Get the modal
            var modal = document.getElementById("myModal{{ $img->id }}");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById("myImg{{ $img->id }}");
            var modalImg = document.getElementById("img01{{ $img->id }}");
            var captionText = document.getElementById("caption{{ $img->id }}");
            img.onclick = function(){
              modal.style.display = "block";
              modalImg.src = this.src;
              captionText.innerHTML = this.alt;
            }
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("{{ $img->id }}")[0];
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }
          </script>
        @empty
        @endforelse

      </table>
    </div>
  </div>
</div>

@endsection

@section('javascript')


<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('vendor/taginputs/tagsinput.js') }}"></script>

@endsection
