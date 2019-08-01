<table id="" class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>Donor Id</th>
					  <th>Blood Bank Name</th>
					  <th>Name</th>
					  <th>Blood Group</th>
					  <th>Mobile No</th> 
					  <th>No. of Units</th>
					  <th>Donation Date</th>
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						foreach($view as $vw){
						?>
						<tr>
						  <td><?php echo $vw->donor_id;?></td>						  
						  <td><?php echo $vw->bloodbank_name;?></td>						  
						  <td><?php echo $vw->name;?></td>
						  <td><?php echo $vw->blood_group;?></td>
						  <td><?php echo $vw->mobile;?></td>
						  <td><?php echo $vw->volume;?></td>
						  <td><?php echo $vw->donation_date;?></td>
						</tr> 
						<?php
						} 
					}
					?>
                </tbody>
                <tfoot>
					<tr>
					  <th>Donor Id</th>
                                          <th>Blood Bank Name</th>
					  <th>Name</th>
					  <th>Blood Group</th>
					  <th>Mobile No</th> 
					  <th>Volume</th>
					  <th>Donation Date</th> 
					</tr>
                </tfoot>
              </table>
                                <?php echo $this->ajax_pagination->create_links();?>