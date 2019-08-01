<table class="table-striped table table-bordered">
    <thead>
        <tr> 
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank</th>
            <?php } ?>    
            <th>Issue Date</th>
            <th>Total</th>
            <th>A+ve</th>
            <th>A+ve</th>
            <th>B+ve</th>
            <th>B-ve</th>
            <th>AB+ve</th>
            <th>AB-ve</th>
            <th>O+ve</th>
            <th>O-ve</th> 
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($view) > 0){
            foreach($view as $ve){
                ?>
                <tr>  
                    <?php if($this->session->userdata("login_type") != '5utype') {?>
                    <td><?php echo $ve->bloodbank_name;?></td>
                    <?php } ?>
                    <td><?php echo date("Y-m-d", strtotime($ve->issue_date));?></td>  
                    <td><?php echo $ve->total;?></td>  
                    <td><?php echo $ve->Apos;?></td>  
                    <td><?php echo $ve->Aneg;?></td>  
                    <td><?php echo $ve->Bpos;?></td>  
                    <td><?php echo $ve->Bneg;?></td>  
                    <td><?php echo $ve->ABpos;?></td>  
                    <td><?php echo $ve->ABneg;?></td>  
                    <td><?php echo $ve->Opos;?></td>  
                    <td><?php echo $ve->Oneg;?></td>  
                </tr>
                <?php
            }
        }else{
                echo "<tr><td colspan='15'>Blood Issued Summary details are not available.</td></tr>";
        }
        ?>
    </tbody>
    <tfoot> 
        <tr> 
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank</th>
            <?php } ?>
            <th>Issue Date</th>
            <th>Total</th>
            <th>A+ve</th>
            <th>A+ve</th>
            <th>B+ve</th>
            <th>B-ve</th>
            <th>AB+ve</th>
            <th>AB-ve</th>
            <th>O+ve</th>
            <th>O-ve</th> 
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>