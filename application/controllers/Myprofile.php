<?php
defined('BASEPATH') or exit('No direct script access allowed');

###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Kadambari Sule (kadambari@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - December 2019
###+------------------------------------------------------------------------------------------------

class Myprofile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ForgotpasswordModel');
		$this->load->model('UserModel');
		$this->load->model('CommonModel');
		$this->load->model('CompanyModel');
		$this->load->model('NgoModel');
		$this->load->model('MyprofileModel');
		$this->load->model('EditUserProfileModel');

		if (isset($_SESSION['UserId'])) {
			$_SESSION['countdown'] = 40;
			$_SESSION['time_started'] = date("Y-m-d H:i:s");

			$_SESSION['last_active_time'] = time();
			$end_time = date("Y-m-d H:i:s", strtotime('+' . $_SESSION['countdown'] . 'minutes', strtotime($_SESSION['time_started'])));
			$_SESSION['end_time'] = $end_time;
		} else {
			redirect(base_url());
		}
	}

	function updateEntityProfile()
	{
		// if (isset($_POST) && $_POST != '') 
		// {

		// 	$entitytypeId 		= $_POST['entityType'];
		// 	$state_code   		= $_POST['state'];
		// 	$entitytypeLetter 	= $this->NgoModel->getentitytypeById($entitytypeId);
		// 	$entityType = $_POST['entityType']; //Entity_type
		// 	$entityName = $_POST['entityName']; //entity_name
		// 	$id 		= $_SESSION['UserId'];
		// 	$entityLogo = '';

		// 	if ($_FILES['entityLogo']['name']) 
		// 	{
		// 		$filename 	= $_FILES['entityLogo']['name'];
		// 		$ext 		= strtolower(pathinfo($filename, PATHINFO_EXTENSION));
		// 		$entityLogo = $id . '-' . 'ADD-PROOF' . '.' . $ext;
		// 		$config['upload_path'] = COMPANY_LOGO_PATH;
		// 		$config['overwrite'] = TRUE;
		// 		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		// 		$config['max_size'] = MAX_FILESIZE_BYTE;
		// 		$config['file_name'] = $id . '-' . 'ADD-PROOF';
		// 		$this->load->library('upload', $config);
		// 		$this->upload->initialize($config);
		// 		if ($this->upload->do_upload('entityLogo')) {
		// 			$uploadData = $this->upload->data();
		// 			$entityLogo = $uploadData['file_name'];
		// 		} else {
		// 			echo "<script>alert('".$this->upload->display_errors()."');history.back();</script>";
		// 			exit;
		// 		}
		// 	} else {
		// 		$entityLogo = $_POST['old_logo'];
		// 	}
		// 	$checkIDexists  = $this->NgoModel->GetUserProfileInfo($id);
		// 	$Purpose_entity = isset($_SESSION["Purpose_entity"]) ? $_SESSION["Purpose_entity"] : 0;
		// 	$role = $this->NgoModel->checkUserRole($id);
		// 	//	echo $role;
		// 	if ($role == 3) {
		// 		if (!empty($Purpose_entity)) {
		// 			$Purpose_entity = array_filter($Purpose_entity);
		// 			$Purpose_entity = implode(",", $Purpose_entity);
		// 		} else {
		// 			$Purpose_entity = 0;
		// 		}
		// 	} else {
		// 		$Purpose_entity = 0;
		// 	}

		// 	$entitytypeId = $_POST['entityType'];
		// 	$state_code   = $_POST['state'];
		// 	$entitytypeLetter = $this->NgoModel->getentitytypeById($entitytypeId);
		// 	$entityType = $_POST['entityType']; //Entity_type
		// 	$entityName = $_POST['entityName']; //entity_name
		// 	$id = $_SESSION['UserId'];
		// 	$governing_actID = $_POST['govAct'] ? implode(",", $_POST['govAct']) : 0;

		// 	$saveData = array(
		// 		'entity_name' => $entityName,
		// 		'entity_type' => $entityType,
		// 		'entity_logo' => $entityLogo,
		// 		'about_entity' => $_POST['about_entity'],
		// 		'Date_of_incorp_birth' => $_POST['incorpDate'],
		// 		'entity_address'      => $_POST['registerAddress'],
		// 		'pincode' => $_POST['pincode'],
		// 		'district' => $_POST['District'],
		// 		'city' => $_POST['city'],
		// 		'state' => $_POST['state'],
		// 		'about_entity' => $_POST['entityAbout'],
		// 		'governing_act_id' => $governing_actID,
		// 	);
		// 	$this->db->where('user_id',$id);
		// 	$inserttrue = $this->db->update('user_profile', $saveData);
		// 	redirect(base_url() . 'myprofile');

		// } else {
		// 	echo "<script>alert('Please enter mandatory fields');history.back();</script>";
		// 	exit;
		// }

		if (isset($_POST) && $_POST != '') {
			$checkIDexists = $this->NgoModel->getUserRoleAndProfle($id);
			$image_base64 = $this->input->post('crop_step2_file');
			if ($image_base64) {
				$image_array_1 = explode(";", $image_base64);
				$image_array_2 = explode(",", $image_array_1[1]);
				$image_base64 = base64_decode($image_array_2[1]);
				$folder = NGO_LOGO_PATH;
				$entityLogo = $id . '-' . 'ADD-LOGO' . '.' . time() . ".png";
				$file = $folder . $entityLogo;
				file_put_contents($file, $image_base64);
			} else {
				$entityLogo = $_POST['old_logo'];
			}
			$this->db->where('id', $id);
			$this->db->update('users', array('step' => 2));
			$saveData = array(
				'user_id' => $id,
				'entity_name' => $_POST['entityName'],
				'governing_act_id' => $_POST['govAct'],
				'date_of_incorp_birth' => strtotime($_POST['incorpDate']),
				'website' => $_POST['website'],
				'entity_address' => $_POST['registerAddress_line_1'],
				'pincode' => $_POST['pincode'],
				'district' => $_POST['cityOrDistrict'],
				'city' => $_POST['city'],
				'state' => $_POST['state'],
				'about_entity' => $_POST['about_entity'],
				'entity_logo' => $entityLogo
			);
			if ($checkIDexists) {
				$this->db->where('user_id', $id);
				$this->db->update('user_profile', $saveData);
				redirect("register/ImprRegForm2");
			} else {
				$inserttrue = $this->db->insert('user_profile', $saveData);
				if ($inserttrue) {
					$Profile_id = $this->db->insert_id(); //Primary
					$update_account_id =
						array(
							'profile_id_display' => $Profile_id,
						);
					$this->db->where('id', $id);
					$this->db->update('users', $update_account_id);
				}
				// $current_role = $_SESSION['current_role'];
				// $allcocated_roles = $this->NgoModel->checkUserRole($id);
				// $all = explode(",", $allcocated_roles);
				// if (!in_array($current_role, $all)) {
				// 	array_push($all, $current_role);
				// 	$role_update = array('all_roles_allocated' => implode(',', $all));
				// 	$this->NgoModel->updateUserRoles($id, $role_update);
				// }
				redirect("register/ImprRegForm2");
			}
		}







	}

	function postUser()
	{
		if (isset($_POST) && $_POST != '') {

			if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST["email"])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter a valid Email address."));
				exit;
			} elseif (!preg_match('/^[0-9]*$/', $_POST['mobileNumber'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter valid number."));
				exit;
			}

			// elseif($_POST['inputPassword'] != $_POST['inputConfPassword']) {
			// 	echo json_encode(array('flag'=>0, 'msg'=>"Confirm Password does not match."));
			// 	exit;
			// } 
			else {
				// NK - 01-04-22 - code commented
				// Verify the reCAPTCHA response 
				// $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLE_RECAPTCHA_SECRET_KEY.'&response='.$_POST['g-recaptcha-response']); 

				// Decode json data 
				// $responseData = json_decode($verifyResponse); 

				// If reCAPTCHA response is valid 
				// if($responseData->success) {
				$EntityType = 'Test';
				$UserDetails = $this->UserModel->GetUserByEmail($_POST['email'], $EntityType);
				$UserDetails2 = $this->UserModel->GetUserByPhone($_POST['mobileNumber'], $EntityType);


				if (isset($UserDetails) && $UserDetails->id != '' && $_POST['mobileNumber'] != 1234567891) {
					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this email address."));
					exit;
				} elseif (isset($UserDetails2) && $UserDetails2->id != '' && $_POST['mobileNumber'] != 1234567891) {

					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this phone number."));
					exit;
				} else {

					$string = '0123456789';
					$string_shuffled = str_shuffle($string);
					$getOTP = substr($string_shuffled, 0, 4);

					$insertOTPdata = array(

						'phone_no' => $_POST['mobileNumber'],
						'otp' => $getOTP,

					);
					$this->db->insert('otp', $insertOTPdata);


					$mtd = "sms";
					//$mesg = 'Thank You for Signing up in truCSR. Your 4 digits OTP is '.$getOTP.'. Use this to complete the Signup process.';
					$mesg1 = 'Welcome to truCSR.';
					$mesg1 .= 'Your 4 digit OTP to complete the Signup process is ' . $getOTP . '. Kindly don\'t share your OTP with anyone.';
					$mesg1 .= '-';
					$mesg1 .= 'truCSR.in';
					$mesg = urlencode($mesg1);

					$mob = $_POST['mobileNumber'];
					$send = "truCSR";
					$key = "A6caf2ce090e57e969d65c6111ef27bb9";
					//$template_id = "1007160093502103810";
					$template_id = "1007162762935940433";

					$url = 'https://api-alerts.kaleyra.com/v4/?api_key=' . $key . '&method=' . $mtd . '&message=' . $mesg . '&to=' . $mob . '&sender=' . $send . '&template_id=' . $template_id . ''; // API URL
					//print_r($url);exit;

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_POST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
					$result = curl_exec($ch);

					echo json_encode(array('flag' => 1, 'msg' => "Enter OTP which sent your registered mobile no.", 'phone' => $_POST['mobileNumber']));
					exit;

				}
				// } else {
				// 	echo json_encode(array( 
				// 		'flag' => 0,
				// 		'msg' => "Robot verification failed, please try again."
				// 	));
				// 	exit;
				// }
			}

		} else {

			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	/*public function profileuser()
	{
		if (isset($_SESSION['UserId'])) {
			//echo $_SESSION['UserId'];
			$data['PageTitle'] = SITE_NAME . ' - My Profile';
			$data['UserDetails'] = $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			$data['companyDetails'] = $companyDetails = $this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
			$data['ngoDetails'] = $ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);


			if ($UserDetails->user_type == 1) {
				if ($ngoDetails == '') {
					$data['boardMembersData'] = '';
				} else {
					$data['boardMembersData'] = $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);
				}
			} elseif ($UserDetails->user_type == 2) {
				if ($companyDetails == '') {
					$data['boardMembersData'] = '';
				} else {
					$data['boardMembersData'] = $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);
				}
			}

			$get_user_account_id = $this->NgoModel->GetUserProfileId($_SESSION['UserId']); //comment by webdev
			$user_account_id = $get_user_account_id;

			$get_user_finance_account = $this->NgoModel->GetUserFinancialDetails($user_account_id);
			$data['user_finance_account'] = $get_user_finance_account;
			$data['State'] = $this->CommonModel->get_state();

			$userid = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			$account_id = $this->NgoModel->GetUserProfileAccountId($userid);
			$profile_id = $this->NgoModel->GetUserProfileAccountId($userid);
			$bank_query = "SELECT * FROM `bank_details` WHERE `profile_id` = " . $profile_id . "";
			$bank_data = $this->db->query($bank_query)->row();

			if ($profile_id) {
				$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle($userid);
			} else {
				$data['usersprofile'] = array();
			}

			$incop_document = $this->NgoModel->getUserDocuments($profile_id, 'CIN');
			$trust_document = $this->NgoModel->getUserDocuments($profile_id, 'TRUSTDEED');
			$eighty_g_document = $this->NgoModel->getUserDocuments($profile_id, '80G_REGISTRATION');
			$twelve_a_document = $this->NgoModel->getUserDocuments($profile_id, '12A_REGISTRATION');
			$pan_document = $this->NgoModel->getUserDocuments($profile_id, 'PAN');
			$data['pan_document'] = $pan_document;
			$data['incop_document'] = $incop_document;
			$data['trust_document'] = $trust_document;
			$data['eighty_g_document'] = $eighty_g_document;
			$data['twelve_a_document'] = $twelve_a_document;

			$ac_document = $this->NgoModel->getUserDocuments($profile_id, '35AC_REGISTRATION');
			$fcra_document = $this->NgoModel->getUserDocuments($profile_id, 'FCRA_REGISTRATION');
			$csr_document = $this->NgoModel->getUserDocuments($profile_id, 'CSR_REGISTRATION');
			$ngo_darpan_document = $this->NgoModel->getUserDocuments($profile_id, 'NGO_DARPAN');


			$data['ac_document'] = $ac_document;
			$data['fcra_document'] = $fcra_document;
			$data['csr_document'] = $csr_document;
			$data['ngo_darpan_document'] = $ngo_darpan_document;

			$gst_document = $this->NgoModel->getUserDocuments($profile_id, 'GST');
			$add_one_document = $this->NgoModel->getUserDocuments($profile_id, 'Additional_Certificate_1');
			$add_two_document = $this->NgoModel->getUserDocuments($profile_id, 'Additional_Certificate_2');
			$add_three_document = $this->NgoModel->getUserDocuments($profile_id, 'Additional_Certificate_3');

			$data['gst_document'] = $gst_document;
			$data['add_one_document'] = $add_one_document;
			$data['add_two_document'] = $add_two_document;
			$data['add_three_document'] = $add_three_document;


			$this->load->view('profile/profileinfo', $data);
			//$this->load->view('profile/contributor/profileinfo', $data);
		} else {
			redirect(base_url());
		}
	}*/
	public function profileuser()
	{
		if (isset($_SESSION['UserId'])) {
	
			$data['PageTitle'] = SITE_NAME . ' - My Profile';
			$data['UserDetails'] = $this->UserModel->GetUserDetails($_SESSION['UserId']);
			if($data['UserDetails']){
				$return = $this->CommonModel->TblSelectedRecords('district_master','dst_name',array('id' => $data['UserDetails']->district));
				$data['UserDetails'] = (object) array_merge((array) $data['UserDetails'], (array) $return);

				$return = $this->CommonModel->TblSelectedRecords('district_master','dst_name as city_name',array('id' => $data['UserDetails']->city));
				$data['UserDetails'] = (object) array_merge((array) $data['UserDetails'], (array) $return);
			}
			$data['entities'] = $this->CommonModel->TblRecords('user_profile','','',array('user_id' => $_SESSION['UserId']),'','');

			$data['incop_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'CIN');
			$data['trust_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'TRUSTDEED');
			$data['eighty_g_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], '80G_REGISTRATION');
			$data['twelve_a_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], '12A_REGISTRATION');
			$data['pan_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'PAN');
			$data['ac_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], '35AC_REGISTRATION');
			$data['fcra_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'FCRA_REGISTRATION');
			$data['csr_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'CSR_REGISTRATION');
			$data['ngo_darpan_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'NGO_DARPAN');
			$data['gst_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'GST');
			$data['add_one_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'Additional_Certificate_1');
			$data['add_two_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'Additional_Certificate_2');
			$data['add_three_document'] = $this->NgoModel->getUserDocuments($_SESSION['ProfileId'], 'Additional_Certificate_3');

			$data['boardMembersData'] = $this->CommonModel->TblRecords('governing_body','','',array('profile_id' => $_SESSION['ProfileId']),'','');
			
			$data['primary_bank_account'] = $this->CommonModel->TblRecords('bank_details','','',array('profile_id' => $_SESSION['ProfileId'],'role_id' => $_SESSION['ActiveRole'],'is_emandate_enabled' => 1),'','');
			$data['fcra_bank_account'] = $this->CommonModel->TblRecords('bank_details','','',array('profile_id' => $_SESSION['ProfileId'],'role_id' => $_SESSION['ActiveRole'],'is_FCRA' => 1),'','');
			
			$data['sectors'] = $this->CommonModel->TblRecords('sector_master','','','','','');
			$data['imp_exp'] = $this->NgoModel->getImplementationExp($_SESSION['ProfileId'], $_SESSION['ActiveRole']);
			$data['business_areas'] = $this->NgoModel->getBusinessOperation($_SESSION['ProfileId'], $_SESSION['ActiveRole']);	

			$data['users'] = $this->CommonModel->TblRecords('users','','',array('profile_id_display' => $_SESSION['ProfileId']),'','');

			if($_SESSION['ActiveRole'] == 2)
				$this->load->view('profile/contributor/profileinfo', $data);
			else
				$this->load->view('profile/profileinfo', $data);
		} else {
			redirect(base_url());
		}
	}
	function editDocuments()
	{
		if (isset($_SESSION['UserId'])) {

			$data['PageTitle'] = SITE_NAME . ' : My Profile - Edit Financial Report';

			//$data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);
			//$get_user_account_id = $this->NgoModel->GetUserProfileId($_SESSION['UserId']);
			//$user_account_id     = $get_user_account_id;

			// $data['usersdocuments']     = $this->NgoModel->documentsbyprofileId($user_account_id);
			// $data['governing_body']     = $this->NgoModel->governing_bodyByprofileId($user_account_id);
			// $data['twelveAC']           = $this->NgoModel->getTwelveAC($user_account_id);
			// $data['eightyAC']           = $this->NgoModel->getEightyAC($user_account_id);
			// $data['thirtyFive']         = $this->NgoModel->getThirtyFive($user_account_id);

			// $data['fcra']      = $this->NgoModel->getFcra($user_account_id);
			// $data['fcra']      = $this->NgoModel->getFcra($user_account_id);
			// $data['csr']       = $this->NgoModel->getUserDocuments($user_account_id,'CSR_REGISTRATION');
			// $data['ngodarpan'] = $this->NgoModel->getUserDocuments($user_account_id,'NGO_DARPAN');

			// $data['additional1'] = $this->NgoModel->getUserDocuments($user_account_id,'Additional_Certificate_1');
			// $data['additional2'] = $this->NgoModel->getUserDocuments($user_account_id,'Additional_Certificate_2');
			// $data['additional3'] = $this->NgoModel->getUserDocuments($user_account_id,'Additional_Certificate_3');

			// $data['usersdocuments_pan'] = $this->NgoModel->documentsPANId($user_account_id);
			// $data['usersdocuments_gst'] = $this->NgoModel->documentsGSTId($user_account_id);
			// $data['usersdocuments_regcert'] = $this->NgoModel->documentsUploadRegisterationCertificateId($user_account_id);

			// $data['usersdocuments_trustdeed'] = $this->NgoModel->documentsTRUSTDEEDId($user_account_id);
			// $this->breadcrumb->add('Edit Documents', base_url('myprofile'));
			// $this->breadcrumb->add('Edit Documents');

			// $data['breadcrumbs'] = $this->breadcrumb->render(); 

			$userid = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			$account_id = $this->NgoModel->GetUserProfileAccountId($userid);
			$profile_id = $this->NgoModel->GetUserProfileAccountId($userid);
			$bank_query = "SELECT * FROM `bank_details` WHERE `profile_id` = " . $profile_id . "";
			$bank_data = $this->db->query($bank_query)->row();

			if ($profile_id) {
				$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle($userid);
			} else {
				$data['usersprofile'] = array();
			}

			$incop_document = $this->NgoModel->getUserDocuments($profile_id, 'CIN');
			$trust_document = $this->NgoModel->getUserDocuments($profile_id, 'TRUSTDEED');
			$eighty_g_document = $this->NgoModel->getUserDocuments($profile_id, '80G_REGISTRATION');
			$twelve_a_document = $this->NgoModel->getUserDocuments($profile_id, '12A_REGISTRATION');
			$pan_document = $this->NgoModel->getUserDocuments($profile_id, 'PAN');
			$data['pan_document'] = $pan_document;
			$data['incop_document'] = $incop_document;
			$data['trust_document'] = $trust_document;
			$data['eighty_g_document'] = $eighty_g_document;
			$data['twelve_a_document'] = $twelve_a_document;

			$ac_document = $this->NgoModel->getUserDocuments($profile_id, '35AC_REGISTRATION');
			$fcra_document = $this->NgoModel->getUserDocuments($profile_id, 'FCRA_REGISTRATION');
			$csr_document = $this->NgoModel->getUserDocuments($profile_id, 'CSR_REGISTRATION');
			$ngo_darpan_document = $this->NgoModel->getUserDocuments($profile_id, 'NGO_DARPAN');


			$data['ac_document'] = $ac_document;
			$data['fcra_document'] = $fcra_document;
			$data['csr_document'] = $csr_document;
			$data['ngo_darpan_document'] = $ngo_darpan_document;

			$gst_document = $this->NgoModel->getUserDocuments($profile_id, 'GST');
			$add_one_document = $this->NgoModel->getUserDocuments($profile_id, 'Additional_Certificate_1');
			$add_two_document = $this->NgoModel->getUserDocuments($profile_id, 'Additional_Certificate_2');
			$add_three_document = $this->NgoModel->getUserDocuments($profile_id, 'Additional_Certificate_3');

			$data['gst_document'] = $gst_document;
			$data['add_one_document'] = $add_one_document;
			$data['add_two_document'] = $add_two_document;
			$data['add_three_document'] = $add_three_document;


			$data['orgtype'] = $this->UserModel->Imporgtype();
			$this->load->view('profile/editDocuments', $data);


		} else {
			redirect(base_url());
		}
	}

	function addUser()
	{
		if (isset($_SESSION['UserId'])) {
			$data['PageTitle'] = SITE_NAME . ' : My Profile - Add User';
			$this->breadcrumb->add('Add User', base_url('myprofile'));
			$this->breadcrumb->add('Add User');
			$data['breadcrumbs'] = $this->breadcrumb->render();
			$this->load->view('profile/addUser', $data);
		} else {
			redirect(base_url());
		}
	}
	function saveBankDetails(){

		$cheque = '';
		if ($_FILES['cheque']['name']) {
			$file_name = $_FILES['cheque']['name'];
			$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$cheque = $_SESSION['UserId'] . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
			$config['upload_path'] = FINANCIAL_REPORT_PATH;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
			$config['max_size'] = MAX_FILESIZE_BYTE;
			$config['file_name'] = $_SESSION['UserId'] . '-' . strtotime(date('Y-m-d H:i:s'));
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('cheque')) {
				$uploadData = $this->upload->data();
				$cheque = $uploadData['file_name'];
			} 
		}

		$info = [
			'profile_id' => $_SESSION['ProfileId'],
			'email_id' => $_POST['bank_email_id'],
			'role_id' => $_SESSION['current_role'],
			'bank_name' => $_POST['bank_name'],
			'account_holder_name' => $_POST['account_holder_name'],
			'account_no' => $_POST['acc_number'],
			'ifsc_code' => $_POST['ifsc_code'],
			'is_FCRA' => $_POST['fcra'],
			'cancelled_cheque_image' => $cheque,
			'branch_name' => $_POST['branch_name'],
			'created_at' => strtotime(date('Y-m-d H:i:s'))
		];
		$this->db->insert('bank_details', $info);
		redirect(base_url().'myprofile');
	}
	function editFinancialReport()
	{
		if (isset($_SESSION['UserId'])) {
			$data['PageTitle'] = SITE_NAME . ' : My Profile - Edit Financial Report';
			// $data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);
			// $get_user_account_id=$this->NgoModel->GetUserProfileId($_SESSION['UserId']);
			// $user_account_id=$get_user_account_id;
			// $get_user_finance_account=$this->NgoModel->GetUserFinancialDetails($user_account_id);
			// $data['user_finance_account']=$get_user_finance_account;
			// $this->breadcrumb->add('Edit Financial Report', base_url('myprofile'));
			// $this->breadcrumb->add('Edit Financial Report');
			// $data['breadcrumbs'] = $this->breadcrumb->render(); 

			$userid = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			$account_id = $this->NgoModel->GetUserProfileAccountId($userid);
			$profile_id = $this->NgoModel->GetUserProfileAccountId($userid);
			$bank_query = "SELECT * FROM `bank_details` WHERE `profile_id` = " . $profile_id . "";
			$bank_data = $this->db->query($bank_query)->row();
			$data['bank_data'] = $bank_data;
			if ($profile_id) {
				$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle($userid);
				$Profile_ID = $data['usersprofile']->id;

				$finan_report_query = $this->db->query("SELECT * FROM `financial_report` WHERE `profile_id` = " . $Profile_ID . "");
				$report_data = $finan_report_query->result_array();
				$data['report_data'] = $report_data;

				$query = "SELECT * FROM `implementation_exp` WHERE `profile_id` = " . $Profile_ID . "";
				$result = $this->db->query($query)->row();
				$data['imp_data'] = $result;
			} else {
				$data['usersprofile'] = array();
			}

			$data['orgtype'] = $this->UserModel->Imporgtype();




			$this->load->view('profile/editFinancialReport', $data);
		} else {
			redirect(base_url());
		}
	}
	function editImplementationexp()
	{
			$data['PageTitle'] = SITE_NAME . ' : My Profile - Edit IMplementation Experience';
			$this->load->view('profile/editImplementationexp', $data);
	}

	function editEntityProfile()
	{
		// if(isset($_SESSION['UserId'])) {	
		// 	$data['PageTitle'] = SITE_NAME.' : My Profile - Edit Entity Profile';
		// 	$data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);
		// 	$get_user_account_id=$this->NgoModel->GetUserProfileId($_SESSION['UserId']);
		// 	$user_account_id=$get_user_account_id;
		// 	$this->breadcrumb->add('Edit Entity Profile', base_url('myprofile'));
		// 	$this->breadcrumb->add('Edit Entity Profile');
		// 	$data['breadcrumbs'] = $this->breadcrumb->render(); 
		// 	$entity_name = $this->db->get_where('org_type_master',array('id'=>$data['UserDetails']->user_type))->row();
		// 	$entityquery = $this->db->query("SELECT * FROM `org_type_master`");
		// 	$entities = $entityquery->result_array();
		// 	$gov_query = $this->db->query("SELECT * FROM `governing_act`");
		// 	$gov_act = $gov_query->result_array();
		// 	$query = $this->db->query("SELECT * FROM `state_master`");
		// 	$state = $query->result_array();

		// 	$userStatus = $data['UserDetails']->user_status;
		// 	if($userStatus == 2){
		// 		$updateData = array( 
		// 			'reject_edit_flag'=> 1,
		// 			'reject_edit_date'=> date('Y-m-d')
		// 		);

		// 		$this->db->where('id', $UserId);
		// 		$this->db->update('users', $updateData);
		// 	}

		// 	$data['entityDetail'] = $entity_name;
		// 	$data['entities'] = $entities;
		// 	$data['states'] = $state;
		// 	$data['gov_act'] = $gov_act;
		// 	$data['district'] = $this->db->query('select * from district_master')->result_array();
		// 	$data['ngoDetails'] = $ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
		// 	$this->load->view('profile/editEntityProfile', $data);
		// } 
		// else{
		// 	 redirect(base_url());
		//  }

		// if (in_array( $impid =1 , $this->assoc_roles_in_array))
		// {
		// 	redirect("dashboard/kycdashboard");
		// }
		$userid = $_SESSION['UserId'];
		$role_id = $_SESSION['current_role'];
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);


		//echo '<pre>', var_dump( $UserDetails ); echo '</pre>';

		$account_id = $this->NgoModel->GetUserProfileAccountId($userid);
		if ($account_id) {
			$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle($userid);
		} else {
			$data['usersprofile'] = array();
		}
		$data['orgtype'] = $this->UserModel->Imporgtype();

		//CHECK IF DATA EXISTS
		//	$data['']
		$query = $this->db->get_where('edit_user_profile', array('user_id' => $userid));
		$existingRecord = $query->row();
		$this->load->view('profile/editEntityProfile', $data);

	}

	function updateAddEntity()
	{
		$id = $_SESSION['UserId'];
		if (isset($_POST) && $_POST != '') {
			$image_base64 = $this->input->post('crop_step2_file');
			if ($image_base64) {
				$image_array_1 = explode(";", $image_base64);
				$image_array_2 = explode(",", $image_array_1[1]);
				$image_base64 = base64_decode($image_array_2[1]);
				$folder = NGO_LOGO_PATH;
				$entityLogo = $id . '-' . 'ADD-LOGO' . '.' . time() . ".png";
				$file = $folder . $entityLogo;
				file_put_contents($file, $image_base64);
			} else {
				$entityLogo = $_POST['old_logo'];
			}
			$saveData = array(
				'user_id' => $id,
				'entity_name' => $_POST['entityName'],
				'entity_logo' => $entityLogo,
				//'governing_act_id' => $_POST['govAct'],
				'Date_of_incorp_birth' => strtotime($_POST['incorpDate']),
				'website' => $_POST['website'],
				'entity_address' => $_POST['registerAddress_line_1'],
				'pincode' => $_POST['pincode'],
				'district' => $_POST['cityOrDistrict'],
				'city' => $_POST['city'],
				'state' => $_POST['state'],
				'about_entity' => $_POST['about_entity'],
				'entity_logo' => $entityLogo
			);

			$existingRecord = $this->EditUserProfileModel->checkUserProfileExists($_SESSION['UserId']);
			if ($existingRecord) {
				$this->db->where('user_id', $id);
				$this->db->update('edit_user_profile', $saveData);
			} else {
				$EntityName = $UserDetails->entity_name;
				$inserttrue = $this->db->insert('edit_user_profile', $saveData);
			}
			redirect("editEntityProfile");
		}
	}

	function editBoardMembers()
	{
		$data['PageTitle'] = SITE_NAME . ' : My Profile - Add User';
		$userid = $_SESSION['UserId'];
		$sql = "SELECT id FROM `user_profile` WHERE `user_id` = " . $userid . "";
		$user_profiles = $this->db->query($sql)->row();
		$profile_id = $user_profiles->id;
		$bank_query = "SELECT * FROM `bank_details` WHERE `profile_id` = " . $profile_id . "";
		$bank_data = $this->db->query($bank_query)->row();
		$data['bank_data'] = $bank_data;
		$gov_query = $this->db->query("SELECT * FROM `governing_body` WHERE `profile_id` = " . $profile_id . "");
		$gov_data = $gov_query->result_array();
		$data['gov_data'] = $gov_data;
		$this->load->view('profile/editBoardMembers', $data);
	}

	public function updateBoardMembers()
	{

		$userid = $_SESSION['UserId'];
		$sql = "SELECT id FROM `user_profile` WHERE `user_id` = " . $userid . "";
		$user_profiles = $this->db->query($sql)->row();
		$profile_id = $user_profiles->id;
		$this->db->where('profile_id', $profile_id);
		$this->db->delete('governing_body');
		$boards = $_POST['gov_body_detail'];

		foreach ($boards as $key => $boardsvalue) {
			$gov_data = [
				'governing_body_name' => $boardsvalue['governing_body_name'],
				'position_or_designation' => $boardsvalue['position_or_designation'],
				'din_or_DPIN' => $boardsvalue['din_or_pan'],
				'category' => $boardsvalue['category'],
				'date_of_cession' => $boardsvalue['date_of_cession'],
				'profile_id' => $profile_id,
				'role_id' => $_SESSION['current_role'],
				'created_at' => date('Y-m-d H:i:s')
			];
			$this->db->insert('governing_body', $gov_data);
		}

		// $cheque = '';
		// if ($_FILES['cheque']['name']) {
		// 	$file_name = $_FILES['cheque']['name'];
		// 	$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
		// 	$cheque = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
		// 	$config['upload_path'] = FINANCIAL_REPORT_PATH;
		// 	$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
		// 	$config['max_size'] = MAX_FILESIZE_BYTE;
		// 	$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
		// 	//Load upload library and initialize configuration
		// 	$this->load->library('upload', $config);
		// 	$this->upload->initialize($config);
		// 	if ($this->upload->do_upload('cheque')) {
		// 		$uploadData = $this->upload->data();
		// 		$cheque = $uploadData['file_name'];
		// 	} 
		// 	// else {
		// 	// 	echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
		// 	// 	exit;
		// 	// }
		// }

		// $bank_data = [
		// 	'profile_id' => $profile_id,
		// 	'email_id' => $_POST['bank_email_id'],
		// 	'role_id' => $_SESSION['current_role'],
		// 	'bank_name' => $_POST['bank_name'],
		// 	'account_holder_name' => $_POST['account_holder_name'],
		// 	'account_no' => $_POST['acc_number'],
		// 	'ifsc_code' => $_POST['ifsc_code'],
		// 	'branch_name' => $_POST['branch_name'],
		// 	'created_at' => date('Y-m-d H:i:s')
		// ];
		// if ($_POST['bank_profile_id']) {
		// 	$this->db->where('profile_id', $profile_id);
		// 	$this->db->update('bank_details', $bank_data);
		// } else {
		// 	$this->db->insert('bank_details', $bank_data);
		// }
		//Update kYC
		// $saveData = 
		// [
		// 	'kyc_status'=>4
		// ];
		$this->db->where('user_id', $_SESSION['UserId']);
		$this->db->update('user_profile', $saveData);
		//Update kYC
		$current_active_role = $_SESSION['current_role'];
		//Update Assocciated

		$users = $this->UserModel->get_users($userid);
		$all_roles_allocated = $users->all_roles_allocated;

		if (strpos($all_roles_allocated, $current_active_role) === false) {
			$all_roles_allocated = $all_roles_allocated . ', ' . $current_active_role;
		}

		$user_role = [
			'all_roles_allocated' => $all_roles_allocated
		];
		$this->db->where('id', $userid);
		$this->db->update('users', $user_role);

		$this->roleAllocation($userid, $current_active_role);

		//Update Assocciated
		/*$this->load->library('uuid');
			  $guid = $this->uuid->v4();
			  $terms_and_cond_data = [
				  'profile_id' => $profile_id,
				  't_c_type' => 'normal',
				  'GUID' => $guid,
				  'project_id' => 0,
				  'IP' => $_SERVER['REMOTE_ADDR'],
				  'Terms_Condition_version' => 1.1,
				  'tnc_status' => 1,
				  'created_at' => date('Y-m-d H:i:s')
			  ];
			  $tcs = "SELECT * FROM `terms_and_condition` WHERE `profile_id` = " . $profile_id . "";
			  $tcs_check = $this->db->query($tcs)->row();
			  if ($tcs_check) {
				  $this->db->where('profile_id', $profile_id);
				  $this->db->update('terms_and_condition', $terms_and_cond_data);
			  } else {
				  $this->db->insert('terms_and_condition', $terms_and_cond_data);
			  }*/
		$sql = "SELECT `GUID` FROM `users` WHERE `id` = " . $userid . "";
		$user = $this->db->query($sql)->row();
		$consent = fatch_consent(CONSENT[2]);
		if (isset($user->GUID) && $consent) {
			$info = array(
				't_c_type' => 2,
				'GUID' => $user->GUID,
				'IP' => $this->input->ip_address(),
				'OS_system' => $this->agent->platform(),
				'T_n_c_template_id' => $consent->id,
				'terms_condition_version' => $consent->version,
				'tnc_status' => 1,
				'created_at' => strtotime(date('Y-m-d H:i:s')),
				'updated_at' => strtotime(date('Y-m-d H:i:s'))
			);
			save_consent($info);
		}

		$this->db->where('id', $userid);
		$this->db->update('users', array('step' => NULL));

		$this->srmAllocation($profile_id);

		if (isset($_GET['profile'])) {
			redirect(current_url());
		}

		//redirect('/dashboard/kycdashboard');

		redirect(current_url());


	}

	function updateFinancialReport()
	{
		foreach ($_POST['id'] as $k => $v) {
			$updateData = array(
				'corpus_funds' => $_POST['corpus_funds_' . $_POST['key'][$k]],
				'liabilities' => $_POST['liablities_' . $_POST['key'][$k]],
				'donations_received' => $_POST['donations_received_' . $_POST['key'][$k]],
				'csr_fund_received' => $_POST['csr_fund_received_' . $_POST['key'][$k]],
				'other_receipts' => $_POST['other_receipts_' . $_POST['key'][$k]],
				'project_expenses' => $_POST['project_expenses_' . $_POST['key'][$k]],
				'other_expenses' => $_POST['other_expenses_' . $_POST['key'][$k]],
			);
			$this->db->where('id', $v);
			$this->db->update('financial_report', $updateData);
			if ($k == (count($_POST['id'])) - 1) {
				echo "<script>alert('Report Updated Successfully');location.href='" . base_url() . "myprofile'</script>";
			}
		}
	}

	public function getbilling()
	{
		$year = $this->input->post('yearchange');
		$ngo_id = $this->input->post('ngo_id');
		$getbillingYearly = $this->NgoModel->getbilling($ngo_id, $year, 'yearly');
		$getbillingMonthly = $this->NgoModel->getbilling($ngo_id, $year, 'monthly');
		echo json_encode(array('getbillingYearly' => $getbillingYearly, 'getbillingMonthly' => $getbillingMonthly, 'ngo_id' => $ngo_id, 'year' => $year));
	}

	public function getdonationreport()
	{
		if (isset($_POST) && $_POST != '') {
			//echo "<pre>";print_r($_POST);echo "</pre>";
			$month = $this->input->post('month');
			$ngo_id = $this->input->post('ngo_id');
			$start_date = date("d-m-Y", strtotime($month));
			$end_date = date("t-m-Y", strtotime($month));
			//echo $start_date."<hr>".$end_date."<hr>";
			$donationDetails = $this->MyprofileModel->getDonationDetails($ngo_id, $start_date, $end_date);
			$ngoData = $this->db->get_where('ngo_details', array('id' => $ngo_id))->row();
			$ngo = $ngoData->org_name;
			$ngoADD1 = $ngoData->org_address_line1;
			$ngoADD2 = $ngoData->org_address_line2;
			$ngocity = $ngoData->city;
			$ngostate = $ngoData->state;
			$ngopincode = $ngoData->pincode;
			$data['ngo'] = $ngo;
			$data['address'] = "$ngoADD1, $ngocity, $ngostate - $ngopincode";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$donationRaised = 0;
			$donationDeducted = 0;
			$donationSettled = 0;
			$projectArr = array();
			$trucsr_platform_fee_percent = TRUCSR_PLATFORM_FEE_PERCENTAGE;
			for ($i = 0; $i < count($donationDetails); $i++) {
				$donationRaised = $donationRaised + $donationDetails[$i]->donation_amount;
				if (!isset($donationDetails[$i]->totalPlatFormFee)) {
					$donationDetails[$i]->totalPlatFormFee = 0;
				}

				if (!isset($donationDetails[$i]->gstPlatFormFee)) {
					$donationDetails[$i]->gstPlatFormFee = 0;
				}

				if ($donationDetails[$i]->trasnfer_status == 1) {
					$totalPlatFormFee = round(($donationDetails[$i]->donation_amount * $trucsr_platform_fee_percent) / 100, 2);
					$deduct = $donationDetails[$i]->donation_amount - $donationDetails[$i]->transfer_amount;
					$gstPlatFormFee = $deduct - $totalPlatFormFee;
					$donationDeducted = $donationDeducted + $deduct;
					$donationSettled = $donationSettled + $donationDetails[$i]->transfer_amount;
					$donationDetails[$i]->totalPlatFormFee = $totalPlatFormFee;
					$donationDetails[$i]->gstPlatFormFee = $gstPlatFormFee;
				}

				$projectArr[$donationDetails[$i]->project_id]['project_id'] = $donationDetails[$i]->project_id;
				$projectArr[$donationDetails[$i]->project_id]['project'] = $donationDetails[$i]->project;
				$projectArr[$donationDetails[$i]->project_id]['transaction'][] = $donationDetails[$i];

				if (!isset($projectArr[$donationDetails[$i]->project_id]['donationRaised'])) {
					$projectArr[$donationDetails[$i]->project_id]['donationRaised'] = 0;
				}

				if (!isset($projectArr[$donationDetails[$i]->project_id]['platFormFee'])) {
					$projectArr[$donationDetails[$i]->project_id]['platFormFee'] = 0;
				}

				if (!isset($projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee'])) {
					$projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee'] = 0;
				}

				if (!isset($projectArr[$donationDetails[$i]->project_id]['donationDeducted'])) {
					$projectArr[$donationDetails[$i]->project_id]['donationDeducted'] = 0;
				}

				if (!isset($projectArr[$donationDetails[$i]->project_id]['donationSettled'])) {
					$projectArr[$donationDetails[$i]->project_id]['donationSettled'] = 0;
				}
				$projectArr[$donationDetails[$i]->project_id]['donationRaised'] = $projectArr[$donationDetails[$i]->project_id]['donationRaised'] + $donationDetails[$i]->donation_amount;
				if ($donationDetails[$i]->trasnfer_status == 1) {
					$projectArr[$donationDetails[$i]->project_id]['platFormFee'] = $projectArr[$donationDetails[$i]->project_id]['platFormFee'] + $totalPlatFormFee;
					$projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee'] = $projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee'] + $gstPlatFormFee;
					$projectArr[$donationDetails[$i]->project_id]['donationDeducted'] = $projectArr[$donationDetails[$i]->project_id]['donationDeducted'] + $deduct;
					$projectArr[$donationDetails[$i]->project_id]['donationSettled'] = $projectArr[$donationDetails[$i]->project_id]['donationSettled'] + $donationDetails[$i]->transfer_amount;
				}

				# code...
			}

			$data['donationRaised'] = $donationRaised;
			$data['donationDeducted'] = $donationDeducted;
			$data['donationSettled'] = $donationSettled;
			$data['projectArr'] = $projectArr;


			//echo "<pre>";print_r($projectArr);echo "</pre>";
			$html = $this->load->view('profile/donation_report_view', $data, true);
			//echo $html;
			//die();

			$this->load->library('pdf');
			$this->pdf->download($html, $month . "_donation_report");



		}

	}

	//contributor start
	public function getContributorRequestForEditView()
	{
		//echo'testing..!!';
		$LoggedInUserId = $_SESSION['UserId'];

		if ($LoggedInUserId == '') {
			redirect(base_url());
		} else {
			$data['UserDetails'] = $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			//print_r($data['UserDetails']);

			if ($UserDetails->type == 2) {
				//redirect(base_url());
				$userId = $this->uri->segment(2);

				$data['PageTitle'] = SITE_NAME . ' : Myprofile - Request An Edit';
				$data['State'] = $this->CommonModel->get_state();
				$data['Co_Organization_Type'] = $this->CommonModel->get_corporate_organization_type();
				$data['userType'] = $UserDetails->type;
				$data['CompanyDetails'] = $this->MyprofileModel->getCompanyDetailsById($userId);

				/* echo'<pre>';
							print_r($data['ProfileDetails']);
							exit; */

				if ($data['CompanyDetails']->user_id == $LoggedInUserId) {
					//add breadcrumb here....

					$this->load->view('profile/companyrequesteditform', $data);
				} else {
					redirect(base_url());
				}
			}


		}

	}

	public function editCompanyProfilePostForm()
	{
		//echo'testing editCompanyProfilePostForm';
		/* echo'<pre>';
			  print_r($_POST);
			  echo'<pre>';
			  print_r($_FILES);
			  echo $_POST['company_id'];  */

		//exit;

		$LoggedInUserId = $_SESSION['UserId'];
		$file_name_arr = [];
		$status = 0;

		if ($LoggedInUserId == '') {
			redirect(base_url());
		} else {
			if (isset($_POST) && $_POST != '' && $_POST['company_id'] != '') {
				$comName = isset($_POST['comName']) ? $_POST['comName'] : '';
				$comAddress1 = isset($_POST['comAddress1']) ? $_POST['comAddress1'] : '';
				$comAddress2 = isset($_POST['comAddress2']) ? $_POST['comAddress2'] : '';
				$comPincode = isset($_POST['comPincode']) ? $_POST['comPincode'] : '';
				$comState = isset($_POST['comState']) ? $_POST['comState'] : '';
				$comDistrict = isset($_POST['comDistrict']) ? $_POST['comDistrict'] : '';
				$comCity = isset($_POST['comCity']) ? $_POST['comCity'] : '';
				$comOrgType = isset($_POST['comOrgType']) ? $_POST['comOrgType'] : '';
				$comAbout = isset($_POST['comAbout']) ? $_POST['comAbout'] : '';
				$comCinNumber = isset($_POST['com_cin_number']) ? $_POST['com_cin_number'] : '';
				$comGstNumber = isset($_POST['com_gst_number']) ? $_POST['com_gst_number'] : '';
				$comPanNumber = isset($_POST['com_pan_number']) ? $_POST['com_pan_number'] : '';

				//files data start
				$comLogo_name = isset($_FILES['comLogo']['name']) ? $_FILES['comLogo']['name'] : array();
				$comLogo_ext = pathinfo($comLogo_name, PATHINFO_EXTENSION);
				$comLogo_allowed_ext = array('jpg', 'jpeg', 'png');


				$com_cin_file_name = isset($_FILES['com_cin_file']['name']) ? $_FILES['com_cin_file']['name'] : array();
				$com_cin_file_ext = pathinfo($com_cin_file_name, PATHINFO_EXTENSION);

				$com_gst_file_name = isset($_FILES['com_gst_file']['name']) ? $_FILES['com_gst_file']['name'] : array();
				$com_gst_file_ext = pathinfo($com_gst_file_name, PATHINFO_EXTENSION);

				$com_pan_file_name = isset($_FILES['com_pan_file']['name']) ? $_FILES['com_pan_file']['name'] : array();
				$com_pan_file_ext = pathinfo($com_pan_file_name, PATHINFO_EXTENSION);

				$com_files_allowed_ext = array('jpg', 'jpeg', 'pdf', 'png');
				//files data end

				if (isset($_POST['companyEditSubmit']) && $_POST['companyEditSubmit'] == 'continue') {
					if (!empty($_POST['con_name_check']) && $comName == '') {

						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;

					}

					if (!empty($_POST['con_add_check']) && $comAddress1 == '' || $comAddress2 == '') {

						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;

					}

					if (isset($_POST['con_pincode_check']) && $_POST['con_pincode_check'] == 1) {
						if ($comPincode == '') {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
							exit;
						} elseif (strlen($comPincode) > 6 || strlen($comPincode) < 6 || !preg_match('/^[1-9][0-9]{5}$/', $comPincode)) {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter valid pincode."));
							exit;
						}

					}

					if (!empty($_POST['con_state_check']) && (empty($comState))) {

						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;

					}

					if (!empty($_POST['con_district_check']) && (empty($comDistrict))) {

						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;

					}

					if (!empty($_POST['con_city_check']) && (empty($comCity))) {

						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;

					}

					if (!empty($_POST['con_org_type_check']) && (empty($comOrgType))) {

						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;

					}

					if (!empty($_POST['con_about_check']) && (empty($comAbout))) {

						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;

					}

					if (!empty($_POST['con_logo_check']) && !empty($_FILES['comLogo'])) {
						if (!empty($comLogo_name) && !in_array($comLogo_ext, $comLogo_allowed_ext)) {
							echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of company logo."));
							exit;
						} else {
							$file_name = $_FILES['comLogo']['name'];
							$com_logo_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $comLogo_ext;
							$file_name_arr['com_logo_filename'] = $com_logo_filename;
							$config['upload_path'] = COMPANY_LOGO_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png';

							$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('comLogo')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

					}

					if (!empty($_POST['con_inco_certi_check'])) {

						if ((empty($com_cin_file_name)) || empty($_POST['com_cin_number'])) {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
							exit;
						} elseif (!empty($com_cin_file_name) && !in_array($com_cin_file_ext, $com_files_allowed_ext)) {
							echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of cin file."));
							exit;
						} elseif (!preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['com_cin_number'])) {
							echo json_encode(array('flag' => 0, 'msg' => "Invalid CIN Number"));
							exit;
						} else {
							$file_name = $_FILES['com_cin_file']['name'];
							$com_cin_file_name = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $com_cin_file_ext;
							$file_name_arr['com_cin_file_name'] = $com_cin_file_name;
							$config['upload_path'] = COMPANY_CIN_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';

							$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('com_cin_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

					}

					if (!empty($_POST['con_gst_certi_check'])) {

						if ((empty($com_gst_file_name)) || empty($_POST['com_gst_number'])) {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
							exit;
						} elseif (!empty($com_gst_file_name) && !in_array($com_gst_file_ext, $com_files_allowed_ext)) {
							echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of gst file."));
							exit;
						} elseif (!preg_match("/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/i", $_POST['com_gst_number'])) {
							echo json_encode(array('flag' => 0, 'msg' => "Invalid GST Number"));
							exit;
						} else {
							$file_name = $_FILES['com_gst_file']['name'];
							$com_gst_file_name = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $com_gst_file_ext;
							$file_name_arr['com_gst_file_name'] = $com_gst_file_name;
							$config['upload_path'] = COMPANY_GST_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';

							$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('com_gst_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

					}

					if (!empty($_POST['con_pan_card_check'])) {

						if ((empty($com_pan_file_name)) || empty($_POST['com_pan_number'])) {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
							exit;
						} elseif (!empty($com_pan_file_name) && !in_array($com_pan_file_ext, $com_files_allowed_ext)) {
							echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of cin file."));
							exit;
						} elseif (!preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['com_pan_number'])) {
							echo json_encode(array('flag' => 0, 'msg' => "Invalid PAN Number"));
							exit;
						} else {
							$file_name = $_FILES['com_pan_file']['name'];
							$com_pan_file_name = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $com_pan_file_ext;
							$file_name_arr['com_pan_file_name'] = $com_pan_file_name;
							$config['upload_path'] = COMPANY_PAN_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';

							$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('com_pan_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

					}


					$com_logo_db_filename = '';
					$com_cin_db_filename = '';
					$com_gst_db_filename = '';
					$com_pan_db_filename = '';

					//echo'<pre>';
					//print_r($file_name_arr);
					/* [com_logo_filename] => 23-1580811114.jpg
								   [com_cin_file_name] => 23-1580811114.jpg
								   [com_gst_file_name] => 23-1580811114.jpg
								   [com_pan_file_name] => 23-1580811114.jpg */


					foreach ($file_name_arr as $key => $file_name) {
						if ($key == 'com_logo_filename') {
							$com_logo_db_filename = $file_name;
						} elseif ($key == 'com_cin_file_name') {
							$com_cin_db_filename = $file_name;
						} elseif ($key == 'com_gst_file_name') {
							$com_gst_db_filename = $file_name;
						} elseif ($key == 'com_pan_file_name') {
							$com_pan_db_filename = $file_name;
						}
					}




					$insert_corporate_details = array(

						'user_id' => $LoggedInUserId,
						'corporate_id' => $_POST['company_id'],
						'company_logo' => $com_logo_db_filename,
						'company_name' => $comName,
						'company_address_1' => $comAddress1,
						'company_address_2' => trim($comAddress2),
						'city' => $comCity,
						'district' => $comDistrict,
						'pincode' => $comPincode,
						'state' => $comState,
						'about_company' => $comAbout,
						'company_org_type' => $comOrgType,
						'cin_no' => base64_encode($_POST['com_cin_number']),
						'cin_file' => $com_cin_db_filename,
						'gst_no' => base64_encode($_POST['com_gst_number']),
						'gst_file' => $com_gst_db_filename,
						'pan_no' => base64_encode($_POST['com_pan_number']),
						'pan_file' => $com_pan_db_filename,
						'status' => $status,
						'created_at' => strtotime(date('Y-m-d H:i:s'))
					);

					/* echo'<pre>';
								   print_r($insert_corporate_details);
								   exit; */

					$isInsert = $this->db->insert('edit_corporate_details', $insert_corporate_details);

					if ($isInsert) {
						$GlobalMsgDetails = $this->CommonModel->getGlobalMsgByCode('admin_request_an_edit_recieved');
						$GlobalMsg = $GlobalMsgDetails->msg;

						$notification_text = $GlobalMsg;
						$link = '<a href="/admin.php/contributor/contributorEditRequests/' . $_POST['company_id'] . '">View the detials here</a>';

						$types = array(1, 2, 3);
						$adminUsers = $this->CommonModel->getAdminUsersByType($types);
						foreach ($adminUsers as $row) {
							$insertdata = array(
								'from_user_id' => $LoggedInUserId,
								'to_user_id' => $row->id,
								'type' => 2,
								'area_id' => $_POST['company_id'],
								'notification_text' => $notification_text,
								'link' => $link,
								'type_of_notification' => 1,
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);

							$this->db->insert('adminuser_notifications', $insertdata);
						}

						echo json_encode(array('flag' => 1, 'msg' => "Your Request Submitted Successfully."));
						exit;
					} else {
						echo json_encode(array('flag' => 0, 'msg' => "Error ..!!"));
						exit;
					}
					//$lastInsertId = $this->db->insert_id();




				}

			}

		}

	}
	//contributor end

	public function getRequestForEditView()
	{
		//echo'testing..!!';
		$LoggedInUserId = $_SESSION['UserId'];

		if ($LoggedInUserId == '') {
			redirect(base_url());
		} else {
			$data['UserDetails'] = $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			//print_r($data['UserDetails']);

			if ($UserDetails->type == 1) {
				//redirect(base_url());
				$userId = $this->uri->segment(2);

				$data['PageTitle'] = SITE_NAME . ' : Myprofile - Request An Edit';
				$data['State'] = $this->CommonModel->get_state();
				$data['PrimarySourceMaster'] = $this->CommonModel->getPrimarySourceMaster();
				$data['OrganizationType'] = $this->CommonModel->get_organization_type();
				$data['Sector_Master'] = $this->CommonModel->get_sector_master();
				$data['BeneficiaryMaster'] = $this->CommonModel->getBeneficiaryMaster();
				$data['userType'] = $UserDetails->type;
				$data['NgoDetails'] = $this->MyprofileModel->getNgoDetailsById($userId);

				/* echo'<pre>';
							print_r($data['ProfileDetails']);
							exit; */

				if ($data['NgoDetails']->user_id == $LoggedInUserId) {
					//add breadcrumb here....

					$this->load->view('profile/requesteditform', $data);
				} else {
					redirect(base_url());
				}
			}


		}

	}



	public function editNgoProfilePostForm()
	{
		//echo'testing editNgoProfilePostForm';
		//echo'<pre>';
		//print_r($_POST);
		/* echo'<pre>';
			  print_r($_FILES);
			   */
		//exit;

		$LoggedInUserId = $_SESSION['UserId'];
		$file_name_arr = [];
		$status = 0;



		if ($LoggedInUserId == '') {
			redirect(base_url());
		} else {
			if (isset($_POST) && $_POST != '' && $_POST['ngo_org_id'] != '') {
				//post fields start
				$orgName = isset($_POST['orgName']) ? $_POST['orgName'] : '';
				$orgAddress1 = isset($_POST['orgAddress1']) ? $_POST['orgAddress1'] : '';
				$orgAddress2 = isset($_POST['orgAddress2']) ? $_POST['orgAddress2'] : '';
				$orgPincode = isset($_POST['orgPincode']) ? $_POST['orgPincode'] : '';
				$orgState = isset($_POST['orgState']) ? $_POST['orgState'] : '';
				$orgDistrict = isset($_POST['orgDistrict']) ? $_POST['orgDistrict'] : '';
				$orgCity = isset($_POST['orgCity']) ? $_POST['orgCity'] : '';
				$orgAbout = isset($_POST['orgAbout']) ? $_POST['orgAbout'] : '';
				$orgType = isset($_POST['orgType']) ? $_POST['orgType'] : '';
				$orgLocation = isset($_POST['orgLocation']) ? $_POST['orgLocation'] : '';
				$orgDateIncorporation = isset($_POST['orgDateIncorporation']) ? $_POST['orgDateIncorporation'] : '';

				$orgSector_arr = isset($_POST['orgSector']) ? $_POST['orgSector'] : array();
				$primarySourceType_arr = isset($_POST['primarySourceType']) ? $_POST['primarySourceType'] : array();
				//step 3 post fields start

				$year1_net_worth = $_POST['year1_net_worth'];
				$year1_turnover = $_POST['year1_turnover'];
				$year1_net_profit = $_POST['year1_net_profit'];

				$year2_net_worth = $_POST['year2_net_worth'];
				$year2_turnover = $_POST['year2_turnover'];
				$year2_net_profit = $_POST['year2_net_profit'];

				$year3_net_worth = $_POST['year3_net_worth'];
				$year3_turnover = $_POST['year3_turnover'];
				$year3_net_profit = $_POST['year3_net_profit'];

				$year4_net_worth = $_POST['year4_net_worth'];
				$year4_turnover = $_POST['year4_turnover'];
				$year4_net_profit = $_POST['year4_net_profit'];

				$year5_net_worth = $_POST['year5_net_worth'];
				$year5_turnover = $_POST['year5_turnover'];
				$year5_net_profit = $_POST['year5_net_profit'];

				$year6_net_worth = $_POST['year6_net_worth'];
				$year6_turnover = $_POST['year6_turnover'];
				$year6_net_profit = $_POST['year6_net_profit'];

				//step 3 post fields end

				//post fields end

				//files start

				$allowed_ext_for_files = array('jpg', 'jpeg', 'pdf', 'png');
				$allowed_ext_for_org_logo = array('jpg', 'jpeg', 'png');
				$allowed = array('jpg', 'jpeg', 'pdf', 'png');

				$orgLogo_name = isset($_FILES['orgLogo']['name']) ? $_FILES['orgLogo']['name'] : array();
				$orgLogo_ext = pathinfo($orgLogo_name, PATHINFO_EXTENSION);


				$org_cin_file_name = isset($_FILES['org_cin_file']['name']) ? $_FILES['org_cin_file']['name'] : array();
				$org_cin_file_ext = pathinfo($org_cin_file_name, PATHINFO_EXTENSION);

				$org_gst_file_name = isset($_FILES['org_gst_file']['name']) ? $_FILES['org_gst_file']['name'] : array();
				$org_gst_file_ext = pathinfo($org_gst_file_name, PATHINFO_EXTENSION);

				$org_pan_file_name = isset($_FILES['org_pan_file']['name']) ? $_FILES['org_pan_file']['name'] : array();
				$org_pan_file_ext = pathinfo($org_pan_file_name, PATHINFO_EXTENSION);

				$org_80g_file_name = isset($_FILES['org_80g_file']['name']) ? $_FILES['org_80g_file']['name'] : array();
				$org_80g_file_ext = pathinfo($org_80g_file_name, PATHINFO_EXTENSION);

				$org_fcra_file_name = isset($_FILES['org_fcra_file']['name']) ? $_FILES['org_fcra_file']['name'] : array();
				$org_fcra_file_ext = pathinfo($org_fcra_file_name, PATHINFO_EXTENSION);

				$org_35ac_file_name = isset($_FILES['org_35ac_file']['name']) ? $_FILES['org_35ac_file']['name'] : array();
				$org_35ac_file_ext = pathinfo($org_35ac_file_name, PATHINFO_EXTENSION);

				$org_12a_file_name = isset($_FILES['org_12a_file']['name']) ? $_FILES['org_12a_file']['name'] : array();
				$org_12a_file_ext = pathinfo($org_12a_file_name, PATHINFO_EXTENSION);



				$org_year_1_file_name = isset($_FILES['org_year_1_file']['name']) ? $_FILES['org_year_1_file']['name'] : array();
				$org_year_1_file_ext = pathinfo($org_year_1_file_name, PATHINFO_EXTENSION);

				$org_year_2_file_name = isset($_FILES['org_year_2_file']['name']) ? $_FILES['org_year_2_file']['name'] : array();
				$org_year_2_file_ext = pathinfo($org_year_2_file_name, PATHINFO_EXTENSION);

				$org_year_3_file_name = isset($_FILES['org_year_3_file']['name']) ? $_FILES['org_year_3_file']['name'] : array();
				$org_year_3_file_ext = pathinfo($org_year_3_file_name, PATHINFO_EXTENSION);

				$org_year_4_file_name = isset($_FILES['org_year_4_file']['name']) ? $_FILES['org_year_4_file']['name'] : array();
				$org_year_4_file_ext = pathinfo($org_year_4_file_name, PATHINFO_EXTENSION);

				$org_year_5_file_name = isset($_FILES['org_year_5_file']['name']) ? $_FILES['org_year_5_file']['name'] : array();
				$org_year_5_file_ext = pathinfo($org_year_5_file_name, PATHINFO_EXTENSION);

				$org_year_6_file_name = isset($_FILES['org_year_6_file']['name']) ? $_FILES['org_year_6_file']['name'] : array();
				$org_year_6_file_ext = pathinfo($org_year_6_file_name, PATHINFO_EXTENSION);

				//files end

				if (isset($_POST['org_name_check']) && $_POST['org_name_check'] == 1) {
					if ($orgName == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (!empty($_POST['org_logo_check']) && !empty($_FILES['orgLogo'])) {
					if ($orgLogo_name != "" && !in_array($orgLogo_ext, $allowed_ext_for_org_logo)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of organization logo."));
						exit;
					} else {
						$file_name = $_FILES['orgLogo']['name'];
						$org_logo_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $orgLogo_ext;
						$file_name_arr['org_logo_filename'] = $org_logo_filename;
						$config['upload_path'] = NGO_LOGO_PATH;
						$config['allowed_types'] = 'jpg|jpeg|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('orgLogo')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}



				if (isset($_POST['org_add_check']) && $_POST['org_add_check'] == 1) {
					if ($orgAddress1 == '' || $orgAddress2 == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['pincode_check']) && $_POST['pincode_check'] == 1) {
					if ($orgPincode == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif (strlen($orgPincode) > 6 || strlen($orgPincode) < 6 || !preg_match('/^[1-9][0-9]{5}$/', $orgPincode)) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter valid pincode."));
						exit;
					}

				}

				if (isset($_POST['state_check']) && $_POST['state_check'] == 1) {
					if ($orgState == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['district_check']) && $_POST['district_check'] == 1) {
					if ($orgDistrict == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['city_check']) && $_POST['city_check'] == 1) {
					if ($orgCity == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['about_org_check']) && $_POST['about_org_check'] == 1) {
					if ($orgAbout == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['org_type_check']) && $_POST['org_type_check'] == 1) {
					if ($orgType == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['loc_of_op_check']) && $_POST['loc_of_op_check'] == 1) {
					if ($orgLocation == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['date_of_incorp_check']) && $_POST['date_of_incorp_check'] == 1) {
					if ($orgDateIncorporation == '') {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}

				if (isset($_POST['sec_of_op_check']) && $_POST['sec_of_op_check'] == 1) {
					if (empty($orgSector_arr)) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					}

				}



				//org file validation with  start


				if (isset($_POST['inco_certi_check']) && $_POST['inco_certi_check'] == 1) {

					if ($org_cin_file_name == '' || empty($_POST['org_cin_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif ($org_cin_file_name != '' && !in_array($org_cin_file_ext, $allowed_ext_for_files)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of cin file."));
						exit;
					} elseif (!preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['org_cin_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid CIN Number"));
						exit;
					} else {
						$file_name = $_FILES['org_cin_file']['name'];
						$org_cin_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_cin_file_ext;
						$file_name_arr['org_cin_filename'] = $org_cin_filename;
						$config['upload_path'] = NGO_CIN_PATH;
						$config['allowed_types'] = 'jpg|jpeg|pdf|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('org_cin_file')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}

				if (isset($_POST['gst_certi_check']) && $_POST['gst_certi_check'] == 1) {

					if ($org_gst_file_name == '' || empty($_POST['org_gst_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif ($org_gst_file_name != '' && !in_array($org_gst_file_ext, $allowed_ext_for_files)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of gst file."));
						exit;
					} elseif (!preg_match("/^([01-35]{2})([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})([1-9A-Z]{1})([zZ]{1})([0-9A-Z]{1})$/i", $_POST['org_gst_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid GST Number"));
						exit;
					} else {
						$file_name = $_FILES['org_gst_file']['name'];
						$org_gst_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_gst_file_ext;
						$file_name_arr['org_gst_filename'] = $org_gst_filename;
						$config['upload_path'] = NGO_GST_PATH;
						$config['allowed_types'] = 'jpg|jpeg|pdf|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('org_gst_file')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}

				if (isset($_POST['pan_card_check']) && $_POST['pan_card_check'] == 1) {

					if ($org_pan_file_name == '' || empty($_POST['org_pan_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif ($org_pan_file_name != '' && !in_array($org_pan_file_ext, $allowed_ext_for_files)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of cin file."));
						exit;
					} elseif (!preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['org_pan_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid PAN Number"));
						exit;
					} else {
						$file_name = $_FILES['org_pan_file']['name'];
						$org_pan_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_pan_file_ext;
						$file_name_arr['org_pan_filename'] = $org_pan_filename;
						$config['upload_path'] = NGO_PAN_PATH;
						$config['allowed_types'] = 'jpg|jpeg|pdf|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('org_pan_file')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}

				if (isset($_POST['certi_80g_check']) && $_POST['certi_80g_check'] == 1) {

					if ($org_80g_file_name == '' || empty($_POST['org_80g_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif ($org_80g_file_name != '' && !in_array($org_80g_file_ext, $allowed_ext_for_files)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of certificate 80G file."));
						exit;
					} else {
						$file_name = $_FILES['org_80g_file']['name'];
						$org_80g_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_80g_file_ext;
						$file_name_arr['org_80g_filename'] = $org_80g_filename;
						$config['upload_path'] = NGO_80G_PATH;
						$config['allowed_types'] = 'jpg|jpeg|pdf|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('org_80g_file')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}

				if (isset($_POST['fcra_certi_check']) && $_POST['fcra_certi_check'] == 1) {

					if ($org_fcra_file_name == '' || empty($_POST['org_fcra_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif ($org_fcra_file_name != '' && !in_array($org_fcra_file_ext, $allowed_ext_for_files)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of certificate FCRA file."));
						exit;
					} else {
						$file_name = $_FILES['org_fcra_file']['name'];
						$org_fcra_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_fcra_file_ext;
						$file_name_arr['org_fcra_filename'] = $org_fcra_filename;
						$config['upload_path'] = NGO_FCRA_PATH;
						$config['allowed_types'] = 'jpg|jpeg|pdf|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('org_fcra_file')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}

				if (isset($_POST['certi_35ac_check']) && $_POST['certi_35ac_check'] == 1) {

					if ($org_35ac_file_name == '' || empty($_POST['org_35ac_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif ($org_35ac_file_name != '' && !in_array($org_35ac_file_ext, $allowed_ext_for_files)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of certificate 35ac file."));
						exit;
					} else {
						$file_name = $_FILES['org_35ac_file']['name'];
						$org_35ac_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_35ac_file_ext;
						$file_name_arr['org_35ac_filename'] = $org_35ac_filename;
						$config['upload_path'] = NGO_35AC_PATH;
						$config['allowed_types'] = 'jpg|jpeg|pdf|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('org_35ac_file')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}

				if (isset($_POST['fcra_certi_check']) && $_POST['fcra_certi_check'] == 1) {

					if ($org_12a_file_name == '' || empty($_POST['org_12a_number'])) {
						echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
						exit;
					} elseif ($org_12a_file_name != '' && !in_array($org_12a_file_ext, $allowed_ext_for_files)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of certificate 80G file."));
						exit;
					} else {
						$file_name = $_FILES['org_12a_file']['name'];
						$org_12a_filename = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_12a_file_ext;
						$file_name_arr['org_12a_filename'] = $org_12a_filename;
						$config['upload_path'] = NGO_12A_PATH;
						$config['allowed_types'] = 'jpg|jpeg|pdf|png';

						$config['file_name'] = $LoggedInUserId . '-' . strtotime(date('Y-m-d H:i:s'));

						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('org_12a_file')) {
							$uploadData = $this->upload->data();

						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}

				}

				//org file validation with nos end

				//org step 3 validation start
				if (isset($_POST['financial_reports_check']) && $_POST['financial_reports_check'] == 1) {
					/*if(empty($_POST['year1_net_worth']) || empty($_POST['year1_turnover']) || empty($_POST['year1_net_profit']) || empty($_FILES['org_year_1_file']['name'] ))
								   {
									   echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
									   exit;
								   }
								   else if(!empty($org_year_1_file_name) && !in_array($org_year_1_file_ext, $allowed)) */

					if (!empty($org_year_1_file_name) && !in_array($org_year_1_file_ext, $allowed)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of year 1."));
						exit;
					} else if (!empty($org_year_2_file_name) && !in_array($org_year_2_file_ext, $allowed)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of year 2."));
						exit;
					} else if (!empty($org_year_3_file_name) && !in_array($org_year_3_file_ext, $allowed)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of year 3."));
						exit;
					} else if (!empty($org_year_4_file_name) && !in_array($org_year_4_file_ext, $allowed)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of year 4."));
						exit;
					} else if (!empty($org_year_5_file_name) && !in_array($org_year_5_file_ext, $allowed)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of year 5."));
						exit;
					} else if (!empty($org_year_6_file_name) && !in_array($org_year_6_file_ext, $allowed)) {
						echo json_encode(array('flag' => 0, 'msg' => "Invalid file type of year 6."));
						exit;
					} else {
						if ((!empty($_FILES['org_year_2_file']['name'])) || (empty($_POST['year2_net_worth']) && empty($_POST['year2_turnover']) && empty($_POST['year2_net_profit']) && empty($_FILES['org_year_2_file']['name']))) {

						} else {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Second Year."));
							exit;
						}

						if ((!empty($_FILES['org_year_3_file']['name'])) || (empty($_POST['year3_net_worth']) && empty($_POST['year3_turnover']) && empty($_POST['year3_net_profit']) && empty($_FILES['org_year_3_file']['name']))) {

						} else {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Third Year."));
							exit;
						}

						if ((!empty($_FILES['org_year_4_file']['name'])) || (empty($_POST['year4_net_worth']) && empty($_POST['year4_turnover']) && empty($_POST['year4_net_profit']) && empty($_FILES['org_year_4_file']['name']))) {

						} else {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Forth Year."));
							exit;
						}

						if ((!empty($_FILES['org_year_5_file']['name'])) || (empty($_POST['year5_net_worth']) && empty($_POST['year5_turnover']) && empty($_POST['year5_net_profit']) && empty($_FILES['org_year_5_file']['name']))) {

						} else {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Fifth Year."));
							exit;
						}

						if ((!empty($_FILES['org_year_6_file']['name'])) || (empty($_POST['year6_net_worth']) && empty($_POST['year6_turnover']) && empty($_POST['year6_net_profit']) && empty($_FILES['org_year_6_file']['name']))) {

						} else {
							echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Sixth Year."));
							exit;
						}

						if (isset($_FILES['org_year_1_file']['name']) && !empty($_FILES['org_year_1_file']['name'])) {
							$filename_year1_db = $LoggedInUserId . '-year1-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_year_1_file_ext;
							$file_name_arr['filename_year1'] = $filename_year1_db;
							$config['upload_path'] = NGO_YEAR_PATH;
							$config['allowed_types'] = 'jpg|jpeg|pdf|png';

							$config['file_name'] = $LoggedInUserId . '-year1-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('org_year_1_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

						if (isset($_FILES['org_year_2_file']['name']) && !empty($_FILES['org_year_2_file']['name'])) {
							$filename_year2_db = $LoggedInUserId . '-year2-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_year_2_file_ext;
							$file_name_arr['filename_year2'] = $filename_year2_db;
							$config['upload_path'] = NGO_YEAR_PATH;
							$config['allowed_types'] = 'jpg|jpeg|pdf|png';

							$config['file_name'] = $LoggedInUserId . '-year2-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('org_year_2_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

						if (isset($_FILES['org_year_3_file']['name']) && !empty($_FILES['org_year_3_file']['name'])) {
							$filename_year3_db = $LoggedInUserId . '-year3-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_year_3_file_ext;
							$file_name_arr['filename_year3'] = $filename_year3_db;
							$config['upload_path'] = NGO_YEAR_PATH;
							$config['allowed_types'] = 'jpg|jpeg|pdf|png';

							$config['file_name'] = $LoggedInUserId . '-year3-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('org_year_3_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

						if (isset($_FILES['org_year_4_file']['name']) && !empty($_FILES['org_year_4_file']['name'])) {
							$filename_year4_db = $LoggedInUserId . '-year4-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_year_4_file_ext;
							$file_name_arr['filename_year4'] = $filename_year4_db;
							$config['upload_path'] = NGO_YEAR_PATH;
							$config['allowed_types'] = 'jpg|jpeg|pdf|png';

							$config['file_name'] = $LoggedInUserId . '-year4-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('org_year_4_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

						if (isset($_FILES['org_year_5_file']['name']) && !empty($_FILES['org_year_5_file']['name'])) {
							$filename_year5_db = $LoggedInUserId . '-year5-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_year_5_file_ext;
							$file_name_arr['filename_year5'] = $filename_year5_db;
							$config['upload_path'] = NGO_YEAR_PATH;
							$config['allowed_types'] = 'jpg|jpeg|pdf|png';

							$config['file_name'] = $LoggedInUserId . '-year5-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('org_year_5_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}

						if (isset($_FILES['org_year_6_file']['name']) && !empty($_FILES['org_year_6_file']['name'])) {
							$filename_year6_db = $LoggedInUserId . '-year6-' . strtotime(date('Y-m-d H:i:s')) . '.' . $org_year_6_file_ext;
							$file_name_arr['filename_year6'] = $filename_year6_db;
							$config['upload_path'] = NGO_YEAR_PATH;
							$config['allowed_types'] = 'jpg|jpeg|pdf|png';

							$config['file_name'] = $LoggedInUserId . '-year6-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('org_year_6_file')) {
								$uploadData = $this->upload->data();

							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						}
					}

				}
				//org step 3 validation end

				if (isset($orgSector_arr)) {
					if (!empty($orgSector_arr)) {
						$orgSector = implode(',', $orgSector_arr);
						$orgSector = ',' . $orgSector . ',';
					} else {
						$orgSector = '';
					}

				}

				/* echo'<pre>';
							print_r($file_name_arr);
							exit; */

				$org_logo_db_filename = '';
				$org_cin_db_filename = '';
				$org_gst_db_filename = '';
				$org_pan_db_filename = '';
				$org_80g_db_filename = '';
				$org_fcra_db_filename = '';
				$org_35ac_db_filename = '';
				$org_12a_db_filename = '';
				$filename_year1_db = '';
				$filename_year2_db = '';
				$filename_year3_db = '';
				$filename_year4_db = '';
				$filename_year5_db = '';
				$filename_year6_db = '';

				foreach ($file_name_arr as $key => $file_name) {

					if ($key == 'org_logo_filename') {
						$org_logo_db_filename = $file_name;
					} elseif ($key == 'org_cin_filename') {
						$org_cin_db_filename = $file_name;
					} elseif ($key == 'org_gst_filename') {
						$org_gst_db_filename = $file_name;
					} elseif ($key == 'org_pan_filename') {
						$org_pan_db_filename = $file_name;
					} elseif ($key == 'org_80g_filename') {
						$org_80g_db_filename = $file_name;
					} elseif ($key == 'org_fcra_filename') {
						$org_fcra_db_filename = $file_name;

					} elseif ($key == 'org_35ac_filename') {
						$org_35ac_db_filename = $file_name;
					} elseif ($key == 'org_12a_filename') {
						$org_12a_db_filename = $file_name;
					} elseif ($key == 'filename_year1') {
						$filename_year1_db = $file_name;

					} elseif ($key == 'filename_year2') {
						$filename_year2_db = $file_name;
					} elseif ($key == 'filename_year3') {
						$filename_year3_db = $file_name;
					} elseif ($key == 'filename_year4') {
						$filename_year4_db = $file_name;

					} elseif ($key == 'filename_year5') {
						$filename_year5_db = $file_name;
					} elseif ($key == 'filename_year6') {
						$filename_year6_db = $file_name;
					}


				}

				if (isset($primarySourceType_arr)) {
					if (!empty($primarySourceType_arr)) {
						$primarySourceType = implode(',', $primarySourceType_arr);
						$primarySourceType = ',' . $primarySourceType . ',';
					} else {
						$primarySourceType = '';
					}
				}

				if (date('m') >= 4) {
					$Y = date('Y') - 1;
				} else {
					$Y = date('Y') - 2;
				}

				$SY = $Y . "-04-01";
				$pt = $Y + 1;
				$EY = $pt . "-03-31";

				$insertData = array(

					'user_id' => $LoggedInUserId,
					'ngo_id' => $_POST['ngo_org_id'],
					'org_name' => $orgName,
					'org_logo' => $org_logo_db_filename,
					'org_address_line1' => $orgAddress1,
					'org_address_line2' => $orgAddress2,
					'city' => $orgCity,
					'district' => $orgDistrict,
					'pincode' => $orgPincode,
					'state' => $orgState,
					'about_org' => $orgAbout,
					'org_type' => $orgType,
					'org_location_operation' => $orgLocation,
					'date_incorporation' => strtotime($orgDateIncorporation),
					'sector_operation' => $orgSector,
					'cin_no' => base64_encode($_POST['org_cin_number']),
					'cin_file' => $org_cin_db_filename,
					'gst_no' => base64_encode($_POST['org_gst_number']),
					'gst_file' => $org_gst_db_filename,
					'pan_no' => base64_encode($_POST['org_pan_number']),
					'pan_file' => $org_pan_db_filename,
					'org_80g_no' => base64_encode($_POST['org_80g_number']),
					'org_80g_file' => $org_80g_db_filename,
					'fcra_no' => base64_encode($_POST['org_fcra_number']),
					'fcra_file' => $org_fcra_db_filename,
					'org_35ac_no' => base64_encode($_POST['org_35ac_number']),
					'org_35ac_file' => $org_35ac_db_filename,
					'org_12a_no' => base64_encode($_POST['org_12a_number']),
					'org_12a_file' => $org_12a_db_filename,
					'primary_source_type' => $primarySourceType,
					'year1' => date('Y', strtotime($SY)),
					'year1_file' => $filename_year1_db,
					'year1_net_worth' => $_POST['year1_net_worth'],
					'year1_turnover' => $_POST['year1_turnover'],
					'year1_net_profit' => $_POST['year1_net_profit'],
					'year2' => date('Y', strtotime($SY)) - 1,
					'year2_file' => $filename_year2_db,
					'year2_net_worth' => $_POST['year2_net_worth'],
					'year2_turnover' => $_POST['year2_turnover'],
					'year2_net_profit' => $_POST['year2_net_profit'],
					'year3' => date('Y', strtotime($SY)) - 2,
					'year3_file' => $filename_year3_db,
					'year3_net_worth' => $_POST['year3_net_worth'],
					'year3_turnover' => $_POST['year3_turnover'],
					'year3_net_profit' => $_POST['year2_net_profit'],
					'year4' => date('Y', strtotime($SY)) - 3,
					'year4_file' => $filename_year4_db,
					'year4_net_worth' => $_POST['year4_net_worth'],
					'year4_turnover' => $_POST['year4_turnover'],
					'year4_net_profit' => $_POST['year4_net_profit'],
					'year5' => date('Y', strtotime($SY)) - 4,
					'year5_file' => $filename_year5_db,
					'year5_net_worth' => $_POST['year5_net_worth'],
					'year5_turnover' => $_POST['year5_turnover'],
					'year5_net_profit' => $_POST['year5_net_profit'],
					'year6' => date('Y', strtotime($SY)) - 5,
					'year6_file' => $filename_year6_db,
					'year6_net_worth' => $_POST['year6_net_worth'],
					'year6_turnover' => $_POST['year6_turnover'],
					'year6_net_profit' => $_POST['year6_net_profit'],
					'status' => $status,
					'created_at' => strtotime(date('Y-m-d H:i:s'))
				);


				/* echo'insertData';
							echo'<pre>';
							print_r($insertData);
							exit; */


				$isInsert = $this->db->insert('edit_ngo_details', $insertData);
				$LastInsertID = $this->db->insert_id();

				if ($isInsert) {
					//$notification_text = 'You have recieved a New KYC Verification Process for Implementer.';
					$GlobalMsgDetails = $this->CommonModel->getGlobalMsgByCode('admin_request_an_edit_recieved');
					$GlobalMsg = $GlobalMsgDetails->msg;

					$notification_text = $GlobalMsg;
					$link = '<a href="/admin.php/partner/editRequests/' . $_POST['ngo_org_id'] . '">View the detials here</a>';

					$types = array(1, 2, 3);
					$adminUsers = $this->CommonModel->getAdminUsersByType($types);
					foreach ($adminUsers as $row) {
						$insertdata = array(
							'from_user_id' => $LoggedInUserId,
							'to_user_id' => $row->id,
							'type' => 1,
							'area_id' => $_POST['ngo_org_id'],
							'notification_text' => $notification_text,
							'link' => $link,
							'type_of_notification' => 1,
							'created_at' => strtotime(date('Y-m-d H:i:s')),
						);

						$this->db->insert('adminuser_notifications', $insertdata);
					}

					echo json_encode(array('flag' => 1, 'msg' => "Your Request Submitted Successfully."));
					exit;
				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Error ..!!"));
					exit;
				}
				//$lastInsertId = $this->db->insert_id();








			} //post else end

		}//main else end 



	}



	public function setEmailVerificationFlag()
	{
		/* $the_session = array("email_verification" => 1);
			  $this->session->set_userdata($the_session); */

		$userData = $this->uri->segment(2);
		$decoded_userData = urldecode($userData);
		//print_r($decoded_userData);
		$data = explode("-", $decoded_userData);
		//print_r($data);
		$user_email_id = $data[0];
		//print_r($user_email_id);
		$user_id = $data[1];
		//print_r($user_id);



		if ($user_email_id != "" && $user_id != "") {

			$userData = $this->MyprofileModel->GetUserDetails($user_id, $user_email_id);

			if (!empty($userData)) {
				$isVerified = $userData->email_verified;

				if ($isVerified == 1) {
					//email_verify_alreadydone
					$the_session = array("email_verification_alrdy_done" => 1);
					$this->session->set_userdata($the_session);

					$sessionEmailVeriDoneFlag = $this->session->userdata('email_verification_alrdy_done');

					if ($sessionEmailVeriDoneFlag == 1) {
						//$this->load->view('discover/discoverpage');
						redirect(BASE_URL('discover'));
					}
				}
			}

			$setFlagOutput = $this->MyprofileModel->setEmailVerificationFlag($user_email_id, $user_id);

			if ($setFlagOutput == true) {
				//$res = array('status'=>200,'msg'=>'Your Email Verification Done Successfully...!!');
				//echo json_encode($res);
				//$data['status'] = 200;
				//$data['msg'] = 'Your Email Verification Done Successfully...!!';
				$the_session = array("email_verification_success" => 1);
				$this->session->set_userdata($the_session);


				$sessionEmailVeriFlag = $this->session->userdata('email_verification_success');

				if ($sessionEmailVeriFlag == 1) {
					//$this->load->view('discover/discoverpage');
					redirect(BASE_URL('discover'));
				}
			} else {
				//$res = array('status'=>404,'msg'=>'Email Verification Unsuccessfull...!!');
				//echo json_encode($res);
				//$data['status'] = 200;
				//$data['msg'] = 'Email Verification Unsuccessfull...!!';
				//$this->load->view('discover/discoverpage',$data);

				$the_session = array("email_verification_failed" => 1);
				$this->session->set_userdata($the_session);

				$sessionEmailVeriFlag = $this->session->userdata('email_verification_failed');

				if ($sessionEmailVeriFlag == 1) {
					//$this->load->view('discover/discoverpage');
					redirect(BASE_URL('discover'));
				}
			}
		}



	}

	public function sendHTMLMailSMTP($to_email, $subject, $content, $attachment = "")
	{

		$message = $content;
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from("info@trucsr.in"); // change it to yours
		$this->email->to($to_email);// change it to yours
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype("html");
		if ($this->email->send()) {
			//echo 'Email sent success.';


			return true;

		} else {


			//show_error($this->email->print_debugger());
			return false;
		}
	}

	public function getEmailTemplateById($email_code)
	{
		$result = $this->db->get_where('email_template', array('email_code' => $email_code))->row();
		return $result;
	}

	public function sendCommonHTMLEmail($email_to, $email_code, $TempVars, $DynamicVars)
	{

		//echo 'sendCommonHTMLEmail';$email_to,$email_code,$TempVars, $DynamicVars


		$emailTemplate = $this->getEmailTemplateById($email_code);

		$subject = $emailTemplate->subject;

		$title = $emailTemplate->title;

		$emailBody = str_replace($TempVars, $DynamicVars, $emailTemplate->content);

		$data['subject'] = $subject;
		$data['title'] = $title;
		$data['content'] = $emailBody;

		$content = $this->load->view('email_template/email_content', $data, TRUE);


		$mailSent = $this->sendHTMLMailSMTP($email_to, $subject, $content, $attachment = "");

		if ($mailSent == true) {
			return true;
		} else {
			return false;
		}

	}


	public function emailVerification()
	{
		if (!empty($_POST['user_id']) && !empty($_POST['email'])) {
			//echo $_POST['email'];
			$user_id = $_POST['user_id'];
			$user_email = $_POST['email'];

			$the_session = array("email_verification_success" => 0, "email_verification_failed" => 0);
			$this->session->set_userdata($the_session);
			//print_r($_SESSION);exit;
			$userData = $this->MyprofileModel->GetUserDetails($user_id, $user_email);
			//print_r($ifexsist);
			//exit;

			$EmailVerificationFlag = $userData->email_verified;
			$user_name = $userData->first_name . " " . $userData->last_name;

			//print_r($user_name );

			if ($EmailVerificationFlag == 0) {
				$email_code = 'email_verification';
				$email_to = $user_email;
				$encoded_id_email = urlencode($email_to . '-' . $user_id);
				$url = BASE_URL . "verify-email-address/" . $encoded_id_email;

				//print_r($url);

				$emailTemplate = $this->getEmailTemplateById($email_code);

				$TempVars = array();
				$DynamicVars = array();

				$subject = $emailTemplate->subject;
				$title = $emailTemplate->title;
				$content = $emailTemplate->content;

				$TempVars = array("##TITLE##", "##USERNAME##", "##VERIFYEMAILURL##");
				$DynamicVars = array($title, $user_name, $url);

				$emailBody = str_replace($TempVars, $DynamicVars, $emailTemplate->content);

				$isSent = $this->sendCommonHTMLEmail($email_to, $email_code, $TempVars, $DynamicVars);

				if ($isSent == true) {

					$the_session = array("email_verification_request" => 1);
					$this->session->set_userdata($the_session);

					$res = array('status' => 200, 'msg' => 'We have sent an email to verify email address. After receiving the email follow the link provided to complete your email verification.');

					echo json_encode($res);
				}
			} elseif ($EmailVerificationFlag == 1) {
				$the_session = array("email_verification_request" => 0);
				$this->session->set_userdata($the_session);

				$res = array('status' => 404, 'msg' => 'Your Email Verification Is Already Done');
				echo json_encode($res);
			}

			//echo json_encode($res);

		}
	}



	public function profilechangepwdView()
	{
		if (isset($_SESSION['UserId'])) {
			$data['PageTitle'] = SITE_NAME . ' : My Profile - Change Password';
			$data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);
			$this->breadcrumb->add('Profile Information', base_url('myprofile'));
			$this->breadcrumb->add('Change Password');
			$data['breadcrumbs'] = $this->breadcrumb->render();
			$this->load->view('profile/changepassword', $data);
		} else {
			redirect(base_url());
		}
	}

	function profilepwdmobile()
	{
		if (empty($_POST)) {
			echo json_encode(array(
				'flag' => 0,
				'msg' => "Please enter all mandatory / compulsory fields."
			));
			exit;
		} else {
			if (empty($_POST['inputMobile'])) {
				echo json_encode(array(
					'flag' => 0,
					'msg' => "Please enter all mandatory / compulsory fields."
				));
				exit;
			} elseif (!preg_match('/^[0-9]*$/', $_POST['inputMobile'])) {
				echo json_encode(array(
					'flag' => 0,
					'msg' => "Please enter valid number."
				));
				exit;
			} else {
				$mobile = trim($_POST['inputMobile']);
				$Record = $this->UserModel->UserExistCount($mobile);

				if ($Record > 0) {

					$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
					if ($UserDetails->phone_no == $_POST['inputMobile']) {
						//$redirect = base_url() . "changepassword";  

						$string = '0123456789';
						$string_shuffled = str_shuffle($string);
						$getOTP = substr($string_shuffled, 0, 4);


						$insertOTPdata = array(

							'phone_no' => $_POST['inputMobile'],
							'otp' => $getOTP,

						);
						$this->db->insert('otp_change_password', $insertOTPdata);

						$mtd = "sms";
						//$mesg = 'Your OTP for Changing Password is '.$getOTP;
						$mesg1 = 'OTP to update your truCSR profile password is ' . $getOTP . '. Kindly don\'t share your OTP with anyone.';
						$mesg1 .= '-';
						$mesg1 .= 'truCSR.in';
						$mesg = urlencode($mesg1);

						$mob = $_POST['inputMobile'];
						$send = "truCSR";
						$key = "A6caf2ce090e57e969d65c6111ef27bb9";
						$template_id = "1007162762950740486";

						$url = 'https://api-alerts.kaleyra.com/v4/?api_key=' . $key . '&method=' . $mtd . '&message=' . $mesg . '&to=' . $mob . '&sender=' . $send . '&template_id=' . $template_id . '';  // API URL
						//print_r($url);exit;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
						curl_setopt($ch, CURLOPT_POST, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
						curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
						$result = curl_exec($ch);

						echo json_encode(array(
							'flag' => 1,
							'msg' => "Success",
							'phone' => $_POST['inputMobile']
							// 'redirect' => $redirect
						));
						exit;
					} else {
						echo json_encode(array(
							'flag' => 0,
							'msg' => "Please enter your registered mobile number."
						));
						exit;
					}
				} else {
					echo json_encode(array(
						'flag' => 0,
						'msg' => "You have not registered customer."
					));
					exit;
				}
			}
		}

	}



	public function changepwdOtp()
	{
		if (isset($_POST) && $_POST != '') {
			if (empty($_POST['otpNumber'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter OTP."));
				exit;
			} else {

				$optData = $this->MyprofileModel->getChangePwdOtpDataByPhone($_POST['phone']);
				if (empty($optData)) {
					echo json_encode(array('flag' => 0, 'msg' => "Phone number is not registered."));
					exit;

				} else {
					if ($optData['otp'] != $_POST['otpNumber']) {
						//if($_POST['otpNumber'] != '1234'){

						echo json_encode(array('flag' => 0, 'msg' => "Invalid OTP"));
						exit;

					} else {

						$this->db->where('phone_no', $optData['phone_no']);
						$this->db->delete('otp_change_password');

						echo json_encode(array('flag' => 1, 'msg' => "OTP verified successfully."));
						exit;

					}
				}

			}

		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}




	public function changepwdresendOtp()
	{
		if (isset($_POST) && $_POST != '') {

			$string = '0123456789';
			$string_shuffled = str_shuffle($string);
			$getOTP = substr($string_shuffled, 0, 4);

			$insertOTPdata = array(

				'phone_no' => $_POST['phone'],
				'otp' => $getOTP,

			);
			$this->db->insert('otp_change_password', $insertOTPdata);

			$mtd = "sms";
			//$mesg = 'Your OTP for Changing Password is '.$getOTP;
			$mesg1 = 'OTP to update your truCSR profile password is ' . $getOTP . '. Kindly don\'t share your OTP with anyone.';
			$mesg1 .= '-';
			$mesg1 .= 'truCSR.in';
			$mesg = urlencode($mesg1);

			$mob = $_POST['phone'];
			$send = "truCSR";
			$key = "A6caf2ce090e57e969d65c6111ef27bb9";
			$template_id = "1007162762950740486";

			$url = 'https://api-alerts.kaleyra.com/v4/?api_key=' . $key . '&method=' . $mtd . '&message=' . $mesg . '&to=' . $mob . '&sender=' . $send . '&template_id=' . $template_id . '';  // API URL
			//print_r($url);exit;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			$result = curl_exec($ch);

			echo json_encode(array('flag' => 1, 'msg' => "OTP sent to your registered number."));
			exit;

		} else {

			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;

		}
	}


	public function changePwd()
	{
		if (isset($_POST) && $_POST != '') {
			// print_r($_POST);exit;
			if (empty($_POST['inputNewPassword']) || empty($_POST['inputRePassword'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			} elseif ($_POST['inputNewPassword'] != $_POST['inputRePassword']) {
				echo json_encode(array('flag' => 0, 'msg' => "Confirm Password does not match."));
				exit;
			} else {

				$HashPassword = password_hash($_POST['inputNewPassword'], PASSWORD_DEFAULT);
				$phone = $this->UserModel->GetUserByPhone($_POST['phone']);

				if (isset($phone) && $phone->id != '') {
					// print_r($phone);
					//exit;


					$Result = $this->ForgotpasswordModel->UpdatePasswordData($phone->id, $HashPassword);
					if ($Result > 0) {
						echo json_encode(array(
							'flag' => 1,
							'msg' => "Success"
							//'redirect' => $redirect
						));
						exit;
					} else {
						echo json_encode(array(
							'flag' => 0,
							'msg' => "Password not update."
							//'redirect' => $redirect
						));
						exit;
					}
				} else {
					echo json_encode(array(
						'flag' => 0,
						'msg' => "You have customer not registered."
						//'redirect' => $redirect
					));
					exit;
				}

			}

		}
	}




	// Change Information

	public function profileeditinfoView()
	{
		if (isset($_SESSION['UserId'])) {
			$data['PageTitle'] = SITE_NAME . ' : My Profile - Edit Information';
			$data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);

			$this->breadcrumb->add('Profile Information', base_url('myprofile'));
			$this->breadcrumb->add('Edit Information');
			$data['breadcrumbs'] = $this->breadcrumb->render();

			$this->load->view('profile/editInformation', $data);
		} else {
			redirect(base_url());
		}

	}

	function profilepost()
	{
		if (empty($_POST)) {
			echo json_encode(array(
				'flag' => 0,
				'msg' => "Please enter all mandatory / compulsory fields."
			));
			exit;
		} else {
			if (empty($_POST['inputFname']) || empty($_POST['inputLname']) || empty($_POST['inputEmail']) || empty($_POST['inputPassword'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			} elseif (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST["inputEmail"])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter a valid Email address."));
				exit;
			} else {
				$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
				$mobile = $UserDetails->phone_no;
				//print_r($mobile);	
				// exit;					 
				$Record = $this->UserModel->UserExistCount($mobile);
				$UserDetails = $this->UserModel->GetUserByPhone($mobile);
				if (sizeof($UserDetails) > 0) {
					$Pass1 = $UserDetails->password;
				}
				$Pass2 = $_POST['inputPassword'];

				if ($Record > 0 && password_verify($Pass2, $Pass1)) {

					$this->MyprofileModel->UpdateProfileData($UserDetails->id, $_POST['inputFname'], $_POST['inputLname'], $_POST['inputEmail']);


					$redirect = base_url() . "myprofile";
					echo json_encode(array(
						'flag' => 1,
						'msg' => "Success",
						'redirect' => $redirect
					));
					exit;
				} else {
					echo json_encode(array(
						'flag' => 0,
						'msg' => "Please enter valid Password."
					));
					exit;
				}


			}
		}
	}


	// Change Mobile Number

	public function changemobileeditView()
	{
		if (isset($_SESSION['UserId'])) {
			$data['PageTitle'] = SITE_NAME . ' : My Profile - Change Mobile Number';
			$data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);
			$this->breadcrumb->add('Profile Information', base_url('myprofile'));
			$this->breadcrumb->add('Change Mobile Number');
			$data['breadcrumbs'] = $this->breadcrumb->render();
			$this->load->view('profile/changeMobile', $data);
		} else {
			redirect(base_url());
		}
	}


	function changemobilenoPost()
	{

		if (empty($_POST)) {
			echo json_encode(array(
				'flag' => 0,
				'msg' => "Please enter all mandatory / compulsory fields."
			));
			exit;
		} else {
			if (empty($_POST['inputMobile']) || empty($_POST['inputNewMobile']) || empty($_POST['inputPassword'])) {
				echo json_encode(array(
					'flag' => 0,
					'msg' => "Please enter all mandatory / compulsory fields."
				));
				exit;
			} elseif (!preg_match('/^[0-9]*$/', $_POST['inputMobile'])) {
				echo json_encode(array(
					'flag' => 0,
					'msg' => "Please enter valid number."
				));
				exit;
			} elseif ($_POST['inputMobile'] == $_POST['inputNewMobile']) {
				echo json_encode(array(
					'flag' => 0,
					'msg' => "Information not update."
				));
				exit;
			} else {


				$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
				$mobile = trim($_POST['inputMobile']);
				$newmobile = trim($_POST['inputNewMobile']);
				//print_r($mobile);	
				// exit;					 
				$Record = $this->UserModel->UserExistCount($mobile);
				$Record1 = $this->UserModel->UserExistCount($newmobile);
				if ($Record1 > 0) {
					echo json_encode(array(
						'flag' => 0,
						'msg' => "Entered  new mobile no is alreday registered."
					));
					exit;
				}

				$UserDetails = $this->UserModel->GetUserByPhone($mobile);
				if (sizeof($UserDetails) > 0) {
					$Pass1 = $UserDetails->password;
				}
				$Pass2 = $_POST['inputPassword'];

				if ($Record > 0 && password_verify($Pass2, $Pass1)) {

					//$this->MyprofileModel->UpdateMobileData($UserDetails->id, $_POST['inputNewMobile']); 

					$string = '0123456789';
					$string_shuffled = str_shuffle($string);
					$getOTP = substr($string_shuffled, 0, 4);


					$insertOTPdata = array(

						'phone_no' => $_POST['inputNewMobile'],
						'otp' => $getOTP,

					);
					$this->db->insert('otp_change_mobile', $insertOTPdata);

					$mtd = "sms";
					//$mesg = 'Your OTP for Changing Mobile no is '.$getOTP;
					//$mesg = 'Your OTP to update your mobile number on truCSR is '.$getOTP.'.';
					$mesg1 = 'Your OTP to update your mobile number on truCSR is ' . $getOTP . '. Kindly don\'t share your OTP with anyone.
                        -
                        truCSR.in';
					$mesg = urlencode($mesg1);




					$mob = $_POST['inputNewMobile'];
					$send = "truCSR";
					$key = "A6caf2ce090e57e969d65c6111ef27bb9";
					//$template_id = "1007162633765408035";
					$template_id = "1007162762909416289";

					$url = 'https://api-alerts.kaleyra.com/v4/?api_key=' . $key . '&method=' . $mtd . '&message=' . $mesg . '&to=' . $mob . '&sender=' . $send . '&template_id=' . $template_id . '';  // API URL
					//print_r($url);exit;

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_POST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
					$result = curl_exec($ch);


					//$redirect = base_url() . "discover";							                   
					echo json_encode(array(
						'flag' => 1,
						'msg' => "Success"
						//'redirect' => $redirect
					));
					exit;
				} else {
					echo json_encode(array(
						'flag' => 0,
						'msg' => "Invalid Phone number or Password."
					));
					exit;
				}


			}
		}
	}


	public function changemobileOtp()
	{
		if (isset($_POST) && $_POST != '') {
			if (empty($_POST['otpNumber'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter OTP."));
				exit;
			} else {

				$optData = $this->MyprofileModel->getChangeMobileOtpDataByPhone($_POST['phone']);
				if (empty($optData)) {
					echo json_encode(array('flag' => 0, 'msg' => "Phone number is not registered."));
					exit;

				} else {
					if ($optData['otp'] != $_POST['otpNumber']) {
						//if($_POST['otpNumber'] != '1234'){

						echo json_encode(array('flag' => 0, 'msg' => "Invalid OTP"));
						exit;

					} else {
						$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
						$this->MyprofileModel->UpdateMobileData($UserDetails->id, $optData['phone_no']);

						$this->db->where('phone_no', $optData['phone_no']);
						$this->db->delete('otp_change_mobile');

						echo json_encode(array('flag' => 1, 'msg' => "OTP verified successfully."));
						exit;

					}
				}

			}

		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}


	public function changemobileresendOtp()
	{
		if (isset($_POST) && $_POST != '') {

			$string = '0123456789';
			$string_shuffled = str_shuffle($string);
			$getOTP = substr($string_shuffled, 0, 4);

			$insertOTPdata = array(

				'phone_no' => $_POST['phone'],
				'otp' => $getOTP,

			);
			$this->db->insert('otp_change_mobile', $insertOTPdata);

			$mtd = "sms";
			//$mesg = 'Your OTP for Changing Mobile no is '.$getOTP;
			//$mesg = 'Your OTP to update your mobile number on truCSR is '.$getOTP.'.';
			$mesg1 = 'Your OTP to update your mobile number on truCSR is ' . $getOTP . '. Kindly don\'t share your OTP with anyone.
                        -
                        truCSR.in';
			$mesg = urlencode($mesg1);


			$mob = $_POST['phone'];
			$send = "truCSR";
			$key = "A6caf2ce090e57e969d65c6111ef27bb9";
			//$template_id = "1007162633765408035";
			$template_id = "1007162762909416289";

			$url = 'https://api-alerts.kaleyra.com/v4/?api_key=' . $key . '&method=' . $mtd . '&message=' . $mesg . '&to=' . $mob . '&sender=' . $send . '&template_id=' . $template_id . '';  // API URL
			//print_r($url);exit;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			$result = curl_exec($ch);

			echo json_encode(array('flag' => 1, 'msg' => "OTP sent to your registered number."));
			exit;

		} else {

			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;

		}
	}

	//Start Line New User Creation
	function StoreUser()
	{

		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$password = $this->input->post('password');
		$otp = $this->input->post('otp');

		if ($name && $email && $phone && $password) {

			if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter a valid Email address."));
				exit;
			} else if (!preg_match('/^[0-9]*$/', $phone)) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter valid number."));
				exit;
			} else {
				if (isset($id)) {
					$user = $this->CommonModel->TblSelectedRecords('users', 'access_type,email,phone_no', array('id' => $id));
					if ($user->email != $email)
						$vEmail = false;
					if ($user->phone_no != $phone)
						$vPhone = false;

				}
				$verifyEmail = $this->UserModel->verifyUserByEmail($email);
				$verifyPhone = $this->UserModel->verifyUserByPhone($phone);


				if (isset($verifyEmail) && count($verifyEmail) > 0 && !isset($vEmail)) {
					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this email address."));
					exit;
				} elseif (isset($verifyPhone) && count($verifyPhone) > 0 && !isset($vPhone)) {
					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this phone number."));
					exit;
				} else {

					$info = array(
						'first_name' => $name,
						'email' => $email,
						'phone_no' => $phone,
						'password' => password_hash($password, PASSWORD_DEFAULT),
						'account_role' => 2,
						'parentId' => $_SESSION['UserId'],
						'created_at' => strtotime(date('Y-m-d H:i:s')),
					);
					if (isset($id)) {
						$this->db->where('id', $id);
						$this->db->update('users', $info);

						$aid = $user->access_type;
						/*--------------------Update Info Into Access Group------------------------*/
						$this->CommonModel->delete('access_type_master', array('access_group_id' => $aid));
						/*--------------------End Update Info Into Access Group------------------------*/
					} else {
						/*--------------------Store Info Into Access Group------------------------*/
						$in = array('group_name' => 'Sub-Account', 'end_user_type' => 2, 'creator_user_profile_id' => $_SESSION['UserId'], 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
						$this->db->insert('access_group', $in);
						$aid = $this->db->insert_id();
						/*--------------------End Store Info Into Access Group------------------------*/
						$info += array('access_type' => $aid);
						$this->db->insert('users', $info);
					}

					$this->store($aid);

					if (isset($otp)) {
						$this->message($email, $phone, $password);
					}
					echo json_encode(array('flag' => 1, 'msg' => "User successfully created"));
					exit;
				}
			}

		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
	//End Line New User Creation

	//Start Line Message
	function message($email, $phone, $password)
	{
		$mtd = "sms";

		$mesg1 = 'Welcome to truCSR.';
		$mesg1 .= 'Email Id: ' . $email . '';
		$mesg1 .= 'Phone Number: ' . $phone . '';
		$mesg1 .= 'Password: ' . $password . '';
		$mesg1 .= 'truCSR.in';
		$mesg = urlencode($mesg1);

		$send = "truCSR";
		$key = "A6caf2ce090e57e969d65c6111ef27bb9";
		$template_id = "1007162762935940433";

		$url = 'https://api-alerts.kaleyra.com/v4/?api_key=' . $key . '&method=' . $mtd . '&message=' . $mesg . '&to=' . $phone . '&sender=' . $send . '&template_id=' . $template_id . ''; // API URL

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_exec($ch);
	}
	//End Line Message

	//Start Line Store
	function store($id)
	{
		/*------------Module--------------*/
		$m_dashboard = $this->input->post('m_dashboard');
		$m_project = $this->input->post('m_project');
		$m_contract = $this->input->post('m_contract');
		$m_fund = $this->input->post('m_fund');
		$m_report = $this->input->post('m_report');
		$m_rfp = $this->input->post('m_rfp');
		$m_volunteering = $this->input->post('m_volunteering');
		$m_user = $this->input->post('m_user');
		$m_csr = $this->input->post('m_csr');
		/*------------End Module--------------*/

		/*--------------Dashboard Module-------------------*/
		if (isset($m_dashboard)) {
			/*------------Funding Sub Module--------------*/
			$m_dashboard_funding_v = $this->input->post('m_dashboard_funding_v');
			if (isset($m_dashboard_funding_v)) {
				$info = array('m_id' => 1, 'sm_id' => 61, 'access_group_id' => $id, 'atm_access_type' => 4, 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Funding Sub Module------------------------*/
			/*------------Volunteering Sub Module--------------*/
			$m_dashboard_volunteering_v = $this->input->post('m_dashboard_volunteering_v');
			if (isset($m_dashboard_volunteering_v)) {
				$info = array('m_id' => 1, 'sm_id' => 62, 'access_group_id' => $id, 'atm_access_type' => 4, 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Volunteering Sub Module------------------------*/
		}
		/*--------------------End Dashboard Module--------------*/


		/*--------------Project Module-------------------*/
		if (isset($m_project)) {
			/*------------Project Sub Module--------------*/
			$m_project_d = $this->input->post('m_project_d');
			$m_project_e = $this->input->post('m_project_e');
			$m_project_v = $this->input->post('m_project_v');

			$key = array();
			if (isset($m_project_d)) {
				array_push($key, 3);
			}
			if (isset($m_project_e)) {
				array_push($key, 2);
			}
			if (isset($m_project_v)) {
				array_push($key, 4);
			}

			if ($key) {
				$info = array('m_id' => 3, 'sm_id' => 9, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}

			/*-----------------End Project Sub Module------------------------*/
		}
		/*--------------------End Project Module--------------*/


		/*--------------Contract Module-------------------*/
		if (isset($m_contract)) {
			/*------------Review Sub Module--------------*/
			$m_contract_review_e = $this->input->post('m_contract_review_e');
			$m_contract_review_v = $this->input->post('m_contract_review_v');
			if (isset($m_contract_review_e) || isset($m_contract_review_v)) {
				$key = array();
				if (isset($m_contract_review_e)) {
					array_push($key, 2);
				}
				if (isset($m_contract_review_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 4, 'sm_id' => 14, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Review Sub Module------------------------*/
			/*------------Signed Sub Module--------------*/
			$m_contract_signed_v = $this->input->post('m_contract_signed_v');
			if (isset($m_contract_signed_v)) {
				$info = array('m_id' => 4, 'sm_id' => 16, 'access_group_id' => $id, 'atm_access_type' => 4, 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Signed Sub Module------------------------*/
			/*------------Archived Sub Module--------------*/
			$m_contract_archived_v = $this->input->post('m_contract_archived_v');
			if (isset($m_contract_archived_v)) {
				$info = array('m_id' => 4, 'sm_id' => 63, 'access_group_id' => $id, 'atm_access_type' => 4, 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Archived Sub Module------------------------*/
		}
		/*--------------------End Contract Module--------------*/

		/*--------------Fund Module-------------------*/
		if (isset($m_fund)) {
			/*------------Csr Sub Module--------------*/
			$m_fund_csr_make = $this->input->post('m_fund_csr_make');
			$m_fund_csr_raise = $this->input->post('m_fund_csr_raise');
			$m_fund_csr_v = $this->input->post('m_fund_csr_v');
			if (isset($m_fund_csr_make) || isset($m_fund_csr_raise) || isset($m_fund_csr_v)) {
				$key = array();
				if (isset($m_fund_csr_make)) {
					array_push($key, 8);
				}
				if (isset($m_fund_csr_raise)) {
					array_push($key, 9);
				}
				if (isset($m_fund_csr_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 5, 'sm_id' => 17, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Csr Sub Module------------------------*/
			/*------------Donation Sub Module--------------*/
			$m_fund_donation_v = $this->input->post('m_fund_donation_v');
			if (isset($m_fund_donation_v)) {
				$info = array('m_id' => 5, 'sm_id' => 18, 'access_group_id' => $id, 'atm_access_type' => 4, 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Donation Sub Module------------------------*/
			/*------------Non CSR Module--------------*/
			$m_fund_non_make = $this->input->post('m_fund_non_make');
			$m_fund_non_raise = $this->input->post('m_fund_non_raise');
			$m_fund_non_v = $this->input->post('m_fund_non_v');
			if (isset($m_fund_non_make) || isset($m_fund_non_raise) || isset($m_fund_non_v)) {
				$key = array();
				if (isset($m_fund_non_make)) {
					array_push($key, 8);
				}
				if (isset($m_fund_non_raise)) {
					array_push($key, 9);
				}
				if (isset($m_fund_non_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 5, 'sm_id' => 20, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Non CSR Sub Module------------------------*/
			/*------------Honorary Sub CSR Module--------------*/
			$m_fund_honorary_make = $this->input->post('m_fund_honorary_make');
			$m_fund_honorary_raise = $this->input->post('m_fund_honorary_raise');
			$m_fund_honorary_v = $this->input->post('m_fund_honorary_v');
			if (isset($m_fund_honorary_make) || isset($m_fund_honorary_raise) || isset($m_fund_honorary_v)) {
				$key = array();
				if (isset($m_fund_honorary_make)) {
					array_push($key, 8);
				}
				if (isset($m_fund_honorary_raise)) {
					array_push($key, 9);
				}
				if (isset($m_fund_honorary_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 5, 'sm_id' => 19, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Honorary Sub Module------------------------*/
		}
		/*--------------------End Fund Module--------------*/

		/*--------------Reports Module-------------------*/
		if (isset($m_report)) {
			/*------------Progress Sub Module--------------*/
			$m_report_progress_e = $this->input->post('m_report_progress_e');
			$m_report_progress_v = $this->input->post('m_report_progress_v');
			if (isset($m_report_progress_e) || isset($m_report_progress_v)) {
				$key = array();
				if (isset($m_report_progress_e)) {
					array_push($key, 2);
				}
				if (isset($m_report_progress_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 6, 'sm_id' => 22, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Progress Sub Module------------------------*/
			/*------------Completion Sub Module--------------*/
			$m_report_completion_e = $this->input->post('m_report_completion_e');
			$m_report_completion_v = $this->input->post('m_report_completion_v');
			if (isset($m_report_completion_e) || isset($m_report_completion_v)) {
				$key = array();
				if (isset($m_report_completion_e)) {
					array_push($key, 2);
				}
				if (isset($m_report_completion_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 6, 'sm_id' => 23, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Completion Sub Module------------------------*/
			/*------------CSR Sub Module--------------*/
			$m_report_csr_e = $this->input->post('m_report_csr_e');
			$m_report_csr_v = $this->input->post('m_report_csr_v');
			if (isset($m_report_csr_e) || isset($m_report_csr_v)) {
				$key = array();
				if (isset($m_report_csr_e)) {
					array_push($key, 2);
				}
				if (isset($m_report_csr_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 6, 'sm_id' => 24, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End CSR Sub Module------------------------*/
			/*------------Director Sub Module--------------*/
			$m_report_director_e = $this->input->post('m_report_director_e');
			$m_report_director_v = $this->input->post('m_report_director_v');
			if (isset($m_report_director_e) || isset($m_report_director_v)) {
				$key = array();
				if (isset($m_report_director_e)) {
					array_push($key, 2);
				}
				if (isset($m_report_director_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 6, 'sm_id' => 25, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Director Sub Module------------------------*/
		}
		/*--------------------End Reports Module--------------*/

		/*--------------RFP Module-------------------*/
		if (isset($m_rfp)) {
			/*------------Project Sub Module--------------*/
			$m_rfp_e = $this->input->post('m_rfp_e');
			$m_rfp_v = $this->input->post('m_rfp_v');
			if (isset($m_rfp_e) || isset($m_rfp_v)) {
				$key = array();
				if (isset($m_rfp_e)) {
					array_push($key, 2);
				}
				if (isset($m_rfp_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 17, 'sm_id' => 53, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Project Sub Module------------------------*/
		}
		/*--------------------End RFP Module--------------*/

		/*--------------Volunteering Module-------------------*/
		if (isset($m_volunteering)) {
			/*------------Skill Sub Module--------------*/
			$m_volunteering_skill_e = $this->input->post('m_volunteering_skill_e');
			$m_volunteering_skill_v = $this->input->post('m_volunteering_skill_v');
			if (isset($m_volunteering_skill_e) || isset($m_volunteering_skill_v)) {
				$key = array();
				if (isset($m_volunteering_skill_e)) {
					array_push($key, 2);
				}
				if (isset($m_volunteering_skill_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 18, 'sm_id' => 54, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Skill Sub Module------------------------*/
			/*------------Opportunities Sub Module--------------*/
			$m_volunteering_opportunities_e = $this->input->post('m_volunteering_opportunities_e');
			$m_volunteering_opportunities_v = $this->input->post('m_volunteering_opportunities_v');
			if (isset($m_volunteering_opportunities_e) || isset($m_volunteering_opportunities_v)) {
				$key = array();
				if (isset($m_volunteering_opportunities_e)) {
					array_push($key, 2);
				}
				if (isset($m_volunteering_opportunities_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 18, 'sm_id' => 64, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Opportunities Sub Module------------------------*/
		}
		/*--------------------End Volunteering Module--------------*/


		/*--------------User Module-------------------*/
		if (isset($m_user)) {
			/*------------Entity Sub Module--------------*/
			$m_user_entity_e = $this->input->post('m_user_entity_e');
			$m_user_entity_v = $this->input->post('m_user_entity_v');
			if (isset($m_user_entity_e) || isset($m_user_entity_v)) {
				$key = array();
				if (isset($m_user_entity_e)) {
					array_push($key, 2);
				}
				if (isset($m_user_entity_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 20, 'sm_id' => 57, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Entity Sub Module------------------------*/
			/*------------Media Sub Module--------------*/
			$m_user_media_e = $this->input->post('m_user_media_e');
			$m_user_media_v = $this->input->post('m_user_media_v');
			if (isset($m_user_media_e) || isset($m_user_media_v)) {
				$key = array();
				if (isset($m_user_media_e)) {
					array_push($key, 2);
				}
				if (isset($m_user_media_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 20, 'sm_id' => 58, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Media Sub Module------------------------*/
			/*------------Transaction  Sub Module--------------*/
			$m_user_transaction_e = $this->input->post('m_user_transaction_e');
			$m_user_transaction_v = $this->input->post('m_user_transaction_v');
			if (isset($m_user_transaction_e) || isset($m_user_transaction_v)) {
				$key = array();
				if (isset($m_user_transaction_e)) {
					array_push($key, 2);
				}
				if (isset($m_user_transaction_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 20, 'sm_id' => 59, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Transaction  Sub Module------------------------*/
			/*------------Bank  Sub Module--------------*/
			$m_user_bank_e = $this->input->post('m_user_bank_e');
			$m_user_bank_v = $this->input->post('m_user_bank_v');
			if (isset($m_user_bank_e) || isset($m_user_bank_v)) {
				$key = array();
				if (isset($m_user_bank_e)) {
					array_push($key, 2);
				}
				if (isset($m_user_bank_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 20, 'sm_id' => 60, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Bank  Sub Module------------------------*/
			/*------------User Management  Sub Module--------------*/
			$m_user_e = $this->input->post('m_user_e');
			$m_user_v = $this->input->post('m_user_v');
			if (isset($m_user_e) || isset($m_user_v)) {
				$key = array();
				if (isset($m_user_e)) {
					array_push($key, 2);
				}
				if (isset($m_user_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 20, 'sm_id' => 56, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End User Management  Sub Module------------------------*/
		}
		/*--------------------End User Module--------------*/

		/*--------------CSR Module-------------------*/
		if (isset($m_csr)) {
			/*------------Basic  Sub Module--------------*/
			$m_csr_basic_e = $this->input->post('m_csr_basic_e');
			$m_csr_basic_v = $this->input->post('m_csr_basic_v');
			if (isset($m_csr_basic_e) || isset($m_csr_basic_v)) {
				$key = array();
				if (isset($m_csr_basic_e)) {
					array_push($key, 2);
				}
				if (isset($m_csr_basic_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 16, 'sm_id' => 65, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Basic  Sub Module------------------------*/
			/*------------Commitee Sub Module--------------*/
			$m_csr_commitee_e = $this->input->post('m_csr_commitee_e');
			$m_csr_commitee_v = $this->input->post('m_csr_commitee_v');
			if (isset($m_csr_commitee_e) || isset($m_csr_commitee_v)) {
				$key = array();
				if (isset($m_csr_commitee_e)) {
					array_push($key, 2);
				}
				if (isset($m_csr_commitee_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 16, 'sm_id' => 66, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Commitee Sub Module------------------------*/
			/*------------Annual  Sub Module--------------*/
			$m_csr_annual_e = $this->input->post('m_csr_annual_e');
			$m_csr_annual_v = $this->input->post('m_csr_annual_v');
			if (isset($m_csr_annual_e) || isset($m_csr_annual_v)) {
				$key = array();
				if (isset($m_csr_annual_e)) {
					array_push($key, 2);
				}
				if (isset($m_csr_annual_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 16, 'sm_id' => 67, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Annual  Sub Module------------------------*/
			/*------------Computation  Sub Module--------------*/
			$m_csr_computation_e = $this->input->post('m_csr_computation_e');
			$m_csr_computation_v = $this->input->post('m_csr_computation_v');
			if (isset($m_csr_computation_e) || isset($m_csr_computation_v)) {
				$key = array();
				if (isset($m_csr_computation_e)) {
					array_push($key, 2);
				}
				if (isset($m_csr_computation_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 16, 'sm_id' => 68, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Computation  Sub Module------------------------*/
			/*------------Spent  Sub Module--------------*/
			$m_csr_spent_e = $this->input->post('m_csr_spent_e');
			$m_csr_spent_v = $this->input->post('m_csr_spent_v');
			if (isset($m_csr_spent_e) || isset($m_csr_spent_v)) {
				$key = array();
				if (isset($m_csr_spent_e)) {
					array_push($key, 2);
				}
				if (isset($m_csr_spent_v)) {
					array_push($key, 4);
				}

				$info = array('m_id' => 16, 'sm_id' => 69, 'access_group_id' => $id, 'atm_access_type' => implode(',', $key), 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
				$this->db->insert('access_type_master', $info);
			}
			/*-----------------End Spent  Sub Module------------------------*/
		}
		/*--------------------End CSR Module--------------*/
	}
	//End Line Store
	public function newaccount()
	{
		$query = $this->db->get('org_type_master');
		$result = $query->result();
		$data['orgtypeall'] = $result;
		$data['PageTitle'] = SITE_NAME . ' - Add New Account';
		$this->load->view('profile/newaccount', $data);
	}
	public function createNewAccount()
	{
		$UserId = $this->session->userdata('UserId');

		$enityName = $this->input->post('enityName');
		$inputEmail = $this->input->post('inputEmail');
		$inputMobile = $this->input->post('inputMobile');
		$orgType = $this->input->post('orgType');

		$info = array(
			'user_id' => $UserId,
			'entity_name' => $enityName,
			'alternate_email_id' => $inputEmail,
			'entity_type' => $orgType,
			'created_at' => strtotime(date('Y-m-d H:i:s')),
		);
		$this->db->insert('user_profile', $info);
		$id = $this->db->insert_id(); 

		$this->session->set_userdata('ProfileId', $id);
		$this->session->set_userdata('ActiveRole', NULL);
		$this->session->set_userdata('AccountRole', NULL);   

		redirect(base_url() . 'register/user_type');
	}
}
