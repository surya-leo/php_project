<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Finance
            <small>Viewing the Finance of Blood Banks</small>
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
            <form class="form-horizontal" method="post" action=""> 
                <div class="box-body"> 
                    <div class="col-sm-12">
                        <div class="form-group pull-right"> 
                            <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo base_url(); ?>admin/viewFinance/')"/>
                        </div>
                    </div>
                    <div class="postList">
                        <table class="table table-bordered table-hover filterable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Blood Bank Name</th>
                                    <th>Price</th>
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
                                            <td><?php echo $vt->bloodbank_name;?></td>                                        
                                            <td><?php echo $vt->bfin_balance;?></td>                                              
                                        </tr>
                                        <?php
                                    }
                                } else{
                                        echo "<tr><td colspan='4'>Blood Bank Finance Data Not Available</td></tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Blood Bank Name</th>
                                    <th>Price</th>  
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