
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password Form 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0);">Settings</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Change Password</h3>
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
				<label>New Password <span class="text-red">*</span></label>
                <input type="password" class="form-control" placeholder="New Password" name="new_pass" >
				<div class="text-red"><?php echo form_error("new_pass");?></div>
              </div>  
			</div> 
			</div>	
			<div class="row">		
				<div class="col-md-6">
				  <div class="form-group">
					<label>Confirm Password <span class="text-red">*</span></label>
					<input type="password" class="form-control" placeholder="Confirm Password" name="con_pass">
					<div class="text-red"><?php echo form_error("con_pass");?></div> 
				  </div>			  
				</div>   
				<!-- /.col -->
		  </div>
          <!-- /.row --> 
        </div> 
		<div class="box-footer">
			<div class="row">
				<div class="col-sm-2">
					<button type="submit" class="btn btn-block btn-success" name="submit" value="Update">Update Password</button>
				</div>
			</div>
		</div>
		</form>
      </div>
	  		
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->




