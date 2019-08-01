<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Appointments
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li class="active">Appointments</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Appointments</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <form class="form-horizontal" method="post" action=""> 
                <div class="box-body">
                    <div class="col-sm-12">
                        <?php $this->load->view("admin/layout/success_error");?>
                    </div> 
                    <div class="col-sm-12">
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewAppoint/')"/>
                        </div>
                    </div>
                    <div class="postList">
<!--                    <table class="table table-bordered table-hover" id="example2">-->
                        <table class="table table-bordered table-hover filterable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Blood Group</th>
                                    <?php if($this->session->userdata("login_parent") == "1"){ ?>
                                    <th>Blood Bank Name</th>
                                    <?php } ?>  
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php  
                                    if(count($view) > 0){
                                            $i = 1;
                                            foreach($view as $vw){ 
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $vw->name;?></td>
                                                <td><?php echo $vw->app_mobile;?></td>
                                                <td><?php echo $vw->date_slot;?></td> 
                                                <td><?php echo $vw->time_slot;?></td> 
                                                <td><?php echo $vw->blood_group;?></td> 
                                                <?php if($this->session->userdata("login_parent") == "1"){ ?>
                                                <td><?php echo $vw->bloodbank_name;?></td> 
                                                <?php } ?>                        
                                                <td><?php echo $vw->app_status;?></td> 
                                              </tr> 
                                          <?php
                                          } 
                                    }else{
                                        echo "<tr><td colspan='7'>Appointments not available.</td></tr>";
                                    }
                                    ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                   <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Blood Group</th>
                                    <?php if($this->session->userdata("login_parent") == "1"){ ?>
                                    <th>Blood Bank Name</th>
                                    <?php } ?>  
                                    <th>Status</th>
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