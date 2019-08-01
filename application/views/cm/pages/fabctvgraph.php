<div class="row">
    <?php 
    $districtval =  $district = $sdistrictval =  "";
    if(count($view) > 0){
        foreach($view as $ve){
            $districtval    .=   "'".$ve->cnt."',";
            $district    .=   "'".$ve->bloodbank_name."',"; 
	        $conditions['asate']  =   $asate; 
			$conditions['bloodbank']   =   $ve->bloodbank_id;
			$vef  =	$this->transfer_model->gtrn_collec_query($conditions); 
			if(count($vef) > 0){
			    $tg =   '0';
			    foreach($vef as $fe){
			        $tg = $tg+$fe->cnt;
			    }
			}
			$tgval    .=   "'".$tg."',";
        }
        $districtval = substr($districtval,0,-1);
        $district  = substr($district,0,-1); 
        $tgval  =    substr($tgval,0,-1); 
    } 
    ?>
    <div class="col-md-12"><br/><br/>
        <div class="chart-responsive">
            <canvas id="barChart" height="100px"></canvas>
        </div>
    </div>  
</div>  
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script>   
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/chartjs/Chart.js"></script>
<script type="text/javascript"> 
var ctx     =   document.getElementById('barChart').getContext('2d'); 
var labels  =   [<?php echo $district;?>];
var myChart = new Chart(ctx, {
    type: 'bar', 
    scaleBeginAtZero: true, 
    scaleShowGridLines: true, 
    scaleGridLineColor: "rgba(0,0,0,.05)", 
    scaleGridLineWidth: 1, 
    scaleShowHorizontalLines: true, 
    scaleShowVerticalLines: true,  
    barValueSpacing: 5, 
    barDatasetSpacing: 1, 
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>", 
    responsive: true,
    maintainAspectRatio: true,
    data: {
        labels: labels,
        datasets: [{   
                 backgroundColor : "rgba(160,41,88,0.5)", 
                label: "No of Camps", 
                data: [<?php echo $districtval;?>]
        },{   
                label: "No. of Collections",
                backgroundColor : "rgba(60,141,188,0.9)", 
                data: [<?php echo $tgval;?>]
        }],
    } 
});   
</script>