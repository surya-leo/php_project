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
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2">From and To Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>cm/viewBctvgraph2/" /> 
                        </div>
                    </div>
                </div>
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
                            $districtval    .=   "'".$ve->cnt."',";
                            $district    .=   "'".$ve->bloodbank_name."',";
                            $today = date('Y-m-d');
            		        $newdate = date('Y-m-d', strtotime('-1 month', strtotime($today))); 
            		        $conditions['asate']  =   $newdate." - ".$today; 
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
            </div> 
      </div>
      <!-- /.row -->
    </div>  
</section>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>bootstrap/js/bootstrap.min.js"></script>  

<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/chartjs/Chart.js"></script>
<script type="text/javascript">
dateInit();
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