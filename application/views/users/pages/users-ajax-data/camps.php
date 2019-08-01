<table class="table table-bordered table-hover">
    <thead>
                            <tr>
                              <th>S.No.</th>  
                              <th>Camp Message</th>  
    </thead>
    <tbody>
                            <?php 
                            if(count($view) > 0){
                                    $i = 1;
                                    foreach($view as $vw){
                                    ?>
                                    <tr>
                                      <td><?php echo $i++;?></td>  
                                      <td><?php echo $vw->camp_description;?></td>  
                                    </tr> 
                                    <?php
                                    } 
                            }
                            ?>
    </tbody>
    <tfoot>
                            <tr>
                              <th>S.No.</th>  
                              <th>Camp Message</th>  
                            </tr>
    </tfoot>
  </table>
<?php echo $this->ajax_pagination->create_links();?>