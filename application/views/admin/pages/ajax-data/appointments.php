<table class="table table-bordered table-hover filterable">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Date</th>
            <th>Time</th>
            <th>Blood Group</th>
            <?php if($this->session->userdata("login_parent") == "1"){ ?>
            <th>Blood Bank Name</th>
            <?php } ?>  
            <th>Status</th>
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
                        <td><?php echo $vw->name;?></td>
                        <td><?php echo $vw->app_mobile;?></td>
                        <td><?php echo $vw->date_slot;?></td> 
                        <td><?php echo $vw->time_slot;?></td> 
                        <td><?php echo $vw->blood_group;?></td> 
                        <?php if($this->session->userdata("login_parent") == "1"){ ?>
                        <td><?php echo $vw->bloodbank_name;?></td> 
                        <?php } ?>                        
                        <td><?php echo $vw->app_status;?></td> 
                      </tr> 
                  <?php
                  } 
            }else{
                echo "<tr><td colspan='7'>Appointments not available.</td></tr>";
            }
            ?>
    </tbody>
    <tfoot>
        <tr>
           <th>S.No.</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Date</th>
            <th>Time</th>
            <th>Blood Group</th>
            <?php if($this->session->userdata("login_parent") == "1"){ ?>
            <th>Blood Bank Name</th>
            <?php } ?>  
            <th>Status</th>
        </tr>
    </tfoot>
</table>  
<?php echo $this->ajax_pagination->create_links();?>