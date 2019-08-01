<?php 
class Message_model extends CI_Model{ 
		public function send_schedule_mail(){
				$val	=	$this->bloodbank_model->get_bloodbankd(); 
				$tom 	=	explode(",",$val['0']->email_id);
				$mom 	=	explode(",",$val['0']->mobile);
				$from 	=	'ap.bloodcell@gmail.com';  
				$to 	= 	$tom['0']; // note the comma
				$mo 	= 	$mom['0']; // note the comma
				// Subject 
				$subject = 'Blood Donation Appointment Booking';
				$name   =   $this->input->post("name")?$this->input->post("name"):"";
				$mname   =   ($this->input->post("phone") == "")?$this->session->userdata("profile")["0"]->phone: $this->input->post("phone");
				$message = '
				<html>
				<head>
				  <title> Blood Donation Appointment Booking </title>
				</head>
				<body>
				  <p>Blood Donation Appointment Booking</p>
				  <table> 
				  	<tr>
					  <th><b>Name.</b></th><td>'.$name.'</td>
					</tr>
					<tr>
					  <th><b>Mobile No.</b></th><td>'.$mname.'</td>
					</tr>
					<tr>
					  <th><b>Selected Date.</b></th><td>'.$this->input->post("date_slot").'</td>
					</tr>
					<tr>
					  <th><b>Selected Time.</b></th><td>'.$this->input->post("time_slot").'</td>
					</tr>
				  </table>
				</body>
				</html>
				';

				// To send HTML mail, the Content-type header must be set
				$headers  	= 'MIME-Version: 1.0' . "\r\n";
				$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// Additional headers 
				$headers 	.= 'From: '.$from."\r\n".
						'Reply-To: '.$from."\r\n" .
						'X-Mailer: PHP/' . phpversion();				// Mail it
				
				$val = mail($to, $subject, $message, $headers);
				
				$phone_number 	= $mo;
				$message_string = "Blood Donation Booking\nName:".$name."\nMobile: ".$mname."\nDate & Time:".$this->input->post("date_slot")." & ".$this->input->post("time_slot");
				$url = "http://sms1.brandebuzz.in/API/sms.php"; //http://www.smsstriker.com/API/sms.php?";
				$data = array(
					'username'  =>  $this->config->item('mob_username'), //'ucdsyousee',
                                        'password'  =>  $this->config->item('mob_password'), //'SMS_for_UCDS',
                                        'from'      =>  $this->config->item('mob_from'),
					'to'		=> "$phone_number",
					'msg'		=>	$message_string,
					'type'		=>	1
				);
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($data)
					)
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);   
				return TRUE;
		}
		public function send_schedule(){
				$val	=	$this->bloodbank_model->get_bloodbankd(); 
				$tom 	=	explode(",",$val['0']->email_id);
				$mom 	=	explode(",",$val['0']->mobile);
				$from 	=	'ap.bloodcell@gmail.com';  
				$to 	= 	$tom['0']; // note the comma
				$mo 	= 	$mom['0']; // note the comma
				// Subject 
				$subject = 'Blood Request';
				// Message
				$message = '
				<html>
				<head>
				  <title> Blood Request </title>
				</head>
				<body>
				  <p>Blood Request </p>
				  <table>
					<tr>
					  <th><b>Name</b></th><td>'.$this->input->post("first_name")." ".$this->input->post("last_name").'</td>
					</tr>
					<tr>
					  <th><b>Blood Group</b></th><td>'.$this->input->post("blood_group").'</td>
					</tr>
					<tr>
					  <th><b>Age</b></th><td>'.$this->input->post("age").'</td>
					</tr>
					<tr>
					  <th><b>Gender</b></th><td>'.$this->input->post("sex").'</td>
					</tr>
					<tr>
					  <th><b>Diagnosis or Description</b></th><td>'.$this->input->post("diag").'</td>
					</tr>
					<tr>
					  <th><b>Doctor Name</b></th><td>'.$this->input->post("doctor_name").'</td>
					</tr>
					<tr>
					  <th><b>Hospital Name</b></th><td>'.$this->input->post("hospi_name").'</td>
					</tr> 
					<tr>
					  <th><b>Selected Date.</b></th><td>'.$this->input->post("date_slot").'</td>
					</tr>
				  </table>
				</body>
				</html>
				';

				// To send HTML mail, the Content-type header must be set
				$headers  	= 'MIME-Version: 1.0' . "\r\n";
				$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// Additional headers 
				$headers 	.= 'From: '.$from."\r\n".
						'Reply-To: '.$from."\r\n" .
						'X-Mailer: PHP/' . phpversion();				// Mail it
				
				$val = mail($to, $subject, $message, $headers);
				
				$phone_number 	= $mo;
				$message_string = "Blood Request\nName:".$this->input->post("first_name")." ".$this->input->post("last_name")."\nBlood Group: ".$this->input->post("blood_group")."\nDate :".$this->input->post("date_slot");
				$url = "http://sms1.brandebuzz.in/API/sms.php"; //http://www.smsstriker.com/API/sms.php?";
				$data = array(
					'username'  =>  $this->config->item('mob_username'), //'ucdsyousee',
                                        'password'  =>  $this->config->item('mob_password'), //'SMS_for_UCDS',
                                        'from'      =>  $this->config->item('mob_from'),
					'to'		=> "$phone_number",
					'msg'		=>	$message_string,
					'type'		=>	1
				);
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($data)
					)
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);   
				return TRUE;
		}
                public function request_blood(){ 
                        $mob    =   $this->session->userdata('phone')?$this->session->userdata('phone'):$this->input->post("phone");
                        $rob    =   $this->session->userdata('unique_code')?$this->session->userdata('unique_code'):$this->input->post("unique_code");
                        $ftv    =   array(
                                "brmobile"                =>  $mob,
                                "brdevice_id"             =>  $rob,
                                "brbloodbank_id"          =>  ($this->session->userdata("login_bloodbank_id") != "")?$this->session->userdata("login_bloodbank_id"):$this->input->post("bloodbank_id"),
                                "patient_first_name"      =>  $this->input->post("first_name"),
                                "patient_last_name"       =>  $this->input->post("last_name"),
                                "patient_age"             =>  $this->input->post("age"),
                                "patient_diagnosis"       =>  $this->input->post("diag"),
                                "patient_gender"          =>  $this->input->post("sex"),
                                "referred_by_doctor"      =>  $this->input->post("doctor_name"),
                                "hospital"                =>  $this->input->post("hospi_name"),
                                "brblood_group"           =>  $this->input->post("blood_group"),
                                "whole_blood_units"       =>  $this->input->post("white_blood_cells"),
                                "packed_cell_units"       =>  $this->input->post("packed_cell_units"),
                                "fp_units"                =>  $this->input->post("fp_units"),
                                "ffp_units"               =>  $this->input->post("ffp_units"),
                                "prp_units"               =>  $this->input->post("prp_units"),
                                "platelet_concentrate_units"    =>  $this->input->post("platelet_concentrate_units"),
                                "request_status"                =>  "Pending",
                                "cryoprecipitate_units"         =>  $this->input->post("cryoprecipitate_units"),
                                "request_date"                  =>  date("Y-m-d", strtotime(str_replace("/","-",$this->input->post('date_slot'))))
                        ); 
                        $this->db->insert("blood_request",$ftv);
                        return $this->db->insert_id();
                }
                public function appointments(){
                        $mob    =   $this->session->userdata('phone')?$this->session->userdata('phone'):$this->input->post("phone");
                        $data   =   array(
                                            'app_mobile'    =>  $mob,
                                            'bloodbank_id'  =>  $this->input->post('bloodbank_id'),
                                            'date_slot'     =>  date("Y-m-d", strtotime(str_replace("/","-",$this->input->post('date_slot')))),
                                            'time_slot'     =>  $this->input->post('time_slot'),
                                            'app_status'    =>  'Pending'
                                    );
                        $this->db->insert('appointments',$data);
                        $appointment_id =   $this->db->insert_id();
                        return $appointment_id;
                } 
                public function send_schedulems($uri){
                        $camp   =   $this->camp_model->get_camps($uri);
                        
                        $val	=	$this->bloodbank_model->get_bloodbankd(); 
                        $tom 	=	explode(",",$val['0']->email_id);
                        $mom 	=	explode(",",$val['0']->mobile);
                        $from 	=	'ap.bloodcell@gmail.com';  
                        $to 	= 	$tom['0'];  
                        $mo 	= 	$mom['0'];  
                        $subject = 'Registration for Camp held on '.date("d F Y", strtotime($camp->camp_date));
                        $message = '
                        <html>
                            <head>
                                <title> Registration for Camp </title>
                            </head>
                            <body>
                                <p>Registration for Camp </p>
                                <table>
                                      <tr>
                                        <th><b>Name </b></th><td>'.$this->input->post("name").'</td>
                                      </tr>
                                      <tr>
                                        <th><b>Blood Group </b></th><td>'.$this->input->post("blood_group").'</td>
                                      </tr>
                                      <tr>
                                        <th><b>Age </b></th><td>'.$this->input->post("age").'</td>
                                      </tr>
                                      <tr>
                                        <th><b>Gender </b></th><td>'.$this->input->post("sex").'</td>
                                      </tr>
                                       <tr>
                                        <th><b>Mobile No. </b></th><td>'.$this->input->post("phone").'</td>
                                      </tr>
                                      <tr>
                                        <th><b>Email Id </b></th><td>'.$this->input->post("emailid").'</td>
                                      </tr>
                                      <tr>
                                        <th><b>Fathers Name </b></th><td>'.$this->input->post("fname").'</td>
                                      </tr>
                                      <tr>
                                        <th><b>District </b></th><td>'.$this->input->post("district").'</td>
                                      </tr>
                                      <tr>
                                        <th><b>Pincode </b></th><td>'.$this->input->post("pincode").'</td>
                                      </tr>
                                </table>
                            </body>
                        </html>
                        ';

                        // To send HTML mail, the Content-type header must be set
                        $headers  	= 'MIME-Version: 1.0' . "\r\n";
                        $headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        // Additional headers 
                        $headers 	.= 'From: '.$from."\r\n".
                                        'Reply-To: '.$from."\r\n" .
                                        'X-Mailer: PHP/' . phpversion();				// Mail it

                        $val = mail($to, $subject, $message, $headers); 
                        return $val;
		}
}
?>