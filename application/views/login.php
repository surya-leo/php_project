<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AP Blood Cell :: Admin Panel</title>
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
	<h3>Login</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body"> 
    <p class="login-box-msg">Sign in to start your session</p>
	<?php $this->load->view("admin/layout/success_error");?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control input_num" placeholder="Mobile No." name="phone" value="<?php echo set_value("phone");?>" minlength="10" maxlength="10">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
		<div class="text-red"><?php echo form_error("phone");?></div>
      </div> 
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Sign In">Send OTP</button>
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
                if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8) ) { 
                        event.preventDefault(); 
                }
	});
</script>
</body>
</html>
