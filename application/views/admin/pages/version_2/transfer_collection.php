<div class="content-wrapper">
    <section class="content-header">
        <h1>Blood Bank <small>Updating the Details</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li class="active">Update</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Bank Details</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="" method="post" action="">
                <div class="box-body">
                    <div class="row"> 
                        <div class="col-md-12">
                            <?php $this->load->view("admin/layout/success_error");?>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Blood Bank Type <span class="text-red">*</span></label>
                                <div class="radio">
                                    <?php if(count($bloodbank_type) > 0){ 
                                        foreach ($bloodbank_type as $vt){
                                            ?> 
                                            <label>
                                                <input type="radio" name="blood_bank_type" value="<?php echo $vt->btype_id;?>" <?php echo set_radio("blood_bank_type",$vt->btype_id);?>  class="bloodbank_transfer" label-name="<?php echo $vt->btype_name;?>"/> <?php echo $vt->btype_name;?>
                                            </label>
                                            <?php
                                        }
                                    }
                                    ?> 
                                </div>
                                <div class="text-red"><?php echo form_error("blood_bank_type");?></div>
                            </div>
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date <span class="text-red">*</span></label> 
                                <input type="text" class="form-control daterange" placeholder="Date ..." name="datem" value="<?php echo set_value('datem');?>"/> 
                                <div class="text-red"><?php echo form_error("datem");?></div>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Banks <span class="text-red">*</span></label>
                                <select class="form-control transfer_bloodbank" name="transfer_bloodbank">
                                    <option value=""> -- Select Blood Bank -- </option>
                                </select>
                                <div class="text-red"><?php echo form_error("transfer_bloodbank");?></div>
                            </div>
                        </div> 
                        <div class="col-md-4">
                                <label>Screened/Unscreened <span class="text-red">*</span></label> 
                                <div>
                                    <input type="radio" class="screen" name="screen" value="1" <?php echo set_radio("screen",'1');?>/> Screened
                                    <input type="radio" class="screen" name="screen" value="2" <?php echo set_radio("screen",'2');?>/> Unscreened
                                </div>
                                <div class="text-red"><?php echo form_error("screen");?></div>
                        </div>  
                    </div> 
                    <div class="row hide_donors">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Donors <span class="text-red">*</span></label>
                                <select class="form-control transfer_donors" name="transfer_donors[]" multiple="">
                                    <option value=""> -- Select Donors -- </option>
                                </select>
                                <div class="text-red"><?php echo form_error("transfer_donors[]");?></div>
                            </div>
                        </div> 
                    </div>
                    <div class="row hide_bag_num"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Group <span class="text-red">*</span></label>
                                <select class="form-control transfer_group" name="transfer_group" onchange="transfer_donors()">
                                    <option value=""> -- Select Blood Group -- </option>
                                    <?php  
                                        if(count($blood_group) > 0 ){
                                            foreach ($blood_group as $bq){
                                                ?>
                                                <option value="<?php echo $bq->blood_group_name;?>" <?php echo set_select("transfer_group",$bq->blood_group_name);?>><?php echo $bq->blood_group_name;?></option>
                                                <?php 
                                            }
                                        } 
                                    ?>
                                </select>
                                <div class="text-red"><?php echo form_error("transfer_group");?></div>
                            </div>
                        </div> 
                        <div class='col-sm-4'>
                            <div class="form-group">
                                <label>Bag Numbers <span class="text-red">*</span></label>
                                <select class="form-control transfer_bag_num" name="transfer_bags[]" multiple="">
                                    <option value=""> -- Select Bag Number -- </option>
                                </select>
                                <div class="text-red"><?php echo form_error("transfer_bags[]");?></div>
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




