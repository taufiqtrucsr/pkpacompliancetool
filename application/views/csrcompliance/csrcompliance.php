<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

$this->load->view('common/head_common'); ?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />
<link href="<?php echo SKIN_URL; ?>css/select2.min.css" rel="stylesheet" />
<style>
    .grey-create-project {
        display: block;
    }

    input[type="date" i]::-webkit-calendar-picker-indicator {
        background-image: url("<?php echo SKIN_URL; ?>images/duration.png") !important;
    }
</style>

<body class="full-page">
    <?php
    $this->load->view('common/header');

    /*$current_year = date('Y');
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
    $current_financial_year = $start_year . '-' . $end_year;*/
    /*Sanjay Oraon
         preceeding financial year and preceeding financial year - 1 
    */
    $year = explode('-', $current_financial_year);
    $preceeding_financial_year = ($year[0] - 1) . '-' . ($year[1]);
    $preceeding_financial_year_previous = ($year[0] - 2) . '-' . ($year[0] - 2);

    /*
    -----------------------------------------
    */

    $financialYears = array();
    // Calculate the last three financial years
    for ($i = 0; $i < 2; $i++) {
        $startYear = $year[0] - $i - 1;
        $endYear = $year[0] - $i;
        $financialYears[] = $startYear . '-' . $endYear;
    }
    $lastThreeYears = array($year[0] - 3, $year[0] - 2, $year[0] - 1);
    ?>
    <div class="container">
        <div class="col-md-12" id="contractDetailsBlock">
            <!-- col-sm-4 -->
            <div class="col-sm-12 right-side-bar-dashboard grey-create-project">
                <div id="membershipCheck"></div>
                <div class="kyc-title">
                    <h2>CSR Compliance</h2>
                </div>
                <ul class="nav nav-tabs main-tab-control">
                    <li class="nav-item basic-tab">
                        <a class="nav-link" href="#Basic_Details" data-toggle="tab" aria-expanded="true">Basic
                            Details</a>
                    </li>
                    <li class="nav-item committee-tab">
                        <a class="nav-link" href="#Committee_Details" data-toggle="tab" aria-expanded="false"> CSR
                            Committee Details</a>
                    </li>
                    <li class="nav-item annual-tab">
                        <a class="nav-link" href="#Annual_Plan" data-toggle="tab" aria-expanded="false">Annual Action
                            Plan</a>
                    </li>
                    <li class="nav-item computaion-tab">
                        <a class="nav-link" href="#Computation" data-toggle="tab" aria-expanded="false">S.198 Profit
                            Download</a>
                    </li>
                    <li class="nav-item report-tab">
                        <a class="nav-link" href="#CSR_Spent_Details" data-toggle="tab" aria-expanded="false">CSR
                            Statutory
                            Report</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="Basic_Details" class="container tab-pane basic-tab">
                        <form action="<?php echo base_url() . "CsrCompliance/saveBasicDetails"; ?>"
                            name="basicDetailsForm" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="mode" value="calculation" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row-1">
                                        <label class="control-label">CSR Applicability Criteria For FY *</label>
                                        <select class="form-select" name="year" aria-label="Default select"
                                            id="fychange">
                                            <?php ?>
                                            <option value="<?= $current_year ?>"><?= $current_year ?></option>
                                            <?php /*if(!$count_current_financial){ ?>
              <option value="<?=$current_year?>"><?=$current_year?></option>
          <?php }
          if($total_financial){
              foreach($logs as $row){  ?>
                  <option value="<?=$row->FY_year?>"  <?=(isset($_GET['fy']) && $_GET['fy'] == $row->FY_year)? 'selected' : ''?>><?=$row->FY_year?></option>
  <?php  break; } } */ ?>
                                        </select>

                                        <select class="form-select" name="is_audited" aria-label="Default select" <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                            echo 'disabled';
                                        } ?>>
                                            <option value="2" <?php if ($checkfinancial_current_year->is_auidted_data == 2) {
                                                echo "selected";
                                            } ?>>Provisional Data</option>
                                            <option value="1" <?php if ($checkfinancial_current_year->is_auidted_data == 1) {
                                                echo "selected";
                                            } ?>>Audited Data</option>
                                        </select>
                                        <a href="javascript:void(0)" class="info-tool-box"><img
                                                src="<?php echo SKIN_URL; ?>images/info.png"><span>Select FY of which
                                                you wish to check the CSR Obligation.For Current FY if audited data is
                                                unavailable then select 'Provisional Data' for to identify possible CSR
                                                obligation</span></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="net_worth">Net worth, Turnover or Net Profit For the FY
                                        (<?php echo $current_financial_year; ?>)
                                        *</label>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Net worth <br />
                                                    ( ₹ 500 crore or more) *
                                                </th>
                                                <th scope="col">
                                                    Turnover <br />
                                                    (₹ 1000 crore or more) *
                                                </th>
                                                <th scope="col">
                                                    Net Profit <br />
                                                    (₹ 5 crore or more) *
                                                </th>
                                                <th scope="col">
                                                    Applicability Of <br />
                                                    Section 135 (CSR)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                                        <input placeholder="" type="number"
                                                            class="form-control net_profit_cal" id="net_worth" required=""
                                                            min="0" name="net_worth"
                                                            value="<?php echo (((isset($_GET['e_net_worth']) && $_GET['e_net_worth'] != '') ? $_GET['e_net_worth'] : $checkfinancial_current_year->net_worth)); ?>"
                                                            aria-required="true" />
                                                    <?php } else {
                                                        echo $checkfinancial_current_year->net_worth;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                                        <input placeholder="" type="number"
                                                            class="form-control net_profit_cal" id="turn_over" required=""
                                                            min="0" name="turn_over"
                                                            value="<?php echo (((isset($_GET['e_turnover']) && $_GET['e_turnover'] != '') ? $_GET['e_turnover'] : $checkfinancial_current_year->turnover)); ?>"
                                                            aria-required="true" />
                                                    <?php } else {
                                                        echo $checkfinancial_current_year->turnover;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php echo $calculation->net_profit; ?>
                                                    <?php if ($calculation->net_profit) { ?>
                                                        </br><a href="javascript:void(0)"
                                                            class="btn btn-sm btn-theme calculate_csr preview-computation"
                                                            id="net-profit-value"
                                                            data-net="<?php echo $calculation->net_profit; ?>"
                                                            data-year="<?php echo $current_financial_year; ?>" data-key="1"
                                                            data-id="#net_profit" alt="">Preview</a>
                                                    <?php } else {
                                                        if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                                            <img src="<?php echo SKIN_URL; ?>images/calcul.svg"
                                                                class="calculate_csr" id="net-profit-value"
                                                                data-net="<?php echo $calculation->net_profit; ?>"
                                                                data-year="<?php echo $current_financial_year; ?>" data-key="1"
                                                                data-id="#net_profit" alt="" />
                                                        <?php }
                                                    } ?>
                                                </td>
                                                <td id="applicability_status">
                                                    <?= ($checkfinancial_current_year->net_worth >= 5000000000 || $checkfinancial_current_year->turnover >= 10000000000 || $calculation->net_profit >= 50000000) ? 'Applicable' : 'Not Applicable' ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <?php
                                        $networth = (((isset($_GET['e_net_worth']) && $_GET['e_net_worth'] != '') ? $_GET['e_net_worth'] : $checkfinancial_current_year->net_worth));
                                        $turnover = (((isset($_GET['e_net_worth']) && $_GET['e_net_worth'] != '') ? $_GET['e_net_worth'] : $checkfinancial_current_year->turnover));
                                        $current_net_profit = $calculation->net_profit;
                                        $applicable_csr = "";
                                        $temp = array();
                                        if ((int) $networth >= 5000000000) {
                                            $applicable_csr .= "Net worth";
                                            array_push($temp, "Net worth");
                                        }
                                        if ((int) $turnover >= 10000000000) {
                                            $applicable_csr .= "Turnover";
                                            array_push($temp, "Turnover");
                                        }
                                        if ((int) $current_net_profit >= 50000000) {
                                            $applicable_csr .= "Net Profit";
                                            array_push($temp, "Net Profit");
                                        }

                                        ?>
                                        <div class="form-group col-sm-6 ctcsr" style="display: table;">
                                            <label class="control-label">Criteria Triggering CSR</label>
                                            <input style="width:100%" type="text" class="form-control"
                                                id="applicable_csr" required="" name="applicable_csr"
                                                value="<?= implode(', ', $temp) ?>" aria-required="true" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="net_profit">Net Profit Computed under Section 198 : </label>

                                        <?php
                                        // echo '<pre>',var_dump($checkfinancial_last_two_year[1]->net_profit); echo '</pre>';
                                        ?>
                                    <table class="table profit">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Financial Year
                                                </th>
                                                <th scope="col">
                                                    <?php echo $financialYears[1]; ?>
                                                </th>
                                                <th scope="col">
                                                    <?php echo $financialYears[0]; ?>
                                                </th>
                                                <th scope="col">
                                                    <?php echo $current_financial_year; ?> <br />
                                                    <span class="audit-text-box"><?php if ($checkfinancial_current_year->is_auidted_data == 1)
                                                        echo 'Audited Data';
                                                    else
                                                        echo 'Provisional Data'; ?></span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Net Profit (₹)(For Sec. 135) * </strong> </td>
                                                <td>
                                                    <?= $calculationTwoPreviousYear->net_profit ?>
                                                    <?php if ($calculationTwoPreviousYear->net_profit) { ?>
                                                        </br><a href="javascript:void(0)"
                                                            class="btn btn-sm btn-theme calculate_csr preview-computation"
                                                            data-year="<?php echo $financialYears[1]; ?>"
                                                            data-key="3">Preview</a>
                                                    <?php } else {
                                                        if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) {
                                                            if ($total_financial < 4) { ?>
                                                                <img src="<?php echo SKIN_URL; ?>images/calcul.svg"
                                                                    class="calculate_csr  mt-15" alt=""
                                                                    data-year="<?php echo $financialYears[1]; ?>" data-key="3"
                                                                    data-id="#net_profit_fy_one" />
                                                            <?php }
                                                        }
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?= $calculationOnePreviousYear->net_profit ?>
                                                    <?php if ($calculationOnePreviousYear->net_profit) { ?>
                                                        </br><a href="javascript:void(0)"
                                                            class="btn btn-sm btn-theme calculate_csr preview-computation"
                                                            data-year="<?php echo $financialYears[0]; ?>"
                                                            data-key="2">Preview</a>
                                                    <?php } else {
                                                        if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) {
                                                            if ($total_financial < 4) { ?>
                                                                <img src="<?php echo SKIN_URL; ?>images/calcul.svg"
                                                                    class="calculate_csr  mt-15"
                                                                    data-year="<?php echo $financialYears[0]; ?>" data-key="2"
                                                                    data-id="#net_profit_fy_two" alt="" />
                                                            <?php }
                                                        }
                                                    } ?>
                                                </td>
                                                <td><?= $calculation->net_profit; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <p class="net_worth">* Net Profit & other details for the preceding financial
                                        years:</label>
                                    <table class="table npfy" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Sr.No.
                                                </th>
                                                <th scope="col">
                                                    Particulars
                                                </th>
                                                <th scope="col" colspan="3">
                                                    Amount in (₹)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <th colspan="2"></th>
                                            <th class="fy">FY-1 </br><?php echo $financialYears[1]; ?></th>
                                            <th class="fy">FY-2 </br><?php echo $financialYears[0]; ?></th>
                                            <th class="fy">FY-3 </br><?php echo $current_financial_year; ?></th>
                                        </tr>
                                        <tr>
                                            <th>01</th>
                                            <td>Profit Before Tax *</td>
                                            <td><?= $calculationTwoPreviousYear->NP_before_tax ?></td>
                                            <td><?= $calculationOnePreviousYear->NP_before_tax ?></td>
                                            <td><?= $calculation->NP_before_tax ?></td>
                                        </tr>
                                        <tr>
                                            <th>02</th>
                                            <td>Net Profit Computed under Section 198 *</td>
                                            <td><?= $calculationTwoPreviousYear->net_profit ?></td>
                                            <td><?= $calculationOnePreviousYear->net_profit ?></td>
                                            <td><?= $calculation->net_profit ?></td>
                                        </tr>
                                        <tr>
                                            <th>03</th>
                                            <td>Total amount adjusted as per rule 2(1)(h) of CSR Policy Rule 2014 *</td>
                                            <td><?= $calculationTwoPreviousYear->amt_adjusted ?></td>
                                            <td><?= $calculationOnePreviousYear->amt_adjusted ?></td>
                                            <td><?= $calculation->amt_adjusted ?></td>
                                        </tr>
                                        <tr>
                                            <th>04</th>
                                            <td>Total Net Profit for section 135 (2-3)</td>
                                            <td><?= $calculationTwoPreviousYear->total_net_profit ?></td>
                                            <td><?= $calculationOnePreviousYear->total_net_profit ?></td>
                                            <td><?= $calculation->total_net_profit ?></td>
                                        </tr>
                                    </table>
                                </div>

                                <?php
                                //echo '<pre>',var_dump($csr_two_obligation_form->percentage_of_avg_net_profit); echo '</pre>';
                                ?>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="form-group col-sm-6 ctcsr" style="display: table;">
                                            <label class="control-label">Average net profit of the company as per
                                                section
                                                135(5):</label>
                                            <input type="text" class="form-control" id="average_net_profit" required=""
                                                name="average_net_profit"
                                                value="<?= $total_average = round(($calculationTwoPreviousYear->total_net_profit + $calculationOnePreviousYear->total_net_profit + $calculation->total_net_profit) / 3); ?>"
                                                aria-required="true" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="form-group col-sm-6 ctcsr" style="display: table;">
                                            <label class="control-label">Whether CSR Policy has been framed * </label>
                                            <div class="yn">
                                                <div><input type="radio" id="yes" name="is_CSR_policy_created" value="1"
                                                        required <?php if ($csr_two_obligation_form->is_CSR_policy_created == 1) {
                                                            echo "checked";
                                                        } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                              echo 'disabled';
                                                          } ?> />
                                                    <label for="yes">Yes</label>
                                                </div>
                                                <div><input type="radio" id="no" name="is_CSR_policy_created" value="2"
                                                        required <?php if ($csr_two_obligation_form->is_CSR_policy_created == 2) {
                                                            echo "checked";
                                                        } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                              echo 'disabled';
                                                          } ?> />
                                                    <label for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="form-group col-sm-12 ctcsr"
                                            style="display: table;text-align: left;">
                                            <label class="control-label">Whether following has been disclosed on the
                                                website
                                                of the company in pursuance of Rule 9 of Companies (CSR Policy) Rules,
                                                2014
                                                : * </label>
                                            <div class="csrpolicy">
                                                <div class="col-sm-4">
                                                    <label class="control-label">CSR Policy</label>
                                                    <div class="yn">
                                                        <div><input type="radio" id="yes" name="is_CSR_policy_displayed"
                                                                value="1" required <?php if ($csr_two_obligation_form->is_CSR_policy_displayed == 1) {
                                                                    echo "checked";
                                                                } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                                      echo 'disabled';
                                                                  } ?> />
                                                            <label for="yes">Yes</label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" id="no" name="is_CSR_policy_displayed"
                                                                value="2" required <?php if ($csr_two_obligation_form->is_CSR_policy_displayed == 2) {
                                                                    echo "checked";
                                                                } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                                      echo 'disabled';
                                                                  } ?> />
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="form-group col-sm-12 ctcsr" <?php if ($csr_two_obligation_form->is_CSR_policy_displayed == 1) {
                                            echo "style='display:block'";
                                        } else {
                                            echo "style='display:none'";
                                        } ?>>
                                            <label class="control-label">Link to CSR Policy * </label>
                                            <input placeholder="https://www.hul.co.in/investor-relations/corporate-gove"
                                                type="text" class="form-control link-pol domain-url" id=""
                                                name="csr_policy_link" <?php if ($csr_two_obligation_form->is_CSR_policy_displayed == 1) {
                                                    echo "required";
                                                } ?>
                                                value="<?= $csr_two_obligation_form->CSR_policy_link; ?>" <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                      echo 'readonly';
                                                  } ?> />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="form-group col-sm-12 ctcsr"
                                            style="display: table; text-align: left;">
                                            <label class="control-label">Whether any amount is available for set off in
                                                pursuance of sub-rule (3) of Rule 7 of Companies (CSR Policy) Rules,
                                                2014: *
                                            </label>
                                            <div class="csrpolicy">
                                                <div class="col-sm-4">
                                                    <div class="yn">
                                                        <div><input type="radio" id="yes"
                                                                name="csr_set_off_amt_amount_avialable" required
                                                                value="1" <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                    echo "checked";
                                                                } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                                      echo 'disabled';
                                                                  } ?> />
                                                            <label for="yes">Yes</label>
                                                        </div>
                                                        <div><input type="radio" id="no"
                                                                name="csr_set_off_amt_amount_avialable" required
                                                                value="2" <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 2) {
                                                                    echo "checked";
                                                                } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                                      echo 'disabled';
                                                                  } ?> />
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 turnover" id="preceding-year-end-after" <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                    echo "style='display:block'";
                                } else {
                                    echo "style='display:none'";
                                } ?>>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Sr. No.
                                                </th>
                                                <th scope="col">
                                                    Financial Year
                                                </th>
                                                <th scope="col">
                                                    Amount available for set-off <br> (₹) *
                                                </th>
                                                <th scope="col">
                                                    Amount set-off in the financial year, if any <br>(₹) *
                                                </th>
                                                <th scope="col">
                                                    Balance Amount <br>(₹)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>FY-1 (YE 31/03/
                                                    <?php echo $lastThreeYears[1] + 1; ?>)
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input type="number" name="csr_set_off_amt[0][avaial_amount]"
                                                            value="<?= $csr_set_off_amt_last_year_one->set_off_amt_available; ?>"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?>
                                                            class="form-control available_amount_cal fyone_avaial_amount">
                                                    <?php } else {
                                                        echo $csr_set_off_amt_last_year_one->set_off_amt_available;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input type="number" name="csr_set_off_amt[0][setoff_amount]"
                                                            value="<?= $csr_set_off_amt_last_year_one->amt_set_off_in_FY; ?>"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?>
                                                            class="form-control available_amount_cal fyone_setoff_amount">
                                                    <?php } else {
                                                        echo $csr_set_off_amt_last_year_one->amt_set_off_in_FY;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input type="number" name="csr_set_off_amt[0][balance_amount]"
                                                            value="<?= $csr_set_off_amt_last_year_one->balance_set_off; ?>"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?>
                                                            class="form-control fyone_balance_amount" readonly>
                                                    <?php } else {
                                                        echo $csr_set_off_amt_last_year_one->balance_set_off;
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>02</td>
                                                <td>FY-2 (YE 31/03/
                                                    <?php echo $lastThreeYears[2] + 1; ?>)
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input type="number" name="csr_set_off_amt[1][avaial_amount]"
                                                            value="<?= $csr_set_off_amt_last_year_two->set_off_amt_available; ?>"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?>
                                                            class="form-control available_amount_cal fytwo_avaial_amount">
                                                    <?php } else {
                                                        echo $csr_set_off_amt_last_year_two->set_off_amt_available;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input type="number" name="csr_set_off_amt[1][setoff_amount]"
                                                            value="<?= $csr_set_off_amt_last_year_two->amt_set_off_in_FY; ?>"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?>
                                                            class="form-control available_amount_cal fytwo_setoff_amount">
                                                    <?php } else {
                                                        echo $csr_set_off_amt_last_year_two->amt_set_off_in_FY;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input type="number" name="csr_set_off_amt[1][balance_amount]"
                                                            value="<?= $csr_set_off_amt_last_year_two->balance_set_off; ?>"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?>
                                                            class="form-control fytwo_balance_amount" readonly>
                                                    <?php } else {
                                                        echo $csr_set_off_amt_last_year_two->balance_set_off;
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>03</td>
                                                <td>FY-3 (YE 31/03/
                                                    <?php echo $lastThreeYears[2] + 2; ?>)
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                                        <input type="number"
                                                            class="form-control available_amount_cal fythree_avaial_amount"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?> name="csr_set_off_amt[2][avaial_amount]"
                                                            value="<?= $csr_set_off_amt_fy->set_off_amt_available; ?>"
                                                            aria-required="true" />
                                                    <?php } else {
                                                        echo $csr_set_off_amt_fy->set_off_amt_available;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                                        <input type="number"
                                                            class="form-control available_amount_cal fythree_setoff_amount"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?> name="csr_set_off_amt[2][setoff_amount]"
                                                            value="<?= $csr_set_off_amt_fy->amt_set_off_in_FY; ?>"
                                                            aria-required="true" />
                                                    <?php } else {
                                                        echo $csr_set_off_amt_fy->amt_set_off_in_FY;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                                        <input type="number" class="form-control fythree_balance_amount"
                                                            <?php if ($csr_two_obligation_form->is_CSR_setoff_available == 1) {
                                                                echo "required";
                                                            } ?>
                                                            name="csr_set_off_amt[2][balance_amount]"
                                                            value="<?= $csr_set_off_amt_fy->balance_set_off; ?>"
                                                            aria-required="true" readonly />
                                                    <?php } else {
                                                        echo $csr_set_off_amt_fy->balance_set_off;
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>04</td>
                                                <td>
                                                    Total
                                                </td>
                                                <td id="text-amount-available">
                                                    <?php echo $csr_set_off_amt_fy->set_off_amt_available + $csr_set_off_amt_last_year_two->set_off_amt_available + $csr_set_off_amt_last_year_one->set_off_amt_available; ?>
                                                </td>
                                                <td id="text-amount-set-off">
                                                    <?php echo $csr_set_off_amt_fy->amt_set_off_in_FY + $csr_set_off_amt_last_year_two->amt_set_off_in_FY + $csr_set_off_amt_last_year_one->amt_set_off_in_FY; ?>
                                                </td>
                                                <td id="text-amount-balance">
                                                    <?php echo $csr_set_off_amt_fy->balance_set_off + $csr_set_off_amt_last_year_two->balance_set_off + $csr_set_off_amt_last_year_one->balance_set_off; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 ">
                                            <div class="form-group ctcsr" style="display: table;">
                                                <label class="control-label">2% of Average net profit of the company as
                                                    per
                                                    section 135(5) * </label>
                                                <input type="text" class="form-control avg_net_profit" id="" required=""
                                                    value="<?= round(($total_average / 100) * 2); ?>"
                                                    name="avg_net_profit" aria-required="true" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 ">
                                            <div class="form-group ctcsr" style="display: table;">
                                                <label class="control-label">Surplus arising out of the CSR projects/
                                                    programs or activities of the previous FY, if any * </label>
                                                <input type="number" class="form-control available_amount_cal"
                                                    id="text-surplus-amount" style="background-color: #fff;color:black"
                                                    required="" name="surplus_amount"
                                                    value="<?= $csr_two_obligation_form->surplus_from_CSR_projects; ?>"
                                                    aria-required="true" <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                        echo 'readonly';
                                                    } ?> />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 event-hide-box" <?php if (!isset($csr_two_obligation_form->amt_to_be_set_off) || $csr_two_obligation_form->amt_to_be_set_off == 0) {
                                            echo "style='display:none'";
                                        } ?>>
                                            <div class="form-group ctcsr" style="display: table;">
                                                <label class="control-label">Amount required to be set off for the
                                                    financial
                                                    year, if any * </label>
                                                <input placeholder="" type="number" class="form-control"
                                                    id="text-amount-to-be-set-off" required=""
                                                    name="amount_to_be_set_off"
                                                    value="<?php echo ($csr_two_obligation_form->amt_to_be_set_off) ? $csr_two_obligation_form->amt_to_be_set_off : 0; ?>"
                                                    aria-required="true" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12  event-hide-box" <?php if (!isset($csr_two_obligation_form->amt_to_be_set_off) || $csr_two_obligation_form->amt_to_be_set_off == 0) {
                                            echo "style='display:none'";
                                        } ?>>
                                            <div class="form-group ctcsr" style="display: table;">
                                                <label class="control-label">If Set Off is available, upload Board
                                                    Resolution for use of same * </label>
                                                <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                                    <input type="file" name="set_off_board_resolution_file"
                                                        accept="application/pdf" class="form-control upload __upload"
                                                        id="fileOne" data-uploaded="<?php if ($csr_two_obligation_form->set_off_board_resolution_file)
                                                            echo 1;
                                                        else
                                                            0; ?>" style="margin-top: 58px;width: 200px;" />
                                                    <img src="<?php echo SKIN_URL; ?>images/board.svg"
                                                        style="width: 200px;" />
                                                <?php } ?>
                                                <?php
                                                if ($csr_two_obligation_form->set_off_board_resolution_file) {
                                                    echo '<a href="' . base_url() . 'public/uploads/csr/csr_compliance/' . $csr_two_obligation_form->set_off_board_resolution_file . '" target="_blank" id="targetOne" style="float:left;" class="preview">Preview</a>';
                                                } else { ?>
                                                    <a href="#" target="_blank" id="targetOne"
                                                        style="float:left;display:none;" class="preview">Preview</a>
                                                <?php } ?>
                                                <span style="float:left;color:red;" class="file-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group ctcsr" style="display: table;">
                                                <label class="control-label">Total CSR obligation for the financial year
                                                    *
                                                </label>
                                                <input type="text" class="form-control" id="text-csr-obligation"
                                                    required="" name="csr_obligation"
                                                    value="<?= round((($calculation->total_net_profit / 100) * 2) + $csr_two_obligation_form->surplus_from_CSR_projects - $csr_two_obligation_form->amt_to_be_set_off); ?>"
                                                    aria-required="true" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                                    <?php
                                    //$csr_two_obligation_form->CSR_obligation_current_FY
                                    // echo '<pre>',var_dump($csr_ongoing_projects_preceeding_years_details); echo '</pre>';
                                    // echo '<pre>',var_dump($csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account); echo '</pre>';
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-sm-12 ctcsr"
                                            style="display: table; text-align: left;">
                                            <p class="net_worth" style="color:#000;font-size:18px">
                                                Details of CSR amount spent in
                                                the financial year for projects of the preceding financial
                                                year(s):</p>
                                            <p class="net_worth" style="color:#000;font-size:15px">Whether any unspent
                                                amount of
                                                preceding
                                                three financial years (financial year ending after January 2021) has
                                                been
                                                spent in the financial year * </p>
                                            <div class="csrpolicy">
                                                <div class="col-sm-4">
                                                    <div class="yn">
                                                        <div><input type="radio"
                                                                name="is_unspent_for_preceeding_3_years_after_22_Jan_21"
                                                                value="1" required <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                                    echo "checked";
                                                                } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                                      echo 'disabled';
                                                                  } ?> />
                                                            <label for="yes">Yes</label>
                                                        </div>
                                                        <div>
                                                            <input type="radio"
                                                                name="is_unspent_for_preceeding_3_years_after_22_Jan_21"
                                                                value="2" required <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 2) {
                                                                    echo "checked";
                                                                } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                                      echo 'disabled';
                                                                  } ?> />
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preceding" <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                        echo "style='display:block'";
                                    } else {
                                        echo "style='display:none'";
                                    } ?>>

                                        <p class="net_worth" style="color:#000;font-size:14px">Details of CSR amount
                                            spent in the
                                            financial year pertaining to three preceding financial year(s) * </p>

                                        <table class="table profit">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Preceding Financial Years</th>
                                                    <th scope="col">Amount transferred to Unspent CSR A/c under section
                                                        135(6) (₹)</th>
                                                    <th scope="col">Balance amount in Unspent CSR A/c under section
                                                        135(6)
                                                        (₹)</th>
                                                    <th scope="col">Amount spent in the Financial Year (₹)</th>
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
                                                <th>FY - 1 (YE 31/03/<?php echo $lastThreeYears[1] + 1; ?>)</th>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[0][amt_transferred_to_CSR_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_CSR_account ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_CSR_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[0][balance_amt_in_CSR_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_one->balance_amt_in_CSR_account ?>"
                                                            oninput="validateAndCalculate(0)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_one->balance_amt_in_CSR_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[0][amt_spent_in_FY]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_one->amt_spent_in_FY ?>"
                                                            oninput="validateAndCalculate(0)" />
                                                        <span class="error-message text-danger" data-row="0"
                                                            data-field="error-msg" style="display:none;">Amount spent cannot
                                                            exceed balance amount!</span>
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_one->amt_spent_in_FY;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control" id="amt_transferred_to_fund_account_0"
                                                            name="pertaining_three_years[0][amt_transferred_to_fund_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_fund_account ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_one->amt_transferred_to_fund_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="date" class="form-control"
                                                            name="pertaining_three_years[0][date_of_transferred_to_fund_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_one->date_of_transferred_to_fund_account ?>"
                                                            onkeydown="return false" max="<?php echo date('Y-m-d'); ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_one->date_of_transferred_to_fund_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[0][amt_remaining_to_spent]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_one->amt_remaining_to_spent ?>"
                                                            oninput="validateAndCalculate(0)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_one->amt_remaining_to_spent;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" class="form-control"
                                                            name="pertaining_three_years[0][deficiency]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_one->deficiency ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_one->deficiency;
                                                    } ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>FY - 2 (YE 31/03/<?php echo $lastThreeYears[2] + 1; ?>)</th>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[1][amt_transferred_to_CSR_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_CSR_account ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_CSR_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[1][balance_amt_in_CSR_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_two->balance_amt_in_CSR_account ?>"
                                                            oninput="validateAndCalculate(1)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_two->balance_amt_in_CSR_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[1][amt_spent_in_FY]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_two->amt_spent_in_FY ?>"
                                                            oninput="validateAndCalculate(1)" />

                                                        <span class="error-message text-danger" data-row="1"
                                                            data-field="error-msg" style="display:none;">Amount spent cannot
                                                            exceed balance amount!</span>
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_two->amt_spent_in_FY;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[1][amt_transferred_to_fund_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_fund_account ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_two->amt_transferred_to_fund_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="date" class="form-control"
                                                            name="pertaining_three_years[1][date_of_transferred_to_fund_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_two->date_of_transferred_to_fund_account ?>"
                                                            onkeydown="return false" max="<?= date('Y-m-d'); ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_two->date_of_transferred_to_fund_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[1][amt_remaining_to_spent]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_two->amt_remaining_to_spent ?>"
                                                            oninput="validateAndCalculate(1)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_two->amt_remaining_to_spent;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="text" class="form-control"
                                                            name="pertaining_three_years[1][deficiency]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_two->deficiency ?>"
                                                            onpaste="return false;"
                                                            onkeypress="return /[a-zA-Z ]/i.test(event.key)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_two->deficiency;
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>FY - 3 (YE
                                                    31/03/<?php $parts = explode('-', $current_financial_year);
                                                    echo $parts[0] + 1; ?>)
                                                </th>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[2][amt_transferred_to_CSR_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[2][balance_amt_in_CSR_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_FY->balance_amt_in_CSR_account ?>"
                                                            oninput="validateAndCalculate(2)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_FY->balance_amt_in_CSR_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[2][amt_spent_in_FY]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_spent_in_FY ?>"
                                                            oninput="validateAndCalculate(2)" />

                                                        <span class="error-message text-danger" data-row="2"
                                                            data-field="error-msg" style="display:none;">Amount spent cannot
                                                            exceed balance amount!</span>
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_FY->amt_spent_in_FY;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[2][amt_transferred_to_fund_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_fund_account ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_fund_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="date" class="form-control"
                                                            name="pertaining_three_years[2][date_of_transferred_to_fund_account]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_FY->date_of_transferred_to_fund_account ?>"
                                                            onkeydown="return false" max="<?= date('Y-m-d'); ?>" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_FY->date_of_transferred_to_fund_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="number" min="0"
                                                            class="form-control"
                                                            name="pertaining_three_years[2][amt_remaining_to_spent]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account ?>"
                                                            oninput="validateAndCalculate(2)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_FY->amt_transferred_to_CSR_account;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy'] && $total_financial < 4) { ?>
                                                        <input <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                                            echo "required";
                                                        } ?> type="text" class="form-control"
                                                            name="pertaining_three_years[2][deficiency]"
                                                            value="<?= $csr_amt_spent_pertaining_three_years_FY->deficiency ?>"
                                                            onpaste="return false;"
                                                            onkeypress="return /[a-zA-Z ]/i.test(event.key)" />
                                                    <?php } else {
                                                        echo $csr_amt_spent_pertaining_three_years_FY->deficiency;
                                                    } ?>
                                                </td>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="preceding" <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                        echo "style='display:block'";
                                    } else {
                                        echo "style='display:none'";
                                    } ?>>
                                        <?php
                                        //  echo '<pre>',var_dump($csr_ongoing_projects_preceeding_years_details); echo '</pre>';
                                        ?>
                                        <p class="net_worth" style="color:#000;font-size:14px">Details of CSR amount
                                            spent in the
                                            financial year for ongoing projects of the preceding financial year(s) *
                                        </p>

                                        <div class="yn">
                                            <label for="yes">Number of Ongoing Projects:</label>
                                            <label for="no" class="no-ongoing-project">1</label>
                                        </div>

                                        <table class="table profit">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sr. No.</th>
                                                    <th scope="col">Project ID</th>
                                                    <th scope="col">Name of the Projects</th>
                                                    <th scope="col">Financial year in which the project was commenced
                                                    </th>
                                                    <th scope="col">Amount spent for the project at the beginning of the
                                                        Financial Year (in ₹)</th>
                                                    <th scope="col">Amount spent in the financial year</th>
                                                    <th scope="col">Cumulative Amount Spent for at the end of the
                                                        Financial
                                                        Year (in ₹)</th>
                                                    <th scope="col">Status of the project - Completed/ Ongoing</th>
                                                    <th class="table-delete-icon"> </th>
                                                </tr>
                                            </thead>
                                            <tbody class="ongoing_project_body">

                                                <?php
                                                if (count($csr_ongoing_projects_preceeding_years_details) > 0) {
                                                    foreach ($csr_ongoing_projects_preceeding_years_details as $keys => $vals) {
                                                        if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) {
                                                            echo '<tr class="ongoing_projects_preceeding_row">
                            <th>' . ($keys + 1) . '</th>
                            <td>
                                <input placeholder="" type="text" class="form-control" id="" required="" name="project_id[]" value="' . $vals->project_id . '" aria-required="true" />
                            </td>
                            <td>
                                <input placeholder="" type="text" class="form-control" id="" required="" name="project_name[]" value="' . $vals->project_name . '" onpaste="return false;"  onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" />
                            </td>
                            <td>
                                <input placeholder="" type="date" class="form-control" id=""
                                    required=""
                                    name="FY_year_project_commenced[]"
                                    value="' . $vals->FY_year_project_commenced . '" aria-required="true"  onkeydown="return false" max="' . date('Y-m-d') . '"/>
                            </td>
                            <td><input placeholder="" type="number" class="form-control commutative-calculation-event" id=""
                                    required=""
                                    name="amt_spent_start_of_year[]"
                                    value="' . $vals->amt_spent_start_of_year . '" aria-required="true" /></td>
                            <td><input placeholder="" type="number" class="form-control commutative-calculation-event" id=""
                                    required=""
                                    name="amt_spent_in_year[]"
                                    value="' . $vals->amt_spent_in_year . '" aria-required="true" /></td>
                            <td>
                                <input placeholder="" type="number" class="form-control commutative-calculation-text" id="" required="" name="commutative_amt_spent[]" value="' . $vals->commutative_amt_spent . '" aria-required="true" readonly />
                            </td>
                            <td>
                                <select class="form-control" name="project_status[]" required>
                                    <option value="">Select</option>
                                    <option ' . (($vals->project_status == "Completed") ? "selected" : "") . ' value="Completed">Completed</option>
                                    <option ' . (($vals->project_status == "Ongoing") ? "selected" : "") . ' value="Ongoing">Ongoing</option>
                                </select>
                            </td>
                            <td  class="table-delete-icon">
                            ' . (($keys > 0) ?
                                                                "<a href='javascript:void(0)' class='event-delete-row-project'>  
                                    <img src='" . SKIN_URL . "images/deleteIconsline.svg' alt=''/>
                                </a>" : "") . '
                            </td>
                        </tr>';
                                                        } else {
                                                            echo '<tr class="ongoing_projects_preceeding_row">
                                <th>' . ++$keys . '</th>
                                <td>' . $vals->project_id . '</td>
                                <td>' . $vals->project_name . '</td>
                                <td>' . $vals->FY_year_project_commenced . '</td>
                                <td>' . $vals->amt_spent_start_of_year . '</td>
                                <td>' . $vals->amt_spent_in_year . '</td>
                                <td>' . $vals->commutative_amt_spent . '</td>
                                <td>' . $vals->project_status . '</td>
                                <td  class="table-delete-icon"></td
                            </tr>';
                                                        }
                                                    }
                                                } else {
                                                    echo '<tr class="ongoing_projects_preceeding_row">
                            <th>1</th>
                            <td>
                                <input type="text" class="form-control" id="" name="project_id[]"  />
                            </td>
                            <td>
                                <input type="text" class="form-control" id="" name="project_name[]"  onpaste="return false;"  onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" />
                            </td>
                            <td>
                                <input type="date" class="form-control" id=""
                                    
                                    name="FY_year_project_commenced[]"
                                     aria-required="true"  onkeydown="return false" max="' . date('Y-m-d') . '"/>
                            </td>
                            <td><input  type="number" class="form-control commutative-calculation-event" id=""
                                   
                                    name="amt_spent_start_of_year[]"
                                     aria-required="true" /></td>
                            <td><input  type="number" class="form-control commutative-calculation-event" id=""
                                    
                                    name="amt_spent_in_year[]"
                                     aria-required="true" /></td>
                            <td>
                                <input placeholder="" type="number" class="form-control commutative-calculation-text" id="" name="commutative_amt_spent[]"  aria-required="true" readonly />
                            </td>
                            <td>
                                <select class="form-control" name="project_status[]">
                                    <option value="">Select</option>
                                    <option  value="Completed">Completed</option>
                                    <option  value="Ongoing">Ongoing</option>
                                </select>
                            </td>
                            <td  class="table-delete-icon"></td>
                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                    <div class="col-sm-12 preceding" <?php if ($csr_two_obligation_form->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) {
                                        echo "style='display:block;text-align: initial;'";
                                    } else {
                                        echo "style='display:none;text-align: initial;'";
                                    } ?>>
                                        <a href="javascript:void(0)" class="addMore"><span class="add-more-link">+ Add
                                                Row</span></a>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="wrap_flex_btn">
                                            <div class="form-group">
                                                <a href="<?= base_url() ?>dashboard/kycdashboard"
                                                    class="cancelBtn">Cancel</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary saveBtn"
                                                    <?= (empty($checkfinancial_current_year) || $event_btn == false) ? 'disabled' : '' ?>>Save &
                                                    Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>


                    <div id="Committee_Details" class="container tab-pane committee-tab">
                        <form method="post" action="<?php echo base_url() . "CsrCompliance/saveCommitteDetails"; ?>"
                            name="save_commitee_details">
                            <div class="row">
                                <div class="form-group col-sm-12 ctcsr" style="display: table; text-align: left;">
                                    <?php if ($csrcompliancedata->CSR_committee_constituted != 1) {
                                        if (!empty($applicable_csr) || $csr_two_obligation_form->surplus_from_CSR_projects > 0 || $ongoing_projects > 0) { ?>
                                            <label class="control-label" style="color:#FF6666;">As per CSR Criteria you are
                                                obliged to create a CSR committee at your Org</label>
                                        <?php }
                                    } ?>
                                    <div class="csrpolicy">
                                        <div class="col-sm-6">
                                            <p class="net_worth" style="color:#000;margin-top: 0;margin-bottom: 15px;">
                                                Whether CSR Committee has been constituted *
                                            </p>
                                            <div class="yn">
                                                <div><input class="form-check-input check_is_committee_constituted"
                                                        type="radio" name="is_committee_constituted" id="yes" value="1"
                                                        <?php echo ($csrcompliancedata->CSR_committee_constituted == 1 || $csr_two_obligation_form->is_CSR_policy_created == 1) ? "checked" : ""; ?> />
                                                    <label for="yes">Yes</label>
                                                </div>
                                                <div>
                                                    <input class="form-check-input check_is_committee_constituted"
                                                        type="radio" name="is_committee_constituted" id="no" value="2"
                                                        <?php echo ($csrcompliancedata->CSR_committee_constituted == 2 && $csr_two_obligation_form->is_CSR_policy_created != 1) ? "checked" :
                                                            ""; ?> <?= ($csr_two_obligation_form->is_CSR_policy_created == 1) ? 'disabled' : '' ?> />
                                                    <label for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 event-no-of-director"
                                            style='<?php echo ($csrcompliancedata->CSR_committee_constituted == 1 || $csr_two_obligation_form->is_CSR_policy_created == 1) ? "display:block" : "display:none"; ?>'>
                                            <p class="net_worth" style="color:#000;margin-top: 0;margin-bottom: 15px;">
                                                Number of directors composing CSR Committee *
                                            </p>
                                            <div class="yn">
                                                <input type="number"
                                                    class="form-control csr_commitee_compostion_directors_count" min="3"
                                                    name="csr_commitee_compostion_directors_count"
                                                    value="<?= ($csrcompliancedata->no_of_CSR_directors >= 2) ? $csrcompliancedata->no_of_CSR_directors : 3; ?>"
                                                    readonly />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="doccsr" <?php echo ($csrcompliancedata->CSR_committee_constituted == 1 || $csr_two_obligation_form->is_CSR_policy_created == 1) ? " " : "style='display:none;'"; ?>>
                                        <div class="col-lg-12">
                                            <p class="net_worth" style="color:#000;margin-top: 0;margin-bottom: 15px;">
                                                Date of constitution of CSR committee * </p>
                                            <input type="date" value="<?= $csrcompliancedata->date_of_constitution; ?>"
                                                onkeydown="return false" max="<?php echo date('Y-m-d'); ?>"
                                                class="form-control bg-c-white w-276" id="regDate"
                                                name="csr_commitee_constitution_date" required>
                                        </div>
                                        <div class="col-lg-12">
                                            <p class="net_worth"
                                                style="color:#000;margin-top: 30px;margin-bottom: 15px;">CSR Commitee
                                                Composition:</p>
                                            <div class="row">
                                                <table class="no-border-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Name of Director *</th>
                                                            <th>Position (Chair-person/ Member) *</th>
                                                            <th>DIN * </th>
                                                            <th>Category *</th>
                                                            <th>Date of Appointment *</th>
                                                            <th class="table-delete-icon"> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="csr_commitee_compostion_dir_row">
                                                        <?php
                                                        if ($csr_CommiteeDetails) {
                                                            foreach ($csr_CommiteeDetails as $key => $cvals) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <input placeholder="Name of Director"
                                                                            onpaste="return false;"
                                                                            onkeypress="return /[a-zA-Z ]/i.test(event.key)"
                                                                            type="text" maxlength="100" class="form-control"
                                                                            name="csr_commitee_compostion_name_of_director[]"
                                                                            value="<?= $cvals->name_of_director ?>"
                                                                            title="<?= $cvals->name_of_director ?>" required="">
                                                                    </td>
                                                                    <td>
                                                                        <select name="csr_commitee_compostion_postion[]"
                                                                            class="form-control chairperson-event" required="">
                                                                            <option value="">Select Position</option>
                                                                            <option value="1" <?php if ($cvals->postion == 1) {
                                                                                echo "selected";
                                                                            } ?>>Member</option>
                                                                            <option value="2" <?php if ($cvals->postion == 2) {
                                                                                echo "selected";
                                                                            } ?>>Chairperson</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input placeholder="DIN" type="number"
                                                                            class="form-control"
                                                                            name="csr_commitee_compostion_din[]"
                                                                            value="<?= (is_numeric($cvals->DIN)) ? $cvals->DIN : '' ?>"
                                                                            required="">
                                                                    </td>
                                                                    <td>
                                                                        <select name="csr_commitee_compostion_category[]"
                                                                            class="form-control" required="">
                                                                            <option value="">Select Category</option>
                                                                            <option value="1" <?php if ($cvals->category == 1) {
                                                                                echo "selected";
                                                                            } ?>>MD</option>
                                                                            <option value="2" <?php if ($cvals->category == 2) {
                                                                                echo "selected";
                                                                            } ?>>Executive</option>
                                                                            <option value="3" <?php if ($cvals->category == 3) {
                                                                                echo "selected";
                                                                            } ?>>Non-Executive Non
                                                                                Independent
                                                                            </option>
                                                                            <option value="4" <?php if ($cvals->category == 4) {
                                                                                echo "selected";
                                                                            } ?>>Non-Executive Independent
                                                                            </option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" class="form-control"
                                                                            name="csr_commitee_compostion_date_of_appointment[]"
                                                                            value="<?= $cvals->date_of_appointment ?>"
                                                                            onkeydown="return false"
                                                                            max="<?php echo date('Y-m-d'); ?>" required="">
                                                                    </td>
                                                                    <td class="table-delete-icon">
                                                                        <?php if ($key >= 3) { ?>
                                                                            <a href="javascript:void(0)"
                                                                                class="event-delete-row-committee">
                                                                                <img src="<?php echo SKIN_URL; ?>images/deleteIconsline.svg"
                                                                                    alt="">
                                                                            </a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        } else {
                                                            for ($i = 0; $i < 3; $i++) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <input placeholder="Name of Director"
                                                                            onpaste="return false;"
                                                                            onkeypress="return /[a-zA-Z ]/i.test(event.key)"
                                                                            type="text" maxlength="100" class="form-control"
                                                                            name="csr_commitee_compostion_name_of_director[]"
                                                                            required="">
                                                                    </td>
                                                                    <td>
                                                                        <select name="csr_commitee_compostion_postion[]"
                                                                            class="form-control chairperson-event" required="">
                                                                            <option value="">Select Position</option>
                                                                            <option value="1">Member</option>
                                                                            <option value="2">Chairperson</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input placeholder="DIN" type="number"
                                                                            class="form-control"
                                                                            name="csr_commitee_compostion_din[]" required="">
                                                                    </td>
                                                                    <td>
                                                                        <select name="csr_commitee_compostion_category[]"
                                                                            class="form-control valid" required="">
                                                                            <option value="">Select Category</option>
                                                                            <option value="1">MD</option>
                                                                            <option value="2">Executive</option>
                                                                            <option value="3">Non-Executive Non Independent
                                                                            </option>
                                                                            <option value="4">Non-Executive Independent</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" class="form-control"
                                                                            name="csr_commitee_compostion_date_of_appointment[]"
                                                                            onkeydown="return false"
                                                                            max="<?php echo date('Y-m-d'); ?>" required="">
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                                <div class="col-sm-12" style="text-align: initial;">
                                                    <a href="javascript:void(0)" class="add-another-member"><span
                                                            class="add-more-link">+ Add Another</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- taufiq -->
                                    <div class="csrpolicy doccsr" <?php echo ($csrcompliancedata->CSR_committee_constituted == 1 || $csr_two_obligation_form->is_CSR_policy_created == 1) ? " " : "style='display:none;'"; ?>>
                                        <div class="col-sm-6">
                                            <p class="net_worth" style="color:#000;margin-block:30px 15px;">Composition
                                                of CSR Committee</p>
                                            <div class="yn">
                                                <div><input type="radio" id="yes"
                                                        name="CSR_committee_constituted_displayed" value="1" required
                                                        <?php if ($csr_two_obligation_form->CSR_committee_constituted_displayed == 1) {
                                                            echo "checked";
                                                        } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                              echo 'disabled';
                                                          } ?> />
                                                    <label for="yes">Yes</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="no"
                                                        name="CSR_committee_constituted_displayed" value="2" required
                                                        <?php if ($csr_two_obligation_form->CSR_committee_constituted_displayed == 2) {
                                                            echo "checked";
                                                        } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                              echo 'disabled';
                                                          } ?> />
                                                    <label for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end taufiq -->

                                    <div class="col-sm-10 mt-100">
                                        <div class="wrap_flex_btn">
                                            <div class="form-group">
                                                <a href="<?= base_url() ?>CsrCompliance/dashboard"
                                                    class="cancelBtn">Back</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary saveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="Annual_Plan" class="container tab-pane annual-tab">
                        <div class="row">
                            <form action="<?php echo base_url() . 'CsrCompliance/saveAnnualDetail' ?>" method="post">
                                <input type="hidden" name="year" value="<?= $current_financial_year ?>" />
                                <div class="col-md-12">
                                    <?php if (($prime_year == $current_financial_year || $prime_year == $_GET['fy']) && !isset($director_report)) { ?>
                                        <label class="control-label">Annual Action Plan for Current FY * <a
                                                href="javascript:void(0)" class="info-tool-box"><img
                                                    src="<?php echo SKIN_URL; ?>images/info.png"><span>Add provisional
                                                    Annual Action Plan for the current FY</span></a></label>
                                    <?php } else {
                                        if (count($csr_annual_action_plan_current_year) > 0) { ?>
                                            <label class="control-label">Annual Action Plan for
                                                (<?= $current_financial_year ?>)</label>
                                        <?php }
                                    } ?>
                                    <?php if (count($csr_annual_action_plan_current_year) > 0) { ?>
                                        <?php if (!isset($director_report)) { ?>
                                            <a href="javascript:void(0)"
                                                class="control-label float-right mr-40 annual-action-plan-edit-event"><span
                                                    class="add-more-link"><img src="<?php echo SKIN_URL; ?>images/edit.png"
                                                        alt="" /> Edit Plan</span></a>
                                        <?php } ?>
                                        <table class="table annual-action-plan-view">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        Project Name
                                                    </th>
                                                    <th scope="col">
                                                        Location (District, State)
                                                    </th>
                                                    <th scope="col">
                                                        Activities / Sector specified in Schedule - VII of the companies
                                                        Act,2013
                                                    </th>
                                                    <th scope="col">
                                                        Budgeted Amount(₹)
                                                    </th>
                                                    <th scope="col">
                                                        Modalities of Utilisation of Funds
                                                    </th>
                                                    <th scope="col">
                                                        Manner of Execution as specified in Rule 4(1)
                                                    </th>
                                                    <th scope="col">
                                                        Implementation Schedule
                                                    </th>
                                                    <th scope="col">
                                                        Monitoring and Reporting Mechanism
                                                    </th>
                                                    <th scope="col">
                                                        Details of Need and Impact Assessment, if any
                                                    </th>
                                                    <th scope="col">
                                                        Project Type
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($csr_annual_action_plan_current_year as $key => $avals) { ?>
                                                    <tr>
                                                        <td><?= $avals->project_name ?></td>
                                                        <td><?= $avals->project_location_district ?>,<?= $avals->project_location_state ?>
                                                        </td>
                                                        <td>
                                                            <?php foreach ($sectors as $row) {
                                                                if ($avals->sectors == $row->sector_type) {
                                                                    echo $row->sector_type;
                                                                    break;
                                                                }
                                                            } ?>
                                                        </td>
                                                        <td><?= $avals->budgeted_amt ?></td>
                                                        <td><?= $avals->modalities_of_funds_utilisation ?></td>
                                                        <td><?= $avals->execution_manner ?></td>
                                                        <td>On or before 31st March
                                                            <?= date('Y', strtotime('+1 year', $avals->created_at)) ?>
                                                        </td>
                                                        <td><?= $avals->monitoring_n_reporting ?></td>
                                                        <td><?= $avals->details_of_impact_assessment ?></td>
                                                        <td><?= $avals->project_type ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    <?php }
                                    if (!isset($director_report)) { ?>
                                        <table class="table annual-action-plan-edit" <?php if (count($csr_annual_action_plan_current_year) > 0) {
                                            echo 'style="display:none;"';
                                        } ?>>
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        Project Name
                                                    </th>
                                                    <th scope="col">
                                                        Location (District, State)
                                                    </th>
                                                    <th scope="col">
                                                        Activities / Sector specified in Schedule - VII of the companies
                                                        Act,2013
                                                    </th>
                                                    <th scope="col">
                                                        Budgeted Amount(₹)
                                                    </th>
                                                    <th scope="col">
                                                        Modalities of Utilisation of Funds
                                                    </th>
                                                    <th scope="col">
                                                        Manner of Execution as specified in Rule 4(1)
                                                    </th>
                                                    <th scope="col">
                                                        Implementation Schedule
                                                    </th>
                                                    <th scope="col">
                                                        Monitoring and Reporting Mechanism
                                                    </th>
                                                    <th scope="col">
                                                        Details of Need and Impact Assessment, if any
                                                    </th>
                                                    <th scope="col">
                                                        Project Type
                                                    </th>
                                                    <th class="table-delete-icon"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="annual_action_row">
                                                <?php

                                                if (count($csr_annual_action_plan_current_year) > 0) {
                                                    foreach ($csr_annual_action_plan_current_year as $key => $avals) { ?>
                                                        <tr>
                                                            <td>
                                                                <input onpaste="return false;"
                                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" type="text"
                                                                    class="form-control" id="" required=""
                                                                    name="csr_annual_action_plan_project_name[]"
                                                                    value="<?= $avals->project_name ?>" aria-required="true" />
                                                            </td>
                                                            <td>
                                                                <select name="csr_annual_action_plan_project_location[]"
                                                                    class="form-control  location-select-2" required="">
                                                                    <?php foreach ($district as $row) { ?>
                                                                        <option <?php if (($avals->project_location_district . ',' . $avals->project_location_state) == $row->dst_name . ',' . $row->st_name) {
                                                                            echo "selected";
                                                                        } ?>
                                                                            value="<?= $row->dst_name . ',' . $row->st_name ?>">
                                                                            <?= $row->dst_name . ',' . $row->st_name ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="csr_annual_action_plan_sectors[]" class="form-control"
                                                                    required="" aria-required="true" aria-invalid="false">
                                                                    <?php foreach ($sectors as $row) { ?>
                                                                        <option <?php if ($avals->sectors == $row->sector_type) {
                                                                            echo "selected";
                                                                        } ?> value="<?= $row->sector_type ?>">
                                                                            <?= $row->sector_type ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input placeholder="" type="number" class="form-control" id=""
                                                                    required="" name="csr_annual_action_plan_budgeted_amt[]"
                                                                    value="<?= $avals->budgeted_amt ?>" aria-required="true" />
                                                            </td>
                                                            <td>
                                                                <select name="csr_annual_action_plan_utilisation[]"
                                                                    class="form-control" required="" aria-required="true"
                                                                    aria-invalid="false">
                                                                    <option <?php if ($avals->modalities_of_funds_utilisation == 'CSR Activities') {
                                                                        echo "selected";
                                                                    } ?> value="CSR Activities">
                                                                        CSR
                                                                        Activities</option>
                                                                    <option <?php if ($avals->modalities_of_funds_utilisation == 'Contribution to Specified Funds') {
                                                                        echo "selected";
                                                                    } ?>
                                                                        value="Contribution to Specified Funds">Contribution to
                                                                        Specified Funds</option>
                                                                    <option <?php if ($avals->modalities_of_funds_utilisation == 'Contribution to specified Incubators and R&D projects') {
                                                                        echo "selected";
                                                                    } ?>
                                                                        value="Contribution to specified Incubators and R&D projects">
                                                                        Contribution to specified Incubators and R&D projects
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="csr_annual_action_plan_execution_manner[]"
                                                                    class="form-control" required="" aria-required="true"
                                                                    aria-invalid="false">
                                                                    <option <?php if ($avals->execution_manner == 'By company itself') {
                                                                        echo "selected";
                                                                    } ?> value="By company itself">By
                                                                        company itself</option>
                                                                    <option <?php if ($avals->execution_manner == 'Through implementation agencies') {
                                                                        echo "selected";
                                                                    } ?>
                                                                        value="Through implementation agencies">Through
                                                                        implementation agencies</option>
                                                                    <option <?php if ($avals->execution_manner == 'In collaboration with one or more companies as prescribed Rule 4(4)') {
                                                                        echo "selected";
                                                                    } ?>
                                                                        value="In collaboration with one or more companies as prescribed Rule 4(4)">
                                                                        In collaboration with one or more companies as prescribed
                                                                        Rule 4(4)</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                On or before 31st March {<?= date('Y') ?>}
                                                            </td>
                                                            <td>
                                                                <input placeholder="" type="text" class="form-control" id=""
                                                                    required=""
                                                                    name="csr_annual_action_plan_monitoring_n_reporting[]"
                                                                    value="<?= $avals->monitoring_n_reporting ?>"
                                                                    aria-required="true" />
                                                            </td>
                                                            <td>
                                                                <input placeholder="" type="text" class="form-control" id=""
                                                                    required=""
                                                                    name="csr_annual_action_plan_details_of_impact_assessment[]"
                                                                    value="<?= $avals->details_of_impact_assessment ?>"
                                                                    aria-required="true" />
                                                            </td>
                                                            <td>
                                                                <select id="project_type_select"
                                                                    name="csr_annual_action_plan_project_type[]"
                                                                    class="form-control" required="" aria-required="true"
                                                                    aria-invalid="false">
                                                                    <option <?php if ($avals->project_type == 'Ongoing') {
                                                                        echo "selected";
                                                                    } ?> value="Ongoing">Ongoing</option>
                                                                    <option <?php if ($avals->project_type == 'Other than Ongoing') {
                                                                        echo "selected";
                                                                    } ?> value="Other than Ongoing">
                                                                        Other than Ongoing</option>
                                                                </select>



                                                            </td>
                                                            <td class="table-delete-icon">
                                                                <?php if ($key != 0) { ?>
                                                                    <a href='javascript:void(0)' class="event-delete-row">
                                                                        <img src="<?php echo SKIN_URL; ?>images/deleteIconsline.svg"
                                                                            alt="" />
                                                                    </a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td>
                                                            <input onpaste="return false;"
                                                                onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" type="text"
                                                                class="form-control" id="" required=""
                                                                name="csr_annual_action_plan_project_name[]" value=""
                                                                aria-required="true" />
                                                        </td>
                                                        <td>
                                                            <select name="csr_annual_action_plan_project_location[]"
                                                                class="form-control location-select-2" required="">
                                                                <option value="">Select Location</option>
                                                                <?php foreach ($district as $row) { ?>
                                                                    <option value="<?= $row->dst_name . ',' . $row->st_name ?>">
                                                                        <?= $row->dst_name . ',' . $row->st_name ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="csr_annual_action_plan_sectors[]" class="form-control"
                                                                required="" aria-required="true" aria-invalid="false">
                                                                <option value="">Select Sector</option>
                                                                <?php foreach ($sectors as $row) { ?>
                                                                    <option value="<?= $row->sector_type ?>">
                                                                        <?= $row->sector_type ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input placeholder="" type="number" class="form-control" id=""
                                                                required="" name="csr_annual_action_plan_budgeted_amt[]"
                                                                aria-required="true" />
                                                        </td>
                                                        <td>
                                                            <select name="csr_annual_action_plan_utilisation[]"
                                                                class="form-control" required="" aria-required="true"
                                                                aria-invalid="false">
                                                                <option value="CSR Activities">CSR Activities</option>
                                                                <option value="Contribution to Specified Funds">Contribution to
                                                                    Specified Funds</option>
                                                                <option
                                                                    value="Contribution to specified Incubators and R&D projects">
                                                                    Contribution to specified Incubators and R&D projects
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="csr_annual_action_plan_execution_manner[]"
                                                                class="form-control" required="" aria-required="true"
                                                                aria-invalid="false">
                                                                <option value="By company itself">By company itself</option>
                                                                <option value="Through implementation agencies">Through
                                                                    implementation agencies</option>
                                                                <option
                                                                    value="In collaboration with one or more companies as prescribed Rule 4(4)">
                                                                    In collaboration with one or more companies as prescribed
                                                                    Rule 4(4)</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            On or before 31st March {<?= date('Y') ?>}
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="" required=""
                                                                name="csr_annual_action_plan_monitoring_n_reporting[]" value=""
                                                                aria-required="true" />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="" required=""
                                                                name="csr_annual_action_plan_details_of_impact_assessment[]"
                                                                value="" aria-required="true" />
                                                        </td>
                                                        <td>
                                                            <select name="csr_annual_action_plan_project_type[]"
                                                                class="form-control" required="">
                                                                <option value="Ongoing">Ongoing</option>
                                                                <option value="Other than Ongoing">Other than Ongoing</option>
                                                            </select>
                                                        </td>
                                                        <td class="table-delete-icon"></td>
                                                    </tr>

                                                <?php } ?>

                                            </tbody>

                                        </table>

                                        <div class="col-sm-12 annual-action-plan-edit" <?php if (count($csr_annual_action_plan_current_year) > 0) {
                                            echo 'style="display:none;"';
                                        } ?>>
                                            <div class="row">
                                                <div class="col-sm-12" style="text-align: initial;">
                                                    <a href="javascript:void(0)" class="addmore-annual-row"><span
                                                            class="add-more-link">+ Add Row</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if ($annualPlanData) { ?>
                                    <div class="col-md-10 previous_year_annual_action_plan report-box-table mb-100 mt-50">
                                        <p class="net_worth">Previous Year Annual Action Plan</label>
                                        <table class="table-theme">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        Financial Year
                                                    </th>
                                                    <th scope="col">
                                                        No of Sectors
                                                    </th>
                                                    <th scope="col">
                                                        Sectors Impacted
                                                    </th>
                                                    <th scope="col">
                                                        CSR Expensed (₹)
                                                    </th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($annualPlanData as $row) { ?>
                                                    <tr>
                                                        <td><?= $row->FY_year ?></td>
                                                        <td><?= $row->no ?></td>
                                                        <td><?= $row->sector ?></td>
                                                        <td><?= $row->budget ?></td>
                                                        <td>
                                                            <a href="<?= base_url() ?>CsrCompliance/dashboard/?fy=<?= $row->FY_year ?>&tab=annual-tab"
                                                                class="btn btn-sm btn-theme">View</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                                <!-- taufiq -->
                                <div class="csrpolicy" style="margin-bottom:25px">
                                    <div class="col-sm-6">
                                        <p class="net_worth" style="color:#000;margin-block:15px;">CSR projects
                                            approved by
                                            the Board</p>

                                        <div class="yn">
                                            <div><input type="radio" id="yes" name="CSR_projects_displayed" value="1"
                                                    required <?php if ($csr_two_obligation_form->CSR_projects_displayed == 1) {
                                                        echo "checked";
                                                    } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                          echo 'disabled';
                                                      } ?>>
                                                <label for="yes">Yes</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="no" name="CSR_projects_displayed" value="2"
                                                    required <?php if ($csr_two_obligation_form->CSR_projects_displayed == 2) {
                                                        echo "checked";
                                                    } ?> <?php if (isset($_GET['fy']) && $prime_year != $_GET['fy']) {
                                                          echo 'disabled';
                                                      } ?>>
                                                <label for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end taufiq -->
                                <div class="col-sm-10">
                                    <div class="wrap_flex_btn">
                                        <div class="form-group">
                                            <a href="<?= base_url() ?>CsrCompliance/dashboard"
                                                class="cancelBtn">Back</a>
                                        </div>
                                        <?php if (!isset($director_report)) { ?>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary saveBtn annual-action-plan-btn"
                                                    <?php if (count($csr_annual_action_plan_current_year) > 0) {
                                                        echo 'style="display:none;"';
                                                    } ?>>Save</button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="Computation" class="container tab-pane report-box-table computaion-tab">
                        <div class="row">
                            <?php if ($computationRecords) { ?>
                                <div class="col-md-12 previous_year_annual_action_plan">
                                    <p class="net_worth">Previous Year Net Profit Calculations</label>
                                    <table class="table-theme">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Financial Year
                                                </th>
                                                <th scope="col">
                                                    Created On
                                                </th>
                                                <th scope="col">
                                                    Profit Before Tax(₹)
                                                </th>
                                                <th scope="col">
                                                    Net Profit-Section 198 (₹)
                                                </th>
                                                <th scope="col">
                                                    Net Profit-Section 135 (₹)
                                                </th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($computationRecords as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row->FY_year; ?></td>
                                                    <td><?php echo date('d-m-Y', $row->created_at); ?></td>
                                                    <td><?php echo $row->NP_before_tax; ?></td>
                                                    <td><?php echo $row->net_profit; ?></td>
                                                    <td><?php echo $row->total_net_profit; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>CsrCompliance/downloadPdf?fy=<?php echo $row->FY_year; ?>"
                                                            class="btn btn-sm btn-theme">Download</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php echo $this->pagination->create_links();
                            } ?>
                        </div>
                    </div>
                    <div id="CSR_Spent_Details" class="container tab-pane report-box-table report-tab">
                        <div class="row">
                            <div class="col-md-12 previous_year_annual_action_plan">
                                <ul class="nav nav-tabs sub-menu-list">
                                    <li class="nav-item director" data-name="director">
                                        <a class="nav-link  report-event-handler" data-key="1" href="#director_submenu"
                                            data-toggle="tab" aria-expanded="true">Director's Reports</a>
                                    </li>
                                    <li class="nav-item csr" data-name="csr">
                                        <a class="nav-link report-event-handler" data-key="2" href="#csr2_submenu"
                                            data-toggle="tab" aria-expanded="false">CSR-2</a>
                                    </li>
                                </ul>
                                <div class="sub-menu-content">
                                    <div id="director_submenu" class="container tab-pane report-box-table director">
                                        <div class="col-sm-3" style="float: inline-end;">
                                            <a href="<?php echo base_url(); ?>CsrCompliance/reportcreate"
                                                class="btn btn-primary btn-sm report-generation">Generate Director
                                                Report</a>
                                        </div>
                                        <div class="col-sm-3" style="float: inline-end;padding-top:10px">
                                            <select class="form-select filter-box-list fyreport"
                                                style="float: inline-end;padding-top:10px">
                                                <option value="">Filter By Year</option>
                                                <?php
                                                if (!$count_current_financial) { ?>
                                                    <option value="<?= $prime_year ?>"><?= $prime_year ?></option>
                                                <?php }
                                                if ($total_financial) {
                                                    foreach ($logs as $row) { ?>
                                                        <option value="<?= $row->FY_year ?>" <?= (isset($_GET['fy']) && $_GET['fy'] == $row->FY_year) ? 'selected' : '' ?>>
                                                            <?= $row->FY_year ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <?php if ($directorReport) { ?>
                                            <div class="col-sm-12" style="margin-top:50px">
                                                <p class="p-theme-title">Project Status</p>
                                            </div>
                                            <table class="table-theme">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            Year
                                                        </th>
                                                        <th scope="col">
                                                            Generated On
                                                        </th>
                                                        <th scope="col">
                                                            Ongoing
                                                        </th>
                                                        <th scope="col">
                                                            Other than Ongoing
                                                        </th>
                                                        <th scope="col">
                                                            Unspent Amt
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($directorReport as $row) { ?>
                                                        <tr>
                                                            <td><?= $row->FY_year ?></td>
                                                            <td><?= date('d-m-Y', $row->created_at) ?></td>
                                                            <td><?= ($row->ongoing ? $row->ongoing : '-') ?></td>
                                                            <td><?= ($row->other_than_ongoing ? $row->other_than_ongoing : '-') ?>
                                                            </td>
                                                            <td><?= $row->amt_unspent_for_FY ?></td>
                                                            <td>
                                                                <a target="_blank"
                                                                    href="<?= base_url() . 'CsrCompliance/previewreport?year=' . $row->FY_year . '&report_id=' . $row->id ?>"
                                                                    class="btn btn-sm btn-link">Views & Download</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } else { ?>
                                            <div class="col-sm-12" style="margin-top:50px">
                                                <p class="p-theme-title">No Records Found</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div id="csr2_submenu" class="container tab-pane report-box-table csr">
                                        <div class="col-sm-3" style="float: inline-end;">
                                            <a href="<?php echo base_url(); ?>CsrCompliance/closingreport"
                                                class="btn btn-primary btn-sm report-generation">Generate CSR-2
                                                Report</a>
                                        </div>
                                        <div class="col-sm-3" style="float: inline-end;padding-top:10px">
                                            <select class="form-select filter-box-list fyreport"
                                                style="float: inline-end;padding-top:10px">
                                                <option value="">Filter By Year</option>
                                                <?php
                                                if (!$count_current_financial) { ?>
                                                    <option value="<?= $prime_year ?>"><?= $prime_year ?></option>
                                                <?php }
                                                if ($total_financial) {
                                                    foreach ($logs as $row) { ?>
                                                        <option value="<?= $row->FY_year ?>" <?= (isset($_GET['fy']) && $_GET['fy'] == $row->FY_year) ? 'selected' : '' ?>>
                                                            <?= $row->FY_year ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <?php if ($csrReport) { ?>
                                            <div class="col-sm-12" style="margin-top:50px">
                                                <p class="p-theme-title">Project Status</p>
                                            </div>
                                            <table class="table-theme">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            Year
                                                        </th>
                                                        <th scope="col">
                                                            Generated On
                                                        </th>
                                                        <th scope="col">
                                                            Ongoing
                                                        </th>
                                                        <th scope="col">
                                                            Other than Ongoing
                                                        </th>
                                                        <th scope="col">
                                                            Unspent Amt
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($csrReport as $row) { ?>
                                                        <tr>
                                                            <td><?= $row->FY_year ?></td>
                                                            <td><?= date('d-m-Y', $row->created_at) ?></td>
                                                            <td><?= ($row->ongoing ? $row->ongoing : '-') ?></td>
                                                            <td><?= ($row->other_than_ongoing ? $row->other_than_ongoing : '-') ?>
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                <a target="_blank"
                                                                    href="<?= base_url() . 'CsrCompliance/previewCSRReport?year=' . $row->FY_year ?>"
                                                                    class="btn btn-sm btn-link">Views & Download</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } else { ?>
                                            <div class="col-sm-12" style="margin-top:50px">
                                                <p class="p-theme-title">No Records Found</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="csrcalculator" style="display: none;">
                        <form action="<?php echo base_url(); ?>CsrCompliance/saveCalculation" id="calculator-form"
                            method="post">
                            <input type="hidden" name="fy_year" value="" />
                            <input type="hidden" name="mode" value="calculation" />
                            <input type="hidden" name="e_net_worth"
                                value="<?= ((isset($_GET['e_net_worth']) ? $_GET['e_net_worth'] : '')) ?>" />
                            <input type="hidden" name="e_turnover"
                                value="<?= ((isset($_GET['e_turnover']) ? $_GET['e_turnover'] : '')) ?>" />
                            <div class="col-md-12">
                                <label class="control-label" style="color:#000;text-transform: none;">
                                    Computation of profit under section 198,
                                    all the following fields are mandatory for the calculation purpose.(<span
                                        class="calculator-year"></span>)
                                </label>
                                <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                    <a href="javascript:void(0)"
                                        class="control-label float-right calculation-edit-event"><span
                                            class="add-more-link"><img src="<?php echo SKIN_URL; ?>images/edit.png"
                                                alt="" /> Edit Computation</span></a>
                                <?php } ?>
                                <table class="table caclulator custom-width-calculator">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                Sr. No
                                            </th>
                                            <th scope="col">
                                                Particulars
                                            </th>
                                            <th scope="col">
                                                Amount <br>(₹)
                                            </th>
                                            <th scope="col">
                                                Total
                                            </th>
                                            <th scope="col">
                                                Remarks
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Net Profit Before Tax as per Financial Statements</td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="NP_before_tax" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" name="NP_before_tax_remark"
                                                    value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td colspan="4" class="theme-blue">Add Credit Shall be given as per
                                                sub-section (2), if not included in profit</td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>
                                                Add: Bounties and subsidies received from:</br>
                                                -Central Goverment</br>
                                                -State Goverment</br>
                                                -Public Authorities</br>
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="bounties_received" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" name="bounties_received_remark"
                                                    value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td colspan="4" class="theme-red">Less: Credit shall not be given as per
                                                sub-section (3),if included in profit</td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(a) Profits, by way of premium on shares or debentures of the company,
                                                which
                                                are issued or sold by the company;(Except for investment company)
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="premium_debunture_profits" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="premium_debunture_profits_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(b) Profits on sales by the company of forfeited shares;</td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="sales_fortified_shares" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="sales_fortified_shares_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(c) Profits of a capital nature including profits from the sale of the
                                                undertaking or any of the undertakings of the company or of any part
                                                thereof; 
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="profits_captial_nature" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="profits_captial_nature_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(d) Profits from the sale of any immovable property or fixed assets of a
                                                capital nature comprised in the undertaking or any of the undertakings
                                                of
                                                the company, unless the business of the company consists, whether wholly
                                                or
                                                partly, of buying and selling any such property or assets:
                                                <br><br>
                                                Provided that where the amount for which any fixed asset is sold exceeds
                                                the
                                                written-down value thereof, credit shall be given for so much of the
                                                excess
                                                as is not higher than the difference between the original cost of that
                                                fixed
                                                asset and its written down value;
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="immvoable_fixed_assests" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="immvoable_fixed_assests_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td colspan="4" class="theme-blue">Add: Credit shall be given as per
                                                sub-section (3),if not included in profit</td>
                                        </tr>

                                        <tr>
                                            <td>03</td>
                                            <td>(e) Any change in carrying amount of an asset or of a liability
                                                recognised
                                                in equity reserves including surplus in Profit and Loss Account on
                                                measurement of the asset or the liability at fair value.
                                            </td>

                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="carrying_amt_assests" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="carrying_amt_assests_remark" value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(f) Any Amount Representing unrealised gains, notional gains or
                                                revaluations of assets.
                                            </td>

                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="carrying_unrealised_gns" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="carrying_unrealised_gns_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td colspan="4" class="theme-red">Less: Sum shall be deducted as per
                                                sub-section (4),if not included in expenses</td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (a) All the usual working charges
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="usual_workings" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" name="usual_workings_remark"
                                                    value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (b) Director's remuneration
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="directors_remumneration" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="directors_remumneration_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (c) Bonus or commission paid or payable to any member of the company's
                                                staff, or to engineer, technician, or person employed or engaged by the
                                                company, whether on a whole time or on a part time basis
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="bonous_commsion_paid" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="bonous_commsion_paid_remark" value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (d) Any tax notified by the Central Government as being in the nature of
                                                a tax on excess or abnormal profits
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="tax_notified_by_govt" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="tax_notified_by_govt_remark" value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (e) Any tax on business profits imposed for special reasons or in
                                                special circumstances and notified by the Central government in this
                                                behalf
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="special_tax_on_business_profits" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="special_tax_on_business_profits_remarks" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (f) Interest on debentures issued by the company
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="interest_on_debentures" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="interest_on_debentures_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (g) Interest on mortgages executed by the company and on loans and
                                                advances secured by a charge on its fixed assets or floating assets
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="interest_on_mortgages" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="interest_on_mortgages_remark" value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (h) Interest on unsecured loans and advances
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="Interest_on_unsecured_loans_and_advances" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="Interest_on_unsecured_loans_and_advances_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (i) Expenses on repairs, whether to immovable or to movable property,
                                                provided the repairs are not of a capital nature
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="Expenses_on_repairs" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="Expenses_on_repairs_remark" value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (j) Outgoings, inclusive of contributions made under Section 181
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="Outgoings" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" name="Outgoings_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (k) Depreciation to the extent provided in Section 123
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="Depreciation_Section_123" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="Depreciation_Section_123_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (l) The excess of expenditure over income, which had arisen in computing
                                                the net profits in accordance with Section 349 in any year which begins
                                                at or after the commencement of this Act, in so far as such excess has
                                                not been deducted in any subsequent year preceeding the year in respect
                                                of which the net profits have to be ascertained
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="excess_expenditure_over_income" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="excess_expenditure_over_income_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (m) Any compensation or damages to be paid by virtue of any legal
                                                liability, including a liability arising from a breach of contract
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="compensation_or_damages" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="compensation_or_damages_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (n) Any sum paid by way of insurance against the risk of meeting any
                                                liability such as is referred to in the previous clause
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="insurance_against_liability" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="insurance_against_liability_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (o) Debts considered bad and written off or adjusted during the year of
                                                account
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="debts_written_off" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" name="debts_written_off_remark"
                                                    value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td colspan="4" class="theme-blue">
                                                Add: Sum shall not be deducted as per sub-section (5), if not falling
                                                under clause (d) and (e) of subsection (4) / already included in
                                                expenses.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>(a) Income-tax and super-tax payable by the company under the Income-tax
                                                Act, 1961, or any other tax on the income of the company not falling
                                                under
                                                clauses (d) and (e) of sub-section (4);
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="Income_and_super_tax" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="Income_and_super_tax_remark" value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>(b) Any compensation, damages or payments made voluntarily, that is to
                                                say,
                                                otherwise than in virtue of a liability such as is referred to in clause
                                                (m)
                                                of sub-section (4);
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="voluntarily_compensation" value=""
                                                    aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="voluntarily_compensation_remark" value=""
                                                    onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>(c) Loss of a capital nature including loss on sale of the undertaking
                                                or
                                                any of the undertakings of the company or of any part thereof not
                                                including
                                                any excess of the written-down value of any asset which is sold,
                                                discarded,
                                                demolished or destroyed over its sale proceeds or its scrap value;
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="capital_loss_sec_350" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="capital_loss_sec_350_remark" value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>(d) Any change in carrying amount of an asset or of a liability
                                                recognised
                                                in equity reserves including surplus in profit and loss account on
                                                measurement of the asset or the liability at fair value.
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="carring_amount" value="" aria-required="true">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" name="carring_amount_remark"
                                                    value="" onpaste="return false;"
                                                    onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>06</td>
                                            <td>
                                                <b>Net Profit computed as per Section 198 of the Companies Act, 2013</b>
                                            </td>
                                            <td></td>
                                            <td class="section-six-total"></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label" style="color:#000;text-transform: none;">
                                    Computation of amount adjusted as per rule 2(1)(h) of CSR Policy Rule 2014 *, all
                                    the following fields are mandatory for the calculation purpose.
                                </label>
                                <table class="table caclulator">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                Sr. No
                                            </th>
                                            <th scope="col">
                                                Particulars
                                            </th>
                                            <th scope="col">
                                                Amount <br>(₹)
                                            </th>
                                            <th scope="col">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>07</td>
                                            <td colspan="3" class="theme-red">Less: Total amount adjusted as per rule
                                                2(1)(h) of CSR Policy Rule 2014 *</td>
                                        </tr>
                                        <tr>
                                            <td>07</td>
                                            <td>
                                                (a) Profit arising from any overseas branch or branches
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="profit_from_oversease" value="" aria-required="true">
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>07</td>
                                            <td>
                                                (b) Dividend received from Indian Companies covered U/s 135 of the act
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="csr-calculator form-control"
                                                    required name="dividend_received" value="" aria-required="true">
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                Total Net Profit
                                            </td>
                                            <td></td>
                                            <td class="net-profit-total"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php if ($prime_year == $current_financial_year || $prime_year == $_GET['fy']) { ?>
                                <div class="col-sm-12">
                                    <div class="wrap_flex_btn">
                                        <div class="form-group">
                                            <a href="javascript:void(0)" class="cancelBtn calculate_csr_back">Back</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary saveBtn">Save &
                                                Continue</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        //store calculation in local storage
        let current = <?php echo json_encode($calculation); ?>;
        let one_year = <?php echo json_encode($calculationOnePreviousYear); ?>;
        let two_year = <?php echo json_encode($calculationTwoPreviousYear); ?>;

        /*var annual_action_plan = <?php //echo json_encode($annualPlanData); ?>;
        $('.preview-annual-action-plan').click(function () {
            var year = $(this).attr('data-id');
            const filteredyears = annual_action_plan.filter(item => item.FY_year === year);
            $('#active_annual_year').text(year);
            $('tbody.annual_action_preview_row').empty();
            filteredyears.forEach(element => {
                var html = `<tr>
                            <td>${element.project_name}</td>
                            <td>${element.project_location_state}</td>
                            <td>${element.sectors}</td>
                            <td>${element.budgeted_amt}</td>
                            <td>${element.modalities_of_funds_utilisation}</td>
                            <td>${element.execution_manner}</td>
                            <td>${element.scheduled_date}</td>
                            <td>${element.monitoring_n_reporting}</td>
                            <td>${element.details_of_impact_assessment}</td>
                        </tr>`;
                $('.annual_action_preview_row').append(html)
            });
            $('.annual-preview-sec').show();
            $('.previous_year_annual_action_plan').hide();
        });
        $('.annual-back-btn').click(function () {
            $('.annual-preview-sec').hide();
            $('.previous_year_annual_action_plan').show();
        });*/

    </script>
    <link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
    <script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/implementor.js?v=' . JS_CSC_V; ?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/form-validation.js?v=' . JS_CSC_V; ?>"></script>
    <script type="text/javascript" src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/select2.min.js?v=' . JS_CSC_V; ?>"></script>
    <?php $this->load->view('common/footer_js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let SKIN_URL = '<?php echo SKIN_URL; ?>';
        $(".addmore-annual-row").click(function () {
            $(".location-select-2").select2('destroy');
            var html = `<tr>
                        <td>
                            <input  onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" type="text" class="form-control" id="" required="" name="csr_annual_action_plan_project_name[]" value="" aria-required="true" />
                        </td>
                        <td>
                            <select name="csr_annual_action_plan_project_location[]" class="form-control location-select-2" required="">
                                <option value="">Select Location</option>
                                 <?php foreach ($district as $row) { ?>
                                                                            <option value="<?= $row->dst_name . ',' . $row->st_name ?>"><?= $row->dst_name . ',' . $row->st_name ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <select name="csr_annual_action_plan_sectors[]" class="form-control" required="" aria-required="true" aria-invalid="false">
                                <option value="">Select Sector</option>
                                <?php foreach ($sectors as $row) { ?>
                                                                            <option value="<?= $row->sector_type ?>"><?= $row->sector_type ?></option>
                               <?php } ?>
                            </select>
                        <td>
                            <input placeholder="" type="number" class="form-control" id="" required="" name="csr_annual_action_plan_budgeted_amt[]" aria-required="true" />
                        </td>
                        <td>
                            <select name="csr_annual_action_plan_utilisation[]" class="form-control" required="" aria-required="true" aria-invalid="false">
                                <option value="CSR Activities">CSR Activities</option>
                                <option value="Contribution to Specified Funds">Contribution to Specified Funds</option>
                                <option value="Contribution to specified Incubators and R&D projects">Contribution to specified Incubators and R&D projects</option>
                            </select>
                        </td>
                        <td>
                            <select name="csr_annual_action_plan_execution_manner[]" class="form-control" required="" aria-required="true" aria-invalid="false">
                                <option value="By company itself">By company itself</option>
                                <option value="Through implementation agencies">Through implementation agencies</option>
                                <option value="In collaboration with one or more companies as prescribed Rule 4(4)">In collaboration with one or more companies as prescribed Rule 4(4)</option>
                            </select>
                        </td>
                        <td>
                            On or before 31st March {<?= date('Y') ?>}
                        </td>
                        <td>
                            <input type="text" class="form-control" id="" required="" name="csr_annual_action_plan_monitoring_n_reporting[]" value="" aria-required="true" />
                        </td>
                        <td>
                            <input type="text" class="form-control" id="" required="" name="csr_annual_action_plan_details_of_impact_assessment[]" value="" aria-required="true" />
                        </td>
                        <td>
                            <select name="csr_annual_action_plan_project_type[]" class="form-control" required="">
                                <option value="Ongoing">Ongoing</option>
                                <option value="Other than Ongoing">Other than Ongoing</option>
                            </select>
                        </td>
                        <td  class="table-delete-icon">
                            <a href='javascript:void(0)' class="event-delete-row">  
                                <img src="`+ SKIN_URL + `images/deleteIconsline.svg" alt=""/>
                            </a>
                        </td>
                    </tr>`;
            $(".annual_action_row").append(html);
            $(".location-select-2").select2();
        });
        $(".location-select-2").select2();
        $(document).ready(function () {
            var tab = '<?= (isset($_GET["tab"])) ? $_GET["tab"] : null ?>';
            var sub = '<?= (isset($_GET["sub"])) ? $_GET["sub"] : null ?>';
            if (tab) {
                $('.main-tab-control').find('.' + tab).addClass('active');
                $('.tab-content').find('.' + tab).addClass('active');
            } else {
                $('.main-tab-control').find('.basic-tab').addClass('active');
                $('.tab-content').find('.basic-tab').addClass('active');
            }
            if (sub) {
                $('.sub-menu-list').find('.' + sub).addClass('active');
                $('.sub-menu-content').find('.' + sub).addClass('active');
            } else {
                $('.sub-menu-list').find('.director').addClass('active');
                $('.sub-menu-content').find('.director').addClass('active');
            }
        });
        $(".pagination .page-link").each(function () {
            $(this).find('a').attr("href", $(this).find('a').attr('href') + "?tab=computaion-tab");
        });
        $('[name="is_audited"]').on('change', function () {
            if ($(this).val() == 1) {
                $('.audit-text-box').text('Audited Data');
            } else {
                $('.audit-text-box').text('Provisional Data');
            }
        });
        $('[name="basicDetailsForm"]').on('change', 'input,select', function () {
            $('[name="basicDetailsForm"]').find('.saveBtn').removeAttr('disabled');
        });
        $(document).on('click', '[name="is_CSR_policy_created"]', function () {
            var e = $('[name="applicable_csr"]').val();
            if ($(this).val() == 2 && e != '') {
                Swal.fire({
                    title: "Oops...",
                    text: "Please recheck the criteria for mandatory CSR committee formation.",
                    icon: "error"
                }).then((result) => {
                    $(this).prop('checked', false);
                });
            }
        });
        $(document).on('change', '.chairperson-event', function () {
            if ($(this).val() == 2) {
                $('.chairperson-event').val(1);
                $(this).val(2);
            }
        });
    </script>
    <script>
        function validateAndCalculate(rowIndex) {
            const balanceField = document.querySelector(`[name="pertaining_three_years[${rowIndex}][balance_amt_in_CSR_account]"]`);
            const spentField = document.querySelector(`[name="pertaining_three_years[${rowIndex}][amt_spent_in_FY]"]`);
            const amountField = document.querySelector(`[name="pertaining_three_years[${rowIndex}][amt_transferred_to_fund_account]"]`);
            const remainingField = document.querySelector(`[name="pertaining_three_years[${rowIndex}][amt_remaining_to_spent]"]`);
            const deficiencyField = document.querySelector(`[name="pertaining_three_years[${rowIndex}][deficiency]"]`);
            const errorMsg = document.querySelector(`[data-row="${rowIndex}"][data-field="error-msg"]`);

            if (!balanceField || !spentField || !amountField || !remainingField || !deficiencyField || !errorMsg) {
                console.error(`Missing fields for row ${rowIndex}`);
                return;
            }


            const balanceAmt = parseFloat(balanceField.value) || 0;
            const spentAmt = parseFloat(spentField.value) || 0;
            const amountTransferred = parseFloat(amountField.value) || 0;
            const remainingAmt = parseFloat(remainingField.value) || 0;

            console.log(`Balance Amount: ${balanceAmt}`);
            console.log(`Amount Spent: ${spentAmt}`);
            console.log(`Amount Transferred: ${amountTransferred}`);
            console.log(`Amt Remaining: ${remainingAmt}`);


            if (spentAmt > balanceAmt) {
                errorMsg.textContent = "Amount spent cannot exceed balance amount!";
                errorMsg.style.display = "block";
                spentField.classList.add("is-invalid");
                return;
            } else {
                errorMsg.style.display = "none";
                spentField.classList.remove("is-invalid");
            }


            if (amountTransferred > balanceAmt) {
                errorMsg.textContent = "Amount transferred cannot exceed balance amount!";
                errorMsg.style.display = "block";
                amountField.classList.add("is-invalid");
                return;
            } else {
                errorMsg.style.display = "none";
                amountField.classList.remove("is-invalid");
            }


            const deficiency = balanceAmt - spentAmt - amountTransferred - remainingAmt;
            deficiencyField.value = deficiency.toFixed(2);


            if (balanceAmt < 0) {
                errorMsg.textContent = "Balance amount cannot be negative!";
                errorMsg.style.display = "block";
                balanceField.classList.add("is-invalid");
            } else {
                balanceField.classList.remove("is-invalid");
            }
        }


        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function () {
                const rowIndex = this.getAttribute('name').match(/\d+/)[0]; // Extract row index
                validateAndCalculate(rowIndex);
            });
        });
    </script>




</body>