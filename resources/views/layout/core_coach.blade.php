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
  <body>
    <!-- Image and text -->
    <!-- <nav class="navbar navbar-light bg-light">

    </nav> -->

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('img/kanba.png')}}" height="50" class="d-inline-block align-middle" alt="">
      </a>

      <ul class="navbar-nav d-block-none coach clearfix" style="justify-content: center; margin-right:auto; margin-left:auto">
        <li class="nav-item @yield('active-jadwal')">
          <a class="nav-link" href="/coach-schedule">Buat Jadwal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @yield('active-status')" href="/coach-status">Status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @yield('active-performa')" href="/coach-performa">Performa</a>
        </li>
      </ul>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav float-right" id="user-icon">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
              <img class="img-profile rounded-circle" src="{{ asset('img/man-user.svg') }}">

          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item d-md-none" href="/coach-schedule">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Buat Jadwal
            </a>
            <a class="dropdown-item d-md-none" href="/coach-status">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Status
            </a>
            <a class="dropdown-item d-md-none" href="/coach-performa">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Performa
            </a>
            <div class="dropdown-divider d-md-none"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>



        <!-- buma icon -->


      </ul>

      <ul class="navbar-nav">
        <style media="screen">
          .logo-icon{
            width: auto !important;
          }
        </style>

        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile logo-icon" src="{{ asset('img/buma.jpg')}}">
          </a>
        </li>
      </ul>

    </nav>
    <!-- End of Topbar -->

    @yield('banner-menu')

    @yield('content')

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    @yield('javascript')
  </body>
</html>
