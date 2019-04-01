<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tecscilsolutions QMS | Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>uifiles/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>uifiles/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>uifiles/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>uifiles/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>uifiles/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>uifiles/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>uifiles/css/styles.css" rel="stylesheet">
	<script src="<?php echo base_url();?>uifiles/jquery/dist/jquery.min.js"></script>
	<?php
	if(@sizeOf($logo) > 0)
	{
	?>
	<link rel="icon" href="<?php echo base_url('uploads/files/'.@$logo[0]->favicon);?>" type="image/png" sizes="16x16">
	<?php
	}
	?>
	<script type="text/javascript">
		var baseurl='<?php echo base_url()?>';
	</script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
				<a href="<?php echo base_url('adminvenjos');?>" class="site_title">
				<?php
				if(@sizeOf($logo) > 0)
				{
				?>
				<img src="<?php echo base_url('uploads/files/'.$logo[0]->logoFile);?>" class="img-responsive logo whitecolor" />
				<?php	
				}
				else
				{
				?>
					<i class="fa fa-paw"></i> <span>Tecscilsolutions</span>
				<?php
				}
				?>
				</a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url();?>uifiles/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo @ucwords($adminuser[0]->firstname);?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url('adminvenjos');?>"><i class="fa fa-home"></i> Dashboard</a></li>
				  
                  <li class="<?php if(@$menu == 'logo' || @$menu == 'company' || @$menu == 'socials' || @$menu == 'roles' || @$menu == 'kiosksettings'){echo 'active';}?>"><a><i class="fa fa-cubes"></i> Configurations <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" <?php if(@$menu == 'logo' || @$menu == 'company' || @$menu == 'socials'){echo 'style="display:block;"';}?>>
                      <li class="<?php if(@$menu == 'logo'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/logo');?>">Logo</a></li>
                      <li class="<?php if(@$menu == 'company'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/company');?>">Company Details</a></li>
					  <li class="<?php if(@$menu == 'displays'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/displays');?>">Display Configurations</a></li>
					  <li class="<?php if(@$menu == 'roles'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/roles');?>">Roles</a></li>
					  <li class="<?php if(@$menu == 'services'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/services');?>">Services</a></li>
					  <li class="<?php if(@$menu == 'counters'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/counters');?>">Counters</a></li>
					  <li class="<?php if(@$menu == 'serviceassigncounter'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/assignServiceToCounter');?>">Assign Service To Counters</a></li>
					  <li class="<?php if(@$menu == 'users'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/users');?>">Users</a></li>
					  
					  <li class="<?php if(@$menu == 'serviceusercounter'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/assignUserToCounter');?>">Assign User To Counters</a></li>
					  
					  <li class="<?php if(@$menu == 'kiosksettings'){echo 'current-page';}?>"><a href="<?php echo base_url('adminvenjos/kiosksettings');?>">Kiosk Settings</a></li>
                    </ul>
                  </li>
                  <!--#FFBF00-->
                </ul>
              </div>
              <div class="menu_section">
                <h3>Queue Management System</h3>
                <ul class="nav side-menu">
                  <li>
					<a href="<?php echo base_url('adminvenjos/pages');?>"><i class="fa fa-windows"></i> Pages</a>
				  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('adminvenjos/logout');?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url();?>uifiles/images/img.jpg" alt=""><?php echo @ucwords($adminuser[0]->firstname);?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="<?php echo base_url('adminvenjos/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
