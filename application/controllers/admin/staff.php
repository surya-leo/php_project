<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staff extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE); 
                if($this->session->userdata("manage-blood-bank-staff") != "1"){
                        redirect("admin");
                }            
        }
        public function index(){
                if($this->session->userdata("view-blood-bank-staff") != "1"){
                        redirect("admin");
                }
                $totalRec              =   $this->staff_model->cntview_staff();
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewStaff';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta 	=	array(
                        "title"		=>	"Staff",
                        "content"	=>	"version_2/staff/view-staff",
                        "view"          =>      $this->staff_model->view_staffs(array('limit'=>$this->perPage))
                ); 
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function create_staff(){
                if($this->session->userdata("create-blood-bank-staff") != "1"){
                        redirect("admin");
                }
                $dta 	=	array(
                        "title"		=>	"Staff",
                        "content"	=>	"version_2/staff/create_staff",
                        "blood_groups" 	=>      $this->bloodbank_model->blood_groups(),
                        "blood_name" 	=>      $this->blood_bank_model->view_blood()
                );
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("blood_group","Blood Group","required");
                        $this->form_validation->set_rules("gender","Gender","required");
                        if($this->session->userdata("login_parent") == '1'){
                                $this->form_validation->set_rules("blood_name","Blood Bank Name","required");
                        }
                        $this->form_validation->set_rules("email_id","Email Id","required|xss_clean|trim|max_length[250]|valid_email|callback_emailid");
                        $this->form_validation->set_rules("mobile","Mobile No.","required|xss_clean|trim|max_length[10]|callback_mobileno");
                        $this->form_validation->set_rules("first_name","First Name","required|xss_clean|trim|max_length[250]");
                        $this->form_validation->set_rules("last_name","Last Name","required|xss_clean|trim|max_length[250]");
                        $this->form_validation->set_rules("dob","DOB","required|xss_clean|trim|max_length[250]");
                        if($this->form_validation->run() == TRUE){
                                $set =	$this->staff_model->create_staff();
                                if($set > 0){
                                        $this->session->set_flashdata("suc","Staff has been created Successfully.");
                                        redirect("admin/create-staff");
                                }else{
                                        $this->session->set_flashdata("err","Staff has been not created Successfully.");
                                        redirect("admin/create-staff");
                                }
                        }
                }
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function emailid($str){
                $vsp	=	$this->staff_model->check_user("l.login_email",$str);
                if($vsp){
                        $this->form_validation->set_message("emailid","Email Id already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function mobileno($str){
                $vsp	=	$this->staff_model->check_euser("s.staff_mobile_no",$str);
                if($vsp){
                        $this->form_validation->set_message("mobileno","Mobile No. already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function viewStaff(){
                if($this->session->userdata("view-blood-bank-staff") != "1"){
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
                $totalRec               =   $this->staff_model->cntview_staff($conditions);
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewStaff';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"Staff", 
                        "view"          =>      $this->staff_model->view_staffs($conditions)
                ); 
                $this->load->view("admin/pages/version_2/staff/ajax-data",$dta);
        }
        public function update_staff(){
                if($this->session->userdata("update-blood-bank-staff") != "1"){
                        redirect("admin");
                }
                $uri    =       $this->uri->segment(3);
                $vsp    =       $this->staff_model->get_staff($uri);
                if(count($vsp) > 0){
                        $dta 	=	array(
                                "title"		=>	"Staff",
                                "content"	=>	"version_2/staff/update_staff",
                                "blood_groups" 	=>      $this->bloodbank_model->blood_groups(),
                                "blood_name" 	=>      $this->blood_bank_model->view_blood(),
                                "view"          =>      $vsp
                        );
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("blood_group","Blood Group","required");
                                $this->form_validation->set_rules("gender","Gender","required");
                                if($this->session->userdata("login_parent") == '1'){
                                        $this->form_validation->set_rules("blood_name","Blood Bank Name","required");
                                }
                                $this->form_validation->set_rules("first_name","First Name","required|xss_clean|trim|max_length[250]");
                                $this->form_validation->set_rules("last_name","Last Name","required|xss_clean|trim|max_length[250]");
                                $this->form_validation->set_rules("dob","DOB","required|xss_clean|trim|max_length[250]");
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->staff_model->update_staff($uri);
                                        if($set > 0){
                                                $this->session->set_flashdata("suc","Staff has been created Successfully.");
                                                redirect("admin/update-staff/".$uri);
                                        }else{
                                                $this->session->set_flashdata("err","Staff has been not created Successfully.");
                                                redirect("admin/update-staff/".$uri);
                                        }
                                }
                        }
                }else {
                        $this->session->set_flashdata("war","Staff does not exists.");
                        redirect("admin/view-staff");
                }
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function delete_staff(){
                if($this->session->userdata("update-blood-bank-staff") != "1"){
                        redirect("admin");
                }
                $uri    =       $this->uri->segment(3);
                $vsp    =       $this->staff_model->get_staff($uri);
                if(count($vsp) > 0){ 
                        $set =	$this->staff_model->delete_staff($uri);
                        if($set > 0){
                                $this->session->set_flashdata("suc","Staff has been deleted Successfully.");
                                redirect("admin/view-staff");
                        }else{
                                $this->session->set_flashdata("err","Staff has been not deleted Successfully.");
                                 redirect("admin/view-staff");
                        } 
                }else {
                        $this->session->set_flashdata("war","Staff does not exists.");
                        redirect("admin/view-staff");
                }
                $this->load->view("admin/layout/inner_template",$dta);
        }
}