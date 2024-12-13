<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Ranjana Patel (ranjana.patel@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - Jan 2020
###+------------------------------------------------------------------------------------------------

class ContractModel extends CI_Model {
	
    public function __construct()
    {
        $this->load->database();
    }
	
	public function getContractUniqueExistCount($contractUniqueID)
	{
		return $this->db->get_where('contracts_funds',array('contract_unique_id'=>$contractUniqueID))->num_rows();
	}
	/*
	Sanjay Oraon 
	Date 16-09-2023
	contracts_funds renamed to contract and some fields are modified
	corporate_details merged with user_profile

	function getAllUnsignedContracts($userId,$orgType,$offset='',$limit='')
	{
		if($orgType == 2){
			$this->db->select('CF.*, P.project_name, ND.org_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			//$this->db->where(array('CF.contributor_user_id' => $userId,'U.status'=>1,'CF.status'=>0,'P.final_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.status'=>0,'P.final_status'=>1,'P.deleted_flag'=> 0));
			$this->db->or_where('CF.status',5);
		}else{
			$this->db->select('CF.*, P.project_name, CD.company_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.contributor_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('corporate_details CD', 'CD.user_id = CF.contributor_user_id', 'inner' );
			//$this->db->where(array('CF.ngo_user_id' => $userId,'CF.status !='=>4,'P.final_status'=>1,'P.deleted_flag'=> 0));
			//$this->db->where(array('CF.ngo_user_id'=>$userId,'U.status'=>1));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->where(array('CF.ngo_user_id'=>$userId));
			
			$this->db->group_start();
			$this->db->where(array('CF.ngo_user_id' => $userId,'CF.status !='=>1,'P.final_status'=>1,'P.deleted_flag'=> 0));
			$this->db->where('CF.status != ',4);
			$this->db->or_where('CF.status',0);
			$this->db->or_where('CF.status',5);
			$this->db->or_where('CF.status',6);
			$this->db->group_end();
		}
		
		$this->db->order_by("CF.id", "DESC");
		if($limit!='')
		{
			$this->db->limit($limit);
		}
        $query = $this->db->get();
		//print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }*/
	function getAllUnsignedContracts($userId,$orgType,$offset='',$limit='')
	{
		if($orgType == 2){
			$this->db->select('CF.*, P.project_name, ND.org_name as org_name');	
			$this->db->from('contract CF');
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.status'=>0,'P.project_status'=>1,'P.deleted_flag'=> 0));
			$this->db->or_where('CF.status',5);
		}else{
			$this->db->select('CF.*, P.project_name, CD.entity_name as org_name');	
			$this->db->from('contract CF');
			$this->db->join('users U', 'U.id = CF.profile_id_contributor', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('user_profile CD', 'CD.user_id = CF.profile_id_contributor', 'inner' );
			
			$this->db->group_start();
			$this->db->where('U.user_status',1);
			$this->db->or_where('U.user_status',8);
			$this->db->group_end();
			
			$this->db->where(array('CF.profile_id_ngo'=>$userId));
			
			$this->db->group_start();
			$this->db->where(array('CF.profile_id_ngo' => $userId,'P.project_status'=>1));
			$this->db->group_end();
		}
		
		$this->db->order_by("CF.id", "DESC");
		if($limit!='')
		{
			$this->db->limit($limit);
		}
        $query = $this->db->get();
		//print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }
	/*
	Sanjay Oraon 
	Date 16-09-2023
	contracts_funds renamed to contract and some fields are modified
	corporate_details merged with user_profile

	function getAllSignedContracts($userId,$orgType,$offset='',$limit='')
	{
		if($orgType == 2){
			$this->db->select('CF.*, P.project_name, ND.org_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			//$this->db->where(array('CF.contributor_user_id' => $userId,'U.status'=>1,'CF.status !='=>0,'P.final_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.status !='=>0,'P.final_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->where('CF.status !=',5);
		}else{
			$this->db->select('CF.*, P.project_name, CD.company_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.contributor_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('corporate_details CD', 'CD.user_id = CF.contributor_user_id', 'inner' );
			//$this->db->where(array('CF.ngo_user_id'=>$userId,'U.status'=>1));
			
			$this->db->where(array('CF.ngo_user_id'=>$userId));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->group_start();
			$this->db->where(array('P.final_status'=>1,'P.deleted_flag'=> 0));
			$this->db->where('CF.status !=',0);
			$this->db->where('CF.status !=',2);
			$this->db->where('CF.status !=',3);
			$this->db->where('CF.status !=',5);
			$this->db->where('CF.status !=',6);
			$this->db->group_end();
		}
		
		// if($limit!='')
		// {
			// $this->db->limit($limit);
		// }
		$this->db->order_by("CF.id", "DESC");
        $query = $this->db->get();
		// print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }
	*/
	function getAllSignedContracts($userId,$orgType,$offset='',$limit='')
	{
		if($orgType == 2){
			$this->db->select('CF.*, P.project_name, ND.org_name as org_name');	
			$this->db->from('contract CF');
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.status !='=>0,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->where('CF.status !=',5);
		}else{
			$this->db->select('CF.*, P.project_name, CD.entity_name as org_name');	
			$this->db->from('contract CF');
			$this->db->join('users U', 'U.id = CF.profile_id_contributor', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('user_profile CD', 'CD.user_id = CF.profile_id_contributor', 'inner' );
			$this->db->where(array('CF.profile_id_ngo'=>$userId));
			$this->db->group_start();
			$this->db->where('U.user_status',1);
			$this->db->or_where('U.user_status',8);
			$this->db->group_end();
			
			$this->db->group_start();
			$this->db->where(array('P.project_status'=>1));
			$this->db->group_end();
		}
		
		// if($limit!='')
		// {
			// $this->db->limit($limit);
		// }
		$this->db->order_by("CF.id", "DESC");
        $query = $this->db->get();
		// print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }
	function getAllUnsignedContractsByProjectId($userId,$orgType,$projectId)
	{
		if($orgType == 2){
			$this->db->select('CF.*, P.project_name, ND.org_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			//$this->db->where(array('CF.contributor_user_id' => $userId,'U.status'=>1,'CF.project_id' => $projectId,'CF.status'=>0,'P.final_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.project_id' => $projectId,'CF.status'=>0,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->or_where('CF.status',5);
		}else{
			$this->db->select('CF.*, P.project_name, CD.company_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.contributor_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('corporate_details CD', 'CD.user_id = CF.contributor_user_id', 'inner' );
			//$this->db->where(array('CF.ngo_user_id' => $userId,'U.status'=>1,'CF.project_id' => $projectId,'CF.status !='=>4,'P.final_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->where(array('CF.ngo_user_id' => $userId,'CF.project_id' => $projectId,'CF.status !='=>4,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			//$this->db->where('CF.status',0);
			//$this->db->or_where('CF.status',3);
		}
		
		// if($limit!='')
		// {
			// $this->db->limit($limit);
		// }
		$this->db->order_by("CF.id", "DESC");
        $query = $this->db->get();
		//print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }


	
	function getAllSignedContractsByProjectId($userId,$orgType,$projectId)
	{
		if($orgType == 2){
			$this->db->select('CF.*, P.project_name, ND.org_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			//$this->db->where(array('CF.contributor_user_id' => $userId,'U.status'=>1,'CF.project_id' => $projectId,'CF.status !='=>0,'P.final_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.project_id' => $projectId,'CF.status !='=>0,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->where('CF.status !=',5);
		}else{
			$this->db->select('CF.*, P.project_name, CD.company_name as org_name');	
			$this->db->from('contracts_funds CF');
			$this->db->join('users U', 'U.id = CF.contributor_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('corporate_details CD', 'CD.user_id = CF.contributor_user_id', 'inner' );
			//$this->db->where(array('CF.ngo_user_id' => $userId,'U.status'=>1,'CF.project_id' => $projectId,'P.final_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->where(array('CF.ngo_user_id' => $userId,'CF.project_id' => $projectId,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			$this->db->where('CF.status !=',0);
			$this->db->where('CF.status !=',3);
		}
		
		// if($limit!='')
		// {
			// $this->db->limit($limit);
		// }
		$this->db->order_by("CF.id", "DESC");
        $query = $this->db->get();
		//print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }
	
	function getAllPayslipData($userId,$orgType,$offset='',$limit='')
	{
		if($orgType == 2){
			$this->db->select('CFP.*, CF.payment_type, CF.first_installment_date, P.project_name, ND.org_name as org_name, CF.ngo_user_id');	
			$this->db->from('contracts_funds_payslip CFP');
			$this->db->join('contracts_funds CF', 'CF.id = CFP.contracts_funds_id', 'inner' );
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			//$this->db->where(array('CF.contributor_user_id' => $userId,'U.status'=>1,'CF.status'=>1,'P.final_status'=>1,'P.deleted_flag'=> 0));
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.status'=>1,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			//$this->db->or_where('CF.status',5);
		}else{
			$this->db->select('CFP.*, CF.contract_unique_id, P.project_name, CD.company_name as org_name, CF.ngo_user_id');	
			$this->db->from('contracts_funds_payslip CFP');
			$this->db->join('contracts_funds CF', 'CF.id = CFP.contracts_funds_id', 'inner' );
			$this->db->join('users U', 'U.id = CF.contributor_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('corporate_details CD', 'CD.user_id = CF.contributor_user_id', 'inner' );
			//$this->db->where(array('CF.ngo_user_id' => $userId,'CF.status !='=>4,'P.final_status'=>1,'P.deleted_flag'=> 0));
			//$this->db->where(array('CF.ngo_user_id'=>$userId,'U.status'=>1,'CF.status'=>1,'P.final_status'=>1,'P.deleted_flag'=> 0));
			$this->db->where(array('CF.ngo_user_id'=>$userId,'CF.status'=>1,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			// $this->db->group_start();
			// $this->db->where(array('CF.ngo_user_id' => $userId,'CF.status !='=>1,'P.final_status'=>1,'P.deleted_flag'=> 0));
			// $this->db->where('CF.status != ',4);
			// $this->db->or_where('CF.status',0);
			// $this->db->or_where('CF.status',5);
			// $this->db->or_where('CF.status',6);
			// $this->db->group_end();
		}
		
		$this->db->order_by("CFP.id", "DESC");
		if($limit!='')
		{
			$this->db->limit($limit);
		}
        $query = $this->db->get();
		//print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }

	// code written for getreportcontributorlist
	function getrepotcontributorlist($userId){
		// $get_report_id_array ="SELECT * FROM project_contributor_funds WHERE contributor_id = $userId";
		// $query_array = $this->db->query($get_report_id_array);
		// $get_array = $query_array->result();
		// foreach($get_array as $gets){
		// 	print_R("<pre>");
		// 	print_r($gets->id);
		// }
		// $sql="SELECT pr.id,pr.due_date , pr.submit_date,p.project_name FROM project_reports AS pr, contracts_funds AS cf, projects AS p WHERE report_type='submitted' 
		// AND cf.id = pr.contributor_id AND FIND_IN_SET('$userId',cf.contributor_user_id) AND cf.project_id = p.id";
		// $sql ="SELECT pr.id , pcf.id as contributed_id , pcf.project_id,pcf.contributor_id,pcf.funded_by, pr.due_date,pr.submit_date,p.project_name FROM 
		// project_contributor_funds AS pcf , project_reports AS pr, projects AS p 
		// WHERE pr.report_type='Submitted' AND pcf.project_id = p.id AND pcf.project_id = pr.project_id  AND pcf.contributor_id='$userId'";
		$sql ="SELECT pr.id , pcf.id as contributed_id , pcf.project_id,pcf.contributor_id,pcf.funded_by, pr.due_date,pr.submit_date,p.project_name,cd.company_name FROM 
		project_contributor_funds AS pcf , project_reports AS pr, projects AS p ,corporate_details AS cd
		WHERE pr.report_type='Submitted' AND pcf.project_id = p.id AND pcf.project_id = pr.project_id  AND pcf.contributor_id='$userId' AND cd.user_id='$userId'";
		// print_r($sql);
	    $query = $this->db->query($sql);
		$resultArr = $query->result();
		// echo '<pre>'; print_r($result); echo '</pre>';
		return $resultArr;
		
	}
	// code ends for getreportcontributorlist

	// code for new getreportcontributorlist
	function getrepotcontributorlistn($userId,$limit,$offset){
		// $sql ="SELECT pr.id,pr.work_activity_status, pcf.id AS contributed_id , SUM(pcfd.amount) AS amount_utilized, pcf.project_id,pcf.contributor_id,pcf.funded_by, SUM(pcf.committed_amount) as committed_amount,SUM(pcf.received_amount) as received_amount ,SUM(pcf.balance_amount) as balance_amount , pr.due_date,pr.submit_date,p.project_name,cd.company_name 
		// FROM project_contributor_funds AS pcf , project_contributor_fund_details AS pcfd, project_reports AS pr, projects AS p ,corporate_details AS cd 
		// WHERE pr.report_type='Submitted' AND pcf.project_id = p.id AND pcf.project_id = pr.project_id AND pcf.contributor_id='$userId' AND pcfd.type='utilized' 
		// AND cd.user_id='$userId' GROUP BY p.id";
		$sql ="SELECT pr.id,pr.work_activity_status, pcf.id AS contributed_id , SUM(pcfd.amount) AS amount_utilized, pcf.project_id,pcf.contributor_id,pcf.funded_by, SUM(pcf.committed_amount) as committed_amount,SUM(pcf.received_amount) as received_amount ,SUM(pcf.balance_amount) as balance_amount , pr.due_date,pr.submit_date,p.project_name,cd.company_name 
		FROM project_contributor_funds AS pcf , project_contributor_fund_details AS pcfd, project_reports AS pr, projects AS p ,corporate_details AS cd 
		WHERE pr.report_type='Submitted' AND pcf.project_id = p.id AND pcf.project_id = pr.project_id AND pcf.contributor_id='$userId' AND pcfd.type='utilized' 
		AND cd.user_id='$userId' GROUP BY p.id ORDER BY p.id LIMIT $limit OFFSET $offset" ;
		// print_r($sql);
		// exit;
		$query = $this->db->query($sql);
		$resultArr = $query->result();
		return $resultArr;
	}
	// code ends for new getreportcontributorlist

	// code for new getreportcontributor num_rows 
	function getrepotcontributorlist_num_rows($userId){
		$sql ="SELECT pr.id,pr.work_activity_status, pcf.id AS contributed_id , SUM(pcfd.amount) AS amount_utilized, pcf.project_id,pcf.contributor_id,pcf.funded_by, SUM(pcf.committed_amount) as committed_amount,SUM(pcf.received_amount) as received_amount ,SUM(pcf.balance_amount) as balance_amount , pr.due_date,pr.submit_date,p.project_name,cd.company_name 
		FROM project_contributor_funds AS pcf , project_contributor_fund_details AS pcfd, project_reports AS pr, projects AS p ,corporate_details AS cd 
		WHERE pr.report_type='Submitted' AND pcf.project_id = p.id AND pcf.project_id = pr.project_id AND pcf.contributor_id='$userId' AND pcfd.type='utilized' 
		AND cd.user_id='$userId' GROUP BY p.id";
		$query = $this->db->query($sql);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	// code ends for new getreportcontributorlist num_rows
 	
	function getAllPayslipDataByProjectId($userId,$orgType,$projectId)
	{
		if($orgType == 2){
			$this->db->select('CFP.*, CF.payment_type, CF.first_installment_date, P.project_name, ND.org_name as org_name, CF.ngo_user_id');	
			$this->db->from('contracts_funds_payslip CFP');
			$this->db->join('contracts_funds CF', 'CF.id = CFP.contracts_funds_id', 'inner' );
			$this->db->join('users U', 'U.id = CF.ngo_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('ngo_details ND', 'ND.user_id = CF.ngo_user_id', 'inner' );
			//$this->db->where(array('CF.contributor_user_id' => $userId,'U.status'=>1,'CF.status'=>1,'CF.project_id' => $projectId,'P.final_status'=>1,'P.deleted_flag'=> 0));
			$this->db->where(array('CF.contributor_user_id' => $userId,'CF.status'=>1,'CF.project_id' => $projectId,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			//$this->db->or_where('CF.status',5);
		}else{
			$this->db->select('CFP.*, CF.contract_unique_id, P.project_name, CD.company_name as org_name, CF.ngo_user_id');	
			$this->db->from('contracts_funds_payslip CFP');
			$this->db->join('contracts_funds CF', 'CF.id = CFP.contracts_funds_id', 'inner' );
			$this->db->join('users U', 'U.id = CF.contributor_user_id', 'inner' );
			$this->db->join('projects P', 'P.id = CF.project_id', 'inner' );
			$this->db->join('corporate_details CD', 'CD.user_id = CF.contributor_user_id', 'inner' );
			//$this->db->where(array('CF.ngo_user_id' => $userId,'CF.status !='=>4,'P.final_status'=>1,'P.deleted_flag'=> 0));
			//$this->db->where(array('CF.ngo_user_id'=>$userId,'U.status'=>1,'CF.status'=>1,'CF.project_id' => $projectId,'P.final_status'=>1,'P.deleted_flag'=> 0));
			$this->db->where(array('CF.ngo_user_id'=>$userId,'CF.status'=>1,'CF.project_id' => $projectId,'P.project_status'=>1,'P.deleted_flag'=> 0));
			
			$this->db->group_start();
			$this->db->where('U.status',1);
			$this->db->or_where('U.status',8);
			$this->db->group_end();
			
			// $this->db->group_start();
			// $this->db->where(array('CF.ngo_user_id' => $userId,'CF.status !='=>1,'P.final_status'=>1,'P.deleted_flag'=> 0));
			// $this->db->where('CF.status != ',4);
			// $this->db->or_where('CF.status',0);
			// $this->db->or_where('CF.status',5);
			// $this->db->or_where('CF.status',6);
			// $this->db->group_end();
		}
		
		$this->db->order_by("CFP.id", "DESC");
		// if($limit!='')
		// {
			// $this->db->limit($limit);
		// }
        $query = $this->db->get();
		//print_r($this->db->last_query());
        $resultArr = $query->result();
        return $resultArr;
    }
	
	public function getContractDetailById($id,$contract_unique_id='')
    {    
		$this->db->select('*');	
		if($contract_unique_id !=''){
       	 	$this->db->where(array('id'=>$id,'contract_unique_id'=>$contract_unique_id));
		}else{
			$this->db->where(array('id'=>$id)); 
		}
        $query = $this->db->get('contracts_funds');
        return $row = $query->row();
    } 
	
	function getProjectAssignedByProjectID($project_id)
	{		
		return $this->db->get_where('projects_assigned',array('project_id'=>$project_id))->row();
	}
	
	public function getPayslipById($id,$payslip_no='')
    {    
		$this->db->select('*');	
		if($payslip_no !=''){
       	 	$this->db->where(array('id'=>$id,'payslip_no'=>$payslip_no));
		}else{
			$this->db->where(array('id'=>$id)); 
		}
        $query = $this->db->get('contracts_funds_payslip');
        return $row = $query->row();
    } 
	
	public function payslipDownloadFile($id,$file_name=''){
		if($file_name!=''){
			$this->db->select($file_name);		
			$this->db->from('contracts_funds_payslip');
			$this->db->where(array('id'=>$id));
			$query = $this->db->get();
			$result = $query->row();
		}else{
			$result = $this->db->get_where('contracts_funds_payslip',array('id'=>$id))->row();	
		}
    	
		return $result ;
    }
	
	public function getPayslipDetailsByPayslipId($id)
    {    
		$this->db->select('CFPD.*, CFP.payslip_status');	
		$this->db->from('contracts_funds_payslip_details CFPD');
		$this->db->join('contracts_funds_payslip CFP', 'CFP.id = CFPD.contracts_funds_payslip_id', 'inner' );
		$this->db->where(array('CFP.id'=>$id)); 
        $query = $this->db->get();
        return $row = $query->row();
    } 
	
	function getSingleInstallmentDataByID($id)
	{		
		return $this->db->get_where('contracts_funds_installment',array('id'=>$id))->row();
	}
	
	function getSingleMilestoneDataByID($id)
	{		
		return $this->db->get_where('contracts_funds_milestones',array('id'=>$id))->row();
	}
	
	public function getInstallmentCountAndPayment($months,$monthArr,$currentMonth,$amount,$type)
	{
		$returnArr=array();
		$q_array = array();
		$i = 0;
		$count = 0;
		$payment = 0;
		switch($type)
		{
			case "1":
				$count = count($months);
				$payment = ($amount/$count);
				$returnArr['insCount'] = $count;
				$returnArr['insPayment']= round($payment,2);
				break;
			case "2":
				
				foreach($months as $value){
					if (in_array(date("m", strtotime($value)),$monthArr)){
						//echo $value;
						$quarter = (int)ceil(date("m", strtotime($value)) / 3);
					 
						 $q_array[$i] = $quarter;
						
					}
					 
				$i++;}
				
				$q_array = (array_count_values($q_array));
				
				//print_r($q_array);
				
				if(!in_array($currentMonth,$monthArr)){
					$count = array_sum($q_array)+1;
				}else{
					$count = array_sum($q_array);
				}
				
				//echo $installmentCount;
				$payment= ($amount/$count);
				
				$returnArr['insCount']= $count;
				$returnArr['insPayment']= round($payment,2);
				
				break;
			case "3":
				
				foreach($months as $value){
					if (in_array(date("m", strtotime($value)),$monthArr)){
						//echo $value;
						$quarter = (int)ceil(date("m", strtotime($value)) / 6);
					 
						 $q_array[$i] = $quarter;
						
					}
					 
				$i++;}
				
				$q_array = (array_count_values($q_array));
				
				if(!in_array($currentMonth,$monthArr)){
					$count = array_sum($q_array)+1;
				}else{
					$count = array_sum($q_array);
				}
					
				$payment= ($amount/$count);
				
				$returnArr['insCount']= $count;
				$returnArr['insPayment']= round($payment,2);
				
				break;
			case "4":
				
				foreach($months as $value){
					if (in_array(date("m", strtotime($value)),$monthArr)){
						//echo $value;
						$quarter = (int)ceil(date("m", strtotime($value)));
						//echo $quarter;	
						 $q_array[$i] = $quarter;
						
					}
					 
				$i++;}
				
				$q_array = (array_count_values($q_array));
				
				if(!in_array($currentMonth,$monthArr)){
					$count = array_sum($q_array)+1;
				}else{
					$count = array_sum($q_array);
				}
				
				$returnArr['insCount']= $count;
				$returnArr['insPayment']= round($payment,2);
				
				break;
			default:
				$returnArr['insCount']= $count;
				$returnArr['insPayment']= round($payment,2);
				break;
			
		}
		return $returnArr;
		
	}
}    