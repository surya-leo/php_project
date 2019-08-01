 <table class="table table-bordered table-hover">
    <thead>
        <tr>
          <th>S.No.</th>
          <th>Camp Name</th> 
          <th>Blood Bank Name</th> 
          <th>District</th> 
          <th>City</th> 
          <th>No. of Donors</th>  
        </tr>
    </thead>
    <tbody>
        <?php  
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
                    <td><?php echo $i++;?></td>
                    <td><?php echo $vw->camp_description;?></td> 
                    <td><?php echo $vw->bloodbank_name;?></td> 
                    <td><?php echo $vw->district;?></td> 
                    <td><?php echo $vw->city;?></td> 
                    <td><?php echo $vw->cnt;?></td> 
                </tr> 
                <?php
                } 
        }else {
                echo "<tr><td colspan='6'>Camp Donor details are not available</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>S.No.</th>
            <th>Camp Name</th>  
            <th>Blood Bank Name</th> 
            <th>District</th> 
            <th>City</th>
            <th>No. of Donors</th> 
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>