<table class="table-striped table table-bordered">
    <thead>
        <tr> 
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank Name</th>
            <?php } ?>
            <th>Blood Unit Number</th>  
            <th>Blood Group</th> 
            <th>Component Type</th> 
            <th>Expiry Date</th> 
            <th>Reason</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if(count($view) > 0){
        foreach ($view as $ve){
            $venotes    =   $ve->notes; 
            ?>  
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <td><?php echo $ve->bloodbank_name;?></td>
            <?php } ?>
            <td><?php echo $ve->blood_unit_num;?></td> 
            <td><?php echo $ve->blood_group?></td>  
            <td><?php echo $ve->component_type;?></td>
            <td><?php echo $ve->expiry_date;?></td> 
            <td><?php 
            if($venotes != ''){
                echo $venotes;
            }else{ ?>
                <a href="javascript:void(0);" class="btn btn-info btn-xs" data-toggle="modal" data-target="#reason_idyModal" onclick="reason_by('<?php echo $ve->inventory_id;?>')">Close</a>
            <?php }
            ?></td>  
        </tr> 
            <?php
        }
    }else{
            echo "<tr><td colspan='5'>Blood Discarded details are not available</td></tr>";
    }
    ?>
    </tbody>
    <tfoot>
        <tr> 
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank Name</th>
            <?php } ?>
            <th>Blood Unit Number</th>  
            <th>Blood Group</th> 
            <th>Component Type</th> 
            <th>Expiry Date</th> 
            <th>Reason</th> 
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>