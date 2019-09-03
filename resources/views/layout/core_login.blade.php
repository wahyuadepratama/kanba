<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">

    @yield('css')
  </head>
  <body style="overflow:hidden;">
    <!-- Image and text -->
    <!-- <nav class="navbar navbar-light bg-light">

    </nav> -->

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('img/kanba.png')}}" height="50" class="d-inline-block align-middle" alt="">
      </a>

      <ul class="navbar-nav ml-auto">
        <style media="screen">
          .logo-icon{
            width: auto !important;
          }
        </style>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile logo-icon" src="{{ asset('img/buma.jpg')}}">
          </a>
        </li>
      </ul>

    </nav>
    <!-- End of Topbar -->

    <div class="login-background">
      <div class="box-login">

        <div class="form-login-container">
          <div class="title-apps">
            <h5>SHE BUMA Kideco</h5>
            <h5>Mempersembahkan</h5>
            <h5>KANBA - Pengingat Otomatis</h5>
            <h5>Mempermudah Coaching Anda</h5>
          </div>
          <br>
          <form action="{{ url('login') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="text" name="nik" class="form-control" aria-describedby="emailHelp" placeholder="NIK" value="{{ old('nik') }}">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control @yield('display-password')" placeholder="Password">
            </div>
            @if (session('error'))
            <small><div class="alert alert-danger"> {{ session('error') }} </div></small>
            @endif
            <center><button type="submit" class="btn btn-yellow form-control">Submit</button></center>
          </form>
        </div>

      </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script type="text/javascript">
      $( document ).ready(function() {
        var heightNavbar = $("nav").height();
        var heightWindow = $(window).height();
        var widthWindow = $(window).width();
        var heightLogin= heightWindow - (heightNavbar);
        console.log( heightLogin);

        if (widthWindow > 990) {
          $(".login-background").height(heightLogin);

          console.log($(".box-login").height());
        }
        $(".box-login").height(heightLogin);

      });

    </script>
    @yield('javascript')
  </body>
</html>
