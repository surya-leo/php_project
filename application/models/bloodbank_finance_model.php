<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bloodbank_finance_model extends CI_Model{
        public function finance_query(){
                $ft     =   array(
                                        "u.ut_open"     => "1",
                                        "t.btype_open"  => "1",
                                        "b.blood_login_id"  =>  $this->session->userdata("login_id")
                                    );
                $vsp    =   $this->db->select("bfin_balance")
                                    ->from("bloodbank_finance")
                                    ->join("bloodbanks as b","b.bloodbank_id = bloodbank_finance.bfin_bloodbank_id","INNER")
                                    ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->where('l.login_open',"1")
                                    ->where($ft)->get()->row();
                if(count($vsp) == 0){  
                        $th     =   array(
                            "bfin_id"               =>  $this->common_model->get_variable("bloodbank_finance")."bfn",
                            "bfin_balance"          =>  "0",
                            "bfin_bloodbank_id"     =>  $this->blood_bank_model->get_val(),
                            "bfin_updated_by"       =>  $this->session->userdata("login_id"),
                            "bfin_updated_on"       =>  date("Y-m-d h:i:s"),
                        );
                        $this->db->insert("bloodbank_finance",$th); 
                        return  "0";
                }else{
                        return $vsp->bfin_balance;
                }
        }
        public function update_finance(){
                $vsp    =   $this->finance_query();
                if($this->input->post("debit_credit") == "Debited"){
                    $price  =   $vsp+$this->input->post("price");
                }else{
                    $price  =   $vsp-$this->input->post("price");
                }
                $dta    =   array(
                        "fin_id"            =>   $this->common_model->get_variable("finance_details")."fnd",
                        "fin_date"          =>   $this->input->post("donation_date"),
                        "fin_bb_id"         =>   $this->blood_bank_model->get_val(),
                        "fin_debit_credit"  =>   $this->input->post("debit_credit"),
                        "fin_description"   =>   $this->input->post("description"),
                        "fin_amount"        =>   $this->input->post("price"),
                        "fin_price"         =>   $price,
                        "fin_bfre_price"    =>   $vsp,
                        "fin_after_price"   =>   $price,
                        "fin_created_by"    =>   $this->session->userdata("login_id"),
                        "fin_created_on"    =>   date("Y-m-d h:i:s")
                );
                $this->db->insert("finance_details",$dta);
                $th     =   array( 
                                    "bfin_balance"          =>  $price,
                                    "bfin_bloodbank_id"     =>  $this->blood_bank_model->get_val(),
                                    "bfin_updated_by"       =>  $this->session->userdata("login_id"),
                                    "bfin_updated_on"       =>  date("Y-m-d h:i:s"),
                            ); 
                $this->db->update("bloodbank_finance",$th);
                return  TRUE;
        }
        public function definance_query($params    =   array()){
                $ft     =   array(
                                        "u.ut_open"     => "1",
                                        "t.btype_open"  => "1",
                                        "b.blood_login_id"  =>  $this->session->userdata("login_id")
                                    );
                if(array_key_exists("cnt",$params)){
                    $sel    =   "count(*) as cnt";
                } else {
                    $sel    =   "*";
                }
                $this->db->select("$sel")
                                    ->from("finance_details")
                                    ->join("bloodbanks as b","b.bloodbank_id = finance_details.fin_bb_id","INNER")
                                    ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->where('l.login_open',"1")
                                    ->where($ft);
                if(array_key_exists("keywords",$params)){
                    $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR fin_bfre_price LIKE '%".$params['keywords']."%' OR fin_after_price LIKE '%".$params['keywords']."%' OR fin_debit_credit LIKE '%".$params['keywords']."%' OR fin_amount LIKE '%".$params['keywords']."%' OR fin_price LIKE '%".$params['keywords']."%' OR fin_date LIKE '%".$params['keywords']."%')");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }        
                $this->db->order_by("finance_details.id","DESC");
                return $this->db->get();
        }
        public function cntview_finance($params    =   array()){
                $params["cnt"]  =   "1";
                $vsp    =   $this->definance_query($params)->row();
                if(count($vsp) > 0){
                        return $vsp->cnt;
                }
                return "0";
        }
        public function view_finance($params    =   array()){
                return  $this->definance_query($params)->result();
        }
        public function getfinancequery($params = array()){
            $ft     =   array(
                                "u.ut_open"     => "1",
                                "t.btype_open"  => "1"
                        );
            $sel    =   "*";
            if(array_key_exists("cnt",$params)){
                    $sel    =   "count(*) as cnt";
            }
            $this->db->select("$sel")
                        ->from("bloodbank_finance")
                        ->join("bloodbanks as b","b.bloodbank_id = bloodbank_finance.bfin_bloodbank_id","INNER")
                        ->join("login as l","b.blood_login_id = l.login_id","INNER")
                        ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->where('l.login_open',"1")
                        ->where($ft); 
            if(array_key_exists("keywords",$params)){
                $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR bfin_balance LIKE '%".$params['keywords']."%')");
            }
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
            }  
            $this->db->order_by("b.bloodbank_name","ASC");
            return  $this->db->get();
        }
        public function cntview_financereprts($params    =   array()){
                $params["cnt"]  =   "1";
                $vsp    =   $this->getfinancequery($params)->row();
                if(count($vsp) > 0){
                        return $vsp->cnt;
                }
                return "0";
        }
        public function view_financereports($params    =   array()){
                return  $this->getfinancequery($params)->result();
        }
}