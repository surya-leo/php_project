<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Blood_availability_model extends CI_Model{
        public function blood_avquery($params = array()){
                $comp   =   "WB";
                if(array_key_exists("component",$params)){
                    if($params["component"] != ""){
                            $comp   =   $params["component"];
                    }
                }
                $vspa    =   $this->blood_bank_model->get_bloodquery()->where("l.login_id",$this->session->userdata("login_id"))->get()->row();
                if($this->session->userdata("login_type") == '3utype'){
                        $this->version2_model->get_bloodbanks();
                }
                $this->db->select(" 
                        bloodbanks.bloodbank_name,trim(bloodbanks.district) as district,trim(bloodbanks.city) as city,bloodbanks.category,
                        SUM(CASE WHEN blood_group='A+ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Apos',
                        SUM(CASE WHEN blood_group='A-ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Aneg',
                        SUM(CASE WHEN blood_group='B+ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Bpos',
                        SUM(CASE WHEN blood_group='B-ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Bneg',
                        SUM(CASE WHEN blood_group='AB+ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'ABpos',
                        SUM(CASE WHEN blood_group='AB-ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'ABneg',
                        SUM(CASE WHEN blood_group='O+ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Opos', 
                        SUM(CASE WHEN blood_group='O-ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Oneg', 
                        SUM(CASE WHEN blood_group='Rh+ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Rhpos', 
                        SUM(CASE WHEN blood_group='Rh-ve' AND component_type='".$comp."' THEN 1 ELSE 0 END) 'Rhneg', 
                            "
                    )
                    ->from('donation_details')
//                    ->join('bb_donation','donation_details.donor_id=bb_donation.bbdonor_id')
                    ->join('bb_donation','donation_details.donation_id=bb_donation.bb_donation_details_id')
                    ->join('blood_inventory','bb_donation.bbdonation_id=blood_inventory.bidonation_id') 
                    ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                    ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                    ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                    ->where('u.ut_open',"1")
                    ->where('t.btype_open',"1")
                    ->where('l.login_open',"1") 
                    ->where('bb_donation.status_id',"6")
                    ->where('bb_donation.screening_result',"1")
                    ->where('blood_inventory.bistatus_id',"7") 
                    ->where('expiry_date>=',date("Y-m-d"),false);
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
                $this->db->where("(bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%')");
            } 
            if(array_key_exists("city",$params)){
                if($params["city"] != ""){
                        $this->db->where("(bloodbanks.city LIKE '".trim($params['city'])."')");
                }
            }
            if(array_key_exists("district",$params)){
                if($params["district"] != ""){
                        $this->db->where("(bloodbanks.district LIKE '".trim($params['district'])."')");
                }
            } 
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
            }
            $this->db->group_by('bb_donation.hospital_id');
            return  $this->db->get();
        }
        public function cntblood_available($params = array()){
                $this->blood_avquery($params);
                $subQuery =  "(".$this->db->last_query().") as d";
                $this->db->select("count(*) as cnt");
                $this->db->from($subQuery); 
                $vsp    =   $this->db->get()->row();
                return  $vsp->cnt;
        }
        public function blood_available($params = array()){
                return  $this->blood_avquery($params)->result();
        }
        public function blood_groupingquery($params = array()){ 
                $this->staff_model->get_querycols("sst1.staff_login_id as forward_staff_id,CONCAT(sst1.first_name,' ',sst1.last_name ) AS forward_staff_name","st1")->get();
                $s1     =   $this->db->last_query();
                $this->staff_model->get_querycols("sst2.staff_login_id as reverse_done_id,CONCAT(sst2.first_name,' ',sst2.last_name ) AS reverse_staff_name","st2")->get(); 
                $s2     =   $this->db->last_query(); 
				
				$sle    =   "*"; 
                if(array_key_exists("cnt",$params)){
                        $sle    =   "count(*) as cnt";
                }  
				if($this->session->userdata("login_type") == '3utype'){
                        $this->version2_model->get_bloodbanks();
                }
                $this->db->select("$sle")
                        ->from("bb_donation")
                        ->join("blood_grouping","bb_donation.bbdonation_id=blood_grouping.bgdonation_id","INNER")
//                        ->join("donation_details","bb_donation.bbdonor_id=donation_details.donor_id","INNER") 
                        ->join('donation_details','donation_details.donation_id=bb_donation.bb_donation_details_id')
                        ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                        ->join("($s1) as s1","s1.forward_staff_id = blood_grouping.forward_done_by","INNER") 
                        ->join("($s2) as s2","s2.reverse_done_id = blood_grouping.reverse_done_by","INNER") 
                        ->where('l.login_open',"1")
//                        ->where("u.ut_open","1")
//                        ->where("t.btype_open",'1')
                        ->order_by("grouping_date",'DESC');
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(grouping_date >= '".$asate['0']."' AND grouping_date <= '".$asate['1']."')");
                    }
                }
                
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
//                $this->db->get();echo $this->db->last_query();exit;
                return  $this->db->get(); 
        }
        public function cntblood_grouping($params = array()){
                $params["cnt"]  =   '1';
                $vsp    =  $this->blood_groupingquery($params)->row(); 
                if(count($vsp)  >0 ){
                    return  $vsp->cnt;
                }
                return 0;
        } 
        public function blood_grouping($params = array()){
                return  $this->blood_groupingquery($params)->result();
        }
        public function blood_screeningquery($params = array()){
                $this->staff_model->get_querycols("sst1.staff_login_id as staff_login_id,CONCAT(sst1.first_name,' ',sst1.last_name ) AS scre_staff_name","st1")->get();
                $s1     =   $this->db->last_query();
                $vspa    =   $this->blood_bank_model->get_bloodquery()->where("l.login_id",$this->session->userdata("login_id"))->get()->row();
                if($this->session->userdata("login_type") == '3utype'){
                        $this->version2_model->get_bloodbanks();
                }
                $select     =   "*,
                               (CASE WHEN test_hiv = 1 THEN 'YES' ELSE 'NO' END) 'test_hiv',
                               (CASE WHEN test_hbsag = 1 THEN 'YES' ELSE 'NO' END) 'test_hbsag',
                               (CASE WHEN test_hcv = 1 THEN 'YES' ELSE 'NO' END) 'test_hcv',
                               (CASE WHEN test_vdrl = 1 THEN 'YES' ELSE 'NO' END) 'test_vdrl',
                               (CASE WHEN test_mp = 1 THEN 'YES' ELSE 'NO' END) 'test_mp',
                               (CASE WHEN test_irregular_ab = 1 THEN 'YES' ELSE 'NO' END) 'test_irregular_ab'";
                if(array_key_exists("cnt",$params)){
                        $select     =   'count(*) as cnt';
                } 
                $this->db->select("$select")
                        ->from('bb_donation')
                        ->join('blood_screening','bb_donation.bbdonation_id=blood_screening.scdonation_id') 
//                        ->join('donation_details','bb_donation.bbdonor_id=donation_details.donor_id') 
                        ->join('donation_details','donation_details.donation_id=bb_donation.bb_donation_details_id')
                        ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                        ->join("($s1) as  s1",'blood_screening.screened_by=s1.staff_login_id',"INNER")
                        ->where("status_id","6")
                        ->where('u.ut_open',"1") 
                        ->where('l.login_open',"1") 
                        ->where('t.btype_open','1'); 
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(donation_details.name LIKE '%".$params['keywords']."%' OR donation_details.blood_group LIKE '%".$params['keywords']."%' OR bb_donation.blood_unit_num LIKE '%".$params['keywords']."%' OR bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%' OR screening_datetime LIKE '%".$params['keywords']."%' OR scre_staff_name LIKE '%".$params['keywords']."%' OR test_hiv LIKE '%".$params['keywords']."%' OR test_hbsag LIKE '%".$params['keywords']."%' OR test_hcv LIKE '%".$params['keywords']."%' OR test_vdrl LIKE '%".$params['keywords']."%' OR test_mp LIKE '%".$params['keywords']."%' OR test_irregular_ab LIKE '%".$params['keywords']."%')"); 
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(screening_datetime >= '".$asate['0']."' AND screening_datetime <= '".$asate['1']."')");
                    }
                }
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
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
//                $this->db->get();echo $this->db->last_query();exit;
                return  $this->db->order_by('screening_datetime','desc')->get();
        }
        public function cntblood_screening($params = array()){
                $params["cnt"]  =   '1';
                $vsp    =  $this->blood_screeningquery($params)->row(); 
                if(count($vsp)  >0 ){
                    return  $vsp->cnt;
                }
                return 0;
        }
        public function blood_screening($params = array()){
                return  $this->blood_screeningquery($params)->result();
        }
        public function blood_componentquery($params = array()){
                    $vspa    =   $this->blood_bank_model->get_bloodquery()->where("l.login_id",$this->session->userdata("login_id"))->get()->row();
					
                    $select     =   " blood_unit_num,donation_details.donor_id,name,blood_group,donation_date,bb_status.status,expiry_date,component_type,blood_inventory.datetime components_date,blood_issue.issue_id,issue_date,bbvolume,segment_num,DATE(screening_datetime) screening_datetime,bloodbanks.bloodbank_name,
                        (CASE WHEN bb_donation.status_id=6 THEN test_hiv ELSE NULL END) test_hiv,
                        (CASE WHEN bb_donation.status_id=6 THEN test_hbsag ELSE NULL END) test_hbsag,
                        (CASE WHEN bb_donation.status_id=6 THEN test_vdrl ELSE NULL END) test_vdrl,
                        (CASE WHEN bb_donation.status_id=6 THEN test_hcv ELSE NULL END) test_hcv,
                        (CASE WHEN bb_donation.status_id=6 THEN test_mp ELSE NULL END) test_mp,
                        (CASE WHEN bb_donation.status_id=6 THEN test_irregular_ab ELSE NULL END) test_irregular_ab";
                    if($this->session->userdata("login_type") == '3utype'){
                            $this->version2_model->get_bloodbanks();
                    }
                    if(array_key_exists("cnt",$params)){
                            $select     =   'count(*) as cnt';
                    }
                    $this->db->select("$select")
                            ->from('donation_details')
//                            ->join('bb_donation','donation_details.donor_id=bb_donation.bbdonor_id','INNER')
                            ->join('bb_donation','donation_details.donation_id=bb_donation.bb_donation_details_id')
                            ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                            ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                            ->join("usertype as u","u.ut_id = l.login_type","INNER")
                            ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                            ->join('camps','bb_donation.camp_id=camps.camp_id','left')
                            ->join('blood_inventory','bb_donation.bbdonation_id=blood_inventory.bidonation_id','left')
                            ->join('blood_screening','bb_donation.bbdonation_id=blood_screening.scdonation_id','left')
                            ->join('bb_issued_inventory','blood_inventory.inventory_id=bb_issued_inventory.inventory_id','left')
                            ->join('blood_issue','bb_issued_inventory.issue_id=blood_issue.issue_id','left')
                            ->join('bb_status','blood_inventory.bistatus_id=bb_status.status_id','left')
                            ->where('u.ut_open',"1") 
                            ->where('l.login_open',"1") 
                            ->where('t.btype_open','1'); 
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
                        $this->db->where("(donation_details.name LIKE '%".$params['keywords']."%' OR donation_details.blood_group LIKE '%".$params['keywords']."%' OR bb_donation.blood_unit_num LIKE '%".$params['keywords']."%' OR screening_datetime LIKE '%".$params['keywords']."%' OR bb_donation.bbdonation_date LIKE '%".$params['keywords']."%' OR expiry_date LIKE '%".$params['keywords']."%' OR bb_status.status LIKE '%".$params['keywords']."%' OR segment_num LIKE '%".$params['keywords']."%' OR bbvolume LIKE '%".$params['keywords']."%' OR issue_date LIKE '%".$params['keywords']."%')"); 
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(donation_date >= '".$asate['0']."' AND donation_date <= '".$asate['1']."')");
                    }
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                $this->db->group_by('blood_inventory.inventory_id')
                        ->order_by('donation_date asc,blood_unit_num ASC');
                return  $this->db->get();
        } 
        public function cntblood_components($params = array()){
                $params["cnt"]  =   '1';
                $vsp        =   $this->blood_componentquery($params)->row();
                if(count($vsp) > 0){
                    return  $vsp->cnt;
                }
                return "0";
        }
        public function blood_components($params = array()){
                return  $this->blood_componentquery($params)->result();
        }
        public function blood_discardquery($params = array()){
                $vspa    =   $this->blood_bank_model->get_bloodquery()->where("l.login_id",$this->session->userdata("login_id"))->get()->row();
		if($this->session->userdata("login_type") == '3utype'){
                        $this->version2_model->get_bloodbanks();
                }
                $this->db->select("bloodbank_name,trim(bloodbanks.district) as district,blood_unit_num,blood_inventory.component_type,donation_details.blood_group,expiry_date,notes,blood_inventory.inventory_id,bb_donation.bbdonation_id,bb_donation.status_id as donation_status,d_status.status as don_status,i_status.status as inv_status")
                        ->from("blood_inventory")
                        ->join("bb_donation","blood_inventory.bidonation_id=bb_donation.bbdonation_id","INNER")
                        ->join("bloodbanks","bloodbanks.bloodbank_id = bb_donation.hospital_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
//                        ->join("donation_details","bb_donation.bbdonor_id=donation_details.donor_id","INNER")
                        ->join('donation_details','donation_details.donation_id=bb_donation.bb_donation_details_id')
                        ->join("bb_status as  d_status","bb_donation.status_id=d_status.status_id","INNER")
                        ->join("bb_status as i_status","blood_inventory.bistatus_id = i_status.status_id","INNER")
                        ->where("blood_inventory.bistatus_id !=",10)
                        ->where('u.ut_open',"1") 
                        ->where('l.login_open',"1") 
                        ->where('t.btype_open','1'); 
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
                        $this->db->where("(bloodbanks.district LIKE '%".$params['keywords']."%' OR blood_unit_num LIKE '%".$params['keywords']."%' OR blood_group LIKE '%".$params['keywords']."%' OR expiry_date LIKE '%".$params['keywords']."%' OR component_type LIKE '%".$params['keywords']."%')"); 
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(expiry_date >= '".$asate['0']."' AND expiry_date <= '".$asate['1']."')");
                    }
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                $this->db->order_by("expiry_date","ASC");
//                $this->db->order_by('component_type,blood_inventory.expiry_date');
                return  $this->db->get();
        } 
        public function cntblood_discarded($params = array()){
                $this->blood_discardquery($params);
                $subQuery =  "(".$this->db->last_query().") as d";
                $this->db->select("count(*) as cnt",FALSE);
                $this->db->from($subQuery); 
                $vsp    =   $this->db->get()->row();
                return  $vsp->cnt;
        }
        public function blood_discarded($params = array()){
                return  $this->blood_discardquery($params)->result();
        }
}