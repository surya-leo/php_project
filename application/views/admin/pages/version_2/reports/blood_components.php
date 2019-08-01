<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Blood Components
            <small>Viewing Blood Components Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Reports</a></li>
            <li class="active">Blood Components</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Components Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">  
                 <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-2">From and To Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>admin/viewBloodComponents/" /> 
                        </div> 
                        <label class="col-sm-2">Blood Bank</label>
                        <div class="col-sm-4">
                            <select class="form-control searbloodbank_id" name="bloodbank_id" onchange="search_summary('<?php echo base_url(); ?>admin/viewBloodComponents/')">
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
                    </div> 
                </form> 
                <div class="col-sm-12">
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBloodComponents/')"/>
                    </div>
                </div> 
                <div class="postList">  
                    <table class="table-striped table table-bordered table-condensed">
                        <thead>
                            <tr> 
                                <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank Name</th>
                                <?php } ?> 
                                <th>Blood Unit Number</th>
                                <th>Name</th>
                                <th>Donation Date</th>
                                <th>Expiry Date</th>
                                <th>Segment Number</th>
                                <th>Volume</th>
                                <th>Blood Group</th>
                                <th>Screened Date</th>
                                <th>HIV</th>
                                <th>HBSAG</th>
                                <th>HCV</th>
                                <th>VDRL</th>
                                <th>MP</th>
                                <th>Irregular Ab</th>
                                <th>Status</th>
                                <th>Components / Prepared Date</th>
                                <th>Issue No. / Issue Dated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($view) > 0){
                                foreach($view as $vw){
                                    ?>
                                    <tr>
                                        <?php if($this->session->userdata("login_type") != '5utype') {?>
                                        <td><?php echo $vw->bloodbank_name;?></td>
                                        <?php } ?>
                                        <td><?php echo $vw->blood_unit_num;?></td>
                                        <td><?php echo $vw->name;?></td>
                                        <td><?php echo $vw->donation_date;?></td>
                                        <td><?php echo $vw->expiry_date;?></td>
                                        <td><?php echo $vw->segment_num;?></td>
                                        <td><?php echo $vw->bbvolume;?></td>
                                        <td><?php echo $vw->blood_group;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($vw->screening_datetime));?></td>
                                        <td><?php echo $vw->test_hiv;?></td>
                                        <td><?php echo $vw->test_hbsag;?></td>
                                        <td><?php echo $vw->test_vdrl;?></td>
                                        <td><?php echo $vw->test_hcv;?></td>
                                        <td><?php echo $vw->test_mp;?></td>
                                        <td><?php echo $vw->test_irregular_ab;?></td>
                                        <td><?php echo $vw->status;?></td>
                                        <td><?php echo $vw->component_type." / ".date("d-m-Y",strtotime($vw->components_date));?></td>
                                        <td><?php echo $vw->issue_id." / ".date("d-m-Y",strtotime($vw->issue_date));?></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                    echo "<tr><td colspan='18'>Blood Component Details are not available</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank Name</th>
                                <?php } ?>
                                <th>Blood Unit Number</th>
                                <th>Donor Name</th>
                                <th>Donation Date</th>
                                <th>Expiry Date</th>
                                <th>Segment Number</th>
                                <th>Volume</th>
                                <th>Blood Group</th>
                                <th>Screened Date</th>
                                <th>HIV</th>
                                <th>HBSAG</th>
                                <th>HCV</th>
                                <th>VDRL</th>
                                <th>MP</th>
                                <th>Irregular Ab</th>
                                <th>Status</th>
                                <th>Components / Prepared Date</th>
                                <th>Issue No. / Issue Dated</th>
                            </tr>
                        </tfoot>
                    </table> 
                </div>
            </div>
        </div>
    </section>
</div>
<?php echo $this->ajax_pagination->create_links();?>
                          