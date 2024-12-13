<?php
defined('BASEPATH') OR exit('No direct script access allowed');

###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Neha Raut (neha.raut@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2019
###+------------------------------------------------------------------------------------------------

class Requestedit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('UserModel');
		$this->load->model('CommonModel');
		$this->load->model('CompanyModel'); 
		$this->load->model('NgoModel');
		$this->load->model('MyprofileModel');
		
		$LoggedInUserId    = isset($_SESSION['UserId'])?$_SESSION['UserId']:'';
		if($LoggedInUserId==''){
			redirect(base_url());
		}
		
		if(isset($_SESSION['UserId'])){
			$_SESSION['countdown'] = 40;
			$_SESSION['time_started'] = date("Y-m-d H:i:s");
			
			$_SESSION['last_active_time'] = time();
			$end_time = date("Y-m-d H:i:s", strtotime('+'.$_SESSION['countdown'].'minutes', strtotime($_SESSION['time_started']))) ;
			$_SESSION['end_time'] = $end_time; 
		}	
	}
	
	public function getRequestForEditView()
	{
		//echo'testing..!!';
		$LoggedInUserId    = $_SESSION['UserId'];
		
		if($LoggedInUserId=='')
		{
			redirect(base_url());
		}
		else
		{
			$data['UserDetails'] = $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			//print_r($data['UserDetails']);
			
			if($UserDetails->type == 1)
			{
				//redirect(base_url());
				$userId = $this->uri->segment(2);
			
				$data['PageTitle'] = SITE_NAME.' : Myprofile - Request An Edit';	
				$data['State']= $this->CommonModel->get_state();
				$data['PrimarySourceMaster']= $this->CommonModel->getPrimarySourceMaster();
				//$data['OrganizationType'] = $this->CommonModel->get_organization_type();
				$data['Organization_Type'] = $this->CommonModel->get_organization_type();
				$data['Sector_Master']= $this->CommonModel->get_sector_master();
				$data['BeneficiaryMaster']= $this->CommonModel->getBeneficiaryMaster();
				$data['userType'] = $UserDetails->type ;
				//$data['NgoDetails'] = $this->MyprofileModel->getNgoDetailsById($userId);
				$data['ngoDetails']=$ngoDetails	= $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);	
				$data['boardMembersData']=$boardMembersData	= $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);	
				$data['team_member_counter']= (isset($boardMembersData) && count($boardMembersData)>0)?count($boardMembersData):1;
				
				/* echo'<pre>';
				print_r($data['ProfileDetails']);
				exit; */
				
				if($data['ngoDetails']->user_id == $LoggedInUserId)
				{
					//add breadcrumb here....
					
					// $this->load->view('profile/requesteditform', $data);
					$this->load->view('profile/ngo_request_edit_form', $data);
				}
				else
				{
					redirect(base_url());
				}
			}
		}   
	}
	public function ngoRequestEditForm1(){
		$UserId = $_SESSION['UserId'];
		// echo '<pre>';
		// print_r($_POST);print_r($_FILES);//exit;
		
		$filename = "";
		$filename_add_proof = "";
		$filename_add_proof_db = "";
		$ngoDetails = $this->MyprofileModel->getNgoDetailsById($UserId);
	
		if(isset($_POST) && $_POST != ''){
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
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;

			if(empty($_POST['orgAddress1']) || empty($_POST['orgAddress2']) || empty($_POST['orgCity']) || empty($_POST['orgDistrict']) || empty($_POST['orgState']) || empty($_POST['orgLocation']) || empty($_POST['orgSector'])){
				
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;

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
				//$_SESSION['updatedFields'] = array();
				$updatedFields = array();
				$updatedFieldsOldData = array();
				$updatedFieldsNewData = array();
				$verficationFields = array();
				$verficationFieldsNewData = array();
				//$_SESSION['updatedFieldsOldData'] = array();
				//$_SESSION['updatedFieldsNewData'] = array();
				//$_SESSION['verfication'] = array();
				
				if($_POST['orgLogoHidden'] !=""){
					$filename = $_POST['orgLogoHidden'];
					$file_name_arr['org_logo_filename'] =  $filename;
				}
				
				if(isset($_FILES['orgLogo']['name']) && !empty($_FILES['orgLogo']['name'])) { 

					$file_name = $_FILES['orgLogo']['name'];
					$filename = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
					$config['upload_path'] = NGO_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s'));

					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('orgLogo')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$file_name_arr['org_logo_filename'] =  $filename;
					}else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}

				if((trim($_POST['orgName']) != trim($ngoDetails->org_name))){
					$updatedFields[] = 'Name' ;
					$updatedFieldsOldData['org_name'] = trim($ngoDetails->org_name) ;
					$updatedFieldsNewData['org_name'] = trim($_POST['orgName']) ;
				} 

				if(trim($filename) != trim($ngoDetails->org_logo)) {
					$updatedFields[] = 'Organization Logo' ;
					$updatedFieldsOldData['org_logo'] = trim($ngoDetails->org_logo) ;
					$updatedFieldsNewData['org_logo'] = trim($filename) ;
				}
				
				if((trim($_POST['orgAddress1']) != trim($ngoDetails->org_address_line1))){
					$updatedFields[] = 'Address1' ;
					$updatedFieldsOldData['org_address_line1'] = trim($ngoDetails->org_address_line1) ;
					$updatedFieldsNewData['org_address_line1'] = trim($_POST['orgAddress1']) ;
				} 
				
				if((trim($_POST['orgAddress2']) != trim($ngoDetails->org_address_line2))){ 
					$updatedFields[] = 'Address2' ;
					$updatedFieldsOldData['org_address_line2'] = trim($ngoDetails->org_address_line2) ;
					$updatedFieldsNewData['org_address_line2'] = trim($_POST['orgAddress2']) ;
				}
				
				if((trim($_POST['orgWebsite']) != trim($ngoDetails->website))){ 
					$updatedFields[] = 'Website' ;
					$updatedFieldsOldData['website'] = trim($ngoDetails->website) ;
					$updatedFieldsNewData['website'] = trim($_POST['orgWebsite']) ;
				}
				
				if($_POST['orgAddProofHidden'] !=""){
					$filename_add_proof = $filename_add_proof_db = $_POST['orgAddProofHidden'];
					$file_name_arr['address_proof'] =  $filename_add_proof_db;
				}
				
				if(isset($_FILES['orgAddProof']['name']) && !empty($_FILES['orgAddProof']['name'])) { 

					$file_name = $_FILES['orgAddProof']['name'];
					$filename_add_proof_db = $UserId.'-'.'ADD-PROOF'.'.'.$ext;
					$config['upload_path'] = NGO_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-'.'ADD-PROOF';

					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('orgAddProof')){
						$uploadData = $this->upload->data();
						$filename_add_proof_db = $uploadData['file_name'];
						$file_name_arr['address_proof'] =  $filename_add_proof_db;
					   
					}else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				//if(trim($filename_add_proof) != trim($ngoDetails->address_proof)){ 
				if(trim($filename_add_proof_db) != trim($ngoDetails->address_proof)){ 
					$updatedFields[] = 'Address Proof' ;
					$updatedFieldsOldData['address_proof'] = trim($ngoDetails->address_proof) ;
					$updatedFieldsNewData['address_proof'] = trim($filename_add_proof_db) ;
				}
				
				if(trim($_POST['orgPincode']) != trim($ngoDetails->pincode)) {
					$updatedFields[] = 'Pincode' ;
					$updatedFieldsOldData['pincode'] = trim($ngoDetails->pincode) ;
					$updatedFieldsNewData['pincode'] = trim($_POST['orgPincode']) ;
				}
				
				if(trim($_POST['orgState']) != trim($ngoDetails->state)) {
					$updatedFields[] = 'State' ;
					$updatedFieldsOldData['state'] = trim($ngoDetails->state) ;
					$updatedFieldsNewData['state'] = trim($_POST['orgState']) ;
				}
				
				if(trim($_POST['orgDistrict']) != trim($ngoDetails->district)) {
					$updatedFields[] = 'District' ;
					$updatedFieldsOldData['district'] = trim($ngoDetails->district) ;
					$updatedFieldsNewData['district'] = trim($_POST['orgDistrict']) ;
				}
				
				if(trim($_POST['orgCity']) != trim($ngoDetails->city)) {
					$updatedFields[] = 'City' ;
					$updatedFieldsOldData['city'] = trim($ngoDetails->city) ;
					$updatedFieldsNewData['city'] = trim($_POST['orgCity']) ;
				}
				
				if(trim($_POST['orgAbout']) != trim($ngoDetails->about_org)) {
					$updatedFields[] = 'About Organization' ;
					$updatedFieldsOldData['about_org'] = trim($ngoDetails->about_org) ;
					$updatedFieldsNewData['about_org'] = trim($_POST['orgAbout']) ;
				}
				
				if(trim($_POST['orgLocation']) != trim($ngoDetails->org_location_operation)) {
					$updatedFields[] = 'Location' ;
					$updatedFieldsOldData['org_location_operation'] = trim($ngoDetails->org_location_operation) ;
					$updatedFieldsNewData['org_location_operation'] = trim($_POST['orgLocation']) ;
				}
				
				if(isset($_POST['orgSector'])){
					$orgSector = implode(',',$orgSector_arr);
					$orgSector = ','.$orgSector.',';					
				}
				
				if(trim($orgSector) != trim($ngoDetails->sector_operation)) {
					$updatedFields[] = 'Organization Sector' ;
					$updatedFieldsOldData['sector_operation'] = trim($ngoDetails->sector_operation) ;
					$updatedFieldsNewData['sector_operation'] = trim($orgSector) ;
				}

				// print_r("<pre>");
				// print_r($updatedFields);
				// print_r("<pre>");
				// print_r($updatedFieldsOldData);
				// print_r("<pre>");
				// print_r($updatedFieldsNewData);
				
				$newdata = array(
					   'updatedFields'  => $updatedFields,
					   'updatedFieldsOldData'   => $updatedFieldsOldData,
					   'updatedFieldsNewData'   => $updatedFieldsNewData,
					   'verficationFields'   => $verficationFields,
					   'verficationFieldsNewData'   => $verficationFieldsNewData,
				   );

				$this->session->set_userdata($newdata);
				
				
				echo json_encode(array('flag'=>1, 'msg'=>""));
				exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
	
	public function ngoRequestEditForm2(){
		$UserId = $_SESSION['UserId'];
		// echo '<pre>';
		// print_r($_POST);print_r($_FILES);exit;
		
		// $updatedFields = $this->session->userdata('updatedFields');
		// $updatedFieldsOldData = $this->session->userdata('updatedFieldsOldData');
		// $updatedFieldsNewData = $this->session->userdata('updatedFieldsNewData');
		
		$updatedFields = $_SESSION['updatedFields'];
		$updatedFieldsOldData = $_SESSION['updatedFieldsOldData'];
		$updatedFieldsNewData = $_SESSION['updatedFieldsNewData'];
		$verficationFields = $_SESSION['verficationFields'];
		$verficationFieldsNewData = $_SESSION['verficationFieldsNewData'];
		
		// print_r($updatedFields );
		// print_r($updatedFieldsOldData );
		// print_r($updatedFieldsNewData );
		// print_r($verficationFields );
		
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

			// code for 12a start here
			$filename_12a = $_FILES['org_12a_file']['name'];
			$filesize_12a = $_FILES['org_12a_file']['size'];
			// code for 12a ends here

			// code for MOA/trustee start here
			$filename_trustee = $_FILES['org_trustee_file']['name'];
			$filesize_trustee = $_FILES['org_trustee_file']['size'];
			// code for MOA/trustee ends here
			
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
			
			if(!empty($filename_cin) && !in_array($ext_cin, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_cin) && $filesize_cin > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_cin."));
				exit;
			}else if(!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_gst) && $filesize_gst > $filesize) {
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
			}else if(!empty($filename_12a) && !in_array($ext_12a, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_12a) && $filesize_12a > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_12a."));
				exit;
			}else if(!empty($filename_trustee) && !in_array($ext_trustee, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_trustee) && $filesize_trustee > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_trustee.")); //code for trustee
				exit;
			}
			 else if(!empty($filename_stamp) && !in_array($ext_stamp, $allowed)) {
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
			}else if(!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['org_gst_number']) && !	empty($_POST['org_gst_number'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid GST Number"));
				exit;
			} else {
				
				$ngoDetails = $this->MyprofileModel->getNgoDetailsById($UserId);

				// code for cin start here
				if($_POST['org_cin_fileHidden'] !=""){
					$filename_cin_db = $_POST['org_cin_fileHidden'];
					$file_name_arr['org_cin_filename'] =  $filename_cin_db;
				}
				
				if(isset($_FILES['org_cin_file']['name']) && !empty($_FILES['org_cin_file']['name'])) {
					$filename_cin_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN.'.$ext_cin;
					$config['upload_path'] = NGO_CIN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-CIN';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_cin_file')){
						$uploadData = $this->upload->data();
						$filename_cin_db = $uploadData['file_name'];
						$file_name_arr['org_cin_filename'] =  $filename_cin_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_cin_db) != trim($ngoDetails->cin_file)) {
					$verficationFields[] = 'CIN Certifiicate' ;
					$verficationFieldsNewData['cin_file'] = $filename_cin_db ;
				}
				// code for cin ends here
				
				if($_POST['org_gst_fileHidden'] !=""){
					$filename_gst_db = $_POST['org_gst_fileHidden'];
					$file_name_arr['org_gst_filename'] =  $filename_gst_db;
				}
				
				if(isset($_FILES['org_gst_file']['name']) && !empty($_FILES['org_gst_file']['name'])) {
					$filename_gst_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-GST.'.$ext_gst;
					$config['upload_path'] = NGO_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-GST';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_gst_file')){
						$uploadData = $this->upload->data();
						$filename_gst_db = $uploadData['file_name'];
						$file_name_arr['org_gst_filename'] =  $filename_gst_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_gst_db) != trim($ngoDetails->gst_file)) {
					$verficationFields[] = 'GST Certifiicate' ;
					$verficationFieldsNewData['gst_file'] = $filename_gst_db ;
				}


				// code for PAN start here
				if($_POST['org_pan_fileHidden'] !=""){
					$filename_pan_db = $_POST['org_pan_fileHidden'];
					$file_name_arr['org_pan_filename'] =  $filename_pan_db;
				}
				
				if(isset($_FILES['org_pan_file']['name']) && !empty($_FILES['org_pan_file']['name'])) {
					$filename_pan_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN.'.$ext_pan;
					$config['upload_path'] = NGO_PAN_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-PAN';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_pan_file')){
						$uploadData = $this->upload->data();
						$filename_pan_db = $uploadData['file_name'];
						$file_name_arr['org_pan_filename'] =  $filename_pan_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_pan_db) != trim($ngoDetails->pan_file)) {
					$verficationFields[] = 'PAN Certifiicate' ;
					$verficationFieldsNewData['pan_file'] = $filename_pan_db ;
				}
				// code for PAN ends here
				
				if($_POST['org_80g_fileHidden'] !=""){
					$filename_80g_db = $_POST['org_80g_fileHidden'];
					$file_name_arr['org_80g_filename'] =  $filename_80g_db;
				}
				
				if(isset($_FILES['org_80g_file']['name']) && !empty($_FILES['org_80g_file']['name'])) {
					$filename_80g_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-80G.'.$ext_80g;
					$config['upload_path'] = NGO_80G_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-80G';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_80g_file')){
						$uploadData = $this->upload->data(); 
						$filename_80g_db = $uploadData['file_name'];	
						$file_name_arr['org_80g_filename'] =  $filename_80g_db;	
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_80g_db) != trim($ngoDetails->org_80g_file)) {
					$verficationFields[] = '80G Certifiicate' ;
					$verficationFieldsNewData['org_80g_file'] = $filename_80g_db ;
				}
				
				if($_POST['org_fcra_fileHidden'] !=""){
					$filename_fcra_db = $_POST['org_fcra_fileHidden'];
					$file_name_arr['org_fcra_filename'] =  $filename_fcra_db;
				}
				
				if(isset($_FILES['org_fcra_file']['name']) && !empty($_FILES['org_fcra_file']['name'])) {
					$filename_fcra_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-FCRA.'.$ext_fcra;
					$config['upload_path'] = NGO_FCRA_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';	
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-FCRA';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('org_fcra_file')){
						$uploadData = $this->upload->data();
						$filename_fcra_db = $uploadData['file_name'];
						$file_name_arr['org_fcra_filename'] =  $filename_fcra_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}	

				if(trim($filename_fcra_db) != trim($ngoDetails->fcra_file)) {
					$verficationFields[] = 'FCRA Certifiicate' ;	
					$verficationFieldsNewData['fcra_file'] = $filename_fcra_db ;
				}
				
				if($_POST['org_35ac_fileHidden'] !=""){
					$filename_35ac_db = $_POST['org_35ac_fileHidden'];
					$file_name_arr['org_35ac_filename'] =  $filename_35ac_db;
				}
				
				if(isset($_FILES['org_35ac_file']['name']) && !empty($_FILES['org_35ac_file']['name'])) {
					$filename_35ac_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-35AC.'.$ext_35ac;
					$config['upload_path'] = NGO_35AC_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-35AC';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_35ac_file')){
						$uploadData = $this->upload->data(); 
						$filename_35ac_db = $uploadData['file_name'];
						$file_name_arr['org_35ac_filename'] =  $filename_35ac_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_35ac_db) != trim($ngoDetails->org_35ac_file)) {
					$verficationFields[] = '35AC Certifiicate' ;
					$verficationFieldsNewData['org_35ac_file'] = $filename_35ac_db ;
				}

				// code for 12A start here
				if($_POST['org_12a_fileHidden'] !=""){
					$filename_12a_db = $_POST['org_12a_fileHidden'];
					$file_name_arr['org_12a_filename'] =  $filename_12a_db;
				}
				
				if(isset($_FILES['org_12a_file']['name']) && !empty($_FILES['org_12a_file']['name'])) {
					$filename_12a_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-12A.'.$ext_12a;
					$config['upload_path'] = NGO_12A_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-12A';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_12a_file')){
						$uploadData = $this->upload->data();
						$filename_12a_db = $uploadData['file_name'];
						$file_name_arr['org_12a_filename'] =  $filename_12a_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_12a_db) != trim($ngoDetails->org_12a_file)) {
					$verficationFields[] = '12A Certifiicate' ;
					$verficationFieldsNewData['org_12a_file'] = $filename_12a_db ;
				}
				// code for 12A ends here

				// code for trustee start here
				if($_POST['org_trustee_fileHidden'] !=""){
					$filename_trustee_db = $_POST['org_trustee_fileHidden'];
					$file_name_arr['org_trustee_filename'] =  $filename_trustee_db;
				}
				
				if(isset($_FILES['org_trustee_file']['name']) && !empty($_FILES['org_trustee_file']['name'])) {
					$filename_trustee_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-12A.'.$ext_trustee;
					$config['upload_path'] = NGO_TRUSTEE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-TRUSTEE';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_trustee_file')){
						$uploadData = $this->upload->data();
						$filename_trustee_db = $uploadData['file_name'];
						$file_name_arr['org_trustee_filename'] =  $filename_trustee_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_trustee_db) != trim($ngoDetails->org_trustee_file)) {
					$verficationFields[] = 'TRUSTEE Certifiicate' ;
					$verficationFieldsNewData['org_trustee_file'] = $filename_trustee_db ;
				}
				// code for trustee ends here
				
				if($_POST['officialseal_fileHidden'] !=""){
					$filename_stamp_db = $_POST['officialseal_fileHidden'];
					$file_name_arr['officialseal_filename'] =  $filename_stamp_db;
				}
				
				if(isset($_FILES['officialseal_file']['name']) && !empty($_FILES['officialseal_file']['name'])) {
					$filename_stamp_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-STAMP.'.$ext_stamp;
					$config['upload_path'] = NGO_STAMP_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-STAMP';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('officialseal_file')){
						$uploadData = $this->upload->data(); 
						$filename_stamp_db = $uploadData['file_name'];
						$file_name_arr['officialseal_filename'] =  $filename_stamp_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_stamp_db) != trim($ngoDetails->officialseal_file)) {
					$verficationFields[] = 'Seal Certifiicate' ;
					$verficationFieldsNewData['officialseal_file'] = $filename_stamp_db ;
				}
				
				if($_POST['signature_fileHidden'] !=""){
					$filename_sign_db = $_POST['signature_fileHidden'];
					$file_name_arr['signature_filename'] =  $filename_sign_db;
				}
				
				if(isset($_FILES['signature_file']['name']) && !empty($_FILES['signature_file']['name'])) {
					$filename_sign_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-SIGNATURE.'.$ext_sign;
					$config['upload_path'] = NGO_SIGNATURE_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_KB_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-SIGNATURE';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('signature_file')){
						$uploadData = $this->upload->data(); 
						$filename_sign_db = $uploadData['file_name'];
						$file_name_arr['signature_filename'] =  $filename_sign_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if(trim($filename_sign_db) != trim($ngoDetails->signature_file)) {
					$verficationFields[] = 'Signature Certifiicate' ;
					$verficationFieldsNewData['signature_file'] = $filename_sign_db ;
				}
				
				
				if($_POST['csr_fileHidden'] !=""){
					$filename_csr_db = $_POST['csr_fileHidden'];
					$file_name_arr['csr_filename'] =  $filename_csr_db;
				}
				
				if(isset($_FILES['csr_file']['name']) && !empty($_FILES['csr_file']['name'])) {
					$filename_csr_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-CSR.'.$ext_csr;
					$config['upload_path'] = NGO_CSR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';	
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-CSR';
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('csr_file')){
						$uploadData = $this->upload->data();
						$filename_csr_db = $uploadData['file_name'];
						$file_name_arr['csr_filename'] =  $filename_csr_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}	

				if(trim($filename_csr_db) != trim($ngoDetails->csr_file)) {
					$verficationFields[] = 'CSR Certifiicate' ;	
					$verficationFieldsNewData['csr_file'] = $filename_csr_db ;
				}
				
			}

			// code for cin start here
			$org_cin_number = $_POST['org_cin_number'];
			if(trim($org_cin_number) != trim(base64_decode($ngoDetails->cin_no))) {
				$verficationFields[] = 'CIN Number' ;
				$verficationFieldsNewData['cin_no'] = trim(base64_encode($org_cin_number)) ;
			}
			// code for cin ends here
			
			$org_gst_number = $_POST['org_gst_number'];
			if(trim($org_gst_number) != trim(base64_decode($ngoDetails->gst_no))) {
				$verficationFields[] = 'GST Number' ;
				$verficationFieldsNewData['gst_no'] = trim(base64_encode($org_gst_number)) ;
			}

			// code for pan number start here
			$org_pan_number = $_POST['org_pan_number'];
			if(trim($org_pan_number) != trim(base64_decode($ngoDetails->pan_no))) {
				$verficationFields[] = 'PAN Number' ;
				$verficationFieldsNewData['pan_no'] = trim(base64_encode($org_pan_number)) ;
			}
			// code for pan number ends here
			
			$org_80g_number = $_POST['org_80g_number'];
			if(trim($org_80g_number) != trim(base64_decode($ngoDetails->org_80g_no))) {
				$verficationFields[] = '80G Number' ;
				$verficationFieldsNewData['org_80g_no'] = trim(base64_encode($org_80g_number)) ;
			}


			// code for 80G start date and end date
			$org_80g_start_date = $_POST['org_80g_start_date'];
			if(trim($org_80g_start_date) != trim($ngoDetails->org_80g_start_date)) {
				$verficationFields[] = '80G START_DATE' ;
				$verficationFieldsNewData['org_80g_start_date'] = trim($org_80g_start_date) ;
			}

			$org_80g_end_date = $_POST['org_80g_end_date'];
			if(trim($org_80g_end_date) != trim($ngoDetails->org_80g_end_date)) {
				$verficationFields[] = '80G END_DATE' ;
				$verficationFieldsNewData['org_80g_end_date'] = trim($org_80g_end_date) ;
			}
			
			// code for 80g start date and end date


			
			$org_fcra_number = $_POST['org_fcra_number'];
			if(trim($org_fcra_number) != trim(base64_decode($ngoDetails->fcra_no))) {
				$verficationFields[] = 'FCRA Number' ;
				$verficationFieldsNewData['fcra_no'] = trim(base64_encode($org_fcra_number)) ;
				
			}

			// code for fcra start date and end date
			
			$org_fcra_start_date = $_POST['org_fcra_start_date'];
			if(trim($org_fcra_start_date) != trim($ngoDetails->org_fcra_start_date)) {
				$verficationFields[] = 'fcra START_DATE' ;
				$verficationFieldsNewData['org_fcra_start_date'] = trim($org_fcra_start_date) ;
			}

			$org_fcra_end_date = $_POST['org_fcra_end_date'];
			if(trim($org_fcra_end_date) != trim($ngoDetails->org_fcra_end_date)) {
				$verficationFields[] = 'fcra END_DATE' ;
				$verficationFieldsNewData['org_fcra_end_date'] = trim($org_fcra_end_date) ;
			}
			// code for fcra start date and end date
			
			$org_35ac_number = $_POST['org_35ac_number'];
			if(trim($org_35ac_number) != trim(base64_decode($ngoDetails->org_35ac_no))) {
				$verficationFields[] = '35AC Number' ;
				$verficationFieldsNewData['org_35ac_no'] = trim(base64_encode($org_35ac_number));
			}


			// code for 35ac start date and end date
			
			$org_35ac_start_date = $_POST['org_35ac_start_date'];
			if(trim($org_35ac_start_date) != trim($ngoDetails->org_35ac_start_date)) {
				$verficationFields[] = '35ac START_DATE' ;
				$verficationFieldsNewData['org_35ac_start_date'] = trim($org_35ac_start_date) ;
			}

			$org_35ac_end_date = $_POST['org_35ac_end_date'];
			if(trim($org_35ac_end_date) != trim($ngoDetails->org_35ac_end_date)) {
				$verficationFields[] = '35ac END_DATE' ;
				$verficationFieldsNewData['org_35ac_end_date'] = trim($org_35ac_end_date) ;
			}
			// code for 35ac start date and end date

			// coded start for 12A certificate 
			$org_12a_number = $_POST['org_12a_number'];
			if(trim($org_12a_number) != trim(base64_decode($ngoDetails->org_12a_no))) {
				$verficationFields[] = '12A Number' ;
				$verficationFieldsNewData['org_12a_no'] = trim(base64_encode($org_12a_number));
			}

			// code for 12a start date
			$org_12a_start_date = $_POST['org_12a_start_date'];
			if(trim($org_12a_start_date) != trim($ngoDetails->org_12a_start_date)) {
				$verficationFields[] = '12a START_DATE' ;
				$verficationFieldsNewData['org_12a_start_date'] = trim($org_12a_start_date) ;
			}

			$org_12a_end_date = $_POST['org_12a_end_date'];
			if(trim($org_12a_end_date) != trim($ngoDetails->org_12a_end_date)) {
				$verficationFields[] = '12a END_DATE' ;
				$verficationFieldsNewData['org_12a_end_date'] = trim($org_12a_end_date) ;
			}
			// code for 12a end date

			// code ends for 12A certificate
			
			$org_trustee_number = $_POST['org_trustee_number'];
			if(trim($org_trustee_number) != trim(base64_decode($ngoDetails->org_trustee_no))) {
				$verficationFields[] = 'Document Date' ;
				$verficationFieldsNewData['org_trustee_no'] = trim(base64_encode($org_trustee_number)) ;
			}
			
			$csr_number = $_POST['csr_number'];
			if(trim($csr_number) != trim(base64_decode($ngoDetails->csr_num))) {
				$verficationFields[] = 'CSR Number' ;
				$verficationFieldsNewData['csr_num'] = trim(base64_encode($csr_number)) ;
			}
			
			// print_r($updatedFields );
			// print_r($updatedFieldsOldData );
			// print_r($updatedFieldsNewData );
			// print_r($verficationFields );
			
			$newdata = array(
				   'updatedFields'  => $updatedFields,
				   'updatedFieldsOldData'   => $updatedFieldsOldData,
				   'updatedFieldsNewData'   => $updatedFieldsNewData,
				   'verficationFields'   => $verficationFields,
				   'verficationFieldsNewData'   => $verficationFieldsNewData,
			   );
			$this->session->set_userdata($newdata);
			
			echo json_encode(array('flag'=>1, 'msg'=>""));
			exit;
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
	
	public function ngoRequestEditForm3(){
		$UserId = $_SESSION['UserId'];
		// echo '<pre>';
		// print_r($_POST);print_r($_FILES);//exit;
		
		$updatedFields = $_SESSION['updatedFields'];
		$updatedFieldsOldData = $_SESSION['updatedFieldsOldData'];
		$updatedFieldsNewData = $_SESSION['updatedFieldsNewData'];
		$verficationFields = $_SESSION['verficationFields'];
		$verficationFieldsNewData = $_SESSION['verficationFieldsNewData'];
		
		// print_r($updatedFields );
		// print_r($updatedFieldsOldData );
		// print_r($updatedFieldsNewData );
		// print_r($verficationFields );
		// print_r($updatedFieldsNewData );
		
		
		// exit;
		
		$primarySourceType_arr = array();
		$primarySourceType = '';
		
		$filename_year1_db = '';
		$filename_year2_db = '';
		$filename_year3_db = '';
		$filename_year4_db = '';
		$filename_year5_db = '';
		$filename_year6_db = '';
		
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
			$filesizee_year5 = $_FILES['org_year_5_file']['size'];
			
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
			
			/*if((empty($_POST['primarySourceType']) || empty($_POST['year1_net_worth']) || empty($_POST['year1_turnover']) || empty($_POST['year1_net_profit']) || (empty($_FILES['org_year_1_file']['name'] ) && $_POST['org_year_1_fileHidden'] == "")) && $monthDiff > 18)
			{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year."));
				exit;
			}else if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {*/
				
			if(!empty($filename_year1) && !in_array($ext_year1, $allowed)) {
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
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields for First Year....."));
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
				
				if(isset($_POST['primarySourceType'])){
					$primarySourceType = implode(',',$primarySourceType_arr);
					$primarySourceType = ','.$primarySourceType.',';					
				}
				if(trim($primarySourceType) != trim($ngoDetails->primary_source_type)) {
					$updatedFields[] = 'Primary Source Type' ;
					$updatedFieldsOldData['primary_source_type'] = trim($ngoDetails->primary_source_type) ;
					$updatedFieldsNewData['primary_source_type'] = trim($primarySourceType) ;
				}
				
				if($_POST['org_year_1_fileHidden'] !="")
				{
					$filename_year1_db = $_POST['org_year_1_fileHidden'];
					$file_name_arr['filename_year1'] =  $filename_year1_db;
				}
				if(isset($_FILES['org_year_1_file']['name']) && !empty($_FILES['org_year_1_file']['name'])) {
					$filename_year1_db = $UserId.'-year1-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year1;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-year1-'.strtotime(date('Y-m-d H:i:s'));

				   //Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_year_1_file')){
						$uploadData = $this->upload->data();
						$filename_year1_db = $uploadData['file_name'];
						$file_name_arr['filename_year1'] =  $filename_year1_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if($_POST['org_year_2_fileHidden'] !="")
				{
					$filename_year2_db = $_POST['org_year_2_fileHidden'];
					$file_name_arr['filename_year2'] =  $filename_year2_db;
				}
				if(isset($_FILES['org_year_2_file']['name']) && !empty($_FILES['org_year_2_file']['name'])) {
					$filename_year2_db = $UserId.'-year2-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year2;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-year2-'.strtotime(date('Y-m-d H:i:s'));

				   //Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_year_2_file')){
						$uploadData = $this->upload->data();
						$filename_year2_db = $uploadData['file_name'];
						$file_name_arr['filename_year2'] =  $filename_year2_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if($_POST['org_year_3_fileHidden'] !="")
				{
					$filename_year3_db = $_POST['org_year_3_fileHidden'];
					$file_name_arr['filename_year3'] =  $filename_year3_db;
				}
				if(isset($_FILES['org_year_3_file']['name']) && !empty($_FILES['org_year_3_file']['name'])) {
					$filename_year3_db = $UserId.'-year3-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year3;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-year3-'.strtotime(date('Y-m-d H:i:s'));

				   //Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_year_3_file')){
						$uploadData = $this->upload->data();
						$filename_year3_db = $uploadData['file_name'];
						$file_name_arr['filename_year3'] =  $filename_year3_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if($_POST['org_year_4_fileHidden'] !="")
				{
					$filename_year4_db = $_POST['org_year_4_fileHidden'];
					$file_name_arr['filename_year4'] =  $filename_year4_db;
				}
				if(isset($_FILES['org_year_4_file']['name']) && !empty($_FILES['org_year_4_file']['name'])) {
					$filename_year4_db = $UserId.'-year4-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year4;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-year4-'.strtotime(date('Y-m-d H:i:s'));

				   //Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_year_4_file')){
						$uploadData = $this->upload->data();
						$filename_year4_db = $uploadData['file_name'];
						$file_name_arr['filename_year4'] =  $filename_year4_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if($_POST['org_year_5_fileHidden'] !="")
				{
					$filename_year5_db = $_POST['org_year_5_fileHidden'];
					$file_name_arr['filename_year5'] =  $filename_year5_db;
				}
				if(isset($_FILES['org_year_5_file']['name']) && !empty($_FILES['org_year_5_file']['name'])) {
					$filename_year5_db = $UserId.'-year5-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year5;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-year5-'.strtotime(date('Y-m-d H:i:s'));

				   //Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_year_5_file')){
						$uploadData = $this->upload->data();
						$filename_year5_db = $uploadData['file_name'];
						$file_name_arr['filename_year5'] =  $filename_year5_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
				
				if($_POST['org_year_6_fileHidden'] !="")
				{
					$filename_year6_db = $_POST['org_year_6_fileHidden'];
					$file_name_arr['filename_year6'] =  $filename_year6_db;
				}
				if(isset($_FILES['org_year_6_file']['name']) && !empty($_FILES['org_year_6_file']['name'])) {
					$filename_year6_db = $UserId.'-year6-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext_year6;
					$config['upload_path'] = NGO_YEAR_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
					$config['file_name'] = $UserId.'-year6-'.strtotime(date('Y-m-d H:i:s'));

				   //Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('org_year_6_file')){
						$uploadData = $this->upload->data();
						$filename_year6_db = $uploadData['file_name'];
						$file_name_arr['filename_year6'] =  $filename_year6_db;
					} else {
						echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
						exit;
					}
				}
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
			
			if($filename_year1_db != ''){	
				if(trim($year1_net_worth) != trim($ngoDetails->year1_net_worth)) {
					$verficationFields[] = 'Year 1 Net Worth' ;
					$verficationFieldsNewData['year1_net_worth'] = trim($year1_net_worth) ;
				}
			
				if(trim($year1_turnover) != trim($ngoDetails->year1_turnover)){
					$verficationFields[] = 'Year 1 Donations / Contributions Received' ;
					$verficationFieldsNewData['year1_turnover'] = trim($year1_turnover) ;
				}
				if(trim($year1_net_profit) != trim($ngoDetails->year1_net_profit)) {
					$verficationFields[] = 'Year 1 Balance Corpus' ;
					$verficationFieldsNewData['year1_net_profit'] = trim($year1_net_profit) ;
				}
				if(trim($filename_year1_db) != trim($ngoDetails->year1_file)) {
					$verficationFields[] = 'Year 1 File' ;
					$verficationFieldsNewData['year1_file'] = trim($filename_year1_db) ;
				}
			}
			
			if($filename_year2_db != ''){	
				if(trim($year2_net_worth) != trim($ngoDetails->year2_net_worth)) {
					$verficationFields[] = 'Year 2 Net Worth' ;
					$verficationFieldsNewData['year2_net_worth'] = trim($year2_net_worth) ;
				}
				if(trim($year2_turnover) != trim($ngoDetails->year2_turnover)){
					$verficationFields[] = 'Year 2 Donations / Contributions Received' ;
					$verficationFieldsNewData['year2_turnover'] = trim($year2_turnover) ;
				}
				if(trim($year2_net_profit) != trim($ngoDetails->year2_net_profit)) {
					$verficationFields[] = 'Year 2 Balance Corpus' ;
					$verficationFieldsNewData['year2_net_profit'] = trim($year2_net_profit) ;
				}
				if(trim($filename_year2_db) != trim($ngoDetails->year2_file)) {
					$verficationFields[] = 'Year 2 File' ;
					$verficationFieldsNewData['year2_file'] = trim($filename_year2_db) ;
				}
			}
			
			if($filename_year3_db != ''){	
				if(trim($year3_net_worth) != trim($ngoDetails->year3_net_worth)) {
					$verficationFields[] = 'Year 3 Net Worth' ;
					$verficationFieldsNewData['year3_net_worth'] = trim($year3_net_worth) ;
				}
				if(trim($year3_turnover) != trim($ngoDetails->year3_turnover)){
					$verficationFields[] = 'Year 3 Donations / Contributions Received' ;
					$verficationFieldsNewData['year3_turnover'] = trim($year3_turnover) ;
				}
				if(trim($year3_net_profit) != trim($ngoDetails->year3_net_profit)) {
					$verficationFields[] = 'Year 3 Balance Corpus' ;
					$verficationFieldsNewData['year3_net_profit'] = trim($year3_net_profit) ;
				}
				if(trim($filename_year3_db) != trim($ngoDetails->year3_file)) {
					$verficationFields[] = 'Year 3 File' ;
					$verficationFieldsNewData['year3_file'] = trim($filename_year3_db) ;
				}
			}
			
			if($filename_year4_db != ''){	
				if(trim($year4_net_worth) != trim($ngoDetails->year4_net_worth)) {
					$verficationFields[] = 'Year 4 Net Worth' ;
					$verficationFieldsNewData['year4_net_worth'] = trim($year4_net_worth) ;
				}
				if(trim($year4_turnover) != trim($ngoDetails->year4_turnover)){
					$verficationFields[] = 'Year 4 Donations / Contributions Received' ;
					$verficationFieldsNewData['year4_turnover'] = trim($year4_turnover) ;
				}
				if(trim($year4_net_profit) != trim($ngoDetails->year4_net_profit)) {
					$verficationFields[] = 'Year 4 Balance Corpus' ;
					$verficationFieldsNewData['year4_net_profit'] = trim($year4_net_profit) ;
				}
				if(trim($filename_year4_db) != trim($ngoDetails->year4_file)) {
					$verficationFields[] = 'Year 4 File' ;
					$verficationFieldsNewData['year4_file'] = trim($filename_year4_db) ;
				}
			}
			
			if($filename_year5_db != ''){	
				if(trim($year5_net_worth) != trim($ngoDetails->year5_net_worth)) {
					$verficationFields[] = 'Year 5 Net Worth' ;
					$verficationFieldsNewData['year5_net_worth'] = trim($year5_net_worth) ;
				}
				if(trim($year5_turnover) != trim($ngoDetails->year5_turnover)){
					$verficationFields[] = 'Year 5 Donations / Contributions Received' ;
					$verficationFieldsNewData['year5_turnover'] = trim($year5_turnover) ;
				}
				if(trim($year5_net_profit) != trim($ngoDetails->year5_net_profit)) {
					$verficationFields[] = 'Year 5 Balance Corpus' ;
					$verficationFieldsNewData['year5_net_profit'] = trim($year5_net_profit) ;
				}
				if(trim($filename_year5_db) != trim($ngoDetails->year5_file)) {
					$verficationFields[] = 'Year 5 File' ;
					$verficationFieldsNewData['year5_file'] = trim($filename_year5_db) ;
				}
			}
			
			if($filename_year6_db != ''){	
				if(trim($year6_net_worth) != trim($ngoDetails->year6_net_worth)) {
					$verficationFields[] = 'Year 6 Net Worth' ;
					$verficationFieldsNewData['year6_net_worth'] = trim($year6_net_worth) ;
				}
				if(trim($year6_turnover) != trim($ngoDetails->year6_turnover)){
					$verficationFields[] = 'Year 6 Donations / Contributions Received' ;
					$verficationFieldsNewData['year6_turnover'] = trim($year6_turnover) ;
				}
				if(trim($year6_net_profit) != trim($ngoDetails->year6_net_profit)) {
					$verficationFields[] = 'Year 6 Balance Corpus' ;
					$verficationFieldsNewData['year6_net_profit'] = trim($year6_net_profit) ;
				}
				if(trim($filename_year6_db) != trim($ngoDetails->year6_file)) {
					$verficationFields[] = 'Year 6 File' ;
					$verficationFieldsNewData['year6_file'] = trim($filename_year6_db) ;
				}
			}
			
			// print_r($updatedFields );
			// print_r($updatedFieldsOldData );
			// print_r($updatedFieldsNewData );
			// print_r($verficationFields );
			// print_r($verficationFieldsNewData );
			
			$newdata = array(
				   'updatedFields'  => $updatedFields,
				   'updatedFieldsOldData'   => $updatedFieldsOldData,
				   'updatedFieldsNewData'   => $updatedFieldsNewData,
				   'verficationFields'   => $verficationFields,
				   'verficationFieldsNewData'   => $verficationFieldsNewData,
			   );

			$this->session->set_userdata($newdata);
		
			echo json_encode(array('flag'=>1, 'msg'=>""));
			exit;
			
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}	
	}
	public function ngoRequestEditForm4(){
		$UserId = $_SESSION['UserId'];
		//echo '<pre>';
		// print_r($_POST);print_r($_FILES);//exit;
		
		$updatedFields = $_SESSION['updatedFields'];

		$updatedFieldsOldData = $_SESSION['updatedFieldsOldData'];
		$updatedFieldsNewData = $_SESSION['updatedFieldsNewData'];
		$verficationFields = $_SESSION['verficationFields'];
		$verficationFieldsNewData = $_SESSION['verficationFieldsNewData'];
		
		// print_r($updatedFields );
		// print_r($updatedFieldsOldData );
		// print_r($updatedFieldsNewData );
		// print_r($verficationFields );
		// print_r($verficationFieldsNewData );
		
		// exit;
		
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
			/*else if(count(array_filter($fullName)) != count($fullName)){*/
				echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;
				
			}else{
				//$ngoDetails	= $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
				$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);				
				$ngoDetails = $this->MyprofileModel->getNgoDetailsById($UserId);
				$boardMembersData	= $this->NgoModel->getNgoBoardMembersData($ngoDetails->id);
				
				$deleted_member_ids = isset($_POST['deleted_member_ids'])?$_POST['deleted_member_ids']:'';
			
				$resultDeleteArray = array();
				$resultUpdateData = array();
				$resultUpdateArray = array();
				$boardUpdateData = array();
				$insertData=array();
				
				if(isset($hiddenPhotograph) && count($hiddenPhotograph)>0){
					$photographArr = array_filter($_FILES['photograph']['name']);
					
					$resultDeleteArray=array_intersect_key($hiddenPhotograph,$photographArr);
					//print_r($resultDeleteArray);
					
					$resultUpdateArray=array_diff_key($hiddenPhotograph,$photographArr);
					if(isset($resultUpdateArray) && count($resultUpdateArray)>0){
						
						foreach($resultUpdateArray as $key=>$value){
							
							$fullNameVal	= $fullName_arr[$key];
							// $emailVal	= $email_arr[$key];
							// $contactNoVal	= $contactNo_arr[$key];
							$emailVal	= $email[$key];
							$contactNoVal	= $contactNo[$key];
							$photoId = $_POST['hiddenPhotographId'][$key]; 
							$roleVal	= $role[$key];
							$designationVal	= $designation[$key];
							$statusVal	= $status[$key];
							$HashPasswordVal	= $HashPassword[$key];
							
							$result = $this->db->get_where('ngo_board_members',array('id'=>$photoId,'ngo_id'=>$ngoDetails->id))->row();		
							//print_r($result);
							// echo $photoId;
							$hiddenPhotoVal = $_POST['hiddenPhotograph'][$key]; 
							
							if($fullNameVal != $result->full_name || $emailVal != $result->email || $contactNoVal != $result->phone_no || $hiddenPhotoVal != $result->photograph){
								$resultUpdateData[] = $photoId;
							}
							
							$boardUpdateData[]=array(  'ngo_id'		=> $ngoDetails->id,
												'full_name'		=> $fullNameVal,
												'email'			=> $emailVal,
												'phone_no'		=> $contactNoVal,
												'photograph'	=> $hiddenPhotoVal,
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
												'password'		=> $HashPasswordVal,
												'designation'	=> $designationVal,
												'role'			=> $roleVal,
												'status'		=> $statusVal,
												// 'id'		=> $photoId,
												);
							// print_r($boardUpdateData);	die();
							// $this->db->where('id',$photoId);					
							// $this->db->update('ngo_board_members', $boardUpdateData);
						}
						// $query = $this->db->update_batch('ngo_board_members',$boardUpdateData,'id');
										
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
									$insertData[]=array(  'ngo_id'		=> $ngoDetails->id,
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
														
									// $this->db->insert('ngo_board_members', $insertData);
								}
							}else {
								echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
								exit;
							}
						}else{
							if(empty($photoId)){
								// echo $foundedByVal.'22222';
								$insertData[]=array(  'ngo_id'		=> $ngoDetails->id,
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
													
								// $this->db->insert('ngo_board_members', $insertData);
							}
						}					
					}
				}
				
				//if((is_array($updatedFields) && count($updatedFields) > 0) || (is_array($verficationFields) && count($verficationFields) > 0)){
					
					if (date('m') >= 4 ) {
						$Y = date('Y') - 1;
					}
					else {
						$Y = date('Y') - 2;
					}
					
					$SY=$Y."-04-01";
					$pt = $Y+1;
					$EY=$pt."-03-31";
					
					$insertUpdatedata = array( 
						'user_id' => $UserId, 
						'ngo_id'	 => $ngoDetails->id,
						'year1' 	=> date('Y', strtotime($SY)), 
						'year2' 	=> date('Y', strtotime($SY))-1,
						'year3' 	=> date('Y', strtotime($SY))-2,
						'year4' 	=> date('Y', strtotime($SY))-3,
						'year5' 	=> date('Y', strtotime($SY))-4,
						'year6' 	=> date('Y', strtotime($SY))-5,
						'verification_field_count' => count($verficationFields),
						'created_at' => strtotime(date('Y-m-d H:i:s')),
					);
					
					$insertUpdatedata = array_merge($insertUpdatedata,$updatedFieldsNewData);
					if(is_array($verficationFields) && count($verficationFields) > 0){
						$insertUpdatedata = array_merge($insertUpdatedata,$verficationFieldsNewData);
					}
					//print_r($updatedata);
					$isInsert = $this->db->insert('edit_ngo_details', $insertUpdatedata);
					$LastInsertID= $this->db->insert_id();
					

					if(is_array($updatedFieldsNewData) && count($updatedFieldsNewData) > 0){
						if($isInsert){
							if (date('m') >= 4 ) {
								$Y = date('Y') - 1;
							}
							else {
								$Y = date('Y') - 2;
							}
							
							$SY=$Y."-04-01";
							$pt = $Y+1;
							$EY=$pt."-03-31";
							
							$insertLogdata = array( 
								'edit_ngo_id' => $LastInsertID, 
								'user_id' => $UserId, 
								'ngo_id'	 => $ngoDetails->id,
								'year1' 	=> date('Y', strtotime($SY)), 
								'year2' 	=> date('Y', strtotime($SY))-1,
								'year3' 	=> date('Y', strtotime($SY))-2,
								'year4' 	=> date('Y', strtotime($SY))-3,
								'year5' 	=> date('Y', strtotime($SY))-4,
								'year6' 	=> date('Y', strtotime($SY))-5,
								'created_at' => strtotime(date('Y-m-d H:i:s')),
							);
							
							$insertLogdata = array_merge($insertLogdata,$updatedFieldsOldData);
							$this->db->insert('log_ngo_details', $insertLogdata);
							$LogLastInsertID= $this->db->insert_id();
						}
					
						$this->db->where('id', $ngoDetails->id);
						$this->db->update('ngo_details', $updatedFieldsNewData);
					}
				//}
				
				if(is_array($verficationFields) && count($verficationFields) > 0){
					$updateData = array( 
						// 'status'=> 8, change status from 8 to 1 becaseu we don't want any type of stuck for implementer
						'status'=> 1,
						'updated_at'=> strtotime(date('Y-m-d H:i:s')),
					);
					$this->db->where('id', $UserId);
					$this->db->update('users', $updateData);
				}
				
				if((trim($deleted_member_ids) != '') || (count($resultDeleteArray) > 0) || (count($resultUpdateData) > 0) || (count($insertData) > 0)){
					$updatedFields[] = 'Board Member' ;
					
					$isInsert = '';
					//print_r($boardMembersData);
					//print_r($boardUpdateData);
					//print_r($insertData);
					
					$editdata = array_merge($boardUpdateData,$insertData);
					
					// echo '<pre>'; print_r($editdata);echo '</pre>';
					if(isset($editdata) && count($editdata) > 0){
						foreach($editdata as $key=>$value){
							$insertEditData[]=array(  
												'edit_ngo_id'	=> $LastInsertID,
												'ngo_id'		=> $value['ngo_id'],
												'full_name'		=> $value['full_name'],
												'email'			=> $value['email'],
												'phone_no'		=> $value['phone_no'],
												'photograph'	=> (isset($value['photograph']))?$value['photograph']:'',
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
												'password'		=> $value['password'],
												'designation'	=> $value['designation'],
												'role'			=> $value['role'],
												'status'		=> $value['status'],
											);
							
						}
						
						// echo '<pre>'; print_r($insertEditData); echo '</pre>';die();
						$isInsert = $this->db->insert_batch('edit_ngo_board_members',$insertEditData);
					}
					if(isset($boardMembersData) && count($boardMembersData) > 0){
						foreach($boardMembersData as $key=>$value){
							
							$insertLogData[]=array(  
												'edit_ngo_id'	=> $LastInsertID,
												'ngo_id'		=> $value->ngo_id,
												'full_name'		=> $value->full_name,
												'email'			=> $value->email,
												'phone_no'		=> $value->phone_no,
												'photograph'	=> $value->photograph,
												'password'		=> $value->password,
												'designation'	=> $value->designation,
												'role'			=> $value->role,
												'status'		=> $value->status,
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
											);
							
						}
						
						//print_r($insertLogData);
						$isInsert = $this->db->insert_batch('log_ngo_board_members',$insertLogData);
					}
					if($isInsert){
						if(isset($deleted_member_ids) && $deleted_member_ids != '')
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
						
						if(isset($resultDeleteArray) && count($resultDeleteArray)>0){
							foreach($resultDeleteArray as $key=>$value){
								
								$delPhotoId = $_POST['hiddenPhotographId'][$key]; 
								
								$this->db->where('id',$delPhotoId);
								$this->db->delete('ngo_board_members');
								
							}
						}
						
						if(isset($resultUpdateArray) && count($resultUpdateArray)>0){
						
							foreach($resultUpdateArray as $key=>$value){
								
								$fullNameVal	= $fullName_arr[$key];
								// $emailVal	= $email_arr[$key];
								// $contactNoVal	= $contactNo_arr[$key];
								$emailVal	= $email[$key];
								$contactNoVal	= $contactNo[$key];
								$photoId = $_POST['hiddenPhotographId'][$key]; 
								//echo $photoId;
								$hiddenPhotoVal = $_POST['hiddenPhotograph'][$key]; 
								$roleVal	= $role[$key];
								$designationVal	= $designation[$key];
								$statusVal	= $status[$key];
								$HashPasswordVal	= $HashPassword[$key]; 
								
								$update=array(  'ngo_id'		=> $ngoDetails->id,
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
								//print_r($update);	
								$this->db->where('id',$photoId);					
								$this->db->update('ngo_board_members', $update);
							}
						}
						
						//print_r($insertData);
						if(isset($insertData) && count($insertData)>0){
							$isInsert = $this->db->insert_batch('ngo_board_members',$insertData);
						}
					}
				} 
				
				$newdata = array(
					   'updatedFields'  => $updatedFields,
					   'updatedFieldsOldData'   => $updatedFieldsOldData,
					   'updatedFieldsNewData'   => $updatedFieldsNewData,
					   'verficationFields'   => $verficationFields,
					   'verficationFieldsNewData'   => $verficationFieldsNewData,
				   );


				$this->session->set_userdata($newdata);
			
				// print_r($updatedFields );
				// print_r($updatedFieldsOldData );
				// print_r($updatedFieldsNewData );
				// print_r($verficationFields );
				// print_r($verficationFieldsNewData );
				$redirect = base_url() . "myprofile";
				if(is_array($updatedFields) && count($updatedFields) > 0){
					$notification_text = 'Implementer has updated the profile';
					$link = '<a href="/admin.php/partner/partnerEditRequestLogView/'.$LastInsertID.'">View the detials here</a>';
					
					$assignedDetails = $this->CommonModel->getNgoAssigned($ngoDetails->id);
					//print_r($assignedDetails);exit;
					if(!empty($assignedDetails) ){
						$insertdata = array(
						   'from_user_id' 	=> $UserId, 
						   'to_user_id'		=> $assignedDetails->id,
						   'type'		=> $UserDetails->type,
						   'area_id' 		=> $ngoDetails->id,
						   'notification_text'=> $notification_text,
						   'link' 			=> $link, 
						   'type_of_notification' => 1,
						   'created_at'   	=> strtotime(date('Y-m-d H:i:s')),
						);
						
						$this->db->insert('adminuser_notifications', $insertdata);
					}
					
					$redirect = base_url() . "myprofile";
				}
				
				if(is_array($verficationFields) && count($verficationFields) > 0){
					
					$verficationFieldsStr = '';
					foreach($verficationFields as $k=>$v) {	
						$verficationFieldsStr .= $v.", ";
					}
					$verficationFieldsStr = substr($verficationFieldsStr,0,-2);
						
					$GlobalMsgDetails = $this->CommonModel->getGlobalMsgByCode('admin_request_an_edit_recieved');
					
					$dyn_Var = array('##ORG_NAME##');
					$temp_Var = array($ngoDetails->org_name);
					
					$GlobalMsg = str_replace($dyn_Var, $temp_Var, $GlobalMsgDetails->msg);
			
					//$GlobalMsg = $GlobalMsgDetails->msg;
						
					$notification_text = $GlobalMsg.' Edited fields: '.$verficationFieldsStr;
					$link = '<a href="/admin.php/partner/verify/'.$ngoDetails->id.'/'.$LastInsertID.'">View the detials here</a>';
					
					$assignedDetails = $this->CommonModel->getNgoAssigned($ngoDetails->id);
					//print_r($assignedDetails);exit;
					if(!empty($assignedDetails) ){
						$insertdata = array(
						   'from_user_id' 	=> $UserId, 
						   'to_user_id'		=> $assignedDetails->id,
						   'type'		=> $UserDetails->type,
						   'area_id' 		=> $ngoDetails->id,
						   'notification_text'=> $notification_text,
						   'link' 			=> $link, 
						   'type_of_notification' => 1,
						   'created_at'   	=> strtotime(date('Y-m-d H:i:s')),
						);
						
						$this->db->insert('adminuser_notifications', $insertdata);
					}

					// Email send to admin when user edit the kyc process (code write on 02-08-2022)
					// $get_rm_id = $this->db->get_where('users',array('id'=>$UserId))->row();
					$notifications_text = $notification_text;
					$Link = '<a href="'.BASE_URL.'admin.php/partner/verify/'.$ngoDetails->id.'/'.$LastInsertID.'" target="_blank">View the detials here</a>';
					$templateId = 49;
					$to= $assignedDetails->email;               
					$UserNameEmail =$assignedDetails->first_name.' '.$assignedDetails->last_name;
					$TempVars = array();
					$DynamicVars = array();
					$TempVars = array("##USERNAME##","##NOTIFICATIONTEXT##","##LINK##");
					$DynamicVars   = array($UserNameEmail,$notifications_text,$Link);
					$this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars,$DynamicVars);

					// Email code ends here

					// Email code send to Implementor in the edit kyc process (code write on 02-08-2022)
					$get_implementor_details = $this->db->get_where('users',array('id'=>$UserId))->row();
					$Link = '<a href="'.BASE_URL.'discover" target="_blank">Click here to signin</a>';
					$templateId = 50;
					$to= $get_implementor_details->email;                
					$UserNameEmail =$get_implementor_details->first_name.' '.$get_implementor_details->last_name;
					$TempVars = array();
					$DynamicVars = array();
					$TempVars = array("##USERNAME##","##LINK##");
					$DynamicVars   = array($UserNameEmail,$Link);
					$this->CommonModel->sendCommonHTMLEmail($to, $templateId, $TempVars,$DynamicVars);
					// Email code ends here
					
					$redirect = base_url() . "discover";
				}
				
				echo json_encode(array('flag'=>1, 'msg'=>"Your Request Submitted Successfully.", 'redirect'=>$redirect));
				exit;
			}
		}else{
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			exit;
		}
	}
}
