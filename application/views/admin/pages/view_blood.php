<?php 
$uri    =   $this->uri->segment("3");
$yu     =   "update-".$button;
$up     =   $this->session->userdata($yu);       
$ct     =   '0';
if($up == '1'){
        $ct     =   '1';
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View <?php echo $uript;?> Details 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0);"><?php echo $uript;?></a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">View <?php echo $uript;?></h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body">
                            <div class="col-sm-12">
                                <div class="form-group pull-right"> 
                                    <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBloodbank/<?php echo $uri;?>/')"/>
                                </div>
                            </div>
                            <div class="postList">
				<table class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>S.No.</th>
					  <th><?php echo $uript;?> Name</th>
					  <th>District</th>
					  <th>Mobile No</th>
					  <th>Email Id</th>
					  <th>Category</th>
                                          <?php if($ct == '1'){?>
					  <th>Action</th>
                                          <?php } ?>
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						$i = 1;
						foreach($view as $vw){
							if($vw->category == "Private"){
									$vep 	=	"cadetblue";
							}
							if($vw->category == "Charity"){
									$vep 	=	"antiquewhite";
							}
							if($vw->category == "Government"){
									$vep 	=	"gold";
							}
							if($vw->category == ""){
									$vep 	=	"";
							}
						?>
						<tr class="<?php echo $vep;?>">
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo $vw->bloodbank_name;?></td>
                                                    <td><?php echo $vw->district;?></td>
                                                    <td><?php echo $vw->bbmobile;?></td>
                                                    <td><?php echo $vw->email_id;?></td>
                                                    <td><?php echo $vw->category;?></td>
                                                    <?php if($ct == '1'){?>
                                                    <td>
							<a href="<?php echo base_url("admin/update-".$button."/".$uri."/".$vw->login_id);?>" title="Edit" class="btn-success btn-sm">Edit</a></td>
                                                    <?php } ?>						  
						</tr> 
						<?php
						} 
					}else{
                                            if($ct == '1'){ ?>
                                                <tr><td colspan="7">No <?php echo $uript;?> Available</td></tr>
                                            <?php } else { ?>  
                                                    <tr><td colspan="6">No <?php echo $uript;?> Available</td></tr>
                                            <?php } 
                                        }
					?>
                </tbody>
                <tfoot>
					<tr>
					  <th>S.No.</th>
					  <th><?php echo $uript;?> Name</th>
					  <th>District</th>
					  <th>Mobile No</th>
					  <th>Email Id</th>
					  <th>Category</th>
                                          <?php if($ct == '1'){?>
					  <th>Action</th>
                                          <?php } ?>
					</tr>
                </tfoot>
              </table>
                                <?php echo $this->ajax_pagination->create_links();?>
                            </div>
                    </div>
		</div>
	</section>
</div>