<section class="content">
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);" onclick="get_pages()"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">
            Blood Availability and Collection Wise Bar Graph
        </li>
    </ol>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Blood Availability and Collection Wise </h3> 
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class='col-sm-12 pull-left'>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="get_pages()"> Back </a>
                </div> 
            </div> 
            <div class="postList">
                <div class="row">
                    <?php 
                    $districtval =  $district = $sdistrictval =  "";
                    if(count($view) > 0){
                        foreach($view as $ve){
                            $districtval    .=   "'".$ve->districtval."',";
                            $district    .=   "'".$ve->district."',";
                        }
                        $districtval = substr($districtval,0,-1);
                        $district  = substr($district,0,-1); 
                    }
                    if(count($sview) > 0){
                        foreach($sview as $vse){
                            $sdistrictval    .=   "'".$vse->districtval."',"; 
                        }
                        $sdistrictval = substr($sdistrictval,0,-1); 
                    }

                    ?>
                    <div class="col-md-12"><br/><br/>
                        <div class="chart-responsive">
                            <canvas id="barChart" height="100px"></canvas>
                        </div>
                    </div>  
                </div> 
            </div> 
      </div>
      <!-- /.row -->
    </div>  
</section>
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
                label: "Available", 
                data: [<?php echo $districtval;?>]
        },{   
                label: "Collection",
                backgroundColor : "rgba(60,141,188,0.9)", 
                data: [<?php echo $sdistrictval;?>]
        }],
    } 
});  
</script>