<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Collection 
            <small>Updating the Blood Collection</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li> 
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
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view("admin/layout/success_error");?>
                        </div> 
                        <div class="col-md-12">
                            <table class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr> 
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
                                            ?>
                                            <tr> 
                                                <td><input type="text" value="<?php echo $out_avail->Apos;?>" class="form-control" name="out_a_pos"/></td>
                                                <td><input type="text" value="<?php echo $out_avail->Aneg;?>" class="form-control" name="out_a_neg"/></td>
                                                <td><input type="text" value="<?php echo $out_avail->Bpos;?>" class="form-control" name="out_b_pos"/></td>
                                                <td><input type="text" value="<?php echo $out_avail->Bneg;?>" class="form-control" name="out_b_neg"/></td>
                                                <td><input type="text" value="<?php echo $out_avail->ABpos;?>" class="form-control" name="out_ab_pos"/></td>
                                                <td><input type="text" value="<?php echo $out_avail->ABneg;?>" class="form-control" name="out_ab_neg"/></td>
                                                <td><input type="text" value="<?php echo $out_avail->Opos;?>" class="form-control" name="out_o_pos"/></td>
                                                <td><input type="text" value="<?php echo $out_avail->Oneg;?>" class="form-control" name="out_o_neg"/></td>
                                              </tr> 
                                            <?php
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