<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->config->item("jsadmin_assets");?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p class="text-capitalize"><?php $val = explode("@",$this->session->userdata("login_email")); echo $val["0"];?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> 
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview dashboard">
                <a href="<?php echo base_url("admin/dashboard");?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a> 
            </li> 
        <?php if($this->session->userdata("manage-permission") == "1"){?>
            <li class="treeview permissions">
                <a href="<?php echo base_url("admin/permissions");?>">
                    <i class="fa fa-key"></i> <span>Permissions</span> 
                </a> 
            </li> 
        <?php }  if($this->session->userdata("manage-roles") == "1"){?> 
            <li class="treeview create-role view-roles update-role">
                <a href="javascript:void(0);">
                    <i class="fa fa-bookmark"></i>
                    <span>Roles</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata("create-role") == "1"){ ?>
                    <li class="create-role"><a href="<?php echo base_url("admin/create-role");?>"><i class="fa fa-circle-o"></i> Create</a></li>    
                    <?php } if($this->session->userdata("view-roles") == "1"){ ?>
                    <li class="view-roles update-role"><a href="<?php echo base_url("admin/view-roles");?>"><i class="fa fa-circle-o"></i> View</a></li> 
                    <?php } ?>
                </ul>
            </li>        
        <?php } if($this->session->userdata("manage-employees") == "1"){?>
            <li class="treeview create-employee view-employees update-employee">
                <a href="javascript:void(0);">
                    <i class="fa fa-users"></i>
                    <span>Employees</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata("create-employee") == "1"){ ?>
                    <li class="create-employee"><a href="<?php echo base_url("admin/create-employee");?>"><i class="fa fa-circle-o"></i> Create</a></li>    
                    <?php } if($this->session->userdata("view-employees") == "1"){ ?>
                    <li class="view-employees update-employee"><a href="<?php echo base_url("admin/view-employees");?>"><i class="fa fa-circle-o"></i> View</a></li> 
                    <?php } ?>
                </ul>
            </li>
        <?php }  if($this->session->userdata("manage-blood-banks") == "1"){ ?>
            <li class="treeview create_blood_bank view-blood-bank view-mother-blood-bank view-blood-storage view-bctv update-blood-bank update-mother-blood-bank  update-blood-storage update-bctv">
                <a href="javascript:void(0);">
                    <i class="fa fa-bank"></i>
                    <span>Blood Bank</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata("create-blood-bank") == "1"){ ?>
                    <li class="create_blood_bank"><a href="<?php echo base_url("admin/create_blood_bank");?>"><i class="fa fa-circle-o"></i> Create</a></li> 
                    <?php } if($this->session->userdata("manage-view-blood-banks") == "1"){ ?>
                    <li class="view-blood-bank view-mother-blood-bank view-blood-storage view-bctv update-blood-bank update-mother-blood-bank update-blood-storage update-bctv">
                        <a href="javascript:void(0);"><i class="fa fa-circle-o"></i> View
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php  if($this->session->userdata("view-blood-bank") == "1"){ ?>
                                <li class="view-blood-bank update-blood-bank"><a href="<?php echo base_url("admin/view-blood-bank/1");?>"><i class="fa fa-circle-o"></i> Blood Banks</a></li>
                            <?php }  if($this->session->userdata("view-mother-blood-bank") == "1"){ ?>
                                <li class="view-mother-blood-bank update-mother-blood-bank"><a href="<?php echo base_url("admin/view-mother-blood-bank/2");?>"><i class="fa fa-circle-o"></i> Mother Blood Banks</a></li>
                            <?php } if($this->session->userdata("view-blood-storage") == "1"){ ?>
                                <li class="view-blood-storage update-blood-storage"><a href="<?php echo base_url("admin/view-blood-storage/3");?>"><i class="fa fa-circle-o"></i> Blood Storage Centre</a></li>
                            <?php }  if($this->session->userdata("view-bctv") == "1"){ ?>
                                <li class="view-bctv update-bctv"><a href="<?php echo base_url("admin/view-bctv/4");?>"><i class="fa fa-circle-o"></i> BCTV </a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </li> 
        <?php }  if($this->session->userdata("manage-users") == "1"){?>
            <li class="treeview users">
                <a href="<?php echo base_url("admin/users");?>">
                    <i class="fa fa-users"></i> <span>Users</span> 
                </a> 
            </li>
        <?php } if($this->session->userdata("manage-blood-not-satisfied") == "1") { ?> 
            <li class="treeview blood-request-not-satisfied">
                <a href="<?php echo base_url("admin/blood-request-not-satisfied");?>">
                    <i class="fa fa-delicious"></i> <span>Blood Request Not Satisfied</span> 
                </a> 
            </li>
        <?php } if($this->session->userdata("manage-blood-bank-staff") == "1") { ?>
        <li class="treeview create-staff view-staff update-staff">
            <a href="javascript:void(0);">
                <i class="fa fa-user"></i>
                <span>Staff</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> 
                <?php if($this->session->userdata("create-blood-bank-staff") == "1") { ?>
                <li class="create-staff"><a href="<?php echo base_url("admin/create-staff");?>"><i class="fa fa-circle-o"></i> Create</a></li>  
                <?php } if($this->session->userdata("view-blood-bank-staff") == "1") { ?>
                <li class="view-staff update-staff"><a href="<?php echo base_url("admin/view-staff");?>"><i class="fa fa-circle-o"></i> View</a></li> 
                <?php } ?>
            </ul>
        </li> 
        <?php } if($this->session->userdata("manage-reports") == "1") {?>
        <li class="treeview reports camp_reports blood_camp_reports donation_summary detailed_donation blood-availability blood-components blood-grouping blood-discarded blood-screening outblood-availability outblood-collection">
            <a href="javascript:void(0);">
                <i class="fa fa-bar-chart"></i>
                <span>Reports</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> 
                <?php if($this->session->userdata("blood-donated-reports") == '1'){ ?>
			<li class="reports"><a href="<?php echo base_url("admin/reports");?>"><i class="fa fa-circle-o"></i> Blood Donated</a></li>  
                <?php }  if($this->session->userdata("camp-donors-reports") == '1'){ ?>
			<li class="camp_reports"><a href="<?php echo base_url("admin/camp_reports");?>"><i class="fa fa-circle-o"></i> Camp Donors</a></li> 
                <?php }  if($this->session->userdata("blood-bank-camp-reports") == '1'){ ?> 
			<li class="blood_camp_reports"><a href="<?php echo base_url("admin/blood_camp_reports");?>"><i class="fa fa-circle-o"></i> Blood Bank Camps</a></li> 
                <?php } if($this->session->userdata("donation-summary-reports") == '1'){ ?> 
                        <li class="donation_summary"><a href="<?php echo base_url("admin/donation_summary");?>"><i class="fa fa-circle-o"></i> Donation Summary</a></li>
                <?php  } if($this->session->userdata("blood-grouping-reports") == "1") { ?>
                <li class="blood-grouping"><a href="<?php echo base_url("admin/blood-grouping");?>"><i class="fa fa-circle-o"></i> Blood Grouping</a></li> 
                <?php }if($this->session->userdata("blood-screening-reports") == "1") { ?>
                <li class="blood-screening"><a href="<?php echo base_url("admin/blood-screening");?>"><i class="fa fa-circle-o"></i> Blood Screening</a></li> 
                <?php } if($this->session->userdata("blood-component-reports") == "1") { ?>
                <li class="blood-components"><a href="<?php echo base_url("admin/blood-components");?>"><i class="fa fa-circle-o"></i> Blood Components</a></li> 
                <?php } if($this->session->userdata("blood-discarded-reports") == "1") { ?>
                <li class="blood-discarded"><a href="<?php echo base_url("admin/blood-discarded");?>"><i class="fa fa-circle-o"></i> Blood Discarded</a></li> 
                <?php } if($this->session->userdata("blood-availability-reports") == "1") { ?>
                <li class="blood-availability"><a href="<?php echo base_url("admin/blood-availability");?>"><i class="fa fa-circle-o"></i> Blood Availability</a></li>  
                <?php } if($this->session->userdata("out-blood-availability-reports") == "1") { ?>
                <li class="outblood-availability"><a href="<?php echo base_url("admin/outblood-availability");?>"><i class="fa fa-circle-o"></i> Out Blood Availability</a></li>  
                <?php } if($this->session->userdata("out-blood-collection-reports") == "1") { ?>
                <li class="outblood-collection"><a href="<?php echo base_url("admin/outblood-collection");?>"><i class="fa fa-circle-o"></i> Out Blood Collection</a></li>  
                <?php } ?> 
          </ul>
        </li>  	
        <?php } if($this->session->userdata("manage-issue-reports") == "1") {?>
            <li class="treeview issue-summary-reports bloodbank-wise-issued-reports detail-blood-issued-reports request-closed-reports">
                <a href="javascript:void(0);">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Blood Issued Reports </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu"> 
                    <?php if($this->session->userdata("issue-summary-reports") == '1'){ ?>
                        <li class="issue-summary-reports"><a href="<?php echo base_url("admin/issue-summary-reports");?>"><i class="fa fa-circle-o"></i> Summary  </a></li>  
                    <?php } if($this->session->userdata("detail-blood-issued-reports") == '1'){ ?>
                        <li class="detail-blood-issued-reports"><a href="<?php echo base_url("admin/detail-blood-issued-reports");?>"><i class="fa fa-circle-o"></i> Detailed Blood Issued</a></li>   
                    <?php }  if($this->session->userdata("bloodbank-wise-issued-reports") == '1'){ ?>
                        <li class="bloodbank-wise-issued-reports"><a href="<?php echo base_url("admin/bloodbank-wise-issued-reports");?>"><i class="fa fa-circle-o"></i> Blood Bank Wise</a></li>  
                    <?php }  if($this->session->userdata("request-closed-reports") == '1'){ ?>
                        <li class="request-closed-reports"><a href="<?php echo base_url("admin/request-closed-reports");?>"><i class="fa fa-circle-o"></i>  Request Closed </a></li>  
                    <?php }?>
                </ul>
            </li>
        <?php }  if($this->session->userdata("manage-appointments") == "1") { ?>
        <li class="appointments"><a href="<?php echo base_url("admin/appointments");?>"><i class="fa fa-calendar"></i> Appointments</a></li>  
        <?php } if($this->session->userdata("manage-blood-donation") == "1") { ?>
        <li class="treeview create_blood_donation view_blood_donation edit_blood_donation">
            <a href="javascript:void(0);">
                <i class="fa fa-tint"></i>
                <span>Blood Donation Details</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> 
                <?php if($this->session->userdata("create-blood-donation") == "1") { ?>
                <li class="create_blood_donation"><a href="<?php echo base_url("admin/create_blood_donation");?>"><i class="fa fa-circle-o"></i> Create</a></li>    
                <?php } if($this->session->userdata("view-blood-donation") == "1") { ?>
                <li class="view_blood_donation edit_blood_donation"><a href="<?php echo base_url("admin/view_blood_donation");?>"><i class="fa fa-circle-o"></i> View</a></li> 
                <?php } ?>
            </ul>
        </li> 
        <?php } if($this->session->userdata("manage-transfer-blood") == "1"){?>
            <li class="treeview transfer-collection">
                <a href="<?php echo base_url("admin/transfer-collection");?>">
                    <i class="fa fa-refresh"></i> <span>Transfer Collection</span> 
                </a> 
            </li>
        <?php }  if($this->session->userdata("manage-transfer-collection") == "1") { ?>
        <li class="treeview transfer-reports collection-reports">
            <a href="javascript:void(0);">
                <i class="fa fa-tint"></i>
                <span>Transfer &  Collection</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> 
                <?php if($this->session->userdata("transfer-reports") == "1") { ?>
                <li class="transfer-reports"><a href="<?php echo base_url("admin/transfer-reports");?>"><i class="fa fa-circle-o"></i> Transfer</a></li>    
                <?php } if($this->session->userdata("transfer-reports") == "1") { ?>
                <li class="collection-reports"><a href="<?php echo base_url("admin/collection-reports");?>"><i class="fa fa-circle-o"></i> Collection</a></li> 
                <?php } ?>
            </ul>
        </li> 
        <?php } if($this->session->userdata("manage-component-preparation") == "1"){?>
            <li class="treeview prepare-components component_preparation donor_medical_checkup donor_bleeding blood_grouping screening">
                <a href="<?php echo base_url("admin/prepare-components");?>">
                    <i class="fa fa-asterisk"></i> <span>Component Preparation</span> 
                </a> 
            </li>
        <?php } ?> 
        <?php if($this->session->userdata("manage-camps") == "1") { ?>
        <li class="treeview camps bulk_sms">
            <a href="<?php echo base_url("admin/camps");?>">
                <i class="fa fa-mobile"></i> <span>Camps</span> 
            </a> 
        </li>
        <?php } if($this->session->userdata("manage-issue-blood") == "1"){?>
        <li class="issue_blood issue issue_submit request-issue"><a href="<?php echo base_url("admin/issue_blood");?>"><i class="fa fa-tint"></i> Issue Blood</a></li>   
        <?php } if($this->session->userdata("manage-blood-availability") == "1"){?>
        <li class="out-blood-availability"><a href="<?php echo base_url("admin/out-blood-availability");?>"><i class="fa fa-tint"></i> Blood Availability</a></li>           
        <?php } if($this->session->userdata("manage-blood-collection") == "1"){?>
        <li class="out-blood-collection"><a href="<?php echo base_url("admin/out-blood-collection");?>"><i class="fa fa-tint"></i> Blood Collection</a></li>           
        <?php }  if($this->session->userdata("manage-bloodbank-finance") == "1"){?>
        <li class="bloodbank-finance"><a href="<?php echo base_url("admin/bloodbank-finance");?>"><i class="fa fa-money"></i> Finance</a></li>   
        <?php } ?>
        <li class="treeview change_password blood_bank">
            <a href="javascript:void(0);">
                <i class="fa fa-cogs"></i>
                <span>Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <?php if($this->session->userdata("manage-issue-blood") == "1" || $this->session->userdata("login_type") == "6utype"){?>
                <li class="blood_bank"><a href="<?php echo base_url("admin/blood_bank");?>"><i class="fa fa-circle-o"></i> Update Blood Bank</a></li>   
            <?php } ?>
            <li class="change_password"><a href="<?php echo base_url("admin/change_password");?>"><i class="fa fa-circle-o"></i> Change Password</a></li>   
          </ul>
         </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
