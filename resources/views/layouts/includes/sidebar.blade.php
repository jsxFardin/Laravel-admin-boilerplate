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

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link
                        {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- @can('list-location')
                    <li class="nav-item">
                        <a href="{{ route('location.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-location-arrow"></i>
                        <p>Location</p>
                        </a>
                    </li>
                @endcan --}}
                @can('list-destination')
                    <li class="nav-item">
                        <a href="{{ route('destination.index') }}" class="nav-link 
                            {{ request()->is('destination*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map"></i>
                            <p>
                                Destination
                            </p>
                        </a>
                    </li>
                @endcan
                @can('list-expense')
                    <li class="nav-item">
                        <a href="{{ route('expense.index') }}" class="nav-link
                            {{ request()->is('expense*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>Expense </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item {{ request()->is('settings/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link
                        {{ request()->is('settings/*') ? 'active' : '' }}">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: {{ request()->is('settings/*') ? 'block' : 'none' }}">
                        @can('list-role')
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link
                                    {{ request()->is('settings/role*') ? 'active' : '' }}">
                                    <i class="fas fa-user-tag nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        @endcan
                        @can('list-user')
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link
                                    {{ request()->is('settings/user*') ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
