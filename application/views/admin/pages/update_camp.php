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
                <div class="box-header with-border">
                  <h3 class="box-title">Update Camps</h3>
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
                                                                <option value="<?php echo $bdq->bloodbank_id;?>" <?php echo ($view->camp_bank_id == $bdq->bloodbank_id)?"selected=selected":"";?>><?php echo $bdq->bloodbank_name;?></option>
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
                                                                <input type="text" class="form-control pull-right" id="adatepicker" placeholder="Enter Camp Date ..." name="camp_date" value="<?php echo $view->camp_date;?>" readonly>
                                                        </div>
                                                        <div class="text-red"><?php echo form_error("camp_date");?></div>
                                                </div>
                                        </div> 
                                        <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Camp Message <span class="text-red">*</span></label>
                                                <textarea class="form-control" name="camp_msg" onkeyup="countChar(this)"><?php echo $view->camp_description;?></textarea>
                                                <span id="charNum">160</span>
                                                <div class="text-red"><?php echo form_error("camp_msg");?></div>
                                          </div>  
                                        </div> 
                                </div>	 
                                <div class="row">
                                        <div class="col-sm-2">
                                                <button type="submit" class="btn btn-sm btn-success" name="submit" value="Update">Update</button>
                                        </div>
                                </div>
                        </form>
                </div> 
        </div> 
    </section> 
</div>