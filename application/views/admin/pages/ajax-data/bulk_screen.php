<form method="post" action="<?php echo base_url()."admin/bulk_screening"?>">
    <div class="box-body">
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table-bordered table-striped table table-responsive">
                    <tr> 
                        <th>Blood Unit Number</th>
                        <th>Blood Group</th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Human Immunodeficiency Virus">
                                HIV
                            </div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Hepatitis B Surface Antigen">HBSAG</div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Hepatitis C Virus">HCV</div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Venereal Disease Research Laboratory">
                                VDRL
                            </div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Metabolic panel">MP</div>
                        </th> 
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Irregular Antibody Screening">Irregular AB</div>
                        </th> 
                        <th>Tested <span class="text-red">*</span></th>
                    </tr>
                    <?php if(count($view) > 0){
                        foreach($view as $vw){
                            ?>  
                                <tr> 
                                    <input type='hidden' name='bbdonation_id[]' value="<?php echo $vw->bbdonation_id;?>"/>
                                    <td><?php echo $vw->blood_unit_num;?></td> 
                                    <td><?php echo $vw->blood_group;?></td>  
                                    <td>
                                        <input type="checkbox"  class="flat-red positive" name="test_hiv_<?php echo $vw->bbdonation_id;?>" value="1"/>
                                    </td>
                                    <td> 
                                        <input type="checkbox"  class="flat-red positive" name="test_hbsag_<?php echo $vw->bbdonation_id;?>" value="1"/> 
                                    </td> 
                                    <td>
                                        <input type="checkbox"  class="flat-red positive"  name="test_hcv_<?php echo $vw->bbdonation_id;?>" value="1"/>
                                    </td>
                                    <td>
                                         <input type="checkbox"  class="flat-red positive" name="test_vdrl_<?php echo $vw->bbdonation_id;?>" value="1"/>
                                    </td>
                                    <td>
                                        <input type="checkbox"  class="flat-red positive" name="test_mp_<?php echo $vw->bbdonation_id;?>" value="1"/>
                                    </td>                                    
                                    <td>
                                        <input type="checkbox"  class="flat-red positive" name="test_irregular_ab_<?php echo $vw->bbdonation_id;?>" value="1"/>
                                    </td>                                    
                                    <td>
                                        <input type="checkbox" required="" class="flat-red" name="tested" value="1" <?php echo set_checkbox("tested","1");?> required=""/>
                                    </td>
                                </tr> 
                            <?php
                        }
                    }
                    ?>
                </table>
                <div class="text-red"><?php echo form_error('prepared');?></div>
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