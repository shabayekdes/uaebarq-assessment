<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">

        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('images/'.auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                {{-- Dashboard --}}
                <li class="nav-item">
                    <router-link to="/admin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </router-link>
                </li>
                {{-- Video --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link{{ Request::is('admin/videos') || Request::is('admin/video.*') ? ' active' : ''}}">
                        <i class="nav-icon fas fa-photo-video"></i>
                        <p>
                            Videos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <!-- <router-link to="/admin/" class="nav-link" active-class="active" exact>
                        <i class="nav-icon fas fa-video"></i>
                        <p>
                            List Videos
                        </p>
                    </router-link> -->
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <router-link to="/admin/videos" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-video"></i>
                                <p>
                                    List Videos
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/video/create" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-cloud-upload-alt"></i>
                                <p>
                                    Add Video
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                {{-- Logout --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
