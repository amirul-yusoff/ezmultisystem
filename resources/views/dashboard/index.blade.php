<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset("/assets/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("/assets/dist/css/adminlte.min.css")}}">
  <!--load all Font Awesome styles -->
  <link rel="stylesheet" href="/assets/fontawesome/css/all.css">
  <link href="/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="/assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="/assets/fontawesome/css/solid.css" rel="stylesheet">

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset("/assets/plugins/jquery/jquery.min.js")}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset("/assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset("/assets/dist/js/adminlte.min.js")}}"></script>
</head>
<body class="hold-transition sidebar-mini">
  <?php
   $dashboard = App\Models\module :: where('isdelete',0)->get();
  ?>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <div>
          <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
          <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
          <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Online" data-off="Offline" {{ $user->is_active ? 'checked' : '' }}>
          
          <script>
            $(function() { 
                    $('.toggle-class').change(function() { 
                    var is_active = $(this).prop('checked') == true ? 1 : 0;  
                    var user_id = $(this).data('id');  
                    $.ajax({ 
                    
                        type: "GET", 
                        dataType: "json", 
                        url: '/dashboard/status/update', 
                        data: {'is_active': is_active, 'user_id': user_id}, 
                        success: function(data){ 
                        console.log(data.success) 
                        setTimeout(function() {
                            toastr.options = {
                                showMethod: 'slideDown',
                                timeOut: 1500
                            };
                            toastr.success('Member List Reload');
                        }, 300);
                     } 
                  }); 
               }) 
            }); 
          </script>
        </div>
        <li class="nav-item d-none d-sm-inline-block">
          <a href= "{{ route('home') }}" class="nav-link">Home</a>
         
         
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href= "{{ route('contact-us') }}" class="nav-link">Contact Us</a>
        </li>
      </ul>
  
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
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
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
              <i class="fa fa-sign-out"></i>
          </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> --}}
      </ul>
    </nav>
    <!-- /.navbar -->
  
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="home" class="brand-link">
        <img src="{{asset("/assets/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">iDeliver</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if ($user->getOneProfilePicture == NULL)
                <img class="img-circle elevation-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
            @else
            <img class="img-circle elevation-2" src="{{asset("/upload/Users/".$user->getOneProfilePicture->users_id."/".$user->getOneProfilePicture->hash.".".$user->getOneProfilePicture->extension."")}}" alt="profile_pic">
            @endif
            {{-- <img src="{{asset("/assets/dist/img/User.png")}}" class="img-circle elevation-2" alt="User Image"> --}}
          </div>
          <div class="info">
            <a href="/profile/view" class="d-block">{{$user->username}}</a>
          </div>
        </div>
  
        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
          @foreach ($dashboard as $item)
              @if ($item->parent_id == 0 && $item->url == NULL)
              <li class="nav-item menu-close">
                  <a href="#" class="nav-link ">
                    {{-- Open Blue  --}}
                  {{-- <a href="#" class="nav-link active"> --}}
                  <i class="{{$item->icon}}"></i>
                  <p>
                      {{$item->module_name}}
                      <i class="right fas fa-angle-left"></i>
                  </p>
                  </a>
                  
              @elseif ($item->parent_id == 0 && $item->url != NULL)
              <li class="nav-item">
                  <a href="{!! $item->url !!}" class="nav-link {{ (app('request')->route()->uri()== "{!! $item->url !!}") ? "active" : ""}} "> 
                  <i class="{{$item->icon}}"></i>
                    <p>
                        {{$item->module_name}}
                    {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a>   
              @endif
  
              @foreach ($dashboard as $itemSub)
              @if ($itemSub->parent_id == $item->id)
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{!! $itemSub->url !!}" class="nav-link {{ (app('request')->route()->uri()== "{!! $itemSub->url !!}") ? "active" : ""}} "> 
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{$itemSub->module_name}}</p>
                    </a>
                  </li>
                </ul>  
              @endif
              @endforeach
            </li>
            @endforeach
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Simple Link
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li> --}}
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->
  
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      {{-- <div class="float-right d-none d-sm-inline">
        Anything you want
      </div> --}}
      <!-- Default to the left -->
      {{-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. --}}
    </footer>
  </div>
<!-- ./wrapper -->


</body>
</html>
