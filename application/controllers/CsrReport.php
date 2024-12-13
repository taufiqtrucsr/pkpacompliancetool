<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CsrCompliance extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CompanyModel');
        $this->load->model('UserModel');
        $this->load->model('CommonModel');
        $this->load->model('NgoModel');
        $this->load->model('CsrModel');
        $user_id = $_SESSION['UserId'];

        $user_profile = $this->db->select('profile_id_display, current_active_role')
            ->get_where('users', array('id' => $user_id))
            ->row();

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
        $this->current_financial_year = $start_year . '-' . $end_year;

        $financialYears = array();
        // Calculate the last three financial years
        for ($i = 0; $i < 2; $i++) {
            $startYear = $current_year - $i - 1;
            $endYear = $current_year - $i;
            $last_financialYears[] = $startYear . '-' . $endYear;
        }
        $this->last_financialYears = $last_financialYears;
        $this->lastThreeYears = array($current_year - 3, $current_year - 2, $current_year - 1);

    }


    public function createDirectorReport(){
        echo "<pre>";
        print_r($_POST);
        die;
    }
}
?>