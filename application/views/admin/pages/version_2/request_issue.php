<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Request Blood
				<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("users/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Request Blood</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
	<!-- Small boxes (Stat box) -->
		<!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
			<h3 class="box-title">Request Blood</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<form method="post" action="">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<?php $this->load->view("admin/layout/success_error");?>
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label>Blood Group <span class="text-red">*</span></label>
								<select class="form-control" name="blood_group">
									<option value=""> Select Blood Group</option>
									<?php 
									if($ct > 0){
												foreach($ct as $bt){
													?>
													<option value="<?php echo $bt->blood_group_name;?>" <?php echo set_select("blood_group",$bt->blood_group_name);?> ><?php echo $bt->blood_group_name;?></option>			
													<?php
												}
									}?>
								 </select>
								<div class="text-red"><?php echo form_error("blood_group");?></div> 
							</div>  
						</div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label>First Name <span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="first_name" value="<?php echo set_value('first_name');?>" placeholder="First Name">
                                                                <div class="text-red"><?php echo form_error("first_name");?></div> 
                                                        </div>  
                                                </div> 
						<div class="col-md-12"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Last Name <span class="text-red">*</span></label>
								<input type="text" class="form-control" name="last_name" value="<?php echo set_value('last_name');?>" placeholder="Last Name">
								<div class="text-red"><?php echo form_error("last_name");?></div> 
							</div>  
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Age <span class="text-red">*</span></label>
								<input type="number" class="form-control input_num" placeholder="Age" name="age" value="<?php echo set_value("age");?>" min="1">
								<div class="text-red"><?php echo form_error("age");?></div> 
							</div>  
						</div> 
						<div class="col-md-12"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Gender <span class="text-red">*</span></label>
								 <div>
									<input type="radio"   name="sex" value="2" <?php echo set_checkbox("sex",'2');?>> Female
									<input type="radio"   name="sex" value="1" <?php echo set_checkbox("sex","1");?>>  Male
								</div>  
								<div class="text-red"><?php echo form_error("sex");?></div>
							</div>  
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Diagnosis or Description <span class="text-red">*</span></label>
								<textarea class="form-control" name="diag" placeholder="Diagnosis or Description" ><?php echo set_value("diag");?></textarea>
								<div class="text-red"><?php echo form_error("diag");?></div> 
							</div>  
						</div> 
						<div class="col-md-12"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Doctor Name <span class="text-red">*</span></label>
								<input type="text" class="form-control" name="doctor_name" value="<?php echo set_value('doctor_name');?>" placeholder="Doctor Name">
								<div class="text-red"><?php echo form_error("doctor_name");?></div>  
							</div>  
						</div>
						<div class="col-md-6"> 
							<label>Schedule Date <span class="text-red">*</span></label>
							<div class="input-group">
								<input type="text" class="form-control" id="adatepicker" name="date_slot">
								<div class="input-group-addon">
								  <i class="fa fa-calendar"></i>
								</div>
							</div>
							<div class="text-red"><?php echo form_error("date_slot");?></div>  
						</div> 
						<div class="col-md-12"></div>  
						<div class="col-md-12">
                                                    <label>Blood Components</label>
                                                    <table  class="table-bordered table-striped table table-responsive">
                                                        <tr>
                                                            <th>Whole Blood Cells</th>
                                                            <th>Packed Cells</th>
                                                            <th>Frozen Plasma</th>
                                                            <th>Fresh Frozen Plasma</th>
                                                            <th>Platelet Rich Plasma</th>
                                                            <th>Platelet Concentrate</th>
                                                            <th>Cryoprecipitate</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" name="white_blood_cells" value="<?php echo set_value("white_blood_cells");?>"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="packed_cell_units" value="<?php echo set_value("packed_cell_units");?>"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fp_units" value="<?php echo set_value("fp_units");?>"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="ffp_units" value="<?php echo set_value("ffp_units");?>"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="prp_units" value="<?php echo set_value("prp_units");?>"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="platelet_concentrate_units" value="<?php echo set_value("platelet_concentrate_units");?>"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="cryoprecipitate_units" value="<?php echo set_value("cryoprecipitate_units");?>"/>
                                                            </td>
                                                        </tr>
                                                    </table>
						</div>
					</div>	
				</div>			
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-block btn-success" name="submit" value="Submit">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>