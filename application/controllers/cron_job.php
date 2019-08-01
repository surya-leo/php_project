<?php

class Cron_Job extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index(){        
     //   if($user_name=='admin' && $password=='ssrdowap'){
            $this->load->model('donor_model');
            $new_bloodbank = $this->donor_model->initialize_new_bank();
            $status = $this->donor_model->update_donors_data();
            echo $status;
     //   }else{            
            
     //   }            
    }

}

?>
