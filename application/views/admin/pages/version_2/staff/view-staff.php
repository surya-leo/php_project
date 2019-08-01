<?php 
$up     =   $this->session->userdata("update-blood-bank-staff");
$dt     =   $this->session->userdata("delete-blood-bank-staff");
$ct     =   '0';
if($up == '1' || $dt == '1'){
        $ct     =   '1';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Staff
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Staff Details</a></li>
            <li class="active">Staff</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Staff</h3>
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
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewStaff/')"/>
                        </div>
                    </div>
                    <div class="postList">
<!--                    <table class="table table-bordered table-hover" id="example2">-->
                        <table class="table table-bordered table-hover filterable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Blood Group</th>
                                    <?php if($this->session->userdata("login_parent") == "1"){ ?>
                                    <th>Blood Bank Name</th>
                                    <?php } ?>
                                    <th>District</th>
                                    <th>City</th>
                                    <?php if($ct == '1'){ ?>
                                    <th class="text-center">Action</th>
                                    <?php } ?> 
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
                                                <td><?php echo $vw->first_name." ".$vw->last_name;?></td>
                                                <td><?php echo $vw->login_email;?></td> 
                                                <td><?php echo $vw->blood_group_name;?></td> 
                                                <?php if($this->session->userdata("login_parent") == "1"){ ?>
                                                <td><?php echo $vw->bloodbank_name;?></td> 
                                                <?php } ?>
                                                <td><?php echo $vw->district;?></td> 
                                                <td><?php echo $vw->city;?></td> 
                                                <?php if($ct == '1'){ ?>
                                                <td class="text-center">
                                                    <?php if($up == '1'){?>
                                                        <a href="<?php echo base_url('admin/update-staff/'.$vw->login_id);?>"  title="Update Role" class="btn-sm btn-success"><i class="fa fa-edit"></i> Edit </a> &nbsp;
                                                    <?php } if($dt == '1'){?>
                                                        <a onclick='javascript:confirmationDelete($(this),"Staff");return false;' href="<?php echo base_url('admin/delete-staff/'.$vw->login_id);?>"  title="Delete Role" class="btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                    <?php } ?>
                                                </td>
                                                <?php } ?> 
                                              </tr> 
                                          <?php
                                          } 
                                    }else{
                                        echo "<tr><td colspan='7'>Staff not available.</td></tr>";
                                    }
                                    ?>
                            </tbody>
                            <tfoot>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Blood Group</th>
                                    <?php if($this->session->userdata("login_parent") == "1"){ ?>
                                    <th>Blood Bank Name</th>
                                    <?php } ?>
                                    <th>District</th>
                                    <th>City</th>
                                    <?php if($ct == '1'){ ?>
                                    <th class="text-center">Action</th>
                                    <?php } ?> 
                            </tfoot>
                        </table>  
                        <?php echo $this->ajax_pagination->create_links();?>
                    </div>                
                </div>                
            </form>
        </div>
    </section>
</div>