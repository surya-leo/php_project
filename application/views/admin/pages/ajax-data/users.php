<table class="table table-bordered table-hover filterable">
    <thead>
        <tr>  
          <th>Mobile No</th>
          <th>Name</th>
          <th>Age</th> 
          <th>Gender</th> 
          <th>Location</th> 
          <th>Blood Group</th> 
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($view) > 0){
                foreach($view as $vw){
                ?>
                <tr>  
                  <td><?php echo $vw->mobile;?></td>
                  <td><?php echo ($vw->name)?$vw->name:"N/A";?></td>
                  <td><?php echo ($vw->age)?$vw->age:"N/A";?></td> 
                  <td><?php echo ($vw->sex)?$vw->sex:"N/A";?></td> 
                  <td><?php echo ($vw->location)?$vw->location:"N/A";?></td> 
                  <td><?php echo ($vw->blood_group)?$vw->blood_group:"N/A";?></td> 
                </tr> 
                <?php
                } 
        }else{
                echo "<tr><td colspan='6'>Users data not available</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>  
          <th>Mobile No</th>
          <th>Name</th>
          <th>Age</th> 
          <th>Gender</th> 
          <th>Location</th> 
          <th>Blood Group</th> 
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>