<?php 
class Bloodbank extends CI_Controller{
		public function __construct(){
                        parent::__construct();
                        $this->config->set_item('enable_query_strings',FALSE);
                        if($this->session->userdata("manage-blood-banks") == ""){
                                redirect("admin");
                        }
		}
		public function create_form(){ 
                        if($this->session->userdata("create-blood-bank") == ""){
                                        redirect("admin");
                        }
                        $dta 	=	array(
                                        "title"             =>	"Bloodbank Form",
                                        "content"           =>	"bloodbank_form",
                                        "bloodbank_type"    =>  $this->version2_model->bloodbank_type(),
                                        "district"          =>  $this->common_model->district(),
                                        "blood_banks"       =>  $this->blood_bank_model->view_blood(array('uri' => "Blood Bank"))
                        );
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("blood_bank_name","Blood Bank Name","required|trim|xss_clean");
                                $this->form_validation->set_rules("blood_bank_addr","Blood Bank Address","required|trim|xss_clean");
//                                $this->form_validation->set_rules("staten","State","required|xss_clean");
                                $this->form_validation->set_rules("blood_bank_type","Blood Bank Type","required|xss_clean");
                                if($this->input->post("blood_bank_type") == "2btype"){
                                        $this->form_validation->set_rules("assign_bloodbank[]","Assign Blood Banks","required");
                                }
                                $this->form_validation->set_rules("district","District","required|xss_clean");
                                $this->form_validation->set_rules("city","City","required|xss_clean");
                                $this->form_validation->set_rules("pincode","Pincode","required|trim|xss_clean|max_length[6]"); 
                                $this->form_validation->set_rules("email","Email Id","required|trim|xss_clean|callback_checkemail");
                                $this->form_validation->set_rules("category","Category","required|trim|xss_clean"); 
                                if($this->form_validation->run() == TRUE){
                                        $set =	$this->blood_bank_model->register();
                                        if($set > 0){
                                                        $this->session->set_flashdata("suc","Blood Bank Registered Successfully.");
                                                        redirect("admin/create_blood_bank");
                                        }else{
                                                        $this->session->set_flashdata("err","Blood Bank not registered Successfully.");
                                                        redirect("admin/create_blood_bank");
                                        }
                                }
                        }
                        $dta["state"]	=	$this->common_model->view_states();
                        $this->load->view("admin/layout/inner_template",$dta);
		}
                public function checkemail($str){ 
                        $vsp	=	$this->employee_model->check_user("l.login_email",$str);
                        if($vsp){
                                $this->form_validation->set_message("checkemail","Email Id already exists.");
                                return FALSE;
                        }	
                        return TRUE; 
                }
                public function uri_seh($urip){ 
                        $uri    =   "Blood Bank";
                        if($urip == '1'){
                                $uri    =   "Blood Bank";
                        }
                        if($urip == '2'){
                                $uri    =   "Mother Blood Bank";
                        }
                        if($urip == '3'){
                                $uri    =   "Blood Storage Centre";
                        }
                        if($urip == '4'){
                                $uri    =   "BCTV (Blood Collection and Transportation Vehicles)";
                        }
                        return $uri;
                }
                public function edit_seh($urip){ 
                        $uri    =   "Blood Bank";
                        if($urip == '1'){
                                $uri    =   "blood-bank";
                        }
                        if($urip == '2'){
                                $uri    =   "mother-blood-bank";
                        }
                        if($urip == '3'){
                                $uri    =   "blood-storage";
                        }
                        if($urip == '4'){
                                $uri    =   "bctv";
                        }
                        return $uri;
                }
		public function view_form(){ 
                        $urip    =      $this->uri->segment(3);  
                        $uri     =      $this->uri_seh($urip);
                        $edit    =      $this->edit_seh($urip); 
                        $yu      =   "view-".$edit;
                        $up      =   $this->session->userdata($yu);   
                        if($up != '1'){
                                redirect("admin");
                        }
                        
                        $dta 	 =	array(
                                            "title"		=>	"View ".$uri."s",
                                            "content"           =>	"view_blood",
                                            "uript"             =>      $uri,
                                            "button"            =>      $edit
                                        ); 
                        $this->perPage         =   "15"; 
                        if($uri != "Mother Blood Bank"){
                                $tot    =   $this->blood_bank_model->ctbloodbanks(array("uri" => $uri))->cnt_bank;
                                $view   =   $this->blood_bank_model->view_blood(array('limit'=>$this->perPage,"uri" => $uri));
                        }else{ 
                                $tot     =   $this->version2_model->cnt_motherquery(); 
                                $view    =   $this->version2_model->view_motherquery(array('limit'=>$this->perPage)); 
                        }
                        $totalRec              =    $tot;
                        $config['base_url']    =    base_url().'admin/viewBloodbank/'.$urip;
                        $config['total_rows']  =    $totalRec;
                        $config['per_page']    =    $this->perPage; 
                        $config['link_func']   =    'searchFilter';
                        $config['uri_segment'] =    4;
                        $this->ajax_pagination->initialize($config);
                        $dta["view"]	=	$view;
                        $this->load->view("admin/layout/inner_template",$dta);
		}
		public function edit_form(){  
                    $urip 	=	$this->uri->segment("3");
                    $id 	=	$this->uri->segment("4");
                    $uri        =      $this->uri_seh($urip);
                    $edit       =      $this->edit_seh($urip);
                    $dta 	=	array(
                                            "title"		=>	"Bloodbank Form",
                                            "content"           =>	"editbloodbank_form",
                                            "uript"             =>      $uri,
                                            "button"            =>      $edit,
                                            "bloodbank_type"    =>      $this->version2_model->bloodbank_type(),
                                            "blood_banks"       =>  $this->blood_bank_model->view_blood(array('uri' => "Blood Bank"))
                                    ); 
                    $vsp                =       $this->blood_bank_model->edit_blood($id);
                    if($this->input->post("submit")){ 
                            $this->form_validation->set_rules("blood_bank_type","Blood Bank Type","required|xss_clean");  
                            $this->form_validation->set_rules("blood_bank_name","Blood Bank Name","required|trim|xss_clean");
                            $this->form_validation->set_rules("blood_bank_addr","Blood Bank Address","required|trim|xss_clean");
//                            $this->form_validation->set_rules("staten","State","required|xss_clean");
                            $this->form_validation->set_rules("district","District","required|xss_clean");
                            $this->form_validation->set_rules("city","City","required|xss_clean");
                            $this->form_validation->set_rules("pincode","Pincode","required|trim|xss_clean|max_length[6]"); 
                            $this->form_validation->set_rules("email","Email Id","required|trim|xss_clean");
                            $this->form_validation->set_rules("category","Category","required|trim|xss_clean"); 
                            if($this->input->post("blood_bank_type") == "2btype"){
                                    $this->form_validation->set_rules("assign_bloodbank[]","Assign Blood Banks","required");
                            }
                            if($this->form_validation->run() == TRUE){
                                    $picture    =   $vsp->bb_licensed;
                                    if($_FILES['file_upload']['name'] != ''){ 
                                            $fname          =       $_FILES['file_upload']['name'];  
                                            $fv             =       explode(".",basename($fname));
                                            $idp            =       $fv['0'].".".$fv['1'];  
                                            $config         =       array ( 
                                                                        'upload_path'         =>       './resources/jdadmin_assets/js_uploads/',
                                                                        'file_name'           =>       $idp,
                                                                        'allowed_types'       =>       '*'
                                                                    ); 
                                            $this->load->library("upload",$config); 
                                            $this->upload->initialize($config); 
                                            if($this->upload->do_upload('file_upload')){
                                                    $uploadData       =         $this->upload->data();        
                                                    $picture          =         $uploadData['file_name'];    
                                            }else{
                                                    $err      =   $this->upload->display_errors(); 
                                            }
                                    }
                                    if($err != ''){
                                            $this->session->set_flashdata("err",$err);
                                            redirect("admin/update-".$edit."/".$urip."/".$id);
                                    }
                                    if($picture != ""){
                                            $this->db->update("bloodbanks",array('bb_licensed' => $picture),array("blood_login_id" => $id));
                                            $sp     =   $this->db->affected_rows();
                                    }
                                    $set =	$this->blood_bank_model->update_form($id);
                                    if($set > 0 || $sp > 0){
                                            $this->session->set_flashdata("suc","Blood Bank Updated Successfully.");
                                            redirect("admin/update-".$edit."/".$urip."/".$id);
                                    }else{
                                            $this->session->set_flashdata("err","Blood Bank not Updated Successfully.");
                                            redirect("admin/update-".$edit."/".$urip."/".$id);
                                    }
                            }
                    }
                    $dta["view"]	=	$vsp;
                    $dta["state"]	=	$this->common_model->view_states();
                    $dta["district"]	=	$this->common_model->district();
                    $dta["city"]	=	$this->common_model->get_city($vsp->district);
                    $this->load->view("admin/layout/inner_template",$dta);
		}
                public function viewBloodbank(){ 
                        $urip    =      $this->uri->segment(3);  
                        $uri     =      $this->uri_seh($urip);                        
                        $edit    =      $this->edit_seh($urip);
                        $yu      =   "view-".$edit;
                        $up      =   $this->session->userdata($yu);   
                        if($up != '1'){
                                redirect("admin");
                        }
                        $conditions = array();
                        $page = $this->uri->segment('4');
                        if(!$page){
                            $offset = 0;
                        }else{
                            $offset = $page;
                        }
                        $keywords       =   $this->input->post('keywords');                         
                        if(!empty($keywords)){
                            $conditions['keywords'] = $keywords;
                        }  
                        if(!empty($uri)){
                            $conditions['uri'] = $uri;
                        }  
                        $this->perPage  =   "15"; 
                        $conditions['start'] = $offset;
                        $conditions['limit'] = $this->perPage;
                        if($uri != "Mother Blood Bank"){
                                $tot    =   $this->blood_bank_model->ctbloodbanks($conditions)->cnt_bank;
                                $view   =   $this->blood_bank_model->view_blood($conditions);
                        }else{ 
                                $tot     =   $this->version2_model->cnt_motherquery(); 
                                $view    =   $this->version2_model->view_motherquery($conditions); 
                        }
                        $totalRec =     $tot;
                        $config['base_url']    =    base_url().'admin/viewBloodbank/'.$urip;
                        $config['total_rows']  = $totalRec;
                        $config['per_page']    = $this->perPage; 
                        $config['link_func']   = 'searchFilter';
                        $config['uri_segment'] =    4;
                        $this->ajax_pagination->initialize($config);
                        $dta 	=	array(
                                "title"		=>	"Staff", 
                                "view"          =>      $view,
                                "uript"         =>      $uri,
                                "button"        =>      $edit,
                        ); 
                        $this->load->view("admin/pages/ajax-data/bloodbank",$dta);
                }
}