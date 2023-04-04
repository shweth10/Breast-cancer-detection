<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <base href="/">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini control-sidebar-slide-open layout-navbar-fixed layout-fixed text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> Account
          
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          
        @if(\Request::is('admin/*') && Auth::guard('admin')->check())

           @include('layouts.admin-topMenus')

        @elseif(\Request::is('user/*') && Auth::guard('web')->check())

           @include('layouts.user-topMenus')

        @elseif(\Request::is('doctor/*') && Auth::guard('doctor')->check())

           @include('layouts.doctor-topMenus')

         @endif
         

        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-dark-olive">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
    <i class="nav-icon fas fa-home"></i>
      <span class="brand-text font-weight-light">Welcome Page</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE-3.1.0/dist/img/3d-illustration-person-with-sunglasses_23-2149436188.avif') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block">
            @if(\Request::is('admin/*') && Auth::guard('admin')->check())
                   {{ Auth::guard('admin')->user()->name }}
            @elseif(\Request::is('user/*') && Auth::guard('web')->check())
                  {{ \Auth::guard('web')->user()->name }}
            @elseif(\Request::is('doctor/*') && Auth::guard('doctor')->check())
                  {{ \Auth::guard('doctor')->user()->name }}
            @endif
          
          </a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


          @if(\Request::is('admin/*') && Auth::guard('admin')->check())

               @include('layouts.admin-sideMenus')

          @elseif(\Request::is('user/*') && Auth::guard('web')->check())

               @include('layouts.user-sideMenus')

          @elseif(\Request::is('doctor/*') && Auth::guard('doctor')->check())

               @include('layouts.doctor-sideMenus')

          @endif
         
        

        </ul>
      </nav>
      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-3.1.0/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
