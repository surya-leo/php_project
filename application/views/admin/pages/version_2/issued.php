<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Issue Details
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Blood Issue Details</a></li>
            <li class="active">Blood Issue Details</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Issue Details</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div> 
            <form class="" method="post" action="<?php echo base_url('admin/issue_submit/'.$this->uri->segment(3));?>">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <?php if(count($donors) > 0){ ?>
                        <div class="col-sm-12"> 
                            <a class="btn btn-success" href="javascript:void(0);" onclick="printDiv();">Print</a>
                        </div> 
                        <div class="col-sm-12"><br/></div>
                        <?php 
                            foreach($donors as $donor){ ?>
                        <div id="print-div" class="col-md-12">
                            <table class="table table-striped table-bordered"> 
				<tr>
					<th colspan="1" align="center">
						Blood Bank
					</th>
                                        <td colspan="3">
                                            <?php echo $donor->bloodbank_name;?>
                                        </td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						Issue Register
					</td>
				</tr>
				<tr>
					<th>Issue ID</th>
					<td><?php echo $donor->issue_id; ?></td>
					<th>Date & Time of Issue</th>
					<td><?php echo date("d-M-Y",strtotime($donor->issue_date));?> <?php echo date("g:ia",strtotime($donor->issue_time));?></td>
				</tr>
				<tr>
					<th>Name of Recipient</th>
					<td><?php echo $donor->patient_first_name." ".$donor->patient_last_name;?></td>
					<th>Hospital</th>
					<td><?php echo $donor->hospital;?></td>
				</tr>
				<tr>
					<th>Blood Unit Num.</th>
					<td><?php echo $donor->blood_unit_num;?></td>
					<th>Segment Num</th>
					<td><?php echo $donor->segment_num;?></td>
				</tr>
                                <tr>
					<th>Component</th>
					<td><?php echo $donor->component_type;?></td>
					<th>Quantity</th>
					<td><?php echo $donor->volume;?>ml</td>
				</tr>
				<tr>
					<th>Blood Group</th>
					<td><?php echo $donor->blood_group;?></td>
					<th>Recipient Blood Group</th>
					<td><?php echo $donor->recipient_group;?></td>
				</tr>
				<tr>
					<th>Indication for Cross Matching</th>
					<td><?php echo $donor->patient_diagnosis;?></td>
					<th>Cross matching No. and Date</th>
					<td><?php echo date("d-M-Y",strtotime($donor->issue_date));?></td>
				</tr>
				<tr>
					<th>Details of Cross Matching</th>
					<td colspan="3">
                                            <table class="table table-bordered">
							<tr>
								<td>Saline Technique</td>
								<td width="90px">Compatible</td>
							</tr>
							<tr>
								<td>Bovine Abumin Test</td>
								<td>Compatible</td>
							</tr>
							<tr>
								<td>Gel Technique</td>
								<td>Compatible</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">
                                            <div class="checkbox-inline">
                                                <label class="col-sm-6"><input type="checkbox" class="checkbox">Free </label>
                                                <label class="col-sm-6"><input type="checkbox"> Paid </label></div>
					</td>
                                        <td>Amount (<i class="fa fa-inr"></i>)</td>
					<td></td>
				</tr>
				<tr>
					<th>Signature of Recipient</th>
					<td width="100px"></td>
					<th>Signature of Technician</th>
					<td></td>
				</tr>
				<tr>
					<th>Signature of Medical Officer</th>
					<td colspan="3"></td>
				</tr>
                            </table>
                        </div>
                        <?php }
                        }?>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                            <?php 
                            if(count($donors) > 0 ){ ?>
                                <tr>
                                    <th colspan="3">Issued Donors List</th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Mobile No.</th>
                                </tr>
                                <?php
                                foreach($donors as $donor){ ?>
                                <tr>
                                        <td><?php echo $donor->name;?></td>
                                        <td><?php echo ($donor->sex == "M")?"Male":"Female";?></td>
                                        <td><?php echo $donor->mobile;?></td>
                                </tr>
                                <?php }
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>