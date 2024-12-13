<?php
defined('BASEPATH') OR exit('No direct script access allowed');

###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Usha Das (usha@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - December 2019
###+------------------------------------------------------------------------------------------------

class User extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('UserModel');
    }    
    private function generateToken($length = 20)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';       
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	
    /*function loginpost()
    {
        if (empty($_POST)) {
            echo json_encode(array(
                'flag' => 0,
                'msg' => "Please enter all mandatory / compulsory fields."
            ));
            exit;
        } else {
            if (empty($_POST['inputMobileLogin']) || empty($_POST['inputPasswordLogin'])) {
                echo json_encode(array( 
					'flag' => 0,
                    'msg' => "Please enter all mandatory / compulsory fields."
                ));
                exit;
            } 
			// Nk on 01-04-2022 - code commented
			// CAPTCHA CODE START HERE
			// elseif(!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
			// 	echo json_encode(array( 
			// 		'flag' => 0,
            //         'msg' => "Please check on the reCAPTCHA box."
            //     ));
            //     exit;
            // } 
			// CAPTCHA CODE ENDS HERE

			//Code comment by krishna due loging with email and mobile number both
			// elseif (!preg_match('/^[0-9]*$/', $_POST['inputMobileLogin'])) {
            //     echo json_encode(array(
            //         'flag' => 0,
            //         'msg' => "Please enter valid number."
			// 	));
			// 	exit;
            // } 
			//Code comment by krishna due loging with email and mobile number both


			else {
				// Code commented by Nk 0n 01-04-22 
				// Verify the reCAPTCHA response 
				// CAPTCHA CODE START HERE
				// $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLE_RECAPTCHA_SECRET_KEY.'&response='.$_POST['g-recaptcha-response']); 
				//  CAPTCHA CODE ENDS HERE
				// Decode json data 
				// CAPTCHA CODE START HERE
				// $responseData = json_decode($verifyResponse); 
				//  CAPTCHA CODE ENDS HERE
				// If reCAPTCHA response is valid 
				// CAPTCHA CODE STAR THERE
				// if($responseData->success) {	
				// CAPTCHA CODE ENDS HERE
					$Emailmobile    = trim($_POST['inputMobileLogin']);   
					$EnityType      = trim($_POST['enityTypeLogin']);   
					$Record      = $this->UserModel->UserExistCount($Emailmobile,$EnityType);
					$UserDetails = $this->UserModel->GetUserByEmailPhone($Emailmobile,$EnityType);

				//	echo '<pre>',var_dump($Record); echo '</pre>';   
					// echo '<pre>',var_dump($UserDetails); echo '</pre>';
					// die();
					if (sizeof($UserDetails) > 0) {
						$Pass1 = $UserDetails->password;
					}  
					
		
					$Pass2 = $_POST['inputPasswordLogin'];     
					if ($Record > 0 && password_verify($Pass2, $Pass1)) { 
						// echo "test";
						// die();
							$this->session->set_userdata('PrimeId', $UserDetails->parentId);
							$this->session->set_userdata('ProfileId', $UserDetails->profile_id_display);
							$this->session->set_userdata('ActiveRole', $UserDetails->current_active_role);
							$this->session->set_userdata('AccountRole', $UserDetails->account_role);
							$this->session->set_userdata('UserId', $UserDetails->id);     
							$this->session->set_userdata('LoginToken', $this->generateToken());   
							//Status 1 by default for testing purpose. comment by krishna"    
							$this->db->insert('login_session_front', array(
								'userID' => $UserDetails->id,
								'access_token' => $this->session->userdata('LoginToken'),
								'created_at' => strtotime(date('Y-m-d H:i:s'))
							));    
							if($UserDetails->user_status == 1){
								if ($UserDetails->user_type == 3 || $UserDetails->user_type == 4) {
								// code...
									$redirect = base_url() . "motivator/campaigns";
								}elseif ($UserDetails->user_type == 6) {
								// code...
									$redirect = base_url() . "donation/dashboard/".$_SESSION['UserId'];
								}
								else{
									$redirect = base_url() . "dashboard/kycdashboard/";	
								}
							}
							elseif($UserDetails->user_status == 0){

								$redirect = base_url() . "register/user_type";
								if($UserDetails->step){
									if($UserDetails->current_active_role == 1){
										// Implementer

										$_SESSION['current_role'] = 1;

										if($UserDetails->step == 2)
											$url = 'ImprRegForm2';
										if($UserDetails->step == 3)
											$url = 'ImprRegForm3';
										if($UserDetails->step == 4)
											$url = 'ImprRegForm4';
										if($UserDetails->step == 5)
											$url = 'ImprRegForm5';
										if(isset($url))
											$redirect = base_url().'register/'.$url;
									}
									if($UserDetails->current_active_role == 2){
										// Contributor(CSR)  && Contributor (Non-CSR)
										$_SESSION['current_role'] = 2;
										if($UserDetails->step == 2){
											$url = 'basicDetailsStepForm2';
											$redirect = base_url().'register/'.$url;
										}
									}
									if($UserDetails->current_active_role == 7){
										// Contributor(CSR)  && Contributor (Non-CSR)
										$_SESSION['current_role'] = 7;
										if($UserDetails->step == 2){
											$url = 'basicDetailsStepForm2';
											$redirect = base_url().'register/'.$url;
										}
									}
									if($UserDetails->current_active_role == 4){
										// Contributor(CSR)  && Contributor (Non-CSR)
										$_SESSION['current_role'] = 4;
										if($UserDetails->step == 2){
											$url = 'basicDetailsStepForm2';
											$redirect = base_url().'register/'.$url;
										}
									}
									if($UserDetails->current_active_role == 3){
										// Motivator 
										$_SESSION['current_role'] = 3;
									}
									if($UserDetails->current_active_role == 5){
										// Volunteer
										$_SESSION['current_role'] = 5;
									}
									if($UserDetails->current_active_role == 6){
										// Donor
										$_SESSION['current_role'] = 6;
									}
								}
							}else{
								$redirect = base_url() . "discover";							                   
							}
							echo json_encode(array(
								'flag' => 1,
								'msg' => "Success",
								'redirect' => $redirect
							));
											
					} else {
						echo json_encode(array(
							'flag' => 0,
							'msg' => "Invalid Phone number/Email or Password."
						));
						exit;
					}
				// CAPTCHA CODE START HERE
				// } else {
				// 	echo json_encode(array( 
				// 		'flag' => 0,
				// 		'msg' => "Robot verification failed, please try again."
				// 	));
				// 	exit;
				// }	
				//CAPTCHA CODE ENDS HERE 
				
            }
        }
    }   */ 
	function loginpost()
    {
        if (empty($_POST)) {
            echo json_encode(array('flag' => 0,'msg' => "Please enter all mandatory / compulsory fields."));exit;
        } else {
            if (empty($_POST['inputMobileLogin']) || empty($_POST['inputPasswordLogin'])) {
                echo json_encode(array('flag' => 0,'msg' => "Please enter all mandatory / compulsory fields."));exit;
            } 
			else {
					$Emailmobile    = trim($_POST['inputMobileLogin']);   
					$EnityType      = trim($_POST['enityTypeLogin']);   
					$Record      = $this->UserModel->UserExistCount($Emailmobile,$EnityType);
					$UserDetails = $this->UserModel->GetUserByEmailPhone($Emailmobile,$EnityType);

					if (sizeof($UserDetails) > 0) {
						$Pass1 = $UserDetails->password;
					}  
					$Pass2 = $_POST['inputPasswordLogin'];     
					if ($Record > 0 && password_verify($Pass2, $Pass1)) { 
					
							$this->session->set_userdata('UserId', $UserDetails->id);  
							$this->session->set_userdata('PrimeId', $UserDetails->parentId);
							$this->session->set_userdata('ProfileId', $UserDetails->profile_id_display);
							$this->session->set_userdata('ActiveRole', $UserDetails->current_active_role);
							$this->session->set_userdata('AccountRole', $UserDetails->account_role);   
							$this->session->set_userdata('UserType', $UserDetails->user_type);   
							$this->session->set_userdata('LoginToken', $this->generateToken());   
							$_SESSION['current_role'] = $UserDetails->current_active_role;

							$this->db->insert('login_session_front', array(
								'userID' => $UserDetails->id,
								'access_token' => $this->session->userdata('LoginToken'),
								'created_at' => strtotime(date('Y-m-d H:i:s'))
							));   

							$profile = $this->CommonModel->TblSelectedRecords('user_profile','*',array('id' => $UserDetails->profile_id_display));

							if($profile->kyc_status == 0){
								if($UserDetails->current_active_role == 1 && $profile->step > 1)
									$url = 'ImprRegForm'+$profile->step;
								else if(($UserDetails->current_active_role == 2 || $UserDetails->current_active_role == 7 || $UserDetails->current_active_role == 4) && $profile->step > 1)
									$url = 'basicDetailsStepForm2';
								else
									$url = 'user_type';
									
									$redirect = base_url() . "register/".$url;
							}else{
								if($profile->entity_type == 3 || $profile->entity_type == 4)
									$redirect = base_url() . "motivator/campaigns";
								else if($profile->entity_type == 6)
									$redirect = base_url() . "donation/dashboard/".$_SESSION['UserId'];
								else
									$redirect = base_url() . "dashboard/kycdashboard/";	
							}
							echo json_encode(array(
								'flag' => 1,
								'msg' => "Success",
								'redirect' => $redirect
							));
											
					}else {
						echo json_encode(array('flag' => 0,'msg' => "Invalid Phone number/Email or Password."));exit;
					}
            }
        }
    } 
    function logout()
    {
        if ($this->session->userdata('LoginToken') != '') {      
            $this->session->unset_userdata('UserId');
			$this->session->unset_userdata('PrimeId');
			$this->session->unset_userdata('ProfileId');
			$this->session->unset_userdata('ActiveRole');
			$this->session->unset_userdata('AccountRole');   
			$this->session->unset_userdata('UserType');   
            $this->session->unset_userdata('LoginToken');            
            $this->session->unset_userdata('countdown');            
            $this->session->unset_userdata('time_started');            
            $this->session->unset_userdata('time_started');            
            $this->session->unset_userdata('last_active_time');            
            $this->session->sess_destroy();       
            redirect(base_url());
        } else {   
			redirect(base_url());
        }
    }    
	
	function checkSession()
    {
		if(isset($_SESSION['end_time'])) {
			$form_time = strtotime(date("Y-m-d H:i:s"));
			$to_time =  strtotime($_SESSION['end_time']);
			
			//Get the difference in seconds.
			$difference = $to_time - $form_time;
			//echo $difference;
			if(time() - $_SESSION['last_active_time'] > 10){
				if($difference == 0){
					echo "logout";
				}else{
					echo gmdate("i:s",$difference);
				}
				//echo "logout";
			}
		}
    }   

	// public function check_session(){
       // //Below last_visited should be updated everytime a page is accessed.
	   // //print_r($this->session->all_userdata());
       // $lastVisitTime = $this->session->userdata('__ci_last_regenerate');
       // $fiveMinutesBefore = date("YmdHi", "-5 minutes");

       // echo date("YmdHi", strtotime($lastVisitTime)) > $fiveMinutesBefore ? 1 : 0;
    // }	

    public function implementer(){
    	// echo "hi";
		if(isset($_SESSION['UserId'])) {
			$user_id = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($user_id);
			    // $userType= $UserDetails->type;
				$SwitchUserById = $this->UserModel->SwitchUserById(1,$user_id);
				// echo $SwitchUserById;
				if($SwitchUserById->role_id == 1){					
					// $update = array('role_id' => 1,
					// 				'updated_at' => strtotime(date('d-m-Y H:i:s')),
					// 			);				
					// $this->db->where('user_id', $user_id);
					// $this->db->update('user_role_lnk', $update);
					
					$updatedata = array('type' => 1,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}else{
					$update = array('role_id' => 1,
									'user_id' => $user_id,
									'created_at' => strtotime(date('d-m-Y H:i:s')),
									'updated_at' => strtotime(date('d-m-Y H:i:s')),
								);				
					// $this->db->where('user_id', $user_id);
					$this->db->insert('user_role_lnk', $update);
					
					$updatedata = array('type' => 1,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}
				if($UserDetails->status == 1){
					redirect(base_url("dashboard/projects/"));	
				}else{
					redirect(base_url("discover"));						                   
				}
		} else {
			redirect('signin','refresh');
		}
    }

    public function contributer(){
    	// echo "hi";
		if(isset($_SESSION['UserId'])) {
			$user_id = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($user_id);
			// $userType= $UserDetails->type;
				$role_id = 2;
				$SwitchUserById = $this->UserModel->SwitchUserById($role_id,$user_id);
				if($SwitchUserById->role_id == 2){					
					// $update = array('role_id' => 2,
					// 				'updated_at' => strtotime(date('d-m-Y H:i:s')),
					// 			);				
					// $this->db->where('user_id', $user_id);
					// $this->db->update('user_role_lnk', $update);
					
					$updatedata = array('type' => 2,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}else{
					$update = array('role_id' => 2,
									'user_id' => $user_id,
									'created_at' => strtotime(date('d-m-Y H:i:s')),
									'updated_at' => strtotime(date('d-m-Y H:i:s')),
								);				
					// $this->db->where('user_id', $user_id);
					$this->db->insert('user_role_lnk', $update);
					
					$updatedata = array('type' => 2,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}
				if($UserDetails->status == 1){
					redirect(base_url("dashboard/projects/"));	
				}else{
					redirect(base_url("discover"));						                   
				}
		} else {
			redirect('signin','refresh');
		}
    }

    public function motivator(){
    	// echo "hi";
		if(isset($_SESSION['UserId'])) {
			$user_id = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($user_id);
			// $userRole_id= $UserDetails->role_id;
			
			$SwitchUserById = $this->UserModel->SwitchUserById(3,$user_id);
			// echo "<pre>"; print_r($SwitchUserById); echo "</pre>"; die();
			if($SwitchUserById->role_id == 3){					
				// $update = array('role_id' => 3,
				// 				'updated_at' => strtotime(date('d-m-Y H:i:s')),
				// 			);				
				// $this->db->where('user_id', $user_id);
				// $this->db->update('user_role_lnk', $update);

				$updatedata = array('user_type' => 3,
							'updated_at' => strtotime(date('d-m-Y H:i:s')),
						);				
				$this->db->where('id', $user_id);
				$this->db->update('users', $updatedata);
			}else{
				$update = array('role_id' => 3,
								'user_id' => $user_id,
								'created_at' => strtotime(date('d-m-Y H:i:s')),
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
				// $this->db->where('user_id', $user_id);
				$this->db->insert('user_role_lnk', $update);

				$updatedata = array('user_type' => 3,
							'updated_at' => strtotime(date('d-m-Y H:i:s')),
						);				
				$this->db->where('id', $user_id);
				$this->db->update('users', $updatedata);
			}
			if($UserDetails->status == 1){
				redirect(base_url("motivator/campaigns"));
			}else{
				redirect(base_url("create-campaign"));					                   
			}
		} else {
			redirect('signin','refresh');
		}
    }

    public function fundraiser(){
    	// echo "hi";
		if(isset($_SESSION['UserId'])) {
			$user_id = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($user_id);
			// $userType= $UserDetails->type;
				$SwitchUserById = $this->UserModel->SwitchUserById(4,$user_id);
				if($SwitchUserById->role_id == 4){					
					// $update = array('role_id' => 4,
					// 				'updated_at' => strtotime(date('d-m-Y H:i:s')),
					// 			);				
					// $this->db->where('user_id', $user_id);
					// $this->db->update('user_role_lnk', $update);

					$updatedata = array('type' => 4,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}else{					
					$update = array('role_id' => 4,
					'user_id' => $user_id,
					'created_at' => strtotime(date('d-m-Y H:i:s')),
					'updated_at' => strtotime(date('d-m-Y H:i:s')),
								);
					$this->db->insert('user_role_lnk', $update);
					
					$updatedata = array('type' => 4,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}
				if($UserDetails->status == 1){
					redirect(base_url("fundraiser/campaigns"));
				}else{
					redirect(base_url("fundraiser-create-campaign"));				                   
				}
		} else {
			redirect('signin','refresh');
		}
    }

    public function donor(){
		if(isset($_SESSION['UserId'])) {
			$user_id = $_SESSION['UserId'];
			$UserDetails = $this->UserModel->GetUserById($user_id);
			// $userType= $UserDetails->type;
				$SwitchUserById = $this->UserModel->SwitchUserById(6,$user_id);
				if($SwitchUserById->role_id == 6){					
					// $update = array('role_id' => 6,
					// 				'updated_at' => strtotime(date('d-m-Y H:i:s')),
					// 			);				
					// $this->db->where('user_id', $user_id);
					// $this->db->update('user_role_lnk', $update);

					$updatedata = array('type' => 6,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}else{					
					$update = array('role_id' => 6,
									'user_id' => $user_id,
									'created_at' => strtotime(date('d-m-Y H:i:s')),
									'updated_at' => strtotime(date('d-m-Y H:i:s')),
								);
					$this->db->insert('user_role_lnk', $update);
					
					$updatedata = array('type' => 6,
								'updated_at' => strtotime(date('d-m-Y H:i:s')),
							);				
					$this->db->where('id', $user_id);
					$this->db->update('users', $updatedata);
				}
				if($UserDetails->status == 1){

					// redirect(base_url("donation/dashboard/"));
					redirect(base_url()."donation/dashboard/".$user_id);
				}else{
					redirect(base_url()."donation/dashboard/".$user_id);
					// redirect(base_url("create-campaign"));				                   
				}
		} else {
			redirect('signin','refresh');
		}
    }
}
