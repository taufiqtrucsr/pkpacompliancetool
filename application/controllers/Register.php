<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/third_party/APISetu.php';

###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Neha Raut (neha.raut@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2019
###+------------------------------------------------------------------------------------------------

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CommonModel');
		$this->load->model('CompanyModel');
		$this->load->model('UserModel');
		$this->load->model('NgoModel');
		$this->load->model('FundraiserModel');
		$this->load->library('user_agent');
		$this->imageDelete = SKIN_URL."images/deleteIconsline.svg";
		
		if (isset($_SESSION['UserId'])) 
		{
			$_SESSION['countdown'] = 40;
			$_SESSION['time_started'] = date("Y-m-d H:i:s");
			$_SESSION['last_active_time'] = time();
			$end_time = date("Y-m-d H:i:s", strtotime('+' . $_SESSION['countdown'] . 'minutes', strtotime($_SESSION['time_started'])));
			$_SESSION['end_time'] = $end_time;
		}
		if(isset( $_SESSION['UserId'] )):
			$userId            = $_SESSION['UserId'];
			$user_profiles     = $this->NgoModel->getUserRoleAndProfle();
			$currentassociatedrole      = $this->NgoModel->checkUserRole($userId);
			$this->profile_id  = $_SESSION['ProfileId'];
			$this->assoc_roles_in_array = explode(",", $currentassociatedrole);
		endif;

	}

	//webdev62
	public function accountaccess(){

	
		$query = $this->db->get('org_type_master');
		$result = $query->result();
		$data['orgtypeall'] = $result;
		$data['PageTitle'] = SITE_NAME . ' - Add New Account';
		$this->load->view('designwebdev/accountaccess', $data);

	}


	public function signin()
	{

		if (isset($_SESSION['UserId']) && $_SESSION['UserId'] != '') {
			redirect(base_url('refresh'));
		}
		$data['PageTitle'] = SITE_NAME . ' - Sign In';
		$this->load->view('signup/login', $data);
	}

	public function mailsendtest()
	{
		$config =
		array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'krishnabrainmaze@gmail.com',
			'smtp_pass' => 'uigyxagtcfbmxeba',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1'
		);
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$from_email = "krishnabrainmaze@gmail.com";
		$to_email = "developer.owengraffix@gmail.com";
		$this->load->library('email');
		$this->email->from($from_email, 'Identification');
		$this->email->to($to_email);
		$this->email->subject('Send Email Codeigniter');
		$this->email->message('The email send using codeigniter library');
		$result = $this->email->send();
		$data = $this->CommonModel->mycustommail();
		die();
	}


	public function signup()
	{
		if (isset($_SESSION['UserId']) && $_SESSION['UserId'] != '') {
			redirect(base_url('refresh'));
		}
		$query = $this->db->get('org_type_master');
		$result = $query->result();
		$data['orgtypeall'] = $result;
		$data['PageTitle'] = SITE_NAME . ' - Sign Up';
		$this->load->view('signup/signup', $data);
	}
	// code start her for user_bifurcation
	public function user_type()
	{
		error_reporting(0);
		if (isset($_SESSION['UserId'])) {

			$UserId = $_SESSION['UserId'];
			$KycStatus = $this->NgoModel->checkUserProfileStatus($UserId);
			$role = $this->NgoModel->checkUserRole($UserId);
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			$profile = $this->CommonModel->TblSelectedRecords('user_profile','*',array('id' => $_SESSION['ProfileId']));
			$user_type   = $UserDetails->current_role;
		    $entity_type = $profile->entity_type;
			$all_assoc_role = $this->UserModel->get_orgtype_all_role($entity_type);
			$roles_string   = $all_assoc_role[0]->user_role;
			$roles_in_array = explode(",", $roles_string);


			$data['asocc_roles_in_array'] = array_filter($roles_in_array);

			
			$this->load->view('user/user_type', $data);

			// This Code Comment by krishna please ask if any one need 
			// if (empty($role)) {
			// 	$this->load->view('user/user_type', $data);
			// } else {
			// 	if ($KycStatus == 4 && $role == 2) {
			// 		$this->load->view('user/');
			// 	} elseif ($KycStatus == 3 && $role == 2) {
			// 		$this->load->view('user/user_type');
			// 	} elseif ($KycStatus == 0 && $role == 3) {
			// 		;
			// 		$this->load->view('user/user_type');
			// 	} elseif ($KycStatus == 0 && $role == 7) {
			// 		;
			// 		$this->load->view('user/user_type');
			// 	} elseif ($KycStatus == 0 && $role == 2) {
			// 		;
			// 		$this->load->view('user/user_type');
			// 	} elseif ($KycStatus == 0 && $role == 1) {
			// 		;
			// 		$this->load->view('user/user_type');
			// 	} elseif ($KycStatus == 0 && $role == 4) {
			// 		;
			// 		$this->load->view('user/user_type');
			// 	} else {
			// 		$this->load->view('user/user_type');
			// 	}

			// }
			// This Code Comment by krishna please ask if any one need 

			// if($KycStatus == 4){
			// 	redirect('dashboard');
			// }elseif($KycStatus == 3){
			// 	$this->load->view('user/user_type');
			// }elseif($KycStatus == 0){
			// 	$ProfileID = $this->NgoModel->GetUserProfileAccountId($UserId);
			// 	if($ProfileID){
			// 		redirect('register/basicDetailsStepForm2#ngo-step-2');
			// 	}
			// 	$this->load->view('user/user_type');
			// }
			// elseif($role == 3){
			// 	$this->load->view('user/usertypepurpose');
			// }
			// else{
			// 	$this->load->view('user/user_type');	
			// }

		} else {
			redirect(base_url('signup', 'refresh'));
		}
	}
	function whatspurpose()
	{
		$this->load->view('user/usertypepurpose');
	}

	// code ends for user_bifurcation
	// code start for EntityType
	public function entity_type()
	{
		if (isset($_SESSION['UserId'])) {

			$userid = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			//$user_type   = $UserDetails->current_active_role;
			$user_type   = $_SESSION['ActiveRole'];
			$type =  $UserDetails->user_type;

			$data['user_profile_check'] = $this->NgoModel->GetUserProfileInfo($userid);

			$data['entity_type'] = $data['user_profile_check']->entity_type;
			$data['org_type_name'] = $this->NgoModel->GetOrgTypeMaster($data['entity_type']);
			$data['currentRole']   = $this->NgoModel->checkUserRole($userid);

			if ($data['user_profile_check']) {



				$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle();
				$Profile_ID = $data['usersprofile']->id;

			
				$kyc_Status =  $data['usersprofile']->kyc_status;
				//kyc status = 4 Non-individual = 1 and not implementor
				if($kyc_Status == 4 && $type == 1 &&  $user_type != 1){
					$this->basicDetailsStepForm2();
				}
				$state_id   = $data['usersprofile']->state;
				$statCode   = $this->NgoModel->statecodebystateId($state_id);
				$data['usersdocuments']     = $this->NgoModel->documentsbyprofileId($Profile_ID);

				$data['governing_body']     = $this->NgoModel->governing_body($Profile_ID,$user_type);
				$data['usersdocuments_pan'] = $this->NgoModel->documentsPANId($Profile_ID);
				$data['usersdocuments_gst'] = $this->NgoModel->documentsGSTId($Profile_ID);
				$data['usersdocuments_regcert'] = $this->NgoModel->documentsUploadRegisterationCertificateId($Profile_ID);

				// echo '<pre>',var_dump($data['usersdocuments_regcert']); echo '</pre>';

				// die();
				$data['usersdocuments_trustdeed'] = $this->NgoModel->documentsTRUSTDEEDId($Profile_ID);

				$data['SelCity'] = $this->NgoModel->citybystatecode($statCode);
				$cin = $this->NgoModel->documentsCINId($this->profile_id);

				if ($cin) {
					$data['cin_no'] = $cin[0]->document_number;
				}
			} else {
				$data['usersprofile'] = array();
				$data['cin_no'] = '';
			}

			// echo "<pre>";
			// print_r($data['governing_body']);
			//   die; 
			$data['orgtype'] = $this->UserModel->get_orgtype($user_type);
			
			/*`	sanjay oraon
				06/07/2023
				List of Entity Type For cin validation process
			*/
			$data['cinEntityTypeList'] = array(6,8,9,10,11);
			/****************/
			$this->load->view('user/new_entity_type', $data);
		}
	}
	// code ends for EntityType
	public function addMoreGoverningAct()
	{
		$gov_act = $this->NgoModel->addMoreGoverningAct();
		$html = '<div class="form-group col-sm-6">
			<label class="control-label">Governing Act<span>*</span></label>
			<div class="select-box">
			<select id="govAct" name="govAct[]" class="form-control">
				<option value="0">Select Governing ID</option>';
		foreach ($gov_act as $key => $gov_actvalue) {
			$html .= '<option value="' . $gov_actvalue->id . '">' . $gov_actvalue->governing_act . '
					</option>';
		}
		$html .= '
			</select>
			</div>
	  	</div>';
		echo $html;
	}
	public function registration()
	{
		if (isset($_SESSION['UserId'])) {
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			if (isset($UserDetails) && $UserDetails->status == 3 && $UserDetails->entity_type == 2) {
				$cboardMembersData = 0;
				$companyDetails = $this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				if (isset($companyDetails->id)) {
					$cboardMembersData = $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);
					$cboardMembersData = count($cboardMembersData);
				}
				if ($cboardMembersData > 0) {
					redirect(base_url('/company/view'), 'refresh');
				} else if ($companyDetails->cin_no != "") {
					redirect(base_url('/company/edit/' . $companyDetails->id . '/#company-step-3'), 'refresh');
				} else {
					redirect(base_url('/company/edit/' . $companyDetails->id . '/#company-step-2'), 'refresh');
				}
			} elseif (isset($UserDetails) && $UserDetails->status == 3 && $UserDetails->entity_type == 1) {
				$nboardMembersData = 0;
				$ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
				if (isset($ngoDetails->id)) {
					$nboardMembersData = $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);
					$nboardMembersData = count($nboardMembersData);
				}

				if ($nboardMembersData > 0) {
					redirect(base_url('ngo/view'), 'refresh');
					//}else if($ngoDetails->year1_file != "" || $ngoDetails->year1_file == "") {
				} else if ($ngoDetails->primary_source_type != "" || $ngoDetails->year1_file != "") {
					redirect(base_url('/ngo/edit/' . $ngoDetails->id . '/#ngo-step-4'), 'refresh');
				} else if ($ngoDetails->cin_no != "") {
					redirect(base_url('/ngo/edit/' . $ngoDetails->id . '/#ngo-step-3'), 'refresh');
				} else {
					redirect(base_url('/ngo/edit/' . $ngoDetails->id . '/#ngo-step-2'), 'refresh');
				}
			} else {
				$data['PageTitle'] = SITE_NAME . ' - Registration';
				$data['State'] = $this->CommonModel->get_state();
				$data['Organization_Type'] = $this->CommonModel->get_organization_type();
				$data['Co_Organization_Type'] = $this->CommonModel->get_corporate_organization_type();
				$data['OrgType'] = $UserDetails->entity_type;
				$data['Sector_Master'] = $this->CommonModel->get_sector_master();
				$data['PrimarySourceMaster'] = $this->CommonModel->getPrimarySourceMaster();
				$this->load->view('register/registration', $data);
			}

		} else {
			redirect(base_url('signin/'), 'refresh');
		}
	}


	public function signUpPostData()
	{
		if (isset($_POST) && $_POST != '') {

			$EntityType = $_POST['enityType'];
			// if(empty($_POST['inputFname']) || empty($_POST['inputLname']) || empty($_POST['inputEmail']) || empty($_POST['inputMobile']) || empty($_POST['inputPassword'])) {
			// 		echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			// 		exit;
			// }

			if (empty($_POST['inputFname']) || empty($_POST['inputMiddle']) || empty($_POST['inputLname']) || empty($_POST['inputEmail']) || empty($_POST['inputMobile']) || empty($_POST['enityType'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			}
			//  elseif(!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
			// 	echo json_encode(array( 
			// 		'flag' => 0,
			//         'msg' => "Please check on the reCAPTCHA box."
			//     ));
			//     exit;
			// } 
			else if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST["inputEmail"])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter a valid Email address."));
				exit;
			} elseif (!preg_match('/^[0-9]*$/', $_POST['inputMobile'])) {
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

				$UserDetails = $this->UserModel->GetUserByEmail($_POST['inputEmail'], $EntityType);
				$UserDetails2 = $this->UserModel->GetUserByPhone($_POST['inputMobile'], $EntityType);


				if (isset($UserDetails) && $UserDetails->id != '') {
					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this email address."));
					exit;
				} elseif (isset($UserDetails2) && $UserDetails2->id != '') {

					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this phone number."));
					exit;
				} else {
					
					$string = '0123456789';
					$string_shuffled = str_shuffle($string);
					$getOTP = substr($string_shuffled, 0, 4);

					$insertOTPdata = array(

						'phone_no' => $_POST['inputMobile'],
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

					$mob = $_POST['inputMobile'];
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

					echo json_encode(array('flag' => 1, 'msg' => "Enter OTP which sent your registered mobile no.", 'phone' => $_POST['inputMobile']));
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


	public function isExist()
	{
		if (isset($_POST) && $_POST != '') {

			$EntityType = $_POST['enityType'];

			if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST["inputEmail"])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter a valid Email address."));
				exit;
			} elseif (!preg_match('/^[0-9]*$/', $_POST['inputMobile'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter valid number."));
				exit;
			}else {
				$UserDetails = $this->UserModel->GetUserByEmail($_POST['inputEmail'], $EntityType);
				$UserDetails2 = $this->UserModel->GetUserByPhone($_POST['inputMobile'], $EntityType);


				if (isset($UserDetails) && $UserDetails->id != '') {
					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this email address."));
					exit;
				} elseif (isset($UserDetails2) && $UserDetails2->id != '') {

					echo json_encode(array('flag' => 0, 'msg' => "User already registered with this phone number."));
					exit;
				} else {
					echo json_encode(array('flag' => 1, 'msg' => ""));
					exit;
				}
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	private function generateToken($length = 20)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function verifyOtp()
	{

		// $userId = $_SESSION['UserId'];
		// print_r("session id ");
		// print_r($userId);

		if (isset($_POST) && $_POST != '') {

			if (empty($_POST['otpNumber'])) {

				echo json_encode(array('flag' => 0, 'msg' => "Please enter OTP."));
				exit;

			} else {

				$optData = $this->UserModel->getOtpDataByPhone($_POST['phone']);
				if (empty($optData)) {
					echo json_encode(array('flag' => 0, 'msg' => "Phone number is not registered."));
					exit;

				} else {

					if ($optData['otp'] != $_POST['otpNumber']) {
						// if($_POST['otpNumber'] != '1234'){
						echo json_encode(array('flag' => 0, 'msg' => "Invalid OTP"));
						exit;

					} else {

						$this->db->where('phone_no', $optData['phone_no']);
						$this->db->delete('otp');
						$HashPassword = password_hash($_POST['inputPassword'], PASSWORD_DEFAULT);
						//$invitee_type = 'fundraiser':'donor';

						/*
						--------------------------START-------------------------------
						Sanjay Oraon
						Date 15-09-2023
						We Will Do It During Invititaion Module

						$UnretsiteredUser = $this->FundraiserModel->findUnregisterUser($_POST['inputEmail'], $_POST['phone']);
						if (count($UnretsiteredUser) > 0) {

							$userType = $this->FundraiserModel->findUnregisterUserType($_POST['inputEmail'], $_POST['phone']);
							if ($userType->invitee_type == "fundraiser") {
								$type = 4;
							} elseif ($userType->invitee_type == "volunter") {
								$type = 5;
							} else {
								$type = 6;
							}
							//echo "success";
							$EntityType = $_POST['enityType'];
							$insertdata = array(
								'email' => $_POST['inputEmail'],
								'first_name' => $_POST['inputFname'],
								'middlename' => $_POST['inputMiddle'],
								'last_name' => $_POST['inputLname'],
								'phone_no' => $_POST['inputMobile'],
								'entity_name' => $_POST['enityName'],
								'User_type' => $_POST['enityType'],
								'password' => $HashPassword,
								'status' => 1,
								'type' => $type,
								'entity_type' => $_POST['orgType'],
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);
							$this->db->insert('users', $insertdata);
							$LastInsertID = $this->db->insert_id();

							$insertdata1 = array(
								'user_id' => $LastInsertID,
								'role_id' => $type,
								'created_at' => strtotime(date('Y-m-d H:i:s'))
							);
							$this->db->insert('user_role_lnk', $insertdata1);

							foreach ($UnretsiteredUser as $UR) {
								$memberId = $UR->id;
								$updatedata = array(
									'register_status' => 2,
									'invitee_id' => $LastInsertID,
									'register_date' => strtotime(date('Y-m-d H:i:s')),
									'updated_at' => strtotime(date('Y-m-d H:i:s'))
								);
								$this->db->where('id', $memberId);
								$this->db->update('campaign_members', $updatedata);
							}

						} else {
							//echo "fail";
							$EntityType = $_POST['enityType'];
							$insertdata = array(
								'first_name' => $_POST['inputFname'],
								'middlename' => $_POST['inputMiddle'],
								'last_name' => $_POST['inputLname'],
								'email' => $_POST['inputEmail'],
								'phone_no' => $_POST['inputMobile'],
								'entity_name' => $_POST['enityName'],
								'User_type' => $_POST['enityType'],
								'entity_type' => $_POST['orgType'],
								'password' => $HashPassword,
								'user_status' => 1,
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);
							$this->db->insert('users', $insertdata);
							$LastInsertID = $this->db->insert_id();

							$insertdata1 = array(
								'user_id' => $LastInsertID,
								'role_id' => 0,
								'created_at' => strtotime(date('Y-m-d H:i:s'))
							);
							$this->db->insert('user_role_lnk', $insertdata1);
						}
						----------------------------END------------------------
						*/

						/*
						--------------------------START-------------------------------
						Sanjay Oraon
						Date 15-09-2023
						We Will Remove It During Invititaion Module
						*/
							$guid = GUID();
							$EntityType = $_POST['enityType'];
							$insertdata = array(
								'first_name' => $_POST['inputFname'],
								'middle_name' => $_POST['inputMiddle'],
								'GUID' => $guid,
								'last_name' => $_POST['inputLname'],
								'email' => $_POST['inputEmail'],
								'phone_no' => $_POST['inputMobile'],
								'User_type' => $_POST['enityType'],
								'account_role' => 1,
								'password' => $HashPassword,
								'user_status' => 1,
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);
							$this->db->insert('users', $insertdata);
							$LastInsertID = $this->db->insert_id();

							$info = array(
								'user_id' => $LastInsertID,
								'entity_name' => $_POST['enityName'],
								'entity_type' => $_POST['orgType'],
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);
							$this->db->insert('user_profile', $info);
							$pId = $this->db->insert_id();

							$info = array('profile_id_display'=> $pId);
							$this->db->where('id', $LastInsertID);
							$this->db->update('users', $info);

							/*$insertdata1 = array(
								'user_id' => $LastInsertID,
								'role_id' => 0,
								'created_at' => strtotime(date('Y-m-d H:i:s'))
							);
							$this->db->insert('user_role_lnk', $insertdata1);*/

							$consent = fatch_consent(CONSENT[0]);
							if($consent){
								$info = array(
									't_c_type' => 1,
									'GUID' => $guid,
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
						/*
							----------------------------END------------------------
						*/

						// mail for registrtation new user By Neerajkumar
						// $templateId =14;
						// $to = $_POST['inputEmail'];
						// $encoded_id_email = urlencode($to.'-'.$LastInsertID);
						// $url = BASE_URL."verify-email-address/".$encoded_id_email;
						// $url = BASE_URL."discover";
						// $username = $_POST['inputFname'].' '.$_POST['inputLname'];
						// $TempVars = array();
						// $DynamicVars = array();
						// $TempVars = array("##USERNAME##","##WEBSITE_LINK##");
						// $DynamicVars   = array($username,$url);
						//echo $to;
						// $mailSent = $this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars,$DynamicVars);
						// mail end for registration new user ends here
						// print_r("Neerajkumar");
						// exit;
						$templateId = 1;
						$to = $_POST['inputEmail'];
						$encoded_id_email = urlencode($to . '-' . $LastInsertID);
						$url = BASE_URL . "verify-email-address/" . $encoded_id_email;
						$username = $_POST['inputFname'] . ' ' . $_POST['inputLname'];
						$TempVars = array();
						$DynamicVars = array();

						$TempVars = array("##USERNAME##", "##VERIFYEMAILURL##");
						$DynamicVars = array($username, $url);
						//echo $to;
						$mailSent = $this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars, $DynamicVars);
						//echo $mailSent;exit;
						//$redirect = base_url();

						if ($mailSent == true) {
							// send notification or insert 
							$notification_text = $username . ' has registered.';
							$link = '<a href="/admin.php/user/viewUser/' . $LastInsertID . '">View the details here</a>';
							$type = 1; //when implementer signs the contract
							$remark = '';

							// global model
							$query_builder['table_name'] = 'adminusers';
							$query_builder['where_in'] = array('user_type' => array(1, 2, 3));
							$adminUsers = $this->gm->get_data_list($query_builder);
							// $adminuseremail = array("tadoc91003@sartess.com","p.jaykumar1997@gmail.com","namrataamrute30@gmail.com");
							// foreach($adminuseremail as $test){


							// Email code written by Neerajkumar on 06-04-2022 (This message will trigger to srm only when a new user registered)

							$query_for_rm['table_name'] = 'adminusers';
							$query_for_rm['where_in'] = array('user_type' => array(3));
							$srmonly = $this->gm->get_data_list($query_for_rm);

							foreach ($srmonly as $get_rm_details) {

								$notificationText = $username . ' has registered.';
								$Link = '<a href="' . BASE_URL . 'admin.php/user/viewUser/' . $LastInsertID . '">View the details here</a>';
								// $ngoDetails = "This is testing file.";
								$templateId = 14;
								$to = $get_rm_details['email'];
								$UserNameEmail = $get_rm_details['first_name'] . ' ' . $get_rm_details['last_name'];
								$TempVars = array();
								$DynamicVars = array();
								$TempVars = array("##USERNAME##", "##NOTIFICATIONTEXT##", "##LINK##");
								$DynamicVars = array($UserNameEmail, $notificationText, $Link);
								$this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars, $DynamicVars);



							}
							// Email code Registration ends here by Neerajkumar 


							// global model
							$query_builder1['table_name'] = 'users';
							$query_builder1['where'] = array('id' => $LastInsertID);
							$UserDetails = $this->gm->get_data_row($query_builder1);
							$status = '';
							foreach ($adminUsers as $row) {
								$insertdata = array(
									'from_user_id' => $LastInsertID,
									'to_user_id' => $row['id'],
									'type' => $_POST['orgType'],
									'notification_text' => $notification_text,
									'area_id' => 0,
									'link' => $link,
									'type' => 5,
									// New register
									'type_of_notification' => 1,
									'created_at' => strtotime(date('Y-m-d H:i:s')),
								);

								$status = $this->gm->insert('adminuser_notifications', $insertdata); // global model



							}
							// calling global model - Vishal parmar 

							if ($status != '') {
								// code start here
								$mobile = trim($_POST['inputMobile']);
								$Record = $this->UserModel->UserExistCount($mobile, $EntityType);
								$UserDetails = $this->UserModel->GetUserByPhone($mobile, $EntityType);

								if (sizeof($UserDetails) > 0) {
									$Pass1 = $UserDetails->password;
								}
								$Pass2 = $_POST['inputPassword'];
								if ($Record > 0 && password_verify($Pass2, $Pass1)) {

									$this->session->set_userdata('UserId', $UserDetails->id);  
									$this->session->set_userdata('PrimeId', $UserDetails->parentId);
									$this->session->set_userdata('ProfileId', $UserDetails->profile_id_display);
									$this->session->set_userdata('ActiveRole', NULL);
									$this->session->set_userdata('AccountRole', $UserDetails->account_role);   
									$this->session->set_userdata('UserType', $UserDetails->user_type);   
									$this->session->set_userdata('LoginToken', $this->generateToken());  

									$this->db->insert(
										'login_session_front',
										array(
											'userID' => $UserDetails->id,
											'access_token' => $this->session->userdata('LoginToken'),
											'created_at' => strtotime(date('Y-m-d H:i:s'))
										)
									);
								}
								$userId = $_SESSION['UserId'];
								// code ends here
								$redirect = base_url() . 'register/user_type';
								echo json_encode(array('flag' => 1, 'msg' => "OTP verified successfully.", 'redirect' => $redirect));
							}
							exit;
							//    echo json_encode(array('flag'=>1, 'msg'=>"OTP verified successfully."));
							//    exit;

						} else {
							echo json_encode(array('flag' => 0, 'msg' => "Something went wrong, please try again"));
							exit;
						}
					}
				}

			}

		} else {

			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function resendOtp()
	{
		if (isset($_POST) && $_POST != '') {

			$string = '0123456789';
			$string_shuffled = str_shuffle($string);
			$getOTP = substr($string_shuffled, 0, 4);


			$insertOTPdata = array(

				'phone_no' => $_POST['phone'],
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

			$mob = $_POST['phone'];
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

			echo json_encode(array('flag' => 1, 'msg' => "OTP sent to your registered number."));
			exit;

		} else {

			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;

		}

	}
	public function ImprRegForm1()
	{
		if (in_array( $impid =1 , $this->assoc_roles_in_array))
		{
			redirect("dashboard/kycdashboard");
		}
		$userid = $_SESSION['UserId'];
		$role_id = $_SESSION['current_role'];
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$account_id  = $this->NgoModel->GetUserProfileAccountId($userid);
		if ($account_id) {
			$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle();
		} else {
			$data['usersprofile'] = array();
		}
		$data['orgtype'] = $this->UserModel->Imporgtype();
		$this->load->view("register/imp-reg-form1", $data);
	}
	public function saveImpStep1()
	{
		$id = $_SESSION['UserId'];
	
		if (isset($_POST) && $_POST != '') {
			$checkIDexists = $this->NgoModel->getUserRoleAndProfle();
			
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

			/*stepperTransferd $this->db->where('id', $id);
			$this->db->update('users', array('step' => 2));*/

			$saveData = array(
				'user_id' => $id,
				'entity_name' => $_POST['entityName'],
				'governing_act_id' => $_POST['govAct'],
				'date_of_incorp_birth' => strtotime($_POST['incorpDate']),
				'website' => $_POST['website'],
				'entity_address' => $_POST['registerAddress_line_1'],
				'pincode' => $_POST['pincode'],
				'district'=>$_POST['cityOrDistrict'],
				'city' => $_POST['city'],
				'state' => $_POST['state'],
				'about_entity' => $_POST['about_entity'],
				'entity_logo' => $entityLogo,
				'step' => 2
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
	public function ImprRegForm2()
	{
		if (in_array( $impid =1 , $this->assoc_roles_in_array))
		{
			redirect("dashboard/kycdashboard");
		}
		$userid = $_SESSION['UserId'];
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
	    $profile_id  = $this->NgoModel->GetUserProfileAccountId($userid);
		$bank_query  = "SELECT * FROM `bank_details` WHERE `profile_id` = " . $profile_id . "";
		$bank_data   = $this->db->query($bank_query)->row();
		$data['bank_data'] = $bank_data;
		if ($profile_id) {
			$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle();
			$Entity_type_id_sel = $data['usersprofile']->entity_type;
			$Profile_ID = $data['usersprofile']->id;
			$state_id = $data['usersprofile']->state;
			$data['usersdocuments'] = $this->NgoModel->documentsbyprofileId($Profile_ID);
			$data['usersdocuments_cin'] = $this->NgoModel->documentsCINId($Profile_ID);
			$data['usersdocuments_pan'] = $this->NgoModel->documentsPANId($Profile_ID);
			$data['usersdocuments_gst'] = $this->NgoModel->documentsGSTId($Profile_ID);
			$data['governing_body'] = $this->NgoModel->governing_bodyByprofileId($Profile_ID);
			$data['imp_exp'] = $this->NgoModel->getImplementationExp($profile_id, $_SESSION['current_role']);
			$data['business_areas'] = $this->NgoModel->getBusinessOperation($profile_id, $_SESSION['current_role']);	
			
		} else {
			$data['usersprofile'] = array();
		}
		$data['orgtype'] = $this->UserModel->Imporgtype();
		$this->load->view("register/imp-reg-form2", $data);
	}
	public function saveImpStep2()
	{
		
		$userid = $_SESSION['UserId'];
		$role_id = $_SESSION['current_role'];
		if (isset($_POST) && $_POST != '') {
			$sql = "SELECT id FROM `user_profile` WHERE `user_id` = " . $userid . "";
			$user_profiles = $this->db->query($sql)->row();
			if ($_POST['implement']) {
				$implement_experience = $_POST['implement'];
				$this->db->where('profile_id', $user_profiles->id);
				$this->db->where('role_id', $_SESSION['current_role']);
				$this->db->delete('implementation_exp');

				foreach ($implement_experience as $key => $implement_experience_value) {
					if($implement_experience_value['sector'] != ''){
					$report_1_file_path = '';
					$name = 'implement_' . $key . '_doc_0';
					$file_name = $_FILES[$name]['name'];
					if ($file_name) {
						$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
						$report_1_file_path = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
						$config['upload_path'] = FINANCIAL_REPORT_PATH;
						$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload($name)) {
							$uploadData = $this->upload->data();
							$report_1_file_path = $uploadData['file_name'];
						} 
					}else{
						$name = 'implement_' . $key . '_doc_old_0';
						if(array_key_exists($name, $_POST)){
							$report_1_file_path = $_POST[$name];
						}
						else{
							$report_1_file_path = '';
						}
					}
					$report_2_file_path = '';
					$name = 'implement_' . $key . '_doc_1';
					$file_name = $_FILES[$name]['name'];
					if ($file_name) {
						$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
						$report_2_file_path = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
						$config['upload_path'] = FINANCIAL_REPORT_PATH;
						$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload($name)) {
							$uploadData = $this->upload->data();
							$report_2_file_path = $uploadData['file_name'];
						} 
					}else{
						$name = 'implement_' . $key . '_doc_old_1';
						if(array_key_exists($name, $_POST))
						{
							$report_2_file_path = $_POST[$name];
						}
						else{
							$report_2_file_path = '';
						}
					}
					$report_3_file_path = '';
					$name = 'implement_' . $key . '_doc_2';
					$file_name = $_FILES[$name]['name'];
					if ($file_name) {
						$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
						$report_3_file_path = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
						$config['upload_path'] = FINANCIAL_REPORT_PATH;
						$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload($name)) {
							$uploadData = $this->upload->data();
							$report_3_file_path = $uploadData['file_name'];
						}
					} else{
						$name = 'implement_' . $key . '_doc_old_2';
						if(array_key_exists($name, $_POST)){
							
							$report_3_file_path = $_POST[$name];
						}
						else{
							$report_3_file_path = '';
						}
					}
					$exp_data = [
						'profile_id' => $user_profiles->id,
						'sector_id' => $implement_experience_value['sector'],
						'role_id' => $_SESSION['current_role'],
						'total_exp_year' => $implement_experience_value['year'],
						'total_exp_month' => $implement_experience_value['month'],
						'FY1_execution' => $implement_experience_value['daterange'][0],
						'report_1_file_path' => $report_1_file_path,
						'FY2_execution' => $implement_experience_value['daterange'][1],
						'report_2_file_path' => $report_2_file_path,
						'FY3_execution' => $implement_experience_value['daterange'][2],
						'report_3_file_path' => $report_3_file_path,
						'created_at' => date('Y-m-d H:i:s')
					];
					$this->db->insert('implementation_exp', $exp_data);
				}
				}
			}

			$this->db->where('profile_id', $user_profiles->id);
			$this->db->where('role_id', $_SESSION['current_role']);
			$this->db->delete('business_operation');
			
			if ($_POST['areaofbuisness'][0]['state'] != '') {
				foreach ($_POST['areaofbuisness'] as $location_value) {
					if (array_key_exists('district', $location_value)) {
						$insertData = array(
							'profile_id' => $user_profiles->id,
							'role_id' => $_SESSION['current_role'],
							'state_id' => $location_value['state'],
							'district_id' => implode(',', $location_value['district']),
							'created_at' => date('Y-m-d H:i:s')
						);
						$this->db->insert('business_operation', $insertData);
					}
				}
			}
			/*stepperTransferd $this->db->where('id', $userid);
			$this->db->update('users', array('step' => 3));*/

			$this->db->where('id', $user_profiles->id);
			$this->db->update('user_profile', array('step' => 3));

			redirect("register/ImprRegForm3");
		}
	}
	public function ImprRegForm3()
	{
		if (in_array( $impid =1 , $this->assoc_roles_in_array))
		{
			redirect("dashboard/kycdashboard");
		}
		$userid 		= $_SESSION['UserId'];
		$UserDetails 	= $this->UserModel->GetUserById($_SESSION['UserId']);
		$account_id 	= $this->NgoModel->GetUserProfileAccountId($userid);
		$profile_id 	= $this->NgoModel->GetUserProfileAccountId($userid);
		$bank_query 	= "SELECT * FROM `bank_details` WHERE `profile_id` = " . $profile_id . "";
		$bank_data 		= $this->db->query($bank_query)->row();
		if ($profile_id) {
			$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle();
		} else {
			$data['usersprofile'] = array();
		}
		$incop_document 			= $this->NgoModel->getUserDocuments($profile_id, 'CIN');
		$trust_document 			= $this->NgoModel->getUserDocuments($profile_id, 'TRUSTDEED');
		$eighty_g_document 			= $this->NgoModel->getUserDocuments($profile_id, '80G_REGISTRATION');
		$twelve_a_document 			= $this->NgoModel->getUserDocuments($profile_id, '12A_REGISTRATION');
		$pan_document 				= $this->NgoModel->getUserDocuments($profile_id, 'PAN');
		$data['pan_document'] 		= $pan_document;
		$data['incop_document'] 	= $incop_document;
		$data['trust_document'] 	= $trust_document;
		$data['eighty_g_document'] 	= $eighty_g_document;
		$data['twelve_a_document']  = $twelve_a_document;



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




		$this->load->view("register/imp-reg-form3", $data);
	}
	public function saveImpStep3()
	{
		$userid = $_SESSION['UserId'];
		
		if (empty($userid)) {
			redirect('/');
		}
		
		$profile_id = $this->NgoModel->GetUserProfileAccountId($userid);
		if ($_POST['cinNumber']) {
			$file_name = $_FILES['incop_doc']['name'];
			$incop_doc_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$incop_doc_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_CIN_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('incop_doc')) {
					$uploadData = $this->upload->data();
					$incop_doc_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$incop_doc_file = $_POST['cinNumber']['old_doc'];
			}
			$save_data = [
				'profile_id' => $profile_id,
				'document_name' => 'CIN',
				'document_number' => $_POST['cinNumber']['cin_no'],
				'date_of_approval' => $_POST['cinNumber']['issue_date'],
				'document_file_path' => $incop_doc_file,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['cin_id']) {
				$this->NgoModel->updateUploadedDocuments($_POST['cin_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
		if ($_POST['trust_deed']) {
			$file_name = $_FILES['trust_deed_doc']['name'];
			$trustere_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$trustere_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_TRUSTEE_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('trust_deed_doc')) {
					$uploadData = $this->upload->data();
					$trustere_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$trustere_file = $_POST['trust_deed']['old_doc'];
			}
			$save_data = [
				'date_of_approval' => $_POST['trust_deed']['trust_doc_date'],
				'document_file_path' => $trustere_file,
				'document_name' => 'TRUSTDEED',
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['trust_deed_id']) {
				$this->NgoModel->updateUploadedDocuments($_POST['trust_deed_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}

		if ($_POST['pan']) {
			$file_name = $_FILES['pan_file']['name'];
			$pan_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$pan_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_PAN_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('pan_file')) {
					$uploadData = $this->upload->data();
					$trustere_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$pan_file = $_POST['pan']['old_pan_file'];
			}
			$save_data = [
				'document_number' => $_POST['pan']['pan_number'],
				'document_file_path' => $pan_file,
				'document_name' => 'PAN',
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['pan_id']) {
				$this->NgoModel->updateUploadedDocuments($_POST['pan_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
		if(isset($_POST['isregistration_expire']) && isset($_POST['twelve_a_document_id']) && $_POST['isregistration_expire'] == 'NO'){
			$this->CommonModel->delete('documents',array('id'=>$_POST['twelve_a_document_id']));
		}else{
			if ($_POST['twelve_a_document']) {
				$file_name = $_FILES['reg_12a_file']['name'];
				$reg_12a_file = '';
				if ($file_name) {
					$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
					$reg_12a_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
					$config['upload_path'] = NGO_12A_PATH;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('reg_12a_file')) {
						$uploadData = $this->upload->data();
						$reg_12a_file = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				} else {
					$reg_12a_file = $_POST['twelve_a_document']['old_pan_file'];
				}
				$save_data = [
					'document_number' => $_POST['twelve_a_document']['document_number'],
					'document_file_path' => $reg_12a_file,
					'FY_start_date' => $_POST['twelve_a_document']['FY_start_date'],
					'FY_end_date' => $_POST['twelve_a_document']['FY_end_date'],
					'document_name' => '12A_REGISTRATION',
					'profile_id' => $profile_id,
					'created_at' => date('Y-m-d')
				];
				if ($_POST['twelve_a_document_id'] != '') {
					$this->NgoModel->updateUploadedDocuments($_POST['twelve_a_document_id'], $save_data);
				} else {
					$this->NgoModel->uploadDocuments($save_data);
				}
			}
	}
	if(isset($_POST['is_eight_registration_expire']) && isset($_POST['eighty_g_document_id']) && $_POST['is_eight_registration_expire'] == 'NO'){
		$this->CommonModel->delete('documents',array('id'=>$_POST['eighty_g_document_id']));
	}else{
		if ($_POST['eighty_g_document']) {
			$file_name = $_FILES['eighty_g_file']['name'];
			$eighty_g_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$eighty_g_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_80G_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('eighty_g_file')) {
					$uploadData = $this->upload->data();
					$eighty_g_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$eighty_g_file = $_POST['eighty_g_document']['old_file'];
			}
			$save_data = [
				'document_number' => $_POST['eighty_g_document']['document_number'],
				'document_file_path' => $eighty_g_file,
				'FY_start_date' => $_POST['eighty_g_document']['FY_start_date'],
				'FY_end_date' => $_POST['eighty_g_document']['FY_end_date'],
				'date_of_approval' => $_POST['eighty_g_document']['date_of_approval'],
				'document_name' => '80G_REGISTRATION',
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['eighty_g_document_id'] != '') {
				$this->NgoModel->updateUploadedDocuments($_POST['eighty_g_document_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
	}
/* no required
	if(isset($_POST['is_eight_registration_expire']) && isset($_POST['eighty_g_document_id']) && $_POST['is_eight_registration_expire'] == 'NO'){
		$this->CommonModel->delete('documents',array('id'=>$_POST['eighty_g_document_id']));
	}else{
		if ($_POST['ac_document']) {
			$file_name = $_FILES['ac_document_file']['name'];
			$ac_document_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$ac_document_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_35AC_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('ac_document_file')) {
					$uploadData = $this->upload->data();
					$ac_document_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$ac_document_file = $_POST['ac_document']['old_file'];
			}
			$save_data = [
				'document_number' => $_POST['ac_document']['document_number'],
				'document_file_path' => $ac_document_file,
				'calendar_start_date' => $_POST['ac_document']['calendar_start_date'],
				'calendar_end_date' => $_POST['ac_document']['calendar_end_date'],
				'Project_name_as_per_notification' => $_POST['ac_document']['Project_name_as_per_notification'],
				'Project_budget_as_per_notification' => $_POST['ac_document']['Project_budget_as_per_notification'],
				'document_name' => '35AC_REGISTRATION',
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['ac_document_id'] != '') {
				$this->NgoModel->updateUploadedDocuments($_POST['ac_document_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
	}*/

	if(isset($_POST['is_facra_registration_expire']) && isset($_POST['fcra_document_id']) && $_POST['is_facra_registration_expire'] == 'NO'){
		$this->CommonModel->delete('documents',array('id'=>$_POST['fcra_document_id']));
	}else{
		//FCRA_REGISTRATION
		if ($_POST['fcra_document']) {
			$file_name = $_FILES['fcra_file']['name'];
			$fcra_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$fcra_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_FCRA_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('fcra_file')) {
					$uploadData = $this->upload->data();
					$fcra_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$fcra_file = $_POST['fcra_document']['old_file'];
			}
			$save_data = [
				'document_number' => $_POST['fcra_document']['document_number'],
				'document_file_path' => $fcra_file,
				'calendar_start_date' => $_POST['fcra_document']['calendar_start_date'],
				'calendar_end_date' => $_POST['fcra_document']['calendar_end_date'],
				'document_name' => 'FCRA_REGISTRATION',
				'nature_of_association_FCRA'=>$_POST['fcra_document']['association_nature'],
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['fcra_document_id'] != '') {
				$this->NgoModel->updateUploadedDocuments($_POST['fcra_document_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
	}

	if(isset($_POST['is_csr_registration_expire']) && isset($_POST['csr_document_id']) && $_POST['is_csr_registration_expire'] == 'NO'){
		$this->CommonModel->delete('documents',array('id'=>$_POST['csr_document_id']));
	}else{
		if ($_POST['csr_document']) {
			$file_name = $_FILES['csr_file']['name'];
			$csr_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$csr_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_CSR_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('csr_file')) {
					$uploadData = $this->upload->data();
					$csr_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$csr_file = $_POST['csr_document']['old_file'];
			}
			$save_data = [
				'document_number' => $_POST['csr_document']['document_number'],
				'document_file_path' => $csr_file,
				'document_name' => 'CSR_REGISTRATION',
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['csr_document_id'] != '') {
				$this->NgoModel->updateUploadedDocuments($_POST['csr_document_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
	}
		//ngo_darpan_document_id
		if(isset($_POST['is_darpan_registration_expired']) && isset($_POST['ngo_darpan_document_id']) && $_POST['is_darpan_registration_expired'] == 'NO'){
			$this->CommonModel->delete('documents',array('id'=>$_POST['ngo_darpan_document_id']));
		}else{
		if ($_POST['ngo_darpan_document']) {
			$file_name = $_FILES['ngo_darpan_doc']['name'];
			$ngo_darpan_doc = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$ngo_darpan_doc = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_TRUSTEE_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('ngo_darpan_doc')) {
					$uploadData = $this->upload->data();
					$ngo_darpan_doc = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$ngo_darpan_doc = $_POST['ngo_darpan_document']['old_file'];
			}
			$save_data = [
				'document_number' => $_POST['ngo_darpan_document']['document_number'],
				'document_file_path' => $ngo_darpan_doc,
				'document_name' => 'NGO_DARPAN',
				'does_expire' => isset($_POST['ngo_darpan_document']['does_expire'])? 1 : 0,
				'calendar_start_date' => $_POST['ngo_darpan_document']['calendar_start_date'],
				'calendar_end_date' => isset($_POST['ngo_darpan_document']['does_expire'])?'':$_POST['ngo_darpan_document']['calendar_end_date'],
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['ngo_darpan_document_id'] != '') {
				$this->NgoModel->updateUploadedDocuments($_POST['ngo_darpan_document_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
	}

	if(isset($_POST['is_gst_registration_expire']) && isset($_POST['gst_document_id']) && $_POST['is_gst_registration_expire'] == 'NO'){
		$this->CommonModel->delete('documents',array('id'=>$_POST['gst_document_id']));
	}else{
		if ($_POST['gst_document']) {
			$file_name = $_FILES['gst_file']['name'];
			$gst_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$gst_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_GST_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('gst_file')) {
					$uploadData = $this->upload->data();
					$gst_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$gst_file = $_POST['gst_document']['old_file'];
			}
			$save_data = [
				'document_number' => $_POST['gst_document']['document_number'],
				'document_file_path' => $gst_file,
				'document_name' => 'GST',
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if ($_POST['gst_document_id'] != '') {
				$this->NgoModel->updateUploadedDocuments($_POST['gst_document_id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
	}
		$add_cert = $_POST['add_cert'];
		foreach ($add_cert as $key => $value) {
			if($key == 0 && isset($_POST['add_cert_registration_expire']) && isset($value['id']) && $_POST['add_cert_registration_expire'] == 'NO'){
				$this->CommonModel->delete('documents',array('id'=>$value['id']));
				continue;
			}
			if($key == 1 && isset($_POST['add_cert2_registration_expire']) && isset($value['id']) && $_POST['add_cert2_registration_expire'] == 'NO'){
				$this->CommonModel->delete('documents',array('id'=>$value['id']));
				continue;
			}
			if($key == 2 && isset($_POST['add_cert3_registration_expire']) && isset($value['id']) && $_POST['add_cert3_registration_expire'] == 'NO'){
				$this->CommonModel->delete('documents',array('id'=>$value['id']));
				continue;
			}
			$name = 'add_Cert_file' . $key;
			$file_name = $_FILES[$name]['name'];
			$add_file = '';
			if ($file_name) {
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$add_file = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = NGO_TRUSTEE_PATH;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload($name)) {
					$uploadData = $this->upload->data();
					$add_file = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$add_file = $value['old_doc'];
			}

			$save_data = [
				'document_number' => $value['number'],
				'document_name' => $value['document_name'],
				'does_expire' => isset($value['not_expire'])? 1 : 0,
				'calendar_start_date' => $value['issue_date'],
				'calendar_end_date' => isset($value['not_expire'])?'':$value['valid_till'],
				'project_name_as_per_notification' => $value['name'],
				'document_file_path' => $add_file,
				'profile_id' => $profile_id,
				'created_at' => date('Y-m-d')
			];
			if (array_key_exists("id", $value) && $value['id'] != '') {
				$this->NgoModel->updateUploadedDocuments($value['id'], $save_data);
			} else {
				$this->NgoModel->uploadDocuments($save_data);
			}
		}
		/*stepperTransferd $this->db->where('id', $userid);
		$this->db->update('users', array('step' => 4));*/

		$this->db->where('id', $profile_id);
		$this->db->update('user_profile', array('step' => 4));

		if(isset($_GET['myprofile'])){
			redirect("myprofile");
		}
		
		redirect("register/ImprRegForm4");
	}

	public function ImprRegForm4()
	{
		if (in_array( $impid =1 , $this->assoc_roles_in_array))
		{
			redirect("dashboard/kycdashboard");
		}
		$userid = $_SESSION['UserId'];
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$account_id = $this->NgoModel->GetUserProfileAccountId($userid);
		$profile_id = $this->NgoModel->GetUserProfileAccountId($userid);
		$bank_query = "SELECT * FROM `bank_details` WHERE `profile_id` = " . $profile_id . "";
		$bank_data = $this->db->query($bank_query)->row();
		$data['bank_data'] = $bank_data;
		if ($profile_id) {
			$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle();
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

		$this->load->view("register/imp-reg-form4", $data);
	}
	public function saveImpStep4()
	{
		$userid = $_SESSION['UserId'];
		if(empty($userid)){
			redirect("/");
		}
		$sql = "SELECT id FROM `user_profile` WHERE `user_id` = " . $userid . "";
		$user_profiles = $this->db->query($sql)->row();
		$this->db->where('profile_id', $user_profiles->id);
		$this->db->delete('financial_report');
		
		foreach ($_POST['financial_report'] as $key => $financial_report_value) {
			$name = 'financial_report_' . $key;
			$file_name = $_FILES[$name]['name'];
			if($file_name){
				$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
				$financial_report_1 = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
				$config['upload_path'] = FINANCIAL_REPORT_PATH;
				$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload($name)) {
					$uploadData = $this->upload->data();
					$financial_report_1 = $uploadData['file_name'];
				}
			}else{
				$name = "financial_report_old_".$key;
				$financial_report_1 = $_POST[$name];
			}
			$saveData = [
				'profile_id' => $user_profiles->id,
				'financial_year' => $financial_report_value['year'],
				'corpus_funds' => $financial_report_value['corpus_fund'],
				'liabilities' => $financial_report_value['liabilities'],
				'donations_received' => $financial_report_value['donations_recieved'],
				'CSR_fund_received' => $financial_report_value['csr_fund'],
				'other_receipts' => $financial_report_value['other_reciept'],
				'other_expenses' => $financial_report_value['other_expense'],
				'project_expenses' => $financial_report_value['project_expense'],
				'audit_report_path' => $financial_report_1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			];
			$this->db->insert('financial_report', $saveData);
		}
	
		$report_1_file_path = '';
		if ($_FILES['report_1_file_path']['name']) {
			$file_name = $_FILES['report_1_file_path']['name'];
			$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$report_1_file_path = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
			$config['upload_path'] = FINANCIAL_REPORT_PATH;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
			$config['max_size'] = MAX_FILESIZE_BYTE;
			$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('report_1_file_path')) {
				$uploadData = $this->upload->data();
				$report_1_file_path = $uploadData['file_name'];
			} 
			// else {
			// 	echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
			// 	exit;
			// }
		} else {
			$report_1_file_path = $_POST['report_1_file_path_old'];
		}
	
		// die;
		$report_2_file_path = '';
		if ($_FILES['report_2_file_path']['name']) {
			$file_name = $_FILES['report_2_file_path']['name'];
			$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$report_2_file_path = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
			$config['upload_path'] = FINANCIAL_REPORT_PATH;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
			$config['max_size'] = MAX_FILESIZE_BYTE;
			$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('report_2_file_path')) {
				$uploadData = $this->upload->data();
				$report_2_file_path = $uploadData['file_name'];
			} 
			// else {
			// 	echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
			// 	exit;
			// }
		} else {
			$report_2_file_path = $_POST['report_2_file_path_old'];
		}
		$report_3_file_path = '';
		if ($_FILES['report_3_file_path']['name']) {
			$file_name = $_FILES['report_3_file_path']['name'];
			$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$report_3_file_path = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
			$config['upload_path'] = FINANCIAL_REPORT_PATH;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
			$config['max_size'] = MAX_FILESIZE_BYTE;
			$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('report_3_file_path')) {
				$uploadData = $this->upload->data();
				$report_3_file_path = $uploadData['file_name'];
			} 
			// else {
			// 	echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
			// 	exit;
			// }
		} else {
			$report_3_file_path = $_POST['report_3_file_path_old'];
		}


		$file_type_one = $this->input->post('file_type_one');
		$file_type_two = $this->input->post('file_type_two');
		$file_type_three = $this->input->post('file_type_three');

		if($file_type_one == 2){
			$report_1_file_path = $_POST['add_link_one'];
		}

		if($file_type_two == 2){
			$report_2_file_path = $_POST['add_link_two'];
		}

		if($file_type_three == 2){
			$report_3_file_path = $_POST['add_link_three'];
		}

		$userid = $_SESSION['UserId'];
		$sql = "SELECT * FROM `user_profile` WHERE `user_id` = " . $userid . "";
		$user_profiles = $this->db->query($sql)->row();
		if ($_POST['funding_source']) {

			$exp_data = [
				'profile_id'    => $user_profiles->id,
				'sector_id'     => $_POST['funding_source'],
				'FY1_execution' => $_POST['FY1_execution'],
				//'report_1_file_type' => $file_type_one,
				'report_1_file_path' => $report_1_file_path,
				'FY2_execution' => $_POST['FY2_execution'],
				//'report_2_file_type' => $file_type_two,
				'report_2_file_path' => $report_2_file_path,
				'FY3_execution' => $_POST['FY3_execution'],
				//'report_3_file_type' => $file_type_three,
				'report_3_file_path' => $report_3_file_path,
				'created_at' => date('Y-m-d H:i:s')
			];
			if (array_key_exists("row_id", $_POST) && $_POST['row_id'] != '') {
				$this->db->where('id', $_POST['row_id']);
				$this->db->update('implementation_exp', $exp_data);
			} else {
				$this->db->insert('implementation_exp', $exp_data);
			}
		}
		/*stepperTransferd $this->db->where('id', $userid);
		$this->db->update('users', array('step' => 5));*/

		$this->db->where('id',  $user_profiles->id);
		$this->db->update('user_profile', array('step' => 5));

		if(isset($_GET['profile'])){
			redirect("myprofile/editFinancialReport");
		}
	
		redirect("register/ImprRegForm5");
	}
	public function ImprRegForm5()
	{
		if (in_array( $impid =1 , $this->assoc_roles_in_array))
		{
			redirect("dashboard/kycdashboard");
		}
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
		$this->load->view("register/imp-reg-form5", $data);
		// die;
	}
	public function saveImpStep5()
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

		$cheque = '';
		if ($_FILES['cheque']['name']) {
			$file_name = $_FILES['cheque']['name'];
			$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$cheque = $userid . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
			$config['upload_path'] = FINANCIAL_REPORT_PATH;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
			$config['max_size'] = MAX_FILESIZE_BYTE;
			$config['file_name'] = $userid . '-' . strtotime(date('Y-m-d H:i:s'));
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('cheque')) {
				$uploadData = $this->upload->data();
				$cheque = $uploadData['file_name'];
			} 
			// else {
			// 	echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
			// 	exit;
			// }
		}

		$bank_data = [
			'profile_id' => $profile_id,
			'email_id' => $_POST['bank_email_id'],
			'role_id' => $_SESSION['current_role'],
			'bank_name' => $_POST['bank_name'],
			'account_holder_name' => $_POST['account_holder_name'],
			'account_no' => $_POST['acc_number'],
			'ifsc_code' => $_POST['ifsc_code'],
			'cancelled_cheque_image' => $cheque,
			'is_emandate_enabled' => 1,
			'branch_name' => $_POST['branch_name'],
			'created_at' => date('Y-m-d H:i:s')
		];
		if ($_POST['bank_profile_id']) {
			$this->db->where('profile_id', $profile_id);
			$this->db->update('bank_details', $bank_data);
		} else {
			$this->db->insert('bank_details', $bank_data);
		}
		//Update kYC
		$current_active_role     = $_SESSION['current_role'];
		//Update Assocciated

		$users = $this->UserModel->get_users($userid);
		$all_roles_allocated =$users->all_roles_allocated;

		if (strpos($all_roles_allocated, $current_active_role) === false ){
			$all_roles_allocated =  $all_roles_allocated.', '.$current_active_role;
		}
		//Update kYC
			$saveData = 
			[
				'kyc_status'=>4,
				'all_roles_allocated' => $all_roles_allocated
			];
			$this->db->where('user_id', $_SESSION['UserId']);
			$this->db->update('user_profile', $saveData);
		//Update kYC
		/*$current_active_role     = $_SESSION['current_role'];
		//Update Assocciated

		$users = $this->UserModel->get_users($userid);
		$all_roles_allocated =$users->all_roles_allocated;

		if (strpos($all_roles_allocated, $current_active_role) === false ){
			$all_roles_allocated =  $all_roles_allocated.', '.$current_active_role;
		}

		$user_role =[
			'all_roles_allocated' => $all_roles_allocated
		];
		$this->db->where('id',$userid);
		$this->db->update('users', $user_role);*/

		$this->roleAllocation($userid,$current_active_role);

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
		if(isset($user->GUID) && $consent){
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

		/*stepperTransferd $this->db->where('id', $userid);
		$this->db->update('users', array('step' => NULL));*/

		$this->db->where('id',  $profile_id);
		$this->db->update('user_profile', array('step' => NULL));

		$this->srmAllocation($profile_id);

		if(isset($_GET['profile'])){
			redirect(current_url());
		}

		redirect('/dashboard/kycdashboard');
	}
	public function ngoPostForm1()
	{

		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}

		if (isset($_POST) && $_POST != '') {

			$filename_add_proof_db = '';

			$data = array();
			$orgSector_arr = array();
			$orgSector = '';

			$allowed = array('jpg', 'jpeg', 'png');
			$allowed1 = array('jpg', 'jpeg', 'png', 'pdf');
			$filename = $_FILES['orgLogo']['name'];
			$filesize_logo = $_FILES['orgLogo']['size'];

			$filename_add_proof = $_FILES['orgAddProof']['name'];
			$filesize_add_proof = $_FILES['orgAddProof']['size'];

			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$ext_add_proof = strtolower(pathinfo($filename_add_proof, PATHINFO_EXTENSION));

			$orgSector_arr = isset($_POST['orgSector']) ? $_POST['orgSector'] : array();


			// $date1 = "2012-09-12";date validation format
			// if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date1)) {
			// return true;
			// } else {
			// return false;
			// }

			// $date="24-07-2018"; date validation format
			// if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$date)) {
			// return true;
			// } else {
			// return false;
			// }
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if (empty($_POST['orgName']) || empty($_POST['orgAddress1']) || empty($_POST['orgAddress2']) || empty($_POST['orgCity']) || empty($_POST['orgDistrict']) || empty($_POST['orgState']) || empty($_POST['orgType']) || empty($_POST['orgLocation']) || empty($_POST['orgDateIncorporation']) || empty($_POST['orgSector'])) {

				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;

			} else if (!empty($_POST['orgDateIncorporation']) && !preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $_POST['orgDateIncorporation'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Date format is incorrect."));
				exit;

			} else if (count($orgSector_arr) <= 0) {
				echo json_encode(array('flag' => 0, 'msg' => "Please select at least one sector."));
				exit;

			} else if (!preg_match('/^[1-9][0-9]{5}$/', $_POST['orgPincode']) || empty($_POST['orgPincode'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter valid pincode."));
				exit;

			} else if (!empty($filename) && !in_array($ext, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;

			} else if (!empty($filename) && $filesize_logo > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename."));
				exit;
			} else if (!empty($filename_add_proof) && !in_array($ext_add_proof, $allowed1)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;

			} else if (!empty($filename_add_proof) && $filesize_add_proof > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_add_proof."));
				exit;
			} else {

				$UserCompanyDetails = $this->NgoModel->GetUserNgoInfo($_POST['ngo_userid_frm1']);
				if (isset($UserCompanyDetails) && $UserCompanyDetails->id != '') {
					echo json_encode(array('flag' => 0, 'msg' => "User already registered with ngo."));
					exit;
				}

				if (isset($_FILES['orgLogo']['name']) && !empty($_FILES['orgLogo']['name'])) {

					$file_name = $_FILES['orgLogo']['name'];
					$filename = $_POST['ngo_userid_frm1'] . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
					$config['upload_path'] = NGO_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $_POST['ngo_userid_frm1'] . '-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('orgLogo')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if (isset($_FILES['orgAddProof']['name']) && !empty($_FILES['orgAddProof']['name'])) {

					$file_name = $_FILES['orgAddProof']['name'];
					$filename_add_proof_db = $_POST['ngo_userid_frm1'] . '-' . 'ADD-PROOF' . '.' . $ext;
					$config['upload_path'] = NGO_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $_POST['ngo_userid_frm1'] . '-' . 'ADD-PROOF';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('orgAddProof')) {
						$uploadData = $this->upload->data();
						$filename_add_proof_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if (isset($_POST['orgSector'])) {
					$orgSector = implode(',', $orgSector_arr);
					$orgSector = ',' . $orgSector . ',';
				}

				$insert_ngo_details = array(
					'user_id' => $_POST['ngo_userid_frm1'],
					'org_logo' => $filename,
					'org_name' => $_POST['orgName'],
					'org_address_line1' => $_POST['orgAddress1'],
					'org_address_line2' => $_POST['orgAddress2'],
					'website' => $_POST['orgWebsite'],
					'address_proof' => $filename_add_proof_db,
					'city' => $_POST['orgCity'],
					'district' => $_POST['orgDistrict'],
					'pincode' => $_POST['orgPincode'],
					'state' => $_POST['orgState'],
					'about_org' => $_POST['orgAbout'],
					'org_type' => $_POST['orgType'],
					'org_location_operation' => $_POST['orgLocation'],
					'date_incorporation' => strtotime($_POST['orgDateIncorporation']),
					'sector_operation' => $orgSector,
					'created_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->insert('ngo_details', $insert_ngo_details);
				$lastInsertId = $this->db->insert_id();

				$updatedata = array(
					/*stepperTransferd 'step' => 2,*/
					'status' => 3,
					'type' => 1,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id', $_POST['ngo_userid_frm1']);
				$this->db->update('users', $updatedata);
				
				/*$updatedata1 = array(
					'role_id' => 1,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id', $_POST['ngo_userid_frm1']);
				$this->db->update('user_role_lnk', $updatedata1);*/

				echo json_encode(array('flag' => 1, 'msg' => "", 'currentInsertId' => $lastInsertId));
				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function ngoPostForm2()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		$id = $_SESSION['UserId'];
		$filename_gst_db = '';
		$filename_fcra_db = '';
		$filename_35ac_db = '';


		if (isset($_POST) && $_POST != '' && isset($_FILES) && $_FILES != '') {
			$allowed = array('jpg', 'jpeg', 'pdf', 'png');
			$filename_cin = $_FILES['org_cin_file']['name'];
			$filesize_cin = $_FILES['org_cin_file']['size'];

			$filename_gst = $_FILES['org_gst_file']['name'];
			$filesize_gst = $_FILES['org_gst_file']['size'];

			$filename_pan = $_FILES['org_pan_file']['name'];
			$filesize_pan = $_FILES['org_pan_file']['size'];

			$filename_80g = $_FILES['org_80g_file']['name'];
			$filesize_80g = $_FILES['org_80g_file']['size'];

			$filename_fcra = $_FILES['org_fcra_file']['name'];
			$filesize_fcra = $_FILES['org_fcra_file']['size'];

			$filename_35ac = $_FILES['org_35ac_file']['name'];
			$filesize_35ac = $_FILES['org_35ac_file']['size'];

			$filename_12a = $_FILES['org_12a_file']['name'];
			$filesize_12a = $_FILES['org_12a_file']['size'];

			$filename_trustee = $_FILES['org_trustee_file']['name'];
			$filesize_trustee = $_FILES['org_trustee_file']['size'];

			$filename_stamp = $_FILES['officialseal_file']['name'];
			$filesize_stamp = $_FILES['officialseal_file']['size'];

			$filename_sign = $_FILES['signature_file']['name'];
			$filesize_sign = $_FILES['signature_file']['size'];

			$filename_csr = $_FILES['csr_file']['name'];
			$filesize_csr = $_FILES['csr_file']['size'];

			$ext_cin = strtolower(pathinfo($filename_cin, PATHINFO_EXTENSION));
			$ext_gst = strtolower(pathinfo($filename_gst, PATHINFO_EXTENSION));
			$ext_pan = strtolower(pathinfo($filename_pan, PATHINFO_EXTENSION));
			$ext_80g = strtolower(pathinfo($filename_80g, PATHINFO_EXTENSION));
			$ext_fcra = strtolower(pathinfo($filename_fcra, PATHINFO_EXTENSION));
			$ext_35ac = strtolower(pathinfo($filename_35ac, PATHINFO_EXTENSION));
			$ext_12a = strtolower(pathinfo($filename_12a, PATHINFO_EXTENSION));
			$ext_trustee = strtolower(pathinfo($filename_trustee, PATHINFO_EXTENSION));
			$ext_stamp = strtolower(pathinfo($filename_stamp, PATHINFO_EXTENSION));
			$ext_sign = strtolower(pathinfo($filename_sign, PATHINFO_EXTENSION));
			$ext_csr = strtolower(pathinfo($filename_csr, PATHINFO_EXTENSION));

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			$filesizess = MAX_KB_FILESIZE_BYTE;
			$sizess = MAX_KB_FILESIZE_MB;

			// if(empty($_POST['org_cin_number']) || empty($_FILES['org_cin_file']['name']) ||	empty($_POST['org_pan_number']) || empty($_FILES['org_pan_file']['name']) || empty($_POST['org_12a_number']) || empty($_FILES['org_12a_file']['name']) || empty($_FILES['org_trustee_file']['name']) || empty($_FILES['officialseal_file']['name']) || empty($_FILES['signature_file']['name'])) {
			if (empty($_POST['org_cin_number']) || empty($_FILES['org_cin_file']['name']) || empty($_POST['org_pan_number']) || empty($_FILES['org_pan_file']['name']) || empty($_POST['org_12a_number']) || empty($_FILES['org_12a_file']['name']) || empty($_FILES['org_trustee_file']['name'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			} else if (!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_cin."));
				exit;
			} else if (!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_gst."));
				exit;
			} else if (!empty($filename_pan) && !in_array($ext_pan, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_pan) && $filesize_pan > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_pan."));
				exit;
			} else if (!empty($filename_80g) && !in_array($ext_80g, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_80g) && $filesize_80g > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_80g."));
				exit;
			} else if (!empty($filename_fcra) && !in_array($ext_fcra, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_fcra) && $filesize_fcra > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_fcra."));
				exit;
			} else if (!empty($filename_35ac) && !in_array($ext_35ac, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_35ac) && $filesize_35ac > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_35ac."));
				exit;
			} else if (!empty($filename_12a) && !in_array($ext_12a, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
				// } else if( !preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['org_cin_number'])){
				// echo json_encode(array('flag'=>0, 'msg'=>"Invalid CIN Number"));
				// exit;

			} else if (!empty($filename_12a) && $filesize_12a > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_12a."));
				exit;
			} else if (!empty($filename_trustee) && !in_array($ext_trustee, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_trustee) && $filesize_trustee > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_trustee."));
				exit;
			} else if (!preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['org_pan_number'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid PAN Number"));
				exit;
			} else if (!empty($filename_stamp) && !in_array($ext_stamp, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type"));
				exit;
			} else if (!empty($filename_stamp) && $filesize_stamp > $filesizess) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $sizess for $filename_stamp."));
				exit;
			} else if (!empty($filename_sign) && !in_array($ext_sign, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type"));
				exit;
			} else if (!empty($filename_sign) && $filesize_sign > $filesizess) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $sizess for $filename_sign."));
				exit;
			} else if (!empty($filename_csr) && !in_array($ext_csr, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_csr) && $filesize_csr > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_csr."));
				exit;
			}
			// else if( !preg_match("/^[A-Za-z0-9]+$/", $_POST['csr_number'])){
			// 	echo json_encode(array('flag'=>0, 'msg'=>"Invalid CSR Number"));
			// 	exit;
			// }
			// else condition commented 
			else if (!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['org_gst_number']) && !empty($_POST['org_gst_number'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid GST Number"));
				exit;

			} else {
				$filename_cin_db = '';
				if (isset($_FILES['org_cin_file']['name']) && !empty($_FILES['org_cin_file']['name'])) {
					$filename_cin_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CIN.' . $ext_cin;
					$config['upload_path'] = NGO_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CIN';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_cin_file')) {
						$uploadData = $this->upload->data();
						$filename_cin_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_gst_db = '';
				if (isset($_FILES['org_gst_file']['name']) && !empty($_FILES['org_gst_file']['name'])) {
					$filename_gst_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-GST.' . $ext_gst;
					$config['upload_path'] = NGO_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-GST';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_gst_file')) {
						$uploadData = $this->upload->data();
						$filename_gst_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_pan_db = '';
				if (isset($_FILES['org_pan_file']['name']) && !empty($_FILES['org_pan_file']['name'])) {
					$filename_pan_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-PAN.' . $ext_pan;
					$config['upload_path'] = NGO_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-PAN';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('org_pan_file')) {
						$uploadData = $this->upload->data();
						$filename_pan_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_80g_db = '';
				if (isset($_FILES['org_80g_file']['name']) && !empty($_FILES['org_80g_file']['name'])) {
					$filename_80g_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-80G.' . $ext_80g;
					$config['upload_path'] = NGO_80G_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-80G';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_80g_file')) {
						$uploadData = $this->upload->data();
						$filename_80g_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_fcra_db = '';
				if (isset($_FILES['org_fcra_file']['name']) && !empty($_FILES['org_fcra_file']['name'])) {
					$filename_fcra_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-FCRA.' . $ext_fcra;
					$config['upload_path'] = NGO_FCRA_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-FCRA';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_fcra_file')) {
						$uploadData = $this->upload->data();
						$filename_fcra_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_35ac_db = '';
				if (isset($_FILES['org_35ac_file']['name']) && !empty($_FILES['org_35ac_file']['name'])) {
					$filename_35ac_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-35AC.' . $ext_35ac;
					$config['upload_path'] = NGO_35AC_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-35AC';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_35ac_file')) {
						$uploadData = $this->upload->data();
						$filename_35ac_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_12a_db = '';
				if (isset($_FILES['org_12a_file']['name']) && !empty($_FILES['org_12a_file']['name'])) {
					$filename_12a_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-12A.' . $ext_12a;
					$config['upload_path'] = NGO_12A_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-12A';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_12a_file')) {
						$uploadData = $this->upload->data();
						$filename_12a_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_trustee_db = '';
				if (isset($_FILES['org_trustee_file']['name']) && !empty($_FILES['org_trustee_file']['name'])) {
					$filename_trustee_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-TRUSTEE.' . $ext_12a;
					$config['upload_path'] = NGO_TRUSTEE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-TRUSTEE';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_trustee_file')) {
						$uploadData = $this->upload->data();
						$filename_trustee_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_csr_db = '';
				if (isset($_FILES['csr_file']['name']) && !empty($_FILES['csr_file']['name'])) {
					$filename_csr_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CSR.' . $ext_csr;
					$config['upload_path'] = NGO_CSR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CSR';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('csr_file')) {
						$uploadData = $this->upload->data();
						$filename_csr_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_stamp_db = '';
				if (isset($_FILES['officialseal_file']['name']) && !empty($_FILES['officialseal_file']['name'])) {
					$filename_stamp_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-STAMP.' . $ext_stamp;
					$config['upload_path'] = NGO_STAMP_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-STAMP';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('officialseal_file')) {
						$uploadData = $this->upload->data();
						$filename_stamp_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_sign_db = '';
				if (isset($_FILES['signature_file']['name']) && !empty($_FILES['signature_file']['name'])) {
					$filename_sign_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-SIGNATURE.' . $ext_sign;
					$config['upload_path'] = NGO_SIGNATURE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-SIGNATURE';
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('signature_file')) {
						$uploadData = $this->upload->data();
						$filename_sign_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}


				$update_ngo_documents_details = array(
					'cin_no' => base64_encode($_POST['org_cin_number']),
					'cin_file' => $filename_cin_db,
					'gst_no' => base64_encode($_POST['org_gst_number']),
					'gst_file' => $filename_gst_db,
					'pan_no' => base64_encode($_POST['org_pan_number']),
					'pan_file' => $filename_pan_db,
					'org_80g_no' => base64_encode($_POST['org_80g_number']),
					'org_80g_file' => $filename_80g_db,
					'org_80g_start_date' => $_POST['org_80g_start_date'],
					'org_80g_end_date' => $_POST['org_80g_end_date'],
					'fcra_no' => base64_encode($_POST['org_fcra_number']),
					'fcra_file' => $filename_fcra_db,
					'org_fcra_start_date' => $_POST['org_fcra_start_date'],
					'org_fcra_end_date' => $_POST['org_fcra_end_date'],
					'org_35ac_no' => base64_encode($_POST['org_35ac_number']),
					'org_35ac_file' => $filename_35ac_db,
					'org_35ac_start_date' => $_POST['org_35ac_start_date'],
					'org_35ac_end_date' => $_POST['org_35ac_end_date'],
					'org_12a_no' => base64_encode($_POST['org_12a_number']),
					'org_12a_file' => $filename_12a_db,
					'org_12a_start_date' => $_POST['org_12a_start_date'],
					'org_12a_end_date' => $_POST['org_12a_end_date'],
					'org_trustee_no' => base64_encode($_POST['org_trustee_number']),
					'org_trustee_file' => $filename_trustee_db,
					'officialseal_file' => $filename_stamp_db,
					'signature_file' => $filename_sign_db,
					'csr_num' => base64_encode($_POST['csr_number']),
					'csr_file' => $filename_csr_db,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id', $id);

				$this->db->update('ngo_details', $update_ngo_documents_details);
				echo json_encode(array('flag' => 1, 'msg' => ""));

				/*stepperTransferd $this->db->where('id', $id);
				$this->db->update('users', array('step' => 3));*/
				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function ngoPostForm3()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		$id = $_SESSION['UserId'];

		$filename_year2_db = '';
		$filename_year3_db = '';
		$filename_year4_db = '';
		$filename_year5_db = '';
		$filename_year6_db = '';
		$primarySourceType_arr = array();
		$primarySourceType = '';

		if (isset($_POST) && $_POST != '' && isset($_FILES) && $_FILES != '') {
			$primarySourceType_arr = isset($_POST['primarySourceType']) ? $_POST['primarySourceType'] : array();

			$allowed = array('jpg', 'jpeg', 'pdf', 'png');
			$filename_year1 = $_FILES['org_year_1_file']['name'];
			$filesize_year1 = $_FILES['org_year_1_file']['size'];

			$filename_year2 = $_FILES['org_year_2_file']['name'];
			$filesize_year2 = $_FILES['org_year_2_file']['size'];

			$filename_year3 = $_FILES['org_year_3_file']['name'];
			$filesize_year3 = $_FILES['org_year_3_file']['size'];

			$filename_year4 = $_FILES['org_year_4_file']['name'];
			$filesize_year4 = $_FILES['org_year_4_file']['size'];

			$filename_year5 = $_FILES['org_year_5_file']['name'];
			$filesize_year5 = $_FILES['org_year_5_file']['size'];

			$filename_year6 = $_FILES['org_year_6_file']['name'];
			$filesize_year6 = $_FILES['org_year_6_file']['size'];

			$ext_year1 = strtolower(pathinfo($filename_year1, PATHINFO_EXTENSION));
			$ext_year2 = strtolower(pathinfo($filename_year2, PATHINFO_EXTENSION));
			$ext_year3 = strtolower(pathinfo($filename_year3, PATHINFO_EXTENSION));
			$ext_year4 = strtolower(pathinfo($filename_year4, PATHINFO_EXTENSION));
			$ext_year5 = strtolower(pathinfo($filename_year5, PATHINFO_EXTENSION));
			$ext_year6 = strtolower(pathinfo($filename_year6, PATHINFO_EXTENSION));

			$ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
			$date_incorporation = date('Y-m-d', $ngoDetails->date_incorporation);
			$today = date('Y-m-d');

			$d1 = new DateTime($date_incorporation);
			$d2 = new DateTime($today);

			//echo ($d1->diff($d2)->m); // int(4)
			$monthDiff = ($d1->diff($d2)->m + ($d1->diff($d2)->y * 12));

			/*if((empty($_POST['primarySourceType']) || empty($_POST['year1_net_worth']) || empty($_POST['year1_turnover']) || empty($_POST['year1_net_profit']) || empty($_FILES['org_year_1_file']['name'] )) && $monthDiff > 18)
			{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
			exit;
			}else if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {*/

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			if (empty($primarySourceType_arr)) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter Primary Source Type."));
				exit;
			} else if (!empty($filename_year1) && !in_array($ext_year1, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year1) && $filesize_year1 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year1."));
				exit;
			} else if (!empty($filename_year2) && !in_array($ext_year2, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year2) && $filesize_year2 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year2."));
				exit;
			} else if (!empty($filename_year3) && !in_array($ext_year3, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year3) && $filesize_year3 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year3."));
				exit;
			} else if (!empty($filename_year4) && !in_array($ext_year4, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year4) && $filesize_year4 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year4."));
				exit;
			} else if (!empty($filename_year5) && !in_array($ext_year5, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year5) && $filesize_year5 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year5."));
				exit;
			} else if (!empty($filename_year6) && !in_array($ext_year6, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year6) && $filesize_year6 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year6."));
				exit;
			} else {
				if ((!empty($_FILES['org_year_1_file']['name'])) || (empty($_POST['year1_net_worth']) && empty($_POST['year1_turnover']) && empty($_POST['year1_net_profit']) && empty($_FILES['org_year_1_file']['name']))) {

				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for First Year."));
					exit;
				}

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

				$filename_year1_db = '';
				if (isset($_FILES['org_year_1_file']['name']) && !empty($_FILES['org_year_1_file']['name'])) {
					$filename_year1_db = $id . '-year1-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year1;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year1-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_1_file')) {
						$uploadData = $this->upload->data();
						$filename_year1_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_year2_db = '';
				if (isset($_FILES['org_year_2_file']['name']) && !empty($_FILES['org_year_2_file']['name'])) {
					$filename_year2_db = $id . '-year2-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year2;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year2-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_2_file')) {
						$uploadData = $this->upload->data();
						$filename_year2_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_year3_db = '';
				if (isset($_FILES['org_year_3_file']['name']) && !empty($_FILES['org_year_3_file']['name'])) {
					$filename_year3_db = $id . '-year3-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year3;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year3-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_3_file')) {
						$uploadData = $this->upload->data();
						$filename_year3_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_year4_db = '';
				if (isset($_FILES['org_year_4_file']['name']) && !empty($_FILES['org_year_4_file']['name'])) {
					$filename_year4_db = $id . '-year4-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year4;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year4-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_4_file')) {
						$uploadData = $this->upload->data();
						$filename_year4_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_year5_db = '';
				if (isset($_FILES['org_year_5_file']['name']) && !empty($_FILES['org_year_5_file']['name'])) {
					$filename_year5_db = $id . '-year5-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year5;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year5-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_5_file')) {
						$uploadData = $this->upload->data();
						$filename_year5_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_year6_db = '';
				if (isset($_FILES['org_year_6_file']['name']) && !empty($_FILES['org_year_6_file']['name'])) {
					$filename_year6_db = $id . '-year6-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year6;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year6-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_6_file')) {
						$uploadData = $this->upload->data();
						$filename_year6_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if (isset($_POST['primarySourceType'])) {
					$primarySourceType = implode(',', $primarySourceType_arr);
					$primarySourceType = ',' . $primarySourceType . ',';
				}

				if (date('m') >= 4) {
					$Y = date('Y') - 1;
				} else {
					$Y = date('Y') - 2;
				}

				$SY = $Y . "-04-01";
				$pt = $Y + 1;
				$EY = $pt . "-03-31";

				$update_ngo_Financial_details = array(
					'primary_source_type' => $primarySourceType,
					'year1' => date('Y', strtotime($SY)),
					'year1_file' => $filename_year1_db,
					'year1_net_worth' => $year1_net_worth,
					'year1_turnover' => $year1_turnover,
					'year1_net_profit' => $year1_net_profit,
					'year2' => date('Y', strtotime($SY)) - 1,
					'year2_file' => $filename_year2_db,
					'year2_net_worth' => $year2_net_worth,
					'year2_turnover' => $year2_turnover,
					'year2_net_profit' => $year2_net_profit,
					'year3' => date('Y', strtotime($SY)) - 2,
					'year3_file' => $filename_year3_db,
					'year3_net_worth' => $year3_net_worth,
					'year3_turnover' => $year3_turnover,
					'year3_net_profit' => $year3_net_profit,
					'year4' => date('Y', strtotime($SY)) - 3,
					'year4_file' => $filename_year4_db,
					'year4_net_worth' => $year4_net_worth,
					'year4_turnover' => $year4_turnover,
					'year4_net_profit' => $year4_net_profit,
					'year5' => date('Y', strtotime($SY)) - 4,
					'year5_file' => $filename_year5_db,
					'year5_net_worth' => $year5_net_worth,
					'year5_turnover' => $year5_turnover,
					'year5_net_profit' => $year5_net_profit,
					'year6' => date('Y', strtotime($SY)) - 5,
					'year6_file' => $filename_year6_db,
					'year6_net_worth' => $year6_net_worth,
					'year6_turnover' => $year6_turnover,
					'year6_net_profit' => $year6_net_profit,
					'created_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id', $id);
				$this->db->update('ngo_details', $update_ngo_Financial_details);

				echo json_encode(array('flag' => 1, 'msg' => ""));

				/*stepperTransferd $this->db->where('id', $id);
				$this->db->update('users', array('step' => 4));*/

				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function ngoPostForm4()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if (isset($_POST) && $_POST != '') {

			$fullName = isset($_POST['fullName']) ? $_POST['fullName'] : array();
			$fullName_arr = array_values(array_filter($fullName));

			$email = isset($_POST['email']) ? $_POST['email'] : array();
			$email_arr = array_values(array_filter($email));

			$contactNo = isset($_POST['contactNo']) ? $_POST['contactNo'] : array();
			$contactNo_arr = array_values(array_filter($contactNo));

			$designation = isset($_POST['designation']) ? $_POST['designation'] : array();
			$designation_arr = array_values(array_filter($designation));

			$role = isset($_POST['role']) ? $_POST['role'] : array();
			$role_arr = array_values(array_filter($role));

			$status = isset($_POST['status']) ? $_POST['status'] : array();
			$status_arr = array_values(array_filter($status));

			$HashPassword = isset($_POST['password']) ? $_POST['password'] : array();
			// $HashPassword = password_hash($password, PASSWORD_DEFAULT);
			// $HashPassword_arr=array_values(array_filter($HashPassword));

			$hiddenPhotograph = isset($_POST['hiddenPhotograph']) ? $_POST['hiddenPhotograph'] : array();
			//echo array_sum($milestoneBudget);exit;

			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if (empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])) {
				//if(empty($_POST['fullName'])){
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;

			} else if (count(array_filter($fullName)) != count($fullName) || count(array_filter($email)) != count($email) || count(array_filter($contactNo)) != count($contactNo)) {
				//else if(count(array_filter($fullName)) != count($fullName)){
				echo json_encode(array('flag' => 0, 'msg' => "Full name or Email or Contact No. is empty."));
				exit;
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;

			} else {
				$ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
				$boardMembersData = $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);

				if ($_FILES['photograph']['name'] != '') {

					$files = $_FILES['photograph'];

					for ($count = 0; $count < count($_FILES["photograph"]["name"]); $count++) {
						if ($files['name'][$count] != '' && $files['error'][$count] == 0) {

							$_FILES['file']['name'] = $file_name = $files['name'][$count];
							$_FILES['file']['type'] = $files['type'][$count];
							$_FILES['file']['tmp_name'] = $files['tmp_name'][$count];
							$_FILES['file']['error'] = $files['error'][$count];
							$_FILES['file']['size'] = $files['size'][$count];

							if ($_FILES["file"]["size"] > $filesize) {
								echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for " . $_FILES["file"]["name"]));
								exit;
							}

							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $ngoDetails->id . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
							$config['upload_path'] = NGO_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;

							$config['file_name'] = $ngoDetails->id . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('file')) {
								$uploadData = $this->upload->data();
								//print_r($uploadData);

								$fullNameVal = $fullName_arr[$count];
								$emailVal = $email[$count];
								$contactNoVal = $contactNo[$count];
								$roleVal = $role[$count];
								$designationVal = $designation[$count];
								$statusVal = $status[$count];
								$HashPasswordVal = $HashPassword[$count];


								$insertData = array(
									'ngo_id' => $ngoDetails->id,
									'full_name' => $fullNameVal,
									'email' => $emailVal,
									'phone_no' => $contactNoVal,
									'photograph' => $uploadData['file_name'],
									'created_at' => strtotime(date('Y-m-d H:i:s')),
									'password' => $HashPasswordVal,
									'designation' => $designationVal,
									'role' => $roleVal,
									'status' => $statusVal,
								);

								$this->db->insert('ngo_board_members', $insertData);
							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						} else {
							$fullNameVal = $fullName_arr[$count];
							$emailVal = $email[$count];
							$contactNoVal = $contactNo[$count];
							$roleVal = $role[$count];
							$designationVal = $designation[$count];
							$statusVal = $status[$count];
							$HashPasswordVal = $HashPassword[$count];

							$insertData = array(
								'ngo_id' => $ngoDetails->id,
								'full_name' => $fullNameVal,
								'email' => $emailVal,
								'phone_no' => $contactNoVal,
								'created_at' => strtotime(date('Y-m-d H:i:s')),
								'password' => $HashPasswordVal,
								'designation' => $designationVal,
								'role' => $roleVal,
								'status' => $statusVal,
							);

							$this->db->insert('ngo_board_members', $insertData);
						}
					}
				}
				$this->srmAllocation($ngoDetails->id);
				echo json_encode(array('flag' => 1, 'msg' => "NGO Information Added."));
/*stepperTransferd 
				$this->db->where('id', $UserId);
				$this->db->update('users', array('step' => NULL));*/

				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function companyPostForm1()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		if (isset($_POST) && $_POST != '') {
			//echo '<pre>'; print_r($_POST);exit;
			$filename_add_proof_db = '';
			$allowed = array('jpg', 'jpeg', 'png');
			$allowed1 = array('jpg', 'jpeg', 'png', 'pdf');

			$filename = $_FILES['companyLogo']['name'];
			$filesize_logo = $_FILES['companyLogo']['size'];

			$filename_add_proof = $_FILES['companyAddProof']['name'];
			$filesize_add_proof = $_FILES['companyAddProof']['size'];

			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$ext_add_proof = strtolower(pathinfo($filename_add_proof, PATHINFO_EXTENSION));

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			// if(empty($_POST['companyName']) || empty($_POST['companyAddress1']) || empty($_POST['companyCity']) || empty($_POST['companyDistrict']) || empty($_POST['companyState']) || empty($_POST['companyOrgType']) || empty($_POST['companyAbout'])){
			// 	echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			// 	exit;
			// }//code commented by Neerajkumar
			if (empty($_POST['companyName']) || empty($_POST['companyCity']) || empty($_POST['companyDistrict']) || empty($_POST['companyState']) || empty($_POST['companyOrgType']) || empty($_POST['companyAbout'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			} else if (!preg_match('/^[1-9][0-9]{5}$/', $_POST['companyPincode']) || empty($_POST['companyPincode'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter valid pincode."));
				exit;

			} else if (!empty($filename) && !in_array($ext, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;

			} else if (!empty($filename) && $filesize_logo > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename."));
				exit;
			} else if (!empty($filename_add_proof) && !in_array($ext_add_proof, $allowed1)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;

			} else if (!empty($filename_add_proof) && $filesize_add_proof > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_add_proof."));
				exit;
			} else {

				$UserCompanyDetails = $this->CompanyModel->GetUserCompanyInfo($_POST['UserId_form1']);
				if (isset($UserCompanyDetails) && $UserCompanyDetails->id != '') {

					echo json_encode(array('flag' => 0, 'msg' => "User already registered with company."));
					exit;
				}


				if (isset($_FILES['companyLogo']['name']) && !empty($_FILES['companyLogo']['name'])) {

					$file_name = $_FILES['companyLogo']['name'];
					$filename = $_POST['UserId_form1'] . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
					$config['upload_path'] = COMPANY_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $_POST['UserId_form1'] . '-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('companyLogo')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}

				}

				if (isset($_FILES['companyAddProof']['name']) && !empty($_FILES['companyAddProof']['name'])) {

					$file_name = $_FILES['companyAddProof']['name'];
					$filename_add_proof_db = $_POST['UserId_form1'] . '-' . 'ADD-PROOF' . '.' . $ext;
					$config['upload_path'] = COMPANY_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $_POST['UserId_form1'] . '-' . 'ADD-PROOF';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('companyAddProof')) {
						$uploadData = $this->upload->data();
						$filename_add_proof_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$insert_corporate_details = array(
					'user_id' => $_POST['UserId_form1'],
					'company_logo' => $filename,
					'company_name' => $_POST['companyName'],
					'company_address_1' => $_POST['companyAddress1'],
					'company_address_2' => $_POST['companyAddress2'],
					'address_proof' => $filename_add_proof_db,
					'city' => $_POST['companyCity'],
					'district' => $_POST['companyDistrict'],
					'pincode' => $_POST['companyPincode'],
					'state' => $_POST['companyState'],
					'about_company' => $_POST['companyAbout'],
					'company_org_type' => $_POST['companyOrgType'],
					'created_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->insert('corporate_details', $insert_corporate_details);

				$corporateId = $this->db->insert_id();

				$updatedata = array(
					'status' => 3,
					'type' => 2,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id', $_POST['UserId_form1']);
				$this->db->update('users', $updatedata);

				/*$updatedata1 = array(
					'role_id' => 2,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id', $_POST['UserId_form1']);
				$this->db->update('user_role_lnk', $updatedata1);*/

				$this->db->where('id', $UserId);
				$this->db->update('users', array('step' => 2));

				echo json_encode(array('flag' => 1, 'msg' => "", 'currentInsertId' => $corporateId));
				exit;

			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function companyPostForm2()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		$id = $_SESSION['UserId'];
		$filename_gst_db = "";

		if (isset($_POST) && $_POST != '' && isset($_FILES) && $_FILES != '') {

			$allowed = array('jpg', 'jpeg', 'pdf', 'png');
			$filename_cin = $_FILES['cin_certificate_file']['name'];
			$filesize_cin = $_FILES['cin_certificate_file']['size'];

			$filename_gst = $_FILES['gst_certificate_file']['name'];
			$filesize_gst = $_FILES['gst_certificate_file']['size'];

			$filename_pan = $_FILES['pan_card_file']['name'];
			$filesize_pan = $_FILES['pan_card_file']['size'];

			$ext_cin = strtolower(pathinfo($filename_cin, PATHINFO_EXTENSION));
			$ext_gst = strtolower(pathinfo($filename_gst, PATHINFO_EXTENSION));
			$ext_pan = strtolower(pathinfo($filename_pan, PATHINFO_EXTENSION));

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if (empty($_POST['cin_certificate_number']) || empty($_POST['pan_card_number']) || empty($_FILES['cin_certificate_file']['name']) || empty($_FILES['pan_card_file']['name'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			} elseif (!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_cin."));
				exit;
			} elseif (!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_gst."));
				exit;
			} elseif (!empty($filename_pan) && !in_array($ext_pan, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
				// }else if( !preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['cin_certificate_number'])){
				// echo json_encode(array('flag'=>0, 'msg'=>"Invalid CIN Number"));
				// exit;

			} else if (!empty($filename_pan) && $filesize_pan > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_pan."));
				exit;
			} else if (!preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['pan_card_number'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid PAN Number"));
				exit;

			} else if (!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['gst_certificate_number']) && !empty($_POST['gst_certificate_number'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid GST Number"));
				exit;

			} else {

				if (isset($_FILES['cin_certificate_file']['name']) && !empty($_FILES['cin_certificate_file']['name'])) {
					$filename_cin_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CIN.' . $ext_cin;
					$config['upload_path'] = COMPANY_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CIN';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('cin_certificate_file')) {
						$uploadData = $this->upload->data();
						$filename_cin_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$filename_gst_db = '';
				if (isset($_FILES['gst_certificate_file']['name']) && !empty($_FILES['gst_certificate_file']['name'])) {
					$filename_gst_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-GST.' . $ext_gst;
					$config['upload_path'] = COMPANY_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-GST';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('gst_certificate_file')) {
						$uploadData = $this->upload->data();
						$filename_gst_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if (isset($_FILES['pan_card_file']['name']) && !empty($_FILES['pan_card_file']['name'])) {
					$filename_pan_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-PAN.' . $ext_pan;
					$config['upload_path'] = COMPANY_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-PAN';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('pan_card_file')) {
						$uploadData = $this->upload->data();
						$filename_pan_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}


				$update_corporate_details = array(
					'cin_no' => base64_encode($_POST['cin_certificate_number']),
					'cin_file' => $filename_cin_db,
					'gst_no' => base64_encode($_POST['gst_certificate_number']),
					'gst_file' => $filename_gst_db,
					'pan_no' => base64_encode($_POST['pan_card_number']),
					'pan_file' => $filename_pan_db,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id', $_POST['step_2_current_id']);
				$this->db->update('corporate_details', $update_corporate_details);

				$this->db->where('id', $id);
				$this->db->update('users', array('step' => 3));

				echo json_encode(array('flag' => 1, 'msg' => ""));
				exit;

			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function companyPostForm3()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if (isset($_POST) && $_POST != '') {

			$fullName = isset($_POST['fullName']) ? $_POST['fullName'] : array();
			$fullName_arr = array_values(array_filter($fullName));

			$email = isset($_POST['email']) ? $_POST['email'] : array();
			$email_arr = array_values(array_filter($email));

			$contactNo = isset($_POST['contactNo']) ? $_POST['contactNo'] : array();
			$contactNo_arr = array_values(array_filter($contactNo));

			//$hiddenPhotograph=isset($_POST['hiddenPhotograph'])?$_POST['hiddenPhotograph']:array();
			//echo array_sum($milestoneBudget);exit;

			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			//if(empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])){
			if (empty($_POST['fullName'] && $_POST['email'] && $_POST['contactNo'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;

			} else if (count(array_filter($fullName)) != count($fullName)) {
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				echo json_encode(array('flag' => 0, 'msg' => "Full name is empty."));
				exit;

			} else if (count(array_filter($email)) != count($email)) {

				echo json_encode(array('flag' => 0, 'msg' => "email is empty."));
				exit;

			} else if (count(array_filter($contactNo)) != count($contactNo)) {

				echo json_encode(array('flag' => 0, 'msg' => "contact Number is empty."));
				exit;

			} else {
				$companyDetails = $this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				$boardMembersData = $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);

				if ($_FILES['photograph']['name'] != '') {

					$files = $_FILES['photograph'];

					for ($count = 0; $count < count($_FILES["photograph"]["name"]); $count++) {
						if ($files['name'][$count] != '' && $files['error'][$count] == 0) {

							$_FILES['file']['name'] = $file_name = $files['name'][$count];
							$_FILES['file']['type'] = $files['type'][$count];
							$_FILES['file']['tmp_name'] = $files['tmp_name'][$count];
							$_FILES['file']['error'] = $files['error'][$count];
							$_FILES['file']['size'] = $files['size'][$count];

							if ($_FILES["file"]["size"] > $filesize) {
								echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for " . $_FILES["file"]["name"]));
								exit;
							}

							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $companyDetails->id . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
							$config['upload_path'] = COMPANY_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;

							$config['file_name'] = $companyDetails->id . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('file')) {
								$uploadData = $this->upload->data();
								//print_r($uploadData);

								$fullNameVal = $fullName_arr[$count];
								// $emailVal	= $email_arr[$count];
								// $contactNoVal	= $contactNo_arr[$count];
								$emailVal = $email[$count];
								$contactNoVal = $contactNo[$count];

								$insertData = array(
									'corporate_id' => $companyDetails->id,
									'full_name' => $fullNameVal,
									'email' => $emailVal,
									'phone_no' => $contactNoVal,
									'photograph' => $uploadData['file_name'],
									'created_at' => strtotime(date('Y-m-d H:i:s')),
								);

								$this->db->insert('corporate_board_members', $insertData);
							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						} else {
							$fullNameVal = $fullName_arr[$count];
							// $emailVal	= $email_arr[$count];
							// $contactNoVal	= $contactNo_arr[$count];
							$emailVal = $email[$count];
							$contactNoVal = $contactNo[$count];

							$insertData = array(
								'corporate_id' => $companyDetails->id,
								'full_name' => $fullNameVal,
								'email' => $emailVal,
								'phone_no' => $contactNoVal,
								//'photograph'	=> $uploadData['file_name'],
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);

							$this->db->insert('corporate_board_members', $insertData);
						}
					}
				}
				$this->db->where('id', $UserId);
				$this->db->update('users', array('step' => NULL));

				$this->srmAllocation($companyDetails->id);
				echo json_encode(array('flag' => 1, 'msg' => "Company Information Added."));
				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function companyEditForm1()
	{

		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);exit;
		$filename = "";
		$filename_add_proof_db = "";

		if (isset($_POST) && $_POST != '') {

			$allowed = array('jpg', 'jpeg', 'png');
			$allowed1 = array('jpg', 'jpeg', 'png', 'pdf');

			$filename = $_FILES['companyLogo']['name'];
			$filesize_logo = $_FILES['companyLogo']['size'];

			$filename_add_proof = $_FILES['companyAddProof']['name'];
			$filesize_add_proof = $_FILES['companyAddProof']['size'];

			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$ext_add_proof = strtolower(pathinfo($filename_add_proof, PATHINFO_EXTENSION));

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if (empty($_POST['companyName']) || empty($_POST['companyAddress1']) || empty($_POST['companyOrgType']) || empty($_POST['companyAbout'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			} else if (!empty($filename) && !in_array($ext, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;

			} else if (!empty($filename) && $filesize_logo > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename."));
				exit;
			} else if (!empty($filename_add_proof) && !in_array($ext_add_proof, $allowed1)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;

			} else if (!empty($filename_add_proof) && $filesize_add_proof > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_add_proof."));
				exit;
			} else {

				if ($_POST['companyLogoHidden'] != "") {
					$filename = $_POST['companyLogoHidden'];
				}

				if (isset($_FILES['companyLogo']['name']) && !empty($_FILES['companyLogo']['name'])) {

					$file_name = $_FILES['companyLogo']['name'];
					$filename = $_POST['UserId_form1'] . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
					$config['upload_path'] = COMPANY_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $_POST['UserId_form1'] . '-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('companyLogo')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}

				}

				if ($_POST['companyAddProofHidden'] != "") {
					$filename_add_proof_db = $_POST['companyAddProofHidden'];
				}

				if (isset($_FILES['companyAddProof']['name']) && !empty($_FILES['companyAddProof']['name'])) {

					$file_name = $_FILES['companyAddProof']['name'];
					$filename_add_proof_db = $_POST['UserId_form1'] . '-' . 'ADD-PROOF' . '.' . $ext;
					$config['upload_path'] = COMPANY_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $_POST['UserId_form1'] . '-' . 'ADD-PROOF';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('companyAddProof')) {
						$uploadData = $this->upload->data();
						$filename_add_proof_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				$update_corporate_details = array(

					'company_logo' => $filename,
					'company_name' => $_POST['companyName'],
					'company_address_1' => $_POST['companyAddress1'],
					'company_address_2' => $_POST['companyAddress2'],
					'address_proof' => $filename_add_proof_db,
					'city' => $_POST['companyCity'],
					'district' => $_POST['companyDistrict'],
					'pincode' => $_POST['companyPincode'],
					'state' => $_POST['companyState'],
					'about_company' => $_POST['companyAbout'],
					'company_org_type' => $_POST['companyOrgType'],
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id', $_POST['step_1_current_id']);
				$this->db->update('corporate_details', $update_corporate_details);

				$this->db->where('id', $UserId);
				$this->db->update('users', array('step' => 2));

				echo json_encode(array('flag' => 1, 'msg' => ""));
				exit;

			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function companyEditForm2()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);exit;
		$id = $_SESSION['UserId'];
		$filename_cin_db = "";
		$filename_gst_db = "";
		$filename_pan_db = "";

		if (isset($_POST) && $_POST != '') {

			$allowed = array('jpg', 'jpeg', 'pdf', 'png');
			$filename_cin = $_FILES['cin_certificate_file']['name'];
			$filesize_cin = $_FILES['cin_certificate_file']['size'];

			$filename_gst = $_FILES['gst_certificate_file']['name'];
			$filesize_gst = $_FILES['gst_certificate_file']['size'];

			$filename_pan = $_FILES['pan_card_file']['name'];
			$filesize_pan = $_FILES['pan_card_file']['size'];

			$ext_cin = strtolower(pathinfo($filename_cin, PATHINFO_EXTENSION));
			$ext_gst = strtolower(pathinfo($filename_gst, PATHINFO_EXTENSION));
			$ext_pan = strtolower(pathinfo($filename_pan, PATHINFO_EXTENSION));

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if (empty($_POST['cin_certificate_number']) || empty($_POST['pan_card_number'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
			} elseif (empty($_FILES['cin_certificate_file']['name']) && $_POST['cin_certificate_fileHidden'] == "") {
				//if(){
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
				//}

			} elseif (empty($_FILES['pan_card_file']['name']) && $_POST['pan_card_fileHidden'] == "") {
				//if($_POST['pan_card_fileHidden'] ==""){
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;
				//}
			} elseif (!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_cin."));
				exit;
			} elseif (!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_gst."));
				exit;
			} elseif (!empty($filename_pan) && !in_array($ext_pan, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
				// }else if( !preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['cin_certificate_number'])){
				// echo json_encode(array('flag'=>0, 'msg'=>"Invalid CIN Number"));
				// exit;

			} else if (!empty($filename_pan) && $filesize_pan > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_pan."));
				exit;
			} else if (!preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['pan_card_number'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid PAN Number"));
				exit;

			} else if (!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['gst_certificate_number']) && !empty($_POST['gst_certificate_number'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid GST Number"));
				exit;

			} else {

				if ($_POST['cin_certificate_fileHidden'] != "") {
					$filename_cin_db = $_POST['cin_certificate_fileHidden'];
				}

				if (isset($_FILES['cin_certificate_file']['name']) && !empty($_FILES['cin_certificate_file']['name'])) {
					$filename_cin_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CIN.' . $ext_cin;
					$config['upload_path'] = COMPANY_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-CIN';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('cin_certificate_file')) {
						$uploadData = $this->upload->data();
						$filename_cin_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if ($_POST['gst_certificate_fileHidden'] != "") {
					$filename_gst_db = $_POST['gst_certificate_fileHidden'];
				}

				if (isset($_FILES['gst_certificate_file']['name']) && !empty($_FILES['gst_certificate_file']['name'])) {
					$filename_gst_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-GST.' . $ext_gst;
					$config['upload_path'] = COMPANY_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-GST';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('gst_certificate_file')) {
						$uploadData = $this->upload->data();
						$filename_gst_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if ($_POST['pan_card_fileHidden'] != "") {
					$filename_pan_db = $_POST['pan_card_fileHidden'];
				}

				if (isset($_FILES['pan_card_file']['name']) && !empty($_FILES['pan_card_file']['name'])) {
					$filename_pan_db = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-PAN.' . $ext_pan;
					$config['upload_path'] = COMPANY_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-' . strtotime(date('Y-m-d H:i:s')) . '-PAN';

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('pan_card_file')) {
						$uploadData = $this->upload->data();
						$filename_pan_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}



				$update_corporate_details = array(
					'cin_no' => base64_encode($_POST['cin_certificate_number']),
					'cin_file' => $filename_cin_db,
					'gst_no' => base64_encode($_POST['gst_certificate_number']),
					'gst_file' => $filename_gst_db,
					'pan_no' => base64_encode($_POST['pan_card_number']),
					'pan_file' => $filename_pan_db,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id', $_POST['step_2_current_id']);
				$this->db->update('corporate_details', $update_corporate_details);

				$this->db->where('id', $UserId);
				$this->db->update('users', array('step' => 3)); 
				echo json_encode(array('flag' => 1, 'msg' => ""));
				exit;

			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function companyEditForm3()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if (isset($_POST) && $_POST != '') {

			$fullName = isset($_POST['fullName']) ? $_POST['fullName'] : array();
			$fullName_arr = array_values(array_filter($fullName));

			$email = isset($_POST['email']) ? $_POST['email'] : array();
			$email_arr = array_values(array_filter($email));

			$contactNo = isset($_POST['contactNo']) ? $_POST['contactNo'] : array();
			$contactNo_arr = array_values(array_filter($contactNo));

			$hiddenPhotograph = isset($_POST['hiddenPhotograph']) ? $_POST['hiddenPhotograph'] : array();
			//echo array_sum($milestoneBudget);exit;

			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			//if(empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])){
			if (empty($_POST['fullName'] && $_POST['email'] && $_POST['contactNo'])) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;

			} else if (count(array_filter($fullName)) != count($fullName)) {
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				echo json_encode(array('flag' => 0, 'msg' => "Full name is empty."));
				exit;

			} else if (count(array_filter($email)) != count($email)) {

				echo json_encode(array('flag' => 0, 'msg' => "email is empty."));
				exit;

			} else if (count(array_filter($contactNo)) != count($contactNo)) {

				echo json_encode(array('flag' => 0, 'msg' => "contact Number is empty."));
				exit;

			} else {
				$companyDetails = $this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				$boardMembersData = $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);

				$deleted_member_ids = isset($_POST['deleted_member_ids']) ? $_POST['deleted_member_ids'] : '';

				//$deleted_member_ids_arr =  array_values(array_filter($deleted_member_ids));
				//echo count($deleted_member_ids_arr);
				//print_r($deleted_member_ids_arr);

				if (isset($deleted_member_ids) && $deleted_member_ids != '') {
					$deleted_member_ids_arr = explode(",", $deleted_member_ids);
					foreach ($deleted_member_ids_arr as $id) {
						$record = $this->db->get_where('corporate_board_members', array('id' => $id))->num_rows();

						if ($record > 0) {
							//echo $id;
							$this->db->where('id', $id);
							$this->db->delete('corporate_board_members');
							//print_r($this->db->last_query());
						}
					}
				}

				if (isset($hiddenPhotograph) && count($hiddenPhotograph) > 0) {
					$photographArr = array_filter($_FILES['photograph']['name']);

					$resultDeleteArray = array_intersect_key($hiddenPhotograph, $photographArr);

					if (isset($resultDeleteArray) && count($resultDeleteArray) > 0) {
						foreach ($resultDeleteArray as $key => $value) {

							$delPhotoId = $_POST['hiddenPhotographId'][$key];

							$this->db->where('id', $delPhotoId);
							$this->db->delete('corporate_board_members');

						}
					}

					$resultUpdateArray = array_diff_key($hiddenPhotograph, $photographArr);
					if (isset($resultUpdateArray) && count($resultUpdateArray) > 0) {

						foreach ($resultUpdateArray as $key => $value) {

							$fullNameVal = $fullName_arr[$key];
							// $emailVal	= $email_arr[$key];
							// $contactNoVal	= $contactNo_arr[$key];
							$emailVal = $email[$key];
							$contactNoVal = $contactNo[$key];
							$photoId = $_POST['hiddenPhotographId'][$key];
							$hiddenPhotoVal = $_POST['hiddenPhotograph'][$key];

							$updateData = array(
								'corporate_id' => $companyDetails->id,
								'full_name' => $fullNameVal,
								'email' => $emailVal,
								'phone_no' => $contactNoVal,
								'photograph' => $hiddenPhotoVal,
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);
							//print_r($insertData2);	
							$this->db->where('id', $photoId);
							$this->db->update('corporate_board_members', $updateData);
						}

					}
				}

				if ($_FILES['photograph']['name'] != '') {

					$files = $_FILES['photograph'];

					for ($count = 0; $count < count($_FILES["photograph"]["name"]); $count++) {
						$fullNameVal = $fullName_arr[$count];
						// $emailVal	= $email_arr[$count];
						// $contactNoVal	= $contactNo_arr[$count];
						$emailVal = $email[$count];
						$contactNoVal = $contactNo[$count];

						$photoId = isset($_POST['hiddenPhotographId'][$count]) ? $_POST['hiddenPhotographId'][$count] : '';
						$hiddenPhotoVal = isset($_POST['hiddenPhotograph'][$count]) ? $_POST['hiddenPhotograph'][$count] : '';

						if ($files['name'][$count] != '' && $files['error'][$count] == 0) {

							$_FILES['file']['name'] = $file_name = $files['name'][$count];
							$_FILES['file']['type'] = $files['type'][$count];
							$_FILES['file']['tmp_name'] = $files['tmp_name'][$count];
							$_FILES['file']['error'] = $files['error'][$count];
							$_FILES['file']['size'] = $files['size'][$count];

							if ($_FILES["file"]["size"] > $filesize) {
								echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for " . $_FILES["file"]["name"]));
								exit;
							}

							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $companyDetails->id . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
							$config['upload_path'] = COMPANY_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;

							$config['file_name'] = $companyDetails->id . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('file')) {
								$uploadData = $this->upload->data();
								//print_r($uploadData);

								if ((!empty($photoId) && empty($hiddenPhotoVal)) || empty($photoId)) {
									$insertData = array(
										'corporate_id' => $companyDetails->id,
										'full_name' => $fullNameVal,
										'email' => $emailVal,
										'phone_no' => $contactNoVal,
										'photograph' => $uploadData['file_name'],
										'created_at' => strtotime(date('Y-m-d H:i:s')),
									);

									$this->db->insert('corporate_board_members', $insertData);
								}
							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						} else {
							if (empty($photoId)) {
								// echo $foundedByVal.'22222';
								$insertData = array(
									'corporate_id' => $companyDetails->id,
									'full_name' => $fullNameVal,
									'email' => $emailVal,
									'phone_no' => $contactNoVal,
									//'photograph'	=> $uploadData['file_name'],
									'created_at' => strtotime(date('Y-m-d H:i:s')),
								);

								$this->db->insert('corporate_board_members', $insertData);
							}
						}
					}
				}

				$this->db->where('id', $UserId);
				$this->db->update('users', array('step' => NULL));

				echo json_encode(array('flag' => 1, 'msg' => "Company Information Updated."));
				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function ngoEditFormStep1()
	{
		$id = $_SESSION['UserId'];
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		
		if (isset($_POST) && $_POST != '') {

			
			$entitytypeId = $_POST['Usertype'];
			$state_code   = $_POST['state'];
			$entitytypeLetter = $this->NgoModel->getentitytypeById($entitytypeId);
			$entityType = $_POST['entityType']; //Entity_type
			$entityName = $_POST['entityName']; //entity_name
			$entityLogo = ""; // Logo
			$checkIDexists  = $this->NgoModel->GetUserProfileInfo($id);
			$Purpose_entity = isset($_SESSION["Purpose_entity"]) ? $_SESSION["Purpose_entity"] : 0;
			$role = $this->NgoModel->checkUserRole($UserId);
			//	echo $role;
			if ($role == 3) {
				if (!empty($Purpose_entity)) {
					$Purpose_entity = array_filter($Purpose_entity);
					$Purpose_entity = implode(",", $Purpose_entity);
				} else {
					$Purpose_entity = 0;
				}
			} else {
				$Purpose_entity = 0;
			}
			
			if ($checkIDexists->step < 1) {
				$uploadedAddressProof = '';
				if ($_FILES['uploadedAddressProof']['name']) {
					$filename = $_FILES['uploadedAddressProof']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$trustDead = $id . '-' . 'ADD-PROOF' . '.' . $ext;
					$config['upload_path'] = NGO_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = '*';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $id . '-' . 'ADD-PROOF';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadedAddressProof')) {
						$uploadData = $this->upload->data();
						$uploadedAddressProof = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				} else {
					$uploadedAddressProof = "";
				}
		
				//Upload Address Proof STEP 1 END
				$governing_actID = $_POST['govAct'] ? implode(",", $_POST['govAct']) : 0;
				//Upload Address Proof STEP 1 END
				$inserttrue =  $_SESSION['ProfileId'];
				$UpdateProfile = array(
					'entity_name' => $_POST['entityName'],
					'entity_type' => $entityType,
					'Date_of_incorp_birth' => strtotime($_POST['incorpDate']),
					'entity_address' => $_POST['registerAddress'],
					'pincode' => $_POST['pincode'] ? $_POST['pincode'] : 0,
					'district' => $_POST['cityOrDistrict'],
					'city' => isset($_POST['city']),
					'governing_act_id' => $governing_actID,
					'state' => $_POST['state'],
					'address_proof' => $uploadedAddressProof,
					'user_id' => $id,
					'address_proof_type'=>$_POST['b_addressProof_type'],
					'step' => 2
				);

				$this->db->where('id', $inserttrue);
				$this->db->update('user_profile', $UpdateProfile);

				//INSERT QUERY END STEP 1
				if ($inserttrue) {
					//$Profile_id = $this->db->insert_id(); //Primary
					/*$update_profile_id =
					array(
						'profile_id_display' => $Profile_id,
					);
					$this->db->where('id', $id);
					$this->db->update('users', $update_profile_id);*/
					//Upload Documents PAN START
					$uploadPan = '';
					if ($_FILES['uploadPan']['name']) {
						$filename = $_FILES['uploadPan']['name'];
						$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
						$config['upload_path'] = NGO_PAN_PATH;
						$config['overwrite'] = TRUE;
						$config['allowed_types'] = '*';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = 'PAN_' . date('Ymd_His');
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('uploadPan')) {
							$uploadData = $this->upload->data();
							$uploadPan = $uploadData['file_name'];
						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}
					$updateDocuments = array(
						'document_number' => isset($_POST['panNumber']) ? $_POST['panNumber'] : 0,
						'document_name' => "PAN",
						'document_file_path' => $uploadPan,
						'profile_id' => $inserttrue,
						'created_at' => date('Y-m-d'),
						'updated_at' => date('Y-m-d'),
					);
					$this->db->insert('documents', $updateDocuments);
					//Upload Documents PAN END
					//Upload Documents GST
					$uploadGST = '';
					if ($_FILES['uploadGst']['name']) {
						$filename = $_FILES['uploadGst']['name'];
						$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
						$config['upload_path'] = NGO_GST_PATH;
						$config['overwrite'] = TRUE;
						$config['allowed_types'] = '*';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = 'GST_' . date('Ymd_His');
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('uploadGst')) {
							$uploadData = $this->upload->data();
							$uploadGST = $uploadData['file_name'];
						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					}
					$insertPAN = array(
						'document_number' => isset($_POST['gstNumber']) ? $_POST['gstNumber'] : 0,
						'document_name' => "GST",
						'document_file_path' => $uploadGST,
						'profile_id' => $inserttrue,
						'does_expire' => 0,
						'created_at' => date('Y-m-d'),
						'updated_at' => date('Y-m-d'),
					);
					$this->db->insert('documents', $insertPAN);
					//Upload Documents GST
					//Upload CIN number Start 
					$insertCIN = array(
						'document_number' => isset($_POST['cin_no']) ? $_POST['cin_no'] : 0,
						'document_name' => "CIN",
						'profile_id' => $inserttrue,
						'created_at' => date('Y-m-d'),
						'updated_at' => date('Y-m-d'),
					);
					$this->db->insert('documents', $insertCIN);
					//Upload CIN number End 
					//Upload Registerate Certificate Start
					$regdCertificate = '';
					if ($_FILES['uploadRegdCertificate']['name']) {
						$filename = $_FILES['uploadRegdCertificate']['name'];
						$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
						$regdCertificate = $id . '-' . 'ADD-PROOF' . '.' . $ext;
						$config['upload_path'] = NGO_CIN_PATH;
						$config['overwrite'] = TRUE;
						$config['allowed_types'] = '*';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = 'RegCerti' . date('Ymd_His');
						//Load upload library and initialize configuration
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('uploadRegdCertificate')) {
							$uploadData = $this->upload->data();
							$regdCertificate = $uploadData['file_name'];
						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
						$regdCertificate = array(
							'calendar_start_date' => isset($_POST['registrationCertificate']) ? $_POST['registrationCertificate'] : 0,
							'document_name' => "UploadRegisterationCertificate",
							'profile_id' => $inserttrue,
							'document_file_path' => $regdCertificate,
							'does_expire' => 0,
							'created_at' => date('Y-m-d'),
							'updated_at' => date('Y-m-d')
						);
						$this->db->insert('documents', $regdCertificate);
					}
					//Upload Registerate Certificate End
					//Upload Upload Trust Deed / R&R  Start
					$trustDead = '';
					if ($_FILES['trustDead']['name']) {
						$filename = $_FILES['trustDead']['name'];
						$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
						$trustDead = $id . '-' . 'ADD-PROOF' . '.' . $ext;
						$config['upload_path'] = NGO_TRUSTEE_PATH;
						$config['overwrite'] = TRUE;
						$config['allowed_types'] = '*';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = 'Trust_Deed' . date('Ymd_His');
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('trustDead')) {
							$uploadData = $this->upload->data();
							$trustDead = $uploadData['file_name'];
						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
						$trustDeadCertificate = array(
							'calendar_start_date' => isset($_POST['trustDeadDate']) ? $_POST['trustDeadDate'] : "",
							'document_name' => "TRUSTDEED",
							'profile_id' => $inserttrue,
							'document_file_path' => $trustDead,
							'does_expire' => 0,
							'created_at' => date('Y-m-d'),
							'updated_at' => date('Y-m-d'),
						);
						$this->db->insert('documents', $trustDeadCertificate);
					}
					/* $trustDeadCertificate = array(
					'calendar_start_date' => isset($_POST['registrationtrustDeed']) ? $_POST['registrationtrustDeed'] : 0,
					'document_name' => "TRUSTDEED",
					'profile_id' => $Profile_id,
					'document_file_path' => $trustDead,
					'does_expire' => 0,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
					);
					$this->db->insert('documents', $trustDeadCertificate); */
					//Upload Upload Trust Deed / R&R  End

					// Board of Directors Details Start 
					$dirName = $_POST['dirName'];
					$din = $_POST['din'];
					if (count($dirName) > 0) {
						foreach ($dirName as $dkeys => $dvals) {
							$updategoveBody = array(
								'profile_id' => $inserttrue,
								'role_id' => $_POST['current_role'],
								'governing_body_name' => $dvals,
								'din_or_DPIN' => $din[$dkeys],
								'created_at' => date('Y-m-d H:i:s'),
								'updated_at' => date('Y-m-d H:i:s'),
							);

							$this->db->insert('governing_body', $updategoveBody);
						}
					}
					//Board of Directors Details End 
				}

				$current_role = $_SESSION['current_role'];
				// $allcocated_roles = $this->NgoModel->checkUserRole($UserId);
				// $all = explode(",", $allcocated_roles);
				// if (!in_array($current_role, $all)) {
				// 	array_push($all, $current_role);
				// 	$role_update = array('all_roles_allocated' => implode(',', $all));
				// 	$this->NgoModel->updateUserRoles($UserId, $role_update);
				// }

			} else {
				
				//Update Query When Profile Id is created STEP 1
				$Profile_id = $this->profile_id;
				$uploadedAddressProof = '';
				
				if($_POST['b_addressProof_type']){
					if ($_FILES['uploadedAddressProof']['name']) {
						$filename = $_FILES['uploadedAddressProof']['name'];
						$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
						$trustDead = $id . '-' . 'ADD-PROOF' . '.' . $ext;
						$config['upload_path'] = NGO_ADD_PROOF_PATH;
						$config['overwrite'] = TRUE;
						$config['allowed_types'] = '*';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] = $id . '-' . 'ADD-PROOF' . date('Ymd_His');
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('uploadedAddressProof')) {
							$uploadData = $this->upload->data();
							$uploadedAddressProof = $uploadData['file_name'];
						} else {
							echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
							exit;
						}
					} else {
						$uploadedAddressProof = $_POST['existedaddressproof'];
					}
				}
				$governing_actID = $_POST['govAct'] ? implode(",", $_POST['govAct']) : 0;

				$UpdateProfile = array(
					'entity_name' => $_POST['entityName'],
					'entity_type' => $entityType,
					'Date_of_incorp_birth' => strtotime($_POST['incorpDate']),
					'entity_address' => $_POST['registerAddress'],
					'pincode' => $_POST['pincode'] ? $_POST['pincode'] : 0,
					'district' => $_POST['cityOrDistrict'],
					'city' => isset($_POST['city']),
					'governing_act_id' => $governing_actID,
					'state' => $_POST['state'],
					'address_proof' => $uploadedAddressProof,
					'address_proof_type'=>$_POST['b_addressProof_type'],
					'step' => 2
				);

				$this->db->where('id', $Profile_id);
				$this->db->update('user_profile', $UpdateProfile);

				$UpdateCIN = array(
					'document_number' => isset($_POST['cin_no']) ? $_POST['cin_no'] : 0,
					'updated_at' => date('Y-m-d'),
				);
				$this->db->where('document_name', "CIN");
				$this->db->where('profile_id', $Profile_id);
				$this->db->update('documents', $UpdateCIN);


				/*
				Sanjay Oraon
				Date 22-09-2023
				no longer use

				// Board of Directors Details Start 
			   //Delete Govern Body
				if (array_key_exists('existoldgovern', $_POST)) {
					$governexistdata = $_POST['existoldgovern'];
					if (count($governexistdata) > 0) {
						foreach ($governexistdata as $gdkeys => $gdvals) {
							$this->db->where('id', $gdkeys);
							$this->db->delete('governing_body');
						}
					}
				}

				*/


			
				$dirName = $_POST['dirName'];
				$din = $_POST['din'];

				
				if (count($dirName) > 0) {

					$this->db->where('profile_id', $Profile_id);
					$this->db->where('role_id', $_POST['current_role']);
					$this->db->delete('governing_body');

					foreach ($dirName as $ekeys => $evals) {

						$updategoveBody = array(
							'profile_id' => $Profile_id,
							'role_id' => $_POST['current_role'],
							'governing_body_name' => $evals,
							'din_or_DPIN' => $din[$ekeys],
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
						);
						$this->db->insert('governing_body', $updategoveBody);

						/*Sanjay Oraon
						Date 22-09-2023
						no longer use

						$updategoveBody = array(
							'governing_body_name' => $evals,
							'din_or_DPIN' => $Existdin[$ekeys],
							'updated_at' => date('Y-m-d'),
						);
						$this->db->where('id', $ekeys);
						$this->db->where('profile_id', $Profile_id);
						$this->db->update('governing_body', $updategoveBody);
						*/
					}
				}

				/*Sanjay Oraon
				Date 22-09-2023
				no longer use

				if (count($dirName) > 0) { echo 'ff';
					foreach ($dirName as $dkeys => $dvals) {
						$updategoveBody = array(
							'profile_id' => $Profile_id,
							'governing_body_name' => $dvals,
							'din_or_DPIN' => $din[$dkeys],
							'updated_at' => date('Y-m-d'),
						);
						$this->db->insert('governing_body', $updategoveBody);
					}
				}
				
				*/
				//Board of Directors Details End 

				//Upload Documents PAN START
				$uploadPan = '';
				if ($_FILES['uploadPan']['name']) {
					$filename = $_FILES['uploadPan']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$config['upload_path'] = NGO_PAN_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = '*';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = 'PAN_' . date('Ymd_His');
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadPan')) {
						$uploadData = $this->upload->data();
						$uploadPan = $uploadData['file_name'];
					} else {
						$uploadPan = $_POST['panexistfile'];
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				} else {
					$uploadPan = $_POST['panexistfile'];
				}

				$updatePan = array(
					'document_number' => isset($_POST['panNumber']) ? $_POST['panNumber'] : 0,
					'document_name' => "PAN",
					'document_file_path' => $uploadPan,
					'updated_at' => date('Y-m-d'),
				);
				$this->db->where('document_name', "PAN");
				$this->db->where('profile_id', $Profile_id);
				$this->db->update('documents', $updatePan);
				//Upload Documents PAN END


				//Upload Documents GST
				$uploadGST = '';
				if ($_FILES['uploadGst']['name']) {
					$filename = $_FILES['uploadGst']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$config['upload_path'] = NGO_GST_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = '*';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = 'GST_' . date('Ymd_His');
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadGst')) {
						$uploadData = $this->upload->data();
						$uploadGST = $uploadData['file_name'];
					} else {
						$uploadGST = $_POST['gstexistfile'];
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				} else {
					$uploadGST = $_POST['gstexistfile'];
				}
				$updateGST = array(
					'document_number' => isset($_POST['gstNumber']) ? $_POST['gstNumber'] : 0,
					'document_file_path' => $uploadGST,
					'updated_at' => date('Y-m-d'),
				);
				$this->db->where('document_name', "GST");
				$this->db->where('profile_id', $Profile_id);
				$this->db->update('documents', $updateGST);
				//Upload Documents PAN

				//Upload Registerate Certificate Start
			
				$wheredocuments           = array('profile_id'=>$this->profile_id,'document_name'=>'UploadRegisterationCertificate');
				$checkreg_certificate_row = $this->NgoModel->checkdocuments_documents($wheredocuments);
				$regdCertificate = '';
				
				if ($_FILES['uploadRegdCertificate']['name']) {
					$filename = $_FILES['uploadRegdCertificate']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$regdCertificate = $id . '-' . 'ADD-PROOF' . '.' . $ext;
					$config['upload_path'] = NGO_CIN_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] ='*';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = 'Reg_Certi' . date('Ymd_His');
					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadRegdCertificate')) {
						$uploadData = $this->upload->data();
						$regdCertificate = $uploadData['file_name'];
					} 
				}else{
					$regdCertificate   = $_POST['existRegproof'];
				}
				
				if(count($checkreg_certificate_row) > 0){
					$regCert_data = array(
						'calendar_start_date' => isset($_POST['registrationCertificate']) ? $_POST['registrationCertificate'] : 0,
						'profile_id' => $this->profile_id,
						'document_file_path' => $regdCertificate,
						'updated_at' => date('Y-m-d'),
					);
					$this->db->where('document_name', "UploadRegisterationCertificate");
					$this->db->where('profile_id', $Profile_id);
					$id = $this->db->update('documents', $regCert_data);
					
				}
				else{
					$regCert_data = array(
						'calendar_start_date' => isset($_POST['registrationCertificate']) ? $_POST['registrationCertificate'] : 0,
						'document_name' => "UploadRegisterationCertificate",
						'document_file_path' => $regdCertificate,
						'profile_id'     =>$this->profile_id,
						'created_at' => date('Y-m-d'),
						'updated_at' => date('Y-m-d')
					);
					$this->db->insert('documents', $regCert_data);
				 }
				//Upload Upload Trust Deed / R&R  Start
				$wheredocuments             = array('profile_id'=>$this->profile_id,'document_name'=>'TRUSTDEED');
				$checkTrust_certificate_row = $this->NgoModel->checkdocuments_documents($wheredocuments);
				$trustDead = '';
				if ($_FILES['trustDead']['name']) {
					$filename = $_FILES['trustDead']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$trustDead = $id . '-' . 'ADD-PROOF' . '.' . $ext;
					$config['upload_path'] = NGO_TRUSTEE_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = '*';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = 'Trust_Deed' . date('Ymd_His');
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('trustDead')) {
						$uploadData = $this->upload->data();
						$trustDead = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}
				else{
					echo $trustDead = $_POST['existTrustproof'];
				}
				if(count($checkTrust_certificate_row) > 0){
					$trustDeadCertificate = array(
						'calendar_start_date' => isset($_POST['trustDeadDate']) ? $_POST['trustDeadDate'] : "",
						'document_file_path' => $trustDead,
						'updated_at' => date('Y-m-d'),
					);
					$this->db->where('document_name', "TRUSTDEED");
					$this->db->where('profile_id', $Profile_id);
					$this->db->update('documents', $trustDeadCertificate);
				}
				else{
					$trustDeadCertificate = array(
						'calendar_start_date' => isset($_POST['trustDeadDate']) ? $_POST['trustDeadDate'] : "",
						'document_file_path'  => $trustDead,
						'profile_id'          => $this->profile_id,
						'created_at' => date('Y-m-d'),
						'updated_at' => date('Y-m-d')
					);
					$this->db->insert('documents', $trustDeadCertificate);
				}
			}

			

			redirect(base_url() . 'register/basicDetailsStepForm2#ngo-step-2');

		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
//Comment By krishna step 2 view page Non-Individual START
	public function basicDetailsStepForm2()
	{
		$userid      = $_SESSION['UserId'];
		$profile_id  = $this->NgoModel->GetUserProfileAccountId($userid);

		$UserDetails             = $this->UserModel->GetUserDetails($_SESSION['UserId']);
		$asocc_role_kyc          = $UserDetails->all_roles_allocated;
		$asocc_role_array        = explode(",", $asocc_role_kyc);
		$asocc_roles_kyc         = array_filter($asocc_role_array);
		$current_active_role     = $_SESSION['current_role'];

		if ($profile_id) {
			$data['usersprofile'] = $this->NgoModel->getUserRoleAndProfle();

			if ($data['usersprofile']->kyc_status == 4 && !in_array($current_active_role, $asocc_roles_kyc)) {
				if($current_active_role == 1)
					$key = 'implementor';
				if($current_active_role == 2 || $current_active_role == 7)
					$key = 'contributor';
				if($current_active_role == 3)
					$key = 'motivator';
				if($current_active_role == 4)
					$key = 'fundrasier';
				if($current_active_role == 5)
					$key = 'volunteer';
				if($current_active_role == 6)
					$key = 'donor';
				redirect(base_url().'discover/term/'.$key);
			}
			if ($data['usersprofile']->kyc_status == 4 && in_array($current_active_role, $asocc_roles_kyc)) {
				redirect('/dashboard/kycdashboard');
			}

			if ($data['usersprofile']) {
				$Entity_type_id_sel = $data['usersprofile']->entity_type;
				$Profile_ID = $data['usersprofile']->id;
				$state_id   = $data['usersprofile']->state;
				$statCode = $this->NgoModel->statecodebystateId($state_id);
				$data['SelCity'] = $this->NgoModel->citybystatecode($statCode);
				$data['org_type_name'] = $this->NgoModel->GetOrgTypeMaster($Entity_type_id_sel);
			}
		} else {
			$data['usersprofile'] = array();
		}

		$this->load->view('user/basicdetailstep2', $data);

	}

//Comment By krishna step 2 view page Non-Individual END
	public function ngoEditFormStep2()
	{
		$id         = $_SESSION['UserId'];
		$profile_id = $_POST['usersprofileID'];
		$UserId     = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		
	  // SDG AND SECTOR ASSOCIATED BY KRISHNA
		$sdgs = '';
		$sectors = '';
		$sectors_implode = 0;
		if (isset($_POST['sector_pref'])) {
			if (is_array($_POST['sector_pref'])) {
				foreach ($_POST['sector_pref'] as $keys => $value) {
					$sector_sel[] = $keys;
				}
				$sectors_implode = implode(',', $sector_sel);
			} else {
				$sectors_implode = 0;
			}
		}
		$sdg_implode = 0;
		if (isset($_POST['sdgs_pref'])) {
			if (is_array($_POST['sdgs_pref'])) {
				foreach ($_POST['sdgs_pref'] as $keys => $value) {
					$sdg_sel[] = $keys;
				}
				$sdg_implode = implode(',', $sdg_sel);
			} else {
				$sdg_implode = 0;
			}
		}
		$sector_data = array(
			'sdgs_master' => $sdg_implode,
			'sector_prefences_id' => $sectors_implode
		);
		$this->db->where('user_id', $_SESSION['UserId']);
		//$this->db->update('user_profile', $sector_data);
		// SDG AND SECTOR ASSOCIATED BY KRISHNA

		$filename = '';
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
		
		$b_uploadedAddressProof = '';
		if ($_FILES['b_uploadedAddressProof']['name']) {
			$filename = $_FILES['b_uploadedAddressProof']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$trustDead = $id . '-' . 'ADD-PROOF' . '.' . $ext;
			$config['upload_path'] = NGO_ADD_PROOF_PATH;
			$config['overwrite'] = TRUE;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['max_size'] = MAX_FILESIZE_BYTE;
			$config['file_name'] = $id . '-' . 'ADD-BILLING-PROOF';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('b_uploadedAddressProof')) {
				$uploadData = $this->upload->data();
				$b_uploadedAddressProof = $uploadData['file_name'];
			} else {
				echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
				exit;
			}
		} else {
			$b_uploadedAddressProof = $_POST['b_address_proof_existed'];
		}
		if (isset($_POST) && $_POST != '') {
			if ($_POST['areaofbuisness']) {
				foreach ($_POST['areaofbuisness'] as $area_key => $location_value) {
					if (isset($location_value['district'])) {
						$dist = implode(',', $location_value['district']);
					} else {
						$dist = "";
					}
					$insertData =
						array(
							'profile_id'  => $profile_id,
							'role_id'     => $_SESSION['current_role'],
							'state_id'    => $location_value['state'],
							'district_id' => $dist,
						);
					$this->db->insert('business_operation', $insertData);
				}
			}
			$saveData = 
			[
				'alternate_email_id' => $_POST['entityAltEmail'],
				'website'            => $_POST['website'],
				'about_entity'       => $_POST['about_entity'],
				'b_entity_address' => $_POST['b_address'],
				'b_pincode'          => $_POST['b_pincode'],
				'b_state'            => $_POST['b_state'],
				'b_district'         => $_POST['b_cityOrDistrict'],
				'b_city'         => $_POST['b_city'],
				'b_address_proof'     =>$b_uploadedAddressProof ,
				'b_address_proof_type'=>$_POST['b_addressProof_type'],
				'entity_logo'         =>$entityLogo,
				'kyc_status'          =>4
			];
			$this->db->where('user_id', $_SESSION['UserId']);
			$this->db->update('user_profile', $saveData);

			/*$this->load->library('uuid');
			$guid = $this->uuid->v4();
			$terms_and_cond_data = [
				'profile_id' => $_POST['usersprofileID'],
				't_c_type' => 2,
				'GUID' => $guid,
				'project_id' => 0,
				'IP' => $_SERVER['REMOTE_ADDR'],
				'Terms_Condition_version' => 1.1,
				'tnc_status' => 1,
			];
			$this->db->insert('terms_and_condition', $terms_and_cond_data);
			*/
			$sql = "SELECT `GUID` FROM `users` WHERE `id` = " . $UserId . "";
			$user = $this->db->query($sql)->row();
			$consent = fatch_consent(CONSENT[1]);
			if(isset($user->GUID) && $consent){
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
			$this->srmAllocation($profile_id);

			$current_active_role =  $_SESSION['current_role'];
			$users = $this->UserModel->get_users($UserId);
			$all_roles_allocated =$users->all_roles_allocated;
			if (strpos($all_roles_allocated, $current_active_role) === false ){
					$all_roles_allocated =  $all_roles_allocated.', '.$current_active_role;
			}
			$user_role =[
				'all_roles_allocated' => $all_roles_allocated,
				/*stepperTransferd 'step' => 3*/
			];
			$this->db->where('id',$_SESSION['ProfileId']);
			$this->db->update('user_profile', $user_role);
			
			$this->roleAllocation($UserId,$current_active_role);

			redirect('/dashboard/kycdashboard');
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function saveIndividualProfle()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		$entityLogo = $_POST['current_entity_logo'];

		$current_active_role =  $_SESSION['current_role'];
		$user_role = [
			'current_active_role' =>  $current_active_role,
			'all_roles_allocated' =>  $current_active_role,
		];


		// SDG AND SECTOR ASSOCIATED BY KRISHNA
		$sdgs = '';
		$sectors = '';
		$sectors_implode = 0;
		if (isset($_POST['sector_pref'])) {
			if (is_array($_POST['sector_pref'])) {
				foreach ($_POST['sector_pref'] as $keys => $value) {
					$sector_sel[] = $keys;
				}
				$sectors_implode = implode(',', $sector_sel);
			} else {
				$sectors_implode = 0;
			}
		}
		$sdg_implode = 0;
		if (isset($_POST['sdgs_pref'])) {
			if (is_array($_POST['sdgs_pref'])) {
				foreach ($_POST['sdgs_pref'] as $keys => $value) {
					$sdg_sel[] = $keys;
				}
				$sdg_implode = implode(',', $sdg_sel);
			} else {
				$sdg_implode = 0;
			}
		}
		$sector_data = array(
			'sdgs_master' => $sdg_implode,
			'sector_prefences_id' => $sectors_implode
		);
		$this->db->where('user_id', $_SESSION['UserId']);
		$this->db->update('user_profile', $sector_data);
		// SDG AND SECTOR ASSOCIATED BY KRISHNA


		$image_base64 = $this->input->post('entity_logo');
		if ($image_base64) {
			$image_array_1 = explode(";", $image_base64);
			$image_array_2 = explode(",", $image_array_1[1]);
			$image_base64 = base64_decode($image_array_2[1]);
			$folder = NGO_LOGO_PATH;
			$entityLogo = $UserId . '-' . 'ADD-LOGO' . '.' . time() . ".png";
			$file = $folder . $entityLogo;
			file_put_contents($file, $image_base64);
			} 
	
		//Upload Documents PAN START
			$uploadPan = '';
			if ($_FILES['uploadPan']['name']) {
				$filename = $_FILES['uploadPan']['name'];
				$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
				$config['upload_path'] = 'public/uploads/ngo/ngo_pan';
				$config['overwrite'] = TRUE;
				$config['allowed_types'] = '*';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = 'PAN_' . date('Ymd_His');
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('uploadPan')) {
					$uploadData = $this->upload->data();
					$uploadPan = 'public/uploads/ngo/ngo_pan/' . $uploadData['file_name'];
				} else {
					$uploadPan = $_POST['panexistfile'];
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$uploadPan = $_POST['panexistfile'];
			}

			$panDetails = array(
				'document_number' => isset($_POST['panNumber']) ? $_POST['panNumber'] : 0,
				'document_name' => "PAN",
				'document_file_path' => $uploadPan,
			);

			if ($this->session->userdata('Purpose_entity') && $current_active_role ==3) {
				$Purpose_entity = $this->session->userdata('Purpose_entity');
				$Purpose_entity_value = 0;
                if ($Purpose_entity['Purpose_entity_1'] ) {
					$Purpose_entity_value =1;
				}
				if ($Purpose_entity['Purpose_entity_2']) {
					$Purpose_entity_value =2;
				}
				if ($Purpose_entity['Purpose_entity_1'] && $Purpose_entity['Purpose_entity_2'] ) {
					$Purpose_entity_value =3;
				}
				//set purpose data
				$saveData = ['motivator_pruprose' =>$Purpose_entity_value];
			}

		   if (isset($_POST) && $_POST != '') {
				$saveData = [
					'about_entity' => $_POST['about_entity'],
					'entity_address' => $_POST['registerAddress'],
					'pincode' => (int) $_POST['pincode'],
					'state' => $_POST['state'],
					'user_id' => $UserId,
					'district' => $_POST['cityOrDistrict'],
					'city' => $_POST['cityOrDistrict'],
					'entity_logo' => $entityLogo,
					'kyc_status' => 4,
				];
			//Get user profile
			$user_profiles =  $this->NgoModel->getUserRoleAndProfle();
			if($user_profiles) {   
				
				$users = $this->UserModel->get_users($UserId);
				$all_roles_allocated =$users->all_roles_allocated;
				if (strpos($all_roles_allocated, $current_active_role) === false ){
					$all_roles_allocated =  $all_roles_allocated.', '.$current_active_role;
				}
				else {
					if ($users ->kyc_status == 4) {
						redirect('/dashboard/kycdashboard');
					} 
				}

				$user_role =[
					'all_roles_allocated' => $all_roles_allocated
				];
				$this->db->where('id',$UserId);
				$this->db->update('users', $user_role);
				
				$this->roleAllocation($UserId,$current_active_role);

		    	$profile_id = $user_profiles -> id;
				$this->db->where('id',$profile_id);
				$this->db->update('user_profile', $saveData);

				$panDetails['updated_at'] = time();
				$this->db->where('profile_id',$profile_id);
				$this->db->update('documents',$panDetails);
				//Here We can the user profile already exist or not ? 
				$this->load->library('uuid');
				$guid = $this->uuid->v4();
				$terms_and_cond_data = [
					'profile_id' => $profile_id,
					't_c_type' => 'normal',
					'GUID' => $guid,
					'project_id' => 0,
					'IP' => $_SERVER['REMOTE_ADDR'],
					'Terms_Condition_version' => 1.1,
					'tnc_status' => 1,
				];
				$this->db->insert('terms_and_condition', $terms_and_cond_data);
				redirect('/dashboard/kycdashboard');
			}else {
				$this->db->where('id',$UserId);
				$this->db->update('users', $user_role);

				$this->db->insert('user_profile', $saveData);


				$profile_id = $this->db->insert_id();
				$panDetails['created_at'] = time();
				$panDetails['profile_id'] = $profile_id;
				$this->db->insert('documents',$panDetails);

				$this->load->library('uuid');
				$guid = $this->uuid->v4();
				$terms_and_cond_data = [
					'profile_id' => $profile_id,
					't_c_type' => 'normal',
					'GUID' => $guid,
					'project_id' => 0,
					'IP' => $_SERVER['REMOTE_ADDR'],
					'Terms_Condition_version' => 1.1,
					'tnc_status' => 1,
				];
				$this->db->insert('terms_and_condition', $terms_and_cond_data);
				redirect('/dashboard/kycdashboard');
			}
		}
	}
	//If any singke Kyc Compleleted krishna start
	 public function termsandconditionSubmit(){
		$current_role     = $_SESSION['current_role'];
		$UserId           = $_SESSION['UserId'];
		$metaKey           = $this->input->post('metaKey');

		$allcocated_roles = $this->NgoModel->checkUserRole($UserId);
		$all              = explode(",", $allcocated_roles);
		if (!in_array($current_role, $all)) {
			array_push($all, $current_role);
			$role_update = array('all_roles_allocated' => implode(',', $all));
			//$this->NgoModel->updateUserRoles($UserId, $role_update);
			$this->db->where('id',$_SESSION['ProfileId']);
			$this->db->update('user_profile',$role_update);
			$this->roleAllocation($UserId,$current_role);
		}

		if ($this->session->userdata('Purpose_entity') && $current_role ==3) {
			$Purpose_entity = $this->session->userdata('Purpose_entity');
			$Purpose_entity_value = 0;
			if ($Purpose_entity['Purpose_entity_1'] ) {
				$Purpose_entity_value =1;
			}
			if ($Purpose_entity['Purpose_entity_2']) {
				$Purpose_entity_value =2;
			}
			if ($Purpose_entity['Purpose_entity_1'] && $Purpose_entity['Purpose_entity_2'] ) {
				$Purpose_entity_value =3;
			}
			//set purpose data
			$saveData = ['motivator_pruprose' =>$Purpose_entity_value];
			$this->db->where('id',$_POST['usersprofileID']);
			$this->db->update('user_profile', $saveData);
		}				
		/*$this->load->library('uuid');
		$guid = $this->uuid->v4();
		$terms_and_cond_data = [
			'profile_id' => $_POST['usersprofileID'] ? $_POST['usersprofileID'] : $this->profile_id,
			't_c_type' => 'normal',
			'GUID' => $guid,
			'project_id' => 0,
			'IP' => $_SERVER['REMOTE_ADDR'],
			'Terms_Condition_version' => 1.1,
			'tnc_status' => 1,
		];
		$this->db->insert('terms_and_condition', $terms_and_cond_data);*/
		$sql = "SELECT `GUID` FROM `users` WHERE `id` = " . $UserId . "";
			$user = $this->db->query($sql)->row();
			if($metaKey){
			$consent = fatch_consent(CONSENT[$metaKey]);
			if(isset($user->GUID) && $consent){
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
		}
		redirect('/dashboard/kycdashboard');
	 }
	//If Kyc single Kyc Completed krishna end

	public function saveVindividualprofile()
	{
        // After Switch Role
        // Current Active Role
		// All Roles Associated
      
	
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		$current_active_role =  $_SESSION['current_role'];
        $user_role = [
			'current_active_role' => $current_active_role,
			'all_roles_allocated' =>  $current_active_role,
		];
     
		$entityLogo = $_POST['current_entity_logo'];
		$image_base64 = $this->input->post('crop_step2_file');
		if ($image_base64) {
			$image_array_1 = explode(";", $image_base64);
			$image_array_2 = explode(",", $image_array_1[1]);
			$image_base64 = base64_decode($image_array_2[1]);
			$folder = NGO_LOGO_PATH;
			$entityLogo = $UserId . '-' . 'ADD-LOGO' . '.' . time() . ".png";
			$file = $folder . $entityLogo;
			file_put_contents($file, $image_base64);
			} 
	    //KRISHA
            //Pan Upload
			// $pan_file=""; 
			// if ($_FILES['uploadPan']['size'] != 0) {
			// 	$file_tmp =$_FILES['uploadPan']['tmp_name'];
			// 	$filename = time().'.'.explode('.',$_FILES['uploadPan']['name'])[1];
			// 	$pan_file = $filename;
			// 	$file_path =  $folder.$UserId.'/' .$pan_file;
			//     move_uploaded_file($file_tmp,$file_path );
			// }
		//KRISHNA PAN
			//Upload Documents PAN START
				$uploadPan = '';
				if ($_FILES['uploadPan']['name']) {
					$filename = $_FILES['uploadPan']['name'];
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$config['upload_path'] = 'public/uploads/ngo/ngo_pan';
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = '*';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = 'PAN_' . date('Ymd_His');
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('uploadPan')) {
						$uploadData = $this->upload->data();
						$uploadPan = 'public/uploads/ngo/ngo_pan/' . $uploadData['file_name'];
					} else {
						$uploadPan = $_POST['panexistfile'];
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				} else {
					$uploadPan = $_POST['panexistfile'];
				}
				//KRISHNA PAN
				$panDetails = array(
					'document_number' => isset($_POST['panNumber']) ? $_POST['panNumber'] : 0,
					'document_name' => "PAN",
					'document_file_path' => $uploadPan,
				);

		if (isset($_POST) && $_POST != '') {
			$saveData = [
				'about_entity' => $_POST['about_entity'],
				'entity_address' => $_POST['registerAddress'],
				'pincode' => (int) $_POST['pincode'],
				'state' => $_POST['state'],
				'user_id' => $UserId,
				'district' => $_POST['cityOrDistrict'],
				'city' => $_POST['cityOrDistrict'],
				'entity_logo' => $entityLogo,
				'kyc_status' => 4,
				'Individual_designation' => $_POST['Individual_designation'],
				'Individual_company_name' => $_POST['Individual_company_name'],
				'Individual_location' => $_POST['Individual_location'],
				'Individual_mode_of_working' => $_POST['Individual_mode_of_working'],
			];
            

			//Get user profile
			$user_profiles =  $this->NgoModel->getUserRoleAndProfle();
			if($user_profiles) {  
				
				$users = $this->UserModel->get_users($UserId);
				$all_roles_allocated =$users->all_roles_allocated;
				if (strpos($all_roles_allocated, $current_active_role) === false ){
					$all_roles_allocated =  $all_roles_allocated.', '.$current_active_role;
				}
				else{
					if($users ->kyc_status == 4){
						redirect('/dashboard/kycdashboard');
					} 
				}

				$user_role =[
					'all_roles_allocated' => $all_roles_allocated
				];
				$this->db->where('id',$UserId);
				$this->db->update('users', $user_role);
                $this->roleAllocation($UserId,$current_active_role);
                $profile_id = $user_profiles->id;
				$this->db->where('id',$profile_id);
				$this->db->update('user_profile', $saveData);

				$panDetails['updated_at'] = time();
				$this->db->where('profile_id',$profile_id);
				$this->db->update('documents',$panDetails);
				//Here We can the user profile already exist or not ? 
				$this->load->library('uuid');
				$guid = $this->uuid->v4();
				$terms_and_cond_data = [
					'profile_id' => $profile_id,
					't_c_type' => 'normal',
					'GUID' => $guid,
					'project_id' => 0,
					'IP' => $_SERVER['REMOTE_ADDR'],
					'Terms_Condition_version' => 1.1,
					'tnc_status' => 1,
				];
				$this->db->insert('terms_and_condition', $terms_and_cond_data);
				redirect('/dashboard/kycdashboard');
			}else {
				$this->db->where('id',$UserId);
				$this->db->update('users', $user_role);
				$this->db->insert('user_profile', $saveData);
				$profile_id = $this->db->insert_id();
				$panDetails['created_at'] = time();
				$panDetails['profile_id'] = $profile_id;
				$this->db->insert('documents',$panDetails);

				$this->load->library('uuid');
				$guid = $this->uuid->v4();
				$terms_and_cond_data = [
					'profile_id' => $profile_id,
					't_c_type' => 'normal',
					'GUID' => $guid,
					'project_id' => 0,
					'IP' => $_SERVER['REMOTE_ADDR'],
					'Terms_Condition_version' => 1.1,
					'tnc_status' => 1,
				];
				$this->db->insert('terms_and_condition', $terms_and_cond_data);
				redirect('/dashboard/kycdashboard');
			}
		}

     


       die;

        //Comment Sector Prefences section

		// $sectors_implode = 0;
		// if (isset($_POST['sector_pref'])) {
		// 	if (is_array($_POST['sector_pref'])) {
		// 		foreach ($_POST['sector_pref'] as $keys => $value) {
		// 			$sector_sel[] = $keys;
		// 		}
		// 		$sectors_implode = implode(',', $sector_sel);
		// 	} else {
		// 		$sectors_implode = 0;
		// 	}
		// }
		// $sdg_implode = 0;
		// if (isset($_POST['sdgs_pref'])) {
		// 	if (is_array($_POST['sdgs_pref'])) {
		// 		foreach ($_POST['sdgs_pref'] as $keys => $value) {
		// 			$sdg_sel[] = $keys;
		// 		}
		// 		$sdg_implode = implode(',', $sdg_sel);
		// 	} else {
		// 		$sdg_implode = 0;
		// 	}
		// }
		// $sector_data = array(
		// 	'sdgs_master' => $sdg_implode,
		// 	'sector_prefences' => $sectors_implode
		// );

		if (isset($_POST) && $_POST != '') {

			$saveData = [
				'about_entity' => $_POST['about_entity'],
				'entity_address' => $_POST['registerAddress'],
				'pincode' => (int) $_POST['pincode'],
				'state' => $_POST['state'],
				'user_id' => $UserId,
				'district' => $_POST['cityOrDistrict'],
				'city' => $_POST['cityOrDistrict'],
				'entity_logo' => $entityLogo,
				'kyc_status' => 4,
				'sdgs_master' => $sdg_implode,
				'sector_prefences_id' => $sectors_implode,
				'current_role' => $_SESSION['current_role'],
				'Individual_designation' => $_POST['Individual_designation'],
				'Individual_company_name' => $_POST['Individual_company_name'],
				'Individual_location' => $_POST['Individual_location'],
				'Individual_mode_of_working' => $_POST['Individual_mode_of_working'],
			];
			$Profile_id = '';
			if ($_POST['usersprofileID']) {
				$this->db->where('id', $_POST['usersprofileID']);
				$this->db->update('user_profile', $saveData);
			} else {
				$inserttrue = $this->db->insert('user_profile', $saveData);
				$entitytypeLetter = $this->NgoModel->getentitytypeById($_POST['entitytypeId']);
				if ($inserttrue) {
					$Profile_id = $this->db->insert_id(); //Primary
					if (empty($_POST['account_id'])) {
						$hexdecimal = str_pad($Profile_id, 6, "0", STR_PAD_LEFT);
						$account_id = $entitytypeLetter . '' . $_POST['state'] . '' . $hexdecimal; //Account_id
						$update_account_id =
							array(
								'account_id' => $account_id,
							);
						$this->db->where('id', $Profile_id);
						$this->db->update('user_profile', $update_account_id);
						$this->db->where('id', $id);
						$this->db->update('users', $update_account_id);
					}
				}
			}
			$uploadPan = '';
			if ($_FILES['uploadPan']['name']) {
				$filename = $_FILES['uploadPan']['name'];
				$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
				$trustDead = $id . '-' . 'ADD-PROOF' . '.' . $ext;
				$config['upload_path'] = NGO_ADD_PROOF_PATH;
				$config['overwrite'] = TRUE;
				$config['allowed_types'] = 'jpg|jpeg|png|pdf';
				$config['max_size'] = MAX_FILESIZE_BYTE;
				$config['file_name'] = $id . '-' . 'ADD-PROOF';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('uploadPan')) {
					$uploadData = $this->upload->data();
					$uploadPan = $uploadData['file_name'];
				} else {
					echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
					exit;
				}
			} else {
				$uploadPan = "";
			}

			$save_data = [
				'profile_id' => $Profile_id,
				'document_name' => 'PAN',
				'document_number' => $_POST['panNumber'],
				'document_file_path' => $uploadPan
			];

			$this->NgoModel->uploadDocuments($save_data);

			$current_role = $_SESSION['current_role'];
			$allcocated_roles = $this->NgoModel->checkUserRole($id);
			$all = explode(",", $allcocated_roles);
			if (!in_array($current_role, $all)) {
				array_push($all, $current_role);
				$role_update = array('all_roles_allocated' => implode(',', $all));
				$this->NgoModel->updateUserRoles($id, $role_update);
			}

			$this->load->library('uuid');
			$guid = $this->uuid->v4();
			$terms_and_cond_data = [
				'profile_id' => $_POST['usersprofileID'] ? $_POST['usersprofileID'] : $Profile_id,
				't_c_type' => 'normal',
				'GUID' => $guid,
				'project_id' => 0,
				'IP' => $_SERVER['REMOTE_ADDR'],
				'Terms_Condition_version' => 1.1,
				'status' => 1,
			];
			$this->db->insert('terms_and_condition', $terms_and_cond_data);
			redirect('/dashboard/kycdashboard');
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function ngoEditForm3()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		$id = $_SESSION['UserId'];

		$filename_year1_db = '';
		$filename_year2_db = '';
		$filename_year3_db = '';
		$filename_year4_db = '';
		$filename_year5_db = '';
		$filename_year6_db = '';
		$primarySourceType_arr = array();
		$primarySourceType = '';


		if (isset($_POST) && $_POST != '') {
			$primarySourceType_arr = isset($_POST['primarySourceType']) ? $_POST['primarySourceType'] : array();

			$allowed = array('jpg', 'jpeg', 'pdf', 'png');
			$filename_year1 = $_FILES['org_year_1_file']['name'];
			$filesize_year1 = $_FILES['org_year_1_file']['size'];

			$filename_year2 = $_FILES['org_year_2_file']['name'];
			$filesize_year2 = $_FILES['org_year_2_file']['size'];

			$filename_year3 = $_FILES['org_year_3_file']['name'];
			$filesize_year3 = $_FILES['org_year_3_file']['size'];

			$filename_year4 = $_FILES['org_year_4_file']['name'];
			$filesize_year4 = $_FILES['org_year_4_file']['size'];

			$filename_year5 = $_FILES['org_year_5_file']['name'];
			$filesize_year5 = $_FILES['org_year_5_file']['size'];

			$filename_year6 = $_FILES['org_year_6_file']['name'];
			$filesize_year6 = $_FILES['org_year_6_file']['size'];

			$ext_year1 = strtolower(pathinfo($filename_year1, PATHINFO_EXTENSION));
			$ext_year2 = strtolower(pathinfo($filename_year2, PATHINFO_EXTENSION));
			$ext_year3 = strtolower(pathinfo($filename_year3, PATHINFO_EXTENSION));
			$ext_year4 = strtolower(pathinfo($filename_year4, PATHINFO_EXTENSION));
			$ext_year5 = strtolower(pathinfo($filename_year5, PATHINFO_EXTENSION));
			$ext_year6 = strtolower(pathinfo($filename_year6, PATHINFO_EXTENSION));

			//echo $ext_year6;exit;

			$ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
			$date_incorporation = date('Y-m-d', $ngoDetails->date_incorporation);
			$today = date('Y-m-d');

			$d1 = new DateTime($date_incorporation);
			$d2 = new DateTime($today);

			//echo ($d1->diff($d2)->m); // int(4)
			$monthDiff = ($d1->diff($d2)->m + ($d1->diff($d2)->y * 12));

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			/*if((empty($_POST['primarySourceType']) || empty($_POST['year1_net_worth']) || empty($_POST['year1_turnover']) || empty($_POST['year1_net_profit']) || (empty($_FILES['org_year_1_file']['name'] ) && $_POST['org_year_1_fileHidden'] == ""))&& $monthDiff > 18)
			{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
			exit;
			}else if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {*/

			if (empty($primarySourceType_arr)) {
				echo json_encode(array('flag' => 0, 'msg' => "Please enter Primary Source Type."));
				exit;
			} else if (!empty($filename_year1) && !in_array($ext_year1, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year1) && $filesize_year1 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year1."));
				exit;
			} else if (!empty($filename_year2) && !in_array($ext_year2, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year2) && $filesize_year2 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year2."));
				exit;
			} else if (!empty($filename_year3) && !in_array($ext_year3, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year3) && $filesize_year3 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year3."));
				exit;
			} else if (!empty($filename_year4) && !in_array($ext_year4, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year4) && $filesize_year4 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year4."));
				exit;
			} else if (!empty($filename_year5) && !in_array($ext_year5, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year5) && $filesize_year5 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year5."));
				exit;
			} else if (!empty($filename_year6) && !in_array($ext_year6, $allowed)) {
				echo json_encode(array('flag' => 0, 'msg' => "Invalid file type."));
				exit;
			} else if (!empty($filename_year6) && $filesize_year6 > $filesize) {
				echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for $filename_year6."));
				exit;
			} else {
				if (((!empty($_FILES['org_year_1_file']['name']) || $_POST['org_year_1_fileHidden'] != "")) || (empty($_POST['year1_net_worth']) && empty($_POST['year1_turnover']) && empty($_POST['year1_net_profit']) && (empty($_FILES['org_year_1_file']['name']) && $_POST['org_year_1_fileHidden'] == ""))) {

				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for First Year."));
					exit;
				}

				if (((!empty($_FILES['org_year_2_file']['name']) || $_POST['org_year_2_fileHidden'] != "")) || (empty($_POST['year2_net_worth']) && empty($_POST['year2_turnover']) && empty($_POST['year2_net_profit']) && (empty($_FILES['org_year_2_file']['name']) && $_POST['org_year_2_fileHidden'] == ""))) {

				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Second Year."));
					exit;
				}

				if (((!empty($_FILES['org_year_3_file']['name']) || $_POST['org_year_3_fileHidden'] != "")) || (empty($_POST['year3_net_worth']) && empty($_POST['year3_turnover']) && empty($_POST['year3_net_profit']) && (empty($_FILES['org_year_3_file']['name']) && $_POST['org_year_3_fileHidden'] == ""))) {

				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Third Year."));
					exit;
				}

				if (((!empty($_FILES['org_year_4_file']['name']) || $_POST['org_year_4_fileHidden'] != "")) || (empty($_POST['year4_net_worth']) && empty($_POST['year4_turnover']) && empty($_POST['year4_net_profit']) && (empty($_FILES['org_year_4_file']['name']) && $_POST['org_year_4_fileHidden'] == ""))) {

				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Forth Year."));
					exit;
				}

				if (((!empty($_FILES['org_year_5_file']['name']) || $_POST['org_year_5_fileHidden'] != "")) || (empty($_POST['year5_net_worth']) && empty($_POST['year5_turnover']) && empty($_POST['year5_net_profit']) && (empty($_FILES['org_year_5_file']['name']) && $_POST['org_year_5_fileHidden'] == ""))) {

				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Fifth Year."));
					exit;
				}

				if (((!empty($_FILES['org_year_6_file']['name']) || $_POST['org_year_6_fileHidden'] != "")) || (empty($_POST['year6_net_worth']) && empty($_POST['year6_turnover']) && empty($_POST['year6_net_profit']) && (empty($_FILES['org_year_6_file']['name']) && $_POST['org_year_6_fileHidden'] == ""))) {

				} else {
					echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields for Sixth Year."));
					exit;
				}

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

				if ($_POST['org_year_1_fileHidden'] != "") {
					$filename_year1_db = $_POST['org_year_1_fileHidden'];
				}
				if (isset($_FILES['org_year_1_file']['name']) && !empty($_FILES['org_year_1_file']['name'])) {
					$filename_year1_db = $id . '-year1-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year1;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year1-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_1_file')) {
						$uploadData = $this->upload->data();
						$filename_year1_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if ($_POST['org_year_2_fileHidden'] != "") {
					$filename_year2_db = $_POST['org_year_2_fileHidden'];
				}
				if (isset($_FILES['org_year_2_file']['name']) && !empty($_FILES['org_year_2_file']['name'])) {
					$filename_year2_db = $id . '-year2-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year2;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year2-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_2_file')) {
						$uploadData = $this->upload->data();
						$filename_year2_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if ($_POST['org_year_3_fileHidden'] != "") {
					$filename_year3_db = $_POST['org_year_3_fileHidden'];
				}
				if (isset($_FILES['org_year_3_file']['name']) && !empty($_FILES['org_year_3_file']['name'])) {
					$filename_year3_db = $id . '-year3-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year3;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year3-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_3_file')) {
						$uploadData = $this->upload->data();
						$filename_year3_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if ($_POST['org_year_4_fileHidden'] != "") {
					$filename_year4_db = $_POST['org_year_4_fileHidden'];
				}
				if (isset($_FILES['org_year_4_file']['name']) && !empty($_FILES['org_year_4_file']['name'])) {
					$filename_year4_db = $id . '-year4-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year4;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year4-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_4_file')) {
						$uploadData = $this->upload->data();
						$filename_year4_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if ($_POST['org_year_5_fileHidden'] != "") {
					$filename_year5_db = $_POST['org_year_5_fileHidden'];
				}
				if (isset($_FILES['org_year_5_file']['name']) && !empty($_FILES['org_year_5_file']['name'])) {
					$filename_year5_db = $id . '-year5-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year5;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year5-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_5_file')) {
						$uploadData = $this->upload->data();
						$filename_year5_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if ($_POST['org_year_6_fileHidden'] != "") {
					$filename_year6_db = $_POST['org_year_6_fileHidden'];
				}
				if (isset($_FILES['org_year_6_file']['name']) && !empty($_FILES['org_year_6_file']['name'])) {
					$filename_year6_db = $id . '-year6-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext_year6;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;

					$config['file_name'] = $id . '-year6-' . strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('org_year_6_file')) {
						$uploadData = $this->upload->data();
						$filename_year6_db = $uploadData['file_name'];
					} else {
						echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
						exit;
					}
				}

				if (isset($_POST['primarySourceType'])) {
					$primarySourceType = implode(',', $primarySourceType_arr);
					$primarySourceType = ',' . $primarySourceType . ',';
				}

				if (date('m') >= 4) {
					$Y = date('Y') - 1;
				} else {
					$Y = date('Y') - 2;
				}

				$SY = $Y . "-04-01";
				$pt = $Y + 1;
				$EY = $pt . "-03-31";

				$update_ngo_Financial_details = array(
					'primary_source_type' => $primarySourceType,
					'year1' => date('Y', strtotime($SY)),
					'year1_file' => $filename_year1_db,
					'year1_net_worth' => $year1_net_worth,
					'year1_turnover' => $year1_turnover,
					'year1_net_profit' => $year1_net_profit,
					'year2' => date('Y', strtotime($SY)) - 1,
					'year2_file' => $filename_year2_db,
					'year2_net_worth' => $year2_net_worth,
					'year2_turnover' => $year2_turnover,
					'year2_net_profit' => $year2_net_profit,
					'year3' => date('Y', strtotime($SY)) - 2,
					'year3_file' => $filename_year3_db,
					'year3_net_worth' => $year3_net_worth,
					'year3_turnover' => $year3_turnover,
					'year3_net_profit' => $year3_net_profit,
					'year4' => date('Y', strtotime($SY)) - 3,
					'year4_file' => $filename_year4_db,
					'year4_net_worth' => $year4_net_worth,
					'year4_turnover' => $year4_turnover,
					'year4_net_profit' => $year4_net_profit,
					'year5' => date('Y', strtotime($SY)) - 4,
					'year5_file' => $filename_year5_db,
					'year5_net_worth' => $year5_net_worth,
					'year5_turnover' => $year5_turnover,
					'year5_net_profit' => $year5_net_profit,
					'year6' => date('Y', strtotime($SY)) - 5,
					'year6_file' => $filename_year6_db,
					'year6_net_worth' => $year6_net_worth,
					'year6_turnover' => $year6_turnover,
					'year6_net_profit' => $year6_net_profit,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id', $id);
				$this->db->update('ngo_details', $update_ngo_Financial_details);
/*stepperTransferd 
				$this->db->where('id', $id);
				$this->db->update('users', array('step' => 4));*/

				echo json_encode(array('flag' => 1, 'msg' => ""));
				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function addMemberEntry()
	{
		if (isset($_SESSION['UserId'])) {

			$random_id = generateUniqueID(10, 'Numeric');
			$data['random_id'] = $random_id;
			$data['number'] = $random_id;
			$data['team_member_counter'] = $_POST['counter'];
			$this->load->view('register/board_member_form', $data);

		} else {
			redirect(base_url('signin'), 'refresh');
		}
	}

	public function ngoEditForm4()
	{
		$UserId = $_SESSION['UserId'];
		if ($UserId == '') {
			redirect(base_url('signin', 'refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if (isset($_POST) && $_POST != '') {

			$fullName = isset($_POST['fullName']) ? $_POST['fullName'] : array();
			$fullName_arr = array_values(array_filter($fullName));

			$email = isset($_POST['email']) ? $_POST['email'] : array();
			$email_arr = array_values(array_filter($email));

			$contactNo = isset($_POST['contactNo']) ? $_POST['contactNo'] : array();
			$contactNo_arr = array_values(array_filter($contactNo));

			$designation = isset($_POST['designation']) ? $_POST['designation'] : array();
			$designation_arr = array_values(array_filter($designation));

			$role = isset($_POST['role']) ? $_POST['role'] : array();
			$role_arr = array_values(array_filter($role));

			$status = isset($_POST['status']) ? $_POST['status'] : array();
			$status_arr = array_values(array_filter($status));

			$HashPassword = isset($_POST['password']) ? $_POST['password'] : array();
			// $HashPassword = password_hash($password, PASSWORD_DEFAULT);
			// $HashPassword_arr=array_values(array_filter($HashPassword));

			$hiddenPhotograph = isset($_POST['hiddenPhotograph']) ? $_POST['hiddenPhotograph'] : array();
			//echo array_sum($milestoneBudget);exit;

			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();

			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if (empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])) {
				//if(empty($_POST['fullName'])){
				echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
				exit;

			} else if (count(array_filter($fullName)) != count($fullName) || count(array_filter($email)) != count($email) || count(array_filter($contactNo)) != count($contactNo)) {
				//else if(count(array_filter($fullName)) != count($fullName)){
				echo json_encode(array('flag' => 0, 'msg' => "Full name or Email or Contact No. is empty."));
				exit;
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;

			} else {
				$ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
				$boardMembersData = $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);

				$deleted_member_ids = isset($_POST['deleted_member_ids']) ? $_POST['deleted_member_ids'] : '';

				//$deleted_member_ids_arr =  array_values(array_filter($deleted_member_ids));
				//echo count($deleted_member_ids_arr);
				//print_r($deleted_member_ids_arr);

				if (isset($deleted_member_ids) && $deleted_member_ids != '') {
					$deleted_member_ids_arr = explode(",", $deleted_member_ids);
					foreach ($deleted_member_ids_arr as $id) {
						$record = $this->db->get_where('ngo_board_members', array('id' => $id))->num_rows();

						if ($record > 0) {
							//echo $id;
							$this->db->where('id', $id);
							$this->db->delete('ngo_board_members');
							//print_r($this->db->last_query());
						}
					}
				}

				if (isset($hiddenPhotograph) && count($hiddenPhotograph) > 0) {
					$photographArr = array_filter($_FILES['photograph']['name']);

					$resultDeleteArray = array_intersect_key($hiddenPhotograph, $photographArr);

					if (isset($resultDeleteArray) && count($resultDeleteArray) > 0) {
						foreach ($resultDeleteArray as $key => $value) {

							$delPhotoId = $_POST['hiddenPhotographId'][$key];

							$this->db->where('id', $delPhotoId);
							$this->db->delete('ngo_board_members');

						}
					}

					$resultUpdateArray = array_diff_key($hiddenPhotograph, $photographArr);
					if (isset($resultUpdateArray) && count($resultUpdateArray) > 0) {

						foreach ($resultUpdateArray as $key => $value) {

							$fullNameVal = $fullName_arr[$key];
							// $emailVal	= $email_arr[$key];
							// $contactNoVal	= $contactNo_arr[$key];
							$emailVal = $email[$key];
							$contactNoVal = $contactNo[$key];
							$photoId = $_POST['hiddenPhotographId'][$key];
							$hiddenPhotoVal = $_POST['hiddenPhotograph'][$key];
							$roleVal = $role[$key];
							$designationVal = $designation[$key];
							$statusVal = $status[$key];
							$HashPasswordVal = $HashPassword[$key];

							$updateData = array(
								'ngo_id' => $ngoDetails->id,
								'full_name' => $fullNameVal,
								'email' => $emailVal,
								'phone_no' => $contactNoVal,
								'photograph' => $hiddenPhotoVal,
								'created_at' => strtotime(date('Y-m-d H:i:s')),
								'password' => $HashPasswordVal,
								'designation' => $designationVal,
								'role' => $roleVal,
								'status' => $statusVal,
							);
							//print_r($insertData2);	
							$this->db->where('id', $photoId);
							$this->db->update('ngo_board_members', $updateData);
						}

					}
				}

				if ($_FILES['photograph']['name'] != '') {

					$files = $_FILES['photograph'];

					for ($count = 0; $count < count($_FILES["photograph"]["name"]); $count++) {
						$fullNameVal = $fullName_arr[$count];
						$emailVal = $email[$count];
						$contactNoVal = $contactNo[$count];
						$roleVal = $role[$count];
						$designationVal = $designation[$count];
						$statusVal = $status[$count];
						$HashPasswordVal = $HashPassword[$count];

						$photoId = isset($_POST['hiddenPhotographId'][$count]) ? $_POST['hiddenPhotographId'][$count] : '';
						$hiddenPhotoVal = isset($_POST['hiddenPhotograph'][$count]) ? $_POST['hiddenPhotograph'][$count] : '';
						if ($files['name'][$count] != '' && $files['error'][$count] == 0) {

							$_FILES['file']['name'] = $file_name = $files['name'][$count];
							$_FILES['file']['type'] = $files['type'][$count];
							$_FILES['file']['tmp_name'] = $files['tmp_name'][$count];
							$_FILES['file']['error'] = $files['error'][$count];
							$_FILES['file']['size'] = $files['size'][$count];

							if ($_FILES["file"]["size"] > $filesize) {
								echo json_encode(array('flag' => 0, 'msg' => "Limit exceeds above $size for " . $_FILES["file"]["name"]));
								exit;
							}

							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $ngoDetails->id . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
							$config['upload_path'] = NGO_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;

							$config['file_name'] = $ngoDetails->id . '-' . strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if ($this->upload->do_upload('file')) {
								$uploadData = $this->upload->data();
								//print_r($uploadData);

								if ((!empty($photoId) && empty($hiddenPhotoVal)) || empty($photoId)) {
									$insertData = array(
										'ngo_id' => $ngoDetails->id,
										'full_name' => $fullNameVal,
										'email' => $emailVal,
										'phone_no' => $contactNoVal,
										'photograph' => $uploadData['file_name'],
										'created_at' => strtotime(date('Y-m-d H:i:s')),
										'password' => $HashPasswordVal,
										'designation' => $designationVal,
										'role' => $roleVal,
										'status' => $statusVal,
									);
									$this->db->insert('ngo_board_members', $insertData);
								}
							} else {
								echo json_encode(array('flag' => 0, 'msg' => $this->upload->display_errors()));
								exit;
							}
						} else {
							if (empty($photoId)) {
								$insertData = array(
									'ngo_id' => $ngoDetails->id,
									'full_name' => $fullNameVal,
									'email' => $emailVal,
									'phone_no' => $contactNoVal,
									'created_at' => strtotime(date('Y-m-d H:i:s')),
									'password' => $HashPasswordVal,
									'designation' => $designationVal,
									'role' => $roleVal,
									'status' => $statusVal,
								);
								$this->db->insert('ngo_board_members', $insertData);
							}
						}
					}
				}
				/*stepperTransferd  $this->db->where('id', $UserId);
				$this->db->update('users', array('step' => NULL));*/

				echo json_encode(array('flag' => 1, 'msg' => "NGO Information Updated."));
				exit;
			}
		} else {
			echo json_encode(array('flag' => 0, 'msg' => "Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
	public function getcontributoraddress()
	{
		$roleid = $_SESSION['current_role'];
		$userid = $_SESSION['UserId'];
		$data = $this->NgoModel->getUserRoleAndProfle();
		$city_ID = $data->district;
		$state_ID = $data->state;

		$districtName = $this->NgoModel->citybystatecode_name($city_ID);
		$stateName = $this->NgoModel->statecodebystateId_name($state_ID);

		$html = '<div class="col-lg-12">
				<div class="form-group col-sm-6">
					<label class="control-label" for="address">Address  * </label>
					<input type="text" placeholder="46, 4 Bajaj Bhavan" class="form-control" id="baddress" name="b_address" value="' . $data->entity_address . '" disabled>
				</div>
				<div class="form-group col-sm-6">
					<label class="control-label" for="pincode">Pincode  * </label>
					<input type="text" class="form-control" id="bpincode" name="b_pincode" value="' . $data->pincode . '" disabled>
				</div>
				<div class="form-group col-sm-6">
					<label class="control-label" for="State">State  * </label>
					<div class="select-box">
						<select id="nbstate" name="b_cityOrDistrict" class="form-control b_cityOrDistrict_step2" disabled>
							<option>' . $stateName . '</option>						
						</select>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="control-label" for="district">District  * </label>
					<div class="select-box">
					<select id="nbcityOrDistrict" name="b_cityOrDistrict" class="form-control b_cityOrDistrict_step2"  disabled>
					<option>' . $districtName . '</option>							
					</select>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="control-label" for="city">City  * </label>
					<div class="select-box">
					<input placeholder="Enter City here" type="text" value="' . $data->city . '" class="form-control validate-char" id="city" name="b_city" disabled>
					</div>
				</div>
			</div>';
		echo $html;
	}


	public function getalldistrictbystateid(){
		$stID = trim($_POST['stID']);
		$stateCode = $this->NgoModel->statecodebystateId($stID);
		$data = $this->NgoModel->citybystatecode($stateCode);
		$html = '<option value="">Select District</option>';
		foreach ($data as $keys => $vals) {
			$html .= '<option value="' . $vals->id . '">' . $vals->dst_name . '</option>';
		}
		echo $html;

	}
	public function getalldistrictbystatecode()
	{
		$index = $_POST['count'];
		$stcode = trim($_POST['stcode']);
		$data = $this->NgoModel->citybystatecode($stcode);
		$html = '<select name="areaofbuisness[' . ($index - 1) . '][district][]" class="form-control select" id="BSelectCity" multiple>';
		foreach ($data as $keys => $vals) {
			$html .= '<option value="' . $vals->id . '">' . $vals->dst_name . '</option>';
		}
		$html .= '</select>';
		echo $html;

	}

	public function getalldistrictbystatecodeAjax()
	{
		$stcode = trim($_POST['stcode']);
		$countID = $_POST['count'];
		$data = $this->NgoModel->citybystatecode($stcode);
		$html = '<select name="areaofbuisness[' . ($countID) . '][district][]" style="height:0px;margin:-1px" class="selector-dist" id="districtaB' . $countID . '" multiple>';
		if($data){
			foreach ($data as $keys => $vals) {
				$html .= '<option '.(($stcode == "ALL")?"selected":"").' value="' . $vals->id . '">' . $vals->dst_name . '</option>';
			}	
		}
		$html .= '</select><label style="display:none" id="districtaB' . $countID . '-error" class="error" for="districtaB' . $countID . '">This field is required.</label>';

		
		echo $html;

	}
	public function getareaofbusinessoperation()
	{
		$stateMaster = $this->NgoModel->stateGet();
		$st = "";
		$count_ID = $_POST['count'];
		foreach ($stateMaster as $keys => $vals) {
			if($vals->st_code != 'OGL'){
			$st .= '<option value="' . $vals->st_code . '">' . $vals->st_name . '</option>';
			}
		}
		$html = '<div class="row" style="margin: 0;margin-left: 15px;"><div class="_areaofsB area_of_buisness_state">
					<div class="form-group col-sm-3 wrap_distCity">
						<select name="areaofbuisness[' . $count_ID . '][state]" class="form-control area_of_service_state" required>
							<option value="">Select State</option>
							' . $st . '
						</select>
					</div>
					<div class="form-group  col-sm-3 col-sm-select districtaB' . $count_ID . '">
						<select class="form-control" name="areaofbuisness[' . $count_ID . '][district][]" required>
							<option  value="">Select District</option>
						</select>
					</div>
					<a href="javascript:void(0)" class="delete" onclick="deleteSector(this)"><img src="'.$this->imageDelete.'"></a>
	  			</div></div>';
	   echo $html;
	}
	public function getassociatedsdg(){
		$sectorID = $_POST['sectorID'];
	    $assos_sdg = $this->NgoModel->getsdg_from_sectorID($sectorID);
		//$data = explode(',',$assos_sdg);

		echo json_encode($assos_sdg);
		exit;

		// echo '<pre>',var_dump($data); echo '</pre>';
	    //echo json_encode($data);
		//return $data;
	}
	/**
	 * 	APISetu
	 *
	 * 	Author	: Sanjay Oraon
	 * 	date	:	06-07-2023
	 * Api call
	 *	
	 */
	 public function getCompanyAndDirectorsDetails(){
		 $cin = $_POST['cin'];
		 $Api = new APISetu();
		 $response = $Api->getCompanyAndDirectorsDetails($cin);
		 echo $response;
	 }

	private function srmAllocation($pid){
		$roleId = $this->CommonModel->TblSelectedRecordsBy('access_group','id',array('group_name' => 'Sr Relationship Manager'),'ASC');
		$return = $this->CommonModel->TblSelectedRecordsBy('profile_assignment_to_srm_rm','srm_id','','DESC');
		if(isset($return->srm_id) && isset($roleId->id)){
            $rn = $this->CommonModel->srmAllocation($return->srm_id,$roleId->id);
			
			if(isset($rn->id)){
				$this->allocate($pid,$rn->id);
				return $rn->id;
			}
		}
		if(isset($roleId->id)){
			$return = $this->CommonModel->TblSelectedRecordsBy('adminusers','id',array('access_group_id' => $roleId->id),'ASC');
			if(isset($return->id)){
				$this->allocate($pid,$return->id);
			}
			return $return->id;
		}
		return false;
	}
	private function allocate($pid,$id){
		if($pid != '' && $id != ''){
			$info = array(
						'profile_id' => $pid,
						'srm_id' => $id,
						'profile_assign_status' => 1,
						'created_at' => strtotime(date('Y-m-d H:i:s')),
						'updated_at' => strtotime(date('Y-m-d H:i:s')),
					);
			$this->db->insert('profile_assignment_to_srm_rm', $info);

			$info = array('srm_id' => $id);
			$this->db->where('id', $pid);
			$this->db->update('user_profile', $info);
		}
		return true;
	}
	private function roleAllocation($id,$role){
		$rn = $this->CommonModel->TblSelectedRecords('user_role_lnk','id',array('user_id' => $id, 'role_id' => $role));
		if($rn)
			return true;
		$info = array(
			'user_id' => $id,
			'role_id' => $role,
			'created_at' => strtotime(date('Y-m-d H:i:s')),
			'updated_at' => strtotime(date('Y-m-d H:i:s')),
		);
		$this->db->insert('user_role_lnk', $info);
	}
}