<?php
class Blood_bank_model extends CI_Model{
		public function register(){
                        $em         =   explode(",",$this->input->post("email"));
                        $login		=	array(
                                "login_email"		=>	$em["0"],
                                "login_type"		=>	$this->version2_model->check_type($this->input->post("login_type")),
                                "login_password"        =>	md5("123456"),
                                "login_parent"          =>      "2"
                        );
                        $this->db->insert("login",$login);
                        $login      =       $this->db->insert_id();
                        $bloodbanks		=	array(
                                "blood_login_id"	=>	$login,
                                "bloodbank_name"	=>	$this->input->post("blood_bank_name"),
                                "address"		=>	$this->input->post("blood_bank_addr"),
                                "state"			=>	'Andhra Pradesh',
                                "district"		=>	trim($this->input->post("district")),
                                "city"			=>	trim($this->input->post("city")),
                                "pincode"		=>	$this->input->post("pincode"),
                                "contact_no"		=>	$this->input->post("contact_no"),
                                "bbmobile"		=>	$this->input->post("mobile_no"),
                                "fax_no"		=>	$this->input->post("fax_no"),
                                "bloodbank_url"		=>	$this->input->post("website"),
                                "email_id"		=>	$this->input->post("email"),
                                "lattitude"		=>	$this->input->post("latitude"),
                                "longitude"		=>	$this->input->post("longitude"),
                                "category"		=>	$this->input->post("category"),
                                "blood_bank_type"	=>	$this->input->post("blood_bank_type"),
                                "blood_bank_code"	=>	$this->input->post("blood_bank_code"),
                                "blood_component"       =>	$this->input->post("blood_component"),
                                "assign_bloodbanks"     =>	$this->input->post("assign_bloodbank")?implode(",",$this->input->post("assign_bloodbank")):""
                        );
                        $this->db->insert("bloodbanks",$bloodbanks);
                        $blood  =   $this->version2_model->blood_comp();
                        $vsp    =   $this->db->insert_id();
                        foreach ($blood as $bd){
                            $this->db->insert("out_blood_availability",array("out_component" => $bd->bc_id,"out_bloodbank_id" => $vsp));
                        }
                        $th     =   array(
                                "bfin_id"               =>  $this->common_model->get_variable("bloodbank_finance")."bfn",
                                "bfin_balance"          =>  "0",
                                "bfin_bloodbank_id"     =>  $vsp,
                                "bfin_updated_by"       =>  $this->session->userdata("login_id"),
                                "bfin_updated_on"       =>  date("Y-m-d H:i:s"),
                        );
                        $this->db->insert("bloodbank_finance",$th);
                        $gtb = array(
                                "outb_bloodbank_id"     =>  $vsp,    
                                "outb_updated_on"       =>  date("Y-m-d H:i:s")
                        );
                        $this->db->insert("out_blood_collection",$gtb);
                        return $vsp;
		}
		public function update_form($id){ 
                        $valp   =   $this->blood_bank_model->edit_blood($id);
                        if($this->input->post("login_type") != ''){
                        $login		=	array( 
                            "login_type"		=>	$this->version2_model->check_type($this->input->post("login_type")) 
                        );   
                        
                        $this->db->update("login",$login,array("login_id" => $id));
                        $vsp    =   $this->db->affected_rows();
		            }
                        $bloodbanks		=	array(
                                "bloodbank_name"        =>	$this->input->post("blood_bank_name"),
                                "address"		=>	$this->input->post("blood_bank_addr"),
                                "state"			=>	trim($this->input->post("staten")),
                                "district"		=>	trim($this->input->post("district")),
                                "city"			=>	trim($this->input->post("city")),
                                "pincode"		=>	$this->input->post("pincode"),
                                "contact_no"		=>	$this->input->post("contact_no"),
                                "bbmobile"		=>	$this->input->post("mobile_no"),
                                "fax_no"		=>	$this->input->post("fax_no"),
                                "bloodbank_url"		=>	$this->input->post("website"),
                                "email_id"		=>	$this->input->post("email"),
                                "lattitude"		=>	$this->input->post("latitude"),
                                "longitude"		=>	$this->input->post("longitude"),
                                "category"		=>	$this->input->post("category"),
                                "blood_bank_type"	=>	$this->input->post("blood_bank_type"),
                                "blood_bank_code"	=>	$this->input->post("blood_bank_code"),
                                "blood_component"	=>	$this->input->post("blood_component"),
                                "assign_bloodbanks"     =>	$this->input->post("assign_bloodbank")?implode(",",$this->input->post("assign_bloodbank")):""
                        );
                        $this->db->update("bloodbanks",$bloodbanks,array("blood_login_id" => $id));
                        $dsp    =   $this->db->affected_rows();
                        if($dsp || $vsp){
                            return "1";
                        }
                        return 0;
		}
                public function get_bloodquery(){
                        $dt     =   array(
                                        "u.ut_open"     => "1",
                                        "l.login_open"  =>  '1',
                                        "t.btype_open"  => "1"
                                    );
                        return  $this->db->select("*")
                                        ->from("login as l")
                                        ->join("bloodbanks as b","b.blood_login_id = l.login_id","INNER")
                                        ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                        ->where($dt);
                }
		public function ve_blood($id){
                        $this->db->where("b.bloodbank_id",$id);
                        return $this->get_bloodquery()->get()->row();
		}
		public function edit_blood($id){
                        $this->db->where("l.login_id",$id);
                        return $this->get_bloodquery()->get()->row();
		}
		public function view_blood($params = array()){
                        $dt     =   array(
                                      "u.ut_open"     => "1",
                                        "l.login_open"  =>  '1',
                                      "t.btype_open"  => "1"
                                  );
                        
                        if($this->session->userdata("login_type") != '5utype'){
                                $vspa    =   $this->get_bloodquery()->where("login_id",$this->session->userdata("login_id"))->get()->row();
                                $this->version2_model->get_assignbanks($vspa);
                        }  
                        if($this->session->userdata("login_type") == '3utype'){
                                $this->version2_model->get_bloodbanks();
                        }
                        $this->db->select("*")
                                      ->from("login as l")
                                      ->join("bloodbanks as b","b.blood_login_id = l.login_id","INNER")
                                      ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                      ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                      ->where($dt);
                        if(array_key_exists("blodbankid",$params)){ 
                                $this->db->where("bloodbank_id !=",$params['blodbankid']);
                        }
                        if(array_key_exists("assign_bloodbanks",$params)){ 
                                $this->db->where("(b.assign_bloodbanks LIKE '%".$params['assign_bloodbanks']."%')");
                        }
                        if(array_key_exists("uri",$params)){ 
                                $this->db->where("t.btype_name",$params['uri']);
                        }
                        if(array_key_exists("blood_category",$params)){
                               $this->db->where("category LIKE '%".$params['blood_category']."%'");
                        }
                        if(array_key_exists("keywords",$params)){
                            $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR district LIKE '%".$params['keywords']."%' OR  city LIKE '%".$params['keywords']."%' OR contact_no LIKE '%".$params['keywords']."%' OR bbmobile LIKE '%".$params['keywords']."%' OR email_id LIKE '%".$params['keywords']."%' OR category LIKE '%".$params['keywords']."%')");
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        }               
                        $this->db->order_by("district","ASC");  
                        //$this->db->get();echo $this->db->last_query();exit;
                        return $this->db->get()->result();
		}
		public function ctbloodbanks($params = array()){
                        $dt     =   array(
                                        "u.ut_open"     => "1",
                                        "l.login_open"  =>  '1',
                                        "t.btype_open"  => "1"
                                    );
                        $this->db->select("count(*) as cnt_bank")
                                      ->from("login as l")
                                      ->join("bloodbanks as b","b.blood_login_id = l.login_id","INNER")
                                      ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                      ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                      ->where($dt); 
                        if(array_key_exists("uri",$params)){ 
                              $this->db->where("t.btype_name",$params['uri']);
                        }
                        if(array_key_exists("blood_category",$params)){
                               $this->db->where("category LIKE '%".$params['blood_category']."%'");
                        }
                        if(array_key_exists("keywords",$params)){
                            $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR district LIKE '%".$params['keywords']."%' OR  city LIKE '%".$params['keywords']."%' OR contact_no LIKE '%".$params['keywords']."%' OR bbmobile LIKE '%".$params['keywords']."%' OR email_id LIKE '%".$params['keywords']."%' OR category LIKE '%".$params['keywords']."%')");
                        }
                        return  $this->db->get()->row();
		} 
		public function ctdonation_details(){
				// $this->db->select("count(distinct donor_id) as cnt_donor");
				// return $this->db->get("donation_details")->row();
                return $this->donation_query(array("columns" => "count(distinct donor_id) as cnt_donor","daterange" => date("Y-m-d",strtotime('-1 month'))." - ".date("Y-m-d")))->get()->row();
                // return $this->donation_query(array("columns" => "count(distinct donor_id) as cnt_donor"))->get()->row();
		}
		public function cnt_volume(){ 
                return $this->donation_query(array("columns" => "sum(d.volume) as cnt_volume","daterange" => date("Y-m-d",strtotime('-1 month'))." - ".date("Y-m-d")))->get()->row();
		}
		public function app_count(){
				$this->db->select("app_count");
				return $this->db->get_where("app_download",array("app_id" => "1"))->row();
		}
		public function update_app(){
				return $this->db->update("app_download",array("app_count" => $this->input->post("app_count")),array("app_id" => "1"));
		}
		public function cnt_camps(){
				$this->db->select("count(*) as cnt_camps");
				return $this->db->get("camps")->row();
		}
                public function cnt_users(){
                        $this->db->select("count(*) as cnt_users")
                                        ->from("device as d")
                                        ->join("donor_registration_app as a","a.phone = d.mobile","LEFT"); 
                        $pr = $this->db->get();
                        if($this->db->affected_rows() > 0){
                                        return $pr->row();
                        }else{
                                        return array();
                        } 	
		} 
                public function register_blooddonor(){ 
                        if($this->session->userdata("login_parent") == "1"){
                                $alpl  = $this->input->post("blood_name");
                        }
                        else{
                                $alpl  =  $this->session->userdata("login_id");
                        }
                        $vgp    =   $this->blood_bank_model->edit_blood($alpl); 
                        $alp    =   $vgp->bloodbank_id;
                        $vsp    =   $this->getdonorid($this->input->post("donor_id"),$this->input->post("mobile")); 
                        if(count($vsp) > 0){
                                $vdsp    =  $this->input->post("donor_id");
                        }else{
                                $vdsp    =  $vgp->blood_bank_code.$this->input->post("donor_id");
                        } 
                        $bloodbanks		=	array(
                                        "donor_id"		=>	$vdsp,
                                        "mobile"		=>	$this->input->post("mobile"),
                                        "name"			=>	$this->input->post("dname"),
                                        "sex"			=>	$this->input->post("sex"),
                                        "blood_group"		=>	$this->input->post("blood_group"),
                                        "volume"		=>	"1",
                                        "donation_date"		=>	$this->input->post("donation_date"),
                                        "camp_name"		=>	$this->input->post("camp_name"), 
                                        "dbbloodbank_id"	=>	$alp,
                                        "mbbloodbank_id"	=>	$alp
                        );
                        $this->db->insert("donation_details",$bloodbanks);
                        return $this->db->insert_id();
		}
		public function get_val(){ 
			$val =      $this->get_bloodquery()
                                        ->where("l.login_id",$this->session->userdata("login_id"))
                                        ->get()->row();
                        return      $val->bloodbank_id;
		}
		public function get_bookval(){ 
			$val =      $this->get_bloodquery()
                                        ->where("l.login_id",$this->session->userdata("login_id"))
                                        ->get()->row();
                        return      $val->bloodbank_id;
		}
		public function view_change_distr($uri){ 
			$val =      $this->get_bloodquery()
                                        ->where("b.district",$uri) 
                                        ->get()->result();
                        return $val;
		}
		public function cntview_blooddonor($params = array()){
                        $params["cnt"]  =   "1";
                        $vsp    =   $this->donation_query($params)->get()->row();
                        if(count($vsp) > 0){
                                return $vsp->cnt;
                        }
                        return "0";
		}
                public function tradonation_query($params  = array()){
                        $limit      =   "";
                        if(array_key_exists("cnt",$params)){
                            $sel    =   "count(*) as cnt";
                            $selp    =   "SUM(cnt) as cnt";
                        } else {
                            $sel    =   "d.*";
                            $selp    =   "*";
                        }
                        if(array_key_exists("donation_not_status",$params)){
                               $sl  =   "AND (d.donation_status < 5 OR d.donation_status = '0')";
                        }
                        if(array_key_exists("bloodbank_id",$params)){
                                $dbbloodbank_id =  $params['bloodbank_id'];
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                               $limit   =   "LIMIT ".$params['start'].",".$params['limit'];
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                               $limit   =   "LIMIT ".$params['limit'];
                        } 
                        if(array_key_exists("keywords",$params)){
                                $keyw    =   "AND (b.bloodbank_name LIKE '%".$params['keywords']."%' OR b.district LIKE '%".$params['keywords']."%' OR  b.city LIKE '%".$params['keywords']."%' OR d.mobile LIKE '%".$params['keywords']."%' OR b.bbmobile LIKE '%".$params['keywords']."%'  OR d.donor_id LIKE '%".$params['keywords']."%' OR d.name LIKE '%".$params['keywords']."%' OR d.blood_group LIKE '%".$params['keywords']."%')";
                        }else{
                                $keyw   =   "";
                        }
                        return  "SELECT $selp FROM ("
                        . "(SELECT $sel FROM (`donation_details` as d) INNER JOIN `bloodbanks` as b ON `b`.`bloodbank_id` = `d`.`dbbloodbank_id` INNER JOIN `login` as l ON `b`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `b`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` WHERE `u`.`ut_open` = '1' AND `t`.`btype_open` = '1' AND  `l`.`login_open` = '1' $sl AND `d`.`dbbloodbank_id` = '$dbbloodbank_id' $keyw)
UNION ALL
(SELECT $sel FROM transfer_collection INNER JOIN `donation_details` as d on d.donation_id = transfer_collection.tc_donation_id INNER JOIN `bloodbanks` as b ON `b`.`bloodbank_id` = `transfer_collection`.`tc_to_bank` INNER JOIN `login` as l ON `b`.`blood_login_id` = `l`.`login_id` INNER JOIN `bloodbank_type` as t ON `b`.`blood_bank_type` = `t`.`btype_id` INNER JOIN `usertype` as u ON `u`.`ut_id` = `l`.`login_type` WHERE `u`.`ut_open` = '1' AND  `l`.`login_open` = '1' AND `t`.`btype_open` = '1' AND transfer_collection.tc_donation_status < '5' AND `transfer_collection`.`tc_to_bank` = '$dbbloodbank_id' $keyw )"
                                . ") as dtabe $limit";
                }
                public function view_donors($params = array()){  
                        $sqk = $this->tradonation_query($params); 
                        return $this->db->query($sqk)->result();
		}
		public function cntview_donors($params = array()){ 
                        $params["cnt"]  =   "1"; 
                        $vsp    =   $this->db->query($this->tradonation_query($params))->result(); 
                        if(count($vsp) > 0){
                            $i  =   0;
                            foreach ($vsp as $vp){
                                $i =    $i+$vp->cnt;
                            }
                            return $i;
                        }
                        return "0";
		}
                public function donation_query($params  = array()){
                        $dt     =   array(
                                        "u.ut_open"     => "1",
                                        "l.login_open"  =>  '1',
                                        "t.btype_open"  => "1"
                                    );
                        $sel    =   "*";
                        if(array_key_exists("cnt",$params)){
                            $sel    =   "count(*) as cnt";
                        } 
                        if(array_key_exists("columns",$params)){
                            $sel    =   $params["columns"];
                        } 
                        $this->db->select("$sel")
                                        ->from("donation_details  as d")
                                        ->join("bloodbanks as b","b.bloodbank_id = d.dbbloodbank_id","INNER") 
                                        ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                        ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                        ->join("transfer_collection","transfer_collection.tc_donation_id = d.donation_id","Left");    
                        $this->db->where($dt); 
                        if(array_key_exists("donation_status",$params)){
                                $this->db->where("d.donation_status",$params['donation_status']);
                        }
                        if(array_key_exists("donation_not_status",$params)){
                                $this->db->where("(d.donation_status < 5 OR d.donation_status = '0')");
                        }
                        if(array_key_exists("keywords",$params)){
                                $this->db->where("(b.bloodbank_name LIKE '%".$params['keywords']."%' OR b.district LIKE '%".$params['keywords']."%' OR  b.city LIKE '%".$params['keywords']."%' OR d.mobile LIKE '%".$params['keywords']."%' OR b.bbmobile LIKE '%".$params['keywords']."%'  OR d.donor_id LIKE '%".$params['keywords']."%' OR d.name LIKE '%".$params['keywords']."%' OR d.blood_group LIKE '%".$params['keywords']."%')");
                        } 
                        if(array_key_exists("mobile",$params)){
                                $this->db->where("d.mobile",$params['mobile']);
                        } 
                        if(array_key_exists("bloodbank_id",$params)){
                                $this->db->where("d.dbbloodbank_id",$params['bloodbank_id']);
                        } 
                        if(array_key_exists("daterange",$params)){  
                                $val    =   explode(" - ",$params["daterange"]);
                                $this->db->where("(d.donation_date >= '".date("Y-m-d",strtotime($val["0"]))."' AND d.donation_date <= '".date("Y-m-d",strtotime($val["1"]))."' )");
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        }   
                        return  $this->db->order_by("d.donation_id","DESC"); 
                }
		public function datecheck($val,$mob,$params = array()){   
                        $gt     =   date("Y-m-d",strtotime("-3 month",strtotime($val))); 
                        $hy     =   "(d.donation_date BETWEEN '$gt' AND '$val') AND mobile =$mob";
                        $vsp    =   $this->donation_query($params)->where($hy)->get()->result();
                        if(count($vsp) == 0){
                            return FALSE;
                        } else {
                            return  TRUE;
                        }
                }
                public function check_bag($val,$pst,$params = array()){
                        $hy     =   "(d.donor_id = '$val' OR d.donor_id = '$pst')";
                        $vsp    =   $this->donation_query($params)->where($hy)->get()->result();
                        if(count($vsp) == 0){
                            return FALSE;
                        } else {
                            return  TRUE;
                        }
                }
		public function view_blooddonor($params = array()){  
                        return $this->donation_query($params)->get()->result();
		}
		public function getdonorid($id,$mob){
                        $this->db->where("d.mobile",$mob);
                        $this->db->where("d.donor_id",$id);
                        return $this->donation_query()->get()->row();
		}	
		public function view_blooddonorid($id,$params= array()){
                        $this->db->where("d.donation_id",$id);
                        return $this->donation_query($params)->get()->row();
		}	
		public function update_blooddonor($id){ 
				$dta	=	array(
						"mobile"			=>	$this->input->post("mobile"),
						"name"				=>	$this->input->post("dname"),
						"sex"				=>	$this->input->post("sex"),
						"blood_group"		=>	$this->input->post("blood_group"),
						"volume"			=>	"1",
						"donation_date"		=>	$this->input->post("donation_date"),
						"camp_name"			=>	$this->input->post("camp_name"), 
						"dbbloodbank_id"		=>	$this->input->post("blood_name") 
				);
				$this->db->update("donation_details",$dta,array("donation_id" => $id));
				return $this->db->affected_rows();
		}	
		public function history(){
			$this->db->select("d.donation_date,b.bloodbank_name,d.volume");
			$this->db->from("donation_details as d");
			$this->db->join("bloodbanks as b","b.bloodbank_id = d.dbbloodbank_id","INNER")
                                        ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                        ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                        ->where("u.ut_open","1")
                                        ->where("l.login_open","1")
                                        ->where("t.btype_open","1"); 
			$this->db->where("d.mobile",$this->input->post_get("phone"));
			return $this->db->get()->result();
		}
		public function get_hist($params = array()){
                        $ph		=	$this->session->userdata("phone"); 
                        $this->db->select("d.*,b.bloodbank_name,d.volume");
                        $this->db->from("donation_details as d");
                        $this->db->join("bloodbanks as b","b.bloodbank_id = d.dbbloodbank_id","INNER")
                                    ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->where("u.ut_open","1")
                                    ->where("l.login_open","1")
                                    ->where("t.btype_open","1"); 
                        $this->db->where("d.mobile",$ph);
                        if(array_key_exists("keywords",$params)){
                                $this->db->where("(bloodbank_name LIKE '%".$params['keywords']."%' OR d.donation_date LIKE '%".$params['keywords']."%')");
                        }
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                                $this->db->limit($params['limit']);
                        }
                        return $this->db->get()->result();
		}		
		public function cnt_get_hist(){
				$ph		=	$this->session->userdata("phone"); 
				$this->db->select("sum(volume) as cnt_volume");
				$this->db->from("donation_details as d");
				$this->db->join("bloodbanks as b","b.bloodbank_id = d.dbbloodbank_id","INNER")
				    ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                    ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                    ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                    ->where("u.ut_open","1")
                                    ->where("l.login_open","1")
                                    ->where("t.btype_open","1"); 
				$this->db->where("d.mobile",$ph);
				return $this->db->get()->row();
		}
		public function cnt_get_donor(){
                        $ph		=	$this->session->userdata("phone"); 
                        $this->db->select("count(*) as cnt_donor");
                        $this->db->from("donation_details as d");
                        $this->db->join("bloodbanks as b","b.bloodbank_id = d.dbbloodbank_id","INNER")
                                ->join("login as l","b.blood_login_id = l.login_id","INNER")
                                ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                                ->join("usertype as u","u.ut_id = l.login_type","INNER")
                                ->where("u.ut_open","1")
                                ->where("l.login_open","1")
                                ->where("t.btype_open","1")
                                ->where("d.mobile",$ph); 
                        return $this->db->get()->row();
		}
}