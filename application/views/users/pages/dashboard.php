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
			<a href="<?php echo base_url("users/view_blood_bank");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>  
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">		  
			  <h3><?php echo $donor->cnt_donor?$donor->cnt_donor:"0";?></h3>
			  <p>Donation History</p>
			</div>
			<div class="icon">
			  <i class="fa fa-clock-o"></i>
			</div>
			<a href="<?php echo base_url("users/view_blood_donation");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
			<a href="<?php echo base_url("users/view_blood_donation");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
			<a href="<?php echo base_url("users/camps");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-olive">
			<div class="inner">				  
			  <h3><i class="fa fa-search"></i></h3>
			  <p>Search Blood Availability</p>
			</div>
			<div class="icon">
			  <i class="fa fa-tint"></i>
			</div>
			<a href="http://www.bloodbank.nhp.gov.in/" class="small-box-footer" target="_blank">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>  
	  	<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
			<div class="inner">				  
			  <h3><i class="fa fa-user"></i></h3>
			  <p>Profile</p>
			</div>
			<div class="icon">
			  <i class="fa fa-user"></i>
			</div>
			<a href="<?php echo base_url("users/profile");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
	  <!-- /.row -->
	  <div class="row">
			<div class="col-lg-12 col-xs-12">
				<div id="gmap_markers" style="height: 500px;"></div>
			</div>
	  </div>
	</section>
	<!-- /.content -->
</div>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDg7KBgSdpwzcOy4UKASS-JFxU9y5tTj8&callback=initMap"
  type="text/javascript"></script>
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/maps/jquery.min.js"></script>

<!-- Google Maps API Js -->
<!-- <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script> -->

<!-- GMaps PLugin Js -->
<script src="<?php echo $this->config->item("jsadmin_assets");?>plugins/maps/gmaps.js"></script> 
<!-- Custom Js -->
<script >

$(function () {
		//Markers
		var markers = new GMaps({
			div: '#gmap_markers',
			lat: 16.000,
			lng: 80.000,
			zoom:8
		});
		<?php 
			if(count($mps) > 0){
				foreach($mps as $mp){
				if( $mp->lattitude != "" && $mp->longitude != ""){
						?>
				markers.addMarker({
					lat: <?php echo $mp->lattitude;?>,
					lng: <?php echo $mp->longitude;?>,
					title: "<?php echo $mp->bloodbank_name.' '.$mp->city;?>"
				});
			 <?php }
			 }
		   }
		   ?>
});
</script> 
<!-- jQuery 2.2.3 -->