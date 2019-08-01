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
	<h3>Admin Panel</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body"> 
    <p class="login-box-msg">Sign in to start your session</p>
	<?php $this->load->view("admin/layout/success_error");?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value("email");?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		<div class="text-red"><?php echo form_error("email");?></div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		<div class="text-red"><?php echo form_error("password");?></div>
      </div>
      <div class="row">
        <div class="col-sm-12">
            <div class=" form-group pull-right">
            <a href="http://nib.gov.in/haemovigilance2.html" target="_blank" class="text-success text-bold">Register to Haemovigilance</a>
          </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Sign In">Sign In</button> 
        </div>
        <!-- /.col -->
      </div>
    </form> 

<!--    <a href="<?php echo base_url();?>">I forgot my password</a><br> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
