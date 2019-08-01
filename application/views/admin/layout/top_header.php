<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url("admin");?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
	  <img src="<?php echo $this->config->item("jsadmin_assets");?>blood.png" class="img-logo1"/> <b>AP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
		  <img src="<?php echo $this->config->item("jsadmin_assets");?>blood.png" class="img-logo"/>
		  <b>AP</b> Blood Cell
	  </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $this->config->item("jsadmin_assets");?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs text-capitalize"><?php $val = explode("@",$this->session->userdata("login_email")); echo $val["0"];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->config->item("jsadmin_assets");?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p class="text-capitalize"><?php $val = explode("@",$this->session->userdata("login_email")); echo $val["0"];?>  - Admin
                  <small>Member since - <?php echo date('F Y',strtotime($this->session->userdata("login_created")));?> </small>
                </p>
              </li> 
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url("admin/change_password");?>" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url("admin/logout");?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li> 
        </ul>
      </div>
    </nav>
  </header>