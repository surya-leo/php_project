<table  class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Blood Bank Name</th> 
			<th>District</th>
			<th>City</th>
			<th>Date</th>
			<th>Camps</th> 
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
			<?php  
			if(count($view) > 0){
					$i = 1;
					foreach($view as $vw){
							if($vw->category == "Private"){
									$vep 	=	"cadetblue";
							}
							if($vw->category == "Charity"){
									$vep 	=	"antiquewhite";
							}
							if($vw->category == "Government"){
									$vep 	=	"gold";
							}
							if($vw->category == ""){
									$vep 	=	"";
							}
					?>
					<tr class="<?php echo $vep;?>">
						<td><?php echo $limit++;?></td>
						<td><?php echo $vw->bloodbank_name;?></td> 
						<td><?php echo $vw->district;?></td> 
						<td><?php echo $vw->city;?></td>
						<td><?php echo date("d F Y",strtotime($vw->camp_date));?></td> 
						<td><?php echo $vw->camp_description;?></td> 
						<td>
							<a href="<?php echo base_url("cm/schedules/".$vw->camp_id);?>" class="btn btn-sm btn-info"></i> Register</a>
						</td>
					</tr> 
					<?php
					} 
			}else{
					echo "<tr><td colspan='6'>Active Blood Bank Camps are not available</td></tr>";
			}
			?>
	</tbody>
	<tfoot>
			<tr>
				<th>S.No.</th>
				<th>Blood Bank Name</th> 
				<th>District</th>
				<th>City</th>
				<th>Date</th>
				<th>Camps</th> 
				<th>Action</th>
			</tr>
	</tfoot>
</table>
<?php echo $this->ajax_pagination->create_links();?>