<?php
class Camp_model extends CI_Model{
		public function create_camp(){
                        if($this->session->userdata("login_parent") == "1"){
                                $alp  	= 	$this->input->post("camp_bank");
                        }
                        else{
                                $alp 	= 	$this->blood_bank_model->get_val($this->session->userdata("login_id"));
                        }
                        $dt 	=	array(
                                "camp_bank_id"		=>	$alp,
                                "camp_date"		=>	date("Y-m-d",strtotime($this->input->post("camp_date"))),
                                "camp_description"	=>	$this->input->post("camp_msg"),
                                "camp_created_on"	=>	date("Y-m-d h:i:s"),
                                "camp_created_by"	=>	$this->session->userdata("login_id"),
                        );
                        $this->db->insert("camps",$dt);
                        return $this->db->insert_id();
		}
		public function update_camp($uri){
                        if($this->session->userdata("login_parent") == "1"){
                                $alp  	= 	$this->input->post("camp_bank");
                        }
                        else{
                                $alp 	= 	$this->blood_bank_model->get_val($this->session->userdata("login_id"));
                        }
                        $dt 	=	array(
                                "camp_bank_id"		=>	$alp,
                                "camp_date"		=>	date("Y-m-d",strtotime($this->input->post("camp_date"))),
                                "camp_description"	=>	$this->input->post("camp_msg"),
                                "camp_created_on"	=>	date("Y-m-d h:i:s"),
                                "camp_created_by"	=>	$this->session->userdata("login_id"),
                        );
                        $this->db->update("camps",$dt,array("camp_id" => $uri));
                        return $this->db->affected_rows();
		}
                public function get_query(){ 
                        $dt     =   array(
                            "u.ut_open"     =>  "1",
                            "t.btype_open"  =>  "1"
                        );
                        $vsop   =  $this->db->select("s.*,a.*")
                                            ->from("camps as s")
                                            ->join("bloodbanks as a","s.camp_bank_id = a.bloodbank_id","INNER")
                                            ->join("login as l","a.blood_login_id = l.login_id","INNER")
                                            ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                            ->join("bloodbank_type as t","a.blood_bank_type = t.btype_id","INNER")
                                            ->where('l.login_open',"1")
                                            ->where($dt);
                        return $vsop;
                }
		public function view_camps($params = array()){	 
                        if(array_key_exists("keywords",$params)){
                            $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR camp_description LIKE '%".$params['keywords']."%' OR camp_date  LIKE '%".$params['keywords']."%')");
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        } 
                        if($this->session->userdata("login_parent") == "2"){ 
                                $alp 	= 	$this->blood_bank_model->get_val($this->session->userdata("login_id"));
                                $this->db->where("s.camp_bank_id",$alp);						
                        } 
//                        $this->get_query()->get();echo $this->db->last_query();exit;
                        return $this->get_query()->get()->result();
		}
		public function fe_camps(){	
                        if($this->session->userdata("login_parent") == "2"){ 
                                $alp 	= 	$this->blood_bank_model->get_val($this->session->userdata("login_id"));
                                $this->db->where("s.camp_bank_id",$alp);						
                        } 
                        $this->db->where("s.camp_activate","1"); 
                        $this->db->order_by("s.camp_id");
                        return $this->get_query()->get()->result();
		}
		public function get_camps($id){
                        if($this->session->userdata("login_parent") == "2"){ 
                                $alp 	= 	$this->blood_bank_model->get_val($this->session->userdata("login_id"));
                                $this->db->where("s.camp_bank_id",$alp);						
                        }
                        $this->db->where("s.camp_id",$id);						 
                        return $this->get_query()->get()->row();
		}
		public function sent_sms($id,$data_value){
				$dt 	=  array(
						"cmp_msg_id"		=>	$id,
						"cmp_mobile_no"		=>	$data_value,
						"cmp_sent_time"		=>	date("Y-m-d h:i:s")
				);
				$this->db->insert("camp_sent_sms",$dt);				
				return $this->db->insert_id();
		}
		public function camp_active(){
				$dt 	=  array( 
						"camp_activate"		=>	$this->input->post("stu")
				);
				$this->db->update("camps",$dt,array("camp_id" => $this->input->post("camp_id")));				
				return $this->db->affected_rows();
		}
                public function camp_report_query($params    =   array()){
                        $dt     =   array(
                                        "u.ut_open"     =>  "1",
                                        "t.btype_open"  =>  "1"
                                    );
                        if($this->session->userdata("login_type") == '3utype'){
                                $this->version2_model->get_bloodbanks();
                        }
                        $this->db->select("count(a.camp_name) as cnt,d.*,b.*")
                                ->from("donation_details as a")
                                ->join("camps as d","a.camp_name = d.camp_id","INNER")
                                ->join("bloodbanks as b","b.bloodbank_id= d.camp_bank_id","INNER") 
                                ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                ->where('l.login_open',"1")
                                ->where($dt);
                        $this->db->group_by("d.camp_id");                          
                        if(array_key_exists("keywords",$params)){
                                $this->db->where("(b.bloodbank_name LIKE '%".$params['keywords']."%' OR d.camp_description LIKE '%".$params['keywords']."%' OR b.district  LIKE '%".$params['keywords']."%'  OR b.city  LIKE '%".$params['keywords']."%')");
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        } 
//                         $this->db->get();echo $this->db->last_query();exit;
                        return $this->db->get();
                }
                public function cntcamp_reports($params    =   array()){
                        $this->camp_report_query($params);
                        $subQuery =  "(".$this->db->last_query().") as d";
                        $this->db->select("count(*) as cnt");
                        $this->db->from($subQuery); 
                        $vsp    =   $this->db->get()->row();
                        return $vsp->cnt;
		}
		public function camp_reports($params    =   array()){  
                        return $this->camp_report_query($params)->result();
		}
                public function bcamp_report_query($params    =   array()){ 
						
                        $dt     =   array(
                                        "u.ut_open"     =>  "1",
                                        "t.btype_open"  =>  "1"
                                    );
                        if($this->session->userdata("login_type") == '3utype'){
                                $this->version2_model->get_bloodbanks();
                        }
                        $this->db->select("count(s.camp_bank_id) as cnt,b.*");
                        $this->db->from("bloodbanks as b");
                        $this->db->join("camps as s","s.camp_bank_id = b.bloodbank_id","INNER")
                                ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER") 
                                ->where('l.login_open',"1")
                                ->where($dt); 
                        $this->db->group_by("s.camp_bank_id");                     
                        if(array_key_exists("keywords",$params)){
                                $this->db->where("(b.bloodbank_name LIKE '%".$params['keywords']."%' OR b.district  LIKE '%".$params['keywords']."%'  OR b.city  LIKE '%".$params['keywords']."%')");
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        } 
                        if(array_key_exists("blood_category",$params)){
                               $this->db->where("category LIKE '%".$params['blood_category']."%'");
                        }
                        if(array_key_exists("bloodbank_type",$params)){
                               $this->db->where("btype_name LIKE '%".$params['bloodbank_type']."%'");
                        }
                        if(array_key_exists("asate",$params)){
                            if($params["asate"] != ""){
                                $asate    =   explode(" - ",$params["asate"]);
                                $this->db->where("(s.camp_date >= '".$asate['0']."' AND s.camp_date <= '".$asate['1']."')");
                            }
                        }            
                        $this->db->order_by("cnt","DESC");
                        return $this->db->get();
                }
                public function cntbcamp_reports($params    =   array()){
                        $this->bcamp_report_query($params);
                        $subQuery =  "(".$this->db->last_query().") as d";
                        $this->db->select("count(*) as cnt");
                        $this->db->from($subQuery); 
                        $vsp    =   $this->db->get()->row();
                        return $vsp->cnt;
		}
		public function bcamp_reports($params    =   array()){  
		            //$this->bcamp_report_query($params);echo $this->db->last_query();exit;
                        return $this->bcamp_report_query($params)->result();
		}  
                public function blood_camp($uri){
                        $csp    =   $this->get_query()
                                ->where("s.camp_bank_id",$uri)->get()->result();
                        return  $csp;
                }
                public function get_fequery(){ 
                        $dt     =   array(
                            "u.ut_open"     =>  "1",
                            "t.btype_open"  =>  "1"
                        );
                        $this->db->select("s.*,trim(a.state) as state,trim(a.district) as district,trim(a.city) as city,a.bloodbank_id,a.new_bloodbank,a.bloodbank_name,a.address,a.pincode,a.contact_no,a.fax_no,a.lattitude,a.longitude,a.bloodbank_url,a.bbmobile as mobile,a.email_id,a.service_time,a.category,a.blood_component,a.blood_bank_code")
                                            ->from("camps as s")
                                            ->join("bloodbanks as a","s.camp_bank_id = a.bloodbank_id","INNER")
                                            ->join("login as l","a.blood_login_id = l.login_id","INNER")
                                            ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                            ->join("bloodbank_type as t","a.blood_bank_type = t.btype_id","INNER")
                                            ->where($dt)
                                            ->where("s.camp_date >",date("Y-m-d"))
                                            ->where('l.login_open',"1")
                                            ->where("s.camp_activate","1");
                                         //   $this->db->get();echo $this->db->last_query();exit;
                    if($this->input->post("page") != ''){
                        $this->db->limit($this->config->item('page_limit'),$this->config->item('page_limit')*$this->input->post("page"));
                    }
                    $vsop   =   $this->db->order_by("s.camp_id","DESC")->get()->result();
                    return $vsop;
            }
            public function cmp_query($params = array()){ 
                    if(array_key_exists("asates",$params)){
                            $this->db->where("s.camp_date >",date("Y-m-d"));
                    }
                    if(array_key_exists("asate",$params)){
                            if($params["asate"] != ""){
                                $asate    =   explode(" - ",$params["asate"]);
                                $this->db->where("(s.camp_date >= '".$asate['0']."' AND s.camp_date <= '".$asate['1']."')");
                            } 
                    }
                    if(array_key_exists("bloodbank",$params)){
                        $this->db->where("s.camp_bank_id",$params["bloodbank"]);						
                    } 
                    if(array_key_exists("blood_category",$params)){
                           $this->db->where("category LIKE '%".$params['blood_category']."%'");
                    }
                    if(array_key_exists("keywords",$params)){
                            $this->db->where("(a.bloodbank_name LIKE '%".$params['keywords']."%' OR a.district  LIKE '%".$params['keywords']."%'  OR a.city  LIKE '%".$params['keywords']."%' OR s.camp_description LIKE '%".$params['keywords']."%' OR DATE_FORMAT(s.camp_date,'%d %M %Y') LIKE '%".$params['keywords']."%')");
                    }
                    
                    if(array_key_exists("blood_bank_type",$params)){
                            $this->db->where("(t.btype_name LIKE '".$params['blood_bank_type']."')");
                    } 
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit']);
                    } 
                    $this->db->where("s.camp_activate","1"); 
                    return $this->get_query()->get(); 
            }
            public function cntcmp_query($params = array()){
                    return  count($this->cmp_query($params)->result());
            }
            public function viewcmp_query($params = array()){
                    return  $this->cmp_query($params)->result();
            }
}