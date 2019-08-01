<section class="content">
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">
            Blood Collection
        </li>
    </ol>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">View Blood Collection</h3> 
        </div>
        <div class="box-body">
            <div class="row">
                <form method="post" action="<?php echo base_url('cm/pdf_download/2');?>">
                    <div class="col-md-12">
                        <label>Blood Bank Type <span class="text-red">*</span></label>
                        <div class="radio">
                            <?php if(count($bloodbank_type) > 0){ 
                                foreach ($bloodbank_type as $vt){
                                    ?> 
                                    <label>
                                        <input type="radio" name="blood_banktype" class="blood_banktype" value="<?php echo $vt->btype_name;?>" onclick="search_summary('<?php echo base_url(); ?>cm/viewCollection/')"/> <?php echo $vt->btype_name;?>
                                    </label>
                                    <?php
                                }
                            }
                            ?>
                            <input type="hidden" name="login_type" class="login_type"/>
                        </div>
                        <div class="text-red"><?php echo form_error("blood_bank_type");?></div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label> <input type="checkbox" name="zero_units" class="zero_units" value="0"  onchange="search_summary('<?php echo base_url(); ?>cm/viewCollection/')"/> Zero Units </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group"> 
                            <label>District</label>
                            <select class="form-control district report_district" name="district"  onchange="search_summary('<?php echo base_url(); ?>cm/viewCollection/')">
                                <option value="">Select District</option>
                                <?php 
                                if(count($district) > 0){ 
                                    foreach ($district as $dis){
                                            ?>
                                            <option value="<?php echo trim($dis->district_name);?>" text_val="<?php echo $dis->district_id;?>"><?php echo trim($dis->district_name);?></option>
                                            <?php
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group"> 
                            <label>City</label>
                            <select class="form-control city report_city" name="city" onchange="search_summary('<?php echo base_url(); ?>cm/viewCollection/')">
                                <option value="">Select City</option> 
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group"> 
                            <label>Category</label> 
                            <select name="blood_category" class="form-control blood_category" onchange="searchFilter('','<?php echo base_url(); ?>cm/viewCollection/')">
                                <option value="">Select Category</option>
                                <option value="Private">Private</option>
                                <option value="Charity">Charity</option>
                                <option value="Government">Government</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group"> 
                            <label>Not Updated In</label> 
                            <select class="btn_excel form-control" name="notintervalue"  onchange="searchFilter('','<?php echo base_url(); ?>cm/viewCollection/')">
                                <option value="0">All</option>
                                <option value="1">24 Hrs</option>
                                <option value="2">48 Hrs</option>
                                <option value="3">72 Hrs</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-sm-12">
                        <div class="form-group pull-right">
                            <button type="submit" name="submit"  value="Submit" class="btn btn-facebook"><i class="fa fa-file-excel-o"></i> Download Excel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="postList">    
                        <table class="table table-bordered table-hover filterable">
                            <thead>
                                <tr>      
                                    <th>S.No.</th>
                                    <th>Blood Bank</th>
                                    <th>District</th>
                                    <th>City</th> 
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
                                    $i = $limit;
                                    $total  =   "0";
                                    foreach ($view as $ve){
    //                                    $total  =   $ve->Apos+$ve->Aneg+$ve->Bpos+$ve->Bneg+$ve->ABpos+$ve->ABneg+$ve->Opos+$ve->Oneg+$ve->Rhpos+$ve->Rhneg;
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
                                        <td><?php echo $i++;?></td>
                                            <td><?php echo $ve->bloodbank_name;?></td>
                                            <td><?php echo $ve->district;?></td>
                                            <td><?php echo $ve->city;?></td> 
                                            <td class="bg-light-yellow"><?php echo $ve->Apos;?></td>  
                                            <td class="bg-light-yellow"><?php echo $ve->Aneg;?></td>   
                                            <td class="bg-light-pink"><?php echo $ve->Bpos;?></td>  
                                            <td class="bg-light-pink"><?php echo $ve->Bneg;?></td>  
                                            <td class="bg-white"><?php echo $ve->ABpos;?></td>  
                                            <td class="bg-white"><?php echo $ve->ABneg;?></td>  
                                            <td class="bg-info"><?php echo $ve->Opos;?></td>  
                                            <td class="bg-info"><?php echo $ve->Oneg;?></td>   
                                            <td class="bg-purple"><?php echo $total;?></td> 
                                            <td><?php echo date("d M Y",strtotime($ve->out_updated_on));?></td> 
                                        </tr>
                                        <?php
                                    }
                                }else {
                                        echo "<tr><td colspan='10'>Blood Collections are not available</td></tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>      
                                    <th>S.No.</th>
                                    <th>Blood Bank</th>
                                    <th>District</th>
                                    <th>City</th> 
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
                        <?php echo $this->ajax_pagination->create_links();?>
                    </div>
                </div>
                <div class='col-sm-12 pull-left'>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="get_pages()"> Back</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
      disInit();
</script>