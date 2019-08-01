 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users  
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
					  <th>Age</th> 
					  <th>Gender</th> 
					  <th>Location</th> 
					  <th>Blood Group</th> 
					</tr>
                </thead>
                <tbody>
					<?php 
					if(count($view) > 0){
											foreach($view as $vw){
						?>
						<tr>   
						  <td><?php echo ($vw->age)?$vw->age:"N/A";?></td> 
						  <td><?php echo ($vw->sex)?$vw->sex:"N/A";?></td> 
						  <td><?php echo ($vw->location)?$vw->location:"N/A";?></td> 
						  <td><?php echo ($vw->blood_group)?$vw->blood_group:"N/A";?></td> 
						</tr> 
						<?php
						} 
					}
					?>
                </tbody>
                <tfoot>
					<tr>   
					  <th>Age</th> 
					  <th>Gender</th> 
					  <th>Location</th> 
					  <th>Blood Group</th> 
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