 
    <section class="content">  
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">
                View Active Camps 
            </li>
        </ol>
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">View Active Camps</h3> 
			</div>
			<div class="box-body">
                            <div class="row"> 
                                <div class="col-sm-12 ">
                                    <a href="javascript:void(0);" class="pull-right btn btn-xs btn-warning" onclick="fa_camps()"> 
                                        All Camps </h5>  
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <label>Blood Bank Type <span class="text-red">*</span></label>
                                    <div class="radio">
                                        <?php if(count($bloodbank_type) > 0){ 
                                            foreach ($bloodbank_type as $vt){
                                                ?> 
                                                <label>
                                                    <input type="radio" name="blood_banktype" class="blood_banktype" value="<?php echo $vt->btype_name;?>" onclick="search_summary('<?php echo base_url(); ?>cm/viewAcCamps/')"/> <?php echo $vt->btype_name;?>
                                                </label>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <input type="hidden" name="login_type" class="login_type"/>
                                    </div> 
                                </div>  
                                <div class="col-sm-6"> 
                                    <div class="form-group pull-left"> 
                                        <label>Category</label>
                                        <select name="blood_category" class="form-control blood_category" onchange="searchFilter('','<?php echo base_url(); ?>cm/viewAcCamps/')">
                                            <option value="">Select Category</option>
                                            <option value="Private">Private</option>
                                            <option value="Charity">Charity</option>
                                            <option value="Government">Government</option>
                                        </select>
                                    </div> 
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group pull-right"> 
                                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>cm/viewAcCamps/')"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="postList">
                                    <table  class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Blood Bank Name</th> 
                                                <th>District</th>
                                                <th>City</th>
												<th>Date</th>
                                                <th>Camps</th> 
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php  
                                                if(count($view) > 0){
                                                        $i = 1;
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
                                                            <td><?php echo $limit++;?></td>
                                                            <td><?php echo $vw->bloodbank_name;?></td> 
                                                            <td><?php echo $vw->district;?></td> 
                                                            <td><?php echo $vw->city;?></td>
															<td><?php echo date("d F Y",strtotime($vw->camp_date));?></td> 
                                                            <td><?php echo $vw->camp_description;?></td> 
                                                            <td>
                                                                <a href="<?php echo base_url("cm/schedules/".$vw->camp_id);?>" class="btn btn-sm btn-info"></i> Register</a>
                                                            </td>
                                                        </tr> 
                                                        <?php
                                                        } 
                                                }else{
                                                        echo "<tr><td colspan='6'>Active Blood Bank Camps are not available</td></tr>";
                                                }
                                                ?>
                                        </tbody>
                                        <tfoot>
                                                <tr>
                                                    <th>S.No.</th>
													<th>Blood Bank Name</th> 
													<th>District</th>
													<th>City</th>
													<th>Date</th>
													<th>Camps</th> 
													<th>Action</th>
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
dateInit();
</script>