<?php
defined('BASEPATH') OR exit('No direct script access allowed');

###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Neha Raut (neha.raut@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2019
###+------------------------------------------------------------------------------------------------

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('CommonModel');
		$this->load->model('CompanyModel'); 
		$this->load->model('UserModel');
		$this->load->model('NgoModel');
		$this->load->model('FundraiserModel');
		
		if(isset($_SESSION['UserId'])){
			$_SESSION['countdown'] = 40;
			$_SESSION['time_started'] = date("Y-m-d H:i:s");
			
			$_SESSION['last_active_time'] = time();
			$end_time = date("Y-m-d H:i:s", strtotime('+'.$_SESSION['countdown'].'minutes', strtotime($_SESSION['time_started']))) ;
			$_SESSION['end_time'] = $end_time; 
		}
	}
	
	public function signin(){
		
		if(isset($_SESSION['UserId']) && $_SESSION['UserId']!=''){
			redirect(base_url('refresh'));
		}
		$data['PageTitle'] = SITE_NAME.' - Sign In';
		$this->load->view('signup/login', $data);
	}

	public function signup(){
		if(isset($_SESSION['UserId']) && $_SESSION['UserId']!=''){
			redirect(base_url('refresh'));
		}	
		$data['PageTitle'] = SITE_NAME.' - Sign Up';
		$this->load->view('signup/signup', $data);
	}

	public function registration(){
		
		if(isset($_SESSION['UserId'])) {

			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);

			if(isset($UserDetails) && $UserDetails->status == 3 && $UserDetails->type== 2) {
				
				$cboardMembersData = 0;
				$companyDetails = $this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				if(isset($companyDetails->id)){
					$cboardMembersData	= $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);	
					$cboardMembersData = count($cboardMembersData);
				}
				
				if($cboardMembersData > 0){
					redirect(base_url('/company/view'),'refresh');
				}else if($companyDetails->cin_no !=""){
					redirect(base_url('/company/edit/'.$companyDetails->id.'/#company-step-3'),'refresh');
				}else{
					redirect(base_url('/company/edit/'.$companyDetails->id.'/#company-step-2'),'refresh');
				}	
				// if($companyDetails->cin_no !=""){
					// redirect(base_url('/company/view'),'refresh');
				// }else{
					// redirect(base_url('/company/edit/'.$companyDetails->id.'/#company-step-2'),'refresh');
				// }	
			}elseif(isset($UserDetails) && $UserDetails->status == 3 && $UserDetails->type == 1){
				
				$nboardMembersData = 0;
				$ngoDetails = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
				if(isset($ngoDetails->id)){
					$nboardMembersData	= $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);	 
					$nboardMembersData = count($nboardMembersData);
				}
				
				if($nboardMembersData > 0){
					redirect(base_url('ngo/view'),'refresh'); 
				//}else if($ngoDetails->year1_file != "" || $ngoDetails->year1_file == "") {
				}else if($ngoDetails->primary_source_type != "" || $ngoDetails->year1_file != "" ) { 
					redirect(base_url('/ngo/edit/'.$ngoDetails->id.'/#ngo-step-4'),'refresh');
				}else if($ngoDetails->cin_no !=""){
					redirect(base_url('/ngo/edit/'.$ngoDetails->id.'/#ngo-step-3'),'refresh');
				}else{
					redirect(base_url('/ngo/edit/'.$ngoDetails->id.'/#ngo-step-2'),'refresh');
				}
			}else{
				$data['PageTitle'] = SITE_NAME.' - Registration';
				$data['State']= $this->CommonModel->get_state();
				$data['Organization_Type']= $this->CommonModel->get_organization_type();
				$data['Co_Organization_Type']= $this->CommonModel->get_corporate_organization_type();
				$data['OrgType']= $UserDetails->type;
				$data['Sector_Master']= $this->CommonModel->get_sector_master();
				$data['PrimarySourceMaster']= $this->CommonModel->getPrimarySourceMaster();
				$this->load->view('register/registration', $data);
			}

		} else{
			redirect(base_url('signin/'),'refresh');
		}
	}


	public function signUpPostData()
	{
		if(isset($_POST) && $_POST != '') {

			if(empty($_POST['inputFname']) || empty($_POST['inputLname']) || empty($_POST['inputEmail']) || empty($_POST['inputMobile']) || empty($_POST['inputPassword'])) {
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
					exit;
			}
			 elseif(!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
				echo json_encode(array( 
					'flag' => 0,
                    'msg' => "Please check on the reCAPTCHA box."
                ));
                exit;
            } 
			else if( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST["inputEmail"])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter a valid Email address."));
				exit;
			} elseif(!preg_match('/^[0-9]*$/', $_POST['inputMobile'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter valid number."));
				exit;
			} elseif($_POST['inputPassword'] != $_POST['inputConfPassword']) {
				echo json_encode(array('flag'=>0, 'msg'=>"Confirm Password does not match."));
				exit;
			} else {	
				// NK - 01-04-22 - code commented
				// Verify the reCAPTCHA response 
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLE_RECAPTCHA_SECRET_KEY.'&response='.$_POST['g-recaptcha-response']); 
				 
				// Decode json data 
				$responseData = json_decode($verifyResponse); 
				 
				// If reCAPTCHA response is valid 
				if($responseData->success) {

					$UserDetails = $this->UserModel->GetUserByEmail($_POST['inputEmail']);
					$UserDetails2 = $this->UserModel->GetUserByPhone($_POST['inputMobile']);
						
					if(isset($UserDetails) && $UserDetails->id!='')
					{	
						echo json_encode(array('flag'=>0, 'msg'=>"User already registered with this email address."));
						exit;
					}elseif (isset($UserDetails2) && $UserDetails2->id!='') {
						
						echo json_encode(array('flag'=>0, 'msg'=>"User already registered with this phone number."));
						exit;
					}
					else {
							
						$string = '0123456789';
						$string_shuffled = str_shuffle($string);
						$getOTP = substr($string_shuffled, 0, 4);

						$insertOTPdata = array( 
							
							'phone_no' => $_POST['inputMobile'], 
							'otp'	   => $getOTP,
							
						);
						$this->db->insert('otp', $insertOTPdata);
						
							
							$mtd = "sms";
							//$mesg = 'Thank You for Signing up in truCSR. Your 4 digits OTP is '.$getOTP.'. Use this to complete the Signup process.';
							$mesg1 = 'Welcome to truCSR.';
							$mesg1 .= 'Your 4 digit OTP to complete the Signup process is '.$getOTP.'. Kindly don\'t share your OTP with anyone.';
							$mesg1 .= '-';
							$mesg1 .= 'truCSR.in';
                            $mesg=urlencode($mesg1);

							$mob = $_POST['inputMobile'];
							$send = "truCSR";
							$key = "A6caf2ce090e57e969d65c6111ef27bb9";
							//$template_id = "1007160093502103810";
							$template_id = "1007162762935940433";

							$url = 'https://api-alerts.kaleyra.com/v4/?api_key='.$key.'&method='.$mtd.'&message='.$mesg.'&to='.$mob.'&sender='.$send.'&template_id='.$template_id.'';  // API URL
							//print_r($url);exit;

							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
							curl_setopt($ch, CURLOPT_POST, 0);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
							curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
							$result = curl_exec($ch);

						echo json_encode(array('flag'=>1, 'msg'=>"Enter OTP which sent your registered mobile no.", 'phone'=> $_POST['inputMobile']));
						exit;
                   
					}
				} else {
					echo json_encode(array( 
						'flag' => 0,
						'msg' => "Robot verification failed, please try again."
					));
					exit;
				}
			}

		} else {

			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}

	}

	public function verifyOtp()
	{
		
		if(isset($_POST) && $_POST != ''){

			if(empty($_POST['otpNumber'])){

				echo json_encode(array('flag'=>0, 'msg'=>"Please enter OTP."));
				exit;

			} else{

				$optData = $this->UserModel->getOtpDataByPhone($_POST['phone']);
				
				
				if(empty($optData))
				{
					echo json_encode(array('flag'=>0, 'msg'=>"Phone number is not registered."));
					exit;

				}else{

					if($optData['otp'] != $_POST['otpNumber']){
					// if($_POST['otpNumber'] != '1234'){

						echo json_encode(array('flag'=>0, 'msg'=>"Invalid OTP"));
						exit;

					}else{

                           $this->db->where('phone_no',$optData['phone_no']);
                            $this->db->delete('otp');
							
						$HashPassword = password_hash($_POST['inputPassword'], PASSWORD_DEFAULT);
						
						//$invitee_type = 'fundraiser':'donor';
						$UnretsiteredUser = $this->FundraiserModel->findUnregisterUser($_POST['inputEmail'],$_POST['phone']);
						
						if(count($UnretsiteredUser) > 0){
							$userType = $this->FundraiserModel->findUnregisterUserType($_POST['inputEmail'],$_POST['phone']);
							if($userType->invitee_type == "fundraiser"){
								$type=4;
							}elseif($userType->invitee_type == "volunter"){
								$type=5;
							}else{
								$type=6;
							}
							//echo "success";
							$insertdata = array( 
								'first_name'  => $_POST['inputFname'],
								'last_name'   => $_POST['inputLname'],
								'email'		  => $_POST['inputEmail'], 
								'phone_no'	  => $_POST['inputMobile'], 
								'password'	  => $HashPassword,								
								'status'	  => 1, 
								'type'	 	  => $type, 
								'created_at'  => strtotime(date('Y-m-d H:i:s')),
									
							);
							$this->db->insert('users', $insertdata);
							$LastInsertID= $this->db->insert_id();

							$insertdata1 = array( 
								'user_id'	  => $LastInsertID,
								'role_id'	  => $type,
								'created_at'  => strtotime(date('Y-m-d H:i:s'))	
							);
							$this->db->insert('user_role_lnk', $insertdata1);
							
							foreach($UnretsiteredUser as $UR){
								$memberId = $UR->id;
								$updatedata = array( 
									'register_status'=> 2,
									'invitee_id'	 => $LastInsertID,
									'register_date'  => strtotime(date('Y-m-d H:i:s')),
									'updated_at' 	 => strtotime(date('Y-m-d H:i:s'))	
								);
								$this->db->where('id', $memberId);
								$this->db->update('campaign_members', $updatedata);
							}
							
						}else{
							//echo "fail";
							$insertdata = array( 
								'first_name'  => $_POST['inputFname'],
								'last_name'   => $_POST['inputLname'],
								'email'		  => $_POST['inputEmail'], 
								'phone_no'	  => $_POST['inputMobile'], 
								'password'	  => $HashPassword,								
								'status'	  => 0, 
								'created_at'  => strtotime(date('Y-m-d H:i:s')),
								
							);
							$this->db->insert('users', $insertdata);
							$LastInsertID= $this->db->insert_id();

							$insertdata1 = array( 
								'user_id'	  => $LastInsertID,
								'role_id'	  => 0,
								'created_at'  => strtotime(date('Y-m-d H:i:s'))	
							);
							$this->db->insert('user_role_lnk', $insertdata1);
						}
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
						
						$templateId =1;
						$to = $_POST['inputEmail'];
						$encoded_id_email = urlencode($to.'-'.$LastInsertID);
						$url = BASE_URL."verify-email-address/".$encoded_id_email;
						$username = $_POST['inputFname'].' '.$_POST['inputLname'];
						$TempVars = array();
						$DynamicVars = array();
						
						$TempVars = array("##USERNAME##" ,"##VERIFYEMAILURL##");
						$DynamicVars   = array($username,$url);
						//echo $to;
						$mailSent = $this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars,$DynamicVars);
						//echo $mailSent;exit;
						//$redirect = base_url();
							
						if($mailSent == true){
							// send notification or insert 
							$notification_text = $username.' has registered.';
							$link='<a href="/admin.php/user/viewUser/'.$LastInsertID.'">View the details here</a>'; 
							$type = 1;     //when implementer signs the contract
							$remark = '';
							
							// global model
							$query_builder['table_name'] = 'adminusers';
							$query_builder['where_in'] = array('user_type'=>array(1,2,3));
							$adminUsers = $this->gm->get_data_list($query_builder);
							// $adminuseremail = array("tadoc91003@sartess.com","p.jaykumar1997@gmail.com","namrataamrute30@gmail.com");
							// foreach($adminuseremail as $test){


							// Email code written by Neerajkumar on 06-04-2022 (This message will trigger to srm only when a new user registered)

							$query_for_rm['table_name'] = 'adminusers';
							$query_for_rm['where_in'] = array('user_type'=>array(3));
							$srmonly = $this->gm->get_data_list($query_for_rm);

							foreach ($srmonly as $get_rm_details) {

								$notificationText = $username.' has registered.';
								$Link='<a href="'.BASE_URL.'admin.php/user/viewUser/'.$LastInsertID.'">View the details here</a>'; 
								// $ngoDetails = "This is testing file.";
								$templateId = 14;
								$to= $get_rm_details['email'];
								$UserNameEmail =$get_rm_details['first_name'].' '.$get_rm_details['last_name'];
								$TempVars = array();
								$DynamicVars = array();
								$TempVars = array("##USERNAME##","##NOTIFICATIONTEXT##","##LINK##");
								$DynamicVars   = array($UserNameEmail,$notificationText,$Link);
								$this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars,$DynamicVars);

							}
							// Email code Registration ends here by Neerajkumar 

							
							// global model
							$query_builder1['table_name'] = 'users';
							$query_builder1['where'] = array('id'=>$LastInsertID);
							$UserDetails = $this->gm->get_data_row($query_builder1);
							$status = '';
							foreach($adminUsers as $row){ 
								$insertdata = array(
									'from_user_id' 			=> $LastInsertID, 
									'to_user_id'			=> $row['id'],
									'type'					=> $UserDetails['type'],
									'notification_text'		=> $notification_text,
									'area_id'				=> 0,
									'link' 					=> $link, 
									'type'					=> 5, // New register
									'type_of_notification'	=> 1, 
									'created_at'   			=> strtotime(date('Y-m-d H:i:s')),
								);
								
								$status = $this->gm->insert('adminuser_notifications', $insertdata); // global model

							

							}
							// calling global model - Vishal parmar 

							if($status != ''){
								echo json_encode(array('flag'=>1, 'msg'=>"OTP verified successfully."));
							}
							exit;							
							//    echo json_encode(array('flag'=>1, 'msg'=>"OTP verified successfully."));
							//    exit;
					
						}
						
						else{
							echo json_encode(array('flag'=>0, 'msg'=>"Something went wrong, please try again"));
							exit;  
						}
					}
				}	

			}

		}else{

			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}	

	}

	public function resendOtp() {
		if(isset($_POST) && $_POST != ''){

			$string = '0123456789';
			$string_shuffled = str_shuffle($string);
			$getOTP = substr($string_shuffled, 0, 4);


			$insertOTPdata = array( 
				
				'phone_no' => $_POST['phone'], 
				'otp'	   => $getOTP,
				
			);
			$this->db->insert('otp', $insertOTPdata);
			
			$mtd = "sms";
			//$mesg = 'Thank You for Signing up in truCSR. Your 4 digits OTP is '.$getOTP.'. Use this to complete the Signup process.';
			$mesg1 = 'Welcome to truCSR.';
			$mesg1 .= 'Your 4 digit OTP to complete the Signup process is '.$getOTP.'. Kindly don\'t share your OTP with anyone.';
			$mesg1 .= '-';
			$mesg1 .= 'truCSR.in';
            $mesg=urlencode($mesg1);

			$mob = $_POST['phone'];
			$send = "truCSR";
			$key = "A6caf2ce090e57e969d65c6111ef27bb9";
            //$template_id = "1007160093502103810";
            $template_id = "1007162762935940433";

			$url = 'https://api-alerts.kaleyra.com/v4/?api_key='.$key.'&method='.$mtd.'&message='.$mesg.'&to='.$mob.'&sender='.$send.'&template_id='.$template_id.'';  // API URL
			//print_r($url);exit;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // change to 1 to verify cert
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			$result = curl_exec($ch);

			echo json_encode(array('flag'=>1, 'msg'=>"OTP sent to your registered number."));
            exit;
			
		} 
		
		else{

			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;

		}	

	}
	
	
	public function ngoPostForm1(){
		
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		
		if(isset($_POST) && $_POST != ''){
			
			$filename_add_proof_db = '';
			
			$data = array();
			$orgSector_arr = array();
			$orgSector = '';
			
			$allowed = array('jpg','jpeg','png');
			$allowed1 = array('jpg','jpeg','png','pdf');
			$filename = $_FILES['orgLogo']['name'];
			$filesize_logo = $_FILES['orgLogo']['size'];
			
			$filename_add_proof = $_FILES['orgAddProof']['name'];
			$filesize_add_proof = $_FILES['orgAddProof']['size'];
			
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$ext_add_proof = strtolower(pathinfo($filename_add_proof, PATHINFO_EXTENSION));
			
			$orgSector_arr = isset($_POST['orgSector'])?$_POST['orgSector']:array();
			
			
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

			if(empty($_POST['orgName']) || empty($_POST['orgAddress1']) || empty($_POST['orgAddress2']) || empty($_POST['orgCity']) || empty($_POST['orgDistrict']) || empty($_POST['orgState']) || empty($_POST['orgType']) || empty($_POST['orgLocation']) || empty($_POST['orgDateIncorporation']) || empty($_POST['orgSector'])){
				
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;

			} else if(!empty($_POST['orgDateIncorporation']) && !preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$_POST['orgDateIncorporation'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Date format is incorrect."));exit;
				
			} else if(count($orgSector_arr)<=0)	{
				echo json_encode(array('flag'=>0, 'msg'=>"Please select at least one sector."));exit;
				
			} else if(!preg_match('/^[1-9][0-9]{5}$/', $_POST['orgPincode']) || empty($_POST['orgPincode'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter valid pincode."));exit;
			
			}else if(!empty($filename) && !in_array($ext, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename) && $filesize_logo > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename."));
				exit;
			}else if(!empty($filename_add_proof) && !in_array($ext_add_proof, $allowed1)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename_add_proof) && $filesize_add_proof > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_add_proof."));
				exit;
			}else{
				
				$UserCompanyDetails = $this->NgoModel->GetUserNgoInfo($_POST['ngo_userid_frm1']);
				if(isset($UserCompanyDetails) && $UserCompanyDetails->id!=''){	
					echo json_encode(array('flag'=>0, 'msg'=>"User already registered with ngo."));
					exit;
				}

				if(isset($_FILES['orgLogo']['name']) && !empty($_FILES['orgLogo']['name'])) { 

					$file_name = $_FILES['orgLogo']['name'];
					$filename = $_POST['ngo_userid_frm1'].'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
					$config['upload_path'] = NGO_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $_POST['ngo_userid_frm1'].'-'.strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('orgLogo')){
			          $uploadData = $this->upload->data();
			           $filename = $uploadData['file_name'];
			      	}else {
			      	echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
					exit;
			      	}
				}
				
				if(isset($_FILES['orgAddProof']['name']) && !empty($_FILES['orgAddProof']['name'])) { 

					$file_name = $_FILES['orgAddProof']['name'];
					$filename_add_proof_db = $_POST['ngo_userid_frm1'].'-'.'ADD-PROOF'.'.'.$ext;
					$config['upload_path'] = NGO_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $_POST['ngo_userid_frm1'].'-'.'ADD-PROOF';

					//Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('orgAddProof')){
			          $uploadData = $this->upload->data();
			           $filename_add_proof_db = $uploadData['file_name'];
			      	}else {
			      	echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
					exit;
			      	}
				}
				
				if(isset($_POST['orgSector'])){
					$orgSector = implode(',',$orgSector_arr);
					$orgSector = ','.$orgSector.',';					
				}

		      	$insert_ngo_details = array( 
					'user_id' 				=> $_POST['ngo_userid_frm1'], 
					'org_logo'	   			=> $filename,
					'org_name' 				=> $_POST['orgName'], 
					'org_address_line1'		=> $_POST['orgAddress1'],
					'org_address_line2'		=> $_POST['orgAddress2'],
					'website'				=> $_POST['orgWebsite'],
					'address_proof'		    => $filename_add_proof_db,
					'city'	   				=> $_POST['orgCity'],
					'district'	   			=> $_POST['orgDistrict'],
					'pincode'	   			=> $_POST['orgPincode'],
					'state'	   				=> $_POST['orgState'],
					'about_org'	   			=> $_POST['orgAbout'],
					'org_type'	   			=> $_POST['orgType'],
					'org_location_operation'=> $_POST['orgLocation'],
					'date_incorporation' 	=> strtotime($_POST['orgDateIncorporation']), 
					'sector_operation' 		=> $orgSector, 
					'created_at'	   		=> strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->insert('ngo_details', $insert_ngo_details);
				$lastInsertId = $this->db->insert_id();
				
				
				$updatedata = array( 
					'status' => 3, 
					'type'	 => 1,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id', $_POST['ngo_userid_frm1']);
				$this->db->update('users', $updatedata);		
				$updatedata1 = array( 
					'role_id'	 => 1,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id', $_POST['ngo_userid_frm1']);
				$this->db->update('user_role_lnk', $updatedata1);
				
				echo json_encode(array('flag'=>1, 'msg'=>"", 'currentInsertId'=>$lastInsertId));
					exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
					exit;
		}	

	}

	public function ngoPostForm2()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		$id = $_SESSION['UserId'];
		$filename_gst_db = '';
		$filename_fcra_db = '';
		$filename_35ac_db = '';
		
		
		if(isset($_POST) && $_POST != '' && isset($_FILES) && $_FILES != '')
		{ 
			$allowed = array('jpg','jpeg','pdf','png');
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

			if(empty($_POST['org_cin_number']) || empty($_FILES['org_cin_file']['name']) ||	empty($_POST['org_pan_number']) || empty($_FILES['org_pan_file']['name']) || empty($_POST['org_12a_number']) || empty($_FILES['org_12a_file']['name']) || empty($_FILES['org_trustee_file']['name']) || empty($_FILES['officialseal_file']['name']) || empty($_FILES['signature_file']['name'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
				exit;
			} else if(!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			} else if(!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_cin."));
				exit;
			}else if(!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			} else if(!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_gst."));
				exit;
			}else if(!empty($filename_pan) && !in_array($ext_pan, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_pan) && $filesize_pan > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_pan."));
				exit;
			}else if(!empty($filename_80g) && !in_array($ext_80g, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_80g) && $filesize_80g > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_80g."));
				exit;
			}else if(!empty($filename_fcra) && !in_array($ext_fcra, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_fcra) && $filesize_fcra > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_fcra."));
				exit;
			} else if(!empty($filename_35ac) && !in_array($ext_35ac, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_35ac) && $filesize_35ac > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_35ac."));
				exit;
			} else if(!empty($filename_12a) && !in_array($ext_12a, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			// } else if( !preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['org_cin_number'])){
				// echo json_encode(array('flag'=>0, 'msg'=>"Invalid CIN Number"));
				// exit;

			} else if(!empty($filename_12a) && $filesize_12a > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_12a."));
				exit;
			}else if(!empty($filename_trustee) && !in_array($ext_trustee, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_trustee) && $filesize_trustee > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_trustee."));
				exit;
			}else if( !preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['org_pan_number'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid PAN Number"));
				exit;
			} else if(!empty($filename_stamp) && !in_array($ext_stamp, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				exit;
			}else if(!empty($filename_stamp) && $filesize_stamp > $filesizess) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $sizess for $filename_stamp."));
				exit;
			}else if(!empty($filename_sign) && !in_array($ext_sign, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				exit;
			}else if(!empty($filename_sign) && $filesize_sign > $filesizess) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $sizess for $filename_sign."));
				exit;
			} else if(!empty($filename_csr) && !in_array($ext_csr, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_csr) && $filesize_csr > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_csr."));
				exit;
			}
			// else if( !preg_match("/^[A-Za-z0-9]+$/", $_POST['csr_number'])){
			// 	echo json_encode(array('flag'=>0, 'msg'=>"Invalid CSR Number"));
			// 	exit;
			// }
			// else condition commented 
			else if(!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['org_gst_number']) && !empty($_POST['org_gst_number'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid GST Number"));
				exit;

			} else{
				$filename_cin_db ='';
				if(isset($_FILES['org_cin_file']['name']) && !empty($_FILES['org_cin_file']['name'])) {
					$filename_cin_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN.'.$ext_cin;
					$config['upload_path'] = NGO_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_cin_file')){
			          $uploadData = $this->upload->data();
					  $filename_cin_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				$filename_gst_db  = '';
				if(isset($_FILES['org_gst_file']['name']) && !empty($_FILES['org_gst_file']['name'])) {
					$filename_gst_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST.'.$ext_gst;
					$config['upload_path'] = NGO_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_gst_file')){
			          $uploadData = $this->upload->data();
					  $filename_gst_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				$filename_pan_db='';
				if(isset($_FILES['org_pan_file']['name']) && !empty($_FILES['org_pan_file']['name'])) {
					$filename_pan_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN.'.$ext_pan;
					$config['upload_path'] = NGO_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
			      	if($this->upload->do_upload('org_pan_file')){
			          $uploadData = $this->upload->data();
					  $filename_pan_db = $uploadData['file_name'];
					 } else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				$filename_80g_db='';
				if(isset($_FILES['org_80g_file']['name']) && !empty($_FILES['org_80g_file']['name'])) {
					$filename_80g_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-80G.'.$ext_80g;
					$config['upload_path'] = NGO_80G_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-80G';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_80g_file')){
			          $uploadData = $this->upload->data();   
					  $filename_80g_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_fcra_db='';
				if(isset($_FILES['org_fcra_file']['name']) && !empty($_FILES['org_fcra_file']['name'])) {
					$filename_fcra_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-FCRA.'.$ext_fcra;
					$config['upload_path'] = NGO_FCRA_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-FCRA';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('org_fcra_file')){
			          $uploadData = $this->upload->data();
					  $filename_fcra_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_35ac_db='';
				if(isset($_FILES['org_35ac_file']['name']) && !empty($_FILES['org_35ac_file']['name'])) {
					$filename_35ac_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-35AC.'.$ext_35ac;
					$config['upload_path'] = NGO_35AC_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-35AC';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_35ac_file')){
			          $uploadData = $this->upload->data(); 
					  $filename_35ac_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				$filename_12a_db='';
				if(isset($_FILES['org_12a_file']['name']) && !empty($_FILES['org_12a_file']['name'])) {
					$filename_12a_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-12A.'.$ext_12a;
					$config['upload_path'] = NGO_12A_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-12A';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('org_12a_file')){
			          $uploadData = $this->upload->data();  
					  $filename_12a_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_trustee_db='';
				if(isset($_FILES['org_trustee_file']['name']) && !empty($_FILES['org_trustee_file']['name'])) {
					$filename_trustee_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-TRUSTEE.'.$ext_12a;
					$config['upload_path'] = NGO_TRUSTEE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-TRUSTEE';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('org_trustee_file')){
			          $uploadData = $this->upload->data();  
					  $filename_trustee_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_csr_db='';
				if(isset($_FILES['csr_file']['name']) && !empty($_FILES['csr_file']['name'])) {
					$filename_csr_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CSR.'.$ext_csr;
					$config['upload_path'] = NGO_CSR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CSR';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('csr_file')){
			          $uploadData = $this->upload->data();  
					  $filename_csr_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_stamp_db='';
				if(isset($_FILES['officialseal_file']['name']) && !empty($_FILES['officialseal_file']['name'])) {
					$filename_stamp_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-STAMP.'.$ext_stamp;
					$config['upload_path'] = NGO_STAMP_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-STAMP';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('officialseal_file')){
			          $uploadData = $this->upload->data();  
					  $filename_stamp_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_sign_db='';
				if(isset($_FILES['signature_file']['name']) && !empty($_FILES['signature_file']['name'])) {
					$filename_sign_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-SIGNATURE.'.$ext_sign;
					$config['upload_path'] = NGO_SIGNATURE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-SIGNATURE';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('signature_file')){
			          $uploadData = $this->upload->data();  
					  $filename_sign_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				

				$update_ngo_documents_details = array( 
					'cin_no' 	=> base64_encode($_POST['org_cin_number']),
					'cin_file'	=> $filename_cin_db,
					'gst_no' 	=> base64_encode($_POST['org_gst_number']),
					'gst_file'	=> $filename_gst_db,
					'pan_no'	=> base64_encode($_POST['org_pan_number']),
					'pan_file'  => $filename_pan_db,
					'org_80g_no'	=> base64_encode($_POST['org_80g_number']),
					'org_80g_file'  => $filename_80g_db,
					'fcra_no'	=> base64_encode($_POST['org_fcra_number']),
					'fcra_file'  => $filename_fcra_db,
					'org_35ac_no'	=> base64_encode($_POST['org_35ac_number']),
					'org_35ac_file'  => $filename_35ac_db,
					'org_12a_no'	=> base64_encode($_POST['org_12a_number']),
					'org_12a_file'  => $filename_12a_db,
					'org_trustee_no'	=> base64_encode($_POST['org_trustee_number']),
					'org_trustee_file'  => $filename_trustee_db,
					'officialseal_file'  => $filename_stamp_db,
					'signature_file'  => $filename_sign_db,
					'csr_num'	=> base64_encode($_POST['csr_number']),
					'csr_file'  => $filename_csr_db,
					'updated_at'	=> strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id',$id);

				$this->db->update('ngo_details', $update_ngo_documents_details);
				echo json_encode(array('flag'=>1, 'msg'=>""));

				exit;
			}
		}
		else
		{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
		
	}

	public function ngoPostForm3()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
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
				
		if(isset($_POST) && $_POST != '' && isset($_FILES) && $_FILES != '')
		{
			$primarySourceType_arr = isset($_POST['primarySourceType'])?$_POST['primarySourceType']:array();
			
			$allowed = array('jpg','jpeg','pdf','png');
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
			$date_incorporation= date('Y-m-d',$ngoDetails->date_incorporation);
			$today= date('Y-m-d');
			
			$d1 = new DateTime($date_incorporation);
			$d2 = new DateTime($today);
			
			//echo ($d1->diff($d2)->m); // int(4)
			$monthDiff = ($d1->diff($d2)->m + ($d1->diff($d2)->y*12));
			
			/*if((empty($_POST['primarySourceType']) || empty($_POST['year1_net_worth']) || empty($_POST['year1_turnover']) || empty($_POST['year1_net_profit']) || empty($_FILES['org_year_1_file']['name'] )) && $monthDiff > 18)
			{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
				exit;
			}else if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {*/
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			if (empty($primarySourceType_arr)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter Primary Source Type."));
				exit;
			}else if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year1) && $filesize_year1 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year1."));
				exit;
			}else if(!empty($filename_year2) && !in_array($ext_year2, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year2) && $filesize_year2 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year2."));
				exit;
			}else if(!empty($filename_year3) && !in_array($ext_year3, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year3) && $filesize_year3 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year3."));
				exit;
			}else if(!empty($filename_year4) && !in_array($ext_year4, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year4) && $filesize_year4 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year4."));
				exit;
			}else if(!empty($filename_year5) && !in_array($ext_year5, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year5) && $filesize_year5 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year5."));
				exit;
			}else if(!empty($filename_year6) && !in_array($ext_year6, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year6) && $filesize_year6 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year6."));
				exit;
			}
			else
			{
				if((!empty($_FILES['org_year_1_file']['name'] )) || (empty($_POST['year1_net_worth']) && empty($_POST['year1_turnover']) && empty($_POST['year1_net_profit']) && empty($_FILES['org_year_1_file']['name'] ) )){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
					exit;
				}
				
				if((!empty($_FILES['org_year_2_file']['name'] )) || (empty($_POST['year2_net_worth']) && empty($_POST['year2_turnover']) && empty($_POST['year2_net_profit']) && empty($_FILES['org_year_2_file']['name'] ) )){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Second Year."));
					exit;
				}
				
				if((!empty($_FILES['org_year_3_file']['name'] )) || (empty($_POST['year3_net_worth']) && empty($_POST['year3_turnover']) && empty($_POST['year3_net_profit']) && empty($_FILES['org_year_3_file']['name'] ))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Third Year."));
					exit;
				}
				
				if((!empty($_FILES['org_year_4_file']['name'] )) || (empty($_POST['year4_net_worth']) && empty($_POST['year4_turnover']) && empty($_POST['year4_net_profit']) && empty($_FILES['org_year_4_file']['name'] ))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Forth Year."));
					exit;
				}
				
				if((!empty($_FILES['org_year_5_file']['name'] )) || (empty($_POST['year5_net_worth']) && empty($_POST['year5_turnover']) && empty($_POST['year5_net_profit']) && empty($_FILES['org_year_5_file']['name'] ))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Fifth Year."));
					exit;
				}
				
				if((!empty($_FILES['org_year_6_file']['name'] )) || (empty($_POST['year6_net_worth']) && empty($_POST['year6_turnover']) && empty($_POST['year6_net_profit']) && empty($_FILES['org_year_6_file']['name'] ))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Sixth Year."));
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
				if(isset($_FILES['org_year_1_file']['name']) && !empty($_FILES['org_year_1_file']['name'])) {
					$filename_year1_db = $id.'-year1-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year1;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year1-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_1_file')){
			          $uploadData = $this->upload->data();
			          $filename_year1_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				$filename_year2_db = '';
				if(isset($_FILES['org_year_2_file']['name']) && !empty($_FILES['org_year_2_file']['name'])) {
					$filename_year2_db = $id.'-year2-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year2;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year2-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_2_file')){
			          $uploadData = $this->upload->data();
			          $filename_year2_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_year3_db = '';
				if(isset($_FILES['org_year_3_file']['name']) && !empty($_FILES['org_year_3_file']['name'])) {
					$filename_year3_db = $id.'-year3-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year3;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year3-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_3_file')){
			          $uploadData = $this->upload->data();
			          $filename_year3_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_year4_db = '';
				if(isset($_FILES['org_year_4_file']['name']) && !empty($_FILES['org_year_4_file']['name'])) {
					$filename_year4_db = $id.'-year4-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year4;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year4-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_4_file')){
			          $uploadData = $this->upload->data();
			          $filename_year4_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_year5_db = '';
				if(isset($_FILES['org_year_5_file']['name']) && !empty($_FILES['org_year_5_file']['name'])) {
					$filename_year5_db = $id.'-year5-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year5;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year5-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_5_file')){
			          $uploadData = $this->upload->data();
			          $filename_year5_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				$filename_year6_db = '';
				if(isset($_FILES['org_year_6_file']['name']) && !empty($_FILES['org_year_6_file']['name'])) {
					$filename_year6_db = $id.'-year6-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year6;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year6-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_6_file')){
			          $uploadData = $this->upload->data();
			          $filename_year6_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if(isset($_POST['primarySourceType'])){
					$primarySourceType = implode(',',$primarySourceType_arr);
					$primarySourceType = ','.$primarySourceType.',';					
				}
				
				if (date('m') >= 4 ) {
					$Y = date('Y') - 1;
				}
				else {
					$Y = date('Y') - 2;
				}
				
				$SY=$Y."-04-01";
				$pt = $Y+1;
				$EY=$pt."-03-31";
				
				$update_ngo_Financial_details = array( 
					'primary_source_type'=> $primarySourceType, 
					'year1' 			=> date('Y', strtotime($SY)), 
					'year1_file'		=> $filename_year1_db,
					'year1_net_worth'	=> $year1_net_worth,
					'year1_turnover' 	=> $year1_turnover,
					'year1_net_profit' 	=> $year1_net_profit,
					'year2' 			=> date('Y', strtotime($SY))-1,  
					'year2_file'		=> $filename_year2_db,
					'year2_net_worth'	=> $year2_net_worth,
					'year2_turnover' 	=> $year2_turnover,
					'year2_net_profit' 	=> $year2_net_profit,
					'year3'				=> date('Y', strtotime($SY))-2,
					'year3_file'  		=> $filename_year3_db,
					'year3_net_worth'	=> $year3_net_worth,
					'year3_turnover' 	=> $year3_turnover,
					'year3_net_profit' 	=> $year3_net_profit,
					'year4'				=> date('Y', strtotime($SY))-3,
					'year4_file'  		=> $filename_year4_db,
					'year4_net_worth'	=> $year4_net_worth,
					'year4_turnover' 	=> $year4_turnover,
					'year4_net_profit' 	=> $year4_net_profit,
					'year5'				=> date('Y', strtotime($SY))-4,
					'year5_file'  		=> $filename_year5_db,
					'year5_net_worth'	=> $year5_net_worth,
					'year5_turnover' 	=> $year5_turnover,
					'year5_net_profit' 	=> $year5_net_profit,
					'year6'				=> date('Y', strtotime($SY))-5,
					'year6_file'  		=> $filename_year6_db,
					'year6_net_worth'	=> $year6_net_worth,
					'year6_turnover' 	=> $year6_turnover,
					'year6_net_profit' 	=> $year6_net_profit,
					'created_at'		=> strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id',$id);
				$this->db->update('ngo_details', $update_ngo_Financial_details);				

				echo json_encode(array('flag'=>1, 'msg'=>""));
				exit;
			}
		}
		else
		{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
	
	public function ngoPostForm4()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if(isset($_POST) && $_POST != ''){
				
			$fullName=isset($_POST['fullName'])?$_POST['fullName']:array();
			$fullName_arr=array_values(array_filter($fullName));
			
			$email=isset($_POST['email'])?$_POST['email']:array();
			$email_arr=array_values(array_filter($email));

			$contactNo=isset($_POST['contactNo'])?$_POST['contactNo']:array();
			$contactNo_arr=array_values(array_filter($contactNo));
			
			$designation=isset($_POST['designation'])?$_POST['designation']:array();
			$designation_arr=array_values(array_filter($designation));

			$role=isset($_POST['role'])?$_POST['role']:array();
			$role_arr=array_values(array_filter($role));

			$status=isset($_POST['status'])?$_POST['status']:array();
			$status_arr=array_values(array_filter($status));
			
			$HashPassword=isset($_POST['password'])?$_POST['password']:array();
			// $HashPassword = password_hash($password, PASSWORD_DEFAULT);
			// $HashPassword_arr=array_values(array_filter($HashPassword));

			$hiddenPhotograph=isset($_POST['hiddenPhotograph'])?$_POST['hiddenPhotograph']:array();
			//echo array_sum($milestoneBudget);exit;
			
			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			
			if(empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])){
			//if(empty($_POST['fullName'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
				
			}
			else if(count(array_filter($fullName)) != count($fullName) || count(array_filter($email)) != count($email) || count(array_filter($contactNo)) != count($contactNo)){
			//else if(count(array_filter($fullName)) != count($fullName)){
				echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;
				
			}else{
				$ngoDetails	= $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);	
				$boardMembersData	= $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);
				
				if($_FILES['photograph']['name'] != ''){
					
					$files = $_FILES['photograph'];
					
					for($count = 0; $count<count($_FILES["photograph"]["name"]); $count++)
					{
						if($files['name'][$count] != ''  && $files['error'][$count] == 0){
							
							$_FILES['file']['name']= $file_name = $files['name'][$count];
							$_FILES['file']['type']= $files['type'][$count];
							$_FILES['file']['tmp_name']= $files['tmp_name'][$count];
							$_FILES['file']['error']= $files['error'][$count];
							$_FILES['file']['size']= $files['size'][$count];
							
							if($_FILES["file"]["size"] > $filesize){
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above $size for ".$_FILES["file"]["name"]));
								exit;
							}
							
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $ngoDetails->id.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
							$config['upload_path'] = NGO_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							
							$config['file_name'] = $ngoDetails->id.'-'.strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('file')){
							  $uploadData = $this->upload->data();
							  //print_r($uploadData);
							
								$fullNameVal	= $fullName_arr[$count];
								$emailVal	= $email[$count];
								$contactNoVal	= $contactNo[$count];
								$roleVal	= $role[$count];
								$designationVal	= $designation[$count];
								$statusVal	= $status[$count];
								$HashPasswordVal	= $HashPassword[$count];
								
								
								$insertData=array(  'ngo_id'		=> $ngoDetails->id,
													'full_name'		=> $fullNameVal,
													'email'			=> $emailVal,
													'phone_no'		=> $contactNoVal,
													'photograph'	=> $uploadData['file_name'],
													'created_at'	=> strtotime(date('Y-m-d H:i:s')),
													'password'		=> $HashPasswordVal,
													'designation'	=> $designationVal,
													'role'			=> $roleVal,
													'status'		=> $statusVal,
													);
													
								$this->db->insert('ngo_board_members', $insertData);
							}else {
								echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
								exit;
							}
						}else{
							$fullNameVal	= $fullName_arr[$count];
							$emailVal	= $email[$count];
							$contactNoVal	= $contactNo[$count];
							$roleVal		= $role[$count];
							$designationVal	= $designation[$count];
							$statusVal		= $status[$count];
							$HashPasswordVal= $HashPassword[$count];
								
							$insertData=array(  'ngo_id'		=> $ngoDetails->id,
												'full_name'		=> $fullNameVal,
												'email'			=> $emailVal,
												'phone_no'		=> $contactNoVal,
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
												'password'		=> $HashPasswordVal,
												'designation'	=> $designationVal,
												'role'			=> $roleVal,
												'status'		=> $statusVal,
												);
												
							$this->db->insert('ngo_board_members', $insertData);
						}
					}
				} 
				
				echo json_encode(array('flag'=>1, 'msg'=>"NGO Information Added."));
				exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function companyPostForm1(){
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		if(isset($_POST) && $_POST != ''){
			//echo '<pre>'; print_r($_POST);exit;
			$filename_add_proof_db = '';
			$allowed = array('jpg','jpeg','png');
			$allowed1 = array('jpg','jpeg','png','pdf');
			
			$filename = $_FILES['companyLogo']['name'];
			$filesize_logo = $_FILES['companyLogo']['size'];
			
			$filename_add_proof = $_FILES['companyAddProof']['name'];
			$filesize_add_proof = $_FILES['companyAddProof']['size'];
			
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));			
			$ext_add_proof = strtolower(pathinfo($filename_add_proof, PATHINFO_EXTENSION));
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if(empty($_POST['companyName']) || empty($_POST['companyAddress1']) || empty($_POST['companyCity']) || empty($_POST['companyDistrict']) || empty($_POST['companyState']) || empty($_POST['companyOrgType']) || empty($_POST['companyAbout'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
				exit;
			}
			else if(!preg_match('/^[1-9][0-9]{5}$/', $_POST['companyPincode']) || empty($_POST['companyPincode'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter valid pincode."));exit;
			
			}else if(!empty($filename) && !in_array($ext, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename) && $filesize_logo > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename."));
				exit;
			}else if(!empty($filename_add_proof) && !in_array($ext_add_proof, $allowed1)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename_add_proof) && $filesize_add_proof > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_add_proof."));
				exit;
			}else{

				$UserCompanyDetails =$this->CompanyModel->GetUserCompanyInfo($_POST['UserId_form1']);
				if(isset($UserCompanyDetails) && $UserCompanyDetails->id!=''){	

					echo json_encode(array('flag'=>0, 'msg'=>"User already registered with company."));
					exit;
				}


				if(isset($_FILES['companyLogo']['name']) && !empty($_FILES['companyLogo']['name'])) { 

					$file_name = $_FILES['companyLogo']['name'];
					$filename = $_POST['UserId_form1'].'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
					$config['upload_path'] = COMPANY_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $_POST['UserId_form1'].'-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('companyLogo')){
			          $uploadData = $this->upload->data();
			          $filename = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}

			    }
				
				if(isset($_FILES['companyAddProof']['name']) && !empty($_FILES['companyAddProof']['name'])) { 

					$file_name = $_FILES['companyAddProof']['name'];
					$filename_add_proof_db = $_POST['UserId_form1'].'-'.'ADD-PROOF'.'.'.$ext;
					$config['upload_path'] = COMPANY_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $_POST['UserId_form1'].'-'.'ADD-PROOF';

					//Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('companyAddProof')){
			          $uploadData = $this->upload->data();
			           $filename_add_proof_db = $uploadData['file_name'];
			      	}else {
			      	echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
					exit;
			      	}
				}

				$insert_corporate_details = array( 
					'user_id' 				=> $_POST['UserId_form1'], 
					'company_logo'	  		=> $filename,
					'company_name'			=> $_POST['companyName'], 
					'company_address_1'	 	=> $_POST['companyAddress1'],
					'company_address_2'	 	=> $_POST['companyAddress2'],
					'address_proof'	  		=> $filename_add_proof_db,
					'city'	   				=> $_POST['companyCity'],
					'district'	   			=> $_POST['companyDistrict'],
					'pincode'	   			=> $_POST['companyPincode'],
					'state'	   				=> $_POST['companyState'],
					'about_company' 		=> $_POST['companyAbout'], 
					'company_org_type'	   	=> $_POST['companyOrgType'],
					'created_at'	   => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->insert('corporate_details', $insert_corporate_details);

				$corporateId = $this->db->insert_id();

				$updatedata = array( 
					'status' => 3, 
					'type'	 => 2,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id', $_POST['UserId_form1']);
				$this->db->update('users', $updatedata);
                
                $updatedata1 = array( 
					'role_id'	 => 2,
					'updated_at' => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id', $_POST['UserId_form1']);
				$this->db->update('user_role_lnk', $updatedata1);
				

				echo json_encode(array('flag'=>1, 'msg'=>"", 'currentInsertId'=>$corporateId));
				exit;

			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}	

	}

	public function companyPostForm2() {
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		$id = $_SESSION['UserId'];
		$filename_gst_db = "";

		if(isset($_POST) && $_POST != '' && isset($_FILES) && $_FILES != '') {

			$allowed = array('jpg','jpeg','pdf','png');
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
			
			if(empty($_POST['cin_certificate_number']) || empty($_POST['pan_card_number']) || empty($_FILES['cin_certificate_file']['name']) || empty($_FILES['pan_card_file']['name'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
				exit;
			}elseif(!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_cin."));
				exit;
			}elseif(!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_gst."));
				exit;
			}elseif(!empty($filename_pan) && !in_array($ext_pan, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			// }else if( !preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['cin_certificate_number'])){
				// echo json_encode(array('flag'=>0, 'msg'=>"Invalid CIN Number"));
				// exit;

			}else if(!empty($filename_pan) && $filesize_pan > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_pan."));
				exit;
			}else if( !preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['pan_card_number'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid PAN Number"));
				exit;

			}else if(!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['gst_certificate_number']) && !empty($_POST['gst_certificate_number'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid GST Number"));
				exit;

			}else{

				if(isset($_FILES['cin_certificate_file']['name']) && !empty($_FILES['cin_certificate_file']['name'])) {
					$filename_cin_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN.'.$ext_cin;
					$config['upload_path'] = COMPANY_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN';

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('cin_certificate_file')){
			          $uploadData = $this->upload->data();
			          $filename_cin_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				$filename_gst_db='';
				if(isset($_FILES['gst_certificate_file']['name']) && !empty($_FILES['gst_certificate_file']['name'])) {
					$filename_gst_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST.'.$ext_gst;
					$config['upload_path'] = COMPANY_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST';

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('gst_certificate_file')){
			          $uploadData = $this->upload->data();
			          $filename_gst_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				if(isset($_FILES['pan_card_file']['name']) && !empty($_FILES['pan_card_file']['name'])) {
					$filename_pan_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN.'.$ext_pan;
					$config['upload_path'] = COMPANY_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN';

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('pan_card_file')){
			          $uploadData = $this->upload->data();
			          $filename_pan_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}


				$update_corporate_details = array( 
						'cin_no' 	=> base64_encode($_POST['cin_certificate_number']), 
						'cin_file'	=> $filename_cin_db,
						'gst_no' 	=> base64_encode($_POST['gst_certificate_number']), 
						'gst_file'	=> $filename_gst_db,
						'pan_no'	=> base64_encode($_POST['pan_card_number']),
						'pan_file'  => $filename_pan_db, 
						'updated_at'=> strtotime(date('Y-m-d H:i:s')),
					);
				$this->db->where('id',$_POST['step_2_current_id']);
				$this->db->update('corporate_details', $update_corporate_details);

				echo json_encode(array('flag'=>1, 'msg'=>""));
				exit;

		}
	}else{
		echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
		exit;
	}

}	

	public function companyPostForm3()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if(isset($_POST) && $_POST != ''){
				
			$fullName=isset($_POST['fullName'])?$_POST['fullName']:array();
			$fullName_arr=array_values(array_filter($fullName));
			
			$email=isset($_POST['email'])?$_POST['email']:array();
			$email_arr=array_values(array_filter($email));

			$contactNo=isset($_POST['contactNo'])?$_POST['contactNo']:array();
			$contactNo_arr=array_values(array_filter($contactNo));
			
			$hiddenPhotograph=isset($_POST['hiddenPhotograph'])?$_POST['hiddenPhotograph']:array();
			//echo array_sum($milestoneBudget);exit;
			
			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			
			//if(empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])){
			if(empty($_POST['fullName'] && $_POST['email'] && $_POST['contactNo'] && $_POST['hiddenPhotograph'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
				
			}else if(count(array_filter($fullName)) != count($fullName)){
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;
				
			}else if(count(array_filter($email)) != count($email)){
				
				echo json_encode(array('flag'=>0, 'msg'=>"email is empty."));exit;
				
			}else if(count(array_filter($contactNo)) != count($contactNo)){
				
				echo json_encode(array('flag'=>0, 'msg'=>"contact Number is empty."));exit;
				
			}else if(count(array_filter($hiddenPhotograph)) != count($hiddenPhotograph)){
				
				echo json_encode(array('flag'=>0, 'msg'=>"Photograph is empty."));exit;
				
			// if(empty($_POST['fullName'])){
			// 	echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
				
			// }
			// /*else if(count(array_filter($fullName)) != count($fullName) || count(array_filter($email)) != count($email) || count(array_filter($contactNo)) != count($contactNo)){*/
			// else if(count(array_filter($fullName)) != count($fullName)){
			// 	//echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
			// 	echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;
				
			}else{
				$companyDetails = $this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				$boardMembersData	= $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);
				
				if($_FILES['photograph']['name'] != ''){
					
					$files = $_FILES['photograph'];
					
					for($count = 0; $count<count($_FILES["photograph"]["name"]); $count++)
					{
						if($files['name'][$count] != ''  && $files['error'][$count] == 0){
							
							$_FILES['file']['name']= $file_name = $files['name'][$count];
							$_FILES['file']['type']= $files['type'][$count];
							$_FILES['file']['tmp_name']= $files['tmp_name'][$count];
							$_FILES['file']['error']= $files['error'][$count];
							$_FILES['file']['size']= $files['size'][$count];
							
							if($_FILES["file"]["size"] > $filesize){
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above $size for ".$_FILES["file"]["name"]));
								exit;
							}
							
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $companyDetails->id.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
							$config['upload_path'] = COMPANY_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							
							$config['file_name'] = $companyDetails->id.'-'.strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('file')){
							  $uploadData = $this->upload->data();
							  //print_r($uploadData);
							
								$fullNameVal	= $fullName_arr[$count];
								// $emailVal	= $email_arr[$count];
								// $contactNoVal	= $contactNo_arr[$count];
								$emailVal	= $email[$count];
								$contactNoVal	= $contactNo[$count];
								
								$insertData=array(  'corporate_id'		=> $companyDetails->id,
													'full_name'		=> $fullNameVal,
													'email'			=> $emailVal,
													'phone_no'		=> $contactNoVal,
													'photograph'	=> $uploadData['file_name'],
													'created_at'	=> strtotime(date('Y-m-d H:i:s')),
													);
													
								$this->db->insert('corporate_board_members', $insertData);
							}else {
								echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
								exit;
							}
						}else{
							$fullNameVal	= $fullName_arr[$count];
							// $emailVal	= $email_arr[$count];
							// $contactNoVal	= $contactNo_arr[$count];
							$emailVal	= $email[$count];
							$contactNoVal	= $contactNo[$count];
								
							$insertData=array(  'corporate_id'		=> $companyDetails->id,
												'full_name'		=> $fullNameVal,
												'email'			=> $emailVal,
												'phone_no'		=> $contactNoVal,
												//'photograph'	=> $uploadData['file_name'],
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
												);
												
							$this->db->insert('corporate_board_members', $insertData);
						}
					}
				} 
				
				echo json_encode(array('flag'=>1, 'msg'=>"Company Information Added."));
				exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function companyEditForm1(){
	
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		//print_r($_POST);exit;
		$filename = "";
		$filename_add_proof_db = "";

		if(isset($_POST) && $_POST != ''){

			$allowed = array('jpg','jpeg','png');
			$allowed1 = array('jpg','jpeg','png','pdf');
			
			$filename = $_FILES['companyLogo']['name'];
			$filesize_logo = $_FILES['companyLogo']['size'];
			
			$filename_add_proof = $_FILES['companyAddProof']['name'];
			$filesize_add_proof = $_FILES['companyAddProof']['size'];
			
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$ext_add_proof = strtolower(pathinfo($filename_add_proof, PATHINFO_EXTENSION));
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if(empty($_POST['companyName']) || empty($_POST['companyAddress1']) || empty($_POST['companyOrgType']) || empty($_POST['companyAbout'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
				exit;
			}else if(!empty($filename) && !in_array($ext, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename) && $filesize_logo > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename."));
				exit;
			}else if(!empty($filename_add_proof) && !in_array($ext_add_proof, $allowed1)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename_add_proof) && $filesize_add_proof > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_add_proof."));
				exit;
			}else{

				if($_POST['companyLogoHidden'] !="")
				{
					$filename = $_POST['companyLogoHidden'];
				}

				if(isset($_FILES['companyLogo']['name']) && !empty($_FILES['companyLogo']['name'])) { 

					$file_name = $_FILES['companyLogo']['name'];
					$filename = $_POST['UserId_form1'].'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
					$config['upload_path'] = COMPANY_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $_POST['UserId_form1'].'-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('companyLogo')){
			          $uploadData = $this->upload->data();
			          $filename = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}

			    }
				
				if($_POST['companyAddProofHidden'] !="")
				{
					$filename_add_proof_db = $_POST['companyAddProofHidden'];
				}
				
				if(isset($_FILES['companyAddProof']['name']) && !empty($_FILES['companyAddProof']['name'])) { 

					$file_name = $_FILES['companyAddProof']['name'];
					$filename_add_proof_db = $_POST['UserId_form1'].'-'.'ADD-PROOF'.'.'.$ext;
					$config['upload_path'] = COMPANY_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $_POST['UserId_form1'].'-'.'ADD-PROOF';

					//Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('companyAddProof')){
			          $uploadData = $this->upload->data();
			           $filename_add_proof_db = $uploadData['file_name'];
			      	}else {
			      	echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
					exit;
			      	}
				}

				$update_corporate_details = array( 
					
					'company_logo'	    => $filename,
					'company_name' 		=> $_POST['companyName'], 
					'company_address_1'	=> $_POST['companyAddress1'],
					'company_address_2'	=> $_POST['companyAddress2'],
					'address_proof'	    => $filename_add_proof_db,
					'city'	   			=> $_POST['companyCity'],
					'district'	   		=> $_POST['companyDistrict'],
					'pincode'	   		=> $_POST['companyPincode'],
					'state'	   			=> $_POST['companyState'],
					'about_company' 	=> $_POST['companyAbout'], 
					'company_org_type'	=> $_POST['companyOrgType'],
					'updated_at'	    => strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('id',$_POST['step_1_current_id']);
				$this->db->update('corporate_details', $update_corporate_details);

				echo json_encode(array('flag'=>1, 'msg'=>""));
				exit;

			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}	

	}	

	public function companyEditForm2() {
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		//print_r($_POST);exit;
		$id = $_SESSION['UserId'];
		$filename_cin_db = "";
		$filename_gst_db = "";
		$filename_pan_db = "";

		if(isset($_POST) && $_POST != '') {

			$allowed = array('jpg','jpeg','pdf','png');
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

			if(empty($_POST['cin_certificate_number']) || empty($_POST['pan_card_number']))
			{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
				exit;
			}
			elseif(empty($_FILES['cin_certificate_file']['name'] ) && $_POST['cin_certificate_fileHidden'] ==""){
				//if(){
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
					exit;
				//}

			}elseif(empty($_FILES['pan_card_file']['name'] ) && $_POST['pan_card_fileHidden'] ==""){
				//if($_POST['pan_card_fileHidden'] ==""){
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
					exit;
				//}
			}
			elseif(!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_cin."));
				exit;
			}elseif(!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_gst."));
				exit;
			}elseif(!empty($filename_pan) && !in_array($ext_pan, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			// }else if( !preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['cin_certificate_number'])){
				// echo json_encode(array('flag'=>0, 'msg'=>"Invalid CIN Number"));
				// exit;

			}else if(!empty($filename_pan) && $filesize_pan > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_pan."));
				exit;
			}else if( !preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['pan_card_number'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid PAN Number"));
				exit;

			}else if(!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['gst_certificate_number']) && !empty($_POST['gst_certificate_number'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid GST Number"));
				exit;

			}else{

				if($_POST['cin_certificate_fileHidden'] !="")
				{
					$filename_cin_db = $_POST['cin_certificate_fileHidden'];
				}

				if(isset($_FILES['cin_certificate_file']['name']) && !empty($_FILES['cin_certificate_file']['name'])) {
					$filename_cin_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN.'.$ext_cin;
					$config['upload_path'] = COMPANY_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN';

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('cin_certificate_file')){
			          $uploadData = $this->upload->data();
			          $filename_cin_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				if($_POST['gst_certificate_fileHidden'] !="")
				{
					$filename_gst_db = $_POST['gst_certificate_fileHidden'];
				}

				if(isset($_FILES['gst_certificate_file']['name']) && !empty($_FILES['gst_certificate_file']['name'])) {
					$filename_gst_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST.'.$ext_gst;
					$config['upload_path'] = COMPANY_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST';

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('gst_certificate_file')){
			          $uploadData = $this->upload->data();
			          $filename_gst_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				if($_POST['pan_card_fileHidden'] !="")
				{
					$filename_pan_db = $_POST['pan_card_fileHidden'];
				}

				if(isset($_FILES['pan_card_file']['name']) && !empty($_FILES['pan_card_file']['name'])) {
					$filename_pan_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN.'.$ext_pan;
					$config['upload_path'] = COMPANY_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN';

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('pan_card_file')){
			          $uploadData = $this->upload->data();
			          $filename_pan_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				

				$update_corporate_details = array( 
						'cin_no' 	=> base64_encode($_POST['cin_certificate_number']), 
						'cin_file'	=> $filename_cin_db,
						'gst_no' 	=> base64_encode($_POST['gst_certificate_number']), 
						'gst_file'	=> $filename_gst_db,
						'pan_no'	=> base64_encode($_POST['pan_card_number']),
						'pan_file'  => $filename_pan_db, 
						'updated_at'=> strtotime(date('Y-m-d H:i:s')),
					);
				$this->db->where('id',$_POST['step_2_current_id']);
				$this->db->update('corporate_details', $update_corporate_details);

				echo json_encode(array('flag'=>1, 'msg'=>""));
				exit;

		}
	}else{
		echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
		exit;
	}

}
	
	public function companyEditForm3()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if(isset($_POST) && $_POST != ''){
				
			$fullName=isset($_POST['fullName'])?$_POST['fullName']:array();
			$fullName_arr=array_values(array_filter($fullName));
			
			$email=isset($_POST['email'])?$_POST['email']:array();
			$email_arr=array_values(array_filter($email));

			$contactNo=isset($_POST['contactNo'])?$_POST['contactNo']:array();
			$contactNo_arr=array_values(array_filter($contactNo));
			
			$hiddenPhotograph=isset($_POST['hiddenPhotograph'])?$_POST['hiddenPhotograph']:array();
			//echo array_sum($milestoneBudget);exit;
			
			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			
			//if(empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])){
			if(empty($_POST['fullName'] && $_POST['email'] && $_POST['contactNo'] )){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
				
			}else if(count(array_filter($fullName)) != count($fullName)){
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;
				
			}else if(count(array_filter($email)) != count($email)){
				
				echo json_encode(array('flag'=>0, 'msg'=>"email is empty."));exit;
				
			}else if(count(array_filter($contactNo)) != count($contactNo)){
				
				echo json_encode(array('flag'=>0, 'msg'=>"contact Number is empty."));exit;
				
			}else if(count(array_filter($hiddenPhotograph)) != count($hiddenPhotograph)){
				
				echo json_encode(array('flag'=>0, 'msg'=>"Photograph is empty."));exit;
				
			}else{
				$companyDetails = $this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				$boardMembersData	= $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);
				
				$deleted_member_ids = isset($_POST['deleted_member_ids'])?$_POST['deleted_member_ids']:'';
			
				//$deleted_member_ids_arr =  array_values(array_filter($deleted_member_ids));
				//echo count($deleted_member_ids_arr);
				//print_r($deleted_member_ids_arr);
				
				if(isset($deleted_member_ids) && $deleted_member_ids != '')
				{
					$deleted_member_ids_arr = explode(",",$deleted_member_ids);
					foreach($deleted_member_ids_arr as $id){
						$record = $this->db->get_where('corporate_board_members', array('id'=>$id))->num_rows(); 
						
						if($record>0){
							//echo $id;
							$this->db->where('id',$id);
							$this->db->delete('corporate_board_members');
							//print_r($this->db->last_query());
						}
					}
				}
				
				if(isset($hiddenPhotograph) && count($hiddenPhotograph)>0){
					$photographArr = array_filter($_FILES['photograph']['name']);
					
					$resultDeleteArray=array_intersect_key($hiddenPhotograph,$photographArr);
					
					if(isset($resultDeleteArray) && count($resultDeleteArray)>0){
						foreach($resultDeleteArray as $key=>$value){
							
							$delPhotoId = $_POST['hiddenPhotographId'][$key]; 
							
							$this->db->where('id',$delPhotoId);
							$this->db->delete('corporate_board_members');
							
						}
					}
					
					$resultUpdateArray=array_diff_key($hiddenPhotograph,$photographArr);
					if(isset($resultUpdateArray) && count($resultUpdateArray)>0){
						
						foreach($resultUpdateArray as $key=>$value){
							
							$fullNameVal	= $fullName_arr[$key];
							// $emailVal	= $email_arr[$key];
							// $contactNoVal	= $contactNo_arr[$key];
							$emailVal	= $email[$key];
							$contactNoVal	= $contactNo[$key];
							$photoId = $_POST['hiddenPhotographId'][$key]; 
							$hiddenPhotoVal = $_POST['hiddenPhotograph'][$key]; 
							
							$updateData=array(  'corporate_id'	=> $companyDetails->id,
												'full_name'		=> $fullNameVal,
												'email'			=> $emailVal,
												'phone_no'		=> $contactNoVal,
												'photograph'	=> $hiddenPhotoVal,
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
												);
							//print_r($insertData2);	
							$this->db->where('id',$photoId);					
							$this->db->update('corporate_board_members', $updateData);
						}
										
					}
				}
				
				if($_FILES['photograph']['name'] != ''){
					
					$files = $_FILES['photograph'];
					
					for($count = 0; $count<count($_FILES["photograph"]["name"]); $count++)
					{
						$fullNameVal	= $fullName_arr[$count];
						// $emailVal	= $email_arr[$count];
						// $contactNoVal	= $contactNo_arr[$count];
						$emailVal	= $email[$count];
						$contactNoVal	= $contactNo[$count];

						$photoId = isset($_POST['hiddenPhotographId'][$count])?$_POST['hiddenPhotographId'][$count]:''; 
						$hiddenPhotoVal = isset($_POST['hiddenPhotograph'][$count])?$_POST['hiddenPhotograph'][$count]:''; 
						
						if($files['name'][$count] != ''  && $files['error'][$count] == 0){
							
							$_FILES['file']['name']= $file_name = $files['name'][$count];
							$_FILES['file']['type']= $files['type'][$count];
							$_FILES['file']['tmp_name']= $files['tmp_name'][$count];
							$_FILES['file']['error']= $files['error'][$count];
							$_FILES['file']['size']= $files['size'][$count];
							
							if($_FILES["file"]["size"] > $filesize){
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above $size for ".$_FILES["file"]["name"]));
								exit;
							}
							
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $companyDetails->id.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
							$config['upload_path'] = COMPANY_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							
							$config['file_name'] = $companyDetails->id.'-'.strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('file')){
							  $uploadData = $this->upload->data();
							  //print_r($uploadData);
							
								if((!empty($photoId) && empty($hiddenPhotoVal)) || empty($photoId)){
									$insertData=array(  'corporate_id'		=> $companyDetails->id,
														'full_name'		=> $fullNameVal,
														'email'			=> $emailVal,
														'phone_no'		=> $contactNoVal,
														'photograph'	=> $uploadData['file_name'],
														'created_at'	=> strtotime(date('Y-m-d H:i:s')),
														);
														
									$this->db->insert('corporate_board_members', $insertData);
								}
							}else {
								echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
								exit;
							}
						}else{
							if(empty($photoId)){
								// echo $foundedByVal.'22222';
								$insertData=array(  'corporate_id'		=> $companyDetails->id,
													'full_name'		=> $fullNameVal,
													'email'			=> $emailVal,
													'phone_no'		=> $contactNoVal,
													//'photograph'	=> $uploadData['file_name'],
													'created_at'	=> strtotime(date('Y-m-d H:i:s')),
													);
													
								$this->db->insert('corporate_board_members', $insertData);
							}
						}
					}
				} 
				
				echo json_encode(array('flag'=>1, 'msg'=>"Company Information Updated."));
				exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function ngoEditForm1(){
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
	    $id = $_SESSION['UserId'];
		$filename = "";
		$filename_add_proof_db = "";
		//print_r($_POST);print_r($_FILES);exit;
		if(isset($_POST) && $_POST != ''){
			$data = array();
			$orgSector_arr = array();
			$orgSector = '';
			
			$allowed = array('jpg','jpeg','png');
			$allowed1 = array('jpg','jpeg','png','pdf');
			
			$filename = $_FILES['orgLogo']['name'];
			$filesize_logo = $_FILES['orgLogo']['size'];
			
			$filename_add_proof = $_FILES['orgAddProof']['name'];
			$filesize_add_proof = $_FILES['orgAddProof']['size'];
			
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$ext_add_proof = strtolower(pathinfo($filename_add_proof, PATHINFO_EXTENSION));
			
			$orgSector_arr = isset($_POST['orgSector'])?$_POST['orgSector']:array();
			
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
			
			if(empty($_POST['orgName']) || empty($_POST['orgAddress1']) || empty($_POST['orgAddress2']) || empty($_POST['orgCity']) || empty($_POST['orgDistrict']) || empty($_POST['orgState']) || empty($_POST['orgType']) || empty($_POST['orgLocation']) || empty($_POST['orgDateIncorporation']) || empty($_POST['orgSector'])){
				
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;

			} else if(!empty($_POST['orgDateIncorporation']) && !preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$_POST['orgDateIncorporation'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Date format is incorrect."));exit;
				
			} else if(count($orgSector_arr)<=0)	{
				echo json_encode(array('flag'=>0, 'msg'=>"Please select at least one sector."));exit;
				
			} else if(!preg_match('/^[1-9][0-9]{5}$/', $_POST['orgPincode']) || empty($_POST['orgPincode'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter valid pincode."));exit;
			
			}else if(!empty($filename) && !in_array($ext, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename) && $filesize_logo > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename."));
				exit;
			}else if(!empty($filename_add_proof) && !in_array($ext_add_proof, $allowed1)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));exit;
				
			}else if(!empty($filename_add_proof) && $filesize_add_proof > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_add_proof."));
				exit;
			}else{
				if($_POST['orgLogoHidden'] !="")
				{
					$filename = $_POST['orgLogoHidden'];
				}
				
				if(isset($_FILES['orgLogo']['name']) && !empty($_FILES['orgLogo']['name'])) { 

					$file_name = $_FILES['orgLogo']['name'];
					$filename = $id.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
					$config['upload_path'] = NGO_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s'));

				//Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('orgLogo')){
			          $uploadData = $this->upload->data();
			          $filename = $uploadData['file_name'];
			      	}else {
			      	echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
					exit;
			      	}
				}
				
				if($_POST['orgAddProofHidden'] !="")
				{
					$filename_add_proof_db = $_POST['orgAddProofHidden'];
				}
				
				if(isset($_FILES['orgAddProof']['name']) && !empty($_FILES['orgAddProof']['name'])) { 

					$file_name = $_FILES['orgAddProof']['name'];
					$filename_add_proof_db = $id.'-'.'ADD-PROOF'.'.'.$ext;
					$config['upload_path'] = NGO_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-'.'ADD-PROOF';

					//Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('orgAddProof')){
			          $uploadData = $this->upload->data();
			           $filename_add_proof_db = $uploadData['file_name'];
			      	}else {
			      	echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
					exit;
			      	}
				}
				
				if(isset($_POST['orgSector'])){
					$orgSector = implode(',',$orgSector_arr);
					$orgSector = ','.$orgSector.',';					
				}

		      	$update_ngo_details = array( 					
					'org_logo'	   			=> $filename,
					'org_name' 				=> $_POST['orgName'], 
					'org_address_line1'		=> $_POST['orgAddress1'],
					'org_address_line2'		=> $_POST['orgAddress2'],
					'website'				=> $_POST['orgWebsite'],
					'address_proof'	   		=> $filename_add_proof_db,
					'city'	   				=> $_POST['orgCity'],
					'district'	   			=> $_POST['orgDistrict'],
					'pincode'	   			=> $_POST['orgPincode'],
					'state'	   				=> $_POST['orgState'],
					'about_org'	   			=> $_POST['orgAbout'],
					'org_type'	   			=> $_POST['orgType'],
					'org_location_operation'=> $_POST['orgLocation'],
					'date_incorporation' 	=> strtotime($_POST['orgDateIncorporation']), 
					'sector_operation' 		=> $orgSector,
					'updated_at'	   		=> strtotime(date('Y-m-d H:i:s')),
				);				
				$this->db->where('user_id',$id);				
				$this->db->update('ngo_details', $update_ngo_details);				
				
				
				echo json_encode(array('flag'=>1, 'msg'=>""));
				exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
					exit;
		}	

	}
	
	public function ngoEditForm2()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		//print_r($_POST);exit;
		$id = $_SESSION['UserId'];
		$filename_cin_db = '';
		$filename_gst_db = '';
		$filename_pan_db = '';
		$filename_80g_db = '';	
		$filename_fcra_db = '';
		$filename_35ac_db = '';
		$filename_12a_db = '';
		$filename_trustee_db = '';
		$filename_stamp_db = '';
		$filename_sign_db = '';
		$filename_csr_db = '';
		
		
		if(isset($_POST) && $_POST != '')
		{
			$allowed = array('jpg','jpeg','pdf','png');
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
			
			//echo $filesize;
			if(empty($_POST['org_cin_number']) || empty($_POST['org_pan_number']) || empty($_POST['org_12a_number'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
				exit;
			} elseif((empty($_FILES['org_cin_file']['name'] ) && $_POST['org_cin_fileHidden'] =="") || (empty($_FILES['org_pan_file']['name'] ) && $_POST['org_pan_fileHidden'] =="") || (empty($_FILES['org_12a_file']['name'] ) && $_POST['org_12a_fileHidden'] =="") || (empty($_FILES['officialseal_file']['name'] ) && $_POST['officialseal_fileHidden'] =="") || (empty($_FILES['signature_file']['name'] ) && $_POST['signature_fileHidden'] =="")){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
				exit;
			} else if(!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			} else if(!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_cin."));
				exit;
			}else if(!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			} else if(!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_gst."));
				exit;
			}else if(!empty($filename_pan) && !in_array($ext_pan, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_pan) && $filesize_pan > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_pan."));
				exit;
			}else if(!empty($filename_80g) && !in_array($ext_80g, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_80g) && $filesize_80g > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_80g."));
				exit;
			}else if(!empty($filename_fcra) && !in_array($ext_fcra, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_fcra) && $filesize_fcra > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_fcra."));
				exit;
			} else if(!empty($filename_35ac) && !in_array($ext_35ac, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_35ac) && $filesize_35ac > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_35ac."));
				exit;
			} else if(!empty($filename_12a) && !in_array($ext_12a, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			// } else if( !preg_match("/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/i", $_POST['org_cin_number'])){
				// echo json_encode(array('flag'=>0, 'msg'=>"Invalid CIN Number"));
				// exit;

			} else if(!empty($filename_12a) && $filesize_12a > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_12a."));
				exit;
			}else if(!empty($filename_trustee) && !in_array($ext_trustee, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_trustee) && $filesize_trustee > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_trustee."));
				exit;
			} else if( !preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['org_pan_number'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid PAN Number"));
				exit;
			}else if(!empty($filename_stamp) && !in_array($ext_stamp, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				exit;
			}else if(!empty($filename_stamp) && $filesize_stamp > $filesizess) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $sizess for $filename_stamp."));
				exit;
			}else if(!empty($filename_sign) && !in_array($ext_sign, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				exit;
			}else if(!empty($filename_sign) && $filesize_sign > $filesizess) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $sizess for $filename_sign."));
				exit;
			}else if(!empty($filename_csr) && !in_array($ext_csr, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_csr) && $filesize_csr > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_csr."));
				exit;
			} else if( !preg_match("/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/i", $_POST['org_pan_number'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid PAN Number"));
				exit;
			}
			// else if(!preg_match("/^[A-Za-z0-9]+$/", $_POST['csr_number'])) {
			// 	echo json_encode(array('flag'=>0, 'msg'=>"Invalid CSR Number"));
			// 	exit;

			// } 
			// code commented here by Neerajkumar by 22-04-2022
			else {
				
				if($_POST['org_cin_fileHidden'] !="")
				{
					$filename_cin_db = $_POST['org_cin_fileHidden'];
				}
				if(isset($_FILES['org_cin_file']['name']) && !empty($_FILES['org_cin_file']['name'])) {
					$filename_cin_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN.'.$ext_cin;
					$config['upload_path'] = NGO_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_cin_file')){
			          $uploadData = $this->upload->data();
					  $filename_cin_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_gst_fileHidden'] !="")
				{
					$filename_gst_db = $_POST['org_gst_fileHidden'];
				}
				if(isset($_FILES['org_gst_file']['name']) && !empty($_FILES['org_gst_file']['name'])) {
					$filename_gst_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST.'.$ext_gst;
					$config['upload_path'] = NGO_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-GST';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_gst_file')){
			          $uploadData = $this->upload->data();
					  $filename_gst_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_pan_fileHidden'] !="")
				{
					$filename_pan_db = $_POST['org_pan_fileHidden'];
				}
				if(isset($_FILES['org_pan_file']['name']) && !empty($_FILES['org_pan_file']['name'])) {
					$filename_pan_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN.'.$ext_pan;
					$config['upload_path'] = NGO_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
			      	if($this->upload->do_upload('org_pan_file')){
			          $uploadData = $this->upload->data();
					  $filename_pan_db = $uploadData['file_name'];
					 } else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_80g_fileHidden'] !="")
				{
					$filename_80g_db = $_POST['org_80g_fileHidden'];
				}
				if(isset($_FILES['org_80g_file']['name']) && !empty($_FILES['org_80g_file']['name'])) {
					$filename_80g_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-80G.'.$ext_80g;
					$config['upload_path'] = NGO_80G_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-80G';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_80g_file')){
			          $uploadData = $this->upload->data(); 
						$filename_80g_db = $uploadData['file_name'];					  
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_fcra_fileHidden'] !="")
				{
					$filename_fcra_db = $_POST['org_fcra_fileHidden'];
				}
				if(isset($_FILES['org_fcra_file']['name']) && !empty($_FILES['org_fcra_file']['name'])) {
					$filename_fcra_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-FCRA.'.$ext_fcra;
					$config['upload_path'] = NGO_FCRA_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';	
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-FCRA';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('org_fcra_file')){
			          $uploadData = $this->upload->data();
					  $filename_fcra_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}			
				
				if($_POST['org_35ac_fileHidden'] !="")
				{
					$filename_35ac_db = $_POST['org_35ac_fileHidden'];
				}
				if(isset($_FILES['org_35ac_file']['name']) && !empty($_FILES['org_35ac_file']['name'])) {
					$filename_35ac_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-35AC.'.$ext_35ac;
					$config['upload_path'] = NGO_35AC_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-35AC';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_35ac_file')){
			          $uploadData = $this->upload->data(); 
					  $filename_35ac_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_12a_fileHidden'] !="")
				{
					$filename_12a_db = $_POST['org_12a_fileHidden'];
				}
				if(isset($_FILES['org_12a_file']['name']) && !empty($_FILES['org_12a_file']['name'])) {
					$filename_12a_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-12A.'.$ext_12a;
					$config['upload_path'] = NGO_12A_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-12A';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('org_12a_file')){
			          $uploadData = $this->upload->data(); 
                      $filename_12a_db = $uploadData['file_name'];					  
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_trustee_fileHidden'] !="")
				{
					$filename_trustee_db = $_POST['org_trustee_fileHidden'];
				}
				if(isset($_FILES['org_trustee_file']['name']) && !empty($_FILES['org_trustee_file']['name'])) {
					$filename_trustee_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-TRUSTEE.'.$ext_12a;
					$config['upload_path'] = NGO_TRUSTEE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-TRUSTEE';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('org_trustee_file')){
			          $uploadData = $this->upload->data(); 
                      $filename_trustee_db = $uploadData['file_name'];					  
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['csr_fileHidden'] !="")
				{
					$filename_csr_db = $_POST['csr_fileHidden'];
				}
				if(isset($_FILES['csr_file']['name']) && !empty($_FILES['csr_file']['name'])) {
					$filename_csr_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CSR'.$ext_csr;
					$config['upload_path'] = NGO_CSR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-CSR';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('csr_file')){
			          $uploadData = $this->upload->data(); 
                      $filename_csr_db = $uploadData['file_name'];					  
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['officialseal_fileHidden'] !="")
				{
					$filename_stamp_db = $_POST['officialseal_fileHidden'];
				}
				if(isset($_FILES['officialseal_file']['name']) && !empty($_FILES['officialseal_file']['name'])) {
					$filename_stamp_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-STAMP.'.$ext_stamp;
					$config['upload_path'] = NGO_STAMP_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-STAMP';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('officialseal_file')){
			          $uploadData = $this->upload->data();  
					  $filename_stamp_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['signature_fileHidden'] !="")
				{
					$filename_sign_db = $_POST['signature_fileHidden'];
				}
				if(isset($_FILES['signature_file']['name']) && !empty($_FILES['signature_file']['name'])) {
					$filename_sign_db = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-SIGNATURE.'.$ext_sign;
					$config['upload_path'] = NGO_SIGNATURE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
			       	$config['file_name'] = $id.'-'.strtotime(date('Y-m-d H:i:s')).'-SIGNATURE';
			        //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);
					
			      	if($this->upload->do_upload('signature_file')){
			          $uploadData = $this->upload->data();  
					  $filename_sign_db = $uploadData['file_name'];	
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}

				$update_ngo_documents_details = array( 
					'cin_no' 	=> base64_encode($_POST['org_cin_number']),
					'cin_file'	=> $filename_cin_db,
					'gst_no' 	=> base64_encode($_POST['org_gst_number']),
					'gst_file'	=> $filename_gst_db,
					'pan_no'	=> base64_encode($_POST['org_pan_number']),
					'pan_file'  => $filename_pan_db,
					'org_80g_no'	=> base64_encode($_POST['org_80g_number']),
					'org_80g_file'  => $filename_80g_db,
					'fcra_no'	=> base64_encode($_POST['org_fcra_number']),
					'fcra_file'  => $filename_fcra_db,
					'org_35ac_no'	=> base64_encode($_POST['org_35ac_number']),
					'org_35ac_file'  => $filename_35ac_db,
					'org_12a_no'	=> base64_encode($_POST['org_12a_number']),
					'org_12a_file'  => $filename_12a_db,
					'org_trustee_no'	=> base64_encode($_POST['org_trustee_number']),
					'org_trustee_file'  => $filename_trustee_db,
					'officialseal_file'  => $filename_stamp_db,
					'signature_file'  => $filename_sign_db,
					'csr_num'	=> base64_encode($_POST['csr_number']),
					'csr_file'  => $filename_csr_db,
					'updated_at'=> strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id',$id);

				$this->db->update('ngo_details', $update_ngo_documents_details);
				echo json_encode(array('flag'=>1, 'msg'=>""));

				exit;
			}
		}
		else
		{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
		
	}
	
	public function ngoEditForm3()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
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
		
		
		if(isset($_POST) && $_POST != '')
		{
			$primarySourceType_arr = isset($_POST['primarySourceType'])?$_POST['primarySourceType']:array();
			
			$allowed = array('jpg','jpeg','pdf','png');
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
			$date_incorporation= date('Y-m-d',$ngoDetails->date_incorporation);
			$today= date('Y-m-d');
			
			$d1 = new DateTime($date_incorporation);
			$d2 = new DateTime($today);
			
			//echo ($d1->diff($d2)->m); // int(4)
			$monthDiff = ($d1->diff($d2)->m + ($d1->diff($d2)->y*12));
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			
			/*if((empty($_POST['primarySourceType']) || empty($_POST['year1_net_worth']) || empty($_POST['year1_turnover']) || empty($_POST['year1_net_profit']) || (empty($_FILES['org_year_1_file']['name'] ) && $_POST['org_year_1_fileHidden'] == ""))&& $monthDiff > 18)
			{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
				exit;
			}else if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {*/
			
			if (empty($primarySourceType_arr)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter Primary Source Type."));
				exit;	
			}else if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year1) && $filesize_year1 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year1."));
				exit;
			}else if(!empty($filename_year2) && !in_array($ext_year2, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year2) && $filesize_year2 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year2."));
				exit;
			}else if(!empty($filename_year3) && !in_array($ext_year3, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year3) && $filesize_year3 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year3."));
				exit;
			}else if(!empty($filename_year4) && !in_array($ext_year4, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year4) && $filesize_year4 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year4."));
				exit;
			}else if(!empty($filename_year5) && !in_array($ext_year5, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year5) && $filesize_year5 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year5."));
				exit;
			}else if(!empty($filename_year6) && !in_array($ext_year6, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_year6) && $filesize_year6 > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_year6."));
				exit;
			}
			else
			{
				if(((!empty($_FILES['org_year_1_file']['name'] ) || $_POST['org_year_1_fileHidden'] != "")) || (empty($_POST['year1_net_worth']) && empty($_POST['year1_turnover']) && empty($_POST['year1_net_profit']) && (empty($_FILES['org_year_1_file']['name'] ) && $_POST['org_year_1_fileHidden'] == ""))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
					exit;
				}
				
				if(((!empty($_FILES['org_year_2_file']['name'] ) || $_POST['org_year_2_fileHidden'] != "")) || (empty($_POST['year2_net_worth']) && empty($_POST['year2_turnover']) && empty($_POST['year2_net_profit']) && (empty($_FILES['org_year_2_file']['name'] ) && $_POST['org_year_2_fileHidden'] == "")) ){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Second Year."));
					exit;
				}
				
				if(((!empty($_FILES['org_year_3_file']['name'] ) || $_POST['org_year_3_fileHidden'] != "")) || (empty($_POST['year3_net_worth']) && empty($_POST['year3_turnover']) && empty($_POST['year3_net_profit']) && (empty($_FILES['org_year_3_file']['name'] ) && $_POST['org_year_3_fileHidden'] == ""))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Third Year."));
					exit;
				}
				
				if(((!empty($_FILES['org_year_4_file']['name'] ) || $_POST['org_year_4_fileHidden'] != "")) || (empty($_POST['year4_net_worth']) && empty($_POST['year4_turnover']) && empty($_POST['year4_net_profit']) && (empty($_FILES['org_year_4_file']['name'] ) && $_POST['org_year_4_fileHidden'] == ""))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Forth Year."));
					exit;
				}
				
				if(((!empty($_FILES['org_year_5_file']['name'] ) || $_POST['org_year_5_fileHidden'] != "")) || (empty($_POST['year5_net_worth']) && empty($_POST['year5_turnover']) && empty($_POST['year5_net_profit']) && (empty($_FILES['org_year_5_file']['name'] ) && $_POST['org_year_5_fileHidden'] == ""))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Fifth Year."));
					exit;
				}
				
				if(((!empty($_FILES['org_year_6_file']['name'] ) || $_POST['org_year_6_fileHidden'] != "")) || (empty($_POST['year6_net_worth']) && empty($_POST['year6_turnover']) && empty($_POST['year6_net_profit']) && (empty($_FILES['org_year_6_file']['name'] ) && $_POST['org_year_6_fileHidden'] == ""))){
					
				}else{
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for Sixth Year."));
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
				
				if($_POST['org_year_1_fileHidden'] !="")
				{
					$filename_year1_db = $_POST['org_year_1_fileHidden'];
				}
				if(isset($_FILES['org_year_1_file']['name']) && !empty($_FILES['org_year_1_file']['name'])) {
					$filename_year1_db = $id.'-year1-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year1;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year1-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_1_file')){
			          $uploadData = $this->upload->data();
			          $filename_year1_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_year_2_fileHidden'] !="")
				{
					$filename_year2_db = $_POST['org_year_2_fileHidden'];
				}
				if(isset($_FILES['org_year_2_file']['name']) && !empty($_FILES['org_year_2_file']['name'])) {
					$filename_year2_db = $id.'-year2-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year2;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year2-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_2_file')){
			          $uploadData = $this->upload->data();
			          $filename_year2_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_year_3_fileHidden'] !="")
				{
					$filename_year3_db = $_POST['org_year_3_fileHidden'];
				}
				if(isset($_FILES['org_year_3_file']['name']) && !empty($_FILES['org_year_3_file']['name'])) {
					$filename_year3_db = $id.'-year3-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year3;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year3-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_3_file')){
			          $uploadData = $this->upload->data();
			          $filename_year3_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_year_4_fileHidden'] !="")
				{
					$filename_year4_db = $_POST['org_year_4_fileHidden'];
				}
				if(isset($_FILES['org_year_4_file']['name']) && !empty($_FILES['org_year_4_file']['name'])) {
					$filename_year4_db = $id.'-year4-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year4;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year4-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_4_file')){
			          $uploadData = $this->upload->data();
			          $filename_year4_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_year_5_fileHidden'] !="")
				{
					$filename_year5_db = $_POST['org_year_5_fileHidden'];
				}
				if(isset($_FILES['org_year_5_file']['name']) && !empty($_FILES['org_year_5_file']['name'])) {
					$filename_year5_db = $id.'-year5-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year5;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year5-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_5_file')){
			          $uploadData = $this->upload->data();
			          $filename_year5_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if($_POST['org_year_6_fileHidden'] !="")
				{
					$filename_year6_db = $_POST['org_year_6_fileHidden'];
				}
				if(isset($_FILES['org_year_6_file']['name']) && !empty($_FILES['org_year_6_file']['name'])) {
					$filename_year6_db = $id.'-year6-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year6;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $id.'-year6-'.strtotime(date('Y-m-d H:i:s'));

			       //Load upload library and initialize configuration
			      	$this->load->library('upload',$config);
			      	$this->upload->initialize($config);

			      	if($this->upload->do_upload('org_year_6_file')){
			          $uploadData = $this->upload->data();
			          $filename_year6_db = $uploadData['file_name'];
			      	} else {
			      		echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
			      	}
				}
				
				if(isset($_POST['primarySourceType'])){
					$primarySourceType = implode(',',$primarySourceType_arr);
					$primarySourceType = ','.$primarySourceType.',';					
				}
				
				if (date('m') >= 4 ) {
					$Y = date('Y') - 1;
				}
				else {
					$Y = date('Y') - 2;
				}
				
				$SY=$Y."-04-01";
				$pt = $Y+1;
				$EY=$pt."-03-31";
				
				$update_ngo_Financial_details = array( 
					'primary_source_type'=> $primarySourceType,
					'year1' 			=> date('Y', strtotime($SY)), 
					'year1_file'		=> $filename_year1_db,
					'year1_net_worth'	=> $year1_net_worth,
					'year1_turnover' 	=> $year1_turnover,
					'year1_net_profit' 	=> $year1_net_profit,
					'year2' 			=> date('Y', strtotime($SY))-1, 
					'year2_file'		=> $filename_year2_db,
					'year2_net_worth'	=> $year2_net_worth,
					'year2_turnover' 	=> $year2_turnover,
					'year2_net_profit' 	=> $year2_net_profit,
					'year3'				=> date('Y', strtotime($SY))-2, 
					'year3_file'  		=> $filename_year3_db,
					'year3_net_worth'	=> $year3_net_worth,
					'year3_turnover' 	=> $year3_turnover,
					'year3_net_profit' 	=> $year3_net_profit,
					'year4'				=> date('Y', strtotime($SY))-3, 
					'year4_file'  		=> $filename_year4_db,
					'year4_net_worth'	=> $year4_net_worth,
					'year4_turnover' 	=> $year4_turnover,
					'year4_net_profit' 	=> $year4_net_profit,
					'year5'				=> date('Y', strtotime($SY))-4, 
					'year5_file'  		=> $filename_year5_db,
					'year5_net_worth'	=> $year5_net_worth,
					'year5_turnover' 	=> $year5_turnover,
					'year5_net_profit' 	=> $year5_net_profit,
					'year6'				=> date('Y', strtotime($SY))-5, 
					'year6_file'  		=> $filename_year6_db,
					'year6_net_worth'	=> $year6_net_worth,
					'year6_turnover' 	=> $year6_turnover,
					'year6_net_profit' 	=> $year6_net_profit,
					'updated_at'		=> strtotime(date('Y-m-d H:i:s')),
				);
				$this->db->where('user_id',$id);
				$this->db->update('ngo_details', $update_ngo_Financial_details);				

				echo json_encode(array('flag'=>1, 'msg'=>""));
				exit;
			}
		}
		else
		{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}

	public function addMemberEntry()
	{
		if(isset($_SESSION['UserId'])) {
			
			$random_id=generateUniqueID(10,'Numeric');
			$data['random_id']=$random_id;
			$data['number']=$random_id;
			$data['team_member_counter']=$_POST['counter'];
			$this->load->view('register/board_member_form', $data);
			
		}else{
			redirect(base_url('signin'),'refresh');
		}
	}

	public function ngoEditForm4()
	{
		$UserId = $_SESSION['UserId'];
		if($UserId==''){
			redirect(base_url('signin','refresh'));
		}
		//print_r($_POST);print_r($_FILES);exit;
		if(isset($_POST) && $_POST != ''){
				
			$fullName=isset($_POST['fullName'])?$_POST['fullName']:array();
			$fullName_arr=array_values(array_filter($fullName));
			
			$email=isset($_POST['email'])?$_POST['email']:array();
			$email_arr=array_values(array_filter($email));

			$contactNo=isset($_POST['contactNo'])?$_POST['contactNo']:array();
			$contactNo_arr=array_values(array_filter($contactNo));
			
			$designation=isset($_POST['designation'])?$_POST['designation']:array();
			$designation_arr=array_values(array_filter($designation));

			$role=isset($_POST['role'])?$_POST['role']:array();
			$role_arr=array_values(array_filter($role));

			$status=isset($_POST['status'])?$_POST['status']:array();
			$status_arr=array_values(array_filter($status));

			$HashPassword=isset($_POST['password'])?$_POST['password']:array();
			// $HashPassword = password_hash($password, PASSWORD_DEFAULT);
			// $HashPassword_arr=array_values(array_filter($HashPassword));

			$hiddenPhotograph=isset($_POST['hiddenPhotograph'])?$_POST['hiddenPhotograph']:array();
			//echo array_sum($milestoneBudget);exit;
			
			//$reciept_arr = isset($_FILES['reciept']['name'])?$_FILES['reciept']['name']:array();
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			
			if(empty($_POST['fullName']) && empty($_POST['email']) && empty($_POST['contactNo'])){
			//if(empty($_POST['fullName'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
				
			}
			else if(count(array_filter($fullName)) != count($fullName) || count(array_filter($email)) != count($email) || count(array_filter($contactNo)) != count($contactNo)){
			//else if(count(array_filter($fullName)) != count($fullName)){
				echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;
				
			}else{
				$ngoDetails	= $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);	
				$boardMembersData	= $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);
				
				$deleted_member_ids = isset($_POST['deleted_member_ids'])?$_POST['deleted_member_ids']:'';
			
				//$deleted_member_ids_arr =  array_values(array_filter($deleted_member_ids));
				//echo count($deleted_member_ids_arr);
				//print_r($deleted_member_ids_arr);
				
				if(isset($deleted_member_ids) && $deleted_member_ids !='')
				{
					$deleted_member_ids_arr = explode(",",$deleted_member_ids);
					foreach($deleted_member_ids_arr as $id){
						$record = $this->db->get_where('ngo_board_members', array('id'=>$id))->num_rows(); 
						
						if($record>0){
							//echo $id;
							$this->db->where('id',$id);
							$this->db->delete('ngo_board_members');
							//print_r($this->db->last_query());
						}
					}
				}
				
				if(isset($hiddenPhotograph) && count($hiddenPhotograph)>0){
					$photographArr = array_filter($_FILES['photograph']['name']);
					
					$resultDeleteArray=array_intersect_key($hiddenPhotograph,$photographArr);
					
					if(isset($resultDeleteArray) && count($resultDeleteArray)>0){
						foreach($resultDeleteArray as $key=>$value){
							
							$delPhotoId = $_POST['hiddenPhotographId'][$key]; 
							
							$this->db->where('id',$delPhotoId);
							$this->db->delete('ngo_board_members');
							
						}
					}
					
					$resultUpdateArray=array_diff_key($hiddenPhotograph,$photographArr);
					if(isset($resultUpdateArray) && count($resultUpdateArray)>0){
						
						foreach($resultUpdateArray as $key=>$value){
							
							$fullNameVal	= $fullName_arr[$key];
							// $emailVal	= $email_arr[$key];
							// $contactNoVal	= $contactNo_arr[$key];
							$emailVal	= $email[$key];
							$contactNoVal	= $contactNo[$key];
							$photoId = $_POST['hiddenPhotographId'][$key]; 
							$hiddenPhotoVal = $_POST['hiddenPhotograph'][$key]; 
							$roleVal	= $role[$key];
							$designationVal	= $designation[$key];
							$statusVal	= $status[$key];
							$HashPasswordVal	= $HashPassword[$key];

							$updateData=array(  'ngo_id'		=> $ngoDetails->id,
												'full_name'		=> $fullNameVal,
												'email'			=> $emailVal,
												'phone_no'		=> $contactNoVal,
												'photograph'	=> $hiddenPhotoVal,
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
												'password'		=> $HashPasswordVal,
												'designation'	=> $designationVal,
												'role'			=> $roleVal,
												'status'		=> $statusVal,
												);
							//print_r($insertData2);	
							$this->db->where('id',$photoId);					
							$this->db->update('ngo_board_members', $updateData);
						}
										
					}
				}
				
				if($_FILES['photograph']['name'] != ''){
					
					$files = $_FILES['photograph'];
					
					for($count = 0; $count<count($_FILES["photograph"]["name"]); $count++)
					{
						$fullNameVal	= $fullName_arr[$count];
						// $emailVal	= $email_arr[$count];
						// $contactNoVal	= $contactNo_arr[$count];
						$emailVal	= $email[$count];
						$contactNoVal	= $contactNo[$count];
						$roleVal		= $role[$count];
						$designationVal	= $designation[$count];
						$statusVal		= $status[$count];
						$HashPasswordVal= $HashPassword[$count];

						$photoId = isset($_POST['hiddenPhotographId'][$count])?$_POST['hiddenPhotographId'][$count]:''; 
						$hiddenPhotoVal = isset($_POST['hiddenPhotograph'][$count])?$_POST['hiddenPhotograph'][$count]:''; 
						// echo $photoId;
						// echo $hiddenPhotoVal;
						// exit;	
						if($files['name'][$count] != ''  && $files['error'][$count] == 0){
							
							$_FILES['file']['name']= $file_name = $files['name'][$count];
							$_FILES['file']['type']= $files['type'][$count];
							$_FILES['file']['tmp_name']= $files['tmp_name'][$count];
							$_FILES['file']['error']= $files['error'][$count];
							$_FILES['file']['size']= $files['size'][$count];
							
							if($_FILES["file"]["size"] > $filesize){
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above $size for ".$_FILES["file"]["name"]));
								exit;
							}
							
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = $ngoDetails->id.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
							$config['upload_path'] = NGO_MEMBER_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							
							$config['file_name'] = $ngoDetails->id.'-'.strtotime(date('Y-m-d H:i:s'));

							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('file')){
							  $uploadData = $this->upload->data();
							  //print_r($uploadData);
							
								if((!empty($photoId) && empty($hiddenPhotoVal)) || empty($photoId)){
									$insertData=array(  'ngo_id'		=> $ngoDetails->id,
														'full_name'		=> $fullNameVal,
														'email'			=> $emailVal,
														'phone_no'		=> $contactNoVal,
														'photograph'	=> $uploadData['file_name'],
														'created_at'	=> strtotime(date('Y-m-d H:i:s')),
														'password'		=> $HashPasswordVal,
														'designation'	=> $designationVal,
														'role'			=> $roleVal,
														'status'		=> $statusVal,
														);
														
									$this->db->insert('ngo_board_members', $insertData);
								}
							}else {
								echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
								exit;
							}
						}else{
							if(empty($photoId)){
								// echo $foundedByVal.'22222';
								$insertData=array(  'ngo_id'		=> $ngoDetails->id,
													'full_name'		=> $fullNameVal,
													'email'			=> $emailVal,
													'phone_no'		=> $contactNoVal,
													//'photograph'	=> $uploadData['file_name'],
													'created_at'	=> strtotime(date('Y-m-d H:i:s')),
													'password'		=> $HashPasswordVal,
													'designation'	=> $designationVal,
													'role'			=> $roleVal,
													'status'		=> $statusVal,
													);
													
								$this->db->insert('ngo_board_members', $insertData);
							}
						}
					}
				} 
				
				echo json_encode(array('flag'=>1, 'msg'=>"NGO Information Updated."));
				exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
}
