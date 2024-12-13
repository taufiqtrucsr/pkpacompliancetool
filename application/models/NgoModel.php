<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Usha Das (usha@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - December 2019###+------------------------------------------------------------------------------------------------

class NgoModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	/*
			Sanjay Oraon
			16-09-2023
			ngo_details Merged With user_profile
			public function GetUserNgoInfo($user_id)
			{
				$result = $this->db->get_where('ngo_details', array('user_id' => $user_id))->row();
				return $result;
			}
	*/
	/*by neeraj public function GetUserNgoInfo($user_id)
	{
		$result = $this->db->get_where('user_profile', array('user_id' => $user_id))->row();
		return $result;
	}*/
	public function GetUserNgoInfo($user_id)
	{
		// code commented for activate project
		// $result = $this->db->get_where('user_profile', array('user_id' => $user_id))->row();
		// code commented for activate project
		$result = $this->db->get_where('user_profile',array('user_id' => $user_id))->row();
		return $result;
	}

	public function getusersOrgType($user_id)
	{
		$data     = $this->db->get_where('users', array('id' => $user_id))->row();
		$Entity_type = $data->Entity_type;
		if ($Entity_type) {
			return $Entity_type;
		} else {
			return 0;
		}

		return $result;
	}

	public function GetUserProfileByAccountId($account_id)
	{
		$result = $this->db->get_where('user_profile', array('user' => $account_id))->row();
		return $result;
	}
	public function checkUserProfileStatus($UserId)
	{
		$data = $this->db->get_where('user_profile', array('user_id' => $UserId))->row();
		$kyc_status = $data->kyc_status;
		if ($kyc_status) {
			return $kyc_status;
		} else {
			return 0;
		}
	}

	/*
	Commented By Sanjay Oraon
	08-10-2024
	
	public function checkUserRole($UserId){
		$data       = $this->db->get_where('users',array('id'=>$UserId))->row();	
		$User_type  = $data->all_roles_allocated;
		if($User_type){
			return $User_type;
		} else {
			return 0;
		}
	}*/

	public function checkUserRole($UserId){

		$this->db->select('users.id,user_profile.all_roles_allocated');
		$this->db->from('users');
		$this->db->join('user_profile', 'users.profile_id_display = user_profile.id', 'inner');
		$this->db->where('users.id', $UserId);
		$query = $this->db->get();
		$return = $query->row();
		return $return->all_roles_allocated;
	}

	public function updateUserRoles($user_id, $all_roles){
		$this->db->where('id', $user_id);
		$this->db->update('users', $all_roles);
		return true;
	}

	public function GetUserProfileInfo($user_id)
	{
		$data = $this->db->get_where('users', array('id' => $user_id))->row();
		$profile_id_display = $data->profile_id_display;
		if ($profile_id_display) {
			$result = $this->db->get_where('user_profile', array('id' => $profile_id_display))->row();
			return $result;
		} else {
			return 0;
		}
	}
// Current Role removed from users_profile
	// public function checkUserRoleAndProfle($userid, $roleid){
	// 	$where = array(
	// 		'user_id' => $userid,
	// 		'current_role' => $roleid
	// 	);
	// 	$row = $this->db->get_where('user_profile', $where)->row();
	// 	return $row;
	// }
// Current Role removed from users_profile

	public function getUserRoleAndProfle(){
		$where = array(
			'id' => $_SESSION['ProfileId']
		);
		$row = $this->db->get_where('user_profile', $where)->row();
		return $row;
	}
	public function getUserDocuments($profile_id, $column)
	{
		$query = "SELECT * FROM `documents` WHERE `profile_id` = " . $profile_id . " AND `document_name` LIKE '" . $column . "' ORDER BY `document_name` ASC";
		$result = $this->db->query($query)->row();
		if ($result) {
			return $result;
		} else {
			return 0;
		}
	}
	public function uploadDocuments($data)
	{
		$this->db->insert('documents', $data);
		return true;
	}

	public function updateUploadedDocuments($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('documents', $data);
		return true;
	}

	public function GetUserProfileAccountId($user_id)
	{
		$data = $this->db->get_where('users', array('id' => $user_id))->row();
		return $data->profile_id_display;
	}
	public function GetUserFinancialDetails($user_id)
	{
		$data = $this->db->get_where('financial_report', array('profile_id' => $user_id))->result();
		return $data;
	}

	public function GetUserProfileId($user_id)
	{
		$data = $this->db->get_where('user_profile', array('user_id' => $user_id))->row();
		return $data->id;
	}
	function GetOrgTypeMaster($orgtypeId)
	{
		$this->db->select('org_type');
		$data = $this->db->get_where('org_type_master', array('id' => $orgtypeId))->row();
		return (isset($data->org_type))?$data->org_type : false;
	}
	function documentsbyprofileId($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId))->result();
			return $result;
		} else {
			return 0;
		}
	}
	function addMoreGoverningAct()
	{

		$result = $this->db->get('governing_act')->result();
		return $result;

	}
	function citybystatecode($state_code)
	{
		if ($state_code) {
			if($state_code == 'ALL'){
				$result = $this->db->get('district_master')->result();
			}else{
				$result = $this->db->get_where('district_master', array('st_code' => $state_code))->result();
			}
			return $result;
		} else {
			return 0;
		}
	}
	public function districtNameBy_districtId($district_id_selected){
		
		$arraydist_ID = explode(",", $district_id_selected);
		$this->db->where_in('id', $arraydist_ID);
		return $result = $this->db->get('district_master')->result();


	}
	public function statecodebystateId($stateid)
	{
		if ($stateid) {
			$result = $this->db->get_where('state_master', array('id' => $stateid))->row();
			return $result->st_code;
		} else {
			return 0;
		}
	}
	function citybystatecode_name($state_code)
	{
		if ($state_code) {
			$result = $this->db->get_where('district_master', array('id' => $state_code))->row();
			return $result->dst_name;
		} else {
			return 0;
		}
	}
	public function statecodebystateId_name($stateid)
	{
		if ($stateid) {
			$result = $this->db->get_where('state_master', array('id' => $stateid))->row();
			return $result->st_name;
		} else {
			return 0;
		}
	}
	public function stateGet()
	{
		$result = $this->db->get_where('state_master')->result();
		return $result;
	}

	public function getImplementationExp($profile_id, $role_id){
		// implementation_exp
		$where = array(
			'profile_id' => $profile_id,
			'role_id'=> $role_id
		);
		$row = $this->db->get_where('implementation_exp', $where)->result();
		return $row;
	}
	public function getBusinessOperation($profile_id, $role_id){
		// implementation_exp
		$where = array(
			'profile_id' => $profile_id,
			'role_id'=> $role_id
		);
		$row = $this->db->get_where('business_operation', $where)->result();
		return $row;
	}
	function documentsCINId($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "CIN"))->result();
			return $result;
		} else {
			return 0;
		}
	}
	function checkdocuments_documents($where){
	
		$result = $this->db->get_where('documents',$where)->result();
		return $result;
	
	}
	function documentsPANId($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "PAN"))->result();
			return $result;
		} else {
			return 0;
		}
	}
	function documentsGSTId($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "GST"))->result();
			return $result;
		} else {
			return 0;
		}
	}
	function documentsUploadRegisterationCertificateId($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "UploadRegisterationCertificate"))->result();
			return $result;
		} else {
			return 0;
		}
	}
	function documentsTRUSTDEEDId($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "TRUSTDEED"))->result();
			return $result;
		} else {
			return 0;
		}
	}

	function getTwelveAC($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "12A_REGISTRATION"))->result();
			return $result;
		} else {
			return 0;
		}
	}

	function getEightyAC($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "80G_REGISTRATION"))->result();
			return $result;
		} else {
			return 0;
		}
	}

	function getThirtyFive($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "35AC_REGISTRATION"))->result();
			return $result;
		} else {
			return 0;
		}
	}

	function getFcra($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('documents', array('profile_id' => $profileId, 'document_name' => "FCRA_REGISTRATION"))->result();
			return $result;
		} else {
			return 0;
		}
	}


	function governing_bodyByprofileId($profileId)
	{
		if ($profileId) {
			$result = $this->db->get_where('governing_body', array('profile_id' => $profileId))->result();
			return $result;
		} else {
			return 0;
		}
	}
	function governing_body($profileId,$type)
	{
		if ($profileId) {
			$result = $this->db->get_where('governing_body', array('profile_id' => $profileId,'role_id' => $type))->result();
			return $result;
		} else {
			return 0;
		}
	}
	public function NgoDownloadFormData($ngo_id, $file_name = '')
	{
		if ($file_name != '') {
			$this->db->select($file_name);
			$this->db->from('ngo_details');
			$this->db->where(array('id' => $ngo_id));
			$query = $this->db->get();
			$result = $query->row();
		} else {
			$result = $this->db->get_where('ngo_details', array('id' => $ngo_id))->row();
		}

		return $result;
	}

	public function getBoardPhotoData($id)
	{
		$row = $this->db->get_where('ngo_board_members', array('id' => $id))->row();
		return $row;
	}
	/*
			Sanjay Oraon
			16-09-2023
			ngo_board_members Merged With governing_body
			public function getNgoBoardMembersData($ngo_id)
			{
				$result = $this->db->get_where('ngo_board_members', array('ngo_id' => $ngo_id))->result();

				return $result;
			}
	*/
	public function getNgoBoardMembersData($ngo_id)
	{
		$result = $this->db->get_where('governing_body', array('profile_id' => $ngo_id))->result();

		return $result;
	}

	public function getEditNgoLogDataByNgoId($ngo_id, $field_name)
	{

		$this->db->select('count(' . $field_name . ') as record_count');
		$this->db->from('log_ngo_details');
		$this->db->where(array('ngo_id' => $ngo_id, "'" . $field_name . "'!= " => ''));
		$query = $this->db->get();
		return $result = $query->row();
		//echo $this->db->last_query();
	}

	public function getbilling($ngo_id, $year = '2021-2022', $subscriptionType = "")
	{
		$yearArr = explode("-", $year);
		$startYear = $yearArr[0];
		$endYear = $yearArr[1];
		$startDate = strtotime("01-04-" . $startYear);
		$endDate = strtotime("31-03-" . $endYear);

		$sql = "select * from ngo_billing_invoice where created_at between $startDate and $endDate and ngo_id = $ngo_id";
		if ($subscriptionType == "yearly") {
			$sql .= " AND invoice_year !=''";
		} elseif ($subscriptionType == "monthly") {
			$sql .= " AND invoice_month!=''";
		}
		$query = $this->db->query($sql);
		$result = $query->result();
		// echo '<pre>'; print_r($result); echo '</pre>';
		return $result;

		/*
		$this->db->from('ngo_billing_invoice');
		$this->db->where(array('ngo_id'=>$ngo_id));
		$query = $this->db->get();
		return $result = $query->result();
		*/
		//echo $this->db->last_query();
	}

	/*public function getNgoFilePath($file_name)
	{
	switch($file_name)
	{
	case "cin_file":
	$Path=NGO_CIN_PATH;
	break;
	case "gst_file":
	$Path=NGO_GST_PATH;
	break;
	case "pan_file":
	$Path=NGO_PAN_PATH;
	break;
	case "org_80g_file":
	$Path=NGO_80G_PATH;
	break;
	case "fcra_file":
	$Path=NGO_FCRA_PATH;
	break;
	case "org_35ac_file":
	$Path=NGO_35AC_PATH;
	break;
	case "org_12a_file":
	$Path=NGO_12A_PATH;
	break;	
	case "year1_file":
	$Path=NGO_YEAR_PATH;
	break;	
	case "year2_file":
	$Path=NGO_YEAR_PATH;
	break;	
	case "year3_file":
	$Path=NGO_YEAR_PATH;
	break;	
	case "year4_file":
	$Path=NGO_YEAR_PATH;
	break;
	case "year5_file":
	$Path=NGO_YEAR_PATH;
	break;
	case "year6_file":
	$Path=NGO_YEAR_PATH;
	break;	
	
	}
	return $Path;
	
	}*/

	public function getentitytypeById($entitytypeId)
	{
		if ($entitytypeId == 1) {
			return "E";
		} elseif ($entitytypeId == 2) {
			return "I";
		} else {
			return "";
		}
	}
	public function getsdg_from_sectorID($ID){
	
		$data     = $this->db->get_where('sector_master', array('id' => $ID))->row();
		$sdgs_id = $data->sdgs_id;
		return $sdgs_id;

	}
}