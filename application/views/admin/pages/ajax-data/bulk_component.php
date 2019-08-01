<form method="post" action="<?php echo base_url()."admin/bulk_compon"?>">
    <div class="box-body">
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table-bordered table-striped table table-responsive">
                    <tr>
                        <th></th>
                        <th></th>
                        <th colspan="7">Blood Components <span class="text-red">*</span></th>
                        <th>-</th>
                    </tr>
                    <tr>
                        <th>Blood Bag Number</th>
                        <th>Blood Group</th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Whole Blood Cells">
                                WB
                            </div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Packed Cells">
                                PC
                            </div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content=" Frozen Plasma (Prepared for extraction of proteins like ImmunoGlobulins. Not meant for direct transfusion to patients)">
                                FP
                            </div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content=" Fresh Frozen Plasma ( Prepared within 6 hours from bleeding time and stored at -40C. Has a shelf life of 1year)">FFP</div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Platelet-rich plasma (Abbreviation: PRP) is blood plasma that has been enriched with platelets. As a concentrated source of autologous platelets, PRP contains (and releases through degranulation) several different growth factors and other cytokines that stimulate healing of bone and soft tissue">PRP</div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="A normal whole blood donation contains a small number of platelets which can be separated into a platelet concentrate. However, 4-8 times as many platelets can be derived from just one platelet donation. An adult patient typically requires 4 units of platelet concentrate for a single treatment episode">
                                Platelet Conc.
                            </div>
                        </th>
                        <th>
                            <div data-toggle="popover" data-placement="bottom" data-content="Cryoprecipitated Antihemophilic Factor (Cryo) is a portion of plasma rich in clotting factors, including Factor VIII and fibrinogen. It is prepared by freezing and then slowly thawing the frozen plasma.">Cryo</div>
                        </th> 
                        <th>Prepared <span class="text-red">*</span></th>
                    </tr>
                    <?php if(count($view) > 0){
                        foreach($view as $vw){
                            ?>
                            <tr>
                                <input type='hidden' name='bbdonation_id[]' value="<?php echo $vw->bbdonation_id;?>"/>
                                <td><?php echo $vw->blood_unit_num;?></td> 
                                <td><?php echo $vw->blood_group;?></td>  
                                <td>
                                    <input type="checkbox" <?php echo set_checkbox('pcells[]', 'WB');?>  class="flat-red"  name="pcells_<?php echo $vw->donation_id;?>[]" value="WB"/>
                                </td>
                                <td>
                                    <input type="checkbox"  class="flat-red"  <?php echo set_checkbox('pcells[]', 'PC');?> name="pcells<?php echo $vw->donation_id;?>[]" value="PC"/>
                                </td>
                                <td>
                                    <input type="checkbox"  class="flat-red" <?php echo set_checkbox('pcells[]', 'FP');?> name="pcells[]" value="FP"/>
                                </td>
                                <td>
                                    <?php if($vw->bag_type >= 2 ){ ?>
                                        <input type="checkbox"  class="flat-red" <?php echo set_checkbox('pcells[]', 'FFP');?> name="pcells[]" value="FFP"/>
                                    <?php } ?>
                                </td>
                                <?php if($vw->bag_type > 2){ ?>
                                <td>
                                    <input type="checkbox"  class="flat-red" <?php echo set_checkbox('pcells[]', 'PRP');?> name="pcells[]" value="PRP"/>
                                </td>
                                <td>
                                     <input type="checkbox"  class="flat-red" <?php echo set_checkbox('pcells[]', 'Platelet Concentrate');?> name="pcells[]" value="Platelet Concentrate"/>
                                </td>
                                <td>
                                    <input type="checkbox"  class="flat-red" <?php echo set_checkbox('pcells[]', 'Cryo');?>  name="pcells[]" value="Cryo"/>
                                </td>
                                <?php } else {?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <?php } ?>                                    
                                <td> 
                                    <input type="checkbox" class="flat-red" <?php echo set_checkbox('prepared', '1');?> name="prepared" value="1"  required=""/>
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