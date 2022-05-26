
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | Eko Motor Rent</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <style>
        .login-page {
            background-image: url({{ asset('images/bg-login-sewa-motor.jpeg') }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img class="img-fluid pad" src="{{ URL::asset('images/icon-eko.png') }}" alt="Photo" width="200px">
    </div>
    <div class="login-logo">

    </div>
    <!-- /.login-logo -->
    <div class="card">
            <div class="overlay" id="overlay-login" hidden>
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg h4">Eko Motor Rent</p>
            <form action="{{ route('login.validate') }}" method="post" id="form-login" autocomplete="off">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="txt_email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="txt_password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Captcha" name="txt_captcha" id="captcha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-unlock-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <div id="captha-js">
                        {!! captcha_img('inverse') !!}
                    </div>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <p>Your IP : <strong>{{ \Request::ip() }}</strong></p>
                </div>
                <div class="input-group mb-3">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="btn-sign-in">Sign In</button>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ URL::asset('theme/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('theme/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('theme/adminlte3/dist/js/adminlte.min.js') }}"></script>
<!-- AES -->
<script src="{{ asset('js/aes.js') }}"></script>
<script>

    let CryptoJSAesJson = {
        stringify: function (cipherParams) {
            let j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
            if (cipherParams.iv) j.iv = cipherParams.iv.toString();
            if (cipherParams.salt) j.s = cipherParams.salt.toString();
            return JSON.stringify(j);
        },
        parse: function (jsonStr) {
            let j = JSON.parse(jsonStr);
            let cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
            if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
            if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
            return cipherParams;
        }
    }

    $("#form-login").on("submit", function (event) {
        event.preventDefault();

        let url  = $("#form-login").attr('action');
        let email = $("input[name=txt_email]").val();
        let pass = $("input[name=txt_password]").val();
        let captcha = $("input[name=txt_captcha]").val();

        if (email == '' || pass == '' || captcha == '') {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Error',
                position: 'bottomRight',
                body: 'Email, Password and Captcha are required ..',
                icon: 'fas fa-envelope fa-lg',
                autohide: true,
                delay: 10000,
            });
        } else {
            let passphrase = 'd45h804rd4rt5';
            let encPassword = CryptoJS.AES.encrypt(JSON.stringify(pass), passphrase, {format: CryptoJSAesJson}).toString();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url,
                type : 'POST',
                data : {
                    _token: "{{ csrf_token() }}",
                    email : email,
                    password : encPassword,
                    captcha: captcha,
                },
                beforeSend : function () {
                    // add overlay
                    $("#overlay-login").removeAttr("hidden");
                    $('#btn-sign-in').attr('disabled', 'disabled');
                },
                success : function(data) {
                    console.log(data);
                    let obj = jQuery.parseJSON(JSON.stringify(data));
                    if (obj.code == '00') {
                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: data.status,
                            position: 'bottomRight',
                            body: data.message,
                            icon: 'fas fa-envelope fa-lg',
                            autohide: true,
                            delay: 10000,
                        });
                        $("#overlay-login").attr("hidden",true);
                        setTimeout(function () {
                            window.location = data.redirect;
                        }, 1500);
                    }
                    else {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: data.status,
                            position: 'bottomRight',
                            body: data.message,
                            icon: 'fas fa-envelope fa-lg',
                            autohide: true,
                            delay: 10000,
                        });
                        $("#overlay-login").attr("hidden",true);
                        $("#captha-js").html(data.captcha);
                    }
                    $('#btn-sign-in').removeAttr("disabled");
                },
                error: function(xhr) {
                    let XHR = JSON.parse(xhr.responseText);
                    let html = '';
                    for (let key in XHR.errors)
                    {
                        html += '<li>'+ XHR.errors[key][0] + '</li>'
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
                    $("#captha-js").html(XHR.captcha);
                    $("#overlay-login").attr("hidden",true);
                    $('#btn-sign-in').removeAttr("disabled");
                }
            });
        }
    });
</script>

</body>
</html>
