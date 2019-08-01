<?php
class Users extends CI_Controller{
        public function __construct(){   
                parent::__construct();  
                if($this->session->userdata("unique_code") == ""){
                                redirect("/");
                }
                $this->config->set_item('enable_query_strings',FALSE); 
        }
        public function dashboard(){
                        $dta 	=	array(
                                        "title" 	=>	"Dashboard",
                                        "content"	=>	"dashboard",
                                        "blood_banks"	=>	$this->blood_bank_model->ctbloodbanks(),
                                        "donor"		=>	$this->blood_bank_model->cnt_get_donor(),
                                        "volume"	=>	$this->blood_bank_model->cnt_get_hist(),
                                        "users"		=>	$this->blood_bank_model->cnt_users(),
                                        "camps"		=>	$this->blood_bank_model->cnt_camps(),
                                        "mps"		=>	$this->blood_bank_model->view_blood() 
                        );
                        //echo "<pre>";print_r($this->session->all_userdata());echo "</pre>";exit;
                        $this->load->view("users/layout/inner_template",$dta);
        }
        public function view_blood_bank(){
                        $dta 	=	array(
                                        "title"		=>	"View Bloodbanks",
                                        "content"	=>	"view_blood"
                        );
                        $totalRec = count($this->blood_bank_model->view_blood());
                        $this->perPage         =   "15"; 
                        $config['base_url']    =    base_url().'users/userBloodbank';
                        $config['total_rows']  =    $totalRec;
                        $config['per_page']    =    $this->perPage; 
                        $config['link_func']   =    'searchFilter';
                        $this->ajax_pagination->initialize($config);
                        $dta["view"]	=	$this->blood_bank_model->view_blood(array('limit'=>$this->perPage));
                        $this->load->view("users/layout/inner_template",$dta);
        }
        public function userBloodbank(){
                $conditions = array();
                $page = $this->uri->segment('3');
                if(!$page){
                    $offset = 0;
                }else{
                    $offset = $page;
                }
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $totalRec = count($this->blood_bank_model->view_blood($conditions));
                $this->perPage  =   "15"; 
                $config['base_url']    = base_url().'users/userBloodbank';
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage; 
                $config['link_func']   = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"View Bloodbanks", 
                        "view"          =>      $this->blood_bank_model->view_blood($conditions)
                ); 
                $this->load->view("users/pages/users-ajax-data/bloodbank",$dta);
        }
        public function profile(){
                        $dta 	=	array(
                                        "title"		=>	"Profile",
                                        "content"	=>	"profile",
                                        "blod_group"=>	$this->bloodbank_model->blood_groups(),
                                        "district"	=>	$this->common_model->district()
                        );
                        if($this->input->post("submit")){
                                        $this->form_validation->set_rules("name","Name","required");
                                        $this->form_validation->set_rules("age","Age","required|min_length[2]|max_length[3]");
                                        $this->form_validation->set_rules("sex","Gender","required");
                                        $this->form_validation->set_rules("blood_group","Blood Group","required");
                                        $this->form_validation->set_rules("location","Location","required");
                                        if($this->form_validation->run() == TRUE){
                                                        $up 	=	$this->donor_model->edit_profile();
                                                        if($up > 0){
                                                                        $this->session->set_flashdata("suc","Updated Profile successfully.");
                                                                        redirect("users/profile");
                                                        }else{
                                                                        $this->session->set_flashdata("err","Not Updated Profile successfully.");
                                                                        redirect("users/profile");
                                                        }
                                        }
                        }
                        $dta["view"]	=	$this->donor_model->get_profile();
                        $this->load->view("users/layout/inner_template",$dta);
        }
        public function camps(){
                $dta 	=	array(
                                        "title"		=>	"Camps",
                                        "content"	=>	"camps" 
                );
                $totalRec = count($this->camp_model->view_camps());
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'users/userCamps';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta["view"]	=	$this->camp_model->view_camps(array('limit'=>$this->perPage));
                $this->load->view("users/layout/inner_template",$dta);
        }
        public function userCamps(){
                        $conditions = array();
                        $page = $this->uri->segment('3');
                        if(!$page){
                            $offset = 0;
                        }else{
                            $offset = $page;
                        }
                        $keywords       =   $this->input->post('keywords'); 
                        if(!empty($keywords)){
                            $conditions['keywords'] = $keywords;
                        }  
                        $totalRec = count($this->camp_model->view_camps($conditions));
                        $this->perPage  =   "15"; 
                        $config['base_url']    = base_url().'users/userCamps';
                        $config['total_rows']  = $totalRec;
                        $config['per_page']    = $this->perPage; 
                        $config['link_func']   = 'searchFilter';
                        $this->ajax_pagination->initialize($config);
                        $conditions['start'] = $offset;
                        $conditions['limit'] = $this->perPage;
                        $dta 	=	array(
                                "title"		=>	"View Camps", 
                                "view"          =>      $this->camp_model->view_camps($conditions)
                        ); 
                        $this->load->view("users/pages/users-ajax-data/camps",$dta);
        }
        public function view_blood_donation(){
				$dta 	=	array(
							"title"		=>	"Blood Donation",
							"content"	=>	"view_blooddonor", 
				);
                                $totalRec = count($this->blood_bank_model->get_hist());
                                $this->perPage         =   "15"; 
                                $config['base_url']    =    base_url().'users/userBlooddonor';
                                $config['total_rows']  =    $totalRec;
                                $config['per_page']    =    $this->perPage; 
                                $config['link_func']   =    'searchFilter';
                                $this->ajax_pagination->initialize($config);
				$dta["view"]	=	$this->blood_bank_model->get_hist(array('limit'=>$this->perPage));
				$this->load->view("users/layout/inner_template",$dta);
		} 
        public function userBlooddonor(){
                $conditions = array();
                $page = $this->uri->segment('3');
                if(!$page){
                    $offset = 0;
                }else{
                    $offset = $page;
                }
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $totalRec = count($this->blood_bank_model->get_hist($conditions));
                $this->perPage  =   "15"; 
                $config['base_url']    = base_url().'admin/userBlooddonor';
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage; 
                $config['link_func']   = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"Users", 
                        "view"          =>      $this->blood_bank_model->get_hist($conditions)
                ); 
                $this->load->view("users/pages/users-ajax-data/blooddonor",$dta);
        }
        public function appointments(){
                        $dta 	=	array(
                                                "title"		=>	"Manage Appointments",
                                                "content"	=>	"appointments",
                                                "blood_bank"	=>	$this->blood_bank_model->view_blood()
                        );
                        if($this->input->post("submit")){ ;
                                        $this->form_validation->set_rules("date_slot","Schedule Date","required");
                                        $this->form_validation->set_rules("time_slot","Schedule Time Slot","required");
                                        $this->form_validation->set_rules("bloodbank_id","Blood Bank","required"); 
                                        if($this->form_validation->run() == TRUE){
                                                        $up 	=	$this->message_model->send_schedule_mail();
                                                        $upa 	=	$this->message_model->appointments();
                                                        if($upa > 0){
                                                                        $this->session->set_flashdata("suc","Appointment has been schedule successfully.");
                                                                        redirect("users/appointments");
                                                        }else{
                                                                        $this->session->set_flashdata("err","Appointment has been Not schedule successfully.");
                                                                        redirect("users/appointments");
                                                        }
                                        }
                        }
                        $this->load->view("users/layout/inner_template",$dta);
        }
        public function request_blood(){
                        $dta 	=	array(
                                                "title"		=>	"Request Blood",
                                                "content"	=>	"request_blood",
                                                "blood_bank"	=>	$this->blood_bank_model->view_blood(),
                                                'ct'		=>	$this->bloodbank_model->blood_groups()
                        );
                        if($this->input->post("submit")){ ;
                                        $this->form_validation->set_rules("date_slot","Schedule Date","required");
                                        $this->form_validation->set_rules("bloodbank_id","Blood Bank","required");
                                        $this->form_validation->set_rules("blood_group","Blood Group","required");
                                        $this->form_validation->set_rules("first_name","First Name","required"); 
                                        $this->form_validation->set_rules("last_name","Last Name","required"); 
                                        $this->form_validation->set_rules("age","Age","required"); 
                                        $this->form_validation->set_rules("sex","Gender","required"); 
                                        $this->form_validation->set_rules("diag","Diagnosis or Description ","required"); 
                                        $this->form_validation->set_rules("doctor_name","Doctor Name","required"); 
                                        $this->form_validation->set_rules("hospi_name","Hospital Name","required"); 
//						$this->form_validation->set_rules("blood_comp","Blood Component","required"); 
                                        if($this->form_validation->run() == TRUE){
                                                        $up 	=	$this->message_model->send_schedule();
                                                        $upa 	=	$this->message_model->request_blood();
                                                        if($upa > 0){
                                                                        $this->session->set_flashdata("suc","Request for blood has been sent successfully.");
                                                                        redirect("users/request_blood");
                                                        }else{
                                                                        $this->session->set_flashdata("err","Request for blood has not been sent successfully.");
                                                                        redirect("users/request_blood");
                                                        }
                                        }
                        }
                        $this->load->view("users/layout/inner_template",$dta);
        }
        public function logout(){
                        $this->session->sess_destroy();
                        redirect("/");
        }
}
?>