<?php 
$up     =   $this->session->userdata("update-blood-bank-staff");
$dt     =   $this->session->userdata("delete-blood-bank-staff");
$ct     =   '0';
if($up == '1' || $dt == '1'){
        $ct     =   '1';
}
?>
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