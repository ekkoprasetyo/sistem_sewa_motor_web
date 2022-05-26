<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Eko Motor Rent</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Google Font: Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css ') }}">

    <link rel="shortcut icon" href="{{ URL::asset('favicon/favicon.ico') }}">
    <link rel="icon" sizes="16x16 32x32 64x64" href="{{ URL::asset('favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="196x196" href="{{ URL::asset('favicon/favicon-192.png') }}">
    <link rel="icon" type="image/png" sizes="160x160" href="{{ URL::asset('favicon/favicon-160.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('favicon/favicon-96.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ URL::asset('favicon/favicon-64.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('favicon/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('favicon/favicon-16.png') }}">
    <link rel="apple-touch-icon" href="{{ URL::asset('favicon/favicon-57.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('favicon/favicon-114.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('favicon/favicon-72.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('favicon/favicon-144.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('favicon/favicon-60.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('favicon/favicon-120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('favicon/favicon-76.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('favicon/favicon-152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('favicon/favicon-180.png') }}">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="{{ URL::asset('favicon/favicon-144.png') }}">
    <meta name="msapplication-config" content="{{ URL::asset('favicon/browserconfig.xml') }}">

    @yield('app_style')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/toasts/custom-toasts.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/custom/adminlte.css') }}">

    <style>
        .clock {
            position: absolute;
            left: 20%;
            /*right: 30%;*/
            /*margin-left: -50px !important;*/
            text-align: center;
            display: block;
            padding-left: 16%;
            font-size: 1.7em;
            font-family: 'Open Sans', sans-serif;
            color: #ffffff;
        }

        @media only screen and (max-width: 1024px) {
            .clock {
                position: absolute;
                /*left: 14%;*/
                right: 25%;
                /*margin-left: -50px !important;*/
                text-align: center;
                display: block;
                padding-left: 1%;
                font-size: 1.6em;
                font-family: 'Open Sans', sans-serif;
                color: #ffffff;
            }
        }

        @media only screen and (max-width: 600px) {
            .clock {
                position: absolute;
                left: 14%;
                /*right: 30%;*/
                /*margin-left: -50px !important;*/
                text-align: center;
                display: block;
                padding-left: 1%;
                font-size: 1.2em;
                font-family: 'Open Sans', sans-serif;
                color: #ffffff;
            }
        }

        @media only screen and (max-width: 300px) {
            .clock {
                position: absolute;
                left: 14%;
                /*right: 30%;*/
                /*margin-left: -50px !important;*/
                text-align: center;
                display: block;
                padding-left: 1%;
                font-size: 0.6em;
                font-family: 'Open Sans', sans-serif;
                color: #ffffff;
            }
        }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm {{ Str::contains(Route::currentRouteName(), ['dashboard']) ? 'sidebar-collapse' : '' }}">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ URL::asset('images/icon-eko.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary navbar-dark border-bottom-0">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <div class="clock text-center" id="clock"></div>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
    {{--            <li class="nav-item">--}}
    {{--                <a class="nav-link" data-widget="navbar-search" href="#" role="button">--}}
    {{--                    <i class="fas fa-search"></i>--}}
    {{--                </a>--}}
    {{--                <div class="navbar-search-block">--}}
    {{--                    <form class="form-inline">--}}
    {{--                        <div class="input-group input-group-sm">--}}
    {{--                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
    {{--                            <div class="input-group-append">--}}
    {{--                                <button class="btn btn-navbar" type="submit">--}}
    {{--                                    <i class="fas fa-search"></i>--}}
    {{--                                </button>--}}
    {{--                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">--}}
    {{--                                    <i class="fas fa-times"></i>--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </li>--}}

                <li class="nav-item dropdown">
                    <div id="assign-inventory-group-notification"></div>
                </li>

                <li class="nav-item dropdown">
                    <div id="assign-inventory-notification"></div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"><strong>{{ Session::get('user_full_name') }} </strong></a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a type="button" onclick="changeProfile('{{ Session::get('user_id') }}','{{ route('change-profile') }}')" class="dropdown-item">
                        {{--                            <a href="/change_profile" class="dropdown-item">--}}
                        <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-sm">{{ Session::get('user_role') }}</p>
                                    <p class="text-sm text-success"><i class="far fa-clock mr-1"></i> {{ Session::get('user_last_login_date') }}</p>
                                    <p class="text-sm text-danger"><i class="fas fa-laptop-code"></i> {{ Session::get('user_last_login_ip') }}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a type="button" onclick="changeProfilePassword('{{ Session::get('user_id') }}','{{ route('change-profile.password') }}')" class="dropdown-item dropdown-footer">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('login.destroy') }}" class="dropdown-item dropdown-footer">Log Out !</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
    {{--            <li class="nav-item dropdown">--}}
    {{--                <a class="nav-link" data-toggle="dropdown" href="#">--}}
    {{--                    <i class="far fa-bell"></i>--}}
    {{--                    <span class="badge badge-warning navbar-badge">15</span>--}}
    {{--                </a>--}}
    {{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
    {{--                    <span class="dropdown-item dropdown-header">15 Notifications</span>--}}
    {{--                    <div class="dropdown-divider"></div>--}}
    {{--                    <a href="#" class="dropdown-item">--}}
    {{--                        <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
    {{--                        <span class="float-right text-muted text-sm">3 mins</span>--}}
    {{--                    </a>--}}
    {{--                    <div class="dropdown-divider"></div>--}}
    {{--                    <a href="#" class="dropdown-item">--}}
    {{--                        <i class="fas fa-users mr-2"></i> 8 friend requests--}}
    {{--                        <span class="float-right text-muted text-sm">12 hours</span>--}}
    {{--                    </a>--}}
    {{--                    <div class="dropdown-divider"></div>--}}
    {{--                    <a href="#" class="dropdown-item">--}}
    {{--                        <i class="fas fa-file mr-2"></i> 3 new reports--}}
    {{--                        <span class="float-right text-muted text-sm">2 days</span>--}}
    {{--                    </a>--}}
    {{--                    <div class="dropdown-divider"></div>--}}
    {{--                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
    {{--                </div>--}}
    {{--            </li>--}}
    {{--            <li class="nav-item">--}}
    {{--                <a class="nav-link" data-widget="fullscreen" href="#" role="button">--}}
    {{--                    <i class="fas fa-expand-arrows-alt"></i>--}}
    {{--                </a>--}}
    {{--            </li>--}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="{{ URL::asset('images/icon-eko.png') }}" alt="Eko Motor Rent Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Eko Motor Rent</span>
            </div>

            @include('layouts.v_sidebar')
        </aside>

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021-{{ date('Y') }} <a href="https://instagram.com/ekkoprasetyo">EKO</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Eko Motor Rent</b> 1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- modal change profile  -->
    <div class="modal fade" id="modal-change-profile">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="overlay-change-profile" hidden="hidden">
                    <div class="overlay d-flex justify-content-center align-items-center">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title">Change Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('change-profile.update-profile') }}" id="form-change-profile" autocomplete="off">
                    <div class="modal-body">
                        <div id="form-change-profile-js"></div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="btn-submit-change-profile">Update !</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal change profile  -->

    <!-- modal change profile password -->
    <div class="modal fade" id="modal-change-profile-password">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="overlay-change-profile-password" hidden="hidden">
                    <div class="overlay d-flex justify-content-center align-items-center">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title">Change Profile Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('change-profile.update-password') }}" id="form-change-profile-password" autocomplete="off">
                    <div class="modal-body">
                        <div id="form-change-profile-password-js"></div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="btn-submit-change-profile-password">Update !</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal change profile password -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- MomentJS -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/moment/moment.min.js') }}"></script>
    <!-- Clock -->
    <script src="{{ URL::asset('js/custom/clock.js ') }} "></script>
    <!-- Custom -->
    <script src="{{ URL::asset('js/custom/change-profile.js') }}"></script>
    <script src="{{ URL::asset('js/custom/change-profile-password.js') }}"></script>

    @yield('app_js')
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('theme/adminlte3/dist/js/adminlte.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            var srv_clock = '';

            $.get("{{ route('clock') }}", function(data, status){
                srv_clock = data.clock;
                if (data.status == 'success') {
                    var clock = new my_Clock(srv_clock);
                    clock.run();
                } else {
                }
            });
        })
    </script>

    @if (Session::has('success_notification'))
        <script type="text/javascript">
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Success',
                position: 'bottomRight',
                body: '{{ Session::get('success_notification') }}',
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
        </script>
    @endif

    @if (Session::has('warning_notification'))
        <script type="text/javascript">
            $(document).Toasts('create', {
                class: 'bg-warning',
                title: 'Warning',
                position: 'bottomRight',
                body: '{{ Session::get('warning_notification') }}',
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
        </script>
    @endif

    @if (Session::has('error_notification'))
        <script type="text/javascript">
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Error',
                position: 'bottomRight',
                body: '{{ Session::get('error_notification') }}',
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
        </script>
    @endif

    @if (Session::has('auth_error_notification'))
        <script type="text/javascript">
            $(document).Toasts('create', {
                class: 'bg-warning',
                title: 'Authorization Error',
                position: 'bottomRight',
                body: '{{ Session::get('auth_error_notification') }}',
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
        </script>
    @endif

    @if (Session::has('info_notification'))
        <script type="text/javascript">
            $(document).Toasts('create', {
                class: 'bg-info',
                title: 'Info',
                position: 'bottomRight',
                body: '{{ Session::get('info_notification') }}',
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
        </script>
    @endif
</body>
</html>
