<div class="content-wrapper">
    <section class="content-header">
        <h1>Permissions<small>Managing Permissions</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Permissions</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Permissions</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
                <div class="box-body">
            <form method="post" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view("admin/layout/success_error");?>
                        </div>
                        <div class="col-md-12">                   
                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>	
                                        <th>Pages</th>
                                    <?php 
                                        $i = count($user);  $j = 0;
                                        if(count($user) > 0) {
                                            foreach($user as $us){
                                                ?>
                                                <th><?php echo $us->ut_name;?></th>
                                                <?php
                                            }
                                        }
                                    ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $sko = array();
                                        foreach($shares as $sh){
                                            $sko[$sh->detail] = $sh->per_status;
                                        }   
                                        if(count($perm) > 0) {
                                            foreach($perm as $pm){
                                                ?>
                                                <tr>	 
                                                    <td><?php echo ucwords(str_replace("-"," ",$pm->page_name));?></td>
                                                    <?php 
                                                    if(count($user) > 0) {
                                                            foreach($user as $us){
                                                                $vlp =	$us->ut_id.'-'.$pm->page_id;  
                                                                ?>
                                                                <td><input type="checkbox" name="permission[<?php echo $us->ut_id;?>][<?php echo $pm->page_id;?>]" value = '1'  <?php echo (array_key_exists($vlp,$sko) && (1 == $sko[$vlp])) ? 'checked=checked' : '';?>> </td>
                                                                <?php
                                                            }
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table> 
                        </div>   
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn  btn-success" name="submit" value="Create">Save</button>
                        </div> 
                    </div>
            </form>
                </div>
        </div>
    </section>
</div>