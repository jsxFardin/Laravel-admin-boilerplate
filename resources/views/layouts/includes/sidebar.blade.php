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
                        <a href="{{ route('destination.index') }}"
                            class="nav-link 
                            {{ request()->is('destination*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map"></i>
                            <p>
                                Destination
                            </p>
                        </a>
                    </li>
                @endcan
                @can('expense-menu')
                    <li class="nav-item {{ request()->is('expense*') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link
                            {{ request()->is('expense*') ? 'active' : '' }}">
                            <i class="fas fa-money-check-alt nav-icon"></i>
                            <p>
                                Expense
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: {{ request()->is('expense*') ? 'block' : 'none' }}">
                            @can('list-expense')
                                <li class="nav-item">
                                    <a href="{{ route('expense.index') }}"
                                        class="nav-link
                                        {{ request()->is('expense') ? 'active' : '' }}">
                                        <i class="fas fa-money-check-alt px-2"></i>
                                        <p>Expense</p>
                                    </a>
                                </li>
                            @endcan
                            @can('approve-list-expense')
                                <li class="nav-item">
                                    <a href="{{ route('expense.approve-list') }}"
                                        class="nav-link
                                        {{ request()->is('expense/approve-list') ? 'active' : '' }}">
                                        <i class="fas fa-check px-2"></i>
                                        <p>Approve Expense</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
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
                                    <p>Employee</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('reports-menu')
                <li class="nav-item {{ request()->is('reports/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link
                        {{ request()->is('reports/*') ? 'active' : '' }}">
                        <i class="fas fa-file nav-icon"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: {{ request()->is('reports/*') ? 'block' : 'none' }}">
                        @can('show-monthly-report')
                        <li class="nav-item">
                            <a href="{{ route('reports.monthly-report') }}"
                                class="nav-link
                                {{ request()->is('reports/monthly-report*') ? 'active' : '' }}">
                                <i class="fas fa-teeth px-2"></i>
                                <p>Monthly Report</p>
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
