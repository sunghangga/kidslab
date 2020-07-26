<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Kids Lab</title>
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
   <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/jquery-ui/jquery-ui.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
     <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>template/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-danger navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars" style="color: white;"></i></a>
      </li>
    </ul>

    <div class="navbar-custom-menu ml-auto">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;">
                    <img src="<?php echo base_url()?>template/dist/img/avatar5.png" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $this->session->userdata('user_nama')?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        <img src="<?php echo base_url()?>template/dist/img/avatar5.png" class="img-circle" alt="User Image">
                        <p>
                            <?php echo $this->session->userdata('user_nama')?>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="row">
                            <div class="pull-left col-md-6">
                                <?php
                                echo anchor(base_url('user/profil'),'Profil',array('class'=>'btn btn-default btn-flat'));
                                ?>
                            </div>
                            <div class="pull-right col-md-6" style="text-align: right;">
                                <?php
                                echo anchor(base_url('login/logout'),'Sign out',array('class'=>'btn btn-default btn-flat'));
                                ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-danger elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('beranda') ?>" class="brand-link bg-red">
      <img src="<?php echo base_url() ?>template/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image"
           style="height: 100%; width: auto;">
      <span class="brand-text font-weight-light"><b>Kids</b> Lab</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
          <li class="nav-item">
            <a href="<?php echo base_url('beranda') ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>
                Registration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('participants') ?>" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>
                    Participants
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('register') ?>" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>
                    Register
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('payment') ?>" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>
                    Payment
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('shipment') ?>" class="nav-link">
              <i class="nav-icon fas fa-shipping-fast"></i>
              <p>
                Shipment
              </p>
            </a>
          </li>
          <?php $level= $this->session->userdata('user_level');
            if($level=="1") { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Class
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('class_type') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('classroom') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Classroom</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('user') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('group') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('company') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <?php
        echo $contents;
        ?>
    </div><!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <b>Version</b> 1.0.0
    </div>
    <!-- Default to the left -->
    <strong>Scheduler &copy; 2020</strong> | Powered by Kids Lab
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- REQUIRED SCRIPTS -->
<script>
   /** add active class and stay opened when selected */
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
  }).addClass('active');

  // for treeview
  $('ul.nav-treeview a').filter(function() {
      return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="<?php echo base_url() ?>template/adminlte/plugins/chart.js/Chart.min.js"></script> -->
<script src="<?php echo base_url() ?>template/adminlte/chart.js/dist/Chart.js"></script>
<script src="<?php echo base_url() ?>template/adminlte/chart.js/dist/Chart.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>template/adminlte/dist/js/adminlte.js"></script>
<!-- datatables -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- <script src="<?php echo base_url() ?>template/adminlte/dist/js/adminlte.min.js"></script> -->
<script src="<?php echo base_url('template/adminlte/plugins/select2/js/select2.full.min.js')?>"></script>
<script src="<?php echo base_url('template/plugins/sweetalert/sweetalert2.all.min.js')?>"></script>
</body>
</html>