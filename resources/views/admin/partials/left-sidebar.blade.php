@php
    $current_route = request()->route()->getName();
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('admin-assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="{{ asset('admin-assets/dist/img/avatar4.png') }}" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
          <a href="#" class="d-block">
            <?php use App\Models\Agency;
            $agency=Agency::find(auth()->user()->agency_id);
            echo ($agency?$agency->agency_name:"");?>
          </a>
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
        
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{ $current_route=='dashboard'?'active':'' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                      Dashboard
                  </p>
              </a>
            </li>
            
            @if (str_contains( auth()->user()->level_access, 'Admin'))
              <li class="nav-item">
                <a href="{{ route('agency.index') }}" class="nav-link {{ $current_route=='agency.index'?'active':'' }}">
                    <i class="nav-icon fa fa-university"></i>
                        <p>
                        Agency
                    </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('platform.index') }}" class="nav-link {{ $current_route=='platform.index'?'active':'' }}">
                    <i class="nav-icon fa fa-street-view"></i>
                        <p>
                        Platform
                    </p>
                </a>
                <li class="nav-item">
                <a href="{{ route('recruit.index') }}" class="nav-link {{ $current_route=='recruit.index'?'active':'' }}">
                    <i class="nav-icon fa fa-address-card"></i>
                        <p>
                        Recruit
                    </p>
                </a>
                </li>
              @endif
                <li class="nav-item">
                <a href="{{ route('host.index') }}" class="nav-link {{ $current_route=='host.index'?'active':'' }}">
                    <i class="nav-icon fa fa-plus-square"></i>
                        <p>
                        Host
                    </p>
                </a>
                </li>
                </li>
                <li class="nav-item">
                <a href="{{ route('reportagency.index') }}" class="nav-link {{ $current_route=='reportagency.index'?'active':'' }}">
                    <i class="nav-icon fa fa-archive"></i>
                        <p>
                        Report Agency
                    </p>
                </a>
                </li>
              @if (str_contains( auth()->user()->level_access, 'Admin'))
                <li class="nav-item {{ $current_route=='users.index'?'menu-open':'' }}">
                  <a href="#" class="nav-link {{ $current_route=='users.index'?'active':'' }}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                      User Management
                      <i class="right fas fa-angle-left"></i>
                  </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ $current_route=='users.index'?'active':'' }}">
                        <i class="far fas fa-user"></i>
                        <p>Users</p>
                        </a>
                    </li>
                  </ul>
              </li>
            @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>