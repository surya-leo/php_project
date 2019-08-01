<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Blood Bank Details 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("users/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0);">Blood Bank</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">View Blood Bank</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body">
                            <div class="col-sm-12">
                                <div class="form-group pull-right"> 
                                    <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>users/userBloodbank/')"/>
                                </div>
                            </div>
                            <div class="postList">
				<table class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>Blood Bank Name</th>
					  <th>District</th>
					  <th>Mobile No</th>
					  <th>Email Id</th>
					  <th>Category</th> 
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						foreach($view as $vw){
						?>
						<tr>
						  <td><?php echo $vw->bloodbank_name;?></td>
						  <td><?php echo $vw->district;?></td>
						  <td><?php echo $vw->mobile;?></td>
						  <td><?php echo $vw->email_id;?></td>
						  <td><?php echo $vw->category;?></td> 
						</tr> 
						<?php
						} 
                                        } else{
                                                echo "<tr><td colspan='5'>BloodBanks not available</td></tr>";
                                        }
					?>
                </tbody>
                <tfoot>
					<tr>
					  <th>Blood Bank Name</th>
					  <th>District</th>
					  <th>Mobile No</th>
					  <th>Email Id</th>
					  <th>Category</th> 
					</tr>
                </tfoot>
              </table>
                                <?php echo $this->ajax_pagination->create_links();?>
                            </div>
			</div>
		</div>
	</section>
</div>