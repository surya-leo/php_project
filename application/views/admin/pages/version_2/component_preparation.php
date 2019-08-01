<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Donor Component Preparation Form 
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Donor Component Preparation</a></li>
            <li class="active">Component Preparation</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Donor Component Preparation</h3>
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
                                <input type="text" class="form-control" placeholder="Enter Blood Bag Number..." name="blood_unit_num" value="<?php echo $view->blood_unit_num;?>"/>
                                <div class="text-red"><?php echo form_error("blood_unit_num");?></div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blood Group<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Blood Group..." name="blood_group" value="<?php echo $view->blood_group;?>"/>
                                <div class="text-red"><?php echo form_error("blood_group");?></div>
                            </div>  
                        </div>
                        <div class="col-md-12">
                            <table class="table-bordered table-striped table table-responsive">
                                <tr>
                                    <th colspan="7">Blood Components <span class="text-red">*</span></th>
                                    <th>-</th>
                                </tr>
                                <tr>
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
                                <tr>
                                    <td>
                                        <input type="checkbox" <?php echo set_checkbox('pcells[]', 'WB');?>  class="flat-red"  name="pcells[]" value="WB"/>
                                    </td>
                                    <td>
                                        <input type="checkbox"  class="flat-red"  <?php echo set_checkbox('pcells[]', 'PC');?> name="pcells[]" value="PC"/>
                                    </td>
                                    <td>
                                        <input type="checkbox"  class="flat-red" <?php echo set_checkbox('pcells[]', 'FP');?> name="pcells[]" value="FP"/>
                                    </td>
                                    <td>
                                        <?php if($view->bag_type >= 2 ){ ?>
                                            <input type="checkbox"  class="flat-red" <?php echo set_checkbox('pcells[]', 'FFP');?> name="pcells[]" value="FFP"/>
                                        <?php } ?>
                                    </td>
                                    <?php if($view->bag_type > 2){ ?>
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
                                        <input type="checkbox" class="flat-red" <?php echo set_checkbox('prepared', '1');?> name="prepared" value="1"  />
                                    </td>
                                </tr>
                            </table>
                            <div class="text-red"><?php echo form_error('pcells[]');?></div>
                            <div class="text-red"><?php echo form_error('prepared');?></div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Done By <span class="text-red">*</span></label>
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
                                <label>Preparation Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" autocomplete="off" id="datepicker" placeholder="Enter Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>"/>
                                </div>
                                <div class="text-red"><?php echo form_error("donation_date");?></div>
                            </div> 
                        </div>
                        
                        <div class="col-sm-12"></div>
                        <div class="col-sm-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Preparation Time <span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker" autocomplete="off" name="donation_time" value="<?php echo set_value('donation_time');?>"/>
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
                            <button type="submit" class="btn btn-sm btn-success" name="submit" value="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>