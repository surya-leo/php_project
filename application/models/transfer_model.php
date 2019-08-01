<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Transfer_model extends CI_Model{
        public function  transferquery($params = array()){
                    $dt     =   array(
                                        "u.ut_open"     => "1",
                                        "b.tc_open"     => "1",
                                        "t.btype_open"  => "1",
                                        "u1.ut_open"     => "1", 
                                        "t1.btype_open"  => "1"
                                    );
                    $select     =   "count(b.tc_date) as cnt,b.tid,tc_date,k.*,k.bloodbank_name as to_bloodbank_name,k1.bloodbank_name as from_bloodbank_name";
                    if(array_key_exists("cnt",$params)){
                            $select     =   'count(*) as cnt';
                    } 
                    $this->db->select("$select")
                                ->from("transfer_collection as b")
                                ->join("bloodbanks as k","k.bloodbank_id = b.tc_to_bank","INNER")
                                ->join("login as l","k.blood_login_id = l.login_id","INNER")
                                ->join("bloodbank_type as t","k.blood_bank_type = t.btype_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("bloodbanks as k1","k1.bloodbank_id = b.tc_from_bank","INNER")
                                ->join("login as l1","k1.blood_login_id = l1.login_id","INNER")
                                ->join("bloodbank_type as t1","k1.blood_bank_type = t1.btype_id","INNER")
                                ->join("usertype as u1","u1.ut_id = l1.login_type","INNER")
                                ->where('l.login_open',"1")
                                ->where('l1.login_open',"1")
                                ->where($dt);
                    if(array_key_exists("keywords",$params)){
                        $this->db->where("(k.bloodbank_name LIKE '%".$params['keywords']."%' OR k1.bloodbank_name LIKE '%".$params['keywords']."%')");
                    }
                    if(array_key_exists("donationid",$params)){
                            $this->db->where("b.tc_donation_id",$params["donationid"]);
                    }
                    if(array_key_exists("tc_acde",$params)){
                            $this->db->where("b.tc_acde",$params['tc_acde']);
                    }
                    if(array_key_exists("bloodbank",$params)){
                            $this->db->where("b.tc_from_bank",$params['bloodbank']);
                    }
                    if(array_key_exists("asate",$params)){
                        if($params["asate"] != ""){
                            $asate    =   explode(" - ",$params["asate"]);
                            $this->db->where("(b.tc_date >= '".$asate['0']."' AND b.tc_date <= '".$asate['1']."')");
                        }
                    }
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit']);
                    }
                    if(array_key_exists('group', $params)){
                            $this->db->group_by($params["group"]);
                    }
                    return $this->db->get();
        }
        public function cnttransfer($params = array()){
                $params["cnt"]      =   '1';
                $params["group"]    =  "b.tc_to_bank,b.tc_date";
                $vsp    =  $this->transferquery($params)->result(); 
                if(count($vsp)  >0 ){
                    $i = 0;
                    foreach ($vsp as $p){
                        $i = $i+1;
                    }
                    return $i;
                }
                return 0;
        }
        public function transfer($params = array()){               
                $params["group"]    =  "b.tc_to_bank,b.tc_date";
                return  $this->transferquery($params)->result();
        }
        public function getdonation($donid){ 
                $params["donationid"]   =   $donid; 
                $params["tc_acde"]   =   '1'; 
                return  $this->transferquery($params)->row();
        }
        public function  collectionquery($params = array()){
                    $dt     =   array(
                                        
                                        "b.tc_open"     => "1",
                                        "u.ut_open"     => "1",
                                        "t.btype_open"  => "1",
                                        "u1.ut_open"     => "1",
                                        "t1.btype_open"  => "1"
                                    );
                    if(array_key_exists("cnt",$params)){
                            $select     =   'count(b.tc_date) as cnt';
                    }else{
                            $select     =   "count(b.tc_date) as cnt,tc_date,k.*,k.bloodbank_name as from_bloodbank_name,k1.bloodbank_name as to_bloodbank_name";
                    }
                    $this->db->select("$select")
                                    ->from("transfer_collection as b")
                                    ->join("bloodbanks as k","k.bloodbank_id = b.tc_from_bank","INNER")
                                    ->join("login as l","k.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","k.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->join("bloodbanks as k1","k1.bloodbank_id = b.tc_to_bank","INNER")
                                    ->join("login as l1","k1.blood_login_id = l1.login_id","INNER")
                                    ->join("bloodbank_type as t1","k1.blood_bank_type = t1.btype_id","INNER")
                                    ->join("usertype as u1","u1.ut_id = l1.login_type","INNER")
                                    ->where('l.login_open',"1")
                                    ->where('l1.login_open',"1")
                                    ->where($dt);
                    if(array_key_exists("keywords",$params)){
                            $this->db->where("(k.bloodbank_name LIKE '%".$params['keywords']."%' OR k1.bloodbank_name LIKE '%".$params['keywords']."%')");
                    }
                    if(array_key_exists("bloodbank",$params)){
                            $this->db->where("b.tc_to_bank",$params['bloodbank']);
                    }
                    if(array_key_exists("asate",$params)){
                        if($params["asate"] != ""){
                            $asate    =   explode(" - ",$params["asate"]);
                            $this->db->where("(b.tc_date >= '".$asate['0']."' AND b.tc_date <= '".$asate['1']."')");
                        }
                    }
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit']);
                    }
                    if(array_key_exists('group', $params)){
                            $this->db->group_by($params["group"]);
                    }
//                    $this->db->get();echo $this->db->last_query();exit;
                    return $this->db->get();
        }
        public function cntcollection($params = array()){
                $params["cnt"]      =   '1';
                $params["group"]    =  "b.tc_from_bank,b.tc_date";
                $vsp    =  $this->collectionquery($params)->result(); 
                if(count($vsp)  >0 ){
                    $i = 0;
                    foreach ($vsp as $p){
                        $i = $i+1;
                    }
                    return $i;
                }
                return 0;
        }
        public function collection($params = array()){               
                $params["group"]    =  "b.tc_from_bank,b.tc_date";
                return  $this->collectionquery($params)->result();
        }
        public function  bcollectionquery($params = array()){
                    $dt     =   array(
                                        
                                        "b.tc_open"     => "1",
                                        "u.ut_open"     => "1",
                                        "t.btype_open"  => "1",
                                        "u1.ut_open"     => "1",
                                        "t1.btype_open"  => "1"
                                    ); 
                    $select     =   "k.*,k.bloodbank_name as from_bloodbank_name,
                        SUM(CASE WHEN blood_group='A+ve' THEN 1 ELSE 0 END) 'Apos',
                        SUM(CASE WHEN blood_group='A-ve' THEN 1 ELSE 0 END) 'Aneg',
                        SUM(CASE WHEN blood_group='B+ve' THEN 1 ELSE 0 END) 'Bpos',
                        SUM(CASE WHEN blood_group='B-ve' THEN 1 ELSE 0 END) 'Bneg',
                        SUM(CASE WHEN blood_group='AB+ve' THEN 1 ELSE 0 END) 'ABpos',
                        SUM(CASE WHEN blood_group='AB-ve' THEN 1 ELSE 0 END) 'ABneg',
                        SUM(CASE WHEN blood_group='O+ve' THEN 1 ELSE 0 END) 'Opos', 
                        SUM(CASE WHEN blood_group='O-ve' THEN 1 ELSE 0 END) 'Oneg',tcdate";  
                    $this->db->select("$select")
                                        ->from("transfer_collection as b")
                                        ->join("donation_details as d","d.donation_id = b.tc_donation_id","INNER")
                                        ->join("bloodbanks as k","k.bloodbank_id = b.tc_from_bank","INNER")
                                        ->join("login as l","k.blood_login_id = l.login_id","INNER")
                                        ->join("bloodbank_type as t","k.blood_bank_type = t.btype_id","INNER")
                                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                        ->join("bloodbanks as k1","k1.bloodbank_id = b.tc_to_bank","INNER")
                                        ->join("login as l1","k1.blood_login_id = l1.login_id","INNER")
                                        ->join("bloodbank_type as t1","k1.blood_bank_type = t1.btype_id","INNER")
                                        ->join("usertype as u1","u1.ut_id = l1.login_type","INNER")
                                        ->join("(SELECT DISTINCT tc_from_bank,MAX(tc_date) as tcdate FROM  transfer_collection GROUP by tc_from_bank)  as mg","mg.tc_from_bank = b.tc_from_bank AND mg.tcdate = b.tc_date","INNER")
                                        ->where('l.login_open',"1")
                                        ->where('l1.login_open',"1");
                    $this->db->where($dt); 
//                    $this->db->where("(tcdate <= '".date("Y-m-d")."')");  
                    if(array_key_exists("district",$params)){
                            $this->db->where("(k.district LIKE '%".$params['district']."%')");
                    }
                    if(array_key_exists("city",$params)){
                            $this->db->where("(k.city LIKE '%".$params['city']."%')");
                    }
                    if(array_key_exists("keywords",$params)){
                            $this->db->where("(k.bloodbank_name LIKE '%".$params['keywords']."%' OR k.district LIKE '%".$params['keywords']."%' OR k.city LIKE '%".$params['keywords']."%')");
                    }                             
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit']);
                    } 
                    if(array_key_exists("group_by",$params)){
                            $this->db->group_by($params['group_by']);
                    }
                    $this->db->order_by("mg.tcdate","DESC");
//                    $this->db->get();echo $this->db->last_query();exit;
                    return $this->db->get();
        }
        public function cntbcollection($params = array()){
                $params["cnt"]  =   '1';
                $params["group_by"]  =   'b.tc_from_bank';
                $vsp    =  $this->bcollectionquery($params)->result(); 
                if(count($vsp)  >0 ){
                    $i = 0;
                    foreach ($vsp as $p){
                        $i = $i+1;
                    }
                    return $i;
                }
                return 0;
        }
        public function bcollection($params = array()){     
                $params["group_by"]  =   'b.tc_from_bank';
                return  $this->bcollectionquery($params)->result();
        } 
        public function trn_collec_query($params){   
                $dmsg   =   '';
                $msg    =   ""; 
                $sgt    =   "d.donation_date";
                $fr     =   "`b`.`tc_from_bank`, `b`.`tc_date`";
                $frg   =   "`b`.`tc_to_bank`, `b`.`tc_date`"; 
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate   =   explode(" - ",$params["asate"]); 
                        $dmsg     =  "AND (d.donation_date >= '".date("Y-m-d",strtotime($asate['0']))."' AND d.donation_date <= '".date("Y-m-d",strtotime($asate['1']))."')";
                        $msg     =  "AND (b.tc_date >= '".date("Y-m-d",strtotime($asate['0']))."' AND b.tc_date <= '".date("Y-m-d",strtotime($asate['1']))."')";
                    }
                }   
                $spl    =   "SELECT count(d.donation_date) as cnt,d.donation_date as tc_date,'Collection' as mg_val,b.category,`b`.`bloodbank_name` as tbloodbank_name,'' as bloodbank_name FROM  `donation_details` as d  INNER JOIN `bloodbanks` as b ON `b`.`bloodbank_id` = `d`.`dbbloodbank_id` INNER JOIN `login` as l ON `b`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `b`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` WHERE `u`.`ut_open` = '1' AND `t`.`btype_open` = '1' AND  `l`.`login_open` = '1' AND `d`.`dbbloodbank_id` = '".$params['bloodbank']."' AND `d`.`mbbloodbank_id` = '".$params['bloodbank']."' AND d.donation_status='0' $dmsg GROUP By $sgt "
                        . " UNION ALL "
                        . "SELECT count(b.tc_date) as cnt, `tc_date`,'Collection from' as mg_val,k.category,`k`.`bloodbank_name` as bloodbank_name,`k1`.`bloodbank_name` as tbloodbank_name FROM  `transfer_collection` as b  INNER JOIN `bloodbanks` as k ON `k`.`bloodbank_id` = `b`.`tc_from_bank` INNER JOIN `login` as l ON `k`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `k`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` INNER JOIN `bloodbanks` as k1 ON `k1`.`bloodbank_id` = `b`.`tc_to_bank` INNER JOIN `login` as l1 ON `k1`.`blood_login_id` = `l1`.`login_id` INNER JOIN `bloodbank_type` as t1 ON `k1`.`blood_bank_type` = `t1`.`btype_id` INNER JOIN `usertype` as u1 ON `u1`.`ut_id` = `l1`.`login_type` WHERE `l`.`login_open` = '1' AND `l1`.`login_open` = '1' AND `b`.`tc_open` = '1' AND `u`.`ut_open` = '1' AND `t`.`btype_open` = '1' AND `u1`.`ut_open` = '1' AND `t1`.`btype_open` = '1' AND `b`.`tc_to_bank` = '".$params['bloodbank']."' $msg GROUP BY $fr
                    UNION ALL 
                    SELECT count(b.tc_date) as cnt, `tc_date`,'Transferred to' as mg_val,k.category,`k`.`bloodbank_name` as bloodbank_name,`k1`.`bloodbank_name` as tbloodbank_name FROM  `transfer_collection` as b  INNER JOIN `bloodbanks` as k ON `k`.`bloodbank_id` = `b`.`tc_from_bank` INNER JOIN `login` as l ON `k`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `k`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` INNER JOIN `bloodbanks` as k1 ON `k1`.`bloodbank_id` = `b`.`tc_to_bank` INNER JOIN `login` as l1 ON `k1`.`blood_login_id` = `l1`.`login_id` INNER JOIN `bloodbank_type` as t1 ON `k1`.`blood_bank_type` = `t1`.`btype_id` INNER JOIN `usertype` as u1 ON `u1`.`ut_id` = `l1`.`login_type` WHERE `l`.`login_open` = '1' AND `l1`.`login_open` = '1' AND `u`.`ut_open` = '1' AND `b`.`tc_open` = '1' AND `t`.`btype_open` = '1' AND `u1`.`ut_open` = '1' AND `t1`.`btype_open` = '1' AND `b`.`tc_from_bank` = '".$params['bloodbank']."' $msg GROUP BY $frg"; 
                $spl    .=  " ORDER BY tc_date DESC";       
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                       $spl .=  " LIMIT ".$params['start'].",".$params['limit'];
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $spl .=  " LIMIT ".$params['limit'];
                }      
                //echo $spl;exit;
                $tr     =   $this->db->query($spl)->result(); 
                return $tr;
        } 
        public function gtrn_collec_query($params){   
                $dmsg   =   '';
                $msg    =   ""; 
                $sgt    =   "d.donation_date";
                $fr     =   "`b`.`tc_from_bank`";
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate   =   explode(" - ",$params["asate"]); 
                        $dmsg     =  "AND (d.donation_date >= '".date("Y-m-d",strtotime($asate['0']))."' AND d.donation_date <= '".date("Y-m-d",strtotime($asate['1']))."')";
                        $msg     =  "AND (b.tc_date >= '".date("Y-m-d",strtotime($asate['0']))."' AND b.tc_date <= '".date("Y-m-d",strtotime($asate['1']))."')";
                    }
                }   
                $spl    =   "SELECT count(d.donation_date) as cnt,d.donation_date as tc_date,`b`.`bloodbank_id` as tbloodbank_name FROM  `donation_details` as d  INNER JOIN `bloodbanks` as b ON `b`.`bloodbank_id` = `d`.`dbbloodbank_id` INNER JOIN `login` as l ON `b`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `b`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` WHERE `u`.`ut_open` = '1' AND `t`.`btype_open` = '1' AND  `l`.`login_open` = '1'  AND `d`.`dbbloodbank_id` = '".$params['bloodbank']."' AND `d`.`mbbloodbank_id` = '".$params['bloodbank']."' AND `t`.`btype_name` LIKE 'BCTV (Blood Collection and Transportation Vehicles)'  AND d.donation_status='0' $dmsg GROUP By $sgt"
                        . " UNION ALL "
                        . "SELECT count(b.tc_date) as cnt,tc_date,`k1`.`bloodbank_id` as tbloodbank_name FROM  `transfer_collection` as b  INNER JOIN `bloodbanks` as k ON `k`.`bloodbank_id` = `b`.`tc_from_bank` INNER JOIN `login` as l ON `k`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `k`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` INNER JOIN `bloodbanks` as k1 ON `k1`.`bloodbank_id` = `b`.`tc_to_bank` INNER JOIN `login` as l1 ON `k1`.`blood_login_id` = `l1`.`login_id` INNER JOIN `bloodbank_type` as t1 ON `k1`.`blood_bank_type` = `t1`.`btype_id` INNER JOIN `usertype` as u1 ON `u1`.`ut_id` = `l1`.`login_type` WHERE `l`.`login_open` = '1' AND `l1`.`login_open` = '1' AND `b`.`tc_open` = '1' AND `u`.`ut_open` = '1' AND `t`.`btype_open` = '1' AND `u1`.`ut_open` = '1' AND `t1`.`btype_open` = '1' AND `t`.`btype_name` LIKE 'BCTV (Blood Collection and Transportation Vehicles)'  AND `b`.`tc_to_bank` = '".$params['bloodbank']."' $msg GROUP BY $fr";
                      
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                       $spl .=  " LIMIT ".$params['start'].",".$params['limit'];
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $spl .=  " LIMIT ".$params['limit'];
                }      
                //echo $spl;exit;
                $tr     =   $this->db->query($spl)->result(); 
                return $tr;
        }
        public function cnttrn_collec_query($params){
                return  count($this->trn_collec_query($params));
        }
        public function vtrn_collec_query($params){
               return  $this->trn_collec_query($params); 
        } 
        public function vrn_collec_query($params){ 
                $msg    =   "";  
                if(array_key_exists("asate",$params)){
                    if($params["asate"] != ""){
                        $asate   =   explode(" - ",$params["asate"]);  
                        $msg     =  "AND (b.tc_date >= '".date("Y-m-d",strtotime($asate['0']))."' AND b.tc_date <= '".date("Y-m-d",strtotime($asate['1']))."')";
                    }
                }   
                $spl    =   "SELECT count(b.tc_date) as cnt, `tc_date`,'Collection from' as mg_val,k.category,`k`.`bloodbank_name` as bloodbank_name,`k1`.`bloodbank_name` as tbloodbank_name FROM  `transfer_collection` as b  INNER JOIN `bloodbanks` as k ON `k`.`bloodbank_id` = `b`.`tc_from_bank` INNER JOIN `login` as l ON `k`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `k`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` INNER JOIN `bloodbanks` as k1 ON `k1`.`bloodbank_id` = `b`.`tc_to_bank` INNER JOIN `login` as l1 ON `k1`.`blood_login_id` = `l1`.`login_id` INNER JOIN `bloodbank_type` as t1 ON `k1`.`blood_bank_type` = `t1`.`btype_id` INNER JOIN `usertype` as u1 ON `u1`.`ut_id` = `l1`.`login_type` WHERE `l`.`login_open` = '1' AND `l1`.`login_open` = '1' AND `b`.`tc_open` = '1' AND `u`.`ut_open` = '1' AND `t`.`btype_open` = '1' AND `u1`.`ut_open` = '1' AND `t1`.`btype_open` = '1' AND `b`.`tc_to_bank` = '".$params['bloodbank']."' $msg GROUP BY `b`.`tc_from_bank` "; 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                       $spl .=  " LIMIT ".$params['start'].",".$params['limit'];
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $spl .=  " LIMIT ".$params['limit'];
                }      
//                echo $spl;
                return $this->db->query($spl)->result(); 
        }
}