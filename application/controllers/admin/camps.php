<?php
class Camps extends CI_Controller{
		public function __construct(){
                        parent::__construct();
                        $this->config->set_item('enable_query_strings',FALSE);
                        $this->config->set_item('sms_username',"APBSEL");
                        $this->config->set_item('sms_password',"APBSEL");
                        $this->config->set_item('sms_from',"APBSEL"); 
                        if($this->session->userdata("manage-camps") != "1"){
                                redirect("admin");
                        }				
		}
        public function index(){ 
                $dta 	=	array(
                                "title"		=>	"Camp Details",
                                "content"	=>	"camps",
                                "camp_bank"     =>	$this->blood_bank_model->view_blood()
                );
                if($this->input->post("submit")){
                        if($this->session->userdata("login_parent") == "1"){
                                $this->form_validation->set_rules("camp_bank","Blood Bank Name","required|xss_clean"); 
                        } 
                        $this->form_validation->set_rules("camp_date","Camp Date","required|trim|xss_clean"); 
                        $this->form_validation->set_rules("camp_msg","Camp Message","required|trim|xss_clean"); 
                        if($this->form_validation->run() == TRUE){
                                $set =	$this->camp_model->create_camp();
                                if($set > 0){
                                        $this->session->set_flashdata("suc","Camp Message created Successfully.");
                                        redirect("admin/camps");
                                }else{
                                        $this->session->set_flashdata("err","Camp Message not created Successfully.");
                                        redirect("admin/camps");
                                }
                        }
                }
                $totalRec = count($this->camp_model->view_camps());
                $this->perPage         =   "15"; 
                $config['base_url']    =    base_url().'admin/viewCamps';
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $this->perPage; 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $dta["view"]	=	$this->camp_model->view_camps(array('limit'=>$this->perPage)); 
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function viewCamps(){
                $conditions = array();
                $page = $this->uri->segment('3');
                if(!$page){
                    $offset = 0;
                }else{
                    $offset = $page;
                }
                $keywords       =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $totalRec = count($this->camp_model->view_camps($conditions));
                $this->perPage  =   "15"; 
                $config['base_url']    = base_url().'admin/viewCamps';
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage; 
                $config['link_func']   = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start'] = $offset;
                $conditions['limit'] = $this->perPage;
                $dta 	=	array(
                        "title"		=>	"View Camps", 
                        "view"          =>      $this->camp_model->view_camps($conditions)
                ); 
                $this->load->view("admin/pages/ajax-data/camps",$dta);
        }
        public function bulk_sms(){
                if($this->session->userdata("send-sms-camp") == ""){
                                redirect("admin");
                }
                $dta 	=	array(
                                "title"		=>	"Camp Details",
                                "content"	=>	"bulk_camps"
                );
                $uri 	=	$this->uri->segment("3");
                $val 	=	$this->camp_model->get_camps($uri);
                if($this->input->post("submit")){
                        if($_FILES["send_sms"]["name"] == ""){
                                        $this->form_validation->set_rules("send_sms","Excel File Upload","required");
                        }else{
                                $config['upload_path'] = './tmp'; 
                                $config['allowed_types'] = 'xlsx|xls';
                                $config['max_size']= '1000';
                                $this->load->library('upload', $config);
                                if (!$this->upload->do_upload("send_sms")){
                                          $error = array('error' => $this->upload->display_errors()); 
                                          $this->session->set_flashdata("err",$error);
                                          redirect("admin/bulk_sms/".$uri);
                                }
                                else {
                                        $datap = array('upload_data' => $this->upload->data());
                                        $filename = "./tmp/".$datap["upload_data"]["file_name"]; 

                                        //read file from path
                                        $objPHPExcel = PHPExcel_IOFactory::load($filename);

                                        //get only the Cell Collection
                                        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

                                        //extract to a PHP readable array format
                                        foreach ($cell_collection as $cell) {
                                                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                                                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                                                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

                                                //header will/should be in row 1 only. of course this can be modified to suit your need.
                                                if ($row != 1) {
                                                                $arr_data[$row][$column] = $data_value; 

                                                                $phone_number 	= $data_value;
                                                                $message_string = str_repalce(" ","%20",$val->camp_description);
                                                                /*
                                                                $url = "http://sms1.brandebuzz.in/API/sms.php"; //http://www.smsstriker.com/API/sms.php?";
                                                                $data = array(
                                                                                'username'	=>  $this->config->item("sms_username"),
                                                                                'password'	=>  $this->config->item("sms_password"),
                                                                                'from'		=>  $this->config->item("sms_from"),
                                                                                'to'		=> 	"$phone_number",
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
                                                                */
                                                                $url 	=	"http://sms1.brandebuzz.in/API/sms.php?username=".$this->config->item('mob_username')."&password=".$this->config->item('mob_password')."&from=".$this->config->item('mob_from')."&to=$phone_number&msg=$message_string&type=1"; 
																$ch = curl_init();
																curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
																curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
																curl_setopt($ch, CURLOPT_URL, $url);
																$result = curl_exec($ch);
																curl_close($ch);
				
                                                                if($result){
                                                                                $this->camp_model->sent_sms($uri,$data_value);
                                                                }
                                                }
                                        }  
                                        unlink("./tmp/".$_FILES["send_sms"]["name"]);
                                        $this->session->set_flashdata("suc","SMS Sent Successfully");
                                        redirect("admin/bulk_sms/".$uri);
                                }						
                        }						
                } 
                $this->load->view("admin/layout/inner_template",$dta);
        }
        public function download(){
                if($this->session->userdata("login_id") == ""){
                                redirect("admin");
                }
                $this->load->helper('download');
                $path = base_url("resources/jdadmin_assets/send_sms.xls");
                $data = file_get_contents($path); // Read the file's contents
                $name = 'send_sms.xls';
                force_download($name, $data);
        }
        public function get_camps(){
                echo json_encode($this->camp_model->fe_camps());
        }
        public function camp_active(){
                echo $this->camp_model->camp_active();
        }
        public function app_count(){
            if($this->session->userdata("login_type") == "2"){
                            redirect("admin");
            }
            if($this->session->userdata("login_id") == ""){
                            redirect("admin");
            }
            $dta 	=	array(
                            "title"	=>	"App Download",
                            "content"	=>	"app_count",
                            "app_count"	=>	$this->blood_bank_model->app_count()
            );
            if($this->input->post("submit")){   
                    $set =	$this->blood_bank_model->update_app();
                    if($set > 0){
                                    $this->session->set_flashdata("suc","Updated Successfully.");
                                    redirect("admin/app_count");
                    }else{
                                    $this->session->set_flashdata("err","Not Updated Successfully.");
                                    redirect("admin/app_count");
                    } 
            }
            $this->load->view("admin/layout/inner_template",$dta);
        }
        public function update_camp(){
				if($this->session->userdata("update-camp") != "1"){
                                redirect("admin");
                        }	
                $uri    =   $this->uri->segment("3");
                $view   =   $this->camp_model->get_camps($uri);
                $dta 	=	array(
                                "title"		=>	"Camp Details",
                                "content"	=>	"update_camp",
                                "view"          =>      $view,
                                "camp_bank"     =>	$this->blood_bank_model->view_blood()
                );
                if($this->input->post("submit")){
                        if($this->session->userdata("login_parent") == "1"){
                                $this->form_validation->set_rules("camp_bank","Blood Bank Name","required|xss_clean"); 
                        } 
                        $this->form_validation->set_rules("camp_date","Camp Date","required|trim|xss_clean"); 
                        $this->form_validation->set_rules("camp_msg","Camp Message","required|trim|xss_clean"); 
                        if($this->form_validation->run() == TRUE){
                                $set =	$this->camp_model->update_camp($uri);
                                if($set > 0){
                                        $this->session->set_flashdata("suc","Camp Message updated Successfully.");
                                        redirect("admin/update_camp/".$uri);
                                }else{
                                        $this->session->set_flashdata("err","Camp Message not updated Successfully.");
                                        redirect("admin/update_camp/".$uri);
                                }
                        }
                } 
                $this->load->view("admin/layout/inner_template",$dta);
        }
}