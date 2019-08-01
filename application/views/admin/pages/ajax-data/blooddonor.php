<?php 
$vsp 	=	"";
if($this->session->userdata("login_parent") == "0"){
        $csp 	=	$this->blood_bank_model->get_val();
        $vsp	=	$csp;
} else {
        $vsp    =       $this->session->userdata("login_bloodbank_id");
}
$up     =   $this->session->userdata("update-blood-donation");       
$ct     =   '0';
if($up == '1'){
        $ct     =   '1';
}
?>
<table   class="table table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Donor Id</th>
            <th>Name</th>
            <th>Blood Group</th>
            <th>Mobile No</th> 
            <th>No. of Units</th>
            <th>Donation Date</th>
            <?php if($ct == '1') {?>
            <th>Action</th>
            <?php } ?>
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
                  <?php if($ct == '1') { ?>
                  <td>
                        <?php 
                        if($vw->donation_status == "0"){
                            if($this->session->userdata("login_parent") == "0"){ ?>
                                <a href="<?php echo base_url("admin/edit_blood_donation/".$vw->donation_id);?>" class="btn-success btn-sm">Edit</a>
                        <?php                         
                            } 
                        else {
                                if($vsp == $vw->bloodbank_id){?>
                                <a href="<?php echo base_url("admin/edit_blood_donation/".$vw->donation_id);?>" class="btn-success btn-sm">Edit</a>
                                <?php }
                            }
                        }
                        ?>
                  </td>
                  <?php 
                  }
                  ?>
                </tr> 
                <?php
                } 
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
            <?php if($ct == '1') {?>
            <th>Action</th>
            <?php } ?>
        </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>