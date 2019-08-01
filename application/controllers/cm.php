<?php 
class cm extends CI_Controller{
		public function __construct() {
			parent::__construct();  
			$this->session->sess_destroy();
                        $this->config->set_item('enable_query_strings',FALSE); 
		}
		public function index(){
                        /*$url 	=	"http://version.advitsoft.com/api_count_value?filter=AP%20Bloodcell";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_URL, $url);
                        $result = curl_exec($ch);
                        curl_close($ch);
                        $obj 	= json_decode($result); */
                        $end    =   date("Y-m-d", strtotime("+1 week"));
                        $start  =   date("Y-m-d"); 
                        $asate  =   $start." - ".$end;   
                        $dta 	=	array( 
                                            "content"		=>	"dashboard",
                                            "blood_banks"	=>	$this->blood_bank_model->ctbloodbanks(array('uri' => "Blood Bank")),
                                            "mother_banks"	=>	$this->version2_model->cnt_motherquery(),
                                            "storage"       =>	$this->blood_bank_model->ctbloodbanks(array('uri' => "Blood Storage Centre")),
                                            "bctv"          =>	$this->blood_bank_model->ctbloodbanks(array('uri' => "BCTV (Blood Collection and Transportation Vehicles)")), 
                                            "mps"		=>	$this->version2_model->blood_avquery(array("out_status" => '1')), 
                                            "bloodav"        =>      $this->version2_model->oblood_available(array("out_status" => '1')),
                                            "accps"          =>      count($this->camp_model->get_fequery()),
                                            //"app"		=>	$obj,
                                            "users"		=>	$this->blood_bank_model->cnt_users(),
                                            "camps"		=>	$this->blood_bank_model->cnt_camps(),
                                            "bloav"             =>      $this->version2_model->oblood_collection(),
                                            "expriy"            =>      $this->blood_availability_model->cntblood_discarded(array('asate' => $asate))
                                    );				
                        $this->load->view("cm/layout/inner_template",$dta);
		}
		public function view_blood_bank(){ 
                            $uri                =       str_replace("\n","",$this->input->post("uir"));
                            $dta["title"]       =       $uri;
                            $this->perPage         =   "15"; 
                            if($uri != "Mother Blood Bank"){
                                    $tot    =   $this->blood_bank_model->ctbloodbanks(array("uri" => $uri))->cnt_bank;
                                    $view   =   $this->blood_bank_model->view_blood(array('limit'=>$this->perPage,"uri" => $uri));
                            }else{ 
                                    $tot     =   $this->version2_model->cnt_motherquery(); 
                                    $view    =   $this->version2_model->view_motherquery(array('limit'=>$this->perPage)); 
                            }
                            $totalRec           =       $tot; 
                            $config['base_url']    =    base_url().'cm/viewBloodbank/';
                            $config['total_rows']  =    $totalRec;
                            $config['per_page']    =    $this->perPage; 
                            $config['link_func']   =    'searchFilter';
                            $config['uri_segment'] =    3;
                            $this->ajax_pagination->initialize($config);
                            $dta["limit"]	=	'1';
                            $dta["view"]	=	$view;
                            $this->load->view("cm/pages/view_blood",$dta);
		}
		public function viewBloodbank(){
				$uri                =       str_replace("\n","",$this->input->post("uir"));
				$dta["title"]       =       $uri;
				$conditions =   array();
				$page       =   $this->uri->segment('3');
				$offset = (!$page)? 0:$page; 
				$keywords       =   $this->input->post('keywords');                         
				if(!empty($keywords)){
					$conditions['keywords'] = $keywords;
				}  
				if(!empty($uri)){
					$conditions['uri'] = $uri;
				}  
				$blood_category       =   $this->input->post('blood_category');                         
				if(!empty($blood_category)){
					$conditions['blood_category'] = $blood_category;
				}  
				$this->perPage  =   "15"; 
				$conditions['start'] = $offset;
				$conditions['limit'] = $this->perPage;
				if($uri != "Mother Blood Bank"){
						$tot    =   $this->blood_bank_model->ctbloodbanks($conditions)->cnt_bank;
						$view   =   $this->blood_bank_model->view_blood($conditions);
				}else{ 
						$tot     =   $this->version2_model->cnt_motherquery($conditions); 
						$view    =   $this->version2_model->view_motherquery($conditions); 
				}
				$totalRec = $tot; 
				$config['base_url']    =    base_url().'cm/viewBloodbank/';
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $this->perPage; 
				$config['link_func']   = 'searchFilter';
				$config['uri_segment'] =    3;
				$this->ajax_pagination->initialize($config);
				$dta["view"]	=	$view;
				$dta["limit"]	=	$offset+1;
				$this->load->view("cm/pages/ajax_blood",$dta);
		}
		public function users(){ 
                        $dta["view"]	=	$this->common_model->users();
                        $this->load->view("cm/pages/users",$dta);
		}
		public function bloodavail(){ 
                        $conditions             =   array();
                        $district               =   $this->input->post('district')?$this->input->post('district'):"";
                        $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                        $component              =   $this->input->post('component')?$this->input->post('component'):"";
                        $conditions['out_status']         =   1;
                        $blood_bank_type        =   $this->input->post('blood_bank_type')?$this->input->post('blood_bank_type'):"";
                        if(!empty($component)){
                                $conditions['component']    =   $component;
                        }
                        if(!empty($district)){
                                $conditions['district']     =   $district;
                        }
                        if(!empty($city)){
                                $conditions['city']         =   $city;
                        } 
                        if(!empty($blood_bank_type)){
                                $conditions['blood_bank_type']         =   $blood_bank_type;
                        } 
                        $totalRec               =   $this->version2_model->cntoblood_available($conditions); 
                        $this->perPage          =   "15"; 
                        $config['base_url']     =   base_url().'cm/viewBloodAvail';
                        $config['total_rows']   =   $totalRec;
                        $config['per_page']     =   $this->perPage;  
                        $conditions['limit']    =   $this->perPage; 
                        $config['link_func']    =   'searchFilter';
                        $this->ajax_pagination->initialize($config); 
                        $dta["view"]        =   $this->version2_model->oblood_available($conditions);
                        $dta["district"]    =   $this->common_model->district();
                        $dta["limit"]	=	'1';
                        $dta["bloodbank_type"]  =   $this->version2_model->bloodbank_type(); 
                        $this->load->view("cm/pages/bloodavail",$dta);
		}
		public function viewBloodavail(){
		        $conditions = array();
                        $page = $this->uri->segment('3');
                        $conditions['out_status']         =   1;
                        $offset = (!$page)?0:$page;
                        $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";   
                        $district               =   $this->input->post('district')?$this->input->post('district'):"";
                        $city                   =   $this->input->post('city')?$this->input->post('city'):"";
                        $component              =   $this->input->post('component')?$this->input->post('component'):"";
                        $blood_bank_type        =   $this->input->post('blood_bank_type')?$this->input->post('blood_bank_type'):"";
                        $zero_units             =   $this->input->post('units'); 
                        if($zero_units == '0'){
                            $conditions['zero_units']         =   $zero_units; 
                        }
                        if(!empty($component)){
                                $conditions['component']    =   $component;
                        }
                        if(!empty($district)){
                                $conditions['district']     =   $district;
                        }
                        if(!empty($city)){
                                $conditions['city']         =   $city;
                        } 
                        $blood_category       =   $this->input->post('blood_category')?$this->input->post('blood_category'):"";
                        if(!empty($blood_category)){
                            $conditions['blood_category'] = $blood_category;
                        }
                        $intervalue      =   $this->input->post('notintervalue')?$this->input->post('notintervalue'):"";
                        if(!empty($intervalue)){
                                $conditions['notintervalue'] = $intervalue;
                        } 
                        if(!empty($blood_bank_type)){
                                $conditions['blood_bank_type']         =   $blood_bank_type;
                        } 
                        if(!empty($keywords)){
                                $conditions['keywords'] = $keywords;
                        } 
                        $totalRec               =   $this->version2_model->cntoblood_available($conditions); 
                        $this->perPage          =   "15"; 
                        $config['base_url']     =   base_url().'cm/viewBloodavail';
                        $config['total_rows']   =   $totalRec;
                        $config['per_page']     =   $this->perPage; 
                        $config['link_func']    =   'searchFilter';
                        $this->ajax_pagination->initialize($config);
                        $conditions['start']    =   $offset;
                        $conditions['limit']    =   $this->perPage;
                        $dta["view"]            =   $this->version2_model->oblood_available($conditions); 
                        $dta["limit"]       =	$offset+1;
                        $this->load->view("cm/pages/ajax-bloodavail",$dta);
		}
		public function view_blood_donation(){
                        //$dta["view"]	=	$this->blood_bank_model->view_blooddonor();
                        $dta["view"]	=	$this->common_model->view_blooddonor();
                        $dta["dview"]	=	$this->common_model->sview_blooddonor();
                        $this->load->view("cm/pages/view_blood_donation",$dta);
		}
		public function camps(){
                        $asate                  =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):"";  
                        $totalRec               =   $this->camp_model->cntbcamp_reports(array('asate' => $asate)); 
                        $this->perPage          =   "15"; 
                        $config['base_url']     =   base_url().'cm/viewCamps';
                        $config['total_rows']   =   $totalRec;
                        $config['per_page']     =   $this->perPage; 
                        $config['link_func']    =   'searchFilter';                
                        $this->ajax_pagination->initialize($config); 
                        $dta["view"]            =   $this->camp_model->bcamp_reports(array('limit'=>$this->perPage,'asate' => $asate));  
                        $dta["limit"]	=	'1';
                        $this->load->view("cm/pages/camps",$dta);
		}
		public function viewCamps(){
				$conditions =   array();
				$page       =   $this->uri->segment('3');
				$offset         = (!$page)?0:$page;
				$keywords       =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
				$asate          =   $this->input->post('asate')?str_replace("/","-",$this->input->post('asate')):""; 
				if(!empty($asate)){
						$conditions['asate'] = $asate;
				}  
				if(!empty($keywords)){
						$conditions['keywords'] = $keywords;
				}   
				$blood_category       =   $this->input->post('blood_category')?$this->input->post('blood_category'):"";
				if(!empty($blood_category)){
					$conditions['blood_category'] = $blood_category;
				}   
				$totalRec               =   $this->camp_model->cntbcamp_reports($conditions); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewCamps';
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';
				$this->ajax_pagination->initialize($config);
				$conditions['start']    =   $offset;
				$conditions['limit']    =   $this->perPage;
				$dta["view"]            =   $this->camp_model->bcamp_reports($conditions);
				$dta["limit"]           =	$offset+1;
				$this->load->view("cm/pages/ajax_camp",$dta);
		}
		public function blood_expiry(){
				$end     =   date("Y-m-d", strtotime("+1 week"));
				$start        =   date("Y-m-d"); 
				$asate                  =   $start." - ".$end; 
				$totalRec               =   $this->blood_availability_model->cntblood_discarded(array('asate' => $asate)); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewBloodDiscarded';
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter'; 
				$this->ajax_pagination->initialize($config); 
				$dta["view"]    =   $this->blood_availability_model->blood_discarded(array('limit'=>$this->perPage,'asate' => $asate));
				$dta["limit"]	=	'1';
				$this->load->view("cm/pages/discarded",$dta);
		}
		public function viewBloodDiscarded(){
				$end     =   date("Y-m-d", strtotime("+1 week"));
				$start        =   date("Y-m-d"); 
				$conditions = array();
				$page = $this->uri->segment('3');
				$offset = (!$page)?0:$page;
				$keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
				$asate                  =   $start." - ".$end;  
				if(!empty($asate)){
						$conditions['asate']        =   $asate;
				}
				if(!empty($keywords)){
						$conditions['keywords']     =   $keywords;
				}   
				$totalRec               =   $this->blood_availability_model->cntblood_discarded($conditions); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewBloodDiscarded';
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';
				$this->ajax_pagination->initialize($config);
				$conditions['start']    =   $offset;
				$conditions['limit']    =   $this->perPage;
				$dta["view"]            =   $this->blood_availability_model->blood_discarded($conditions);  
				$dta["limit"]       =	$offset+1;
				$this->load->view("cm/pages/ajax_discarded",$dta);
		} 
		public function viewCampsblood(){
				 $end        =   date("Y-m-d", strtotime("+2 week"));
				$start      =   date("Y-m-d", strtotime("-2 week"));
				$asate      =   $start." - ".$end; 
				$blood      =   $this->uri->segment(3);
				$totalRec               =   $this->camp_model->cntcmp_query(array('asate' => $asate,'bloodbank' => $blood)); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewBloodCamps/'.$blood;
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';       
				$config['uri_segment']    =   '4';
				$this->ajax_pagination->initialize($config); 
				$dta["bloodid"]            =   $blood;  
				$dta["view"]            =   $this->camp_model->viewcmp_query(array('limit'=>$this->perPage,'asate' => $asate,'bloodbank' => $blood));  
				$dta["limit"]	=	'1';
				$this->load->view("cm/pages/viewcamps",$dta);
		}
		public function viewBloodCamps(){
				$end        =   date("Y-m-d", strtotime("+2 week"));
				$start      =   date("Y-m-d", strtotime("-2 week")); 
				$conditions = array();
				$blood      =   $this->uri->segment('3');
				$dta["bloodid"]            =   $blood;
				$page       =   $this->uri->segment('4');
				$offset = (!$page)?0:$page;
				$keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
				$asate                  =   $this->input->post("asate")?$this->input->post("asate"):$start." - ".$end;  
				if(!empty($blood)){
						$conditions['bloodbank']        =   $blood;
				}
				if(!empty($asate)){
						$conditions['asate']        =   $asate;
				}
				if(!empty($keywords)){
						$conditions['keywords']     =   $keywords;
				}   
				$totalRec               =   $this->camp_model->cntcmp_query($conditions); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewBloodCamps/'.$blood;
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';
				$config['uri_segment']    =   '4';
				$this->ajax_pagination->initialize($config);
				$conditions['start']    =   $offset; 
				$conditions['limit']    =   $this->perPage;
				$dta["view"]            =   $this->camp_model->viewcmp_query($conditions);  
				$dta["limit"]       =	$offset+1;
				$this->load->view("cm/pages/ajax_viewcamps",$dta);
} 
		public function collections(){ 
				$conditions     =   array();
				$totalRec       =   $this->version2_model->cntoblood_collection($conditions);
				$this->perPage         =   "15"; 
				$config['base_url']    =    base_url().'cm/viewCollection';
				$config['total_rows']  =    $totalRec;
				$config['per_page']    =    $this->perPage; 
				$config['link_func']   =    'searchFilter';
				$this->ajax_pagination->initialize($config); 
				$conditions['limit']    =   $this->perPage;
				$dta["view"]            =   $this->version2_model->oblood_collection($conditions);
				$dta["district"]        =   $this->common_model->district();
				$dta["limit"]	=	'1';
				$dta["bloodbank_type"]  =   $this->version2_model->bloodbank_type();
				$this->load->view("cm/pages/collections",$dta);
		}
		public function viewCollection(){ 
				$conditions     =   array(); 
				$page           =   $this->uri->segment('3');
				$offset = (!$page)?0:$page;
				$keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";   
				$district               =   $this->input->post('district')?$this->input->post('district'):"";   
				$city                   =   $this->input->post('city')?$this->input->post('city'):"";   
				$blood_bank_type        =   $this->input->post('blood_bank_type')?$this->input->post('blood_bank_type'):"";  
				if(!empty($district)){
						$conditions['district']        =   $district;
				}
				if(!empty($city)){
						$conditions['city']        =   $city;
				}
				if(!empty($keywords)){
						$conditions['keywords']     =   $keywords;
				}  
				if(!empty($blood_bank_type)){
						$conditions['blood_bank_type']    =   $blood_bank_type;
				} 
				$zero_units             =   $this->input->post('units'); 
				if($zero_units == '0'){
					$conditions['zero_units']         =   $zero_units; 
				} 
				$blood_category       =   $this->input->post('blood_category')?$this->input->post('blood_category'):"";
				if(!empty($blood_category)){
					$conditions['blood_category'] = $blood_category;
				}
				$intervalue      =   $this->input->post('notintervalue')?$this->input->post('notintervalue'):"";
				if(!empty($intervalue)){
					$conditions['notintervalue'] = $intervalue;
				}
				$this->perPage         =   "15"; 
				$config['base_url']    =    base_url().'cm/viewCollection';
				$config['total_rows']  =    $this->version2_model->cntoblood_collection($conditions);
				$config['per_page']    =    $this->perPage; 
				$config['link_func']   =    'searchFilter';
				$this->ajax_pagination->initialize($config); 
				$conditions['limit']    =   $this->perPage;
				$conditions['start']    =   $offset; 
				$dta["view"]            =   $this->version2_model->oblood_collection($conditions);
				$dta["district"]        =   $this->common_model->district();
				$dta["limit"]       =	$offset+1;
				$this->load->view("cm/pages/ajax_collections",$dta);
		} 
		
		public function charts(){
				$dta["view"]	=	$this->common_model->ceeports();
				$dta["district"]    =   $this->common_model->district();
				$this->load->view("cm/pages/charts",$dta);
		}
		public function viewCharts(){ 
				$district       =   $this->input->post('district')?$this->input->post('district'):"";
				if(!empty($district)){
					$conditions['district'] =   $district;
				}
				$dta["view"]	=	$this->common_model->ceeports($conditions); 
				$this->load->view("cm/pages/fecharts",$dta);
		}
		public function fa_bargraph(){
				$dta["view"]            =   $this->version2_model->osfblood_available();  
				$dta["district"]    =   $this->common_model->district();
				$this->load->view("cm/pages/fa_bargraph",$dta);
		} 
		public function viewBctvgraph(){  
		        $today = date('Y-m-d');
		        $newdate = date('Y-m-d', strtotime('-1 month', strtotime($today)));  
		        $conditions['asate']  =  $newdate." - ".$today; 
		        $conditions['bloodbank_type'] = "BCTV (Blood Collection and Transportation Vehicles)";
		        $dta["view"]        =	$this->camp_model->bcamp_reports($conditions);
				$this->load->view("cm/pages/fa_bctvgraph",$dta);
		}
		public function viewBctvgraph2(){  
		        $today = date('Y-m-d');
		        $newdate = date('Y-m-d', strtotime('-1 month', strtotime($today))); 
		        if($this->input->post("asate") != ''){
		            $vsp    =   explode(" - ",$this->input->post("asate"));
		            $newdate = date('Y-m-d', strtotime($vsp['0']));
		            $today = date('Y-m-d', strtotime($vsp['1']));
		        }
		        $conditions['asate']  =  $newdate." - ".$today; 
		            $dta['asate'] =  $newdate." - ".$today;
		        $conditions['bloodbank_type'] = "BCTV (Blood Collection and Transportation Vehicles)";
		        $dta["view"]        =	$this->camp_model->bcamp_reports($conditions);
				$this->load->view("cm/pages/fabctvgraph",$dta);
		}
		public function fa_blodcollection(){
				$dta["view"]        =	$this->version2_model->blood_available(); 
				$dta["sview"]        =	$this->version2_model->blood_collection(); 
				$this->load->view("cm/pages/fa_blodcollection",$dta);
		} 
		public function viewBloodGraph(){
                        $district       =   $this->input->post('district')?$this->input->post('district'):"";
                        if(!empty($district)){
                            $conditions['district'] =   $district;
                        } 
                        $dta["view"]        =	$this->version2_model->osfblood_available($conditions);
                        $dta["district"]    =   $this->common_model->district();
                        $this->load->view("cm/pages/barajax_graph",$dta);
		} 
		public function getvalue(){ 
				$district       =   $this->input->post('district')?$this->input->post('district'):"";
				if(!empty($district)){
					$conditions['district'] =   $district;
				} 
				$dta["view"]	=	$this->version2_model->asblood_available($conditions);
				$this->load->view("cm/pages/fagraph",$dta);
		}
		public function active_camps(){
				$asate                  =   date("Y-m-d");  
				$totalRec               =   $this->camp_model->cntcmp_query(array('asates' => $asate)); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewAcCamps';
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';                
				$this->ajax_pagination->initialize($config); 
				
				$dta["bloodbank_type"]  =   $this->version2_model->bloodbank_type();
				$dta["view"]            =   $this->camp_model->viewcmp_query(array('limit'=>$this->perPage,'asates' => $asate));  
				$dta["limit"]           =   '1';
				$this->load->view("cm/pages/accamps",$dta);
		}
		public function viewAcCamps(){
				$conditions     =   array();
				$page           =   $this->uri->segment('3');
				$offset         =   (!$page)?0:$page;
				$keywords       =   $this->input->post('keywords')?$this->input->post('keywords'):"";  
				$asate          =   $this->input->post("asate")?$this->input->post("asate"):"";  
				$blood_category       =   $this->input->post('blood_category');
				$blood_bank_type        =   $this->input->post('blood_bank_type')?$this->input->post('blood_bank_type'):"";  
				if(!empty($blood_bank_type)){
						$conditions['blood_bank_type']    =   str_replace("+"," ",$blood_bank_type);
				} 
				if(!empty($blood_category)){
					$conditions['blood_category'] = $blood_category;
				}  
				if(empty($asate)){
						$conditions['asates'] = date("Y-m-d");
				} 
				if(!empty($asate)){
						$conditions['asate'] = $asate;
				}  
				if(!empty($keywords)){
						$conditions['keywords'] = $keywords;
				}   
				$totalRec               =   $this->camp_model->cntcmp_query($conditions); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewAcCamps';
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';
				$this->ajax_pagination->initialize($config);
				$conditions['start']    =   $offset;
				$conditions['limit']    =   $this->perPage;
				$dta["view"]            =   $this->camp_model->viewcmp_query($conditions);
				$dta["limit"]           =   $offset+1;
				$this->load->view("cm/pages/ajax_accamps",$dta);
		}
		public function viewtrCollections(){ 
				$blood      =   $this->uri->segment(3); 
				$conditions['bloodbank']=   $blood; 
				$totalRec               =   $this->transfer_model->cnttrn_collec_query($conditions); 
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewTCollections/'.$blood; 
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';       
				$config['uri_segment']  =   '4';
				$this->ajax_pagination->initialize($config); 
				$dta["bloodid"]         =   $blood; 
				$conditions['limit']    =   $this->perPage;
				$dta["view"]            =   $this->transfer_model->vtrn_collec_query($conditions);  
				$dta["limit"]	=	'1';
				$this->load->view("cm/pages/viewtrcollections",$dta);
		}
		public function viewTCollections(){  
				$conditions     =   array();
				$blood          =   $this->uri->segment('3');
				$dta["bloodid"] =   $blood;
				$page           =   $this->uri->segment('4');
				$offset         =   (!$page)?0:$page;
				$keywords       =   $this->input->post('keywords')?$this->input->post('keywords'):"";   
				$asate          =   $this->input->post('asate')?$this->input->post('asate'):"";  
				if(!empty($asate)){
						$conditions['asate'] = $asate;
				} 
				$conditions['bloodbank']            =   $blood; 
				if(!empty($keywords)){
						$conditions['keywords']     =   $keywords;
				}   
				$totalRec               =   $this->transfer_model->cnttrn_collec_query($conditions);
				$this->perPage          =   "15"; 
				$config['base_url']     =   base_url().'cm/viewTCollections/'.$blood;
				$config['total_rows']   =   $totalRec;
				$config['per_page']     =   $this->perPage; 
				$config['link_func']    =   'searchFilter';
				$config['uri_segment']  =   '4';
				$this->ajax_pagination->initialize($config);
				$conditions['start']    =   $offset; 
				$conditions['limit']    =   $this->perPage;
				$dta["view"]            =   $this->transfer_model->vtrn_collec_query($conditions);  
				$dta["limit"]       =	$offset+1;
				$this->load->view("cm/pages/ajax_trcollcs",$dta); 
}
		public function schedules(){
				$uri    =       $this->uri->segment('3');
				$view   =       $this->camp_model->get_camps($uri);
				if(count($view) > 0){
						$dta 	=	array( 
										"ct"    =>	$this->bloodbank_model->blood_groups(),
										"district"	=>	$this->common_model->district(),
										"cmp"           =>      $view
						);
						if($this->input->post("submit")){ ;
								$this->form_validation->set_rules("phone","Mobile No.","required|min_length[10]|max_length[10]");
								$this->form_validation->set_rules("name","Name","required");
								$this->form_validation->set_rules("blood_group","Blood Group","required"); 
								if($this->form_validation->run() == TRUE){
										$up 	=	$this->message_model->send_schedulems($uri);
										if($up > 0){
											$this->session->set_flashdata("suc","Mail has been sent successfully.");
											redirect("cm/schedules/".$uri);
										}else{
											$this->session->set_flashdata("err","Mail has not been sent successfully.");
											redirect("cm/schedules/".$uri);
										}
								}
						}
						$this->load->view("cm/pages/register",$dta);
				}else{
						redirect("/cm");
				}
		} 
		public function pdf_download(){  
                        $uri    =   $this->uri->segment('3');
                        $conditions             =   array();
                        $keywords               =   $this->input->post('keywords')?$this->input->post('keywords'):"";   
                        $district               =   $this->input->post('district')?$this->input->post('district'):"";   
                        $city                   =   $this->input->post('city')?$this->input->post('city'):"";   
                        $blood_bank_type        =   $this->input->post('blood_banktype')?$this->input->post('blood_banktype'):"";  
                        $component              =   $this->input->post('component')?$this->input->post('component'):""; 
                        if(!empty($component)){
                                $conditions['component']    =   $component;
                        }
                        if(!empty($district)){
                                $conditions['district']        =   $district;
                        }
                        if(!empty($city)){
                                $conditions['city']        =   $city;
                        }
                        if(!empty($keywords)){
                                $conditions['keywords']     =   $keywords;
                        }  
                        if(!empty($blood_bank_type)){
                                $conditions['blood_bank_type']    =   $blood_bank_type;
                        }  
                        if($this->input->post('zero_units') != ""){
                                $conditions['zero_units']         =   $this->input->post('zero_units'); 
                        } 
                        $blood_category       =   $this->input->post('blood_category')?$this->input->post('blood_category'):"";
                        if(!empty($blood_category)){
                                $conditions['blood_category'] = $blood_category;
                        }
                        $intervalue      =   $this->input->post('notintervalue')?$this->input->post('notintervalue'):"";
                        if(!empty($intervalue)){
                                $conditions['notintervalue'] = $intervalue;
                        } 
                        if($uri == '1'){
                            $conditions['out_status']  =   '1';
                            $dta["view"]    =   $this->version2_model->oblood_available($conditions);   
                            $html           =   $this->load->view('cm/pages/ajax-bloodavail',$dta, true);    
                            $mgh            =   "Blood Availability";
                        }
                        if($uri == '2'){
                            $dta["view"]    =   $this->version2_model->oblood_collection($conditions);   
                            $html           =   $this->load->view('cm/pages/ajax_collections',$dta, true);    
                            $mgh            =   "Blood Collections";
                        }  
                        $quer       =   $dta["view"];
                        $csv_header =   ""; $csv_row = ""; 
                        $csv_header .= "Blood Bank,District,City,Mobile No,Contact No,Email Id,Category,A+ve,A-ve,B+ve,B-ve,AB+ve,AB-ve,O+ve,O-ve,Updated On";   
                        $csv_header .= "\n";
                        foreach($quer as $vp){    
                                $csv_row .= '"'.$vp->bloodbank_name.'",'; 
                                $csv_row .= '"'.$vp->district.'",'; 
                                $csv_row .= '"'.$vp->city.'",'; 
                                $csv_row .= '"'.$vp->bbmobile.'",'; 
                                $csv_row .= '"'.$vp->contact_no.'",'; 
                                $csv_row .= '"'.$vp->email_id.'",';
                                $csv_row .= '"'.$vp->category.'",';
                                $csv_row .= '"'.$vp->Apos.'",';
                                $csv_row .= '"'.$vp->Aneg.'",';
                                $csv_row .= '"'.$vp->Bpos.'",';
                                $csv_row .= '"'.$vp->Bneg.'",';
                                $csv_row .= '"'.$vp->ABpos.'",';
                                $csv_row .= '"'.$vp->ABneg.'",';
                                $csv_row .= '"'.$vp->Opos.'",';
                                $csv_row .= '"'.$vp->Oneg.'",';
                                $csv_row .= '"'.date("d M Y",strtotime($vp->out_updated_on)).'",';
                                $csv_row .= "\n";
                        // echo $csv_row;exit;
                        } 
                        /* Download as CSV File */
                        header('Content-type: application/csv');
                        header('Content-Disposition: attachment; filename='.str_replace(" ","_",$this->input->post("reports_type")).date('Y-m-d').'.csv');
                        $vsg    =   $csv_header . $csv_row;
                        echo $vsg; 
                        exit;
                }
}
?>