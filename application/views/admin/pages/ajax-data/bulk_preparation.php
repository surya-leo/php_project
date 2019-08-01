<form method="post" action="<?php echo base_url()."admin/bulk_group"?>">
    <div class="box-body">
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table-bordered table-striped table table-responsive">
                    <tr>
                        <th>Blood Unit Number</th>
                        <th>Blood Group</th>
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
                    <?php 
                    if(count($view) > 0){
                        foreach ($view as $vw){
                            ?>
                            <tr>
                                <input type='hidden' name='bbdonation_id[]' value="<?php echo $vw->bbdonation_id;?>"/>
                                <td><input type="text" class="form-control" placeholder="Enter Blood Bag Number..." name="blood_unit_num_<?php echo $vw->bbdonation_id;?>" value="<?php echo $vw->blood_unit_num;?>"></td>
                                <td><input type="text" class="form-control blood_group" placeholder="Enter Blood Group..." name="blood_group_<?php echo $vw->bbdonation_id;?>" value="<?php echo $vw->blood_group;?>"></td>
                                <td><input type='text' class="form-control" name='anti_a_<?php echo $vw->bbdonation_id;?>' id='anti_a'  value="<?php echo $vw->anti_a;?>"/></td>
                                <td><input type='text' class="form-control" name='anti_b_<?php echo $vw->bbdonation_id;?>' id='anti_b' value="<?php echo $vw->anti_b;?>"/></td>
                                <td><input type='text' class="form-control" name='anti_ab_<?php echo $vw->bbdonation_id;?>' id='anti_ab' value="<?php echo $vw->anti_ab;?>"/></td>
                                <td><input type='text' class="form-control" name='anti_d_<?php echo $vw->bbdonation_id;?>' id='anti_d' value="<?php echo $vw->anti_d;?>"/></td>
                                <td><input type='text' class="form-control" name='anti_ac_<?php echo $vw->bbdonation_id;?>' id='anti_ac' value="<?php echo $vw->a_cells;?>"/></td>
                                <td><input type='text' class="form-control" name='anti_bc_<?php echo $vw->bbdonation_id;?>' id='anti_bc' value="<?php echo $vw->b_cells;?>"/></td>
                                <td><input type='text' class="form-control" name='anti_oc_<?php echo $vw->bbdonation_id;?>' id='anti_oc' value="<?php echo $vw->o_cells;?>"/></td>
                                <td><input type='text' class="form-control" name='anti_du_<?php echo $vw->bbdonation_id;?>' id='anti_du' value="<?php echo $vw->du;?>"/></td>
                                <td>
                                    <input type="checkbox"  class="flat-red" required="" name="under_collection" value="1" <?php echo set_checkbox("under_collection","1");?>/>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <div class="text-red"><?php echo form_error('under_collection');?></div>
            </div> 
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Forward Done <span class="text-red">*</span></label>
                    <select class="form-control" name="staff_forward" required="">
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
                    <select class="form-control" name="staff_reverse" required="">
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
                        <input type="text" class="form-control pull-right"  autocomplete="off" id="datepicker" placeholder="Enter Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>" required="">
                    </div>
                    <div class="text-red"><?php echo form_error("donation_date");?></div>
                </div> 
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-sm btn-success" name="submit" value="submit">Save</button>
            </div>
        </div>
    </div>
</form>
<script> 
    $('#datepicker').datepicker({
            autoclose: true,
            endDate: '+0d',
            format:"yyyy-mm-dd" 
    });
</script>