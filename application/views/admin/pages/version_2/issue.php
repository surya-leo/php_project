<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Donor Grouping Form 
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Donor Grouping</a></li>
            <li class="active">Grouping</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Donor Grouping Details</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div> 
            <form class="" method="post" action="">
            <!--<form class="" method="post" action="<?php echo base_url('admin/issue_submit/'.$this->uri->segment(3));?>">-->
                <!-- /.box-header -->
                <?php if(count($inv) > 0){ ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view("admin/layout/success_error");?>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-condensed table-striped">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Blood Unit Number</th>
                                    <th>Component Type</th>
                                    <th>Blood Group</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                </tr>
                                 <?php
                                    $j     =   1; 
                                    foreach($inv as $i){
                                    ?>
                                        <tr class="universal">
                                                <td><?php echo $j++;?></td>
                                                <td><?php echo $i->blood_unit_num;?></td>
                                                <td><?php echo $i->component_type;?></td>
                                                <td><?php echo $i->blood_group;?></td>
                                                <td><?php echo date("d-M-Y",strtotime($i->expiry_date));;?></td>
                                                <td><input type="checkbox" value="<?php echo $i->inventory_id;?>"  name="inventory_id[]" class="select_component" <?php echo set_checkbox("inventory_id[]",$i->inventory_id);?> /></td>
                                        </tr>
                                    <?php
                                    }
                                ?>
                            </table>
                            <div class="text-red"><?php echo form_error('inventory_id[]');?></div>
                        </div>
                        <div class="col-md-12"> 
                            <label>Selected</label>
                            <div class="selected_components">
                            </div>  
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-sm-6">
                            <label>Issue By <span class="text-red"></span></label>
                            <select class="form-control" name="staff_issue">
                                <option value="">Select Issue By</option>
                                <?php if(count($staff) > 0){
                                    foreach($staff as $dt){
                                        ?>                                          
                                <option value="<?= $dt->staff_id;?>" <?php echo set_select("staff_issue",$dt->staff_id)?>><?php echo $dt->first_name." ".$dt->last_name." ( ".$dt->staff_mobile_no.")";?></option> 
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <div class="text-red"><?php echo form_error("staff_issue");?></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Cross Matched By <span class="text-red"></span></label>
                            <select class="form-control" name="staff_forward">
                                <option value="">Select Cross Matched By</option>
                                <?php if(count($staff) > 0){
                                    foreach($staff as $dt){
                                        ?>                                          
                                <option value="<?= $dt->staff_id;?>" <?php echo set_select("staff_forward",$dt->staff_id)?>><?php echo $dt->first_name." ".$dt->last_name." ( ".$dt->staff_mobile_no.")";?></option> 
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <div class="text-red"><?php echo form_error("staff_forward");?></div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Enter Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>">
                                </div>
                                <div class="text-red"><?php echo form_error("donation_date");?></div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Time <span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="donation_time" value="<?php echo set_value('donation_time');?>"/>
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                    <div class="text-red"><?php echo form_error("donation_time");?></div>
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
                <?php } else {  ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Requested Blood Group : </label> <?php echo $view->brblood_group;?>
                        </div>
                        <div class="col-md-12 col-label">
                            <div class="">Blood Components </div>
                            <?php
                            if($view->whole_blood_units!=0){
                                    echo "<label class='label label-success'><b>WB: ".$view->whole_blood_units."</b></label>"; 
                            }
                            if($view->packed_cell_units!=0){
                                    echo "<label class='label label-info'><b>PC: ".$view->packed_cell_units."</b></label>";  
                            }
                            if($view->fp_units!=0){
                                    echo "<label class='label label-warning'><b>FP: ".$view->fp_units."</b></label>"; 
                            }
                            if($view->ffp_units!=0){
                                    echo "<label class='label label-primary'><b>FFP: ".$view->ffp_units."</b></label>"; 
                            }
                            if($view->prp_units!=0){
                                    echo "<label class='label bg-navy'><b>PRP : ".$view->prp_units."</b></label>"; 
                            }
                            if($view->platelet_concentrate_units!=0){
                                    echo "<label class='label bg-teal'><b>Platelet Concentrate: ".$view->platelet_concentrate_units."</b></label>"; 
                            }
                            if($view->cryoprecipitate_units!=0){
                                    echo "<label class='label bg-gray'><b>Cryo: ".$view->cryoprecipitate_units."</b></label>"; 
                            }
                            ?>
                        </div>
                        <div class="col-md-12"><br/>
                            Required components are not available in inventory!
                        </div>
                    </div>
                </div>
                <?php }?>
            </form>
        </div>
    </section>
</div>