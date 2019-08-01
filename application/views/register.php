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
<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo $this->config->item("jsadmin_assets");?>blood.png" class="img-logo"/>
	<a href="<?php echo base_url("admin");?>"><b>AP </b>Blood Cell <br/></a> 
	<h3>Register</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body"> 
    <p class="login-box-msg">Sign up to start your session</p>
	<?php $this->load->view("admin/layout/success_error");?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control input_num" placeholder="Mobile No." name="phone" value="<?php echo set_value("phone");?>" minlength="10" maxlength="10">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
		<div class="text-red"><?php echo form_error("phone");?></div>
      </div>	  
	  <div class="form-group has-feedback">
        <input type="text" class="form-control input_char" placeholder="Name" name="name" value="<?php echo set_value("name");?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		<div class="text-red"><?php echo form_error("name");?></div>
      </div>
		<div class="form-group has-feedback">
        <input type="number" class="form-control input_num" placeholder="Age" name="age" value="<?php echo set_value("age");?>" min="1">
      </div>
		<div class="form-group has-feedback">
        Gender : <input type="radio"   name="sex" value="Female" <?php echo set_checkbox("sex",'Female');?>> Female
        <input type="radio"   name="sex" value="Male" <?php echo set_checkbox("sex","Male");?>>  Male
      </div>
	  <div class="form-group has-feedback">
         <select class="form-control" name="blood_group">
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
 <div class="form-group has-feedback">
         <select class="form-control" name="district">
			<option value=""> Select District</option>
			<?php 
			if($district > 0){
						foreach($district as $ft){
							?>
							<option value="<?php echo $ft->district_id;?>" <?php echo set_select("district",$ft->district_id);?> ><?php echo $ft->district_name;?></option>			
							<?php
						}
			}?>
		 </select> 
      </div>
	  <div class="form-group has-feedback">
         <textarea class="form-control" name="location" placeholder="Location" ><?php echo set_value("location");?></textarea>
      </div> 
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Sign Up">Sign Up</button>
        </div>
        <!-- /.col -->
      </div>
    </form>  
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
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
