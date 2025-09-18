<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/assets/demo/favicon.png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
    <!-- CSS -->
    <link href="/public/assets/vendors/material-icons/material-icons.css" rel="stylesheet" type="text/css">
    <link href="/public/assets/vendors/mono-social-icons/monosocialiconsfont.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/public/assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body class="body-bg-full profile-page" style="background-image: url(/public/assets/demo/night.jpg)">
    <div id="wrapper" class="row wrapper">
        <div class="col-10 ml-sm-auto col-sm-6 col-md-4 ml-md-auto login-center mx-auto">
            <div class="navbar-header text-center">
                <a href="index.html">
                    <img alt="" src="/public/assets/img/logo-expand-dark.png">
                </a>
            </div>
            <!-- /.navbar-header -->
            <form class="form-material" id="formLogin" method="POST" action="null">
                <div class="form-group">
                    <input type="text" placeholder="Username" class="form-control form-control-line" name="username" id="username">
                    <label for="username">Username</label>
                </div>
                <div class="form-group">
                    <input type="password" id="password" placeholder="password" class="form-control form-control-line">
                    <label>Password</label>
                </div>
                <input type="hidden" name="_token" value="{{ $_token }}">
                <div class="form-group">
                    <button id="loginBtn" class="btn btn-block btn-lg btn-color-scheme ripple" type="submit">Login</button>
                </div>
                {{-- <div class="form-group no-gutters mb-0">
                    <div class="col-md-12 d-flex">
                        <div class="checkbox checkbox-info mr-auto">
                            <label class="d-flex">
                                <input type="checkbox"> <span class="label-text">Remember me</span>
                            </label>
                        </div><a href="javascript:void(0)" id="to-recover" class="my-auto pb-2 text-right"><i class="fa fa-lock mr-1"></i>Forgot Password?</a>
                    </div>
                    <!-- /.col-md-12 -->
                </div> --}}
                <!-- /.form-group -->
            </form>
            <!-- /.form-material -->
            <!-- /.btn-list -->
            {{-- <footer class="col-sm-12 text-center">
                <hr>
                <p>Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a>
                </p>
            </footer> --}}
        </div>
        <!-- /.login-center -->
    </div>
    <!-- /.body-container -->
    <!-- Scripts -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/material-design.js"></script>

    <script>
        $(document).ready(function() {
            $('#formLogin').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val(),
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '/dashboard';
                        } else {
                            // alert('Login failed: ' + response.message);
                            swal('Error', response.message, 'error');
                            $('input[name="_token"]').val(response._token);
                        }
                    },
                    error: function() {
                        swal('Error', 'An error occurred while processing your request.', 'error');
                    }
                });
            });
        });
    </script>
</body>

</html>