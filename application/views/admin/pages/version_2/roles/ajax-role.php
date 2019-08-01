<?php 
$up     =   $this->session->userdata("update-role");
$dt     =   $this->session->userdata("delete-role");
$ct     =   '0';
if($up == '1' || $dt == '1'){
        $ct     =   '1';
}
?>
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