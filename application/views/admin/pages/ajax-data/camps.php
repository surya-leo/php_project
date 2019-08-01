<?php 
$ct     =      $this->session->userdata("create-camp");
$ut     =      $this->session->userdata("update-camp");
$up     =      $this->session->userdata("send-sms-camp");
$ap     =      $this->session->userdata("active-deactive-camp");
$pt     =       "0";
if($up == '1' || $ap == '1' || $ut == '1'){
    $pt     =   '1';
}
?>
<table  class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>S.No.</th> 
					  <?php if($this->session->userdata("login_parent") == "1") {?>
					  <th>Blood Bank Name</th> 
					  <?php } ?>
					  <th>Camp Date</th> 
					  <th>Camp Message</th> 
                                          <?php if($pt == '1'){ ?>
					  <th>Action</th>
                                          <?php } ?>
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						$j = 1;
						foreach($view as $vw){
						?>
						<tr>
						  <td><?php echo $j++;?></td> 
						  <?php if($this->session->userdata("login_parent") == "1") {?>
						  <td><?php echo $vw->bloodbank_name;?></td> 
						  <?php } ?>
						  <td><?php echo $vw->camp_date;?></td> 
						  <td><?php echo $vw->camp_description;?></td> 
                                                    <?php if($pt == '1'){ ?>
                                                    <td width="10%">
                                                        <?php if($ut == '1'){ ?>
                                                        <a href="<?php echo base_url("admin/update_camp/".$vw->camp_id);?>" title="Update Camp" class="btn-bitbucket btn-sm"><i class="fa fa-edit"></i> Edit </a><br/><br/>
                                                      <?php }  if($up == '1'){ ?>
                                                        <a href="<?php echo base_url("admin/bulk_sms/".$vw->camp_id);?>" title="Send SMS" class="btn-success btn-sm"><i class="fa fa-mobile"></i> Send SMS</a>
                                                        <?php } if($ap == '1'){ ?>
                                                        <br/><br/>
                                                        <?php if($vw->camp_activate == "0"){ ?>
                                                        <a href="javascript:void(0);" title="Activate" class="btn-primary btn-sm stactive" camp_id="<?php echo $vw->camp_id;?>" sta="1"><i class="fa fa-check"></i> Active</a>
                                                        <?php } else { ?>							
                                                        <a href="javascript:void(0);" title="Deactivate" class="btn-danger btn-sm stactive" camp_id="<?php echo $vw->camp_id;?>" sta="0"><i class="fa fa-times-circle-o"></i> Deactive</a>
                                                    <?php }
                                                        }?>
                                                    </td>
                                                    <?php }?>
						</tr> 
						<?php
						} 
					}
					?>
                </tbody>
                <tfoot>
					<tr>
					   <th>S.No.</th> 
					  <?php if($this->session->userdata("login_parent") == "1") {?>
					  <th>Blood Bank Name</th> 
					  <?php } ?>
					  <th>Camp Date</th> 
					  <th>Camp Message</th> 
                                          <?php if($pt == '1'){ ?>
					  <th>Action</th>
                                          <?php } ?>
					</tr>
                </tfoot>
              </table>
                                <?php echo $this->ajax_pagination->create_links();?>