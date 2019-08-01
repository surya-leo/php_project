<table class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>Blood Bank Name</th>
					  <th>Distirct</th>
					  <th>Mobile No</th>
					  <th>Email Id</th>
					  <th>Category</th> 
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						foreach($view as $vw){
						?>
						<tr>
						  <td><?php echo $vw->bloodbank_name;?></td>
						  <td><?php echo $vw->district;?></td>
						  <td><?php echo $vw->mobile;?></td>
						  <td><?php echo $vw->email_id;?></td>
						  <td><?php echo $vw->category;?></td> 
						</tr> 
						<?php
						} 
                                        } else{
                                                echo "<tr><td colspan='5'>BloodBanks not available</td></tr>";
                                        }
					?>
                </tbody>
                <tfoot>
					<tr>
					  <th>Blood Bank Name</th>
					  <th>State</th>
					  <th>Mobile No</th>
					  <th>Email Id</th>
					  <th>Category</th> 
					</tr>
                </tfoot>
              </table>
                                <?php echo $this->ajax_pagination->create_links();?>