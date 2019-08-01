<?php 
class Settings extends CI_Controller{
        public function __construct(){
                parent::__construct();
                $this->config->set_item('enable_query_strings',FALSE);
                if($this->session->userdata("login_id") == ""){
                                redirect("admin");
                }
        }
        public function change_password(){
                $dta 	=	array(
                                "title"		=>	"Change Password",
                                "content"	=>	"change_password"
                );
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("new_pass","New Password","required|trim|xss_clean|min_length[6]|max_length[20]");
                        $this->form_validation->set_rules("con_pass","Confirm Password","required|trim|min_length[6]|max_length[20]|xss_clean|matches[new_pass]"); 
                        if($this->form_validation->run() == TRUE){
                                                $set =	$this->common_model->change_password();
                                                if($set > 0){
                                                                $this->session->set_flashdata("suc","Password Changed Successfully.");
                                                                redirect("admin/change_password");
                                                }else{
                                                                $this->session->set_flashdata("err","Password not changed.");
                                                                redirect("admin/change_password");
                                                }
                        }
                } 
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function blood_bank_form(){
                $dta 	=	array(
                                "title"		=>	"Bloodbank Form",
                                "content"	=>	"version_2/blood_bank",
                                "bloodbank_type"    =>  $this->version2_model->bloodbank_type()
                );
                $id 	=	$this->session->userdata("login_id"); 
                $view   =       $this->blood_bank_model->edit_blood($id);
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("blood_bank_name","Blood Bank Name","required|trim|xss_clean");
                        $this->form_validation->set_rules("blood_bank_addr","Blood Bank Address","required|trim|xss_clean");
                        $this->form_validation->set_rules("blood_bank_type","Blood Bank Type","required|trim|xss_clean");
                        $this->form_validation->set_rules("staten","State","required|xss_clean");
                        $this->form_validation->set_rules("district","District","required|xss_clean");
                        $this->form_validation->set_rules("city","City","required|xss_clean");
                        $this->form_validation->set_rules("pincode","Pincode","required|trim|xss_clean|max_length[6]"); 
                        $this->form_validation->set_rules("email","Email Id","required|trim|xss_clean");
                        $this->form_validation->set_rules("category","Category","required|trim|xss_clean"); 
                        if($this->form_validation->run() == TRUE){
                                $picture    =   $view->bb_licensed;
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
                                        redirect("admin/blood_bank/");
                                }
                                if($picture != ""){
                                        $this->db->update("bloodbanks",array('bb_licensed' => $picture),array("blood_login_id" => $id));
                                        $sp     =   $this->db->affected_rows();
                                }
                                $set =	$this->blood_bank_model->update_form($id);
                                if($set > 0 ||  $sp > 0){
                                        $this->session->set_flashdata("suc","Blood Bank Updated Successfully.");
                                        redirect("admin/blood_bank/");
                                }else{
                                        $this->session->set_flashdata("err","Blood Bank not Updated Successfully.");
                                        redirect("admin/blood_bank/");
                                }
                        }
                }
                $dta["view"]        =	$view;
                $dta["state"]       =	$this->common_model->view_states();
                $dta["district"]    =	$this->common_model->district();
                $dta["city"]        =	$this->common_model->city();
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function users(){
                if($this->session->userdata("manage-users") != "1"){
                        redirect("admin");
                } 
                $totalRec = count($this->common_model->users(array()));
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewUsers';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta 	=	array(
                        "title"		=>	"Users",
                        "content"	=>	"users",
                        "view"          =>      $this->common_model->users(array('limit'=>$this->perPage))
                );  
                $this->load->view("admin/layout/inner_template",$dta); 
        }
        public function viewUsers(){
                if($this->session->userdata("manage-users") != "1"){
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
                $totalRec = count($this->common_model->users($conditions));
                $this->perPage  =   "15"; 
                $config['base_url']    = base_url().'admin/viewUsers';
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage; 
                $config['link_func']   = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"Staff", 
                        "view"          =>      $this->common_model->users($conditions)
                ); 
                $this->load->view("admin/pages/ajax-data/users",$dta);
        }
}