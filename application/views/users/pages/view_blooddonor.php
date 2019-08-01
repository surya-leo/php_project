<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Blood Donation Details 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("users/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0);">Blood Donation Details</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">View Blood Donation Details</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body"><div class="col-sm-12">
                                <div class="form-group pull-right"> 
                                    <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>users/userBlooddonor/')"/>
                                </div>
                            </div>
                            <div class="postList">                            
				<table id="" class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>Donor Id</th>
					  <th>Blood Bank Name</th>
					  <th>Name</th>
					  <th>Blood Group</th>
					  <th>Mobile No</th> 
					  <th>No. of Units</th>
					  <th>Donation Date</th>
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						foreach($view as $vw){
						?>
						<tr>
						  <td><?php echo $vw->donor_id;?></td>						  
						  <td><?php echo $vw->bloodbank_name;?></td>						  
						  <td><?php echo $vw->name;?></td>
						  <td><?php echo $vw->blood_group;?></td>
						  <td><?php echo $vw->mobile;?></td>
						  <td><?php echo $vw->volume;?></td>
						  <td><?php echo $vw->donation_date;?></td>
						</tr> 
						<?php
						} 
					}
					?>
                </tbody>
                <tfoot>
					<tr>
					  <th>Donor Id</th>
                                          <th>Blood Bank Name</th>
					  <th>Name</th>
					  <th>Blood Group</th>
					  <th>Mobile No</th> 
					  <th>Volume</th>
					  <th>Donation Date</th> 
					</tr>
                </tfoot>
              </table>
                                <?php echo $this->ajax_pagination->create_links();?>
                            </div>
			</div>
		</div>
	</section>
</div>