<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Out Blood Collection
            <small>Viewing Out Blood Collection</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Reports</a></li>
            <li class="active">Out Blood Collection</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Out Blood Collection Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">  
                <form action="<?php echo base_url("admin/export_excel/0");?>" method="post">
               <?php if($this->session->userdata("login_type") != '5utype') {?>
			   <?php if($this->session->userdata("login_type") != '3utype') {?>
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <label>District</label>
                        <select class="form-control district report_district"  onchange="search_summary('<?php echo base_url(); ?>admin/viewOutBloodCollection/')">
                            <option value="">Select District</option>
                            <?php 
                            if(count($district) > 0){ 
                                foreach ($district as $dis){
                                        ?>
                                        <option value="<?php echo $dis->district_name;?>" text_val="<?php echo $dis->district_id;?>"><?php echo $dis->district_name;?></option>
                                        <?php
                                }
                            }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <label>City</label>
                        <select class="form-control city report_city" onchange="search_summary('<?php echo base_url(); ?>admin/viewOutBloodCollection/')">
                            <option value="">Select City</option> 
                        </select>
                    </div>
                </div> 
			   <?php } ?>
                <div class="col-sm-4">
                    <label>Blood Bank</label> 
                    <select class="form-control searbloodbank_id" name="bloodbank_id" onchange="search_summary('<?php echo base_url(); ?>admin/viewOutBloodCollection/')">
                        <option value="">Select Blood Bank</option>
                        <option value="All">All Blood Bank</option>
                        <?php 
                        if(count($blood_bank) > 0){
                            foreach ($blood_bank as $bb){
                                ?>
                                <option value="<?php echo $bb->bloodbank_id;?>"><?php echo $bb->bloodbank_name;?></option>
                                <?php
                            }
                        }
                        ?>

                    </select> 
                </div>
                <?php } ?>  
                <div class="col-sm-12"></div> 
                <div class="col-sm-4">
                    <div class="form-group">
                        <label> <input type="checkbox" name="zero_units" class="zero_units" value="0" onchange="search_summary('<?php echo base_url(); ?>admin/viewOutBloodCollection/')"/> Zero Units </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <select class="btn_excel form-control" onchange="btn_excel()">
                        <option value="0">All</option>
                        <option value="1">24 Hrs</option>
                        <option value="2">48 Hrs</option>
                        <option value="3">72 Hrs</option>
                    </select>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="">Component Type</label>
                        <div class="radio">
                            <label><input type="radio" name="blood_bank_type" value="WB" checked="checked" class="component_type"/> Whole Blood (WB)</label>
                            <label><input type="radio" name="blood_bank_type" value="PC" class="component_type"/> Packed Cells (PC)</label>
                            <label><input type="radio" name="blood_bank_type" value="FP" class="component_type"/> Frozen Plasma (FP)</label>
                            <label><input type="radio" name="blood_bank_type" value="FFP" class="component_type"/> Fresh Frozen Plasma (FFP)</label>
                            <label><input type="radio" name="blood_bank_type" value="PRP" class="component_type"/> Platelet Rich plasma (PRP)</label>
                            <label><input type="radio" name="blood_bank_type" value="Platelet Concentrate" class="component_type"/> Platelet Concentrate</label>
                            <label><input type="radio" name="blood_bank_type" value="Cryo" class="component_type"/> Cryoprecipitated Antihemophilic Factor (Cryo)</label>
                        </div>
                        <input type="hidden" class="varurl" value="<?php echo base_url(); ?>admin/viewOutBloodCollection/"/>
                    </div>
                </div>
                <div class="col-sm-12">
<!--                    <div class="pull-right form-group"><a href="<?php echo base_url("admin/export_excel/0/1");?>" class="btn_excelhref btn btn-success btn-sm">Export to Excel</a></div>-->
                    <div class="pull-right form-group"><button type="submit" class="btn_excelhref btn btn-success btn-sm">Export to Excel</button></div>
                </div>
                </form>
                <div class="postList">   
                    <table class="table table-bordered table-hover filterable">
                        <thead>
                            <tr>     
                               <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank</th>
                                <th>District</th>
                                <th>City</th>
                                <?php } ?> 
                                <th class="bg-light-yellow">A+ve</th> 
                                <th class="bg-light-yellow">A-ve</th> 
                                <th class="bg-light-pink">B+ve</th> 
                                <th class="bg-light-pink">B-ve</th>  
                                <th class="bg-white">AB+ve</th> 
                                <th class="bg-white">AB-ve</th> 
                                <th class="bg-info">O+ve</th> 
                                <th class="bg-info">O-ve</th>  
                                <th class="bg-purple">Total</th> 
                                <th>Updated On</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php 
                            if(count($view) > 0){
                                $total  =   "0";
                                foreach ($view as $ve){ 
                                    $total  =   $ve->Apos+$ve->Aneg+$ve->Bpos+$ve->Bneg+$ve->ABpos+$ve->ABneg+$ve->Opos+$ve->Oneg;
                                    if($ve->category == "Private"){
                                                    $vep 	=	"cadetblue";
                                    }
                                    if($ve->category == "Charity"){
                                                    $vep 	=	"antiquewhite";
                                    }
                                    if($ve->category == "Government"){
                                                    $vep 	=	"gold";
                                    }
                                    if($ve->category == ""){
                                                    $vep 	=	"";
                                    }
                                ?>
                                <tr class="<?php echo $vep;?>">
                                       <?php if($this->session->userdata("login_type") != '5utype') {?>
                                        <td><?php echo $ve->bloodbank_name;?></td>
                                        <td><?php echo $ve->district;?></td>
                                        <td><?php echo $ve->city;?></td>
                                        <?php } ?>  
                                        <td class="bg-light-yellow"><?php echo $ve->Apos;?></td>  
                                        <td class="bg-light-yellow"><?php echo $ve->Aneg;?></td>   
                                        <td class="bg-light-pink"><?php echo $ve->Bpos;?></td>  
                                        <td class="bg-light-pink"><?php echo $ve->Bneg;?></td>  
                                        <td class="bg-white"><?php echo $ve->ABpos;?></td>  
                                        <td class="bg-white"><?php echo $ve->ABneg;?></td>  
                                        <td class="bg-info"><?php echo $ve->Opos;?></td>  
                                        <td class="bg-info"><?php echo $ve->Oneg;?></td>   
                                        <td class="bg-purple"><?php echo $total;?></td> 
                                        <td><?php echo date("d M Y H:i:s",strtotime($ve->out_updated_on));?></td> 
                                    </tr>
                                    <?php
                                }
                            }else {
                                    echo "<tr><td>Blood Collections are not available</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>     
                               <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank</th>
                                <th>District</th>
                                <th>City</th>
                                <?php } ?> 
                                <th class="bg-light-yellow">A+ve</th> 
                                <th class="bg-light-yellow">A-ve</th> 
                                <th class="bg-light-pink">B+ve</th> 
                                <th class="bg-light-pink">B-ve</th>  
                                <th class="bg-white">AB+ve</th> 
                                <th class="bg-white">AB-ve</th> 
                                <th class="bg-info">O+ve</th> 
                                <th class="bg-info">O-ve</th>  
                                <th class="bg-purple">Total</th> 
                                <th>Updated On</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="col-sm-12">
                        <?php echo $this->ajax_pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>