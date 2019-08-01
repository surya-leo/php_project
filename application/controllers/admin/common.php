<?php
class Common extends CI_Controller{
		public function district(){
				$json 	=	$this->common_model->district();
				$op 	=	"<option value=''> -- Select District -- </option>";
				foreach($json as $p){ 
						$op .= "<option value='".$p->district_name."'  text_val='".$p->district_id."'>".$p->district_name."</option>";
				}
				echo $op;
		}
		public function city(){
				$json 	=	$this->common_model->city();
				$op 	=	"<option value=''> -- Select City -- </option>";
				foreach($json as $p){
						$op .= "<option value='".$p->city_name."' >".$p->city_name."</option>";
				}
				echo $op;
		}
		public function get_bloodbanks(){
				$json 	=	$this->blood_bank_model->view_blood(array('uri' => $this->input->post("label_val"),"blodbankid" => $this->session->userdata("login_bloodbank_id")));
				$op 	=	"<option value=''> -- Select Blood Bank -- </option>";
				foreach($json as $p){
						$op .= "<option value='".$p->bloodbank_id."'>".$p->bloodbank_name."</option>";
				}
				echo $op;
		}
		public function change_distr(){
				$json 	=	$this->blood_bank_model->view_change_distr($this->input->post("change_distr"));
				$op 	=	"<option value=''> -- Select Blood Bank -- </option>";
				foreach($json as $p){
						$op .= "<option value='".$p->bloodbank_id."'>".$p->bloodbank_name."</option>";
				}
				echo $op;
		}
		public function get_transfer_donors(){
                        $json 	=	$this->blood_bank_model->view_blooddonor(
                                            array( 
                                                'daterange'         =>  $this->input->post("daterange"),
                                                'bloodbank_id'      =>  $this->session->userdata("login_bloodbank_id"),
                                                'donation_status'   =>  "0" 
                                            )
                                        );
                        $op 	=	"<option value=''> -- Select Donors -- </option>";
                        if(count($json) > 0){
                            foreach($json as $p){
                                    $op .= "<option value='".$p->donation_id."' >".$p->name."( ".$p->donor_id." )"."</option>";
                            }
                        }
                        echo $op;
		}
                public function get_transfer_num(){
                        $dtr            =   $this->input->post("daterange")?str_replace('/', '-', $this->input->post("daterange")):""; 
                        $blood_group    =   $this->input->post("blood_group")?$this->input->post("blood_group"):"";
                        $conditions     =   array();
                        if(!empty($dtr)){
                            $conditions['asate'] = $dtr;
                        } 
                        if(!empty($blood_group)){
                            $conditions['bloodgroup'] = $blood_group;
                        } 
                        $json 	=	$this->version2_model->blood_screening($conditions); 
                        $op 	=	"<option value=''> -- Select Bag Number -- </option>";
                        if(count($json) > 0){
                            foreach($json as $p){
                                $bvth   =   $this->transfer_model->getdonation($p->donation_id);
                                if($p->dc_screen == '1'){
                                    if($bvth->bloodbank_id == $this->session->userdata("login_bloodbank_id")){ 
                                        $op .= "<option value='".$p->donation_id."' >".$p->blood_unit_num."( ".$p->donor_id." )"."</option>";                                   
                                    }
                                }else{
                                        $op .= "<option value='".$p->donation_id."' >".$p->blood_unit_num."( ".$p->donor_id." )"."</option>";                                   
                                }
                            }
                        }
                        echo $op;
		}
		public function get_det(){
                        $json 	=	$this->common_model->get_det();
                        echo $json;
		}
}