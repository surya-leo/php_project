     <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Blood Donor Details  
      </h1> 
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
		<div class="box box-default"> 
			<div class="box-body">
				<table id="example2" class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>Donor Id</th> 
					  <th>Blood Group</th> 
					  <th>No. of Units</th>
					  <th>Donation Date</th>
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
						$i = 1;
						foreach($view as $vw){
						?>
						<tr>   
						  <td><?php echo $vw->donor_id;?></td> 
						  <td><?php echo $vw->blood_group;?></td> 
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
					  <th>Blood Group</th> 
					  <th>Volume</th>
					  <th>Donation Date</th> 
					</tr>
                </tfoot>
              </table>
			</div>
		</div>
	</section> 
		
<script> 
	$('#example2').DataTable({
		  "paging": true,
		  "lengthChange": true, 
		  "ordering": true,
		  "info": true,
		  "autoWidth": true
    }); 
</script>