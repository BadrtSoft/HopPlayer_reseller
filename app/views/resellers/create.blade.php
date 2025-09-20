<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/public/assets/css/pace.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/assets/demo/favicon.png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Reseller Dashboard - {{ APP_NAME }}</title>
    <!-- CSS -->
    <link href="/public/assets/vendors/material-icons/material-icons.css" rel="stylesheet" type="text/css">
    <link href="/public/assets/vendors/mono-social-icons/monosocialiconsfont.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css"
        rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    <link href="/public/assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body class="header-light sidebar-dark sidebar-expand">
    <div id="wrapper" class="wrapper">
        <!-- HEADER & TOP NAVIGATION -->
        <nav class="navbar">
            <!-- Logo Area -->
            <div class="navbar-header">
                <a href="index.html" class="navbar-brand">
                    <img class="logo-expand" alt="" src="/public/assets/img/logo-expand.png">
                    <img class="logo-collapse" alt="" src="/public/assets/img/logo-collapse.png">
                    <!-- <p>OSCAR</p> -->
                </a>
            </div>
            <!-- /.navbar-header -->
            <!-- Left Menu & Sidebar Toggle -->
            <ul class="nav navbar-nav">
                <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i class="material-icons list-icon">menu</i></a></li>
            </ul>
            <!-- /.navbar-left -->
            <div class="spacer"></div>
            <div class="btn-list dropdown d-md-flex mr-4 font-weight-bold"> {{ $reseller->credits }} <span class="mr-1 ml-1 text-muted">Credits</span> <i class="text-muted fa fa-credit-card"></i></div>
        </nav>
        <!-- /.navbar -->
        <div class="content-wrapper">
            <!-- SIDEBAR -->
            <aside class="site-sidebar scrollbar-enabled clearfix">
                <!-- User Details -->
                <div class="side-user">
                    <a class="col-sm-12 media clearfix" href="javascript:void(0);">
                        <figure class="media-left media-middle user--online thumb-sm mr-r-10 mr-b-0">
                            <img src="/public/assets/demo/users/user-image.png" class="media-object rounded-circle"
                                alt="">
                        </figure>
                        <div class="media-body hide-menu">
                            <h4 class="media-heading mr-b-5 text-uppercase">{{ $reseller->username }}</h4><span class="user-type fs-12">Edit Profile (...)</span>
                        </div>
                    </a>
                    <div class="clearfix"></div>
                    <ul class="nav in side-menu">
                        <li><a href="/profile"><i class="list-icon material-icons">face</i> My Profile</a></li>
                        <li><a href="/auth/logout"><i class="list-icon material-icons">settings_power</i> Logout</a></li>
                    </ul>
                </div>
                <!-- /.side-user -->
                <!-- Sidebar Menu -->
                <nav class="sidebar-nav">
                    <ul class="nav in side-menu">
                        <li class="list-divider"></li>
                        <li>
                            <a href="/dashboard" class="ripple"><i class="list-icon material-icons">dashboard</i> <span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="/playlists/add" class="ripple"><i class="list-icon material-icons">playlist_add</i> <span class="hide-menu">Add Playlist</span></a>
                        </li>
                        <li>
                            <a href="/activation" class="ripple"><i class="list-icon material-icons">important_devices</i> <span class="hide-menu">Activation</span></a>
                        </li>
                        <li>
                            <a href="/devices/info" class="ripple"><i class="list-icon material-icons">info_outline</i> <span class="hide-menu">Device Info</span></a>
                        </li>
                        <li>
                            <a href="/resellers" class="ripple"><i class="list-icon material-icons">recent_actors</i> <span class="hide-menu">Resellers</span></a>
                        </li>
                        <li>
                            <a href="/auth/logout"><i class="list-icon material-icons">settings_power</i> <span class="hide-menu">Log Out</span></a>
                        </li>
                    </ul>
                    <!-- /.side-menu -->
                </nav>
                <!-- /.sidebar-nav -->
            </aside>
            <!-- /.site-sidebar -->
            <main class="main-wrapper clearfix">
                <!-- Page Title Area -->
                <div class="row page-title clearfix">
                    <div class="page-title-left">
                        <h5 class="mr-0 mr-r-5">{{ $page_title }}</h5>
                        {{-- <p class="mr-0 text-muted d-none d-md-inline-block">statistics, charts, events and reports</p> --}}
                    </div>
                    <!-- /.page-title-left -->
                    <div class="page-title-right d-none d-sm-inline-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $page_title }}</li>
                        </ol>
                    </div>
                    <!-- /.page-title-right -->
                </div>
                <!-- /.page-title -->
                <!-- =================================== -->
                <!-- Different data widgets ============ -->
                <!-- =================================== -->
                <div class="widget-list">
                    <div class="row">
                        <div class="col-md-12 widget-holder">
                            <div class="widget-bg">
                                {{-- <div class="widget-heading clearfix">
                                    <h5>Blank Starter Page</h5>
                                    <ul class="widget-actions">
                                        <li><a href="javascript:void(0);"><i
                                                    class="material-icons list-icon">cached</i></a>
                                        </li>
                                        <li>
                                            <div class="dropdown"><a class="color-content-color"
                                                    href="javascript:void(0);" class="dropdown-toggle"
                                                    data-toggle="dropdown"><i
                                                        class="material-icons list-icon">more_vert</i></a>
                                                <div class="dropdown-menu"><a class="dropdown-item"
                                                        href="javascript:void(0);"><i
                                                            class="material-icons list-icon float-left mr-r-10">date_range</i>
                                                        History </a><a class="dropdown-item"
                                                        href="javascript:void(0);"><i
                                                            class="material-icons list-icon float-left mr-r-10">format_list_bulleted</i>
                                                        Detailed logs </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="material-icons list-icon float-left mr-r-10">pie_chart_outlined</i>
                                                        Statistics</a>
                                                    <div role="separator" class="dropdown-divider"></div><a
                                                        class="dropdown-item" href="javascript:void(0);"><i
                                                            class="material-icons list-icon float-left mr-r-10">close</i>
                                                        <strong>Clear list</strong></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- /.widget-actions -->
                                </div> --}}
                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <div class="col-md-12 widget-holder">
                                        <div class="widget-bg">
                                            <div class="widget-body clearfix">
                                                <form class="has-validation-callback" id="create-reseller-form" action="/resellers/create" method="POST">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label" for="username">Username</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" id="username" name="username" placeholder="Username" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label" for="password">Password</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" id="password" name="password" placeholder="Password" type="password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label" for="credits">Credits</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" id="credits" name="credits" placeholder="Credits" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="form-group row">
                                                            <div class="col-md-9 ml-md-auto btn-list">
                                                                <button class="btn btn-primary btn-rounded" type="submit">Submit</button>
                                                                <button class="btn btn-outline-default btn-rounded" type="button">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.widget-body -->
                                        </div>
                                        <!-- /.widget-bg -->
                                    </div>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.widget-list -->
            </main>
        </div>
        <!-- /.content-wrapper -->
        <!-- FOOTER -->
        <footer class="footer text-center clearfix"><b>{{ date("Y") }}</b> © Reseller Panel <b>{{ APP_NAME }}</b></footer>
    </div>
    <!--/ #wrapper -->
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
    <script src="/public/assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.77/jquery.form-validator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>
    <script src="/public/assets/js/theme.js"></script>
    <script src="/public/assets/js/custom.js"></script>

    <script>
        $(document).ready(function() {
            let _token = '{{ $_token }}';
            $("#create-reseller-form").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Gather form data
                var formData = {
                    username: $("#username").val(),
                    password: $("#password").val(),
                    credits: $("#credits").val(),
                    _token: _token
                };

                // Send the form data via AJAX
                $.ajax({
                    type: "POST",
                    url: "/resellers/create",
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        if(response.success) {
                            _token = response._token; // Update the token
                            return swal(
                                'Success!',
                                'Reseller created successfully.',
                                'success'
                            ).then(() => {
                                $("#create-reseller-form")[0].reset(); // Reset the form
                            });
                        } else {
                            _token = response._token; // Update the token
                            return swal(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        swal(
                            'Error!',
                            'There was an error creating the reseller.',
                            'error'
                        );
                    }
                });
            });
        });
    </script>

</body>

</html>
