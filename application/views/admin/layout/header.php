<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome WEB Inventory Gudang</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <<!-- Google Fonts -->
    <link href="<?php echo base_url('assets/fonts/google.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/icon.css');?>" rel="stylesheet" type="text/css">

    <!--
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.css');?>" rel="stylesheet">
        
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/plugins/node-waves/waves.css');?>" rel="stylesheet">
    
   
    <!-- Animation Css -->
     <link href="<?php echo base_url('assets/plugins/animate-css/animate.css');?>" rel="stylesheet">
   
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css');?>" rel="stylesheet">

    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css');?>" rel="stylesheet">

    <!-- Wait Me Css -->
    <link href="<?php echo base_url('assets/plugins/waitme/waitMe.css');?>" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css');?>" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css');?>" rel="stylesheet">


    <!-- Morris Chart Css-->
    <link href="<?php echo base_url('assets/plugins/morrisjs/morris.css');?>" rel="stylesheet">
   
    <!-- Sweet Alert Css -->
    <link href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css');?>" rel="stylesheet">
    
    <!-- Custom Css -->
   <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
    
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('assets/css/themes/all-themes.css');?>" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo site_url('admin/dashboard'); ?>">Inventory Gudang</a>
            </div>
                    
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo site_url('admin/dashboard/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="<?php echo site_url('admin/dashboard'); ?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>         
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Gudang</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('admin/C_barang'); ?>">Data Barang</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_brand'); ?>">Data Brand</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_category'); ?>">Data Category</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_cabang'); ?>">Data Cabang</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_gudang'); ?>">Data Gudang</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_harga'); ?>">Data Harga</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_jenis_gudang'); ?>">Data Jenis Gudang</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_jenis_barang'); ?>">Data Jenis Barang</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_satuan'); ?>">Data Satuan</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_stok'); ?>">Data Stok</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_sj'); ?>">Data Surat Jalan</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Pembelian</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('admin/C_penawaran'); ?>">Data Penawaran</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_perm_pembelian'); ?>">Data Permintaan Pembelian</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_retur_pembelian'); ?>">Data Retur Pembelian</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Penjualan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('admin/C_order'); ?>">Data Order</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/C_retur_penjualan'); ?>">Data Retur Penjualan</a>
                            </li>
                        </ul>
                    </li>
              </div>   
              </div>   
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
