<?php 
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Deepak Salve (deepak@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - July 2021
###+------------------------------------------------------------------------------------------------

class FundraiserModel extends CI_Model {
	
	public function __construct()	
	{	
		$this->load->database();
	}	
    
    public function checkFundraiserUnderMotivator($userId) {
        $sql = "select inviter_id,inviter_type from campaign_members where inviter_type='motivator' AND invitee_type='fundraiser' AND register_status='register' AND delete_flag=0 AND invitee_id=$userId";
        $query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	public function getMotivatorCampaignProjects($motivatorId) {
		$sql = "select p.id,p.project_name from campaign_projets as cp left join campaigns as c on c.id=cp.campaign_id left join projects as p on p.id=cp.project_id where cp.delete_flag=0 AND c.user_id=$motivatorId AND c.final_status='Active'";
        $query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;

	}
	
	public function getSectors($ids) {
		$ids = substr($ids,1,-1);
		$idsArr = explode(",",$ids);	
		foreach($idsArr as $id){ 
			
			$sectors = $this->db->get_where('sector_master',array('id'=>$id))->row();
			$result[] = $sectors->sector_type;
		} 
		return $result ;
	}

	public function getallcampaigndetails() {
		$this->db->select('*');
		$this->db->from('campaigns');
		$this->db->join('campaign_projets','campaign_projets.campaign_id = campaigns.id');
		$query = $this->db->get();
		
		return $query->row();
	}

	public function project_filter(){
		$sql = "select projects.id, projects.project_status, projects.status, project_name, projects.identifier, projects.sectors, state_master.st_name FROM projects \n"
		    . "LEFT JOIN state_master ON state_master.st_code = projects.state\n"
		    . "WHERE sectors LIKE \'%5%\' AND `status` = 1 AND `final_status` = 1 AND `district` LIKE \'%Mumbai%\' AND `state` LIKE \'%MH%\'";
	    $query = $this->db->query($sql);
		$result = $query->result();
	}

	public function districtDropdown()
	{
		$this->db->select('DISTINCT(district)');
		$query = $this->db->get('projects');		
		return $query->result();
	}

    public function getDraftProjectsFundsAlrecdData($campaign_id)
    {         
        $this->db->where('campaign_id',$campaign_id);
        $query = $this->db->get('campaign_projets');
        $resultArr = $query->result();
        return $resultArr;
    } 

	public function getallProjectdetails() {
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('projects.status',1);
		$this->db->where('projects.project_status',1);
		// $this->db->join('campaign_projets','campaign_projets.campaign_id = campaigns.id');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_all_project_imagesBy_id($projectId)
	{
		$this->db->select('projects_gallery.*, projects.project_name');
		$this->db->from('projects_gallery');
		$this->db->join('projects','projects.id = projects_gallery.project_id');
		$this->db->where('projects_gallery.project_id',$projectId);
		$query = $this->db->get();		
		return $query->result();
	}
	
	// public function get_all_projectid()
	// {
	//     $query = $this->db->get('projects_gallery');
	//     $array = array();
	//     foreach($query->result() as $row)
	//     {
	//         $array[] = $row->id; // add each user id to the array
	//     }
	//     return $array;
	// }
	// public function getallProjectdetails() {
	// 	$this->db->select('projects.*, projects_gallery.image');
	// 	$this->db->from('projects');
	// 	$this->db->join('projects_gallery','projects_gallery.project_id = projects.id');
	// 	$this->db->join('projects_gallery','projects_gallery.project_id = projects.id');
	// 	$query = $this->db->get();		
	// 	return $query->result();
	// }

    public function getPreviewCampaignData($campaign_identifier)
    {        
		// $this->db->select('campaigns.*, projects.project_name'); 
        $this->db->where('identifier',$campaign_identifier);
        $query = $this->db->get('campaigns');
        $resultArr = $query->row();
        return $resultArr;
    } 

    public function getCampaignDataByID($campaign_id)
    {        
		// $this->db->select('campaigns.*, projects.project_name'); 
        $this->db->where('id',$campaign_id);
        $query = $this->db->get('campaigns');
        $resultArr = $query->row();
        return $resultArr;
    } 

    public function getCampaignMember($campaign_id){								
		$result = $this->db->get_where('campaign_members',array('campaign_id'=>$campaign_id,'delete_flag'=>'0'))->result();
		return $result;
	}
	
	public function getprojectDescShortById($projectId)
	{
		$sql = "SELECT projects.id, projects.project_short_description, projects.project_description
				FROM `projects` 
				WHERE projects.id = ".$projectId;
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function insert_by_upload($data)
	{
		$this->db->insert_batch('campaign_members', $data);
	}
	
	public function getduplicateMembers($email,$phone,$invitee_type){
		$this->db->select("*");
		$this->db->from("campaign_members");
		//$this->db->where(array("email" => $email, "phone" => $phone)); 
		$this->db->where(array("email" => $email, "phone" => $phone,"invitee_type" => $invitee_type)); 	
		$this->result = $this->db->get();
		$result = $this->result->num_rows();
		return $result;
	}

    public function getProjectsGalleryData($image_id)
    {         
        $this->db->where('id',$image_id);
        $query = $this->db->get('projects_gallery');
        $resultArr = $query->row();
        return $resultArr;
    }

    public function getAggregateFundingAmount($campaign_id)
    {   
    	$this->db->select("sum(campaign_projets.funding_amount) as total_target_amount");
			$this->db->from("campaign_projets");      
      $this->db->where('campaign_projets.campaign_id',$campaign_id);
      $query = $this->db->get();
      $resultArr = $query->row();
      return $resultArr;
    }

    // public function getCampaignUpdatesByID($campaign_identifier)
    // {        
    // 	$this->db->select('campaign_updates.*, campaigns.identifier, campaign_comments.comments, campaign_comments.user_id, users.first_name, users.last_name, campaign_comments.created_at as comments_created_at, campaign_comments.updated_at as comments_updated_at');
	// 	$this->db->from('campaign_updates');
	// 	$this->db->join('campaigns','campaigns.id = campaign_updates.campaign_id');
	// 	$this->db->join('campaign_comments','campaign_comments.campaign_id = campaigns.id');
	// 	$this->db->join('users','users.id = campaign_comments.user_id');
	// 	$this->db->where('campaigns.identifier',$campaign_identifier);
	// 	$query = $this->db->get();
	// 	print_r($this->db->last_query());die();		
	// 	return $query->result();
    // } 

    public function getCampaignUpdatesByID($campaign_id)
    {        
    	// $this->db->select('campaign_updates.*, campaign_comments.comments, campaign_comments.user_id, users.first_name, users.last_name, campaign_comments.created_at as comments_created_at, campaign_comments.updated_at as comments_updated_at');
    	$this->db->select('campaign_updates.*, ');
		$this->db->from('campaign_updates');
		// $this->db->join('campaigns','campaigns.id = campaign_updates.campaign_id');
		// $this->db->join('campaign_comments','campaign_comments.campaign_id = campaigns.id');
		// $this->db->join('users','users.id = campaign_comments.user_id');
		$this->db->where('campaign_updates.campaign_id',$campaign_id);
		// $this->db->where('campaigns.identifier',$campaign_identifier);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();		
		return $query->result();
    }

	public function getFundraiserCampaignProjectName($campaign_id) {
		$sql = "SELECT c.id, cp.*,p.id as project_id, p.project_name, p.min_donation_amt 
				FROM campaigns as c
				LEFT JOIN campaign_projets cp ON cp.campaign_id = c.id
				LEFT JOIN projects p ON p.id = cp.project_id
				WHERE c.id = $campaign_id";
        $query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	
	public function getFundraiserCampaignCamments($campaign_id) {
		// $sql = "SELECT cp.id, cc.*,u.id,u.first_name,u.last_name
		// 		FROM campaigns as cp
		// 		LEFT JOIN campaign_comments cc ON cc.campaign_id = cp.id
		// 		LEFT JOIN users u ON u.id = cc.user_id
		// 		WHERE cp.id = $campaign_id";
        // $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		// first_name;
		$this->db->select('campaign_comments.*, users.first_name,users.last_name,');
		$this->db->from('campaign_comments');
		$this->db->join('users','users.id = campaign_comments.user_id');
		$this->db->where('campaign_comments.campaign_id',$campaign_id);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();		
		return $query->result();
	}
	
    public function getCampaignGalleryData($campaign_identifier)
    {         
		$this->db->select('projects_gallery.image');
		$this->db->from('campaign_gallery');
		$this->db->join('campaigns','campaigns.id = campaign_gallery.campaign_id');
		$this->db->join('projects_gallery','projects_gallery.id = campaign_gallery.image_id');
		$this->db->where('campaigns.identifier',$campaign_identifier);
		$query = $this->db->get();
		$resultArr = $query->result();
		return $resultArr;
    }
	
	public function getAllCampaignsData($user_id,$final_status,$limit=''){      
		$this->db->select('campaigns.*,');
		$this->db->from('campaigns');
		$this->db->where(array('campaigns.user_id' => $user_id,'campaigns.final_status'=>$final_status,'campaigns.deleted_flag'=> 0,'campaigns.hide_status'=> 0));
		if($limit!=''){
			$this->db->limit($limit);
		}
		$this->db->order_by("campaigns.id", "DESC");
        $query = $this->db->get();
		print_r($this->db->last_query());die();
        $resultArr = $query->result();
        return $resultArr;
    }
	
    public function getAllCampaignsDateDetails($user_id)
    {         
		$this->db->select('campaign_date_details.*,campaigns.final_status');
		$this->db->from("campaign_date_details");
		$this->db->join('campaigns','campaigns.id = campaign_date_details.campaign_id');
		// $this->db->where('campaigns.final_status',1);
		$this->db->where('campaign_date_details.user_id',$user_id);
        $query = $this->db->get();
        return $query->result();
    }
	
    public function getAllCampaignsDateFilter($user_id)
    {         
		$todayEnd=strtotime(date("Y-m-d 23:59:59"));
		$this->db->select('campaign_date_details.created_at, campaign_date_details.updated_at');
		$this->db->from("campaign_date_details");
		$this->db->join('campaigns','campaigns.id = campaign_date_details.campaign_id');
		$this->db->join('campaign_members','campaign_members.id = campaign_date_details.campaign_id');
        // $this->db->where('campaign_date_details.updated_at >', $from);
        $this->db->where('campaign_date_details.updated_at <', $todayEnd);
		$this->db->where('campaigns.final_status',2);
		$this->db->where('campaign_date_details.user_id',$user_id);
        $query = $this->db->get();
        return $query->result();
    }
	
    public function getAllActiveCampaigns($user_id)
    {         
		$this->db->select('campaigns.*,sector_master.sector_type');
		$this->db->from("campaigns");
		$this->db->join('sector_master','sector_master.id = campaigns.sectors');
		$this->db->where('campaigns.final_status',2);
		$this->db->where('campaigns.user_id',$user_id);
        $query = $this->db->get();
        return $query->result();
    }
	
    public function getAllInactiveCampaigns($user_id)
    {         
		$this->db->select('campaigns.*,sector_master.sector_type');
		$this->db->from("campaigns");
		$this->db->join('sector_master','sector_master.id = campaigns.sectors');
		$this->db->where('campaigns.user_id',$user_id);
		$this->db->or_where(array('campaigns.final_status' => 1 ,'campaigns.final_status' =>  4));
		// $this->db->where('campaigns.final_status',0 || 2);
        $query = $this->db->get();
        return $query->result();
    }
	
	function getCampaignById($campaign_id)	
	{	
		//$result = $this->db->get_where('campaigns',array('id'=>$campaign_id))->row();
		//return $result;
		$sql = "SELECT campaigns.id,campaigns.campaign_name,campaigns.campaign_cover_image,cp.project_id,p.id, p.project_name
				FROM `campaigns`
				LEFT JOIN campaign_projets cp ON cp.campaign_id = campaigns.id
				LEFT JOIN projects p ON p.id = cp.project_id
				WHERE campaigns.id = ".$campaign_id;
		$query = $this->db->query($sql);
		return $query->row();
	}
	
  //   public function getSectorsForCampaign()
  //   {         
		// $this->db->select('sector_master.*');
		// $this->db->from("campaigns");
		// $this->db->join('sector_master','sector_master.id = campaigns.sectors');
		// // $this->db->where('campaigns.identifier',$campaign_identifier);
		// $query = $this->db->get();
		// $resultArr = $query->result();
		// return $resultArr;
  //   }
	
    public function getcampaignMembersFromCampaign($user_id)
    {         
		$this->db->select('campaign_members.*');
		$this->db->from("campaign_members");
		// $this->db->join('campaign_members','sector_master.id = campaigns.sectors');
		// $this->db->where('campaigns.identifier',$campaign_identifier);
		$query = $this->db->get();
		$resultArr = $query->result();
		return $resultArr;
    }

	public function getTotalcampaignValues($user_id)
    {   
		$this->db->select('sum(funds_raised) as total_funds_raised,sum(donation_received) as total_donation_received, sum(certificates_earned) as total_certificates_earned, ');	
		// $this->db->join('campaign_members','campaign_members.campaign_id = campaigns.id');
		$this->db->where(array('campaigns.user_id' => $user_id,'campaigns.final_status'=>2,'campaigns.campaign_status'=> 2));	
        // $this->db->where('status', 1);
        // $this->db->where('project_id',$project_id);
        $query = $this->db->get('campaigns');
		// print_r($this->db->last_query());die();
        $result = $query->row();
        return $result;
    }

	// public function getTotalfundraiserCount($user_id)
 //    {   
	// 	$this->db->select('sum(invitee_type) as total_fundraiser, ');	
	// 	// $this->db->join('campaigns','campaigns.id = campaign_members.campaign_id', 'LEFT');
	// 	$this->db->join('campaigns','campaigns.user_id = campaign_members.invitee_id', 'LEFT');
	// 	// $this->db->join('campaigns','campaign_members.invitee_type = fundraiser');
	// 	$this->db->where(array('campaigns.user_id' => $user_id, 'campaigns.final_status'=>2,'campaigns.campaign_status'=> 2));	
	// 	// $this->db->where(array('campaigns.user_id' => $user_id,'campaign_members.inviter_type' =>'motivator','campaign_members.invitee_type' =>'fundraiser','campaigns.final_status'=>2,'campaigns.campaign_status'=> 2));	
	// 	// $this->db->where(array('campaigns.user_id' => $user_id,'campaign_members.invitee_id' =>'campaigns.user_id','campaigns.final_status'=>2,'campaigns.campaign_status'=> 2));
 //        $query = $this->db->get('campaign_members');
	// 	print_r($this->db->last_query());die();
 //        $result = $query->row();
 //        return $result;
 //    }

    public function getTotalActiveDonors($user_id)
    {         
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',2);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

	public function getTotalcampaignDropdownValues($user_id,$invitee_type,$date,$campaign_id)
    {   
		$this->db->select('count(campaign_members.invitee_type) as total_invitee_type, campaigns.identifier ');
		$this->db->join('campaigns','campaigns.id = campaign_members.campaign_id');
		$this->db->where(array('campaign_members.inviter_id' => $user_id,'campaign_members.campaign_id' => $campaign_id));
		// $this->db->where(array('campaign_members.inviter_id' => $user_id,'campaign_members.updated_at' => $updated_at));
		if ($invitee_type==1) {
			// code...
			$this->db->where(array('campaign_members.invitee_type'=> 1));
		}elseif ($invitee_type==2) {
			// code...		
			$this->db->where(array('campaign_members.invitee_type'=> 2));
		}else{
			$this->db->where(array('campaign_members.invitee_type'=> 3));

		}

		// $this->db->where('campaign_members.updated_at >=', $date);
		// $this->db->where('campaign_members.updated_at <= ', $date);
		$this->db->where('campaign_members.updated_at >', $date['fromdate']);
		$this->db->where('campaign_members.updated_at < ', $date['todate']);
		
        $query = $this->db->get('campaign_members');
		// print_r($this->db->last_query());die();
        $result = $query->result();
        return $result;
    }

	public function TotalRegisteredFundraiserValues($user_id,$invitee_type,$date,$campaign_id)
    {   
		$this->db->select('count(campaign_members.invitee_type) as total_invitee_type, campaigns.identifier ');
		$this->db->join('campaigns','campaigns.id = campaign_members.campaign_id');
		$this->db->where(array('campaign_members.inviter_id' => $user_id,'campaign_members.campaign_id' => $campaign_id,'campaign_members.register_status' => 2));
		// $this->db->where(array('campaign_members.inviter_id' => $user_id,'campaign_members.updated_at' => $updated_at));
		if ($invitee_type==1) {
			// code...
			$this->db->where(array('campaign_members.invitee_type'=> 1));
		}elseif ($invitee_type==2) {
			// code...		
			$this->db->where(array('campaign_members.invitee_type'=> 2));
		}else{
			$this->db->where(array('campaign_members.invitee_type'=> 3));

		}

		// $this->db->where('campaign_members.updated_at >=', $date);
		// $this->db->where('campaign_members.updated_at <= ', $date);
		$this->db->where('campaign_members.updated_at >', $date['fromdate']);
		$this->db->where('campaign_members.updated_at <', $date['todate']);
		
        $query = $this->db->get('campaign_members');
		// print_r($this->db->last_query());die();
        $result = $query->result();
        return $result;
    }

    public function ammountRaisedGraph($user_id)
    {
    	$this->db->select('sum(campaign_donation_details.donation_amount) as donation_amount_raised');
		$this->db->from("campaign_donation_details");
		// $this->db->join('campaign_donation_details','campaigns.id = campaign_members.campaign_id');
		$this->db->where(array('campaign_donation_details.user_id' => $user_id, 'month(campaign_donation_details.created_at)' => date('m')));		
        $query = $this->db->get();
		// print_r($this->db->last_query());die();
        $result = $query->result();
        return $result;
    }
	
    public function deletecsv($campaign_csv_id)
    {         
			$this->db->select('campaign_csv.*,');
			$this->db->from("campaign_csv");
			// $this->db->join('campaigns','campaigns.id = campaign_csv.campaign_id');
			// $this->db->where('campaign_members.register_status',1);
			$this->db->where('campaign_csv.id',$campaign_csv_id);
	    $query = $this->db->get();
		// print_r($this->db->last_query());die();
	    return $query->row();
    }
	
  //   public function getAllActiveFundraisers($user_id)
  //   {         
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status = 'Active'";
  //     	 $query = $this->db->query($sql);
		// // print_r($this->db->last_query());die();
  //     return $query->result();
  //   }
	
  //   public function getAllInActiveFundraisers($user_id)
  //   {         
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status != 'Active'";
  //     	 $query = $this->db->query($sql);
		// // print_r($this->db->last_query());die();
  //     return $query->result();
  //   }
	
    public function getGraphActiveFundraisers($user_id,$campaign_id)
    {         
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status = 'Active'";
        $singleCampaign="and cm.campaign_id=$campaign_id"; 
		if(isset($campaign_id) && $campaign_id!='all' ) $singleCampaign="and cm.campaign_id=$campaign_id";
		if(isset($campaign_id) && $campaign_id =='all' ) $singleCampaign="";
		$sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='register' $singleCampaign and c.id is not null group by invitee_id";
		// $sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = 179 AND cm.inviter_type = 'motivator' and cm.register_status='register' and cm.campaign_id=1 and c.id is not null group by invitee_id";
      	 $query = $this->db->query($sql);
		// print_r($this->db->last_query());die();
      return $query->result();
    }
	
    public function getGraphInActiveFundraisers($user_id,$campaign_id)
    {         
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status != 'Active'";
        $singleCampaign="and cm.campaign_id=$campaign_id"; 
		if(isset($campaign_id) && $campaign_id!='all' ) $singleCampaign="and cm.campaign_id=$campaign_id";
		if(isset($campaign_id) && $campaign_id =='all' ) $singleCampaign="";
		$sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='register' $singleCampaign and c.id is null group by invitee_id";
      	 $query = $this->db->query($sql);
		// print_r($this->db->last_query());die();
      return $query->result();
    }
	
    public function getAllUnregisteredFundraisers($user_id)
    {         
		$this->db->select('campaign_members.*,campaigns.campaign_name');
		$this->db->from("campaign_members");
		$this->db->join('campaigns','campaigns.id = campaign_members.campaign_id');
		$this->db->where('campaign_members.register_status',1);
		$this->db->where('campaign_members.inviter_id',$user_id);
		// print_r($this->db->last_query());die();
	    $query = $this->db->get();
	    return $query->result();
    }

    public function getAllActiveFundraisers($user_id)
    {         
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status = 'Active' AND c.id = $campaign_id";
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status = 'Active'";
        // $singleCampaign="cm.campaign_id=$campaign_id"; 

		$sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='register' and c.id is not null group by invitee_id";
		// $sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='register' and cm.campaign_id = $campaign_id and c.id is not null group by invitee_id";
		// if($campaign_id!='all' ) $sql=$sql." AND 'cm.campaign_id'= $campaign_id";
		// if($campaign_id !='all' ) $sql=$sql." AND c.id = $campaign_id";
		// if($campaign_id =='all' ) $sql=$sql."";
      	 $query = $this->db->query($sql);
		// print_r($this->db->last_query());die();
      return $query->result();
    }

    public function getAllInActiveFundraisers($user_id)
    {         
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status != 'Active' AND c.id = $campaign_id";
		// $sql = "SELECT * FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and c.final_status != 'Active'";
		$sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='register' and c.id is null group by invitee_id";
		// $sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='register' and cm.campaign_id = $campaign_id and c.id is null group by invitee_id";
		// if($campaign_id!='all' ) $sql=$sql." AND 'cm.campaign_id'= $campaign_id";
		// if($campaign_id !='all' ) $sql=$sql." AND c.id = $campaign_id";
		// if($campaign_id =='all' ) $sql=$sql."";
      	 $query = $this->db->query($sql);
		// print_r($this->db->last_query());die();
      return $query->result();
    }

    public function getGraphInvitedFundraisers($campaign_id,$user_id)
    {         
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		}
		$this->db->where('campaign_members.invitee_type',1);
		// $this->db->where('campaign_members.register_status',1);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getGraphRegisteredFundraisers($campaign_id,$user_id)
    {         
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		}
		$this->db->where('campaign_members.invitee_type',1);
		$this->db->where('campaign_members.register_status',2);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getGraphUnregisteredFundraisers($user_id,$campaign_id)
    {      
    	 $singleCampaign="and cm.campaign_id=$campaign_id"; 
		if(isset($campaign_id) && $campaign_id!='all' ) $singleCampaign="and cm.campaign_id=$campaign_id";
		if(isset($campaign_id) && $campaign_id =='all' ) $singleCampaign="";
		// $sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='unregister' $singleCampaign and c.id is null group by invitee_id";
		$sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type='fundraiser' WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='unregister' $singleCampaign and c.id is null group by phone";
      	 $query = $this->db->query($sql);
		// print_r($this->db->last_query());die();
      	return $query->result();   
		// $this->db->select('campaign_members.*,');
		// $this->db->from("campaign_members");
		// if ($campaign_id != 'all') {
		// 	// code...
		// 	$this->db->where('campaign_members.campaign_id',$campaign_id);
		// }
		// $this->db->where('campaign_members.invitee_type',1);
		// $this->db->where('campaign_members.register_status',2);
		// $query = $this->db->get();
		// // print_r($this->db->last_query());die();
		// return $query->result();
    }

    public function getAllActiveDonors($user_id)
    {         
		// $sql = "SELECT cm.*,c.id,c.funds_raised FROM campaign_members as cm LEFT JOIN campaigns as c ON c.user_id = cm.invitee_id and cm.invitee_type=2 WHERE cm.inviter_id = $user_id AND cm.inviter_type = 'motivator' and cm.register_status='register' and c.id is not null group by invitee_id";
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		$this->db->join('campaign_donation_details','campaign_donation_details.user_id = campaign_members.invitee_id');
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.inviter_type',1);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',2);
		$this->db->group_by('campaign_members.phone');
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getAllInActiveDonors($user_id)
    {         
    	$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		// $this->db->join('campaigns','campaigns.user_id = campaign_members.invitee_id');
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.inviter_type',1);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',2);
		$this->db->group_by('campaign_members.phone');
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getAllUnregisteredDonors($user_id)
    {         
    	$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		// $this->db->join('campaigns','campaigns.user_id = campaign_members.invitee_id');
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.inviter_type',1);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',1);
		$this->db->group_by('campaign_members.phone');
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getGraphActiveDonors($campaign_id,$user_id)
    {         
		$this->db->select('campaign_members.*,campaign_donation_details.donation_amount');
		$this->db->from("campaign_members");
		$this->db->join('campaign_donation_details','campaign_donation_details.user_id = campaign_members.invitee_id');
		if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		}
		$this->db->where('campaign_members.inviter_type',1);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',2);
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->group_by('campaign_members.phone');
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getGraphInActiveDonors($campaign_id,$user_id)
    {         
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		// $this->db->join('campaign_donation_details','campaign_donation_details.user_id = campaign_members.invitee_id');
		// $this->db->join('campaign_donation_details','campaign_donation_details.campaign_id = campaign_members.campaign_id');
		if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		}
		// $this->db->where('campaign_members.invitee_id','campaign_donation_details.user_id');
		$this->db->where('campaign_members.inviter_type',1);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',2);
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->group_by('campaign_members.phone');
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getGraphUnregisteredDonors($campaign_id,$user_id)
    {         
    	$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		// $this->db->join('campaigns','campaigns.user_id = campaign_members.invitee_id');
		if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		}
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.inviter_type',1);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',1);
		$this->db->group_by('campaign_members.phone');
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getGraphInvitedDonors($campaign_id,$user_id)
    {         
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		}
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.invitee_type',2);
		// $this->db->where('campaign_members.register_status',1);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function getGraphRegisteredDonors($campaign_id,$user_id)
    {         
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		}
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.invitee_type',2);
		$this->db->where('campaign_members.register_status',2);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function allUnregisteredUser($campaign_id,$user_id)
    {         
		$this->db->select('campaign_members.*,');
		$this->db->from("campaign_members");
		// if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_members.campaign_id',$campaign_id);
		// }
		$this->db->where('campaign_members.inviter_id',$user_id);
		$this->db->where('campaign_members.inviter_type',1);
		$this->db->where('campaign_members.register_status',1);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }

    public function allmilestones($campaign_id,$user_id)
    {         
		$this->db->select('campaign_milestones.*,');
		$this->db->from("campaign_milestones");
		// $this->db->join('campaign_members','campaign_members.campaign_id = campaign_milestones.campaign_id');
		// if ($campaign_id != 'all') {
			// code...
			$this->db->where('campaign_milestones.campaign_id',$campaign_id);
		// }
		$this->db->where('campaign_milestones.user_id',$user_id);
		// $this->db->where('campaign_members.inviter_type',1);
		// $this->db->where('campaign_members.register_status',1);
		$query = $this->db->get();
		// print_r($this->db->last_query());die();
		return $query->result();
    }
	
	public function getMotivatorCampaignStartEnd($campaign_id) {
        $sql = "SELECT c.id,c.user_id,cm.*,cnew.campaign_date_from,cnew.campaign_date_to,cnew.sectors 
				FROM campaigns as c
				LEFT JOIN campaign_members cm ON cm.invitee_id = c.user_id
				LEFT JOIN campaigns cnew ON cnew.id = cm.campaign_id
				WHERE c.id = $campaign_id AND cm.invitee_type = 'fundraiser'";
	    //echo $sql."<hr>";
        $query = $this->db->query($sql);
		$row = $query->row();
        //echo "<pre>";print_r($row);echo "<pre>";die;
		return $row;
	}
	
	//edit campaign
    public function getViewCampaignData($campaign_id)
    {        
		// $this->db->select('campaigns.*, projects.project_name'); 
        $this->db->where('id',$campaign_id);
        $query = $this->db->get('campaigns');
        $resultArr = $query->row();
        return $resultArr;
    }

    public function getCampaignProjectData($campaign_id)
    {
        $this->db->where('campaign_id',$campaign_id);
        $query = $this->db->get('campaign_projets');
        $resultArr = $query->row();
        return $resultArr;
    }
	
	public function getCampaignProjectGalleryData($campaign_id,$project_id)
    {
        $this->db->where('project_id',$project_id);
        $this->db->where_in('campaign_id',$campaign_id);
        $query = $this->db->get('campaign_gallery');
        $resultArr = $query->result();
        return $resultArr;
    }
	
	public function getCampaignCSV($campaign_id){
        $sql = "SELECT * FROM `campaign_csv` WHERE `campaign_id` = $campaign_id";
        $query = $this->db->query($sql);
		$row = $query->row();
		return $row;
	}
	
	 public function getTopDonors($user_id,$campaign_id){         
		$sql="select cdd.id,cdd.first_name,cdd.last_name,(select campaign_name from campaigns where id=cdd.campaign_id ) as campaign_name,cdd.campaign_id,cdd.donation_amount from campaign_members as cm left join campaign_donation_details as cdd on cm.campaign_id=cdd.campaign_id AND cm.invitee_id=cdd.user_id where cm.inviter_type='fundraiser' AND cm.invitee_type='donor' AND cm.inviter_id=$user_id AND cm.campaign_id=$campaign_id AND cm.register_status='register' AND cdd.status=1 order by cdd.donation_amount desc";
	    //echo $sql."<hr>";
	    $query = $this->db->query($sql);
      	$result=$query->result_array();
      	$topDonorArr=array();
      	for ($i=0; $i <count($result) ; $i++) { 
      		$topDonorArr[$result[$i]['campaign_id']]['campaign_id']=$result[$i]['campaign_id'];
      		$topDonorArr[$result[$i]['campaign_id']]['campaign_name']=$result[$i]['campaign_name'];
      		$topDonorArr[$result[$i]['campaign_id']]['donors'][$result[$i]['id']]['first_name']=$result[$i]['first_name'];
      		$topDonorArr[$result[$i]['campaign_id']]['donors'][$result[$i]['id']]['last_name']=$result[$i]['last_name'];
      		$topDonorArr[$result[$i]['campaign_id']]['donors'][$result[$i]['id']]['donation_amount']=$result[$i]['donation_amount'];
      	}
      	//echo "<pre>";print_r($topDonorArr);echo "<pre>";die;
      	return $topDonorArr;
    }
	
	public function getCampaignTopDonors($campaign_id){         
		$sql="select user_id,first_name,last_name,donation_amount from campaign_donation_details as cdd where cdd.campaign_id=$campaign_id  AND cdd.status=1 order by cdd.donation_amount desc limit 5";
	    //echo $sql."<hr>";
	    $query = $this->db->query($sql);
      	$result=$query->result_array();
      	return $result;
    }

	public function findUnregisterUser($email,$phone){
		/*$sql = "SELECT * FROM `campaign_members` 
				WHERE email = '$email' AND phone = $phone AND invitee_type = '$invitee_type' AND delete_flag = 0";*/
		$sql = "SELECT * FROM `campaign_members` 
				WHERE email = '$email' AND phone = $phone AND delete_flag = 0";	
	    $query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	public function findUnregisterUserType($email,$phone){
		$sql = "SELECT * FROM `campaign_members` 
				WHERE email = '$email' AND phone = $phone AND delete_flag = 0";	
	    $query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

	public function findRegisterUser($email,$phone){
		$sql = "SELECT cm.*, usr.id as userid, usr.created_at as usrcreated
				FROM `users` as usr
				LEFT JOIN campaign_members as cm ON cm.phone = usr.phone_no
				WHERE cm.email = '$email' AND cm.phone = $phone AND cm.delete_flag = 0";		
	    $query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	
	public function getCampaignPaymentByDonor($Id)
	{
		$this->db->select('*');
		$this->db->from('campaign_donation_details');	
		$this->db->where(array('id'=>$Id));
		//$this->db->order_by("id", "DESC");
		$query = $this->db->get();
		return $query->row();
	}
	
	public function getFundraiserCampaignNgoName($campaign_id){
		$sql = "SELECT c.id, cp.*, p.project_name,p.user_id,nd.id as ngo_id, nd.org_name 
				FROM campaigns as c
				LEFT JOIN campaign_projets cp ON cp.campaign_id = c.id
				LEFT JOIN projects p ON p.id = cp.project_id
				LEFT JOIN ngo_details nd ON nd.user_id = p.user_id
				WHERE c.id = $campaign_id";
        $query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	
	
	function getngoData($id)	
	{		
		$this->db->select('ngo_details.org_name, ngo_details.org_logo, ngo_details.org_address_line1, ngo_details.org_address_line2, ngo_details.city, ngo_details.state, ngo_details.pincode, ngo_details.org_80g_no, ngo_details.user_id, ngo_details.id, ngo_details.pan_no, ngo_details.website, ngo_details.officialseal_file,ngo_details.signature_file,ngo_details.csr_num,users.phone_no, users.first_name, users.last_name, users.email');
		$this->db->from('campaign_donation_details');
		$this->db->join('campaign_projets', 'campaign_projets.campaign_id = campaign_donation_details.campaign_id', 'left');
		$this->db->join('projects', 'projects.id = campaign_projets.project_id', 'left');
		$this->db->join('ngo_details', 'ngo_details.user_id = projects.user_id', 'left');
		$this->db->join('users', 'users.id = ngo_details.user_id', 'left');
		$this->db->where(array('campaign_donation_details.id'=>$id));
        $query = $this->db->get();
        return $query->row();
	}
	
	function getuserdetails($id) {
	    $this->db->select('campaign_donation_details.*, campaign_donation_details.first_name, campaign_donation_details.last_name, campaign_donation_details.email, users.phone_no');
		$this->db->from('campaign_donation_details');
		$this->db->join('users', 'users.id = campaign_donation_details.user_id', 'left');
		$this->db->where(array('campaign_donation_details.id'=>$id));
        $query = $this->db->get();
        return $query->row();
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
    
    public function updateCampaignFund($campaignId) {
    	$sql="select sum(donation_amount) as fundsRaised from `campaign_donation_details` where campaign_id=$campaignId and status=1";
        $query = $this->db->query($sql);
		$row = $query->row_array();
		$fundsRaised=$row['fundsRaised'];
		$this->db->where('id', $campaignId);
		$this->db->update('campaigns', array('funds_raised' => $fundsRaised));
    }
   
	
}
