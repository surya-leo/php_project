<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bloodavailability extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-blood-availability") != '1'){
                        redirect("admin");
                }
        }
        public function index(){
                $dta 	=	array(
                        "title"		=>	"Blood Issue",
                        "content"	=>	"version_2/out_blood_availability",
                        "blood_groups"  =>      $this->bloodbank_model->blood_groups(),
                        "out_avail"     =>      $this->version2_model->out_avail() 
                );
                if($this->input->post("submit")){
                        $uipf   =   $this->version2_model->update_availabilty();
                        if($uipf){ 
                                $this->session->set_flashdata("suc","Blood Availability has been updated Successfully.");
                                redirect("admin/out-blood-availability");
                        }else{
                                $this->session->set_flashdata("err","Blood Availability has been not updated Successfully.");
                                redirect("admin/out-blood-availability");
                        }
                }
                $this->load->view("admin/layout/inner_template",$dta);
        }
}