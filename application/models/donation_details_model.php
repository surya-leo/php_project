<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Donation_details_model extends CI_Model{
        public function medicalcheckup($uri){
                $getdata        =   $this->blood_bank_model->view_blooddonorid($uri);
                $repl_id        =   "0";
                if($this->input->post("donation_type") == '1'){
                        $repl   =   array(
                                "name"              =>  $this->input->post("patient_name"),
                                "blood_group"       =>  $this->input->post("blood_group")
                        );
                        $this->db->insert("bb_replacement_patient",$repl);
                        $repl_id    =   $this->db->insert_id();
                }
                $bb_dont    =   array(
                            "bb_donation_details_id"    =>  $getdata->donation_id,
                            "bbdonor_id"                =>  $getdata->donor_id,
                            "replacement_patient_id"    =>  $repl_id,
                            "weight"                    =>  $this->input->post("weight"),
                            "pulse"                     =>  $this->input->post("pulse"),
                            "hb"                        =>  $this->input->post("hb"),
                            "sbp"                       =>  $this->input->post("sbp"),
                            "dbp"                       =>  $this->input->post("dbp"),
                            "temperature"               =>  $this->input->post("temperature"),
                            "donation_time"             =>  $this->input->post("donation_time"),
                            "hospital_id"               =>  $getdata->mbbloodbank_id,
                            "bbdonation_date"           =>  $getdata->donation_date,
                );
                $this->db->insert("bb_donation",$bb_dont);
                $val    =   $this->db->insert_id();
                if($val > 0){
                    $getdat     =   $this->blood_bank_model->view_blooddonorid($uri);
                    if($getdat->donation_status == '7'){
                        $this->db->update("transfer_collection",array("tc_donation_status" => "1"),array("tc_donation_id" => $uri));
                    }else{
                        $this->db->update("donation_details",array("donation_status" => "1"),array("donation_id" => $uri));
                    }
                    return $val;
                }
                return  "0";
        }
        public function get_medical($uri){
                return     $this->db->select("*")
                                    ->from("bb_donation as b")
                                    ->join("bloodbanks as k","k.bloodbank_id = b.hospital_id","INNER")
                                    ->join("login as l","k.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","k.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->where('u.ut_open',"1")
                                    ->where('t.btype_open',"1") 
                                    ->where('l.login_open',"1")
                                    ->where("b.bbdonation_id",$uri)
                                    ->get()->row();
        }
        public function get_bb_donation_details_id($uri){
                return     $this->db->select("*")
                                    ->from("bb_donation as b")
                                    ->join("bloodbanks as k","k.bloodbank_id = b.hospital_id","INNER")
                                    ->join("login as l","k.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","k.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->where('u.ut_open',"1")
                                    ->where('t.btype_open',"1") 
                                    ->where('l.login_open',"1")
                                    ->where("b.bb_donation_details_id",$uri)
                                    ->get()->row();
        }
        public function get_donation($uri){
                return      $this->db->select("*")
                                    ->from("bb_donation as b")
                                    ->join("bloodbanks as k","k.bloodbank_id = b.hospital_id","INNER")
                                    ->join("login as l","k.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","k.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->join("donation_details as d","d.donor_id = b.bbdonor_id","INNER")
                                    ->join("transfer_collection","transfer_collection.tc_donation_id = d.donation_id","LEFT")
                                    ->where('u.ut_open',"1")
                                    ->where('t.btype_open',"1") 
                                    ->where('l.login_open',"1")
                                    ->where("b.bbdonation_id",$uri)->get()->row();
        }
        public function check_bag($uri){
                $vsp    =   $this->db->select("count(*) as cnt")
                            ->from("bb_donation as b")
                            ->join("bloodbanks as k","k.bloodbank_id = b.hospital_id","INNER")
                            ->join("login as l","k.blood_login_id = l.login_id","INNER")
                            ->join("bloodbank_type as t","k.blood_bank_type = t.btype_id","INNER")
                            ->join("usertype as u","u.ut_id = l.login_type","INNER")
                            ->join("donation_details as d","d.donor_id = b.bbdonor_id","INNER")
                        ->where('u.ut_open',"1")
                    ->where('t.btype_open',"1") 
                    ->where('l.login_open',"1")
                            ->where("b.blood_unit_num",$uri)->get()->row();
                if($vsp->cnt == '0'){
                        return TRUE;
                }
                return FALSE;
        }
        public function bleeding($uri){
                $getdata    =   $this->get_donation($uri);
                if($this->input->post('under_collection')){
			$status_id      =   3;
			$blood_unit     =   $this->input->post('blood_unit_num');
		}
		else{
			$status_id      =   4;
			$blood_unit     =   $this->input->post('blood_unit_num');
		}
                $dta    =   array(
                        "blood_unit_num"    =>      $blood_unit,
                        "segment_num"       =>      $this->input->post("segment_num"),
                        "bag_type"          =>      $this->input->post("bag_type"),
                        "collected_by"      =>      $this->input->post("staff"),                      
                        "bbvolume"          =>      $this->input->post("volume"),
                        "status_id"         =>      $status_id
                );
                $this->db->update("bb_donation",$dta,array("bbdonation_id" => $uri));
                if($getdata->donation_status == '7'){
                    $this->db->update("transfer_collection",array("tc_donation_status" => "2"),array("tc_donation_id" => $getdata->donation_id));
                }else{
                    $this->db->update("donation_details",array("donation_status" => "2"),array("donation_id" => $getdata->donation_id));
                }
                return  $this->db->affected_rows();
        }
        public function blood_grouping($uri){
                $getdata    =   $this->get_donation($uri);
                $dta    =   array(
                            "bgdonation_id"      =>      $uri,
                            "bgblood_group"      =>      $this->input->post("blood_group"),
                            "grouping_date"      =>      $this->input->post("donation_date"),
                            "anti_a"             =>      $this->input->post("anti_a"),
                            "anti_b"             =>      $this->input->post("anti_b"), 
                            "anti_ab"            =>      $this->input->post("anti_ab"), 
                            "anti_d"             =>      $this->input->post("anti_d"), 
                            "a_cells"            =>      $this->input->post("anti_ac"), 
                            "b_cells"            =>      $this->input->post("anti_bc"), 
                            "o_cells"            =>      $this->input->post("anti_oc"), 
                            "du"                 =>      $this->input->post("anti_du"), 
                            "forward_done_by"    =>      $this->input->post("staff_forward"), 
                            "reverse_done_by"    =>      $this->input->post("staff_reverse")
                );
                $this->db->insert("blood_grouping",$dta);
                $this->db->update("bb_donation",array("status_id" => "5"),array("bbdonation_id" => $uri));     
                if($getdata->donation_status == '7'){
                    $this->db->update("transfer_collection",array("tc_donation_status" => "3"),array("tc_donation_id" => $getdata->bb_donation_details_id));
                }else{
                    $this->db->update("donation_details",array("donation_status" => "3"),array("donation_id" => $getdata->bb_donation_details_id));       
                }        
                return $this->db->affected_rows();
        }
        public function blood_group_serum($uri){
                return  $this->db->get_where("blood_group_serum",array("blood_group" => $uri))->row();
        }
        public function component_preparation($uri){
                    $getdata    =   $this->get_donation($uri);
                    $this->db->select('DATE_ADD(bbdonation_date,INTERVAL 35 DAY) expiry_35,DATE_ADD(bbdonation_date,INTERVAL 42 DAY) expiry_42,                    DATE_ADD(bbdonation_date,INTERVAL 5 DAY) expiry_5,DATE_ADD(bbdonation_date,INTERVAL 365 DAY) expiry_365,DATE_ADD(bbdonation_date,INTERVAL 1825 DAY) expiry_1825,blood_inventory.*,bb_donation.*',FALSE)->from('bb_donation')
                    ->join('blood_inventory','blood_inventory.bidonation_id=bb_donation.bbdonation_id',"LEFT")
                    ->where('bb_donation.bbdonation_id',$uri);
                    $components  =    $this->input->post('pcells'); 
                    $query      =   $this->db->get();  
                    $result     =   $query->row();
                    $inventory  =   $result;//[0];  
                    foreach($components as $component){ 
                            if($component ==    "WB"){
                                    $volume =   $inventory->bbvolume;
                                    $expiry_date    =   $inventory->expiry_35;
                            }
                            else if($component  ==  'PC'){
                                    if($inventory->bbvolume   ==  350){
                                            $volume='100';
                                    }
                                    else{
                                            $volume='150';
                                    }
                                    if($inventory->bag_type ==  5){
                                            $expiry_date    =   $inventory->expiry_42;
                                    }
                                    else{
                                            $expiry_date    =   $inventory->expiry_35;
                                    }
                            }
                            else if($component=='FFP'){
                                    if($inventory->bbvolume==350){
                                            $volume='40';
                                    }
                                    else{
                                            $volume='60';
                                    }
                                    $expiry_date    =   $inventory->expiry_365;
                            }
                            else if($component  ==  'FP'){
                                    if($inventory->bbvolume==350){
                                            $volume='40';
                                    }
                                    else{
                                            $volume='60';
                                    }
                                    $expiry_date    =   $inventory->expiry_1825;
                            }
                            else if($component=='PRP'){
                                    if($inventory->bbvolume==350){
                                            $volume='100';
                                    }
                                    else{
                                            $volume='120';
                                    }
                                    $expiry_date    =   $inventory->expiry_5;
                            }
                            else if($component=='Platelet Concentrate'){
                                    if($inventory->bbvolume==350){
                                            $volume='100';
                                    }
                                    else{
                                            $volume='120';
                                    }
                                    $expiry_date    =   $inventory->expiry_5;
                            }
                            else if($component=='Cryo'){
                                    if($inventory->bbvolume==350){
                                            $volume='80';
                                    }
                                    else{
                                            $volume='100';
                                    }
                                    $expiry_date    =   $inventory->expiry_5;
                            }  
                            $dta    =   array(
                                        "bidonation_id"        =>      $uri,
                                        "component_type"       =>      $component,
                                        "bistatus_id"          =>      "7",
                                        "bivolume"             =>      $volume,
                                        "created_by"           =>      $this->input->post("staff_reverse"), 
                                        "expiry_date"          =>      $expiry_date, 
                                        "component_perparation_time"             =>      $this->input->post("donation_time"), 
                                        "datetime"             =>      $this->input->post("donation_date") 
                            );
                            $this->db->insert("blood_inventory",$dta); 
                    } 
                    $dta    =   array(
                                "bidonation_id"        =>      $uri,
                                "component_type"     =>      "Components Prepared",
                                "bistatus_id"          =>      "10",
                                "bivolume"             =>      $inventory->bbvolume,
                                "created_by"         =>      $this->input->post("staff_reverse"), 
                                "expiry_date"        =>      $inventory->bbdonation_date, 
                                "component_perparation_time"  =>      $this->input->post("donation_time"), 
                                "datetime"           =>      $this->input->post("donation_date") 
                    );
                    $this->db->insert("blood_inventory",$dta);  
                    if($getdata->donation_status == '7'){
                        $this->db->update("transfer_collection",array("tc_donation_status" => "4"),array("tc_donation_id" => $getdata->bb_donation_details_id));
                    }else{
                        $this->db->update("donation_details",array("donation_status" => "4"),array("donation_id" => $getdata->bb_donation_details_id));
                    } 
                    return  $this->db->affected_rows();
        }
        public function blood_screening($uri){
                $hiv            =   $this->input->post("test_hiv")?$this->input->post("test_hiv"):"0";
                $hbsag          =   $this->input->post("test_hbsag")?$this->input->post("test_hbsag"):"0";
                $hcv            =   $this->input->post("test_hcv")?$this->input->post("test_hcv"):"0";
                $vdrl           =   $this->input->post("test_vdrl")?$this->input->post("test_vdrl"):"0";
                $mp             =   $this->input->post("test_mp")?$this->input->post("test_mp"):"0";
                $irregular_ab   =   $this->input->post("test_irregular_ab")?$this->input->post("test_irregular_ab"):"0";
                $getdata    =   $this->get_donation($uri);
                $dta    =   array(
                            "scdonation_id" =>      $uri,
                            "test_hiv"      =>      $hiv,
                            "test_hbsag"    =>      $hbsag, 
                            'test_hcv'      =>      $hcv,
                            'test_vdrl'     =>      $vdrl,
                            'test_mp'       =>      $mp,
                            'test_irregular_ab'     =>  $irregular_ab,
                            'screening_datetime'    =>  $this->input->post("donation_date"), 
                            "screened_by"           =>  $this->input->post("staff_reverse") 
                );
                if($hiv == 1 || $hbsag == 1 || $hcv == 1 ||  $vdrl == 1 || $mp == 1 ||  $irregular_ab == 1){
                       $screening_result    =   0;
                }
                else{
                       $screening_result    =   1;
                }
                $status_data    =  array( 
                                    'status_id'         =>  6,
                                    'screening_result'  =>  $screening_result
			);
                $this->db->insert("blood_screening",$dta); 
                $this->db->update('bb_donation',$status_data,array("bbdonation_id" => $uri));
                if($getdata->donation_status == '7'){
                    $this->db->update("transfer_collection",array("tc_donation_status" => "5"),array("tc_donation_id" => $getdata->bb_donation_details_id));
                }else{
                    $this->db->update("donation_details",array("donation_status" => "5"),array("donation_id" => $getdata->bb_donation_details_id));
                }
                return  $this->db->affected_rows();
        }
        public function cntblood_issue($params = array()){
                $this->blood_issue_query($params);
                $subQuery =  "(".$this->db->last_query().") as d";
                $this->db->select("count(*) as cnt");
                $this->db->from($subQuery); 
                $vsp    =   $this->db->get()->row();
                return  $vsp->cnt;
        }
        public function blood_issue_query($params = array()){
                $this->db->select("*")
                                ->from("blood_request as r")
                                ->join("bloodbanks as b","b.bloodbank_id = r.brbloodbank_id","INNER")
                                ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER") 
                                ->where('u.ut_open',"1")
                                ->where('t.btype_open',"1") 
                                ->where('l.login_open',"1")
                                ->where("r.request_status","Pending");
                if($this->session->userdata("login_bloodbank_id") != ''){
                        $this->db->where("r.brbloodbank_id",$this->session->userdata("login_bloodbank_id"));
                } 
                if(array_key_exists("request_id",$params)){                    
                        $this->db->where("r.request_id", $params['request_id']);
                }
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(b.bloodbank_name LIKE '%".$params['keywords']."%' OR b.district LIKE '%".$params['keywords']."%' OR  b.city LIKE '%".$params['keywords']."%' OR b.bbmobile LIKE '%".$params['keywords']."%' OR r.brmobile LIKE '%".$params['keywords']."%'  OR r.patient_first_name LIKE '%".$params['keywords']."%' OR r.patient_last_name LIKE '%".$params['keywords']."%' OR r.brblood_group LIKE '%".$params['keywords']."%' OR (CASE WHEN r.patient_gender = 1 THEN 'Male' ELSE 'Female' END) LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                return  $this->db->get();
        }
        public function blood_issue($params = array()){
                return  $this->blood_issue_query($params)->result();
        }
        public function blood_issue_row($uir){
                $params['request_id']   =   $uir;
                return  $this->blood_issue_query($params)->row();
        }
        public function check_inventory($uir){ 
                $component      =   array();
                $ve             =   $this->blood_issue_row($uir);
                if($ve->whole_blood_units!=0){   $component[]   =   '"WB"';    }
                if($ve->packed_cell_units!=0){   $component[]   =   '"PC"';    }
                if($ve->fp_units!=0){            $component[]   =   '"FP"';    }
                if($ve->ffp_units!=0){           $component[]   =   '"FFP"';   }
                if($ve->prp_units!=0){           $component[]   =   '"PRP"';   }
                if($ve->platelet_concentrate_units!=0){ $component[]   =   '"Platelet Concentrate"';  }
                if($ve->cryoprecipitate_units!=0){      $component[]   =   '"Cryo"'; }                
                $hospital       =   $this->session->userdata("login_bloodbank_id");
		$components     =   ($this->input->post('components'))?implode($this->input->post('components'),","):implode($component,","); 
		$blood_group    =   ($this->input->post('blood_group'))?$this->input->post('blood_group'):$ve->brblood_group;
		
		$result =   $this->db->query('
                        SELECT * FROM blood_inventory
                        JOIN bb_donation ON blood_inventory.bidonation_id=bb_donation.bbdonation_id
                        JOIN donation_details ON donation_details.donation_id=bb_donation.bb_donation_details_id
                        WHERE ("WB" IN ('.$components.')) AND component_type="WB" AND bb_donation.status_id=6 AND screening_result=1 AND blood_inventory.bistatus_id=7 AND blood_group="'.$blood_group.'" AND donation_details.dbbloodbank_id='.$hospital.'
                        UNION
                        SELECT * FROM blood_inventory
                        JOIN bb_donation ON blood_inventory.bidonation_id=bb_donation.bbdonation_id
                        JOIN donation_details ON donation_details.donation_id=bb_donation.bb_donation_details_id
                        WHERE ("FP" IN ('.$components.') OR "FFP" IN ('.$components.') OR "PC" IN ('.$components.')) AND component_type IN ("PC","FP","FFP") AND bb_donation.status_id=6 AND screening_result=1 AND blood_inventory.bistatus_id=7  AND donation_details.dbbloodbank_id='.$hospital.' AND blood_group LIKE "'.trim($blood_group,'+-').'%"
                        UNION
                        SELECT * FROM blood_inventory
                        JOIN bb_donation ON blood_inventory.bidonation_id=bb_donation.bbdonation_id
                        JOIN donation_details ON donation_details.donation_id=bb_donation.bb_donation_details_id
                        WHERE ("Cryo" IN ('.$components.') OR "PRP" IN ('.$components.') OR "Platelet Concentrate" IN ('.$components.'))
                        AND component_type IN ("Cryo","PRP","Platelet Concentrate") 
                        AND bb_donation.status_id=6  AND screening_result=1 AND blood_inventory.bistatus_id=7  AND donation_details.dbbloodbank_id='.$hospital.'
                        ORDER BY component_type,blood_unit_num ASC,expiry_date ASC
		');    
                return $result->result();
        }
        public function issue($uri){
                $inventory  =   $this->input->post('inventory_id');
                $data=array(
                        'request_id'    =>      $uri,
                        'issued_by'     =>      $this->input->post('staff'),
                        'cross_matched_by'  =>  $this->input->post('cross_matched_by'),
                        'issue_date'        =>  date("Y-m-d",strtotime($this->input->post('donation_date'))),
                        'issue_time'        =>  date("h:i:s",strtotime($this->input->post('donation_time')))
                );
                $issued_inventory = array(); 
                $this->db->insert('blood_issue',$data);
                $issue_id   =   $this->db->insert_id();
                foreach($inventory as $inventory_id){
                        $issued_inventory[] =   array(
                                                    'issue_id'      =>  $issue_id,
                                                    'inventory_id'  =>  $inventory_id
                                                );
                        $this->db->update('blood_inventory',array('bistatus_id'=>8),array("inventory_id" => $inventory_id));
                } 
                $this->db->insert_batch('bb_issued_inventory',$issued_inventory);
                $this->db->update('blood_request',array('request_status'=>'issued'),array("request_id" => $uri));
                return $this->print_blood($inventory);
        }
        public function print_blood($inventory){
                $this->db->select('donation_details.*,blood_request.*,donation_details.donation_date,blood_issue.issue_id, issue_date,issue_time,blood_request.request_status,bb_donation.blood_unit_num, bb_donation.segment_num, blood_inventory.component_type, blood_inventory.bivolume, blood_request.brblood_group "recipient_group",bloodbanks.bloodbank_name')
                        ->from('donation_details')
//			->join('bb_donation','donation_details.donor_id=bb_donation.bbdonor_id','left')
			->join('bb_donation','donation_details.donation_id=bb_donation.bb_donation_details_id','left')
			->join('blood_inventory','bb_donation.bbdonation_id=blood_inventory.bidonation_id','left')
			->join('bb_issued_inventory','blood_inventory.inventory_id=bb_issued_inventory.inventory_id','left')
			->join('blood_issue','bb_issued_inventory.issue_id=blood_issue.issue_id','left')
			->join('blood_request','blood_issue.request_id=blood_request.request_id','left') 
                        ->join('bloodbanks','bloodbanks.bloodbank_id=blood_request.bloodbank_id','left')
                        ->join("login as l","bloodbanks.blood_login_id = l.login_id","left")
                        ->join("usertype as u","u.ut_id = l.login_type","left")
                        ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","left") 
                        ->where('u.ut_open',"1")
                    ->where('t.btype_open',"1") 
                    ->where('l.login_open',"1")
			->where_in('blood_inventory.inventory_id',$inventory)
			->group_by('donation_details.donor_id');
			$query=$this->db->get();
                return $query->result();
        }
        public function request_submit(){
                $this->db->update("blood_request",array("request_remarks" => $this->input->post('text_datap'),'request_status' => "Closed"),array("request_id" => $this->input->post("viattr")));
                return TRUE;
        }
        public function bulk_group(){
                $mdid   =   $this->input->post("bbdonation_id");
                if($mdid != ''){
                    foreach($mdid as $uri){
                            $getdata    =   $this->get_donation($uri);
                            $dta    =   array(
                                        "bgdonation_id"      =>      $uri,
                                        "bgblood_group"      =>      $this->input->post("blood_group_$uri"),
                                        "grouping_date"      =>      $this->input->post("donation_date"),
                                        "anti_a"             =>      $this->input->post("anti_a_$uri"),
                                        "anti_b"             =>      $this->input->post("anti_b_$uri"), 
                                        "anti_ab"            =>      $this->input->post("anti_ab_$uri"), 
                                        "anti_d"             =>      $this->input->post("anti_d_$uri"), 
                                        "a_cells"            =>      $this->input->post("anti_ac_$uri"), 
                                        "b_cells"            =>      $this->input->post("anti_bc_$uri"), 
                                        "o_cells"            =>      $this->input->post("anti_oc_$uri"), 
                                        "du"                 =>      $this->input->post("anti_du_$uri"), 
                                        "forward_done_by"    =>      $this->input->post("staff_forward"), 
                                        "reverse_done_by"    =>      $this->input->post("staff_reverse")
                            ); 
                            $this->db->insert("blood_grouping",$dta);
                            $this->db->update("bb_donation",array("status_id" => "5"),array("bbdonation_id" => $uri));     
                            if($getdata->donation_status == '7'){
                                $this->db->update("transfer_collection",array("tc_donation_status" => "3"),array("tc_donation_id" => $getdata->bb_donation_details_id));
                            }else{
                                $this->db->update("donation_details",array("donation_status" => "3"),array("donation_id" => $getdata->bb_donation_details_id));       
                            } 
                        }
                        return TRUE;
                }
                return FALSE;
        }
        public function bulk_compon(){
                $mdid   =   $this->input->post("bbdonation_id");
                if($mdid != ''){
                    foreach($mdid as $uri){
                        $getdata    =   $this->get_donation($uri); 
                        $this->db->select('DATE_ADD(bbdonation_date,INTERVAL 35 DAY) expiry_35,DATE_ADD(bbdonation_date,INTERVAL 42 DAY) expiry_42,                    DATE_ADD(bbdonation_date,INTERVAL 5 DAY) expiry_5,DATE_ADD(bbdonation_date,INTERVAL 365 DAY) expiry_365,DATE_ADD(bbdonation_date,INTERVAL 1825 DAY) expiry_1825,blood_inventory.*,bb_donation.*',FALSE)->from('bb_donation')
                        ->join('blood_inventory','blood_inventory.bidonation_id=bb_donation.bbdonation_id',"LEFT")
                        ->where('bb_donation.bbdonation_id',$uri);
                        $components  =    $this->input->post("pcells_$uri"); 
                        $query      =   $this->db->get();  
                        $result     =   $query->row();
                        $inventory  =   $result;//[0];  
                        foreach($components as $component){ 
                                if($component ==    "WB"){
                                        $volume =   $inventory->bbvolume;
                                        $expiry_date    =   $inventory->expiry_35;
                                }
                                else if($component  ==  'PC'){
                                        if($inventory->bbvolume   ==  350){
                                                $volume='100';
                                        }
                                        else{
                                                $volume='150';
                                        }
                                        if($inventory->bag_type ==  5){
                                                $expiry_date    =   $inventory->expiry_42;
                                        }
                                        else{
                                                $expiry_date    =   $inventory->expiry_35;
                                        }
                                }
                                else if($component=='FFP'){
                                        if($inventory->bbvolume==350){
                                                $volume='40';
                                        }
                                        else{
                                                $volume='60';
                                        }
                                        $expiry_date    =   $inventory->expiry_365;
                                }
                                else if($component  ==  'FP'){
                                        if($inventory->bbvolume==350){
                                                $volume='40';
                                        }
                                        else{
                                                $volume='60';
                                        }
                                        $expiry_date    =   $inventory->expiry_1825;
                                }
                                else if($component=='PRP'){
                                        if($inventory->bbvolume==350){
                                                $volume='100';
                                        }
                                        else{
                                                $volume='120';
                                        }
                                        $expiry_date    =   $inventory->expiry_5;
                                }
                                else if($component=='Platelet Concentrate'){
                                        if($inventory->bbvolume==350){
                                                $volume='100';
                                        }
                                        else{
                                                $volume='120';
                                        }
                                        $expiry_date    =   $inventory->expiry_5;
                                }
                                else if($component=='Cryo'){
                                        if($inventory->bbvolume==350){
                                                $volume='80';
                                        }
                                        else{
                                                $volume='100';
                                        }
                                        $expiry_date    =   $inventory->expiry_5;
                                }  
                                $dta    =   array(
                                            "bidonation_id"        =>      $uri,
                                            "component_type"       =>      $component,
                                            "bistatus_id"          =>      "7",
                                            "bivolume"             =>      $volume,
                                            "created_by"           =>      $this->input->post("staff_reverse"), 
                                            "expiry_date"          =>      $expiry_date, 
                                            "component_perparation_time"             =>      $this->input->post("donation_time"), 
                                            "datetime"             =>      $this->input->post("donation_date") 
                                );
                                $this->db->insert("blood_inventory",$dta); 
                        } 
                        $dta    =   array(
                                    "bidonation_id"         =>      $uri,
                                    "component_type"        =>      "Components Prepared",
                                    "bistatus_id"           =>      "10",
                                    "bivolume"              =>      $inventory->bbvolume,
                                    "created_by"            =>      $this->input->post("staff_reverse"), 
                                    "expiry_date"           =>      $inventory->bbdonation_date, 
                                    "component_perparation_time"  =>      $this->input->post("donation_time"), 
                                    "datetime"              =>      $this->input->post("donation_date") 
                        );
                        $this->db->insert("blood_inventory",$dta);  
                        if($getdata->donation_status == '7'){
                            $this->db->update("transfer_collection",array("tc_donation_status" => "4"),array("tc_donation_id" => $getdata->bb_donation_details_id));
                        }else{
                            $this->db->update("donation_details",array("donation_status" => "4"),array("donation_id" => $getdata->bb_donation_details_id));
                        }  
                    }  
                    return TRUE;
                } 
                return FALSE;
        }
        public function bulk_screening(){
                $mdid   =   $this->input->post("bbdonation_id");
                if($mdid != ''){
                    foreach($mdid as $uri){
                        $hiv            =   $this->input->post("test_hiv_$uri")?$this->input->post("test_hiv_$uri"):"0";
                        $hbsag          =   $this->input->post("test_hbsag_$uri")?$this->input->post("test_hbsag_$uri"):"0";
                        $hcv            =   $this->input->post("test_hcv_$uri")?$this->input->post("test_hcv_$uri"):"0";
                        $vdrl           =   $this->input->post("test_vdrl_$uri")?$this->input->post("test_vdrl_$uri"):"0";
                        $mp             =   $this->input->post("test_mp_$uri")?$this->input->post("test_mp_$uri"):"0";
                        $irregular_ab   =   $this->input->post("test_irregular_ab_$uri")?$this->input->post("test_irregular_ab_$uri"):"0";
                        $getdata    =   $this->get_donation($uri);
                        $dta    =   array(
                                    "scdonation_id" =>      $uri,
                                    "test_hiv"      =>      $hiv,
                                    "test_hbsag"    =>      $hbsag, 
                                    'test_hcv'      =>      $hcv,
                                    'test_vdrl'     =>      $vdrl,
                                    'test_mp'       =>      $mp,
                                    'test_irregular_ab'     =>  $irregular_ab,
                                    'screening_datetime'    =>  $this->input->post("donation_date"), 
                                    "screened_by"           =>  $this->input->post("staff_reverse") 
                        );
                        if($hiv == 1 || $hbsag == 1 || $hcv == 1 ||  $vdrl == 1 || $mp == 1 ||  $irregular_ab == 1){
                               $screening_result    =   0;
                        }
                        else{
                               $screening_result    =   1;
                        }
                        $status_data    =  array( 
                                            'status_id'         =>  6,
                                            'screening_result'  =>  $screening_result
                                );
                        $this->db->insert("blood_screening",$dta); 
                        $this->db->update('bb_donation',$status_data,array("bbdonation_id" => $uri));
                        if($getdata->donation_status == '7'){
                            $this->db->update("transfer_collection",array("tc_donation_status" => "5"),array("tc_donation_id" => $getdata->bb_donation_details_id));
                        }else{
                            $this->db->update("donation_details",array("donation_status" => "5"),array("donation_id" => $getdata->bb_donation_details_id));
                        } 
                    }
                    return TRUE;
                }
                return FALSE;
        }
}