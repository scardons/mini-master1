<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo URL; ?>gen/production/images/user.png" type="image/ico" />

    <title>Zafiro Stock</title>

    <!-- Bootstrap -->
    <link href="<?php echo URL; ?>gen/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo URL; ?>gen/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo URL; ?>gen/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo URL; ?>gen/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo URL; ?>gen/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo URL; ?>gen/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo URL; ?>gen/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo URL; ?>gen/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL; ?>css/sweetalert2.min.css">
    <script>const url = "<?php echo URL ; ?>";</script>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"> <span>Zafiro Stock</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo URL; ?>gen/production/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Vallrack</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                <li>
                  <a href="<?php echo URL;?>orderController/showDashboard">
                      <i class="fa fa-edit"></i> Dashboard
                  </a>
                </li>
                  <li><a><i class="fa fa-users"></i> Manage Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo URL;?>userController/userRegister">User Register</a></li>
                      <li><a href="<?php echo URL;?>userController/getUsers">View Users</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Manage Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo URL;?>productController/productRegister">Product Register</a></li>
                      <li><a href="<?php echo URL;?>productController/getProducts">View Product</a></li>   
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> Buy Order <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo URL;?>orderController/cart">Sell</a></li>
                      <li><a href="<?php echo URL;?>orderController/showCart">Sales of the day</a></li>--
                    </ul>
                  </li>
                </ul>
              </div>
            
            </div>
            <!-- /sidebar menu -->

          
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo URL; ?>gen/production/images/img.jpg" alt="">Vallrack
                  </a>

                  
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;">
                      </a>
                    <a class="dropdown-item"  href="<?php echo URL;?>userController/closeSession"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">