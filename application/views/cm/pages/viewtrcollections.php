<section class="content">
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:void(0);" class="small-box-footer" onclick="fa_bank(this)" uri="BCTV (Blood Collection and Transportation Vehicles)">  BCTV</a></li>
        <li class="active">
            View BCTV Collections  
        </li>
    </ol>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">View BCTV Collections</h3> 
        </div>
        <div class="box-body">
            <div class="row">  
                <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2">From and To Date </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>cm/viewTCollections/<?php echo $bloodid;?>/" /> 
                            </div>
                        </div>
                </div>  
                <div class="col-sm-12"> 
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>cm/viewTCollections/<?php echo $bloodid;?>/')"/>
                    </div>
                </div>
                <div class="col-sm-12"> 
                    <div class="postList">
                        <table  class="table table-bordered table-hover">
                            <thead>
                                <tr> 
                                    <th>Date</th>
                                    <th>Blood Bank Name</th>
                                    <th>Type </th>
                                    <th>Blood Bank Name</th>
                                    <th>No. of units</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php 
                                    $tot = 0;
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
                                                <td><?php echo $vw->tc_date;?></td>
                                                <td><?php echo $vw->tbloodbank_name;?></td>
                                                <td><?php echo $vw->mg_val;?></td>
                                                <td><?php echo $vw->bloodbank_name;?></td>
                                                <td><?php 
                                                $tot = $tot+$vw->cnt;
                                                echo $vw->cnt;?></td>  
                                            </tr>  
                                            <?php
                                            } 
                                    }else{
                                            echo "<tr><td colspan='5'>Collections and Transfers are not available</td></tr>";
                                    }
                                    ?>
                                    <tr>
                                        <td colspan='4'><b class='pull-right'>Total</b></td><td><b><?php echo $tot;?></b></td>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr> 
                                    <th>Date</th>
                                    <th>Blood Bank Name</th>
                                    <th>Type </th>
                                    <th>Blood Bank Name</th>
                                    <th>No. of units</th>
                                </tr>
                            </tfoot>
                        </table>
                        <?php echo $this->ajax_pagination->create_links();?>
                    </div>
                </div>  
            </div>   
        </div>
    </div>
</section> 
<script> 
    dateInit();
</script>