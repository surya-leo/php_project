<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Issue_report_model extends CI_Model{
        public function issue_summaryquery($params = array()){
                $vspa    =   $this->blood_bank_model->get_bloodquery()->where("l.login_id",$this->session->userdata("login_id"))->get()->row();
                $this->db->select('
                        issue_date,issue_time,bloodbank_name,
                        SUM(CASE WHEN 1 THEN 1 ELSE 0 END) "total",
                        SUM(CASE WHEN blood_group="A+ve" THEN 1 ELSE 0 END) "Apos",
                        SUM(CASE WHEN blood_group="A-ve" THEN 1 ELSE 0 END) "Aneg",
                        SUM(CASE WHEN blood_group="B+ve" THEN 1 ELSE 0 END) "Bpos",
                        SUM(CASE WHEN blood_group="B-ve" THEN 1 ELSE 0 END) "Bneg",
                        SUM(CASE WHEN blood_group="AB+ve" THEN 1 ELSE 0 END) "ABpos",
                        SUM(CASE WHEN blood_group="AB-ve" THEN 1 ELSE 0 END) "ABneg",
                        SUM(CASE WHEN blood_group="O+ve" THEN 1 ELSE 0 END) "Opos",
                        SUM(CASE WHEN blood_group="O-ve" THEN 1 ELSE 0 END) "Oneg",
                        SUM(CASE WHEN blood_group="Rh+ve" THEN 1 ELSE 0 END) "Rhpos",
                        SUM(CASE WHEN blood_group="Rh-ve" THEN 1 ELSE 0 END) "Rhneg"
                        ') 
                        ->from('donation_details')
//                        ->join('bb_donation','donation_details.donor_id=bb_donation.bbdonor_id')
                        ->join('bb_donation','donation_details.donation_id=bb_donation.bb_donation_details_id')
                        ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                        ->join('blood_inventory','bb_donation.bbdonation_id=blood_inventory.bidonation_id')
                        ->join('bb_issued_inventory','blood_inventory.inventory_id=bb_issued_inventory.inventory_id')
                        ->join('blood_issue','bb_issued_inventory.issue_id=blood_issue.issue_id')
                        ->where('u.ut_open',"1")
                        ->where('t.btype_open',"1") 
                        ->where('l.login_open',"1")
                        ->where('blood_inventory.bistatus_id',8);
                if(array_key_exists("searbloodbank_id",$params)){
                    if($params["searbloodbank_id"] != "" && $params["searbloodbank_id"] != "All"){ 
                        $this->db->where("bb_donation.hospital_id",$params["searbloodbank_id"]);
                    }else if($params["searbloodbank_id"] == "All"){
                        $this->version2_model->get_assignbanks($vspa);
                    }
                } else {
                    if($this->session->userdata("login_bloodbank_id") != ''){
                        $this->db->where("bb_donation.hospital_id",$this->session->userdata("login_bloodbank_id"));
                    }
                }
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(issue_date LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(issue_date >= '".$asate['0']."' AND issue_date <= '".$asate['1']."')");
                    }
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                $this->db->group_by('issue_date'); 
                $this->db->order_by('issue_date','desc');  
                return $this->db->get();
        }
        public function cntissue_summary($params = array()){
                $this->issue_summaryquery($params);
                $subQuery =  "(".$this->db->last_query().") as d";
                $this->db->select("count(*) as cnt");
                $this->db->from($subQuery); 
                $vsp    =   $this->db->get()->row();
                return  $vsp->cnt;
        }
        public function issue_summary($params = array()){
            return  $this->issue_summaryquery($params)->result();
        }
        public function hospitalwisequery($params){  
                $this->db->select('
                        bloodbanks.bloodbank_name, 
                        SUM(CASE WHEN sex="m" THEN 1 ELSE 0 END) "male",
                        SUM(CASE WHEN sex="f" THEN 1 ELSE 0 END) "female",
                        SUM(CASE WHEN 1 THEN 1 ELSE 0 END) "total",
                        SUM(CASE WHEN donation_details.blood_group="A+ve" THEN 1 ELSE 0 END) "Apos",
                        SUM(CASE WHEN donation_details.blood_group="A-ve" THEN 1 ELSE 0 END) "Aneg",
                        SUM(CASE WHEN donation_details.blood_group="B+ve" THEN 1 ELSE 0 END) "Bpos",
                        SUM(CASE WHEN donation_details.blood_group="B-ve" THEN 1 ELSE 0 END) "Bneg",
                        SUM(CASE WHEN donation_details.blood_group="AB+ve" THEN 1 ELSE 0 END) "ABpos",
                        SUM(CASE WHEN donation_details.blood_group="AB-ve" THEN 1 ELSE 0 END) "ABneg",
                        SUM(CASE WHEN donation_details.blood_group="O+ve" THEN 1 ELSE 0 END) "Opos",
                        SUM(CASE WHEN donation_details.blood_group="O-ve" THEN 1 ELSE 0 END) "Oneg",
                        SUM(CASE WHEN donation_details.blood_group="Rh+ve" THEN 1 ELSE 0 END) "Rhpos",
                        SUM(CASE WHEN donation_details.blood_group="Rh-ve" THEN 1 ELSE 0 END) "Rhneg"
                        ')
                        ->from('donation_details')
//                        ->join('bb_donation','donation_details.donor_id=bb_donation.bbdonor_id','INNER')
                        ->join('bb_donation','donation_details.donation_id=bb_donation.bb_donation_details_id')
                        ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                        ->join('blood_inventory','bb_donation.bbdonation_id=blood_inventory.bidonation_id','INNER')
                        ->join('bb_issued_inventory','blood_inventory.inventory_id=bb_issued_inventory.inventory_id',"INNER")
                        ->join('blood_issue','bb_issued_inventory.issue_id=blood_issue.issue_id',"INNER")
                        ->join('blood_request','blood_issue.request_id=blood_request.request_id','LEFT') 
                        ->where('blood_inventory.bistatus_id',8) 
                        ->where('u.ut_open',"1")
                        ->where('t.btype_open',"1") 
                        ->where('l.login_open',"1")
                        ->group_by("bb_donation.hospital_id"); 
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(bbdonation_date >= '".$asate['0']."' AND bbdonation_date <= '".$asate['1']."')");
                    }
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                return $this->db->get();
        }  
        public function cnthospitalwise_summary($params = array()){
                $this->hospitalwisequery($params);
                $subQuery =  "(".$this->db->last_query().") as d";
                $this->db->select("count(*) as cnt");
                $this->db->from($subQuery); 
                $vsp    =   $this->db->get()->row();
                return  $vsp->cnt;
        }
        public function hospitalwise_summary($params = array()){
            return  $this->hospitalwisequery($params)->result();
        }
        public function detail_reportquery($params = array()){                  
                $this->staff_model->get_querycols("staff_login_id,CONCAT(first_name,' ',last_name) AS issued_staff_name","s1")->get();
                $s1    =   $this->db->last_query();
                $this->staff_model->get_querycols("staff_login_id,CONCAT(first_name,' ',last_name) AS cross_matched_staff_name","s2")->get();
                $s2    =   $this->db->last_query(); 
                $vspa    =   $this->blood_bank_model->get_bloodquery()->where("l.login_id",$this->session->userdata("login_id"))->get()->row();
                if(array_key_exists("cnt",$params)){
                        $select     =   'count(*) as cnt';
                }else{
                        $select  =   "concat(blood_request.patient_first_name,' ',blood_request.patient_last_name ) as patient_name,donor_id,donation_details.name,donation_details.blood_group,donation_date,blood_issue.issue_id, issue_date,issue_time,bb_donation.blood_unit_num, bb_donation.segment_num, blood_inventory.component_type, blood_inventory.bivolume, issued_staff_name, cross_matched_staff_name,bloodbanks.bloodbank_name,blood_request.patient_diagnosis,blood_request.*";
                }
                $this->db->select("$select",FALSE)
                        ->from('blood_inventory')
                        ->join('bb_donation','blood_inventory.bidonation_id=bb_donation.bbdonation_id','INNER')
//                        ->join('donation_details','bb_donation.bbdonor_id=donation_details.donor_id','INNER')
                        ->join('donation_details','donation_details.donation_id=bb_donation.bb_donation_details_id')
                        ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                        ->join('bb_issued_inventory','blood_inventory.inventory_id=bb_issued_inventory.inventory_id','left')
                        ->join('blood_issue','bb_issued_inventory.issue_id=blood_issue.issue_id','left')
                        ->join('blood_request','blood_issue.request_id=blood_request.request_id','left')     
                        ->join('('.$s1.') issued_staff','blood_issue.issued_by=issued_staff.staff_login_id', 'left')
                        ->join('('.$s2.') cross_matched_staff','blood_issue.cross_matched_by=cross_matched_staff.staff_login_id', 'left') 
                        ->where('u.ut_open',"1")
                        ->where('t.btype_open',"1") 
                        ->where('l.login_open',"1")
                        ->where('blood_inventory.bistatus_id',8); 
                if(array_key_exists("searbloodbank_id",$params)){
                    if($params["searbloodbank_id"] != "" && $params["searbloodbank_id"] != "All"){ 
                        $this->db->where("bb_donation.hospital_id",$params["searbloodbank_id"]);
                    }else if($params["searbloodbank_id"] == "All"){
                        $this->version2_model->get_assignbanks($vspa);
                    }
                } else {
                    if($this->session->userdata("login_bloodbank_id") != ''){
                        $this->db->where("bb_donation.hospital_id",$this->session->userdata("login_bloodbank_id"));
                    }
                }
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%' OR donation_details.donor_id LIKE '%".$params['keywords']."%' OR donation_details.name LIKE '%".$params['keywords']."%' OR donation_details.blood_group LIKE '%".$params['keywords']."%' OR issued_staff_name LIKE '%".$params['keywords']."%' OR cross_matched_staff_name LIKE '%".$params['keywords']."%' OR concat(blood_request.patient_first_name,' ',blood_request.patient_last_name)  LIKE '%".$params['keywords']."%' OR blood_inventory.component_type LIKE '%".$params['keywords']."%' OR brblood_group LIKE '%".$params['keywords']."%' OR bb_donation.blood_unit_num LIKE '%".$params['keywords']."%' OR bb_donation.blood_unit_num LIKE '%".$params['keywords']."%' OR bb_donation.segment_num LIKE '%".$params['keywords']."%' OR blood_inventory.bivolume LIKE '%".$params['keywords']."%' OR issue_date LIKE '%".$params['keywords']."%' OR issue_time LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(bbdonation_date >= '".$asate['0']."' AND bbdonation_date <= '".$asate['1']."')");
                    }
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
		$this->db->order_by('issue_date DESC,issue_time DESC');
                return $this->db->get();                        
        }  
        public function cntdetail_report($params = array()){
                $params["cnt"]  =   '1';
                $vsp    =  $this->detail_reportquery($params)->row(); 
                if(count($vsp)  >0 ){
                    return  $vsp->cnt;
                }
                return 0;
        }
        public function detail_report($params = array()){
            return  $this->detail_reportquery($params)->result();
        }
        public function cntclosed_report($params = array()){
                $params["cnt"]  =   '1';
                $vsp    =  $this->blood_issue_query($params)->result(); 
                if(count($vsp)  >0 ){
                    $i  =   0;
                    foreach($vsp as $h){
                        $i  =   $i+1;
                    }
                    return  $i;
                }
                return 0;
        }
        public function closed_report($params = array()){
            return  $this->blood_issue_query($params)->result();
        }
        public function blood_issue_query($params = array()){
                if($this->session->userdata("login_parent") == '1'){
                        $sel    =   "count(r.brbloodbank_id) as cnt,b.bloodbank_name";
                }
                else {
                    $sel    =   "*";                
                }
                if(array_key_exists("cnt",$params)){
                    $sel    =   "count(*) as cnt";
                }
                $this->db->select("$sel")
                                ->from("blood_request as r")
                                ->join("bloodbanks as b","b.bloodbank_id = r.brbloodbank_id","INNER")
                                ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER") 
                                ->where('u.ut_open',"1")
                                ->where('t.btype_open',"1") 
                                ->where('l.login_open',"1")
                                ->where("r.request_status","Closed");
                if($this->session->userdata("login_bloodbank_id") != ''){
                        $this->db->where("r.brbloodbank_id",$this->session->userdata("login_bloodbank_id"));
                }  
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(r.request_remarks LIKE '%".$params['keywords']."%' OR b.bloodbank_name LIKE '%".$params['keywords']."%' OR r.patient_first_name LIKE '%".$params['keywords']."%' OR r.patient_last_name LIKE '%".$params['keywords']."%' OR r.patient_last_name LIKE '%".$params['keywords']."%' OR r.brblood_group LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                if($this->session->userdata("login_parent") == '1'){
                        $this->db->group_by("r.brbloodbank_id");
                }
                return  $this->db->get();
        }
}