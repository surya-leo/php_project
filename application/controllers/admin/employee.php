<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Employee extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-employees") != '1'){
                        redirect("admin");
                }
        }
        public function create_employee(){
                if($this->session->userdata("create-employee") != '1'){
                        redirect("admin");
                }
                $dta    =   array(
                        "title"         =>      "Employee",
                        "content"       =>      "version_2/employee/create_employee",
                        "blood_groups" 	=>      $this->bloodbank_model->blood_groups(),
                        "district" 	=>      $this->common_model->district(),
                );
                if($this->input->post("submit")){ 
                        $this->form_validation->set_rules("blood_group","Blood Group","required");
                        $this->form_validation->set_rules("district","District","required"); 
                        $this->form_validation->set_rules("gender","Gender","required"); 
                        $this->form_validation->set_rules("email_id","Email Id","required|xss_clean|trim|max_length[250]|valid_email|callback_emailid");
                        $this->form_validation->set_rules("mobile","Mobile No.","required|xss_clean|trim|max_length[10]|callback_mobileno");
                        $this->form_validation->set_rules("first_name","First Name","required|xss_clean|trim|max_length[250]");
                        $this->form_validation->set_rules("last_name","Last Name","required|xss_clean|trim|max_length[250]");
                        $this->form_validation->set_rules("dob","DOB","required|xss_clean|trim|max_length[250]");
                        $this->form_validation->set_rules("assign_bloodbank[]","Assign Blood Bank","required");
                        if($this->form_validation->run() == TRUE){
                                $set =	$this->employee_model->create_employee();
                                if($set > 0){
                                        $this->session->set_flashdata("suc","Employee has been created Successfully.");
                                        redirect("admin/create-employee");
                                }else{
                                        $this->session->set_flashdata("err","Employee has been not created Successfully.");
                                        redirect("admin/create-employee");
                                }
                        }
                } 
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function emailid($str){
                $vsp	=	$this->employee_model->check_user("login_email",$str);
                $esp	=	$this->employee_model->check_euser("email_id",$str);
                if($vsp || $esp){
                        $this->form_validation->set_message("emailid","Email Id already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function mobileno($str){
                $vsp	=	$this->employee_model->check_euser("mobile_no",$str);
                if($vsp){
                        $this->form_validation->set_message("mobileno","Mobile No. already exists.");
                        return FALSE;
                }	
                return TRUE;
        }
        public function view_employees(){
                if($this->session->userdata("view-employees") != '1'){
                        redirect("admin");
                }
                $dta 	=	array(
                                        "title"		=>	"View Employees",
                                        "content"	=>	"version_2/employee/employees"
                                );
                $totalRec              =    $this->employee_model->cntview_employees();
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewEmployee';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta["view"]           =    $this->employee_model->view_employees(array('limit'=>$this->perPage));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewEmployee(){
                if($this->session->userdata("view-employees") != '1'){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3'); 
                $offset =  ($page != "")?$page:"0"; 
                $keywords       =   $this->input->post('keywords')?$this->input->post('keywords'):""; 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $totalRec              =    $this->employee_model->cntview_employees($conditions);
                $perpage               =   "15"; 
                $config['base_url']    =    base_url().'admin/viewEmployee';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']   =    $offset;
                $conditions['limit']   =    $perpage;
                $dt["view"]            =    $this->employee_model->view_employees($conditions);
                $this->load->view("admin/pages/ajax-data/employee",$dt);
        }
        public function update_employee(){
                if($this->session->userdata("update-employee") != '1'){
                        redirect("admin");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->employee_model->get_employee($uri); 
                if(count($vue) > 0){                                    
                    $dt     =   array(
                            "title"             =>      "Update Employee",
                            "content"           =>      "version_2/employee/update-employee",
                            "blood_groups" 	=>      $this->bloodbank_model->blood_groups(),
                            "district"          =>      $this->common_model->district(),
                            "blood_banks" 	=>      $this->blood_bank_model->view_change_distr($vue->emp_district),
                            "view"              =>      $vue
                    ); 
                    if($this->input->post("submit")){
                            $this->form_validation->set_rules("blood_group","Blood Group","required");
                            $this->form_validation->set_rules("gender","Gender","required");   
                            $this->form_validation->set_rules("district","District","required"); 
                            $this->form_validation->set_rules("first_name","First Name","required|xss_clean|trim|max_length[250]");
                            $this->form_validation->set_rules("last_name","Last Name","required|xss_clean|trim|max_length[250]");
                            $this->form_validation->set_rules("dob","DOB","required|xss_clean|trim|max_length[250]");
                            $this->form_validation->set_rules("assign_bloodbank[]","Assign Blood Bank","required");
                            if($this->form_validation->run() == TRUE){
                                    $bt     =   $this->employee_model->update_employee($uri);
                                    if($bt > 0){
                                            $this->session->set_flashdata("suc","Updated Employee details Successfully.");
                                            redirect("admin/update-employee/".$uri);
                                    }else{
                                            $this->session->set_flashdata("err","Not Updated Employee.Please try again.");
                                            redirect("admin/update-employee/".$uri);    
                                    }
                            }
                    }
                }else{
                        $this->session->set_flashdata("war","Employees does not exists."); 
                        redirect("admin/view-employees");
                }
                $this->load->view("admin/layout/inner_template",$dt);
        }
        public function delete_employee(){
                if($this->session->userdata("delete-employee") != '1'){
                        redirect("admin");
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->employee_model->get_employee($uri);
                if(count($vue) > 0){
                        $vt     =   $this->employee_model->delete_employee($uri); 
                        if($vt > 0){
                                $this->session->set_flashdata("suc","Deleted Employee Successfully.");
                                redirect("admin/view-employees");
                        }else{
                                $this->session->set_flashdata("err","Not Deleted Employee.Please try again.");
                                redirect("admin/view-employees");    
                        }
                }else{
                        $this->session->set_flashdata("war","Employee does not exists."); 
                        redirect("admin/view-employees");
                }
        }
}