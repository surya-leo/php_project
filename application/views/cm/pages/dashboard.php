<section class="content">
    <div class="" id="mg_dtaa">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <a href="javascript:void(0);" class="small-box-footer fa_bank" uri="Blood Bank">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $blood_banks->cnt_bank?$blood_banks->cnt_bank:"0";?></h3>
                            <p>Blood Banks</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bank"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_bank" uri="Mother Blood Bank">
                    <div class="small-box bg-gray-active">
                        <div class="inner">
                            <h3><?php echo $mother_banks?$mother_banks:"0";?></h3>
                            <p>Mother Blood Banks</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bank"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_bank" uri="Blood Storage Centre">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $storage->cnt_bank?$storage->cnt_bank:"0";?></h3>
                            <p>Blood Storage Centre</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bank"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6"> 
                <a href="javascript:void(0);" class="small-box-footer fa_bank" uri="BCTV (Blood Collection and Transportation Vehicles)">
                    <div class="small-box bg-fuchsia">
                        <div class="inner">
                            <h3><?php echo $bctv->cnt_bank?$bctv->cnt_bank:"0";?></h3>
                            <p>BCTV</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-x fa-bank"></i>
                        </div>
                    </div>
                </a> 
            </div>
            
            <div class="col-lg-3 col-xs-6"> 
                <div class="small-box bg-teal">
                    <div class="inner">
                        <!-- <h3><?php //echo ($app->app_count)?$app->app_count:"0";?></h3> -->
                        <h3>30426</h3>
                        <p>Total App Downloads</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-download"></i>
                    </div>
                </div> 
            </div> 
            <!---
            <div class="col-lg-3 col-xs-6"> 
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 class="users"><?php echo $users->cnt_users?$users->cnt_users:"0";?></h3>
                        <p>Total App Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div> 
            </div> -->
            <!---
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_camps">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3 class="camps"><?php echo $camps->cnt_camps?$camps->cnt_camps:"0";?></h3>
                            <p>Total Camps</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-mobile"></i>
                        </div>
                    </div>
                </a>
            </div> -->
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_accamps">
                    <div class="small-box bg-green-gradient">
                        <div class="inner">
                            <h3 class="camps"><?php echo $accps?$accps:"0";?></h3>
                            <p>Active Camps</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-mobile"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_avail">
                    <div class="small-box bg-purple-gradient">
                        <div class="inner">
                            <h3>
                    <?php
                        $total  =   "0";
                        foreach ($bloodav as $ve){ 
                            $total  +=   $ve->Apos+$ve->Aneg+$ve->Bpos+$ve->Bneg+$ve->ABpos+$ve->ABneg+$ve->Opos+$ve->Oneg;
                        }
                        echo $total;
                    ?>
                    </h3>
                            <p>Current Blood Availability</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tint"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_discarded">
                    <div class="small-box bg-aqua-active">
                        <div class="inner">
                            <h3> <?php echo ($expriy)?$expriy:"0";?></h3>
                            <p>Blood Expiry within a Week</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tint"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_collect">
                    <div class="small-box bg-lyellow-gradient">
                        <div class="inner">
                            <h3>
                     <?php
                      $total1  =   "0";
                      foreach ($bloav as $ve){ 
                          $total1  +=   $ve->Apos+$ve->Aneg+$ve->Bpos+$ve->Bneg+$ve->ABpos+$ve->ABneg+$ve->Opos+$ve->Oneg;
                      }
                      echo $total1;
                  ?></h3>
                            <p>Blood Daily Collections</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tint"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_charts">
                    <div class="small-box bg-yellow-gradient">
                        <div class="inner">
                            <h3><i class="fa fa-pie-chart"></i></h3>
                            <p>Pie Chart for Blood Donated Users</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tint"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_bargraph">
                    <div class="small-box bg-teald-gradient">
                        <div class="inner">
                            <h3><i class="fa fa-bar-chart"></i></h3>
                            <p>Bar Graphs with Blood Availability</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="http://apbloodsanitation.com/" class="small-box-footer" target="_blank">
                    <div class="small-box bg-te-gradient">
                        <div class="inner">
                            <h3><i class="fa fa-trash"></i></h3>
                            <p>Sanitation Appraisal</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bank"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="http://gps.gamyamtech.com/#/apsacsdashboard?autologin=true&client=bctvDashboard" class="small-box-footer" target="_blank">
                    <div class="small-box btn-twitter">
                        <div class="inner">
                            <h3><i class="fa fa-map-marker"></i> </h3>
                            <p>Live Track BCTV</p>
                        </div> 
                        <div class="icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                    </div>
                </a>
            </div>
            
            <!---<div class="col-lg-3 col-xs-6">
                <a href="javascript:void(0);" class="small-box-footer fa_blodcollection">
                    <div class="small-box btn-cadetblue">
                        <div class="inner">
                            <h3><i class="fa fa-bar-chart"></i> </h3>
                            <p>District Blood Collection & Availbility</p>
                        </div> 
                        <div class="icon">
                            <i class="fa fa-bar-chart"></i>
                        </div>
                    </div>
                </a>
            </div> -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div id="gmap_markers" style="height: 500px;"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div id="content_show"></div>
        </div>
    </div>
</section>
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