<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Kadambari Sule (kadambari@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - December 2019###+------------------------------------------------------------------------------------------------


class ForgotpasswordModel extends CI_Model
{
	
	public function __construct()
	{
	  $this->load->database();
	}


	function getForgotPwdOtpDataByPhone($phone_no)
	{
		$query = $this->db->query("SELECT * FROM otp where phone_no=".$phone_no." order by id desc limit 1");
   		return $query->row_array();
	}	

  public function UpdatePasswordData($id, $password)
	{
		$passwordChangedAt = strtotime(date('Y-m-d H:i:s'));
		$data = array(
		'password' => $password,
		'password_changed_at' => $passwordChangedAt,
	
      );
     $this->db->where('id', $id);
     $this->db->update('users', $data);
    if($this->db->affected_rows() > 0)
			   return true;
		   else
			  return false;

	   }


}