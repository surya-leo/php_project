<section class="content">
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">
            Blood Expiry
        </li>
    </ol>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Blood Expiry</h3> 
        </div> 
        <div class="box-body">
            <div class="col-sm-12">
                <div class="form-group pull-right"> 
                    <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>cm/viewBloodDiscarded/')"/>
                </div>
            </div>
            <div class="postList">  
                <table class="table-striped table table-bordered">
                    <thead>
                        <tr>  
                            <th>S.No.</th>
                            <th>Blood Bank Name</th> 
                            <th>District</th>
                            <th>Blood Unit Number</th>  
                            <th>Blood Group</th> 
                            <th>Component Type</th> 
                            <th>Expiry Date</th> 
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(count($view) > 0){
                        $i = $limit;
                        foreach ($view as $ve){
                            $venotes    =   $ve->notes;
                            if($ve->expiry_date < date("Y-m-d")){
                                $venotes  =   "Expired";
                            }
                            ?>   
                            <td><?php echo $i++;?></td>
                            <td><?php echo $ve->bloodbank_name;?></td> 
                            <td><?php echo $ve->district;?></td> 
                            <td><?php echo $ve->blood_unit_num;?></td> 
                            <td><?php echo $ve->blood_group?></td>  
                            <td><?php echo $ve->component_type;?></td>
                            <td><?php echo $ve->expiry_date;?></td> 
                            <td><?php echo $venotes;?></td>  
                        </tr> 
                            <?php
                        }
                    }else{
                            echo "<tr><td colspan='6'>Blood Expiry details are not available</td></tr>";
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>  
                            <th>S.No.</th>
                            <th>Blood Bank Name</th> 
                            <th>District</th>
                            <th>Blood Unit Number</th>  
                            <th>Blood Group</th> 
                            <th>Component Type</th> 
                            <th>Expiry Date</th> 
                            <th>Reason</th>
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