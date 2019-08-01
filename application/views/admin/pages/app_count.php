
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       App Downloads Form 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">App Downloads</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">App Downloads</h3>
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
				<label>App Downloads <span class="text-red">*</span></label>
                <input type="text" class="form-control" value="<?php echo $app_count->app_count;?>" name="app_count" > 
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




