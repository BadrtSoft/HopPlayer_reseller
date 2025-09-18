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
                        <h5 class="mr-0 mr-r-5">{{ $page_name }}</h5>
                    </div>
                    <!-- /.page-title-left -->
                    <div class="page-title-right d-none d-sm-inline-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $page_name }}</li>
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
                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <form action="/device/info" method="GET" id="checkDevice">
                                                <div class="form-group">
                                                    <label for="device_mac">Device Mac</label>
                                                    <input type="text" minlength="17" maxlength="17" class="form-control text-center" id="device_mac" name="device_mac" placeholder="--:--:--:--:--:--:--" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Check</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card mt-3" id="add_select" style="display: none;">
                                        <div class="card-body">
                                            <div class="form-group row">
                                              <label class="col-md-3 col-form-label" for="add_method">Select Method</label>
                                              <div class="col-md-9">
                                                <select name="add_method" id="add_method" class="form-control">
                                                    <option value="">Select Method</option>
                                                    <option value="0">Xtream Codes Api</option>
                                                    <option value="1">Playlist URL</option>
                                                </select>
                                              </div>
                                            </div>

                                            <form action="POST" id="xtreamcodes_api_form" style="display: none;">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label" for="playlist_name_api">Playlist Name</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" id="playlist_name_api" placeholder="Playlist Name" name="playlist_name_api" type="text" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label" for="xtreacodes_protocol">API Url</label>
                                                    <div class="col-md-1 col-sm-6">
                                                        <select name="xtreacodes_protocol" id="xtreacodes_protocol" class="form-control">
                                                            <option value="http">http</option>
                                                            <option value="https">https</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control" id="xtreacodes_hostname" placeholder="example.com" name="xtreacodes_hostname" type="text" required="required">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input class="form-control" id="xtreacodes_port" placeholder="default 80/443" name="xtreacodes_port" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label" for="xtreacodes_username">Username</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" id="xtreacodes_username" placeholder="Username" name="xtreacodes_username" type="text" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label" for="xtreacodes_password">Password</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" id="xtreacodes_password" placeholder="Password" name="xtreacodes_password" type="text" required="required">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Playlist</button>
                                            </form>

                                            <form action="POST" id="url_form" style="display: none;">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label" for="playlist_name_url">Playlist Name</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" id="playlist_name_url" placeholder="Playlist Name" name="playlist_name_url" type="text" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label" for="playlist_url">M3u Playlist URL</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" id="playlist_url" placeholder="Default Input" name="playlist_url" type="text" required="required">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Playlist</button>
                                            </form>
                                        </div>
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
        let token = "{{ $_token }}";
        let device_id = null;
        $(document).ready(function() {
            // $("#device_mac").on({
            //     keydown: function(e) {
            //         this.value =
            //                     (this.value.toUpperCase()
            //                     .replace(/[^\d|A-F]/g, '')
            //                     .match(/.{1,2}/g) || [])
            //                     .join(":")
            //     },
            //     keyup: function(e) {
            //         this.value =
            //                     (this.value.toUpperCase()
            //                     .replace(/[^\d|A-F]/g, '')
            //                     .match(/.{1,2}/g) || [])
            //                     .join(":")
            //     },
            //     change: function() {
            //         this.value =
            //                     (this.value.toUpperCase()
            //                     .replace(/[^\d|A-F]/g, '')
            //                     .match(/.{1,2}/g) || [])
            //                     .join(":")
            //     },
            //     input: function() {
            //         this.value =
            //                     (this.value.toUpperCase()
            //                     .replace(/[^\d|A-F]/g, '')
            //                     .match(/.{1,2}/g) || [])
            //                     .join(":")
            //     }
            // });

            $("#device_mac").on("input", function(e) {
                this.value = (this.value.toUpperCase()
                             .replace(/[^\d|A-F]/g, '')
                             .match(/.{1,2}/g) || [])
                             .join(":")
            });

            $("#checkDevice").submit(function(event) {
                event.preventDefault();
                $("#add_select").hide();
                var device_mac = $("#device_mac").val();
                if (device_mac.length !== 17) {
                    swal("Error", "Please enter a valid MAC address.", "error");
                    return;
                }
                $.ajax({
                    url: '/playlists/device/info',
                    type: 'POST',
                    data: {
                        device_mac: device_mac,
                        _token: token
                    },
                    success: function(response) {
                        if (response.success) {
                            // swal("Device Info", "Status: " + response.status + "\nPlan: " + response.plan + "\nActive: " + response.active, "success");
                            device_id = response.device_id;
                            token = response._token;
                            $("#add_select").show();
                        } else {
                            swal("Error", response.error, "error");
                            token = response._token;
                        }
                    },
                    error: function() {
                        swal("Error", "An error occurred while processing your request.", "error");
                    }
                });
            });


            $("#xtreacodes_port").on('input', function() {
                var val = $(this).val();
                // Allow only numbers and dots
                if (!/^\d*$/.test(val)) {
                    $(this).val(val.replace(/[^\d]/g, ''));
                }
            });

            $("#add_method").change(function() {
                var method = $(this).val();
                if (method === "0") {
                    $("#url_form").hide();
                    $("#xtreamcodes_api_form").show();
                } else if (method === "1") {
                    $("#xtreamcodes_api_form").hide();
                    $("#url_form").show();
                }else {
                    $("#url_form").hide();
                    $("#xtreamcodes_api_form").hide();
                }
            });

            $("#xtreamcodes_api_form").submit(function(event) {
                event.preventDefault();
                // Add your form submission logic here
                $.ajax({
                    url: '/playlists/add/xtreamcodes',
                    type: 'POST',
                    data: {
                        device_id: device_id,
                        playlist_name: $('#playlist_name_api').val(),
                        protocol: $('#xtreacodes_protocol').val(),
                        port: $('#xtreacodes_port').val(),
                        hostname: $('#xtreacodes_hostname').val(),
                        username: $('#xtreacodes_username').val(),
                        password: $('#xtreacodes_password').val(),
                        _token: token
                    },
                    success: function(response) {
                        if (response.success) {
                            swal("Success", "Playlist added successfully.", "success");
                            token = response._token;
                            // Optionally, reset the form here
                            $('#xtreamcodes_api_form')[0].reset();
                        } else {
                            swal("Error", response.error, "error");
                            token = response._token;
                        }
                    },
                    error: function() {
                        swal("Error", "An error occurred while processing your request.", "error");
                    }
                });
                alert("Xtream Codes API form submitted!");
            });

            $("#url_form").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/playlists/add/url',
                    type: 'POST',
                    data: {
                        device_id: device_id,
                        playlist_name: $('#playlist_name_url').val(),
                        playlist_url: $('#playlist_url').val(),
                        _token: token
                    },
                    success: function(response) {
                        if (response.success) {
                            swal("Success", "Playlist added successfully.", "success");
                            token = response._token;
                            // Optionally, reset the form here
                            $('#url_form')[0].reset();
                        } else {
                            swal("Error", response.error, "error");
                            token = response._token;
                        }
                    },
                    error: function() {
                        swal("Error", "An error occurred while processing your request.", "error");
                    }
                });
                // Add your form submission logic here
                alert("Playlist URL form submitted!");
            });
        });
    </script>
</body>

</html>
