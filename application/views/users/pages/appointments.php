<div class="content-wrapper"> 
	<section class="content-header">
		<h1>
			Manage Appointments
				<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("users/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Manage Appointments</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
	<!-- Small boxes (Stat box) -->
		<!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
			<h3 class="box-title">Manage Appointments</h3>
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
								<label>Blood Bank <span class="text-red">*</span></label>
								<select class="form-control" name="bloodbank_id"> 
									<option value="">-- Select Blood Bank Name --</option>
									<?php 
									if(count($blood_bank) > 0){ 
										foreach($blood_bank as $bdq){
										?>
										<option value="<?php echo $bdq->bloodbank_id;?>" <?php echo set_select("bloodbank_id",$bdq->bloodbank_id);?>><?php echo $bdq->bloodbank_name;?></option>
										<?php 
										}
									}?>
								</select>
								<div class="text-red"><?php echo form_error("bloodbank_id");?></div> 
							</div>  
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label>Schedule Date <span class="text-red">*</span></label>
								<div class="input-group">
									<input type="text" class="form-control datepicker" name="date_slot">
									<div class="input-group-addon">
									  <i class="fa fa-calendar"></i>
									</div>
								</div>
								<div class="text-red"><?php echo form_error("date_slot");?></div> 
							</div>  
						</div>
						<div class="col-md-12"></div>
						<div class="col-md-6"> 
							<div class="bootstrap-timepicker">
								<div class="form-group">
									<label>Schedule Time Slot <span class="text-red">*</span></label> 
									<div class="input-group">
										<input type="text" class="form-control timepicker" name="time_slot">
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div>
									</div>
								  <!-- /.input group -->
								</div>  
							</div>  
							<div class="text-red"><?php echo form_error("time_slot");?></div> 
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
