<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employee
            <small>Creating Employee</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Employee</a></li>
            <li class="active">Create Employee</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Employee</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="form-horizontal" method="post" action=""> 
                <div class="box-body">
                    <div class="col-sm-12">
                        <?php $this->load->view("admin/layout/success_error");?>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>First Name <span class="text-red">*</span></label>
                            <input class="form-control input_char" name="first_name" placeholder="Enter First Name ..." value="<?php echo set_value("first_name");?>" maxlength="150"/>
                            <div class="text-red"><?php echo form_error("first_name");?></div>
                        </div> 
                        <div class="col-sm-6">
                            <label>Last Name <span class="text-red">*</span></label>
                            <input class="form-control input_char" name="last_name" placeholder="Enter Last Name ..." value="<?php echo set_value("last_name");?>" maxlength="150"/>                            
                            <div class="text-red"><?php echo form_error("last_name");?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Gender <span class="text-red">*</span></label>
                            <select class="form-control" name="gender">
                                <option value="">-- Select Gender --</option>
                                <option value="F" <?php echo set_select("gender","F");?>>Female</option>
                                <option value="M" <?php echo set_select("gender","M");?>>Male</option>
                            </select>
                            <div class="text-red"><?php echo form_error("gender");?></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Date of Birth <span class="text-red">*</span></label>
                            <div class="input-group date">
                                    <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Enter Date of Birth ..." name="dob" value="<?php echo set_value("dob");?>">
                            </div>
                            <div class="text-red"><?php echo form_error("dob");?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Mobile No. <span class="text-red">*</span></label>
                            <input type="text" class="form-control input_num" placeholder="Enter Mobile No. ..." name="mobile" value="<?php echo set_value("mobile");?>" minlength="10" maxlength="10"/>
                      <div class="text-red"><?php echo form_error("mobile");?></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Email Id <span class="text-red">*</span></label>
                            <input type="email" class="form-control" placeholder="Enter Email Id ..." name="email_id" value="<?php echo set_value("email_id");?>" /> 
                            <div class="text-red"><?php echo form_error("email_id");?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Blood Group <span class="text-red">*</span></label>
                            <select class="form-control" name="blood_group"> 
                                <option value="">-- Select Blood Group --</option>
                                    <?php 
                                    if(count($blood_groups) > 0){ 
                                        foreach($blood_groups as $bd){
                                            ?>
                                            <option value="<?php echo $bd->blood_group_id;?>" <?php echo set_select("blood_group",$bd->blood_group_id);?>><?php echo $bd->blood_group_name;?></option>
                                            <?php 
                                            }
                                    }?>
                            </select>
                            <div class="text-red"><?php echo form_error("blood_group");?></div>
                        </div> 
                        <div class="col-sm-6">
                            <label>District <span class="text-red">*</span></label>
                            <select class="form-control change_distr" name="district">
                                <option  value=""> -- Select District</option> 
                                <?php 
                                if(count($district) > 0){ 
                                    foreach($district as $bds){
                                        ?>
                                        <option value="<?php echo $bds->district_name;?>" <?php echo set_select("district",trim($bds->district_name));?>><?php echo trim($bds->district_name);?></option>
                                        <?php 
                                        }
                                }?>
                            </select>
                            <div class="text-red"><?php echo form_error("district");?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Assign Blood Banks <span class="text-red">*</span></label>
                            <select class="form-control assign_bloodbank" name="assign_bloodbank[]" multiple=""> 
                                <option value="">-- Select Blood Bank --</option> 
                            </select>
                            <div class="text-red"><?php echo form_error("assign_bloodbank[]");?></div>
                        </div> 
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-sm btn-success" name="submit" value="Create">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>