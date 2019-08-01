<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reports_model extends CI_Model{
        public function donation_querysummary($params = array()){
                $dt     =   array(
			"u.ut_open"     =>  "1",
			"t.btype_open"  =>  "1"
		);
                $vspa    =   $this->blood_bank_model->get_bloodquery()->where("l.login_id",$this->session->userdata("login_id"))->get()->row();
                if(array_key_exists("cnt",$params)){
                        $select     =   'count(*) as cnt';
                } else {
                        $select     =   "donation_details.donation_date,bloodbanks.bloodbank_name,
                                camps.camp_id,camp_description,
                                SUM(CASE WHEN sex='m' THEN 1 ELSE 0 END) 'male',
                                SUM(CASE WHEN sex='f' THEN 1 ELSE 0 END) 'female',
                                SUM(CASE WHEN 1 THEN 1 ELSE 0 END) 'total',
                                SUM(CASE WHEN blood_group='A+ve' THEN 1 ELSE 0 END) 'Apos',
                                SUM(CASE WHEN blood_group='A-ve' THEN 1 ELSE 0 END) 'Aneg',
                                SUM(CASE WHEN blood_group='B+ve' THEN 1 ELSE 0 END) 'Bpos',
                                SUM(CASE WHEN blood_group='B-ve' THEN 1 ELSE 0 END) 'Bneg',
                                SUM(CASE WHEN blood_group='AB+ve' THEN 1 ELSE 0 END) 'ABpos',
                                SUM(CASE WHEN blood_group='AB-ve' THEN 1 ELSE 0 END) 'ABneg',
                                SUM(CASE WHEN blood_group='O+ve' THEN 1 ELSE 0 END) 'Opos',
                                SUM(CASE WHEN blood_group='O-ve' THEN 1 ELSE 0 END) 'Oneg',
                                SUM(CASE WHEN blood_group='Rh+ve' THEN 1 ELSE 0 END) 'Rhpos',
                                SUM(CASE WHEN blood_group='Rh-ve' THEN 1 ELSE 0 END) 'Rhneg'";
                }
                
                if($this->session->userdata("login_type") == '3utype'){
                        $this->version2_model->get_bloodbanks();
                }
                $this->db->select("$select")
                        ->from("donation_details")
                        ->join("bloodbanks","bloodbanks.bloodbank_id = donation_details.dbbloodbank_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER")
                        ->join('bb_donation','donation_details.donation_id=bb_donation.bb_donation_details_id',"LEFT")
//                        ->join("bb_donation","donation_details.donor_id =   bb_donation.bbdonor_id","LEFT")
                        ->join("camps","camps.camp_id = donation_details.camp_name AND camps.camp_bank_id = bb_donation.hospital_id","LEFT")
                        ->where('l.login_open',"1")
                        ->where($dt)
                        ->where("bb_donation.status_id >=",5); 
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(donation_details.donation_date LIKE '%".$params['keywords']."%' OR bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%' OR  camp_description LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(donation_details.donation_date >= '".$asate['0']."' AND donation_details.donation_date <= '".$asate['1']."')");
                    }
                }
                if(array_key_exists("searbloodbank_id",$params)){
                    if($params["searbloodbank_id"] != "" && $params["searbloodbank_id"] != "All"){ 
                        $this->db->where("donation_details.dbbloodbank_id",$params["searbloodbank_id"]);
                    }else if($params["searbloodbank_id"] == "All"){
                        $this->version2_model->get_assignbanks($vspa);
                    }
                } else {
                    if($this->session->userdata("login_bloodbank_id") != ''){
                        $this->db->where("bb_donation.hospital_id",$this->session->userdata("login_bloodbank_id"));
                    }
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                $this->db->group_by("donation_details.donation_date,donation_details.dbbloodbank_id,donation_details.camp_name")
                        ->order_by("donation_details.donation_date","desc"); 
//                $this->db->get();echo $this->db->last_query();exit;
                return  $this->db->get();
        }
        public function cntdonation_summary($params = array()){ 
                $params["cnt"]  =   '1';
                $vsp    =  $this->donation_querysummary($params)->row();
                if(count($vsp)  >0 ){
                    return  $vsp->cnt;
                }
                return  "0";
        }
        public function donation_summary($params = array()){
                return  $this->donation_querysummary($params)->result();
        }
}