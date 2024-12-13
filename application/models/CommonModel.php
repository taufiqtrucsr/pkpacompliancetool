<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Usha Das (usha@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - August 2017
###+------------------------------------------------------------------------------------------------

class CommonModel extends CI_Model { 

    public function __construct()
    {
        $this->load->database();
    }

	/*
            Sanjay Oraon
            Date: 10-10-2023
            Computation Records
    */

	function TblRecordsCount($tbl,$filter)
    {
		if($filter)
			$this->db->where($filter);
        $query  = $this->db->get($tbl);
		$return = $query->num_rows();
        return $return;
    }
	public function update($tbl, $filter,$info)
    {
        $this->db->where($filter);
        $this->db->update($tbl, $info);
		return $this->db->affected_rows();
    }
	function TblRecords($tbl,$qnt,$order,$filter,$page,$segment)
    {
		if($filter)
			$this->db->where($filter);
		if($order)
			$this->db->order_by($order[0],$order[1]);
		if($page)
			$this->db->limit($page, $segment);
        $query  = $this->db->get($tbl);
		if($qnt)
			$return = $query->row();
		else
			$return = $query->result();
        return $return;
    }

	function TblSelectedRecords($tbl,$selecter,$filter)
    {
		$this->db->select($selecter);
		$this->db->where($filter);
        $query  = $this->db->get($tbl);
		$return = $query->row();
        return $return;
    }
	function TblSelectedRecordsBy($tbl,$selecter,$filter,$order)
    {
		$this->db->select($selecter);
		$this->db->order_by('id',$order);
		if($filter)
			$this->db->where($filter);
        $query  = $this->db->get($tbl);
		$return = $query->row();
        return $return;
    }
	function TblAllRecords($tbl,$selecter,$filter)
    {
		$this->db->select($selecter);
		$this->db->where($filter);
        $query  = $this->db->get($tbl);
		$return = $query->result();
        return $return;
    }
	function srmAllocation($id,$roleId)
    {
		$this->db->select('id');
		$this->db->where('id >',$id);
		$this->db->where('access_group_id',$roleId);
		$this->db->order_by('id','ASC');
        $query  = $this->db->get('adminusers');
		$return = $query->row();
        return $return;
    }
	function fatchMedia($id)
    {
		$this->db->select('id,path');
		$this->db->where_in('id',$id);
        $query  = $this->db->get('media');
		$return = $query->result();
        return $return;
    }

	function fatch($tbl,$id,$filter)
    {
		$this->db->where($filter);
		$this->db->where_in('id',$id);
        $query  = $this->db->get($tbl);
		$return = $query->result();
        return $return;
    }




	public function get_countries()
    {     
		$query = $this->db->get_where('countries_master');
        $resultArr = $query->result_array();

		return $resultArr;
    } 

	public function get_state()
    {        

		
        $query = $this->db->get_where('state_master');
        $resultArr = $query->result_array();

		return $resultArr;
    } 

	public function get_district()
    {        

		
        $query = $this->db->get_where('district_master');
        $resultArr = $query->result_array();

		return $resultArr;
    } 


	public function mycustommail(){

		echo "test";

		die();
	}

    public function get_organization_type()
    {         
        $query = $this->db->get_where('org_type_master', array('deleted_flag'=>0));
        $resultArr = $query->result_array();

		return $resultArr;
    } 
	
	public function get_corporate_organization_type()
    {         
        $query = $this->db->get_where('corporate_org_type_master', array('deleted_flag'=>0));
        $resultArr = $query->result_array();

		return $resultArr;
    } 

    public function get_sector_master()
    {         
        $query = $this->db->get_where('sector_master', array('deleted_flag'=>0));
        $resultArr = $query->result_array();
		
		return $resultArr;
    }
	
	public function getPrimarySourceMaster()
    {         
        $query = $this->db->get_where('primary_source_master');
        $resultArr = $query->result_array();
		
		return $resultArr;
    }

	public function getBeneficiaryMaster()
    {         
        $query = $this->db->get_where('beneficiary_master', array('deleted_flag'=>0));
        $resultArr = $query->result_array();
		
		return $resultArr;
    } 	
	
	public function getOrgTypeById($id) {
		$result = $this->db->get_where('org_type_master',array('id'=>$id))->row();		
		return $result ;
	}
	
	public function getCompanyOrgTypeById($id) {
		$result = $this->db->get_where('corporate_org_type_master',array('id'=>$id))->row();		
		return $result ;
	}
	
	public function getSectorById($id) {
		$result = $this->db->get_where('sector_master',array('id'=>$id))->row();		
		return $result ;
	}
	
	public function getBeneficiaryById($id) {
		$result = $this->db->get_where('beneficiary_master',array('id'=>$id))->row();		
		return $result ;
	}
	
	public function getPrimarySourceById($id) {
		$result = $this->db->get_where('primary_source_master',array('id'=>$id))->row();		
		return $result ;
	}

	public function getCMSPageDataByIdentifier($Identifier)
	{
		$result = $this->db->get_where('cms_pages',array('identifier'=>$Identifier, 'status' => 1))->row();		
		return $result ;
    }
    
    public function getGoalMaster()
    {         
        $query = $this->db->get_where('sdgs_master');
        $resultArr = $query->result_array();
        
        return $resultArr;
    }   
    
    ///getDataByID
    public function getDataByID($tableName,$condition,$select)
    {
        if(!empty($select))
        {
            $this->db->select($select);
        }
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
       
        $query = $this->db->get($tableName);
        return $query->result();
    }
    
    //insertData
    function insertData($tableName,$data)
    {
        $this->db->insert($tableName,$data);
        return $this->db->affected_rows() > 0 ? true : false;
    } 
    
    //Get Global Messages by MsgCode
    public function getGlobalMsgByCode($MsgCode)
	{
		$result = $this->db->get_where('global_messages',array('msg_code'=>$MsgCode))->row();		
		return $result ;
    }
	
	public function get_interval_in_month($from, $to) {
		// $month_in_year = 12;
		// $date_from = getdate($from);
		// $date_to = getdate($to);
		// return ($date_to['year'] - $date_from['year']) * $month_in_year -
			// ($month_in_year - $date_to['mon']) +
			// ($month_in_year - $date_from['mon']);
			
		$from = date('Y-m-d',$from);	
		$to = date('Y-m-d', $to);
		
		$date1=date_create($from);
		$date2=date_create($to);
		$diff=date_diff($date1,$date2);
		//print_r($diff);
		$InDays = $diff->format("%a");
		   $convert = $InDays + 1; // days you want to convert
		
		$years = ($convert / 366) ; // days / 365 days
		$years = floor($years); // Remove all decimals

		$month = ($convert) / 30.5; // I choose 30.5 for Month (30,31) ;)
		return $month = floor($month); // Remove all decimals	
	}
	
	public function GetCountOfNgoUser()
	{
		$query = $this->db->query("SELECT COUNT(id) as ngoCount FROM users WHERE user_type = 1 AND user_status = 1");
   		return $query->row();
	}
	
	public function GetCountOfCompanyUser()
	{
		$query = $this->db->query("SELECT COUNT(id) as companyCount FROM users WHERE user_type = 2 AND user_status = 1");
   		return $query->row();
	}
	
	public function GetCountOfCompletedProjects()
	{
		$query = $this->db->query("SELECT COUNT(id) as completedproCount FROM projects WHERE project_status = 2 AND is_deleted = 0");
   		return $query->row();
	}
	
	public function GetCountOfAllProjects()
	{
		$query = $this->db->query("SELECT COUNT(id) as allProCount FROM projects WHERE is_deleted = 0");
   		return $query->row();
	}
	
	public function GetCountOfSector()
	{
		$query = $this->db->query("SELECT id FROM sector_master");
   		$result = $query->result_array();
		
		$i = 0;
		foreach ($result as $row)
        {	  
		  $id = $row['id'];
		   
		  $likestring = ",$id,";
			
		  $query = $this->db->query('SELECT COUNT(*) as total FROM projects WHERE sectors LIKE "%'.$likestring.'%" AND project_status = 1 AND is_deleted = 0');
		  $rs = $query->row();
  
		  if($rs->total > 0)
		  {
			 $i++;
		  } 
		  
        }
		return $i;
	}
	
		public function GetCountOfBeneficiaries()
	{
		$query = $this->db->query("SELECT id FROM beneficiary_master");
   		$result = $query->result_array();
		
		$i = 0;
		foreach ($result as $row)
        {	  
		  $id = $row['id'];
		   
		  $likestring = ",$id,";
		/*
			sanjay oraon
			beneficiaries removed
			$query = $this->db->query('SELECT COUNT(*) as benetotal FROM projects WHERE beneficiaries LIKE "%'.$likestring.'%" AND final_status = 1 AND is_deleted = 0');
		*/
		  $query = $this->db->query('SELECT COUNT(*) as benetotal FROM projects WHERE project_status = 1 AND  is_deleted = 0');
		  $rs = $query->row();
  
		  if($rs->benetotal > 0)
		  {
			 $i++;
		  } 
		  
        }
		return $i;
	}
	
	public function getBeneficiariesCount(){
		/*
			sanjay oraon
			beneficiaries removed
			$sql="select beneficiaries FROM projects WHERE is_deleted = 0";
		
		$sql="select * FROM projects WHERE is_deleted = 0";
		$query = $this->db->query($sql);
   		$result = $query->result_array();
   		$beneficiaryArr=array();
   		for ($i=0; $i < count($result); $i++) { 
   			$beneficiaries=trim($result[$i]['beneficiaries'], ',');
   			$beneficiaryArr=array_merge($beneficiaryArr,explode(",", $beneficiaries));
   		}
			return $beneficiaryCount=count(array_values($beneficiaryArr))*4;
		*/
   		return $beneficiaryCount=0;
   	}

	public function getBannerDataImage()
	{
		$query = $this->db->query("SELECT * FROM banners WHERE banner_image != '' ORDER BY id ASC LIMIT 0,1");
   		$result = $query->row();
		return $result;
		//print_r($result);
    }

    public function getBannerDataImage1()
	{
		$query = $this->db->query("SELECT * FROM banners WHERE banner_image != '' ORDER BY id DESC LIMIT 0,1");
   		$result = $query->row();
		return $result;
		//print_r($result);
    }
	public function getCityOfState()
	{
		$this->db->select('D.dst_name, S.st_name');		
		$this->db->from('district_master D');
		$this->db->join("state_master S", 'S.st_code = D.st_code', 'inner' );
		$this->db->order_by("D.dst_name", "ASC");
		$query = $this->db->get();
        $return = $query->result();
        return $return;
	}
	public function getRecentProjectLists()
	{
		//echo 'pooja';
		//exit;
		//$this->db->select('P.*, ND.org_name');		
		//$this->db->from('projects P');
		//$this->db->join("ngo_details ND", 'ND.user_id = P.user_id', 'inner' );
		//$this->db->join('projects_funds PF', 'PF.project_id = P.id', 'left');
		//$this->db->where("P.status", 1);
		//$this->db->where("P.deleted_flag", 0);
		//$this->db->order_by("P.id", "DESC");
		//$this->db->limit(0,3);
		
		// $query = $this->db->query("SELECT P.*, ND.org_name, ND.org_logo, IF((ND.org_80g_file!='' && ND.signature_file!='' && ND.officialseal_file!=''), 1, 0) as tax_benefit FROM projects as P INNER JOIN users as U ON U.id = P.user_id INNER JOIN ngo_details as ND ON ND.user_id = P.user_id LEFT JOIN projects_funds as PF ON PF.project_id = P.id where U.status = 1 AND P.final_status = 1 AND P.deleted_flag = 0 ORDER BY P.id DESC LIMIT 0,3");
		// $query = $this->db->query("SELECT P.*, ND.org_name, ND.org_logo, ND.csr_num , IF((ND.org_80g_file!='' && ND.signature_file!='' && ND.officialseal_file!=''), 1, 0) as tax_benefit FROM projects as P INNER JOIN users as U ON U.id = P.user_id INNER JOIN ngo_details as ND ON ND.user_id = P.user_id LEFT JOIN projects_funds as PF ON PF.project_id = P.id where U.status = 1 AND P.final_status = 1 AND P.deleted_flag = 0 and P.hide_status= 0  ORDER BY P.id DESC LIMIT 0,3"); //fetch csr_number AS ND.csr_num by nK ON 22-4-2022
		/*
			sanjay oraon
			removed 
				final_status,ngo_details table,hide_status
			replaced
				user_id with profile_id
			$query = $this->db->query("SELECT P.*, ND.org_name, ND.org_logo, ND.csr_num , IF((ND.org_80g_file!=''), 1, 0) as tax_benefit FROM projects as P INNER JOIN users as U ON U.id = P.user_id INNER JOIN ngo_details as ND ON ND.user_id = P.user_id LEFT JOIN projects_funds as PF ON PF.project_id = P.id where U.user_status = 1 AND P.final_status = 1 AND P.is_deleted = 0 and P.hide_status= 0  ORDER BY P.id DESC LIMIT 0,3"); //removed the signature_file and official_seal
		*/
		$query = $this->db->query("SELECT P.* FROM projects as P INNER JOIN users as U ON U.id = P.profile_id  LEFT JOIN projects_funds as PF ON PF.project_id = P.id where U.user_status = 1 AND P.project_status = 1 AND P.is_deleted = 0 ORDER BY P.id DESC LIMIT 0,3"); //removed the signature_file and official_seal
		$result = $query->result_array();
		return $result;
	
	}
	
	public function getSearchSuggestion($existingString)
	{
		//echo 'testing...!!';
		//print_r($_POST);
		//exit;
		//if(isset($_POST) && !empty($_POST))
		/* { */
			//$keyword = $_POST['existingString'];
			$searchKeyword = '%'.$existingString.'%';
			//echo $searchKeyword;

			
			$query = $this->db->query('SELECT keyword from search_keys where keyword LIKE "'.$searchKeyword.'" ');
			
			//echo $query;
		
			$result = $query->result_array();
			
			return $result;
			//return json_encode($result);
		//}
		
	}
	
	function numberToCurrency($number)
	{
		//if(setlocale(LC_MONETARY, 'en_IN'))
		 // return money_format('%.0n', $number);
		//else {
		  $explrestunits = "" ;
		  $number = explode('.', $number);
		  $num = $number[0];
		  if(strlen($num)>3){
			  $lastthree = substr($num, strlen($num)-3, strlen($num));
			  $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			  $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			  $expunit = str_split($restunits, 2);
			  for($i=0; $i<sizeof($expunit); $i++){
				  // creates each of the 2's group and adds a comma to the end
				  if($i==0)
				  {
					  $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
				  }else{
					  $explrestunits .= $expunit[$i].",";
				  }
			  }
			  $thecash = $explrestunits.$lastthree;
		  } else {
			  $thecash = $num;
		  }
		  if(!empty($number[1])) {
			  if($number[1] == 0){
				return '<i class="fa fa-inr"></i> ' .$thecash;	
			  }else{
				return '<i class="fa fa-inr"></i> ' .$thecash . '.' . $number[1];  
			  }			
		  } else {
			//return '<i class="fa fa-inr"></i> ' .$thecash.'.00';
			return '<i class="fa fa-inr"></i> ' .$thecash;
		  }
		//}
	}
	
	public function UserNotificationCount($user_id,$limit='')
	{
		//return $this->db->get_where('user_notification',array('to_user_id'=>$user_id,'type_of_notification'=>1,'visited_flag'=>'1'))->num_rows();
		
		$this->db->select('*');
		$this->db->from('user_notifications');
		$this->db->where(array('to_user_id'=>$user_id,'visited_flag'=>1));
		$this->db->order_by('id','desc');		
		$query = $this->db->get();
		$result= $query->num_rows();
		return $result ;	
	}
	
	public function UserNotifications($user_id,$notificationId='',$limit='')
	{
		$this->db->select('*');
		$this->db->from('user_notifications');
		$this->db->where(array('to_user_id'=>$user_id));
		if($notificationId!=''){
		   $this->db->where('id < ',$notificationId);
		}	
		$this->db->order_by('id','desc');
		if($limit!=''){
		   $this->db->limit($limit);
		}		
		$query = $this->db->get();
		
		$result= $query->result_array();
		return $result ;	
		
	}
	
	function formatDate($time) {
		if ($time >= strtotime("today 00:00")) {
			return "Today";
		} elseif ($time >= strtotime("yesterday 00:00")) {
			return "Yesterday";
		} else {
			return date("dS M", $time);
		}
	}
	
	public function GetUserNgoInfo($user_id){
    	 $result = $this->db->get_where('ngo_details',array('user_id'=>$user_id))->row();	
			return $result ;
     }
	 
	 public function GetUserCompanyInfo($user_id){
    	$result = $this->db->get_where('corporate_details',array('user_id'=>$user_id))->row();	
		return $result ;
    } 

	public function GetFromUserImg($id)
	{
			///return 1;
			//echo "user id".$id;
			//exit;
			
			$query = $this->db->query("SELECT b.user_id,b.org_logo,c.user_id,c.company_logo FROM users as a LEFT JOIN ngo_details b ON a.id=b.user_id  LEFT JOIN corporate_details c ON a.id=c.user_id");
			$result = $query->result();
			//echo "<pre>";
			//print_r($result);
			return $result;
		
    }
	
	public function GetLogo($uid, $type)
	{
		if($uid != "" && $type != "")
		{
			if($type == 1)
			{
				$table ="ngo_details";
				$column = "org_logo";
			}
			elseif($type == 2)
			{
				$table ="corporate_details";
				$column = "company_logo";
			}
			
			$query = $this->db->query('select '.$column.' from '.$table.' where user_id ='.$uid);
			$result= $query->result();
			/* echo'<pre>';*/
			/* print_r($result); 
			echo $result;
			//$result;
			exit; */
			return $result;
		}
		else
		{
			return false;
		}
		$query = $this->db->query("");
		$result = $query->result();
		return $result;
	}
	
	
	function get_notifications()
	{
		$this->db->select('user_notifications.*');
		return $this->db->get('user_notifications')->result();
	}
	
	/*
	Sanjay Oraon
	Date 16-09-2023
	Due To ngo_details and corporate_details merged into user_profile

	function get_ngobylogo($id)
	{
		$this->db->select('*');
		$this->db->from('ngo_details');
		$this->db->where('user_id',$id);
		return $this->db->get()->row();
	}

	
	function get_companybylogo($id)
	{
		$this->db->select('*');
		$this->db->from('corporate_details');
		$this->db->where('user_id',$id);
		return $this->db->get()->row();
	}*/

	function get_logo($id)
	{
		$this->db->select('*');
		$this->db->from('user_profile');
		$this->db->where('id',$id);
		return $this->db->get()->row();
	}
	
	public function getEmailTemplateById($id)
	{
		
		$result = $this->db->get_where('email_template',array('id'=>$id))->row();		
		return $result ;
	}
	
	public function sendCommonHTMLEmail($to, $templateId, $TempVars,$DynamicVars, $inputEmail='')
	{	
		if($inputEmail != ''){
			$email = $inputEmail;
		}else{
			$email = TRUCSR_DEFAULT_MAIL;
		}
		$emailTemplate = $this->getEmailTemplateById($templateId);
		
		$subject = $emailTemplate->subject;
		$title = $emailTemplate->title;
	
		$emailBody = str_replace($TempVars, $DynamicVars, $emailTemplate->content);
		
		$data['title'] = $title;
		$data['subject'] = $subject;
		$data['content'] = $emailBody;
		
		$content = $this->load->view('email_template/email_content', $data, TRUE);
		
		$mailSent = $this->sendHTMLMailSMTP($to, $subject, $content, $email, $attachment="");
		
		if($mailSent){
			return true;
		}else{
			return false;
		}
	}
	
	public function sendCommonSuccessFailHTMLEmail($to, $templateId, $TempVars,$DynamicVars, $inputEmail='')
	{	
		if($inputEmail != ''){
			$email = $inputEmail;
		}else{
			$email = TRUCSR_DEFAULT_MAIL;
		}
		$emailTemplate = $this->getEmailTemplateById($templateId);
		
		//$subject = $emailTemplate->subject;
		$title = $emailTemplate->title;
	
		$emailBody = str_replace($TempVars, $DynamicVars, $emailTemplate->content);
		
		$subject = str_replace($TempVars, $DynamicVars, $emailTemplate->subject);
		
		$data['title'] = $title;
		$data['subject'] = $subject;
		$data['content'] = $emailBody;
		
		$content = $this->load->view('email_template/email_content', $data, TRUE);
		
		$mailSent = $this->sendHTMLMailSMTP($to, $subject, $content, $email, $attachment="");
		
		if($mailSent){
			return true;
		}else{
			return false;
		}
	}
	
	public function sendHTMLMailSMTP($to, $subject, $content, $email, $attachment="")
 	{	


		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'krishnabrainmaze@gmail.com',
			'smtp_pass' => 'uigyxagtcfbmxeba',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
	    );

		$this->load->library('email',$config);



		//$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($email); // change it to yours
		$this->email->to($to);// change it to yours
		//$this->email->reply_to(""); add no reply email here
		$this->email->subject($subject);
		$this->email->message($content);
		$this->email->set_mailtype("html");
		if($this->email->send()){
			return true;
		}else{
			return false;
		}
  	}
	
	public function getAdminUsersByType($type)
	{
		if(is_array($type)){
			$this->db->select('*');
			$this->db->from('adminusers');
			$this->db->where_in('user_type', $type);
			$query = $this->db->get();
			$result= $query->result();
		}else{
			$result = $this->db->get_where('adminusers',array('user_type'=>$type))->result();
		}
		return $result;
	}
	
	function convertToIndianCurrency($number) {
		$no = round($number);
		$decimal = round($number - ($no = floor($number)), 2) * 100;    
		$digits_length = strlen($no);    
		$i = 0;
		$str = array();
		$words = array(
			0 => '',
			1 => 'One',
			2 => 'Two',
			3 => 'Three',
			4 => 'Four',
			5 => 'Five',
			6 => 'Six',
			7 => 'Seven',
			8 => 'Eight',
			9 => 'Nine',
			10 => 'Ten',
			11 => 'Eleven',
			12 => 'Twelve',
			13 => 'Thirteen',
			14 => 'Fourteen',
			15 => 'Fifteen',
			16 => 'Sixteen',
			17 => 'Seventeen',
			18 => 'Eighteen',
			19 => 'Nineteen',
			20 => 'Twenty',
			30 => 'Thirty',
			40 => 'Forty',
			50 => 'Fifty',
			60 => 'Sixty',
			70 => 'Seventy',
			80 => 'Eighty',
			90 => 'Ninety');
		//$digits = array('', 'Hundred', 'Thousand', 'Lac', 'Crore');
		$digits = array('', 'hundred', 'thousand', 'lac', 'crore');
		while ($i < $digits_length) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += $divider == 10 ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
				// $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
				$str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] ;
			} else {
				$str [] = null;
			}  
		}
		
		$Rupees = implode(' ', array_reverse($str));
		$paise = ($decimal) ? "and " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10]) ." Paise" : '';
		//return ($Rupees ? $Rupees : '') . $paise . " Only";
		return ($Rupees ? $Rupees : '') . $paise;
	}
	
	public function getPercentOfNumber($total, $number)
	{
		if ( $total > 0 ) {
			//return round(($number / $total) * 100,2);
			$percent = round(($number / $total) * 100,2);
            return ($percent > 100)?100:$percent;
		}else{
			return 0;
		}
	}
	
	function getNgoAssigned($ngo_id,$flag='')
	{		
		if($flag == ''){
			$this->db->select('au.*')
			->from('adminusers as au, ngo_assigned as na')
			->where('au.id = na.assign_to')
			->where('na.ngo_id = "'.$ngo_id.'"');
		}else{
			$this->db->select('au.*')
			->from('adminusers as au, ngo_assigned as na')
			->where('au.id = na.assign_from')
			->where('na.ngo_id = "'.$ngo_id.'"');
		}
		$query = $this->db->get();
		//print_r($this->db->last_query());
		return $query->row();
	}
	
	function getCorporateAssigned($corporate_id,$flag='')
	{	
		if($flag == ''){
			$this->db->select('au.*')
			->from('adminusers as au, corporate_assigned as ca')
			->where('au.id = ca.assign_to')
			->where('ca.corporate_id = "'.$corporate_id.'"');
		}else{
			$this->db->select('au.*')
			->from('adminusers as au, corporate_assigned as ca')
			->where('au.id = ca.assign_from')
			->where('ca.corporate_id = "'.$corporate_id.'"');
		}
		
		$query = $this->db->get();
		return $query->row();
	}

	public function get_days_interval($from, $to) 
	{
		$from = date('Y-m-d',$from);
		$to = date('Y-m-d',$to);

		$date1=date_create($from);
		$date2=date_create($to);
		$diff=date_diff($date1,$date2);
		$InDays = $diff->format("%a");
		$convert = $InDays + 1; // days you want to convert
	
		$years = ($convert / 366) ; // days / 365 days
		$years = floor($years); // Remove all decimals
		
		$month = ($convert) / 30.5; // I choose 30.5 for Month (30,31) ;)
		$month = floor($month); // Remove all decimals	
		if($years!=0){
			return array('D'=>$InDays,'YM'=>$years.' years');
		}else if($month!=0){
			return array('D'=>$InDays,'YM'=>$month.' month');
		}else{
			return array('D'=>$InDays,'YM'=>$InDays.' days');
		}
	}

	//get total donation 
	// public function get_total_donation($project_id){
	public function get_total_donation($project_id){
		$sql = "SELECT COUNT(*) AS no_of_doners,SUM(donation_amount) as total_donation FROM `donor_standalone_details` WHERE project_id = $project_id AND STATUS = 1";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	// get total donation ends here

	public function serializeId($tbl,$name,$key){
        $this->db->select('GROUP_CONCAT(DISTINCT('.$name.')) AS id');
        $this->db->where($key);
        $query = $this->db->get($tbl);
        $return = $query->row();
        return $return;
    }
	public function totalAssesment($key){
        $this->db->select('SUM(direct_expenditure) AS total');
        $this->db->where($key);
        $query = $this->db->get('csr2_directors_report_project');
        $return = $query->row();
        return $return;
    }
	public function totalOverhead($key){
        $this->db->select('SUM(overheads) AS total');
        $this->db->where($key);
        $query = $this->db->get('csr2_directors_report_project');
        $return = $query->row();
        return $return;
    }
	public function delete($tbl,$key)
    {
        $this->db->where($key);
        $this->db->delete($tbl);
    }
}
