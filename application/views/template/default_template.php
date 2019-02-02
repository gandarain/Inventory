<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $title ?></title>

        <!-- Import CSS -->
        <link href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/font-awesome/css/all.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/iCheck/skins/flat/green.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/google-code-prettify/bin/prettify.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/switchery/dist/switchery.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/starrr/dist/starrr.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/jqvmap/dist/jqvmap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') ?>" rel="stylesheet">
            <!-- Datatables -->
        <link rel="stylesheet" href="<?php echo base_url('vendors/DataTables/datatables.min.css') ?>">
        <!-- PNotify -->
        <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.brighttheme.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.buttons.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('vendors/pnotify/dist/pnotify.nonblock.css') ?>">
        <!-- /PNotify -->
            <!-- Custom Theme Style -->
        <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/fonts.css') ?>" rel="stylesheet">
        <!-- /Import CSS -->
        <!-- Import JS -->
        <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
        <!-- /Import JS -->

    </head>
    <body class="nav-md">
        <div id="flash-message" class="hide">
            <div class="flash-message-text"><?php echo $this->session->flashdata('flash_message') ?></div>
        </div>
        <div class="container body">
            <div class="main_container">
                <?php echo $sidenavs ?>
                <?php echo $navs ?>
                <!-- Page Content -->
                <div class="right_col" role="main">
                    <div class="main_content">
                        <div class="page-title">
                            <div class="title_left">
                                <h3 class="label-lg"><?php echo $header ?></h3>
                            </div>
                            <div class="title_right">
                                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for...">
                                        <span class="input-group-btn"><button class="btn btn-default" type="button">Go!</button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php echo $content ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /Page Content -->
                <!-- Global Modal -->
                <div class="modal fade in" id="main-modal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close close_modal"><span aria-hidden="true"><i class="fas fa-small fa-times"></i></span></button>
                                <h4 class="modal-title">Modal</h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer"></div>
                        </div>
                    </div>
                </div>
                <!-- /Global Modal -->
                <!-- Footer Content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> || <?php echo $footer; ?>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /Footer Content -->
            </div>
        </div>

        <!-- Import Javascript -->
        <script src="<?php echo base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/fastclick/lib/fastclick.js') ?>"></script>
        <script src="<?php echo base_url('vendors/nprogress/nprogress.js') ?>"></script>
        <script src="<?php echo base_url('vendors/Chart.js/dist/Chart.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/gauge.js/dist/gauge.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/iCheck/icheck.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/skycons/skycons.js') ?>"></script>
            <!-- Flot -->
        <script src="<?php echo base_url('vendors/Flot/jquery.flot.js') ?>"></script>
        <script src="<?php echo base_url('vendors/Flot/jquery.flot.pie.js') ?>"></script>
        <script src="<?php echo base_url('vendors/Flot/jquery.flot.time.js') ?>"></script>
        <script src="<?php echo base_url('vendors/Flot/jquery.flot.stack.js') ?>"></script>
        <script src="<?php echo base_url('vendors/Flot/jquery.flot.resize.js') ?>"></script>
            <!-- Flot Plugins -->
        <script src="<?php echo base_url('vendors/flot.orderbars/js/jquery.flot.orderBars.js') ?>"></script>
        <script src="<?php echo base_url('vendors/flot-spline/js/jquery.flot.spline.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/flot.curvedlines/curvedLines.js') ?>"></script>
            <!-- JQVMap -->
        <script src="<?php echo base_url('vendors/jqvmap/dist/jquery.vmap.js') ?>"></script>
        <script src="<?php echo base_url('vendors/jqvmap/dist/maps/jquery.vmap.world.js') ?>"></script>
        <script src="<?php echo base_url('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') ?>"></script>
        <script src="<?php echo base_url('vendors/font-awesome/js/all.min.js') ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('vendors/DateJS/build/date.js') ?>"></script>
            <!-- Bootstrap Date Range Picker -->
        <script src="<?php echo base_url('vendors/moment/min/moment.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

        <script src="<?php echo base_url('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/jquery.hotkeys/jquery.hotkeys.js') ?>"></script>
        <script src="<?php echo base_url('vendors/google-code-prettify/src/prettify.js') ?>"></script>
        <script src="<?php echo base_url('vendors/jquery.tagsinput/src/jquery.tagsinput.js') ?>"></script>
        <script src="<?php echo base_url('vendors/switchery/dist/switchery.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/select2/dist/js/select2.full.min.js') ?>"></script>
        <!-- This is for Form Validation <script src="<?php echo base_url('vendors/parsleyjs/dist/parsley.min.js') ?>"></script> --> 
        <script src="<?php echo base_url('vendors/autosize/dist/autosize.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/starrr/dist/starrr.js') ?>"></script>
        <script src="<?php echo base_url('/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
            <!-- Datatables -->
        <script src="<?php echo base_url('vendors/DataTables/datatables.min.js') ?>"></script>
        
        <script src="<?php echo base_url('vendors/jszip/dist/jszip.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/pdfmake/build/pdfmake.min.js') ?>"></script>
        <script src="<?php echo base_url('vendors/pdfmake/build/vfs_fonts.js') ?>"></script>
        <!-- PNotify -->
        <script src="<?php echo base_url('vendors/pnotify/dist/pnotify.js') ?>"></script>
        <script src="<?php echo base_url('vendors/pnotify/dist/pnotify.buttons.js') ?>"></script>
        <script src="<?php echo base_url('vendors/pnotify/dist/pnotify.nonblock.js') ?>"></script>
        <!-- /PNotify -->
            <!-- Custom JS -->
        <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/custom_service.js') ?>"></script>
        <!-- /Import Javascript -->

        <script>
            $(function() {
                if ( $("#flash-message div.flash-message-text").html().length > 1 ) {
                    showNotification($("#flash-message div.flash-message-text").html(), 3);
                }
            });
        </script>
    </body>
</html>