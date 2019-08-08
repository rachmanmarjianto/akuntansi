<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SI Akuntansi</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('vendor/fontawesome-free/css/all2.css');?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('css/font.css');?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('css/sb-admin-2.min.css');?>" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js');?>"></script>

   

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-money-check fa-money-check-alt" style="font-size:30px; color:white"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SI Akuntansi</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Akun
      </div>

      <!-- Nav Item - Dashboard -->
      
      <li class="nav-item <?php if($controller=='C_home' || $controller=='home') echo 'active';?>">
        <a class="nav-link" href="<?php echo site_url('C_home');?>">
          <i class="fas fa-book fa-book-alt"></i>
          <span>Jurnal</span></a>
      </li>

      <li class="nav-item  <?php if($controller=='C_bukuBesar') echo 'active';?>">
        <a class="nav-link" href="<?php echo site_url('C_bukuBesar');?>">
          <i class="fas fa-archive fa-archive-alt"></i>
          <span>Buku Besar</span></a>
      </li>

      <li class="nav-item <?php if($controller=='C_neracaSaldo') echo 'active';?>">
        <a class="nav-link" href="<?php echo site_url('C_neracaSaldo');?>">
          <i class="fas fa-balance-scale fa-balance-scale-alt"></i>
          <span>Neraca Saldo</span></a>
      </li>

      <li class="nav-item <?php if($controller=='C_labaRugi') echo 'active';?>">
        <a class="nav-link" href="<?php echo site_url('C_labaRugi');?>">
          <i class="fas fa-chart-line fa-chart-line-alt"></i>
          <span>Laba Rugi</span></a>
      </li>

      <li class="nav-item <?php if($controller=='C_perubahanModal') echo 'active';?>">
        <a class="nav-link" href="<?php echo site_url('C_perubahanModal');?>">
          <i class="fas fa-folder fa-folder-alt"></i>
          <span>Perubahan Modal</span></a>
      </li>

  <!--    <li class="nav-item ">
        <a class="nav-link" href="<?php //echo site_url('C_home');?>">
          <i class="fas fa-money-bill-wave fa-money-bill-wave-alt"></i>
          <span>Arus Kas</span></a>
      </li>
  -->
      <li class="nav-item <?php if($controller=='C_neraca') echo 'active';?>">
        <a class="nav-link" href="<?php echo site_url('C_neraca');?>">
          <i class="fas fa-chart-bar fa-chart-bar-alt"></i>
          <span>Neraca</span></a>
      </li>

<!--      <li class="nav-item ">
        <a class="nav-link" href="<?php echo site_url('C_home');?>">
          <i class="fas fa-university fa-university-alt"></i>
          <span>Jurnal Penutup</span></a>
      </li>
-->


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengaturan
      </div>

      <li class="nav-item <?php if($controller=='C_pengaturan') echo 'active';?>">
        <a class="nav-link" href="<?php echo site_url('C_pengaturan');?>">
          <i class="fas fa-wrench fa-wrench-alt"></i>
          <span>Pengaturan Akun</span></a>
      </li>

      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" style="margin-top:30px">

       