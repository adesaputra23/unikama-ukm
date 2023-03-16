<!DOCTYPE html>
<html lang="en">

<head>
    <title>SPK-UKM UNIKAMA</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4. The starter version of Gradient Able is completely free for personal project." />
    <meta name="keywords" content="flat ui, admin , Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="codedthemes">
    <!-- Favicon icon -->
    {{-- <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon"> --}}
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/icofont/css/icofont.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}">
</head>

<body>
    <!-- Pre-loader start -->
    {{-- <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div> --}}
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            
            @include('template.partial_nav_header')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('template.partial_nav_right')

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <!-- Page-header start -->
                                    <div class="page-header card">
                                        @yield('content-breadcrumb')
                                    </div>
                                    <!-- Page-header end -->
                                    
                                    {{-- page body --}}
                                    <div class="page-body">
                                        @yield('content')
                                    </div>
                                    {{-- end page body --}}

                                </div>
                            </div>
                        </div>
                        <div class="navbar navbar-inverse navbar-fixed-bottom">
                            <div class="container">
                                <p class="text-muted">Thank you and enjoy our website.</p>
                                <p class="text-muted"><b>SPK-UKM UNIKAMA</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('assets/js/modernizr/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/modernizr/css-scrollbars.js')}}"></script>
    <!-- am chart -->
    <script src="{{asset('assets/pages/widget/amchart/amcharts.min.js')}}"></script>
    <script src="{{asset('assets/pages/widget/amchart/serial.min.js')}}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{asset('assets/js/chart.js/Chart.js')}}"></script>
    <!-- Custom js -->
    {{-- <script type="text/javascript" src="{{asset('assets/pages/dashboard/custom-dashboard.min.js')}}"></script> --}}
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{asset('assets/js/vartical-demo.js')}}"></script>
    <script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    @yield('costum-js')
</body>

</html>
