<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
?>
<?php $this->load->view('common/head_common');


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
$current_financial_year = $start_year . '-' . $end_year;
$curernt = date("Y");
$last = date("Y", strtotime("-1 year"));
$financialYears = array();
// Calculate the last three financial years
for ($i = 0; $i < 2; $i++) {
  $startYear = $current_year - $i - 1;
  $endYear = $current_year - $i;
  $financialYears[] = $startYear . '-' . $endYear;
}
$lastThreeYears = array($current_year - 3, $current_year - 2, $current_year - 1);

?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />

<body class="full-page">
  <?php $this->load->view('common/header'); ?>
  <div class="container">
    <div id="fyendreport">
      <div class="kyc-title">
        <h2>FY End CSR-2 Info</h2>
      </div>
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
            <a href="#" id="fy-step-1-btn" type="button" class="btn btn-primary btn-circle"><span
                class="step-count">01</span> Add Details</a>
          </div>

          <div class="stepwizard-step">
            <a href="#" id="fy-step-2-btn" type="button" class="btn btn-default btn-circle"><span
                class="step-count">02</span> Preview & Download</a>
          </div>

        </div>
      </div>

      <form method="post" action="<?php echo base_url() . "CsrCompliance/createCsrReportStepOne" ?>"
        enctype="multipart/form-data">
        <div id="fy-step-1-btn">
          <p>This report is based on projects funded by you as contributor through the platform. Any addtional projects
            either as direct implementation or through an implementing agency outside the platform needs to be added in
            this report before submission on MCA portal </p>
          <div class="thruout_year">
            <div class="col-md-8">
              <div class="row">
                <label class="control-label">Additional Details related to CSR activities conducted throughout the
                  year:</label>
                <p><label>Number of meetings of CSR Committee held during the year attended by director: * </label></p>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" style=" width: 100px; ">
                        Sr. No
                      </th>
                      <th scope="col">
                        DIN
                      </th>
                      <th scope="col">
                        Name of Director
                      </th>
                      <th scope="col">
                        Category
                      </th>
                      <th scope="col">
                        No. of meetings of CSR Committee attended during the year
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($comitte_details as $key => $value) {
                      echo ' <tr>
                        <th scope="row">' . ($key + 1) . '</th>
                        <input type="hidden" value="' . $value->id . '" name="csr_committe[' . $key . '][csr_committe_id]">
                        <td> <input type="text" class="form-control"  name="csr_committe[' . $key . '][din]" value="' . $value->DIN . '"> </td>
                        <td> <input type="text" class="form-control"  name="csr_committe[' . $key . '][director]" value="' . $value->name_of_director . '"> </td>
                        <td> <input type="text" class="form-control"  name="csr_committe[' . $key . '][category]" value="' . $value->category . '"> </td>
                        <td> <input type="text" class="form-control"  name="csr_committe[' . $key . '][meetings_count]" value="">
                        </td>
                    </tr>';
                    } ?>
                  </tbody>
                </table>
                <div class="csrpolicy">
                  <div class="row">
                    <div class="col-sm-8">
                      <h2>Whether Impact assessment of CSR projects is carried out in pursuance of sub-rule (3) of Rule
                        8
                        of Companies (CSR Policy) Rules,2014, if applicable * </h2>
                      <div class="yn">
                        <input type="radio" id="yes" name="add_csr_details[csr_assesment_impact]" value="Yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="add_csr_details[csr_assesment_impact]" value="No">
                        <label for="no">No</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <h2>Whether the same has been disclosed in the Board Report * </h2>
                      <div class="yn">
                        <input type="radio" id="yes" name="add_csr_details[board_report_status]" value="Yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="add_csr_details[board_report_status]" value="No">
                        <label for="no">No</label>
                      </div>
                    </div>
                    <div class="form-group col-sm-6 ctcsr" style="display: table;margin-top:20px">
                      <p class="control-label" style="margin-bottom:10px">Number of Ongoing Projects for the financial
                        year: </p>
                      <input placeholder="" type="text" class="form-control link-pol" id=""=""
                        name="add_csr_details[report_link]" value="" aria-="true" style=" width: 100%; ">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="previous_year">
            <div class="col-lg-12">
              <div class="row">
                <label class="control-label" style="color:#000; margin-bottom:20px;">Details of CSR amount spent against
                  projects for the financial year: 2021-2022 (Projects started in Previous Year)</label>
                <div class="csrpolicy">
                  <div class="row-1">
                    <div class="col-sm-4">
                      <h2>Whether CSR amount for the financial year has been spent:</h2>
                      <div class="yn">
                        <label for="yes">Yes</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <h2>CSR amount has been spent against:</h2>
                      <div class="yn">
                        <label for="yes">Both (Ongoing and other than ongoing projects)</label>
                      </div>
                    </div>
                  </div>
                  <div class="ongoing_projects">
                    <div class="col-lg-12">
                      <div class="row">
                        <label class="control-label"
                          style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details
                          for <b>ONGOING</b> projects : 2021-2022 * </label>

                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                          <p class="control-label" style="margin-bottom:0px">Number of Ongoing Projects for the
                            financial
                            year: <span style="margin-left:10px;">02</span></p>
                          <table class="table" style="margin-top:10px">
                            <thead>
                              <tr>
                                <th scope="col" style=" width: 110px; ">
                                  Sr. No
                                </th>
                                <th scope="col">
                                  Project ID
                                </th>
                                <th scope="col">
                                  Item from the list of activities in schedule VII
                                </th>
                                <th scope="col">
                                  Project Name
                                </th>
                                <th scope="col">
                                  Local Area Y/N
                                </th>
                                <th scope="col" style="width: 200px;">
                                  Project Location (State)
                                </th>
                                <th scope="col">
                                  Project Location (District)
                                </th>
                                <th scope="col">
                                  Project Duration (Months)
                                </th>
                                <th scope="col">
                                  Amt. spent in the FY (₹ Lakhs)
                                </th>
                                <th scope="col">
                                  Direct Implementation (Y/N)
                                </th>
                                <th scope="col" style="width: 200px;">
                                  CSR Registr ation No. (Agency)
                                </th>
                                <th scope="col">
                                  Name (Agency)
                                </th>
                              </tr>
                            </thead>
                            <tbody class="ongoing_porjects_row">
                              <tr>
                                <th scope="row">1</th>
                                <td> <input type="text" name="ongoing_porject[0][project_id]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][activities]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][project_name]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][local_area]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][state]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][district]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][months]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][amt_spent]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][dir_implementation]"
                                    class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][reg_no]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][agency_name]" class="form-control">
                                </td>
                              </tr>

                            </tbody>
                          </table>
                          <div class="col-sm-12-">
                            <div class="row">
                              <div class="form-group col-sm-6-" style="text-align: left;">
                                <a href="javascript:void()" class="btn addmore add-more-projects"> <span>+</span> Add
                                  details of other projects</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="ongoing_projects">
                    <div class="col-lg-12">
                      <div class="row">
                        <label class="control-label"
                          style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details
                          for <b>ONGOING</b> projects : 2021-2022 * </label>

                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                          <p class="control-label" style="margin-bottom:0px">Number of Ongoing Projects for the
                            financial
                            year: <span style="margin-left:10px;">02</span></p>
                          <table class="table" style="margin-top:10px">
                            <thead>
                              <tr>
                                <th scope="col" style=" width: 110px; ">
                                  Sr. No
                                </th>
                                <th scope="col">
                                  Project ID
                                </th>
                                <th scope="col">
                                  Item from the list of activities in schedule VII
                                </th>
                                <th scope="col">
                                  Project Name
                                </th>
                                <th scope="col">
                                  Local Area Y/N
                                </th>
                                <th scope="col" style="width: 200px;">
                                  Project Location (State)
                                </th>
                                <th scope="col">
                                  Project Location (District)
                                </th>
                                <th scope="col">
                                  Project Duration (Months)
                                </th>
                                <th scope="col">
                                  Amt. spent in the FY (₹ Lakhs)
                                </th>
                                <th scope="col">
                                  Direct Implementation (Y/N)
                                </th>
                                <th scope="col" style="width: 200px;">
                                  CSR Registr ation No. (Agency)
                                </th>
                                <th scope="col">
                                  Name (Agency)
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                            <tbody class="ongoing_porjects_row">
                              <tr>
                                <th scope="row">1</th>
                                <td> <input type="text" name="ongoing_porject[0][project_id]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][activities]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][project_name]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][local_area]" class="form-control">
                                </td>
                                <td> <input type="text" name="ongoing_porject[0][state]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][district]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][months]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][amt_spent]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][dir_implementation]"
                                    class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][reg_no]" class="form-control"> </td>
                                <td> <input type="text" name="ongoing_porject[0][agency_name]" class="form-control">
                                </td>
                              </tr>
                            </tbody>

                            </tbody>
                          </table>
                          <div class="col-sm-12-">
                            <div class="row">
                              <div class="form-group col-sm-6-" style="text-align: left;">
                                <a href="javascript:void()" class="btn addmore add-more-projects"> <span>+</span> Add
                                  details of other projects</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 amount_spent">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group col-sm-12 ctcsr" style="display: table;">
                              <label class="control-label">Amount spent in Administrative Overheads * </label>
                              <input placeholder="2,00,000" type="text" class="form-control link-pol" id=""=""
                                name="amt_spent_adminstrative" value="₹ 2,00,000" aria-="true">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group col-sm-12 ctcsr" style="display: table;">
                              <label class="control-label">Amount spent on Impact Assessment, if applicable: * </label>
                              <input placeholder="₹ 0" type="text" class="form-control link-pol" id=""=""
                                name="amt_spent_impact" value="₹ 0" aria-="true">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group col-sm-12 ctcsr" style="display: table;">
                              <label class="control-label">Total amount spent for Financial Year:</label>
                              <input placeholder="₹ 20,00,000" type="text" class="form-control link-pol" id=""=""
                                name="total_amt" value="" aria-="true">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group col-sm-12 ctcsr" style="display: table;">
                              <label class="control-label">Amount unspent/ (excess) spent for the Financial Year
                                (unspent
                                for Ongoing projects) * </label>
                              <input type="text" name="amt_unspent" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group col-sm-12 ctcsr" style="display: table;">
                              <label class="control-label">Amount eligible for transfer to Unspent CSR Account for the
                                Financial Year as per Section 135(6) (before adjustments) </label>
                              <input type="text" name="amt_eligible_of_unspent" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group col-sm-12 ctcsr" style="display: table;">
                              <label class="control-label">Amount to be transferred to Fund specified in Schedule VII
                                for
                                the Financial Year (if total unspent for the Financial Year is greater than unspent for
                                Ongoing projects)</label>
                              <input type="text" name="amt_to_be_transfered" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="unspent_amount">
            <div class="col-lg-12">
              <div class="row">
                <label class="control-label" style="color:#000; margin-bottom:20px;">Details of transfer of Unspent CSR
                  amount for the financial year: <br>
                  (How is unspent of current FY being used)</label>
              </div>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="uspent_csr">
                  <p><label>Transfer to Unspent CSR account as per Section 135(6): * </label></p>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style=" width: 100px; ">
                          Amount to be transferred to Unspent CSR account (₹ Lakhs)
                        </th>
                        <th scope="col">
                          Amount actually transferred to Unspent CSR account (₹ Lakhs)
                        </th>
                        <th scope="col">
                          Date of Transfer
                        </th>
                        <th scope="col">
                          Deficiency, if any
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> <input type="number" name="transfer_to_unspent[amt_to_transfer]" readonly>
                        </td>
                        <td> <input type="number" name="transfer_to_unspent[amt_transfer]"></td>
                        <td> <input type="date" name="transfer_to_unspent[date_transfer]"></td>
                        <td> <input type="text" name="transfer_to_unspent[deficiency]"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="uspent_csr">
                  <p><label>Transfer to Fund specified in Schedule VII as per second proviso to Section 135(5) for the
                      Financial Year: * </label></p>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style=" width: 100px; ">
                          Amount to be transferred to Unspent CSR account (₹ Lakhs)
                        </th>
                        <th scope="col">
                          Amount actually transferred to Unspent CSR account (₹ Lakhs)
                        </th>
                        <th scope="col">
                          Date of Transfer
                        </th>
                        <th scope="col">
                          Deficiency, if any
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> <input type="number" name="transfer_to_fund[amt_to_transfer]" readonly>
                        </td>
                        <td> <input type="number" name="transfer_to_fund[amt_transfer]"></td>
                        <td> <input type="date" name="transfer_to_fund[date_transfer]"></td>
                        <td> <input type="text" name="transfer_to_fund[deficiency]"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-lg-10">
              <div class="row">
                <div class="uspent_csr">
                  <p><label>Specify the reason(s) if the company has failed to spend two per cent of the average net
                      profit as per section 135(5): (Optional)</label></p>
                  <textarea placeholder="reason" type="text" class="form-control" id=""="" name="fail_reason" value=""
                    aria-="true"></textarea>
                </div>
              </div>
            </div>
            <div class="csrpolicy">
              <div class="row">
                <div class="col-sm-8">
                  <h2>Whether any unspent amount of preceding three financial years (financial year ending after 22
                    January 2021) has been spent in the financial year </h2>
                  <div class="yn">
                    <input type="radio" id="yes" name="any_unspent_amt" value="Yes">
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="any_unspent_amt" value="No">
                    <label for="no">No</label>
                  </div>
                </div>
                <div class="form-group col-sm-6 ctcsr" style="display: table;margin-top:20px">
                  <p class="control-label" style="margin-bottom:10px">Number of Ongoing Projects for the financial year:
                  </p>
                  <input placeholder="" type="text" class="form-control link-pol" id=""="" name=""
                    value="https://www.unliver.co.in/CSR-Board-Report-2022/" aria-="true" style=" width: 100%; ">
                </div>
              </div>
            </div>

            <div class="uspent_csr">
              <p><label>Details of CSR amount spent in the financial year pertaining to three preceding financial
                  year(s):
                </label></p>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">
                      Preceding Financial Years
                    </th>
                    <th scope="col">
                      Amount transferred to Unspent CSR A/c under section 135(6) (₹ Lakhs)
                    </th>
                    <th scope="col">
                      Balance amount in Unspent CSR A/c under section 135(6) (₹ Lakhs)
                    </th>
                    <th scope="col">
                      Amount spent in the Financial Year (₹ Lakhs)
                    </th>
                    <th scope="col" colspan="2">
                      Amt transferred to fund specified in Sch VII as per second proviso to Section 135(5), if any
                    </th>
                    <th scope="col">
                      Amt remaining to be spent in succeeding FY (₹ Lakhs)
                    </th>
                    <th scope="col">
                      Deficiency, if any
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th colspan="4"></th>
                    <th class="fy">Amount (₹)</th>
                    <th class="fy">Date of Transfer</th>
                    <th class="" colspan="2"></th>
                  </tr>
                  <tr>
                  <tr>
                    <th>FY - 1 (YE 31/03/
                      <?php echo $lastThreeYears[1]; ?>)
                      <input type="hidden" name="pertaining_three_years[0][fy]" value="<?php echo " 31/03/" .
                        $lastThreeYears[1]; ?>">
                    </th>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[0][amt_transferred_to_CSR_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_CSR_account ?>"
                        aria-="true" /></td>
                    <td><input
                        placeholder="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_CSR_account ?>"
                        type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[0][balance_amt_in_CSR_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_one->balance_amt_in_CSR_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[0][amt_spent_in_FY]"
                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_spent_in_FY ?>" aria-="true" />
                    </td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[0][amt_transferred_to_fund_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_fund_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="date" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[0][date_of_transferred_to_fund_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_one->date_of_transferred_to_fund_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[0][amt_remaining_to_spent]"
                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_remaining_to_spent ?>" aria-="true" />
                    </td>
                    <td><input placeholder="" type="text" class="form-control" id=""=""
                        name="pertaining_three_years[0][deficiency]"
                        value="<?= $csr_amt_spent_pertaining_three_years_one->deficiency ?>" aria-="true" />
                    </td>
                  </tr>
                  <tr>
                    <th>FY - 2 (YE 31/03/
                      <?php echo $lastThreeYears[2]; ?>)
                      <input type="hidden" name="pertaining_three_years[1][fy]" value="<?php echo " 31/03/" .
                        $lastThreeYears[2]; ?>">
                    </th>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[1][amt_transferred_to_CSR_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_CSR_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[1][balance_amt_in_CSR_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_two->balance_amt_in_CSR_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[1][amt_spent_in_FY]"
                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_spent_in_FY ?>" aria-="true" />
                    </td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[1][amt_transferred_to_fund_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_fund_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="date" class="form-control" id=""=""
                        name="pertaining_three_years[1][date_of_transferred_to_fund_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_two->date_of_transferred_to_fund_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[1][amt_remaining_to_spent]"
                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_remaining_to_spent ?>" aria-="true" />
                    </td>
                    <td><input placeholder="" type="text" class="form-control" id=""=""
                        name="pertaining_three_years[1][deficiency]"
                        value="<?= $csr_amt_spent_pertaining_three_years_two->deficiency ?>" aria-="true" />
                    </td>
                  </tr>
                  <tr>
                    <th>FY - 3 (YE 31/03/
                      <?php $parts = explode('-', $current_financial_year);
                      echo $parts[0]; ?>)
                      <input type="hidden" name="pertaining_three_years[2][fy]" value="<?php echo " 31/03/" . $parts[0];
                      ?>">
                    </th>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[2][amt_transferred_to_CSR_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[2][balance_amt_in_CSR_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_FY->balance_amt_in_CSR_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[2][amt_spent_in_FY]"
                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_spent_in_FY ?>" aria-="true" />
                    </td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[2][amt_transferred_to_fund_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_fund_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="date" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[2][date_of_transferred_to_fund_account]"
                        value="<?= $csr_amt_spent_pertaining_three_years_FY->date_of_transferred_to_fund_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="number" min="0" class="form-control" id=""=""
                        name="pertaining_three_years[2][amt_remaining_to_spent]"
                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account ?>"
                        aria-="true" /></td>
                    <td><input placeholder="" type="text" class="form-control" id=""=""
                        name="pertaining_three_years[2][deficiency]"
                        value="<?= $csr_amt_spent_pertaining_three_years_FY->deficiency ?>" aria-="true" /></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="new_project previous_year">
            <div class="col-lg-12">
              <div class="row">
                <label class="control-label" style="color:#000; margin-bottom:20px;">Details of CSR amount spent against
                  new CSR projects in the financial year: <br>
                  (Projects started in this {Current - Year; Ex: 2021-2022})</label>
                <div class="csrpolicy">
                  <div class="row-1">
                    <div class="col-sm-6">
                      <h2 style=" font-weight: 600; ">Whether any new CSR project has been undertaken in the financial
                        year from the Unspent amount pertaining to preceding three financial years :</h2>
                      <div class="yn">
                        <input type="radio" id="yes" name="any_new_csr_project_in_preceding_year" value="Yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="any_new_csr_project_in_preceding_year" value="no">
                        <label for="no">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="csrpolicy">
                  <h2 style=" font-weight: 600; ">If yes, nature of the new CSR Project(s) is/are:</h2>
                  <div class="row-1">
                    <div class="col-sm-4">
                      <div class="yn">
                        <input type="radio" id="Ongoing_projects" name="csr_nature" value="Ongoing projects">
                        <label for="Ongoing projects">Ongoing projects</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="yn">
                        <input type="radio" id="Other" name="csr_nature" value="Other">
                        <label for="Other">Other than ongoing projects</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="yn">
                        <input type="radio" id="Both" name="csr_nature" value="Both">
                        <label for="yes">Both, (Ongoing and other than ongoing projects)</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ongoing_projects">
                  <div class="col-lg-12">
                    <div class="row">
                      <label class="control-label"
                        style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details
                        for <b>ONGOING</b> projects : 2021-2022 * </label>

                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                        <p class="control-label" style="margin-bottom:0px">Number of Ongoing Projects for the financial
                          year: <span style="margin-left:10px;">02</span></p>
                        <table class="table" style="margin-top:10px">
                          <thead>
                            <tr>
                              <th scope="col">
                                Sr. No
                              </th>
                              <th scope="col">
                                Project ID
                              </th>
                              <th scope="col">
                                FY to which the new project pertains
                              </th>
                              <th scope="col">
                                Item from the list of activities in Schedule VII
                              </th>
                              <th scope="col">
                                Name of the project
                              </th>
                              <th scope="col">
                                Local Area (Y/N)
                              </th>
                              <th scope="col" colspan="2">
                                Project Location (District)
                              </th>
                              <th scope="col">
                                Project Duration (Months)
                              </th>
                              <th scope="col">
                                Amt. spent in the FY (₹ Lakhs)
                              </th>
                              <th scope="col">
                                Direct (Y/N)
                              </th>
                              <th scope="col" colspan="2">
                                Through Implementing Agency
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="col" colspan="6">
                              </th>
                              <th scope="col" class="fy">
                                State
                              </th>
                              <th scope="col" class="fy">
                                District
                              </th>
                              <th scope="col" colspan="3">
                              </th>
                              <th scope="col" class="fy">
                                CSR Registration No.
                              </th>
                              <th scope="col" class="fy">
                                Name
                              </th>
                            </tr>
                          </tbody>
                          <tbody class="new-csr-project">
                            <tr>
                              <td> 1 </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][project_id]"> </td>
                              <td> {2021-2022}</td>
                              <td> </td>
                              <td> </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][lcoal_area]"> </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][state]"> </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][district]"> </td>
                              <td> </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][amt_spent]"> </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][direct]"> </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][csr_reg]"> </td>
                              <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][name]"> </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="col-sm-12-">
                          <div class="row">
                            <div class="form-group col-sm-6-" style="text-align: left;">
                              <a href="javascript:void()" class="btn addmore add-more-new-csr-project" onclick="">
                                <span>+</span> Add details of other projects</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ongoing_projects">
                  <div class="col-lg-12">
                    <div class="row">
                      <label class="control-label"
                        style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details
                        of amount spent against new other than ongoing projects in the financial year: </label>

                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                        <p class="control-label" style="margin-bottom:0px">Number of Other than Ongoing Projects: <span
                            style="margin-left:10px;">02</span></p>
                        <table class="table" style="margin-top:10px">
                          <thead>
                            <tr>
                              <th scope="col" style=" width: 110px; ">
                                Sr. No
                              </th>
                              <th scope="col">
                                FY to which the new project pertains
                              </th>
                              <th scope="col">
                                Item from the list of activities in Schedule VII
                              </th>
                              <th scope="col">
                                Project Name
                              </th>
                              <th scope="col">
                                Local Area (Y/N)
                              </th>
                              <th scope="col" colspan="2">
                                Project Location
                              </th>
                              <th scope="col">
                                Amt. spent in the FY (₹ Lakhs)
                              </th>
                              <th scope="col">
                                Direct (Y/N)
                              </th>
                              <th scope="col" colspan="2">
                                Through Implementing Agency
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="col" colspan="5">
                              </th>
                              <th scope="col" class="fy">
                                State
                              </th>
                              <th scope="col" class="fy">
                                District
                              </th>
                              <th scope="col" colspan="2">
                              </th>
                              <th scope="col" class="fy">
                                CSR Registration No.
                              </th>
                              <th scope="col" class="fy">
                                Name
                              </th>
                            </tr>
                          </tbody>
                          <tbody class="other-than-csr-project">
                            <tr>
                              <td> 1 </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][fy]"
                                  value="<?php echo $current_financial_year; ?>" class="form-control" readonly></td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][activities_list]"
                                  class="form-control"> </td>
                              <td><input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][project]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][lcoal_area]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][state]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][district]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][amt_spent]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][direct]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][csr_reg]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][name]"
                                  class="form-control"> </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="col-sm-12-">
                          <div class="row">
                            <div class="form-group col-sm-6-" style="text-align: left;">
                              <a href="javascript:void()" class="btn addmore add-more-other-than-csr-project">
                                <span>+</span> Add details of other projects</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="new_project previous_year">
            <div class="col-lg-12">
              <div class="row">
                <label class="control-label" style="color:#000; margin-bottom:20px;">Details of any unspent amount
                  pertaining to FY 2014-15 to FY 2019-20 has been spent in the financial year:</label>
                <div class="csrpolicy">
                  <div class="row-1">
                    <div class="col-sm-6">
                      <h2 style=" font-weight: 600; ">Whether any unspent amount pertaining to FY 2014-15 to FY 2019-20
                        has been spent in the financial year:</h2>
                      <div class="yn">
                        <input type="radio" id="yes" name="any_unspent_amt_in_fy" value="Yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="any_unspent_amt_in_fy" value="no">
                        <label for="no">No</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="ongoing_projects">
                  <div class="col-lg-12">
                    <div class="row">
                      <label class="control-label"
                        style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details
                        of amount spent against CSR projects in the financial year:</label>

                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                        <p class="control-label" style="margin-bottom:0px">Number of Other than Ongoing Projects: <span
                            style="margin-left:10px;">0</span></p>
                        <table class="table" style="margin-top:10px">
                          <thead>
                            <tr>
                              <th scope="col">
                                Sr. No.
                              </th>
                              <th scope="col">
                                FY to which the new project pertains
                              </th>
                              <th scope="col">
                                Item from the list of activities in Schedule VII
                              </th>
                              <th scope="col">
                                Project Name
                              </th>
                              <th scope="col">
                                Local Area (Y/N)
                              </th>
                              <th scope="col" colspan="2">
                                Project Location
                              </th>
                              <th scope="col">
                                Amt. spent in the FY (₹ Lakhs)
                              </th>
                              <th scope="col">
                                Direct (Y/N)
                              </th>
                              <th scope="col" colspan="2">
                                Through Implementing Agency
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="col" colspan="5">
                              </th>
                              <th scope="col" class="fy">
                                State
                              </th>
                              <th scope="col" class="fy">
                                District
                              </th>
                              <th scope="col" colspan="2">
                              </th>
                              <th scope="col" class="fy">
                                CSR Reg. No.
                              </th>
                              <th scope="col" class="fy">
                                Name
                              </th>
                            </tr>
                          </tbody>
                          <tbody>
                          <tbody class="against-csr-project">
                            <tr>
                              <td> 1 </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][fy]" value=""
                                  class="form-control">
                              </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][activities_list]"
                                  class="form-control"> </td>
                              <td><input type="text" name="detail_amt_spent_against_csr[0][project]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][lcoal_area]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][state]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][district]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][amt_spent]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][direct]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][csr_reg]"
                                  class="form-control"> </td>
                              <td> <input type="text" name="detail_amt_spent_against_csr[0][name]" class="form-control">
                              </td>
                            </tr>
                          </tbody>

                          </tbody>
                        </table>
                        <div class="col-sm-12-">
                          <div class="row">
                            <div class="form-group col-sm-6-" style="text-align: left;">
                              <a href="javascript:void()" class="btn addmore add-more-against-csr-project">
                                <span>+</span>
                                Add details of other projects</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="new_project previous_year capital_assets">
            <div class="col-lg-12">
              <div class="row">
                <label class="control-label" style="color:#000; margin-bottom:20px;">Details of capital assets that have
                  been created or acquired through CSR spent in the financial year:</label>
                <div class="csrpolicy">
                  <div class="row-1">
                    <div class="col-sm-6">
                      <h2 style=" font-weight: 600; ">Whether any Capital assets have been created or acquired through
                        CSR
                        spent in the financial year:</h2>
                      <div class="yn">
                        <input type="radio" id="yes" name="any_capital_asset" value="Yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="any_capital_asset" value="no">
                        <label for="no">No</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="ongoing_projects">
                  <div class="col-lg-12">
                    <div class="row">
                      <label class="control-label"
                        style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">Furnish
                        the details relating to such asset(s) so created or acquired through CSR spent in the financial
                        year:</label>

                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                        <table class="table" style="margin-top:10px">
                          <thead>
                            <tr>
                              <th scope="col">
                                Sr. No.
                              </th>
                              <th scope="col">
                                Short particulars of property or asset(s) [Including complete address and location of
                                the
                                property] *
                              </th>
                              <th scope="col">
                                Pin code of property or asset *
                              </th>
                              <th scope="col">
                                Date of Creation *
                              </th>
                              <th scope="col">
                                Amount of CSR spent *
                              </th>
                              <th scope="col" colspan="3">
                                Detail of entity/authority/beneficiary of registered owner *
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="col">
                              </th>
                              <th scope="col">
                              </th>
                              <th scope="col">
                              </th>
                              <th scope="col">
                              </th>
                              <th scope="col">
                              </th>
                              <th scope="col" class="fy">
                                CSR Registration Number, if applicable
                              </th>
                              <th scope="col" class="fy">
                                Name
                              </th>
                              <th scope="col" class="fy">
                                Registered Address
                              </th>
                            </tr>
                          </tbody>
                          <tbody class="capital_asset-csr-project">
                            <tr>
                              <th>1</th>
                              <th> <input type="text" name="capital_asset[0][shorts]" class="form-control">
                              </th>
                              <th> <input type="text" name="capital_asset[0][pincode]" class="form-control">
                              </th>
                              <th> <input type="date" name="capital_asset[0][creation_date]" class="form-control"> </th>
                              <th> <input type="text" name="capital_asset[0][csr_spent]" class="form-control">
                              </th>
                              <th> <input type="text" name="capital_asset[0][csr_reg]" class="form-control">
                              </th>
                              <th> <input type="text" name="capital_asset[0][name]" class="form-control">
                              </th>
                              <th> <input type="text" name="capital_asset[0][address]" class="form-control">
                              </th>
                            </tr>
                          </tbody>
                        </table>
                        <div class="col-sm-12-">
                          <div class="row">
                            <div class="form-group col-sm-6-" style="text-align: left;">
                              <a href="javascript:void()" class="btn addmore add-more-capital_asset-csr-project"
                                onclick=""> <span>+</span> Add details of other projects</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <input type="hidden" name="submit_type" class="submit_type" value="">
        <input type="submit" class="submitform" style="display: none;">
      </form>
    </div>
  </div>
  <div class="save_btns">
    <div class="col-sm-12">
      <div class="wrap_flex_btn">
        <div class="form-group">
          <a href="javascript:void(0)" class="cancelBtn">Cancel</a>
        </div>
        <div class="form-group">
          <a href="javascript:void(0)" class="draftbtn">Save As Draft</a>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary saveBtn">Submit & Preview</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <script>
    $(".draftbtn").click(function () {
      $('.submit_type').val(2);
      setTimeout(() => {
        $('.submitform').click();
      }, 1500);
    })
    $(".saveBtn").click(function () {
      $('.submit_type').val(3);
      setTimeout(() => {
        $('.submitform').click();
      }, 1500);
    })
  </script>
</body>
<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
<script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/implementor.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<?php $this->load->view('common/footer_js'); ?>