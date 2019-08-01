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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Camps 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
        <li class="active">Camps</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-default">
                    <?php if($ct == '1'){?>
			<div class="box-header with-border">
			  <h3 class="box-title">Create Camps</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body">
				<form method="post" action="">
					<div class="row">
						<div class="col-md-12">
							<?php $this->load->view("admin/layout/success_error");?>
						</div>
						<?php if($this->session->userdata("login_parent") == "1"){?>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Blood Bank<span class="text-red">*</span></label>
							<select class="form-control" name="camp_bank"> 
								<option value="">-- Select Blood Bank Name --</option>
								<?php 
								if(count($camp_bank) > 0){ 
									foreach($camp_bank as $bdq){
									?>
									<option value="<?php echo $bdq->bloodbank_id;?>" <?php echo set_select("camp_bank",$bdq->bloodbank_id);?>><?php echo $bdq->bloodbank_name;?></option>
									<?php 
									}
								}?>
							</select>
							<div class="text-red"><?php echo form_error("camp_bank");?></div> 
						  </div>  
						</div>
						<?php } ?>						
						<div class="col-md-6">
							<div class="form-group">
								<label>Camp Date <span class="text-red">*</span></label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" id="adatepicker" placeholder="Enter Camp Date ..." name="camp_date" value="<?php echo set_value("camp_date");?>" readonly>
								</div>
								<div class="text-red"><?php echo form_error("camp_date");?></div>
							</div>
						</div> 
						<div class="col-md-6">
						  <div class="form-group">
							<label>Camp Message <span class="text-red">*</span></label>
							<textarea class="form-control" name="camp_msg" onkeyup="countChar(this)"><?php echo set_value("camp_msg");?></textarea>
							<span id="charNum">160</span>
							<div class="text-red"><?php echo form_error("camp_msg");?></div>
						  </div>  
						</div> 
					</div>	 
					<div class="row">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-sm btn-success" name="submit" value="Update">Create</button>
						</div>
					</div>
				</form>
			</div> 
                    <?php }?>
			<div class="box-header with-border">
			  <h3 class="box-title">View Camps</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			  </div>
			</div>
			<div class="box-body">
                             <div class="col-sm-12">
                                <div class="form-group pull-right"> 
                                    <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewCamps/')"/>
                                </div>
                            </div>
                            <div class="postList">
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
                            </div>
			</div>
		</div>
	</section>
</div>