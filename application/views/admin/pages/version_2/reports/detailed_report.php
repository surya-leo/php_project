<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Detailed Blood Issued
            <small>Viewing Detailed Blood Issued Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Issue Reports</a></li>
            <li class="active">Detailed Blood Issued</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Detailed Blood Issued Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">  
                 <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-2">From and To Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>admin/viewDetailedIssued/" /> 
                        </div>  
                        <label class="col-sm-2">Blood Bank</label>
                        <div class="col-sm-4">
                            <select class="form-control searbloodbank_id" name="bloodbank_id" onchange="search_summary('<?php echo base_url(); ?>admin/viewDetailedIssued/')">
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
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewDetailedIssued/')"/>
                    </div>
                </div> 
                <div class="postList">  
                    <table class="table-striped table table-bordered">
                        <thead>
                            <tr> 
                                <th>Issue Date</th> 
                                <th>Issue Time</th> 
                                <th>Blood Bag Number</th> 
                                <th>Component</th> 
                                <th>Patient Name</th> 
                                <th>Patient Blood Group</th> 
                                <th>Patient Diagnosis</th> 
                                <th>Hospital Name</th> 
                                <th>Donor Name</th> 
                                <th>Donor Blood Group</th> 
                                <th>Quantity of Blood</th> 
                                <th>Blood Bank Name</th> 
                                <th>Issued By</th> 
                                <th>Cross Matched By</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($view) > 0){
                                foreach($view as $vw){
                                    ?>
                                    <tr>
                                        <td><?php echo date("d-m-Y",strtotime($vw->issue_date));?></td>
                                        <td><?php echo $vw->issue_time;?></td>
                                        <td><?php echo $vw->blood_unit_num;?></td>
                                        <td><?php echo $vw->component_type;?></td>
                                        <td><?php echo $vw->patient_name;?></td>  
                                        <td><?php echo $vw->brblood_group;?></td>  
                                        <td><?php echo $vw->patient_diagnosis;?></td>  
                                        <td><?php echo $vw->hospital;?></td>   
                                        <td><?php echo $vw->name;?></td> 
                                        <td><?php echo $vw->blood_group;?></td>   
                                        <td><?php echo $vw->bivolume;?></td>    
                                        <td><?php echo $vw->bloodbank_name;?></td>    
                                        <td><?php echo $vw->issued_staff_name;?></td>    
                                        <td><?php echo $vw->issued_staff_name;?></td>    
                                    </tr>
                                    <?php
                                }
                            }else{
                                    echo "<tr><td colspan='18'>Blood Issued Details are not available</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Issue Date</th> 
                                <th>Issue Time</th> 
                                <th>Blood Bag Number</th> 
                                <th>Component</th> 
                                <th>Patient Name</th> 
                                <th>Patient Blood Group</th> 
                                <th>Patient Diagnosis</th> 
                                <th>Hospital Name</th> 
                                <th>Donor Name</th> 
                                <th>Donor Blood Group</th> 
                                <th>Quantity of Blood</th> 
                                <th>Blood Bank Name</th> 
                                <th>Issued By</th> 
                                <th>Cross Matched By</th> 
                            </tr>
                        </tfoot>
                    </table> 
                    <?php echo $this->ajax_pagination->create_links();?>
                </div>
            </div>
        </div>
    </section>
</div>
                          