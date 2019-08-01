<table class="table-striped table table-bordered table-condensed">
    <thead>
        <tr> 
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank Name</th>
            <?php } ?> 
            <th>Blood Unit Number</th>
            <th>Name</th>
            <th>Donation Date</th>
            <th>Expiry Date</th>
            <th>Segment Number</th>
            <th>Volume</th>
            <th>Blood Group</th>
            <th>Screened Date</th>
            <th>HIV</th>
            <th>HBSAG</th>
            <th>HCV</th>
            <th>VDRL</th>
            <th>MP</th>
            <th>Irregular Ab</th>
            <th>Status</th>
            <th>Components / Prepared Date</th>
            <th>Issue No. / Issue Dated</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($view) > 0){
            foreach($view as $vw){
                ?>
                <tr>
                    <?php if($this->session->userdata("login_type") != '5utype') {?>
                    <td><?php echo $vw->bloodbank_name;?></td>
                    <?php } ?>
                    <td><?php echo $vw->blood_unit_num;?></td>
                    <td><?php echo $vw->name;?></td>
                    <td><?php echo $vw->donation_date;?></td>
                    <td><?php echo $vw->expiry_date;?></td>
                    <td><?php echo $vw->segment_num;?></td>
                    <td><?php echo $vw->bbvolume;?></td>
                    <td><?php echo $vw->blood_group;?></td>
                    <td><?php echo date("d-m-Y",strtotime($vw->screening_datetime));?></td>
                    <td><?php echo $vw->test_hiv;?></td>
                    <td><?php echo $vw->test_hbsag;?></td>
                    <td><?php echo $vw->test_vdrl;?></td>
                    <td><?php echo $vw->test_hcv;?></td>
                    <td><?php echo $vw->test_mp;?></td>
                    <td><?php echo $vw->test_irregular_ab;?></td>
                    <td><?php echo $vw->status;?></td>
                    <td><?php echo $vw->component_type." / ".date("d-m-Y",strtotime($vw->components_date));?></td>
                    <td><?php echo $vw->issue_id." / ".date("d-m-Y",strtotime($vw->issue_date));?></td>
                </tr>
                <?php
            }
        }else{
                echo "<tr><td colspan='18'>Blood Component Details are not available</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank Name</th>
            <?php } ?>
            <th>Blood Unit Number</th>
            <th>Donor Name</th>
            <th>Donation Date</th>
            <th>Expiry Date</th>
            <th>Segment Number</th>
            <th>Volume</th>
            <th>Blood Group</th>
            <th>Screened Date</th>
            <th>HIV</th>
            <th>HBSAG</th>
            <th>HCV</th>
            <th>VDRL</th>
            <th>MP</th>
            <th>Irregular Ab</th>
            <th>Status</th>
            <th>Components / Prepared Date</th>
            <th>Issue No. / Issue Dated</th>
        </tr>
    </tfoot>
</table> 