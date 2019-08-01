<?php
class Device_model extends CI_Model{
        public function log_otp($otp){
                $otp_data = array(
                        'otp'       =>  $otp,
                        'mobile'    =>  $this->input->post_get('phone'),
                ); 
                $phone_number   =   $this->input->post_get('phone');
                $message_string =   str_replace(" ","%20","OTP to login to Register your mobile with AP Blood Cell is: $otp. Valid for 10 min.");
               /*
                $url            =   "http://sms1.brandebuzz.in/API/sms.php"; //http://www.smsstriker.com/API/sms.php?";
                $data = array(
                    'username'  =>  $this->config->item('mob_username'), //'ucdsyousee',
                    'password'  =>  $this->config->item('mob_password'), //'SMS_for_UCDS',
                    'from'      =>  $this->config->item('mob_from'),
                    'to'        =>  "$phone_number",
                    'msg'       =>  $message_string,
                    'type'      =>  1
                );
                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data)
                    )
                );
                $context    =   stream_context_create($options);
                $result     =   file_get_contents($url, false, $context);
                */
                $url 	=	"http://sms1.brandebuzz.in/API/sms.php?username=".$this->config->item('mob_username')."&password=".$this->config->item('mob_password')."&from=".$this->config->item('mob_from')."&to=$phone_number&msg=$message_string&type=1"; 
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_URL, $url);
				$result = curl_exec($ch);
				curl_close($ch);
                if($result){
                        $this->db->insert('otp_log',$otp_data);
                        return true;
                }
                return false;
        }
        function registered(){ 
                $this->db->select('*')
                        ->from('otp_log')
                        ->where('otp',$this->input->post_get('otp'))        
                        ->where('mobile',$this->input->post_get('phone'))
                        ->where("DATE(sent_time) LIKE CURRENT_DATE")
//                        ->where("TIMEDIFF(CURTIME(),TIME(sent_time)) <= 10")
                        ->where("TIMEDIFF(TIME(sent_time), CURTIME()) <= 10")
                        ->where('flag','1'); 
                $response   =   $this->db->get(); 
                $result     =   $response->result();
                if(sizeof($result)>0){
                        $this->db->select('*')
                                ->from('device')
                                ->where('mobile', $this->input->post_get('phone'));
                        $response   =   $this->db->get();
                        $result     =   $response->result();
                        if(sizeof($result)>0){
                                return $result[0]->device_id;
                        }else{
                                return -2;       // Phone does not exist     
                        }
                }else{
                        return -1;           // OTP wrong
                } 
        }
        function registed_device(){
                $this->db->select('*')
                        ->from('device')
                        ->where('mobile', $this->input->post_get('phone'))
                        ->where('device_id', $this->input->post_get('unique_code'));  
                $response = $this->db->get();
                $result = $response->result(); 
                if(sizeof($result)>0){
                        return 'registered';
                }else{
                        $this->db->select('*')
                                ->from('donation_details')
                                ->where('mobile', $this->input->post_get('phone')); 
                        $response = $this->db->get();
                        $result = $response->result();
                        if(sizeof($result)>0){
                                return 'donated';
                        }else{
                                return false;
                        }
                }
        }
        function register_device(){
                $this->db->select('*')
                        ->from('otp_log')
                        ->where('otp',$this->input->post_get('otp'))
                        ->where('mobile',$this->input->post_get('phone'))
                        ->where("DATE(sent_time) LIKE CURRENT_DATE")
                        ->where("TIMEDIFF(TIME(sent_time), CURTIME()) <= 10")
                        ->where('flag','1');
                $response = $this->db->get();
                $result = $response->result();
                if(sizeof($result)>0){
                        $this->db->where('otp_id', $result[0]->otp_id);
                        $this->db->update('otp_log',array('flag'=>'-1'));							
                        $device_data = array(
                                'mobile' => $this->input->post_get('phone'),
                                'gcm_id' => ''
                        );
                        $this->db->insert('device',$device_data);
                        return $this->db->insert_id();	    
                }else{
                        return "-3";
                }
        }
}