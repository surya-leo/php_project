<div class="row barChart1">
    <div class="col-md-6">
        <div class="chart-responsive">
            <canvas id="barChart" height="150"></canvas>
        </div>
    </div>  
</div> 
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script>  
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/chartjs/Chart.js"></script>
<script type="text/javascript">
var ctx     =   document.getElementById('barChart').getContext('2d'); 
var labels  =   ["A+ve", "A-ve", "B+ve", "B-ve", "AB+ve", "AB-ve", "O+ve","O-ve"];
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
                data: [<?php echo $view->Apos;?>, <?php echo $view->Aneg;?>, <?php echo $view->Bpos;?>, <?php echo $view->Bneg;?>, <?php echo $view->ABpos;?>, <?php echo $view->ABneg;?>, <?php echo $view->Opos;?>, <?php echo $view->Oneg;?>]
        }],
    },
    options: { 
        legend  :  false,
        onClick: myFunction
    }
}); 
 
function   myFunction(evt) {
    var activePoints = myChart.getElementsAtEvent(evt);
    var district    =   $(".district option:selected").val();
    if (activePoints[0]) {
        var chartData   =   activePoints[0]['_chart'].config.data;
        var idx         =   activePoints[0]['_index']; 
        var label       =   chartData.labels[idx];   
        $.post("/cm/getvalue",{label:label,district:district},function(data){
                $(".barChart1").html(data);
        });
    }
}
</script>