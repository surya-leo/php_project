<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url("users/dashboard");?>" class="logo">
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
              <span class="hidden-xs text-capitalize"><?php echo $this->session->userdata("profile")["0"]->name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->config->item("jsadmin_assets");?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p class="text-capitalize"><?php echo $this->session->userdata("profile")["0"]->name;?>  - User
                  <small>Member since - <?php echo date('F Y',strtotime($this->session->userdata("since")));?> </small>
                </p>
              </li> 
              <!-- Menu Footer-->
              <li class="user-footer"> 
                <div class="pull-right">
                  <a href="<?php echo base_url("users/logout");?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li> 
        </ul>
      </div>
    </nav>
  </header>