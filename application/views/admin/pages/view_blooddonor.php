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
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View Blood Donor Details 
            <small>View Blood Donor</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Donor Details</a></li>
            <li class="active">View</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">View Blood Donor Details</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBlooddonor/')"/>
                    </div>
                </div>
                <div class="postList">
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
                                      <?php if($ct == '1') {?>
                                      <td>
                                            <?php if($this->session->userdata("login_parent") == "0"){ ?>
                                            <a href="<?php echo base_url("admin/edit_blood_donation/".$vw->donation_id);?>" class="btn-success btn-sm">Edit</a>
                                            <?php } else {
                                                    if($vsp == $vw->bloodbank_id){?>
                                                    <a href="<?php echo base_url("admin/edit_blood_donation/".$vw->donation_id);?>" class="btn-success btn-sm">Edit</a>
                                                    <?php }
                                            }?>
                                      </td>
                                      <?php } ?>
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
                </div>
            </div>
        </div>
    </section>
</div>