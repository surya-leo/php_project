<section class="content"> 
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">
            View Blood Bank Camps
        </li>
    </ol>
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">View Blood Bank Camps</h3> 
			</div>
			<div class="box-body">
                <div class="row">
                    <form method="post" action="">
                        <div class="col-md-12">
                            <label>Blood Bank Type <span class="text-red">*</span></label>
                            <div class="radio">
                                <?php if(count($bloodbank_type) > 0){ 
                                    foreach ($bloodbank_type as $vt){
                                        ?> 
                                        <label>
                                            <input type="radio" name="blood_banktype" class="blood_banktype" value="<?php echo $vt->btype_name;?>" onclick="search_summary('<?php echo base_url(); ?>cm/viewCamps/')"/> <?php echo $vt->btype_name;?>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>
                                <input type="hidden" name="login_type" class="login_type"/>
                            </div> 
                        </div>  
                        <div class="col-md-10">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4">Category </label>
                                        <div class="col-sm-8">
                                            <select name="blood_category" class="form-control blood_category" onchange="searchFilter('','<?php echo base_url(); ?>cm/viewCamps/')">
                                                <option value="">Select Category</option>
                                                <option value="Private">Private</option>
                                                <option value="Charity">Charity</option>
                                                <option value="Government">Government</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4">From and To Date </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>cm/viewCamps/" /> 
                                        </div>
                                    </div>
                                </div>
                            </div>   
                    </form>	 
                    <div class="col-md-12">
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>cm/viewCamps/')"/>
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
                                        <th>No. of Camps</th>   
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
                                                    <td><?php echo $vw->cnt;?></td>  
                                                </tr> 
                                                <?php
                                                } 
                                        }else{
                                                echo "<tr><td colspan='6'>Blood Bank Camp details are not available</td></tr>";
                                        }
                                        ?>
                                </tbody>
                                <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Blood Bank Name</th> 
                                            <th>District</th>
                                            <th>City</th>
                                            <th>No. of Camps</th>   
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