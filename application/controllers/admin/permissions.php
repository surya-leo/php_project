<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
class Permissions extends CI_Controller{
        public function __construct(){
                parent::__construct();                
                $this->config->set_item('enable_query_strings',FALSE); 
                if($this->session->userdata("manage-permission") == ""){
                        redirect("admin");
                }
        }
        public function index(){
                $data 	=	array(
                        "title" 	=>	"Permissions",
                        "content"	=>	"version_2/permissions",
                        "user"          =>      $this->permission_model->get_users(),
                        "perm"          =>      $this->permission_model->get_pages(),
                        "shares"        =>      $this->permission_model->get_shares()
                ); 	
                if($this->input->post("submit")){
                        $ins = $this->permission_model->update_permission();
                        if($ins){						 
                                $valp 	= $this->login_model->get_roles($this->session->userdata('login_type'));
                                foreach($valp  as $vp){
                                        $this->session->set_userdata(trim($vp->page_name),$vp->per_status);
                                }  
                                $this->session->set_flashdata("suc","Updated Permissions Successfully.");
                                redirect("admin/permissions");
                        }else{
                                    $this->session->set_flashdata("err","Not Updated Permissions.");
                                    redirect("admin/permissions");
                        }
                } 
                $this->load->view("admin/layout/inner_template",$data);
        } 
}