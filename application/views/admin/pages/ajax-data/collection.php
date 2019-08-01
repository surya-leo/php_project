<table class="table-striped table table-bordered">
                                <thead>
                                    <tr> 
                                        <th>Date</th>
                                        <th>Blood Bank Name</th>
                                        <th>No. of Donors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if(count($view) > 0){
                                    foreach ($view as $ve){
                                        ?>
                                    <tr>
                                        <td><?php echo $ve->tc_date;?></td>
                                        <td><?php echo $ve->bloodbank_name;?></td>
                                        <td><?php echo $ve->cnt;?></td>  
                                    </tr> 
                                        <?php
                                    }
                                }else{
                                        echo "<tr><td colspan='5'>Blood Collection details are not available</td></tr>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr> 
                                        <th>Date</th>
                                        <th>Blood Bank Name</th>
                                        <th>No. of Donors</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php echo $this->ajax_pagination->create_links();?>