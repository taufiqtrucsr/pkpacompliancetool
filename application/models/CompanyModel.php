<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Neha Raut (neha.raut@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2019
###+------------------------------------------------------------------------------------------------

class CompanyModel extends CI_Model {
	
    public function __construct()
    {
        $this->load->database();
    }
	/*
			Sanjay Oraon
			16-09-2023
			corporate_details Merged With user_profile
			public function GetUserCompanyInfo($user_id){
				$result = $this->db->get_where('corporate_details',array('user_id'=>$user_id))->row();	
				return $result ;
			}
	*/
    public function GetUserCompanyInfo($user_id){
    	$result = $this->db->get_where('user_profile',array('user_id'=>$user_id))->row();	

		return $result ;
    }

    // public function GetUserNgoInfo($user_id){
    	// $result = $this->db->get_where('ngo_details',array('user_id'=>$user_id))->row();	

		// return $result ;
    // }

	 public function CompanyDownloadFormData($company_id,$file_name=''){
		if($file_name!=''){
			$this->db->select($file_name);		
			$this->db->from('corporate_details');
			$this->db->where(array('id'=>$company_id));
			$query = $this->db->get();
			$result = $query->row();
		}else{
			$result = $this->db->get_where('corporate_details',array('id'=>$company_id))->row();	
		}
    	
		return $result ;
    }
	
	public function getBoardPhotoData($id){
		$row = $this->db->get_where('corporate_board_members',array('id'=>$id))->row();	
		return $row ;
    }
	/*
			Sanjay Oraon
			19-09-2023
			corporate_board_members Merged With governing_body
			public function getCompanyBoardMembersData($corporate_id)
			{
				$result = $this->db->get_where('corporate_board_members',array('corporate_id'=>$corporate_id))->result();	

				return $result ;
			}
	*/
	public function getCompanyBoardMembersData($ngo_id)
	{
		$result = $this->db->get_where('governing_body', array('profile_id' => $ngo_id))->result();

		return $result;
	}
	/*function GetCsrRandomString($length)
	{
		if($length>0) 
		{ 
			$RandomString="";
			$characters       = '0123456789';
			$charactersLength = strlen($characters);
			$randomString     = '';       
			for ($i = 0; $i < $length; $i++) {
				$RandomString .= $characters[rand(0, $charactersLength - 1)];
			}
		}

		return $RandomString; 
	} */
	
	public function CsrUniqueExistCount($csrUniqueID)
	{
		return $this->db->get_where('users',array('csr_unique_id'=>$csrUniqueID))->num_rows();
	}
	
	public function getEditCompanyLogDataByCompanyId($company_id,$field_name){
		
		$this->db->select('count('.$field_name.') as record_count');		
		$this->db->from('log_corporate_details');
		$this->db->where(array('corporate_id'=>$company_id, "$field_name != " => ''));
		$query = $this->db->get();
		return $result = $query->row();
		//echo $this->db->last_query();
	}

	public function getCompanyInfo($company_id){
		return $result = $this->db->get_where('corporate_details',array('id'=>$company_id))->row();
	}
}    
