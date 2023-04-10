<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=config('site')->app_name.' '.config('site')->ibukota. ' v'.config('site')->app_version?> </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <!-- daterange picker && Tempusdominus Bootstrap 4-->
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/toastr/toastr.min.css">


    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
        rel="stylesheet" />

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>/public/themes/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link d-none d-xs-block d-sm-block d-md-block d-lg-none" role="button">SPD KPU</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i>
                        MENU</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown ">
                    <a class=" nav-link border rounded border-warning " data-toggle="dropdown" href="#">
                        <?=user()->username?> <i class="far fa-user-circle text-warning"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- <span class="dropdown-header">Level : Levelnya si user</span>
                        <div class="dropdown-divider"></div>
                        <a href="" class="dropdown-item">
                            <i class="fas fa-key mr-2"></i> Ganti Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-ghost mr-2"></i> Profil
                        </a>


                        <div class="dropdown-divider"></div> -->
                        <a href="<?=site_url('logout')?>"
                            class="dropdown-item dropdown-footer p-2 text-bold text-danger ">LOGOUT</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?=site_url()?>" class="brand-link">
                <img src="<?=base_url()?>/public/img/logo.png" alt="SPD KPU" class="brand-image img-circle elevation-3"
                    style="opacity: .9">
                <span class="brand-text font-weight-light">SPD KPU</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <?=$this->include('themes/AdminLTE/sidebar');?>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?=$this->renderSection('content')?>
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                No Copyright Here
            </div>
            <!-- Default to the left -->
            <strong>Dari Kendro, Untuk KPU</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <div class="viewmodal" style="display:none;"></div>

    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/toastr/toastr.min.js"></script>

    <!-- InputMask && date-range-picker -->
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
    </script>
    <script
        src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>

    <!-- DataTables  & Plugins -->
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
    </script>
    <script
        src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script
        src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <script type="text/javascript"
        src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?=base_url()?>/public/themes/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>


</body>

</html>