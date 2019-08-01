<?php 
$vsp 	=	"";
if($this->session->userdata("login_parent") == "0"){
        $csp 	=	$this->blood_bank_model->get_val();
        $vsp	=	$csp;
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
                <div class="col-md-12">
                    <?php $this->load->view("admin/layout/success_error");?>
                </div>
                <div class="col-md-4">
                    <label>Bulk Preparation</label>
                    <div class="form-group pull-right"> 
                        <select class="form-control bulk_preparation">
                            <option value="">Select Bulk Preparation</option>
                            <option value="2">Grouping</option>
                            <option value="3">Component Preparation</option>
                            <option value="4">Screening</option>
                        </select>
                    </div>
                </div>
                <div class="col_prepare">
                    <div class="col-sm-12">
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewDonors/')"/>
                        </div>
                    </div>
                    <div class="postList">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>