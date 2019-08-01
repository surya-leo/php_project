<?php 
$uri    =   $this->uri->segment("3");
$yu     =   "update-".$button;
$up     =   $this->session->userdata($yu);       
$ct     =   '0';
if($up == '1'){
        $ct     =   '1';
}
?>
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