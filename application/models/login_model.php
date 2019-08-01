<?php
class Login_model extends CI_Model{
        public function authenticate(){
                $dt     =   array(
                                    "login_email" 	=>	$this->input->post("email"),
                                    "login_password"	=> 	md5($this->input->post("password"))
                            );
                $qu     =   $this->get_loginquery()->where($dt)->get(); 
                if($qu->num_rows() >0){
                        $this->session->set_userdata($qu->row_array());
                        $par    =   $this->session->userdata("login_parent"); 
                        $uri    =   $this->session->userdata("login_id"); 
                        if($par     ==  '2'){
                                $vfg    =   $this->blood_bank_model->get_bookval($uri);
                                $this->session->set_userdata("login_bloodbank_id",$vfg);
                        } 
                        if($par     ==  '3'){
                                $vfg    =   $this->staff_model->get_staff($uri);
                                $this->session->set_userdata("login_bloodbank_id",$vfg->staff_bloodbank_id);
                        }  
                        $vkp    =   $this->get_roles($this->session->userdata("login_type")); 
                        if(count($vkp)){
                                foreach($vkp as $vtp){
                                    $this->session->set_userdata($vtp->page_name,$vtp->per_status);
                                }
                        } 
                        return TRUE;
                }else{
                        return FALSE;
                }
        }
        public function get_loginquery(){
                return  $this->db->select()
                                ->from("login as l")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->where('l.login_open',"1")
                                ->where("u.ut_open","1");
        }
        public function get_roles($vsp){
                $this->db->select("p.page_name,s.per_status")
                        ->from("pages as p")
                        ->join("permissions as s","s.per_page_id = p.page_id","LEFT")
                        ->where("s.per_usertype",$vsp);
                $vkp = $this->db->get()->result();
                return $vkp;
        }
}