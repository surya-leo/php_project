<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Profile
				<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("users/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Profile</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
	<!-- Small boxes (Stat box) -->
		<!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
			<h3 class="box-title">Profile</h3>
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
									<label>Name <span class="text-red">*</span></label>
									<input type="text" class="form-control input_char" placeholder="Enter Name ..." name="name" value="<?php echo $view->name;?>">
									<div class="text-red"><?php echo form_error("name");?></div>
								</div>  
						</div>
						<div class="col-md-6">
							  <div class="form-group">
									<label>Age<span class="text-red">*</span></label>
									<input type="text" class="form-control input_num" placeholder="Enter Age ..." name="age" value="<?php echo $view->age;?>" minlength="2" maxlength="3" >
									<div class="text-red"><?php echo form_error("age");?></div>
							  </div>  
						</div>
						<div class="col-md-12"></div>
						<div class="col-md-6">
								<div class="form-group">
									<label>Gender <span class="text-red">*</span></label>
									<select name="sex" class="form-control">
										<option value="">-- Select Gender --</option>
										<option value="Female" <?php echo ($view->sex == "Female")?"selected=selected":"";?> >Female</option> 
										<option value="Female" <?php echo ($view->sex == "Male")?"selected=selected":"";?> >Male</option>   
									</select>
									<div class="text-red"><?php echo form_error("sex");?></div>
								</div>  
						</div>
						<div class="col-md-6">
							  <div class="form-group">
									<label>Blood Group<span class="text-red">*</span></label>
									<select name="blood_group" class="form-control">
										<option value="">-- Select Gender --</option>
										<?php 
										if(count($blod_group) > 0){
											foreach($blod_group as $bg){
												?>
										<option value="<?php echo $bg->blood_group_name;?>" <?php echo ($view->blood_group == $bg->blood_group_name)?"selected=selected":"";?> ><?php echo $bg->blood_group_name;?></option>  
											<?php 	}
										}?>
									</select>
									<div class="text-red"><?php echo form_error("blood_group");?></div>
							  </div>  
						</div>
						<div class="col-md-12"></div>
						<div class="col-md-6">
							  <div class="form-group">
									<label>District</label>
									<select name="district" class="form-control">
										<option value="">-- Select District--</option>
										<?php 
										if(count($district) > 0){
											foreach($district as $jdg){
												?>
										<option value="<?php echo $jdg->district_id;?>" <?php echo ($view->district_id == $jdg->district_id)?"selected=selected":"";?> ><?php echo $jdg->district_name;?></option>  
											<?php 	}
										}?>
									</select>
							  </div>  
						</div>
						<div class="col-md-6">
								<div class="form-group">
									<label>Location <span class="text-red">*</span></label>
									<textarea type="text" class="form-control" name="location" maxlength="150"><?php echo $view->location;?></textarea>
									<div class="text-red"><?php echo form_error("location");?></div>
								</div>  
						</div> 
					</div>	
				</div>			
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-block btn-success" name="submit" value="Update">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
