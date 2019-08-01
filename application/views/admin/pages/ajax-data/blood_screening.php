<table class="table-striped table table-bordered table-condensed">
    <thead>
        <tr>
            <th>Date</th>
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank Name</th>
            <?php } ?>
            <th>Blood Unit Number</th>
            <th>Donor Name</th>
            <th>Blood Group</th>
            <th>HIV</th>
            <th>HBSAG</th>
            <th>HCV</th>
            <th>VDRL</th>
            <th>MP</th>
            <th>Irregular Ab</th>
            <th>Screened By</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($view) > 0){
            foreach($view as $ve){
                ?>
                <tr>
                    <td><?php echo date("Y-m-d",strtotime($ve->screening_datetime));?></td>
                    <?php if($this->session->userdata("login_type") != '5utype') {?>
                        <td><?php echo $ve->bloodbank_name;?></td>
                    <?php } ?>
                    <td><?php echo $ve->blood_unit_num;?></td>
                    <td><?php echo $ve->name;?></td>
                    <td><?php echo $ve->blood_group;?></td>
                    <td><?php echo $ve->test_hiv;?></td> 
                    <td><?php echo $ve->test_hbsag;?></td> 
                    <td><?php echo $ve->test_hcv;?></td> 
                    <td><?php echo $ve->test_vdrl;?></td> 
                    <td><?php echo $ve->test_mp;?></td> 
                    <td><?php echo $ve->test_irregular_ab;?></td> 
                    <td><?php echo $ve->scre_staff_name;?></td>
                </tr>
                <?php
            }
        }else{
                echo "<tr><td colspan='12'>Blood Screening details are not available.</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Date</th>
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank Name</th>
            <?php } ?>
            <th>Blood Unit Number</th>
            <th>Donor Name</th>
            <th>Blood Group</th>
            <th>HIV</th>
            <th>HBSAG</th>
            <th>HCV</th>
            <th>VDRL</th>
            <th>MP</th>
            <th>Irregular Ab</th>
            <th>Screened By</th>
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>