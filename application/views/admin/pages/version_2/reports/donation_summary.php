<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Donation Summary
            <small>Viewing the Donation Summary</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Reports</a></li>
            <li class="active">Donation Summary</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Donation Summary Reports</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-2">From and To Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pull-right daterange" placeholder="Date ..." name="datem" value_url="<?php echo base_url(); ?>admin/viewDonationsummary/" /> 
                        </div>  
                        <label class="col-sm-2">Blood Bank</label>
                        <div class="col-sm-4">
                            <select class="form-control searbloodbank_id" name="bloodbank_id" onchange="search_summary('<?php echo base_url(); ?>admin/viewDonationsummary/')">
                                <option value="">Select Blood Bank</option>
                                <option value="All">All Blood Bank</option>
                                <?php 
                                if(count($blood_bank) > 0){
                                    foreach ($blood_bank as $bb){
                                        ?>
                                        <option value="<?php echo $bb->bloodbank_id;?>"><?php echo $bb->bloodbank_name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>  
                    </div> 
                </form> 
                <div class="col-sm-12">
                    <div class="form-group pull-right"> 
                        <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('',)"/>
                    </div>
                </div>
                <div class="postList"> 
                    <table class="table table-bordered table-hover filterable">
                        <thead>
                            <tr>  
                                <th>Date</th>
                                <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank</th>
                                <?php } ?>
                                <th>Camp Name</th> 
                                <th class="bg-yellow">Male</th> 
                                <th class="bg-purple">Female</th> 
                                <th class="bg-red">Total</th> 
                                
                                <th class="bg-light-yellow">A+ve</th> 
                                <th class="bg-light-yellow">A-ve</th> 
                                <th class="bg-light-pink">B+ve</th> 
                                <th class="bg-light-pink">B-ve</th>  
                                <th class="bg-white">AB+ve</th> 
                                <th class="bg-white">AB-ve</th> 
                                <th class="bg-info">O+ve</th> 
                                <th class="bg-info">O-ve</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($view) > 0){
                                    foreach($view as $vw){
                                    ?>
                                    <tr>  
                                      <td><?php echo $vw->donation_date;?></td>  
                                      <?php if($this->session->userdata("login_type") != '5utype') {?>
                                      <td><?php echo $vw->bloodbank_name;?></td>  
                                      <?php } ?>
                                      <td><?php echo ($vw->camp_description)?$vw->camp_description:"-";?></td>   
                                      <td class="bg-yellow"><?php echo $vw->male;?></td>  
                                      <td class="bg-purple"><?php echo $vw->female;?></td>  
                                      <td class="bg-red"><?php echo $vw->total;?></td>  
                                      <td class="bg-light-yellow"><?php echo $vw->Apos;?></td>  
                                      <td class="bg-light-yellow"><?php echo $vw->Aneg;?></td>   
                                      <td class="bg-light-pink"><?php echo $vw->Bpos;?></td>  
                                      <td class="bg-light-pink"><?php echo $vw->Bneg;?></td>  
                                      <td class="bg-white"><?php echo $vw->ABpos;?></td>  
                                      <td class="bg-white"><?php echo $vw->ABneg;?></td>  
                                      <td class="bg-info"><?php echo $vw->Opos;?></td>  
                                      <td class="bg-info"><?php echo $vw->Oneg;?></td>  
                                    </tr> 
                                    <?php
                                    } 
                                    $male1=0;$female1=0;$Apos1=0;$Aneg1=0;$Bpos1=0;$Bneg1=0;$ABpos1=0;$ABneg1=0;$Opos1=0;$Oneg1=0;$total1=0;
                                    if(count($per_view) > 0){
                                        foreach ($per_view as $ph){
                                                $male1   +=  $ph->male;
                                                $female1   +=  $ph->female;
                                                $total1   +=  $ph->total;
                                                $Apos1   +=  $ph->Apos;
                                                $Aneg1   +=  $ph->Aneg;
                                                $Bpos1   +=  $ph->Bpos;
                                                $Bneg1   +=  $ph->Bneg;
                                                $ABpos1   +=  $ph->ABpos;
                                                $ABneg1   +=  $ph->ABneg;
                                                $Opos1   +=  $ph->Opos;
                                                $Oneg1   +=  $ph->Oneg; 
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <?php if($this->session->userdata("login_type") != '5utype') {?>
                                        <th colspan="3">Total Per Page</th>
                                        <?php } else {  ?>
                                        <th colspan="2">Total Per Page</th>
                                        <?php }?>
                                        <th class="bg-yellow" align="right"><?php echo $male1;?></th>
                                        <th class="bg-purple" align="right"><?php echo $female1;?></th>
                                        <th class="bg-red" align="right"><?php echo $total1;?></th>
                                        <th class="bg-light-yellow" align="right"><?php echo $Apos1;?></th>
                                        <th class="bg-light-yellow" align="right"><?php echo $Aneg1;?></th>
                                        <th class="bg-light-pink" align="right"><?php echo $Bpos1;?></th>
                                        <th class="bg-light-pink" align="right"><?php echo $Bneg1;?></th>
                                        <th class="bg-white" align="right"><?php echo $ABpos1;?></th>
                                        <th class="bg-white" align="right"><?php echo $ABneg1;?></th>
                                        <th class="bg-info"align="right"><?php echo $Opos1;?></th>
                                        <th class="bg-info" align="right"><?php echo $Oneg1;?></th> 
                                    </tr>
                                    <?php 
                                    $male=0;$female=0;$Apos=0;$Aneg=0;$Bpos=0;$Bneg=0;$ABpos=0;$ABneg=0;$Opos=0;$Oneg=0;
                                    $Rhpos=0;$Rhneg=0;$total=0;
                                    if(count($cnt_view) > 0){
                                        foreach ($cnt_view as $bh){
                                                $male   +=  $bh->male;
                                                $female   +=  $bh->female;
                                                $total   +=  $bh->total;
                                                $Apos   +=  $bh->Apos;
                                                $Aneg   +=  $bh->Aneg;
                                                $Bpos   +=  $bh->Bpos;
                                                $Bneg   +=  $bh->Bneg;
                                                $ABpos   +=  $bh->ABpos;
                                                $ABneg   +=  $bh->ABneg;
                                                $Opos   +=  $bh->Opos;
                                                $Oneg   +=  $bh->Oneg;
                                                $Rhpos   +=  $bh->Rhpos;
                                                $Rhneg   +=  $bh->Rhneg;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <?php if($this->session->userdata("login_type") != '5utype') {?>
                                        <th colspan="3">Total </th>
                                        <?php } else {  ?>
                                        <th colspan="2">Total </th>
                                        <?php }?>
                                        <th class="bg-yellow" align="right"><?php echo $male;?></th>
                                        <th class="bg-purple" align="right"><?php echo $female;?></th>
                                        <th class="bg-red" align="right"><?php echo $total;?></th>
                                        <th class="bg-light-yellow" align="right"><?php echo $Apos;?></th>
                                        <th class="bg-light-yellow" align="right"><?php echo $Aneg;?></th>
                                        <th class="bg-light-pink" align="right"><?php echo $Bpos;?></th>
                                        <th class="bg-light-pink" align="right"><?php echo $Bneg;?></th>
                                        <th class="bg-white" align="right"><?php echo $ABpos;?></th>
                                        <th class="bg-white" align="right"><?php echo $ABneg;?></th>
                                        <th class="bg-info"align="right"><?php echo $Opos;?></th>
                                        <th class="bg-info" align="right"><?php echo $Oneg;?></th> 
                                    </tr>
                                    <?php 
                            }else{
                                    echo "<tr><td colspan='15'>Donation Summary data not available</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>  
                                <th>Date</th>
                                <?php if($this->session->userdata("login_type") != '5utype') {?>
                                <th>Blood Bank</th>
                                <?php } ?>
                                <th>Camp Name</th> 
                                <th class="bg-yellow">Male</th> 
                                <th class="bg-purple">Female</th> 
                                <th class="bg-red">Total</th> 
                                <th class="bg-light-yellow">A+ve</th> 
                                <th class="bg-light-yellow">A-ve</th> 
                                <th class="bg-light-pink">B+ve</th> 
                                <th class="bg-light-pink">B-ve</th>  
                                <th class="bg-white">AB+ve</th> 
                                <th class="bg-white">AB-ve</th> 
                                <th class="bg-info">O+ve</th> 
                                <th class="bg-info">O-ve</th> 
                            </tr>
                        </tfoot>
                    </table>
                    <?php echo $this->ajax_pagination->create_links();?>
                </div>
            </div>
        </div>
    </section>
</div>