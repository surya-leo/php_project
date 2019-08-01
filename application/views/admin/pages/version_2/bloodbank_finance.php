<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Finance 
            <small>Viewing Finance</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Finance</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Finance</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div> 
            <!-- /.box-header -->
            <form class="" action="" method="post">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="pull-right"><a href="javascript:void(0);" class="btn btn-sm btn-tumblr">Cash Balance : <?php echo $finance;?></a></div> 
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php $this->load->view("admin/layout/success_error");?>
                        </div>
                        <div class="col-sm-4">
                            <label>Date <span class="text-red">*</span></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" autocomplete="off" id="datepicker" placeholder="Enter Date ..." name="donation_date" value="<?php echo set_value("donation_date");?>">
                            </div>
                            <div class="text-red"><?php echo form_error("donation_date");?></div>
                        </div>
                        <div class="col-sm-4">
                            <label>Amount<span class="text-red">*</span></label>
                            <input type="text" class="form-control pull-right" autocomplete="off" placeholder="Enter Amount..." name="price" value="<?php echo set_value("price");?>">
                            <div class="text-red"><?php echo form_error("price");?></div>
                        </div>
                        <div class="col-sm-4">
                            <label>Type <span class="text-red">*</span></label>
                            <div class="form-group">
                                <div class="radio-inline">
                                    <input type="radio" value="Debited" name="debit_credit" <?php echo set_radio("debit_credit","Debited");?>/> Debited
                                </div>
                                <div class="radio-inline">
                                    <input type="radio" value="Credited" name="debit_credit"  <?php echo set_radio("debit_credit","Credited");?>/> Credited
                                </div>
                            </div> 
                            <div class="text-red"><?php echo form_error("debit_credit");?></div>
                        </div>
                        <div class="col-sm-12"><br/></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description <span class="text-red">*</span></label>
                                <textarea class="form-control" name="description" placeholder="Description"><?php echo set_value("description");?></textarea>
                                <div class="text-red"><?php echo form_error('description');?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-sm btn-success" name="submit" value="Create">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBloodbankFinance/')"/>
                    </div>
                </div>
                <div class="postList">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Date</th>
                                <th>Available Amount</th>
                                <th>Amount</th>
                                <th>Type</th>  
                                <th>Description</th>  
                                <th>Balance</th>   
                            </tr>
                        </thead>
                        <tbody>   
                            <?php 
                            if(count($view) > 0){
                                $i  =   1;
                                foreach($view as $vt){
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $vt->fin_date;?></td>                                        
                                        <td><?php echo $vt->fin_price;?></td>   
                                        <td><?php echo $vt->fin_amount;?></td>                                     
                                        <td><?php echo $vt->fin_debit_credit;?></td>                                        
                                        <td><?php echo $vt->fin_description;?></td>                                        
                                        <td><?php echo $vt->fin_after_price;?></td>                                        
                                    </tr>
                                    <?php
                                }
                            }else {
                            	echo "<tr><td colspan=7>No Finance details Available</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Date</th>
                                <th>Available Amount</th>
                                <th>Amount</th>
                                <th>Type</th>  
                                <th>Description</th>  
                                <th>Balance</th>  
                            </tr>
                        </tfoot>
                    </table>
                    <?php echo $this->ajax_pagination->create_links();?>
                </div>
            </div>
        </div>
    </section>
</div>