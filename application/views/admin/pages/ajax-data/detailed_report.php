<table class="table-striped table table-bordered">
    <thead>
        <tr> 
            <th>Issue Date</th> 
            <th>Issue Time</th> 
            <th>Blood Bag Number</th> 
            <th>Component</th> 
            <th>Patient Name</th> 
            <th>Patient Blood Group</th> 
            <th>Patient Diagnosis</th> 
            <th>Hospital Name</th> 
            <th>Donor Name</th> 
            <th>Donor Blood Group</th> 
            <th>Quantity of Blood</th> 
            <th>Blood Bank Name</th> 
            <th>Issued By</th> 
            <th>Cross Matched By</th> 
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($view) > 0){
            foreach($view as $vw){
                ?>
                <tr>
                    <td><?php echo date("d-m-Y",strtotime($vw->issue_date));?></td>
                    <td><?php echo $vw->issue_time;?></td>
                    <td><?php echo $vw->blood_unit_num;?></td>
                    <td><?php echo $vw->component_type;?></td>
                    <td><?php echo $vw->patient_name;?></td>  
                    <td><?php echo $vw->brblood_group;?></td>  
                    <td><?php echo $vw->patient_diagnosis;?></td>  
                    <td><?php echo $vw->hospital;?></td>   
                    <td><?php echo $vw->name;?></td> 
                    <td><?php echo $vw->blood_group;?></td>   
                    <td><?php echo $vw->bivolume;?></td>    
                    <td><?php echo $vw->bloodbank_name;?></td>    
                    <td><?php echo $vw->issued_staff_name;?></td>    
                    <td><?php echo $vw->issued_staff_name;?></td>    
                </tr>
                <?php
            }
        }else{
                echo "<tr><td colspan='18'>Blood Issued Details are not available</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Issue Date</th> 
            <th>Issue Time</th> 
            <th>Blood Bag Number</th> 
            <th>Component</th> 
            <th>Patient Name</th> 
            <th>Patient Blood Group</th> 
            <th>Patient Diagnosis</th> 
            <th>Hospital Name</th> 
            <th>Donor Name</th> 
            <th>Donor Blood Group</th> 
            <th>Quantity of Blood</th> 
            <th>Blood Bank Name</th> 
            <th>Issued By</th> 
            <th>Cross Matched By</th> 
        </tr>
    </tfoot>
</table> 
<?php echo $this->ajax_pagination->create_links();?>