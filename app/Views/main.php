<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TPV SHOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="TPV SHOP" name="description" />
    <meta content="Axley Herrera" name="author" />

    <link rel="shortcut icon" href="<?php echo base_url('assets/images/app-icon.ico'); ?>">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/libs/jsvectormap/css/jsvectormap.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" id="bootstrap-style" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/icons.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" id="app-style" href="<?php echo base_url('assets/css/app.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" id="app-style" href="<?php echo base_url('assets/libs/jquery-ui/jquery-ui.css'); ?>" />
    <link type="text/css" rel="stylesheet" id="app-style" href="<?php echo base_url('assets/libs/select2/css/select2.css'); ?>" />
    <link href="<?php echo base_url('assets/libs/sweetalert/sweetalert2.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/libs/apexcharts/dist/apexcharts.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/metismenujs/metismenujs.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/feather-icons/feather.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jsvectormap/js/jsvectormap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jsvectormap/maps/world-merc.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/select2/js/select2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/imask/jquery.inputmask.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/moment/moment.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/sweetalert/sweetalert2.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/customApp.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/apexcharts/dist/apexcharts.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/custom/formValidation.js'); ?>"></script>
</head>

<body style="background-color: #dce9f1">
    <div id="layout-wrapper">
        <?php
        echo view('topBar'); // TOP BAR
        echo view('leftSideBar'); // LEFT SIDE BAR
        ?>
        <div id="main-modal"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- CONTENT -->
                    <?php echo view($page); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>

</html>