<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Camps 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url("admin/camps");?>">Camps</a></li>
        <li class="active">Send SMS</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">Send SMS of Camps </h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body">
				<form method="post" action="" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<?php $this->load->view("admin/layout/success_error");?>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
								<a href="<?php echo base_url("admin/download");?>">Download</a> this Template
						  </div>  
						</div> 
						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="send_sms"/>
							</div>
							<div class="text-red"><?php echo form_error("send_sms");?></div>
						</div> 
					</div>	 
					<div class="row">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-block btn-success" name="submit" value="Send">Send</button>
						</div>
					</div>
				</form>
			</div>  
		</div>
	</section>
</div>