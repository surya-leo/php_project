<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Transfer_collection_reports extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("manage-transfer-collection") != "1"){
                                redirect("admin");
                }                
        }
        public function index(){               
                if($this->session->userdata("transfer-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array(); 
                if($this->session->userdata("login_parent") == '1'){
                        $dta 	=	array(
                                "title"		=>	"Blood Issue",
                                "content"	=>	"version_2/reports/adtransfer", 
                        );
                }else{ 
                        $dta 	=	array(
                                "title"		=>	"Blood Issue",
                                "content"	=>	"version_2/reports/transfer", 
                        ); 
                        $conditions['bloodbank']    =   $this->session->userdata("login_bloodbank_id"); 
                } 
                $asate       =   $this->input->post('asate')?$this->input->post('asate'):""; 
                if(!empty($asate)){
                    $conditions['asate'] = $asate;
                }
                $totalRec = $this->transfer_model->cnttransfer($conditions);
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewTransfer';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config); 
                $conditions['limit']    =   $this->perPage;
                $dta["view"]	=	$this->transfer_model->transfer($conditions);
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewTransfer(){               
                if($this->session->userdata("transfer-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page       = $this->uri->segment('3');
                $offset     = ($page != "")?$page:"0";
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $asate       =   $this->input->post('asate')?$this->input->post('asate'):""; 
                if(!empty($asate)){
                    $conditions['asate'] = $asate;
                }  
                if($this->session->userdata("login_parent") == '1'){
                        $content    =   "adtransfer";
                }else{ 
                        $content    =   "transfer";
                        $conditions['bloodbank']    =   $this->session->userdata("login_bloodbank_id");
                }
                $totalRec               =   $this->transfer_model->cnttransfer($conditions);
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewTransfer';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->transfer_model->transfer($conditions); 
                $this->load->view("admin/pages/ajax-data/".$content,$dta);
        }
        public function collection(){               
                if($this->session->userdata("collection-reports") != "1"){
                        redirect("admin");
                } 
                $conditions = array();
                if($this->session->userdata("login_parent") == '1'){
                        $dta 	=	array(
                                "title"		=>	"Blood Collection",
                                "content"	=>	"version_2/reports/adcollection", 
                        );
                }else{ 
                        $dta 	=	array(
                                "title"		=>	"Blood Collection",
                                "content"	=>	"version_2/reports/collection", 
                        ); 
                        $conditions['bloodbank']    =   $this->session->userdata("login_bloodbank_id"); 
                }  
                $asate       =   $this->input->post('asate')?$this->input->post('asate'):""; 
                if(!empty($asate)){
                    $conditions['asate'] = $asate;
                }
                $totalRec = $this->transfer_model->cntcollection($conditions);
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewCollection';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config); 
                $conditions['limit']    =   $this->perPage;
                $dta["view"]	=	$this->transfer_model->collection($conditions);
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewCollection(){               
                if($this->session->userdata("transfer-reports") != "1"){
                        redirect("admin");
                }
                $conditions = array();
                $page = $this->uri->segment('3');
                if($this->session->userdata("login_parent") == '1'){
                        $content    =   "adcollection";
                }else{ 
                        $content    =   "collection";
                        $conditions['bloodbank']    =   $this->session->userdata("login_bloodbank_id");
                } 
                $offset = (!$page)?0:$page;
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $asate       =   $this->input->post('asate')?$this->input->post('asate'):""; 
                if(!empty($asate)){
                    $conditions['asate'] = $asate;
                } 
                $totalRec               =   $this->transfer_model->cntcollection($conditions);
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewCollection';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->transfer_model->collection($conditions);
                $this->load->view("admin/pages/ajax-data/".$content,$dta);
        }
}