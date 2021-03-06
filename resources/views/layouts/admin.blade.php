<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="{{ url('/') }}/css/admin/style.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" id="layout-navbar">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin') }}" class="nav-link">Home</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
      <li class="nav-item d-none d-sm-inline-block">
	<a class="nav-link" href="{{ route('logout') }}"
	   onclick="event.preventDefault();
			 document.getElementById('logout-form').submit();">
	    {{ __('Logout') }}
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	    @csrf
	</form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" id="layout-sidebar">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!--<img src="{{ url('/') }}/vendor/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <img src="{{ url('/') }}//images/starter-cms-logo.png" alt="StarterCMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Starter CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/').Auth::user()->getThumbnail() }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!--<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
	  <li class="nav-item">
	      @php $active = (request()->is('admin')) ? 'active' : '' @endphp
	      <a href="{{ route('admin') }}" class="nav-link {{ $active }}">
		<i class="nav-icon fas fa-chart-line"></i>
		  <p>@lang ('labels.title.dashboard')</p>
	      </a>
          </li>
	  @allowto ('create-user')
	      @php $open = (request()->is('admin/users*')) ? 'menu-open' : '' @endphp
	      <li class="nav-item {{ $open }}">
		  @php $active = (request()->is('admin/users*')) ? 'active' : '' @endphp
		  <a href="#" class="nav-link {{ $active }}">
		    <i class="nav-icon fas fa-users"></i>
		    <p>@lang ('labels.title.user_management')<i class="right fas fa-angle-left"></i></p>
		  </a>
		  <ul class="nav nav-treeview">
			@php $active = (request()->is('admin/users/users*')) ? true : false @endphp
			<x-menu-item href="{{ route('admin.users.users.index') }}" :sub=true :active="$active">
			  @lang ('labels.title.users')
			</x-menu-item>
		    @allowto ('create-group')
			@php $active = (request()->is('admin/users/groups*')) ? true : false @endphp
			<x-menu-item href="{{ route('admin.users.groups.index') }}" :sub=true :active="$active">
			  @lang ('labels.title.groups')
			</x-menu-item>
		    @endallowto
		    @allowto ('create-role')
			@php $active = (request()->is('admin/users/roles*')) ? true : false @endphp
			<x-menu-item href="{{ route('admin.users.roles.index') }}" :sub=true :active="$active">
			  @lang ('labels.title.roles')
			</x-menu-item>
		    @endallowto
		    @if (auth()->user()->hasRole('super-admin'))
			@php $active = (request()->is('admin/users/permissions*')) ? true : false @endphp
			<x-menu-item href="{{ route('admin.users.permissions.index') }}" :sub=true :active="$active">
			  @lang ('labels.title.permissions')
			</x-menu-item>
		    @endif
		  </ul>
	      </li>
	  @endallowto

	  @allowto ('create-post')
	      @php $open = (request()->is('admin/blog*')) ? 'menu-open' : '' @endphp
	      <li class="nav-item {{ $open }}">
		  @php $active = (request()->is('admin/blog*')) ? 'active' : '' @endphp
		  <a href="#" class="nav-link {{ $active }}">
		    <i class="nav-icon fas fa-pencil-alt"></i>
		    <p>@lang ('labels.title.blog')<i class="right fas fa-angle-left"></i></p>
		  </a>
		  <ul class="nav nav-treeview">
			  @php $active = (request()->is('admin/blog/posts*')) ? true : false @endphp
			  <x-menu-item href="{{ route('admin.blog.posts.index') }}" :sub=true :active="$active">
			    @lang ('labels.title.posts')
			  </x-menu-item>
		      @allowto ('create-blog-category')
			  @php $active = (request()->is('admin/blog/categories*')) ? true : false @endphp
			  <x-menu-item href="{{ route('admin.blog.categories.index') }}" :sub=true :active="$active">
			    @lang ('labels.title.categories')
			  </x-menu-item>
		      @endallowto
		  </ul>
	      </li>
	  @endallowto

	  @allowto ('create-menu')
	      @php $open = (request()->is('admin/menus*')) ? 'menu-open' : '' @endphp
	      <li class="nav-item {{ $open }}">
		  @php $active = (request()->is('admin/menus*')) ? 'active' : '' @endphp
		  <a href="#" class="nav-link {{ $active }}">
		    <i class="nav-icon fas fa-bars"></i>
		    <p>@lang ('labels.title.menus')<i class="right fas fa-angle-left"></i></p>
		  </a>
		  <ul class="nav nav-treeview">
			  @php $active = (request()->is('admin/menus/menus*')) ? true : false @endphp
			  <x-menu-item href="{{ route('admin.menus.menus.index') }}" :sub=true :active="$active">
			    @lang ('labels.title.menus')
			  </x-menu-item>

			  @inject ('menu', 'App\Models\Menus\Menu')
                          @foreach ($menu::getMenus() as $menu)
			      @php $active = (request()->is('admin/menus/'.$menu->code.'/menuitems*')) ? true : false @endphp
			      <x-menu-item href="{{ route('admin.menus.menuitems.index', $menu->code) }}" :sub=true :active="$active">
				 {{ $menu->title }}
			      </x-menu-item>
			  @endforeach
		  </ul>
	      </li>
	  @endallowto

	  @allowtoany (['global-settings', 'blog-settings', 'update-email'])
	      @php $open = (request()->is('admin/settings*')) ? 'menu-open' : '' @endphp
	      <li class="nav-item {{ $open }}">
		  @php $active = (request()->is('admin/settings*')) ? 'active' : '' @endphp
		  <a href="#" class="nav-link {{ $active }}">
		    <i class="nav-icon fas fa-cogs"></i>
		    <p>@lang ('labels.title.settings')<i class="right fas fa-angle-left"></i></p>
		  </a>
		  <ul class="nav nav-treeview">
			@allowto ('global-settings')
			    @php $active = (request()->is('admin/settings/general*')) ? true : false @endphp
			    <x-menu-item href="{{ route('admin.settings.general.index') }}" :sub=true :active="$active">
			      @lang ('labels.title.general')
			    </x-menu-item>
			@endallowto
			@allowto ('blog-settings')
			    <x-menu-item href="#" :sub=true :active=false>
			      Blog
			    </x-menu-item>
			@endallowto
			@allowto ('update-email')
			    @php $active = (request()->is('admin/settings/emails*')) ? true : false @endphp
			    <x-menu-item href="{{ route('admin.settings.emails.index') }}" :sub=true :active="$active">
			      @lang ('labels.title.emails')
			    </x-menu-item>
			@endallowto
		  </ul>
	      </li>
	  @endallowto
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
	    @yield ('header')
            <!--<h1 class="m-0">Starter Page</h1>-->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!--<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>-->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      @include ('layouts.flash-message')
      @yield ('main')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
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
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ url('/') }}/vendor/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/vendor/adminlte/js/adminlte.min.js"></script>
<!-- Select2 Plugin -->
<script type="text/javascript" src="{{ url('/') }}/vendor/adminlte/plugins/select2/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/vendor/adminlte/plugins/select2/css/select2.min.css"></script>
<!-- Additional js scripts -->
@stack ('scripts')
</body>
</html>
