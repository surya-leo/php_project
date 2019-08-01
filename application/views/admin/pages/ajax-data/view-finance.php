<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Date</th>
            <th>Available Amount</th>
            <th>Amount</th>
            <th>Type</th>  
            <th>Description</th>  
            <th>Balance</th>   
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
                    <td><?php echo $vt->fin_date;?></td>                                        
                    <td><?php echo $vt->fin_price;?></td>   
                    <td><?php echo $vt->fin_amount;?></td>                                     
                    <td><?php echo $vt->fin_debit_credit;?></td>                                        
                    <td><?php echo $vt->fin_description;?></td>                                        
                    <td><?php echo $vt->fin_after_price;?></td>                                        
                </tr>
                <?php
            }
        }else {
            echo "<tr><td colspan=7>No Finance details Available</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>S.No.</th>
            <th>Date</th>
            <th>Available Amount</th>
            <th>Amount</th>
            <th>Type</th>  
            <th>Description</th>  
            <th>Balance</th>  
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>