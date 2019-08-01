<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Version2  extends CI_Controller{
        public function __construct() {
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
        }
        public function blood_camp(){
                $json 	=	$this->camp_model->blood_camp($this->input->post("blood_camp"));
                $op 	=	"<option value=''> -- Select Camp Name -- </option>";
                foreach($json as $p){
                        $op .= "<option value='".$p->camp_id."' >".$p->camp_description."</option>";
                }
                echo $op;
        }
        public function appointments(){
                if($this->session->userdata("manage-appointments") != "1"){
                        redirect("admin");
                } 
                $dta 	=	array(
                                    "title"	=>	"View Appointments",
                                    "content"	=>	"version_2/appointments"
                                );
                $bg                    =    $this->version2_model->cntview_appoint();
                $totalRec              =    $bg;
                $perPage               =   "15"; 
                $config['base_url']    =    base_url().'admin/viewAppoint';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta["view"]           =    $this->version2_model->appointments(array('limit'=>$perPage));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewAppoint(){
                if($this->session->userdata("manage-appointments") != "1"){
                        redirect("admin");
                }
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
                $totalRec               =   $this->version2_model->cntview_appoint($conditions);
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewAppoint';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->version2_model->appointments($conditions);
                $this->load->view("admin/pages/ajax-data/appointments",$dta);
        } 
        public function blood_not_satisfied(){
                if($this->session->userdata("manage-blood-not-satisfied") != "1"){
                        redirect("admin");
                }
                $dta 	=	array(
                                    "title"	=>	"View Appointments",
                                    "content"	=>	"version_2/blood_not_satisfied"
                                );
                $bg                    =    $this->version2_model->cntview_not_satisfied();
                $totalRec              =    $bg;
                $perPage               =   "15"; 
                $config['base_url']    =    base_url().'admin/viewNotsatisfied';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta["view"]           =    $this->version2_model->view_not_satisfied(array('limit'=>$perPage));
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewNotsatisfied(){
                if($this->session->userdata("manage-blood-not-satisfied") != "1"){
                        redirect("admin");
                }
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $totalRec               =   $this->version2_model->cntview_not_satisfied($conditions);
                $this->perPage          =   "15"; 
                $config['base_url']     =   base_url().'admin/viewNotsatisfied';
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $this->perPage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $this->perPage;
                $dta["view"]            =   $this->version2_model->view_not_satisfied($conditions);
                $this->load->view("admin/pages/ajax-data/blood_not_satisfied",$dta);
        }
        public function submitNotsatisfied(){
                if($this->session->userdata("manage-blood-not-satisfied") != "1"){
                        redirect("admin");
                }
                $set =	$this->version2_model->submitNotsatisfied();
                echo $set;
        }
        public function  blood_transfer_collection(){ 
                if($this->session->userdata("manage-transfer-blood") != "1"){
                        redirect("admin");
                }  
                $dta 	=	array(
                                    "title"	=>	"Blood Transfer",
                                    "content"	=>	"version_2/transfer_collection",
                                    "bloodbank_type"    =>      $this->version2_model->bloodbank_type(),
                                    "blood_group"       =>      $this->bloodbank_model->blood_groups(),
                                    "blood_name" 	=>      $this->blood_bank_model->view_blood(array("uri" => "Blood Bank"))
                                );
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("screen","Screened/UnScreened","required");
                        $this->form_validation->set_rules("datem","From and To Date","required|trim|xss_clean");
                        $this->form_validation->set_rules("blood_bank_type","Blood Bank Type","required|trim|xss_clean");
                        $this->form_validation->set_rules("transfer_bloodbank","Blood Bank","required|trim|xss_clean");
                        if($this->input->post("screen") == '1'){
                                $this->form_validation->set_rules("transfer_bags[]","Bag Numbers","required");
                                $this->form_validation->set_rules("transfer_group","Blood Group","required");
                        }
                        if($this->input->post("screen") == '2'){
                                $this->form_validation->set_rules("transfer_donors[]","Donors","required");
                        }
                        if($this->form_validation->run() == TRUE){
                                $set =	$this->version2_model->blood_transfer_collection();
                                if($set > 0){
                                        $this->session->set_flashdata("suc","Blood Donors has been transferred Successfully.");
                                        redirect("admin/transfer-collection"); 
                                }else{
                                        $this->session->set_flashdata("err","Blood Donors has been not transferred Successfully.");
                                        redirect("admin/transfer-collection");
                                }
                        }
                }
                $this->load->view("admin/layout/inner_template",$dta);  
        }
        public function export_excel(){
                $uri    =   $this->uri->segment("3");
                $pri    =   $this->uri->segment("4");
                $parmas = array();
                if($uri != "0"){
                    $parmas["intervalue"]   =   $uri;
                }
                $district       =   $this->input->post('district')?$this->input->post('district'):"";
                $city           =   $this->input->post('city')?$this->input->post('city'):"";
                $component      =   $this->input->post('blood_bank_type')?$this->input->post('blood_bank_type'):"";
                $zero_units     =   $this->input->post('zero_units');
                if(!empty($district)){
                        $parmas['district'] = $district;
                } 
                if(!empty($city)){
                        $parmas['city'] = $city;
                } 
                if(!empty($component)){
                        $parmas['component'] = $component;
                } 
                if($zero_units == '0'){
                        $parmas['zero_units'] = $zero_units;
                } 
                if($pri == '1'){
                        $quer   =   $this->version2_model->oblood_collection($parmas); 
                }else{
                        $quer   =   $this->version2_model->oblood_available($parmas); 
                }                
                $csv_header =   ""; $csv_row = ""; 
                $csv_header .= "Blood Bank,District,City,Mobile No,Contact No,Email Id,Updated On";   
                $csv_header .= "\n";
                foreach($quer as $vp){    
                        $csv_row .= '"'.$vp->bloodbank_name.'",'; 
                        $csv_row .= '"'.$vp->district.'",'; 
                        $csv_row .= '"'.$vp->city.'",'; 
                        $csv_row .= '"'.$vp->bbmobile.'",'; 
                        $csv_row .= '"'.$vp->contact_no.'",'; 
                        $csv_row .= '"'.$vp->email_id.'",';
                        $csv_row .= '"'.date("d M Y",strtotime($vp->out_updated_on)).'",';
                        $csv_row .= "\n";
                // echo $csv_row;exit;
                } 
                /* Download as CSV File */
                header('Content-type: application/csv');
                header('Content-Disposition: attachment; filename='.str_replace(" ","_",$this->input->post("reports_type")).date('Y-m-d').'.csv');
                $vsg    =   $csv_header . $csv_row;
                echo $vsg; 
        }
        public function bloodcollection(){
                $dta 	=	array(
                        "title"		=>	"Blood Issue",
                        "content"	=>	"version_2/out_blood_collection",
                        "blood_groups"  =>      $this->bloodbank_model->blood_groups(),
                        "out_avail"     =>      $this->version2_model->out_collection() 
                );
                if($this->input->post("submit")){
                        $uipf   =   $this->version2_model->update_collection();
                        if($uipf){ 
                                $this->session->set_flashdata("suc","Blood Collection has been updated Successfully.");
                                redirect("admin/out-blood-collection");
                        }else{
                                $this->session->set_flashdata("err","Blood Collection has been not updated Successfully.");
                                redirect("admin/out-blood-collection");
                        }
                }
                $this->load->view("admin/layout/inner_template",$dta);
        }
}