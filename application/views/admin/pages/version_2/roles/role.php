<?php 
$up     =   $this->session->userdata("update-role");
$dt     =   $this->session->userdata("delete-role");
$ct     =   '0';
if($up == '1' || $dt == '1'){
        $ct     =   '1';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Roles
            <small>Viewing Roles</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Roles</a></li>
            <li class="active">View Roles</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">View Roles</h3>
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
                                <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewRole/')"/>
                        </div>
                    </div> 
                    <div class="col-sm-12">
                            <div class="postList">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No.</th> 
                                            <th>Role Name</th> 
                                            <th>Status</th>
                                            <?php if($ct == '1'){ ?>
                                            <th class="text-center">Action</th>
                                            <?php } ?>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(count($view) > 0){
                                                $i  =   1;
                                                foreach ($view as $ve){
                                                    ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $i++;?></td> 
                                                        <td><?php echo $ve->ut_name;?></td> 
                                                        <td>Active</td>
                                                        <?php if($ct == '1'){ ?>
                                                        <td class="text-center">
                                                            <?php if($up == '1'){?>
                                                                <a href="<?php echo base_url('admin/update-role/'.$ve->ut_id);?>"  title="Update Role" class="btn-sm btn-success"><i class="fa fa-edit"></i> Edit </a> &nbsp;
                                                            <?php } if($dt == '1'){?>
                                                                <a onclick='javascript:confirmationDelete($(this),"Role");return false;' href="<?php echo base_url('admin/delete-role/'.$ve->ut_id);?>"  title="Delete Role" class="btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                            <?php } ?>
                                                        </td>
                                                        <?php } ?> 
                                                    </tr>
                                                    <?php
                                                }
                                        } else {
                                            if($ct == '1'){ ?>
                                                <tr><th colspan="4">No Roles Available</th></tr>
                                            <?php } else { ?>  
                                                    <tr><th colspan="3">No Roles Available</th></tr>
                                            <?php }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php echo $this->ajax_pagination->create_links();?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </section>
</div>