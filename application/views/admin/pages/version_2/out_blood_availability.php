<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Availability 
            <small>Updating the Blood Availability</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li class="active">Blood Availability</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Availability</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="" method="post" action="">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view("admin/layout/success_error");?>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date <span class="text-red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>" >
                                </div>
                                <div class="text-red"><?php echo form_error("donation_date");?></div>
                            </div>
            			</div> 
                        <div class="col-md-12">
                            <table class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Components</th>
                                        <th>A +ve</th>
                                        <th>A -ve</th>
                                        <th>B +ve</th>
                                        <th>B -ve</th>
                                        <th>AB +ve</th>
                                        <th>AB -ve</th>
                                        <th>O +ve</th>
                                        <th>O -ve</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if(count($out_avail) > 0){
                                        foreach($out_avail as $bg1){ 
                                            ?>
                                            <tr>
                                                <td><?php echo $bg1->bc_name;?></td> 
                                                <td><input type="text" value="<?php echo $bg1->out_a_pos;?>" class="form-control" name="out_a_pos[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                                <td><input type="text" value="<?php echo $bg1->out_a_neg;?>" class="form-control" name="out_a_neg[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                                <td><input type="text" value="<?php echo $bg1->out_b_pos;?>" class="form-control" name="out_b_pos[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                                <td><input type="text" value="<?php echo $bg1->out_b_neg;?>" class="form-control" name="out_b_neg[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                                <td><input type="text" value="<?php echo $bg1->out_ab_pos;?>" class="form-control" name="out_ab_pos[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                                <td><input type="text" value="<?php echo $bg1->out_ab_neg;?>" class="form-control" name="out_ab_neg[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                                <td><input type="text" value="<?php echo $bg1->out_o_pos;?>" class="form-control" name="out_o_pos[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                                <td><input type="text" value="<?php echo $bg1->out_o_neg;?>" class="form-control" name="out_o_neg[<?php echo $bg1->bc_id;?>]" maxlength="3"/></td>
                                              </tr> 
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-md-offset-3">
                                <button type="submit" class="btn  btn-success" name="submit" value="Create">Save</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>