<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Usha Das (usha@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - Jan 2020
###+------------------------------------------------------------------------------------------------

class SearchModel extends CI_Model {
	
    public function __construct()
    {
        $this->load->database();
    }   
	/*
	Sanjay Oraon
	Date 22-09-2023
	ngo_details moved to user_profile
		    public function AllProjects($search_param='', $order_by='', $offset='', $limit='')
			{	
				//print_r($search_param);
				$data = array();		
				
				$data = array();	
				// $this->db->select('P.*, ND.org_name, ND.org_logo,IF((ND.org_80g_file!="" && ND.signature_file!="" && ND.officialseal_file!=""), 1, 0) as tax_benefit');		
				//$this->db->select('P.*, ND.org_name, ND.org_logo,ND.csr_num,IF((ND.org_80g_file!="" && ND.signature_file!="" && ND.officialseal_file!=""), 1, 0) as tax_benefit');	 //adde csr number by Neerajkumar  on 22-04-2022
				$this->db->select('P.*, ND.org_name, ND.org_logo,ND.csr_num,IF((ND.org_80g_file!=""), 1, 0) as tax_benefit');	//signature file and official seal has commented from tax_benefit //code added on 4-10-22
				$this->db->from('projects P');
				$this->db->join('users U', 'U.id = P.user_id', 'inner' );
				$this->db->join("ngo_details ND", 'ND.user_id = P.user_id', 'inner' );
				$this->db->join('projects_funds PF', 'PF.project_id = P.id', 'left');
				$this->db->where("U.user_status", 1);
				$this->db->where("P.project_status", 1);
				$this->db->where("P.is_deleted", 0);
				$this->db->where("P.hide_status", 0);
						
				if($offset!='' && $order_by=='asc')	{
					$this->db->where('P.id > ' , $offset);
				} else if($offset!='' && $order_by=='desc')	{
					$this->db->where('P.id < ' , $offset);
				} else if($offset!='')	{
					$this->db->where('P.id < ' , $offset);
				}		
				
				// project name - keyword
				if(isset($search_param['keyword']) && $search_param['keyword'] !="")
				{
					$this->db->like('P.project_name',$search_param['keyword']);
				}
				
				// Project Type
				$ProTypes = array();
				if(isset($search_param['pt_project']) && $search_param['pt_project'] !="")
				{
					$ProTypes[] = $search_param['pt_project'];
				}
				if(isset($search_param['pt_program']) && $search_param['pt_program'] !="")
				{
					$ProTypes[] = $search_param['pt_program'];
				}		
				if(count($ProTypes) > 0)
				{
					$this->db->where_in('P.project_type',$ProTypes);
				}
				
				// Funding Type
				$FundTypes = array();
				if(isset($search_param['ft_onetime']) && $search_param['ft_onetime'] !="")
				{
					$FundTypes[] = 'PF.onetime_pay = 1';
				}
				if(isset($search_param['ft_instpay']) && $search_param['ft_instpay'] !="")
				{
					$FundTypes[] = 'PF.inst_pay = 1';
				}
				if(isset($search_param['ft_milestone']) && $search_param['ft_milestone'] !="")
				{
					$FundTypes[] = 'PF.milestone_pay = 1';
				}		
				if(count($FundTypes) > 0)
				{
					$FundTypesStr = implode(" OR ", $FundTypes);			
					$this->db->where("(".$FundTypesStr.")");
				}
				
				//Search by CSRF-1 
				if(isset($search_param['csr_num']))
				{
					$this->db->where("( ND.csr_num != '".$search_param['csr_num']."')");					
				}
				
				// Location
				if(isset($search_param['search_by_loc']) && $search_param['search_by_loc'] !="")
				{
					$this->db->where("(P.city like '%".$search_param['search_by_loc']."%' OR P.district like '%".$search_param['search_by_loc']."%')");			
				}
				
				// Donation amount range
				if((isset($search_param['donation_min_amount']) && $search_param['donation_min_amount'] !="") && (isset($search_param['donation_max_amount']) && $search_param['donation_max_amount'] !=""))
				{
					$donation_min_amount = filter_var($search_param['donation_min_amount'],FILTER_SANITIZE_NUMBER_INT);		
					$donation_max_amount = filter_var($search_param['donation_max_amount'],FILTER_SANITIZE_NUMBER_INT);
						
					$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");					
				}
				$donationTypes = array();
				if(isset($search_param['damt_1']) && $search_param['damt_1'] != ''){
					$donation_min_amount = 2500000;
					//$this->db->where("(P.min_donation_amt <= '".$donation_min_amount."')");	
					$donationTypes[] = "(P.min_donation_amt <= '".$donation_min_amount."')";	
				}
				if(isset($search_param['damt_2']) && $search_param['damt_2'] != ''){
					$donation_min_amount = 2500000;
					$donation_max_amount = 5000000;
					//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");	
					$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')";	
				}
				if(isset($search_param['damt_3']) && $search_param['damt_3'] != ''){
					$donation_min_amount = 5000000;
					$donation_max_amount = 10000000;
					//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");	
					$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')";
				}
				if(isset($search_param['damt_4']) && $search_param['damt_4'] != ''){
					$donation_min_amount = 10000000;
					//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."')");
					$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."')";	
				}
				if(count($donationTypes) > 0){
					$donationTypesStr = implode(" OR ", $donationTypes);			
					$this->db->where("(".$donationTypesStr.")");
				}
				
				// Sector
				if(isset($search_param['search_sector']) && $search_param['search_sector'] !="")
				{
					$selectsector_subquery_ary = array();
					foreach ($search_param['search_sector'] as $sv) {
						$selectsector_subquery_ary[] = "P.sectors like '%,".$sv.",%'";
					}
					
					if(count($selectsector_subquery_ary) > 0)
					{
						$SelectedSectorStr = implode(" OR ", $selectsector_subquery_ary);			
						$this->db->where("(".$SelectedSectorStr.")");
					}			
				}
				
				// Beneficiary
				if(isset($search_param['search_beneficiary']) && $search_param['search_beneficiary'] !="")
				{
					$selectben_subquery_ary = array();
					foreach ($_POST['search_beneficiary'] as $sb) {
						$selectben_subquery_ary[] = "P.beneficiaries like '%,".$sb.",%'";
					}
					
					if(count($selectben_subquery_ary) > 0)
					{
						$SelectedBenStr = implode(" OR ", $selectben_subquery_ary);			
						$this->db->where("(".$SelectedBenStr.")");
					}			
				}		

				if(isset($order_by) &&  $order_by !="")
				{
				if($order_by=='asc')
				{
					$this->db->order_by("P.id", "ASC");
				}
				if($order_by=='desc')
				{
					$this->db->order_by("P.id", "DESC");
				}
				}else {
					$this->db->order_by("P.id", "DESC");
				}		
				
				if($limit!='')
				{
					$this->db->limit($limit);
				}
				
				$query = $this->db->get();
				//print_r($this->db->last_query());die;
				$result = $query->result();
				return $result;	   
			}
	*/
    public function AllProjects($search_param='', $order_by='', $offset='', $limit='')
	{	
		$data = array();		
		
		$data = array();	
		
		$this->db->from('projects P');

		// Code commented for activate project
		// $this->db->join('users U', 'U.profile_id_display = P.profile_id', 'inner' );
		// Code commented for activate project
		$this->db->join("user_profile ND", 'ND.id = P.profile_id', 'inner' );
		$this->db->join('projects_funds PF', 'PF.project_id = P.id', 'left');
				// Code commented for activate project
		// $this->db->where("U.user_status", 1);
		// Code commented for activate project
		$this->db->where("P.project_status", 1);
		$this->db->where("P.is_deleted", 0);
	
				
		if($offset!='' && $order_by=='asc')	{
			$this->db->where('P.id > ' , $offset);
		} else if($offset!='' && $order_by=='desc')	{
			$this->db->where('P.id < ' , $offset);
		} else if($offset!='')	{
			$this->db->where('P.id < ' , $offset);
		}		
		
		// project name - keyword
		if(isset($search_param['keyword']) && $search_param['keyword'] !="")
		{
			$this->db->like('P.project_name',$search_param['keyword']);
		}
		
		// Project Type
		$ProTypes = array();
		if(isset($search_param['pt_project']) && $search_param['pt_project'] !="")
		{
			$ProTypes[] = $search_param['pt_project'];
		}
		if(isset($search_param['pt_program']) && $search_param['pt_program'] !="")
		{
			$ProTypes[] = $search_param['pt_program'];
		}		
		if(count($ProTypes) > 0)
		{
			$this->db->where_in('P.project_type',$ProTypes);
		}
		
		// Funding Type
		$FundTypes = array();
		if(isset($search_param['ft_onetime']) && $search_param['ft_onetime'] !="")
		{
			$FundTypes[] = 'PF.onetime_pay = 1';
		}
		if(isset($search_param['ft_instpay']) && $search_param['ft_instpay'] !="")
		{
			$FundTypes[] = 'PF.inst_pay = 1';
		}
		if(isset($search_param['ft_milestone']) && $search_param['ft_milestone'] !="")
		{
			$FundTypes[] = 'PF.milestone_pay = 1';
		}		
		if(count($FundTypes) > 0)
		{
			$FundTypesStr = implode(" OR ", $FundTypes);			
			$this->db->where("(".$FundTypesStr.")");
		}
		
		//Search by CSRF-1 
		if(isset($search_param['csr_num']))
		{
			$this->db->where("( ND.csr_num != '".$search_param['csr_num']."')");					
		}
		
		// Location
		if(isset($search_param['search_by_loc']) && $search_param['search_by_loc'] !="")
		{
			$this->db->where("(P.city like '%".$search_param['search_by_loc']."%' OR P.district like '%".$search_param['search_by_loc']."%')");			
		}
		
		// Donation amount range
		if((isset($search_param['donation_min_amount']) && $search_param['donation_min_amount'] !="") && (isset($search_param['donation_max_amount']) && $search_param['donation_max_amount'] !=""))
		{
			$donation_min_amount = filter_var($search_param['donation_min_amount'],FILTER_SANITIZE_NUMBER_INT);		
			$donation_max_amount = filter_var($search_param['donation_max_amount'],FILTER_SANITIZE_NUMBER_INT);
				
			$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");					
		}
		$donationTypes = array();
		if(isset($search_param['damt_1']) && $search_param['damt_1'] != ''){
			$donation_min_amount = 2500000;
			//$this->db->where("(P.min_donation_amt <= '".$donation_min_amount."')");	
			$donationTypes[] = "(P.min_donation_amt <= '".$donation_min_amount."')";	
		}
		if(isset($search_param['damt_2']) && $search_param['damt_2'] != ''){
			$donation_min_amount = 2500000;
			$donation_max_amount = 5000000;
			//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");	
			$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')";	
		}
		if(isset($search_param['damt_3']) && $search_param['damt_3'] != ''){
			$donation_min_amount = 5000000;
			$donation_max_amount = 10000000;
			//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");	
			$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')";
		}
		if(isset($search_param['damt_4']) && $search_param['damt_4'] != ''){
			$donation_min_amount = 10000000;
			//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."')");
			$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."')";	
		}
		if(count($donationTypes) > 0){
			$donationTypesStr = implode(" OR ", $donationTypes);			
			$this->db->where("(".$donationTypesStr.")");
		}
		
		// Sector
		if(isset($search_param['search_sector']) && $search_param['search_sector'] !="")
		{
			$selectsector_subquery_ary = array();
			foreach ($search_param['search_sector'] as $sv) {
				$selectsector_subquery_ary[] = "P.sectors like '%,".$sv.",%'";
			}
			
			if(count($selectsector_subquery_ary) > 0)
			{
				$SelectedSectorStr = implode(" OR ", $selectsector_subquery_ary);			
				$this->db->where("(".$SelectedSectorStr.")");
			}			
		}
		
		// Beneficiary
		if(isset($search_param['search_beneficiary']) && $search_param['search_beneficiary'] !="")
		{
			$selectben_subquery_ary = array();
			foreach ($_POST['search_beneficiary'] as $sb) {
				$selectben_subquery_ary[] = "P.beneficiaries like '%,".$sb.",%'";
			}
			
			if(count($selectben_subquery_ary) > 0)
			{
				$SelectedBenStr = implode(" OR ", $selectben_subquery_ary);			
				$this->db->where("(".$SelectedBenStr.")");
			}			
		}		

		if(isset($order_by) &&  $order_by !="")
		{
		  if($order_by=='asc')
		  {
			  $this->db->order_by("P.id", "ASC");
		  }
		  if($order_by=='desc')
		  {
			   $this->db->order_by("P.id", "DESC");
		  }
		}else {
			$this->db->order_by("P.id", "DESC");
		}		
		
		if($limit!='')
		{
			$this->db->limit($limit);
		}
		
		$query = $this->db->get();
		//print_r($this->db->last_query());die;
		$result = $query->result();
		return $result;	   
	}  
	
	 public function AllProjectsNew($search_param='', $order_by='', $offset='', $limit='')
	{	
		//print_r($search_param);
		$data = array();		
		
		$data = array();	
		$this->db->select('P.*, ND.org_name');		
		$this->db->from('projects P');
		$this->db->join('users U', 'U.id = P.user_id', 'inner' );
		$this->db->join("ngo_details ND", 'ND.user_id = P.user_id', 'inner' );
		$this->db->join('projects_funds PF', 'PF.project_id = P.id', 'left');
		$this->db->where("U.user_status", 1);
		$this->db->where("P.project_status", 1);
		$this->db->where("P.is_deleted", 0);
		$this->db->where("P.hide_status", 0);
				
		if($offset!='' && $order_by=='asc')	{
			$this->db->where('P.id > ' , $offset);
		} else if($offset!='' && $order_by=='desc')	{
			$this->db->where('P.id < ' , $offset);
		} else if($offset!='')	{
			$this->db->where('P.id < ' , $offset);
		}		
		
		// project name - keyword
		if(isset($search_param['keyword']) && $search_param['keyword'] !="")
		{

			$searchParam=explode(" ", $search_param['keyword']);
			//echo "<pre>";print_r($searchParam);die;
			for($i=0;$i <count($searchParam); $i++) { 
			    $selectsearch_subquery_ary[] = "P.project_name like '%".$searchParam[$i]."%'";
			}
			//echo "<pre>";print_r($selectsearch_subquery_ary);die;
			if(count($selectsearch_subquery_ary) > 0){
				$selectedSearchStr = implode(" OR ", $selectsearch_subquery_ary);
				$this->db->where("(".$selectedSearchStr.")");
			}
		}
		
		// Project Type
		$ProTypes = array();
		if(isset($search_param['pt_project']) && $search_param['pt_project'] !="")
		{
			$ProTypes[] = $search_param['pt_project'];
		}
		if(isset($search_param['pt_program']) && $search_param['pt_program'] !="")
		{
			$ProTypes[] = $search_param['pt_program'];
		}		
		if(count($ProTypes) > 0)
		{
			$this->db->where_in('P.project_type',$ProTypes);
		}
		
		// Funding Type
		$FundTypes = array();
		if(isset($search_param['ft_onetime']) && $search_param['ft_onetime'] !="")
		{
			$FundTypes[] = 'PF.onetime_pay = 1';
		}
		if(isset($search_param['ft_instpay']) && $search_param['ft_instpay'] !="")
		{
			$FundTypes[] = 'PF.inst_pay = 1';
		}
		if(isset($search_param['ft_milestone']) && $search_param['ft_milestone'] !="")
		{
			$FundTypes[] = 'PF.milestone_pay = 1';
		}		
		if(count($FundTypes) > 0)
		{
			$FundTypesStr = implode(" OR ", $FundTypes);			
			$this->db->where("(".$FundTypesStr.")");
		}	
		
		// Location
		if(isset($search_param['search_by_loc']) && $search_param['search_by_loc'] !="")
		{
			$this->db->where("(P.city like '%".$search_param['search_by_loc']."%' OR P.district like '%".$search_param['search_by_loc']."%')");			
		}
		
		// Donation amount range
		if((isset($search_param['donation_min_amount']) && $search_param['donation_min_amount'] !="") && (isset($search_param['donation_max_amount']) && $search_param['donation_max_amount'] !=""))
		{
			$donation_min_amount = filter_var($search_param['donation_min_amount'],FILTER_SANITIZE_NUMBER_INT);		
			$donation_max_amount = filter_var($search_param['donation_max_amount'],FILTER_SANITIZE_NUMBER_INT);
				
			$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");					
		}
		$donationTypes = array();
		if(isset($search_param['damt_1']) && $search_param['damt_1'] != ''){
			$donation_min_amount = 2500000;
			//$this->db->where("(P.min_donation_amt <= '".$donation_min_amount."')");	
			$donationTypes[] = "(P.min_donation_amt <= '".$donation_min_amount."')";	
		}
		if(isset($search_param['damt_2']) && $search_param['damt_2'] != ''){
			$donation_min_amount = 2500000;
			$donation_max_amount = 5000000;
			//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");	
			$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')";	
		}
		if(isset($search_param['damt_3']) && $search_param['damt_3'] != ''){
			$donation_min_amount = 5000000;
			$donation_max_amount = 10000000;
			//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')");	
			$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."' AND P.min_donation_amt <= '".$donation_max_amount."')";
		}
		if(isset($search_param['damt_4']) && $search_param['damt_4'] != ''){
			$donation_min_amount = 10000000;
			//$this->db->where("(P.min_donation_amt >= '".$donation_min_amount."')");
			$donationTypes[] = "(P.min_donation_amt >= '".$donation_min_amount."')";	
		}
		if(count($donationTypes) > 0){
			$donationTypesStr = implode(" OR ", $donationTypes);			
			$this->db->where("(".$donationTypesStr.")");
		}
		
		// Sector
		if(isset($search_param['search_sector']) && $search_param['search_sector'] !="")
		{
			$selectsector_subquery_ary = array();
			foreach ($search_param['search_sector'] as $sv) {
				$selectsector_subquery_ary[] = "P.sectors like '%,".$sv.",%'";
			}
			
			if(count($selectsector_subquery_ary) > 0)
			{
				$SelectedSectorStr = implode(" OR ", $selectsector_subquery_ary);			
				$this->db->where("(".$SelectedSectorStr.")");
			}			
		}
		
		// Beneficiary
		if(isset($search_param['search_beneficiary']) && $search_param['search_beneficiary'] !="")
		{
			$selectben_subquery_ary = array();
			foreach ($_POST['search_beneficiary'] as $sb) {
				$selectben_subquery_ary[] = "P.beneficiaries like '%,".$sb.",%'";
			}
			
			if(count($selectben_subquery_ary) > 0)
			{
				$SelectedBenStr = implode(" OR ", $selectben_subquery_ary);			
				$this->db->where("(".$SelectedBenStr.")");
			}			
		}		

		if(isset($order_by) &&  $order_by !="")
		{
		  if($order_by=='asc')
		  {
			  $this->db->order_by("P.id", "ASC");
		  }
		  if($order_by=='desc')
		  {
			   $this->db->order_by("P.id", "DESC");
		  }
		}else {
			$this->db->order_by("P.id", "DESC");
		}		
		
		if($limit!='')
		{
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		//print_r($this->db->last_query());die;
		
		$result = $query->result();
		return $result;	   
	}  
	

	public function GetDonationRange()
	{
		$query = $this->db->query("SELECT min(min_donation_amt) as donation_min_amt, max(min_donation_amt) as donation_max_amt FROM projects WHERE project_status = 1 AND is_deleted = 0");
   		$query_res = $query->row();
		
		if($query_res->donation_min_amt == '') { $query_res->donation_min_amt = 0; }
		if($query_res->donation_max_amt == '') { $query_res->donation_max_amt = 10000000; }		
		
		return $query_res;
		
	}
	
}    
