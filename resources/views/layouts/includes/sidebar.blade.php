<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light pcmLogo">PCM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @can('dashboard-menu')
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link
                        {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endcan
              
                @can('settings-menu')
                <li class="nav-item {{ request()->is('settings/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link
                        {{ request()->is('settings/*') ? 'active' : '' }}">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: {{ request()->is('settings/*') ? 'block' : 'none' }}">
                        @can('list-role')
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}"
                                    class="nav-link
                                    {{ request()->is('settings/role*') ? 'active' : '' }}">
                                    <i class="fas fa-user-tag px-2"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        @endcan
                        @can('list-user')
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link
                                    {{ request()->is('settings/user*') ? 'active' : '' }}">
                                    <i class="fas fa-users px-2"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
