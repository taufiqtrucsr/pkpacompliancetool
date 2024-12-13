<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Usha Das (usha@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2017
###+------------------------------------------------------------------------------------------------

class UserModel extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }	
	public function GetUserDetails($id){
		$this->db->select('users.*,user_profile.about_entity,user_profile.website,user_profile.entity_type,user_profile.current_active_role,user_profile.all_roles_allocated,user_profile.entity_name,user_profile.district,user_profile.entity_logo,user_profile.date_of_incorp_birth,user_profile.website,user_profile.entity_address,user_profile.b_entity_address,user_profile.city,user_profile.district,user_profile.pincode,user_profile.about_entity,state_master.st_name,governing_act.governing_act,user_role_master.user_role,org_type_master.org_type');
		$this->db->from('users');
		$this->db->join('user_profile', 'users.profile_id_display = user_profile.id', 'inner');
		$this->db->join('user_role_master', 'user_profile.current_active_role = user_role_master.id', 'inner');
		$this->db->join('org_type_master', 'user_profile.entity_type = org_type_master.id', 'inner');
		$this->db->join('governing_act', 'user_profile.governing_act_id = governing_act.id', 'inner');
		$this->db->join('state_master', 'user_profile.state = state_master.id', 'inner');
		$this->db->where('users.id', $id);
		$this->db->where('users.is_deleted', 0);
		$query = $this->db->get();
		return $query->row();
	}
	function get_Partners()
	{		
		
		$query = $this->db->query("SELECT * FROM ngo_details order by id desc");
		// $query = $this->db->query("SELECT ngo_details.user_id, projects.project_name, projects.user_id
								// FROM ngo_details, projects
								// INNER JOIN ngo_details.ngo_details.user_id ON projects.projects.user_id;");
		// $query = $this->db->query("SELECT ngo_details.user_id, projects.project_name, projects.user_id
								// FROM ngo_details, projects
								// INNER JOIN projects.projects.user_id ON ngo_details.ngo_details.user_id");
			// $this->db->select('nd.*');
			// $this->db->from('ngo_details as nd');
			// ->where('u.type = 2')
			// ->where('u.deleted_flag', '0')
			// ->where('nd.kyc_status !=',  '0')
		
		//$this->db->limit($num, $offset);
		//print_r($this->db->last_query());
		// $query = $this->db->get();
		return $query->result();
	}
	
	function get_projects($LoginID,$userType)
	{
		$query = $this->db->query("SELECT * FROM projects order by id desc");
		// $this->db->select('p.*')
		// $this->db->from('projects p');				
		// $query = $this->db->get();
		return $query->result();
	}

	public function UserExistCount($Emobile,$EntityType="")
	{
		//Code Comment By krishna, this is only for mobile Login
		//return $this->db->get_where('users',array('phone_no'=>$mobile,'User_type'=>$EntityType ,'is_deleted'=>0))->num_rows();
		//Code Comment By krishna, this is only for mobile Login
		$this->db->select('*');
		$this->db->from('users');
		$this->db->group_start();
		$this->db->where('email', $Emobile)->or_where('phone_no', $Emobile);
		$this->db->where('phone_no', $Emobile);
		$this->db->group_end();
		if($EntityType)
			$this->db->where('user_type', $EntityType);
		$this->db->where('is_deleted', 0);
		return $query = $this->db->get()->num_rows();
	}	

	/*
	Commented By Sanjay Oraon
	08-10-2024
	
	public function GetUserByEmailPhone($Emobile,$EntityType=""){

	
		$this->db->select('*');
		$this->db->from('users');
		$this->db->group_start();
		$this->db->where('email', $Emobile)->or_where('phone_no', $Emobile);
		$this->db->group_end();
		$this->db->where('user_type', $EntityType);
		$this->db->where('is_deleted', 0);
		$query = $this->db->get();
		return $query->row();
	}*/

	public function GetUserByEmailPhone($Emobile,$EntityType=""){

	
		$this->db->select('users.*,user_profile.current_active_role,user_profile.all_roles_allocated');
		$this->db->from('users');
		$this->db->group_start();
		$this->db->where('users.email', $Emobile)->or_where('users.phone_no', $Emobile);
		$this->db->group_end();
		$this->db->join('user_profile', 'users.profile_id_display = user_profile.id', 'inner');
		$this->db->where('users.user_type', $EntityType);
		$this->db->where('users.is_deleted', 0);
		$query = $this->db->get();
		return $query->row();
	}

	function GetUserByEmail($email,$EntityType="")
	{
		$result = $this->db->get_where('users',array('email'=>$email, 'user_type'=>$EntityType ,'is_deleted'=>0))->row();
		return $result;
	}

	function GetUserByPhone($phone_no,$EntityType="")
	{
		$result = $this->db->get_where('users',array('phone_no'=>$phone_no,'user_type'=>$EntityType , 'is_deleted'=>0))->row();	
		return $result;
	}
	function verifyUserByEmail($email)
	{
		$result = $this->db->get_where('users',array('email'=>$email))->row();
		return $result;
	}

	function verifyUserByPhone($phone_no)
	{
		$result = $this->db->get_where('users',array('phone_no'=>$phone_no))->row();	
		return $result;
	}
	function GetUserById($id)
	{
		$this->db->select('us.*,ul.role_id');
		$this->db->from('users us');
		$this->db->join('user_role_lnk ul', 'ul.user_id = us.id','LEFT');
		$this->db->where('us.id', $id);
		$query = $this->db->get();
		$row   = $query->last_row();
		return $row;
		// $result = $this->db->get_where('users',array('id'=>$id))->row();
		// return $result ;
		// 27-04-2021
	}
	// to get all rolde id not only last row as given above 
	function GetUserById_role($id)
	{
		$this->db->select('us.*,ul.role_id');
		$this->db->from('users us');
		$this->db->join('user_role_lnk ul', 'ul.user_id = us.id','LEFT');
		// New code added for activate project
		$this->db->join('user_profile uf', 'uf.user_id = us.id','LEFT');
		// New code added for activate project
		$this->db->where('us.id', $id);
		$query = $this->db->get();
		$row=$query->result_array();
		// exit;
		//echo $id;echo "<pre>";print_r($row);die;
		return $row;
		// $result = $this->db->get_where('users',array('id'=>$id))->row();
		// return $result ;
		// 27-04-2021
	}	


	function GetUserByRoleIdTable($id,$Roleid)
	{
		$this->db->select('ul.role_id,');
		$this->db->from('user_role_lnk ul');
		// $this->db->join('user_role_lnk ul', 'ul.user_id = us.id','LEFT');
		$this->db->where('ul.user_id', $id);
		$this->db->where('ul.role_id', $Roleid);
		$query = $this->db->get();
		$row=$query->row();
		// echo $id;echo "<pre>";print_r($row);die;
		return $row;
		// $result = $this->db->get_where('users',array('id'=>$id))->row();
		// return $result ;
		// 27-04-2021
	}	


	function getOtpDataByPhone($phone_no)
	{
		$query = $this->db->query("SELECT * FROM otp where phone_no=".$phone_no." order by id desc limit 1");
   		return $query->row_array();
	}	

	function GetRandomString($Length)
	{
		if($Length>0) 
		{ 
			$RandomString="";
			for($i=1; $i<=$Length; $i++)
			{
				mt_srand((double)microtime() * 1000000);
				$Number = mt_rand(1,36);
				$RandomString .= $this->AssignRandomString($Number);
			}
		}

		return md5($RandomString);
	} 

	function AssignRandomString($Number)
	{	 
		switch($Number)
		{
			case "1": $rand_value = "a"; break;
			case "2": $rand_value = "b"; break;
			case "3": $rand_value = "c"; break;
			case "4": $rand_value = "d"; break;
			case "5": $rand_value = "e"; break;
			case "6": $rand_value = "f"; break;
			case "7": $rand_value = "g"; break;
			case "8": $rand_value = "h"; break;
			case "9": $rand_value = "i"; break;
			case "10": $rand_value = "j"; break;
			case "11": $rand_value = "k"; break;
			case "12": $rand_value = "l"; break;
			case "13": $rand_value = "m"; break;
			case "14": $rand_value = "n"; break;
			case "15": $rand_value = "o"; break;
			case "16": $rand_value = "p"; break;
			case "17": $rand_value = "q"; break;
			case "18": $rand_value = "r"; break;
			case "19": $rand_value = "s"; break;
			case "20": $rand_value = "t"; break;
			case "21": $rand_value = "u"; break;
			case "22": $rand_value = "v"; break;
			case "23": $rand_value = "w"; break;
			case "24": $rand_value = "x"; break;
			case "25": $rand_value = "y"; break;
			case "26": $rand_value = "z"; break;
			case "27": $rand_value = "0"; break;
			case "28": $rand_value = "1"; break;
			case "29": $rand_value = "2"; break;
			case "30": $rand_value = "3"; break;
			case "31": $rand_value = "4"; break;
			case "32": $rand_value = "5"; break;
			case "33": $rand_value = "6"; break;
			case "34": $rand_value = "7"; break;
			case "35": $rand_value = "8"; break;
			case "36": $rand_value = "9"; break;
		}

		return $rand_value;

	}

	//insertData
	public function insertData($tableName,$data)
	{
		$this->db->insert($tableName,$data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function SwitchUserById($role_id,$user_id)
	{
		$this->db->select('user_role_lnk.*,');
		$this->db->from('user_role_lnk');
		$this->db->where('user_role_lnk.role_id', $role_id);
		$this->db->where('user_role_lnk.user_id', $user_id);
		$query = $this->db->get();
		$row=$query->row();
		return $row;
	}
	function get_orgtype($orgtype)
	{
		$this->db->select('org_type_master.*');
		$this->db->like('user_role',$orgtype);
		$this->db->where('deleted_flag', 0);
		return $this->db->get('org_type_master')->result();
	}
	function get_orgtype_all_role($entity_type){
		$this->db->select('user_role');
		$this->db->where('id',$entity_type);
		$this->db->where('deleted_flag', 0);
		return $this->db->get('org_type_master')->result();
	}
	function get_orgtype_all()
	{
		$this->db->select('org_type_master.*');
		$this->db->where('deleted_flag', 0);
		return $this->db->get('org_type_master')->result();
	}
	function Imporgtype()
	{
		$this->db->select('org_type_master.*');
		$this->db->where('deleted_flag', 0);
		return $this->db->get('org_type_master')->result();
	}
	//snajan kumar
    function get_users($id) {
		return $this->db->get_where('users',array('id'=>$id))->row();
	}
	public function getorgtypeByEntityId($id){

		$this->db->where('id',$id);
		$this->db->select('org_type');
		$query = $this->db->get('org_type_master');
		$data =  $query->row();
		return $data->org_type;
	}
}
