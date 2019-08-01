  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->config->item("jsadmin_assets");?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p class="text-capitalize"><?php echo $this->session->userdata("profile")["0"]->name;?> </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> 
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview dashboard">
          <a href="<?php echo base_url("dashboard");?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a> 
		</li>
		<li class="treeview view_blood_bank">
          <a href="<?php echo base_url("users/view_blood_bank");?>">
            <i class="fa fa-bank"></i> <span>Blood Banks</span> 
          </a> 
        </li>	
        <li class="treeview view_blood_donation">
          <a href="<?php echo base_url("users/view_blood_donation");?>">
            <i class="fa fa-clock-o"></i> <span>Donation History</span> 
          </a> 
        </li>
		<li class="treeview profile ">
          <a href="<?php echo base_url("users/profile");?>">
            <i class="fa fa-user"></i> <span>Profile</span> 
          </a> 
        </li>
		<li class="treeview camps ">
          <a href="<?php echo base_url("users/camps");?>">
            <i class="fa fa-mobile"></i> <span>Camps</span> 
          </a> 
        </li>
		<li class="treeview appointments ">
          <a href="<?php echo base_url("users/appointments");?>">
            <i class="fa fa-calendar"></i> <span>Manage Appointments / <br/> Deposit </span> 
          </a> 
        </li>
		<li class="treeview request_blood ">
          <a href="<?php echo base_url("users/request_blood");?>">
            <i class="fa fa-calendar"></i> <span>Request Blood </span> 
          </a> 
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
