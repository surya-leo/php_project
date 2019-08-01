 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blood Donor Chart  
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Blood Donor Chart</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                    <div class='col-sm-12 pull-left'>
                        <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="get_pages()"> Back</a>
                    </div>
              	 <div class="col-md-6">
                	<?php 
			$priceprod = array();
			foreach ($view as $g => $f){
			  // use the key $g in the $priceprod array
			  $priceprod[$g] = $f->cnt;
			}
			
			// get the highest price
			$maxprice = max($priceprod);
			$minprice = min($priceprod); 
			$vsp = ""; $msp = "";
                		foreach ($view as $g => $f){ 
                			if($f->cnt == $maxprice){
                				if($msp == ""){
		                		?>
		                		<table class='table-bordered table text-center'>
		                		<tr class="tr_green">
		                			<td class="tr_25"><b>Max No. of Units</b></td>
		                			<td class="tr_75"><b>Blood Bank Name</b></td>
		                		</tr>
		                		<tr class="tr_height">
		                			<td class="tr_25"><?php echo $maxprice;?></td>  
		                			<td  class="tr_75"><?php echo $f->bloodbank_name.", ".trim($f->district);?></td>  
		                		</tr>
		                		</table> 
		                		<?php }
		                		$msp = $f->bloodbank_name;
                			} if($f->cnt == $minprice){
		                		if($vsp == ""){
		                		?>
		                		<table class='table-bordered table text-center'>
		                		<tr style="background-color:brown;color:#fff;">
		                			<td class="tr_25"><b>Min No. of Units</b></td>
		                			<td class="tr_75"><b>Blood Bank Name</b></td>
		                		</tr>
		                		<tr class="tr_height">
		                			<td class="tr_25"><?php echo $minprice;?></td>  
		                			<td class="tr_75"><?php echo $f->bloodbank_name.", ".trim($f->district);?></td>  
		                		</tr>
		                		</table> 
		                		<?php }
		                		$vsp = $f->bloodbank_name;
	                		}
                		}?>
                </div>
                <div class="col-md-6">              		
                <?php 
			$spriceprod = array();
			foreach ($dview as $sg => $sf){
			  // use the key $g in the $priceprod array
			  $spriceprod [$sg] = $sf->cnt;
			}
			
			// get the highest price
			$smaxprice = max($spriceprod);
			$sminprice = min($spriceprod);
			?>
                		<?php $ssp = ""; $smp = "";
                		foreach ($dview as $sg => $sf){ 
                			if($sf->cnt == $smaxprice){
	                			if($smp == ""){
	                			?>
                				<table class='table-bordered table text-center'>
	                				<tr class="tr_green">
			                			<td class="tr_25"><b>Max No. of Units</b></td> 
			                			<td class="tr_75"><b>District</b></td>
			                		</tr>
			                		<tr class="tr_height">
			                			<td class="tr_25"><?php echo $smaxprice;?></td> 
			                			<td class="tr_75"><?php echo $sf->district;?></td>  
			                		</tr>
		                		</table>
		                		<?php } 
		                		$smp = $sf->district;
	                		}
	                		if($sf->cnt == $sminprice){
	                			if($ssp == ""){
		                		?>		                		
			                	<table class='table-bordered table text-center'>
				                	<tr class="tr_brown">
			                			<td class="tr_25"><b>Min No. of Units</b></td>  
			                			<td class="tr_75"><b>District</b></td>
			                		</tr>
			                		<tr class="tr_height">
			                			<td class="tr_25"><?php echo $sminprice;?></td>
			                			<td class="tr_75"><?php echo $sf->district;?></td>  
			                		</tr>
		                		</table>
		                		<?php }
		                		$ssp = $sf->district;
	                		}
                		}?>                	
              		</div>
              	</div>
               <div class="col-md-6">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="350"></canvas>
                  </div>
                  <div id="legend"> 
                  </div>
                  <!-- ./chart-responsive -->
                </div> 
                <div class="col-md-6">
                  <div class="chart-responsive">
                    <canvas id="pieChartp" height="350"></canvas>
                  </div>
                  <div id="legendp"> 
                  </div>
                  <!-- ./chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
            </div> 
            <!-- /.footer -->
          </div>
    </section>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script>  
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/chartjs/Chart.min.js"></script>
<script type="text/javascript">
 $(function () {

  'use strict'; 
  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
<?php if(count($view) > 0){
	foreach($view as $ve){
		?>
				{
				  value: <?php echo $ve->cnt;?>,  
				  label: "<?php echo $ve->bloodbank_name;?>"
				}, 
		<?php }
	}
?>
  ];
  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 0, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><i class=\"fa fa-circle\" style=\"color:<%=segments[i].fillColor%>\"></i>&nbsp;&nbsp;<%if(segments[i].label){%><%=segments[i].value%> Units - <%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> Units, <%=label%>"
  };
   // You can switch between pie and douhnut using the method below.
  window.ps = pieChart.Doughnut(PieData, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------
  
document.getElementById('legend').innerHTML = ps.generateLegend();
});
$(function () {

  'use strict'; 
  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#pieChartp").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
<?php if(count($dview) > 0){
	foreach($dview as $dve){
		?>
				{
				  value: <?php echo $dve->cnt;?>,  
				  label: "<?php echo trim($dve->district);?>"
				}, 
		<?php }
	}
?>
  ];
  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 0, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><i class=\"fa fa-circle\" style=\"color:<%=segments[i].fillColor%>\"></i>&nbsp;&nbsp;<%if(segments[i].label){%><%=segments[i].value%> Units - <%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> Units, <%=label%>"
  };
   // You can switch between pie and douhnut using the method below.
  window.ps = pieChart.Doughnut(PieData, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------
  
document.getElementById('legendp').innerHTML = ps.generateLegend();
});
</script>