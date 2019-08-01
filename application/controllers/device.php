<?php 
class Device extends CI_Controller{
    //put your code here
        private $registered_mobile = -1;
        function __construct() {
                parent::__construct();
                header("requestCode: ".$this->input->post_get('requestCode')); 
        }
        function login(){ 
                if($this->session->userdata('logged_in')=='yes'){
                        $json_response = array(
                                'status_code'       =>  "5",
                                'status_message'    =>  'Login Successfull',
                                'session_id'        =>  $this->session->userdata('session_id'),
                                'requestCode'       =>  $this->input->post_get('requestCode')
                        );
                        echo json_encode($json_response);
                }
                else if( $this->input->post_get('otp') && $this->input->post_get('phone')){
                        $unique_code = $this->device_model->registered();
                        if($unique_code == '-1'){ 
                        }
                        else if($unique_code == -2){
                                $unique_code = $this->device_model->register_device();
                        }
                        if($unique_code > 0){
                                $user_session_data = array(
                                        'logged_in' => 'yes'
                                );
                                $this->session->set_userdata($user_session_data);
                                $session_all = $this->session->all_userdata();
                                $json_response = array(
                                        'status_code'       =>  "4",
                                        'status_message'    =>  'Registration Successfull',
                                        'requestCode'       =>  $this->input->post_get('requestCode'),
                                        'donor_id'          =>  $this->donor_model->get_donor_details(),
                                        'session_id'        =>  $this->session->userdata('session_id'),
                                        'unique_code'       =>  "$unique_code",
                                        'all'               =>  $session_all
                                );
                                echo json_encode($json_response); 
                        }else{
                                $json_response = array(
                                        'status_code'       => "3",
                                        'status_message'    => 'Invalid OTP or OTP has been Expired',
                                        'requestCode'       => $this->input->post_get('requestCode')
                                );
                                echo json_encode($json_response); 
                        }  
                }
                else if(($this->input->post_get('phone')) && ($this->input->post_get('unique_code'))){
                        if($this->device_model->registed_device()){
                                $session_all = $this->session->all_userdata();
                                $json_response  =   array(
                                                        'status_code'       => "5",
                                                        'status_message'    => 'Login Successfull',
                                                        'requestCode'       => $this->input->post_get('requestCode'),
                                                        'donor_id'          => $this->donor_model->get_donor_details(),
                                                        'session_id'        => $this->session->userdata('session_id'),
                                                        'all'               => $session_all
                                                    );                
                        }else{
                                $json_response  =    array(
                                                        'status_code'       => "6",
                                                        'status_message'    => 'Invalid Access',
                                                        'requestCode'       => $this->input->post_get('requestCode')
                                                    );  
                        }
                        echo json_encode($json_response);
                }
                else if(($this->input->post_get('phone'))){ 
                        $otp            =   rand(1000, 9999);
                        $json_response  =   array(
                                                'status_code'       =>  "1",
                                                'status_message'    =>  'OTP Sent',
                                                'requestCode'       =>  $this->input->post_get('requestCode')
                                            );	    
                        $tu     =   $this->device_model->log_otp($otp);
                        if($tu){
                                echo json_encode($json_response);                      
                        }else{
                                $json_response  =   array(
                                                            'status_code'       =>  "2",
                                                            'status_message'    =>  'OTP has been not sent',
                                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                                    );
                                echo json_encode($json_response);  
                        }
                }
                else{	    
                        show_404();
                }
        }
        function logout(){
                $this->session->sess_destroy();
                $json_response  =   array(
                                            'status_code'       =>  "1",
                                            'status_message'    =>  'Logged out successfully',
                                            'requestCode'       =>  $this->input->post_get('requestCode')
                                    );
                echo json_encode($json_response);  
        }
        public function index(){
                $this->config->set_item('enable_query_strings',FALSE); 
                if($this->input->post("submit")){
                                $this->form_validation->set_rules("phone","Mobile No.","required|min_length[10]|max_length[10]");
                                if($this->form_validation->run() == TRUE){
                                                $otp = rand(1000, 9999);
                                                $vl 	= $this->device_model->log_otp($otp);
                                                if($vl){
                                                                $this->session->set_flashdata("suc","OTP Sent Successfully to your Mobile No.");
                                                                redirect("otp");
                                                }else{
                                                     $this->session->set_flashdata("err","OTP has been not Sent to your Mobile No.");
                                                       redirect("/");
                                                }
                                }
                }
                $this->load->view("login");
        }
        public function otp(){
                $this->config->set_item('enable_query_strings',FALSE); 
                if($this->input->post("submit")){
                                $this->form_validation->set_rules("phone","Mobile No.","required|min_length[10]|max_length[10]");
                                $this->form_validation->set_rules("otp","OTP","required|min_length[4]|max_length[4]");
                                if($this->form_validation->run() == TRUE){
                                            $unique_code = $this->device_model->registered(); 
                                            if($unique_code == -2){
                                                            $unique_code = $this->device_model->register_device();
                                            }	    
                                            // else if($unique_code) 
                                            if($unique_code > 0){
                                                    $get_dta	=	$this->donor_model->get_user_profile();
                                                    if(count($get_dta) > 0){  
                                                            $this->session->set_userdata("unique_code",$unique_code);
                                                            $this->session->set_userdata("phone",$this->input->post("phone"));
                                                            $this->session->set_userdata("profile",$get_dta);
                                                            $this->session->set_userdata("since",$unique_code);
                                                            $this->session->set_userdata("unique_code",$this->donor_model->get_since());
                                                            $this->session->set_userdata("users",$this->donor_model->get_donor_details()); 
                                                            $session_all = $this->session->all_userdata();  
                                                            redirect("users/dashboard");
                                                    }else{
                                                                    redirect("register");
                                                    }
                                            }else{
                                                            $this->session->set_flashdata("err","OTP Sent Successfully to your Mobile No.");
                                                            redirect("otp");
                                            } 
                                }
                }
                $this->load->view("otp");
        }
		public function register(){
				$this->config->set_item('enable_query_strings',FALSE); 
				$dta['ct']	=	$this->bloodbank_model->blood_groups();
$dta['district'] = $this->common_model->district();
				if($this->input->post("submit")){
						$this->form_validation->set_rules("phone","Mobile No.","required|min_length[10]|max_length[10]");
						$this->form_validation->set_rules("name","Name","required");
						$this->form_validation->set_rules("blood_group","Blood Group","required");
						if($this->form_validation->run() == TRUE){
								$unique_code = $this->donor_model->register_donor(); 
								if($unique_code > 0){ 
										$user_session_data = array(
												'unique_code' 	=>  $unique_code,
												'profile'	 	=>  $this->donor_model->get_user_profile(),
												"since"			=>	$this->donor_model->get_since(),
												"users"			=>	$this->donor_model->get_donor_details(),
												"phone"			=>	$this->input->post("phone")
										);
										$this->session->set_userdata($user_session_data);
										$session_all = $this->session->all_userdata(); 
										redirect("users/dashboard"); 
								}else{
										$this->session->set_flashdata("err","Not Registered Successfully your Mobile No and details.");
										redirect("register");
								} 
						}
				}
				$this->load->view("register",$dta);
		}
		public function districts(){
			echo json_encode($this->common_model->district());
		}
}