<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Blood Bank Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>   
        <?php 
        if(count($view) > 0){
            $i  =   1;
            foreach($view as $vt){
                ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $vt->bloodbank_name;?></td>                                        
                    <td><?php echo $vt->bfin_balance;?></td>                                              
                </tr>
                <?php
            }
        }else{
                echo "<tr><td colspan='4'>Blood Bank Finance Data Not Available</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>S.No.</th>
            <th>Blood Bank Name</th>
            <th>Price</th>  
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>