<?php

class donor extends CI_Controller{ 
        private $registered_mobile = -1;
        function __construct() {
                parent::__construct();
                header("requestCode: ".$this->input->post_get('requestCode'));
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
        function register_donor(){
            if($this->registered_mobile == -1){
                    return;
            }
            if($this->input->post_get('phone') && $this->input->post_get('name')){
                    $donor_id = $this->donor_model->register_donor();
                    $json_response = array();
                    if($donor_id == "-2"){		
                            $json_response = array(
                                'status_code'       =>  '5',
                                'status_message'    =>  'Phone number missing',
                                'requestCode'       =>  $this->input->post_get('requestCode') 
                            );
                    }else if($donor_id == -3){
                            $json_response = array(
                                'status_code'       =>  '4',
                                'status_message'    =>  'Phone number already exists',
                                'requestCode'       =>  $this->input->post_get('requestCode')
                            );
                    }else{
                            $json_response = array(
                                'status_code'       =>  '3',
                                'status_message'    =>  'Registered as donor Successful',
                                'requestCode'       =>  $this->input->post_get('requestCode'),
                                'donor_id'          =>  $donor_id
                            );
                    }	    
            }else{
                    $json_response = array(
                            'status_code'       =>  '2',
                            'status_message'    =>  'Phone number or name missing',
                            'requestCode'       =>  $this->input->post_get('requestCode')
                    );
            }
            echo json_encode($json_response);
        }

        function get_summary(){
                if($this->registered_mobile == -1){
                    return;
                } 
                $donation_summary = $this->donor_model->get_donation_summary();
                $donor_details = $this->donor_model->get_donor_details();
                $jason_response='';
                if(sizeof($donor_details) > 0){
                        $jason_response = array( 
                            'status_code'       =>  '2',
                            'status_message'    =>  'Viewing Donation Summary',
                            'requestCode'       =>  $this->input->post_get('requestCode'),
                            "donation_summary"  =>  array( 
                                                        "name"              => $donor_details[0]->name,
                                                        'blood_group'       => $donor_details[0]->blood_group,
                                                        'location'          => '',
                                                        'donations'         => $donation_summary 
                                                    )
                        );	    
                }else{
                        $donor_mobile_profile = $this->donor_model->get_user_profile();
                        if($donor_mobile_profile == -2){
                                $jason_response = array(
                                    'status_code'       => '4',
                                    'status_message'    => 'Invalid Access',
                                    'requestCode'       => $this->input->post_get('requestCode')
                                );            
                        }else{
                                $jason_response = array( 
                                    'status_code'       =>  '3',
                                    'status_message'    =>  'Viewing Profile Summary',
                                    'requestCode'       =>  $this->input->post_get('requestCode'),
                                    "profile_summary"   =>  $donor_mobile_profile
                                ); 
                        }
                }
                echo json_encode($jason_response);
        }
    function get_profile(){
            if($this->registered_mobile == -1){
                    return;
            } 
            $get_details  = $this->donor_model->get_user_profile();
            if(sizeof($get_details) > 0){
                    $jsoc = array(
                            'status_code'       =>  '2',
                            'status_message'    =>  'Profile details viewing',
                            'requestCode'       =>  $this->input->post_get('requestCode'),
                            "profile_details"   =>  $get_details
                    );
            }
            else{
                    $jsoc = array(
                            'status_code'       =>  '3',
                            'status_message'    => 'Invalid Access',
                            'requestCode'       => $this->input->post_get('requestCode')
                    );  
            }
            echo json_encode($jsoc);
    }
    function edit_profile(){
            if($this->registered_mobile == -1){
                    return;
            } 
            $get_details  = $this->donor_model->edit_profile();
            if($get_details > 0){
                            $jsoc = array(
                                    'status_code'       => 3,
                                    'status_message'    => 'Updated Profile successfully',
                                    'requestCode'       => $this->input->post_get('requestCode')
                            ); 
            }
            else{
                            $jsoc = array(
                                    'status_code'       => "2",
                                    'status_message'    => 'Profile not updated successfully',
                                    'requestCode'       => $this->input->post_get('requestCode')
                            );  
            }
            echo json_encode($jsoc);
    }
}

?>
