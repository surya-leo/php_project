<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Dashboard
		<small>Control panel</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	  </ol>
	</section>
	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<?php if($this->session->userdata("login_parent") == 1){ ?>
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-aqua">
			<div class="inner">
			  <h3><?php echo $blood_banks->cnt_bank?$blood_banks->cnt_bank:"0";?></h3>
			  <p>Blood Banks</p>
			</div>
			<div class="icon">
			  <i class="fa fa-bank"></i>
			</div>
			<a href="<?php echo base_url("admin/view-blood-bank/1");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div> 
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-gray-active">
			<div class="inner">
			  <h3><?php echo $mother_banks?$mother_banks:"0";?></h3>
			  <p>Mother Blood Banks</p>
			</div>
			<div class="icon">
			  <i class="fa fa-bank"></i>
			</div>
			<a href="<?php echo base_url("admin/view-blood-bank/2");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div> 
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-primary">
			<div class="inner">
			  <h3><?php echo $storage->cnt_bank?$storage->cnt_bank:"0";?></h3>
			  <p>Blood Storage Unit</p>
			</div>
			<div class="icon">
			  <i class="fa fa-bank"></i>
			</div>
			<a href="<?php echo base_url("admin/view-blood-bank/3");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div> 
		
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-fuchsia">
			<div class="inner">
			  <h3><?php echo $bctv->cnt_bank?$bctv->cnt_bank:"0";?></h3>
			  <p>BCTV</p>
			</div>
			<div class="icon">
			  <i class="fa fa-bank"></i>
			</div>
			<a href="<?php echo base_url("admin/view-blood-bank/4");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div> 
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-teal">
			<div class="inner">				  
			  <h3><?php echo $app->app_count?$app->app_count:"23020";?></h3>
			  <p>App Downloads</p>
			</div>
			<div class="icon">
			  <i class="fa fa-download"></i>
			</div>
			<a href="Javascript:void(0);" class="small-box-footer">Total App Downloads  </a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
			<div class="inner">				  
			  <h3><?php echo $users->cnt_users?$users->cnt_users:"0";?></h3>
			  <p>App Users</p>
			</div>
			<div class="icon">
			  <i class="fa fa-users"></i>
			</div>
			<a href="<?php echo base_url("admin/users");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<?php } ?>
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">		  
			  <h3><?php echo $donor->cnt_donor?$donor->cnt_donor:"0";?></h3>
			  <p>Blood Donors</p>
			</div>
			<div class="icon">
			  <i class="fa fa-users"></i>
			</div>
			<a href="<?php echo base_url("admin/view_blood_donation");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-red">
			<div class="inner">				  
			  <h3><?php echo $volume->cnt_volume?$volume->cnt_volume:"0";?></h3>
			  <p>No. of Units</p>
			</div>
			<div class="icon">
			  <i class="fa fa-tint"></i>
			</div>
			<a href="<?php echo base_url("admin/view_blood_donation");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-purple">
			<div class="inner">				  
			  <h3><?php echo $camps->cnt_camps?$camps->cnt_camps:"0";?></h3>
			  <p>Camps</p>
			</div>
			<div class="icon">
			  <i class="fa fa-mobile"></i>
			</div>
			<a href="<?php echo base_url("admin/camps");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
                <?php if($this->session->userdata("login_parent") == '1') {?>
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-olive">
			<div class="inner">				  
			  <h3><i class="fa fa-search"></i></h3>
			  <p>Blood Availability</p>
			</div>
			<div class="icon">
			  <i class="fa fa-tint"></i>
			</div>
			<a href="<?php echo base_url("admin/outblood-availability");?>" class="small-box-footer" >More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<?php } ?>
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-maroon">
			<div class="inner">				  
			  <h3><i class="fa fa-bar-chart-o"></i></h3>
			  <p>Pie Chart</p>
			</div>
			<div class="icon">
			  <i class="fa fa-tint"></i>
			</div>
			<a href="javascript:void(0);" class="small-box-footer fa_charts">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
	  </div> 
	  <!-- /.row -->
	  <div class="row">
			<div class="col-lg-12 col-xs-12">  
				<div id="gmap_markers" style="height: 500px;"></div>
				<div id="content_show"></div>
			</div>
	  </div>
	</section>
	<!-- /.content -->
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqEJLWTEC94kryhT5XnbBz6Jsecqxdadk" type="text/javascript"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/maps/jquery.min.js"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/maps/gmaps.js"></script>
<script>
    $(function() {
        //Markers
        var markers = new GMaps({
            div: '#gmap_markers',
            lat: 16.000,
            lng: 80.000,
            zoom: 8
        });
        var infowindow = new google.maps.InfoWindow();
        <?php 
            if(count($mps) > 0){
                foreach($mps as $mp){
                    if( $mp->lattitude != "" && $mp->longitude != ""){ 
                    $contentString = '<div class="">'
                                . '<h5><b>'.str_replace("'","",$mp->bloodbank_name).'</b></h5>' 
                                . '<div>'.trim($mp->district).','.trim($mp->city).'</div>'
                                . '<div><i class="fa fa-envelope text-success"></i> '.trim($mp->email_id).'</div>'
                                . '<div><i class="fa fa-phone text-success"></i> '.trim($mp->mobile).'</div>'
                                . '<div class="text-red"><i class="fa fa-tint"></i> <b>Blood Availability</b> </div>'
                                . '<div>A+ve : '.$mp->Apos.', A-ve : '.$mp->Aneg.', B+ve : '.$mp->Bpos.', B-ve : '.$mp->Bneg.',<br/> AB+ve : '.$mp->ABpos.',  AB-ve : '.$mp->ABneg.', O+ve : '.$mp->Opos.', O-ve : '.$mp->Oneg.'</div>'
                                . '</div>';
                                    ?>
        markers.addMarker({
            lat: <?php echo $mp->lattitude;?>,
            lng: <?php echo $mp->longitude;?>,
            icon:'<?php  
            if($mp->btype_id == '4btype'){
                echo "http://apbloodcell.com/resources/jdadmin_assets/12.png";
            }
            if($mp->btype_id == '3btype'){
                echo "http://apbloodcell.com/resources/jdadmin_assets/16.png";
            }
            ?>',
            infoWindow: {
                content: '<?= $contentString;?>'
            }
        });
        markers.addListener('mouseover', function() {
            infowindow.open(map, marker);
        });
        <?php }
            }
       }
       ?>
    });
</script>