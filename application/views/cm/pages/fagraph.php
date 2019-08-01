<div class="col-md-6">
    <div class="chart-responsive" height="100">
        <canvas id="barChart1"></canvas>
    </div>
</div>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script>  
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/chartjs/Chart.js"></script>
<?php
    if(count($view) > 0 ){
        $drf    =   $crf    =   "";
        foreach ($view as $vfr){
                $drf    .= "'".$vfr->bc_abbr."',";
                $crf    .= "'".$vfr->apos."',";
        }
        $drf    = substr($drf,0,-1);
        $crf    = substr($crf,0,-1);
    }
?>
<script type="text/javascript">
var ctx     =   document.getElementById('barChart1').getContext('2d'); 
var labels  =   [<?php echo $drf;?>];
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
                backgroundColor: ["#FFFF99", "#FFFF99", "#FFB6C1", "#FFB6C1", "white", "white", "#d9edf7", "#d9edf7"], 
                borderColor:"rgba(210, 214, 222, 1)",
                borderWidth:"1", 
                data: [<?php echo $crf;?>]
        }],
    },
    options: { 
        legend  :  false,
        onClick: myFunctions
    }
});  
function   myFunctions(evt) {     
    $.post("/cm/fa_bargraph",function(data){
            $("#content_show").html(data);
    }); 
}
</script>