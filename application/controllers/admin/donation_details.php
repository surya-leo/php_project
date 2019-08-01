<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Donation_details extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-component-preparation") != "1"){
                        redirect("admin");
                }               
        }
        public function view_donor(){
                $dta 	=	array(
                                    "title"	=>	"Bloodbank Donation Form",
                                    "content"	=>	"version_2/view_donors"
                                ); 
                $conditions['donation_not_status']  = '0';
                $conditions['transfer']  = '1'; 
                $conditions['bloodbank_id']     = $this->session->userdata("login_bloodbank_id");
                $totalRec              =    $this->blood_bank_model->cntview_donors($conditions); 
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewDonors';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions["limit"]   =    $this->perPage;
                $dta["view"]           =    $this->blood_bank_model->view_donors($conditions);
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function viewDonors(){
            if($this->session->userdata("manage-component-preparation") != "1"){
                    redirect("admin");
            }
            $conditions     =   array();
            $page           =   $this->uri->segment('3');
            $offset         =   (!$page)?"0":$page;
            $keywords       =   $this->input->post('keywords'); 
            $conditions['donation_not_status']  = '0';
            $conditions['transfer']  = '1'; 
            $conditions['bloodbank_id']     = $this->session->userdata("login_bloodbank_id");
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $totalRec	= $this->blood_bank_model->cntview_donors($conditions); 
            $this->perPage         =    "15"; 
            $config['base_url']    =    base_url().'admin/viewBlooddonor';
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =    $this->perPage; 
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']   =    $offset;
            $conditions['donation_not_status']  = '0';
            $conditions['transfer']  = '1';
            $conditions['bloodbank_id']     = $this->session->userdata("login_bloodbank_id");
            $conditions['limit']   =    $this->perPage;
            $dta 	=	array(
                                    "title"		=>	"View Bloodbank Donations", 
                                    "view"              =>      $this->blood_bank_model->view_donors($conditions)
                                ); 
            $this->load->view("admin/pages/ajax-data/transferblooddonor",$dta);
    }
        public function index(){ 
                $uri    =       $this->uri->segment(3);
                $dta 	=	array(
                        "title"		=>	"Bloodbank Donation Form",
                        "content"	=>	"version_2/medical_checkup",
                        "blood_groups" 	=>      $this->bloodbank_model->blood_groups()
                );
                $getdat     =   $this->blood_bank_model->view_blooddonorid($uri);
                if(count($getdat) > 0){  
                        $status     =   ($getdat->tc_donation_status != "")?$getdat->tc_donation_status:$getdat->donation_status;
                        if($status >= '1'){
                            $uget   = $this->donation_details_model->get_bb_donation_details_id($uri); 
                            if(count($uget) >0){
                                redirect("admin/donor_bleeding/".$uget->bbdonation_id);
                            } 
                        }
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("weight","Weight","required|xss_clean|trim|callback_weightcheck");
                                $this->form_validation->set_rules("pulse","Pulse","required|xss_clean|trim|callback_pulsecheck");
                                $this->form_validation->set_rules("hb","HB","required|xss_clean|trim|callback_hbcheck");
                                $this->form_validation->set_rules("sbp","BP","required|xss_clean|trim|callback_bpcheck");
                                $this->form_validation->set_rules("dbp","DBP","required|xss_clean|trim|callback_dbpcheck");
                                $this->form_validation->set_rules("temperature","Temperature","required|xss_clean|trim|callback_tempcheck");
                                $this->form_validation->set_rules("donation_time","Donation Time","required|xss_clean|trim");
                                $this->form_validation->set_rules("donation_type","Donation Type","required");
                                if($this->input->post("donation_type") == '1'){
                                        $this->form_validation->set_rules("blood_group","Blood Group","required");
                                        $this->form_validation->set_rules("patient_name","Patient Name","required|xss_clean|trim");
                                }
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->donation_details_model->medicalcheckup($uri);
                                        if($set > 0){
                                                $this->session->set_flashdata("suc","Blood Donor Details updated Successfully.");
                                                redirect("admin/donor_bleeding/".$set);
                                        }else{
                                                $this->session->set_flashdata("err","Blood Donor Details not updated Successfully.");
                                                redirect("admin/donor_medical_checkup/".$uri);
                                        }
                                }
                        }
                }else{
                        redirect("admin/prepare-components");
                }
                $this->load->view("admin/layout/inner_template",$dta);
        }
        function tempcheck($cp){   
                if ($cp >= 70) return true;
                $this->form_validation->set_message('tempcheck', 'Temperature must be more than 70.');
                return FALSE; 
        }
        function weightcheck($cp){   
                if ($cp >= 45) return true;
                $this->form_validation->set_message('weightcheck', 'Weight must be more than 45.');
                return FALSE; 
        }
        function pulsecheck($pots){  
                if ($pots >= 70) return true;
                $this->form_validation->set_message('pulsecheck', 'Pulse must be more than 70.');
                return FALSE; 
        }
        function hbcheck($pots){  
                if ($pots >= 12.5) return true;
                $this->form_validation->set_message('hbcheck', 'HB must be more than 12.5.');
                return FALSE; 
        }
        function bpcheck($pots){  
                if ($pots >= 70) return true;
                $this->form_validation->set_message('bpcheck', 'SBP must be more than 70.');
                return FALSE; 
        }
        function dbpcheck($pots){  
                if ($pots >= 70) return true;
                $this->form_validation->set_message('dbpcheck', 'DBP must be more than 70.');
                return FALSE; 
        }
        public function donor_bleeding(){ 
                $uri    =       $this->uri->segment(3);
                $bagnu  =       $this->donation_details_model->get_donation($uri);
                if(count($bagnu) > 0){
                        $status     =   ($bagnu->tc_donation_status != "")?$bagnu->tc_donation_status:$bagnu->donation_status;
                        if($status >= '2'){
                            $uget   = $this->donation_details_model->get_medical($uri); 
                            if(count($uget) >0){
                                redirect("admin/blood_grouping/".$uget->bbdonation_id);
                            } 
                        }
                        $dta 	=	array(
                                "title"		=>	"Bloodbank Donation Form",
                                "content"	=>	"version_2/donor_bleeding",
                                "blood_groups" 	=>      $this->bloodbank_model->blood_groups(),
                                "staff"         =>      $this->staff_model->view_staff($uri),
                                "bag_number"    =>      $this->input->post('blood_unit_num')?$this->input->post('blood_unit_num'):$bagnu->blood_bank_code
                        );
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("blood_unit_num","Blood Bag Number","required|xss_clean|trim|callback_isbagnummber[$bagnu->blood_bank_code]");
                                $this->form_validation->set_rules("segment_num","Segment Number","required|xss_clean|trim");
                                $this->form_validation->set_rules("bag_type","Bag Type","required");
                                $this->form_validation->set_rules("volume","Volume","required"); 
                                $this->form_validation->set_rules("staff","Staff","required"); 
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->donation_details_model->bleeding($uri);
                                        if($set > 0){
                                                $this->session->set_flashdata("suc","Blood Donor waiting details updated Successfully.");
                                                if($this->input->post('under_collection')){
                                                        redirect("admin/prepare-components");
                                                }else{
                                                        redirect("admin/blood_grouping/".$uri);
                                                }
                                        }else{
                                                $this->session->set_flashdata("err","Blood Donor waiting Details not updated Successfully.");
                                                redirect("admin/donor_medical_checkup/".$uri);
                                        }
                                }
                        }
                        $this->load->view("admin/layout/inner_template",$dta);
                } else {
                    redirect("admin/prepare-components");
                }
        }        
        function isbagnummber($pots,$param){  
                $set    =   $this->donation_details_model->check_bag($pots);
                if($pots == $param){
                        $this->form_validation->set_message('isbagnummber', 'Concatenate Blood Bag Number with the Blood bank code');
                        return FALSE; 
                }
                if ($set) {
                    return true;
                }else{
                        $this->form_validation->set_message('isbagnummber', 'Blood Bag Number already exists.');
                        return FALSE; 
                }
        }
        public function blood_group_serum(){
                $gtb    =   $this->donation_details_model->blood_group_serum($this->input->post("bgroup"));
                if(count($gtb) > 0){
                     echo $gtb->anti_a."@@".$gtb->anti_b."@@".$gtb->anti_ab."@@".$gtb->anti_d."@@".$gtb->a_cells."@@".$gtb->b_cells."@@".$gtb->o_cells."@@".$gtb->du;
                }
        }
        public function blood_grouping(){
                $uri    =       $this->uri->segment(3);
                $bagnu  =       $this->donation_details_model->get_donation($uri);
                if(count($bagnu) > 0){
                        $status     =   ($bagnu->tc_donation_status != "")?$bagnu->tc_donation_status:$bagnu->donation_status;
                        if($status >= '3'){
                            $uget   = $this->donation_details_model->get_medical($uri); 
                            if(count($uget) >0){
                                redirect("admin/component_preparation/".$uget->bbdonation_id);
                            } 
                        }
                        $dta 	=	array(
                                "title"		=>	"Bloodbank Donation Form",
                                "content"	=>	"version_2/blood_grouping",
                                "view"          =>      $this->donation_details_model->get_donation($uri),
                                "staff"         =>      $this->staff_model->view_staff($uri)
                        );
                        if($this->input->post("submit")){   
                                $this->form_validation->set_rules("under_collection","Group","required");
                                $this->form_validation->set_rules("blood_group","Blood Group","required");
                                $this->form_validation->set_rules("donation_date","Grouping Date","required");
                                $this->form_validation->set_rules("staff_forward","Forward By","required");
                                $this->form_validation->set_rules("staff_reverse","Reverse By","required");
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->donation_details_model->blood_grouping($uri);
                                        if($set > 0){
                                                $this->session->set_flashdata("suc","Blood Donor waiting details updated Successfully.");
                                                redirect("admin/component_preparation/".$uri);
                                        }else{
                                                $this->session->set_flashdata("err","Blood Donor waiting Details not updated Successfully.");
                                                redirect("admin/blood_grouping/".$uri);
                                        }
                                }
                        }
                        $this->load->view("admin/layout/inner_template",$dta);
                } 
        }
        public function component_preparation(){
                $uri    =       $this->uri->segment(3);
                $bagnu  =       $this->donation_details_model->get_donation($uri);
                $dta 	=	array(
                        "title"		=>	"Bloodbank Donation Form",
                        "content"	=>	"version_2/component_preparation",
                        "view"          =>      $bagnu,
                        "staff"         =>      $this->staff_model->view_staff($uri)
                );
                if(count($bagnu) > 0){
                        $status     =   $bagnu->tc_donation_status?$bagnu->tc_donation_status:$bagnu->donation_status;
                        if($status >= '4'){
                            $uget   = $this->donation_details_model->get_medical($uri); 
                            if(count($uget) >0){
                                redirect("admin/screening/".$uget->bbdonation_id);
                            } 
                        }
                        if($this->input->post("submit")){   
                                $this->form_validation->set_rules("blood_group","Blood Group","required");
                                $this->form_validation->set_rules("donation_date","Preparation Date","required"); 
                                $this->form_validation->set_rules("staff_reverse","Reverse By","required");
                                $this->form_validation->set_rules("prepared","Component Prepared","required");
                                $this->form_validation->set_rules("pcells[]","Blood Components","required");
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->donation_details_model->component_preparation($uri);
                                        if($set > 0){
                                                $this->session->set_flashdata("suc","Blood Donor Component Preparation has done Successfully.");
                                                redirect("admin/screening/".$uri);
                                        }else{
                                                $this->session->set_flashdata("err","Blood Donor Component Preparation has not done Successfully.");
                                                redirect("admin/component_preparation/".$uri);
                                        }
                                }
                        }
                        $this->load->view("admin/layout/inner_template",$dta);
                }else{
                        redirect("admin/blood_grouping/".$uri);
                }
        }
        public function screening(){
                $uri    =       $this->uri->segment(3);
                $bagnu  =       $this->donation_details_model->get_donation($uri);
                $dta 	=	array(
                        "title"		=>	"Bloodbank Donation Form",
                        "content"	=>	"version_2/screening",
                        "view"          =>      $bagnu,
                        "staff"         =>      $this->staff_model->view_staff($uri)
                );
                if(count($bagnu) > 0){
                        $status     =   ($bagnu->tc_donation_status !="")?$bagnu->tc_donation_status:$bagnu->donation_status;
                        if($status >= '5'){
                            $uget   = $this->donation_details_model->get_medical($uri); 
                            if(count($uget) >0){
                                redirect("admin/prepare-components");
                            } 
                        }
                        if($this->input->post("submit")){   
                                $this->form_validation->set_rules("tested","Blood Tested","required");
                                $this->form_validation->set_rules("blood_group","Blood Group","required");
                                $this->form_validation->set_rules("donation_date","Screened Date","required"); 
                                $this->form_validation->set_rules("staff_reverse","Reverse By","required");
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->donation_details_model->blood_screening($uri);
                                        if($set > 0){
                                                $this->session->set_flashdata("suc","Blood Donor component has been prepared Successfully.");
                                                redirect("admin/prepare-components");
                                        }else{
                                                $this->session->set_flashdata("err","Blood Donor Screening has not done Successfully.");
                                                redirect("admin/component_preparation/".$uri);
                                        }
                                }
                        }
                        $this->load->view("admin/layout/inner_template",$dta);
                }else{
                        redirect("admin/component_preparation/".$uri);
                }
        }
        public function bulk_preparation(){ 
                $conditions['donation_status']  = $this->input->post("status"); 
                $conditions['bloodbank_id']     = $this->session->userdata("login_bloodbank_id");
                $dta["staff"]          =    $this->staff_model->view_staffs();        
                $dta["view"]           =    $this->version2_model->view_blooddonation($conditions);        
                $this->load->view("admin/pages/ajax-data/bulk_preparation",$dta);
        }
        public function bulk_group(){
                $ins    = $this->donation_details_model->bulk_group();
                if($ins){
                        $this->session->set_flashdata("suc","Blood Grouping has been done successfully.");
                        redirect("admin/prepare-components");
                }else{
                        $this->session->set_flashdata("err","Blood Grouping has not done Successfully.");
                        redirect("admin/prepare-components");
                }
        }  
        public function bulk_component(){ 
                $conditions['donation_status']  = $this->input->post("status");   
                $conditions['bloodbank_id']     = $this->session->userdata("login_bloodbank_id");
                $dta["staff"]          =    $this->staff_model->view_staffs();        
                $dta["view"]           =    $this->version2_model->view_blooddonation($conditions);        
                $this->load->view("admin/pages/ajax-data/bulk_component",$dta);
        } 
        public function bulk_screen(){ 
                $conditions['donation_status']  = $this->input->post("status");   
                $conditions['bloodbank_id']     = $this->session->userdata("login_bloodbank_id");
                $dta["staff"]          =    $this->staff_model->view_staffs();        
                $dta["view"]           =    $this->version2_model->view_blooddonation($conditions);        
                $this->load->view("admin/pages/ajax-data/bulk_screen",$dta);
        } 
        public function bulk_compon(){
                $ins    = $this->donation_details_model->bulk_compon();
                if($ins){
                        $this->session->set_flashdata("suc","Blood Component has been done successfully.");
                        redirect("admin/prepare-components");
                }else{
                        $this->session->set_flashdata("err","Blood Component has not done Successfully.");
                        redirect("admin/prepare-components");
                }
        }
        public function bulk_screening(){
                $ins    = $this->donation_details_model->bulk_screening();
                if($ins){
                        $this->session->set_flashdata("suc","Blood Screening has been done successfully.");
                        redirect("admin/prepare-components");
                }else{
                        $this->session->set_flashdata("err","Blood Screening has not done Successfully.");
                        redirect("admin/prepare-components");
                }
        }
}