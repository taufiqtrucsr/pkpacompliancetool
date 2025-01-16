<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />
<link href="<?php echo SKIN_URL; ?>css/select2.min.css" rel="stylesheet" />
<style>
   .table {
      width: 100%;
      margin-bottom: 0;
      max-width: 100%;
   }

   .table-delete-icon {
      background: #fff !important;
   }

   .contributor_details input.form-control {
      text-align: left;
      max-width: 400px;
      margin-bottom: 0;
   }

   /*.cus-step-one a {
    position: relative;
}

.cus-step-one:after {
    position: absolute;
    top: 10px;
    width: 41%;
    height: 2px;
    background-color: #000;
    left: 0px;
    content: "";
}*/

   .fix-width {
      width: 100%;
      overflow-y: hidden;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
   }

   .select2-container--default .select2-selection--single .select2-selection__arrow {
      top: 3px !important;
      right: 18px !important;
   }

   .ctcsr .form-control {
      width: 160px !important;
   }

   .panel {
      padding: 15px;
      border: 0px solid #000 !important;
   }

   .previous_year input.form-control {
      width: 160px !important;
   }

   .scroll-inner {
      &::-webkit-scrollbar {
         width: 10px;
      }

      &::-webkit-scrollbar:horizontal {
         height: 10px;
      }

      &::-webkit-scrollbar-track {
         background-color: transparentize(#ccc, 0.7);
      }

      &::-webkit-scrollbar-thumb {
         border-radius: 10px;
         background: transparentize(#ccc, 0.5);
         box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
      }
   }

   body {
      background-color: tint(cornflowerblue, 60%);
   }

   .contributor_details ul li {
      list-style-type: none;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
   }

   .new_csr_project_ongoing .add-more-link {
      margin-bottom: 2rem;
   }
</style>

<body class="full-page">
   <?php $this->load->view('common/header'); ?>
   <form action="<?php echo base_url() . "/CsrCompliance/storeClosingReport"; ?>" method="post">
      <input type="hidden" name="entity_name"
         value="<?= (isset($entity->entity_name)) ? $entity->entity_name : '' ?>" />
      <div class="container">
         <div id="fyendreport" class="organisation-main-steps">
            <div class="kyc-title">
               <h2>Details For CSR-2 Reporting For The Financial Year<br> April
                  <?php $year = explode('-', $prime_year); ?><?= $year[0]; ?> to March <?= $year[1]; ?>
               </h2>
            </div>
            <!-- <div class="stepwizard">
               <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step cus-step-one">
                     <a href="#" id="fy-step-1-btn" type="button" class="btn btn-primary btn-circle"><span class="step-count">01</span> Add Details</a>
                  </div>
                  <div class="stepwizard-step">
                     <a href="#" id="fy-step-2-btn" type="button" class="btn btn-default btn-circle"><span class="step-count">02</span> Preview & Download</a>
                  </div>
               </div>
            </div> -->



            <div class="stepwizard col-md-offset-3">
               <div class="stepwizard-row setup-panel" style="justify-content: center !important; display: flex;">
                  <div class="stepwizard-step">
                     <a href="#ngo-step-1" id="fy-step-1-btn" class="btn btn-primary btn-circle"><span
                           class="step-count">01</span>
                        Add Details</a>
                  </div>
                  <div class="stepwizard-step">
                     <a href="#ngo-step-2" id="fy-step-2-btn" class="btn btn-default btn-circle"
                        disabled="disabled"><span class="step-count">02</span> Preview & Download</a>
                  </div>
               </div>
            </div>




            <div id="fy-step-2-btn">
               <div class="thruout_year">
                  <div class="col-md-12" style="background: transparent;">
                     <div class="row">
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (a) CIN *:</label>
                           <p><input type="text" class="form-control"
                                 value="<?= (isset($entity->cin->document_number)) ? $entity->cin->document_number : '' ?>" />
                           </p>
                        </div>
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (b) Name of the company*:</label>
                           <p><input type="text" class="form-control" value="<?= $entity->entity_name ?>" /></p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (c) Company Address *:</label>
                           <p><input type="text" class="form-control" value="<?= $entity->entity_address ?>" /></p>
                        </div>
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (d) Email *:</label>
                           <p><input type="text" class="form-control"
                                 value="<?= htmlspecialchars($data['user']->email); ?>" /></p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">2. (a) FY to which the CSR details pertain *:</label>
                              <ul class="pegtain">
                                 <li><label class="control-label">From : </label><input class="form-control" type="date"
                                       value="<?= (isset($csr2) && isset($csr2->csr_details_pegtain_from)) ? date('Y-m-d', $csr2->csr_details_pegtain_from) : date('Y-m-d', strtotime('01-04-' . $year[0])) ?>"
                                       name="from" onkeydown="return false" required /></li>
                                 <li><label class="control-label">To : </label><input class="form-control" type="date"
                                       value="<?= (isset($csr2) && isset($csr2->csr_details_pegtain_to)) ? date('Y-m-d', $csr2->csr_details_pegtain_to) : date('Y-m-d', strtotime('31-03-' . $year[1])) ?>"
                                       name="to" onkeydown="return false" required /></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">2. (b) SRN of form AOC-4/ AoC-4 XBRL/ AoC-4 NBFC
                                 filed by the company for its standalone financial statements *:</label>
                              <ul class="pegtain pegtain1">
                                 <li><input class="form-control" type="text" name="srn"
                                       value="<?= (isset($csr2) && isset($csr2->srn)) ? $csr2->srn : '' ?>" required />
                                 </li>
                                 <li><input class="form-control" type="date" name="srn_date"
                                       value="<?= (isset($csr2) && isset($csr2->srn_date)) ? date('Y-m-d', $csr2->srn_date) : '' ?>"
                                       onkeydown="return false" required /></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="ongoing_projects">
                        <div class="col-lg-12">
                           <div class="row">
                              <label class="control-label"
                                 style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">3.
                                 Financial Details for CSR:</label>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="row">
                              <div class="form-group col-sm ctcsr" style="margin-top:20px">
                                 <table class="table" style="margin-top:10px">
                                    <thead>
                                       <tr>
                                          <th scope="col">
                                             Net Worth (in Rs.)
                                          </th>
                                          <th scope="col">
                                             Turnover (in Rs.)
                                          </th>
                                          <th scope="col">
                                             Net Profit (in Rs.)
                                          </th>
                                          <th scope="col">
                                             Criteria that triggered CSR applicability
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td><?= $criteria->net_worth ?></td>
                                          <td><?= $criteria->turnover ?></td>
                                          <td><?= $criteria->net_profit ?></td>
                                          <td><?= $criteria->csr_criteria_applicable ?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (a) (i) Whether CSR Committee has been constituted
                                 * :</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->CSR_committee_constituted == 1) ? 'checked' : '' ?>>
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->CSR_committee_constituted == 2) ? 'checked' : '' ?>>
                                    <label>No</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= (!$obligation->CSR_committee_constituted) ? 'checked' : '' ?>>
                                    <label>Not Applicable</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php if ($obligation->CSR_committee_constituted == 1) { ?>
                           <div class="col-md-6">
                              <div class="contributor_details">
                                 <label class="control-label-closing">4. (a) (ii) Number of directors composing CSR
                                    Committee:</label>
                                 <input class="form-control form-sm-2" style="width:200px"
                                    value="<?= $obligation->no_of_CSR_directors ?>" type="text" readonly />
                              </div>
                           </div>
                        <?php } ?>
                     </div>
                     <?php if ($obligation->CSR_committee_constituted == 1) { ?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="contributor_details">
                                 <label class="control-label-closing">4. (a) (iii) Number of meetings of CSR Committee held
                                    during the year:</label>
                                 <input class="form-control" style="width:200px"
                                    value="<?= (isset($csr2) && isset($csr2->number_of_meetings_of_csr_committee)) ? $csr2->number_of_meetings_of_csr_committee : '' ?>"
                                    name="meeting" type="number" required />
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="row">
                              <table class="table" style="margin-top:10px">
                                 <thead>
                                    <tr>
                                       <th scope="col">
                                          Sr. No.
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
                                    <?php
                                    foreach ($committee as $key => $row) { ?>
                                       <tr>
                                          <td><?= $key + 1 ?></td>
                                          <td><?= $row->DIN ?></td>
                                          <td><?= $row->name_of_director ?></td>
                                          <td>
                                             <?= (($row->category == 1) ? 'MD' : (($row->category == 2) ? 'Executive' : (($row->category == 3) ? 'Non-Executive Non Independent' : 'Non-Executive Independent'))) ?>
                                          </td>
                                          <td>
                                             <input class="form-control" type="hidden" name="member_id[]"
                                                value="<?= $row->id ?>" />
                                             <input class="form-control" type="number" name="attend[]"
                                                value="<?= (isset($row->meeting)) ? $row->meeting : '' ?>"
                                                max="<?= (isset($row->meeting)) ? $row->meeting : '' ?>" required />
                                          </td>
                                       </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     <?php } ?>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (b) (i) Whether the company has a website
                                 *:</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_CSR_policy_displayed == 1) ? "checked" : "" ?> value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_CSR_policy_displayed == 2) ? "checked" : "" ?> value="2">
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6"
                           style='<?= ($obligation->is_CSR_policy_displayed != 1) ? "display:none" : "" ?>'>
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (b) (ii) If Yes, Provide web link :</label>
                              <input class="form-control" type="text" value="<?= $obligation->CSR_policy_link ?>"
                                 style="width:300px" readonly />
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-7">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (b) (iii)Whether following has been disclosed on
                                 the website of the company in pursuance of Rule 8 of Companies (CSR Policy) Rules,
                                 2014:</label>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">CSR Policy:</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_CSR_policy_displayed == 1) ? "checked" : "" ?> value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_CSR_policy_displayed == 2) ? "checked" : "" ?> value="2">
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">Composition of CSR committee</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->CSR_committee_constituted_displayed == 1) ? "checked" : "" ?>
                                       value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->CSR_committee_constituted_displayed == 2) ? "checked" : "" ?>
                                       value="2">
                                    <label>No</label>
                                 </div>
                                 <div>
                                    <input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= (!$obligation->CSR_committee_constituted_displayed) ? "checked" : "" ?>
                                       value="3">
                                    <label>Not Applicable</label>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">CSR projects approved by the board:</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted"
                                       <?= ($obligation->CSR_projects_displayed == 1) ? "checked" : "" ?> type="radio"
                                       name="" value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted"
                                       <?= ($obligation->CSR_projects_displayed == 2) ? "checked" : "" ?> type="radio"
                                       name="" value="2">
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (c) (i) Whether Impact assessment of CSR projects
                                 is carried out in pursuance of sub-rule (3) of Rule 8 of Companies (CSR Policy)
                                 Rules,2014, if applicable *:</label>
                              <div class="yn">
                                 <div>
                                    <input class="form-check-input" type="radio" name="impact_assessment"
                                       <?= (isset($csr2->is_impact_assessment_carried_out) && $csr2->is_impact_assessment_carried_out == 1) ? 'checked' : '' ?> value="1"
                                       required>
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input" type="radio" name="impact_assessment"
                                       <?= (isset($csr2->is_impact_assessment_carried_out) && $csr2->is_impact_assessment_carried_out == 2) ? 'checked' : '' ?> value="2">
                                    <label>No</label>
                                 </div>
                                 <div>
                                    <input class="form-check-input" type="radio" name="impact_assessment"
                                       <?= (isset($csr2->is_impact_assessment_carried_out) && $csr2->is_impact_assessment_carried_out == 3) ? 'checked' : '' ?> value="3">
                                    <label>Not Applicable</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4 check_is_impact_assessment_board_box"
                           style="<?= (isset($csr2->is_impact_assessment_carried_out) && $csr2->is_impact_assessment_carried_out == 1) ? '' : 'display:none' ?>">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (c) (ii) If yes, Whether the same has been
                                 disclosed in the Board Report *:</label>
                              <div class="yn">
                                 <div><input class="form-check-input" type="radio" name="impact_assessment_board"
                                       <?= (isset($csr2->is_impact_assessment_disclosed_in_board_report) && $csr2->is_impact_assessment_disclosed_in_board_report == 1) ? 'checked' : '' ?>
                                       value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input" type="radio" name="impact_assessment_board"
                                       <?= (isset($csr2->is_impact_assessment_disclosed_in_board_report) && $csr2->is_impact_assessment_disclosed_in_board_report == 2) ? 'checked' : '' ?>
                                       value="2">
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2 impact_assessment_board_link_box"
                           style="<?= (isset($csr2->is_impact_assessment_disclosed_in_board_report) && $csr2->is_impact_assessment_disclosed_in_board_report == 1) ? '' : 'display:none' ?>">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (c) (iii) Provide web-link,if any :</label>
                              <input class="form-control" type="text"
                                 value="<?= (isset($csr2->board_report_link)) ? $csr2->board_report_link : '' ?>"
                                 name="impact_assessment_board_link">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-8">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (d) (i) Whether any amount is available for set
                                 off in pursuance of sub-rule (3) of Rule 7 of Companies (CSR Policy) Rules,2014 *
                                 :</label>
                              <div class="yn">
                                 <div> <input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_CSR_setoff_available == 1) ? "checked" : "" ?> value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div>
                                    <input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_CSR_setoff_available == 2) ? "checked" : "" ?> value="2">
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="row">
                           <label class="control-label-closing" style="color:#000;">4. (d) (ii) If yes, provide
                              details:</label>
                           <div class="ongoing_projects">
                              <div class="col-lg-12">
                                 <div class="row">
                                    <?php if ($obligation->is_CSR_setoff_available == 1) { ?>
                                       <div class="form-group col-sm ctcsr" style="display: table">
                                          <table class="table" style="margin-top:10px">
                                             <thead>
                                                <tr>
                                                   <th scope="col">
                                                      Sr. No.
                                                   </th>
                                                   <th scope="col">
                                                      Financial Year
                                                   </th>
                                                   <th scope="col">
                                                      Amount available for set-off (in Rs.)
                                                   </th>
                                                   <th scope="col">
                                                      Amount set-off in the financial year, if any (in Rs.)
                                                   </th>
                                                   <th scope="col">
                                                      Balance Amount (in Rs.)
                                                   </th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td>01</td>
                                                   <td>FY-1 (YE <?= $set_one_year->FY_year ?>)</td>
                                                   <td><?= $set_one_year->set_off_amt_available ?></td>
                                                   <td><?= $set_one_year->amt_set_off_in_FY ?></td>
                                                   <td><?= $set_one_year->balance_set_off ?></td>
                                                </tr>
                                                <tr>
                                                   <td>02</td>
                                                   <td>FY-2 (YE <?= $set_two_year->FY_year ?>)</td>
                                                   <td><?= $set_two_year->set_off_amt_available ?></td>
                                                   <td><?= $set_two_year->amt_set_off_in_FY ?></td>
                                                   <td><?= $set_two_year->balance_set_off ?></td>
                                                </tr>
                                                <tr>
                                                   <td>03</td>
                                                   <td>FY-3 (YE <?= $set_three_year->FY_year ?>)</td>
                                                   <td><?= $set_three_year->set_off_amt_available ?></td>
                                                   <td><?= $set_three_year->amt_set_off_in_FY ?></td>
                                                   <td><?= $set_three_year->balance_set_off ?></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                           <div class="ongoing_projects">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="contributor_details">
                                       <label class="control-label-closing">5. (a) Whether the company has completed the
                                          period of three financial years since its incorporation *:</label>
                                       <div class="yn">
                                          <div><input class="form-check-input check_is_committee_constituted"
                                                type="radio" <?= ($entity->companyHasCompletedYears >= 3) ? 'checked' : '' ?> value="1">
                                             <label>Yes</label>
                                          </div>
                                          <div>
                                             <input class="form-check-input check_is_committee_constituted" type="radio"
                                                <?= (!$entity->companyHasCompletedYears >= 3) ? 'checked' : '' ?>
                                                value="2">
                                             <label>No</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="contributor_details">
                                       <label class="control-label-closing">5. (b) If no, then provide the number of
                                          financial years completed since incorporation :</label>
                                       <input class="form-control" type="number" name="financial_completed"
                                          value="<?= $entity->companyHasCompletedYears ?>" style="width:200px"
                                          <?= ($entity->companyHasCompletedYears >= 3) ? 'disabled' : '' ?> min="1">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-8">
                                 <div class="row">
                                    <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                                       <label class="control-label-closing">5. (c) Net Profit & Other Details For The
                                          Preceding Financial Years: *:</label>
                                       <table class="table" style="margin-top:10px">
                                          <thead>
                                             <tr>
                                                <th scope="col" style=" width: 110px; ">
                                                   Sr. No
                                                </th>
                                                <th scope="col">
                                                   Particulars
                                                </th>
                                                <th scope="col" colspan="3">
                                                   Amount (in Rs.)
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <th scope="col" colspan="2">
                                                </th>
                                                <th scope="col" class="fy">
                                                   FY-1<br>2021-2022
                                                </th>
                                                <th scope="col" class="fy">
                                                   FY-2<br>2022-2023
                                                </th>
                                                <th scope="col" class="fy">
                                                   FY-3<br>2023-2024
                                                </th>
                                             </tr>
                                          </tbody>
                                          <tbody>
                                             <tr>
                                                <td>01</td>
                                                <td>Profit Before Tax</td>
                                                <td><?= $calculationTwoPreviousYear->NP_before_tax ?></td>
                                                <td><?= $calculationOnePreviousYear->NP_before_tax ?></td>
                                                <td><?= $calculation->NP_before_tax ?></td>
                                             </tr>
                                             <tr>
                                                <td>02</td>
                                                <td>Net Profit Computed under Section 198</td>
                                                <td><?= $calculationTwoPreviousYear->net_profit ?></td>
                                                <td><?= $calculationOnePreviousYear->net_profit ?></td>
                                                <td><?= $calculation->net_profit ?></td>
                                             </tr>
                                             <tr>
                                                <td>03</td>
                                                <td>Total amount adjusted as per rule 2(1)(h) of CSR Policy Rule 2014
                                                </td>
                                                <td><?= $calculationTwoPreviousYear->amt_adjusted ?></td>
                                                <td><?= $calculationOnePreviousYear->amt_adjusted ?></td>
                                                <td><?= $calculation->amt_adjusted ?></td>
                                             </tr>
                                             <tr>
                                                <td>04</td>
                                                <td>Total Net Profit for section 135 (2-3)</td>
                                                <td><?= $calculationTwoPreviousYear->total_net_profit ?></td>
                                                <td><?= $calculationOnePreviousYear->total_net_profit ?></td>
                                                <td><?= $calculation->total_net_profit ?></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <div class="csrpolicy">
                                 <div class="row">
                                    <div class="col-md-7">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">5. (d) Average net profit of the company
                                             as per section 135(5) * :</label>
                                          <input class="form-control" type="text" name="" style="width:150px"
                                             value="<?= $total_average = round(($calculationTwoPreviousYear->total_net_profit + $calculationOnePreviousYear->total_net_profit + $calculation->total_net_profit) / 3); ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-5">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (a) 2% of Avegage net profit of the
                                             company as peg section 135(5) * :</label>
                                          <input class="form-control" type="text" name="" style="width:150px"
                                             value="<?= round(($total_average / 100) * 2); ?>">
                                       </div>
                                    </div>
                                    <div class="col-md-7">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (b) Sugplus arising out of the CSR
                                             pgojects/programs og activities of the previous financial year, if any*
                                             :</label>
                                          <input class="form-control" type="text" name="" style="width:150px"
                                             value="<?= $obligation->surplus_from_CSR_projects; ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-5">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (c) Amount required to be set off for
                                             the financial year, if any *:</label>
                                          <input class="form-control" type="text" name="" style="width:150px"
                                             value="<?= $obligation->amt_to_be_set_off; ?>">
                                       </div>
                                    </div>
                                    <div class="col-md-7">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (d) Total CSR obligation for the
                                             financial year (6a+6b-6c) *:</label>
                                          <input class="form-control" type="text" name="" style="width:150px"
                                             value="<?= $total_csr_amt = round((($calculation->total_net_profit / 100) * 2) + $obligation->surplus_from_CSR_projects - $obligation->amt_to_be_set_off) ?>">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="previous_year">
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">7. (a) Whether CSR amount for the financial year has
                                 been spent: *:</label>
                              <div class="yn">
                                 <div>
                                    <input class="form-check-input check_is_committee_constituted"
                                       <?= (count($director_report_project_ongoing) > 0 || count($director_report_project_other) > 0) ? 'checked' : '' ?> type="radio"
                                       value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted"
                                       <?= (!count($director_report_project_ongoing) > 0 && !count($director_report_project_other) > 0) ? 'checked' : '' ?> type="radio"
                                       value="2">
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="contributor_details">
                              <label class="control-label-closing">7. (b) If Yes, CSR amount has been spent
                                 against:</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= (count($director_report_project_ongoing) > 0 && !count($director_report_project_other) > 0) ? 'checked' : '' ?> value="1">
                                    <label>Ongoing projects</label>
                                 </div>
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= (!count($director_report_project_ongoing) > 0 && count($director_report_project_other) > 0) ? 'checked' : '' ?> value="2">
                                    <label>Other than Ongoing projects</label>
                                 </div>
                                 <div>
                                    <input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= (count($director_report_project_ongoing) > 0 && count($director_report_project_other) > 0) ? 'checked' : '' ?> value="3">
                                    <label>Both (Ongoing and other than ongoing projects)</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="csrpolicy">
                           <div class="ongoing_projects">
                              <div class="col-lg-12">
                                 <?php $grandTotal = 0;
                                 if (count($director_report_project_ongoing) > 0 || (isset($previous_ongoing) && count($previous_ongoing) > 0)) { ?>
                                    <div class="row">
                                       <div class="form-group col-sm ctcsr" style="display: table;">
                                          <label class="control-label-closing">(i) Details of CSR amount spent against
                                             ongoing projects for the financial year:</label></br>
                                          <label class="control-label-closing">Number of Ongoing Projects for the financial
                                             year: <?= count($director_report_project_ongoing) ?></label>
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
                                                      CSR Registration No. (Agency)
                                                   </th>
                                                   <th scope="col">
                                                      Name (Agency)
                                                   </th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td colspan="5"></td>
                                                   <td style="background:#f3f6fc">State</td>
                                                   <td style="background:#f3f6fc">District</td>
                                                   <td colspan="3"></td>
                                                   <td style="background:#f3f6fc">CSR Registration No.</td>
                                                   <td style="background:#f3f6fc">Name</td>
                                                </tr>
                                                <?php $total = 0;
                                                if ((isset($previous_ongoing) && count($previous_ongoing) > 0)) {
                                                   foreach ($previous_ongoing as $key => $row) { ?>
                                                      <tr>
                                                         <td><?= $key + 1 ?></td>
                                                         <td></td>
                                                         <td><?= $row->sector ?></td>
                                                         <td><?= $row->project_name ?></td>
                                                         <td><?= ($row->local_area == 1) ? 'Yes' : 'No' ?></td>
                                                         <td><?= $row->location_state; ?></td>
                                                         <td><?= $row->location_district; ?></td>
                                                         <td>
                                                            <input type="number" class="form-control"
                                                               value="<?= $row->project_duration; ?>"
                                                               name="financial_duration_ongoing[]" required />
                                                         </td>
                                                         <td><?= $row->amt_spent_in_year ?></td>
                                                         <td>
                                                            <?= ($row->is_direct_implementation == 1) ? 'Implementing agency' : 'Direct' ?>
                                                         </td>
                                                         <td><input type="text" class="form-control validate-csr-number"
                                                               maxlength="11" name="csr_no_ongoing[]"
                                                               value="<?= $row->CSR_reg_no; ?>" required /></td>
                                                         <td><?= $entity->entity_name ?></td>
                                                      </tr>
                                                      <?php $total += $row->amt_spent_in_year;
                                                   }
                                                } else {
                                                   foreach ($director_report_project_ongoing as $key => $row) {
                                                      if ($row->project_type == 'Ongoing') { ?>
                                                         <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td></td>
                                                            <td><?= $row->sector ?></td>
                                                            <td><?= $row->project_activity_name ?></td>
                                                            <td><?= ($row->is_project_location_local == 1) ? 'Yes' : 'No' ?></td>
                                                            <td>
                                                               <?php $location = explode(',', $row->project_location_state);
                                                               echo (count($location) > 1) ? $location[1] : $location[0]; ?>
                                                            </td>
                                                            <td><?php echo (count($location) > 1) ? $location[0] : '-'; ?></td>
                                                            <td>
                                                               <input type="number" class="form-control"
                                                                  name="financial_duration_ongoing[]" required />
                                                            </td>
                                                            <td><?= $row->direct_expenditure ?></td>
                                                            <td>
                                                               <?= ($row->is_direct_implementation_dir_report == 1) ? 'Implementing agency' : 'Direct' ?>
                                                            </td>
                                                            <td><input type="text" class="form-control validate-csr-number"
                                                                  maxlength="11" name="csr_no_ongoing[]" required /></td>
                                                            <td><?= $entity->entity_name ?></td>
                                                         </tr>
                                                         <?php $total += $row->direct_expenditure;
                                                      }
                                                   }
                                                }
                                                $grandTotal += $total; ?>
                                                <tr>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td>Total</td>
                                                   <td><?= $total ?></td>
                                                   <td></td>
                                                   <td></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 <?php }
                                 if (count($director_report_project_other) > 0 || (isset($previous_other) && count($previous_other) > 0)) { ?>
                                    <div class="row">
                                       <div class="form-group col-sm ctcsr" style="display: table;">
                                          <label class="control-label-closing">(ii) Details of CSR amount spent against
                                             Other than ongoing projects for the financial year:</label></br>
                                          <label class="control-label-closing">Number of Other than Ongoing Projects for
                                             the financial year: <?= count($director_report_project_other) ?></label>
                                          <table class="table" style="margin-top:10px">
                                             <thead>
                                                <tr>
                                                   <th scope="col" style=" width: 110px; ">
                                                      Sr. No
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
                                                      CSR Registration No. (Agency)
                                                   </th>
                                                   <th scope="col">
                                                      Name (Agency)
                                                   </th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td colspan="4"></td>
                                                   <td style="background:#f3f6fc">State</td>
                                                   <td style="background:#f3f6fc">District</td>
                                                   <td colspan="3"></td>
                                                   <td style="background:#f3f6fc">CSR Registration No.</td>
                                                   <td style="background:#f3f6fc">Name</td>
                                                </tr>
                                                <?php $total = 0;
                                                if ((isset($previous_other) && count($previous_other) > 0)) {
                                                   foreach ($previous_other as $key => $row) { ?>
                                                      <tr>
                                                         <td><?= $key + 1 ?></td>
                                                         <td><?= $row->sector ?></td>
                                                         <td><?= $row->project_name ?></td>
                                                         <td><?= ($row->local_area == 1) ? 'Yes' : 'No' ?></td>
                                                         <td><?= $row->location_state; ?></td>
                                                         <td><?= $row->location_district; ?></td>
                                                         <td>
                                                            <input type="number" class="form-control"
                                                               value="<?= $row->project_duration; ?>"
                                                               name="financial_duration_other[]" required />
                                                         </td>
                                                         <td><?= $row->amt_spent_in_year ?></td>
                                                         <td>
                                                            <?= ($row->is_direct_implementation == 1) ? 'Implementing agency' : 'Direct' ?>
                                                         </td>
                                                         <td><input type="text" class="form-control validate-csr-number"
                                                               maxlength="11" name="csr_no_other[]"
                                                               value="<?= $row->CSR_reg_no; ?>" required /></td>
                                                         <td><?= $entity->entity_name ?></td>
                                                      </tr>
                                                      <?php $total += $row->amt_spent_in_year;
                                                   }
                                                } else {
                                                   foreach ($director_report_project_other as $key => $row) {
                                                      if ($row->project_type == 'Other than Ongoing') { ?>
                                                         <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td><?= $row->sector ?></td>
                                                            <td><?= $row->project_activity_name ?></td>
                                                            <td><?= ($row->is_project_location_local == 1) ? 'Yes' : 'No' ?></td>
                                                            <td>
                                                               <?php $location = explode(',', $row->project_location_state);
                                                               echo (count($location) > 1) ? $location[1] : $location[0]; ?>
                                                            </td>
                                                            <td><?php echo (count($location) > 1) ? $location[0] : '-'; ?></td>
                                                            <td>
                                                               <input type="number" class="form-control"
                                                                  name="financial_duration_other[]" required />
                                                            </td>
                                                            <td><?= $row->direct_expenditure ?></td>
                                                            <td>
                                                               <?= ($row->is_direct_implementation_dir_report == 1) ? 'Implementing agency' : 'Direct' ?>
                                                            </td>
                                                            <td><input type="text" class="form-control validate-csr-number"
                                                                  maxlength="11" name="csr_no_other[]" required /></td>
                                                            <td><?= $entity->entity_name ?></td>
                                                         </tr>
                                                         <?php $total += $row->direct_expenditure;
                                                      }
                                                   }
                                                }
                                                $grandTotal += $total ?>
                                                <tr>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td>Total</td>
                                                   <td><?= $total ?></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <?php
                                 } ?>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-5">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (c) Amount spent in Administrative Overheads
                                       *:</label>
                                    <input class="form-control" type="number" name="overhead" value="" placeholder=""
                                       required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (d) Amount spent on Impact Assessment, if
                                       applicable *:</label>
                                    <input class="form-control" type="number" name="assessment" value="" placeholder=""
                                       required>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-5">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (e) Total amount spent for the Financial
                                       Year *:</label>
                                    <input class="form-control" type="number" name="amount_spent"
                                       value="<?= $grandTotal += $oh + $asmt ?>" required readonly>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (f) Amount unspent/ (excess) spent for the
                                       Financial Year (6(D) - 7(e)) unspent for Ongoing projects *:</label>
                                    <input class="form-control" id="seven_f" type="number" name="amount_unspent"
                                       value="<?= $total_csr_amt - $grandTotal ?>" required readonly>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-5">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (g) Amount eligible for transfer to Unspent
                                       CSR Account for the Financial Year as per Section 135(6) (before adjustments)
                                       *:</label>
                                    <input class="form-control csr_amt-text" id="seven_g" type="number" readonly
                                       value="<?= isset($budgeted_amt) && isset($total) ? $budgeted_amt - $total : 0 ?>">

                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (h) Amount to be transferred to Fund
                                       specified in Schedule VII for the Financial Year (if total unspent for the
                                       Financial Year is greater than unspent for Ongoing projects) *:</label>
                                    <input class="form-control schedule_amt-text" id="seven_h" type="number" readonly
                                       value="">
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
                        <label class="control-label" style="color:#000; margin-bottom:20px;">8. Details of transfer of
                           Unspent CSR amount for the financial year:</label>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row">
                        <div class="uspent_csr">
                           <p><label>(a) Transfer to Unspent CSR account as per Section 135(6):</label></p>
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th scope="col" style=" width: 100px; ">
                                       Amount to be transferred to Unspent CSR account (in Rs.)
                                    </th>
                                    <th scope="col">
                                       Amount actually transferred to Unspent CSR account (in Rs.)
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
                                    <td><input type="number" class="form-control" id="csr_amt" name="csr_amt"
                                          value="<?= $obligation->amt_transfer_eligible_unspent_CSR_acc ?>" required
                                          oninput="calculateDeficiency()"></td>
                                    <td><input type="number" class="form-control" id="csr_actual" name="csr_actual"
                                          value="<?= $obligation->amt_actual_transfer_unspent_CSR_acc ?>" required
                                          oninput="validateAndCalculate()">
                                       <p id="error-message" style="color: red; display: none;">Actual transfer amount
                                          cannot be greater than the eligible amount.</p>
                                    </td>
                                    <td><input type="date" class="form-control" name="csr_date"
                                          value="<?= $obligation->date_of_trasnfer_csr_unspent_acc ?>" required></td>
                                    <td><input type="text" onpaste="return false;"
                                          onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" class="form-control"
                                          id="csr_deficiency" name="csr_deficiency"
                                          value="<?= $obligation->deficiency_unspent_csr ?>" required></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="uspent_csr">
                           <p><label>(b) Transfer to Fund specified in Schedule VII as per second proviso to Section
                                 135(5) for the Financial Year:</label></p>
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th scope="col" style=" width: 100px; ">
                                       Amount to be transferred to fund specified in schedule VII (in Rs.)
                                    </th>
                                    <th scope="col">
                                       Amount actually transferred to fund specified in schedule VII (in Rs.)
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
                                    <td><input type="number" class="form-control" id="schedule_amt" name="schedule_amt"
                                          value="<?= $obligation->amt_transfer_fund_specificed_sch7 ?>" required></td>
                                    <td><input type="number" class="form-control" id="schedule_actual"
                                          name="schedule_actual"
                                          value="<?= $obligation->amt_actual_transfer_fund_specificed_sch7 ?>" required
                                          oninput="validateAndCalculateSchedule()">
                                       <p id="schedule-error-message" style="color: red; display: none;">
                                          Actual transfer amount cannot be greater than the eligible amount.
                                       </p>
                                    </td>
                                    <td><input type="date" class="form-control" name="schedule_date"
                                          value="<?= $obligation->date_of_trasnfer_fund_specificed_sch7 ?>" required>
                                    </td>
                                    <td><input type="text" onpaste="return false;"
                                          onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" class="form-control"
                                          id="schedule_deficiency" name="schedule_deficiency"
                                          value="<?= $obligation->deficiency_fund_specificed_sch7 ?>" required></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-10">
                     <div class="row">
                        <div class="uspent_csr">
                           <p><label>9. Specify the reason(s) if the company has failed to spend two per cent of the
                                 average net profit as per section 135(5): *</label></p>
                           <span><?= isset($report->reason_failed_to_csr_spend_director_report) ? $report->reason_failed_to_csr_spend_director_report : '' ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="unspent_amount">
                  <div class="col-lg-12 amount_spent">
                     <div class="row">
                        <div class="col-md-11">
                           <div class="contributor_details">
                              <label class="control-label-closing">Whether any unspent amount of preceding three
                                 financial years (financial year ending after 22 January 2021) has been spent in the
                                 financial year *:</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) ? 'checked' : '' ?> value="1">
                                    <label>Yes</label>
                                 </div>
                                 <div>
                                    <input class="form-check-input check_is_committee_constituted" type="radio"
                                       <?= ($obligation->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 2) ? 'checked' : '' ?> value="2">
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php if ($obligation->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1) { ?>
                        <div class="col-md-12">
                           <div class="row">
                              <label class="control-label-closing">10. (a) Details of CSR amount spent in the financial
                                 year pertaining to three preceding financial year(s):</label>
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th scope="col">
                                          Preceding Financial Years
                                       </th>
                                       <th scope="col">
                                          Amount transferred to Unspent CSR A/c under section 135(6) (in Rs.)
                                       </th>
                                       <th scope="col">
                                          Balance amount in Unspent CSR A/c under section 135(6) (in Rs.)
                                       </th>
                                       <th scope="col">
                                          Amount spent in the Financial Year (in Rs.)
                                       </th>
                                       <th scope="col" colspan="2">
                                          Amt transferred to fund specified in Sch VII as per second proviso to Section
                                          135(5), if any
                                       </th>
                                       <th scope="col">
                                          Amt remaining to be spent in succeeding FY (in Rs.)
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
                                       <th>FY-1 (YE <?= $preceding_one_year->FY_year ?>)</th>
                                       <td><?= $preceding_one_year->amt_transferred_to_CSR_account ?></td>
                                       <td><?= $preceding_one_year->balance_amt_in_CSR_account ?></td>
                                       <td><?= $preceding_one_year->amt_spent_in_FY ?></td>
                                       <td><?= $preceding_one_year->amt_transferred_to_fund_account ?></td>
                                       <td>
                                          <?= date('d-m-Y', strtotime($preceding_one_year->date_of_transferred_to_fund_account)) ?>
                                       </td>
                                       <td><?= $preceding_one_year->amt_remaining_to_spent ?></td>
                                       <td><?= $preceding_one_year->deficiency ?></td>
                                    </tr>
                                    <tr>
                                       <th>FY-1 (YE <?= $preceding_two_year->FY_year ?>)</th>
                                       <td><?= $preceding_two_year->amt_transferred_to_CSR_account ?></td>
                                       <td><?= $preceding_two_year->balance_amt_in_CSR_account ?></td>
                                       <td><?= $preceding_two_year->amt_spent_in_FY ?></td>
                                       <td><?= $preceding_two_year->amt_transferred_to_fund_account ?></td>
                                       <td>
                                          <?= date('d-m-Y', strtotime($preceding_two_year->date_of_transferred_to_fund_account)) ?>
                                       </td>
                                       <td><?= $preceding_two_year->amt_remaining_to_spent ?></td>
                                       <td><?= $preceding_two_year->deficiency ?></td>
                                    </tr>
                                    <tr>
                                       <th>FY-1 (YE <?= $preceding_three_year->FY_year ?>)</th>
                                       <td><?= $preceding_three_year->amt_transferred_to_CSR_account ?></td>
                                       <td><?= $preceding_three_year->balance_amt_in_CSR_account ?></td>
                                       <td><?= $preceding_three_year->amt_spent_in_FY ?></td>
                                       <td><?= $preceding_three_year->amt_transferred_to_fund_account ?></td>
                                       <td>
                                          <?= date('d-m-Y', strtotime($preceding_three_year->date_of_transferred_to_fund_account)) ?>
                                       </td>
                                       <td><?= $preceding_three_year->amt_remaining_to_spent ?></td>
                                       <td><?= $preceding_three_year->deficiency ?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     <?php } ?>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="control-label-closing">10. (b) Details of CSR amount spent in the financial
                              year for ongoing projects of the preceding financial year(s):</label>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                              <p class="control-label" style="margin-bottom:0px">Number of Ongoing Projects <span
                                    class="textbox"
                                    style="margin-left:10px;"><?= count($ongoing_projects_preceeding_year) ?></span></p>
                              <table class="table" style="margin-top:10px">
                                 <thead>
                                    <tr>
                                       <th scope="col">
                                          Sr. No.
                                       </th>
                                       <th scope="col">
                                          Project ID
                                       </th>
                                       <th scope="col">
                                          Name of the Projects
                                       </th>
                                       <th scope="col">
                                          Financial year in which the project was commenced
                                       </th>
                                       <th scope="col">
                                          Amount spent for the project at the beginning of the Financial Year (in Rs.)
                                       </th>
                                       <th scope="col">
                                          Amount spent on the financial year
                                       </th>
                                       <th scope="col">
                                          Cumulative AmountSpentfor at theend of the Financial Year (in Rs.)
                                       </th>
                                       <th scope="col">
                                          Status of the project - Completed/ Ongoing
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($ongoing_projects_preceeding_year as $key => $row) { ?>
                                       <tr>
                                          <th><?= $key + 1 ?></th>
                                          <td><?= $row->project_id ?></td>
                                          <td><?= $row->project_name ?></td>
                                          <td><?= $row->FY_year_project_commenced ?></td>
                                          <td><?= $row->amt_spent_start_of_year ?></td>
                                          <td><?= $row->amt_spent_in_year ?></td>
                                          <td><?= $row->commutative_amt_spent ?></td>
                                          <td><?= $row->project_status ?></td>
                                       </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-11">
                           <div class="contributor_details">
                              <label class="control-label-closing">10. (c) (i) Whether any new CSR project has been
                                 undertaken in the financial year from the Unspent amount pertaining to preceding three
                                 financial years :</label>
                              <div class="yn">
                                 <div><input class="form-check-input check_is_committee_constituted"
                                       name="new_csr_project" <?= ($obligation->is_new_csr_project == 1) ? 'checked' : '' ?> type="radio" name="" value="1" required>
                                    <label>Yes</label>
                                 </div>
                                 <div>
                                    <input class="form-check-input check_is_committee_constituted"
                                       name="new_csr_project" <?= ($obligation->is_new_csr_project == 2) ? 'checked' : '' ?> type="radio" name="" value="2" required>
                                    <label>No</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="new_csr_project_nature"
                        style="<?= ($obligation->is_new_csr_project != 1) ? 'display:none' : '' ?>">
                        <div class="row">
                           <div class="col-md-11">
                              <div class="contributor_details">
                                 <label class="control-label-closing">10. (c) (ii) If yes, nature of the new CSR
                                    Project(s) is/are:</label>
                                 <div class="yn">
                                    <div>
                                       <input class="form-check-input check_is_committee_constituted" type="radio"
                                          name="new_csr_project_nature" <?= ($obligation->new_csr_project_nature == 1) ? 'checked' : '' ?> value="1">
                                       <label>Ongoing projects</label>
                                    </div>
                                    <div><input class="form-check-input check_is_committee_constituted" type="radio"
                                          name="new_csr_project_nature" <?= ($obligation->new_csr_project_nature == 2) ? 'checked' : '' ?> value="2">
                                       <label>Other than Ongoing projects</label>
                                    </div>
                                    <div>
                                       <input class="form-check-input check_is_committee_constituted" type="radio"
                                          name="new_csr_project_nature" <?= ($obligation->new_csr_project_nature == 3) ? 'checked' : '' ?> value="3">
                                       <label>Both (Ongoing and other than ongoing projects)</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row new_csr_project_ongoing"
                           style="<?= ($obligation->new_csr_project_nature == 2) ? 'display:none' : '' ?>">
                           <div class="col-md-11">
                              <div class="contributor_details">
                                 <label class="control-label-closing">10. (c) (iii) Details of amount spent against new
                                    ongoing CSR project in the financial year:</label>
                              </div>
                           </div>
                        </div>
                        <div class="ongoing_projects new_csr_project_ongoing"
                           style="<?= ($obligation->new_csr_project_nature == 2) ? 'display:none' : '' ?>">
                           <div class="col-lg-12">
                              <div class="row">
                                 <div class="form-group col-sm ctcsr">
                                    <p class="control-label" style="margin-bottom:0px">Number of Ongoing Projects: <span
                                          class="textbox box-ongoing-event-count"
                                          style="margin-left:10px;"><?= (isset($new_ongoing)) ? count($new_ongoing) : 1 ?></span>
                                    </p>
                                    <div class="container">
                                       <div class="panel panel-default">
                                          <div class="center-block fix-width scroll-inner">
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
                                                         Location of the Project
                                                      </th>
                                                      <!--<th scope="col">
                                                Project Duration (Months)
                                             </th>-->
                                                      <th scope="col">
                                                         Amt spent in the FY (in Rs.)
                                                      </th>
                                                      <th scope="col">
                                                         Mode of Implementation Direct (Y/ N)
                                                      </th>
                                                      <th scope="col" colspan="2">
                                                         Mode of Implementation Through Implementing Agency
                                                      </th>
                                                      <th class="table-delete-icon"> </th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                      <th scope="col" colspan="6">
                                                      </th>
                                                      <th colspan="2" scope="col" class="fy">
                                                         State & District
                                                      </th>
                                                      <th scope="col" colspan="2">
                                                      </th>
                                                      <th scope="col" class="fy">
                                                         CSR Registration No.
                                                      </th>
                                                      <th scope="col" class="fy">
                                                         Name
                                                      </th>
                                                      <th class="table-delete-icon"> </th>
                                                   </tr>
                                                </tbody>
                                                <tbody class="box-ongoing">
                                                   <?php if (isset($new_ongoing) && $new_ongoing) {
                                                      foreach ($new_ongoing as $key => $row) { ?>
                                                         <tr>
                                                            <td>1</td>
                                                            <td>
                                                               <input type="text" name="project_id[]"
                                                                  value="<?= $row->project_id ?>" class="form-control"
                                                                  required />
                                                               <input type="hidden" name="type[]" class="form-control"
                                                                  value="1" required />
                                                            </td>
                                                            <td><input type="date" name="pertains[]"
                                                                  value="<?= $row->FY_year_project_commenced ?>"
                                                                  class="form-control" required /></td>
                                                            <td>
                                                               <select name="sector[]" class="form-control" required>
                                                                  <option value="">Select Sector</option>
                                                                  <?php foreach ($sectors as $sec) { ?>
                                                                     <option <?= ($row->sector == $sec->sector_type) ? 'selected' : '' ?> data-sdgs='<?= $sec->sdgs_id ?>'
                                                                        value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?>
                                                                     </option>
                                                                  <?php } ?>
                                                               </select>
                                                            </td>
                                                            <td><input type="text" name="prject_name[]"
                                                                  value="<?= $row->project_name ?>" class="form-control"
                                                                  onpaste="return false;"
                                                                  onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"
                                                                  required /></td>
                                                            <td>
                                                               <select name="area[]" class="form-control" required>
                                                                  <option value="">Select</option>
                                                                  <option <?= ($row->local_area == 1) ? 'selected' : '' ?>
                                                                     value="1">
                                                                     Yes</option>
                                                                  <option <?= ($row->local_area == 2) ? 'selected' : '' ?>
                                                                     value="2">
                                                                     No</option>
                                                               </select>
                                                            </td>
                                                            <td colspan="2">
                                                               <select name="location[]"
                                                                  class="form-control location-select-2" required>
                                                                  <option value="">Select Location</option>
                                                                  <?php foreach ($district as $dst) { ?>
                                                                     <option <?= (($row->location_district . ',' . $row->location_state) == ($dst->dst_name . ',' . $dst->st_name)) ? 'selected' : '' ?>
                                                                        value="<?= $dst->dst_name . ',' . $dst->st_name ?>">
                                                                        <?= $dst->dst_name . ',' . $dst->st_name ?>
                                                                     </option>
                                                                  <?php } ?>
                                                               </select>
                                                            </td>
                                                            <input type="hidden" value="<?= $row->project_duration ?>"
                                                               name="duration[]" class="form-control" required />
                                                            <td><input type="number" value="<?= $row->amt_spent_in_year ?>"
                                                                  name="amount[]" class="form-control" required /></td>
                                                            <td>
                                                               <select name="implementation[]" class="form-control" required>
                                                                  <option value="">Select</option>
                                                                  <option <?= ($row->is_direct_implementation == 1) ? 'selected' : '' ?> value='1'>Implementing agency</option>
                                                                  <option <?= ($row->is_direct_implementation == 2) ? 'selected' : '' ?> value='2'>Direct</option>
                                                               </select>
                                                            </td>
                                                            <td><input type="text" name="registration[]"
                                                                  value="<?= $row->CSR_reg_no ?>"
                                                                  class="form-control validate-csr-number" maxlength="11"
                                                                  required /></td>
                                                            <td><input type="text" name="agency[]"
                                                                  value="<?= $row->implementer_name ?>" class="form-control"
                                                                  required /></td>
                                                            <td class="table-delete-icon"></td>
                                                         </tr>
                                                      <?php }
                                                   } else { ?>
                                                      <tr>
                                                         <td>1</td>
                                                         <td>
                                                            <input type="text" name="project_id[]" class="form-control" />
                                                            <input type="hidden" name="type[]" class="form-control"
                                                               value="1" required />
                                                         </td>
                                                         <td><input type="date" name="pertains[]" class="form-control" />
                                                         </td>
                                                         <td>
                                                            <select name="sector[]" class="form-control">
                                                               <option value="">Select Sector</option>
                                                               <?php foreach ($sectors as $sec) { ?>
                                                                  <option data-sdgs='<?= $sec->sdgs_id ?>'
                                                                     value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?>
                                                                  </option>
                                                               <?php } ?>
                                                            </select>
                                                         </td>
                                                         <td><input type="text" name="prject_name[]" class="form-control"
                                                               onpaste="return false;"
                                                               onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" /></td>
                                                         <td>
                                                            <select name="area[]" class="form-control">
                                                               <option value="">Select</option>
                                                               <option value="1">Yes</option>
                                                               <option value="2">No</option>
                                                            </select>
                                                         </td>
                                                         <td colspan="2">
                                                            <select name="location[]"
                                                               class="form-control location-select-2">
                                                               <option value="">Select Location</option>
                                                               <?php foreach ($district as $dst) { ?>
                                                                  <option value="<?= $dst->dst_name . ',' . $dst->st_name ?>">
                                                                     <?= $dst->dst_name . ',' . $dst->st_name ?>
                                                                  </option>
                                                               <?php } ?>
                                                            </select>
                                                         </td>
                                                         <input type="hidden" name="duration[]" class="form-control" />
                                                         <td><input type="number" name="amount[]" class="form-control" />
                                                         </td>
                                                         <td>
                                                            <select name="implementation[]" class="form-control">
                                                               <option value="">Select</option>
                                                               <option value='1'>Implementing agency</option>
                                                               <option value='2'>Direct</option>
                                                            </select>
                                                         </td>
                                                         <td><input type="text" name="registration[]"
                                                               class="form-control validate-csr-number" maxlength="11" />
                                                         </td>
                                                         <td><input type="text" name="agency[]" class="form-control" />
                                                         </td>
                                                         <td class="table-delete-icon"></td>
                                                      </tr>
                                                   <?php } ?>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12" style="text-align: initial;">
                                       <a href="javascript:void(0)" class="box-ongoing-event"><span
                                             class="add-more-link">+ Add Row</span></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row new_csr_project_other"
                           style="<?= ($obligation->new_csr_project_nature == 1) ? 'display:none' : '' ?>">
                           <div class="col-md-11">
                              <div class="contributor_details">
                                 <label class="control-label-closing">10. (c) (iv) Details of amount spent against new
                                    otheg than ongoing CSR project in the financial year:</label>
                              </div>
                           </div>
                        </div>
                        <div class="ongoing_projects new_csr_project_other"
                           style="<?= ($obligation->new_csr_project_nature == 1) ? 'display:none' : '' ?>">
                           <div class="col-lg-12">
                              <div class="row">
                                 <label class="control-label"
                                    style="font-weight:400;font-size:16px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details
                                    of amount spent against new other than ongoing projects in the financial
                                    year:</label>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="row">
                                 <div class="form-group col-sm ctcsr" style="margin-top:20px">
                                    <p class="control-label" style="margin-bottom:0px">Number of Other than Ongoing
                                       Projects: <span class="textbox box-other-ongoing-event-count"
                                          style="margin-left:10px;"><?= (isset($new_other)) ? count($new_other) : 1 ?></span>
                                    </p>
                                    <div class="container">
                                       <div class="panel panel-default">
                                          <div class="center-block fix-width scroll-inner">
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
                                                         Name of the project
                                                      </th>
                                                      <th scope="col">
                                                         Local Area (Y/N)
                                                      </th>
                                                      <th scope="col" colspan="2">
                                                         Location of the Project
                                                      </th>
                                                      <th scope="col">
                                                         Project Duration (Months)
                                                      </th>
                                                      <th scope="col">
                                                         Amt spent in the FY (in Rs.)
                                                      </th>
                                                      <th scope="col">
                                                         Mode of Implementation Direct (Y/ N)
                                                      </th>
                                                      <th scope="col" colspan="2">
                                                         Mode of Implementation Through Implementing Agency
                                                      </th>
                                                      <th class="table-delete-icon"> </th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                      <th scope="col" colspan="5">
                                                      </th>
                                                      <th colspan="2" scope="col" class="fy">
                                                         State & District
                                                      </th>
                                                      <th scope="col" colspan="3">
                                                      </th>
                                                      <th scope="col" class="fy">
                                                         CSR Registration No.
                                                      </th>
                                                      <th scope="col" class="fy">
                                                         Name
                                                      </th>
                                                      <th class="table-delete-icon"> </th>
                                                   </tr>
                                                </tbody>
                                                <tbody class="box-other-ongoing">
                                                   <?php if (isset($new_other) && $new_other) {
                                                      foreach ($new_other as $key => $row) { ?>
                                                         <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td>
                                                               <input type="hidden" name="project_id[]"
                                                                  class="form-control" />
                                                               <input type="hidden" name="type[]" class="form-control"
                                                                  value="2" required />
                                                               <input type="date" name="pertains[]"
                                                                  value="<?= $row->FY_year_project_commenced ?>"
                                                                  class="form-control" required />
                                                            </td>
                                                            <td>
                                                               <select name="sector[]" class="form-control" required>
                                                                  <option value="">Select Sector</option>
                                                                  <?php foreach ($sectors as $sec) { ?>
                                                                     <option <?= ($row->sector == $sec->sector_type) ? 'selected' : '' ?> data-sdgs='<?= $sec->sdgs_id ?>'
                                                                        value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?>
                                                                     </option>
                                                                  <?php } ?>
                                                               </select>
                                                            </td>
                                                            <td><input type="text" name="prject_name[]"
                                                                  value="<?= $row->project_name ?>" class="form-control"
                                                                  onpaste="return false;"
                                                                  onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"
                                                                  required /></td>
                                                            <td>
                                                               <select name="area[]" class="form-control" required>
                                                                  <option value="">Select</option>
                                                                  <option <?= ($row->local_area == 1) ? 'selected' : '' ?>
                                                                     value="1">
                                                                     Yes</option>
                                                                  <option <?= ($row->local_area == 2) ? 'selected' : '' ?>
                                                                     value="2">
                                                                     No</option>
                                                               </select>
                                                            </td>
                                                            <td colspan="2">
                                                               <select name="location[]"
                                                                  class="form-control location-select-2" required>
                                                                  <option value="">Select Location</option>
                                                                  <?php foreach ($district as $dst) { ?>
                                                                     <option <?= (($row->location_district . ',' . $row->location_state) == ($dst->dst_name . ',' . $dst->st_name)) ? 'selected' : '' ?>
                                                                        value="<?= $dst->dst_name . ',' . $dst->st_name ?>">
                                                                        <?= $dst->dst_name . ',' . $dst->st_name ?>
                                                                     </option>
                                                                  <?php } ?>
                                                               </select>
                                                            </td>
                                                            <td><input type="number" name="duration[]"
                                                                  value="<?= $row->project_duration ?>" class="form-control"
                                                                  required /></td>
                                                            <td><input type="number" name="amount[]"
                                                                  value="<?= $row->amt_spent_in_year ?>" class="form-control"
                                                                  required /></td>
                                                            <td>
                                                               <select name="implementation[]" class="form-control" required>
                                                                  <option value="">Select</option>
                                                                  <option <?= ($row->is_direct_implementation == 1) ? 'selected' : '' ?> value='1'>Implementing agency</option>
                                                                  <option <?= ($row->is_direct_implementation == 2) ? 'selected' : '' ?> value='2'>Direct</option>
                                                               </select>
                                                            </td>
                                                            <td><input type="text" name="registration[]"
                                                                  value="<?= $row->CSR_reg_no ?>"
                                                                  class="form-control validate-csr-number" maxlength="11"
                                                                  required /></td>
                                                            <td><input type="text" name="agency[]"
                                                                  value="<?= $row->implementer_name ?>" class="form-control"
                                                                  required /></td>
                                                            <td class="table-delete-icon"></td>
                                                         </tr>
                                                      <?php }
                                                   } else { ?>
                                                      <tr>
                                                         <td>1</td>
                                                         <td>
                                                            <input type="hidden" name="project_id[]"
                                                               class="form-control" />
                                                            <input type="hidden" name="type[]" class="form-control"
                                                               value="2" required />
                                                            <input type="date" name="pertains[]" class="form-control" />
                                                         </td>
                                                         <td>
                                                            <select name="sector[]" class="form-control">
                                                               <option value="">Select Sector</option>
                                                               <?php foreach ($sectors as $sec) { ?>
                                                                  <option data-sdgs='<?= $sec->sdgs_id ?>'
                                                                     value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?>
                                                                  </option>
                                                               <?php } ?>
                                                            </select>
                                                         </td>
                                                         <td><input type="text" name="prject_name[]" class="form-control"
                                                               onpaste="return false;"
                                                               onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" /></td>
                                                         <td>
                                                            <select name="area[]" class="form-control">
                                                               <option value="">Select</option>
                                                               <option value="1">Yes</option>
                                                               <option value="2">No</option>
                                                            </select>
                                                         </td>
                                                         <td colspan="2">
                                                            <select name="location[]"
                                                               class="form-control location-select-2">
                                                               <option value="">Select Location</option>
                                                               <?php foreach ($district as $dst) { ?>
                                                                  <option value="<?= $dst->dst_name . ',' . $dst->st_name ?>">
                                                                     <?= $dst->dst_name . ',' . $dst->st_name ?>
                                                                  </option>
                                                               <?php } ?>
                                                            </select>
                                                         </td>
                                                         <td><input type="number" name="duration[]" class="form-control" />
                                                         </td>
                                                         <td><input type="number" name="amount[]" class="form-control" />
                                                         </td>
                                                         <td>
                                                            <select name="implementation[]" class="form-control">
                                                               <option value="">Select</option>
                                                               <option value='1'>Implementing agency</option>
                                                               <option value='2'>Direct</option>
                                                            </select>
                                                         </td>
                                                         <td><input type="text" name="registration[]"
                                                               class="form-control validate-csr-number" maxlength="11" />
                                                         </td>
                                                         <td><input type="text" name="agency[]" class="form-control" />
                                                         </td>
                                                         <td class="table-delete-icon"></td>
                                                      </tr>
                                                   <?php } ?>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12" style="text-align: initial;">
                                       <a href="javascript:void(0)" class="box-other-ongoing-event"><span
                                             class="add-more-link">+ Add Row</span></a>
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
               <div class="row">
                  <div class="col-md-11">
                     <div class="contributor_details">
                        <label class="control-label-closing">11 Whether any unspent amount pertaining to FY 2014-15 to
                           FY 2019-20 has been spent in the financial year:</label>
                        <div class="yn">
                           <div><input class="form-check-input check_is_committee_constituted"
                                 <?= ($obligation->is_unspent_for_pretaining_2014_15_to_2019_20 == 1) ? 'checked' : '' ?>
                                 type="radio" name="is_unspent_for_pretaining_2014_15_to_2019_20" value="1" required>
                              <label>Yes</label>
                           </div>
                           <div>
                              <input class="form-check-input check_is_committee_constituted"
                                 <?= ($obligation->is_unspent_for_pretaining_2014_15_to_2019_20 == 2) ? 'checked' : '' ?>
                                 type="radio" name="is_unspent_for_pretaining_2014_15_to_2019_20" value="2" required>
                              <label>No</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 target-pretaining-box"
                  style="<?= ($obligation->is_unspent_for_pretaining_2014_15_to_2019_20 == 1) ? 'display:block' : 'display:none' ?>">
                  <div class="row">
                     <div class="ongoing_projects">
                        <div class="col-lg-12">
                           <div class="row">
                              <label class="control-label"
                                 style="font-weight:400;font-size:16px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details
                                 of amount spent against CSR projects in the financial year:</label>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="row">
                              <div class="form-group col-sm ctcsr" style="margin-top:20px">
                                 <p class="control-label" style="margin-bottom:0px">Number of CSR Projects: <span
                                       class="box-csr-event-count"
                                       style="margin-left:10px;"><?= (isset($csr_project)) ? count($csr_project) : 1 ?></span>
                                 </p>
                                 <div class="container">
                                    <div class="panel panel-default">
                                       <div class="center-block fix-width scroll-inner">
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
                                                      Name of the project
                                                   </th>
                                                   <th scope="col">
                                                      Local Area (Y/N)
                                                   </th>
                                                   <th scope="col" colspan="2">
                                                      Location of the Project
                                                   </th>
                                                   <!--<th scope="col">
                                             Project Duration (Months)
                                          </th>-->
                                                   <th scope="col">
                                                      Amt spent in the FY (in Rs.)
                                                   </th>
                                                   <th scope="col">
                                                      Mode of Implementation Direct (Y/ N)
                                                   </th>
                                                   <th scope="col" colspan="2">
                                                      Mode of Implementation Through Implementing Agency
                                                   </th>
                                                   <th class="table-delete-icon"> </th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <th scope="col" colspan="5">
                                                   </th>
                                                   <th colspan="2" scope="col" class="fy">
                                                      State & District
                                                   </th>
                                                   <th scope="col" colspan="2">
                                                   </th>
                                                   <th scope="col" class="fy">
                                                      CSR Registration No.
                                                   </th>
                                                   <th scope="col" class="fy">
                                                      Name
                                                   </th>
                                                   <th class="table-delete-icon"> </th>
                                                </tr>
                                             </tbody>
                                             <tbody class="box-csr">
                                                <?php if (isset($csr_project) && $csr_project) {
                                                   foreach ($csr_project as $key => $row) { ?>
                                                      <tr>
                                                         <td><?= $key + 1 ?></td>
                                                         <td>
                                                            <input type="hidden" name="project_id[]" class="form-control" />
                                                            <input type="hidden" name="type[]" class="form-control" value="3"
                                                               required />
                                                            <input type="date" name="pertains[]"
                                                               value="<?= $row->FY_year_project_commenced ?>"
                                                               class="form-control" required />
                                                         </td>
                                                         <td>
                                                            <select name="sector[]" class="form-control" required>
                                                               <option value="">Select Sector</option>
                                                               <?php foreach ($sectors as $sec) { ?>
                                                                  <option <?= ($row->sector == $sec->sector_type) ? 'selected' : '' ?> data-sdgs='<?= $sec->sdgs_id ?>'
                                                                     value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?>
                                                                  </option>
                                                               <?php } ?>
                                                            </select>
                                                         </td>
                                                         <td><input type="text" name="prject_name[]" class="form-control"
                                                               value="<?= $row->project_name ?>" onpaste="return false;"
                                                               onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required />
                                                         </td>
                                                         <td>
                                                            <select name="area[]" class="form-control" required>
                                                               <option value="">Select</option>
                                                               <option <?= ($row->local_area == 1) ? 'selected' : '' ?>
                                                                  value="1">Yes
                                                               </option>
                                                               <option <?= ($row->local_area == 2) ? 'selected' : '' ?>
                                                                  value="2">No
                                                               </option>
                                                            </select>
                                                         </td>
                                                         <td colspan="2">
                                                            <select name="location[]" class="form-control location-select-2"
                                                               required>
                                                               <option value="">Select Location</option>
                                                               <?php foreach ($district as $dst) { ?>
                                                                  <option <?= (($row->location_district . ',' . $row->location_state) == ($dst->dst_name . ',' . $dst->st_name)) ? 'selected' : '' ?>
                                                                     value="<?= $dst->dst_name . ',' . $dst->st_name ?>">
                                                                     <?= $dst->dst_name . ',' . $dst->st_name ?>
                                                                  </option>
                                                               <?php } ?>
                                                            </select>
                                                         </td>
                                                         <input type="hidden" name="duration[]" class="form-control"
                                                            value="<?= $row->project_duration ?>" required />
                                                         <td><input type="number" name="amount[]" class="form-control"
                                                               value="<?= $row->amt_spent_in_year ?>" required /></td>
                                                         <td>
                                                            <select name="implementation[]" class="form-control" required>
                                                               <option value="">Select</option>
                                                               <option <?= ($row->is_direct_implementation == 1) ? 'selected' : '' ?> value='1'>Implementing agency</option>
                                                               <option <?= ($row->is_direct_implementation == 2) ? 'selected' : '' ?> value='2'>Direct</option>
                                                            </select>
                                                         </td>
                                                         <td><input type="text" name="registration[]"
                                                               value="<?= $row->CSR_reg_no ?>"
                                                               class="form-control validate-csr-number" maxlength="11"
                                                               required /></td>
                                                         <td><input type="text" name="agency[]"
                                                               value="<?= $row->implementer_name ?>" class="form-control"
                                                               required /></td>
                                                         <td class="table-delete-icon"></td>
                                                      </tr>
                                                   <?php }
                                                } else { ?>
                                                   <tr>
                                                      <td>1</td>
                                                      <td>
                                                         <input type="hidden" name="project_id[]" class="form-control" />
                                                         <input type="hidden" name="type[]" class="form-control"
                                                            value="3" />
                                                         <input type="date" name="pertains[]" class="form-control" />
                                                      </td>
                                                      <td>
                                                         <select name="sector[]" class="form-control">
                                                            <option value="">Select Sector</option>
                                                            <?php foreach ($sectors as $sec) { ?>
                                                               <option data-sdgs='<?= $sec->sdgs_id ?>'
                                                                  value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?>
                                                               </option>
                                                            <?php } ?>
                                                         </select>
                                                      </td>
                                                      <td><input type="text" name="prject_name[]" class="form-control"
                                                            onpaste="return false;"
                                                            onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" /></td>
                                                      <td>
                                                         <select name="area[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                         </select>
                                                      </td>
                                                      <td colspan="2">
                                                         <select name="location[]" class="form-control location-select-2">
                                                            <option value="">Select Location</option>
                                                            <?php foreach ($district as $dst) { ?>
                                                               <option value="<?= $dst->dst_name . ',' . $dst->st_name ?>">
                                                                  <?= $dst->dst_name . ',' . $dst->st_name ?>
                                                               </option>
                                                            <?php } ?>
                                                         </select>
                                                      </td>
                                                      <input type="hidden" name="duration[]" class="form-control" />
                                                      <td><input type="number" name="amount[]" class="form-control" /></td>
                                                      <td>
                                                         <select name="implementation[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value='1'>Implementing agency</option>
                                                            <option value='2'>Direct</option>
                                                         </select>
                                                      </td>
                                                      <td><input type="text" name="registration[]"
                                                            class="form-control validate-csr-number" maxlength="11" /></td>
                                                      <td><input type="text" name="agency[]" class="form-control" /></td>
                                                      <td class="table-delete-icon"></td>
                                                   </tr>
                                                <?php } ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12" style="text-align: initial;">
                                    <a href="javascript:void(0)" class="box-csr-event"><span class="add-more-link">+ Add
                                          Row</span></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="new_project previous_year">
               <div class="row">
                  <div class="col-md-6">
                     <div class="contributor_details">
                        <label class="control-label-closing">12. Whether any Capital assets have been created or
                           acquired through CSR spent in the financial year *:</label>
                        <div class="yn">
                           <div>
                              <input class="form-check-input check_is_committee_constituted"
                                 <?= ($obligation->is_capital_assest_created == 1) ? 'checked' : '' ?> type="radio"
                                 name="is_capital_assest_created" <?= ($obligation->is_capital_assest_created == 1) ? 'checked' : '' ?> value="1" required>
                              <label>Yes</label>
                           </div>
                           <div>
                              <input class="form-check-input check_is_committee_constituted"
                                 <?= ($obligation->is_capital_assest_created == 2) ? 'checked' : '' ?> type="radio"
                                 name="is_capital_assest_created" <?= ($obligation->is_capital_assest_created == 2) ? 'checked' : '' ?> value="2" required>
                              <label>No</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 target-asset-box"
                     style="<?= ($obligation->is_capital_assest_created == 1) ? 'display:block' : 'display:none' ?>">
                     <div class="contributor_details">
                        <label class="control-label-closing">If Yes, enter the number of Capital assets created/acquired
                           :</label>
                        <div class="yn">
                           <input class="form-control" readonly type="text" name="number_of_capital_assets">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 target-asset-box"
                  style="<?= ($obligation->is_capital_assest_created == 1) ? 'display:block' : 'display:none' ?>">
                  <div class="row">
                     <div class="ongoing_projects">
                        <div class="col-lg-12">
                           <div class="row">
                              <label class="control-label"
                                 style="font-weight:400;font-size:16px;color:#000;margin-bottom:0px;display:block;width: 100%;">Furnish
                                 the details relating to such asset(s) so created or acquired through CSR spent in the
                                 financial year:</label>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="row">
                              <div class="form-group col-sm ctcsr" style="margin-top:20px">
                                 <div class="container">
                                    <div class="panel panel-default">
                                       <div class="center-block fix-width scroll-inner">
                                          <table class="table" style="margin-top:10px">
                                             <thead>
                                                <tr>
                                                   <th scope="col">
                                                      Sr. No.
                                                   </th>
                                                   <th scope="col">
                                                      Short particulars of property or asset(s) [Including complete
                                                      address and location of the property]
                                                   </th>
                                                   <th scope="col">
                                                      Pin code of property or asset
                                                   </th>
                                                   <th scope="col">
                                                      Date of Creation
                                                   </th>
                                                   <th scope="col">
                                                      Amount of CSR spent
                                                   </th>
                                                   <th scope="col" colspan="3">
                                                      Detail of entity/authority/beneficiary of registered owner
                                                   </th>
                                                   <th class="table-delete-icon"> </th>
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
                                                   <th class="table-delete-icon"> </th>
                                                </tr>
                                             </tbody>
                                             <tbody class="box-asset">
                                                <?php if (isset($csr_asset) && $csr_asset) {
                                                   foreach ($csr_asset as $key => $row) { ?>
                                                      <tr>
                                                         <td><?= $key + 1 ?></td>
                                                         <td>
                                                            <input type="text" name="particulars[]" class="form-control"
                                                               value="<?= $row->asset_details ?>" required />
                                                         </td>
                                                         <td>
                                                            <input type="text" minlength="6" maxlength="6" name="pin[]"
                                                               class="form-control" value="<?= $row->pincode ?>" required />
                                                         </td>
                                                         <td>
                                                            <input type="date" name="creation[]" class="form-control"
                                                               value="<?= $row->date_of_creation ?>" required />
                                                         </td>
                                                         <td>
                                                            <input type="number" name="csr_amount[]" class="form-control"
                                                               value="<?= $row->Expense_budget ?>" required />
                                                         </td>
                                                         <td>
                                                            <input type="text" name="owner_registration[]"
                                                               class="form-control  validate-csr-number" maxlength="11"
                                                               value="<?= $row->CSR_reg_no ?>" required />
                                                         </td>
                                                         <td><input type="text" name="owner_name[]" class="form-control"
                                                               value="<?= $row->implrmenter_name ?>" required /></td>
                                                         <td><input type="text" name="owner_address[]" class="form-control"
                                                               value="<?= $row->implementer_registred_address ?>" required />
                                                         </td>
                                                         <td class="table-delete-icon"></td>
                                                      </tr>
                                                   <?php }
                                                } else { ?>
                                                   <tr>
                                                      <td>01</td>
                                                      <td>
                                                         <input type="text" name="particulars[]" class="form-control" />
                                                      </td>
                                                      <td>
                                                         <input type="text" minlength="6" maxlength="6" name="pin[]"
                                                            class="form-control validate-number" />
                                                      </td>
                                                      <td>
                                                         <input type="date" name="creation[]" class="form-control" />
                                                      </td>
                                                      <td>
                                                         <input type="number" name="csr_amount[]" class="form-control" />
                                                      </td>
                                                      <td>
                                                         <input type="text" name="owner_registration[]"
                                                            class="form-control  validate-csr-number" maxlength="11" />
                                                      </td>
                                                      <td><input type="text" name="owner_name[]" class="form-control" />
                                                      </td>
                                                      <td><input type="text" name="owner_address[]" class="form-control" />
                                                      </td>
                                                      <td class="table-delete-icon"></td>
                                                   </tr>
                                                <?php } ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12" style="text-align: initial;">
                                    <a href="javascript:void(0)" class="box-asset-event"><span class="add-more-link">+
                                          Add details of capital asset</span></a>
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
      <input type="hidden" name="report_status" class="report_status" value="">
      <input type="submit" style="display: none;" class="submitform">
   </form>
   <div class="save_btns">
      <div class="col-sm-12">
         <div class="wrap_flex_btn">
            <div class="form-group">
               <a href="<?php echo base_url(); ?>/CsrCompliance/dashboard" class="cancelBtn">Cancel</a>
            </div>
            <div class="form-group">
               <a href="javascript:void(0)" class="draftbtn">Save As Draft</a>
            </div>
            <div class="form-group">
               <button type="button" class="btn btn-primary saveBtn">Submit & Preview</button>
            </div>
         </div>
      </div>
   </div>
</body>
<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
<script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/implementor.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/select2.min.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
<?php $this->load->view('common/footer_js'); ?>
<script>
   let SKIN_URL = '<?php echo SKIN_URL; ?>';
   $(".draftbtn").click(function () {
      if (validateCsrNumber() != true)
         return false;
      $('.report_status').val(2);
      setTimeout(() => {
         $('.submitform').click();
      }, 1500);
   });
   $(".saveBtn").click(function () {
      if (validateCsrNumber() != true)
         return false;
      $('.report_status').val(3);
      setTimeout(() => {
         $('.submitform').click();
      }, 1500);
   });
   $(".box-ongoing-event").click(function () {
      $(".location-select-2").select2('destroy');
      var count = Number($(".box-ongoing tr").length);
      $('.box-ongoing-event-count').text(count + 1);
      var html = `<tr>
                                    <td>${count + 1}</td>
                                    <td>
                                       <input type="text" name="project_id[]" class="form-control" required/>
                                       <input type="hidden" name="type[]" class="form-control" value="1" required/>
                                    </td>
                                    <td><input type="date" name="pertains[]" class="form-control" required/></td>
                                    <td>
                                       <select name="sector[]" class="form-control" required>
                                          <option value="">Select Sector</option>
                                          <?php foreach ($sectors as $sec) { ?>
                                                                                                         <option data-sdgs='<?= $sec->sdgs_id ?>' value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?></option>
                                          <?php } ?>
                                       </select>
                                    </td>
                                    <td><input type="text" name="prject_name[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                    <td>
                                       <select name="area[]" class="form-control" required>
                                          <option value="">Select</option>
                                          <option value="1">Yes</option>
                                          <option value="2">No</option>
                                       </select>
                                    </td>
                                    <td colspan="2">
                                       <select name="location[]" class="form-control location-select-2" required>
                                          <option value="">Select Location</option>
                                          <?php foreach ($district as $dst) { ?>
                                                                                                         <option value="<?= $dst->dst_name . ',' . $dst->st_name ?>"><?= $dst->dst_name . ',' . $dst->st_name ?></option>
                                          <?php } ?>
                                       </select>
                                    </td>
                                    <input type="hidden" name="duration[]" class="form-control"/>
                                    <td><input type="number" name="amount[]" class="form-control" required/></td>
                                    <td>
                                       <select name="implementation[]" class="form-control" required>
                                          <option value="">Select</option>
                                          <option value='1'>Implementing agency</option>
                              <option value='2'>Direct</option>
                                       </select>
                                    </td>
                                    <td><input type="text" name="registration[]" class="form-control validate-csr-number" maxlength="11"  required/></td>
                                    <td><input type="text" name="agency[]" class="form-control" required/></td>
                                    <td class="table-delete-icon">
                                       <a href="javascript:void(0)" class="event-delete-row-project-ongoing">  
                                          <img src="`+ SKIN_URL + `images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
      $(".box-ongoing").append(html);
      $(".location-select-2").select2();
   });
   $(document).on('click', '.event-delete-row-project-ongoing', function () {
      $(this).closest('tr').remove();
      var count = Number($(".box-ongoing tr").length);
      $('.box-ongoing-event-count').text(count);
   });
   $(".location-select-2").select2();

   $(".box-other-ongoing-event").click(function () {
      $(".location-select-2").select2('destroy');
      var count = Number($(".box-other-ongoing tr").length);
      $('.box-other-ongoing-event-count').text(count + 1);
      var html = `<tr>
                                    <td>${count + 1}</td>
                                    <td>
                                       <input type="hidden" name="project_id[]" class="form-control"/>
                                       <input type="hidden" name="type[]" class="form-control" value="2" required/>
                                       <input type="date" name="pertains[]" class="form-control" required/></td>
                                    <td>
                                       <select name="sector[]" class="form-control" required>
                                          <option value="">Select Sector</option>
                                          <?php foreach ($sectors as $sec) { ?>
                                                                                                         <option data-sdgs='<?= $sec->sdgs_id ?>' value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?></option>
                                          <?php } ?>
                                       </select>
                                    </td>
                                    <td><input type="text" name="prject_name[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                    <td>
                                       <select name="area[]" class="form-control" required>
                                          <option value="">Select</option>
                                          <option value="1">Yes</option>
                                          <option value="2">No</option>
                                       </select>
                                    </td>
                                    <td colspan="2">
                                       <select name="location[]" class="form-control location-select-2" required>
                                          <option value="">Select Location</option>
                                          <?php foreach ($district as $dst) { ?>
                                                                                                         <option value="<?= $dst->dst_name . ',' . $dst->st_name ?>"><?= $dst->dst_name . ',' . $dst->st_name ?></option>
                                          <?php } ?>
                                       </select>
                                    </td>
                                    <td><input type="number" name="duration[]" class="form-control" required/></td>
                                    <td><input type="number" name="amount[]" class="form-control" required/></td>
                                    <td>
                                       <select name="implementation[]" class="form-control" required>
                                          <option value="">Select</option>
                                          <option value='1'>Implementing agency</option>
                              <option value='2'>Direct</option>
                                       </select>
                                    </td>
                                    <td><input type="text" name="registration[]" class="form-control validate-csr-number" maxlength="11"  required/></td>
                                    <td><input type="text" name="agency[]" class="form-control" required/></td>
                                    <td class="table-delete-icon">
                                       <a href="javascript:void(0)" class="event-delete-row-project-other">  
                                          <img src="`+ SKIN_URL + `images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
      $(".box-other-ongoing").append(html);
      $(".location-select-2").select2();
   });
   $(document).on('click', '.event-delete-row-project-other', function () {
      $(this).closest('tr').remove();
      var count = Number($(".box-other-ongoing tr").length);
      $('.box-other-ongoing-event-count').text(count);
   });
   $(".box-csr-event").click(function () {
      $(".location-select-2").select2('destroy');
      var count = Number($(".box-csr tr").length);
      $('.box-csr-event-count').text(count + 1);
      var html = `<tr>
                                    <td>${count + 1}</td>
                                    <td>
                                       <input type="hidden" name="project_id[]" class="form-control"/>
                                       <input type="hidden" name="type[]" class="form-control" value="3" required/>
                                       <input type="date" name="pertains[]" class="form-control" required/></td>
                                    <td>
                                       <select name="sector[]" class="form-control" required>
                                          <option value="">Select Sector</option>
                                          <?php foreach ($sectors as $sec) { ?>
                                                                                                         <option data-sdgs='<?= $sec->sdgs_id ?>' value="<?= $sec->sector_type ?>"><?= $sec->sector_type ?></option>
                                          <?php } ?>
                                       </select>
                                    </td>
                                    <td><input type="text" name="prject_name[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                    <td>
                                       <select name="area[]" class="form-control" required>
                                          <option value="">Select</option>
                                          <option value="1">Yes</option>
                                          <option value="2">No</option>
                                       </select>
                                    </td>
                                    <td colspan="2">
                                       <select name="location[]" class="form-control location-select-2" required>
                                          <option value="">Select Location</option>
                                          <?php foreach ($district as $dst) { ?>
                                                                                                         <option value="<?= $dst->dst_name . ',' . $dst->st_name ?>"><?= $dst->dst_name . ',' . $dst->st_name ?></option>
                                          <?php } ?>
                                       </select>
                                    </td>
                                    <input type="hidden" name="duration[]" class="form-control"/>
                                    <td><input type="number" name="amount[]" class="form-control" required/></td>
                                    <td>
                                       <select name="implementation[]" class="form-control" required>
                                          <option value="">Select</option>
                                          <option value='1'>Implementing agency</option>
                              <option value='2'>Direct</option>
                                       </select>
                                    </td>
                                    <td><input type="text" name="registration[]" class="form-control validate-csr-number" maxlength="11"  required/></td>
                                    <td><input type="text" name="agency[]" class="form-control" required/></td>
                                    <td class="table-delete-icon">
                                       <a href="javascript:void(0)" class="event-delete-row-project-csr">  
                                          <img src="`+ SKIN_URL + `images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
      $(".box-csr").append(html);
      $(".location-select-2").select2();
   });
   $(document).on('click', '.event-delete-row-project-csr', function () {
      $(this).closest('tr').remove();
      var count = Number($(".box-csr tr").length);
      $('.box-csr-event-count').text(count);
   });
   $(".box-asset-event").click(function () {
      var count = Number($(".box-asset tr").length);
      var html = `<tr>
                                    <td>${count + 1}</td>
                                    <td>
                                       <input type="text" name="particulars[]" class="form-control" required/>
                                    </td>
                                    <td>
                                       <input type="number"  type="text"  minlength="6" maxlength="6"  name="pin[]" class="form-control" required/>
                                    </td>
                                    <td>
                                       <input type="date" name="creation[]" class="form-control" required/>
                                    </td>
                                    <td>
                                       <input type="number" name="csr_amount[]" class="form-control" required/>
                                    </td>
                                    <td>
                                       <input type="text" name="owner_registration[]" class="form-control  validate-csr-number" maxlength="11" required/>
                                    </td>
                                    <td><input type="text" name="owner_name[]" class="form-control" required/></td>
                                    <td><input type="text" name="owner_address[]" class="form-control" required/></td>
                                    <td  class="table-delete-icon">
                                       <a href='javascript:void(0)' class="event-delete-row-asset">  
                                          <img src="`+ SKIN_URL + `images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
      $(".box-asset").append(html);
      numberOfAsset();
   });
   $(document).on('click', '[name="is_capital_assest_created"]', function () {
      var check = $('input[name="is_capital_assest_created"]:checked').val();
      if (check == 1) {
         $('.target-asset-box').find("input").prop('required', true);
         $('.target-asset-box').css('display', 'block');
      } else {
         $('.target-asset-box').find("input").prop('required', false);
         $('.target-asset-box').css('display', 'none');
      }
   });
   $(document).on('click', '[name="is_unspent_for_pretaining_2014_15_to_2019_20"]', function () {
      var check = $('input[name="is_unspent_for_pretaining_2014_15_to_2019_20"]:checked').val();
      if (check == 1) {
         $('.target-pretaining-box').find("input,select").prop('required', true);
         $('.target-pretaining-box').css('display', 'block');
      } else {
         $('.target-pretaining-box').find("input,select").prop('required', false);
         $('.target-pretaining-box').css('display', 'none');
      }
   });
   $(document).on('click', '[name="new_csr_project"]', function () {
      var check = $('input[name="new_csr_project"]:checked').val();
      if (check == 1) {
         $('.new_csr_project_nature').find("input,select").prop('required', true);
         $('.new_csr_project_nature').css('display', 'block');
      } else {
         $('.new_csr_project_nature').find("input,select").prop('required', false);
         $('.new_csr_project_nature').css('display', 'none');
      }
   });
   $(document).on('click', '[name="new_csr_project_nature"]', function () {
      var check = $('input[name="new_csr_project_nature"]:checked').val();
      $('.new_csr_project_other').find("input,select").prop('required', true);
      $('.new_csr_project_ongoing').find("input,select").prop('required', true);
      if (check == 1) {
         $('.new_csr_project_ongoing').css('display', 'block');
         $('.new_csr_project_other').css('display', 'none');
         $('.new_csr_project_other').find("input,select").prop('required', false);
      } else if (check == 2) {
         $('.new_csr_project_other').css('display', 'block');
         $('.new_csr_project_ongoing').css('display', 'none');
         $('.new_csr_project_ongoing').find("input,select").prop('required', false);
      } else {
         $('.new_csr_project_ongoing').css('display', 'block');
         $('.new_csr_project_other').css('display', 'block');
      }
   });
   $(document).on('click', '[name="impact_assessment"]', function () {
      var check = $('input[name="impact_assessment"]:checked').val();
      if (check == 1) {
         $('.check_is_impact_assessment_board_box').css('display', 'block');
         $('.check_is_impact_assessment_board_box').find('input').attr('required', true);
      } else {
         $('.check_is_impact_assessment_board_box').css('display', 'none');
         $('.impact_assessment_board_link_box').css('display', 'none');
         $('.check_is_impact_assessment_board_box').find('input').attr('required', false);
      }
   });
   $(document).on('click', '[name="impact_assessment_board"]', function () {
      var check = $('input[name="impact_assessment_board"]:checked').val();
      if (check == 1) {
         $('.impact_assessment_board_link_box').css('display', 'block');
      } else {
         $('.impact_assessment_board_link_box').css('display', 'none');
      }
   });
   $(document).on('change', '[name="meeting"]', function () {
      $('[name="attend[]"]').val($(this).val());
      $('[name="attend[]"]').attr('max', $(this).val());
   });
   function numberOfAsset() {
      $('[name="number_of_capital_assets"]').val(Number($('[name="particulars[]"]').length));
   }
   $('.box-asset').on('click', '.event-delete-row-asset', function () {
      $(this).closest('tr').remove();
      numberOfAsset();
   });
   numberOfAsset();
   $(document).on('change', '[name="csr_amt"]', function () {
      $('.csr_amt-text').val($(this).val());
   });
   $(document).on('change', '[name="schedule_amt"]', function () {
      $('.schedule_amt-text').val($(this).val());
   });
   $(document).on('change mouseover', '[name="implementation[]"]', function () {
      $(this).attr('title', $(this).find(":selected").text());
   });
   $(document).on('change', '.validate-csr-number', function () {
      validateCsrNumber();
   });
   function validateCsrNumber() {
      var regex = /^(CSR)+([0-9]{8,8})+$/;
      var flag = false;
      $('.validate-csr-number').each(function () {
         var value = $(this).val();
         if ($(this).attr('required')) {
            $(this).parent().find('.error').remove();
            if (regex.test(value) != true) {
               $(this).parent().append('<label class="error">Please Enter A Valid CSR Registration No.</label>');
               flag = true;
            }
         }
      });
      if (flag == true)
         return false;
      return true;
   };
</script>
<script>document.addEventListener('DOMContentLoaded', function () {
      const sevenF = document.getElementById('seven_f');
      const sevenG = document.getElementById('seven_g');
      const sevenH = document.getElementById('seven_h');

      const calculateSevenH = () => {
         const f = parseFloat(sevenF.value) || 0;
         const g = parseFloat(sevenG.value) || 0;
         sevenH.value = (f - g).toFixed(2);
      };


      calculateSevenH();


      sevenF.addEventListener('input', calculateSevenH);
      sevenG.addEventListener('input', calculateSevenH);
   });</script>
<script>
   function validateCSRAmount(actualInput) {
      const csrAmt = parseFloat(document.getElementById('csr_amt').value) || 0;
      const csrActual = parseFloat(actualInput.value) || 0;
      const errorMessage = document.getElementById('error-message');

      if (csrActual > csrAmt) {
         errorMessage.style.display = 'block';
         actualInput.style.borderColor = 'red';
      } else {
         errorMessage.style.display = 'none';
         actualInput.style.borderColor = '';
      }
   }

</script>
<script>
   function calculateDeficiency() {
      const csrAmt = parseFloat(document.getElementById('csr_amt').value) || 0;
      const csrActual = parseFloat(document.getElementById('csr_actual').value) || 0;
      const deficiencyInput = document.getElementById('csr_deficiency');

      console.log("Eligible Amount:", csrAmt);
      console.log("Actual Amount:", csrActual);


      const deficiency = csrAmt - csrActual;

      console.log("Deficiency:", deficiency);


      deficiencyInput.value = deficiency >= 0 ? deficiency : 0;


      const errorMessage = document.getElementById('error-message');
      if (csrActual > csrAmt) {
         errorMessage.style.display = 'block';
      } else {
         errorMessage.style.display = 'none';
      }
   }
</script>
<script>
   function validateAndCalculate() {
      validateCSRAmount(document.getElementById('csr_actual'));
      calculateDeficiency();
   }
</script>
<script>function validateAndCalculateSchedule() {
      const scheduleAmt = parseFloat(document.getElementById('schedule_amt').value) || 0;
      const scheduleActual = parseFloat(document.getElementById('schedule_actual').value) || 0;
      const scheduleDeficiency = document.getElementById('schedule_deficiency');
      const errorMessage = document.getElementById('schedule-error-message');


      const deficiency = scheduleAmt - scheduleActual;


      scheduleDeficiency.value = deficiency >= 0 ? deficiency : 0;


      if (scheduleActual > scheduleAmt) {
         errorMessage.style.display = 'block';
      } else {
         errorMessage.style.display = 'none';
      }
   }
</script>