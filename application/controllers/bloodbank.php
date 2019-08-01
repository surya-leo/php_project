<?php


class bloodbank extends CI_Controller {
    //put your code here
    private $registered_mobile = -1;
    
    function __construct() {
        parent::__construct();       
            $this->output->set_header("requestCode: ".$this->input->post_get('requestCode'));        
            if($this->input->post_get('unique_code') && $this->input->post_get('phone')){
                    $registered = $this->device_model->registed_device();
                    $jason_response = array(
                        'status_code'       =>  "0",
                        'status_message'    =>  'Phone number not exists.',
                        'requestCode'       =>  $this->input->post_get('requestCode')
                    );
                    if($registered == 'registered' || $registered == 'donated'){
                        $this->registered_mobile = 1;
                    } else
                        echo json_encode($jason_response);
            }else{ 
                    $jason_response = array(
                        'status_code'       =>  "1",
                        'status_message'    => 'Phone number and unique code are missing',
                        'requestCode'       => $this->input->post_get('requestCode')
                    );
                    echo json_encode($jason_response);
            }
    }
    function get_bank_details(){
		if($this->registered_mobile == -1){
			return;
		}
                if($this->input->post("bloodbank_id") != ''){
		$schedules = $this->bloodbank_model->get_bloodbankd();
                        $jason_response     =   array(
                                                'status_code'       => 3,
                                                'status_message'    => 'Viewing Blood Bank details',
                                                'requestCode'       => $this->input->post_get('requestCode'),
                                                'blood_bank_info'   => $schedules
                                        ); 
                } else {
                        $jason_response     =   array(
                                                'status_code'       => 2,
                                                'status_message'    => 'Blood Bank is required',
                                                'requestCode'       => $this->input->post_get('requestCode') 
                                        ); 
                }
		echo json_encode($jason_response);
}
        function get_bloodbanks(){    
                if($this->registered_mobile == -1 ){
                        return;
                }
                $location_summary = $this->bloodbank_model->get_locations();
                $jason_response     =   array(
                                                'status_code'       => 2,
                                                'status_message'    => 'Viewing Blood Banks',
                                                'requestCode'       => $this->input->post_get('requestCode'),
                                                'blood_bank_info'   => $location_summary
                                        ); 
                echo json_encode($jason_response);   
        }
    
    function get_inventory(){
		if($this->registered_mobile == -1 ){
			return;
		}	
        $this->load->library('form_validation');
        $this->form_validation->set_rules('blood_group','Blood Group','required|trim|xss_clean');
        if ($this->form_validation->run() === FALSE){
            $jason_response = array(
                'status_code' => 11,
                'status_message' => 'Blood Group Missing',
                'requestCode' => $this->input->post_get('requestCode')
            );            
            echo json_encode($jason_response);   
        }else{ 
            $blood_inventory = $this->bloodbank_model->get_inventory();
            echo json_encode($blood_inventory);
        }
    }
    
    function make_request(){
		if($this->registered_mobile == -1){
			return;
		}
		$this->load->library('form_validation');
        $this->form_validation->set_rules('blood_group','Blood Group','required|trim|xss_clean');
		if ($this->form_validation->run() === FALSE){
            $jason_response = array(
                'status_code' => 11,
                'status_message' => 'Blood Group or Components Missing',
                'requestCode' => $this->input->post_get('requestCode')
            );
            $this->output->set_output(json_encode($jason_response));   
        }else{ 
            $request_status = $this->bloodbank_model->make_request();
            echo json_encode($request_status);
        }
    }
    
    function get_camp_schedules(){
		if($this->registered_mobile == -1){
			return;
		}
		$schedules = $this->bloodbank_model->get_schedules();
		echo json_encode($schedules);
    }
    
    function book_donation(){
		if($this->registered_mobile == -1){
			return;
		}
		$this->form_validation->set_rules('slot_id','Slot ID','required|trim|xss_clean');
		if ($this->form_validation->run() === FALSE){
            $jason_response = array(
                'status_code' => 11,
                'status_message' => 'Slot ID or Bloodbank ID missing',
                'requestCode' => $this->input->post_get('requestCode')
            );
            echo json_encode($jason_response);   
        }else{
			$booking_id = $this->bloodbank_model->book_donation();
			echo json_encode($booking_id);
		}
    }
    function get_schedule(){
	if($this->registered_mobile == -1){
		return;
	}
	$schedules = $this->bloodbank_model->get_schedules();
	echo json_encode($schedules);
    }
    function blood_groups(){
		if($this->registered_mobile == -1){
			return;
		}
		$blood_groups = $this->bloodbank_model->blood_groups();
		echo json_encode($blood_groups);
	}
	function history(){
		if($this->registered_mobile == -1){
			return;
		}
		$blood_groups = $this->blood_bank_model->history();
		echo json_encode($blood_groups);
	}
        public function appointments(){
                if($this->registered_mobile == -1){
			return;
		}
                if($this->input->post("bloodbank_id") != "" && $this->input->post("date_slot") != "" && $this->input->post("time_slot") != ""){
                        $this->message_model->send_schedule_mail();
                        $appointment_id     =   $this->message_model->appointments();
                        if($appointment_id > 0){
                                $json_response  =   array(
                                                            'status_code'       =>  "4",
                                                            'status_message'    =>  'Scheduled Appointments Successfully', 
                                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                                    );
                        }else{
                                $json_response  =   array(
                                                            'status_code'       =>  "3",
                                                            'status_message'    =>  'Not Scheduled any Appointments', 
                                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                                    );
                        }
                }else{
                        $json_response  =   array(
                                                            'status_code'       =>  "2",
                                                            'status_message'    =>  'Bloodbank or Date or Time are missing', 
                                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                                    );
                }
                echo json_encode($json_response);
        }
        public function request_blood(){
                if($this->registered_mobile == -1){
			return;
		}
                if($this->input->post("bloodbank_id") != "" && $this->input->post("date_slot") != "" && $this->input->post("first_name") != ""){
                        
                        $this->message_model->send_schedule();
                        $appointment_id     =   $this->message_model->request_blood();
                        if($appointment_id > 0){
                                $json_response  =   array(
                                                            'status_code'       =>  "4",
                                                            'status_message'    =>  'Requested Blood Successfully', 
                                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                                    );
                        }else{
                                $json_response  =   array(
                                                            'status_code'       =>  "3",
                                                            'status_message'    =>  'Not requested any blood', 
                                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                                    );
                        }
                }else{
                        $json_response  =   array(
                                                            'status_code'       =>  "2",
                                                            'status_message'    =>  'Some fields are missing', 
                                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                                    );
                }
                echo json_encode($json_response);
        }
}
