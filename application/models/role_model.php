<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Role_model extends CI_Model{
        public function view_role($params   =   array()){
                $this->db->where("id != ","1"); 
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(ut_name LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }               
                $this->db->order_by("ut_id","DESC");
                return $this->db->get_where("usertype",array("ut_open" => "1"))->result();
        }
        public function get_role($uri){  
                return $this->db->get_where("usertype",array("ut_open" => "1","ut_id" => $uri))->row();
        }
        public function get_uname($uri){  
                $vsp    =    $this->db->get_where("usertype",array("ut_open" => "1","ut_name" => $uri))->row();
                return      $vsp->ut_id;
        }
        public function cntview_role($params = array()){
                $this->db->select("count(*) as cnt");
                $this->db->where("id != ","1"); 
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(ut_name LIKE '%".$params['keywords']."%')");
                }
                $vsp    =   $this->db->get_where("usertype",array("ut_open" => "1"))->row();
                return $vsp->cnt;
        }
        public function get_userroles(){
                $this->db->where("id > ","2");  
                $this->db->order_by("ut_name","DESC");
                return $this->db->get_where("usertype",array("ut_open" => "1"))->result();
        }
        public function create_role(){
                $ftp    =   $this->common_model->get_variable("usertype")."utype"; 
                $ft     =   array(
                        "ut_id"         =>  $ftp,
                        "ut_name"       =>  $this->input->post("rolename"),
                        "ut_created_on" =>  date("Y-m-d h:i:s"),
                        "ut_created_by" =>  $this->session->userdata("login_id")
                ); 
                $this->db->insert("usertype",$ft);
                return $this->db->insert_id();
        }
        public function update_role($uri) {
               $ft     =   array( 
                        "ut_name"           =>  $this->input->post("rolename"),
                        "ut_modified_on"    =>  date("Y-m-d h:i:s"),
                        "ut_modified_by"    =>  $this->session->userdata("login_id")
                ); 
                $this->db->update("usertype",$ft,array("ut_id" => $uri));
                return $this->db->affected_rows(); 
        }
        public function delete_col($uri) {
               $ft     =   array( 
                        "ut_open"           =>  "0",
                        "ut_modified_on"    =>  date("Y-m-d h:i:s"),
                        "ut_modified_by"    =>  $this->session->userdata("login_id")
                ); 
                $this->db->update("usertype",$ft,array("ut_id" => $uri));
                return $this->db->affected_rows(); 
        } 
}