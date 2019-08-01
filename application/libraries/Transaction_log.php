<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Transaction_log{ 
        public function save_log($utk,$uri,$mri,$rmk,$usr_d){
                $ci     =   &get_instance();
                $ci->load->database(); 
                $ci->db->select("max(id) as maxid");
                $valp 	=   $ci->db->get("transaction_log")->row(); 
                $vt     =   $valp->maxid+1;
                $ft     =   array(
                        "trans_id"          =>     $vt."trans",
                        "trans_usr_id"      =>     $usr_d,
                        "trans_name"        =>     $uri,
                        "trans_form"        =>     $utk,
                        "trans_value"       =>     $mri,
                        "trans_ctime"       =>     date("Y-m-d h:i:s"),
                        "trans_remarks"     =>     $rmk
                );   
                $ci->db->insert("transaction_log",$ft); 
                if($ci->db->insert_id() > 0){
                        return TRUE;
                }
                return FALSE;
        } 
}