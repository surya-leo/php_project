<table class="table-striped table table-bordered table-condensed">
    <thead>
        <tr>
            <th>Date</th>
            <th>Blood Bank</th>
            <th>Blood Unit Number</th>
            <th>Donor Id</th>
            <th>Donor Name</th>
            <th>Blood Group</th>
            <th>ANTI A</th>
            <th>ANTI B</th>
            <th>ANTI AB</th>
            <th>ANTI D</th>
            <th>A Cells</th>
            <th>B Cells</th>
            <th>O Cells</th>
            <th>Du</th>
            <th>Forwarded By</th>
            <th>Reverse By</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if(count($view) > 0){
        foreach ($view as $ve){
            ?> 
        <tr>
            <td><?php echo $ve->grouping_date;?></td>
            <td><?php echo $ve->bloodbank_name;?></td>
            <td><?php echo $ve->blood_unit_num;?></td>
            <td><?php echo $ve->donor_id;?></td>
            <td><?php echo $ve->name;?></td> 
            <td><?php echo $ve->blood_group?></td>  
            <td><?php echo $ve->anti_a;?></td>
            <td><?php echo $ve->anti_b;?></td>
            <td><?php echo $ve->anti_ab;?></td>
            <td><?php echo $ve->anti_d;?></td>
            <td><?php echo $ve->a_cells;?></td>
            <td><?php echo $ve->b_cells;?></td>
            <td><?php echo $ve->o_cells;?></td>
            <td><?php echo $ve->du;?></td>
            <td><?php echo $ve->forward_staff_name;?></td>
            <td><?php echo $ve->reverse_staff_name;?></td>
        </tr> 
            <?php
        }
    }else{
            echo "<tr><td colspan='15'>Blood Grouping Details are not available</td></tr>";
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Date</th>
            <th>Blood Bank </th>
            <th>Blood Unit Number</th>
            <th>Donor Id</th>
            <th>Donor Name</th>
            <th>Blood Group</th>
            <th>ANTI A</th>
            <th>ANTI B</th>
            <th>ANTI AB</th>
            <th>ANTI D</th>
            <th>A Cells</th>
            <th>B Cells</th>
            <th>O Cells</th>
            <th>Du</th>
            <th>Forwarded By</th>
            <th>Reverse By</th>
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>