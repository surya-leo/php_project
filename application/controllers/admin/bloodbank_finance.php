<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bloodbank_finance extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-bloodbank-finance") != '1'){
                        redirect("admin");
                }
        }
        public function index(){
                if($this->session->userdata("login_parent") == '1'){
                        $data       =   array(
                                            "title"     =>  "Blood Bank Finance",
                                            "content"   =>  "version_2/finance"
                                        );
                        $totalRec              =   $this->bloodbank_finance_model->cntview_financereprts();
                        $this->perPage         =   "15"; 
                        $config['base_url']    =    base_url().'admin/viewFinance';
                        $config['total_rows']  =    $totalRec;
                        $config['per_page']    =    $this->perPage; 
                        $config['link_func']   =    'searchFilter';
                        $this->ajax_pagination->initialize($config);
                        $data["view"]          =    $this->bloodbank_finance_model->view_financereports(array('limit'=>$this->perPage)); 
                        $this->load->view("admin/layout/inner_template",$data);
                }else{
                        $data       =   array(
                            "title"     =>  "Blood Bank Finance",
                            "content"   =>  "version_2/bloodbank_finance",
                            "finance"   =>  $this->bloodbank_finance_model->finance_query()
                        );
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("donation_date","Date","required|xss_clean|trim");
                                $this->form_validation->set_rules("price","Price","required|xss_clean|trim");
                                $this->form_validation->set_rules("debit_credit","Type","required|xss_clean|trim");
                                $this->form_validation->set_rules("description","Description","required|xss_clean|trim");
                                if($this->form_validation->run() == TRUE){
                                        $tg     =   $this->bloodbank_finance_model->update_finance();
                                        if($tg){ 
                                                $this->session->set_flashdata("suc","Added finance Successfully.");
                                                redirect("admin/bloodbank-finance");
                                        }else{
                                                $this->session->set_flashdata("err","Blood Availability has been not updated Successfully.");
                                                redirect("admin/bloodbank-finance");
                                        }
                                }
                        }
                        $totalRec              =   $this->bloodbank_finance_model->cntview_finance();
                        $this->perPage         =   "15"; 
                        $config['base_url']    =    base_url().'admin/viewCamps';
                        $config['total_rows']  =    $totalRec;
                        $config['per_page']    =    $this->perPage; 
                        $config['link_func']   =    'searchFilter';
                        $this->ajax_pagination->initialize($config);
                        $data["view"]          =    $this->bloodbank_finance_model->view_finance(array('limit'=>$this->perPage)); 
                        $this->load->view("admin/layout/inner_template",$data);
                }
        }
        public function viewBloodbankFinance(){
                $conditions = array();
                $page = $this->uri->segment('3'); 
                $offset = ($page != "")?$page:0;
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $totalRec       =   $this->bloodbank_finance_model->cntview_finance($conditions);
                $this->perPage  =   "1"; 
                $config['base_url']    = base_url().'admin/viewFinance';
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage; 
                $config['link_func']   = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"View Finance", 
                        "view"          =>      $this->bloodbank_finance_model->view_finance($conditions)
                ); 
                $this->load->view("admin/pages/ajax-data/view-finance",$dta);
        }
        public function viewFinance(){
                $conditions = array();
                $page = $this->uri->segment('3'); 
                $offset = ($page != "")?$page:0;
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $totalRec       =   $this->bloodbank_finance_model->cntview_financereprts($conditions);
                $this->perPage  =   "1"; 
                $config['base_url']    = base_url().'admin/viewFinance';
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage; 
                $config['link_func']   = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"View Camps", 
                        "view"          =>      $this->bloodbank_finance_model->view_financereports($conditions)
                ); 
                $this->load->view("admin/pages/ajax-data/finance",$dta);
        }
}