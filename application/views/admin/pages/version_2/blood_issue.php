<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Issue
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li class="active">Blood Issue</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Issue</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div> 
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->load->view("admin/layout/success_error");?>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-12">
                            <div class="pull-right form-group">
                                <a href="<?php echo base_url();?>admin/request-issue" class="btn btn-success btn-sm">Request Issue</a>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group pull-right"> 
                                <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBloodissue/')"/>
                            </div>
                        </div>
                        <div class="postList">
                            <table class="table table-striped table-bordered table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Blood Group</th>
                                        <th>Blood Components</th>
                                        <th>Issue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if(count($view)>0){
                                    $i  =   1;
                                    foreach($view as $ve){
                                            ?>
                                            <tr>
                                                <form action="issue/<?php echo $ve->request_id;?>" method="post" >
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo $ve->patient_first_name." ".$ve->patient_last_name;?></td>
                                                    <td><?php echo ($ve->patient_gender == 2)?"Female":"Male";?></td>
                                                    <td><?php echo $ve->brblood_group;?></td>
                                                    <td>
                                                        <input type="text" value="<?php echo $ve->brblood_group;?>" hidden name="blood_group" />
                                                        <div class="col-label">
                                                        <?php 
                                                        if($ve->whole_blood_units!=0){
                                                                echo "<label class='label label-success'><b>WB: ".$ve->whole_blood_units;
                                                                echo "</b><input type='text' value='\"WB\"' hidden name='components[]' /></label>";
                                                        }
                                                        if($ve->packed_cell_units!=0){
                                                                echo "<label class='label label-info'><b>PC: ".$ve->packed_cell_units;
                                                                echo "</b><input type='text' value='\"PC\"' hidden name='components[]' /></label> ";
                                                        }
                                                        if($ve->fp_units!=0){
                                                                echo "<label class='label label-warning'><b>FP: ".$ve->fp_units;
                                                                echo "</b><input type='text' value='\"FP\"' hidden name='components[]' /></label> ";
                                                        }
                                                        if($ve->ffp_units!=0){
                                                                echo "<label class='label label-primary'><b>FFP: ".$ve->ffp_units;
                                                                echo "</b><input type='text' value='\"FFP\"' hidden name='components[]' /></label> ";
                                                        }
                                                        if($ve->prp_units!=0){
                                                                echo "<label class='label bg-navy'><b>PRP : ".$ve->prp_units;
                                                                echo "</b><input type='text' value='\"PRP\"' hidden name='components[]' /></label> ";
                                                        }
                                                        if($ve->platelet_concentrate_units!=0){
                                                                echo "<label class='label bg-teal'><b>Platelet Concentrate: ".$ve->platelet_concentrate_units;
                                                                echo "</b><input type='text' value='\"Platelet Concentrate\"' hidden name='components[]' /></label> ";
                                                        }
                                                        if($ve->cryoprecipitate_units!=0){
                                                                echo "<label class='label bg-gray'><b>Cryo: ".$ve->cryoprecipitate_units;
                                                                echo "</b><input type='text' value='\"Cryo\"' hidden name='components[]' /></label> ";
                                                        }
                                                        ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php if($ve->request_status  == 'Closed'){
                                                            
                                                        }else { 
                                                        ?>
                                                        <input type="submit" value="Blood Issue" class="btn btn-success btn-xs" name="select_request" />
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs btn-request" data-toggle="modal" data-target="#request_idyModal" request_id="<?php echo $ve->request_id;?>">Close</a>
                                                        <?php } ?>
                                                    </td>
                                                </form>
                                            </tr>
                                            <?php
                                    }
                                } else {
                                        echo "<tr><td colspan='6'>No Blood Requests</td></tr>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Blood Group</th>
                                            <th>Blood Components</th>
                                            <th>Issue</th>
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