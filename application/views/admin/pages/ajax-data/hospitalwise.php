<table class="table-striped table table-bordered">
    <thead>
        <tr> 
            <th>Blood Bank</th>
            <th>Male</th>
            <th>Female</th>
            <th>Total</th>
            <th>A+ve</th>
            <th>A+ve</th>
            <th>B+ve</th>
            <th>B-ve</th>
            <th>AB+ve</th>
            <th>AB-ve</th>
            <th>O+ve</th>
            <th>O-ve</th>
            <th>Rh+ve</th>
            <th>Rh-ve</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($view) > 0){
            foreach($view as $ve){
                ?>
                <tr>  
                    <td><?php echo $ve->bloodbank_name;?></td>  
                    <td><?php echo $ve->male;?></td>  
                    <td><?php echo $ve->female;?></td>  
                    <td><?php echo $ve->total;?></td>  
                    <td><?php echo $ve->Apos;?></td>  
                    <td><?php echo $ve->Aneg;?></td>  
                    <td><?php echo $ve->Bpos;?></td>  
                    <td><?php echo $ve->Bneg;?></td>  
                    <td><?php echo $ve->ABpos;?></td>  
                    <td><?php echo $ve->ABneg;?></td>  
                    <td><?php echo $ve->Opos;?></td>  
                    <td><?php echo $ve->Oneg;?></td>
                    <td><?php echo $ve->Rhpos;?></td>  
                    <td><?php echo $ve->Rhneg;?></td>
                </tr>
                <?php
            }
        }else{
                echo "<tr><td colspan='10'>Blood Issued by Blood Bank details are not available.</td></tr>";
        }
        ?>
    </tbody>
    <tfoot> 
        <tr>
            <th>Blood Bank</th>
            <th>Male</th>
            <th>Female</th>
            <th>Total</th>
            <th>A+ve</th>
            <th>A+ve</th>
            <th>B+ve</th>
            <th>B-ve</th>
            <th>AB+ve</th>
            <th>AB-ve</th>
            <th>O+ve</th>
            <th>O-ve</th>
            <th>Rh+ve</th>
            <th>Rh-ve</th>
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>