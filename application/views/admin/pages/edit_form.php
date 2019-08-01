  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blood Donor Details Form 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url("admin/view_blood_donation");?>">View Blood Donor Details</a></li>
        <li class="active">Edit</li>
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
				<label>Donor ID. <span class="text-red">*</span></label>
                <input type="text" class="form-control" placeholder="Enter Donor ID. ..." name="donor_id" value="<?php echo  $view->donor_id;?>">
				<div class="text-red"><?php echo form_error("donor_id");?></div>
              </div>  
			</div>
			<div class="col-md-6">
              <div class="form-group">
				<label>Donor Mobile No. <span class="text-red">*</span></label>
                <input type="text" class="form-control" placeholder="Enter Donor Mobile No. ..." name="mobile" value="<?php echo  $view->mobile;?>">
				<div class="text-red"><?php echo form_error("mobile");?></div>
              </div>  
			</div>  
			<div class="col-md-12"></div>
			<div class="col-md-6">
			  <div class="form-group">
                <label>Donor Name <span class="text-red">*</span></label>
               <input type="text" class="form-control" placeholder="Enter Donor Name ..." name="dname" value="<?php echo $view->name;?>">
				<div class="text-red"><?php echo form_error("dname");?></div>
              </div>			  
			</div>    
			<div class="col-md-6">
			  <div class="form-group">
                <label>Donor Gender<span class="text-red">*</span></label>
                <select class="form-control" name="sex">
					<option value="">-- Select Gender --</option>
					<option value="F" <?php echo ($view->sex == "F")?"selected=selected":"";?>>Female</option>
					<option value="M" <?php echo ($view->sex == "M")?"selected=selected":"";?>>Male</option>
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
							<option value="<?php echo $bd->blood_group_name;?>" <?php echo ($view->blood_group == $bd->blood_group_name)?"selected=selected":"";?> ><?php echo $bd->blood_group_name;?></option>
							<?php 
							}
						}?>
					</select>
					<div class="text-red"><?php echo form_error("blood_group");?></div>
				  </div></div>  
			<div class="col-md-6">			  
				  <div class="form-group">
					<label>No. of Units<span class="text-red">*</span></label>
					<input type="number" class="form-control" placeholder="Enter No. of Units ..." name="volume" value="<?php echo $view->volume;?>" min="0"> 
					<div class="text-red"><?php echo form_error("volume");?></div>
				  </div>
			</div>  
			<div class="col-md-12"></div>
			<div class="col-md-6">
				  <div class="form-group">
					<label>Blood Bank Name <span class="text-red">*</span></label>
					<select class="form-control" name="blood_name"> 
						<option value="">-- Select Blood Bank Name --</option>
						<?php 
						if(count($blood_name) > 0){ 
							foreach($blood_name as $bdq){
							?>
							<option value="<?php echo $bdq->bloodbank_id;?>" <?php echo ($view->bloodbank_id == $bdq->bloodbank_id)?"selected=selected":"";?>><?php echo $bdq->bloodbank_name;?></option>
							<?php 
							}
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
						<input type="text" class="form-control pull-right" id="datepicker" placeholder="Enter Donated Date ..." name="donation_date" value="<?php echo $view->donation_date;?>">
					</div>
					<div class="text-red"><?php echo form_error("donation_date");?></div>
				</div>
			</div>  
			<div class="col-md-12"></div>
			<div class="col-md-6">
				  <div class="form-group">
					<label>Camp Name</label>
					<select class="form-control" name="camp_name">
						<option value=""> -- Select Camp Name -- </option>
						<?php 
						if(count($fe_camps) > 0){
								foreach($fe_camps as $fe){
									?>
									<option value="<?php echo $fe->camp_id;?>" <?php echo ($view->camp_name == $fe->camp_id)?"selected=selected":"";?> ><?php echo $fe->camp_description;?></option>
									<?php
								}
						}
						?> 
					</select>  
				  </div>
			</div>  
          </div>
          <!-- /.row --> 
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
	 </div>
<!-- /.col (right) -->
</div>
<!-- /.row -->




