<?php

class bloodbank_model extends CI_Model{ 
        function __construct() {
            parent::__construct();
        } 
        function get_locations(){
                $dt     =   array(
                        "u.ut_open"     =>  "1",
                        "t.btype_open"  =>  "1"
                );
                $lat    =   $this->input->post("latitude")?$this->input->post("latitude"):"16";
                $lon    =   $this->input->post("longitude")?$this->input->post("longitude"):"84";
                $this->db->select('bloodbank_id,bloodbank_name,category, lattitude, longitude,t.btype_name as type_name,email_id,bbmobile,trim(district) as district,trim(city) as city,round((((acos(sin(('.$lat.'*pi()/180))*sin((lattitude*pi()/180))+cos(('.$lat.'*pi()/180))*cos((lattitude*pi()/180))*cos((('.$lon.'-longitude)*pi()/180))))*180/pi())*60*1.1515*1.609344)) as distance')
                        ->from("login as l")
                        ->join("bloodbanks as b","b.blood_login_id = l.login_id","INNER")
                        ->join("usertype as u","u.ut_id = l.login_type","INNER")
                        ->join("bloodbank_type as t","b.blood_bank_type = t.btype_id","INNER")
                        ->where('l.login_open',"1")
                        ->where($dt);
                if($this->input->post("latitude") && $this->input->post("longitude")){
                        $this->db->having("distance <= ",$this->config->item('distance'));
                }
                if($this->input->post("page") != ''){
                        $this->db->limit($this->config->item('page_limit'),$this->config->item('page_limit')*$this->input->post("page"));
                }
                $this->db->order_by("distance","ASC");
                $response = $this->db->get(); 
                $result = $response->result();
                return $result;
        }
    
    function get_inventory(){
	$dashboard = array();
	if($this->input->post_get('bloodbank_id')){
	    $bloodbank_id = $this->input->post_get('bloodbank_id');	
	    $this->db->where('bloodbank_id', $bloodbank_id);
	}	
        $dbdefault = $this->load->database('default',TRUE);
        $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type, lattitude, longitude')
        ->from('bloodbanks');	
        $query=$this->db->get();
        $result = $query->result();
        foreach($result as $r){
            $config['hostname'] = "$r->host_name";
            $config['username'] = "$r->username";
            $config['password'] = "$r->database_password";
            $config['database'] = "$r->database_name";
            $config['dbdriver'] = 'mysql';
            $config['dbprefix'] = '';
            $config['pconnect'] = TRUE;
            $config['db_debug'] = TRUE;
            $config['cache_on'] = FALSE;
            $config['cachedir'] = '';
            $config['char_set'] = 'utf8';
            $config['dbcollat'] = 'utf8_general_ci';
            $dbt=$this->load->database($config,TRUE);
            $dbt->select("COUNT(*) blood_group_count, blood_group, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type, $r->bloodbank_type lattitude, $r->bloodbank_type longitude", false)
            ->from('bb_donation')
            ->join('blood_grouping','blood_grouping.donation_id = bb_donation.bbdonation_id')
            ->join('blood_inventory','blood_inventory.donation_id = bb_donation.bbdonation_id');
	    if($this->input->post_get('blood_group')){
		$blood_group = $this->input->post_get('blood_group');
		$dbt->where('blood_group', $blood_group);
	    }
	    if($this->input->post_get('component_type')){
		$component_type = $this->input->post_get('component_type');
		$dbt->where('blood_inventory.component_type', $component_type);
	    }            
            $dbt->where('blood_inventory.status_id = 7')
	    ->group_by('blood_group');
            $query=$dbt->get();	    
            $dashboard[]=$query->result();
        }
        return $dashboard;
    }
    
    function make_request(){
	$config = array();
	$patient_data = array();
	$patient_visit_data = array();
	$request_data = array();
	if($this->input->post_get('bloodbank_id')){
	    $request_data['bloodbank_id'] = $this->input->post_get('bloodbank_id');
	    $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password')
	    ->from('bloodbanks')
	    ->where('bloodbank_id', $request_data['bloodbank_id']);
	    $query=$this->db->get();
	    $result = $query->result();
	    $r = $result['0'];
	    $config['hostname'] = "$r->host_name";
            $config['username'] = "$r->username";
            $config['password'] = "$r->database_password";
            $config['database'] = "$r->database_name";
            $config['dbdriver'] = 'mysql';
            $config['dbprefix'] = '';
            $config['pconnect'] = TRUE;
            $config['db_debug'] = TRUE;
            $config['cache_on'] = FALSE;
            $config['cachedir'] = '';
            $config['char_set'] = 'utf8';
            $config['dbcollat'] = 'utf8_general_ci';            
	}else{
	    return -1;	    //Bloodbank not set.
	}
	if($this->input->post_get('patient_first_name')){
	    $patient_data['first_name'] = $this->input->post_get('patient_first_name');
	}
	if($this->input->post_get('patient_last_name')){
	    $patient_data['last_name'] = $this->input->post_get('patient_last_name');
	}
	if($this->input->post_get('patient_age')){
	    $patient_data['patient_age'] = $this->input->post_get('patient_age');
	}
	if($this->input->post_get('patient_diagnosis')){
	    $patient_visit_data['patient_diagnosis'] = $this->input->post_get('patient_diagnosis');
	}	
	if($this->input->post_get('gender')){
	    $patient_data['gender'] = $this->input->post_get('gender');
	}
	if($this->input->post_get('referred_by_doctor')){
	    $request_data['referred_by_doctor'] = $this->input->post_get('referred_by_doctor');
	}
	if($this->input->post_get('hospital')){
	    $request_data['hospital'] = $this->input->post_get('hospital');
	}
	if($this->input->post_get('blood_group')){
	    $request_data['blood_group'] = $this->input->post_get('blood_group');
	}
	if($this->input->post_get('whole_blood_units')){
	    $request_data['whole_blood_units'] = $this->input->post_get('whole_blood_units');
	}
	if($this->input->post_get('packed_cell_units')){
	    $request_data['packed_cell_units'] = $this->input->post_get('packed_cell_units');
	}
	if($this->input->post_get('fp_units')){
	    $request_data['fp_units'] = $this->input->post_get('fp_units');
	}
	if($this->input->post_get('ffp_units')){
	    $request_data['ffp_units'] = $this->input->post_get('ffp_units');
	}
	if($this->input->post_get('prp_units')){
	    $request_data['prp_units'] = $this->input->post_get('prp_units');
	}
	if($this->input->post_get('platelet_concentrate_units')){
	    $request_data['platelet_concentrate_units'] = $this->input->post_get('platelet_concentrate_units');
	}
	if($this->input->post_get('cryoprecipitate_units')){
	    $request_data['cryoprecipitate_units'] = $this->input->post_get('cryoprecipitate_units');
	}
	if($this->input->post_get('request_date')){
	    $request_data['request_date'] = $this->input->post_get('request_date');
	}
	$request_data['request_type'] = '0';
	$request_data['staff_id'] = '5';
	
	$dbt=$this->load->database($config,TRUE);
	//Insert patient data
	$dbt->insert('patient',$patient_data);
	$patient_id = $dbt->insert_id();
	$patient_visit_data['patient_id'] = $patient_id;
	$request_data['patient_id'] = $patient_id;
	
	//Get OP count
	$dbt->select('count')->from('counter')->where('counter_name','OP');
	$query= $dbt->get();
	$result=$query->row();	
	$patient_visit_data['hosp_file_no'] = ++$result->count;
	$dbt->where('counter_name','OP');
	$dbt->update('counter', array('count'=>$patient_visit_data['hosp_file_no']));
	
	//Insert visit data
	$dbt->insert('patient_visit',$patient_visit_data,false);
	$visit_id = $dbt->insert_id();
	$request_data['visit_id'] = $visit_id;
	
	//Insert request
	$dbt->insert('blood_request',$request_data,false);
	$request_id = $dbt->insert_id();
	return $request_id;
    }
    
    function set_schedules(){
	$blood_group = $this->input->post_get('blood_group');
        $dbdefault = $this->load->database('default',TRUE);
        $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type, lattitude, longitude')
        ->from('bloodbanks');
        $query=$this->db->get();
        $result = $query->result();
        foreach($result as $r){
            $config['hostname'] = "$r->host_name";
            $config['username'] = "$r->username";
            $config['password'] = "$r->database_password";
            $config['database'] = "$r->database_name";
            $config['dbdriver'] = 'mysql';
            $config['dbprefix'] = '';
            $config['pconnect'] = TRUE;
            $config['db_debug'] = TRUE;
            $config['cache_on'] = FALSE;
            $config['cachedir'] = '';
            $config['char_set'] = 'utf8';
            $config['dbcollat'] = 'utf8_general_ci';
            $dbt=$this->load->database($config,TRUE);
	    $today = date("Y-m-d");
            $dbt->select("$r->bloodbank_id bloodbank_id, bb_slot.*, blood_donation_camp.camp_name, blood_donation_camp.location", false)
            ->from('bb_slot')
            ->join('blood_donation_camp','blood_donation_camp.camp_id = bb_slot.camp_id')
	    ->where("bb_slot >= $today");           
            $query=$dbt->get();
            $schedules = $query->result();
        }
	$this->db->trans_start();
        $this->db->insert_batch('donation_details', $donors);
        $this->db->trans_complete();
        return $this->db->trans_status();        
    }
    
    function get_schedules(){
	if($this->input->post_get('bloodbank_id')){
	    $bloodbank_id = $this->input->post_get('bloodbank_id');
	    $this->db->where('bloodbank_id', $bloodbank_id);
	}
	
	$this->db->select('*')
		->from('donation_schedules');
	$query = $this->db->get();
	$result = $query->result();
	return $result;		
    }
    
    function book_donation(){
	$config = array();
	$patient_data = array();
	$patient_visit_data = array();
	$request_data = array();
	if($this->input->post_get('bloodbank_id') && $this->input->post_get('slot_id')){
	    $request_data['bloodbank_id'] = $this->input->post_get('bloodbank_id');
	    $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password')
	    ->from('bloodbanks')
	    ->where('bloodbank_id', $request_data['bloodbank_id']);
	    $query=$this->db->get();
	    $result = $query->result();
	    $r = $result['0'];
	    $config['hostname'] = "$r->host_name";
            $config['username'] = "$r->username";
            $config['password'] = "$r->database_password";
            $config['database'] = "$r->database_name";
            $config['dbdriver'] = 'mysql';
            $config['dbprefix'] = '';
            $config['pconnect'] = TRUE;
            $config['db_debug'] = TRUE;
            $config['cache_on'] = FALSE;
            $config['cachedir'] = '';
            $config['char_set'] = 'utf8';
            $config['dbcollat'] = 'utf8_general_ci';	    
	}else{
	    return -1;	    //Bloodbank not set.
	}
	
	$slot_data = array();
	if($this->input->post_get('phone')){
	    $slot_data['phone'] = $this->input->post_get('phone');
	}
	if($this->input->post_get('slot_id')){
	    $slot_data['slot_id'] = $this->input->post_get('slot_id');
	}
	
	$dbt=$this->load->database($config,TRUE);
	$dbt->insert('blood_request',$slot_data,false);
	$booking_id = $dbt->insert_id();
	return $booking_id;
    }
    function get_bloodbankd(){
        $dt     =   array(
                        "u.ut_open"     =>  "1",
                        "t.btype_open"  =>  "1"
                );
        $this->db->select('bloodbank_id,bloodbank_name,category, lattitude, longitude,email_id,bbmobile as mobile,trim(district) as district,trim(city) as city')
            ->from('bloodbanks') 
            ->join("login as l","bloodbanks.blood_login_id = l.login_id","INNER")
            ->join("usertype as u","u.ut_id = l.login_type","INNER")
            ->join("bloodbank_type as t","bloodbanks.blood_bank_type = t.btype_id","INNER")
            ->where('l.login_open',"1")
            ->where($dt)
            ->where('bloodbank_id',$this->input->post_get("bloodbank_id")); 
        $response = $this->db->get();
        
        $result = $response->result();
        return $result;
    }
    function get_schedule(){ 
		$bloodbank_id = $this->input->post_get('bloodbank_id'); 
		$this->db->select('*')
			->from('donation_schedules')
			->where('bloodbank_id', $bloodbank_id); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;		
    }
    function blood_groups(){
	$this->db->order_by("blood_group_name","ASC");
	$query = $this->db->get("blood_groups"); 
	$result = $query->result();
	return $result;	
      }
}
