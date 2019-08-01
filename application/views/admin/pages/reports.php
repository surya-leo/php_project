<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View Blood Donated Reports<small>Viewing Blood Donated reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Reports</a></li>
            <li class="active">Blood Donated</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">View Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <form method="post" action="<?php echo base_url("get_download");?>">
                        <div class="form-group">
                            <label class="col-sm-2">From and To Date </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>admin/viewBloodDonated/" /> 
                            </div>  
                            <?php if($this->session->userdata("login_type") != '3utype'){ ?>
                            <label class="col-sm-2">District </label>
                            <div class="col-sm-4">
                                <select name="district" class="form-control report_district" onchange="search_summary('<?php echo base_url(); ?>admin/viewBloodDonated/')">
                                        <option value=""> -- Select District -- </option>
                                        <?php
                                        if(count($district) > 0){
                                            foreach($district as $dt){
                                            ?>
                                            <option value="<?php echo $dt->district_name;?>"><?php echo $dt->district_name;?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <?php } ?>
                        </div> 
                    <div class="col-sm-12"><br/>
                        <div class="form-group pull-left">  
                            <button type="submit" name="submit" class="btn btn-sm btn-primary pull-right">Download in Xls</button>
                        </div> 
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBloodDonated/')"/>
                        </div>
                    </div>
                </form>
                    <div class="col-sm-12">
                        <div class="postList"> 
                            <table class="table table-bordered table-hover">
                                    <thead>
                                            <tr>
                                              <th>S.No.</th>
                                              <th>Blood Bank Name</th>
                                              <th>Distirct</th>
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
                                                      <td><?php echo $vw->bloodbank_name;?></td>
                                                      <td><?php echo $vw->district;?></td>  
                                                       <td><?php echo $vw->city;?></td>  
                                                      <td><?php echo $vw->cnt;?></td> 
                                                    </tr> 
                                                    <?php
                                                    } 
                                            }else {
                                                echo "<tr><td colspam='6'>Blood Donated Details not available</td></tr>";
                                            }
                                            ?>
                                    </tbody>
                                    <tfoot>
                                            <tr>
                                                    <th>S.No.</th>
                                                    <th>Blood Bank Name</th>
                                                    <th>Distirct</th> 
                                                    <th>City</th> 
                                                    <th>No. of Donors</th> 
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
</div>