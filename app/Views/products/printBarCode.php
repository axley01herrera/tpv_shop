<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TPV-SHOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Personal projects examples" name="description" />
    <meta content="Axley Herrera" name="author" />

    <!-- APP ICO -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/app-icon.ico'); ?>">

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/libs/jsvectormap/css/jsvectormap.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/libs/jquery-ui/jquery-ui.css'); ?>" />

    <style>
        #sidebar-menu ul li.mm-active>a {
            background-color: #1c1b22;
            color: #fff;
        }

        #sidebar-menu ul li.mm-active>a .nav-icon {
            color: #fff !important;
        }

        .page-item.active .page-link {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-dark {
            background-color: #1c1b22;
            border-color: #1c1b22;
        }

        .card {
            background-color: #fff;
            background-clip: border-box;
            border: none;
            border-radius: 0pc;
        }

        .hoverable:hover {
            box-shadow: inset 0 0 0 9999px rgba(0, 0, 0, 0.075);
        }

        .sampleLabel {
            border: 1px solid #909090;
            background-color: #fff;
            border-radius: 10px !important;
            width: 370px;
            overflow: hidden;
            margin: auto;
            margin-bottom: 2px;
            page-break-inside: avoid;
        }

        .barcodeSVG {
            display: block;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

        .break-page {
            page-break-before: always;
        }
    </style>

    <!-- JS -->
    <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jsvectormap/js/jsvectormap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jsvectormap/maps/world-merc.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/customApp.js'); ?>"></script>
</head>

<body>
    <div id="layout-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12" style="margin-top: 11px;">
                    <div class="sampleLabel tu-clase-de-contenedor">
                        <div class="p-2" style="font-size: 12px;">
                            <?php echo $name; ?>
                        </div>
                        <div class="p-2">
                            <span class="barcodeSVG"><?php echo $barcode; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        window.print();

    });
    window.onafterprint = function() {
        window.close();
    }
</script>