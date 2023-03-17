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
    
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap/css/bootstrap.min.css')); ?>">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/icon/themify-icons/themify-icons.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/icon/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/icon/icofont/css/icofont.css')); ?>">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/jquery.mCustomScrollbar.css')); ?>">

    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

</head>

<body>
    <!-- Pre-loader start -->
    
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            
            <?php echo $__env->make('template.partial_nav_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?php echo $__env->make('template.partial_nav_right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <!-- Page-header start -->
                                    <div class="page-header card">
                                        <?php echo $__env->yieldContent('content-breadcrumb'); ?>
                                    </div>
                                    <!-- Page-header end -->
                                    
                                    
                                    <div class="page-body">
                                        <?php echo $__env->yieldContent('content'); ?>
                                    </div>
                                    

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
    <script type="text/javascript" src="<?php echo e(asset('assets/js/jquery/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/popper.js/popper.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap/js/bootstrap.min.js')); ?>"></script>

    
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js "></script>

    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')); ?>"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/modernizr/modernizr.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/modernizr/css-scrollbars.js')); ?>"></script>
    <!-- am chart -->
    <script src="<?php echo e(asset('assets/pages/widget/amchart/amcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/pages/widget/amchart/serial.min.js')); ?>"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/chart.js/Chart.js')); ?>"></script>
    <!-- Custom js -->
    
    <!-- Custom js -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pcoded.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vartical-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
    <script>$(document).ready(function () {$('#example').DataTable()})</script>
    <?php echo $__env->yieldContent('costum-js'); ?>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/unikama-ukm/resources/views/template/partials.blade.php ENDPATH**/ ?>