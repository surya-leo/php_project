<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Employee_model extends CI_Model{
        public function  get_query(){
                $drt    =   array(
                        "s.employee_open"   => "1",
                        "u.ut_open"         => "1",
                );
                return  $this->db->select("*")
                                ->from("employees as s") 
                                ->join("login as l","l.login_id = s.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("blood_groups as b","b.blood_group_id = s.blood_group","INNER")
                                ->where('l.login_open',"1")
                                ->where($drt);
        }
        public function  cntview_employees($params = array()){
                $drt    =   array(
                        "s.employee_open"   => "1",
                        "u.ut_open"         => "1"
                );
                $this->db->select("count(*) as cnt")
                                ->from("employees as s") 
                                ->join("login as l","l.login_id = s.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("blood_groups as b","b.blood_group_id = s.blood_group","INNER")
                                ->where('l.login_open',"1")
                                ->where($drt);
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(s.first_name LIKE '%".$params['keywords']."%' OR s.last_name LIKE '%".$params['keywords']."%' OR s.email_id LIKE '%".$params['keywords']."%' OR s.mobile_no LIKE '%".$params['keywords']."%' OR b.blood_group_name LIKE '%".$params['keywords']."%')");
                } 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                $csp    =   $this->db->get()->row();
                return $csp->cnt;
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
        public function view_employees($params = array()){   
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(s.first_name LIKE '%".$params['keywords']."%' OR s.last_name LIKE '%".$params['keywords']."%' OR s.email_id LIKE '%".$params['keywords']."%' OR s.mobile_no LIKE '%".$params['keywords']."%' OR b.blood_group_name LIKE '%".$params['keywords']."%')");
                } 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                return   $this->get_query()->get()->result();
        } 
        public function get_employee($uri){   
                return   $this->get_query()->where("l.login_id",$uri)->get()->row();
        } 
        public function create_employee(){ 
                $loin    =   array(
                        "login_email"       =>  $this->input->post("email_id"),
                        "login_password"    =>  md5("123456"),
                        "login_parent"      =>  "4",
                        "login_type"        =>  $this->role_model->get_uname("Employees"),
                        "login_created"     =>  date("Y-m-d h:i:s")
                );
                $this->db->insert("login",$loin);
                $login  =   $this->db->insert_id();
                $ftg    =   array(
                        "employee_id"       =>  $this->common_model->get_variable("employees")."emp",
                        "login_id"          =>  $login,
                        "gender"            =>  $this->input->post("gender"),
                        "email_id"          =>  $this->input->post("email_id"),
                        "mobile_no"         =>  $this->input->post("mobile"),
                        "first_name"        =>  $this->input->post("first_name"),
                        "last_name"         =>  $this->input->post("last_name"),
                        "dob"               =>  $this->input->post("dob"),
                        "emp_district"      =>  $this->input->post("district"),
                        "blood_group"       =>  $this->input->post("blood_group"),
                        "bloodbanks"        =>  implode(",",array_filter($this->input->post("assign_bloodbank"))),
                    
                ); 
                $this->db->insert("employees",$ftg);
                return $this->db->insert_id();
        } 
        public function update_employee($uri){   
                $ftg    =   array( 
                        "gender"            =>  $this->input->post("gender"), 
                        "first_name"        =>  $this->input->post("first_name"),
                        "last_name"         =>  $this->input->post("last_name"),
                        "dob"               =>  $this->input->post("dob"),
                        "blood_group"       =>  $this->input->post("blood_group"),
                        "emp_district"      =>  $this->input->post("district"),
                        "bloodbanks"        =>  implode(",",array_filter($this->input->post("assign_bloodbank")))                    
                ); 
                $this->db->update("employees",$ftg,array("login_id" => $uri));
                return $this->db->affected_rows();
        } 
        public function delete_employee($uri){   
                $ftg    =   array( 
                        "employee_open"            =>  "0"             
                ); 
                $this->db->update("employees",$ftg,array("login_id" => $uri));
                return $this->db->affected_rows();
        } 
}