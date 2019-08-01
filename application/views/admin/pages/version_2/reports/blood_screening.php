<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Screening
            <small>Viewing Blood Screening Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Reports</a></li>
            <li class="active">Blood Screening</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Screening Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">  
                 <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-2">From and To Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>admin/viewBloodScreening/" /> 
                        </div>  
                        <label class="col-sm-2">Blood Bank</label>
                        <div class="col-sm-4">
                            <select class="form-control searbloodbank_id" name="bloodbank_id" onchange="search_summary('<?php echo base_url(); ?>admin/viewBloodScreening/')">
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
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBloodScreening/')"/>
                    </div>
                </div>
                <div class="postList">  
                    <table class="table-striped table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank Name</th>
                                <?php } ?>
                                <th>Blood Unit Number</th>
                                <th>Donor Name</th>
                                <th>Blood Group</th>
                                <th>HIV</th>
                                <th>HBSAG</th>
                                <th>HCV</th>
                                <th>VDRL</th>
                                <th>MP</th>
                                <th>Irregular Ab</th>
                                <th>Screened By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($view) > 0){
                                foreach($view as $ve){
                                    ?>
                                    <tr>
                                        <td><?php echo date("Y-m-d",strtotime($ve->screening_datetime));?></td>
                                        <?php if($this->session->userdata("login_type") != '5utype') {?>
                                            <td><?php echo $ve->bloodbank_name;?></td>
                                        <?php } ?>
                                        <td><?php echo $ve->blood_unit_num;?></td>
                                        <td><?php echo $ve->name;?></td>
                                        <td><?php echo $ve->blood_group;?></td>
                                        <td><?php echo $ve->test_hiv;?></td> 
                                        <td><?php echo $ve->test_hbsag;?></td> 
                                        <td><?php echo $ve->test_hcv;?></td> 
                                        <td><?php echo $ve->test_vdrl;?></td> 
                                        <td><?php echo $ve->test_mp;?></td> 
                                        <td><?php echo $ve->test_irregular_ab;?></td> 
                                        <td><?php echo $ve->scre_staff_name;?></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                    echo "<tr><td colspan='12'>Blood Screening details are not available.</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank Name</th>
                                <?php } ?>
                                <th>Blood Unit Number</th>
                                <th>Donor Name</th>
                                <th>Blood Group</th>
                                <th>HIV</th>
                                <th>HBSAG</th>
                                <th>HCV</th>
                                <th>VDRL</th>
                                <th>MP</th>
                                <th>Irregular Ab</th>
                                <th>Screened By</th>
                            </tr>
                        </tfoot>
                    </table>
                    <?php echo $this->ajax_pagination->create_links();?>
                </div>
            </div>
        </div>
    </section>
</div>