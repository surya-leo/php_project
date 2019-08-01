<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AP Blood Cell :: MAIN PANEL</title> 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>dist/css/AdminLTE.min.css"> 
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>style.css">   
  <style>
    .bg-te-gradient {
            background: #39834C !important;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #39CCCC), color-stop(1, #F39E16)) !important;
            background: -ms-linear-gradient(bottom, #F39E16, #39CCCC) !important;
            background: -moz-linear-gradient(center bottom, #F39E16  0%, #39CCCC 100%) !important;
            background: -o-linear-gradient(#F39E16, #39CCCC) !important;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F39E16', endColorstr='#39CCCC', GradientType=0) !important;
            color: #fff;
    }
    .bg-teald-gradient {
            background: #808000 !important;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #808000), color-stop(1, #39CCCC)) !important;
            background: -ms-linear-gradient(bottom, #808000, #39CCCC) !important;
            background: -moz-linear-gradient(center bottom, #808000 0%, #39CCCC 100%) !important;
            background: -o-linear-gradient(#39CCCC, #808000) !important;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#39CCCC', endColorstr='#808000', GradientType=0) !important;
            color: #fff;
    }
    .bg-lyellow-gradient {
            background: #d275ba !important;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #d275ba), color-stop(1, #f7bc60)) !important;
            background: -ms-linear-gradient(bottom, #d275ba, #f7bc60) !important;
            background: -moz-linear-gradient(center bottom, #d275ba 0%, #f75c60 100%) !important;
            background: -o-linear-gradient(#f7bc60, #d275ba) !important;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f7bc60', endColorstr='#d275ba', GradientType=0) !important;
            color: #fff;
    }
    .btn-cadetblue{
            background:cadetblue;
             color: #fff;
    }
  </style>
</head>
<body class="hold-transition body-class">  
	<header class="main-header">
		<!-- Logo -->
		<a href="<?php echo base_url("cm");?>" class="logo"> 
		  <span class="logo-lg">
			  <img src="<?php echo $this->config->item("jsadmin_assets");?>blood.png" class="img-logo"/>
			  <b>AP</b> Blood Cell
		  </span>
		</a> <!-- Content Header (Page header) -->
		<section class="content-header hidden-xs">
			<ul class="nav navbar-nav">
				
				
				<li>
					<div class="m-b-811">
						<img src="<?php echo $this->config->item("jsadmin_assets");?>ap_logo.png" class="img-logo_ap12"/>
					</div>
				</li>
				<li>
					<div class="m-b-811">
						<img src="<?php echo $this->config->item("jsadmin_assets");?>ap_nhm-new.png"  /> 
					</div>
				</li>
				<li>
					<div class="m-b-811">
						<img src="<?php echo $this->config->item("jsadmin_assets");?>naco_logo1.png"  class="img-logo_ap23"/>
					</div>
				</li> 
				
				 
				
				<li>
					<div class="m-b-811">
						<img src="<?php echo $this->config->item("jsadmin_assets");?>ap_APSACS.png" class="img-logo_ap11 pull-right"/>
					</div>
				</li>
				<li>
					<div class="m-b-811">
						<img src="http://apbloodcell.com/resources/jdadmin_assets/CM.png" class="img-logo_ap31" style="
    width: 90px;
    margin-left: 190px;
">
					</div>
				</li> 
				
				
			</ul> 
		</section>
	</header>
  <?php $this->load->view("cm/pages/".$content);?>
	<footer class="main-footer1">
		<div class="pull-right hidden-xs">
			Developed By <a href="http://advitsoft.com/" target="_blank">ADVIT</a> <b>Version</b> 2.0.0  
		</div>
		<strong>Copyright &copy; 2016 <a href="">AP Blood Cell</a>.</strong> All rights reserved.
	</footer>  
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

<!-- daterangepicker -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>moment.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/datatables/dataTables.bootstrap.min.js"></script> 
<script>   
    	function searchFilter(page_num,url) {
            page_num        =   page_num?page_num:0; 
            var keywords    =   $('#FilterTextBox').val(); 
            var fr          =   $(".zero_units").is(":checked")?"0":'1'; 
            var ds          =    $(".daterange").val()? $(".daterange").val(): $(".daterange1").val();
            $.ajax({
                type: 'POST',
                url: url+page_num,
                data:{
                    keywords    :   keywords,
                    asate       :   ds,
                    district    :   $(".report_district option:selected").val(),
                    blood_category    :   $(".blood_category option:selected").val(),
                    notintervalue    :   $(".btn_excel option:selected").val(),
                    city        :   $(".report_city option:selected").val(), 
                    component   :   $(".component_type:checked").val(),
                    blood_bank_type   :   $(".blood_banktype:checked").val(),
                    units       :   fr,
                    uir         :   $(".uir").val() 
                }, 
                success: function (html) { 
                    $('.postList').html(html); 
                }
            });
        }   
        function search_summary(url){ 
                searchFilter('',url);
        } 
        var disInit = function(){
                $(".district").change(function(){
                            var district 	=	$(".district option:selected").attr("text_val"); 
                            $.post("/admin/common/city",{district:district},function(data){
                                            $('.city').html(data);
                            });
            	}); 
                $(".component_type").click(function(){
                        var url     =   $(".varurl").val();
                        searchFilter('',url);
                });
        }
        var dateInit = function(){
                $('.daterange').daterangepicker({
                        autoUpdateInput: false,
                        autoApply:true,
                        locale: {
                            cancelLabel: 'Clear'
                        },
                        showDropdowns:true,
                       // maxDate: new Date()
                });
                $('.daterange').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
                        search_summary($('.daterange').attr("value_url")); 
                }); 
                $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                });  
                $('.daterange1').daterangepicker({
                        autoUpdateInput: false,
                        autoApply:true,
                        locale: {
                            cancelLabel: 'Clear'
                        },
                        showDropdowns:true,
                        minDate: new Date()
                });
                $('.daterange1').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
                        search_summary($('.daterange1').attr("value_url")); 
                }); 
                $('.daterange1').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                }); 
                function search_summary(url){ 
                        searchFilter('',url);
                } 
        }
        $(".fa_bank").click(function(){
                var uir     =   $(this).attr("uri");
                $.post("/cm/view_blood_bank",{uir:uir},function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
	});
	$(".fa_users").click(function(){
                $.post("/cm/users",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
	});
	$(".fa_avail").click(function(){
                $.post("/cm/bloodavail",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
	});
	$(".fa_discarded").click(function(){
                $.post("/cm/blood_expiry",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
	});
	$(".fa_view").click(function(){
			$.post("/cm/view_blood_donation",function(dta){
						$("#mg_dtaa").hide();
						$("#content_show").html(dta);
			});
	});
	$(".fa_charts").click(function(){
                $.post("/cm/charts",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
	});
	
	function fa_camps(){
			$.post("/cm/camps",function(dta){
						$("#mg_dtaa").hide();
						$("#content_show").html(dta);
			});
	}
	function get_pages(){ 
			$("#mg_dtaa").show();
            $("#content_show").html("");
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
	}
	function get_func(){
			var fdat 	=	$(".sedate").val();
			var tdat 	=	$(".setdate").val(); 
			$.post("/getcamps",{fdat:fdat,tdat:tdat},function(data){  
					$(".camps_reports").html(data);
			});
	} 
        function viewCamps(el){
                var bloodbank_id    =   el.attr("bloodbankid"); 
                $.post("/cm/viewCampsblood/"+bloodbank_id,function(data){
                        $('#content_show').html(data);
                });
        } 
        function viewCollection(el){
                var bloodbank_id    =   el.attr("bloodbankid"); 
                $.post("/cm/viewtrCollections/"+bloodbank_id,function(data){
                        $('#content_show').html(data);
                });
        } 
        function fa_bank(ths){
                var uir     =   $(ths).attr("uri");
                $.post("/cm/view_blood_bank",{uir:uir},function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
        }
        function viewBctvgraph(evt){
                $.post("/cm/viewBctvgraph",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
        }
        $(".fa_collect").click(function(){
                $.post("/cm/collections",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
        });
        $(".fa_accamps").click(function(){
                $.post("/cm/active_camps",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
        });
         $(".fa_blodcollection").click(function(){
                $.post("/cm/fa_blodcollection",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
        });
        $(".fa_bargraph").click(function(){
                $.post("/cm/fa_bargraph",function(dta){
                        $("#mg_dtaa").hide();
                        $("#content_show").html(dta);
                });
        }); 
</script>
</body>
</html>
