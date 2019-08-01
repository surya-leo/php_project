<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AP Blood Cell :: Registration </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head> 
<body class="hold-transition login-page">
    <header class="main-header"> 
        <a href="<?php echo base_url("cm");?>" class="logo"> 
          <span class="logo-lg">
                  <img src="<?php echo $this->config->item("jsadmin_assets");?>blood.png" class="img-logo"/>
                  <b>AP</b> Blood Cell
          </span>
        </a>  
    </header> 
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <h4>Camp : <?php echo $cmp->camp_description;?></h4>
                <h4>Date : <?php echo date("d F Y", strtotime($cmp->camp_date));?></h4>
                <h4>Held By : <?php echo $cmp->bloodbank_name;?></h4>                
            </div>
        </div>
        <div class="">  
            <div class="login-box-body">  
                <h4 class="login-box-msg">Registration for Blood Bank Camp</h4>
                <?php  if($this->session->flashdata("err") != ""){?>
                <div class="alert alert-danger alert-dismissible">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                       <?php echo $this->session->flashdata("err");?>
                 </div>
                <?php }  if($this->session->flashdata("war") != ""){?> 
                 <div class="alert alert-warning alert-dismissible">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <h4><i class="icon fa fa-check"></i> Alert!</h4>
                       <?php echo $this->session->flashdata("war");?>
                 </div>
                 <?php }  if($this->session->flashdata("suc") != ""){?> 
                 <div class="alert alert-success alert-dismissible">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <h4><i class="icon fa fa-check"></i> Alert!</h4>
                       <?php echo $this->session->flashdata("suc");?>
                 </div>
                 <?php } ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control input_num" placeholder="Mobile No." name="phone" value="<?php echo set_value("phone");?>" minlength="10" maxlength="10" required="">
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                <div class="text-red"><?php echo form_error("phone");?></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control input_char" placeholder="Name" name="name" value="<?php echo set_value("name");?>" required=""/>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                <div class="text-red"><?php echo form_error("name");?></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <input type="number" class="form-control input_num" placeholder="Age" name="age" value="<?php echo set_value("age");?>" min="18" required="">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                Gender : <input type="radio"   name="sex" value="Female" required="" <?php echo set_checkbox("sex",'Female');?>> Female
                                <input type="radio"   name="sex" value="Male" required=""  <?php echo set_checkbox("sex","Male");?>>  Male
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <select class="form-control" name="blood_group" required="" >
                                    <option value=""> Select Blood Group</option>
                                    <?php 
                                    if($ct > 0){
                                        foreach($ct as $bt){
                                            ?>
                                            <option value="<?php echo $bt->blood_group_name;?>" <?php echo set_select("blood_group",$bt->blood_group_name);?> ><?php echo $bt->blood_group_name;?></option>			
                                            <?php
                                        }
                                    }?>
                                 </select>
                                <div class="text-red"><?php echo form_error("blood_group");?></div>
                             </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <select class="form-control" name="district" required="" >
                                    <option value=""> Select District</option>
                                    <?php 
                                    if($district > 0){
                                        foreach($district as $ft){
                                                ?>
                                                <option value="<?php echo $ft->district_name;?>" <?php echo set_select("district",$ft->district_id);?> ><?php echo $ft->district_name;?></option>			
                                                <?php
                                        }
                                    }?>
                                 </select> 
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <input type="email" class="form-control" placeholder="Email Id" name="emailid" value="<?php echo set_value("emailid");?>" >
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span> 
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control input_char" placeholder="Father's Name" name="fname" value="<?php echo set_value("fname");?>">
                                <input type="hidden" class="form-control" name="bloodbank_id" value="<?php echo $cmp->bloodbank_id;?>">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span> 
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <input type="number" class="form-control input_num" placeholder="Pincode" name="pincode" value="<?php echo set_value("pincode");?>" min="1">
                            </div>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-2">
                          <button type="submit" class="btn btn-primary  btn-flat" name="submit" value="Submit">Submit</button>
                        </div>
                      <!-- /.col -->
                    </div>
                </form>
            </div> 
          </div> 
    </section>
    <footer class="main-footer1">
        <div class="pull-right hidden-xs">
                Developed By <a href="http://advitsoft.com/" target="_blank">ADVIT</a> <b>Version</b> 2.0.0  
        </div>
        <strong>Copyright &copy; 2016 <a href="">AP Blood Cell</a>.</strong> All rights reserved.
    </footer> 
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script> 
<script>
	$(".input_num").keypress(function(event){
			var inputValue = event.which;
			// allow numbers only.
			if(!(inputValue >= 48 && inputValue <= 57)) { 
				event.preventDefault(); 
			}
	});
</script>
</body>
</html>
