<table class="table table-striped table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <th>S.No.</th> 
            <th>Blood Bank Name</th>
            <th>No of Requests</th> 
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
                    <td><?php echo $ve->bloodbank_name;?></td> 
                    <td><?php echo $ve->cnt;?></td> 
                </tr>
                <?php
        }
    } else {
            echo "<tr><td colspan='6'>No Data Available</td></tr>";
    }
    ?>
    </tbody>
    <tfoot>
            <tr>
                <th>S.No.</th>
                <th>Blood Bank Name</th>
                <th>No of Requests</th> 
            </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>