<table class="table table-striped table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Blood Components</th>
            <th>Issue</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if(count($view)>0){
        $i  =   1;
        foreach($view as $ve){
                ?>
                <tr>
                    <form action="issue/<?php echo $ve->request_id;?>" method="post" >
                        <td><?php echo $i++;?></td>
                        <td><?php echo $ve->patient_first_name." ".$ve->patient_last_name;?></td>
                       <td><?php echo ($ve->patient_gender == 2)?"Female":"Male";?></td>
                        <td><?php echo $ve->blood_group;?></td>
                        <td>
                            <input type="text" value="<?php echo $ve->blood_group;?>" hidden name="blood_group" />
                            <div class="col-label">
                            <?php 
                            if($ve->whole_blood_units!=0){
                                    echo "<label class='label label-success'><b>WB: ".$ve->whole_blood_units;
                                    echo "</b><input type='text' value='\"WB\"' hidden name='components[]' /></label>";
                            }
                            if($ve->packed_cell_units!=0){
                                    echo "<label class='label label-info'><b>PC: ".$ve->packed_cell_units;
                                    echo "</b><input type='text' value='\"PC\"' hidden name='components[]' /></label> ";
                            }
                            if($ve->fp_units!=0){
                                    echo "<label class='label label-warning'><b>FP: ".$ve->fp_units;
                                    echo "</b><input type='text' value='\"FP\"' hidden name='components[]' /></label> ";
                            }
                            if($ve->ffp_units!=0){
                                    echo "<label class='label label-primary'><b>FFP: ".$ve->ffp_units;
                                    echo "</b><input type='text' value='\"FFP\"' hidden name='components[]' /></label> ";
                            }
                            if($ve->prp_units!=0){
                                    echo "<label class='label bg-navy'><b>PRP : ".$ve->prp_units;
                                    echo "</b><input type='text' value='\"PRP\"' hidden name='components[]' /></label> ";
                            }
                            if($ve->platelet_concentrate_units!=0){
                                    echo "<label class='label bg-teal'><b>Platelet Concentrate: ".$ve->platelet_concentrate_units;
                                    echo "</b><input type='text' value='\"Platelet Concentrate\"' hidden name='components[]' /></label> ";
                            }
                            if($ve->cryoprecipitate_units!=0){
                                    echo "<label class='label bg-gray'><b>Cryo: ".$ve->cryoprecipitate_units;
                                    echo "</b><input type='text' value='\"Cryo\"' hidden name='components[]' /></label> ";
                            }
                            ?>
                            </div>
                        </td>
                        <td> 
<input type="submit" value="Issue" class="btn btn-success btn-xs" name="select_request" onclick="submit_request('<?php echo $ve->request_id;?>')"/> </td>
                    </form>
                </tr>
                <?php
        }
    } else {
            echo "<tr><td colspan='6'>No Blood Requests</td></tr>";
    }
    ?>
    </tbody>
    <tfoot>
            <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Blood Group</th>
                <th>Blood Components</th>
                <th>Issue</th>
            </tr>
    </tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>