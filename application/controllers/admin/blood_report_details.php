<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Blood_report_details extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-reports") != '1'){
                        redirect("admin");
                }
        }
        public function blood_availability(){
                if($this->session->userdata("blood-availability-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Availability",
                        "content"   =>  "version_2/reports/blood_availability",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $conditions             =   array();
                $district               =   $this->input->post('district')?$this->input->post('district'):"";
                $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                $component              =   $this->input->post('component')?$this->input->post('component'):"";
                if(!empty($component)){
                        $conditions['component']    =   $component;
                }
                if(!empty($district)){
                        $conditions['district']     =   $district;
                }
                if(!empty($city)){
                        $conditions['city']         =   $city;
                } 
                $totalRec               =   $this->blood_availability_model->cntblood_available($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodAvailability';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage;  
                $conditions['limit']    =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                
                $this->ajax_pagination->initialize($config); 
                $dta["view"]        =   $this->blood_availability_model->blood_available($conditions);
                $dta["district"]    =   $this->common_model->district();
                $this->load->view("admin/layout/inner_template",$dta);
        }  
        public function viewBloodAvailability(){ 
                if($this->session->userdata("blood-availability-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                $offset = (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $district               =   $this->input->post('district')?$this->input->post('district'):"";
                $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                $component              =   $this->input->post('component')?$this->input->post('component'):"";
                $searbloodbank_id       =   $this->input->post('searbloodbank_id')?$this->input->post('searbloodbank_id'):""; 
                if(!empty($searbloodbank_id)){
                        $conditions['searbloodbank_id'] = $searbloodbank_id;
                }
                if(!empty($component)){
                        $conditions['component']     =   $component;
                }
                if(!empty($district)){
                        $conditions['district']     =   $district;
                }
                if(!empty($city)){
                        $conditions['city']     =   $city;
                }
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }   
                $totalRec               =   $this->blood_availability_model->cntblood_available($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodAvailability';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->blood_availability_model->blood_available($conditions);  
                $this->load->view("admin/pages/ajax-data/blood_availability",$dta);
        }
        public function blood_grouping(){
                if($this->session->userdata("blood-grouping-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Availability",
                        "content"   =>  "version_2/reports/blood_grouping",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):(date("Y-m-d")." - ".date("Y-m-d")); 
                $totalRec               =   $this->blood_availability_model->cntblood_grouping(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodGrouping';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->blood_availability_model->blood_grouping(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewBloodGrouping(){ 
                if($this->session->userdata("blood-grouping-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):(date("Y-m-d")." - ".date("Y-m-d")); 
                if(!empty($asate)){
                        $conditions['asate']        =   $asate;
                } 
                if(!empty($keywords)){
                        $conditions['keywords']     =   $keywords;
                }   
                $totalRec               =   $this->blood_availability_model->cntblood_grouping($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodGrouping';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->blood_availability_model->blood_grouping($conditions);  
                $this->load->view("admin/pages/ajax-data/blood_grouping",$dta);
        }
        public function blood_screening(){
                if($this->session->userdata("blood-screening-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Screening",
                        "content"   =>  "version_2/reports/blood_screening",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):"";  
                $totalRec               =   $this->blood_availability_model->cntblood_screening(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodScreening';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->blood_availability_model->blood_screening(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewBloodScreening(){ 
                if($this->session->userdata("blood-screening-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                $offset = (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $searbloodbank_id      =   $this->input->post('searbloodbank_id')?$this->input->post('searbloodbank_id'):""; 
                if(!empty($searbloodbank_id)){
                        $conditions['searbloodbank_id'] = $searbloodbank_id;
                }
                if(!empty($asate)){
                        $conditions['asate']        =   $asate;
                }
                if(!empty($keywords)){
                        $conditions['keywords']     =   $keywords;
                }   
                $totalRec               =   $this->blood_availability_model->cntblood_screening($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodAvailability';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->blood_availability_model->blood_screening($conditions);  
                $this->load->view("admin/pages/ajax-data/blood_screening",$dta);
        }
        public function blood_components(){
                if($this->session->userdata("blood-component-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Components",
                        "content"   =>  "version_2/reports/blood_components",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $totalRec               =   $this->blood_availability_model->cntblood_components(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodComponents';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->blood_availability_model->blood_components(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewBloodComponents(){ 
                if($this->session->userdata("blood-component-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                $offset = (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $searbloodbank_id      =   $this->input->post('searbloodbank_id')?$this->input->post('searbloodbank_id'):""; 
                if(!empty($searbloodbank_id)){
                        $conditions['searbloodbank_id'] = $searbloodbank_id;
                }
                if(!empty($asate)){
                        $conditions['asate']        =   $asate;
                }
                if(!empty($keywords)){
                        $conditions['keywords']     =   $keywords;
                }   
                $totalRec               =   $this->blood_availability_model->cntblood_components($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodComponents';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->blood_availability_model->blood_components($conditions);  
                $this->load->view("admin/pages/ajax-data/blood_components",$dta);
        }
        public function blood_discarded(){
                if($this->session->userdata("blood-discarded-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Components",
                        "content"   =>  "version_2/reports/blood_discarded",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $totalRec               =   $this->blood_availability_model->cntblood_discarded(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodDiscarded';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->blood_availability_model->blood_discarded(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewBloodDiscarded(){ 
                if($this->session->userdata("blood-component-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                $offset = (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $searbloodbank_id       =   $this->input->post('searbloodbank_id')?$this->input->post('searbloodbank_id'):""; 
                if(!empty($searbloodbank_id)){
                        $conditions['searbloodbank_id'] = $searbloodbank_id;
                }
                if(!empty($asate)){
                        $conditions['asate']        =   $asate;
                }
                if(!empty($keywords)){
                        $conditions['keywords']     =   $keywords;
                }   
                $totalRec               =   $this->blood_availability_model->cntblood_discarded($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodDiscarded';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->blood_availability_model->blood_discarded($conditions);  
                $this->load->view("admin/pages/ajax-data/blood_discarded",$dta);
        }
        public function outblood_availability(){
                if($this->session->userdata("out-blood-availability-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"         =>  "Blood Availability",
                        "content"       =>  "version_2/reports/outblood",
                        "blood_bank"    =>  $this->blood_bank_model->view_blood()
                );
                $conditions             =   array();
                $district               =   $this->input->post('district')?$this->input->post('district'):"";
                $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                $component              =   $this->input->post('component')?$this->input->post('component'):"";
                $intervalue              =   $this->input->post('intervalue')?$this->input->post('intervalue'):"";
                if(!empty($component)){
                        $conditions['component']    =   $component;
                }
                if(!empty($district)){
                        $conditions['district']     =   $district;
                }
                if(!empty($city)){
                        $conditions['city']         =   $city;
                } 
                if(!empty($intervalue)){
                        $conditions['intervalue']         =   $intervalue;
                } 
                $conditions['out_status']         =   1;
                $totalRec               =   $this->version2_model->cntoblood_available($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewOutBloodAvailability';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage;  
                $conditions['limit']    =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                
                $this->ajax_pagination->initialize($config); 
                $dta["view"]        =   $this->version2_model->oblood_available($conditions);
                $dta["district"]    =   $this->common_model->district();
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewOutBloodAvailability(){
                if($this->session->userdata("out-blood-availability-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                $offset = (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $district               =   $this->input->post('district')?$this->input->post('district'):"";
                $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                $component              =   $this->input->post('component')?$this->input->post('component'):"";
                $searbloodbank_id       =   $this->input->post('searbloodbank_id')?$this->input->post('searbloodbank_id'):""; 
                $zero_units             =   $this->input->post('units'); 
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):"";
                if(!empty($asate)){
                        $conditions['asate']        =   $asate;
                }
                if($zero_units == '0'){
                        $conditions['zero_units']         =   $zero_units; 
                }
                if(!empty($searbloodbank_id)){
                        $conditions['searbloodbank_id'] = $searbloodbank_id;
                }
                $intervalue              =   $this->input->post('intervalue')?$this->input->post('intervalue'):"";
                if(!empty($component)){
                        $conditions['component']    =   $component;
                }
                if(!empty($district)){
                        $conditions['district']     =   $district;
                }
                if(!empty($city)){
                        $conditions['city']         =   $city;
                } 
                if(!empty($intervalue)){
                        $conditions['intervalue']         =   $intervalue;
                } 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }   
                $totalRec               =   $this->version2_model->cntoblood_available($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewOutBloodAvailability';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->version2_model->oblood_available($conditions);  
                $this->load->view("admin/pages/ajax-data/outblood",$dta);
        }
        public function discard_submit(){
                echo $this->version2_model->discard_submit();
        }
        public function outblood_collection(){
                if($this->session->userdata("out-blood-collection-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"         =>  "Blood Collection",
                        "content"       =>  "version_2/reports/outbloodcollection",
                        "blood_bank"    =>  $this->blood_bank_model->view_blood()
                );
                $conditions             =   array();
                $district               =   $this->input->post('district')?$this->input->post('district'):"";
                $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                $component              =   $this->input->post('component')?$this->input->post('component'):""; 
                $zero_units             =   $this->input->post('units'); 
                if($zero_units == '0'){
                        $conditions['zero_units']         =   $zero_units; 
                }
                if(!empty($component)){
                        $conditions['component']    =   $component;
                }
                if(!empty($district)){
                        $conditions['district']     =   $district;
                }
                if(!empty($city)){
                        $conditions['city']         =   $city;
                }  
                $intervalue              =   $this->input->post('intervalue')?$this->input->post('intervalue'):"";
                if(!empty($intervalue)){
                        $conditions['intervalue']         =   $intervalue;
                }
                $totalRec               =   $this->version2_model->cntoblood_collection($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewOutBloodCollection';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage;  
                $conditions['limit']    =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                
                $this->ajax_pagination->initialize($config); 
                $dta["view"]        =   $this->version2_model->oblood_collection($conditions);
                $dta["district"]    =   $this->common_model->district();
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewOutBloodCollection(){
                if($this->session->userdata("out-blood-collection-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                $offset = (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $district               =   $this->input->post('district')?$this->input->post('district'):"";
                $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                $searbloodbank_id       =   $this->input->post('searbloodbank_id')?$this->input->post('searbloodbank_id'):""; 
                $zero_units             =   $this->input->post('units'); 
                if($zero_units == '0'){
                        $conditions['zero_units']         =   $zero_units; 
                }
                if(!empty($searbloodbank_id)){
                        $conditions['searbloodbank_id'] = $searbloodbank_id;
                }
                if(!empty($district)){
                        $conditions['district']     =   $district;
                }
                if(!empty($city)){
                        $conditions['city']         =   $city;
                } 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }   
                $intervalue              =   $this->input->post('intervalue')?$this->input->post('intervalue'):"";
                if(!empty($intervalue)){
                        $conditions['intervalue']         =   $intervalue;
                }
                $totalRec               =   $this->version2_model->cntoblood_collection($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewOutBloodCollection';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->version2_model->oblood_collection($conditions);  
                $this->load->view("admin/pages/ajax-data/outblood",$dta);
        }
}