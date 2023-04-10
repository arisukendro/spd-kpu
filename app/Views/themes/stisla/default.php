<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SPD </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?=base_url()?>/themes/stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/themes/stisla/node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="<?=base_url()?>/themes/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/themes/stisla/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/themes/stisla/node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/themes/stisla/node_modules/selectric/public/selectric.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/themes/stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/themes/stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <!-- datatable  -->
    <link rel="stylesheet"
        href="<?=base_url()?>/themes/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?=base_url()?>/themes/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?=base_url()?>/themes/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>/themes/stisla/assets/css/components.css">

    <!-- General JS Scripts -->
    <script src="<?=base_url()?>/themes/stisla/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/popper.js/dist/popper.min.js">
    </script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/moment/dist/moment.js">
    </script>
    <script src="<?=base_url()?>/themes/stisla/assets/js/stisla.js"></script>


    <!-- JS Libraies -->
    <script src="<?=base_url()?>/themes/stisla/node_modules/cleave.js/dist/cleave.min.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js">
    </script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js">
    </script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js">
    </script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/selectric/public/jquery.selectric.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?=base_url()?>/themes/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>/themes/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js">
    </script>

    <script src="<?=base_url()?>/themes/stisla/node_modules/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Template JS File -->
    <script src="<?=base_url()?>/themes/stisla/assets/js/scripts.js"></script>
    <script src="<?=base_url()?>/themes/stisla/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?=base_url()?>/themes/stisla/assets/js/page/forms-advanced-forms.js"></script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <!-- top navbar -->
            <nav class="navbar navbar-expand-lg main-navbar">
                <?= $this->include('themes/stisla/top_navbar') ?>
            </nav>

            <!-- sidebar -->
            <div class="main-sidebar sidebar-style-2">
                <?= $this->include('themes/stisla/sidebar') ?>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <b class="text-primary"><?=$title_page?></b>
                    </div>

                    <div class="section-body">
                        <?=$this->renderSection('content')?>
                    </div>
                </section>
            </div>

            <!-- footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyleft &copy; 2023 <div class="bullet"></div> <a href="https://arisukendro.blogspot.com/">Ari
                        Sukendro</a>
                </div>
                <div class="footer-right">
                    SPD_KPU v2.0
                </div>
            </footer>
        </div>
    </div>


</body>

</html>