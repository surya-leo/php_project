<?php 
class Dashboard extends CI_Controller{
		public function __construct(){
				parent::__construct();
				$this->config->set_item('enable_query_strings',FALSE);
				if($this->session->userdata("login_id") == ""){
						redirect("admin");
				}
				$this->load->model("bloodbank_model");
				$this->load->model("blood_bank_model");
		}
		public function index(){
		    /*
				$url 	=	"http://version.advitsoft.com/api_count_value?filter=AP%20Bloodcell";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, $url);
				$result = curl_exec($ch);
				curl_close($ch);
				$obj 	= json_decode($result); 
			*/
			$data	=	 array(
						"title"		=>	"Dashboard",
						"content"	=>	"dashboard",
						"blood_banks"	=>	$this->blood_bank_model->ctbloodbanks(array('uri' => "Blood Bank")),
						"mother_banks"	=>	$this->version2_model->cnt_motherquery(),
						"storage"	=>	$this->blood_bank_model->ctbloodbanks(array('uri' => "Blood Storage Centre")),
						"bctv"	=>	$this->blood_bank_model->ctbloodbanks(array('uri' => "BCTV (Blood Collection and Transportation Vehicles)")),
						"donor"		=>	$this->blood_bank_model->ctdonation_details(),
						"volume"	=>	$this->blood_bank_model->cnt_volume(),
						"users"		=>	$this->blood_bank_model->cnt_users(),
						"camps"		=>	$this->blood_bank_model->cnt_camps(),
						"mps"		=>	$this->version2_model->blood_avquery(),//$this->blood_bank_model->view_blood(), 
						"app"		=>	0  
				); 
				$this->load->view("admin/layout/inner_template",$data);
		}
}