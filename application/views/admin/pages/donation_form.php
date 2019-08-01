<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Donor Details 
            <small>Creating Blood Donors</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Donor Details</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Blood Donor Details</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
            </div>
        </div>
	<form class="" method="post" action="">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
                <div class="col-md-12">
                        <?php $this->load->view("admin/layout/success_error");?>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Donor Mobile No. <span class="text-red">*</span></label>
                        <input type="text" class="form-control search_mobile input_num" placeholder="Enter Donor Mobile No. ..." name="mobile" value="<?php echo set_value("mobile");?>" minlength="10" maxlength="10" autocomplete="off">
                        <div class="text-red"><?php echo form_error("mobile");?></div>
                    </div>  
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Donor ID. <span class="text-red">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon mg_name"><?php echo $bag_number;?></span>
                            <input type="text" class="form-control" placeholder="Enter Donor ID. ..." name="donor_id" value="<?php echo set_value("donor_id");?>">
                        </div> 
                        <div class="text-red"><?php echo form_error("donor_id");?></div>
                    </div>  
                </div>
              <div class="col-md-12"></div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Donor Name <span class="text-red">*</span></label>
                      <input type="text" class="form-control input_char" placeholder="Enter Donor Name ..." name="dname" value="<?php echo set_value("dname");?>">
                      <div class="text-red"><?php echo form_error("dname");?></div>
                  </div>			  
              </div>    
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Donor Gender<span class="text-red">*</span></label>
                      <select class="form-control" name="sex">
                          <option value="">-- Select Gender --</option>
                          <option value="F" <?php echo set_select("sex","F");?>>Female</option>
                          <option value="M" <?php echo set_select("sex","M");?>>Male</option>
                      </select>
                      <div class="text-red"><?php echo form_error("sex");?></div>
                  </div> 
              </div>
              <div class="col-md-12"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Blood Group <span class="text-red">*</span></label>
                    <select class="form-control" name="blood_group"> 
                        <option value="">-- Select Blood Group --</option>
                            <?php 
                            if(count($blood_groups) > 0){ 
                                foreach($blood_groups as $bd){
                                    ?>
                                    <option value="<?php echo $bd->blood_group_name;?>" <?php echo set_select("blood_group",$bd->blood_group_name);?>><?php echo $bd->blood_group_name;?></option>
                                    <?php 
                                    }
                            }?>
                    </select>
                    <div class="text-red"><?php echo form_error("blood_group");?></div>
                </div>
            </div>  
            <div class="col-md-6">			  
                <div class="form-group">
                    <label>No. of Units <span class="text-red">*</span></label>
                    <input type="number" class="form-control" placeholder="Enter No. of Units ..." name="volume" value="<?php echo set_value("volume")?set_value("volume"):"1";?>" min="0"> 
                    <div class="text-red"><?php echo form_error("volume");?></div>
                </div>
            </div>  
            <div class="col-md-12"></div>
                <?php if($this->session->userdata("login_parent") == "1"){?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Blood Bank Name <span class="text-red">*</span></label>
                        <select class="form-control blood_camp" name="blood_name" onchange="blood_camp()"> 
                            <option value="">-- Select Blood Bank Name --</option>
                            <?php if(count($blood_name) > 0){ 
                                foreach($blood_name as $bdq){
                                    ?>
                                    <option value="<?php echo $bdq->bloodbank_id;?>" blood_login_id="<?php echo $bdq->blood_login_id;?>" <?php echo set_select("blood_name",$bdq->bloodbank_id);?>><?php echo $bdq->bloodbank_name;?></option>
                            <?php }
                            }?>
                        </select>
                        <div class="text-red"><?php echo form_error("blood_name");?></div>
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Donated Date <span class="text-red">*</span></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Enter Donated Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>">
                        </div>
                        <div class="text-red"><?php echo form_error("donation_date");?></div>
                    </div>
                </div>  
			<div class="col-md-12"></div>
			<div class="col-md-6">
                            <div class="form-group">
                                <label>Camp Name</label>
                                <select class="form-control camp_name" name="camp_name">
                                    <option value=""> -- Select Camp Name -- </option> 
                                </select> 
                            </div>
			</div> 
			<?php } else { ?> 
			<div class="col-md-6">
                            <div class="form-group">
                                <label>Donated Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Enter Donated Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>" >
                                </div>
                                <div class="text-red"><?php echo form_error("donation_date");?></div>
                            </div>
			</div>  
			<div class="col-md-6">
				  <div class="form-group">
					<label>Camp Name</label>
					<select class="form-control" name="camp_name">
						<option value=""> -- Select Camp Name -- </option>
						<?php 
						if(count($fe_camps) > 0){
								foreach($fe_camps as $fe){
									?>
									<option value="<?php echo $fe->camp_id;?>" <?php echo set_select("camp_name",$fe->camp_id);?> ><?php echo $fe->camp_description;?></option>
									<?php
								}
						}
						?> 
					</select> 
				  </div>
			</div> 
			<div class="col-md-12"></div>
			<?php } ?> 
          </div>
          <!-- /.row --> 
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