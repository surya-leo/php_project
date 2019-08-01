<?php 
class Common_model extends CI_Model{
		public function view_states(){
				$this->db->order_by("state_name","ASC");
				$st 	=	$this->db->get("state");
				return $st->result();
		}
		public function district(){
				$this->db->order_by("district_name","ASC");
				$this->db->where("district_name != '-'");
				if($this->input->post("cstate") != ""){
						$st 	=	$this->db->get_where("district",array("state_id" => $this->input->post("cstate")));
				}else{
						$st 	=	$this->db->get_where("district",array("state_id" => 1));
				}
				return $st->result();
		}
		public function city(){
				$this->db->order_by("city_name","ASC");
				if($this->input->post("district") != ""){
					$st 	=	$this->db->get_where("city",array("district_id" => $this->input->post("district")));
				}else{
					$st 	=	$this->db->get_where("city");
				}
				return $st->result();
		}
                public function get_city($uri){
                        return  $this->db->select("city.*")
                                            ->from("city")
                                            ->join("district","district.district_id = city.district_id","INNER")
                                            ->where("district.district_name",$uri)
                                            ->get()->result();
                }
		public function change_password(){
				$dat 	=	array("login_password" => md5($this->input->post("new_pass")));
				$this->db->update("login",$dat,array("login_email" => $this->session->userdata("login_email")));
				//echo $this->db->last_query();exit;
				if($this->db->affected_rows() >0 ){
						return 1;
				}else{
						return 0;
				}
		}
		public function users($params){
                        $this->db->select("d.*,a.*")
                                    ->from("device as d")
                                    ->join("donor_registration_app as a","a.phone = d.mobile","LEFT")
                                    ->order_by("d.device_id","DESC");
                        if(array_key_exists("keywords",$params)){
                            $this->db->where("(a.phone LIKE '%".$params['keywords']."%' OR a.name LIKE '%".$params['keywords']."%' OR a.age LIKE '%".$params['keywords']."%' OR a.location LIKE '%".$params['keywords']."%' Or a.blood_group LIKE '%".$params['keywords']."%')");
                        } 
                        $this->db->order_by("d.device_id","DESC"); 
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        }                              
                        $pr = $this->db->get(); 
                        if($this->db->affected_rows() > 0){
                                        return $pr->result();
                        }else{
                                        return array();
                        }
					
		}
		public function get_det(){
                        $this->db->select("d.*,a.*")
                                        ->from("device as d")
                                        ->join("donor_registration_app as a","a.phone = d.mobile","LEFT")
                                        ->where("d.mobile",$this->input->post("mob")); 
                        $pr = $this->db->get();
//                         echo $this->db->last_query();exit;
                        if($this->db->affected_rows() > 0){
                                $val =  $pr->row();
                                $pos = strpos($val->blood_group, "ve");
                                if($pos == ""){
                                                $valp = $val->blood_group."ve";	
                                }else{
                                                $valp = $val->blood_group;
                                }
                                return $val->name."@@".substr($val->sex,0,1)."@@".$valp."@@0"."@@".$val->donor_id;
                        }else{
                                if($this->session->userdata("login_parent") == '2'){
                                    $id     =   $this->session->userdata("login_id");
                                    $vgp    =   $this->blood_bank_model->edit_blood($id);
                                    return "@@@@@@1@@".$vgp->blood_bank_code;
                                }else{
                                    $id     =   $this->input->post("blood_camp");
                                    $vgp    =   $this->blood_bank_model->edit_blood($id);
                                    return "@@@@@@1@@".$vgp->blood_bank_code;
                                }
                                return "@@@@@@@@";
                        }					
		}
                public function report_query($params    =   array()){
                        $dt     =   array(
                                "u.ut_open"     =>  "1",
                                "t.btype_open"  =>  "1"
                        );
                        if($this->session->userdata("login_type") == '3utype'){
                                $this->version2_model->get_bloodbanks();
                        }
                        $this->db->select("count(d.dbbloodbank_id) as cnt,a.*");
                        $this->db->from("bloodbanks as a")
                                ->join("login as l","a.blood_login_id = l.login_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->join("bloodbank_type as t","a.blood_bank_type = t.btype_id","INNER")
                                ->join("donation_details as d","a.bloodbank_id = d.dbbloodbank_id","INNER") 
                                ->where('l.login_open',"1")
                                ->where($dt);
                       if(array_key_exists("asate",$params)){
                            if($params["asate"] != ""){
                                $asate    =   explode(" - ",$params["asate"]);
                                $this->db->where("(d.donation_date >= '".$asate['0']."' AND d.donation_date <= '".$asate['1']."')");
                            }
                        } 
                        if(array_key_exists("district",$params)){
                            if($params["district"] != ""){ 
                                $this->db->where("a.district",$params["district"]);
                            }
                        } 
                        if(array_key_exists("keywords",$params)){
                                $this->db->where("(d.donation_date LIKE '%".$params['keywords']."%' OR a.bloodbank_name LIKE '%".$params['keywords']."%' OR  a.district LIKE '%".$params['keywords']."%' OR  a.city LIKE '%".$params['keywords']."%')");
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        } 
                        $this->db->group_by("d.dbbloodbank_id");
                        return $this->db->get();
                }
                public function cntreports($params    =   array()){
                        $this->report_query($params);
                        $subQuery =  "(".$this->db->last_query().") as d";
                        $this->db->select("count(*) as cnt");
                        $this->db->from($subQuery); 
                        $vsp    =   $this->db->get()->row();
                        return $vsp->cnt;
		}
		public function reports($params    =   array()){  
                        return $this->report_query($params)->result();
		} 
                public function ceeports($params = array()){
				$this->db->select("count(d.dbbloodbank_id) as cnt,a.bloodbank_name,a.district,a.city");
				$this->db->from("bloodbanks as a");
				$this->db->join("donation_details as d","a.bloodbank_id = d.dbbloodbank_id","INNER");
				$first_date		= 	date("Y-m-d", strtotime("-1 months"));
				$second_date 	=	date("Y-m-d");
				$this->db->where('d.donation_date >=', $first_date);
				$this->db->where('d.donation_date <=', $second_date);
				$this->db->group_by("d.dbbloodbank_id");
                                if(array_key_exists("district",$params)){
                                    if($params["district"] != ""){
                                            $this->db->where("(trim(a.district) LIKE '".trim($params['district'])."')");
                                    }
                                }
				$this->db->order_by("cnt","DESC");
//                                $this->db->get();echo $this->db->last_query();exit;
				return $this->db->get()->result();
		}
		public function view_blooddonor(){ 
				$this->db->select("count(d.donor_id) as cnt,a.bloodbank_name,a.district,a.city");
				$this->db->from("bloodbanks as a");
				$this->db->join("donation_details as d","a.bloodbank_id = d.dbbloodbank_id","INNER"); 
				$this->db->where("(d.donation_date >=".date('Y-m-d',strtotime("-1 month"))." AND d.donation_date >=".date('Y-m-d').")");
				$this->db->group_by("d.dbbloodbank_id"); 
				$this->db->order_by("cnt","DESC");
				return $this->db->get()->result();
		}
		public function sview_blooddonor(){ 
				$this->db->select("count(d.donor_id) as cnt,a.district");
				$this->db->from("bloodbanks as a");
				$this->db->join("donation_details as d","a.bloodbank_id = d.dbbloodbank_id","INNER"); 
				$this->db->where("(d.donation_date >=".date('Y-m-d',strtotime("-1 month"))." AND d.donation_date >=".date('Y-m-d').")");
				$this->db->group_by("a.district"); 
				$this->db->order_by("cnt","DESC");
				return $this->db->get()->result();
		}
		public function greports($conditions){
                        $qu     =       $this->common_model->reports($conditions);
                        $bi_ar	=	array();
                        if(count($qu) > 0){
                                $valp 	=	"";
                                foreach($qu as $bik){
                                                $valp .= "bloodbank_id != ".$bik->bloodbank_id." and "; 
                                }
                                $valp = substr($valp,0,-4);
                                $this->db->select("bloodbank_name,state,district,city,address,mobile,email_id,contact_no,category");
                                $this->db->where("(".$valp.")");
                                $vp = $this->db->get("bloodbanks");//->result();
                                return $vp;
                        } 
		} 
        public function get_variable($tbl){
                $this->db->select("max(id) as maxid");
                $valp 	=	$this->db->get($tbl)->row();
                return $valp->maxid+1;
        }
}