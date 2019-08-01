<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AP Blood Cell :: <?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/daterangepicker/daterangepicker.css">  
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>style.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>version2.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper"> 
  <!-- Header -->  
  <?php $this->load->view("users/layout/top_header");?>
  <!-- /Header -->
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view("users/layout/side_bar");?>
  <!-- / Left -->
  
  <?php $this->load->view("users/pages/".$content);?>
	<footer class="main-footer">
    <div class="pull-right hidden-xs">
      Developed By <a href="http://advitsoft.com/" target="_blank">ADVIT</a> <b>Version</b> 1.0.0  
    </div>
    <strong>Copyright &copy; 2016 <a href="">AP Blood Cell</a>.</strong> All rights reserved.
  </footer> 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>raphael-min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>moment.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- DataTables -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Slimscroll -->

<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>dist/js/app.min.js"></script> 
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>dist/js/demo.js"></script>
<script> 
    var uri =	"<?php echo $this->uri->segment("2");?>";
    if(uri != ""){
                    $("."+uri).addClass("active");
    }
    $(".timepicker").timepicker({
                    showInputs: false
    });
    $('.datepicker').datepicker({
                    autoclose: true,
                    startDate: '+0d',
                    format:"yyyy-mm-dd"
    });
    $('#example2').DataTable({
		  "paging": true,
		  "lengthChange": true, 
		  "ordering": true,
		  "info": true,
		  "autoWidth": true
    }); 
    $(".input_num").keypress(function(event){
                    var inputValue = event.which;  
                    if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8) ) { 
                            event.preventDefault(); 
                    }
    }); 
    $(".input_char").keypress(function(event){
                    var inputValue = event.which;   
                    if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 0 && inputValue != 8 && inputValue != 32 && inputValue != 46 &&  inputValue != 0)) { 
                            event.preventDefault(); 
                    }
    }); 
    function searchFilter(page_num,url) {
            page_num = page_num?page_num:0;
            var keywords = $('#FilterTextBox').val();   
            $.ajax({
                type: 'POST',
                url: url+page_num,
                data:{
                    keywords:keywords
                },
                beforeSend: function () {
                    $('.loading').show();
                },
                success: function (html) {
                    console.log(html);
                    $('.postList').html(html);
                    $('.loading').fadeOut("slow");
                }
            });
    }
</script>
</body>
</html>
