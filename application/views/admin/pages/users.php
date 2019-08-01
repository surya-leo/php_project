<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0);">Users</a></li>
        <li class="active">View Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">View Users</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body">
                            <div class="col-sm-12">
                                <div class="form-group pull-right"> 
                                    <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewUsers/')"/>
                                </div>
                            </div>
                            <div class="postList">
            <!--                    <table class="table table-bordered table-hover" id="example2">-->
                            <table class="table table-bordered table-hover filterable">
                                <thead>
                                                        <tr>  
                                                          <th>Mobile No</th>
                                                          <th>Name</th>
                                                          <th>Age</th> 
                                                          <th>Gender</th> 
                                                          <th>Location</th> 
                                                          <th>Blood Group</th> 
                                                        </tr>
                                </thead>
                                <tbody>
                                                        <?php 
                                                        if(count($view) > 0){
                                                                foreach($view as $vw){
                                                                ?>
                                                                <tr>  
                                                                  <td><?php echo $vw->mobile;?></td>
                                                                  <td><?php echo ($vw->name)?$vw->name:"N/A";?></td>
                                                                  <td><?php echo ($vw->age)?$vw->age:"N/A";?></td> 
                                                                  <td><?php echo ($vw->sex)?$vw->sex:"N/A";?></td> 
                                                                  <td><?php echo ($vw->location)?$vw->location:"N/A";?></td> 
                                                                  <td><?php echo ($vw->blood_group)?$vw->blood_group:"N/A";?></td> 
                                                                </tr> 
                                                                <?php
                                                                } 
                                                        }else{
                                                                echo "<tr><td colspan='6'>Users data not available</td></tr>";
                                                        }
                                                        ?>
                                </tbody>
                                <tfoot>
                                                        <tr>  
                                                          <th>Mobile No</th>
                                                          <th>Name</th>
                                                          <th>Age</th> 
                                                          <th>Gender</th> 
                                                          <th>Location</th> 
                                                          <th>Blood Group</th> 
                                                        </tr>
                                </tfoot>
                            </table>
                            <?php echo $this->ajax_pagination->create_links();?>
			</div>
		</div>
	</section>
</div>