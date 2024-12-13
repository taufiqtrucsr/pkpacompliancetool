<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'homepage';
$route['404_override'] = 'homepage/pagenotfound';
$route['translate_uri_dashes'] = FALSE;

$route['discover'] = 'discover';
$route['project-details/(:any)'] = 'discover/getProjectDetails';
$route['more-details/(:any)'] = 'discover/getMoreProjectDetails';

$route['signin'] = 'register/signin';
$route['signup'] = 'register/signup';
$route['signup/postData'] = 'register/signUpPostData';
$route['signup/verifyOtp'] = 'register/verifyOtp';
$route['signup/resendOtp'] = 'register/resendOtp';

//contactUS
$route['contact'] = 'homepage/contactUS';
$route['registration'] = 'register/registration';
/*$route['register/companyPostForm1'] = 'register/companyPostForm1';
$route['register/companyPostForm2'] = 'register/companyPostForm2';
$route['register/ngoPostForm1'] = 'register/ngoPostForm1';
$route['register/ngoPostForm2'] = 'register/ngoPostForm2';
$route['register/ngoPostForm3'] = 'register/ngoPostForm3';*/

$route['company/view'] = 'company/companyView';
$route['company/edit/(:any)'] = 'company/companyEdit';
/*$route['register/companyEditForm1'] = 'register/companyEditForm1';
$route['register/companyEditForm2'] = 'register/companyEditForm2';*/

$route['ngo/view'] = 'ngo/ngoView';
$route['ngo/edit/(:any)'] = 'ngo/ngoEdit';

$route['login/loginpost'] = 'user/loginpost';
$route['logout'] = 'user/logout';

$route['forgotpassword'] = 'forgotpassword/forgotpasswordView';
$route['forgotpassword/postData'] = 'forgotpassword/forgotpasswordmobile';
$route['forgotpassword/verifyOtp'] = 'forgotpassword/forgotpwdOtp';
$route['forgotpassword/resendOtp'] = 'forgotpassword/forgotpwdresendOtp';

//Dashboard
$route['dashboard/projects'] = 'dashboard';
$route['dashboard/contracts'] = 'dashboard';
$route['dashboard/reports'] = 'dashboard';
$route['dashboard/funds'] = 'dashboard';

$route['dashboard/project-details/(:any)'] = 'dashboard/getOwnProjectDetails';

//Project 
$route['create-project'] = 'project/createProject';
$route['project/edit/(:any)'] = 'project/editProject';

//Project 
$route['create-campaign'] = 'motivator/createcampaign';
// $route['project/edit/(:any)'] = 'project/editProject';

//Fund Project 
$route['fund-project/(:any)'] = 'contract/index';

//Profile Verification

$route['myprofile'] = 'myprofile/profileuser';

$route['myprofile/changePassword'] = 'myprofile/profilechangepwdView';
$route['myprofile/postData'] = 'myprofile/profilepwdmobile';
$route['myprofile/verifyOtp'] = 'myprofile/changepwdOtp';
$route['myprofile/resendOtp'] = 'myprofile/changepwdresendOtp';

//Profile Edit Information

$route['myprofile/editInformation'] = 'myprofile/profileeditinfoView';

//Change Mobile Number

//$route['myprofile/changeMobile'] = 'myprofile/mobileeditView';
$route['myprofile/mobilepostData'] = 'myprofile/changeMobilePost';


$route['myprofile/changeMobile'] = 'myprofile/changemobileeditView';
$route['myprofile/changemobilepostData'] = 'myprofile/changemobilenoPost';
$route['myprofile/mobileverifyOtp'] = 'myprofile/changemobileOtp';
$route['myprofile/mobileresendOtp'] = 'myprofile/changemobileresendOtp';

//faq listing 

$route['faqs'] = 'faq/getFaqListView';
$route['faqs/faqList/(:any)'] = 'faq/Get_Detailed_Faqlist';

//cms page management 

$route['page/(:any)'] = 'cms/getPageByIdentifier';

//Project Request Edit

$route['project/request-edit/(:any)'] = 'project/requestEdit';

// email verification 
$route['verify-email-address/(:any)'] = 'myprofile/setEmailVerificationFlag';

//request for edit
// $route['request-for-edit/(:any)'] = 'myprofile/getRequestForEditView';
// $route['request-for-edit-contributor/(:any)'] = 'myprofile/getContributorRequestForEditView';

//request for edit new
$route['request-for-edit/(:any)'] = 'requestedit/getRequestForEditView';
$route['request-for-edit-contributor/(:any)'] = 'companyrequestedit/getContributorRequestForEditView';

//All notification
$route['notifications'] = 'homepage/notificationView';


//Payment
$route['payment'] = 'payment';
$route['payment-status'] = 'payment/getPaymentStatus';

//Donor Payment
$route['donation'] = 'donation';
$route['donor-project-details/(:any)'] = 'donation/donate_project_details';
$route['donor-payment/(:any)'] = 'DonorPayment';
$route['donor-payment-failed'] = 'DonorPayment/PaymentFailed';
