<table  class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th>Date</th>
            <th>Blood Bank Name</th>
            <th>Type </th>
            <th>Blood Bank Name</th>
            <th>No. of units</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $tot = 0;
        if(count($view) > 0){
                $i = 1;
                foreach($view as $vw){
                        if($vw->category == "Private"){
                                $vep 	=	"cadetblue";
                        }
                        if($vw->category == "Charity"){
                                $vep 	=	"antiquewhite";
                        }
                        if($vw->category == "Government"){
                                $vep 	=	"gold";
                        }
                        if($vw->category == ""){
                                $vep 	=	"";
                        }
                ?>
                 <tr class="<?php echo $vep;?>"> 
                    <td><?php echo $vw->tc_date;?></td>
                    <td><?php echo $vw->tbloodbank_name;?></td>
                    <td><?php echo $vw->mg_val;?></td>
                    <td><?php echo $vw->bloodbank_name;?></td>
                    <td><?php 
                    $tot = $tot+$vw->cnt;
                    echo $vw->cnt;?></td>  
                </tr>  
                <?php
                } 
        }else{
                echo "<tr><td colspan='5'>Collections and Transfers are not available</td></tr>";
        }
        ?>
        <tr>
            <td colspan='4'><b class='pull-right'>Total</b></td><td><b><?php echo $tot;?></b></td>
        </tr>
</tbody>
    <tfoot>
        <tr> 
            <th>Date</th>
            <th>Blood Bank Name</th>
            <th>Type </th>
            <th>Blood Bank Name</th>
            <th>No. of units</th>
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>