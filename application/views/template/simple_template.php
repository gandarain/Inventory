<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title ?></title>

    <link href="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('vendors/font-awesome/css/all.min.css') ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('vendors/animate.css/animate.min.css') ?>" rel="stylesheet">
    <!-- PNotify -->
    <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.brighttheme.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.buttons.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.nonblock.css') ?>">
    <!-- /PNotify -->

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/css/custom.min.css') ?>" rel="stylesheet">

    <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

    <script src="<?php echo base_url('vendors/DateJS/build/date.js') ?>"></script>
        <!-- Bootstrap Date Range Picker -->
    <script src="<?php echo base_url('vendors/moment/min/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

        <!-- PNotify -->
    <script src="<?php echo base_url('vendors/pnotify/dist/pnotify.js') ?>"></script>
    <script src="<?php echo base_url('vendors/pnotify/dist/pnotify.buttons.js') ?>"></script>
    <script src="<?php echo base_url('vendors/pnotify/dist/pnotify.nonblock.js') ?>"></script>

    <script src="<?php echo base_url('vendors/font-awesome/js/all.min.js') ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/custom_service.js') ?>"></script>
    </head>

    <body class="login">
        <?php echo $content ?>
    </body>
</html>
