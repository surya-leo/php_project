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
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view("admin/layout/success_error");?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blood Bag Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Blood Bag Number..." name="blood_unit_num" value="<?php echo $view->blood_unit_num;?>">
                                <div class="text-red"><?php echo form_error("blood_unit_num");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blood Group<span class="text-red">*</span></label>
                                <input type="text" class="form-control blood_group" placeholder="Enter Blood Group..." name="blood_group" value="<?php echo $view->blood_group;?>">
                                <div class="text-red"><?php echo form_error("blood_group");?></div>
                            </div>  
                        </div>
                        <div class="col-md-12">
                            <table class="table-bordered table-striped table table-responsive">
                                <tr>
                                    <th>Anti A</th>
                                    <th>Anti B</th>
                                    <th>Anti AB</th>
                                    <th>Anti D</th>
                                    <th>A Cells</th>
                                    <th>B Cells</th>
                                    <th>O Cells</th>
                                    <th>Du</th>
                                    <th>Grouped <span class="text-red">*</span></th>
                                </tr>
                                <tr>
                                    <td><input type='text' class="form-control" name='anti_a' id='anti_a'/></td>
                                    <td><input type='text' class="form-control" name='anti_b' id='anti_b'/></td>
                                    <td><input type='text' class="form-control" name='anti_ab' id='anti_ab'/></td>
                                    <td><input type='text' class="form-control" name='anti_d' id='anti_d'/></td>
                                    <td><input type='text' class="form-control" name='anti_ac' id='anti_ac'/></td>
                                    <td><input type='text' class="form-control" name='anti_bc' id='anti_bc'/></td>
                                    <td><input type='text' class="form-control" name='anti_oc' id='anti_oc'/></td>
                                    <td><input type='text' class="form-control" name='anti_du' id='anti_du'/></td>
                                    <td>
                                        <input type="checkbox"  class="flat-red" required="" name="under_collection" value="1" <?php echo set_checkbox("under_collection","1");?>/>
                                    </td>
                                </tr>
                            </table>
                            <div class="text-red"><?php echo form_error('under_collection');?></div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Forward Done <span class="text-red">*</span></label>
                                <select class="form-control" name="staff_forward">
                                    <option value="">Select Forward Done</option>
                                    <?php if(count($staff) > 0){
                                        foreach($staff as $dt){
                                            ?>                                          
                                    <option value="<?= $dt->staff_login_id;?>" <?php echo set_select("staff_forward",$dt->staff_login_id)?>><?php echo $dt->first_name." ".$dt->last_name." ( ".$dt->staff_mobile_no.")";?></option> 
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="text-red"><?php echo form_error("staff_forward");?></div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Reverse By<span class="text-red">*</span></label>
                                <select class="form-control" name="staff_reverse">
                                    <option value="">Select Reverse By</option>
                                    <?php if(count($staff) > 0){
                                        foreach($staff as $dt){
                                            ?>                                          
                                    <option value="<?= $dt->staff_login_id;?>" <?php echo set_select("staff_reverse",$dt->staff_login_id)?>><?php echo $dt->first_name." ".$dt->last_name." ( ".$dt->staff_mobile_no.")";?></option> 
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="text-red"><?php echo form_error("staff_reverse");?></div>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right"  autocomplete="off" id="datepicker" placeholder="Enter Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>">
                                </div>
                                <div class="text-red"><?php echo form_error("donation_date");?></div>
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