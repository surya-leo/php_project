<table   class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Donor Id</th>
            <th>Name</th>
            <th>Blood Group</th>
            <th>Mobile No</th> 
            <th>No. of Units</th>
            <th>Donation Date</th> 
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($view) > 0){
                $i 	= 1;
                foreach($view as $vw){
                ?>
                <tr>
                  <td><?php echo $i++;?></td>						  
                  <td><?php echo $vw->donor_id;?></td>						  
                  <td><?php echo $vw->name;?></td>
                  <td><?php echo $vw->blood_group;?></td>
                  <td><?php echo $vw->mobile;?></td>
                  <td><?php echo $vw->volume;?></td>
                  <td><?php echo $vw->donation_date;?></td> 
                  <td> 
                        <a href="<?php echo base_url("admin/donor_medical_checkup/".$vw->donation_id);?>" class="btn-success btn-sm">Component Preparation</a> 
                  </td>
                  <?php } ?>
                </tr> 
                <?php  
        }else{
                echo "<tr><td colspan='8'>Blood Donors not availabe.</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>S.No.</th>
            <th>Donor Id</th>
            <th>Name</th>
            <th>Blood Group</th>
            <th>Mobile No</th> 
            <th>Volume</th>
            <th>Donation Date</th> 
            <th>Action</th> 
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>