<?php 
class Login extends CI_Controller{
		public function __construct(){
				parent::__construct();
				$this->config->set_item('enable_query_strings',FALSE);
		}
		public function index(){
				if($this->session->userdata("login_id") != ""){
						redirect("admin/dashboard");
				}
				if($this->input->post("submit")){
						$this->form_validation->set_rules("email","Email Id","required|trim|xss_clean|valid_email");
						$this->form_validation->set_rules("password","Password","required|trim|xss_clean|min_length[6]|max_length[20]");
						if($this->form_validation->run() == TRUE){
								$ins 	=		$this->login_model->authenticate(); 
								if($ins){ 
                                                                        redirect("admin/dashboard");
								}else{
                                                                        $this->session->set_flashdata("err","Login Failed");
                                                                        redirect("admin");
								}
						}
				}
				$this->load->view("admin/layout/login");
		}
		public function logout(){
				$this->session->sess_destroy();
				redirect("admin");
		}
}