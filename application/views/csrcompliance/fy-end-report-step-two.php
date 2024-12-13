<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
?>
<?php $this->load->view('common/head_common'); ?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />

<body class="full-page">
    <?php $this->load->view('common/header');


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
    <div class="container">

        <form method="post" action="<?php echo base_url() . " CsrCompliance/createCsrReportStepOne" ?>"
            enctype="multipart/form-data">
            <p>Additional Details related to CSR activities conducted throughout the year:</p>
            <p> Number of meetings of CSR Committee held during the year attended by director: * </p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">S No.</th>
                        <th scope="col">DIN</th>
                        <th scope="col">Name of Director</th>
                        <th scope="col">Category</th>
                        <th scope="col">No. of meetings of CSR Committee attended during the year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comitte_details as $key => $value) {
                        echo ' <tr>
                        <th scope="row">' . ($key + 1) . '</th>
                        <input type="hidden" value="' . $value->id . '" name="csr_committe[' . $key . '][csr_committe_id]">
                        <td> <input type="text" class="form-control" required name="csr_committe[' . $key . '][din]" value="' . $value->DIN . '"> </td>
                        <td> <input type="text" class="form-control" required name="csr_committe[' . $key . '][director]" value="' . $value->name_of_director . '"> </td>
                        <td> <input type="text" class="form-control" required name="csr_committe[' . $key . '][category]" value="' . $value->category . '"> </td>
                        <td> <input type="text" class="form-control" required name="csr_committe[' . $key . '][meetings_count]" value="">
                        </td>
                    </tr>';
                    } ?>
                </tbody>
            </table>
            <lable>Whether Impact assessment of CSR projects is carried out in pursuance of sub-rule (3) of Rule 8 of
                Companies (CSR Policy) Rules,2014, if applicable * </lable>
            <input type="radio" class="form-control" required name="add_csr_details[csr_assesment_impact]" value="true">
            <input type="radio" class="form-control" required name="add_csr_details[csr_assesment_impact]" value="false">

            <label>Whether the same has been disclosed in the Board Report *</label>
            <input type="radio" class="form-control" required name="add_csr_details[board_report_status]" value="true">
            <input type="radio" class="form-control" required name="add_csr_details[board_report_status]" value="false">

            <label>Link to Board Report * </label>
            <input type="url" required name="add_csr_details[report_link]" class="form-control">

            <div class="row">
                <div class="col-sm-12">
                    <h3>Details of CSR amount spent against projects for the financial year: 2021-2022 (Projects started
                        in Previous Year)</h3>
                    <h4>Whether CSR amount for the financial year has been spent:</h4>
                    <p>YES (fetch from basic details page table csr obligation)
                    <h4>CSR amount has been spent against:</h4>
                    <p>Both (Ongoing and other than ongoing projects) same from CSR obligation</p>
                </div>
                <div class="col-sm-12">
                    <h3>Details for ongoing projects : 2021-2022 *</h3>
                    <p>Number of Ongoing Projects for the financial year: </p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">S No.</th>
                                <th scope="col">Project ID</th>
                                <th scope="col">Item from the list of activities in schedule VII</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Local Area Y/N</th>
                                <th scope="col">Project Location (State)</th>
                                <th scope="col">Project Location (District)</th>
                                <th scope="col">Project Duration (Months)</th>
                                <th scope="col">Amt. spent in the FY (₹ Lakhs)</th>
                                <th scope="col">Direct Implementation (Y/N)</th>
                                <th scope="col">CSR Registr ation No. (Agency)</th>
                                <th scope="col">Name (Agency)</th>
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
                    <a href="javascript:void()" class="btn add-more-projects"> + Add details of other projects</a>
                </div>

                <div class="col-sm-12">
                    <h3>Details for other than ongoing projects : 2021-2022 * </h3>
                    <p>Number of Other than Ongoing Projects for the financial year: </p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">S No.</th>
                                <th scope="col">Project ID</th>
                                <th scope="col">Item from the list of activities in schedule VII</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Local Area Y/N</th>
                                <th scope="col">Project Location (State)</th>
                                <th scope="col">Project Location (District)</th>
                                <th scope="col">Project Duration (Months)</th>
                                <th scope="col">Amt. spent in the FY (₹ Lakhs)</th>
                                <th scope="col">Direct Implementation (Y/N)</th>
                                <th scope="col">CSR Registr ation No. (Agency)</th>
                                <th scope="col">Name (Agency)</th>
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
                    <a href="javascript:void()" class="btn add-more-projects"> + Add details of other projects</a>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Amount spent in Administrative Overheads *</label>
                        <input type="text" name="amt_spent_adminstrative" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Amount spent on Impact Assessment, if applicable: * </label>
                        <input type="text" name="amt_spent_impact" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Total amount spent for Financial Year: *</label>
                        <input type="text" name="total_amt" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Amount unspent/ (excess) spent for the Financial Year (unspent for Ongoing projects) *
                        </label>
                        <input type="text" name="amt_unspent" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Amount eligible for transfer to Unspent CSR Account for the Financial Year as per Section
                            135(6) (before adjustments)</label>
                        <input type="text" name="amt_eligible_of_unspent" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Amount to be transferred to Fund specified in Schedule VII for the Financial Year (if
                            total unspent for the Financial Year is greater than unspent for Ongoing projects)</label>
                        <input type="text" name="amt_to_be_transfered" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <h2>Details of transfer of Unspent CSR amount for the financial year:
                    (How is unspent of current FY being used)</h2>
                <h3>Transfer to Unspent CSR account as per Section 135(6): * </h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Amount to be transferred to Unspent CSR account (₹ Lakhs)</th>
                            <th scope="col">Amount actually transferred to Unspent CSR account
                                (₹ Lakhs)</th>
                            <th scope="col">Date of Transfer</th>
                            <th scope="col">Deficiency, if any</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <input type="number" name="transfer_to_unspent[amt_to_transfer]" required readonly>
                            </td>
                            <td> <input type="number" name="transfer_to_unspent[amt_transfer]" required></td>
                            <td> <input type="date" name="transfer_to_unspent[date_transfer]" required></td>
                            <td> <input type="number" name="transfer_to_unspent[deficiency]" required></td>
                        </tr>
                    </tbody>
                </table>
                <h3>Transfer to Fund specified in Schedule VII as per second proviso to Section 135(5) for the Financial
                    Year: * </h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Amount to be transferred to Unspent CSR account (₹ Lakhs)</th>
                            <th scope="col">Amount actually transferred to Unspent CSR account
                                (₹ Lakhs)</th>
                            <th scope="col">Date of Transfer</th>
                            <th scope="col">Deficiency, if any</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <input type="number" name="transfer_to_fund[amt_to_transfer]" required readonly>
                            </td>
                            <td> <input type="number" name="transfer_to_fund[amt_transfer]" required></td>
                            <td> <input type="date" name="transfer_to_fund[date_transfer]" required></td>
                            <td> <input type="number" name="transfer_to_fund[deficiency]" required></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Specify the reason(s) if the company has failed to spend two percent of the average net
                        profit as per section 135(5): (Optional)</label>
                    <textarea
                        name="fail_reason">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </textarea>
                </div>
                <div class="form-group">
                    <label>Whether any unspent amount of preceding three financial years (financial year ending after 22
                        January 2021) has been spent in the financial year </label>
                    <input type="radio" name="any_unspent_amt" value="true">
                    <input type="radio" name="any_unspent_amt" value="false">
                </div>
                <div class="form-group">
                    <h2>Details of CSR amount spent in the financial year pertaining to three preceding financial
                        year(s):</h2>
                    <div class="preceding">
                        <p class="net_worth" style="color:#000;">Details of CSR amount spent in the
                            financial year pertaining to three preceding financial year(s) * </p>
                        <table class="table profit">
                            <thead>
                                <tr>
                                    <th scope="col">Preceding Financial Years</th>
                                    <th scope="col">Amount transferred to Unspent CSR A/c under section
                                        135(6) (₹ Lakhs)</th>
                                    <th scope="col">Balance amount in Unspent CSR A/c under section
                                        135(6)
                                        (₹ Lakhs)</th>
                                    <th scope="col">Amount spent in the Financial Year (₹ Lakhs)</th>
                                    <th scope="col" colspan="2">Amt transferred to fund specified in Sch
                                        VII
                                        as per second proviso to Section 135(5), if any</th>
                                    <th scope="col">Amt remaining to be spent in succeeding FY (₹)</th>
                                    <th scope="col">Deficiency, if any</th>
                                </tr>
                            </thead>
                            <tr>
                                <th colspan="4"></th>
                                <th>Amount (₹)</th>
                                <th>Date of Transfer</th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th>FY - 1 (YE 31/03/
                                    <?php echo $lastThreeYears[1]; ?>)
                                    <input type="hidden" name="pertaining_three_years[0][fy]"
                                        value="<?php echo "31/03/" . $lastThreeYears[1]; ?>">
                                </th>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[0][amt_transferred_to_CSR_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_CSR_account ?>"
                                        aria-required="true" /></td>
                                <td><input
                                        placeholder="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_CSR_account ?>"
                                        type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[0][balance_amt_in_CSR_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_one->balance_amt_in_CSR_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[0][amt_spent_in_FY]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_spent_in_FY ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[0][amt_transferred_to_fund_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_fund_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="date" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[0][date_of_transferred_to_fund_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_one->date_of_transferred_to_fund_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[0][amt_remaining_to_spent]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_one->amt_remaining_to_spent ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="text" class="form-control" id="" required=""
                                        name="pertaining_three_years[0][deficiency]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_one->deficiency ?>"
                                        aria-required="true" /></td>
                            </tr>
                            <tr>
                                <th>FY - 2 (YE 31/03/
                                    <?php echo $lastThreeYears[2]; ?>)
                                    <input type="hidden" name="pertaining_three_years[1][fy]"
                                        value="<?php echo "31/03/" . $lastThreeYears[2]; ?>">
                                </th>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[1][amt_transferred_to_CSR_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_CSR_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[1][balance_amt_in_CSR_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_two->balance_amt_in_CSR_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[1][amt_spent_in_FY]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_spent_in_FY ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[1][amt_transferred_to_fund_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_fund_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="date" class="form-control" id="" required=""
                                        name="pertaining_three_years[1][date_of_transferred_to_fund_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_two->date_of_transferred_to_fund_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[1][amt_remaining_to_spent]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_two->amt_remaining_to_spent ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="text" class="form-control" id="" required=""
                                        name="pertaining_three_years[1][deficiency]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_two->deficiency ?>"
                                        aria-required="true" /></td>
                            </tr>
                            <tr>
                                <th>FY - 3 (YE 31/03/
                                    <?php $parts = explode('-', $current_financial_year);
                                    echo $parts[0]; ?>)
                                    <input type="hidden" name="pertaining_three_years[2][fy]"
                                        value="<?php echo "31/03/" . $parts[0]; ?>">
                                </th>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[2][amt_transferred_to_CSR_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[2][balance_amt_in_CSR_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_FY->balance_amt_in_CSR_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[2][amt_spent_in_FY]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_spent_in_FY ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[2][amt_transferred_to_fund_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_fund_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="date" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[2][date_of_transferred_to_fund_account]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_FY->date_of_transferred_to_fund_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="number" min="0" class="form-control" id="" required=""
                                        name="pertaining_three_years[2][amt_remaining_to_spent]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account ?>"
                                        aria-required="true" /></td>
                                <td><input placeholder="" type="text" class="form-control" id="" required=""
                                        name="pertaining_three_years[2][deficiency]" required
                                        value="<?= $csr_amt_spent_pertaining_three_years_FY->deficiency ?>"
                                        aria-required="true" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <h2>Details of CSR amount spent against new CSR projects in the financial year: (Projects started in
                    this {Current - Year; Ex: 2021-2022})</h2>
                <div class="form-group">
                    <label>Whether any new CSR project has been undertaken in the financial year from the Unspent amount
                        pertaining to preceding three financial years :</label>
                    <input type="radio" name="any_new_csr_project_in_preceding_year" value="true" class="form-control">
                    <input type="radio" name="any_new_csr_project_in_preceding_year" value="false" class="form-control">
                </div>
                <div class="form-group">
                    <label>If yes, nature of the new CSR Project(s) is/are:</label>
                    <input type="radio" name="csr_nature" value="ongoing_project"><label>Ongoing projects</label>
                    <input type="radio" name="csr_nature" value="other_than_ongoing_project"><label>Other than ongoing
                        projects</label>
                    <input type="radio" name="csr_nature" value="both"><label>Both, (Ongoing and other than ongoing
                        projects)</label>
                </div>
            </div>

            <div class="col-sm-12">
                <h2>Details of amount spent against new ongoing CSR project in the financial year:</h2>
                <p>Number of Ongoing Projects: 02</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">Project ID</th>
                            <th scope="col">FY to which the new project pertains</th>
                            <th scope="col">Item from the list of activities in Schedule VII</th>
                            <th scope="col">Name of the project</th>
                            <th scope="col">Local Area (Y/N)</th>
                            <th colspan="2">Project Location </th>
                            <th scope="col">Project Duration (Months)</th>
                            <th scope="col">Amt spent in the FY (₹ Lakhs)</th>
                            <th scope="col">Direct (Y/ N)</th>
                            <th colspan="2">Through Implementing Agency</th>
                        </tr>
                    </thead>
                    <tbody class="new-csr-project">
                        <tr>
                            <td> 1 </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][project_id]" required> </td>
                            <td> {2021-2022}</td>
                            <td> </td>
                            <td> </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][lcoal_area]" required> </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][state]" required> </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][district]" required> </td>
                            <td> </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][amt_spent]" required> </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][direct]" required> </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][csr_reg]" required> </td>
                            <td> <input type="text" name="detail_amt_ongoing_csr_fy[0][name]" required> </td>
                        </tr>
                    </tbody>
                </table>
                <a href="javascript:void(0)" class="btn add-more-new-csr-project"> + Add details of other projects</a>
            </div>
            <div class="col-sm-12">
                <h3>Details of amount spent against new other than ongoing projects in the financial year:</h3>
                <p>Number of Other than Ongoing Projects: 02</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">FY to which the new project pertains</th>
                            <th scope="col">Item from the list of activities in Schedule VII</th>
                            <th scope="col">Project Name </th>
                            <th scope="col">Local Area (Y/N)</th>
                            <th colspan="2">Project Location </th>
                            <th scope="col">Amt spent in the FY (₹ Lakhs)</th>
                            <th scope="col">Direct (Y/ N)</th>
                            <th colspan="2">Through Implementing Agency</th>
                        </tr>
                    </thead>
                    <tbody class="other-than-csr-project">
                        <tr>
                            <td> 1 </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][fy]"
                                    value="<?php echo $current_financial_year; ?>" class="form-control" readonly></td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][activities_list]"
                                    class="form-control" required> </td>
                            <td><input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][project]"
                                    class="form-control" required> </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][lcoal_area]"
                                    class="form-control" required> </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][state]"
                                    class="form-control" required> </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][district]"
                                    class="form-control" required> </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][amt_spent]"
                                    class="form-control" required> </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][direct]"
                                    class="form-control" required> </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][csr_reg]"
                                    class="form-control" required> </td>
                            <td> <input type="text" name="detail_amt_otherthan_ongoing_csr_fy[0][name]"
                                    class="form-control" required> </td>
                        </tr>
                    </tbody>
                </table>
                <a href="javascript:void(0)" class="btn add-more-other-than-csr-project"> + Add details of other
                    projects</a>
            </div>
            <div class="col-sm-12">
                <h3>Details of any unspent amount pertaining to FY 2014-15 to FY 2019-20 has been spent in the financial
                    year:</h3>
                <div class="form-group">
                    <h3>Whether any unspent amount pertaining to FY 2014-15 to FY 2019-20 has been spent in the
                        financial year:</h3>
                    <label for="yes">Yes</label>
                    <input id="yes" type="radio" name="any_unspent_amt_in_fy" value="true">
                    <label for="no">No</label>
                    <input id="no" type="radio" name="any_unspent_amt_in_fy" value="false">
                </div>
                <div class="form-group">
                    <h3>Details of amount spent against CSR projects in the financial year:</h3>
                    <p>Number of Other than Ongoing Projects:</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">FY to which the new project pertains</th>
                                <th scope="col">Item from the list of activities in Schedule VII</th>
                                <th scope="col">Project Name </th>
                                <th scope="col">Local Area (Y/N)</th>
                                <th colspan="2">Project Location </th>
                                <th scope="col">Amt spent in the FY (₹ Lakhs)</th>
                                <th scope="col">Direct (Y/ N)</th>
                                <th colspan="2">Through Implementing Agency</th>
                            </tr>
                        </thead>
                        <tbody class="against-csr-project">
                            <tr>
                                <td> 1 </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][fy]" value=""
                                        class="form-control">
                                </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][activities_list]"
                                        class="form-control" required> </td>
                                <td><input type="text" name="detail_amt_spent_against_csr[0][project]"
                                        class="form-control" required> </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][lcoal_area]"
                                        class="form-control" required> </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][state]"
                                        class="form-control" required> </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][district]"
                                        class="form-control" required> </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][amt_spent]"
                                        class="form-control" required> </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][direct]"
                                        class="form-control" required> </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][csr_reg]"
                                        class="form-control" required> </td>
                                <td> <input type="text" name="detail_amt_spent_against_csr[0][name]"
                                        class="form-control" required> </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="javascript:void(0)" class="btn add-more-against-csr-project"> + Add details of other
                        projects</a>
                </div>
                <div class="col-sm-12">
                    <h3>Details of capital assets that have been created or acquired through CSR spent in the financial
                        year:</h3>
                    <div class="form-group">
                        <label>Whether any Capital assets have been created or acquired through CSR spent in the
                            financial year:</label>
                        <input type="radio" name="any_capital_asset" value="true">
                        <input type="radio" name="any_capital_asset" value="false">
                    </div>
                    <p>Furnish the details relating to such asset(s) so created or acquired through CSR spent in the
                        financial year:</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">Short particulars of property or asset(s) [Including complete address
                                    and location of the property] * </th>
                                <th scope="col">Pin code of property or asset * </th>
                                <th scope="col">Date of Creation * </th>
                                <th scope="col">Amount of CSR spent * </th>
                                <th colspan="3">Detail of entity/authority/beneficiary of registered owner * </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>CSR Registration Number, if applicable</th>
                                <th>Name</th>
                                <th>Registered Address</th>
                            </tr>
                        </thead>
                        <tbody class="capital_asset-csr-project">
                            <tr>
                                <th>1</th>
                                <th> <input type="text" name="capital_asset[0][shorts]" class="form-control" required>
                                </th>
                                <th> <input type="text" name="capital_asset[0][pincode]" class="form-control" required>
                                </th>
                                <th> <input type="date" name="capital_asset[0][creation_date]" class="form-control"
                                        required> </th>
                                <th> <input type="text" name="capital_asset[0][csr_spent]" class="form-control"
                                        required> </th>
                                <th> <input type="text" name="capital_asset[0][csr_reg]" class="form-control" required>
                                </th>
                                <th> <input type="text" name="capital_asset[0][name]" class="form-control" required>
                                </th>
                                <th> <input type="text" name="capital_asset[0][address]" class="form-control" required>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <a href="javascript:void(0)" class="btn add-more-capital_asset-csr-project"> + Add details of other
                        projects</a>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
    <link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
    <script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/implementor.js?v=' . JS_CSC_V; ?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
    <script type="text/javascript" src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <?php $this->load->view('common/footer_js'); ?>
</body>