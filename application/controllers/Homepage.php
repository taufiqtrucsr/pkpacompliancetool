<?php
defined('BASEPATH') OR exit('No direct script access allowed');

###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ]
###+------------------------------------------------------------------------------------------------
###| Code By - Neha Raut (neha.raut@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2019
###+------------------------------------------------------------------------------------------------

class Homepage extends CI_Controller
{
	/**
	* Index Page for this controller.
	 *
	 * Maps to the following URL
	 *         http://example.com/index.php/welcome
	 *    - or -
	 *         http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 
	 */
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CommonModel');
		$this->load->model('UserModel');
		$this->load->model('SearchModel');
		$this->load->model('CmsModel');
		$this->load->model('ProjectModel');
		$this->load->model('ShorternModel');
		$this->load->model('MotivatorModel');
		$this->load->model('DonorModel');
		// $this->load->helper('csr');
		
		if(isset($_SESSION['UserId'])){
			$_SESSION['countdown'] = 40;
			$_SESSION['time_started'] = date("Y-m-d H:i:s");
			
			$_SESSION['last_active_time'] = time();
			$end_time = date("Y-m-d H:i:s", strtotime('+'.$_SESSION['countdown'].'minutes', strtotime($_SESSION['time_started']))) ;
			$_SESSION['end_time'] = $end_time; 
		}	
	}
	
	public function index()
	{
	

		log_message('error', "Inside homepage controller index function called");
		$data['PageTitle'] = SITE_NAME.' - Home';

		$data['ngoUserCount'] = $this->CommonModel->GetCountOfNgoUser();

		$data['companyUserCount'] = $this->CommonModel->GetCountOfCompanyUser();
		//$data['completedProjectsCount'] = $this->CommonModel->GetCountOfCompletedProjects();
		$data['allProjectsCount'] = $this->CommonModel->GetCountOfAllProjects();
		$data['sectorCount'] = $sectorCount = $this->CommonModel->GetCountOfSector();
		//$data['beneficiariesCount'] = $beneficiariesCount = $this->CommonModel->GetCountOfBeneficiaries();
		$data['beneficiariesCount'] = $beneficiariesCount = $this->CommonModel->getBeneficiariesCount();

		$data['fundRaised'] = $fundRaised = $this->ProjectModel->getTotalRecievedAmt();
		$data['ProectListData'] = $this->CommonModel->getRecentProjectLists();
		$data['BannerData'] = $this->CommonModel->getBannerDataImage();	
        $data['BannerData1'] = $this->CommonModel->getBannerDataImage1();	

		$data['HomePageBlock1'] = $this->CommonModel->getCMSPageDataByIdentifier('homepage-block1');
		$data['HomePageBlock2'] = $this->CommonModel->getCMSPageDataByIdentifier('homepage-block2');
		$data['HomePageBlock3'] = $this->CommonModel->getCMSPageDataByIdentifier('homepage-block3');
		$data['HomePageBlock4'] = $this->CommonModel->getCMSPageDataByIdentifier('homepage-block4');
		// urlFunction();

	
		$this->load->view('homepage', $data);
	}
	
	public function pagenotfound()
	{
		if(isset($_SESSION['UserId'])) {
			$data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);
		}
		// if (condition) {
		// 	# code...
		// }
		// $shortUrl = isset($_SERVER['HTTP_REFERER']);

        // echo $shortUrl = prep_url($this->input->post('alias'));
        // $actualLink = $this->ShorternModel->getLinksTable($shortUrl);
		// if (isset($actualLink) && $actualLink->url != '') {
		// 	# code...
			//  $redirect = $actualLink->url;		
			//  redirect($redirect);
			//  return(redirect($redirect));
			// echo json_encode(array('flag'=>1, 'redirect'=>$redirect));
		// 	// exit;
		// print_r($redirect);die();
		// } 
		// else {
			$data['PageTitle'] = SITE_NAME . ' :: Page not found';
			$this->load->view('common/404page', $data);
		// }
	}   

	///contactUS
	public function contactUS()
	{
		$data['PageTitle'] = SITE_NAME.' - Contact Us';
		if(isset($_SESSION['UserId'])) {
			$data['UserDetails'] = $this->UserModel->GetUserById($_SESSION['UserId']);
		}
		else
		{
			$data['UserDetails'] = '';			
		}
		$this->load->view('contact',$data);
		
		
	}
	//submitContact
	public function submitContact()
	{
		$inputFullName = $_POST['inputFullName'];
		$inputEmail	= $_POST['inputEmail'];
		$inputOrganization	= $_POST['inputOrganization'];
		$inputContactNumber	= $_POST['inputContactNumber'];
		$inputMessage	= $_POST['inputMessage'];
		if($inputFullName!='' && $inputEmail!='' && $inputOrganization!='' && $inputContactNumber!='' &&  $inputMessage!='')
		{
			$numberLength = strlen($inputContactNumber);
			if($numberLength < 10)
			{
				$response = array('msg'=>'It should be accept only 10 numbers.','status'=>403);
				echo json_encode($response);
				exit;
			}
			elseif($numberLength > 10)
			{
				$response = array('msg'=>'Please enter 10 digit number.','status'=>403);
				echo json_encode($response);
				exit;
			}

			$validateEmail = filter_var($inputEmail, FILTER_VALIDATE_EMAIL);
			if($validateEmail='')
			{
				$response = array('msg'=>'Invalid email ID.','status'=>403);
				echo json_encode($response);
				exit;
			}
			// if($validateEmail)

		$insertArr = array(
			'full_name' =>$inputFullName,
			'email_address' =>$inputEmail,
			'organization' =>$inputOrganization,
			'contact_no' =>$inputContactNumber,
			'message' =>$inputMessage,
			'ip_address' =>$_SERVER['REMOTE_ADDR'],
			'created_at' =>strtotime(date('Y-m-d H:i:s')),

		);
		$insertData = $this->UserModel->insertData('contact_us',$insertArr);
		if($insertData)
		{
			$to      = TRUCSR_DEFAULT_MAIL;
			
			$templateId =2;
			
			$TempVars = array();
			$DynamicVars = array();
	
			$TempVars = array("##NAME##","##EMAIL##","##EMAIL##","##ORGANIZATION##","##CONTACT##","##MESSAGE##");
			$DynamicVars   = array($inputFullName,$inputEmail,$inputEmail,$inputOrganization,$inputContactNumber,$inputMessage);

			$status = $this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars,$DynamicVars, $inputEmail);
			
			if($status == true)
			{
				$response = array('msg'=>'sucess','status'=>200);
			}
			else
			{
				$response = array('msg'=>'fail to send mail','status'=>403);
			}
		}
	}
		echo json_encode($response);
		
		
	}
	
	
	public function notificationView()
    {        		
        $data['PageTitle']      = SITE_NAME . ' - View Notification .';
		if(isset($_SESSION['UserId'])) {
        $data['notification'] = $this->CommonModel->get_notifications($_SESSION['UserId']);
		}
        $this->load->view('common/all_notifications', $data);
    }
	
	public function notificationUpdate()
	{
		$n_id = $_POST['id'];
		
		$data	=  array(		
             'unread_flag'=>0,
             'visited_flag'=>0,
             'updated_at'=>time(),
			 
             );
		
        $this->db->where('id',$n_id);
        $this->db->update('user_notifications',$data);
	}
	
	
	public function countUpdate(){
		$Userid = $_SESSION['UserId'];
		
		$data =  array(
             'visited_flag'=>0,
             'updated_at'=>time(),
			 );
		
        $this->db->where('to_user_id',$Userid);
        $this->db->update('user_notifications',$data);
	}
	
	function updateUserType()
    {
		$LoggedInUserId	= $_SESSION['UserId'];
		if($LoggedInUserId=='') {			
			redirect(base_url());
		}
        if (empty($_POST)) {
            echo json_encode(array(
                'flag' => 0,
                'msg' => "Please enter all mandatory / compulsory fields."
            ));
            exit;
        } else if(empty($_POST['user_type'])) {
            echo json_encode(array( 
                'flag' => 0,
                'msg' => "Pleas select type."
            ));
            exit;
        } else {
                $user_type = trim($_POST['user_type']);  
                
                $updatedata = array( 
                    'type'	 => $user_type,
                    // 'status' => 1,
                    'updated_at'  => strtotime(date('Y-m-d H:i:s')),
                );
                $this->db->where('id', $LoggedInUserId);
                $this->db->update('users', $updatedata);
				
				$updatedatarole = array( 
					'role_id'	  => $user_type,
					'updated_at'  => strtotime(date('Y-m-d H:i:s')),	
				);
				$this->db->where('user_id', $LoggedInUserId);
                $this->db->update('user_role_lnk', $updatedatarole);
                
                // code added here for user_bifurcation on 24-08-2022
				if($user_type == 3){
					$redirect = base_url('motivator/campaigns/');
				}else if($user_type == 4){
					$redirect = base_url('fundraiser/campaigns/');
				}else{
					$redirect = base_url();
				}
				// code end here
				// $redirect = '';
                // if ($this->db->affected_rows() > 0) {
                   //$redirect = base_url() . "registration";
                //   $redirect = base_url();
                // }
            
                echo json_encode(array(
                    'flag' => 1,
                    'msg' => "Success",
                    'redirect' => $redirect
                ));
                exit;                   
            } 
    }
    
	
	
}
