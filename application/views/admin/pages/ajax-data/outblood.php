<table class="table table-bordered table-hover filterable">
    <thead>
        <tr>     
           <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank</th>
            <th>District</th>
            <th>City</th>
            <?php } ?>  
            <th class="bg-light-yellow">A+ve</th> 
            <th class="bg-light-yellow">A-ve</th> 
            <th class="bg-light-pink">B+ve</th> 
            <th class="bg-light-pink">B-ve</th>  
            <th class="bg-white">AB+ve</th> 
            <th class="bg-white">AB-ve</th> 
            <th class="bg-info">O+ve</th> 
            <th class="bg-info">O-ve</th> 
<!--                                <th class="bg-yellow-active">Rh+ve</th> 
            <th class="bg-green-gradient">Rh-ve</th>-->
            <th class="bg-purple">Total</th> 
            <th>Updated On</th>
        </tr>
    </thead> 
    <tbody>
        <?php 
        if(count($view) > 0){
            $total  =   "0";
            foreach ($view as $ve){
//                                    $total  =   $ve->Apos+$ve->Aneg+$ve->Bpos+$ve->Bneg+$ve->ABpos+$ve->ABneg+$ve->Opos+$ve->Oneg+$ve->Rhpos+$ve->Rhneg;
                $total  =   $ve->Apos+$ve->Aneg+$ve->Bpos+$ve->Bneg+$ve->ABpos+$ve->ABneg+$ve->Opos+$ve->Oneg;
                if($ve->category == "Private"){
                                $vep 	=	"cadetblue";
                }
                if($ve->category == "Charity"){
                                $vep 	=	"antiquewhite";
                }
                if($ve->category == "Government"){
                                $vep 	=	"gold";
                }
                if($ve->category == ""){
                                $vep 	=	"";
                }
        ?>
        <tr class="<?php echo $vep;?>">
                   <?php if($this->session->userdata("login_type") != '5utype') {?>
                    <td><?php echo $ve->bloodbank_name;?></td>
                    <td><?php echo $ve->district;?></td>
                    <td><?php echo $ve->city;?></td>
                    <?php } ?>  
                    <td class="bg-light-yellow"><?php echo $ve->Apos;?></td>  
                    <td class="bg-light-yellow"><?php echo $ve->Aneg;?></td>   
                    <td class="bg-light-pink"><?php echo $ve->Bpos;?></td>  
                    <td class="bg-light-pink"><?php echo $ve->Bneg;?></td>  
                    <td class="bg-white"><?php echo $ve->ABpos;?></td>  
                    <td class="bg-white"><?php echo $ve->ABneg;?></td>  
                    <td class="bg-info"><?php echo $ve->Opos;?></td>  
                    <td class="bg-info"><?php echo $ve->Oneg;?></td>  
            <!--                                        <td class="bg-yellow-active"><?php // echo $ve->Rhpos;?></td>  
                    <td class="bg-green-gradient"><?php // echo $ve->Rhneg;?></td>  -->
                    <td class="bg-purple"><?php echo $total;?></td> 
                    <td><?php echo date("d M Y H:i:s",strtotime($ve->out_updated_on));?></td> 
                </tr>
                <?php
            }
        }else {
                echo "<tr><td>Blood availability not available</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>     
           <?php if($this->session->userdata("login_type") != '5utype') {?>
            <th>Blood Bank</th>
            <th>District</th>
            <th>City</th>
            <?php } ?> 
            <th class="bg-light-yellow">A+ve</th> 
            <th class="bg-light-yellow">A-ve</th> 
            <th class="bg-light-pink">B+ve</th> 
            <th class="bg-light-pink">B-ve</th>  
            <th class="bg-white">AB+ve</th> 
            <th class="bg-white">AB-ve</th> 
            <th class="bg-info">O+ve</th> 
            <th class="bg-info">O-ve</th> 
<!--                                <th class="bg-yellow-active">Rh+ve</th> 
            <th class="bg-green-gradient">Rh-ve</th>-->
            <th class="bg-purple">Total</th> 
            <th>Updated On</th>
        </tr>
    </tfoot>
</table>
<div class="col-sm-12">
    <?php echo $this->ajax_pagination->create_links();?>
</div>