<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Role extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE); 
                if($this->session->userdata("manage-roles") == ""){
                        redirect("admin");
                }
        }
        public function create_role(){
                if($this->session->userdata("create-role") != '1'){
                        redirect("admin");
                }
                $data 	=	array(
                        "title" 	=>	"Roles",
                        "content"	=>	"version_2/roles/create-role",
                );
                if($this->input->post("submit")){ 
                        $this->form_validation->set_rules("rolename","Role Name","required|xss_clean|trim|min_length[5]|max_length[100]");
                        if($this->form_validation->run() == TRUE){
                                $bt     =   $this->role_model->create_role();
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Created Role Successfully.");
                                        redirect("admin/create-role");
                                }else{
                                        $this->session->set_flashdata("err","Not Created Role.Please try again.");
                                        redirect("admin/create-role");    
                                }
                        }
                }
                $this->load->view("admin/layout/inner_template",$data);
        }
        public function index(){
                if($this->session->userdata("view-roles") != '1'){
                        redirect("admin");
                }
                $dt     =   array(
                        "title"     =>  "Role",
                        "content"   =>  "version_2/roles/role" 
                );
                $totalRec              =    $this->role_model->cntview_role(); 
                $perpage               =    "15"; 
                $config['base_url']    =    base_url().'admin/viewRole';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage; 
                $config['link_func']   =    'searchFilter';                
                $this->ajax_pagination->initialize($config); 
                $dt["view"]            =     $this->role_model->view_role(array("limit" => $perpage));
                $this->load->view("admin/layout/inner_template",$dt);
        }
        public function viewRole(){
                if($this->session->userdata("view-roles") != '1'){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                if(!$page){
                    $offset = 0;
                }else{
                    $offset = $page;
                }
                $keywords       =   $this->input->post('keywords')?$this->input->post('keywords'):""; 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $totalRec              =   $this->role_model->cntview_role($conditions);
                $perpage               =   "15"; 
                $config['base_url']    =    base_url().'admin/viewRole';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']   =    $offset;
                $conditions['limit']   =    $perpage;
                $dt["view"]            =    $this->role_model->view_role($conditions);
                $this->load->view("admin/pages/version_2/roles/ajax-role",$dt);
        }
        public function update_role(){
                if($this->session->userdata("update-role") != '1'){
                        redirect("admin");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->role_model->get_role($uri);
                if(count($vue) > 0){                                    
                    $dt     =   array(
                            "title"     =>  "Update Role",
                            "content"   =>  "version_2/roles/update-role",
                            "view"      =>  $vue
                    ); 
                    if($this->input->post("submit")){
                            $this->form_validation->set_rules("rolename","Role Name","required|xss_clean|trim|min_length[5]|max_length[100]");
                            if($this->form_validation->run() == TRUE){
                                    $bt     =   $this->role_model->update_role($uri);
                                    if($bt > 0){
                                            $this->session->set_flashdata("suc","Updated Role Successfully.");
                                            redirect("admin/update-role/".$uri);
                                    }else{
                                            $this->session->set_flashdata("err","Not Updated Role.Please try again.");
                                            redirect("admin/update-role/".$uri);    
                                    }
                            }
                    }
                }else{
                        $this->session->set_flashdata("war","Role does not exists."); 
                        redirect("admin/view-roles");
                }
                $this->load->view("admin/layout/inner_template",$dt);
        }
        public function delete_role(){
                if($this->session->userdata("delete-role") != '1'){
                        redirect("admin");
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->role_model->get_role($uri);
                if(count($vue) > 0){
                        $vt     =   $this->role_model->delete_col($uri); 
                        if($vt > 0){
                                $this->session->set_flashdata("suc","Deleted Role Successfully.");
                                redirect("admin/view-roles");
                        }else{
                                $this->session->set_flashdata("err","Not Deleted Role.Please try again.");
                                redirect("admin/view-roles");    
                        }
                }else{
                        $this->session->set_flashdata("war","Role does not exists."); 
                        redirect("admin/view-roles");
                }
        }
}