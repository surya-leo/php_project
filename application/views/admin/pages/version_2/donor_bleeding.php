<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Donor Bleeding Form 
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Donor Details</a></li>
            <li class="active">Bleeding</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Donor Bleeding Details</h3>
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
                                <label>Blood Bag Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Blood Bag Number..." name="blood_unit_num" value="<?php echo $bag_number;?>">
                                <div class="text-red"><?php echo form_error("blood_unit_num");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Segment<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Segment..." name="segment_num" value="<?php echo set_value("segment_num");?>">
                                <div class="text-red"><?php echo form_error("segment_num");?></div>
                            </div>  
                        </div>
                        <div class="col-md-12"></div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bag Type <span class="text-red">*</span></label>
                                <select class="form-control" name="bag_type">
                                    <option value="">Select Bag Type</option>
                                    <option value="1" <?php echo set_select("bag_type","1")?>> Single</option>
                                    <option value="2" <?php echo set_select("bag_type","2")?>> Double</option>
                                    <option value="3" <?php echo set_select("bag_type","3")?>> Triple</option>
                                    <option value="4" <?php echo set_select("bag_type","4")?>> Quadruple</option>
                                    <option value="5" <?php echo set_select("bag_type","5")?>> Quadruple - Sagm</option>
                                </select>
                                <div class="text-red"><?php echo form_error("bag_type");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Volume <span class="text-red">*</span></label>
                                <select class="form-control" name="volume">
                                    <option value="">Select Volume</option>
                                    <option value="350" <?php echo set_select("volume","350")?>> 350 ml</option>
                                    <option value="450" <?php echo set_select("volume","450")?>> 450 ml</option> 
                                </select>
                                <div class="text-red"><?php echo form_error("volume");?></div>
                            </div>  
                        </div>
                        <div class="col-md-12"></div>      
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Staff <span class="text-red">*</span></label>
                                <select class="form-control" name="staff">
                                    <option value="">Select Staff</option>
                                    <?php if(count($staff) > 0){
                                        foreach($staff as $dt){
                                            ?>                                          
                                    <option value="<?= $dt->staff_id;?>" <?php echo set_select("staff",$dt->staff_id)?>><?php echo $dt->first_name." ".$dt->last_name." ( ".$dt->staff_mobile_no.")";?></option> 
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="text-red"><?php echo form_error("volume");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Under Collection </label> 
                                <div class="checkbox">
                                <input type="checkbox"  class="flat-red" name="under_collection" value="1" <?php echo set_checkbox("under_collection","1");?>/>
                                </div>
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