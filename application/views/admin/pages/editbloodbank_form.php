<?php 
$uri    =   $this->uri->segment(3);
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $uript;?> <small>Updating the Details</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url("admin/view-".$button."/".$uri);?>"><?php echo $uript;?></a></li>
            <li class="active">Update</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $uript;?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="" method="post" action="" enctype="multipart/form-data">
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
                                            <input type="radio" name="blood_bank_type" value="<?php echo $vt->btype_id;?>" <?php echo ($view->blood_bank_type == $vt->btype_id)?"checked=checked":"";?>  class="bloodbank_type" label-name="<?php echo $vt->btype_name;?>"/> <?php echo $vt->btype_name;?>
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
                                <input type="text" class="form-control bnamep" placeholder="Enter Blood Bank Name ..." name="blood_bank_name" value="<?php echo $view->bloodbank_name;?>">
                                <div class="text-red"><?php echo form_error("blood_bank_name");?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><span class="bname">Blood Bank  </span> Address <span class="text-red">*</span></label>
                                <textarea class="form-control bnamea" rows="4" placeholder="Enter Blood Bank Address ..." name="blood_bank_addr"><?php echo $view->address;?></textarea>
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
                                                    <option value="<?php echo trim($st->state_name);?>" text_val="<?php echo $st->state_id;?>" <?php echo ($view->state == trim($st->state_name))?"selected=selected":"";?> > <?php echo trim($st->state_name);?></option>
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
                                            foreach($district as $scdt){
                                                    ?>
                                                    <option value="<?php echo trim($scdt->district_name);?>" text_val="<?php echo $scdt->district_id;?>" <?php echo ($view->district == trim($scdt->district_name))?"selected=selected":"";?> > <?php echo trim($scdt->district_name);?></option>
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
                                <select class="form-control" name="city">
                                    <option value=""> -- Select City -- </option>
                                    <?php
                                        if(count($city) > 0){
                                            foreach($city as $sct){
                                                    ?>
                                                    <option value="<?php echo trim($sct->city_name);?>" text_val="<?php echo $sct->city_id;?>" <?php echo ($view->city == trim($sct->city_name))?"selected=selected":"";?> > <?php echo trim($sct->city_name);?></option>
                                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="text-red"><?php echo form_error("city");?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pincode <span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Pincode ..." name="pincode" value="<?php echo $view->pincode;?>">
                                <div class="text-red"><?php echo form_error("pincode");?></div>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Email Id <span class="text-red">*</span></label>
                                <input type="email" class="form-control" placeholder="Enter Email Id ..." name="email" value="<?php echo $view->email_id;?>">
                                <div class="text-red"><?php echo form_error("email");?></div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category <span class="text-red">*</span></label>
                                <select class="form-control select2" data-placeholder="Select a Category" style="width: 100%;" name="category">
                                    <option value="">Select Category</option>
                                    <option value="Charity" <?php echo ($view->category == "Charity")?"selected=selected":"";?>>Charity</option>
                                    <option value="Government" <?php echo ( $view->category == "Government")?"selected=selected":"";?>>Government</option>
                                    <option value="Private" <?php echo ($view->category == "Private")?"selected=selected":"";?>>Private</option>
                                </select>
                                <div class="text-red"><?php echo form_error("category");?></div>
                            </div>
                        </div>
                    </div>   
                    <div class="row"> 
                        <div class="col-md-4">                            
                            <div class="form-group">
                                  <label>Blood Bag Code </label>
                                  <input type="text" class="form-control" placeholder="Enter Blood Bag Code ..." name="blood_bank_code" value="<?php echo $view->blood_bank_code;?>">
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact No. </label>
                                <input type="text" class="form-control" placeholder="Enter Contact No. ..." name="contact_no" value="<?php echo $view->contact_no;?>"> 
                            </div>
                        </div>  
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Mobile No </label>
                                <input type="text" class="form-control input_num" placeholder="Enter Mobile No ..." name="mobile_no" value="<?php echo $view->bbmobile;?>" minlength="10" maxlength="10"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" class="form-control" placeholder="Enter Website ..." name="website" value="<?php echo $view->bloodbank_url;?>">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Component Available</label>
                                <select class="form-control select2" style="width: 100%;" name="blood_component">
                                    <option value=""> -- Select Blood Component -- </option>
                                    <option value="YES" <?php echo ($view->blood_component == "YES")?"selected=selected":"";;?>>Yes</option>
                                    <option value="NO" <?php echo ($view->blood_component == "NO")?"selected=selected":"";;?>>No</option>                                </select> 
                          </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Fax No</label>
                                <input type="text" class="form-control" placeholder="Enter Fax No ..." name="fax_no" value="<?php echo $view->fax_no;?>">
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-4 ">
                            <div class="form-group">
                                  <label>Latitude </label>
                                  <input type="text" class="form-control input_geo" placeholder="Enter Latitude ..." name="latitude" value="<?php echo $view->lattitude;?>">
                            </div> 
                        </div>
                        <div class="col-md-4 ">                        
                            <div class="form-group"> 
                                <label>Longitude</label>
                                <input type="text" class="form-control input_geo" placeholder="Enter Longitude ..." name="longitude" value="<?php echo $view->longitude;?>">
                            </div>
                        </div>
                         <div class="col-md-4 hide_banks">                        
                            <div class="form-group"> 
                                <label>Assign Blood Banks <span class="text-red">*</span></label>
                                <?php $ves  =   explode(",",$view->assign_bloodbanks);?>
                                <select class="form-control" name="assign_bloodbank[]" multiple=""> 
                                    <option value="">-- Select Blood Bank --</option>
                                        <?php 
                                        if(count($blood_banks) > 0){ 
                                            foreach($blood_banks as $bds){
                                                ?>
                                                <option value="<?php echo $bds->bloodbank_id;?>" <?php echo in_array($bds->bloodbank_id,$ves)?"selected='selected'":"";?>><?php echo $bds->bloodbank_name;?></option>
                                                <?php 
                                                }
                                        }?>
                                </select> 
                                <div class="text-red"><?php echo form_error("assign_bloodbank[]");?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row"> 
                        <div class="col-md-4">                        
                            <div class="form-group"> 
                                <label>Upload License</label>
                                <input type="file" class="form-control" name="file_upload" accept="application/pdf">
                                <div class='text-red'>Note: Please upload only PDF file types.<br/>
                                Max Size to upload - 2 MB</div>
                                <?php 
                                $imgp   =   "";
                                $imp    =  'resources/jdadmin_assets/js_uploads/'.$view->bb_licensed;  
                                if (file_exists($imp)) {
                                    $imgp = $imp;
                                }
                                if($imgp != ''){ ?> 
                                <a href="/<?php echo $imgp;?>" target="_blank" class="btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> View </a>
                                <?php } ?>
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