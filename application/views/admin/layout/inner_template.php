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
  <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/timepicker/bootstrap-timepicker.min.css">
   <link rel="stylesheet" href="<?php echo $this->config->item("jsadmin_assets");?>plugins/iCheck/all.css">
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
  <?php $this->load->view("admin/layout/top_header");?>
  <!-- /Header -->
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view("admin/layout/side_bar");?>
  <!-- / Left -->
  
  <?php $this->load->view("admin/pages/".$content);?>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          Developed By <a href="http://advitsoft.com/" target="_blank">ADVIT</a> <b>Version</b> 2.0.0  
        </div>
        <strong>Copyright &copy; 2016 <a href="">AP Blood Cell</a>.</strong> All rights reserved.
    </footer>  
    <div class="control-sidebar-bg"></div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Remarks</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="">
                <div class="form-group">
                    <label>Remarks <span class="text-red">*</span></label>
                    <textarea name="text_data" class="text_data form-control" placeholder="Remarks"></textarea>
                    <input type="hidden" class="viattr" name="viattr"/>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn-success btn-remarks btn btn-sm" name="submit" value="Submit"/>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div> 
  </div>
</div>
<div id="request_idyModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Remarks</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="">
                <div class="form-group">
                    <label>Remarks <span class="text-red">*</span></label>
                    <textarea name="text_data" class="text_datap form-control" placeholder="Remarks"></textarea>
                    <input type="hidden" class="request_id" name="request_id"/>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn-success btn-requests btn btn-sm" name="submit" value="Submit"/>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div> 
  </div>
</div>
<div id="reason_idyModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Reason</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="">
                <div class="form-group">
                    <label>Reason <span class="text-red">*</span></label>
                    <textarea name="text_data" class="text_dp form-control" placeholder="Remarks"></textarea>
                    <input type="hidden" class="bbdonation_id" name="bbdonation_id"/>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn-success btn-discr btn btn-sm" name="submit" value="Submit"/>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div> 
  </div>
</div>
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
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>dist/js/app.min.js"></script> 
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>dist/js/demo.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>version2.js"></script>
<script> 
    $('input[type="checkbox"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green' 
    });
    $(".timepicker").timepicker({
            showInputs: false
    });
    $('#example2').DataTable({
		  "paging": true,
		  "lengthChange": true, 
		  "ordering": true,
		  "info": true,
		  "autoWidth": true
    }); 
    $('#datepicker').datepicker({
            autoclose: true,
            endDate: '+0d',
            format:"yyyy-mm-dd" 
    }).keydown(false);
    $('#adatepicker').datepicker({
            autoclose: true,
            format:"yyyy-mm-dd" 
    }).keydown(false);
	var uri =	"<?php echo $this->uri->segment("2");?>";
	if(uri != ""){
			$("."+uri).addClass("active");
	}
	$(".clstate").change(function(){
			var cstate 	=	$(".clstate option:selected").attr("text_val");
			$.post("/admin/common/district",{cstate:cstate},function(data){
					$('.district').html(data);
			});
	}); 
	$(".district").change(function(){
                var district 	=	$(".district option:selected").attr("text_val"); 
                $.post("/admin/common/city",{district:district},function(data){
                                $('.city').html(data);
                });
	}); 
	function countChar(val) {
			var len = val.value.length;
			if (len >= 160) {
				val.value = val.value.substring(0, 160);
			} else {
				$('#charNum').text(160 - len);
			}
	}
	$(".input_num").keypress(function(event){
			var inputValue = event.which;
			// allow numbers only.
			if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8) ) { 
				event.preventDefault(); 
			}
	});
	$(".input_geo").keypress(function(event){
			var inputValue = event.which;
			// allow numbers and dot only.
			if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8 &&inputValue != 46)) { 
				event.preventDefault(); 
			}
	});
	$(".input_char").keypress(function(event){
			var inputValue = event.which;  
			// allow letters , dots and whitespaces only.
			if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 0 && inputValue != 8 && inputValue != 32 && inputValue != 46 &&  inputValue != 0)) { 
				event.preventDefault(); 
			}
	});
	$(".get_camps").click(function(){
			var fdat 	=	$(".sedate").val();
			var tdat 	=	$(".setdate").val(); 
			$.post("/getcamps",{fdat:fdat,tdat:tdat},function(data){  
					$(".camps_reports").html(data);
			});
	});
	$(".stactive").click(function(){
			var stu 		=	$(this).attr("sta");
			var camp_id 	=	$(this).attr("camp_id");
			$.post("/camp_active",{stu:stu,camp_id:camp_id},function(data){ 
							location.reload(); 
			});
	}); 
	$(".fa_charts").click(function(){
			$.post("/cm/charts",function(dta){
						$("#gmap_markers").hide();
						$("#content_show").html(dta);
			});
	}); 
        $(".positive").change(function(){
                var vChecked=false;
                $(this).closest('tr').find(".positive").each(function(){
                    if($(this).is(":checked")){
                        vChecked=true;
                        return true;
                    }
                });
                if(vChecked){  
                    $(this).closest('tr').css("background-color","rgba(206,97,97,0.8)");
                }else{ 
                    $(this).closest('tr').css("background-color",""); 
                }
	});
    $('[data-toggle="popover"]').popover({trigger:'hover',html:true});
    var bgroup  =   $(".blood_group").val();
    if(bgroup != ""){ 
        $.post("/admin/blood_group_serum",{bgroup:bgroup},function(dta){
                var sp =    dta.split("@@");                
                $("#anti_a").val(sp['0']);
                $("#anti_b").val(sp['1']); 
                $("#anti_ab").val(sp['2']);
                $("#anti_d").val(sp['3']);
                $("#anti_ac").val(sp['4']);
                $("#anti_bc").val(sp['5']);
                $("#anti_oc").val(sp['6']);
                $("#anti_du").val(sp['7']);
        });
    }
    function printDiv(){
//            var content = document.getElementById('print-div');
            var printContents       = document.getElementById('print-div').innerHTML;
            var originalContents    = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
    }
    function searchFilter(page_num,url) {
            page_num        =   page_num?page_num:0; 
            var fr          =   $(".zero_units").is(":checked")?"0":'1'; 
            var keywords    =   $('#FilterTextBox').val();   
            $.ajax({
                type: 'POST',
                url: url+page_num,
                data:{
                    keywords    :   keywords,
                    asate       :   $(".daterange").val(),
                    district    :   $(".report_district option:selected").val(),
                    city        :   $(".report_city option:selected").val(),
                    intervalue  :   $(".btn_excel option:selected").val(),
                    searbloodbank_id        :   $(".searbloodbank_id option:selected").val(),
                    units       :   fr,
                    component   :   $(".component_type:checked").val()
                }, 
                success: function (html) { 
                    $('.postList').html(html); 
                }
            });
    }  
    function submit_request(ur){
            frm     =   document.getElementById('myform'+ur);
            frm.submit(
                function (e) {
                        e.preventDefault();
                        $.ajax({
                            type: frm.attr('method'),
                            url: frm.attr('action'),
                            data: frm.serialize() 
                    });
            });
    }
    $('.daterange').daterangepicker({
            autoUpdateInput: false,
            autoApply:true,
            locale: {
                cancelLabel: 'Clear'
            },
            maxDate: new Date()
    });
    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
            search_summary($('.daterange').attr("value_url"));
            transfer_donors();
    }); 
    $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
    });     
    function search_summary(url){ 
            searchFilter('',url);
    } 
    $(".component_type").click(function(){
            var url     =   $(".varurl").val();
            searchFilter('',url);
    });
    function blood_camp(){
            var mob             =    $(".search_mobile").val(); 
            remobile(mob); 
    } 
    $(".search_mobile").keyup(function(){
            var mob  = $(".search_mobile").val();
            if(mob.length == "10"){
                    remobile(mob);
            }
    }); 
    function    remobile(mob){ 
            var blood_camp      =     $(".blood_camp option:selected").attr("blood_login_id");
            var valo            =     $("input[name=donor_id]").val();
            $.post("/admin/common/get_det",{blood_camp:blood_camp,mob:mob},function(data){ 
                    var slp = data.split("@@"); 
                    $("input[name=dname]").val(slp["0"]);
                    $("select[name=sex]").val(slp["1"]);
                    $("select[name=blood_group]").val(slp["2"]);
                    if(slp["3"] == '0'){
                            $(".mg_name").html("");
                            $("input[name=donor_id]").val(slp["4"]);
                    }else{
                            $(".mg_name").html(slp["4"]);
                            if(valo == ''){
                                $("input[name=donor_id]").val("");
                            }
                    }
            });
    }
    function reason_by(val){
            $(".bbdonation_id").val(val);
    }
</script>
</body>
</html>
