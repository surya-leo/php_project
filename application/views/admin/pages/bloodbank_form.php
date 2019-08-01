<div class="content-wrapper">
    <section class="content-header">
        <h1>Blood Bank <small>Creating Blood Bank</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Bank</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Bank</h3>
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
                            <label>Blood Bank Type <span class="text-red">*</span></label>
                            <div class="radio">
                                <?php if(count($bloodbank_type) > 0){ 
                                    foreach ($bloodbank_type as $vt){
                                        ?> 
                                        <label>
                                            <input type="radio" name="blood_bank_type" value="<?php echo $vt->btype_id;?>" <?php echo set_radio("blood_bank_type",$vt->btype_id);?>  class="bloodbank_type" label-name="<?php echo $vt->btype_name;?>"/> <?php echo $vt->btype_name;?>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>
                                <input type="hidden" name="login_type" class="login_type"/>
                            </div>
                            <div class="text-red"><?php echo form_error("blood_bank_type");?></div>
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><span class="bname">Blood Bank</span> Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control bnamep" placeholder="Enter Blood Bank Name ..." name="blood_bank_name" value="<?php echo set_value("blood_bank_name");?>">
                                <div class="text-red"><?php echo form_error("blood_bank_name");?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><span class="bname">Blood Bank  </span> Address <span class="text-red">*</span></label>
                                <textarea class="form-control bnamea" rows="4" placeholder="Enter Blood Bank Address ..." name="blood_bank_addr"><?php echo set_value("blood_bank_addr");?></textarea>
                                <div class="text-red"><?php echo form_error("blood_bank_addr");?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
<!--                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label>State  <span class="text-red">*</span></label>
                                <select class="form-control clstate" name="staten">
                                    <option value=""> -- Select State -- </option>
                                        <?php
                                        if(count($state) > 0){
                                            foreach($state as $st){
                                                ?>
                                                    <option value="<?php echo $st->state_name;?>" text_val="<?php echo $st->state_id;?>" <?php echo set_select("staten",$st->state_name);?> > <?php echo $st->state_name;?></option>
                                                <?php
                                                }
                                        }
                                        ?>
                                </select>
                                <div class="text-red"><?php echo form_error("staten");?></div> 
                            </div>
                        </div>-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District <span class="text-red">*</span></label>
                                <input type="hidden" name="staten" value="Andhra Pradesh"/>
                                <select class="form-control district" name="district">
                                    <option value=""> -- Select District -- </option>
                                    <?php
                                        if(count($district) > 0){
                                            foreach($district as $st){
                                                ?>
                                                    <option value="<?php echo $st->district_name;?>" text_val="<?php echo $st->district_id;?>" <?php echo set_select("district",$st->district_name);?> > <?php echo $st->district_name;?></option>
                                                <?php
                                                }
                                        }
                                    ?>
                                </select>
                                <div class="text-red"><?php echo form_error("district");?></div>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>City <span class="text-red">*</span></label>
                                <select class="form-control city" name="city">
                                    <option value=""> -- Select City -- </option>
                                </select>
                                <div class="text-red"><?php echo form_error("city");?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pincode <span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Pincode ..." name="pincode" value="<?php echo set_value('pincode');?>">
                                <div class="text-red"><?php echo form_error("pincode");?></div>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Email Id <span class="text-red">*</span></label>
                                <input type="email" class="form-control" placeholder="Enter Email Id ..." name="email" value="<?php echo set_value("email");?>">
                                <div class="text-red"><?php echo form_error("email");?></div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category <span class="text-red">*</span></label>
                                <select class="form-control select2" data-placeholder="Select a Category" style="width: 100%;" name="category">
                                    <option value="">Select Category</option>
                                    <option value="Charity" <?php echo set_select("category","Charity");?>>Charity</option>
                                    <option value="Government" <?php echo set_select("category","Government");?>>Government</option>
                                    <option value="Private" <?php echo set_select("category","Private");?>>Private</option>
                                </select>
                                <div class="text-red"><?php echo form_error("category");?></div>
                            </div>
                        </div>
                    </div>   
                    <div class="row"> 
                        <div class="col-md-4">                            
                            <div class="form-group">
                                  <label>Blood Bag Code </label>
                                  <input type="text" class="form-control" placeholder="Enter Blood Bag Code ..." name="blood_bank_code" value="<?php echo set_value("blood_bank_code");?>">
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact No. </label>
                                <input type="text" class="form-control" placeholder="Enter Contact No. ..." name="contact_no" value="<?php echo set_value("contact_no");?>"> 
                            </div>
                        </div>  
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Mobile No </label>
                                <input type="text" class="form-control input_num" placeholder="Enter Mobile No ..." name="mobile_no" value="<?php echo set_value("mobile_no");?>" minlength="10" maxlength="10"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" class="form-control" placeholder="Enter Website ..." name="website" value="<?php echo set_value("website");?>">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Component Available</label>
                                <select class="form-control select2" style="width: 100%;" name="blood_component">
                                    <option value=""> -- Select Blood Component -- </option>
                                    <option value="YES" <?php echo set_select("blood_component","YES");?>>Yes</option>
                                    <option value="NO" <?php echo set_select("blood_component","NO");?>>No</option>
                                </select> 
                          </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Fax No</label>
                                <input type="text" class="form-control" placeholder="Enter Fax No ..." name="fax_no" value="<?php echo set_value("fax_no");?>">
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-4 hide_bctv">
                            <div class="form-group">
                                  <label>Latitude </label>
                                  <input type="text" class="form-control input_geo" placeholder="Enter Latitude ..." name="latitude" value="<?php echo set_value("latitude");?>">
                            </div> 
                        </div>
                        <div class="col-md-4 hide_bctv">                        
                            <div class="form-group"> 
                                <label>Longitude</label>
                                <input type="text" class="form-control input_geo" placeholder="Enter Longitude ..." name="longitude" value="<?php echo set_value("longitude");?>">
                            </div>
                        </div>
                        <div class="col-md-4 hide_banks">                        
                            <div class="form-group"> 
                                <label>Assign Blood Banks <span class="text-red">*</span></label>
                                <select class="form-control" name="assign_bloodbank[]" multiple=""> 
                                    <option value="">-- Select Blood Bank --</option>
                                        <?php 
                                        if(count($blood_banks) > 0){ 
                                            foreach($blood_banks as $bds){
                                                ?>
                                                <option value="<?php echo $bds->bloodbank_id;?>" <?php echo set_select("assign_bloodbank[]",$bds->bloodbank_id);?>><?php echo $bds->bloodbank_name;?></option>
                                                <?php 
                                                }
                                        }?>
                                </select> 
                                <div class="text-red"><?php echo form_error("assign_bloodbank[]");?></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-sm btn-success" name="submit" value="Create">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>




