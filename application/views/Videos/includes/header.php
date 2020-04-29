<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/app.min.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/bundles/datatables/datatables.min.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'?>">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/components.css'?>">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/custom.css'?>">
  <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url().'assets/img/logo1.png'?>" />
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="<?php echo base_url().'assets/img/logo1.png'?>"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello Admin</div>
          <!--    <a href="#" class="dropdown-item has-icon"> <i class="far-->
										<!--fa-user"></i> Profile-->
          <!--    </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>-->
          <!--      Activities-->
          <!--    </a> -->
          <a href="<?php echo base_url().'index.php/admin/change_password'?>" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
               Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url().'index.php/admin/logout'?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">  <span
                class="logo-name">Grid Unlimited</span>
            </a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="<?php echo base_url().'assets/img/logo1.png'?>">
            </div>
            <div class="sidebar-user-details">
              <!--<div class="user-name">Anwish Shrivastava</div>-->
              <div class="user-role">Administrator</div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="monitor"></i><span>Mannage Chanels</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo base_url().'index.php/admin/add_category'?>">Add new channel</a></li>
                <li><a class="nav-link" href="<?php echo base_url().'index.php/admin/list_category'?>">Manage channel</a></li>
              </ul>
            </li>
			 <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i data-feather="monitor"></i><span>Manage Videos</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo base_url().'index.php/admin/add_video'?>">Add new video</a></li>
                <li><a class="nav-link" href="<?php echo base_url().'index.php/admin/list_video'?>">Manage videos</a></li>
              </ul>
            </li>
            
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>