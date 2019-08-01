<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Camps 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("users/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0);">Camps</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-default"> 
			<div class="box-header with-border">
			  <h3 class="box-title">View Camps</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body">
                            <div class="col-sm-12">
                                <div class="form-group pull-right"> 
                                    <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>users/userCamps/')"/>
                                </div>
                            </div>
                            <div class="postList">
				<table class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>S.No.</th>  
					  <th>Camp Message</th>  
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						$i = 1;
						foreach($view as $vw){
						?>
						<tr>
						  <td><?php echo $i++;?></td>  
						  <td><?php echo $vw->camp_description;?></td>  
						</tr> 
						<?php
						} 
					}
					?>
                </tbody>
                <tfoot>
					<tr>
					  <th>S.No.</th>  
					  <th>Camp Message</th>  
					</tr>
                </tfoot>
              </table>
                                <?php echo $this->ajax_pagination->create_links();?>
                            </div>
			</div>
		</div>
	</section>
</div>