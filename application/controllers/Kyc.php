<?php
defined('BASEPATH') OR exit('No direct script access allowed');
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Krishna (usha@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2023
###+------------------------------------------------------------------------------------------------

class Kyc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommonModel');
		$this->load->model('CmsModel');
		$this->load->model('UserModel');
		
		if(isset($_SESSION['UserId'])){
			$_SESSION['countdown'] = 40;
			$_SESSION['time_started'] = date("Y-m-d H:i:s");
			
			$_SESSION['last_active_time'] = time();
			$end_time = date("Y-m-d H:i:s", strtotime('+'.$_SESSION['countdown'].'minutes', strtotime($_SESSION['time_started']))) ;
			$_SESSION['end_time'] = $end_time; 
		}
    }

    
    public function dashboard(){
        $org_type = $_POST['companyOrgType'];
        $this->load->view('ngo/edit');
    }
	

}
	
	
	
    
	
	

   