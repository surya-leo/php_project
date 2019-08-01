<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Grouping
            <small>Viewing Blood Grouping Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Reports</a></li>
            <li class="active">Blood Grouping</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blood Grouping Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">  
                 <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-2">From and To Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>admin/viewBloodGrouping/" /> 
                        </div>  
                        <label class="col-sm-2">Blood Bank</label>
                        <div class="col-sm-4">
                            <select class="form-control searbloodbank_id" name="bloodbank_id" onchange="search_summary('<?php echo base_url(); ?>admin/viewBloodGrouping/')">
                                <option value="">Select Blood Bank</option>
                                <option value="All">All Blood Bank</option>
                                <?php 
                                if(count($blood_bank) > 0){
                                    foreach ($blood_bank as $bb){
                                        ?>
                                        <option value="<?php echo $bb->bloodbank_id;?>"><?php echo $bb->bloodbank_name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>  
                    </div> 
                </form> 
                <div class="col-sm-12">
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewBloodGrouping/')"/>
                    </div>
                </div>
                <div class="postList">  
                    <table class="table-striped table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Blood Bank </th>
                                <th>Blood Unit Number</th>
                                <th>Donor Id</th>
                                <th>Donor Name</th>
                                <th>Blood Group</th>
                                <th>ANTI A</th>
                                <th>ANTI B</th>
                                <th>ANTI AB</th>
                                <th>ANTI D</th>
                                <th>A Cells</th>
                                <th>B Cells</th>
                                <th>O Cells</th>
                                <th>Du</th>
                                <th>Forwarded By</th>
                                <th>Reverse By</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if(count($view) > 0){
                            foreach ($view as $ve){
                                ?> 
                            <tr>
                                <td><?php echo $ve->grouping_date;?></td>
                                <td><?php echo $ve->bloodbank_name;?></td>
                                <td><?php echo $ve->blood_unit_num;?></td>
                                <td><?php echo $ve->donor_id;?></td>
                                <td><?php echo $ve->name;?></td> 
                                <td><?php echo $ve->blood_group?></td>  
                                <td><?php echo $ve->anti_a;?></td>
                                <td><?php echo $ve->anti_b;?></td>
                                <td><?php echo $ve->anti_ab;?></td>
                                <td><?php echo $ve->anti_d;?></td>
                                <td><?php echo $ve->a_cells;?></td>
                                <td><?php echo $ve->b_cells;?></td>
                                <td><?php echo $ve->o_cells;?></td>
                                <td><?php echo $ve->du;?></td>
                                <td><?php echo $ve->forward_staff_name;?></td>
                                <td><?php echo $ve->reverse_staff_name;?></td>
                            </tr> 
                                <?php
                            }
                        }else{
                                echo "<tr><td colspan='15'>Blood Grouping Details are not available</td></tr>";
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Blood Bank Name</th>
                                <th>Blood Unit Number</th>
                                <th>Donor Id</th>
                                <th>Donor Name</th>
                                <th>Blood Group</th>
                                <th>ANTI A</th>
                                <th>ANTI B</th>
                                <th>ANTI AB</th>
                                <th>ANTI D</th>
                                <th>A Cells</th>
                                <th>B Cells</th>
                                <th>O Cells</th>
                                <th>Du</th>
                                <th>Forwarded By</th>
                                <th>Reverse By</th>
                            </tr>
                        </tfoot>
                    </table>
                    <?php echo $this->ajax_pagination->create_links();?>
                </div>
            </div>
        </div>
    </section>
</div>