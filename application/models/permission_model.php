<?php
class Permission_model extends CI_Model{  
        public function get_users(){ 
                if($this->session->userdata("login_type") != '1utype'){
                        $this->db->where("id != ","1"); 
                }
                return $this->db->get_where("usertype",array("ut_open" => "1"))->result();
        }
        public function get_pages(){
                        $this->db->select("*");
                        $this->db->from("pages");
                        $this->db->where("page_name != 'manage-permission'");
                        return $this->db->get()->result();
        }
        public function get_shares(){ 
                        $this->db->select('CONCAT(per_usertype,"-",per_page_id) AS detail,per_status',FALSE);
                        $this->db->from('permissions'); 
//                        $this->db->get();echo $this->db->last_query();exit;
                        return $this->db->get()->result();
        }
        public function get_shre($pg,$ut){ 
                        $this->db->select('per_status');
                        $this->db->from("permissions"); 
                        $this->db->where("per_page_id",$pg); 
                        $this->db->where("per_usertype",$ut); 
                        $this->db->get(); 
                        if($this->db->affected_rows() > 0){
                                return "1";
                        }else{
                                $dt = array(
                                        "per_page_id"	=>	$pg,
                                        "per_usertype"	=>	$ut,
                                        "per_status"	=>	0,
                                );
                                $this->db->insert("permissions",$dt);
                                if($this->db->insert_id() > 0){
                                                return "1";
                                }else{
                                                return "0";
                                }
                        }
        }
        public function update_permission(){				
                $users 	=	$this->permission_model->get_users();
                $pages 	=	$this->get_pages();
                $share 	=	$this->get_shares();
                $sth    =   $this->input->post("permission");
                $sty    =   array();
                foreach($sth as $key =>  $hrt){
                    foreach($hrt as $ju =>  $ht){
                        $sty[$key."-".$ju] =   $ht;
                    }
                } 
                if(count($pages) > 0){
                        foreach($pages as $pg){
                                foreach($users as $ur){ 
                                        $vlpa = $this->get_shre($pg->page_id,$ur->ut_id);
                                        if($vlpa == "1"){
                                                $sj         =   $ur->ut_id."-".$pg->page_id;
                                                $vala       =   array_key_exists($sj,$sty)?$sty[$sj]:"0"; 
//                                                $vala 	=   $this->input->post('permission['.$ur->ut_id.']['.$pg->page_id.']');
                                                $valp	=	$vala?$vala:0;
                                                $dt = array(
                                                        "per_page_id"	=>	$pg->page_id,
                                                        "per_usertype"	=>	$ur->ut_id
                                                ); 
                                                $this->db->update("permissions",array("per_status" => $valp),$dt);  
                                        }
                                }
                        } 
                        return TRUE;
                }
        } 
}
?>