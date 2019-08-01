<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Version2_model extends CI_Model{
        public function bloodbank_type(){
                $this->db->order_by("btype_name","ASC");
                return  $this->db->get_where("bloodbank_type",array("btype_open" => '1'))->result();
        }
        public function check_type($uri){ 
                $csp    =   $this->db->get_where("usertype",array("ut_open" => '1','ut_name' => $uri))->row(); 
                return  $csp->ut_id;
        }  
        public function app_query($params = array()){
                $dt     =   array(
                                "u.ut_open"     =>  "1",
                                "t.btype_open"  =>  "1"
                            );
                
                if(array_key_exists("cnt",$params)){
                        $sel    =   "count(*) as cnt";
                }else{
                        $sel    =   "*";
                }
                $this->db->select("$sel")
                                ->from("appointments as a") 
                                ->join("donor_registration_app as d","d.phone = a.app_mobile","INNER") 
                                ->join("bloodbanks as b","b.bloodbank_id = a.bloodbank_id","INNER")
                                ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                ->where('l.login_open',"1")
                                ->where($dt);
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR a.app_mobile LIKE '%".$params['keywords']."%' OR  a.date_slot LIKE '%".$params['keywords']."%' OR a.time_slot LIKE '%".$params['keywords']."%' OR a.app_status LIKE '%".$params['keywords']."%' OR d.blood_group LIKE '%".$params['keywords']."%' OR d.name LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                } 
                return $this->db->get();
        }
        public function cntview_appoint($params    =   array()){
                $params["cnt"]  =   '1';
                $vsp    =  $this->app_query($params)->row(); 
                if(count($vsp)  >0 ){
                    return  $vsp->cnt;
                }
                return 0;
        }
        public function appointments($params    =   array()){
                return      $this->app_query($params)->result();
        }
        public function not_satisfied_query($params = array()){ 
                $dt     =   array(
                        "a.ns_open"   =>  "1"
                );
                if(array_key_exists("cnt",$params)){
                        $sel    =   "count(*) as cnt";
                }else{
                        $sel    =   "*";
                }
                $this->db->select("$sel")
                                ->from("blood_not_satisifed as a") 
                                ->join("donor_registration_app as d","d.phone = a.ns_mobile","INNER") 
                                ->where($dt);
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(a.ns_mobile LIKE '%".$params['keywords']."%' OR  a.ns_date LIKE '%".$params['keywords']."%' OR d.age LIKE '%".$params['keywords']."%' OR d.blood_group LIKE '%".$params['keywords']."%' OR d.name LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                } 
                return $this->db->get();
        }
        public function cntview_not_satisfied($params    =   array()){
                $params["cnt"]  =   '1';
                $vsp    =  $this->not_satisfied_query($params)->row(); 
                if(count($vsp)  >0 ){
                    return  $vsp->cnt;
                }
                return 0;
        }
        public function view_not_satisfied($params    =   array()){
                return      $this->not_satisfied_query($params)->result();
        }
        public function blood_avquery($params    =   array()){ 
                $comp   =   $this->input->post("component")?$this->input->post("component"):"WB"; 
                $lat    =   $this->input->post("latitude")?$this->input->post("latitude"):"16";
                $lon    =   $this->input->post("longitude")?$this->input->post("longitude"):"84";
                $district   =   $this->input->post("district")?$this->input->post("district"):"";
                $city       =   $this->input->post("city")?$this->input->post("city"):"";
                $this->db->select(" 
                            bloodbanks.bloodbank_id,bloodbanks.bloodbank_name,t.btype_name,t.btype_id,trim(bloodbanks.district) as district,trim(bloodbanks.city) as city,bloodbanks.bbmobile as mobile,bloodbanks.email_id,bloodbanks.category,bloodbanks.lattitude,bloodbanks.longitude,bloodbanks.address,round((((acos(sin(($lat*pi()/180))*sin((lattitude*pi()/180))+cos(($lat*pi()/180))*cos((lattitude*pi()/180))*cos((($lon-longitude)*pi()/180))))*180/pi())*60*1.1515*1.609344)) as distance,"
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_a_pos ELSE 0 END) as Apos,"
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_a_neg ELSE 0 END) as Aneg,"
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_b_pos ELSE 0 END) as Bpos,"
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_b_neg ELSE 0 END) as Bneg," 
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_ab_pos ELSE 0 END) as ABpos,"
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_ab_neg ELSE 0 END) as ABneg," 
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_o_pos ELSE 0 END) as Opos,"
                        . "(CASE WHEN  blood_components.bc_abbr ='".$comp."' THEN out_o_neg ELSE 0 END) as Oneg,"   
                        ,FALSE)
                        ->from('out_blood_availability')
                        ->join("blood_components","out_blood_availability.out_component = blood_components.bc_id","INNER")
                        ->join("bloodbanks","bloodbanks.bloodbank_id = out_blood_availability.out_bloodbank_id","INNER")
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                        ->where('u.ut_open',"1")
                        ->where('l.login_open',"1")
                        ->where('t.btype_open',"1");
                if($this->input->post("latitude") && $this->input->post("longitude")){
                        $this->db->having("distance <= ",$this->config->item('distance'));
                }
                if($district != ""){
                        $this->db->where('trim(bloodbanks.district)',$district);
                }
                if($city != ""){
                        $this->db->where('trim(bloodbanks.city)',$city);
                }
                if($this->input->post("page") != ''){
                        $this->db->limit($this->config->item('page_limit'),$this->config->item('page_limit')*$this->input->post("page"));
                }
                if(array_key_exists("out_status",$params)){
                        $this->db->where("out_status",$params['out_status']);
                }
                $this->db->order_by("distance","ASC");
                //$this->db->get();echo $this->db->last_query();exit;
                $vsop   =  $this->db->group_by('out_blood_availability.out_bloodbank_id')->get()->result();
                return $vsop;
        }
        public function out_avail(){
                $dt     =   array(
                        "u.ut_open"                 =>  "1",    
                        "t.btype_open"              =>  "1",
                        "out_blood_availability.out_status"    =>  "1",
                        "bloodbanks.blood_login_id" =>  $this->session->userdata("login_id")
                );
                $vspp   =   $this->db->select("blood_components.*,out_blood_availability.*")
                            ->from("out_blood_availability")
                            ->join("blood_components","out_blood_availability.out_component = blood_components.bc_id","INNER")
                            ->join("bloodbanks","bloodbanks.bloodbank_id = out_blood_availability.out_bloodbank_id","INNER")
                            ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                            ->join("usertype as u","u.ut_id = l.login_type","INNER")
                            ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER")
                            ->where('l.login_open',"1")
                            ->where($dt)
                            ->get()->result(); 
                //print_r($this->db->last_query());    
                //print_r($vspp);    

                return  $vspp; 
        }
        public function blood_comp(){
                return      $this->db->get_where("blood_components",array("bc_open" => "1"))->result();
        }
        public function  get_bloodgrop($uri){
        	$vsl =  $this->db->get_where("blood_groups",array("blood_group_id" => $uri))->row();
        	return $vsl->blood_group_name;
        }
        public function update_availabilty(){
                $out_avail  =   $this->out_avail();  
				$gt 		=	$this->input->post("donation_date")?$this->input->post("donation_date"):date("Y-m-d");
                $cur        =   $fed    =   date("Y-m-d");
                $spdate     =   $edf    =   date("Y-m-d",strtotime($gt));
                $sps    =   '0';
                $spf    =   '1';  
                if(strtotime($spdate) < strtotime($cur)){
                        $sps    =   '1';
                        $spf    =   '0'; 
                        $fed    =   $spdate;
                        $edf    =   $cur;
                        foreach($out_avail as $tg){
                                $dt     =   array(
                                                        "out_status"        =>  $sps,
                                                        "out_updated_by"    =>  $this->session->userdata("login_id") 
                                                    ); 
                                $fe     =   array("out_component" => $tg->bc_id,"out_bloodbank_id"  =>  $tg->out_bloodbank_id,"out_status" => '1');
                                $this->db->update("out_blood_availability",$dt,$fe);  
                                $dta    =   array(
                                                "out_bloodbank_id"  =>  $tg->out_bloodbank_id,
                                                "out_component"     =>  $tg->bc_id,
                                                "out_a_pos"     =>  $this->input->post("out_a_pos")[$tg->bc_id],
                                                "out_a_neg"     =>  $this->input->post("out_a_neg")[$tg->bc_id],
                                                "out_b_pos"     =>  $this->input->post("out_b_pos")[$tg->bc_id],
                                                "out_b_neg"     =>  $this->input->post("out_b_neg")[$tg->bc_id],
                                                "out_ab_pos"    =>  $this->input->post("out_ab_pos")[$tg->bc_id],
                                                "out_ab_neg"    =>  $this->input->post("out_ab_neg")[$tg->bc_id], 
                                                "out_o_pos"     =>  $this->input->post("out_o_pos")[$tg->bc_id],
                                                "out_o_neg"     =>  $this->input->post("out_o_neg")[$tg->bc_id],
                                                "out_updated_by"    =>  $this->session->userdata("login_id"),
                                                "out_updated_on"    =>  $fed." ".date("h:i:s"),
                                                "out_status"        =>  $spf,
                                            );  
                                $this->db->insert("out_blood_availability",$dta);  
                        }
                return TRUE;
                }else{
                        foreach($out_avail as $tg){ 
                                $dt     =   array(
                                                        "out_status"        =>  0,
                                                        "out_updated_by"    =>  $this->session->userdata("login_id") 
                                                    ); 
                                $fe     =   array("out_component" => $tg->bc_id,"out_bloodbank_id"  =>  $tg->out_bloodbank_id);
                                $this->db->update("out_blood_availability",$dt,$fe);  
                                $dta    =   array(
                                                "out_bloodbank_id"  =>  $tg->out_bloodbank_id,
                                                "out_component"     =>  $tg->bc_id,
                                                "out_a_pos"     =>  $this->input->post("out_a_pos")[$tg->bc_id],
                                                "out_a_neg"     =>  $this->input->post("out_a_neg")[$tg->bc_id],
                                                "out_b_pos"     =>  $this->input->post("out_b_pos")[$tg->bc_id],
                                                "out_b_neg"     =>  $this->input->post("out_b_neg")[$tg->bc_id],
                                                "out_ab_pos"    =>  $this->input->post("out_ab_pos")[$tg->bc_id],
                                                "out_ab_neg"    =>  $this->input->post("out_ab_neg")[$tg->bc_id], 
                                                "out_o_pos"     =>  $this->input->post("out_o_pos")[$tg->bc_id],
                                                "out_o_neg"     =>  $this->input->post("out_o_neg")[$tg->bc_id],
                                                "out_updated_by"    =>  $this->session->userdata("login_id"),
                                                "out_updated_on"    =>  $fed." ".date("h:i:s"),
                                                "out_status"        =>  1,
                                            );  
                                $this->db->insert("out_blood_availability",$dta);  
                        }
                return TRUE;
                } 
        }
        public function blood_not_satisifed(){ 
                $dt     =   array(
                                "ns_date"        =>  date("Y-m-d"),
                                "ns_message"     =>  "Blood request has been not met the need",
                                "ns_mobile"      =>  $this->input->post("phone")
                            );
                $this->db->insert("blood_not_satisifed",$dt);   
                if($this->db->insert_id() > 0){
                    return TRUE;
                }
                return FALSE;
        }
        public function get_assignbanks($vspa){
                if($this->session->userdata("login_type") != '5utype'){
                        if(count($vspa) > 0){
                            $gb    =    "";
                            $coun  =    array_filter(explode(",",$vspa->assign_bloodbanks));
                            if(count($coun) > 0){
                                foreach ($coun as $bt){
                                        $gb     .=  "bloodbank_id = ".$bt." or ";
                                }
                                if($gb != ""){
                                    $gb     =   substr($gb,0,-3); 
                                    $this->db->where("($gb)");
                                }
                            }
                        }
                }
        }
        public function blood_transfer_collection(){
                $screen     =   $this->input->post("screen");
                if($screen == '2'){
                    $trbdr      =   $this->input->post("transfer_donors");
                    $tc_donation_status  =   "0";
                }else{
                    $trbdr      =   $this->input->post("transfer_bags");
                    $tc_donation_status  =   "1";
                }
                $val    =   $this->blood_bank_model->edit_blood($this->session->userdata("login_id"));
                if(count($trbdr) > 0 && count($val) > 0){
                        foreach ($trbdr as $tg){
                                $bvth   =   $this->transfer_model->getdonation($tg);
                                if(count($bvth) > 0){ 
                                        $this->db->update("transfer_collection",array("tc_acde" => '0'),array("tid" => $bvth->tid));
                                }
                                $dt     =   array(
                                                    "tc_from_bank"          =>      $val->bloodbank_id,
                                                    "tc_from_type"          =>      $val->blood_bank_type,
                                                    "tc_to_bank"            =>      $this->input->post("transfer_bloodbank"),
                                                    "tc_to_type"            =>      $this->input->post("blood_bank_type"),
                                                    "tc_donation_id"        =>      $tg,
                                                    "tc_donation_status"    =>      $tc_donation_status,
                                                    "tc_date"               =>      date("Y-m-d"),
                                                    "tc_screen"             =>      $screen
                                            );
                                $this->db->insert("transfer_collection",$dt);
                                $this->db->update("donation_details",array("donation_status" => "7","dbbloodbank_id" => $this->input->post("transfer_bloodbank"),"dc_screen" => $screen),array("donation_id" => $tg));
                        }
                        return TRUE;
                }
                return FALSE;
        }
        public function submitNotsatisfied(){
                $this->db->update("blood_not_satisifed",array('ns_remarks' => $this->input->post('text_data'),'ns_acde' => '0'),array('ns_id' => $this->input->post('viattr')));
                return TRUE;
        }
        public function blood_oavquery($params = array()){
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
                $sel     =  "out_updated_on,bloodbanks.bbmobile,bloodbanks.email_id,bloodbanks.bloodbank_name,bloodbanks.contact_no,bloodbanks.category,trim(bloodbanks.district) as district,trim(bloodbanks.city) as city,blood_components.bc_name,out_a_pos as 'Apos',out_a_neg as 'Aneg',out_b_pos as 'Bpos',out_b_neg as 'Bneg',out_ab_pos as 'ABpos',out_ab_neg as 'ABneg',out_o_pos as 'Opos',out_o_neg as 'Oneg'";
                if(array_key_exists("columns",$params)){
                        $sel    =   $params['columns'];
                }
                $this->db->select("$sel")
                    ->from('out_blood_availability')  
                    ->join("blood_components","out_blood_availability.out_component = blood_components.bc_id","INNER")
                    ->join("bloodbanks","bloodbanks.bloodbank_id = out_blood_availability.out_bloodbank_id","INNER") 
                    ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                    ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                    ->where('u.ut_open',"1")
                    ->where('t.btype_open',"1")  
                    ->where('l.login_open',"1")
                    ->where('blood_components.bc_open',"1"); 
            if(!array_key_exists("notcp",$params)){
                    $this->db->where('blood_components.bc_abbr',"$comp");
            }
            if(array_key_exists("blood_category",$params)){
                    $this->db->where("category LIKE '%".$params['blood_category']."%'");
            } 
            if(array_key_exists("searbloodbank_id",$params)){
                if($params["searbloodbank_id"] != "" && $params["searbloodbank_id"] != "All"){ 
                    $this->db->where("out_blood_availability.out_bloodbank_id",$params["searbloodbank_id"]);
                }else if($params["searbloodbank_id"] == "All"){
                    $this->version2_model->get_assignbanks($vspa);
                }
            } else {
                if($this->session->userdata("login_bloodbank_id") != ''){
                    $this->db->where("out_blood_availability.out_bloodbank_id",$this->session->userdata("login_bloodbank_id"));
                }
            }
            if(array_key_exists("blood_bank_type",$params)){ 
                    $this->db->where("t.btype_name", $params["blood_bank_type"]);  
            }
            if(array_key_exists("keywords",$params)){
                $this->db->where("(bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%')");
            } 
            if(array_key_exists("city",$params)){
                if($params["city"] != ""){
                        $this->db->where("(bloodbanks.city LIKE '".trim($params['city'])."')");
                }
            }
            if(array_key_exists("out_status",$params)){
                    $this->db->where("out_status",$params['out_status']);
            }
            if(array_key_exists("district",$params)){
                if($params["district"] != ""){
                        $this->db->where("(trim(bloodbanks.district) LIKE '".trim($params['district'])."')");
                }
            } 
            if(array_key_exists("zero_units",$params)){
                    $this->db->where("(out_a_neg = 0 AND out_a_pos = 0 AND out_b_neg = 0 AND out_b_pos = 0  AND out_o_neg = 0 AND out_o_pos = 0 AND out_ab_neg = 0 AND out_ab_pos = 0)");
            }
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
            } 
            if(array_key_exists("group_by",$params)){
                    $this->db->group_by("out_component");
            }
            if(array_key_exists("groupby",$params)){
                    $this->db->group_by($params['groupby']);
            }
            
            if(array_key_exists("intervalue",$params)){
                    $this->db->where("out_updated_on >= now() - INTERVAL ".$params["intervalue"]." DAY");
            }
            if(array_key_exists("notintervalue",$params)){
                    $this->db->where("out_updated_on <= now() - INTERVAL ".$params["notintervalue"]." DAY");
            } 
             if(array_key_exists("asate",$params)){
                if($params["asate"] != ""){
                    $asate    =   explode(" - ",$params["asate"]);
                    $this->db->where("(out_updated_on >= '".$asate['0']." 00:00:00' AND out_updated_on <= '".$asate['1']." 23:59:59')");
                }
            } 
            if(array_key_exists("order_by",$params)){
                    $this->db->order_by($params['order_by'],"ASC");
            }
           //$this->db->get();echo $this->db->last_query();exit;
            return  $this->db->get();
        }
        public function cntoblood_available($params = array()){
                $this->blood_oavquery($params);
                $subQuery =  "(".$this->db->last_query().") as d";
                $this->db->select("count(*) as cnt");
                $this->db->from($subQuery); 
                $vsp    =   $this->db->get()->row();
                return  $vsp->cnt;
        }
        public function oblood_available($params = array()){
            //  $this->blood_oavquery($params);echo $this->db->last_query();exit;
                return  $this->blood_oavquery($params)->result();
        }  
        public function osfblood_available($params = array()){
                $params['out_status']   =   '1';
                $params["columns"]  =   "SUM(out_a_pos) as 'Apos',SUM(out_a_neg) as 'Aneg',SUM(out_b_pos) as 'Bpos',SUM(out_b_neg) as 'Bneg',SUM(out_ab_pos) as 'ABpos',SUM(out_ab_neg) as 'ABneg',SUM(out_o_pos) as 'Opos',SUM(out_o_neg) as 'Oneg'";
                return  $this->blood_oavquery($params)->row();
        }   
        public function blood_available($params = array()){
                $params['out_status']   =   '1';
                $params['groupby']   = $params['order_by']   =   'district';
                $params["columns"]  =   "SUM(out_a_pos)+SUM(out_a_neg)+SUM(out_b_pos)+SUM(out_b_neg)+SUM(out_ab_pos)+SUM(out_ab_neg)+SUM(out_o_pos)+SUM(out_o_neg) as 'districtval',trim(bloodbanks.district) as district";
                return  $this->blood_oavquery($params)->result();
        }   
         public function blood_collection($params = array()){  
                $params['groupby']   = $params['order_by'] =  'district';
                $params["columns"]  =   "SUM(outb_a_pos)+SUM(outb_a_neg)+SUM(outb_b_pos)+SUM(outb_b_neg)+SUM(outb_ab_pos)+SUM(outb_ab_neg)+SUM(outb_o_pos)+SUM(outb_o_neg) as 'districtval',trim(bloodbanks.district) as district";
                return  $this->blood_oclquery($params)->result();
        }
        public function asblood_available($params = array()){ 
                $lv     =   $this->input->post("label");
                if(strpos($lv,"+")  !== false){
                    $str    =    "out_".strtolower(str_replace("+ve","_pos",$lv));
                }else{
                    $str    =    "out_".strtolower(str_replace("-ve","_neg",$lv));
                } 
                $params['out_status']   =   '1';
                $params["notcp"]        =   "1";
                $params["group_by"]     =   "out_component";
                $params["columns"]      =   "SUM($str) as 'apos',bc_abbr,bc_name";
                return  $this->blood_oavquery($params)->result();
        }  
        public function view_blooddonation($params = array()){  
                $dt     =   array(
                                "u.ut_open"     => "1",
                                "t.btype_open"  => "1"
                            );
                $sel    =   "*"; 
                $this->db->select("$sel")
                                ->from("donation_details  as d")
                                ->join('bb_donation','d.donation_id=bb_donation.bb_donation_details_id','INNER')
                                ->join('blood_group_serum','d.blood_group=blood_group_serum.blood_group','INNER')
                                ->join("bloodbanks as b","b.bloodbank_id = d.dbbloodbank_id","INNER") 
                                ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("transfer_collection","transfer_collection.tc_donation_id = d.donation_id","Left")
                                ->where('l.login_open',"1");    
                $this->db->where($dt); 
                if(array_key_exists("donation_status",$params)){
                        $this->db->where("d.donation_status",$params['donation_status']);
                }  
                if(array_key_exists("bloodbank_id",$params)){
                        $this->db->where("d.dbbloodbank_id",$params['bloodbank_id']);
                }     
                return  $this->db->get()->result();
        } 
        public function motherquery($params = array()){
                $dt     =   array(
                            "u.ut_open"     => "1",
                            "t.btype_open"  => "1"
                        );  
                $this->db->select("*")
                            ->from("login as l")
                            ->join("bloodbanks as b","b.blood_login_id = l.login_id","INNER") 
                            ->join("usertype as u","u.ut_id = l.login_type","INNER")
                            ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                            ->where('l.login_open',"1")
                            ->where($dt)
                            ->where("assign_bloodbanks != ''");  
                if(array_key_exists("uri",$params)){ 
                        $this->db->where("t.btype_name",$params['uri']);
                }
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR district LIKE '%".$params['keywords']."%' OR  city LIKE '%".$params['keywords']."%' OR contact_no LIKE '%".$params['keywords']."%' OR bbmobile LIKE '%".$params['keywords']."%' OR email_id LIKE '%".$params['keywords']."%' OR category LIKE '%".$params['keywords']."%')");
                }
                $cnt    =   $this->db->get()->result();
                $gt     =   $mg     =   $gtr    =   array();
                foreach($cnt as $bt){
                        $gth    = array_filter(explode(",",$bt->assign_bloodbanks));
                        if(count($gth) > 0){
                            foreach($gth as $ju){
                                $mg[]   =   $ju;
                            }
                        }
                }
                $gt     = array_values(array_unique($mg)); 
                foreach ($gt as $jul){
                        $gtr[]  =   $this->blood_bank_model->ve_blood($jul);
                }  
                return array_filter($gtr);
        }  
        public function cnt_motherquery($params){
                $params['uri'] =  'Blood Storage Centre';
                $params['cnt'] = '1';
                return  count($this->motherquery($params));
        }
        public function view_motherquery($params = array()){
                $params['uri'] =  'Blood Storage Centre';
                $vtg    =     $this->motherquery($params); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $mg     =       array_slice( $vtg, $params['start'], $params['limit'] );  
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $mg     =       array_slice( $vtg, '0', $params['limit'] );
                } 
                return $mg;
        }
        public function discard_submit(){ 
                $this->db->update("blood_inventory",array("notes" => $this->input->post('text_datap'),'bistatus_id' => "9"),array("inventory_id" => $this->input->post("viattr")));
                return TRUE; 
        }
        public function blood_screeningquery($params = array()){
                $this->staff_model->get_querycols("sst1.staff_login_id as staff_login_id,CONCAT(sst1.first_name,' ',sst1.last_name ) AS scre_staff_name","st1")->get();
                $s1     =   $this->db->last_query(); 
                $select     =   "*";
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
                if(array_key_exists("bloodgroup",$params)){
                        $this->db->where("donation_details.blood_group",$params['bloodgroup']);
                }
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate    =   explode(" - ",$params["asate"]);
                        $this->db->where("(screening_datetime >= '".$asate['0']."' AND screening_datetime <= '".$asate['1']."')");
                    }
                } 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }   
                return  $this->db->order_by('screening_datetime','desc')->get(); 
        }
        public function blood_screening($params = array()){
                return  $this->blood_screeningquery($params)->result();
        }
        public function blood_oclquery($params = array()){
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
                $sel     =  "outb_updated_on as out_updated_on,bloodbanks.bbmobile,bloodbanks.email_id,bloodbanks.bloodbank_name,bloodbanks.contact_no,bloodbanks.category,trim(bloodbanks.district) as district,trim(bloodbanks.city) as city,outb_a_pos as 'Apos',outb_a_neg as 'Aneg',outb_b_pos as 'Bpos',outb_b_neg as 'Bneg',outb_ab_pos as 'ABpos',outb_ab_neg as 'ABneg',outb_o_pos as 'Opos',outb_o_neg as 'Oneg'";
                if(array_key_exists("columns",$params)){
                        $sel    =   $params['columns'];
                }
                $this->db->select("$sel") 
                    ->from('out_blood_collection')   
                    ->join("bloodbanks","bloodbanks.bloodbank_id = out_blood_collection.outb_bloodbank_id","INNER") 
                    ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                    ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER") 
                    ->where('u.ut_open',"1")
                    ->where('t.btype_open',"1") 
                    ->where('l.login_open',"1");
            if(array_key_exists("searbloodbank_id",$params)){
                if($params["searbloodbank_id"] != "" && $params["searbloodbank_id"] != "All"){ 
                    $this->db->where("out_blood_collection.outb_bloodbank_id",$params["searbloodbank_id"]);
                }else if($params["searbloodbank_id"] == "All"){
                    $this->version2_model->get_assignbanks($vspa);
                }
            } else {
                if($this->session->userdata("login_bloodbank_id") != ''){
                    $this->db->where("out_blood_collection.outb_bloodbank_id",$this->session->userdata("login_bloodbank_id"));
                }
            }
            if(array_key_exists("blood_category",$params)){
                    $this->db->where("category LIKE '%".$params['blood_category']."%'");
            }
            if(array_key_exists("blood_bank_type",$params)){ 
                    $this->db->where("t.btype_name", $params["blood_bank_type"]);  
            }
            if(array_key_exists("keywords",$params)){
                $this->db->where("(bloodbanks.bloodbank_name LIKE '%".$params['keywords']."%')");
            } 
            if(array_key_exists("city",$params)){
                if($params["city"] != ""){
                        $this->db->where("(bloodbanks.city LIKE '".$params['city']."')");
                }
            }
            if(array_key_exists("zero_units",$params)){
                    $this->db->where("(outb_a_neg = 0 AND outb_a_pos = 0 AND outb_b_neg = 0 AND outb_b_pos = 0  AND outb_o_neg = 0 AND outb_o_pos = 0 AND outb_ab_neg = 0 AND outb_ab_pos = 0)");
            }
            if(array_key_exists("district",$params)){
                if($params["district"] != ""){
                        $this->db->where("(bloodbanks.district LIKE '".$params['district']."')");
                }
            } 
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
            } 
            if(array_key_exists("intervalue",$params)){
                    $this->db->where("outb_updated_on >= now() - INTERVAL ".$params["intervalue"]." DAY");
            }
			if(array_key_exists("notintervalue",$params)){
                    $this->db->where("outb_updated_on <= now() - INTERVAL ".$params["notintervalue"]." DAY");
            } 
        	if(array_key_exists("groupby",$params)){
                    $this->db->group_by($params["groupby"]);
            }
            if(array_key_exists("order_by",$params)){
                    $this->db->order_by($params['order_by'],"ASC");
            }
            //$this->db->get();echo $this->db->last_query();exit;
            return  $this->db->get();
        }
        public function cntoblood_collection($params = array()){
                $this->blood_oclquery($params);
                $subQuery =  "(".$this->db->last_query().") as d";
                $this->db->select("count(*) as cnt");
                $this->db->from($subQuery); 
                $vsp    =   $this->db->get()->row();
                return  $vsp->cnt;
        }
        public function oblood_collection($params = array()){
                return  $this->blood_oclquery($params)->result();
        } 
        public function out_collection($params = array()){ 
                return  $this->blood_oclquery($params)->row();
        }
        public function update_collection(){
                $dt     =   array(
                                "outb_a_pos"     =>  $this->input->post("out_a_pos"),
                                "outb_a_neg"     =>  $this->input->post("out_a_neg"),
                                "outb_b_pos"     =>  $this->input->post("out_b_pos"),
                                "outb_b_neg"     =>  $this->input->post("out_b_neg"),
                                "outb_ab_pos"    =>  $this->input->post("out_ab_pos"),
                                "outb_ab_neg"    =>  $this->input->post("out_ab_neg"),
                                "outb_o_pos"     =>  $this->input->post("out_o_pos"),
                                "outb_o_neg"     =>  $this->input->post("out_o_neg"),
                                "outb_updated_by"    =>  $this->session->userdata("login_id"),
                                "outb_updated_on"    =>  date("Y-m-d H:i:s"),
                            );
                $this->db->update("out_blood_collection",$dt,array("outb_bloodbank_id" => $this->session->userdata("login_bloodbank_id")));  
                return TRUE;
        }
        public function get_bloodbanks(){
                $vsp    =   $this->employee_model->get_employee($this->session->userdata("login_id"));
                if(count($vsp) > 0){ 
                    $hy     =   "";
                    if($vsp->bloodbanks != ""){
                        $bs =   array_filter(explode(",",$vsp->bloodbanks));
                        if(count($bs) > 0){ 
                            foreach ($bs as $ht){
                                    $hy .=  "bloodbank_id =".$ht." OR ";
                            }
                            if($hy != ''){
                                    $hy     =   substr($hy,0,-3);
                                    $this->db->where("($hy)");
                            }
                        }
                    }  
                }
        }
}