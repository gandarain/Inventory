<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url('favicon.ico'); ?>" type="image/icon">

    <title>
        <?php echo (empty($title))?lang('appname').' - Dashboard':$title; ?>
    </title>

    <!-- Core JS & CSS - Include with every page -->
    <!-- JQuery -->
    <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js') ?>" type="text/javascript"></script>
    
    <!-- Autosize -->
    <script src="<?php echo base_url('vendors/autosize/dist/autosize.min.js') ?>" type="text/javascript"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap-theme.min.css') ?>">
    <script src="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/bootstrap-wysiwyg/css/style.css') ?>">
    <script src="<?php echo base_url('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') ?>" type="text/javascript"></script>

    <!-- Chart.js -->
    <script src="<?php echo base_url('vendors/Chart.js/dist/Chart.min.js') ?>" type="text/javascript"></script>

    <!-- cropper -->
    <script src="<?php echo base_url('vendors/cropper/dist/cropper.min.js') ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/cropper/dist/cropper.min.css') ?>">

    <!-- datatables -->
    <script src="<?php echo base_url('vendors/datatables.net/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">

    <!-- Fonts CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/fonts.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/animate.css/animate.min.css') ?>">

    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/font-awesome/css/all.min.css') ?>">
    <script src="<?php echo base_url('vendors/font-awesome/js/all.min.js') ?>" type="text/javascript"></script>
</head>

<body>
    <style>
        .border-bottom-shop{
            border-bottom-width: 1px; 
            border-bottom-style: solid; 
            border-bottom-color:gray;
        }

        .text-no-style{
            color:black;
        }

        .padding-bottom-10{
            padding-bottom: 10px;
        }

        .padding-top-10{
            padding-top:10px;
        }

    	.header-me{
    		background-color:#2d1e5f;
    		width:100%;
    		border-bottom: 2px solid #faa819;
            padding:0px;
            margin:0px;
            height: 13%;
    		padding:10px;
    	}

        .logo-header{
            
        }

        .btn-primary{
            background-color:#faa819 !important;
            border-color:#faa819;
        }

        .navbar{
            /* background-color: #2d1e5f !important; */
            background-color: #ffffff !important;
            border-radius: 0px !important;
            padding: 0px !important;
            margin:0px !important;
            height: 61px;
            /* border-bottom: 2px solid #faa819; */
        }

        .navbar-brand{
            padding: 10px;
            margin-left: 0 !important;
            margin-top: 0.25em;
        }

        .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover{
            background-color: #2d1e5f !important;
        }

        .navbar-default .navbar-brand{
            color:white;
        }

        .navbar-default .navbar-nav>li>a{
            color:white;
        }

        .btn{
            background-color:#faa819;
            border-color:#faa819;
        }
        #login-dp{
            min-width: 250px;
            padding: 14px 14px 0;
            overflow:hidden;
        }
        #login-dp .help-block{
            font-size:12px    
        }
        #login-dp .bottom{
            border-top:1px solid #ddd;
            clear:both;
            padding:14px;
        }
        #login-dp .social-buttons{
            margin:12px 0    
        }
        #login-dp .social-buttons a{
            width: 49%;
        }
        #login-dp .form-group {
            margin-bottom: 10px;
        }
        .btn-fb{
            color: #fff;
            background-color:#3b5998;
        }
        .btn-fb:hover{
            color: #fff;
            background-color:#496ebc 
        }
        .btn-tw{
            color: #fff;
            background-color:#55acee;
        }
        .btn-tw:hover{
            color: #fff;
            background-color:#59b5fa;
        }
        @media(max-width:768px){
            #login-dp{
                background-color: inherit;
                color: #fff;
            }
            #login-dp .bottom{
                background-color: inherit;
                border-top:0 none;
            }
        }

        .header-menu-container{
            height: 18px;
            color: #fcfcfc;
            background: #2d1e5f;
        }

        .header-menu-button > div {
            float: right;
            /* margin-right: 50px; */
            height: 25px;
        }
        
        .header-menu-button > div > a {
            color: #ffffff;
            padding: 0 0.5em 0 0.5em;
            font-family: Muli-ExtraBold;
            font-size: 10pt;
            line-height: 20px;
            /* padding-top: 2px; */
            /* padding-bottom: 2px; */
            text-align: center;
        }

        a.fill-div {
            /* display: block; */
            height: 100%;
            width: 100%;
            text-decoration: none;
        }

        a:hover{
            color: #dcdcdc;
        }

        .shadow{
            box-shadow: 2px 2px 3px 3px #dedede;
        }

        .search-icon{
            border-radius: 10pt 0 0 10pt;
            background: #fff;
            border-right: none !important;
        }

        .search-icon > img {
            filter: grayscale(100%);
            -webkit-filter: grayscale(100%);
            opacity: 50%;
        }

        .btn-search{
            text-decoration: none !important;
            font-family: Muli-Bold;
            font-size: 14.44pt;
            background: #270e5d;
            border-radius: 0 10pt 10pt 0;
            color: #fcfcfc;
            width: 76px;
            /* padding: 6px 25px; */
            border: solid 1px #270e5d;
        }

        .btn-search:hover{
            color: #dedede;
        }

        .btn-cart{
            background: none;
            border: none;
            margin-top: 0.25em;
            font-family: Muli-Bold;
            color: #270e5d;
            font-size: 10pt;
        }

        .cring-category-dropdown{
            text-decoration: none !important;
            font-family: Muli-Bold;
            font-size: 10pt;
            background: none;
            border-left: none;
        }

        .cring-category-dropdown > button:hover {
            background: #ffffff;
        }

        .cring-category-dropdown > button {
            border: none;
            color: #a6a8ab;
        }

        .cring-input{
            border-left: none;
            border-right: none;
            font-family: Muli-SemiBold;
            height: 38px;
            color: #a6a8ab;
            font-size: 14.44pt;
            box-shadow: none;            
        }

        .cart-notify-badge{
            position: absolute;
            left: 35px;
            top: 0;
            background: #f28800;
            text-align: center;
            border-radius: 50px;
            color: white;
            padding: 3px 7px;
            font-size: 7pt;
            font-family: Muli;
        }

        /*footer*/
        .col_white_amrc { color:#424413; font-family: Muli-Bold; font-size: 12pt;}
        footer { width:100%; background-color:#fff; min-height:250px; padding:10px 0px 25px 0px ;}
        .pt2 { padding-top:40px font-weight: bold;}
        footer p { font-size:13px; color:#CCC; padding-bottom:0px; margin: 0;}
        .mb10 { padding-bottom:15px ;}
        .footer{ padding-bottom: 0px;}
        .footer_ul_amrc { margin:0px ; list-style-type:none ; font-size:12pt; padding:0px 0px 10px 0px; color:#a6a8ab; font-family: Muli-Light;}
        .footer_ul_amrc li {padding:0px 0px 5px 0px;}
        .footer_ul_amrc li a{ color:#a6a8ab;}
        .footer_ul_amrc li a:hover{ color:#270e5d; text-decoration:none;}
        .fleft { float:left;}
        .padding-right { padding-right:10px; }

        .footer_ul2_amrc {margin:0px; list-style-type:none; padding:0px;}
        .footer_ul2_amrc li p { display:table; }
        .footer_ul2_amrc li a:hover { text-decoration:none;}
        .footer_ul2_amrc li i { margin-top:5px;}

        .bottom_border { border-bottom:2px solid #ededed; padding-bottom:20px;}
        .foote_bottom_ul_amrc {
            list-style-type:none;
            padding:0px;
            display:table;
            margin-top: 10px;
            margin-right: auto;
            margin-bottom: 10px;
            margin-left: auto;
        }
        .foote_bottom_ul_amrc li { display:inline;}
        .foote_bottom_ul_amrc li a { color:#999; margin:0 12px;}

        .social_footer_ul { display:table; margin:0 auto 0 auto; list-style-type:none;  }
        .social_footer_ul li { padding-left:0; padding-top:10px; float:left; }
        .social_footer_ul li a { color:#CCC; border:1px solid #CCC; padding:8px;border-radius:50%;}
        .social_footer_ul li i {  width:20px; height:20px; text-align:center;}

        .copyright > p{ font-family: Muli-SemiBold; font-size: 10pt; color: #424143; }
        .copyright{ padding-bottom: 22pt;}
        .pt-cring{ font-family: Muli-SemiBold; font-size: 10pt; color: #424143; }
        .pt-cring:hover{ text-decoration: none; }

        .external-logo-lists {
            display: inline-block;
        }

        .external-logo--list {
            background-color: #fff;
            display: block;
            float: left;
            width: 55px;
            height: 33px;
            margin: 3px;
            -webkit-box-shadow: inset 1px 0 0 #f3f3f3, inset -1px 0 0 #f3f3f3, inset 0 1px 0 #f3f3f3, inset 0 -1px 0 #f3f3f3;
            box-shadow: inset 1px 0 0 #f3f3f3, inset -1px 0 0 #f3f3f3, inset 0 1px 0 #f3f3f3, inset 0 -1px 0 #f3f3f3;
            /* border: solid 1px #a6a8ab; */
            border-radius: 5px;
            font-size: 8pt;
        }

        .external-logo-item {
            float: left;
            display: block;
            position: relative;
            overflow: hidden;
            text-align: left;
            text-indent: -9999px;
            background-position: -9999px -9999px;
            background-repeat: no-repeat;
            -webkit-background-size: 55px 33px;
            background-size: 55px;
            width: 55px;
            height: 33px;
        }

        .external-logo-item--mastercard {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/mastercard-logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--cod {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/cod-logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--visa {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/visa-logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--bca {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/bca-logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--bni {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/bni-logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--bri {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/bri-logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--mandiri {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/mandiri-logo-2.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--cimb {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/cimb-logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }
        .external-logo-item--anz {
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/anz-logo.jpg');
            background-repeat: no-repeat;
            background-position: center;
        }

        .c-socmed-follow__list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: inline-block;
        }

        .c-socmed-follow__item:first-child {
            margin-left: 0;
        }

        .c-socmed-follow__item {
            margin: 0 0 0 3px;
            padding: 0;
            display: block;
            float: left;
        }

        .c-socmed-follow__icon {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
            line-height: 1;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            overflow: hidden;
            text-indent: -9999px;
            background-repeat: no-repeat;
            background-image: url('<?php echo base_url();?>assets/images/web-cring/footer/sprite-follow.png');
            background-position: 0 0;
            -webkit-background-size: 24px 329px;
            background-size: 24px 329px;
        }

        .c-socmed-follow__icon--facebook {
            background-position: 0 0;
        }

        .c-socmed-follow__icon--twitter {
            background-position: 0 -34px;
        }

        .c-socmed-follow__icon--youtube {
            background-position: 0 -68px;
        }

        .c-socmed-follow__icon--instagram {
            background-position: 0 -102px;
        }

        .c-socmed-follow__icon--gplus {
            background-position: 0 -136px;
        }

        .c-socmed-follow__icon--linkedin {
            background-position: 0 -170px;
        }

        .btn-chat-seller{
            text-decoration: none !important;
            float: right;
            font-family: Muli-Bold;
            font-size: 14.44pt;
            height: 35pt;
            color: #fcfcfc;
            background: #270e5d;
            border: none;
            border-radius: 0px;
            position: fixed;
            bottom: 0;
            right: 0;
        }

        .btn-chat-seller:hover{
            text-decoration: none !important;
            color: #dedede;
        }

        .btn-chat-seller:focus{
            text-decoration: none !important;
            color: #dedede;
        }

        .btn-chat-seller:before {
            content: "";
            width: 20pt;
            height: 20pt;
            display: inline-block;
            margin-right: 15pt;
            vertical-align: text-top;
            background-color: transparent;
            background-position : center;
            background-repeat:no-repeat;
        }

        .btn-chat-seller-icon:before{
            background-image : url('<?php echo base_url();?>assets/images/web-cring/footer/chat-white.png');
            /* background-image : url(http://icons.iconarchive.com/icons/fatcow/farm-fresh/16/accept-icon.png); */
        }

	</style>

    <!-- Header -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <!-- Top Header -->
        <div class="header-menu-container">
            <div class="header-menu-button">
                <div>
                    <a href="#" class="fill-div">Status Pemesanan</a>
                    <a href="#" class="fill-div">Seller Center</a>
                    <a href="#" class="fill-div">Bantuan</a>
                    <a href="#" class="fill-div">Unduh Aplikasi</a>
                </div>
            </div>
        </div>

        <!-- Second Header -->
        <div class="navbar shadow">
            <div class="container-fluid row">
                <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->

                <div class="col-lg-2">
                    <a class="navbar-brand" href="">
                        <img src="<?php echo base_url("assets/images/web-cring/cring-logo.png") ?>" width="" height="31" alt="">
                    </a>
                </div>

                <div class="collapse navbar-collapse">
                    <div class="col-lg-8" style="margin-top: 0.25em;">
                        <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <form class="" role="search" method="POST" action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search" name="item-search">
                                </div>
                                <button type="submit" class="btn btn-default">Cari</button>
                            </form>
                        </div> -->
                        <form class="" role="search" method="POST" action="#">
                            <div class="input-group">
                                <span class="input-group-addon search-icon">
                                    <img src="<?php echo base_url('assets/images/web-cring/cring-search-grey.png') ?>" height="19">
                                </span>
                                <span>
                                    <input type="text" class="form-control cring-input" name="item-search" id="" placeholder="Apa yang Anda cari hari ini?" value="">
                                </span>
                                <span class="input-group-addon dropdown cring-category-dropdown">
                                    <button class="dropdown-toggle" type="button" role="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Computer & Accessories
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </span>
                                <a type="submit" class="btn input-group-addon btn-search">
                                    <span>Cari</span>
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Cart -->
                    <div class="col-lg-2" style="margin-top: 5px;">
                        <button class="button btn-cart">
                            <span class="cart-notify-badge">8</span>
                            <img src="<?php echo base_url("assets/images/web-cring/cring-cart-purple.png") ?>" width="" height="28" alt="">
                            <span style="margin-left: 15pt  ;">My Cart</span>
                        </button>
                    </div>
                </div><!-- /.navbar-collapse -->

            </div>
        </div>
    </nav>
    <!-- End of Header -->

    <!-- Content -->
    <?php if ( $content ) { ?>
        <div class="container" style="margin-top: 80px;">
            <?php echo $content;?>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    <?php } ?>
    <!-- End of Content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-3 col">
                    <div class="row">
                        <h5 class="headin5_amrc col_white_amrc pt2">Panduan Pengguna Baru</h5>
                        
                        <ul class="footer_ul_amrc">
                            <li><a href="#">Cara Berbelanja</a></li>
                            <li><a href="#">Kupon</a></li>
                            <li><a href="#">Hubungi Kami</a></li>
                            <li><a href="#">Informasi Pengiriman</a></li>
                            <li><a href="#">Informasi Faktur Luar Negeri</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                            <li><a href="#">Jaminan Aman</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-sm-6 col-md-3 col-3 col">
                    <div class="row">
                        <h5 class="headin5_amrc col_white_amrc pt2">Info Cring Cring</h5>
                        
                        <ul class="footer_ul_amrc">
                            <li><a href="#">Tentang Cring Cring</a></li>
                            <li><a href="#">Visi & Misi</a></li>
                            <li><a href="#">Syarat dan Ketentuan</a></li>
                            <li><a href="#">Blog Cring</a></li>
                            <li><a href="#">Kabar Terbaru</a></li>
                            <li><a href="#">Karir</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-sm-6 col-md-3 col-3 col">
                    <div class="row">
                        <h5 class="headin5_amrc col_white_amrc pt2">Metode Pembayaran</h5>
                        
                        <ul class="footer_ul2_amrc col-xs-8 external-logo-lists">
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--mastercard">Mastercard</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--cod">COD</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--visa">Visa</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--bca">BCA</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--bni">BNI</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--bri">BRI</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--mandiri">MANDIRI</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--cimb">CIMB</span>
                            </li>
                            <li class="external-logo--list">
                                <span class="external-logo-item external-logo-item--anz">ANZ</span>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-sm-6 col-md-3 col-3 col">
                    <div class="row">
                        <h5 class="headin5_amrc col_white_amrc pt2">Ikuti Kami!</h5>
                        
                        <ul class="c-socmed-follow__list">
                            <li class="c-socmed-follow__item">
                                <a target="_blank" class="c-socmed-follow__icon c-socmed-follow__icon--facebook" rel="nofollow" href="https://facebook.com/cring-cring">Facebook</a>
                            </li>
                            <li class="c-socmed-follow__item">
                                <a target="_blank" class="c-socmed-follow__icon c-socmed-follow__icon--twitter" rel="nofollow" href="https://twitter.com/cring-cring">Twitter</a>
                            </li>
                            <li class="c-socmed-follow__item">
                                <a target="_blank" class="c-socmed-follow__icon c-socmed-follow__icon--youtube" href="https://www.youtube.com/user/cring-cring">YouTube</a>
                            </li>
                            <li class="c-socmed-follow__item">
                                <a target="_blank" class="c-socmed-follow__icon c-socmed-follow__icon--instagram" rel="nofollow" href="https://instagram.com/cring-cring/">Instagram</a>
                            </li>
                            <li class="c-socmed-follow__item">
                                <a target="_blank" class="c-socmed-follow__icon c-socmed-follow__icon--gplus" rel="nofollow" href="https://plus.google.com/+cring-cringdotcom">Google+</a>
                            </li>
                            <li class="c-socmed-follow__item">
                                <a target="_blank" class="c-socmed-follow__icon c-socmed-follow__icon--linkedin" rel="nofollow" href="https://www.linkedin.com/company/pt-cring-cring-com">LinkedIn</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="bottom_border"></div>

        <div class="container copyright">
            <p class="text-left">&copy; 2018 Hak Cipta <a class="pt-cring" href="">PT. Cring Cring Indonesia</a></p>
            <button class="fixed-bottom btn btn-chat-seller btn-chat-seller-icon">Chat dengan Penjual</button>
        </div>

    </footer>
    <!-- End of Footer -->
</body>

<script>
    $(document).ready(function(){

        $("#form-login").submit(function(event){
            
            event.preventDefault();
            
            var url = "<?php echo base_url('cring/login') ?>";

            var email = $("input#email").val();
            var password = $("input#password").val();
            var submit = $("button#submit").val();

            var error = 0;
            var success = 1;
                
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    email: email, 
                    password: password,
                    submit: submit
                },
                success: function(data){
                    console.log('data: ', data);
                    if(data){
                        // console.log('data: ', data);
                        var res = JSON.parse(data);
                        
                        if(res.status == error){
                            alert(res.message);
                        }else{
                            alert(res.message);
                            window.location.href = "<?php echo base_url('cring/home') ?>";
                        }
                    }      
                },
                error : function(data) {
                    alert('Error!');
                    
                }
                
            });

            // return false;  //stop the actual form post !important!

        });

        $("#logout-user").click(function(event){
            
            event.preventDefault();
            
            var url = "<?php echo base_url('cring/logout') ?>";

            var error = 0;
            var success = 1;
                
            $.ajax({
                url: url,
                success: function(data){
                    if(data){
                        // console.log('data: ', data);
                        var res = JSON.parse(data);
                        
                        if(res.status == error){
                            alert(res.message);
                        }else{
                            alert(res.message);
                            window.location.href = "<?php echo base_url('cring/home') ?>";
                        }
                    }      
                },
                error : function(data) {
                    alert('Error!');
                    
                }
                
            });

            // return false;  //stop the actual form post !important!

        });

        $("#open-shop").click(function(event){
            
            event.preventDefault();
            
            window.location.href = "<?php echo base_url('shop/open_shop_') ?>";

            return false;  //stop the actual form post !important!

        });

        $("#my-cart").click(function(event){
            
            event.preventDefault();
            
            var url = "<?php echo base_url('cring/my_cart') ?>";

            var error = 0;
            var success = 1;
                
            $.ajax({
                url: url,
                success: function(data){
                    if(data){
                        // console.log('data: ', data);
                        var res = JSON.parse(data);
                        
                        if(res.status == error){
                            alert(res.message);
                        }else{
                            alert(res.message);
                            window.location.href = "<?php echo base_url('cring/home') ?>";
                        }
                    }      
                },
                error : function(data) {
                    alert('Error!');
                    
                }
                
            });

            // return false;  //stop the actual form post !important!

        });

    });
</script>