<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Issue_reports extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-issue-reports") == ""){
                        redirect("admin");
                }
        }
        public function summary(){
               if($this->session->userdata("issue-summary-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Issued Summary",
                        "content"   =>  "version_2/reports/issue_summary",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $totalRec               =   $this->issue_report_model->cntissue_summary(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewIssuedSummary';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->issue_report_model->issue_summary(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function  viewIssuedSummary(){
                if($this->session->userdata("issue-summary-reports") != "1"){
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
                $totalRec               =   $this->issue_report_model->cntissue_summary($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewIssuedSummary';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->issue_report_model->issue_summary($conditions);  
                $this->load->view("admin/pages/ajax-data/issue_summary",$dta);
        }
        public function bloodbankwise(){
               if($this->session->userdata("bloodbank-wise-issued-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Issued Detailed Report",
                        "content"   =>  "version_2/reports/hospitalwise"
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $totalRec               =   $this->issue_report_model->cnthospitalwise_summary(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewHospitalwiseSummary';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->issue_report_model->hospitalwise_summary(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function  viewHospitalwiseSummary(){
                if($this->session->userdata("bloodbank-wise-issued-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                $offset = (!$page)?0:$page;
                $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                if(!empty($asate)){
                        $conditions['asate']        =   $asate;
                }
                if(!empty($keywords)){
                        $conditions['keywords']     =   $keywords;
                }   
                $totalRec               =   $this->issue_report_model->cnthospitalwise_summary($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewHospitalwiseSummary';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->issue_report_model->hospitalwise_summary($conditions);  
                $this->load->view("admin/pages/ajax-data/hospitalwise",$dta);
        }
        public function detailed_report(){
               if($this->session->userdata("detail-blood-issued-reports") != "1") {
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Blood Availability",
                        "content"   =>  "version_2/reports/detailed_report",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $totalRec               =   $this->issue_report_model->cntdetail_report(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewDetailedIssued';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->issue_report_model->detail_report(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function  viewDetailedIssued(){
                if($this->session->userdata("detail-blood-issued-reports") != "1"){
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
                $totalRec               =   $this->issue_report_model->cntdetail_report($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewDetailedIssued';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->issue_report_model->detail_report($conditions);  
                $this->load->view("admin/pages/ajax-data/detailed_report",$dta);
        }
        public function closed_report(){
                if($this->session->userdata("request-closed-reports") != "1") {
                        redirect("admin");
                }
                if($this->session->userdata("login_parent") == "2") {
                        $content    =   "closed_report";
                }else{
                        $content    =   "adclosed_report";
                }
                $dta    =   array(
                        "title"     =>  "Blood Request Closed",
                        "content"   =>  "version_2/reports/".$content,
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                $totalRec               =   $this->issue_report_model->cntclosed_report(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewClosedrequest';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter'; 
                $this->ajax_pagination->initialize($config); 
                $dta["view"]    =   $this->issue_report_model->closed_report(array('limit'=>$this->perPage,'asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function  viewClosedrequest(){
                if($this->session->userdata("request-closed-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                if($this->session->userdata("login_parent") == "2") {
                        $content    =   "closed_report";
                }else{
                        $content    =   "adclosed_reports";
                }
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
                $totalRec               =   $this->issue_report_model->cntclosed_report($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewDetailedIssued';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->issue_report_model->closed_report($conditions);  
                $this->load->view("admin/pages/ajax-data/".$content,$dta);
        }
}