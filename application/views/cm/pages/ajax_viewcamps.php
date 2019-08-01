<table  class="table table-bordered ">
    <thead>
        <tr>
           <tr>
                <th>S.No.</th>
                <th>Blood Bank Name</th> 
                <th>District</th>
                <th>City</th>
                <th>Camp Name</th>  
                <th>Camp Date</th>  
            </tr>  
        </tr>
    </thead>
    <tbody>
        <?php  
        if(count($view) > 0){
                $i = 1;
                foreach($view as $vw){
                    $vep    =   "red";
                    if($vw->camp_date < date("Y-m-d")){
                            $vep    =   "green";
                    }
                ?>
                <tr class="<?php echo $vep;?>">
                    <td><?php echo $i++;?></td>
                    <td><?php echo $vw->bloodbank_name;?></td>
                    <td><?php echo $vw->district;?></td> 
                    <td><?php echo $vw->city;?></td>
                    <td><?php echo $vw->camp_description;?></td> 
                    <td><?php echo date("d F Y",strtotime($vw->camp_date));?></td> 
                </tr> 
                <?php
                } 
        }else{
                echo "<tr><td colspan='5'>Blood Bank Camps are not available</td></tr>";
        }
        ?>
</tbody>
    <tfoot>
            <tr>
                <th>S.No.</th>
                <th>Blood Bank Name</th> 
                <th>District</th>
                <th>City</th>
                <th>Camp Name</th>  
                <th>Camp Date</th>  
            </tr>
    </tfoot>
    </table>
    <?php echo $this->ajax_pagination->create_links();?>