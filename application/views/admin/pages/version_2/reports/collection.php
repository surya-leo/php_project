<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Collection 
            <small>Viewing the Blood Collected details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Transfer & Collection Reports</a></li>
            <li class="active">Blood Collection</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Collection</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="" method="post" action="">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2">From and To Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>admin/viewCollection/" /> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewCollection/')"/>
                        </div>
                    </div>
                    <div class="postList">
                        <table class="table-striped table table-bordered">
                                <thead>
                                    <tr> 
                                        <th>Date</th>
                                        <th>Blood Bank Name</th>
                                        <th>No. of Donors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if(count($view) > 0){
                                    foreach ($view as $ve){
                                        ?>
                                    <tr>
                                        <td><?php echo $ve->tc_date;?></td>
                                        <td><?php echo $ve->bloodbank_name;?></td>
                                        <td><?php echo $ve->cnt;?></td>  
                                    </tr> 
                                        <?php
                                    }
                                }else{
                                        echo "<tr><td colspan='5'>Blood Collection details are not available</td></tr>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr> 
                                        <th>Date</th>
                                        <th>Blood Bank Name</th>
                                        <th>No. of Donors</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php echo $this->ajax_pagination->create_links();?>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
