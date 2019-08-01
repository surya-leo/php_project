<?php 
$up     =   $this->session->userdata("update-employee");
$dt     =   $this->session->userdata("delete-employee");
$ct     =   '0';
if($up == '1' || $dt == '1'){
        $ct     =   '1';
}
?>
<table class="table table-striped table-bordered table-hover table-checkable order-column">
    <thead>
        <tr>
            <th class="text-center">S.No.</th> 
            <th>Name</th> 
            <th>Email Id</th> 
            <th>Mobile No.</th> 
            <th>Role Name</th> 
            <th>Blood Group</th> 
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
                        <td><?php echo $ve->first_name." ".$ve->last_name;?></td>  
                        <td><?php echo $ve->login_email;?></td>  
                        <td><?php echo $ve->mobile_no;?></td>  
                        <td><?php echo $ve->ut_name;?></td>  
                        <td><?php echo $ve->blood_group_name;?></td>  
                        <?php if($ct == '1'){ ?>
                        <td class="text-center">
                            <?php if($up == '1'){?>
                                <a href="<?php echo base_url('admin/update-employee/'.$ve->login_id);?>"  title="Update Employee" class="btn-sm btn-success"><i class="fa fa-edit"></i> Edit </a> &nbsp;
                            <?php } if($dt == '1'){?>
                                <a onclick='javascript:confirmationDelete($(this),"Employee");return false;' href="<?php echo base_url('admin/delete-employee/'.$ve->login_id);?>"  title="Delete Employee" class="btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php } ?>
                        </td>
                        <?php } ?> 
                    </tr>
                    <?php
                }
        } else {
            if($ct == '1'){ ?>
                    <tr><th colspan="6">No Employees Available</th></tr>
            <?php } else { ?>  
                    <tr><th colspan="5">No Employees Available</th></tr>
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