
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recover Password | ARTS Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

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
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <p class="login-box-msg"><img class="img-fluid pad" src="{{ URL::asset('images/logo-arms.png') }}" alt="Photo" width="180px"></p>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="overlay" id="overlay-recover-password" hidden>
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Password must be changed</p>

            <form action="{{ route('recover-password.validate') }}" method="post" autocomplete="off" id="form-recover-password">
                @csrf
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="txt_recover_password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="txt_recover_password_confirmation" id="password-confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ URL::asset('theme/adminlte3/plugins/jquery/jquery.min.js ') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('theme/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js ') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('theme/adminlte3/dist/js/adminlte.min.js ') }}"></script>
<script>

    $("#form-recover-password").on("submit", function (event) {
        event.preventDefault();

        var url  = $("#form-recover-password").attr('action');
        var pass = $("input[name=txt_recover_password]").val();
        var confirmation_pass = $("input[name=txt_recover_password_confirmation]").val();

        if (pass == '' || confirmation_pass == '') {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Error',
                position: 'bottomRight',
                body: 'Password and Confirm Password cant empty ..',
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url,
                type : 'POST',
                data : $("#form-recover-password").serialize(),
                beforeSend : function () {
                    // add overlay
                    $("#overlay-recover-password").removeAttr("hidden");
                },
                success : function(data) {
                    setTimeout(function(){
                        // Button loading reset
                        var obj = jQuery.parseJSON(JSON.stringify(data));

                        if (obj.status == 'error') {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: obj.title,
                                position: 'bottomRight',
                                body: obj.message,
                                icon: 'fas fa-envelope fa-lg',
                                autohide: true,
                                delay: 10000,
                            });
                            $("#overlay-recover-password").attr("hidden",true);
                            $("#password").val('');
                            $("#password-confirmation").val('');
                        }
                        else if (obj.status == 'errors') {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: obj.title,
                                position: 'bottomRight',
                                body: obj.message,
                                icon: 'fas fa-envelope fa-lg',
                                autohide: true,
                                delay: 10000,
                            });
                            $("#overlay-recover-password").attr("hidden",true);
                            $("#password").val('');
                            $("#password-confirmation").val('');
                        } else {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: obj.title,
                                position: 'bottomRight',
                                body: obj.message,
                                icon: 'fas fa-envelope fa-lg',
                                autohide: true,
                                delay: 10000,
                            });
                            $("#overlay-recover-password").attr("hidden",true);
                            setTimeout(function () {
                                window.location = data.redirect;
                            }, 1500);
                        }
                    }, 500);
                },
                error: function(xhr) {
                    var xhr = JSON.parse(xhr.responseText);
                    var html = '';
                    for (var key in xhr.errors)
                    {
                        html += '<li>'+ xhr.errors[key][0] + '</li>'
                    }
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: xhr.message,
                        position: 'bottomRight',
                        body: html,
                        icon: 'fas fa-envelope fa-lg',
                        autohide: true,
                        delay: 10000,
                    });
                    $("#overlay-recover-password").attr("hidden",true);
                }
            });
        }
    });
</script>
</body>
</html>
