<?php

class CsrModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function addCsrTwoObligationFormData($data)
    {
        $this->db->insert('csr2_obligation_form', $data);
        return true;
    }
    public function addCriteriaEligibilty($data)
    {
        $this->db->insert('csr_criteria_applicability', $data);
        return true;
    }
    public function insert($tbl,$info)
    {
        $this->db->insert($tbl, $info);
        $id = $this->db->insert_id();
        return  $id;
    }
    public function delete($tbl,$key)
    {
        $this->db->where($key);
        $this->db->delete($tbl);
    }

    public function getCriteriaEligibilty($where)
    {
        $data = $this->db->get_where('csr_criteria_applicability', $where)->result();
        return $data;
    }

    public function addCsrNetProfitForProceedingYears($data)
    {
        $this->db->insert('csr_net_profit_calculator_for_preceeding_years', $data);
        return true;
    }
    public function saveCsrSetOffAmt($data)
    {
        $this->db->insert('csr_set_off_amt', $data);
        return true;
    }

    public function saveAmtSpentPertainingThreeYear($data)
    {
        $this->db->insert('csr_amt_spent_pertaining_3_years', $data);
        return true;
    }

    public function saveOngoingProjectProceedingYearDetail($data)
    {
        $this->db->insert('csr_ongoing_projects_preceeding_year_details', $data);
        return true;
    }

    public function addCommitteDetails($data)
    {
        $this->db->insert('csr_committee_details', $data);
        return true;
    }
    public function getCommitteDetails($where)
    {
        $data = $this->db->get_where('csr_committee_details', $where)->result();
        return $data;
    }

    public function getCsrComplainceByUserIdAndRole($profile_id, $role_id, $fy_year)
    {
        $result = $this->db->get_where('csr2_obligation_form', array('profile_id' => $profile_id, 'role_id' => $role_id, 'FY_year' => $fy_year))->row();
        return $result;
    }

    public function updateCsrTwoObligationFormData($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('csr2_obligation_form', $data);
        return true;
    }
    public function getCsrTwoObligationFormData($where)
    {
        $data = $this->db->get_where('csr2_obligation_form', $where)->row();
        return $data;
    }

    public function saveCsrAnnualPlan($data)
    {
        $this->db->insert('csr_annual_action_plan', $data);
        return true;
    }

    // krishna web 2
    public function checkcsrfinacialyear($data)
    {
        $data = $this->db->get_where('csr_criteria_applicability', $data)->row();
        return $data;
    }
    public function checkpreceeding_current_year($data)
    {
        $data = $this->db->get_where('csr_net_profit_calculator_for_preceeding_years', $data)->row();
        return $data;
    }
    public function get_csr_two_obligation_form($data)
    {
        $data = $this->db->get_where('csr2_obligation_form', $data)->row();
        return $data;
    }
    public function get_csr_set_off_amt($data)
    {
        $data = $this->db->get_where('csr_set_off_amt', $data)->row();
        return $data;
    }
    public function get_csr_amt_spent_pertaining_three_years($data)
    {
        $data = $this->db->get_where('csr_amt_spent_pertaining_3_years', $data)->row();
        return $data;
    }
    public function get_csr_ongoing_projects_preceeding($data)
    {
        $data = $this->db->get_where('csr_ongoing_projects_preceeding_year_details', $data)->result();
        return $data;
    }
    //krishna  web 2
    /*public function getCsrAnnualPlan($where, $current_financial_year)
    {
        // $this->db->where("FY_year =",'2022-2023');
        //$this->db->where('FY_year !=', $current_financial_year);
        $data = $this->db->get('csr_annual_action_plan', $where)->result();
        return $data;
    }*/
    public function getCsrAnnualPlan($key,$year){
        $this->db->select('FY_year,COUNT(DISTINCT(sectors)) AS no, GROUP_CONCAT(DISTINCT(sectors)) AS sector, SUM(budgeted_amt) AS budget');
        $this->db->group_by('FY_year'); 
        $this->db->order_by('FY_year'); 
        $this->db->where($key);
        $this->db->where('FY_year <', $year);
        $query = $this->db->get('csr_annual_action_plan');
        $return = $query->result();
        return $return;
    }
    public function getTotalBudgetedAmt($key)
{
    $this->db->select_sum('budgeted_amt');
    $this->db->where($key);
    $query = $this->db->get('csr_annual_action_plan');
    $result = $query->row();

    return $result ? $result->budgeted_amt : 0;
}
    public function getAvgNetProfit($key,$match){
        $this->db->select('AVG(total_net_profit) AS avg_net_profit');
        $this->db->where($key);
        $this->db->where_in($match);
        $query = $this->db->get('csr_net_profit_calculator_for_preceeding_years');
        $return = $query->row();
        return $return;
    }
    public function get_csr_committee_details($where)
    {
        $data = $this->db->get_where('csr_committee_details', $where)->result();
        return $data;
    }
    public function get_csr_annual_action_plan($where)
    {
        $data = $this->db->get_where('csr_annual_action_plan', $where)->result();
        return $data;
    }
    public function updatecsr_criteria_applicability_FY($fyear, $profile_id, $role_id, $data)
    {
        $this->db->where('FY_year', $fyear);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->update('csr_criteria_applicability', $data);
        return true;

    }

    public function updateCsrNetProfitForProceedingYears($fyear, $profile_id, $role_id, $data)
    {
        $this->db->where('FY_year', $fyear);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->update('csr_net_profit_calculator_for_preceeding_years', $data);
        return true;
    }
    public function checkcsrnetprofitfinacialyear($where)
    {
        $data = $this->db->get_where('csr_net_profit_calculator_for_preceeding_years', $where)->result();
        return $data;
    }
    public function updateCsrNetProfitForProceedingYearsFY($where, $data)
    {
        $data = $this->db->get_where('csr_net_profit_calculator_for_preceeding_years', $where)->result();
        return $data;
    }

    public function checksaveCSRAmountSetOff($where)
    {
        $data = $this->db->get_where('csr_set_off_amt', $where)->result();
        return $data;
    }
    public function checkcsrsetofffinacialyear($where)
    {
        $data = $this->db->get_where('csr_set_off_amt', $where)->result();
        return $data;
    }
    public function updateCsrSetOffAmt($fyear, $profile_id, $role_id, $data)
    {
        $this->db->where('FY_year', $fyear);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->update('csr_set_off_amt', $data);
        return true;
    }
    public function checkAmtSpentPertainingThreeYear($where)
    {
        $data = $this->db->get_where('csr_amt_spent_pertaining_3_years', $where)->result();
        return $data;
    }
    public function updateAmtSpentPertainingThreeYear($fyear, $profile_id, $role_id, $data)
    {
        $this->db->where('FY_year', $fyear);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->update('csr_amt_spent_pertaining_3_years', $data);
        return true;
    }
    public function CheckOngoingProjectProceedingYearDetail($where)
    {
        $data = $this->db->get_where('csr_ongoing_projects_preceeding_year_details', $where)->result();
        return $data;
    }
    public function updateOngoingProjectProceedingYearDetail($row_id, $profile_id, $role_id, $data)
    {
        $this->db->where('id', $row_id);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->update('csr_ongoing_projects_preceeding_year_details', $data);
        return true;
    }
    public function updateCsrAnnualPlan($row_id, $profile_id, $current_financial_year, $role_id, $data)
    {
        $this->db->where('id', $row_id);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->where('FY_year', $current_financial_year);
        $this->db->update('csr_annual_action_plan', $data);
        return true;
    }

    public function checkOngoinginsert_obligation_data($where)
    {
        $data = $this->db->get_where('csr2_obligation_form', $where)->result();
        return $data;
    }
    public function updateObligationFormData($fyear, $profile_id, $role_id, $data)
    {
        $this->db->where('FY_year', $fyear);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->update('csr2_obligation_form', $data);
        return true;
    }
    public function checkcsr_committee_details($profile_id, $role_id)
    {
        // $data = $this->db->get_where('csr_committee_details', $where)->result();
        // return $data; 
        return true;
    }

    public function updatecsr_committee_details($row_id, $profile_id, $role_id, $data)
    {
        $this->db->where('id', $row_id);
        $this->db->where('profile_id', $profile_id);
        $this->db->where('role_id', $role_id);
        $this->db->update('csr_committee_details', $data);
        return true;
    }

    public function getSdgs()
    {
        $query = $this->db->get('sdgs_master');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    //krishna  web 2

    public function saveCsrCommitteMeetings($data)
    {
        $this->db->insert('csr_committee_meetings', $data);
        return true;
    }
    public function getCsrCommitteMeetings($where)
    {
        $data = $this->db->get_where('csr_committee_meetings', $where)->result();
        return $data;
    }
    public function getDirectorReport($id,$year,$status,$type)
	{	
        $this->db->select('R.id AS id,D.brief_about_director_report,D.amt_unspent_for_FY,D.reason_failed_to_csr_spend_director_report,D.sdgs');
		$this->db->from('reports R');
		$this->db->join("csr2_directors_report D", 'D.report_id = R.id', 'inner');
		$this->db->where("D.FY_year", $year);
        $this->db->where("R.profile_id", $id);
        $this->db->where("R.report_status", $status);
        $this->db->where("R.report_type", $type);
		$query = $this->db->get();
        $return = $query->row();
        return $return;
	}
    public function getCSRReport($id,$year,$status,$type)
	{	
        $this->db->select('R.id AS id,A.FY_year');
		$this->db->from('reports R');
		$this->db->join("csr2_report C", 'C.report_id = R.id', 'inner');
        $this->db->join("csr_criteria_applicability A", 'A.id = C.csr_criteria_appicability_id', 'inner');
		$this->db->where("A.FY_year", $year);
        $this->db->where("R.profile_id", $id);
        $this->db->where("R.report_status", $status);
        $this->db->where("R.report_type", $type);
		$query = $this->db->get();
        $return = $query->row();
        return $return;
	}
    public function getCSRReportAll($id,$year,$status,$type)
	{	
        $this->db->select('R.id AS id,R.created_at,C.CSR_project_ongoing_details_previous_year_id,C.CSR_project_other_than_ongoing_details_previous_year_id,C.CSR_project_ongoing_details_current_year_id,C.CSR_project_other_than_ongoing_details_current_year_id,C.CSR_project_details_before_2014_15_year_id,A.FY_year');
		$this->db->from('reports R');
		$this->db->join("csr2_report C", 'C.report_id = R.id', 'inner');
        $this->db->join("csr_criteria_applicability A", 'A.id = C.csr_criteria_appicability_id', 'inner');
        if($year)
            $this->db->where("A.FY_year", $year);
        $this->db->where("R.profile_id", $id);
        $this->db->where("R.report_status", $status);
        $this->db->where("R.report_type", $type);
		$query = $this->db->get();
        $return = $query->result();
        return $return;
	}
    public function getDirectorReportAll($id,$year,$status,$type)
	{	
        $this->db->select('R.id AS id,R.created_at,D.FY_year,D.amt_unspent_for_FY');
		$this->db->from('reports R');
		$this->db->join("csr2_directors_report D", 'D.report_id = R.id', 'inner');
        if($year)
		    $this->db->where("D.FY_year", $year);
        $this->db->where("R.profile_id", $id);
        $this->db->where("R.report_status", $status);
        $this->db->where("R.report_type", $type);
		$query = $this->db->get();
        $return = $query->result();
        return $return;
	}
    public function ongoingAndOther($tbl,$key){
        $this->db->select('COUNT(id) AS total');
        $this->db->where($key);
        $query = $this->db->get($tbl);
        $return = $query->row();
        return $return;
    }
    public function ongoingAndOtherCsr($tbl,$key,$merged){
        $this->db->select('COUNT(id) AS total');
        $this->db->where($key);
        $this->db->where_in('id',$merged);
        $query = $this->db->get($tbl);
        $return = $query->row();
        return $return;
    }
}

?>