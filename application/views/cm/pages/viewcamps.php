<section class="content">
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:void(0);" class="small-box-footer" onclick="fa_bank(this)" uri="BCTV (Blood Collection and Transportation Vehicles)">  BCTV</a></li>
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
                <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2">From and To Date </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>cm/viewBloodCamps/<?php echo $bloodid;?>/" /> 
                            </div>
                        </div>
                </div>  
                <div class="col-sm-12"> 
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>cm/viewBloodCamps/<?php echo $bloodid;?>/')"/>
                    </div>
                </div>
                <div class="col-sm-12"> 
                    <div class="postList">
                        <table  class="table table-bordered">
                            <thead> 
                                <tr>
                                     <th>S.No.</th>
                                     <th>Blood Bank Name</th> 
                                     <th>District</th>
                                     <th>City</th>
                                     <th>Camp Name</th>  
                                     <th>Camp Date</th>  
                                 </tr>   
                            </thead>
                            <tbody>
                                    <?php  
                                    if(count($view) > 0){
                                            $i = 1;
                                            foreach($view as $vw){
                                                $vep    =   "red";
                                                if($vw->camp_date < date("Y-m-d")){
                                                        $vep    =   "green";
                                                }
                                            ?>
                                            <tr class="<?php echo $vep;?>">
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $vw->bloodbank_name;?></td>
                                                <td><?php echo $vw->district;?></td> 
                                                <td><?php echo $vw->city;?></td>
                                                <td><?php echo $vw->camp_description;?></td> 
                                                <td><?php echo date("d F Y",strtotime($vw->camp_date));?></td> 
                                            </tr> 
                                            <?php
                                            } 
                                    }else{
                                            echo "<tr><td colspan='5'>Blood Bank Camps are not available</td></tr>";
                                    }
                                    ?>
                            </tbody>
                            <tfoot>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Blood Bank Name</th> 
                                        <th>District</th>
                                        <th>City</th>
                                        <th>Camp Name</th>  
                                        <th>Camp Date</th>  
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