  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{@url('/dashboard')}}" class="brand-link">
      <img src="{{@url('/admin/dist/img/AdminLTELogo.png')}}" class="brand-image elevation-3" style="opacity: .8">
      <!-- <img src="{{@url('/admin/dist/img/AdminLTELogo.png')}}" alt="{{ config('app.name') }}" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{@url('/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{@url('/dashboard')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline d-none">
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
          <li class="nav-item {{$dashboardOpening ?? ''}}  {{$dashboardOpend ?? ''}}">
            <a href="{{@url('/dashboard')}}" class="nav-link {{$dashboardActive??''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if (Gate::check('role-list') || Gate::check('role-create'))
          <li class="nav-item {{$roleOpening??''}} {{$roleOpend??''}}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Roles
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('role-list') 
              <li class="nav-item">
                <a href="{{@url('/roles')}}" class="nav-link {{$roleListActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              @endcan
              @can('role-create') 
              <li class="nav-item">
                <a href="{{@url('roles/create')}}" class="nav-link {{$roleCreateActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              @endcan
              
            </ul>
          </li>
          @endif
          <!-- special -->
          <?php /*<li class="nav-item {{$userOpening??''}} {{$userOpend??''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{@url('/users')}}" class="nav-link {{$userListActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{@url('/users/create')}}" class="nav-link {{$userCreateActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              
            </ul>
          </li> */ ?>
          <!-- special -->
          
          @if (Gate::check('user-list') || Gate::check('user-create'))
          <li class="nav-item {{$userOpening??''}} {{$userOpend??''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('user-list')
            <li class="nav-item">
              <a href="{{@url('/users')}}" class="nav-link {{$userListActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              @endcan
              @can('user-create')
              <li class="nav-item">
                <a href="{{@url('/user/create')}}" class="nav-link {{$userCreateActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              @endcan
              
            </ul>
          </li>
          @endif

          @if (Gate::check('employee-list') || Gate::check('employee-create'))
          <li class="nav-item {{$employeeOpening??''}} {{$employeeOpend??''}}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Employees
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('employee-list') 
              <li class="nav-item">
                <a href="{{@url('/employees')}}" class="nav-link {{$employeeListActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              @endcan
              {{-- @can('employee-create') 
              <li class="nav-item">
                <a href="{{@url('/employee/create')}}" class="nav-link {{$employeeCreateActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              @endcan --}}
              
            </ul>
          </li>
          @endif

          <li class="nav-item ">
            <a href="{{@url('/employee/search')}}" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Search Employee
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{@url('/employeehistory/create')}}" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Create Employee
              </p>
            </a>
          </li>

          @if (Gate::check('notification-list'))
          <li class="nav-item {{$notificationsOpening??''}} {{$notificationsOpend??''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Notifications
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('notification-list')
            <li class="nav-item">
              <a href="{{@url('/notifications')}}" class="nav-link {{$notificationsListActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              @endcan
              <!-- @can('user-create')
              <li class="nav-item">
                <a href="{{@url('/users/create')}}" class="nav-link {{$userCreateActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              @endcan -->
              
            </ul>
          </li>
          @endif
          @can('app-settings')
          <li class="nav-item {{$appSettingsOpening??''}} {{$appSettingsOpend??''}}">
            <a href="{{@url('/app-settings')}}" class="nav-link {{$appSettings??''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                App Settings
                <!-- <i class="fas fa-angle-left right"></i> -->
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          @endcan

          <li class="nav-item {{$profileOpening??''}} {{$profileOpend??''}}">
            <a href="{{@url('users/change-password')}}" class="nav-link {{$profile??''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          @can('zoom-settings')
          <li class="nav-item {{$appSettingsOpening??''}} {{$appSettingsOpend??''}}">
            <a href="{{@url('/zoom-settings')}}" class="nav-link {{$appSettings??''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Zoom App Settings
                <!-- <i class="fas fa-angle-left right"></i> -->
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          @endcan

          @if (Gate::check('meeting-list') || Gate::check('meeting-create'))
          <li class="nav-item {{$meetingOpening??''}} {{$meetingOpend??''}}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Meetings
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('meeting-list')
              <li class="nav-item">
                <a href="{{@url('/meetings')}}" class="nav-link {{$meetingListActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{@url('/meetings/calendar')}}" class="nav-link {{$calendarSettings??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Calendar</p>
                </a>
              </li>
            @endcan
            @can('meeting-create')
              <li class="nav-item">
                <a href="{{@url('/meetings/create')}}" class="nav-link {{$meetingAddActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
            @endcan
            </ul>
          </li>
          @endif

          <?php /* @if (Gate::check('camera-settings') || Gate::check('camera-settings'))
          <li class="nav-item {{$cameraSettingsOpening??''}} {{$cameraSettingsOpend??''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Camera
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('camera-settings')
            <li class="nav-item">
              <a href="{{@url('/camera-settings')}}" class="nav-link {{$cameraSettings??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Settings</p>
                </a>
              </li>
              @endcan
              @can('user-create')
              <!-- <li class="nav-item">
                <a href="{{@url('/users/create')}}" class="nav-link {{$blogCreateActive??''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li> -->
              @endcan
              
            </ul>
          </li>
          @endif */ ?>
          <li class="nav-item">
            <a class="nav-link" href="JAVASCRIPT://" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="far fa-circle  nav-icon"></i>
                <p>{{ __('Logout') }}</p>
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