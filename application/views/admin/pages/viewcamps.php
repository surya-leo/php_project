<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Camp Donor Reports
            <small>Viewing the camp donor reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li><a href="javascript:void(0);">Reports</a></li>
            <li class="active">Camp Donors</li>
        </ol>
    </section> 
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">View Camp Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body"> 
                <div class="col-sm-12"><br/>
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewCampDonor/')"/>
                    </div>
                </div> 
                <div class="postList">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>S.No.</th>
                              <th>Camp Name</th> 
                              <th>Blood Bank Name</th> 
                              <th>District</th> 
                              <th>City</th> 
                              <th>No. of Donors</th>  
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
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $vw->camp_description;?></td> 
                                        <td><?php echo $vw->bloodbank_name;?></td> 
                                        <td><?php echo $vw->district;?></td> 
                                        <td><?php echo $vw->city;?></td> 
                                        <td><?php echo $vw->cnt;?></td> 
                                    </tr> 
                                    <?php
                                    } 
                            }else {
                                    echo "<tr><td colspan='6'>Camp Donor details are not available</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Camp Name</th>  
                                <th>Blood Bank Name</th> 
                                <th>District</th> 
                                <th>City</th>
                                <th>No. of Donors</th> 
                            </tr>
                        </tfoot>
                    </table>
                    <?php echo $this->ajax_pagination->create_links();?>
                </div>
            </div>
        </div>
    </section>
</div>