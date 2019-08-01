<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Donor Screening Form 
            <small>Screening the Blood</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Donor Screening</a></li>
            <li class="active">Screening</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Donor Screening</h3>
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
                                        <div data-toggle="popover" data-placement="bottom" data-content="Malaria parasite">MP</div>
                                    </th> 
                                    <th>
                                        <div data-toggle="popover" data-placement="bottom" data-content="Irregular Antibody Screening">Irregular AB</div>
                                    </th> 
                                    <th>Tested <span class="text-red">*</span></th>
                                </tr>
                                <tr> 
                                    <td>
                                        <input type="checkbox"  class="flat-red positive" name="test_hiv" value="1"/>
                                    </td>
                                    <td> 
                                        <input type="checkbox"  class="flat-red positive" name="test_hbsag" value="1"/> 
                                    </td> 
                                    <td>
                                        <input type="checkbox"  class="flat-red positive"  name="test_hcv" value="1"/>
                                    </td>
                                    <td>
                                         <input type="checkbox"  class="flat-red positive" name="test_vdrl" value="1"/>
                                    </td>
                                    <td>
                                        <input type="checkbox"  class="flat-red positive" name="test_mp" value="1"/>
                                    </td>                                    
                                    <td>
                                        <input type="checkbox"  class="flat-red positive" name="test_irregular_ab" value="1"/>
                                    </td>                                    
                                    <td>
                                        <input type="checkbox" required="" class="flat-red" name="tested" value="1" <?php echo set_checkbox("tested","1");?>/>
                                    </td>
                                </tr>
                            </table>
                             <div class="text-red"><?php echo form_error("tested");?></div>
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
                                <label>Screened Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" autocomplete="off" id="datepicker" placeholder="Enter Screened Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>">
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