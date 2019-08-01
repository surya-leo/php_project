<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 	= "device"; 
$route['admin'] 				= "admin/login";
$route['admin/dashboard'] 		= "admin/dashboard/index";
$route['admin/logout'] 			= "admin/login/logout";
$route['admin/create_blood_bank'] 		= "admin/bloodbank/create_form";
$route['admin/edit_blood_bank/(:num)'] 		= "admin/bloodbank/edit_form/$1";
$route['admin/change_password'] 		= "admin/settings/change_password";

$route['admin/create_blood_donation'] 	= "admin/blood_donation/create_form";
$route['admin/view_blood_donation'] 	= "admin/blood_donation/view_form"; 

$route['admin/edit_blood_donation/(:num)'] 	= "admin/blood_donation/edit_form/$1";
$route['admin/users'] 	= "admin/settings/users";
$route['admin/camps'] 	= "admin/camps";
$route['admin/bulk_sms/(:num)'] 	= "admin/camps/bulk_sms/$1";
$route['admin/download'] 	= "admin/camps/download";
$route['404_override'] 			= '';
$route['getcamps'] 	= "admin/camps/get_campsre";
$route['camp_active'] 	= "admin/camps/camp_active";
$route['admin/update_camp/(:num)'] 	= "admin/camps/update_camp/$1";

$route['admin/blood_bank'] 		= "admin/settings/blood_bank_form";

$route['dashboard']             = "users/dashboard";
$route['camps'] 		= "users/camps";
$route['admin/app_count'] 	= "admin/camps/app_count"; 

$route['register'] 	= "device/register"; 
$route['otp'] 	= "device/otp";
$route['blood_camp'] 	= "admin/version2/blood_camp";



$route['admin/reports'] 	= "admin/report_details/index";   
$route['get_download']          = "admin/report_details/get_download";
$route['admin/camp_reports'] 	= "admin/report_details/camp_reports"; 
$route['admin/blood_camp_reports'] 	= "admin/report_details/bcamp_reports";

/*** Version 2 **/

$route['admin/donor_medical_checkup/(:num)'] 	= "admin/donation_details/index/$1";
$route['admin/blood_group_serum'] 	= "admin/donation_details/blood_group_serum";
$route['admin/donor_bleeding/(:num)'] 	= "admin/donation_details/donor_bleeding/$1";
$route['admin/blood_grouping/(:num)'] 	= "admin/donation_details/blood_grouping/$1";
$route['admin/component_preparation/(:num)'] 	= "admin/donation_details/component_preparation/$1";
$route['admin/screening/(:num)'] 	= "admin/donation_details/screening/$1";

$route['admin/users/(:num)']                = "admin/settings/users/$1"; 
$route['admin/issue_blood']                 = "admin/blood_details/issue_blood"; 
$route['admin/issue/(:num)']                = "admin/blood_details/issue/$1"; 
$route['admin/issue_submit/(:num)']         = "admin/blood_details/issue_submit/$1";  
$route['admin/donation_summary']            = "admin/report_details/donation_summary";  
$route['admin/detailed_donation']           = "admin/report_details/detailed_donation";  
$route['admin/blood-availability']          = "admin/blood_report_details/blood_availability";  
$route['admin/blood-grouping']              = "admin/blood_report_details/blood_grouping";  
$route['admin/blood-screening']             = "admin/blood_report_details/blood_screening";  
$route['admin/blood-components']            = "admin/blood_report_details/blood_components";  
$route['admin/blood-discarded']             = "admin/blood_report_details/blood_discarded";  
$route['admin/permissions']                 = "admin/permissions/index";  

$route['admin/view-blood-bank/(:num)'] 		= "admin/bloodbank/view_form/$1";
$route['admin/view-mother-blood-bank/(:num)']  = "admin/bloodbank/view_form/$1";
$route['admin/view-blood-storage/(:num)']       = "admin/bloodbank/view_form/$1";
$route['admin/view-bctv/(:num)']                = "admin/bloodbank/view_form/$1";
$route['admin/update-blood-bank/(:num)/(:num)'] 	= "admin/bloodbank/edit_form/$1/$1";
$route['admin/update-mother-blood-bank/(:num)/(:num)'] 	= "admin/bloodbank/edit_form/$1/$1"; 
$route['admin/update-blood-storage/(:num)/(:num)'] 	= "admin/bloodbank/edit_form/$1/$1"; 
$route['admin/update-bctv/(:num)/(:num)']               = "admin/bloodbank/edit_form/$1/$1"; 

$route['admin/create-role']              = "admin/role/create_role";  
$route['admin/view-roles']               = "admin/role/index";  
$route['admin/update-role/(:any)']       = "admin/role/update_role/$1";  
$route['admin/delete-role/(:any)']       = "admin/role/delete_role/$1";  


$route['admin/create-staff']            =   "admin/staff/create_staff";
$route['admin/view-staff']              =   "admin/staff/index"; 
$route['admin/update-staff/(:num)']              =   "admin/staff/update_staff/$1"; 
$route['admin/delete-staff/(:num)']              =   "admin/staff/delete_staff/$1";  

$route['admin/create-employee']              = "admin/employee/create_employee";  
$route['admin/view-employees']               = "admin/employee/view_employees";  
$route['admin/update-employee/(:any)']       = "admin/employee/update_employee/$1";  
$route['admin/delete-employee/(:any)']       = "admin/employee/delete_employee/$1"; 

$route['admin/appointments']            = "admin/version2/appointments";  
$route['admin/issue-summary-reports']            = "admin/issue_reports/summary";  
$route['admin/bloodbank-wise-issued-reports']       = "admin/issue_reports/bloodbankwise";  
$route['admin/detail-blood-issued-reports']         = "admin/issue_reports/detailed_report"; 

$route['admin/out-blood-availability']      =    "admin/bloodavailability/index";  
$route['admin/bloodbank-finance']           =    "admin/bloodbank_finance/index";  
$route['admin/prepare-components']          =    "admin/donation_details/view_donor";  
$route['admin/request-closed-reports']      =    "admin/issue_reports/closed_report";  



$route['admin/blood-request-not-satisfied']         =   "admin/version2/blood_not_satisfied";
$route['admin/transfer-collection']                 =   "admin/version2/blood_transfer_collection";
$route['get_bloodbanks']                            =   "admin/common/get_bloodbanks";
$route['get_transfer_donors']                       =   "admin/common/get_transfer_donors";
$route['get_transfer_num']                          =   "admin/common/get_transfer_num";
$route['admin/collection-reports']                  =   "admin/transfer_collection_reports/collection";
$route['admin/transfer-reports']                    =   "admin/transfer_collection_reports/index";
/** Ajax Pagination **/

$route['admin/viewStaff/(:num)']                = "admin/staff/viewStaff/$1"; 
$route['admin/viewUsers/(:num)']                = "admin/settings/viewUsers/$1"; 
$route['admin/viewBloodbank/(:num)/(:num)'] 	= "admin/bloodbank/viewBloodbank/$1/$1";
$route['admin/viewBlooddonor/(:num)']           = "admin/blood_donation/viewBlooddonor/$1";
$route['admin/viewBloodissue/(:num)']           = "admin/blood_details/viewBloodissue/$1"; 
$route['admin/viewReports/(:num)']              = "admin/bloodbank/viewReports/$1"; 
$route['admin/viewCamps/(:num)']                = "admin/camps/viewCamps/$1"; 
$route['admin/viewDonationsummary/(:num)']      = "admin/report_details/viewDonationsummary/$1"; 
$route['admin/viewDonationdetail/(:num)']       = "admin/report_details/viewDonationdetail/$1"; 
$route['admin/viewRole/(:num)']                 = "admin/role/viewRole/$1"; 
$route['admin/viewEmployee/(:num)']             = "admin/employee/viewEmployee/$1"; 
$route['admin/viewAppoint/(:num)']              = "admin/version2/viewAppoint/$1"; 
$route['admin/viewBloodDonated/(:num)']         = "admin/report_details/viewBloodDonated/$1"; 
$route['admin/viewCampDonor/(:num)']            = "admin/report_details/viewCampDonor/$1"; 
$route['admin/viewBcampreport/(:num)']          = "admin/report_details/viewBcampreport/$1"; 
$route['admin/viewBloodAvailability/(:num)']    = "admin/blood_report_details/viewBloodAvailability/$1"; 
$route['admin/viewBloodGrouping/(:num)']        = "admin/blood_report_details/viewBloodGrouping/$1"; 
$route['admin/viewBloodScreening/(:num)']       = "admin/blood_report_details/viewBloodScreening/$1"; 
$route['admin/viewBloodComponents/(:num)']      = "admin/blood_report_details/viewBloodComponents/$1"; 
$route['admin/viewBloodDiscarded/(:num)']       = "admin/blood_report_details/viewBloodDiscarded/$1"; 
$route['admin/viewIssuedSummary/(:num)']        = "admin/issue_reports/viewIssuedSummary/$1"; 
$route['admin/viewHospitalwiseSummary/(:num)']  = "admin/issue_reports/viewHospitalwiseSummary/$1"; 
$route['admin/viewDetailedIssued/(:num)']       = "admin/issue_reports/viewDetailedIssued/$1"; 
$route['admin/viewNotsatisfied/(:num)']         = "admin/version2/viewNotsatisfied/$1"; 
$route['admin/viewDonors/(:num)']               = "admin/donation_details/viewDonors/$1"; 
$route['admin/viewTransfer/(:num)']             = "admin/transfer_collection_reports/viewTransfer/$1"; 
$route['admin/viewCollection/(:num)']           = "admin/transfer_collection_reports/viewCollection/$1"; 
$route['admin/submitNotsatisfied']              = "admin/version2/submitNotsatisfied"; 
$route['admin/viewFinance/(:num)']              = "admin/bloodbank_finance/viewFinance/$1"; 
$route['admin/viewBloodbankFinance/(:num)']     = "admin/bloodbank_finance/viewBloodbankFinance/$1"; 
$route['admin/viewClosedrequest/(:num)']        = "admin/issue_reports/viewClosedrequest/$1"; 

$route['admin/request_submit']                    = "admin/blood_details/request_submit"; 
$route['admin/change_distr']                    = "admin/common/change_distr"; 


$route['users/userBloodbank/(:num)']            = "users/userBloodbank/$1"; 
$route['users/userBlooddonor/(:num)']           = "users/userBlooddonor/$1"; 
$route['users/userCamps/(:num)']                = "users/userCamps/$1"; 

$route['admin/request-issue']            =     "admin/blood_details/request_issue"; 
$route['admin/outblood-availability']    =     "admin/blood_report_details/outblood_availability"; 
$route['admin/viewOutBloodAvailability/(:num)']    =     "admin/blood_report_details/viewOutBloodAvailability/$1"; 

$route['admin/outblood-collection']    =     "admin/blood_report_details/outblood_collection"; 
$route['admin/viewOutBloodCollection/(:num)']    =     "admin/blood_report_details/viewOutBloodCollection/$1"; 

$route['admin/bulk_preparation']    =     "admin/donation_details/bulk_preparation"; 
$route['admin/bulk_group']          =     "admin/donation_details/bulk_group"; 
$route['admin/bulk_component']      =     "admin/donation_details/bulk_component"; 
$route['admin/bulk_compon']          =     "admin/donation_details/bulk_compon"; 
$route['admin/bulk_screen']          =     "admin/donation_details/bulk_screen"; 
$route['admin/bulk_screening']          =     "admin/donation_details/bulk_screening"; 

/*** API ***/
$route['api_login']                =    "device/login"; 
$route['api_logout']               =    "device/logout"; 
$route['api_register_donor']       =    "donor/register_donor"; 
$route['api_donor_profile']        =    "donor/get_profile"; 
$route['api_update_profile']       =    "donor/edit_profile"; 
$route['api_donation_summary']     =    "donor/get_summary"; 
$route['api_bloodbanks']           =    "bloodbank/get_bloodbanks"; 
$route['api_bloodbank_details']    =    "bloodbank/get_bank_details"; 
$route['api_appointments']         =    "bloodbank/appointments"; 
$route['api_request_blood']        =    "bloodbank/request_blood"; 
$route['api_camps']                =    "version_apis/camps"; 
$route['api_blood_availability']   =    "version_apis/blood_availability"; 
$route['api_not_satisifed']        =    "version_apis/blood_not_satisifed"; 
$route['admin/export_excel/(:num)']      =   "admin/version2/export_excel/$1";
$route['admin/out-blood-collection']     =   "admin/version2/bloodcollection";


$route['admin/discard_submit']                    = "admin/blood_report_details/discard_submit"; 
/* End of file routes.php */
/* Location: ./application/config/routes.php */