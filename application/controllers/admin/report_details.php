<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Report_details extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-reports") != '1'){
                        redirect("admin");
                }
                $this->config->set_item('enable_query_strings',FALSE); 
        }
        public function index(){  
                if($this->session->userdata("blood-donated-reports") != "1"){
                        redirect("admin");
                }
                $dta 	=	array(
                                "title"		=>	"Reports",
                                "content"	=>	"reports"
                );
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):(date("Y-m-d")." - ".date("Y-m-d")); 
                $district       =   $this->input->post('district')?$this->input->post('district'):"";
                $totalRec               =   $this->common_model->cntreports(array('asate' => $asate,'district' => $district)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodDonated';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                
                $this->ajax_pagination->initialize($config); 
                $dta["view"]            =   $this->common_model->reports(array('limit'=>$this->perPage,'asate' => $asate));  
                $dta["district"] 	=   $this->common_model->district(); 
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewBloodDonated(){
                if($this->session->userdata("blood-donated-reports") != "1"){
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
                $district       =   $this->input->post('district')?$this->input->post('district'):""; 
                $asate          =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):(date("Y-m-d")." - ".date("Y-m-d")); 
                if(!empty($asate)){
                        $conditions['asate'] = $asate;
                }  
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                if(!empty($district)){
                        $conditions['district'] = $district;
                }  
                $totalRec               =   $this->common_model->cntreports($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBloodDonated';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->common_model->reports($conditions);
                $this->load->view("admin/pages/view_reports",$dta);
        }
        public function get_download(){  
                if($this->session->userdata("blood-donated-reports") != "1"){
                        redirect("admin");
                }
                $this->load->helper('download');
                $keywords       =   $this->input->post('FilterTextBox')?$this->input->post('FilterTextBox'):""; 
                $district       =   $this->input->post('district')?$this->input->post('district'):""; 
                $asate          =   $this->input->post('datem')?str_replace("/","-",$this->input->post('datem')):(date("Y-m-d")." - ".date("Y-m-d")); 
                $conditions     =   array();
                if(!empty($asate)){
                        $conditions['asate']    = $asate;
                }  
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                if(!empty($district)){
                        $conditions['district'] = $district;
                } 
                $query = $this->common_model->greports($conditions);
                if(!$query)
                        return false; 
                require_once APPPATH . 'third_party/PHPExcel.php';
                require_once APPPATH . 'third_party/PHPExcel/IOFactory.php';

                $objPHPExcel = new PHPExcel();
                $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");			 
                $objPHPExcel->setActiveSheetIndex(0);			 
                // Field names in the first row
                $fields = $query->list_fields();
                $col = 0;
                foreach ($fields as $field){
                                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                                $col++;
                }			 
                // Fetching the table data
                $row = 2;
                foreach($query->result() as $data){
                                $col = 0;
                                foreach ($fields as $field){
                                                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                                                $col++;
                                }			 
                                $row++;
                }			 
                $objPHPExcel->setActiveSheetIndex(0);			 
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');			 
                // Sending headers to force the user to download the file
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="Camp_'.date('dMy').'.xls"');
                header('Cache-Control: max-age=0');			 
                $objWriter->save('php://output');
        }
        public function donation_summary(){ 
                if($this->session->userdata("donation-summary-reports") != "1"){
                        redirect("admin");
                }
                $dta    =   array(
                        "title"     =>  "Donation Summary",
                        "content"   =>  "version_2/reports/donation_summary",
                        "blood_bank"    => $this->blood_bank_model->view_blood()
                );
                $asate          =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):(date("Y-m-d")." - ".date("Y-m-d")); 
                $totalRec              =   $this->reports_model->cntdonation_summary(array('asate' => $asate)); 
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewDonationsummary';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                
                $this->ajax_pagination->initialize($config); 
                $dta["view"]      =     $dta["per_view"]      =   $this->reports_model->donation_summary(array('limit'=>$this->perPage,'asate' => $asate)); 
                $dta["cnt_view"]        =   $this->reports_model->donation_summary(array('asate' => $asate));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewDonationsummary(){ 
                if($this->session->userdata("donation-summary-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                if(!$page){
                    $offset = 0;
                }else{
                    $offset = $page;
                }
                $searbloodbank_id      =   $this->input->post('searbloodbank_id')?$this->input->post('searbloodbank_id'):""; 
                $keywords       =   $this->input->post('keywords')?$this->input->post('keywords'):""; 
                $asate          =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):(date("Y-m-d")." - ".date("Y-m-d")); 
                if(!empty($asate)){
                        $conditions['asate'] = $asate;
                }  
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                if(!empty($searbloodbank_id)){
                        $conditions['searbloodbank_id'] = $searbloodbank_id;
                }  
                $totalRec       =   $this->reports_model->cntdonation_summary($conditions);
                $this->perPage  =   "15"; 
                $config['base_url']    = base_url().'admin/viewDonationsummary';
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage; 
                $config['link_func']   = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"View Donations Summary", 
                        "view"          =>      $this->reports_model->donation_summary($conditions),
                        "per_view"      =>      $this->reports_model->donation_summary($conditions)
                ); 
                $dta["cnt_view"]        =   $this->reports_model->donation_summary($conditions);
//                $dta["cnt_view"]        =   $this->reports_model->donation_summary(array('keywords'=> $keywords,'asate' => $asate));
                $this->load->view("admin/pages/ajax-data/rdonation_summary",$dta);
        }
        public function camp_reports(){
                if($this->session->userdata("camp-donors-reports") != "1"){
                        redirect("admin");
                }
                $dta 	=	array(
                                "title"		=>	"Camp Donor Reports",
                                "content"	=>	"viewcamps"
                ); 
                $totalRec               =   $this->camp_model->cntcamp_reports(); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewCampDonor';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config); 
                $dta["view"]            =   $this->camp_model->camp_reports(array('limit'=>$this->perPage));  
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function viewCampDonor(){
                if($this->session->userdata("camp-donors-reports") != "1"){
                        redirect("admin");
                }
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $totalRec               =      $this->camp_model->cntcamp_reports($conditions); 
                $this->perPage          =      "15"; 
                $config['base_url']     =      base_url().'admin/viewCampDonor';
                $config['total_rows']   =      $totalRec;
                $config['per_page']     =      $this->perPage; 
                $config['link_func']    =      'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =      $offset;
                $conditions['limit']    =      $this->perPage;
                $dta["view"]            =      $this->camp_model->camp_reports($conditions);
                $this->load->view("admin/pages/ajax-data/viewcamps",$dta);
        } 
        public function bcamp_reports(){ 
                if($this->session->userdata("blood-bank-camp-reports") != "1"){
                        redirect("admin");
                }
                $dta 	=	array(
                                "title"		=>	"Camp Reports",
                                "content"	=>	"bcamp_reports"
                );  
                $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):"";  
                $totalRec               =   $this->camp_model->cntbcamp_reports(array('asate' => $asate)); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBcampreport';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';                
                $this->ajax_pagination->initialize($config); 
                $dta["view"]            =   $this->camp_model->bcamp_reports(array('limit'=>$this->perPage,'asate' => $asate));   
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewBcampreport(){
                $conditions = array();
                $page = $this->uri->segment('3');
                if(!$page){
                    $offset = 0;
                }else{
                    $offset = $page;
                }
                $keywords       =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
                $asate          =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
                if(!empty($asate)){
                        $conditions['asate'] = $asate;
                }  
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }   
                $totalRec               =   $this->camp_model->cntbcamp_reports($conditions); 
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewBcampreport';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->camp_model->bcamp_reports($conditions);
                $this->load->view("admin/pages/camp_reports",$dta);
        }  
        public function detailed_donation(){
                $dta    =   array(
                        "title"     =>  "Donation Summary",
                        "content"   =>  "version_2/reports/detailed_donation"
                );
                $totalRec              =   $this->reports_model->cntdonation_summary(); 
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewDonationdetail';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config); 
                $dta["view"]      =     $dta["per_view"]      =   $this->reports_model->donation_summary(array('limit'=>$this->perPage)); 
                $dta["cnt_view"]        =   $this->reports_model->donation_summary();
                $this->load->view("admin/layout/inner_template",$dta);
        }
}