<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Donor Medical Checkup Form 
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Donor Details</a></li>
            <li class="active">Medical Checkup</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Donor  Medical Checkup Details</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="" method="post" action="">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                                <?php $this->load->view("admin/layout/success_error");?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Weight (Kgs)<span class="text-red">*</span></label>
                                <input type="text" class="form-control input_geo" placeholder="Enter Weight..." name="weight" value="<?php echo set_value("weight");?>">
                                <div class="text-red"><?php echo form_error("weight");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pulse (min)<span class="text-red">*</span></label>
                                <input type="text" class="form-control input_num" placeholder="Enter Pulse..." name="pulse" value="<?php echo set_value("pulse");?>">
                                <div class="text-red"><?php echo form_error("pulse");?></div>
                            </div>  
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>HB (gm/dL)<span class="text-red">*</span></label>
                                <input type="text" class="form-control input_geo" placeholder="Enter HB..." name="hb" value="<?php echo set_value("hb");?>">
                                <div class="text-red"><?php echo form_error("hb");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>BP<span class="text-red">*</span></label>
                                <div class="display-block">
                                    <input type="text" class="form-control input_num form-control-50" placeholder="Enter Pulse..." name="sbp" value="<?php echo set_value("sbp");?>">
                                    /<input type="text" class="form-control input_num form-control-50" placeholder="Enter DBP..." name="dbp" value="75">
                                    <div class="text-red"><?php echo form_error("sbp").form_error("dbp");?></div>
                                </div>  
                            </div>  
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Temperature (Fahrenheit)<span class="text-red">*</span></label>
                                <input type="text" class="form-control input_geo" placeholder="Enter Temperature..." name="temperature" value="<?php echo set_value("temperature");?>">
                                <div class="text-red"><?php echo form_error("temperature");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Donation Time <span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="donation_time" value="<?php echo set_value('donation_time');?>"/>
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Donation Type <span class="text-red">*</span></label>
                                <select class="form-control donation_type" name="donation_type">
                                    <option value="">Select Donation Type</option>
                                    <option value="1" <?php echo set_select("donation_type","1")?>> Replacement</option>
                                    <option value="2" <?php echo set_select("donation_type","2")?>> Voluntary</option>
                                </select>
                                <div class="text-red"><?php echo form_error("donation_type");?></div>
                            </div>  
                        </div>
                        <div class="col-md-12"></div>
                        <div class="patient_details">
                            <div class="col-md-6">
                                <label>Patient Name <span class="text-red">*</span></label>
                                <input class="form-control input_char" name="patient_name" placeholder="Patient Name" value="<?php echo set_value("patient_name");?>" type="text"/>                                
                                <div class="text-red"><?php echo form_error("patient_name");?></div>
                            </div>
                            <div class="col-md-6">
                                <label>Blood Group <span class="text-red">*</span></label>
                                <select class="form-control" name="blood_group"> 
                                    <option value="">-- Select Blood Group --</option>
                                        <?php 
                                        if(count($blood_groups) > 0){ 
                                            foreach($blood_groups as $bd){
                                                ?>
                                                <option value="<?php echo $bd->blood_group_name;?>" <?php echo set_select("blood_group",$bd->blood_group_name);?>><?php echo $bd->blood_group_name;?></option>
                                                <?php 
                                                }
                                        }?>
                                </select>
                                <div class="text-red"><?php echo form_error("blood_group");?></div>
                            </div>
                        </div>                             
                    </div> 
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-sm btn-success" name="submit" value="Create">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>