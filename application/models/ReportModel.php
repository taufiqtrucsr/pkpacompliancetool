<?php
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ] 
###+------------------------------------------------------------------------------------------------
###| Code By - Mangal Jaiswar (mangal.jaiswar@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - July 2021
###+------------------------------------------------------------------------------------------------

class ReportModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->assigned_project_program = ' project/program is assigned to you. Please review and make it live.';

	}

	public function getAllDraftReports($userId, $offset = '', $limit = '')
	{
		$this->db->select('DP.*, ND.org_name');
		$this->db->from('draft_projects DP');
		$this->db->join("ngo_details ND", 'ND.user_id = DP.user_id', 'inner');
		$this->db->join('draft_projects_funds DPF', 'DPF.project_id = DP.id', 'left');
		/*
			Sanjay Oraon
			Date 21-09-2023
			saved_as_draft removed from table
			$this->db->where(array('DP.user_id' => $userId, 'DP.saved_as_draft' => 1));
		*/
		$this->db->where(array('DP.user_id' => $userId));
		if ($limit != '') {
			$this->db->limit($limit);
		}
		$this->db->order_by("DP.id", "DESC");
		$query = $this->db->get();
		//print_r($this->db->last_query());
		$resultArr = $query->result();
		return $resultArr;
	}

	public function getProjectReportByProjectId($project_id)
	{
		$this->db->select('PR.*');
		$this->db->from('project_reports PR');
		$this->db->where(array('PR.project_id' => $project_id));
		$query = $this->db->get();
		// print_r($this->db->last_query());
		$result = $query->row();
		return $result;
	}

	public function getAllProjectReports($project_id, $report_type, $offset = '', $limit = '')
	{
		$this->db->select('PR.*');
		$this->db->from('project_reports PR');
		$this->db->where(array('PR.project_id' => $project_id, 'PR.report_type' => $report_type));
		if ($offset != '') {
			$this->db->where('PR.id > ', $offset);
		}
		if ($limit != '') {
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		// print_r($this->db->last_query());
		$result = $query->result();
		return $result;
	}

	public function getProgressReportDetails($report_id)
	{
		$this->db->select('PR.*,PR.id AS report_id, P.*');
		$this->db->from('project_reports PR');
		$this->db->join("projects P", 'P.id = PR.project_id', 'inner');
		$this->db->where(array('PR.id' => $report_id));
		$query = $this->db->get();
		// print_r($this->db->last_query());
		$result = $query->row();
		return $result;
	}

	//get new progress details
	public function getProgressReportDetailsn($project_id, $start_date, $end_date)
	{
		// $this->db->select('PR.*,PR.id AS report_id, P.*');	
		// $this->db->from('project_reports PR');
		// $this->db->join("projects P", 'P.id = PR.project_id', 'inner' );
		// $this->db->where(array('PR.project_id' => $report_id));
		// $query = $this->db->get();
		// $result = $query->row();
		// return $result;


		// $sql="SELECT * FROM `project_reports` AS pr , projects AS p WHERE pr.project_id = '$project_id' AND pr.project_id = p.id AND submit_date BETWEEN $start_date AND $end_date";
		// $sql="SELECT GROUP_CONCAT(pr.contributor_id) AS contributor_id,pr.due_date,pr.no_of_beneficiaries,pr.work_activity_status,pr.work_description,project_id,report_type_name,p.project_name,p.project_date_from,p.project_date_to,p.project_description,p.problem_statement,p.sectors,p.beneficiaries,p.city,p.district,p.total_project_cost FROM `project_reports` AS pr , projects AS p WHERE pr.project_id = '$project_id' 
		// AND pr.project_id = p.id AND submit_date BETWEEN $start_date AND $end_date";
		$sql = "SELECT pr.id, pr.contributor_id AS contributor_id,pr.due_date,pr.no_of_beneficiaries,pr.work_activity_status,pr.work_description,project_id,report_type_name,p.project_name,p.project_date_from,p.project_date_to,p.project_description,p.problem_statement,p.sectors,p.beneficiaries,p.city,p.district,p.total_project_cost FROM `project_reports` AS pr , projects AS p WHERE pr.project_id = '$project_id' 
		AND pr.project_id = p.id AND submit_date BETWEEN $start_date AND $end_date ORDER BY pr.id DESC LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->row();
		// echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}
	// get new progress details ends here

	public function getContributorsOfProject($project_id)
	{
		//original query is below one
		$this->db->select('pcf.*');
		$this->db->from('project_contributor_funds pcf');
		// $this->db->join("contracts_funds CF", 'CF.contributor_user_id = CD.user_id', 'inner' );
		$this->db->where(array('pcf.project_id' => $project_id));
		// $this->db->group_by('CF.contributor_user_id');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		$result = $query->result();
		return $result;


		// $this->db->select('DISTINCT(pcf.funded_by),pcf.id,pcf.project_id,pcf.contributor_id,pcf.source,pcf.start_date,pcf.end_date,pcf.committed_amount,  
		// pcf.received_amount,pcf.balance_amount,pcf.created_at,pcf.updated_at');	
		// $this->db->distinct();
		// $this->db->select('pcf.*');	
		// $this->db->from('project_contributor_funds pcf');
		// // $this->db->from('contracts_funds cf');
		// $this->db->join("contracts_funds CF", 'CF.contributor_user_id = pcf.contributor_id', 'inner' );
		// $this->db->where(array('pcf.project_id' => $project_id));
		// // $this->db->group_by('CF.contributor_user_id');
		// $query = $this->db->get();
		// // print_r($this->db->last_query());
		// $result = $query->result();
		// return $result ;

		// 		SELECT DISTINCT pcf.project_id,pcf.contributor_id,pcf.funded_by,pcf.source,pcf.start_date,pcf.end_date,pcf.committed_amount,
//   pcf.received_amount,pcf.balance_amount,pcf.created_at,pcf.updated_at FROM `project_contributor_funds` `pcf` INNER JOIN `contracts_funds` `CF` 
//   ON `CF`.`contributor_user_id` = `pcf`.`contributor_id` 
//   WHERE `pcf`.`project_id` = '244'


		// $this->db->select('*');	
		// $this->db->from('project_contributor_funds pcf');
		// $this->db->from('corporate_details CD');
		// $this->db->join("contracts_funds CF", 'CF.contributor_user_id = CD.user_id', 'inner' ); //commented code recommented
		// $this->db->where(array('pcf.project_id' => $project_id));
		// $this->db->or_where(array('CF.project_id' => $project_id));
		// $this->db->group_by('CF.contributor_user_id'); //commented code recommented
		// $query = $this->db->get();
		// print_r($this->db->last_query());
		// $result = $query->result();
		// return $result ;

	}

	public function getExternalContributor($project_id)
	{
		//original query is below one
		$sql = "SELECT DISTINCT pcf.id FROM `project_contributor_funds` AS pcf,`contracts_funds` AS cf 
		WHERE pcf.project_id='$project_id' AND pcf.contributor_id = cf.contributor_user_id";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		// echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	public function get_current_tot_beneficiaries($report_id, $project_id)
	{
		$sql = "SELECT SUM(no_of_beneficiaries) as total_beneficiaries_benefitted FROM project_reports WHERE project_id='$project_id' AND id<$report_id";
		$query = $this->db->query($sql);
		$result = $query->row();
		// echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	// public function getcontractContributorsOfProject($id,$project_id){
	// 	$this->db->select('cf.*');	
	// 	$this->db->from('contracts_funds cf');
	// 	// $this->db->join("contracts_funds CF", 'CF.contributor_user_id = CD.user_id', 'inner' );
	// 	// $this->db->where(array('cf.project_id' => $project_id,'cf.ngo_user_id'=>$id));
	// 	$this->db->where(array('cf.project_id' => $project_id,'cf.contributor_user_id'=>$id));
	// 	// $this->db->group_by('CF.contributor_user_id');
	// 	$query = $this->db->get();
	// 	// print_r($this->db->last_query());
	// 	$result = $query->result();
	// 	return $result ;
	// }

	public function projectContributorFundsByID($id, $project_id)
	{
		$this->db->select('pcf.*');
		$this->db->from('project_contributor_funds pcf');
		$this->db->where(array('pcf.id' => $id, 'pcf.project_id' => $project_id));
		$query = $this->db->get();
		// print_r($this->db->last_query());
		$result = $query->row();
		return $result;
	}

	public function projectContributorFundsNotByID($id, $project_id)
	{
		$sql = "select * from project_contributor_funds where id not in ($id) and project_id=$project_id";
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	public function projectContributorFundsDetails($id, $project_id)
	{
		if ($id == 0) {
			$sql = "select * from project_contributor_funds where project_id=$project_id";
		} else {
			//  $sql="select * from project_contributor_funds where id in ($id) and project_id=$project_id"; //original code
			//  $sql="SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
			// AND project_id=$project_id AND pcf.contributor_id = cd.user_id";
			$sql = "SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
			AND project_id=$project_id AND pcf.contributor_id = cd.user_id AND pcf.source ='truCSR'";
			//  print_r("<pre>");
			//  print_r($sql);
			//  exit;
			// code written for get contributor name
			// $sql ="SELECT * FROM (`project_contributor_funds` `pcf`, `corporate_details` `CD`) INNER JOIN `contracts_funds` `CF` 
			// ON `CF`.`contributor_user_id` = `CD`.`user_id` WHERE `CF`.`id` IN($id)
			// GROUP BY `CF`.`contributor_user_id`";

		}
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}


	//code get only contributor details  by project id 
	public function projectContributorFundsDetails_new($project_id, $contributor_id)
	{


		// $sql="SELECT * FROM project_contributor_funds AS pcf , corporate_details AS cd WHERE pcf.contributor_id = cd.user_id 
		// AND pcf.project_id='$project_id' AND pcf.source='truCSR'";
		$sql = "SELECT * FROM project_contributor_funds AS pcf , corporate_details AS cd WHERE pcf.contributor_id = cd.user_id  AND pcf.id  IN($contributor_id)
		AND pcf.project_id='$project_id' AND pcf.source='truCSR'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	//code ends here for contributor details




	// code start here

	public function projectContributorFundsDetailsss($id, $project_id)
	{
		// if ($id == 0) {
		// 	$sql="select * from project_contributor_funds where project_id=$project_id";
		// } else {
		// 	//  $sql="select * from project_contributor_funds where id in ($id) and project_id=$project_id"; //original code
		// 	 $sql="SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
		// 	AND project_id=$project_id AND pcf.contributor_id = cd.user_id";
		// 	//  print_r("<pre>");
		// 	//  print_r($sql);
		// 	//  exit;
		// 	// code written for get contributor name
		// 	// $sql ="SELECT * FROM (`project_contributor_funds` `pcf`, `corporate_details` `CD`) INNER JOIN `contracts_funds` `CF` 
		// 	// ON `CF`.`contributor_user_id` = `CD`.`user_id` WHERE `CF`.`id` IN($id)
		// 	// GROUP BY `CF`.`contributor_user_id`";

		// }
		if ($id == 0) {
			$sql = "SELECT * from project_contributor_funds where project_id=$project_id";

		} else {
			// $sql="SELECT * FROM project_contributor_funds WHERE project_id=$project_id AND id IN ($id)";
			$sql = "SELECT * FROM project_contributor_funds WHERE project_id=$project_id AND id IN ($id)";

		}

		// echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	public function projectContributorFundsDetailss($id, $project_id)
	{
		// if ($id == 0) {
		// 	$sql="select * from project_contributor_funds where project_id=$project_id";
		// } else {
		// 	//  $sql="select * from project_contributor_funds where id in ($id) and project_id=$project_id"; //original code
		// 	 $sql="SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
		// 	AND project_id=$project_id AND pcf.contributor_id = cd.user_id";
		// 	//  print_r("<pre>");
		// 	//  print_r($sql);
		// 	//  exit;
		// 	// code written for get contributor name
		// 	// $sql ="SELECT * FROM (`project_contributor_funds` `pcf`, `corporate_details` `CD`) INNER JOIN `contracts_funds` `CF` 
		// 	// ON `CF`.`contributor_user_id` = `CD`.`user_id` WHERE `CF`.`id` IN($id)
		// 	// GROUP BY `CF`.`contributor_user_id`";

		// }
		if ($id == 0) {
			// $sql="select * from project_contributor_funds where project_id=$project_id";
			// $sql ="SELECT DISTINCT pcf.* FROM project_contributor_funds AS pcf , `project_contributor_fund_details` AS pcfd 
			// 		WHERE pcf.project_id=$project_id AND pcf.id = pcfd.project_contributor_fund_id";

			$sql = "SELECT * FROM project_contributor_funds WHERE project_id='$project_id' AND id NOT IN (SELECT DISTINCT pcf.id FROM project_contributor_funds AS pcf , `contracts_funds` AS cf 
			WHERE pcf.project_id= '$project_id' AND pcf.contributor_id = cf.contributor_user_id)";
			// print_r("this is zero");
			// print_r($sql);
		} else {
			$sql = "SELECT * FROM project_contributor_funds WHERE project_id=$project_id AND id IN ($id)";
			// $sql="SELECT * FROM project_contributor_funds WHERE project_id=$project_id AND id NOT IN ($id)";

		}

		// echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}


	// code for get only other source start here
	public function projectContributorFundsDetailss_new($project_id, $start_date, $end_date)
	{

		// $sql ="SELECT * FROM project_contributor_funds AS pcf , corporate_details AS cd WHERE pcf.contributor_id = cd.user_id  AND pcf.id NOT IN($contributor_id)
		// AND pcf.project_id='$project_id' AND pcf.source='Outside'";
		// $sql ="SELECT * FROM project_contributor_funds AS pcf , project_reports AS pr 
		// WHERE pcf.source='outside' AND pcf.project_id='$project_id' AND pr.submit_date BETWEEN $start_date AND $end_date GROUP BY pcf.id";
		$sql = "SELECT * FROM project_contributor_funds AS pcf , project_reports AS pr 
		WHERE pcf.source='outside' AND pcf.project_id='$project_id' AND pcf.created_at BETWEEN $start_date AND $end_date GROUP BY pcf.id";
		// print_r('<pre>');
		// print_r($sql);
		// exit;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}
	// code for get only other source ends here

	//code start here get contributor id
	// public function projectContributorids($project_id){
	// 		$sql= "SELECT DISTINCT pcf.* FROM project_contributor_funds AS pcf , `contracts_funds` AS cf 
	// 		WHERE pcf.project_id= '$project_id' AND pcf.contributor_id = cf.contributor_user_id";
	// 		$query = $this->db->query($sql);
	// 		$result = $query->result_array();
	// 		// echo "<pre>";print_r($result);echo "</pre>";die;
	// 		return $result;
	// }

	// public function projectContributoridst($project_id){
	// 	$sql= "SELECT DISTINCT pcf.* FROM project_contributor_funds AS pcf , `contracts_funds` AS cf 
	// 	WHERE pcf.project_id= '$project_id' AND pcf.contributor_id = cf.contributor_user_id";
	// 	$query = $this->db->query($sql);
	// 	$result = $query->num_rows();
	// 	// echo "<pre>";print_r($result);echo "</pre>";die;
	// 	return $result;
	// }

	// code ends here

	// code start here
	public function projectCurrentContributor($id, $project_id, $userId)
	{
		if ($id == 0) {
			$sql = "select * from project_contributor_funds where project_id=$project_id";
		} else {
			$sql = "SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
			AND project_id=$project_id AND pcf.contributor_id = cd.user_id and cd.user_id='$userId'";
		}
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	// get project current contributorn

	public function projectCurrentContributorn($project_id, $userId)
	{
		// if ($id == 0) {
		// 	$sql="select * from project_contributor_funds where project_id=$project_id";
		// } else {
		// 	 $sql="SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
		// 	AND project_id=$project_id AND pcf.contributor_id = cd.user_id and cd.user_id='$userId'";
		// }
		// $sql="select * from project_contributor_funds where project_id=$project_id";
		$sql = "SELECT * FROM project_contributor_funds AS pcf , corporate_details AS cd WHERE pcf.contributor_id = cd.user_id AND pcf.project_id='$project_id' AND contributor_id='$userId'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	// get project current contributorn ends here


	public function projectCurrentCollaborator($id, $project_id, $userId)
	{
		if ($id == 0) {
			// $sql="select * from project_contributor_funds where project_id=$project_id";
			// $sql="SELECT DISTINCT funded_by,contributor_id from project_contributor_funds where project_id=$project_id";
			$sql = "SELECT DISTINCT funded_by,contributor_id from project_contributor_funds where project_id=$project_id";
		} else {
			//  $sql="SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
			// AND project_id=$project_id AND pcf.contributor_id = cd.user_id and cd.user_id!='$userId'";
			$sql = "SELECT DISTINCT funded_by,contributor_id,company_logo  FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
			AND project_id=$project_id AND pcf.contributor_id = cd.user_id and cd.user_id!='$userId'";
		}
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	// code start here


	// code for new collaboartorn start here
	public function projectCurrentCollaboratorn($project_id, $userId)
	{
		// if ($id == 0) {
		// 	// $sql="select * from project_contributor_funds where project_id=$project_id";
		// 	// $sql="SELECT DISTINCT funded_by,contributor_id from project_contributor_funds where project_id=$project_id";
		// 	$sql="SELECT DISTINCT funded_by,contributor_id from project_contributor_funds where project_id=$project_id";
		// } else {
		// 	//  $sql="SELECT * FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
		// 	// AND project_id=$project_id AND pcf.contributor_id = cd.user_id and cd.user_id!='$userId'";
		// 	$sql="SELECT DISTINCT funded_by,contributor_id,company_logo  FROM project_contributor_funds AS pcf,corporate_details AS cd WHERE pcf.id IN ($id) 
		// 	AND project_id=$project_id AND pcf.contributor_id = cd.user_id and cd.user_id!='$userId'";
		// }
		// $sql="SELECT DISTINCT funded_by,contributor_id from project_contributor_funds where project_id=$project_id";
		// $sql ="SELECT * FROM project_contributor_funds AS pcf, corporate_details AS cd WHERE pcf.project_id=$project_id GROUP BY contributor_id";
		$sql = "SELECT * FROM project_contributor_funds AS pcf , corporate_details AS cd WHERE pcf.contributor_id = cd.user_id 
		AND pcf.contributor_id NOT IN($userId)
		AND pcf.project_id ='$project_id' GROUP BY pcf.contributor_id";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	// code for new collaboratorn ends here

	//get project_details for cover image
	public function getprojectcoverimage($project_id)
	{
		// $sql="SELECT * FROM project_reports WHERE project_id='$project_id' GROUP BY project_id";
		$sql = "SELECT * FROM project_reports WHERE project_id='$project_id' ORDER BY id DESC";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	// code end here for cover image 

	public function getDraftReportImageData($report_id)
	{
		$this->db->select('PRI.*');
		$this->db->from('project_report_images PRI');
		$this->db->where(array('PRI.project_report_id' => $report_id));
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getDraftReportUtilizedData($report_id)
	{
		$this->db->select('RFU.*');
		$this->db->from('project_report_fund_utilized RFU');
		$this->db->where(array('RFU.project_report_id' => $report_id));
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProjectReportUtilizedData($project_id)
	{
		$sql = "select pcfd.id,pcfd.project_contributor_fund_id,pcfd.project_id,pcfd.amount,pcfu.amount_description,pcfu.document from project_contributor_fund_details as pcfd left join project_contributor_fund_utilized pcfu on pcfu.project_fund_detail_id=pcfd.id where pcfd.project_id=$project_id and pcfd.type='utilized'";
		// echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	//code for get new fudn utilized data
	public function getProjectReportUtilizedData_new($project_id, $start_date, $end_date)
	{
		// $sql="select pcfd.id,pcfd.project_contributor_fund_id,pcfd.project_id,pcfd.amount,pcfu.amount_description,pcfu.document from project_reports AS pr, project_contributor_fund_details as pcfd left join project_contributor_fund_utilized pcfu on pcfu.project_fund_detail_id=pcfd.id where pcfd.project_id=$project_id and pcfd.type='utilized' 
		// AND pr.submit_date BETWEEN $start_date AND $end_date GROUP BY id ASC";
		$sql = "select pcfd.id,pcfd.project_contributor_fund_id,pcfd.project_id,pcfd.amount,pcfu.amount_description,pcfu.document from project_reports AS pr, project_contributor_fund_details as pcfd left join project_contributor_fund_utilized pcfu on pcfu.project_fund_detail_id=pcfd.id where pcfd.project_id=$project_id and pcfd.type='utilized' 
		AND pcfu.created_at BETWEEN $start_date AND $end_date GROUP BY id ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}


	public function getProjectReportUtilizedSumAmount($project_id)
	{
		// $sql="select sum(pcfd.amount) as spentAmout, pcfd.project_contributor_fund_id from project_contributor_fund_details as pcfd where project_contributor_fund_id=$project_fund_detail_id and type='utilized' GROUP BY project_contributor_fund_id";
		// $sql = "select DISTINCT sum(pcfd.amount) as spentAmout, pcfd.project_contributor_fund_id from project_contributor_fund_details as pcfd where project_contributor_fund_id=$project_fund_detail_id and type='utilized' GROUP BY project_contributor_fund_id";
		$sql = "select sum(pcfd.amount) as spentAmout, pcfd.project_contributor_fund_id , pcf.funded_by, pcf.received_amount, pcfd.project_id\n"
			. "from project_contributor_fund_details as pcfd\n"
			. "left join project_contributor_fund_utilized as pcfu ON pcfu.project_fund_detail_id = pcfd.id\n"
			. "left join project_contributor_funds as pcf ON pcf.id = pcfd.project_contributor_fund_id\n"
			// . "left join project_contributor_funds as pcf ON pcf.project_id = pcfd.project_id\n"
			. "where pcfd.project_id=$project_id and pcfd.type='utilized' GROUP BY project_contributor_fund_id";
		// echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	public function getReportMilestoneData($projects_funds_milestone_id)
	{
		$sql = "select * from project_report_milestone where projects_funds_milestone_id=$projects_funds_milestone_id";
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";print_r($result);echo "</pre>";die;
		return $result;
	}

	public function getReportUtilizedData($report_id)
	{
		$this->db->select('RFU.*');
		$this->db->from('project_contributor_fund_utilized RFU');
		// $this->db->join('project_contributor_fund_details', 'project_contributor_fund_details.id = RFU.project_fund_detail_id');
		$this->db->where(array('RFU.project_fund_detail_id' => $report_id));
		$query = $this->db->get();
		// print_r($this->db->last_query());
		$result = $query->result();
		return $result;
	}

	public function getDraftReportCaseStudyData($report_id)
	{
		$this->db->select('RCS.*');
		$this->db->from('project_report_case_studies RCS');
		$this->db->where(array('RCS.project_report_id' => $report_id));
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getReportPeriod($date, $interval_subtract)
	{
		$date = date('d-m-Y', $date);
		$strt_date = date_create($date);
		date_sub($strt_date, date_interval_create_from_date_string($interval_subtract));
		$result = date_format($strt_date, "d-m-Y");

		return $result;
	}

	public function checkProjectReport($project_id)
	{
		$sql = "select id,project_type,reporting_frequency,project_date_from,project_date_to from projects where id=$project_id";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$row['start_date'] = date("d-m-Y", $row['project_date_from']);
		$row['reporting_frequency'] = trim($row['reporting_frequency'], ',');
		$row['reporting_frequency_arr'] = explode(",", $row['reporting_frequency']);
		$row['day'] = $day = date("j", $row['project_date_from']);
		$row['month'] = $month = date("n", $row['project_date_from']);
		$next_month = $month + 1;
		$current_next_month = date("n") + 1;

		/*
		echo " project start date=>";
		echo date("d-m-Y",$row['project_date_from']);
		echo "<hr>";
		echo " project end date=>";
		echo "<hr>";
		echo strtotime(date("d-m-Y")) <= $row['project_date_to'];
		echo "<hr>";
		echo "next_month=>".$next_month;
		echo "<hr>";
		echo "current_next_month=>".$current_next_month;
		echo "<hr>";
		*/

		if ($row['project_type'] == 1) {

			$difference = date("n") - $month;


			/*Monthly Report*/
			$index = $difference;
			if ($index == 0) {
				$row['mpr_start_date'] = date("d-m-Y", $row['project_date_from']);
				$row['mpr_due_date'] = date("d-m-Y", $row['project_date_from']);
				$row['mpr_end_date'] = date("t-m-Y", strtotime($row['mpr_start_date']));
				$row['mpr_report_type_name'] = 'MPR-1';
			} else {
				$row['mpr_start_date'] = date("1-m-Y", strtotime("-1 month", strtotime(date("1-m-Y"))));
				$row['mpr_due_date'] = date("1-m-Y");
				$row['mpr_end_date'] = date("t-m-Y", strtotime("-1 month", strtotime(date("1-m-Y"))));
				$row['mpr_report_type_name'] = 'MPR-' . $index;
			}



			$start_dt = strtotime(date("t-m-Y", $row['project_date_to']));
			$project_start_date = date("d-m-Y", $row['project_date_from']);
			$project_end_date = date("t-m-Y", $row['project_date_to']);
			$start = new DateTime($project_start_date);
			$end = new DateTime($project_end_date);

			/*Quaterly Report*/
			$interval = DateInterval::createFromDateString('90 days');
			$period = new DatePeriod($start, $interval, $end);
			$i = 1;
			$index = $difference / 3;
			foreach ($period as $dt) {
				$dt_frmt = strtotime($dt->format("Y-m-1"));
				if ($dt_frmt != $start_dt) {
					if ($index == $i) {
						if ($i == 1) {
							$row['qpr_start_date'] = date("d-m-Y", $row['project_date_from']);
							$row['qpr_due_date'] = date("d-m-Y", $row['project_date_from']);
							$row['qpr_end_date'] = date("t-m-Y", strtotime("+90 days", strtotime($row['qpr_start_date'])));
							$row['qpr_report_type_name'] = 'QPR-1';
						} else {
							$row['qpr_start_date'] = date("1-m-Y", strtotime("+1 day", strtotime(date("t-m-Y", $dt_frmt))));
							$row['qpr_due_date'] = date("d-m-Y", strtotime("+92 days", strtotime($row['qpr_start_date'])));
							$row['qpr_end_date'] = date("t-m-Y", strtotime("+90 days", strtotime($row['qpr_start_date'])));
							$row['qpr_report_type_name'] = 'QPR-' . $i;
						}
					}
					$i++;
				}
			}

			/*Half Yearly Report*/
			$interval = DateInterval::createFromDateString('180 days');
			$period = new DatePeriod($start, $interval, $end);
			$i = 1;
			$index = $difference / 6;
			foreach ($period as $dt) {
				$dt_frmt = strtotime($dt->format("Y-m-1"));
				if ($dt_frmt != $start_dt) {
					if ($index == $i) {
						if ($i == 1) {
							$row['hpr_start_date'] = date("d-m-Y", $row['project_date_from']);
							$row['hpr_due_date'] = date("d-m-Y", $row['project_date_from']);
							$row['hpr_end_date'] = date("t-m-Y", strtotime("+180 days", strtotime($row['hpr_start_date'])));
							$row['hpr_report_type_name'] = 'HPR-1';
						} else {
							$row['hpr_start_date'] = date("1-m-Y", strtotime("+1 day", strtotime(date("t-m-Y", $dt_frmt))));
							$row['hpr_due_date'] = date("d-m-Y", strtotime("+182 days", strtotime($row['hpr_start_date'])));
							$row['hpr_end_date'] = date("t-m-Y", strtotime("+180 days", strtotime($row['hpr_start_date'])));
							$row['hpr_report_type_name'] = 'HPR-' . $i;
						}
					}
					$i++;
				}
			}

			/*Yearly Report*/
			$interval = DateInterval::createFromDateString('1 year');
			$period = new DatePeriod($start, $interval, $end);
			$i = 1;
			$index = $difference / 6;
			foreach ($period as $dt) {
				$dt_frmt = strtotime($dt->format("Y-m-1"));
				if ($dt_frmt != $start_dt) {
					if ($index == $i) {
						if ($i == 1) {
							$row['apr_start_date'] = date("d-m-Y", $row['project_date_from']);
							$row['apr_due_date'] = date("d-m-Y", $row['project_date_from']);
							$row['apr_end_date'] = date("t-m-Y", strtotime("+180 days", strtotime($row['apr_start_date'])));
							$row['apr_report_type_name'] = 'APR-1';
						} else {
							$row['apr_start_date'] = date("1-m-Y", strtotime("+1 day", strtotime(date("t-m-Y", $dt_frmt))));
							$row['apr_due_date'] = date("d-m-Y", strtotime("1 year", strtotime($row['apr_start_date'])));
							$row['apr_end_date'] = date("t-m-Y", strtotime("1 year", strtotime($row['apr_start_date'])));
							$row['apr_report_type_name'] = 'APR-' . $i;
						}
					}
					$i++;
				}
			}
		} else {
			$difference = date("n") - $month;


			/*Monthly Report*/
			$index = $difference;
			if ($index == 0) {
				$row['mpr_start_date'] = date("d-m-Y", $row['project_date_from']);
				$row['mpr_due_date'] = date("d-m-Y", $row['project_date_from']);
				$row['mpr_end_date'] = date("t-m-Y", strtotime($row['mpr_start_date']));
				$row['mpr_report_type_name'] = 'MPR-1';
			} else {
				$row['mpr_start_date'] = date("1-m-Y", strtotime("-1 month", strtotime(date("1-m-Y"))));
				$row['mpr_due_date'] = date("1-m-Y");
				$row['mpr_end_date'] = date("t-m-Y", strtotime("-1 month", strtotime(date("1-m-Y"))));
				$row['mpr_report_type_name'] = 'MPR-' . $index;
			}


			$start_dt = strtotime(date("t-m-Y"));
			$project_start_date = date("d-m-Y", $row['project_date_from']);
			$project_end_date = date("t-m-Y");
			$start = new DateTime($project_start_date);
			$end = new DateTime($project_end_date);

			/*Quaterly Report*/
			$interval = DateInterval::createFromDateString('90 days');
			$period = new DatePeriod($start, $interval, $end);
			$i = 1;
			$index = $difference / 3;
			foreach ($period as $dt) {
				$dt_frmt = strtotime($dt->format("Y-m-1"));
				if ($dt_frmt != $start_dt) {
					if ($index == $i) {
						if ($i == 1) {
							$row['qpr_start_date'] = date("d-m-Y", $row['project_date_from']);
							$row['qpr_due_date'] = date("d-m-Y", $row['project_date_from']);
							$row['qpr_end_date'] = date("t-m-Y", strtotime("+90 days", strtotime($row['qpr_start_date'])));
							$row['qpr_report_type_name'] = 'QPR-1';
						} else {
							$row['qpr_start_date'] = date("1-m-Y", strtotime("+1 day", strtotime(date("t-m-Y", $dt_frmt))));
							$row['qpr_due_date'] = date("d-m-Y", strtotime("+92 days", strtotime($row['qpr_start_date'])));
							$row['qpr_end_date'] = date("t-m-Y", strtotime("+90 days", strtotime($row['qpr_start_date'])));
							$row['qpr_report_type_name'] = 'QPR-' . $i;
						}
					}
					$i++;
				}
			}

			/*Half Yearly Report*/
			$interval = DateInterval::createFromDateString('180 days');
			$period = new DatePeriod($start, $interval, $end);
			$i = 1;
			$index = $difference / 6;
			foreach ($period as $dt) {
				$dt_frmt = strtotime($dt->format("Y-m-1"));
				if ($dt_frmt != $start_dt) {
					if ($index == $i) {
						if ($i == 1) {
							$row['hpr_start_date'] = date("d-m-Y", $row['project_date_from']);
							$row['hpr_due_date'] = date("d-m-Y", $row['project_date_from']);
							$row['hpr_end_date'] = date("t-m-Y", strtotime("+180 days", strtotime($row['hpr_start_date'])));
							$row['hpr_report_type_name'] = 'HPR-1';
						} else {
							$row['hpr_start_date'] = date("1-m-Y", strtotime("+1 day", strtotime(date("t-m-Y", $dt_frmt))));
							$row['hpr_due_date'] = date("d-m-Y", strtotime("+182 days", strtotime($row['hpr_start_date'])));
							$row['hpr_end_date'] = date("t-m-Y", strtotime("+180 days", strtotime($row['hpr_start_date'])));
							$row['hpr_report_type_name'] = 'HPR-' . $i;
						}
					}
					$i++;
				}
			}

			/*Yearly Report*/
			$interval = DateInterval::createFromDateString('1 year');
			$period = new DatePeriod($start, $interval, $end);
			$i = 1;
			$index = $difference / 6;
			foreach ($period as $dt) {
				$dt_frmt = strtotime($dt->format("Y-m-1"));
				if ($dt_frmt != $start_dt) {
					if ($index == $i) {
						if ($i == 1) {
							$row['apr_start_date'] = date("d-m-Y", $row['project_date_from']);
							$row['apr_due_date'] = date("d-m-Y", $row['project_date_from']);
							$row['apr_end_date'] = date("t-m-Y", strtotime("+180 days", strtotime($row['apr_start_date'])));
							$row['apr_report_type_name'] = 'APR-1';
						} else {
							$row['apr_start_date'] = date("1-m-Y", strtotime("+1 day", strtotime(date("t-m-Y", $dt_frmt))));
							$row['apr_due_date'] = date("d-m-Y", strtotime("1 year", strtotime($row['apr_start_date'])));
							$row['apr_end_date'] = date("t-m-Y", strtotime("1 year", strtotime($row['apr_start_date'])));
							$row['apr_report_type_name'] = 'APR-' . $i;
						}
					}
					$i++;
				}
			}
		}

		//echo "<pre>";print_r($row);echo "</pre>";
		$reporting_frequency_arr = $row['reporting_frequency_arr'];
		if (isset($row['mpr_report_type_name'])) {
			$mpr_start_date = $row['mpr_start_date'];
			$mpr_end_date = $row['mpr_end_date'];
			$mpr_due_date = $row['mpr_due_date'];
			$mpr_report_type_name = $row['mpr_report_type_name'];
		}
		if (isset($row['qpr_report_type_name'])) {
			$qpr_start_date = $row['qpr_start_date'];
			$qpr_end_date = $row['qpr_end_date'];
			$qpr_due_date = $row['qpr_due_date'];
			$qpr_report_type_name = $row['qpr_report_type_name'];
		}
		if (isset($row['hpr_report_type_name'])) {
			$hpr_start_date = $row['hpr_start_date'];
			$hpr_end_date = $row['hpr_end_date'];
			$hpr_due_date = $row['hpr_due_date'];
			$hpr_report_type_name = $row['hpr_report_type_name'];
		}
		if (isset($row['apr_report_type_name'])) {
			$apr_start_date = $row['apr_start_date'];
			$apr_end_date = $row['apr_end_date'];
			$apr_due_date = $row['apr_due_date'];
			$apr_report_type_name = $row['apr_report_type_name'];
		}

		if (in_array(1, $reporting_frequency_arr)) {
			if (isset($row['mpr_report_type_name'])) {
				//echo "MPR";
				$sql = "select count(id) as reportCount from project_reports where project_id=$project_id AND report_type_name='" . $row['mpr_report_type_name'] . "'";
				//echo "<hr>".$sql."<hr>";
				$query = $this->db->query($sql);
				$row = $query->row_array();
				$reportCount = $row['reportCount'];
				if ($reportCount == 0) {
					$insertArr = array('project_id' => $project_id, 'report_type_name' => $mpr_report_type_name, 'due_date' => strtotime($mpr_due_date), 'start_date' => strtotime($mpr_start_date), 'end_date' => strtotime($mpr_end_date), 'report_type' => 'Due');
					//echo "<pre>";print_r($insertArr);echo "</pre>";
					$this->db->insert('project_reports', $insertArr);
				}
			}
		}

		if (in_array(2, $reporting_frequency_arr)) {
			if (isset($qpr_report_type_name)) {
				//echo "qPR";
				$sql = "select count(id) as reportCount from project_reports where project_id=$project_id AND report_type_name='" . $qpr_report_type_name . "'";
				//echo "<hr>".$sql."<hr>";
				$query = $this->db->query($sql);
				$row = $query->row_array();
				$reportCount = $row['reportCount'];
				if ($reportCount == 0) {
					$insertArr = array('project_id' => $project_id, 'report_type_name' => $qpr_report_type_name, 'due_date' => strtotime($qpr_due_date), 'start_date' => strtotime($qpr_start_date), 'end_date' => strtotime($qpr_end_date), 'report_type' => 'Due');
					//echo "<pre>";print_r($insertArr);echo "</pre>";
					$this->db->insert('project_reports', $insertArr);
				}
			}
		}

		if (in_array(3, $reporting_frequency_arr)) {
			if (isset($hpr_report_type_name)) {
				//echo "HPR";
				$sql = "select count(id) as reportCount from project_reports where project_id=$project_id AND report_type_name='" . $hpr_report_type_name . "'";
				//echo "<hr>".$sql."<hr>";
				$query = $this->db->query($sql);
				$row = $query->row_array();
				$reportCount = $row['reportCount'];
				if ($reportCount == 0) {
					$insertArr = array('project_id' => $project_id, 'report_type_name' => $hpr_report_type_name, 'due_date' => strtotime($hpr_due_date), 'start_date' => strtotime($hpr_start_date), 'end_date' => strtotime($hpr_end_date), 'report_type' => 'Due');
					//echo "<pre>";print_r($insertArr);echo "</pre>";
					$this->db->insert('project_reports', $insertArr);
				}
			}
		}

		if (in_array(4, $reporting_frequency_arr)) {
			if (isset($apr_report_type_name)) {
				//echo "APR";
				$sql = "select count(id) as reportCount from project_reports where project_id=$project_id AND report_type_name='" . $apr_report_type_name . "'";
				//echo "<hr>".$sql."<hr>";
				$query = $this->db->query($sql);
				$row = $query->row_array();
				$reportCount = $row['reportCount'];
				if ($reportCount == 0) {
					$insertArr = array('project_id' => $project_id, 'report_type_name' => $apr_report_type_name, 'due_date' => strtotime($apr_due_date), 'start_date' => strtotime($apr_start_date), 'end_date' => strtotime($apr_end_date), 'report_type' => 'Due');
					//echo "<pre>";print_r($insertArr);echo "</pre>";
					$this->db->insert('project_reports', $insertArr);
				}
			}
		}


		// code added for already upload an image details
		// $get_project_report_details = $this->db->get_where('project_reports',array('project_id'=>$project_id))->row();
		// $project_report_id = $get_project_report_details->id;
		// $get_project_report_images = $this->db->get_where('project_report_images',array('project_report_id'=>$project_report_id))->row();
		// if($get_project_report_images==""){
		// 	$insertdata = array(
		// 		'project_report_id' => $project_report_id,
		// 		'created_at'=>strtotime(date('d-m-y'))
		// 	);
		// 	$this->db->insert('project_report_case_studies', $insertdata);
		// }
		//die;
	}

	public function get_donationDetails($ngo_id, $start_date, $end_date, $project_id = 0)
	{
		$sql = "select dsd.*,drt.donation_id,drt.transfer_amount,drt.status as trasnfer_status,drt.project_link_account_id, drt.link_account_id, drt.transfer_id,(select project_name from projects where id=dsd.project_id) as project from donor_standalone_details dsd left join donation_route_transfers drt on dsd.id=drt.donation_id where dsd.ngo_id=$ngo_id and dsd.created_at between " . strtotime($start_date) . " and " . strtotime("+1 day", strtotime($end_date)) . " and dsd.status=1 ";
		if (isset($project_id) && $project_id != 0) {
			$sql .= " AND dsd.project_id=$project_id";
		}
		// echo $sql;
		// exit;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function get_offline_donationDetails($ngo_id, $start_date, $end_date, $project_id = 0)
	{
		$sql = "select dsd.*,drt.donation_id,drt.transfer_amount,drt.status as trasnfer_status,drt.project_link_account_id, drt.link_account_id, drt.transfer_id,(select project_name from projects where id=dsd.project_id) as project from donor_standalone_details dsd left join donation_route_transfers drt on dsd.id=drt.donation_id where dsd.ngo_id=$ngo_id and dsd.created_at between " . strtotime($start_date) . " and " . strtotime("+1 day", strtotime($end_date)) . " and dsd.status=1  and dsd.method='Cheque'";
		if (isset($project_id) && $project_id != 0) {
			$sql .= " AND dsd.project_id=$project_id";
		}
		// echo $sql;
		// exit;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function createProjectReport($insertdata)
	{
		$this->db->insert('reports', $insertdata);
		$data = $this->db->insert_id();
		return $data;
	}

	public function saveTestimonials($data)
	{
		$this->db->insert('report_testimonials', $data);
		return true;
	}

	public function createDirectorReport($insertdata)
	{
		$this->db->insert('csr2_directors_report', $insertdata);
		$data = $this->db->insert_id();
		return $data;
	}

	public function getCsrDirectorReports($profile_id, $contributor_id)
	{
		$sql = "SELECT *
		FROM reports
		RIGHT JOIN csr2_directors_report ON reports.id = csr2_directors_report.report_id
		WHERE reports.profile_id = '$profile_id' AND reports.contributor_ids = '$contributor_id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	public function createReportCaseStudies($insertdata)
	{
		$this->db->insert('project_report_case_studies', $insertdata);
		return true;
	}

	public function createDirectorReportProject($insertdata)
	{
		$this->db->insert('csr2_directors_report_project', $insertdata);
		return true;
	}

	public function getReportDataById($profile_id, $report_id)
	{
		$report_data = [];
		$report_data['report'] = $this->db->get_where('reports', array('profile_id' => $profile_id, 'id' => $report_id))->row();
		$report_data['csr2_directors_report_project'] = $this->db->get_where('csr2_directors_report_project', array('dir_report_id' => $report_id))->result();
		$report_data['project_report_case_studies'] = $this->db->get_where('project_report_case_studies', array('project_report_id' => $report_id))->row();
		$report_data['csr2_directors_report'] = $this->db->get_where('csr2_directors_report', array('report_id' => $report_id))->row();
		$report_data['report_testimonials'] = $this->db->get_where('report_testimonials', array('report_id' => $report_id))->result();
		return $report_data;
	}

}