<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="{{ url('/img/kanba.png') }}">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - @yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">

  @yield('css')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
          <img class="img-profile" src="{{ asset('img/kanba.png')}}" width="80">
        <!-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @yield('active-home')">
        <a class="nav-link" href="/admin">
          <i class="fas fa-home"></i>
          <span>Home</span></a>
      </li>
      <li class="nav-item @yield('active-hubungan')">
        <a class="nav-link" href="/admin/kelola-hubungan">
          <i class="fas fa-handshake"></i>
          <span>Kelola Hubungan</span></a>
      </li>
      <li class="nav-item @yield('active-jadwal')">
        <a class="nav-link" href="/admin/kelola-jadwal">
          <i class="fas fa-calendar-day"></i>
          <span>Kelola Jadwal</span></a>
      </li>
      <li class="nav-item @yield('active-performa')">
        <a class="nav-link" href="/admin/performa">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Performa</span></a>
      </li>
      <li class="nav-item @yield('active-slider')">
        <a class="nav-link" href="/admin/kelola-slider">
          <i class="fas fa-images"></i>
          <span>Kelola Slider</span></a>
      </li>
      <li class="nav-item @yield('active-bapak')">
        <a class="nav-link" href="/admin/bapak-asuh">
          <i class="fas fa-user-tie"></i>
          <span>Data Bapak Asuh</span></a>
      </li>
      <li class="nav-item @yield('active-anak')">
        <a class="nav-link" href="/admin/anak-asuh">
          <i class="fas fa-users"></i>
          <span>Data Anak Asuh</span></a>
      </li>
      <li class="nav-item @yield('active-gallery')">
        <a class="nav-link" href="/admin/gallery-coaching">
          <i class="fas fa-image"></i>
          <span>Materi Coaching</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto" id="user-icon">


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow" >
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('login')->name }}</span>
                  <img class="img-profile rounded-circle" src="{{ asset('/img/user.jpg') }}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ session('login')->name }}
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav">
            <style media="screen">
              .logo-icon{
                width: auto !important;
              }
            </style>

            <div class="topbar-divider d-block-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile logo-icon" src="{{ asset('img/buma.jpg')}}">
              </a>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

        @yield('content')


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="https://coachingbuma.com">Coaching Buma</a> 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @yield('javascript')

</body>

</html>
