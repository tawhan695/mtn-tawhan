<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-family:  'Itim', cursive">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  {{-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}"> --}}
  {{-- <script>
    $( "#fullscreen_id" ).trigger( "click" );
  </script> --}}
   {{-- sweetalert2 --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="text/javascript" src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    @yield('javascript')
</head>
{{-- control-sidebar-slide-open layout-navbar-fixed sidebar-collapse sidebar-mini
  hold-transition sidebar-mini layout-fixed sidebar-collapse
  --}}
<body id="body" class=" layout-navbar-fixed sidebar-collapse sidebar-mini" style="font-family:  'Itim', cursive">
<div class="wrapper" >

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center bg-warning">
    <img class="animation__shake" src="{{ asset('images/logo/mtn.png') }}" alt="Logo" height="200" width="200">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light  "
        style="background-color: #F0C929;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block d-flex justify-content-center">
        <a href="#" class="nav-link"><h5>{{ App\Models\Branchs::where('id',App\Models\Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->first()->name}}</h5></a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      {{-- wallet  --}}
      <li class="nav-item">
        <a class="nav-link">
          <i class="fas fa-wallet"></i>
          <span > ฿{{number_format( App\Models\Wallet::where('branch_id',App\Models\Has_Branchs::where('user_id',Auth::user()->id)->first()->id)->first()->balance, 2, '.', ',')  }}</span>
        </a>
      </li>
      <!-- Navbar Search -->
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> --}}

  {{-- full scean --}}
    <li class="nav-item">
      <a id="fullscreen_id" class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-warning elevation-4 ">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('images/logo/logo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> {{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset(Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('user.index')}}" class="d-block" >{{ Auth::user()->name }}</a>
          <p class="">{{ App\Models\Branchs::where('id',App\Models\Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->first()->name}}</p>
          @if (auth()->user()->hasRole('admin'))
            <a href="{{ route('dashboard.index')}}">จัดการหลังร้าน</a>
          @endif
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                การขาย
                <i class="right fas fa-angle-left"></i> --}}
              {{-- </p>
            </a>
            <ul class="nav nav-treeview"> --}}
              <li class="nav-item">
                <a href="{{ route('sale.index')}}" class="nav-link {{ request()->routeIs('sale.index')? 'active' : '' }}">
                  <i class="nav-icon fas fa-cart-plus"></i>
                  <p>ขาย</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sale2.index')}}" class="nav-link {{ request()->routeIs('sale2.index')? 'active' : '' }}">
                  <i class="nav-icon fas fa-cart"></i>
                  <p>ขายส่ง</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transection.index')}}" class="nav-link {{ request()->routeIs('transection.index')? 'active' : '' }}">
                  <i class="nav-icon fas fa-history"></i>
                  <p>ประวัติการขาย</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('return.index')}}" class="nav-link {{ request()->routeIs('return.index')? 'active' : '' }}">
                  <i class="fas fa-undo nav-icon"></i>
                  <p>คืนสินค้า</p>
                </a>
              </li>
            {{-- </ul>
          </li> --}}
          <li class="nav-item">
            <a href="{{Route('defective.index')}}" class="nav-link {{ request()->routeIs('defcetive.index')? 'active' : '' }}">
              <i class="nav-icon fas fa-trash"></i>
              <p>
                สินค้าชำรุด
                <span class="right badge badge-danger">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('user.index')}}" class="nav-link {{ request()->routeIs('user.index')? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                โปรไฟล์
                <span class="right badge badge-danger">me</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                 ออกจากระบบ
                {{-- <span class="right badge badge-danger">me</span> --}}
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('content-header')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> --}}
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  {{-- <footer class="main-footer" >
    <strong>Power By   <a href="https://www.facebook.com/TawhanStudio">Tawhan Studio</a>.</strong>

    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
{{-- <script type="text/javascript" src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
{{-- <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
<!-- daterangepicker -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
{{-- <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script> --}}
</body>
</html>
