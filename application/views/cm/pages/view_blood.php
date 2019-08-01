<section class="content">
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">
            View <?php echo $title;?>  Details 
        </li>
    </ol>
	<div class="box box-default"> 
            <div class="box-header with-border">
                <h3 class="box-title">View <?php echo $title;?> </h3> 
            </div>
            <div class="box-body">
                <?php if(trim($title) == "BCTV (Blood Collection and Transportation Vehicles)") {?>
                <div class="col-sm-12">
                    <div class="pull-right">
                        <a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="viewBctvgraph($(this))"><i class="fa fa-bar-chart-o"></i> View </a><br/><br/>
                    </div>
                </div>  
                <?php }  ?>
                <div class="col-sm-6"> 
                    <div class="form-group pull-left"> 
                        <label>Category</label>
                        <select name="blood_category" class="form-control blood_category" onchange="searchFilter('','<?php echo base_url(); ?>cm/viewBloodbank/')">
                            <option value="">Select Category</option>
                            <option value="Private">Private</option>
                            <option value="Charity">Charity</option>
                            <option value="Government">Government</option>
                        </select>
                    </div> 
                </div> 
                <div class="col-sm-6">
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>cm/viewBloodbank/')"/>
                        <input type="hidden" class="uir" value="<?php echo $title;?>"/>
                    </div>
                </div>
                <div class="postList"> 
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th><?php echo $title;?> Name</th>
                                <?php if(trim($title) == "Mother Blood Bank") {?>
                                <th>Linked Blood Storage</th>                                  
                                <?php } if(trim($title) == "Blood Storage Centre"){ ?>
                                <th>Linked Mother Blood Bank</th>
                                <?php } ?>
                                <th>District</th>
                                <th>Mobile No</th>
                                <th>Email Id</th>
                                <th>Category</th> 
                                <th>Licensed</th> 
                                <?php if(trim($title) == "BCTV (Blood Collection and Transportation Vehicles)") {?>
                                <th>Action</th>                           
                                <th>Month Collection</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($view) > 0){
                                    $i = $limit;
                                    foreach($view as $vw){
                                            if($vw->category == "Private"){
                                                    $vep 	=	"cadetblue";
                                            }
                                            if($vw->category == "Charity"){
                                                    $vep 	=	"antiquewhite";
                                            }
                                            if($vw->category == "Government"){
                                                    $vep 	=	"gold";
                                            }
                                            if($vw->category == ""){
                                                    $vep 	=	"";
                                            }
                                    ?>
                                    <tr class="<?php echo $vep;?>">
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $vw->bloodbank_name;?></td> 
                                        <?php if(trim($title) == "Mother Blood Bank") {?>
                                        <td><?php echo $this->blood_bank_model->view_blood(array('assign_bloodbanks' => $vw->bloodbank_id,'uri' => 'Blood Storage Centre'))['0']->bloodbank_name;?></td>
                                        <?php } if(trim($title) == "Blood Storage Centre") {?>
                                        <td><?php echo $this->blood_bank_model->ve_blood($vw->assign_bloodbanks)->bloodbank_name;?></td>
                                        <?php } ?>
                                        <td><?php echo $vw->district;?></td>
                                        <td><?php echo $vw->bbmobile;?></td>
                                        <td><?php echo $vw->email_id;?></td>
                                        <td><?php echo $vw->category;?></td> 
                                        <td>
                                            <?php 
                                            if($vw->bb_licensed != ''){
                                            $imgp   =   "";
                                            $imp    =  'resources/jdadmin_assets/js_uploads/'.$vw->bb_licensed;  
                                            if (file_exists($imp)) {
                                                $imgp = $imp;
                                            }
                                            if($imgp != ''){ ?> 
                                            <a href="/<?php echo $imgp;?>" target="_blank" class="btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> View </a>
                                            <?php }
                                            }?>
                                        </td>
                                        <?php if(trim($title) == "BCTV (Blood Collection and Transportation Vehicles)") {?>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary" bloodbankid="<?php echo $vw->bloodbank_id;?>" onclick="viewCamps($(this))"><i class="fa fa-search-plus"></i> View Camps </a>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-info" bloodbankid="<?php echo $vw->bloodbank_id;?>" onclick="viewCollection($(this))"><i class="fa fa-search-plus"></i> View Collections </a>
                                        </td>
                                        <td>
                                            <?php 
                                            $end    =   date("Y-m-d");
                                            $str    =   date("Y-m-d",strtotime("-1 month")); 
                                            $conditions['bloodbank']            =   $vw->bloodbank_id; 
                                            $conditions['asate'] = $str." - ".$end; 
                                            $vsp    =   $this->transfer_model->vrn_collec_query($conditions);
                                            if(count($vsp) > 0){
                                                $ror    =   "0";
                                                echo "<table class='table table-bordered table-hover'>";
                                                    foreach ($vsp as $vwe){
                                                        $ror    =   $ror+$vwe->cnt;
                                                        ?>
                                                        <tr>  
                                                            <td><?php echo $vwe->bloodbank_name;?></td>  
                                                            <td><?php echo $vwe->cnt;?></td>  
                                                        </tr>     
                                                        <?php 
                                                        echo "<tr><th>Total</th><th>".$ror."</th></tr>";
                                                    }
                                                echo "</table>";
                                            }
                                            ?>
                                        </td>
                                        <?php } ?>
                                    </tr> 
                                    <?php
                                    } 
                            }else{  ?>  
                                        <tr><td colspan="7">No <?php echo $title;?> Available</td></tr>
                                <?php 
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                 <th>S.No.</th>
                                <th><?php echo $title;?> Name</th>
                                <?php if(trim($title) == "Mother Blood Bank") {?>
                                <th>Linked Blood Storage</th>                                  
                                <?php } if(trim($title) == "Blood Storage Centre"){ ?>
                                <th>Linked Mother Blood Bank</th>
                                <?php } ?>
                                <th>District</th>
                                <th>Mobile No</th>
                                <th>Email Id</th>
                                <th>Category</th> 
                                <th>Licensed</th> 
                                <?php if(trim($title) == "BCTV (Blood Collection and Transportation Vehicles)") {?>
                                <th>Action</th>          
                                <th>Month Collection</th>
                                <?php } ?>     
                            </tr>
                        </tfoot>
                      </table>
                    <?php echo $this->ajax_pagination->create_links();?>
                </div>
                <div class='col-sm-12 pull-left'>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="get_pages()"> Back</a>
                </div>
            </div>
	</div>
</section> 