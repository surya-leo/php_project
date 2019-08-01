<div class="col-md-5">
    <div class="chart-responsive">
        <canvas id="pieChart" height="350"></canvas>
    </div>
</div>
<div class="col-md-7">
      <div id="legend"></div>
</div>
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
				  label: "<?php echo $ve->bloodbank_name."-".trim($ve->district)."-".trim($ve->city);?>"
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
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><i class=\"fa fa-circle\" style=\"color:<%=segments[i].fillColor%>\"></i>&nbsp;&nbsp;<%if(segments[i].label){%><%=segments[i].value %> users - <%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> users, <%=label%>"
  };
  
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  window.ps = pieChart.Doughnut(PieData, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------
  
document.getElementById('legend').innerHTML = ps.generateLegend();
});
</script>