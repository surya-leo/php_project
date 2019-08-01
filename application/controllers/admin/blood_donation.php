<?php 
class Blood_donation extends CI_Controller{
		public function __construct(){
                        parent::__construct();
                        $this->config->set_item('enable_query_strings',FALSE);
                        if($this->session->userdata("manage-blood-donation") != "1"){
                                redirect("admin");
                        }  
		}
		public function create_form(){
			if($this->session->userdata("create-blood-donation") != "1"){
                                redirect("admin");
                        }  
                        $dta 	=	array(
                                                "title"		=>	"Bloodbank Donation Form",
                                                "content"	=>	"donation_form",
                                                "blood_groups" 	=>      $this->bloodbank_model->blood_groups(),
                                                "fe_camps" 	=>      $this->camp_model->fe_camps(),
                                                "blood_name" 	=>      $this->blood_bank_model->view_blood(), 
                                        );
                        $donr_id    =   "";
                        $id         =   $this->session->userdata("login_id");
                        $vgp        =   $this->blood_bank_model->edit_blood($id);
                        if(count($vgp) > 0){
                                $donr_id    =   $vgp->blood_bank_code; 
                        }
                        if($this->input->post("submit")){
                                if($this->session->userdata("login_parent") == "1"){
                                    $id     =   $this->input->post("blood_name");
                                }else{
                                    $id     =   $this->session->userdata("login_id");
                                }
                                $vgp    =   $this->blood_bank_model->edit_blood($id); 
                                $this->form_validation->set_rules("donor_id","Donor Id","required|trim|xss_clean|callback_isbagnummber[$vgp->blood_bank_code]");
                                $this->form_validation->set_rules("mobile","Mobile","required|trim|xss_clean");
                                $this->form_validation->set_rules("dname","Name","required|trim|xss_clean");
                                $this->form_validation->set_rules("sex","Gender","required|trim|xss_clean");
                                $this->form_validation->set_rules("blood_group","Blood Group","required|xss_clean");
                                $this->form_validation->set_rules("volume","Volume","required|xss_clean|is_numeric");
                                if($this->session->userdata("login_type") == "1"){
                                        $this->form_validation->set_rules("blood_name","Blood Bank Name","required|xss_clean"); 
                                }
                                $mob    =   $this->input->post('mobile');
                                $this->form_validation->set_rules("donation_date","Donation Date","required|xss_clean|callback_datecheck[$mob]");   
                                $donr_id    =   $vgp->blood_bank_code;
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->blood_bank_model->register_blooddonor();
                                        if($set > 0){
                                                $this->session->set_flashdata("suc","Blood Donor Details Registered Successfully.");
                                                redirect("admin/create_blood_donation");
                                                //redirect("admin/donor_medical_checkup/".$set);
                                        }else{
                                                $this->session->set_flashdata("err","Blood Donor Details not registered Successfully.");
                                                redirect("admin/create_blood_donation");
                                        }
                                }
                        } 
                        $dta["bag_number"] = $donr_id;
                        $this->load->view("admin/layout/inner_template",$dta);
		}
                function isbagnummber($pots,$param){
                        if($this->session->userdata("login_parent") == "1"){
                            $id     =   $this->input->post("blood_name");
                        }else{
                            $id     =   $this->session->userdata("login_id");
                        }
                        $vgp    =   $this->blood_bank_model->edit_blood($id);
                        $pst    =   $vgp.$pots;
                        $set    =   $this->blood_bank_model->check_bag($pots,$pst,array("mobile" => $this->input->post('mobile')));
                        if($pots == $param){
                                $this->form_validation->set_message('isbagnummber', 'Concatenate Id Number with the Blood bank code');
                                return FALSE; 
                        }
                        if (!$set) {
                            return TRUE;
                        }else{
                                $this->form_validation->set_message('isbagnummber', 'Donor Id already exists.');
                                return FALSE; 
                        }
                }
                public function datecheck($val,$mob){
                        if($mob != ""){
                                $cp  =  $this->blood_bank_model->datecheck($val,$mob); 
                                if (!$cp){
                                    return true;
                                }
                                $this->form_validation->set_message('datecheck', 'Already donated the blood between the 3 months');
                                return FALSE;  
                        }
                }
		public function edit_form(){
                        if($this->session->userdata("update-blood-donation") != "1"){
                                redirect("admin");
                        }
                        $dta 	=	array(
                                        "title"		=>	"Bloodbank Donation Form",
                                        "content"	=>	"edit_form",
                                        "blood_groups" 	=>      $this->bloodbank_model->blood_groups(),
                                        "fe_camps" 	=>      $this->camp_model->fe_camps(),
                                        "blood_name" 	=>      $this->blood_bank_model->view_blood()
                        );
                        $id = $this->uri->segment("3");
                        if($this->input->post("submit")){  
                                $this->form_validation->set_rules("mobile","Mobile","required|trim|xss_clean");
                                $this->form_validation->set_rules("dname","Name","required|trim|xss_clean");
                                $this->form_validation->set_rules("sex","Gender","required|trim|xss_clean");
                                $this->form_validation->set_rules("blood_group","Blood Group","required|xss_clean");
                                $this->form_validation->set_rules("volume","Volume","required|xss_clean|is_numeric");
                                if($this->session->userdata("login_type") == "1"){
                                        $this->form_validation->set_rules("blood_name","Blood Bank Name","required|xss_clean"); 
                                } 
                                $this->form_validation->set_rules("donation_date","Donation Date","required|xss_clean");  
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->blood_bank_model->update_blooddonor($id);
                                        if($set > 0){
                                            $this->session->set_flashdata("suc","Blood Donor Details updated Successfully.");
                                            redirect("admin/edit_blood_donation/".$id);
                                        }else{
                                            $this->session->set_flashdata("err","Blood Donor Details not updated Successfully.");
                                            redirect("admin/edit_blood_donation/".$id);
                                        }
                                }
                        }
                        $dta["view"]	=	$this->blood_bank_model->view_blooddonorid($id);
                        $this->load->view("admin/layout/inner_template",$dta);
		}
		public function view_form(){
                        if($this->session->userdata("view-blood-donation") != "1"){
                                redirect("admin");
                        }  
                        $dta 	=	array(
                                            "title"	=>	"View Bloodbank Donations",
                                            "content"	=>	"view_blooddonor"
                                        ); 
                        $val    =   date("Y-m-d");
                        $msg    =   date("Y-m-d",strtotime("-1 day",strtotime($val)))." - ".$val;
                        //$params['daterange']    =   $msg; 
                        $totalRec              =    $this->blood_bank_model->cntview_blooddonor($params); 
                        $this->perPage         =   "15"; 
                        $config['base_url']    =    base_url().'admin/viewBlooddonor';
                        $config['total_rows']  =    $totalRec;
                        $config['per_page']    =    $this->perPage; 
                        $config['link_func']   =    'searchFilter'; 
                        $params['limit']    =   $this->perPage; 
                        $this->ajax_pagination->initialize($config);
                        $dta["view"]	=	$this->blood_bank_model->view_blooddonor($params);
                        $this->load->view("admin/layout/inner_template",$dta);
		}
                public function viewBlooddonor(){
                        if($this->session->userdata("view-blood-donation") != "1"){
                                redirect("admin");
                        }
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
                        $val    =   date("Y-m-d");
                        $msg    =   date("Y-m-d",strtotime("-1 day",strtotime($val)))." - ".$val;
                        $conditions['daterange']    =   $msg; 
                        $bg = $this->blood_bank_model->cntview_blooddonor($conditions);
                        $totalRec	=	$bg;
                        $this->perPage  =   "15"; 
                        $config['base_url']    = base_url().'admin/viewBlooddonor';
                        $config['total_rows']  = $totalRec;
                        $config['per_page']    = $this->perPage; 
                        $config['link_func']   = 'searchFilter';
                        $this->ajax_pagination->initialize($config);
                        $conditions['start'] = $offset;
                        $conditions['limit'] = $this->perPage;
                        $dta 	=	array(
                                "title"		=>	"View Bloodbank Donations", 
                                "view"          =>      $this->blood_bank_model->view_blooddonor($conditions)
                        ); 
                        $this->load->view("admin/pages/ajax-data/blooddonor",$dta);
                }
}