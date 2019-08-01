 <table class="table table-striped table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if(count($view)>0){
        $i  =   1;
        foreach($view as $ve){
                ?>
                <tr> 
                    <td><?php echo $i++;?></td>
                    <td><?php echo $ve->patient_first_name." ".$ve->patient_last_name;?></td>
                    <td><?php echo ($ve->patient_gender == 1)?"Female":"Male";?></td>
                    <td><?php echo $ve->brblood_group;?></td> 
                    <td><?php echo $ve->request_remarks;?></td> 
                </tr>
                <?php
        }
    } else {
            echo "<tr><td colspan='6'>No Blood Requests</td></tr>";
    }
    ?>
    </tbody>
    <tfoot>
            <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Blood Group</th>
                <th>Remarks</th> 
            </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>