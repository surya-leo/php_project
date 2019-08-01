<?php

class donor_model extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function register_donor(){
            $donor_data = array();	
            if($this->input->post_get('phone')){
                    $donor_data['phone'] = $this->input->post_get('phone');
                    $this->db->select('*')
                                ->from('donor_registration_app')
                                ->where('phone', $donor_data['phone']);
                    $query = $this->db->get();
                    $result = $query->result();
                    if(sizeof($result) > 0){
                            return -3;                      //Record exists
                    }
            }else{
                    return -2;				//Missing information
            }
            if($this->input->post_get('name')){
                    $donor_data['name'] = $this->input->post_get('name');
            }
            if($this->input->post_get('age')){
                    $donor_data['age'] = $this->input->post_get('age');
            }
            if($this->input->post_get('sex')){
                    $donor_data['sex'] = $this->input->post_get('sex');
            }
            if($this->input->post_get('location')){
                    $donor_data['location'] = $this->input->post_get('location');
            }
            if($this->input->post_get('blood_group')){
                    $donor_data['blood_group'] = $this->input->post_get('blood_group');
            }
            if($this->input->post_get('email')){
                    $donor_data['email'] = $this->input->post_get('email');
            }
            if($this->input->post_get('district')){
                    $donor_data['district_id'] = $this->input->post_get('district');
            }
            $this->db->insert('donor_registration_app', $donor_data);
            return $this->db->insert_id();
    }
    
    function get_donation_summary(){
			$result = '';
			if($this->input->post_get('phone')){
				$this->db->select('*')
				->from('donation_details')
				->where('mobile', $this->input->post_get('phone'));
                                if($this->input->post("page") != ''){
                                        $this->db->limit($this->config->item('page_limit'),$this->config->item('page_limit')*$this->input->post("page"));
                                }
				$response = $this->db->get();
				$result = $response->result();	
			}
			return $result;
    }
    
    function get_donor_details(){
			$result = '';
			if($this->input->post_get('phone')){
				$this->db->select('*')
				->from('donation_details')
				->where('mobile', $this->input->post_get('phone'));
				$response = $this->db->get();	   
				$result = $response->result();	
			}
			return $result;
    }
    
    function initialize_new_bank(){
        $donors = array();
        $new_bloodbanks = array();
        $dbdefault = $this->load->database('default',TRUE);        
        $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
            ->from('bloodbanks')
            ->where('new_bloodbank','1');
        $query=$this->db->get();
        $result = $query->result();
        if(sizeof($result) > 0){
            
        }else{
            return true;
        }
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
            $dbt->select("$r->bloodbank_id bloodbank_id, '$r->bloodbank_name' blood_bank, blood_donor.donor_id, blood_donor.name, blood_donor.phone mobile, bb_donation.bbdonation_id bloodbank_donation_id, blood_grouping.blood_group, donation_date, camp_name", false)
                ->from('blood_donor')
                ->join('bb_donation','bb_donation.bbdonor_id = blood_donor.donor_id')
                ->join('blood_donation_camp','blood_donation_camp.camp_id = bb_donation.camp_id')
                ->join('blood_grouping','blood_grouping.donation_id = bb_donation.bbdonation_id')
                ->where('bb_donation.status_id >= 5')
                ->order_by('blood_donor.donor_id');
            $query=$dbt->get();
            $results = $query->result();
            foreach($results as $result){
                $donors[] = (array) $result;
            }
            $new_bloodbanks[] = $r->bloodbank_id;
        }
        $set_flag = array(
            'new_bloodbank' => '2'
        );
        if(sizeof($donors)>0){
            
        }else{
            return false;
        }
        $this->db->trans_start();
        $this->db->insert_batch('donation_details', $donors);
        $this->db->where_in('bloodbank_id', $new_bloodbanks);
        $this->db->update('bloodbanks', $set_flag);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    function update_donors_data(){
        $donors = array();
        $dbdefault = $this->load->database('default',TRUE);        
        $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
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
            $dbt->select("$r->bloodbank_id bloodbank_id, '$r->bloodbank_name' blood_bank, "
		    . "blood_donor.donor_id, blood_donor.sex, blood_donor.name, blood_donor.phone mobile, "
		    . "bb_donation.bbdonation_id bloodbank_donation_id, blood_grouping.bgblood_group, blood_inventory.volume, donation_date, camp_name", false)
                ->from('blood_donor')
                ->join('bb_donation','bb_donation.bbdonor_id = blood_donor.donor_id')
                ->join('blood_donation_camp','blood_donation_camp.camp_id = bb_donation.camp_id')
                ->join('blood_grouping','blood_grouping.donation_id = bb_donation.bbdonation_id')
		->join('blood_inventory', 'blood_inventory.donation_id = bb_donation.bbdonation_id')    
                ->where('bb_donation.status_id = 5')
		->where('blood_inventory.component_type', 'WB')
                ->order_by('blood_donor.donor_id');
            $query=$dbt->get();
            $results = $query->result();
            foreach($results as $result){
                $this->db->select('donation_id')
                        ->from('donation_details')
                        ->where('bloodbank_donation_id', "$result->bloodbank_donation_id")
                        ->where('bloodbank_id', "$result->bloodbank_id");
                $query=$this->db->get();
                $match = $query->result();
                if(sizeof($match)>0){
                    continue;
                }
                $donors[] = (array) $result;
            }
        }
        if(sizeof($donors)>0){
            
        }else{
            return false;
        }
        $this->db->trans_start();
        $this->db->insert_batch('donation_details', $donors);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    function get_user_profile(){
            $donor_profile = '';
            $phone = '';
            if($this->input->post_get('phone')){
                    $phone = $this->input->post_get('phone');
                    $this->db->where('phone', $phone);
            }else{
                    return -2;
            } 
            $this->db->select('*')
                    ->from('donor_registration_app'); 
            $query = $this->db->get();
            $result = $query->result();  
            return $result; 
    }
    public function edit_profile(){
                $donor_data = array();
                $ph		=	$this->session->userdata("phone");
                if($this->input->post_get('phone')){
                                $ph 	=	$this->input->post_get('phone');
                } 
                if($this->input->post_get('name')){
                        $donor_data['name'] = $this->input->post_get('name');
                }
                if($this->input->post_get('age')){
                        $donor_data['age'] = $this->input->post_get('age');
                }
                if($this->input->post_get('sex')){
                        $donor_data['sex'] = $this->input->post_get('sex');
                }
                if($this->input->post_get('location')){
                        $donor_data['location'] = $this->input->post_get('location');
                }
                if($this->input->post_get('blood_group')){
                        $donor_data['blood_group'] = $this->input->post_get('blood_group');
                        $this->db->update('donation_details',array('blood_group' => $this->input->post_get('blood_group')),array("mobile" => $ph)); 
                }
                if($this->input->post_get('district')){
                        $donor_data['district_id'] = $this->input->post_get('district');
                }
                if($this->input->post_get('email')){
                        $donor_data['email'] = $this->input->post_get('email');
                }
                $this->db->update('donor_registration_app',$donor_data,array("phone" => $ph));  
                return $this->db->affected_rows();
	}
	public function get_since(){
			$phone = $this->input->post_get('phone');
			$this->db->select('registered_on')
				->from('device')
				->where('mobile', $phone);
			$query = $this->db->get(); 
			$result = $query->row();
			return $result->registered_on;
	}
	public function get_profile(){
			$phone = $this->session->userdata('phone');
			$this->db->select('*')
				->from('donor_registration_app')
				->where('phone', $phone);
			$query = $this->db->get(); 
			$result = $query->row();
			return $result;
	}
}
