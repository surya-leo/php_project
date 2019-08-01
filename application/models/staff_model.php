<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staff_model extends CI_Model{
        public function  get_query(){
                $drt    =   array(
                        "s.staff_open"      =>  "1",
                        "u.ut_open"         =>  "1",
                        "t.btype_open"      =>  "1"
                );
                return  $this->db->select("*")
                                ->from("staff as s") 
                                ->join("login as l","l.login_id = s.staff_login_id","INNER")
                                ->join("bloodbanks as bs","bs.bloodbank_id = s.staff_bloodbank_id","INNER") 
                                ->join("bloodbank_type as t","bs.blood_bank_type = t.btype_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("blood_groups as b","b.blood_group_id = s.staff_blood_group","INNER")
                                ->where('l.login_open',"1")
                                ->where($drt);
        }
        public function  get_querycols($cols,$st){
                $drt    =   array(
                        "s$st.staff_open"      =>  "1",
                        "u$st.ut_open"         =>  "1",
                        "t$st.btype_open"      =>  "1",
                        "l$st.login_open"      =>  "1"
                );
                return  $this->db->select($cols,FALSE)
                                ->from("staff as s$st") 
                                ->join("login as l$st","l$st.login_id = s$st.staff_login_id","INNER")
                                ->join("bloodbanks as bs$st","bs$st.bloodbank_id = s$st.staff_bloodbank_id","INNER") 
                                ->join("bloodbank_type as t$st","bs$st.blood_bank_type = t$st.btype_id","INNER")
                                ->join("usertype as u$st","u$st.ut_id = l$st.login_type","INNER")
                                ->join("blood_groups as b$st","b$st.blood_group_id = s$st.staff_blood_group","INNER") 
                                ->where($drt);
        }
        public function check_user($mob,$str){
                $byh    =       $this->login_model->get_loginquery()
                                    ->where($mob,$str)
                                    ->get()->result();
                $vsp 	=	count($byh);  
                if($vsp > 0){
                        return TRUE;
                }
                return FALSE;
        } 
        public function check_euser($mob,$str){
                $byh    =       $this->get_query()
                                    ->where($mob,$str)
                                    ->get()->result();
                $vsp 	=	count($byh);  
                if($vsp > 0){
                        return TRUE;
                }
                return FALSE;
        } 
        public function view_staff($uri){
                $pri    =   $this->donation_details_model->get_medical($uri);
                return $this->get_query()
                        ->where("bs.bloodbank_id",$pri->bloodbank_id)
                        ->get()->result();
        }
        public function get_staff($uri){ 
                return $this->get_query()
                        ->where("s.staff_login_id",$uri)
                        ->get()->row(); 
        }
        public function create_staff(){
                if($this->session->userdata("login_parent") == "1"){
                        $alp  = $this->input->post("blood_name");
                }
                else{
                        $alp  = $this->blood_bank_model->get_val($this->session->userdata("login_id"));
                }
                $loin    =   array(
                        "login_email"       =>  $this->input->post("email_id"),
                        "login_password"    =>  md5("123456"),
                        "login_parent"      =>  "3",
                        "login_type"        =>  $this->role_model->get_uname("Blood Bank Staff"),
                        "login_created"     =>  date("Y-m-d h:i:s")
                );
                $this->db->insert("login",$loin);
                $login  =   $this->db->insert_id();
                $ftg    =   array(
                        "staff_id"              =>  $this->common_model->get_variable("staff")."stff",
                        "staff_login_id"        =>  $login ,
                        "staff_bloodbank_id"    =>  $alp,
                        "staff_blood_group"           =>  $this->input->post("blood_group"),
                        "gender"                =>  $this->input->post("gender"),
                        "staff_email_id"              =>  $this->input->post("email_id"),
                        "staff_mobile_no"             =>  $this->input->post("mobile"),
                        "first_name"            =>  $this->input->post("first_name"),
                        "last_name"             =>  $this->input->post("last_name"),
                        "dob"                   =>  $this->input->post("dob")
                );
                $this->db->insert("staff",$ftg);
                return $this->db->insert_id();
        }
        public function update_staff($uri){
                if($this->session->userdata("login_parent") == "1"){
                        $alp  = $this->input->post("blood_name");
                }
                else{
                        $alp  = $this->blood_bank_model->get_val($this->session->userdata("login_id"));
                }  
                $ftg    =   array( 
                        "staff_bloodbank_id"    =>  $alp,
                        "staff_blood_group"           =>  $this->input->post("blood_group"),
                        "gender"                =>  $this->input->post("gender"), 
                        "first_name"            =>  $this->input->post("first_name"),
                        "last_name"             =>  $this->input->post("last_name"),
                        "dob"                   =>  $this->input->post("dob")
                );
                $this->db->update("staff",$ftg,array("staff_login_id" => $uri));
                return $this->db->affected_rows();
        }
        public function delete_staff($uri){  
                $ftg    =   array( 
                        "staff_open"    =>  "0"
                );
                $this->db->update("staff",$ftg,array("staff_login_id" => $uri));
                return $this->db->affected_rows();
        }
        public function cntview_staff($params = array()){ 
                if($this->session->userdata("login_parent") == "0"){ 
                        $alp    =    $this->blood_bank_model->get_val($this->session->userdata("login_id")); 
                        $this->db->where("s.staff_bloodbank_id",$alp);
                }  
                $drt    =   array(
                        "s.staff_open"      =>  "1",
                        "u.ut_open"         =>  "1",
                        "t.btype_open"      =>  "1"
                );
                $this->db->select("count(*) as cnt")
                            ->from("staff as s") 
                            ->join("login as l","l.login_id = s.staff_login_id","INNER")
                            ->join("bloodbanks as bs","bs.bloodbank_id = s.staff_bloodbank_id","INNER") 
                            ->join("bloodbank_type as t","bs.blood_bank_type = t.btype_id","INNER")
                            ->join("usertype as u","u.ut_id = l.login_type","INNER")
                            ->join("blood_groups as b","b.blood_group_id = s.staff_blood_group","INNER")
                            ->where('l.login_open',"1")
                            ->where($drt);
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(bs.bloodbank_name LIKE '%".$params['keywords']."%' OR bs.state LIKE '%".$params['keywords']."%' OR bs.district LIKE '%".$params['keywords']."%' OR bs.city LIKE '%".$params['keywords']."%' OR s.last_name LIKE '%".$params['keywords']."%' OR s.first_name LIKE '%".$params['keywords']."%' OR b.blood_group_name LIKE '%".$params['keywords']."%' OR l.login_email LIKE '%".$params['keywords']."')");
                }     
                $vso    =   $this->db->get()->row();
                return  $vso->cnt;
        }
        public function view_staffs($params = array()){  
                if($this->session->userdata("login_parent") == "2"){ 
                        $alp    =    $this->blood_bank_model->get_val($this->session->userdata("login_id")); 
                        $this->db->where("s.staff_bloodbank_id",$alp);
                }  
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(bs.bloodbank_name LIKE '%".$params['keywords']."%' OR bs.state LIKE '%".$params['keywords']."%' OR bs.district LIKE '%".$params['keywords']."%' OR bs.city LIKE '%".$params['keywords']."%' OR s.last_name LIKE '%".$params['keywords']."%' OR s.first_name LIKE '%".$params['keywords']."%' OR b.blood_group_name LIKE '%".$params['keywords']."%' OR l.login_email LIKE '%".$params['keywords']."')");
                } 
                $this->db->order_by("s.staff_id","DESC"); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                $vsp =  $this->get_query()->get(); 
                return $vsp->result();
        }
}