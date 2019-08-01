<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Request Not Satisfied
            <small>Viewing Blood Request Not Satisfied details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li class="active">Blood Request Not Satisfied</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Request Not Satisfied</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="form-horizontal" method="post" action=""> 
                <div class="box-body">
                    <div class="col-sm-12">
                        <?php $this->load->view("admin/layout/success_error");?>
                    </div> 
                    <div class="col-sm-12">
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewAppoint/')"/>
                        </div>
                    </div>
                    <div class="postList">
                            <table class="table table-bordered table-hover filterable">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Mobile</th>
                                        <th>Blood Group</th> 
                                        <th>Message</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php  
                                        if(count($view) > 0){
                                                $i = 1;
                                                foreach($view as $vw){ 
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo date("d-M-Y", strtotime($vw->ns_date));?></td>  
                                                    <td><?php echo $vw->name;?></td>
                                                    <td><?php echo $vw->age;?></td>
                                                    <td><?php echo $vw->ns_mobile;?></td>
                                                    <td><?php echo $vw->blood_group;?></td>  
                                                    <td><?php echo $vw->ns_message;?></td> 
                                                    <td><?php echo $vw->ns_remarks;?></td> 
                                                    <td>
                                                        <?php 
                                                        if($vw->ns_acde == '0'){
                                                            echo "<label class='label label-danger'>Closed</label>";
                                                        }else{ ?>
                                                        <a href="javascript:void(0);" class="btn-sm btn-success btn-viattr" data-toggle="modal" data-target="#myModal" viattr="<?php echo $vw->ns_id;?>">Close</a>
                                                        <?php } ?>
                                                    </td> 
                                                  </tr> 
                                              <?php
                                              } 
                                        }else{
                                            echo "<tr><td colspan='8'>Data not available.</td></tr>";
                                        }
                                        ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Mobile</th>
                                        <th>Blood Group</th> 
                                        <th>Message</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>  
                        <?php echo $this->ajax_pagination->create_links();?>
                    </div>                
                </div>                
            </form>
        </div>
    </section>
</div>