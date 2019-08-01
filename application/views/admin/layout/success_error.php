 <?php  if($this->session->flashdata("err") != ""){?>
 <div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-ban"></i> Alert!</h4>
	<?php echo $this->session->flashdata("err");?>
  </div>
 <?php }  if($this->session->flashdata("war") != ""){?> 
  <div class="alert alert-warning alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-check"></i> Alert!</h4>
	<?php echo $this->session->flashdata("war");?>
  </div>
  <?php }  if($this->session->flashdata("suc") != ""){?> 
  <div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-check"></i> Alert!</h4>
	<?php echo $this->session->flashdata("suc");?>
  </div>
  <?php } ?>