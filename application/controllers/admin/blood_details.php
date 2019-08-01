<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Blood_details extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-issue-blood") != "1"){
                                redirect("admin");
                }                
        }
        public function issue_blood(){               
                $dta 	=	array(
                        "title"		=>	"Blood Issue",
                        "content"	=>	"version_2/blood_issue", 
                );
                $totalRec = $this->donation_details_model->cntblood_issue();
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewBloodissue';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta["view"]	=	$this->donation_details_model->blood_issue(array('limit'=>$this->perPage));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewBloodissue(){
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
                $totalRec               =    $this->donation_details_model->cntblood_issue($conditions);
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodissue';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->donation_details_model->blood_issue($conditions);
                $this->load->view("admin/pages/ajax-data/bloodissue",$dta);
        }
        public function issue(){                
                $uri    =   $this->uri->segment(3);                
                $ui     =   $this->donation_details_model->check_inventory($uri); 
                $dta 	=	array(
                        "title"		=>	"Blood Issue",
                        "content"	=>	"version_2/issue",
                        "inv"           =>      (count($ui)> 0)?$ui:array(),
                        "view"          =>      $this->donation_details_model->blood_issue_row($uri),
                        "staff"         =>      $this->staff_model->view_staffs()
                ); 
                if($this->input->post("submit")){  
                        $this->form_validation->set_rules("inventory_id[]","Action","required");
                        $this->form_validation->set_rules("staff_issue","Issue By","required");
                        $this->form_validation->set_rules("staff_forward","Cross Matched By","required");
                        $this->form_validation->set_rules("donation_date","Issue Date","required");
                        $this->form_validation->set_rules("donation_time","Issue Time","required"); 
                        if($this->form_validation->run() == TRUE){
                                $set =	$this->donation_details_model->issue($uri);
                                if(count($set) > 0){
                                        return $this->print_blood($set);
                                }else{
                                        $this->session->set_flashdata("err","Blood has been not issued Successfully.");
                                        redirect("admin/issue_blood");
                                }
                        }
                }
                $this->load->view("admin/layout/inner_template",$dta);
        } 
        public function print_blood($set){
                $dta 	=	array(
                        "title"		=>	"Blood Issue",
                        "content"	=>	"version_2/issued", 
                        "donors"        =>       $set
                ); 
                $this->session->set_flashdata("suc","Blood has been Issued Successfully.");
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function request_submit(){
                echo $this->donation_details_model->request_submit();
        }
        public function request_issue(){
                $dta 	=	array(
                        "title"		=>	"Blood Issue",
                        "content"	=>	"version_2/request_issue",
                        "ct"		=>	$this->bloodbank_model->blood_groups()
                );  
                if($this->input->post("submit")){ ;
                        $this->form_validation->set_rules("date_slot","Schedule Date","required"); 
                        $this->form_validation->set_rules("blood_group","Blood Group","required");
                        $this->form_validation->set_rules("first_name","First Name","required"); 
                        $this->form_validation->set_rules("last_name","Last Name","required"); 
                        $this->form_validation->set_rules("age","Age","required"); 
                        $this->form_validation->set_rules("sex","Gender","required"); 
                        $this->form_validation->set_rules("diag","Diagnosis or Description ","required"); 
                        $this->form_validation->set_rules("doctor_name","Doctor Name","required");  
                        if($this->form_validation->run() == TRUE){
                                $up 	=	$this->message_model->send_schedule();
                                $upa 	=	$this->message_model->request_blood();
                                if($upa > 0){
                                        $this->session->set_flashdata("suc","Requested for blood has been sent successfully.");
                                        redirect("admin/issue_blood");
                                }else{
                                        $this->session->set_flashdata("err","Requested for blood has not been successfully.");
                                        redirect("admin/request-issue");
                                }
                        }
                }
                $this->load->view("admin/layout/inner_template",$dta);
        }
}