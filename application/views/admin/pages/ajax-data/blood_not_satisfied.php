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
                      </tr> 
                  <?php
                  } 
            }else{
                echo "<tr><td colspan='7'>Data not available.</td></tr>";
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
        </tr>
    </tfoot>
</table>  
<?php echo $this->ajax_pagination->create_links();?>