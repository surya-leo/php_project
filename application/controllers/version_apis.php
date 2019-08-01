<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Version_apis extends CI_Controller{
        private $registered_mobile = -1;
        public function __construct() {
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
                        } else{
                            echo json_encode($jason_response);
                        }
                }else{ 
                        $jason_response = array(
                            'status_code'       =>  "1",
                            'status_message'    => 'Phone number and unique code are missing',
                            'requestCode'       => $this->input->post_get('requestCode')
                        );
                        echo json_encode($jason_response);
                }
        }
        public function blood_not_satisifed() { 
                if($this->registered_mobile == -1){
			return;
		}
                $vtg    =   $this->version2_model->blood_not_satisifed();
                if($vtg){
                        $json_response  =   array(
                                                    'status_code'       =>  "3",
                                                    'status_message'    =>  'Blood request has been not met the need', 
                                                    'requestCode'       =>  $this->input->post_get('requestCode')
                                            );
                }else{
                        $json_response  =   array(
                                                    'status_code'       =>  "2",
                                                    'status_message'    =>  'Failed', 
                                                    'requestCode'       =>  $this->input->post_get('requestCode') 
                                            );
                }
		echo json_encode($json_response);
        }
        public function camps(){
                if($this->registered_mobile == -1){
			return;
		}
		$caps = $this->camp_model->get_fequery();
                if(count($caps) > 0){
                        $json_response  =   array(
                                                    'status_code'       =>  "3",
                                                    'status_message'    =>  'Viewing Blood Bank Camps', 
                                                    'requestCode'       =>  $this->input->post_get('requestCode'),
                                                    'camps_details'     =>  $caps
                                            );
                }else{
                        $json_response  =   array(
                                                    'status_code'       =>  "2",
                                                    'status_message'    =>  'No Camps to view', 
                                                    'requestCode'       =>  $this->input->post_get('requestCode')
                                            );
                }
		echo json_encode($json_response);
        }
        public function blood_availability(){
                if($this->registered_mobile == -1){
			return;
		}
		$caps   =   $this->version2_model->blood_avquery();
                $group  =   ($this->input->post("blood_group") != "")?$this->version2_model->get_bloodgrop($this->input->post("blood_group")):"";
                if(count($caps) > 0){
                        $blood   =   array();
                        foreach ($caps as $key =>   $bt){
	                       	    $blood[$key]['bloodbank_id']         =   $bt->bloodbank_id;
                                $blood[$key]['bloodbank_name']       =   $bt->bloodbank_name;
                                $blood[$key]['type_name']            =   $bt->btype_name;
                                $blood[$key]['district']             =   $bt->district;
                                $blood[$key]['city']                 =   $bt->city;
                                $blood[$key]['mobile']               =   $bt->mobile;
                                $blood[$key]['email_id']             =   $bt->email_id;
                                $blood[$key]['address']              =   $bt->address;
                                $blood[$key]['lattitude']            =   $bt->lattitude;
                                $blood[$key]['longitude']            =   $bt->longitude; 
                                $blood[$key]['category']             =   $bt->category;
                                $blood[$key]['distance']             =   round($bt->distance);
                                if($group == "All" || $group == ""){
                                    $blood[$key]['bloodbank_group']['Apos']     =   $bt->Apos;
                                    $blood[$key]['bloodbank_group']['Aneg']     =   $bt->Aneg;
                                    $blood[$key]['bloodbank_group']['Bpos']     =   $bt->Bpos;
                                    $blood[$key]['bloodbank_group']['Bneg']     =   $bt->Bneg; 
                                    $blood[$key]['bloodbank_group']['ABpos']    =   $bt->ABpos;
                                    $blood[$key]['bloodbank_group']['ABneg']    =   $bt->ABneg;
                                    $blood[$key]['bloodbank_group']['Opos']     =   $bt->Opos;
                                    $blood[$key]['bloodbank_group']['Oneg']     =   $bt->Oneg;   
                                } 
                                if($group == "A+ve"){
                                    $blood[$key]['bloodbank_group']['Apos']     =   $bt->Apos; 
                                }
                                if($group == "A-ve"){
                                    $blood[$key]['bloodbank_group']['Aneg']     =   $bt->Aneg; 
                                }
                                if($group == "B+ve"){
                                    $blood[$key]['bloodbank_group']['Bpos']     =   $bt->Bpos; 
                                }
                                if($group == "B-ve"){
                                    $blood[$key]['bloodbank_group']['Bneg']     =   $bt->Bneg; 
                                }
                                if($group == "AB+ve"){
                                    $blood[$key]['bloodbank_group']['Apos']     =   $bt->ABpos; 
                                }
                                if($group == "AB-ve"){
                                    $blood[$key]['bloodbank_group']['Aneg']     =   $bt->ABneg; 
                                }
                                if($group == "O+ve"){
                                    $blood[$key]['bloodbank_group']['Opos']     =   $bt->Opos; 
                                }
                                if($group == "O-ve"){
                                    $blood[$key]['bloodbank_group']['Oneg']     =   $bt->Oneg; 
                                } 
                        }
                        $json_response  =   array(
                                                    'status_code'       =>  "3",
                                                    'status_message'    =>  'Viewing Blood Availability', 
                                                    'requestCode'       =>  $this->input->post_get('requestCode'),
                                                    'blood_details'     =>  $blood
                                            );
                }else{
                        $json_response  =   array(
                                                    'status_code'       =>  "2",
                                                    'status_message'    =>  'No Blood Banks to view', 
                                                    'requestCode'       =>  $this->input->post_get('requestCode') 
                                            );
                }
		echo json_encode($json_response);
        }
}