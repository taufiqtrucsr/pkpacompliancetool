<?php
defined('BASEPATH') OR exit('No direct script access allowed');

###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Kadambari Sule (kadambari@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - December 2019
###+------------------------------------------------------------------------------------------------

class Forgotpassword extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ForgotpasswordModel');
		$this->load->model('UserModel');
        
		if(isset($_SESSION['UserId'])  && $_SESSION['UserId']!=''){
			redirect(base_url());
		}
	}

	public function forgotpasswordView()
	{
     $data['PageTitle'] = SITE_NAME.' - Forgotpassword';
     $this->load->view('forgotpassword/verifymobile', $data);
	}

   function forgotpasswordmobile()
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
                   //$redirect = base_url() . "forgotpassword";  

                      $string = '0123456789';
                      $string_shuffled = str_shuffle($string);
                      $getOTP = substr($string_shuffled, 0, 4);


                      $insertOTPdata = array( 
                      'otp_type'    => 4,
                      'phone_no' => $_POST['inputMobile'], 
                      'otp'    => $getOTP,

                      );
                      $this->db->insert('otp', $insertOTPdata);   

        						$mtd = "sms";
        						//$mesg = 'Your OTP to reset your truCSR password is '.$getOTP.'.';
                    //$mesg = 'Your OTP to reset you truCSR password is '.$getOTP.'. Kindly don\'t share your OTP with anyone.';
                    $mesg1 = 'Your OTP to reset your truCSR password is '.$getOTP.'. Kindly don\'t share your OTP with anyone.';
                    $mesg1 .= '-';
                    $mesg1 .= 'truCSR.in';
                    $mesg=urlencode($mesg1);
        						$mob = $_POST['inputMobile'];
        						$send = "truCSR";
        						$key = "A6caf2ce090e57e969d65c6111ef27bb9";
                    //$template_id = "1007162633749063080";
                    $template_id = "1007162762888122636";

        						$url = 'https://api-alerts.kaleyra.com/v4/?api_key='.$key.'&method='.$mtd.'&message='.$mesg.'&to='.$mob.'&sender='.$send.'&template_id='.$template_id;  // API URL
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
                        'phone'=> $_POST['inputMobile']
                       // 'redirect' => $redirect
                    ));
                    exit;                   
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


    public function forgotpwdOtp()
    {
    
      if(isset($_POST) && $_POST != ''){

      if(empty($_POST['otpNumber'])){

        echo json_encode(array('flag'=>0, 'msg'=>"Please enter OTP."));
        exit;

      } else{

        $optData = $this->ForgotpasswordModel->getForgotPwdOtpDataByPhone($_POST['phone']);
        
        if(empty($optData))
        {
          echo json_encode(array('flag'=>0, 'msg'=>"Phone number is not registered."));
          exit;

        }else{

          if($optData['otp'] != $_POST['otpNumber']){
          //if($_POST['otpNumber'] != '1234'){

            echo json_encode(array('flag'=>0, 'msg'=>"Invalid OTP"));
            exit;

          }else{
			
			   $this->db->where('phone_no',$optData['phone_no']);
               $this->db->delete('otp');	
             
			 
             echo json_encode(array('flag'=>1, 'msg'=>"OTP verified successfully."));
             exit;

          }
        } 

      }

    }else{

      echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
      exit;
    } 

  }


  public function forgotpwdresendOtp() {
    if(isset($_POST) && $_POST != ''){

      $string = '0123456789';
      $string_shuffled = str_shuffle($string);
      $getOTP = substr($string_shuffled, 0, 4);


      $insertOTPdata = array( 
        'otp_type' => 4,
        'phone_no' => $_POST['phone'], 
        'otp'    => $getOTP,
        
      );
      $this->db->insert('otp', $insertOTPdata);
	  
        $mtd = "sms";
        //$mesg = 'Your OTP for  new password is '.$getOTP;
        //$mesg = 'Your OTP to reset you truCSR password is '.$getOTP.'. Kindly don\'t share your OTP with anyone.';
        $mesg1 = 'Your OTP to reset your truCSR password is '.$getOTP.'. Kindly don\'t share your OTP with anyone.';
        $mesg1 .= '-';
        $mesg1 .= 'truCSR.in';
        $mesg=urlencode($mesg1);
            
        $mob = $_POST['phone'];
        $send = "truCSR";
        $key = "A6caf2ce090e57e969d65c6111ef27bb9";
        //$template_id = "1007162633749063080";
        $template_id = "1007162762888122636";

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

    } else{

      echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
      exit;

    } 

  }



   public function changePassword()
   {
    if(isset($_POST) && $_POST != '')
    {
      // print_r($_POST);exit;
    if(empty($_POST['inputNewPassword']) || empty($_POST['inputRePassword'])){
      echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
      exit;   
    }
    elseif($_POST['inputNewPassword'] != $_POST['inputRePassword']){
          echo json_encode(array('flag'=>0, 'msg'=>"Confirm Password does not match."));
          exit;
        }
        else{
         
          $HashPassword = password_hash($_POST['inputNewPassword'], PASSWORD_DEFAULT);
          $phone = $this->UserModel->GetUserByPhone($_POST['phone']);

          if(isset($phone) && $phone->id !=''){
         // print_r($phone);
          //exit;
           $Result = $this->ForgotpasswordModel->UpdatePasswordData($phone->id, $HashPassword);
             if($Result > 0){
          echo json_encode(array(
                        'flag' => 1,
                        'msg' => "Success"
                        //'redirect' => $redirect
                    ));
                    exit;
        }else{
          echo json_encode(array(
                        'flag' => 0,
                        'msg' => "Password not update."
                        //'redirect' => $redirect
                    ));
           exit;
          }          
        }
        else{
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

 }