<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Request Closed
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li class="active">Blood Request Closed</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Request Closed</h3>
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
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewClosedrequest/')"/>
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
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if(count($view)>0){
                                    $i  =   1;
                                    foreach($view as $ve){
                                            ?>
                                            <tr> 
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $ve->patient_first_name." ".$ve->patient_last_name;?></td>
                                                <td><?php echo ($ve->patient_gender == 1)?"Female":"Male";?></td>
                                                <td><?php echo $ve->brblood_group;?></td> 
                                                <td><?php echo $ve->request_remarks;?></td> 
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
                                            <th>Remarks</th> 
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