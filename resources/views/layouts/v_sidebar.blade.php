<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ URL::asset('theme/adminlte3/dist/img/avatar4.png' ) }}" class="img-circle elevation-2" alt="Eko Motor Rent">
        </div>
        <div class="info">
            <a href="{{ route('home') }}" class="d-block">{{ Session::get('user_full_name') }}</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            @if(UserAuthorization::isAllowed('master-motor') || UserAuthorization::isAllowed('motor-rent'))
                <li class="nav-item has-treeview {{ Str::contains(Route::currentRouteName(), ['master-motor','motor-rent']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Str::contains(Route::currentRouteName(), ['master-motor','motor-rent']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-motorcycle"></i>
                        <p>
                            MENU
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(UserAuthorization::isAllowed('master-motor'))
                            <li class="nav-item">
                                <a href="{{ route('master-motor') }}" class="nav-link {{ Route::currentRouteName() == 'master-motor' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Motor</p>
                                </a>
                            </li>
                        @endif
                        @if(UserAuthorization::isAllowed('motor-rent'))
                            <li class="nav-item">
                                <a href="{{ route('motor-rent') }}" class="nav-link {{ Route::currentRouteName() == 'motor-rent' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Motor Rent</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Session::get('user_role_id') == 1)
                @include('layouts.v_admin_sidebar')
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
