<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class CsrCompliance extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CompanyModel');
        $this->load->model('UserModel');
        $this->load->model('CommonModel');
        $this->load->model('NgoModel');
        $this->load->model('CsrModel');
        $this->load->model('ReportModel');

        $this->isLogin();

        $user_id = $_SESSION['UserId'];
        $user_profile = $this->db->select('profile_id_display, current_active_role')->get_where('users', array('id' => $user_id))->row();

        $this->profile_id_display = $user_profile->profile_id_display;
        $this->current_active_role = $user_profile->current_active_role;

        $current_year = date('Y');
        $current_month = date('n');

        if ($current_month >= 4) {
            // if current month is April or later, then financial year has started in current year
            $start_year = $current_year;
            $end_year = $current_year + 1;
        } else {
            // if current month is earlier than April, then financial year started in previous year
            $start_year = $current_year - 1;
            $end_year = $current_year;
        }

        $this->current_year = $start_year . '-' . $end_year;
        $this->prime_year = ($start_year-1) . '-' . ($end_year-1);
        $this->current_financial_year = (isset($_GET['fy']) && !empty($_GET['fy']))? $_GET['fy']: ($start_year-1) . '-' . ($end_year-1);

        // Calculate the last three financial years
        /*for ($i = 0; $i < 2; $i++) {
            $startYear = $current_year - $i - 1;
            $endYear = $current_year - $i;
            $last_financialYears[] = $startYear . '-' . $endYear;
        }
        $this->last_financialYears = $last_financialYears;
        $this->lastThreeYears = array($current_year - 3, $current_year - 2, $current_year - 1);**/
        $mode_p = $this->input->post('mode');
        $mode = ((isset($mode_p) && $mode_p == 'calculation')?true:((isset($_SESSION['mode']) && $_SESSION['mode'] == 'calculation')?true: false));
        
        $this->event_btn = false;

        if($mode == false){
            $this->initCalculation(null,1);
        }
        if($mode == true){
            $this->event_btn = true;
        }
        if(isset($_SESSION['mode'])){
            unset($_SESSION['mode']);
        }

    }
    public function dashboard()
    {
        $data['current_year'] = $this->current_year;
        $data['event_btn'] = $this->event_btn;
        $data['prime_year'] = $this->prime_year;
        
        $data['current_financial_year'] = $current_financial_year = $this->current_financial_year;
        
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;

        $data_to_check_fy = array('FY_year' => $current_financial_year, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $checkfinancial_current_year = $this->CsrModel->checkcsrfinacialyear($data_to_check_fy);
        if (count($checkfinancial_current_year) > 0) {
            $data['checkfinancial_current_year'] = $checkfinancial_current_year;
        }

        /*$currentYear = date('Y');
        $financialYears = array();
        // Calculate the last three financial years
        for ($i = 0; $i < 2; $i++) {
            $startYear = $currentYear - $i - 1;
            $endYear = $currentYear - $i;
            $financialYears = $startYear . '-' . $endYear;
            $data_to_check_last_ty = array('FY_year' => $financialYears, 'profile_id' => $profile_id, 'role_id' => $role_id);
            $checkfinancial_last_two_year[$i] = $this->CsrModel->checkcsrfinacialyear($data_to_check_last_ty);
            //csr_net_profit_for_preceeding_years
            $checkfinancial_last_two_preceding_year[$i] = $this->CsrModel->checkpreceeding_current_year($data_to_check_last_ty);
            //csr_net_profit_for_preceeding_years
        }*/

        //$data['checkfinancial_last_two_year'] = $checkfinancial_last_two_year;
       // $data['checkfinancial_last_preceding_two_year'] = $checkfinancial_last_two_preceding_year;
        //csr_criteria_applicability

        //csr_net_profit_for_preceeding_years
        /*$checkfinancial_preceeding_current_year = $this->CsrModel->checkpreceeding_current_year($data_to_check_fy);
        if (count($checkfinancial_preceeding_current_year) > 0) {
            $data['checkfinancial_preceeding_current_year'] = $checkfinancial_preceeding_current_year;
        }*/
        //csr_net_profit_for_preceeding_years
        $csr_two_obligation_form = $this->CsrModel->get_csr_two_obligation_form($data_to_check_fy);
        $data['csr_two_obligation_form'] = $csr_two_obligation_form;


        //CSR CST OFF AMOUNT DATE FORMAT CHANGE
        $parts = explode('-', $current_financial_year);
        $date_full_current_year = "31/03/" . $parts[0];

        $lastThreeYears = array($parts[0] - 1, $parts[0], $parts[0]+1);

        $lastThreeYears_one = "31/03/" . $lastThreeYears[0];
        $lastThreeYears_two = "31/03/" . $lastThreeYears[1];
        $lastThreeYears_three = "31/03/" . $lastThreeYears[2];

        $fulldate_to_check_fy = array('FY_year' => $lastThreeYears_three, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $csr_set_off_amt_fy = $this->CsrModel->get_csr_set_off_amt($fulldate_to_check_fy);
        $data['csr_set_off_amt_fy'] = $csr_set_off_amt_fy;


        $fulldate_to_check_lastyear_one = array('FY_year' => $lastThreeYears_one, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $csr_set_off_amt_last_year_one = $this->CsrModel->get_csr_set_off_amt($fulldate_to_check_lastyear_one);
        $data['csr_set_off_amt_last_year_one'] = $csr_set_off_amt_last_year_one;

        $fulldate_to_check_lastyear_two = array('FY_year' => $lastThreeYears_two, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $csr_set_off_amt_last_year_two = $this->CsrModel->get_csr_set_off_amt($fulldate_to_check_lastyear_two);
        $data['csr_set_off_amt_last_year_two'] = $csr_set_off_amt_last_year_two;
        //CSR CST OFF AMOUNT DATE FORMAT CHANGE


        //csr_amt_spent_pertaining_three_years
        $fulldate_to_check_fy = array('FY_year' => $date_full_current_year, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $csr_amt_spent_pertaining_three_years_fy = $this->CsrModel->get_csr_amt_spent_pertaining_three_years($fulldate_to_check_fy);
        $data['csr_amt_spent_pertaining_three_years_FY'] = $csr_amt_spent_pertaining_three_years_fy;
        //   echo '<pre>',var_dump($data['csr_amt_spent_pertaining_three_years_FY']); echo '</pre>';
        $lastThreeYears_one = "31/03/" . ($lastThreeYears[0]-1);
        $fulldate_to_check_lastyear_one = array('FY_year' => $lastThreeYears_one, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $csr_amt_spent_pertaining_three_years_one = $this->CsrModel->get_csr_amt_spent_pertaining_three_years($fulldate_to_check_lastyear_one);
        $data['csr_amt_spent_pertaining_three_years_one'] = $csr_amt_spent_pertaining_three_years_one;
        //  echo '<pre>',var_dump($data['csr_amt_spent_pertaining_three_years_one']); echo '</pre>';
        $lastThreeYears_two = "31/03/" . ($lastThreeYears[1]-1);
        $fulldate_to_check_lastyear_two = array('FY_year' => $lastThreeYears_two, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $csr_amt_spent_pertaining_three_years_two = $this->CsrModel->get_csr_amt_spent_pertaining_three_years($fulldate_to_check_lastyear_two);
        $data['csr_amt_spent_pertaining_three_years_two'] = $csr_amt_spent_pertaining_three_years_two;
        //csr_amt_spent_pertaining_three_years
        //  echo '<pre>',var_dump($data['csr_amt_spent_pertaining_three_years_two']); echo '</pre>';

        //die();
        //csr_ongoing_projects_preceeding_years_details
        $where_query = array('profile_id' => $profile_id, 'role_id' => $role_id);
        $csr_ongoing_projects_preceeding_years = $this->CsrModel->get_csr_ongoing_projects_preceeding($where_query);
        $data['csr_ongoing_projects_preceeding_years_details'] = $csr_ongoing_projects_preceeding_years;


        $csr_CommiteeDetails = $this->CsrModel->get_csr_committee_details($where_query);
        $data['csr_CommiteeDetails'] = $csr_CommiteeDetails;
        //csr_ongoing_projects_preceeding_years_details


        //csr_annual_action_plan
        $csr_annual_action_plan = $this->CsrModel->get_csr_annual_action_plan($where_query);
        $data['csr_annual_action_plan'] = $csr_annual_action_plan;

        $currentyear_where = array('FY_year' => $current_financial_year, 'profile_id' => $profile_id, 'role_id' => $role_id);

        $data['csr_annual_action_plan_current_year'] = $this->CsrModel->get_csr_annual_action_plan($currentyear_where);
        
       

        /*
            Sanjay Oraon
            Date: 10-10-2023
            Computation Records
        */

        $key = array('profile_id' => $profile_id, 'role_id' => $role_id);
        //Count Number Of Records
		$data['total_financial'] = $count = $this->CommonModel->TblRecordsCount('csr_net_profit_calculator_for_preceeding_years',$key);

        //Generate Pagination Segments
		$lib = $this->paginationCompress ("CsrCompliance/dashboard/computation/", $count, 10);

        //Return Records Form Db
        $order = array('FY_year','DESC');
        $key1 = $key + array('type' => null);
		$data['computationRecords'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',null,$order,$key1,$lib["page"],$lib["segment"]);
       
        $order = array('id','DESC');
        $key1 = $key + array('FY_year' => $current_financial_year);
        $data['calculation'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key1,null,null);
        
        $data['csrcompliancedata'] = $this->CommonModel->TblRecords('csr2_obligation_form',1,null,$key1,null,null); 
        
        $year = explode('-',$current_financial_year);
        $key2 = $key + array('FY_year' => ($year[0]-1).'-'.($year[1]-1));
        $data['calculationOnePreviousYear'] =  $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key2,null,null);
        
        
        $year = explode('-',$current_financial_year);
        $key2 = $key + array('FY_year' => ($year[0]-2).'-'.($year[1]-2));
        $data['calculationTwoPreviousYear'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key2,null,null);
        
        $order = array('FY_year','DESC');
        $data['logs'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',null,$order,$key,null,null);

        //Total Ongoing Projects
        $key3 =  $key + array('project_status' => 'Ongoing');
        $data['ongoing_projects'] = $this->CommonModel->TblRecordsCount('csr_ongoing_projects_preceeding_year_details',$key3);

        $key4 = array('deleted_flag' => 0);
        $data['sectors']  = $this->CommonModel->TblAllRecords('sector_master','sector_type',$key4);
       
        $key5 =  $key + array('FY_year' => $this->prime_year);
        $data['count_current_financial'] = $count = $this->CommonModel->TblRecordsCount('csr_net_profit_calculator_for_preceeding_years',$key5);
        
        $data['annualPlanData'] = $this->CsrModel->getCsrAnnualPlan($key,$this->current_financial_year);
        $data['district'] = $this->CommonModel->getCityOfState();


        if((isset($_GET['fy'])) && !empty($_GET['fy']))
            $year = $_GET['fy'];
        else
            $year = null;
        $data['directorReport'] = $this->CsrModel->getDirectorReportAll($this->profile_id_display,$year,3,3);
        $data['csrReport'] = $this->CsrModel->getCSRReportAll($this->profile_id_display,$year,3,4);

        $report = $this->CsrModel->getDirectorReport($this->profile_id_display,$current_financial_year,3,3);

        if($report)
            $data['director_report'] = true;

        foreach($data['directorReport'] as $row){
            $key1 = array('dir_report_id' => $row->id, 'project_type' => 'Ongoing');
            $row->ongoing = $this->CsrModel->ongoingAndOther('csr2_directors_report_project',$key1)->total;

            $key1 = array('dir_report_id' => $row->id, 'project_type' => 'Other than Ongoing');
            $row->other_than_ongoing = $this->CsrModel->ongoingAndOther('csr2_directors_report_project',$key1)->total;
        }

        foreach($data['csrReport'] as $row){

           
            $return1 = explode(',',$row->CSR_project_ongoing_details_previous_year_id);
    
            $return2 = explode(',',$row->CSR_project_other_than_ongoing_details_previous_year_id);
          
            $return3 = explode(',',$row->CSR_project_ongoing_details_current_year_id);
            
            $return4 = explode(',',$row->CSR_project_other_than_ongoing_details_current_year_id);
           
            $return5 = explode(',',$row->CSR_project_details_before_2014_15_year_id);
           
            $merged = array_merge($return1,$return2,$return3,$return4,$return5);

            $key1 = $key + array('project_csr_implementation_type' => 1);
            $row->ongoing = $this->CsrModel->ongoingAndOtherCsr('csr_project_details',$key1,$merged)->total;

            $key1 = $key + array('project_csr_implementation_type' => 2);
            $row->other_than_ongoing = $this->CsrModel->ongoingAndOtherCsr('csr_project_details',$key1,$merged)->total;
       
        }
        
        $this->load->view('csrcompliance/csrcompliance', $data);

    }
    public function reportYear(){
        $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role);
        $application = $this->CommonModel->TblAllRecords('csr_criteria_applicability','FY_year',$key);
        foreach($application as $row){
            $return = $this->CsrModel->getDirectorReport($this->profile_id_display,$row->FY_year,3,3);
            if(empty($return)){
                return $row->FY_year;
            }
        }
        return null;
    }
    public function reportcreate()
    {
        $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role);
       
        $reportYear = $this->reportYear();

        if(isset($reportYear) && !empty($reportYear)){
            $year = explode('-',$reportYear);
            $data['prime_year'] = $reportYear;
        }else{
            $year = explode('-',$this->prime_year);
            $data['prime_year'] = $this->prime_year;
        }
       
        $key1 = $key + array('FY_year' => $data['prime_year']);
        $data['obligation'] = $this->CommonModel->TblRecords('csr2_obligation_form',1,null,$key1,null,null);
        
        $report = $this->CsrModel->getDirectorReport($this->profile_id_display,$data['prime_year'],3,3);
        
        if($data['obligation'] && !$report){
            $data['committee'] = $this->CommonModel->TblAllRecords('csr_committee_details','name_of_director',$key);

            $match = array($data['prime_year'],($year[0]-1).'-'.($year[1]-1),($year[0]-2).'-'.($year[1]-2));
            $data['avg_net_profit'] = $this->CsrModel->getAvgNetProfit($key,$match);

            $key2 = $key + array('FY_year' => $data['prime_year']);
            $data['annual_plan']  = $this->CommonModel->TblAllRecords('csr_annual_action_plan','*',$key2);

            $key3 = array('deleted_flag' => 0);
            $data['sectors']  = $this->CommonModel->TblAllRecords('sector_master','sdgs_id,sector_type',$key3);

            $data['sdgs']  = $this->CommonModel->TblRecords('sdgs_master',null,null,null,null,null);
            $data['district'] = $this->CommonModel->getCityOfState();

            $data['report'] = $this->CsrModel->getDirectorReport($this->profile_id_display,$data['prime_year'],2,3);
            
            if($data['report']){

                $kay7 = array('dir_report_id' => $data['report']->id);
                $data['director_project'] = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,$kay7,null,null);
    
                foreach($data['director_project'] as $row){
                    $return = $this->CommonModel->TblSelectedRecords('sector_master','sdgs_id',array('sector_type' => $row->sector));
                    if($return)
                        $row->sdgs_id = $return->sdgs_id;
                    else
                        $row->sdgs_id = null;
                }

                $kay8 = array('project_report_id' => $data['report']->id);
                $data['case_study'] = $this->CommonModel->TblRecords('project_report_case_studies',1,null,$kay8,null,null);
                if(isset($data['case_study']->case_study_image)){
                    $id = explode(',',$data['case_study']->case_study_image);
                }else{
                    $id = 0; 
                }
                $data['case_study_image'] = $this->CommonModel->fatchMedia($id);
                
                $kay10 = array('report_id' => $data['report']->id);
                $data['testimonials'] = $this->CommonModel->TblRecords('report_testimonials',null,null,$kay10,null,null);
            }else{
                foreach($data['annual_plan'] as $row){
                    $return = $this->CommonModel->TblSelectedRecords('sector_master','sdgs_id',array('sector_type' => $row->sectors));
                    if($return)
                        $row->sdgs_id = $return->sdgs_id;
                    else
                        $row->sdgs_id = null;
                }
            }

            $this->load->view('csrcompliance/reportcreate', $data);
        }else{
            redirect('/CsrCompliance/dashboard');
        }
    }
    public function reportCsrYear(){
        $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role);
        $application = $this->CommonModel->TblAllRecords('csr_criteria_applicability','FY_year',$key);
        foreach($application as $row){
            $return = $this->CsrModel->getCSRReport($this->profile_id_display,$row->FY_year,3,4);
            if(empty($return)){
                return $row->FY_year;
            }
        }
        return null;
    }
    public function closingreport()
    {
        $reportYear = $this->reportCsrYear();
        
        if(isset($reportYear) && !empty($reportYear)){
            $year = explode('-',$reportYear);
            $data['prime_year'] = $reportYear;
        }else{
            $year = explode('-',$this->prime_year);
            $data['prime_year'] = $this->prime_year;
        }
            
        $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role);
       
        $data['entity'] = $this->CommonModel->TblRecords('user_profile',1,null,array('id' => $this->profile_id_display),null,null);
        

        $data['entity']->companyHasCompletedYears = date_diff(date_create(date('Y-m-d')),date_create(date('Y-m-d',$data['entity']->date_of_incorp_birth)))->y;

        $data['entity']->cin = $this->CommonModel->TblSelectedRecordsBy('documents','document_number',array('profile_id' => $this->profile_id_display,'document_name' => 'CIN'),'DESC');
        //$data['entity']->csr_registration = $this->CommonModel->TblSelectedRecordsBy('documents','document_number',array('profile_id' => $this->profile_id_display,'document_name' => 'CSR_REGISTRATION'),'DESC');
 
        $key1 = $key + array('FY_year' => $data['prime_year']);
        $data['obligation'] = $this->CommonModel->TblRecords('csr2_obligation_form',1,null,$key1,null,null);

        $key1 = $key + array('FY_year' => $data['prime_year']);
        $data['criteria'] = $this->CommonModel->TblRecords('csr_criteria_applicability',1,null,$key1,null,null);
        
        $data['report'] = $this->CsrModel->getDirectorReport($this->profile_id_display,$data['prime_year'],3,3);
    
        $report = $this->CsrModel->getCSRReport($this->profile_id_display,$data['prime_year'],3,4);

        if($data['criteria'] && $data['obligation'] && $data['report'] && empty($report)){

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-2)));
            $data['set_one_year'] = $this->CommonModel->TblSelectedRecords('csr_set_off_amt','FY_year,set_off_amt_available,amt_set_off_in_FY,balance_set_off',$key1);
    
            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-1)));
            $data['set_two_year'] = $this->CommonModel->TblSelectedRecords('csr_set_off_amt','FY_year,set_off_amt_available,amt_set_off_in_FY,balance_set_off',$key1);

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0])));
            $data['set_three_year'] = $this->CommonModel->TblSelectedRecords('csr_set_off_amt','FY_year,set_off_amt_available,amt_set_off_in_FY,balance_set_off',$key1);

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-2)));
            $data['preceding_one_year'] = $this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','*',$key1);
    
            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-1)));
            $data['preceding_two_year'] = $this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','*',$key1);

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0])));
            $data['preceding_three_year'] = $this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','*',$key1);

            $order = array('id','DESC');
            $key1 = $key + array('FY_year' => $data['prime_year']);
            $data['calculation'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key1,null,null);
            
            $year = explode('-',$data['prime_year']);
            $key2 = $key + array('FY_year' => ($year[0]-1).'-'.($year[1]-1));
            $data['calculationOnePreviousYear'] =  $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key2,null,null);
            
            
            $year = explode('-',$data['prime_year']);
            $key2 = $key + array('FY_year' => ($year[0]-2).'-'.($year[1]-2));
            $data['calculationTwoPreviousYear'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key2,null,null);

            $data['committee'] = $this->CommonModel->TblAllRecords('csr_committee_details','id,name_of_director,DIN,category',$key);
            foreach($data['committee'] as $row){
                $temp = $key + array('FY_year' => $data['prime_year'],'committee_member_id' => $row->id);
                $return = $this->CommonModel->TblSelectedRecords('csr_committee_meetings','meetings_attended_in_year',$temp);
                if($return) 
                    $row->meeting = $return->meetings_attended_in_year;
            }
            $data['ongoing_projects_preceeding_year'] = $this->CommonModel->TblRecords('csr_ongoing_projects_preceeding_year_details',null,null,$key,null,null);

            $data['director_report_project_ongoing'] = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,array('dir_report_id' => $data['report']->id,'project_type' => 'Ongoing'),null,null);
            $data['director_report_project_other'] = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,array('dir_report_id' => $data['report']->id,'project_type' => 'Other than Ongoing'),null,null);
            $data['assesment'] = $this->CommonModel->totalAssesment(array('dir_report_id' => $data['report']->id,'project_type' => 'Impact Assessment'));
            $data['overhead'] = $this->CommonModel->totalOverhead(array('dir_report_id' => $data['report']->id));
            
            
            $key3 = array('deleted_flag' => 0);
            $data['sectors']  = $this->CommonModel->TblAllRecords('sector_master','sdgs_id,sector_type',$key3);
            $data['district'] = $this->CommonModel->getCityOfState();



            //load data
            $report = $this->CsrModel->getCSRReport($this->profile_id_display,$data['prime_year'],2,4);
            if($report){
                $data['csr2'] = $this->CommonModel->TblRecords('csr2_report',1,null,array('report_id' => $report->id),null,null);
            }
            
            if(isset($data['csr2'])){

                $keys = explode(',',$data['csr2']->CSR_project_ongoing_details_previous_year_id);
                $data['previous_ongoing'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_other_than_ongoing_details_previous_year_id);
                $data['previous_other'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_ongoing_details_current_year_id);
                $data['new_ongoing'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_other_than_ongoing_details_current_year_id);
                $data['new_other'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_details_before_2014_15_year_id);
                $data['csr_project'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->csr2_capital_assest_contributor_id);
                $data['csr_asset'] = $this->CommonModel->fatch('csr_capital_asset_contributor',$keys,$key);

            }
            
    // Fetching email from the users table
    $data['user'] = $this->CommonModel->TblRecords('users', 1, null, array('id' => $this->profile_id_display), null, null);

    if (!$data['user'] || empty($data['user']->email)) {
        $data['user']->email = 'Email not available';
    }

            $this->load->model('CsrModel');
    $budgeted_amt = $this->CsrModel->getTotalBudgetedAmt($key);
    $data['budgeted_amt'] = $budgeted_amt ? $budgeted_amt : 0;

            $this->load->view('csrcompliance/closingreport', $data);
        }else{
          //  redirect('/CsrCompliance/dashboard');

            $this->load->view('csrcompliance/closingreport', $data);

        }
    }
    public function previewCSRReport()
    {
        if (isset($_GET['year'])) {
            $data['prime_year'] = $_GET['year'];
            $year = explode('-',$_GET['year']);
            
        $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role);
       
        $data['entity'] = $this->CommonModel->TblRecords('user_profile',1,null,array('id' => $this->profile_id_display),null,null);
        

        $data['entity']->companyHasCompletedYears = date_diff(date_create(date('Y-m-d')),date_create($data['entity']->date_of_incorp_birth))->y;

        $data['entity']->cin = $this->CommonModel->TblSelectedRecordsBy('documents','document_number',array('profile_id' => $this->profile_id_display,'document_name' => 'CIN'),'DESC');
        $data['entity']->csr_registration = $this->CommonModel->TblSelectedRecordsBy('documents','document_number',array('profile_id' => $this->profile_id_display,'document_name' => 'CSR_REGISTRATION'),'DESC');

        $key1 = $key + array('FY_year' => $data['prime_year']);
        $data['obligation'] = $this->CommonModel->TblRecords('csr2_obligation_form',1,null,$key1,null,null);

        $key1 = $key + array('FY_year' => $data['prime_year']);
        $data['criteria'] = $this->CommonModel->TblRecords('csr_criteria_applicability',1,null,$key1,null,null);
        
        $data['report'] = $this->CsrModel->getDirectorReport($this->profile_id_display,$data['prime_year'],3,3);

        if($data['criteria'] && $data['obligation'] && $data['report']){

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-2)));
            $data['set_one_year'] = $this->CommonModel->TblSelectedRecords('csr_set_off_amt','FY_year,set_off_amt_available,amt_set_off_in_FY,balance_set_off',$key1);
    
            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-1)));
            $data['set_two_year'] = $this->CommonModel->TblSelectedRecords('csr_set_off_amt','FY_year,set_off_amt_available,amt_set_off_in_FY,balance_set_off',$key1);

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0])));
            $data['set_three_year'] = $this->CommonModel->TblSelectedRecords('csr_set_off_amt','FY_year,set_off_amt_available,amt_set_off_in_FY,balance_set_off',$key1);

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-2)));
            $data['preceding_one_year'] = $this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','*',$key1);
    
            $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-1)));
            $data['preceding_two_year'] = $this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','*',$key1);

            $key1 = $key + array('FY_year' => ('31/03/'.($year[0])));
            $data['preceding_three_year'] = $this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','*',$key1);

            $order = array('id','DESC');
            $key1 = $key + array('FY_year' => $data['prime_year']);
            $data['calculation'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key1,null,null);
            
            $year = explode('-',$data['prime_year']);
            $key2 = $key + array('FY_year' => ($year[0]-1).'-'.($year[1]-1));
            $data['calculationOnePreviousYear'] =  $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key2,null,null);
            
            
            $year = explode('-',$data['prime_year']);
            $key2 = $key + array('FY_year' => ($year[0]-2).'-'.($year[1]-2));
            $data['calculationTwoPreviousYear'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,$order,$key2,null,null);

            $data['committee'] = $this->CommonModel->TblAllRecords('csr_committee_details','id,name_of_director,DIN,category',$key);
            foreach($data['committee'] as $row){
                $temp = $key + array('FY_year' => $data['prime_year'],'committee_member_id' => $row->id);
                $return = $this->CommonModel->TblSelectedRecords('csr_committee_meetings','meetings_attended_in_year',$temp);
                if($return) 
                    $row->meeting = $return->meetings_attended_in_year;
            }
            $data['ongoing_projects_preceeding_year'] = $this->CommonModel->TblRecords('csr_ongoing_projects_preceeding_year_details',null,null,$key,null,null);

            $data['director_report_project_ongoing'] = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,array('dir_report_id' => $data['report']->id,'project_type' => 'Ongoing'),null,null);
            $data['director_report_project_other'] = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,array('dir_report_id' => $data['report']->id,'project_type' => 'Other than Ongoing'),null,null);
           

            $key3 = array('deleted_flag' => 0);
            $data['sectors']  = $this->CommonModel->TblAllRecords('sector_master','sdgs_id,sector_type',$key3);
            $data['district'] = $this->CommonModel->getCityOfState();



            //load data
            $report = $this->CsrModel->getCSRReport($this->profile_id_display,$data['prime_year'],3,4);
            if($report){
                $data['csr2'] = $this->CommonModel->TblRecords('csr2_report',1,null,array('report_id' => $report->id),null,null);
            }
            
            if(isset($data['csr2'])){

                $keys = explode(',',$data['csr2']->CSR_project_ongoing_details_previous_year_id);
                $data['previous_ongoing'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_other_than_ongoing_details_previous_year_id);
                $data['previous_other'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_ongoing_details_current_year_id);
                $data['new_ongoing'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_other_than_ongoing_details_current_year_id);
                $data['new_other'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->CSR_project_details_before_2014_15_year_id);
                $data['csr_project'] = $this->CommonModel->fatch('csr_project_details',$keys,$key);

                $keys = explode(',',$data['csr2']->csr2_capital_assest_contributor_id);
                $data['csr_asset'] = $this->CommonModel->fatch('csr_capital_asset_contributor',$keys,$key);

            }

            if(isset($_GET['action'])=='pdf'){
                $this->load->library('pdf');
                $html = $this->load->view('csrcompliance/pdf/report-csr.php',$data,true);
                $this->pdf->generate($html, 'Computation-', false);
            }else{
                $this->load->view('csrcompliance/preview', $data);
            }
        }else{
            redirect('/CsrCompliance/dashboard');
        }
    }else{
            redirect('/CsrCompliance/dashboard');
        }
    }
    public function deleteProject($temp,$key){
        foreach($temp as $row){
            $key1 = $key+array('id' => $row);
            $this->CsrModel->delete('csr_project_details', $key1);
        }
    }
    public function storeClosingReport()
    {
        $this->isLogin();
        $this->isPost();

        $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role);

        $reportYear = $this->reportCsrYear();

        if(isset($reportYear) && !empty($reportYear)){
            $year = explode('-',$reportYear);
            $prime_year = $reportYear;
        }else{
            $year = explode('-',$this->prime_year);
            $prime_year = $this->prime_year;
        }
        
        $info = [
            'profile_id' => $this->profile_id_display,
            'report_type' => 4,
            'report_status' => (int) $_POST['report_status'],
            'submit_date' => strtotime(date('Y-m-d H:i:s')),
            'contributor_ids' => $this->current_active_role,
            'updated_at' => strtotime(date('Y-m-d H:i:s')),
            'created_at' => strtotime(date('Y-m-d H:i:s')),
        ];
        $report = $this->CsrModel->getCSRReport($this->profile_id_display,$prime_year,2,4);
        if($report){
            $report_id = $report->id;
            $this->CommonModel->update('reports', array('id' => $report->id),$info);
        }else{
            $report_id = $this->ReportModel->createProjectReport($info);
        }

        $csr2 = $this->CommonModel->TblRecords('csr2_report',1,null,array('report_id' => $report_id),null,null);

        $financial_completed = $this->input->post('financial_completed');
        
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $srn = $this->input->post('srn');
        $srn_date = $this->input->post('srn_date');

        $meeting = $this->input->post('meeting');
        $member_id = $this->input->post('member_id');
        $attend = $this->input->post('attend');

        $impact_assessment = $this->input->post('impact_assessment');
        $impact_assessment_board = $this->input->post('impact_assessment_board');
        $impact_assessment_board_link = $this->input->post('impact_assessment_board_link');

        $new_csr_project = $this->input->post('new_csr_project');
        $new_csr_project_nature = $this->input->post('new_csr_project_nature');
        $is_unspent_for_pretaining_2014_15_to_2019_20 = $this->input->post('is_unspent_for_pretaining_2014_15_to_2019_20');
        $is_capital_assest_created = $this->input->post('is_capital_assest_created');

        $entity_name = $this->input->post('entity_name');

        $financial_duration_ongoing = $this->input->post('financial_duration_ongoing');
        $csr_no_ongoing = $this->input->post('csr_no_ongoing');
        $financial_duration_other = $this->input->post('financial_duration_other');
        $csr_no_other = $this->input->post('csr_no_other');

        $project_id = $this->input->post('project_id');
        $type = $this->input->post('type');
        $pertains = $this->input->post('pertains');
        $sector = $this->input->post('sector');
        $prject_name = $this->input->post('prject_name');
        $area = $this->input->post('area');
        $location = $this->input->post('location');


        $overhead = $this->input->post('overhead');
        $assessment = $this->input->post('assessment');
        $amount_spent = $this->input->post('amount_spent');
        $amount_unspent = $this->input->post('amount_unspent');

        $csr_amt = $this->input->post('csr_amt');
        $csr_actual = $this->input->post('csr_actual');
        $csr_date = $this->input->post('csr_date');
        $csr_deficiency = $this->input->post('csr_deficiency');

        $schedule_amt = $this->input->post('schedule_amt');
        $schedule_actual = $this->input->post('schedule_actual');
        $schedule_date = $this->input->post('schedule_date');
        $schedule_deficiency = $this->input->post('schedule_deficiency');


        $duration = $this->input->post('duration');
        $amount = $this->input->post('amount');
        $implementation = $this->input->post('implementation');
        $registration = $this->input->post('registration');
        $agency = $this->input->post('agency');

        $particulars = $this->input->post('particulars');
        $pin = $this->input->post('pin');
        $creation = $this->input->post('creation');
        $csr_amount = $this->input->post('csr_amount');
        $owner_registration = $this->input->post('owner_registration');
        $owner_name = $this->input->post('owner_name');
        $owner_address = $this->input->post('owner_address');

        if(isset($csr2->CSR_project_ongoing_details_current_year_id)){
            $temp = explode(',',$csr2->CSR_project_ongoing_details_current_year_id);  
            $this->deleteProject($temp,$key);
        }
        if(isset($csr2->CSR_project_other_than_ongoing_details_current_year_id)){
            $temp = explode(',',$csr2->CSR_project_other_than_ongoing_details_current_year_id);   
            $this->deleteProject($temp,$key);
        }
        if(isset($csr2->CSR_project_details_before_2014_15_year_id)){
            $temp = explode(',',$csr2->CSR_project_details_before_2014_15_year_id); 
            $this->deleteProject($temp,$key);  
        }
        if(isset($csr2->CSR_project_ongoing_details_previous_year_id)){
            $temp = explode(',',$csr2->CSR_project_ongoing_details_previous_year_id);   
            $this->deleteProject($temp,$key);
        }
        if(isset($csr2->CSR_project_other_than_ongoing_details_previous_year_id)){
            $temp = explode(',',$csr2->CSR_project_other_than_ongoing_details_previous_year_id);  
            $this->deleteProject($temp,$key); 
        }


        $CSR_project_ongoing_details_current_year_id = array();
        $CSR_project_other_than_ongoing_details_current_year_id = array();
        $CSR_project_details_before_2014_15_year_id = array();
if($project_id){
        foreach($project_id as $i =>  $row){
            if(($type[$i] == 1 && $new_csr_project == 1 && ($new_csr_project_nature == 1  || $new_csr_project_nature == 3)) || ($type[$i] == 2 && $new_csr_project == 1 && ($new_csr_project_nature == 2  || $new_csr_project_nature == 3)) || ($type[$i] == 3 && $is_unspent_for_pretaining_2014_15_to_2019_20 == 1)){
            $temp = explode(',',$location[$i]);
            $info = [
                'profile_id' => $this->profile_id_display,
                'role_id' => $this->current_active_role,
                'FY_year_project_commenced' => $pertains[$i],
                'project_id' => $row,
                'project_name' =>  $prject_name[$i],
                'sector' => $sector[$i],
                'local_area' => $area[$i],
                'location_state' => ($temp)?$temp[1]:null,
                'location_district' => ($temp)?$temp[0]:null,
                'project_duration' => $duration[$i],
                'amt_spent_in_year' => $amount[$i],
                'is_direct_implementation' => $implementation[$i],
                'implementer_name' => $agency[$i],
                'CSR_reg_no' => $registration[$i],
                'project_csr_implementation_type' => $type[$i]
            ];

            if($type[$i] == 1 && $new_csr_project == 1 && ($new_csr_project_nature == 1  || $new_csr_project_nature == 3)){
                $id = $this->CsrModel->insert('csr_project_details',$info);
                array_push($CSR_project_ongoing_details_current_year_id,$id);
            }
            if($type[$i] == 2 && $new_csr_project == 1 && ($new_csr_project_nature == 2  || $new_csr_project_nature == 3)){
                $id = $this->CsrModel->insert('csr_project_details',$info);
                array_push($CSR_project_other_than_ongoing_details_current_year_id,$id);
            }
            if($type[$i] == 3 && $is_unspent_for_pretaining_2014_15_to_2019_20 == 1){
                $id = $this->CsrModel->insert('csr_project_details',$info);
                array_push($CSR_project_details_before_2014_15_year_id,$id);
            }
            }
        }
    }
        if(isset($csr2->csr2_capital_assest_contributor_id)){
            $temp = explode(',',$csr2->csr2_capital_assest_contributor_id);   
            foreach($temp as $row){
                $key1 = $key+array('id' => $row);
                $this->CsrModel->delete('csr_capital_asset_contributor', $key1);
            }
        }

        $csr2_capital_assest_contributor_id = array();
        if($is_capital_assest_created == 1){
            foreach($particulars as $i =>  $row){
                $info = [
                    'profile_id' => $this->profile_id_display,
                    'role_id' => $this->current_active_role,
                    'FY_year' => $prime_year,
                    'asset_details' => $row,
                    'pincode' =>  $pin[$i],
                    'date_of_creation' => $creation[$i],
                    'Expense_budget' => $csr_amount[$i],
                    'CSR_reg_no' => $owner_registration[$i],
                    'implrmenter_name' => $owner_name[$i],
                    'implementer_registred_address' => $owner_address[$i],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
                $id = $this->CsrModel->insert('csr_capital_asset_contributor',$info);
                array_push($csr2_capital_assest_contributor_id,$id);
            }
        }

        if(isset($csr2->csr2_committee_meetings_id)){
            $temp = explode(',',$csr2->csr2_committee_meetings_id);   
            foreach($temp as $row){
                $key1 = $key+array('id' => $row);
                $this->CsrModel->delete('csr_committee_meetings', $key1);
            }
        }
       
        $csr2_committee_meetings_id = array();
        if(isset($member_id)){
            foreach($member_id as $i =>  $row){
                $info = [
                    'profile_id' => $this->profile_id_display,
                    'role_id' => $this->current_active_role,
                    'FY_year' => $prime_year,
                    'committee_member_id' => $row,
                    'meetings_attended_in_year' =>  $attend[$i],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
                $id = $this->CsrModel->insert('csr_committee_meetings',$info);
                array_push($csr2_committee_meetings_id,$id);
            }
        }

        $report = $this->CsrModel->getDirectorReport($this->profile_id_display,$prime_year,3,3);

        $ongoingRecord = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,array('dir_report_id' => $report->id,'project_type' => 'Ongoing'),null,null);
        $otherRecord = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,array('dir_report_id' => $report->id,'project_type' => 'Other than Ongoing'),null,null);

        $ongoing = array(); 
        foreach($ongoingRecord as $i => $row){
            $location = explode(',',$row->project_location_state); 
            $info = [
                'profile_id' => $this->profile_id_display,
                'role_id' => $this->current_active_role,
                'project_name' =>  $row->project_activity_name,
                'sector' => $row->sector,
                'local_area' => $row->is_project_location_local,
                'location_state' => (count($location)>1)? $location[1]:$location[0],
                'location_district' => (count($location)>1)? $location[0]:'',
                'project_duration' => $financial_duration_ongoing[$i],
                'amt_spent_in_year' => $row->direct_expenditure,
                'is_direct_implementation' => $row->is_direct_implementation_dir_report,
                'implementer_name' => $entity_name,
                'CSR_reg_no' => $csr_no_ongoing[$i],
                'project_csr_implementation_type' =>(($row->project_type=='Ongoing')?1:2) 
            ];

            $id = $this->CsrModel->insert('csr_project_details',$info);
            array_push($ongoing,$id);
        }
        $other = array(); 
        foreach($otherRecord as $i => $row){
            $location = explode(',',$row->project_location_state); 
            $info = [
                'profile_id' => $this->profile_id_display,
                'role_id' => $this->current_active_role,
                'project_name' =>  $row->project_activity_name,
                'sector' => $row->sector,
                'local_area' => $row->is_project_location_local,
                'location_state' => (count($location)>1)? $location[1]:$location[0],
                'location_district' => (count($location)>1)? $location[0]:'',
                'project_duration' => $financial_duration_other[$i],
                'amt_spent_in_year' => $row->direct_expenditure,
                'is_direct_implementation' => $row->is_direct_implementation_dir_report,
                'implementer_name' => $entity_name,
                'CSR_reg_no' => $csr_no_other[$i],
                'project_csr_implementation_type' =>(($row->project_type=='Ongoing')?1:2) 
            ];

            $id = $this->CsrModel->insert('csr_project_details',$info);
            array_push($other,$id);
        }


        $key1 = $key + array('FY_year' => $prime_year);
        $criteria = $this->CommonModel->TblSelectedRecords('csr_criteria_applicability','id',$key1);
        $obligation = $this->CommonModel->TblSelectedRecords('csr2_obligation_form','id',$key1);
        $setOff = $this->CommonModel->serializeId('csr_set_off_amt','id',$key1);
        $net_preceeding_years = $this->CommonModel->serializeId('csr_net_profit_calculator_for_preceeding_years','id',$key1);

        $preceding_id = array();
        $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-2)));
        array_push($preceding_id,$this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','id',$key1)->id);
    
        $key1 = $key + array('FY_year' => ('31/03/'.($year[0]-1)));
        array_push($preceding_id,$this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','id',$key1)->id);

        $key1 = $key + array('FY_year' => ('31/03/'.($year[0])));
        array_push($preceding_id,$this->CommonModel->TblSelectedRecords('csr_amt_spent_pertaining_3_years','id',$key1)->id);

        $preceeding_years = $this->CommonModel->serializeId('csr_ongoing_projects_preceeding_year_details','id',$key);

        $info = [
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
            'report_id' => $report_id,
            'csr_criteria_appicability_id' => $criteria->id,
            'due_date' => date('Y-m-d',strtotime('20-09-'.date('Y'))),
            'csr2_obligation_id' => $obligation->id,
            'csr_details_pegtain_from' => strtotime($from),
            'csr_details_pegtain_to' => strtotime($to),
            'srn' => $srn,
            'srn_date' => strtotime($srn_date),
            'number_of_meetings_of_csr_committee' => $meeting,
            'csr2_committee_meetings_id' => implode(',',$csr2_committee_meetings_id),
            'is_impact_assessment_carried_out' => $impact_assessment,
            'is_impact_assessment_disclosed_in_board_report' => ($impact_assessment==1 && $impact_assessment_board==1)?1:0,
            'board_report_link' => ($impact_assessment==1 && $impact_assessment_board==1)?$impact_assessment_board_link:'',
            'CSR_set_off_amt_id' => $setOff->id,
            'net_profit_for_preceeding_years_id' => $net_preceeding_years->id,
            'CSR_project_ongoing_details_previous_year_id' => implode(',',$ongoing),
            'CSR_project_other_than_ongoing_details_previous_year_id' => implode(',',$other),
            'CSR_amt_spent_pertaining_3_years_id' => implode(',',$preceding_id),
            'CSR_ongoing_projects_preceeding_year_details_id' => $preceeding_years->id,
            'CSR_project_ongoing_details_current_year_id' => implode(',',$CSR_project_ongoing_details_current_year_id),
            'CSR_project_other_than_ongoing_details_current_year_id' => implode(',',$CSR_project_other_than_ongoing_details_current_year_id),
            'CSR_project_details_before_2014_15_year_id' => implode(',',$CSR_project_details_before_2014_15_year_id),
            'csr2_capital_assest_contributor_id' => implode(',',$csr2_capital_assest_contributor_id),
        ];

        
        if($csr2){
            $this->CommonModel->update('csr2_report', array('id' => $csr2->id),$info);
        }else{
            $id = $this->CsrModel->insert('csr2_report',$info);
        }

        $info = [
            'contributor_csr_admin_overheads' => $overhead,
            'contributor_impact_assess_expense_amt' => $assessment,
            'total_amt_spent_for_FY' => $amount_spent,
            'amt_unspent_excess_for_FY' => $amount_unspent,
            'amt_transfer_eligible_unspent_CSR_acc' => $csr_amt,
            'amt_transfer_fund_specificed_sch7' => $schedule_amt,
            'amt_actual_transfer_unspent_CSR_acc' => $csr_actual,
            'date_of_trasnfer_csr_unspent_acc' => $csr_date,
            'deficiency_unspent_csr' => $csr_deficiency,
            'amt_actual_transfer_fund_specificed_sch7' => $schedule_actual,
            'date_of_trasnfer_fund_specificed_sch7' => $schedule_date,
            'deficiency_fund_specificed_sch7' => $schedule_deficiency,
            'is_new_csr_project' => $new_csr_project,
            'new_csr_project_nature' => ($new_csr_project == 1)? $new_csr_project_nature : null,
            'is_unspent_for_pretaining_2014_15_to_2019_20' => $is_unspent_for_pretaining_2014_15_to_2019_20,
            'is_capital_assest_created' => $is_capital_assest_created
        ];

        $this->CommonModel->update('csr2_obligation_form', array('id' => $obligation->id),$info);

        if ($_POST['report_status'] == 3) {
            redirect('CsrCompliance/previewCSRReport?year=' . $prime_year);
        }
        redirect('CsrCompliance/dashboard');
    }
    public function reports()
    {
        $data = [];
        $data['director_reports'] = $this->ReportModel->getCsrDirectorReports($this->profile_id_display, $this->current_active_role);
        $this->load->view('csrcompliance/csrreports', $data);
    }

    public function previewreport()
    {
        if (isset($_GET['year']) && isset($_GET['report_id'])) {

            $data['prime_year'] = $_GET['year'];
            $year = explode('-',$_GET['year']);

            $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role);
            
            $key1 = $key + array('FY_year' => $data['prime_year']);
            $data['obligation'] = $this->CommonModel->TblRecords('csr2_obligation_form',1,null,$key1,null,null);

            $kay5 = array('profile_id' => $this->profile_id_display, 'id' => $_GET['report_id'], 'report_type' => 3, 'report_status' => 3);
            $report = $this->CommonModel->TblRecords('reports',1,null,$kay5,null,null);
      
            if($data['obligation'] && $report){
            
                $data['committee'] = $this->CommonModel->TblAllRecords('csr_committee_details','name_of_director',$key);
            
                $match = array($this->prime_year,($year[0]-1).'-'.($year[1]-1),($year[0]-2).'-'.($year[1]-2));
                $data['avg_net_profit'] = $this->CsrModel->getAvgNetProfit($key,$match);
            
                $data['sdgs']  = $this->CommonModel->TblRecords('sdgs_master',null,null,null,null,null);
                
                $kay6 = array('report_id' => $report->id);
                $data['director_report'] = $this->CommonModel->TblRecords('csr2_directors_report',1,null,$kay6,null,null);

                $kay7 = array('dir_report_id' => $report->id);
                $data['director_project'] = $this->CommonModel->TblRecords('csr2_directors_report_project',null,null,$kay7,null,null);

                foreach($data['director_project'] as $row){
                    $return = $this->CommonModel->TblSelectedRecords('sector_master','sdgs_id',array('sector_type' => $row->sector));
                    if($return)
                        $row->sdgs_id = $return->sdgs_id;
                    else
                        $row->sdgs_id = null;
                }

                $kay8 = array('project_report_id' => $report->id);
                $data['case_study'] = $this->CommonModel->TblRecords('project_report_case_studies',1,null,$kay8,null,null);

                $id = explode(',',$data['case_study']->case_study_image);
                $data['case_study_image'] = $this->CommonModel->fatchMedia($id);
                
                $kay10 = array('report_id' => $report->id);
                $data['testimonials'] = $this->CommonModel->TblRecords('report_testimonials',null,null,$kay10,null,null);
                
                if(isset($_GET['action'])=='pdf'){
                    $this->load->library('pdf');
                    $html = $this->load->view('csrcompliance/pdf/report.php',$data,true);
                    $this->pdf->generate($html, 'Computation-', false);
                }else{
                    $this->load->view('csrcompliance/previewreport', $data);
                }
            }else{
                redirect('/CsrCompliance/dashboard');
            } 
        }else{
            redirect('/CsrCompliance/dashboard');
        }
    }
   public function fyendreport()
    {
        $data = [];
        $where = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role
        );

        $comitte_details = $this->CsrModel->getCommitteDetails($where);
        $comitte_details ? $data['comitte_details'] = $comitte_details : $data;

        $pertaining_year = $this->CsrModel->get_csr_amt_spent_pertaining_three_years($where);
        $this->load->view('csrcompliance/fyendreport', $data);
    }

    public function closingReportStepTwo()
    {
        $this->load->view('CsrCompliance/fy-end-report-step-two');
    }
    public function downloadreport()
    {
        $this->load->view('csrcompliance/downloadreport');
    }
    public function isLogin()
    {
        $user_id = $_SESSION['UserId'];
        if (empty($user_id) || $_SESSION['current_role'] != 2) {
            redirect(base_url());
        }else{
            $data['UserDetails']=$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
            $this->load->vars($data);
        }
    }
    public function getRoleIdProfileID($user_id)
    {
        $user_profile = $this->db->select('profile_id_display, current_active_role')
            ->get_where('users', array('id' => $user_id))
            ->row();
        return $user_profile;
    }

    //function to save CSR compliance basic details 
    public function saveBasicDetails()
    {    
        $this->isPost();
        $user_id = $_SESSION['UserId'];
        if (empty($user_id)) {
            redirect(base_url());
        }
        $user_profile = $this->db->select('profile_id_display, current_active_role')
            ->get_where('users', array('id' => $user_id))
            ->row();
        $profile_id = $user_profile->profile_id_display;
        $role_id = $user_profile->current_active_role;
        $this->saveApplicablityCriteria($_POST, $user_id, $profile_id, $role_id);
        //$this->saveCsrNetProfitForProceedingYears($_POST['preceding_year'], $profile_id, $role_id);
        $this->saveCSRAmountSetOff();
        $this->saveAmtSpentPertainingThreeYear();
        $this->saveOngoingProjectProceedingYearDetail();
        
        $set_off_board_resolution_file = '';
        $file_name = $_FILES['set_off_board_resolution_file']['name'];
        if ($file_name) {
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $set_off_board_resolution_file = $user_id . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
            $config['upload_path'] = CSR_COMPLIANCE_DOCUMENTS;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
            $config['max_size'] = MAX_FILESIZE_BYTE;
            $config['file_name'] = $user_id . '-' . strtotime(date('Y-m-d H:i:s'));
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('set_off_board_resolution_file')) {
                $uploadData = $this->upload->data();
                $set_off_board_resolution_file = $uploadData['file_name'];
            }
        } else {
            $set_off_board_resolution_file = '';
        }
        $this->Ongoinginsert_obligation_data($_POST, $profile_id, $role_id, $set_off_board_resolution_file);

        $key = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
            'type' => 1
        );
        $to_delete = $this->CommonModel->TblAllRecords('csr_net_profit_calculator_for_preceeding_years','FY_year',$key);
        foreach($to_delete as $row){
            $this->initCalculation($row->FY_year,NULL);
        }

        $this->updateCalculation();

        redirect('CsrCompliance/dashboard?tab=committee-tab');
    }
    public function updateCalculation(){
        $key = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
        );
        $info = array('type' => NULL);

        $this->CommonModel->update('csr_net_profit_calculator_for_preceeding_years',$key,$info);
    }
    public function initCalculation($fy,$type){
        $key = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
            'type' => $type,
        );
        if($fy){
            $key += array(
                'FY_year' => $fy
            );   
        }

        $this->CsrModel->delete('csr_net_profit_calculator_for_preceeding_years',$key);
    }
    public function Ongoinginsert_obligation_data($data, $profile_id, $role_id, $set_off_board_resolution_file)
    {
        $this->isPost();
        $current_financial_year = $this->current_financial_year;
        $data_to_check_fy = array('FY_year' => $current_financial_year, 'profile_id' => $profile_id, 'role_id' => $role_id);

        if($set_off_board_resolution_file){
            $info = [
                        'set_off_board_resolution_file' => $set_off_board_resolution_file
                    ];
        }else{
            $info = array();
        }

        $data_check_count = $this->CsrModel->checkOngoinginsert_obligation_data($data_to_check_fy);
        if (count($data_check_count) > 0) {
            $info += [
                'is_CSR_policy_created' => $_POST['is_CSR_policy_created'],
                'is_CSR_policy_displayed' => $_POST['is_CSR_policy_displayed'],
                'CSR_committee_constituted_displayed' => $_POST['CSR_committee_constituted_displayed'],
                'CSR_projects_displayed' => $_POST['CSR_projects_displayed'],
                'CSR_policy_link' => ($_POST['is_CSR_policy_displayed']==1)?$_POST['csr_policy_link']:'',
                'is_CSR_setoff_available' => $_POST['csr_set_off_amt_amount_avialable'],
                'percentage_of_avg_net_profit' => $_POST['avg_net_profit'],
                'surplus_from_CSR_projects' => $_POST['surplus_amount'],
                'amt_to_be_set_off' => $_POST['amount_to_be_set_off'],
                'CSR_obligation_current_FY' => $_POST['csr_obligation'],
                'is_unspent_for_preceeding_3_years_after_22_Jan_21' => $_POST['is_unspent_for_preceeding_3_years_after_22_Jan_21'],
            ];
            $this->CsrModel->updateObligationFormData($current_financial_year, $profile_id, $role_id, $info);
        } else {
            $info += [
                'profile_id' => $profile_id,
                'role_id' => $role_id,
                'FY_year' => $current_financial_year,
                'is_CSR_policy_created' => $_POST['is_CSR_policy_created'],
                'is_CSR_policy_displayed' => $_POST['is_CSR_policy_displayed'],
                'CSR_committee_constituted_displayed' => $_POST['CSR_committee_constituted_displayed'],
                'CSR_projects_displayed' => $_POST['CSR_projects_displayed'],
                'CSR_policy_link' => ($_POST['is_CSR_policy_displayed']==1)?$_POST['csr_policy_link']:'',
                'is_CSR_setoff_available' => $_POST['csr_set_off_amt_amount_avialable'],
                'percentage_of_avg_net_profit' => $_POST['avg_net_profit'],
                'surplus_from_CSR_projects' => $_POST['surplus_amount'],
                'amt_to_be_set_off' => $_POST['amount_to_be_set_off'],
                'CSR_obligation_current_FY' => $_POST['csr_obligation'],
                'is_unspent_for_preceeding_3_years_after_22_Jan_21' => $_POST['is_unspent_for_preceeding_3_years_after_22_Jan_21'],
            ];
            $this->CsrModel->addCsrTwoObligationFormData($info);
        }
    }
    public function saveApplicablityCriteria()
    {
        $this->isPost();

        $net_worth = $this->input->post('net_worth');
        $turn_over = $this->input->post('turn_over');
        $is_audited = $this->input->post('is_audited');
        $applicable_csr = $this->input->post('applicable_csr'); 

        $key = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
            'FY_year' => $this->current_financial_year,
        );
    
        $return = $this->CommonModel->TblSelectedRecords('csr_net_profit_calculator_for_preceeding_years','net_profit',$key);
    
        if ($net_worth >= 5000000000 || $turn_over >= 10000000000 || $return->net_profit >= 50000000) {
            $is_applicable = 1;
        }else{
            $is_applicable = 0;
        }

            $info = array(
                                'profile_id' =>  $this->profile_id_display,
                                'role_id' => $this->current_active_role,
                                'FY_year' => $this->current_financial_year,
                                'is_auidted_data' => $is_audited,
                                'net_worth' => $net_worth,
                                'turnover' => $turn_over,
                                'net_profit' => $return->net_profit,
                                'is_csr_applicable' => $is_applicable,
                                'csr_criteria_applicable' => $applicable_csr,
                                'created_at' => strtotime(date('Y-m-d H:i:s')),
                                'updated_at' => strtotime(date('Y-m-d H:i:s'))
                        );

            $this->CsrModel->delete('csr_criteria_applicability',$key);
            $this->CsrModel->insert('csr_criteria_applicability',$info);
      
        return true;
    }
    /*
    Sanjay Oraon 
    Date 13-10-2023
    code optimized in other function

    public function saveApplicablityCriteria($data, $user_id, $profile_id, $role_id)
    {
        $current_financial_year = $this->current_financial_year;
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;
        $data_to_check_fy = array('FY_year' => $current_financial_year, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $checkfinancial_current_year = $this->CsrModel->checkcsrfinacialyear($data_to_check_fy);

        if (count($checkfinancial_current_year) > 0) {
            $this->update_ApplicablityCriteria($data);
        } else {
            //Previous_second_year 
            $last_financialYears = $this->last_financialYears;
            $last_previous_fy = array('FY_year' => $last_financialYears[0], 'profile_id' => $profile_id, 'role_id' => $role_id);
            $checkfinancial_previous_fy = $this->CsrModel->checkcsrfinacialyear($last_previous_fy);
            if (count($checkfinancial_previous_fy) > 0) {
                foreach ($data['app_criteria'] as $key => $value) {
                    if ($key == 'cur_year') {
                        $is_csr_applicable = false;
                        $csr_criteria_applicable = [];
                        if ($key == 'cur_year') {
                            if ($value['net_worth'] >= 5000000000 && $value['turn_over'] >= 10000000000 && $value['net_profit'] >= 50000000) {
                                $is_csr_applicable = true;
                            }
                            if ($value['net_worth'] >= 5000000000) {
                                $csr_criteria_applicable[] = "Net worth";
                            }
                            if ($value['turn_over'] >= 10000000000) {
                                $csr_criteria_applicable[] = "Turnover";
                            }
                            if ($value['net_profit'] >= 50000000) {
                                $csr_criteria_applicable[] = "Net Profit";
                            }
                        }
                        $csr_criteria_applicability = [
                            'profile_id' => $profile_id,
                            'role_id' => $role_id,
                            'FY_year' => $value['fy'],
                            'is_auidted_data' => $key == 'cur_year' ? $value['is_auidted_data'] : 0,
                            'net_worth' => $key == 'cur_year' ? $value['net_worth'] : 0,
                            'turnover' => $key == 'cur_year' ? $value['turn_over'] : 0,
                            'net_profit' => $value['net_profit'],
                            'is_csr_applicable' => $is_csr_applicable,
                            'csr_criteria_applicable' => implode(", ", $csr_criteria_applicable),
                            'created_at' => strtotime(date('Y-m-d H:i:s')),
                            'updated_at' => strtotime(date('Y-m-d H:i:s'))
                        ];
                        $insert_current_financial_year = $this->CsrModel->addCriteriaEligibilty($csr_criteria_applicability);
                        if ($insert_current_financial_year) {
                            echo "TRUE";
                        }
                    }
                }
            } else {
                $this->insert_all_ApplicablityCriteria($data);
            }
        }
        return true;
    }
    public function update_ApplicablityCriteria($data)
    {
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;
        foreach ($data['app_criteria'] as $key => $value) {
            $csr_criteria_applicable = [];
            $is_csr_applicable = false;
            if ($key == 'cur_year') {
                if ($value['net_worth'] >= 5000000000 && $value['turn_over'] >= 10000000000 && $value['net_profit'] >= 50000000) {
                    $is_csr_applicable = true;
                }
                if ($value['net_worth'] >= 5000000000) {
                    $csr_criteria_applicable[] = "Net worth";
                }
                if ($value['turn_over'] >= 10000000000) {
                    $csr_criteria_applicable[] = "Turnover";
                }
                if ($value['net_profit'] >= 50000000) {
                    $csr_criteria_applicable[] = "Net Profit";
                }
            }
            if ($key == 'cur_year') {
                $data = [
                    'is_auidted_data' => $key == 'cur_year' ? $value['is_auidted_data'] : 0,
                    'net_worth' => $key == 'cur_year' ? $value['net_worth'] : 0,
                    'turnover' => $key == 'cur_year' ? $value['turn_over'] : 0,
                    'net_profit' => $value['net_profit'],
                    'is_csr_applicable' => $is_csr_applicable,
                    'csr_criteria_applicable' => implode(", ", $csr_criteria_applicable),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
            } else {
                $data = [
                    'net_profit' => $value['net_profit'],
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
            }
            $update = $this->CsrModel->updatecsr_criteria_applicability_FY($value['fy'], $profile_id, $role_id, $data);
            if ($update) {
                echo "true";
            }
        }
    }
    public function insert_all_ApplicablityCriteria($data)
    {
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;
        foreach ($data['app_criteria'] as $key => $value) {
            $is_csr_applicable = false;
            $csr_criteria_applicable = [];
            if ($key == 'cur_year') {
                if ($value['net_worth'] >= 5000000000 && $value['turn_over'] >= 10000000000 && $value['net_profit'] >= 50000000) {
                    $is_csr_applicable = true;
                }
                if ($value['net_worth'] >= 5000000000) {
                    $csr_criteria_applicable[] = "Net worth";
                }
                if ($value['turn_over'] >= 10000000000) {
                    $csr_criteria_applicable[] = "Turnover";
                }
                if ($value['net_profit'] >= 50000000) {
                    $csr_criteria_applicable[] = "Net Profit";
                }
            }
            $csr_criteria_applicability = [
                'profile_id' => $profile_id,
                'role_id' => $role_id,
                'FY_year' => $value['fy'],
                'is_auidted_data' => $key == 'cur_year' ? $value['is_auidted_data'] : 0,
                'net_worth' => $key == 'cur_year' ? $value['net_worth'] : 0,
                'turnover' => $key == 'cur_year' ? $value['turn_over'] : 0,
                'net_profit' => $value['net_profit'],
                'is_csr_applicable' => $is_csr_applicable,
                'csr_criteria_applicable' => implode(", ", $csr_criteria_applicable),
                'created_at' => strtotime(date('Y-m-d H:i:s')),
                'updated_at' => strtotime(date('Y-m-d H:i:s'))
            ];
            $this->CsrModel->addCriteriaEligibilty($csr_criteria_applicability);
        }
    }

    Sanjay Oraon
    Date 12-10-2023
    Save Calculator Calculation
    */

    public function saveCalculation()
    {
        $this->isPost();

        $section_one_total = 0;
        $section_two_total = 0;
        $section_third_total = 0;
         
        $adjustment = 0;
       
        $e_net_worth = $this->input->post('e_net_worth');
        $e_turnover = $this->input->post('e_turnover');

       $fy_year = $this->input->post('fy_year');

       $NP_before_tax = $this->input->post('NP_before_tax');
       $NP_before_tax_remark = $this->input->post('NP_before_tax_remark');

       $bounties_received = $this->input->post('bounties_received');
       $bounties_received_remark = $this->input->post('bounties_received_remark');

       $section_one_total += $premium_debunture_profits = $this->input->post('premium_debunture_profits');
       $premium_debunture_profits_remark = $this->input->post('premium_debunture_profits_remark');

       $section_one_total += $sales_fortified_shares = $this->input->post('sales_fortified_shares');
       $sales_fortified_shares_remark = $this->input->post('sales_fortified_shares_remark');

       $section_one_total += $profits_captial_nature = $this->input->post('profits_captial_nature');
       $profits_captial_nature_remark = $this->input->post('profits_captial_nature_remark');

       $section_one_total += $immvoable_fixed_assests = $this->input->post('immvoable_fixed_assests');
       $immvoable_fixed_assests_remark = $this->input->post('immvoable_fixed_assests_remark');

       $section_one_total += $carrying_amt_assests = $this->input->post('carrying_amt_assests');
       $carrying_amt_assests_remark = $this->input->post('carrying_amt_assests_remark');

       $section_two_total += $usual_workings = $this->input->post('usual_workings');
       $usual_workings_remark = $this->input->post('usual_workings_remark');

       $section_two_total += $directors_remumneration = $this->input->post('directors_remumneration');
       $directors_remumneration_remark = $this->input->post('directors_remumneration_remark');

       $section_two_total += $bonous_commsion_paid = $this->input->post('bonous_commsion_paid');
       $bonous_commsion_paid_remark = $this->input->post('bonous_commsion_paid_remark');

       $section_two_total += $tax_notified_by_govt = $this->input->post('tax_notified_by_govt');
       $tax_notified_by_govt_remark = $this->input->post('tax_notified_by_govt_remark');

       $section_two_total += $special_tax_on_business_profits = $this->input->post('special_tax_on_business_profits');
       $special_tax_on_business_profits_remarks = $this->input->post('special_tax_on_business_profits_remarks');

       $section_two_total += $interest_on_debentures = $this->input->post('interest_on_debentures');
       $interest_on_debentures_remark = $this->input->post('interest_on_debentures_remark');

       $section_two_total += $interest_on_mortgages = $this->input->post('interest_on_mortgages');
       $interest_on_mortgages_remark = $this->input->post('interest_on_mortgages_remark');

       $section_two_total += $Interest_on_unsecured_loans_and_advances = $this->input->post('Interest_on_unsecured_loans_and_advances');
       $Interest_on_unsecured_loans_and_advances_remark = $this->input->post('Interest_on_unsecured_loans_and_advances_remark');

       $section_two_total += $Expenses_on_repairs = $this->input->post('Expenses_on_repairs');
       $Expenses_on_repairs_remark = $this->input->post('Expenses_on_repairs_remark');

       $section_two_total += $Outgoings = $this->input->post('Outgoings');
       $Outgoings_remark = $this->input->post('Outgoings_remark');

       $section_two_total += $Depreciation_Section_123 = $this->input->post('Depreciation_Section_123');
       $Depreciation_Section_123_remark = $this->input->post('Depreciation_Section_123_remark');


       $section_two_total += $excess_expenditure_over_income = $this->input->post('excess_expenditure_over_income');
       $excess_expenditure_over_income_remark = $this->input->post('excess_expenditure_over_income_remark');

       $section_two_total += $compensation_or_damages = $this->input->post('compensation_or_damages');
       $compensation_or_damages_remark = $this->input->post('compensation_or_damages_remark');

       $section_two_total += $insurance_against_liability = $this->input->post('insurance_against_liability');
       $insurance_against_liability_remark = $this->input->post('insurance_against_liability_remark');

       $section_two_total += $debts_written_off = $this->input->post('debts_written_off');
       $debts_written_off_remark = $this->input->post('debts_written_off_remark');

       $section_third_total += $Income_and_super_tax = $this->input->post('Income_and_super_tax');
       $Income_and_super_tax_remark = $this->input->post('Income_and_super_tax_remark');

       $section_third_total += $voluntarily_compensation = $this->input->post('voluntarily_compensation');
       $voluntarily_compensation_remark = $this->input->post('voluntarily_compensation_remark');

       $section_third_total += $capital_loss_sec_350 = $this->input->post('capital_loss_sec_350');
       $capital_loss_sec_350_remark = $this->input->post('capital_loss_sec_350_remark');

       $section_third_total += $carring_amount = $this->input->post('carring_amount');
       $carring_amount_remark = $this->input->post('carring_amount_remark');

       $adjustment += $profit_from_oversease = $this->input->post('profit_from_oversease');
       $adjustment += $dividend_received = $this->input->post('dividend_received');


        $net_profit = $NP_before_tax+$bounties_received-$section_one_total-$section_two_total+$section_third_total;
        $totel_net_profit = $net_profit-$adjustment;

        $info = array(
                                'profile_id' => $this->profile_id_display,
                                'role_id' => $this->current_active_role,
                                'FY_year' => $fy_year,
                                'type' => 1,
                                'NP_before_tax' => $NP_before_tax,
                                'NP_before_tax_remark' => $NP_before_tax_remark,
                                'bounties_received' => $bounties_received,
                                'bounties_received_remark' => $bounties_received_remark,
                                'premium_debunture_profits' => $premium_debunture_profits,
                                'premium_debunture_profits_remark' => $premium_debunture_profits_remark,
                                'sales_fortified_shares' => $sales_fortified_shares,
                                'sales_fortified_shares_remark' => $sales_fortified_shares_remark,
                                'profits_captial_nature' => $profits_captial_nature,
                                'profits_captial_nature_remark' => $profits_captial_nature_remark,
                                'immvoable_fixed_assests' => $immvoable_fixed_assests,
                                'immvoable_fixed_assests_remark' => $immvoable_fixed_assests_remark,
                                'carrying_amt_assests' => $carrying_amt_assests,
                                'carrying_amt_assests_remark' => $carrying_amt_assests_remark,
                                'usual_workings' => $usual_workings,
                                'usual_workings_remark' => $usual_workings_remark,
                                'directors_remumneration' => $directors_remumneration,
                                'directors_remumneration_remark' => $directors_remumneration_remark,
                                'bonous_commsion_paid' => $bonous_commsion_paid,
                                'bonous_commsion_paid_remark' => $bonous_commsion_paid_remark,
                                'tax_notified_by_govt' => $tax_notified_by_govt,
                                'tax_notified_by_govt_remark' => $tax_notified_by_govt_remark,
                                'special_tax_on_business_profits' => $special_tax_on_business_profits,
                                'special_tax_on_business_profits_remarks' => $special_tax_on_business_profits_remarks,
                                'interest_on_debentures' => $interest_on_debentures,
                                'interest_on_debentures_remark' => $interest_on_debentures_remark,
                                'interest_on_mortgages' => $interest_on_mortgages,
                                'interest_on_mortgages_remark' => $interest_on_mortgages_remark,
                                'Interest_on_unsecured_loans_and_advances' => $Interest_on_unsecured_loans_and_advances,
                                'Interest_on_unsecured_loans_and_advances_remark' => $Interest_on_unsecured_loans_and_advances_remark,
                                'Expenses_on_repairs' => $Expenses_on_repairs,
                                'Expenses_on_repairs_remark' => $Expenses_on_repairs_remark,
                                'Outgoings' => $Outgoings,
                                'Outgoings_remark' => $Outgoings_remark,
                                'Depreciation_Section_123' => $Depreciation_Section_123,
                                'Depreciation_Section_123_remark' => $Depreciation_Section_123_remark,
                                'excess_expenditure_over_income' => $excess_expenditure_over_income,
                                'excess_expenditure_over_income_remark' => $excess_expenditure_over_income_remark,
                                'compensation_or_damages' => $compensation_or_damages,
                                'compensation_or_damages_remark' => $compensation_or_damages_remark,
                                'insurance_against_liability' => $insurance_against_liability,
                                'insurance_against_liability_remark' => $insurance_against_liability_remark,
                                'debts_written_off' => $debts_written_off,
                                'debts_written_off_remark' => $debts_written_off_remark,
                                'Income_and_super_tax' => $Income_and_super_tax,
                                'Income_and_super_tax_remark' => $Income_and_super_tax_remark,
                                'voluntarily_compensation' => $voluntarily_compensation,
                                'voluntarily_compensation_remark' => $voluntarily_compensation_remark,
                                'capital_loss_sec_350' => $capital_loss_sec_350,
                                'capital_loss_sec_350_remark' => $capital_loss_sec_350_remark,
                                'carring_amount' => $carring_amount,
                                'carring_amount_remark' => $carring_amount_remark,
                                'net_profit' =>$net_profit,
                                'profit_from_oversease' => $profit_from_oversease,
                                'dividend_received' => $dividend_received,
                                'amt_adjusted' => $adjustment,
                                'total_net_profit' => $totel_net_profit,
                                'created_at' => strtotime(date('Y-m-d H:i:s')),
                                'updated_at' => strtotime(date('Y-m-d H:i:s'))
                     );
        $this->initCalculation($fy_year,1);
        $this->CsrModel->insert('csr_net_profit_calculator_for_preceeding_years',$info);
        $_SESSION['mode'] = 'calculation';        

        redirect('/CsrCompliance/dashboard/?e_net_worth='.$e_net_worth.'&e_turnover='.$e_turnover);
    }

    /*
    Sanjay Oraon
    Date 12-10-2023
    Already Data Stored

    public function saveCsrNetProfitForProceedingYears($data, $profile_id, $role_id)
    {
        $current_financial_year = $this->current_financial_year;
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;
        $where = array('FY_year' => $current_financial_year, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $checkDB = $this->CsrModel->checkcsrnetprofitfinacialyear($where);
        if (count($checkDB) > 0) {
            $this->updateCsrNetProfitForProceedingYearsFY($data);
        } else {
            //Previous year  1
            $last_financialYears = $this->last_financialYears;
            $last_previous_fy = array('FY_year' => $last_financialYears[0], 'profile_id' => $profile_id, 'role_id' => $role_id);
            $checkfinancial_previous_one = $this->CsrModel->checkcsrfinacialyear($last_previous_fy);

            if ($checkfinancial_previous_one) {
            } else {
                foreach ($data as $key => $value) {
                    if ($value['fy'] == $last_financialYears[0]) {
                        $insertData = [
                            'profile_id' => $profile_id,
                            'role_id' => $role_id,
                            'FY_year' => $value['fy'],
                            'NP_before_tax' => $value['profit_before_tax'],
                            'net_profit' => $value['net_profit'],
                            'amt_adjusted' => $value['amt_adjusted'],
                            'total_net_profit' => ($value['net_profit'] + $value['amt_adjusted'] + $value['profit_before_tax']),
                            'is_auidted_net_profit' => array_key_exists('is_auidted_net_profit', $value) ? $value['is_auidted_net_profit'] : 0,
                            'created_at' => strtotime(date('Y-m-d H:i:s')),
                            'updated_at' => strtotime(date('Y-m-d H:i:s'))
                        ];
                        $this->CsrModel->addCsrNetProfitForProceedingYears($insertData);
                    }
                }
            }
            //Previous year  2
            $last_financialYears = $this->last_financialYears;
            $last_previous_fy = array('FY_year' => $last_financialYears[1], 'profile_id' => $profile_id, 'role_id' => $role_id);
            $checkfinancial_previous_two = $this->CsrModel->checkcsrfinacialyear($last_previous_fy);
            if ($checkfinancial_previous_one) {
            } else {
                foreach ($data as $key => $value) {
                    if ($value['fy'] == $last_financialYears[1]) {
                        $insertData = [
                            'profile_id' => $profile_id,
                            'role_id' => $role_id,
                            'FY_year' => $value['fy'],
                            'NP_before_tax' => $value['profit_before_tax'],
                            'net_profit' => $value['net_profit'],
                            'amt_adjusted' => $value['amt_adjusted'],
                            'total_net_profit' => ($value['net_profit'] + $value['amt_adjusted'] + $value['profit_before_tax']),
                            'is_auidted_net_profit' => array_key_exists('is_auidted_net_profit', $value) ? $value['is_auidted_net_profit'] : 0,
                            'created_at' => strtotime(date('Y-m-d H:i:s')),
                            'updated_at' => strtotime(date('Y-m-d H:i:s'))
                        ];
                        $this->CsrModel->addCsrNetProfitForProceedingYears($insertData);
                    }
                }
            }
            foreach ($data as $key => $value) {
                if ($value['fy'] == $current_financial_year) {
                    $insertData = [
                        'profile_id' => $profile_id,
                        'role_id' => $role_id,
                        'FY_year' => $value['fy'],
                        'NP_before_tax' => $value['profit_before_tax'],
                        'net_profit' => $value['net_profit'],
                        'amt_adjusted' => $value['amt_adjusted'],
                        'total_net_profit' => ($value['net_profit'] + $value['amt_adjusted'] + $value['profit_before_tax']),
                        'is_auidted_net_profit' => array_key_exists('is_auidted_net_profit', $value) ? $value['is_auidted_net_profit'] : 0,
                        'created_at' => strtotime(date('Y-m-d H:i:s')),
                        'updated_at' => strtotime(date('Y-m-d H:i:s'))
                    ];
                    $this->CsrModel->addCsrNetProfitForProceedingYears($insertData);
                }
            }
        }
        return true;
    }
    public function updateCsrNetProfitForProceedingYearsFY($data)
    {
        foreach ($data as $key => $value) {
            if ($value['fy'] == $this->current_financial_year) {
                $updateQuery = [
                    'NP_before_tax' => $value['profit_before_tax'],
                    'net_profit' => $value['net_profit'],
                    'amt_adjusted' => $value['amt_adjusted'],
                    'total_net_profit' => ($value['net_profit'] + $value['amt_adjusted'] + $value['profit_before_tax']),
                    'is_auidted_net_profit' => array_key_exists('is_auidted_net_profit', $value) ? $value['is_auidted_net_profit'] : 0,
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
                $this->CsrModel->updateCsrNetProfitForProceedingYears($value['fy'], $this->profile_id_display, $this->current_active_role, $updateQuery);
            }
        }
    }
    public function saveCSRAmountSetOff($data, $profile_id, $role_id)
    {
        $lastThreeYears = $this->lastThreeYears;
        $current_financial_year = $this->current_financial_year;
        $current_financial_year = explode('-', $current_financial_year);
        $date_full_current_year = "31/03/" . $current_financial_year[0];
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;
        $where = array('FY_year' => $date_full_current_year, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $checkDB = $this->CsrModel->checksaveCSRAmountSetOff($where);

        if (count($checkDB) > 0) {
            $this->updateCSRAmountSetOffFY($data);
        } else {
            //Previous year  1
            $date_full_current_year_one = "31/03/" . $lastThreeYears[1];

            $where = array('FY_year' => $date_full_current_year_one, 'profile_id' => $profile_id, 'role_id' => $role_id);
            $checkfinancial_previous_one = $this->CsrModel->checkcsrsetofffinacialyear($where);
            if (count($checkfinancial_previous_one)) {

            } else {
                if ($data['csr_set_off_amt_amount_avialable'] == 1) {
                    foreach ($data['csr_set_off_amt'] as $key => $value) {
                        if ($value['fy'] == $date_full_current_year_one) {
                            $insertData = [
                                'profile_id' => $profile_id,
                                'role_id' => $role_id,
                                'FY_year' => $value['fy'],
                                'set_off_amt_available' => $value['avaial_amount'],
                                'amt_set_off_in_FY' => $value['setoff_amount'],
                                'balance_set_off' => ($value['avaial_amount'] - $value['setoff_amount']),
                                'created_at' => strtotime(date('Y-m-d H:i:s')),
                                'updated_at' => strtotime(date('Y-m-d H:i:s'))
                            ];
                            $this->CsrModel->saveCsrSetOffAmt($insertData);
                        }
                    }
                }
            }
            //Previous year  2
            $last_financialYears_two = "31/03/" . $lastThreeYears[2];
            $where = array('FY_year' => $last_financialYears_two, 'profile_id' => $profile_id, 'role_id' => $role_id);
            $checkfinancial_previous_two = $this->CsrModel->checkcsrsetofffinacialyear($where);
            if (count($checkfinancial_previous_one)) {
            } else {
                if ($data['csr_set_off_amt_amount_avialable'] == 1) {
                    foreach ($data['csr_set_off_amt'] as $key => $value) {
                        if ($value['fy'] == $checkfinancial_previous_two) {
                            $insertData = [
                                'profile_id' => $profile_id,
                                'role_id' => $role_id,
                                'FY_year' => $value['fy'],
                                'set_off_amt_available' => $value['avaial_amount'],
                                'amt_set_off_in_FY' => $value['setoff_amount'],
                                'balance_set_off' => ($value['avaial_amount'] - $value['setoff_amount']),
                                'created_at' => strtotime(date('Y-m-d H:i:s')),
                                'updated_at' => strtotime(date('Y-m-d H:i:s'))
                            ];
                            $this->CsrModel->saveCsrSetOffAmt($insertData);
                        }
                    }
                }
            }
        }
        if ($data['csr_set_off_amt_amount_avialable'] == 1) {
            foreach ($data['csr_set_off_amt'] as $key => $value) {
                if ($value['fy'] == $date_full_current_year) {
                    $insertData = [
                        'profile_id' => $profile_id,
                        'role_id' => $role_id,
                        'FY_year' => $value['fy'],
                        'set_off_amt_available' => $value['avaial_amount'],
                        'amt_set_off_in_FY' => $value['setoff_amount'],
                        'balance_set_off' => ($value['avaial_amount'] - $value['setoff_amount']),
                        'created_at' => strtotime(date('Y-m-d H:i:s')),
                        'updated_at' => strtotime(date('Y-m-d H:i:s'))
                    ];
                    $this->CsrModel->saveCsrSetOffAmt($insertData);
                }
            }
        }
        return true;
    }*/
    public function saveCSRAmountSetOff()
    {
        $this->isPost();

        $current = explode('-', $this->current_financial_year);

        $amt = $this->input->post('csr_set_off_amt');
        $is = $this->input->post('csr_set_off_amt_amount_avialable');

        foreach($amt as $key => $row){

            $year = "31/03/" . (($key == 0)? ($current[0]-1):(($key == 1)? $current[0]: ($current[0]+1)));
            
            if($is==1){
                $info = array(
                                    'profile_id' => $this->profile_id_display,
                                    'role_id' => $this->current_active_role,
                                    'FY_year' => $year,
                                    'set_off_amt_available' => $row['avaial_amount'],
                                    'amt_set_off_in_FY' => $row['setoff_amount'],
                                    'balance_set_off' => ($row['avaial_amount'] - $row['setoff_amount']),
                                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                            );
            }
            $key = array(
                            'profile_id' => $this->profile_id_display,
                            'role_id' => $this->current_active_role,
                            'FY_year' => $year,
                        );
            $this->CsrModel->delete('csr_set_off_amt',$key);
            if($is==1){
                $this->CsrModel->insert('csr_set_off_amt',$info);
            }
        }
        return true;
    }
    /*public function updateCSRAmountSetOffFY($data)
    {
        $lastThreeYears = $this->lastThreeYears;
        $current_financial_year = $this->current_financial_year;
        $current_financial_year = explode('-', $current_financial_year);
        $date_full_current_year = "31/03/" . $current_financial_year[0];
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;
        if ($data['csr_set_off_amt_amount_avialable'] == 1) {
            foreach ($data['csr_set_off_amt'] as $key => $value) {
                if ($value['fy'] == $date_full_current_year) {
                    $update = [
                        'set_off_amt_available' => $value['avaial_amount'],
                        'amt_set_off_in_FY' => $value['setoff_amount'],
                        'balance_set_off' => ($value['avaial_amount'] - $value['setoff_amount']),
                        'updated_at' => strtotime(date('Y-m-d H:i:s'))
                    ];
                    $this->CsrModel->updateCsrSetOffAmt($date_full_current_year, $this->profile_id_display, $role_id, $update);
                }
            }
        }
    }
    public function saveAmtSpentPertainingThreeYear($data, $profile_id, $role_id)
    {
        $lastThreeYears = $this->lastThreeYears;
        $current_financial_year = $this->current_financial_year;
        $current_financial_year = explode('-', $current_financial_year);
        $date_full_current_year = "31/03/" . $current_financial_year[0];
        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;
        $where = array('FY_year' => $date_full_current_year, 'profile_id' => $profile_id, 'role_id' => $role_id);
        $checkDB = $this->CsrModel->checkAmtSpentPertainingThreeYear($where);
        if (count($checkDB) > 0) {
            $this->updateAmtSpentPertainingThreeYear($data);
        } else {
            //Previous year  1
            $date_full_current_year_one = "31/03/" . $lastThreeYears[1];
            $where = array('FY_year' => $date_full_current_year_one, 'profile_id' => $profile_id, 'role_id' => $role_id);
            $checkfinancial_previous_one = $this->CsrModel->checkAmtSpentPertainingThreeYear($where);
            if (count($checkfinancial_previous_one) > 0) {
            } else {
                foreach ($data as $key => $value) {
                    if ($value['fy'] == $date_full_current_year_one) {
                        $insertData = [
                            'profile_id' => $profile_id,
                            'role_id' => $role_id,
                            'FY_year' => $value['fy'],
                            'amt_transferred_to_CSR_account' => $value['amt_transferred_to_CSR_account'],
                            'balance_amt_in_CSR_account' => $value['balance_amt_in_CSR_account'],
                            'amt_spent_in_FY' => $value['amt_spent_in_FY'],
                            'amt_transferred_to_fund_account' => $value['amt_transferred_to_fund_account'],
                            'date_of_transferred_to_fund_account' => $value['date_of_transferred_to_fund_account'],
                            'amt_remaining_to_spent' => $value['amt_remaining_to_spent'],
                            'deficiency' => $value['deficiency'],
                            'created_at' => strtotime(date('Y-m-d H:i:s')),
                            'updated_at' => strtotime(date('Y-m-d H:i:s')),
                        ];
                        $this->CsrModel->saveAmtSpentPertainingThreeYear($insertData);
                    }
                }
            }
            //Previous year  2
            $last_financialYears_two = "31/03/" . $lastThreeYears[2];
            $where = array('FY_year' => $last_financialYears_two, 'profile_id', $profile_id, 'role_id' => $role_id);
            $checkfinancial_previous_two = $this->CsrModel->checkAmtSpentPertainingThreeYear($where);
            if (count($checkfinancial_previous_one)) {
            } else {
                foreach ($data as $key => $value) {
                    if ($value['fy'] == $last_financialYears_two) {
                        $insertData = [
                            'profile_id' => $profile_id,
                            'role_id' => $role_id,
                            'FY_year' => $value['fy'],
                            'amt_transferred_to_CSR_account' => $value['amt_transferred_to_CSR_account'],
                            'balance_amt_in_CSR_account' => $value['balance_amt_in_CSR_account'],
                            'amt_spent_in_FY' => $value['amt_spent_in_FY'],
                            'amt_transferred_to_fund_account' => $value['amt_transferred_to_fund_account'],
                            'date_of_transferred_to_fund_account' => $value['date_of_transferred_to_fund_account'],
                            'amt_remaining_to_spent' => $value['amt_remaining_to_spent'],
                            'deficiency' => $value['deficiency'],
                            'created_at' => strtotime(date('Y-m-d H:i:s')),
                            'updated_at' => strtotime(date('Y-m-d H:i:s')),
                        ];
                        $this->CsrModel->saveAmtSpentPertainingThreeYear($insertData);
                    }
                }
            }
        }
        foreach ($data as $key => $value) {
            if ($value['fy'] == $date_full_current_year) {
                $insertData = [
                    'profile_id' => $profile_id,
                    'role_id' => $role_id,
                    'FY_year' => $value['fy'],
                    'amt_transferred_to_CSR_account' => $value['amt_transferred_to_CSR_account'],
                    'balance_amt_in_CSR_account' => $value['balance_amt_in_CSR_account'],
                    'amt_spent_in_FY' => $value['amt_spent_in_FY'],
                    'amt_transferred_to_fund_account' => $value['amt_transferred_to_fund_account'],
                    'date_of_transferred_to_fund_account' => $value['date_of_transferred_to_fund_account'],
                    'amt_remaining_to_spent' => $value['amt_remaining_to_spent'],
                    'deficiency' => $value['deficiency'],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s')),
                ];
                $this->CsrModel->saveAmtSpentPertainingThreeYear($insertData);
            }
        }
        return true;
    }*/
    public function saveAmtSpentPertainingThreeYear()
    {
        $this->isPost();
        $current = explode('-', $this->current_financial_year);

        $year = $this->input->post('pertaining_three_years');
        $is = $this->input->post('is_unspent_for_preceeding_3_years_after_22_Jan_21');

        foreach($year as $key => $row){
            $year = "31/03/" . (($key == 0)? ($current[0]-2):(($key == 1)? ($current[0]-1): $current[0]));
            
            if($is==1){
                $info = array(
                                    'profile_id' => $this->profile_id_display,
                                    'role_id' => $this->current_active_role,
                                    'FY_year' => $year,
                                    'amt_transferred_to_CSR_account' => $row['amt_transferred_to_CSR_account'],
                                    'balance_amt_in_CSR_account' => $row['balance_amt_in_CSR_account'],
                                    'amt_spent_in_FY' => $row['amt_spent_in_FY'],
                                    'amt_transferred_to_fund_account' => $row['amt_transferred_to_fund_account'],
                                    'date_of_transferred_to_fund_account' => $row['date_of_transferred_to_fund_account'],
                                    'amt_remaining_to_spent' => $row['amt_remaining_to_spent'],
                                    'deficiency' => $row['deficiency'],
                                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                            );
            }
            $key = array(
                            'profile_id' => $this->profile_id_display,
                            'role_id' => $this->current_active_role,
                            'FY_year' => $year,
                        );
            $this->CsrModel->delete('csr_amt_spent_pertaining_3_years',$key);
            if($is==1){
                $this->CsrModel->insert('csr_amt_spent_pertaining_3_years',$info);
            }
        }
        return true;
    }
    /*public function updateAmtSpentPertainingThreeYear($data)
    {
        $lastThreeYears = $this->lastThreeYears;
        $current_financial_year = $this->current_financial_year;
        $current_financial_year = explode('-', $current_financial_year);
        $date_full_current_year = "31/03/" . $current_financial_year[0];
        foreach ($data as $key => $value) {
            if ($value['fy'] == $date_full_current_year) {
                $Update = [
                    'amt_transferred_to_CSR_account' => $value['amt_transferred_to_CSR_account'],
                    'balance_amt_in_CSR_account' => $value['balance_amt_in_CSR_account'],
                    'amt_spent_in_FY' => $value['amt_spent_in_FY'],
                    'amt_transferred_to_fund_account' => $value['amt_transferred_to_fund_account'],
                    'date_of_transferred_to_fund_account' => $value['date_of_transferred_to_fund_account'],
                    'amt_remaining_to_spent' => $value['amt_remaining_to_spent'],
                    'deficiency' => $value['deficiency'],
                    'updated_at' => strtotime(date('Y-m-d H:i:s')),
                ];
                $this->CsrModel->updateAmtSpentPertainingThreeYear($value['fy'], $this->profile_id_display, $this->current_active_role, $Update);
            }
        }
        return true;
    }
    public function saveOngoingProjectProceedingYearDetail($data, $profile_id, $role_id)
    {
        $where = array('profile_id' => $profile_id, 'role_id' => $role_id);
        $checkDB = $this->CsrModel->CheckOngoingProjectProceedingYearDetail($where);
        if (count($checkDB) > 0) {
            foreach ($data as $key => $value) {
                if (isset($value['row_id'])) {
                    $update = [
                        'project_id' => $value['project_id'],
                        'project_name' => $value['project_name'],
                        'FY_year_project_commenced' => $value['FY_year_project_commenced'],
                        'amt_spent_start_of_year' => $value['amt_spent_start_of_year'],
                        'amt_spent_in_year' => $value['amt_spent_in_year'],
                        'project_status' => $value['project_status'],
                        'updated_at' => strtotime(date('Y-m-d H:i:s'))
                    ];
                    $this->CsrModel->updateOngoingProjectProceedingYearDetail($value['row_id'], $profile_id, $role_id, $update);
                } else {
                    $insertData = [
                        'profile_id' => $profile_id,
                        'role_id' => $role_id,
                        'project_id' => $value['project_id'],
                        'project_name' => $value['project_name'],
                        'FY_year_project_commenced' => $value['FY_year_project_commenced'],
                        'amt_spent_start_of_year' => $value['amt_spent_start_of_year'],
                        'amt_spent_in_year' => $value['amt_spent_in_year'],
                        'project_status' => $value['project_status'],
                        'created_at' => strtotime(date('Y-m-d H:i:s')),
                        'updated_at' => strtotime(date('Y-m-d H:i:s'))
                    ];
                    $this->CsrModel->saveOngoingProjectProceedingYearDetail($insertData);
                }
            }
        } else {
            foreach ($data as $key => $value) {
                $insertData = [
                    'profile_id' => $profile_id,
                    'role_id' => $role_id,
                    'project_id' => $value['project_id'],
                    'project_name' => $value['project_name'],
                    'FY_year_project_commenced' => $value['FY_year_project_commenced'],
                    'amt_spent_start_of_year' => $value['amt_spent_start_of_year'],
                    'amt_spent_in_year' => $value['amt_spent_in_year'],
                    'project_status' => $value['project_status'],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
                $this->CsrModel->saveOngoingProjectProceedingYearDetail($insertData);
            }
        }
        return true;
    }
    */
    public function saveOngoingProjectProceedingYearDetail()
    {
        $this->isPost();
        $project = $this->input->post('project_id');
        $project_name = $this->input->post('project_name');
        $FY_year_project_commenced = $this->input->post('FY_year_project_commenced');
        $amt_spent_start_of_year = $this->input->post('amt_spent_start_of_year');
        $amt_spent_in_year = $this->input->post('amt_spent_in_year');
        $commutative_amt_spent = $this->input->post('commutative_amt_spent');
        $project_status = $this->input->post('project_status');
        $is = $this->input->post('is_unspent_for_preceeding_3_years_after_22_Jan_21');

        $key = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
        );
        $this->CsrModel->delete('csr_ongoing_projects_preceeding_year_details',$key);
        if($is==1){
            foreach($project as $key => $row){
                
                $info = array(
                                    'profile_id' => $this->profile_id_display,
                                    'role_id' => $this->current_active_role,
                                    'project_id' => $row,
                                    'project_name' => $project_name[$key],
                                    'FY_year_project_commenced' => $FY_year_project_commenced[$key],
                                    'amt_spent_start_of_year' => $amt_spent_start_of_year[$key],
                                    'amt_spent_in_year' => $amt_spent_in_year[$key],
                                    'commutative_amt_spent' => $commutative_amt_spent[$key],
                                    'project_status' => $project_status[$key],
                                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                            );
                $this->CsrModel->insert('csr_ongoing_projects_preceeding_year_details',$info);
            }
        }
        return true;
    }
    public function saveCommitteDetails()
    {
        $this->isPost();

        $profile_id = $this->profile_id_display;
        $role_id = $this->current_active_role;

        $complianceData = $this->CsrModel->getCsrComplainceByUserIdAndRole($profile_id, $role_id, $this->getFinancialYear());
        $update_data = [
            'CSR_committee_constituted' => $_POST['is_committee_constituted'],
            'no_of_CSR_directors' => $_POST['csr_commitee_compostion_directors_count'],
            'date_of_constitution' => $_POST['csr_commitee_constitution_date']
        ];
        $this->CsrModel->updateCsrTwoObligationFormData($complianceData->id, $update_data);


        $name = $this->input->post('csr_commitee_compostion_name_of_director');
        $postion = $this->input->post('csr_commitee_compostion_postion');
        $din = $this->input->post('csr_commitee_compostion_din');
        $category = $this->input->post('csr_commitee_compostion_category');
        $appointment = $this->input->post('csr_commitee_compostion_date_of_appointment');

        $key = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
        );
        $this->CsrModel->delete('csr_committee_details',$key);

        foreach($name as $key => $row){
            
            $info = array(
                                'profile_id' => $this->profile_id_display,
                                'role_id' => $this->current_active_role,
                                'name_of_director' => $row,
                                'postion' => $postion[$key],
                                'DIN' => $din[$key],
                                'category' => $category[$key],
                                'date_of_appointment' => $appointment[$key],
                                'created_at' => strtotime(date('Y-m-d H:i:s')),
                                'updated_at' => strtotime(date('Y-m-d H:i:s'))
                        );
            $this->CsrModel->insert('csr_committee_details',$info);
        }
   
        redirect('CsrCompliance/dashboard?tab=annual-tab');
    }

    public function getFinancialYear()
    {
        $current_year = date('Y');
        $current_month = date('n');
        if ($current_month >= 4) {
            $start_year = $current_year;
            $end_year = $current_year + 1;
        } else {
            $start_year = $current_year - 1;
            $end_year = $current_year;
        }
        $current_financial_year = ($start_year-1) . '-' . ($end_year-1);
        return $current_financial_year;
    }


    public function saveAnnualDetail()
    {
        $schedule_dates = $this->input->post('csr_annual_action_plan_schedule_date');
        $this->isPost();

        $year = $this->input->post('year');
        $name = $this->input->post('csr_annual_action_plan_project_name');
        $location = $this->input->post('csr_annual_action_plan_project_location');
        $sectors = $this->input->post('csr_annual_action_plan_sectors');
        $budget = $this->input->post('csr_annual_action_plan_budgeted_amt');
        $utilisation = $this->input->post('csr_annual_action_plan_utilisation');
        $manner = $this->input->post('csr_annual_action_plan_execution_manner');
        $reporting = $this->input->post('csr_annual_action_plan_monitoring_n_reporting');
        $assessment = $this->input->post('csr_annual_action_plan_details_of_impact_assessment');
        $type = $this->input->post('csr_annual_action_plan_project_type');

        $key = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role,
            'FY_year' => $year
        );
        $this->CsrModel->delete('csr_annual_action_plan',$key);

        foreach ($name as $key => $row) {
            $l = explode(',', $location[$key]);
            $info = array(
                'profile_id' => $this->profile_id_display,
                'role_id' => $this->current_active_role,
                'FY_year' => $year,
                'project_name' => $row,
                'project_location_state' => $l[1],
                'project_location_district' => $l[0],
                'sectors' => $sectors[$key],
                'budgeted_amt' => $budget[$key],
                'modalities_of_funds_utilisation' => $utilisation[$key],
                'execution_manner' => $manner[$key],
                //'implementation_schedule_date' => $schedule_dates[$key],
                'monitoring_n_reporting' => $reporting[$key],
                'details_of_impact_assessment' => $assessment[$key],
                'project_type' => $type[$key],
                
                'created_at' => strtotime(date('Y-m-d H:i:s')),
                'updated_at' => strtotime(date('Y-m-d H:i:s'))
            );
            $this->CsrModel->insert('csr_annual_action_plan', $info);
        }
        
        $this->load->library('session');
   
        redirect('CsrCompliance/dashboard');
    }

    /*public function saveAnnualDetail()
    {
        $user_id = $_SESSION['UserId'];
        if (empty($user_id)) {
            redirect(base_url());
        }

        $user_profile = $this->db->select('profile_id_display, current_active_role')
            ->get_where('users', array('id' => $user_id))
            ->row();
        $profile_id = $user_profile->profile_id_display;
        $role_id = $user_profile->current_active_role;

        foreach ($_POST['csr_annual_action_plan'] as $key => $value) {




            if (isset($value['row_id'])) {

                $current_financial_year = $this->current_financial_year;
                $profile_id = $this->profile_id_display;
                $role_id = $this->current_active_role;
                
                $updateData = [
                    'project_name' => $value['project_name'],
                    'project_location_state' => $value['project_location_state'],
                    'project_location_district' => 0,
                    'sectors' => $value['sectors'],
                    'budgeted_amt' => $value['budgeted_amt'],
                    'modalities_of_funds_utilisation' => $value['modalities_of_funds_utilisation'],
                    'execution_manner' => $value['execution_manner'],
                    'scheduled_date' => $value['scheduled_date'],
                    'monitoring_n_reporting' => $value['monitoring_n_reporting'],
                    'details_of_impact_assessment' => $value['details_of_impact_assessment'],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
                $this->CsrModel->updateCsrAnnualPlan($value['row_id'], $profile_id, $current_financial_year, $role_id, $updateData);


            } else {
                $insertData = [
                    'profile_id' => $profile_id,
                    'role_id' => $role_id,
                    'FY_year' => $this->getFinancialYear(),
                    'project_name' => $value['project_name'],
                    'project_location_state' => $value['project_location_state'],
                    'project_location_district' => 0,
                    'sectors' => $value['sectors'],
                    'budgeted_amt' => $value['budgeted_amt'],
                    'modalities_of_funds_utilisation' => $value['modalities_of_funds_utilisation'],
                    'execution_manner' => $value['execution_manner'],
                    'scheduled_date' => $value['scheduled_date'],
                    'monitoring_n_reporting' => $value['monitoring_n_reporting'],
                    'details_of_impact_assessment' => $value['details_of_impact_assessment'],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];
                $this->CsrModel->saveCsrAnnualPlan($insertData);
            }
        }
        redirect('CsrCompliance/dashboard');
    }*/

    //Reports create and preview function start from here...
    public function fyclosingreport()
    {
        $data = [];
        $where = array(
            'profile_id' => $this->profile_id_display,
            'role_id' => $this->current_active_role
        );

        $comitte_details = $this->CsrModel->getCommitteDetails($where);
        $comitte_details ? $data['comitte_details'] = $comitte_details : $data;

        $pertaining_year = $this->CsrModel->get_csr_amt_spent_pertaining_three_years($where);

        // echo "<pre>";
        // print_r($pertaining_year);
        // die;

        $this->load->view('/CsrCompliance/fyclosingreport', $data);
    }

    public function createCsrReportStepOne()
    {
        if ($_POST) {
            echo "<pre>";
            $meetings_data = $_POST['csr_committe'];
            foreach ($meetings_data as $key => $value) {
                $insert = [
                    'profile_id' => $this->profile_id_display,
                    'role_id' => $this->current_active_role,
                    'FY_year' => $this->current_financial_year,
                    'committee_member_id' => $value['csr_committe_id'],
                    'meetings_attended_in_year' => $value['meetings_count'],
                    'updated_at' => strtotime(date('Y-m-d H:i:s')),
                    'created_at' => strtotime(date('Y-m-d H:i:s'))
                ];
                // $this->CsrModel->saveCsrCommitteMeetings($insert);
            }
            print_r($_POST);


            die;
        }
    }

    public function storeDirectorReport()
    {
        $this->isLogin();
        $this->isPost();


        $reportYear = $this->reportYear();

        if(isset($reportYear) && !empty($reportYear)){
            $data['prime_year'] = $reportYear;
        }else{
            $data['prime_year'] = $this->prime_year;
        }
    
        $report = $this->CsrModel->getDirectorReport($this->profile_id_display,$data['prime_year'],2,3);

        $files = $_FILES;

        $info = [
                'profile_id' => $this->profile_id_display,
                'report_type' => 3,
                'report_status' => (int) $_POST['report_status'],
                'submit_date' => strtotime(date('Y-m-d H:i:s')),
                'contributor_ids' => $this->current_active_role,
                'updated_at' => strtotime(date('Y-m-d H:i:s')),
                'created_at' => strtotime(date('Y-m-d H:i:s')),
        ];
        if($report){
            $report_id = $report->id;
            $this->CommonModel->update('reports', array('id' => $report->id),$info);
            $this->CsrModel->delete('csr2_directors_report_project', array('dir_report_id' => $report_id));
        }else{
            $report_id = $this->ReportModel->createProjectReport($info);
        }

        $info = [
            'report_id' => $report_id,
            'FY_year' => $data['prime_year'],
            'brief_about_director_report' => $_POST['brief_about_director_report'],
            'amt_unspent_for_FY' => $_POST['amt_unspent_for_FY'],
            'reason_failed_to_csr_spend_director_report' => $_POST['reason_failed_to_csr_spend_director_report'],
            'sdgs' => (isset($_POST['sdgs_pref']))?implode(',', $_POST['sdgs_pref']):NULL,
            'created_at' => strtotime(date('Y-m-d H:i:s')),
            'updated_at' => strtotime(date('Y-m-d H:i:s'))
        ];

        if($report){
            $this->CommonModel->update('csr2_directors_report', array('report_id' => $report_id),$info);
        }else{
            $this->ReportModel->createDirectorReport($info);
        }

        $name = $this->input->post('project_activity_name');
        $project_type = $this->input->post('project_type');
        $sector = $this->input->post('sector');
        $is_project_location_local = $this->input->post('is_project_location_local');
        $project_location_state = $this->input->post('project_location_state');
        $project_outlay_amt = $this->input->post('project_outlay_amt');
        $direct_expenditure = $this->input->post('direct_expenditure');
        $overheads = $this->input->post('overheads');
        $cumulative_expense = $this->input->post('cumulative_expense');
        $is_direct_implementation_dir_report = $this->input->post('is_direct_implementation_dir_report');

        foreach ($name as $key => $value) {
            $director_report_insert = [
                'dir_report_id' => $report_id,
                'project_activity_name' => $value,
                'project_type' => $project_type[$key],
                'sector' => $sector[$key],
                'is_project_location_local' => $is_project_location_local[$key],
                'project_location_state' => $project_location_state[$key],
                'project_outlay_amt' => $project_outlay_amt[$key],
                'direct_expenditure' => $direct_expenditure[$key],
                'overheads' => $overheads[$key],
                'cumulative_expense' => $cumulative_expense[$key],
                'is_direct_implementation_dir_report' => $is_direct_implementation_dir_report[$key],
                'created_at' => strtotime(date('Y-m-d H:i:s')),
                'updated_at' => strtotime(date('Y-m-d H:i:s'))
            ];
            $this->ReportModel->createDirectorReportProject($director_report_insert);
        }

        $store_image = array();
        
        foreach ($files['case_study_image']['name'] as $key => $row) {
            if(!$row)
                continue;
            $return = $this->fileUpload($files,CSR_COMPLIANCE_DOCUMENTS,'case_study_image',$key);
            if($return){
                $info = array('path' => CSR_COMPLIANCE_CASE_STUDY.''.$return,'created_at' => strtotime(date('Y-m-d H:i:s')),'updated_at' => strtotime(date('Y-m-d H:i:s')));
                $uid = $this->CsrModel->insert('media',$info);
                if($uid)
                    array_push($store_image,$uid);
            }
        }

        $info = [
            'project_report_id' => $report_id,
            'case_study_title' => $_POST['case_study_title'],
            'case_study' => $_POST['case_study'],
            'conclusion' => $_POST['conclusion'],
            'created_at' => strtotime(date('Y-m-d H:i:s')),
            'updated_at' => strtotime(date('Y-m-d H:i:s'))
        ];
       
        if($report){
            $case_study_file = explode(',',$this->input->post('case_study_file'));
            $case_study_file_removed = explode(',',$this->input->post('case_study_file_removed'));
            foreach($case_study_file as $row){
                if(in_array($row,$case_study_file_removed)){
                    $return = $this->CommonModel->TblSelectedRecords('media','id,path',array('id' => $row));
                    $this->CsrModel->delete('media', array('id' => $row));
                    if($return)
                        unlink($return->path);
                }else{
                    array_push($store_image,$row);
                }
            }
            $info += ['case_study_image' => (isset($store_image))?implode(',',$store_image):NULL];
            $this->CommonModel->update('project_report_case_studies', array('project_report_id' => $report_id),$info);
        }else{
            $info += ['case_study_image' => (isset($store_image))?implode(',',$store_image):NULL];
            $this->ReportModel->createReportCaseStudies($info);
        }

        $person_id = $this->input->post('person_id');
        $person_name = $this->input->post('person_name');
        $person_designation = $this->input->post('person_designation');
        $person_organisation = $this->input->post('person_organisation');
        $testimonial_description = $this->input->post('testimonial_description');

        if($report_id && isset($person_id)){
            $return = $this->CommonModel->TblAllRecords('report_testimonials','id,person_image',array('report_id' => $report_id));
            foreach($return as $row){
                if(!in_array($row->id,$person_id)){
                    $this->CsrModel->delete('report_testimonials', array('id' => $row->id));
                    if($row->person_image)
                        unlink(CSR_COMPLIANCE_CASE_STUDY.''.$row->person_image);
                }
            }
        }
        foreach ($person_name as $key => $row) {
            if ($row && $person_designation[$key] && $person_organisation[$key] && $testimonial_description[$key]) {
                if(!empty($files['person_image']['name'][$key]))
                    $person_image = $this->fileUpload($files,CSR_COMPLIANCE_DOCUMENTS,'person_image',$key);
                else
                    $person_image = null;

                $info = [
                    'report_id' => $report_id,
                    'person_name' => $row,
                    'person_designation' => $person_designation[$key],
                    'person_organisation' => $person_organisation[$key],
                    'testimonial_description' => $testimonial_description[$key],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ];

                if(isset($person_id[$key])){
                    if($person_image){
                        $return = $this->CommonModel->TblSelectedRecords('report_testimonials','person_image',array('id' => $person_id[$key]));
                        if($return)
                            unlink(CSR_COMPLIANCE_CASE_STUDY.''.$return->person_image);
                        $info += ['person_image' => $person_image];
                    }
                    $this->CommonModel->update('report_testimonials', array('id' => $person_id[$key]),$info);
                }else{
                    $info += ['person_image' => $person_image];
                    $this->ReportModel->saveTestimonials($info);
                }
            }
        }
        if ($_POST['report_status'] == 3) {
            redirect('CsrCompliance/previewreport?year=' . $data['prime_year'] . '&report_id=' . $report_id);
        }
        redirect('CsrCompliance/dashboard');
    }
    public function fileUpload($files,$dir,$file,$key){
                if (isset($files[$file]['name'][$key])){
                    $fileName = $files[$file]['name'][$key];
                    $_FILES[$file]['name']= $files[$file]['name'][$key];
                    $_FILES[$file]['type']= $files[$file]['type'][$key];
                    $_FILES[$file]['tmp_name']= $files[$file]['tmp_name'][$key];
                    $_FILES[$file]['error']= $files[$file]['error'][$key];
                    $_FILES[$file]['size']= $files[$file]['size'][$key];
                    
                    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $name = $this->profile_id_display . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
                    $config['upload_path'] = $dir;
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = MAX_FILESIZE_BYTE;
                    $config['file_name'] = $this->profile_id_display . '-' . strtotime(date('Y-m-d H:i:s'));
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload($file)) {
                        $info = $this->upload->data();
                        $name = $info['file_name'];
                    }else{
                        $error = array('upload_error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error',  $error['upload_error']); 
                        echo $files[$file]['name'][$key].' '.$error['upload_error']; exit;
                    }
                }else{
                        $name = '';
                }
                return $name;
    }
    public function progressreport()
    {
        $this->load->view('csrcompliance/progressreport');
    }
    public function isPost()
    {
        if(!$_POST)
            redirect('/');
    }
    public function downloadPdf(){

        $year = $this->input->get('fy');
        if(!$year)
            redirect('CsrCompliance/dashboard');
        $this->load->library('pdf');
        $key = array('profile_id' => $this->profile_id_display, 'role_id' => $this->current_active_role,'FY_year' => $year);
        $data['calculation'] = $this->CommonModel->TblRecords('csr_net_profit_calculator_for_preceeding_years',1,null,$key,null,null);
        if(!$data['calculation'])
            redirect('CsrCompliance/dashboard');
        $html = $this->load->view('csrcompliance/pdf/computation',$data,true);
        $this->pdf->download($html, 'Computation-'.$year, false);
    
    }
}


?>