<table class="table-striped table table-bordered">
    <thead>
        <tr>  
            <th>S.No.</th>
            <th>Blood Bank Name</th> 
            <th>District</th>
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
        $i = $limit;
        foreach ($view as $ve){
            $venotes    =   $ve->notes;
            if($ve->expiry_date < date("Y-m-d")){
                $venotes  =   "Expired";
            }
            ?>   
            <td><?php echo $i++;?></td>
            <td><?php echo $ve->bloodbank_name;?></td> 
            <td><?php echo $ve->district;?></td> 
            <td><?php echo $ve->blood_unit_num;?></td> 
            <td><?php echo $ve->blood_group?></td>  
            <td><?php echo $ve->component_type;?></td>
            <td><?php echo $ve->expiry_date;?></td> 
            <td><?php echo $venotes;?></td>  
        </tr> 
            <?php
        }
    }else{
            echo "<tr><td colspan='6'>Blood Expiry details are not available</td></tr>";
    }
    ?>
    </tbody>
    <tfoot>
        <tr>  
            <th>S.No.</th>
            <th>Blood Bank Name</th> 
            <th>District</th>
            <th>Blood Unit Number</th>  
            <th>Blood Group</th> 
            <th>Component Type</th> 
            <th>Expiry Date</th> 
            <th>Reason</th>
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>