<?php
defined('BASEPATH') OR exit('No direct script access allowed');
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Neha Raut (neha.raut@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2019
###+------------------------------------------------------------------------------------------------

class Companyrequestedit extends CI_Controller {

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
	
	public function getContributorRequestForEditView()
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
			
			if($UserDetails->type == 2)
			{
				//redirect(base_url());
				$userId = $this->uri->segment(2);
			
				$data['PageTitle'] = SITE_NAME.' : Myprofile - Request An Edit';	
				$data['State']= $this->CommonModel->get_state();
				$data['Co_Organization_Type']= $this->CommonModel->get_corporate_organization_type();				
				$data['userType'] = $UserDetails->type ;
				$data['companyDetails'] = $companyDetails=$this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				$data['boardMembersData']=$boardMembersData	= $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);	
				$data['team_member_counter']= (isset($boardMembersData) && count($boardMembersData)>0)?count($boardMembersData):1;
				
				/* echo'<pre>';
				print_r($data['ProfileDetails']);
				exit; */
				
				if($data['companyDetails']->user_id == $LoggedInUserId)
				{
					//add breadcrumb here....
					
					// $this->load->view('profile/requesteditform', $data);
					$this->load->view('profile/company_request_edit_form', $data);
				}
				else
				{
					redirect(base_url());
				}
			}
		}   
	}
	
	public function companyRequestEditForm1(){

		//print_r($_POST);exit;
		$UserId = $_SESSION['UserId'];
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

			if(empty($_POST['companyAddress1']) || empty($_POST['companyAddress2']) || empty($_POST['companyAbout'])){
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
				
				$updatedFields = array();
				$updatedFieldsOldData = array();
				$updatedFieldsNewData = array();
				$verficationFields = array();
				$verficationFieldsNewData = array();
				
				$companyDetails= $this->MyprofileModel->getCompanyDetailsById($UserId);
				//print_r($companyDetails);exit;
				
				if($_POST['companyLogoHidden'] !="")
				{
					$filename = $_POST['companyLogoHidden'];
				}

				if(isset($_FILES['companyLogo']['name']) && !empty($_FILES['companyLogo']['name'])) { 

					$file_name = $_FILES['companyLogo']['name'];
					$filename = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'.'.$ext;
					$config['upload_path'] = COMPANY_LOGO_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s'));

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
				
				if(trim($filename) != trim($companyDetails->company_logo)) {
					$updatedFields[] = 'Organization Logo' ;
					$updatedFieldsOldData['company_logo'] = trim($companyDetails->company_logo) ;
					$updatedFieldsNewData['company_logo'] = trim($filename) ;
				}
				
				if((trim($_POST['companyAddress1']) != trim($companyDetails->company_address_1))){
					$updatedFields[] = 'Address1' ;
					$updatedFieldsOldData['company_address_1'] = trim($companyDetails->company_address_1) ;
					$updatedFieldsNewData['company_address_1'] = trim($_POST['companyAddress1']) ;
				} 
				
				if((trim($_POST['companyAddress2']) != trim($companyDetails->company_address_2))){ 
					$updatedFields[] = 'Address2' ;
					$updatedFieldsOldData['company_address_2'] = trim($companyDetails->company_address_2) ;
					$updatedFieldsNewData['company_address_2'] = trim($_POST['companyAddress2']) ;
				}
				
				if($_POST['companyAddProofHidden'] !="")
				{
					$filename_add_proof = $filename_add_proof_db = $_POST['companyAddProofHidden'];
				}
				
				if(isset($_FILES['companyAddProof']['name']) && !empty($_FILES['companyAddProof']['name'])) { 

					$filename_add_proof = $file_name = $_FILES['companyAddProof']['name'];
					$filename_add_proof_db = $UserId.'-'.'ADD-PROOF'.'.'.$ext;
					$config['upload_path'] = COMPANY_ADD_PROOF_PATH;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $UserId.'-'.'ADD-PROOF';

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
				
				if(trim($filename_add_proof) != trim($companyDetails->address_proof)){ 
					$updatedFields[] = 'Address Proof' ;
					$updatedFieldsOldData['address_proof'] = trim($companyDetails->address_proof) ;
					$updatedFieldsNewData['address_proof'] = trim($filename_add_proof_db) ;
				}
				
				if(trim($_POST['companyPincode']) != trim($companyDetails->pincode)) {
					$updatedFields[] = 'Pincode' ;
					$updatedFieldsOldData['pincode'] = trim($companyDetails->pincode) ;
					$updatedFieldsNewData['pincode'] = trim($_POST['companyPincode']) ;
				}
				
				if(trim($_POST['companyState']) != trim($companyDetails->state)) {
					$updatedFields[] = 'State' ;
					$updatedFieldsOldData['state'] = trim($companyDetails->state) ;
					$updatedFieldsNewData['state'] = trim($_POST['companyState']) ;
				}
				
				if(trim($_POST['companyDistrict']) != trim($companyDetails->district)) {
					$updatedFields[] = 'District' ;
					$updatedFieldsOldData['district'] = trim($companyDetails->district) ;
					$updatedFieldsNewData['district'] = trim($_POST['companyDistrict']) ;
				}
				
				if(trim($_POST['companyCity']) != trim($companyDetails->city)) {
					$updatedFields[] = 'City' ;
					$updatedFieldsOldData['city'] = trim($companyDetails->city) ;
					$updatedFieldsNewData['city'] = trim($_POST['companyCity']) ;
				}
				
				if(trim($_POST['companyAbout']) != trim($companyDetails->about_company)) {
					$updatedFields[] = 'About Organization' ;
					$updatedFieldsOldData['about_company'] = trim($companyDetails->about_company) ;
					$updatedFieldsNewData['about_company'] = trim($_POST['companyAbout']) ;
				}

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

	public function companyRequestEditForm2() {
		// echo '<pre>';
		// print_r($_POST);print_r($_FILES);//exit;
		$UserId = $_SESSION['UserId'];
		
		$updatedFields = $_SESSION['updatedFields'];
		$updatedFieldsOldData = $_SESSION['updatedFieldsOldData'];
		$updatedFieldsNewData = $_SESSION['updatedFieldsNewData'];
		$verficationFields = $_SESSION['verficationFields'];
		$verficationFieldsNewData = $_SESSION['verficationFieldsNewData'];
		
		$filename_cin_db = "";
		$filename_gst_db = "";
		$filename_pan_db = "";

		if(isset($_POST) && $_POST != '') {

			$allowed = array('jpg','jpeg','pdf','png');
			
			$filename_gst = $_FILES['gst_certificate_file']['name'];
			$filesize_gst = $_FILES['gst_certificate_file']['size'];
			
			$ext_gst = strtolower(pathinfo($filename_gst, PATHINFO_EXTENSION));
			
			$filesize = MAX_FILESIZE_BYTE;
			$size = MAX_FILESIZE_MB;
			
			if(!empty($filename_gst) && !in_array($ext_gst, $allowed)) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type."));
				exit;
			}else if(!empty($filename_gst) && $filesize_gst > $filesize) {
				echo json_encode(array('flag'=>0, 'msg'=>"Limit exceeds above $size for $filename_gst."));
				exit;
			}else if(!preg_match("/^([0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}([a-zA-Z]{1}|[0-9]{1})){0,15}$/", $_POST['gst_certificate_number']) && !empty($_POST['gst_certificate_number'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Invalid GST Number"));
				exit;

			}else{
				$companyDetails= $this->MyprofileModel->getCompanyDetailsById($UserId);
				//print_r($companyDetails);exit;
				
				if($_POST['gst_certificate_fileHidden'] !="")
				{
					$filename_gst_db = $_POST['gst_certificate_fileHidden'];
				}

				if(isset($_FILES['gst_certificate_file']['name']) && !empty($_FILES['gst_certificate_file']['name'])) {
					$filename_gst_db = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-GST.'.$ext_gst;
					$config['upload_path'] = COMPANY_GST_PATH;
					$config['allowed_types'] = 'jpg|jpeg|pdf|png';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					
			       	$config['file_name'] = $UserId.'-'.strtotime(date('Y-m-d H:i:s')).'-GST';

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
				
				if(trim($filename_gst_db) != trim($companyDetails->gst_file)) {
					$verficationFields[] = 'GST Certifiicate' ;
					$verficationFieldsNewData['gst_file'] = $filename_gst_db ;
				}
				
				$gst_certificate_number = $_POST['gst_certificate_number'];
				if(trim($gst_certificate_number) != trim(base64_decode($companyDetails->gst_no))) {
					$verficationFields[] = 'GST Number' ;
					$verficationFieldsNewData['gst_no'] = trim(base64_encode($gst_certificate_number)) ;
				}
				
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
	
	public function companyRequestEditForm3()
	{
		// echo '<pre>';
		// print_r($_POST);print_r($_FILES);//exit;
		$UserId = $_SESSION['UserId'];
		
		$updatedFields = $_SESSION['updatedFields'];
		$updatedFieldsOldData = $_SESSION['updatedFieldsOldData'];
		$updatedFieldsNewData = $_SESSION['updatedFieldsNewData'];
		$verficationFields = $_SESSION['verficationFields'];
		$verficationFieldsNewData = $_SESSION['verficationFieldsNewData'];
		
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
			if(empty($_POST['fullName'])){
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
				
			}
			/*else if(count(array_filter($fullName)) != count($fullName) || count(array_filter($email)) != count($email) || count(array_filter($contactNo)) != count($contactNo)){*/
			else if(count(array_filter($fullName)) != count($fullName)){
				//echo json_encode(array('flag'=>0, 'msg'=>"Full name or Email or Contact No. is empty."));exit;
				echo json_encode(array('flag'=>0, 'msg'=>"Full name is empty."));exit;
				
			}else{
				$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);	
				$companyDetails = $this->MyprofileModel->getCompanyDetailsById($UserId);
				$boardMembersData	= $this->CompanyModel->getCompanyBoardMembersData($companyDetails->id);
				
				$deleted_member_ids = isset($_POST['deleted_member_ids'])?$_POST['deleted_member_ids']:'';
			
				$resultDeleteArray = array();
				$resultUpdateData = array();
				$resultUpdateArray = array();
				$boardUpdateData = array();
				$insertData=array();
								
				if(isset($hiddenPhotograph) && count($hiddenPhotograph)>0){
					$photographArr = array_filter($_FILES['photograph']['name']);
					
					$resultDeleteArray=array_intersect_key($hiddenPhotograph,$photographArr);
					
					$resultUpdateArray=array_diff_key($hiddenPhotograph,$photographArr);
					if(isset($resultUpdateArray) && count($resultUpdateArray)>0){
						
						foreach($resultUpdateArray as $key=>$value){
							
							$fullNameVal	= $fullName_arr[$key];
							// $emailVal	= $email_arr[$key];
							// $contactNoVal	= $contactNo_arr[$key];
							$emailVal	= $email[$key];
							$contactNoVal	= $contactNo[$key];
							$photoId = $_POST['hiddenPhotographId'][$key]; 
							
							$result = $this->db->get_where('corporate_board_members',array('id'=>$photoId,'	corporate_id'=>$companyDetails->id))->row();		
							//print_r($result);
							//echo $photoId;
							$hiddenPhotoVal = $_POST['hiddenPhotograph'][$key]; 
							
							if($fullNameVal != $result->full_name || $emailVal != $result->email || $contactNoVal != $result->phone_no || $hiddenPhotoVal != $result->photograph){
								$resultUpdateData[] = $photoId;
							}
							
							$boardUpdateData[]=array(  'corporate_id'	=> $companyDetails->id,
														'full_name'		=> $fullNameVal,
														'email'			=> $emailVal,
														'phone_no'		=> $contactNoVal,
														'photograph'	=> $hiddenPhotoVal,
														'created_at'	=> strtotime(date('Y-m-d H:i:s')),
														);
							//print_r($insertData2);	
							// $this->db->where('id',$photoId);					
							// $this->db->update('corporate_board_members', $updateData);
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
									$insertData[]=array(  'corporate_id'		=> $companyDetails->id,
														'full_name'		=> $fullNameVal,
														'email'			=> $emailVal,
														'phone_no'		=> $contactNoVal,
														'photograph'	=> $uploadData['file_name'],
														'created_at'	=> strtotime(date('Y-m-d H:i:s')),
														);
														
									//$this->db->insert('corporate_board_members', $insertData);
								}
							}else {
								echo json_encode(array('flag'=>0, 'msg'=> $this->upload->display_errors()));
								exit;
							}
						}else{
							if(empty($photoId)){
								// echo $foundedByVal.'22222';
								$insertData[]=array( 'corporate_id'		=> $companyDetails->id,
													'full_name'		=> $fullNameVal,
													'email'			=> $emailVal,
													'phone_no'		=> $contactNoVal,
													//'photograph'	=> $uploadData['file_name'],
													'created_at'	=> strtotime(date('Y-m-d H:i:s')),
													);
													
								//$this->db->insert('corporate_board_members', $insertData);
							}
						}
					}
				}
				
				//if((is_array($updatedFields) && count($updatedFields) > 0) || (is_array($verficationFields) && count($verficationFields) > 0)){
					
					$insertUpdatedata = array( 
						'user_id' 		=> $UserId, 
						'corporate_id'	 => $companyDetails->id,
						'verification_field_count' => count($verficationFields),
						'created_at' => strtotime(date('Y-m-d H:i:s')),
					);
					
					$insertUpdatedata = array_merge($insertUpdatedata,$updatedFieldsNewData);
					if(is_array($verficationFields) && count($verficationFields) > 0){
						$insertUpdatedata = array_merge($insertUpdatedata,$verficationFieldsNewData);
					}
					
					$isInsert = $this->db->insert('edit_corporate_details', $insertUpdatedata);
					$LastInsertID= $this->db->insert_id();
					
					if(is_array($updatedFieldsNewData) && count($updatedFieldsNewData) > 0){
						if($isInsert){
							
							$insertLogdata = array( 
								'edit_corporate_id' => $LastInsertID, 
								'user_id' 			=> $UserId, 
								'corporate_id'		=> $companyDetails->id,
							);
							$insertLogdata = array_merge($insertLogdata,$updatedFieldsOldData);
							
							$this->db->insert('log_corporate_details', $insertLogdata);
							$LogLastInsertID= $this->db->insert_id();
						}
						
						$this->db->where('id', $companyDetails->id);
						$this->db->update('corporate_details', $updatedFieldsNewData);
					}
				//}
				
				if(is_array($verficationFields) && count($verficationFields) > 0){
					$updateData = array( 
						'status'=> 8,
						'updated_at'=> strtotime(date('Y-m-d H:i:s')),
					);
					$this->db->where('id', $UserId);
					$this->db->update('users', $updateData);
				}
				
				if((trim($deleted_member_ids) != '') || (count($resultDeleteArray) > 0) || (count($resultUpdateData) > 0) || (count($insertData) > 0)){
					$updatedFields[] = 'Board Member' ;
					
					$isInsert = '';
					// print_r($boardMembersData);
					// print_r($boardUpdateData);
					// print_r($insertData);exit;
					
					$editdata = array_merge($boardUpdateData,$insertData);
					
					//print_r($editdata);exit;
					if(isset($editdata) && count($editdata) > 0){
						foreach($editdata as $key=>$value){
							$insertEditData[]=array(  
												'edit_corporate_id'	=> $LastInsertID,
												'corporate_id'		=> $value['corporate_id'],
												'full_name'		=> $value['full_name'],
												'email'			=> $value['email'],
												'phone_no'		=> $value['phone_no'],
												'photograph'	=> (isset($value['photograph']))?$value['photograph']:'',
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
											);
							
						}
						
						//print_r($insertEditData);
						$isInsert = $this->db->insert_batch('edit_corporate_board_members',$insertEditData);
					}
					if(isset($boardMembersData) && count($boardMembersData) > 0){
						foreach($boardMembersData as $key=>$value){
							
							$insertLogData[]=array(  
												'edit_corporate_id'	=> $LastInsertID,
												'corporate_id'		=> $value->corporate_id,
												'full_name'		=> $value->full_name,
												'email'			=> $value->email,
												'phone_no'		=> $value->phone_no,
												'photograph'	=> $value->photograph,
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
											);
							
						}
						
						//print_r($insertLogData);
						$isInsert = $this->db->insert_batch('log_corporate_board_members',$insertLogData);
					}
					
					if($isInsert){
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
						
						if(isset($resultDeleteArray) && count($resultDeleteArray)>0){
							foreach($resultDeleteArray as $key=>$value){
								
								$delPhotoId = $_POST['hiddenPhotographId'][$key]; 
								
								$this->db->where('id',$delPhotoId);
								$this->db->delete('corporate_board_members');
								
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
								
								$update=array(  'corporate_id'	=> $companyDetails->id,
												'full_name'		=> $fullNameVal,
												'email'			=> $emailVal,
												'phone_no'		=> $contactNoVal,
												'photograph'	=> $hiddenPhotoVal,
												'created_at'	=> strtotime(date('Y-m-d H:i:s')),
												);
								//print_r($update);	
								$this->db->where('id',$photoId);					
								$this->db->update('corporate_board_members', $update);
							}
						}
						
						//print_r($insertData);
						if(isset($insertData) && count($insertData)>0){
							$isInsert = $this->db->insert_batch('corporate_board_members',$insertData);
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
			
				$redirect = base_url() . "myprofile";
				if(is_array($updatedFields) && count($updatedFields) > 0){
					$notification_text = 'Contributor has updated the profile';
					$link = '<a href="/admin.php/contributor/contributorEditRequestLogView/'.$LastInsertID.'">View the detials here</a>';
					
					$assignedDetails = $this->CommonModel->getCorporateAssigned($companyDetails->id);
					//print_r($assignedDetails);exit;
					if(!empty($assignedDetails) ){
						$insertdata = array(
						   'from_user_id' 	=> $UserId, 
						   'to_user_id'		=> $assignedDetails->id,
						   'type'		=> $UserDetails->type,
						   'area_id' 		=> $companyDetails->id,
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
					$temp_Var = array($companyDetails->company_name);
					
					$GlobalMsg = str_replace($dyn_Var, $temp_Var, $GlobalMsgDetails->msg);
			
					//$GlobalMsg = $GlobalMsgDetails->msg;
						
					$notification_text = $GlobalMsg.' Edited fields: '.$verficationFieldsStr;
					$link = '<a href="/admin.php/contributor/verify/'.$companyDetails->id.'/'.$LastInsertID.'">View the detials here</a>';
					
					$assignedDetails = $this->CommonModel->getNgoAssigned($companyDetails->id);
					//print_r($assignedDetails);exit;
					if(!empty($assignedDetails) ){
						$insertdata = array(
						   'from_user_id' 	=> $UserId, 
						   'to_user_id'		=> $assignedDetails->id,
						   'type'		=> $UserDetails->type,
						   'area_id' 		=> $companyDetails->id,
						   'notification_text'=> $notification_text,
						   'link' 			=> $link, 
						   'type_of_notification' => 1,
						   'created_at'   	=> strtotime(date('Y-m-d H:i:s')),
						);
						
						$this->db->insert('adminuser_notifications', $insertdata);
					}
					
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