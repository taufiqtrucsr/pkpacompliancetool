<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('common/head_common'); ?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />
<link href="<?php echo SKIN_URL; ?>css/select2.min.css" rel="stylesheet" />
<style>
   input,select{
      pointer-events: none;
      background-color: #eeeeee!important;
   }
</style>
<body class="full-page">
   <?php $this->load->view('common/header'); ?>
      <div class="container">
         <div id="fyendreport">
            <div class="kyc-title">
               <h2>Details of Financial Year Closing Report (CSR-2)<br> April <?php $year = explode('-', $prime_year); ?><?=$year[0];?> to March <?=$year[1];?></h2>
            </div>
            <div class="stepwizard">
               <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step">
                     <a href="#" id="fy-step-1-btn" type="button" class="btn btn-default btn-circle"><span class="step-count">01</span> Add Details</a>
                  </div>
                  <div class="stepwizard-step">
                     <a href="#" id="fy-step-2-btn" type="button" class="btn btn-primary btn-circle"><span class="step-count">02</span> Preview & Download</a>
                  </div>
               </div>
            </div>
            <div id="fy-step-2-btn">
               <div class="thruout_year">
                  <div class="col-md-12" style="background: transparent;">
                     <div class="row">
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (a) CIN *:</label>
                           <p><?=(isset($entity->cin->document_number))?$entity->cin->document_number:''?></p>
                        </div>
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (b) Name of the company*:</label>
                           <p><?=$entity->entity_name?></p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (c) Company Addgess *:</label>
                           <p><?=$entity->entity_address?></p>
                        </div>
                        <div class="col-md-6 contributor_details">
                           <label class="control-label-closing">1. (d)  Email *:</label>
                           <p><?=$entity->alternate_email_id?></p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">2. (a) FY to which the CSR details pertain *:</label>
                              <ul class="pegtain">
                                 <li><label class="control-label">From : </label><input class="form-control" type="date" value="<?=(isset($csr2) && isset($csr2->csr_details_pegtain_from))? date('Y-m-d',$csr2->csr_details_pegtain_from):''?>" name="from" onkeydown="return false" required/></li>
                                 <li><label class="control-label">To : </label><input class="form-control" type="date" value="<?=(isset($csr2) && isset($csr2->csr_details_pegtain_to))? date('Y-m-d',$csr2->csr_details_pegtain_to):''?>" name="to" onkeydown="return false" required/></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">2. (b) SRN of fogm AOC-4/ AoC-4 XBRL/ AoC-4 NBFC filed by the company fog its standalone financial statements *:</label>
                              <ul class="pegtain">
                                 <li><input class="form-control" type="text" name="srn" value="<?=(isset($csr2) && isset($csr2->srn))? $csr2->srn:''?>" required/></li>
                                 <li><input class="form-control" type="date"  name="srn_date" value="<?=(isset($csr2) && isset($csr2->srn_date))? date('Y-m-d',$csr2->srn_date):''?>" onkeydown="return false" required/></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="col-lg-12">
                           <div class="row">
                              <label class="control-label" style="font-weight:400;font-size:18px;color:#000;margin-bottom:0px;display:block;width: 100%;">3. Financial Details for CSR:</label>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="row">
                              <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                                 <table class="table" style="margin-top:10px">
                                    <thead>
                                       <tr>
                                          <th scope="col">
                                             Net Worth (in Rs.)
                                          </th>
                                          <th scope="col">
                                             Turnover  (in Rs.)
                                          </th>
                                          <th scope="col">
                                             Net Profit  (in Rs.)
                                          </th>
                                          <th scope="col">
                                             Criteria that triggered CSR applicability
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td><?=$criteria->net_worth?></td>
                                          <td><?=$criteria->turnover?></td>
                                          <td><?=$criteria->net_profit?></td>
                                          <td><?=$criteria->csr_criteria_applicable?></td>
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
                              <label class="control-label-closing">4. (a) (i) Whether CSR Committee has been constituted  * :</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->CSR_committee_constituted == 1)? 'checked':''?> disabled>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->CSR_committee_constituted == 2)? 'checked':''?> disabled>
                                 <label>No</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=(!$obligation->CSR_committee_constituted)? 'checked':''?> disabled>
                                 <label>Not Applicable</label>
                              </div>
                           </div>
                        </div>
                        <?php if($obligation->CSR_committee_constituted == 1){ ?>
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (a) (ii) Number of directors composing CSR Committee:</label>
                              <input class="form-control form-sm-2" style="width:200px" value="<?=$obligation->no_of_CSR_directors ?>" type="text" readonly />
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                     <?php if($obligation->CSR_committee_constituted == 1){ ?>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (a) (iii)  Number of meetings of CSR Committee held during the year:</label>
                              <input class="form-control" style="width:200px" value="<?=(isset($csr2) && isset($csr2->number_of_meetings_of_csr_committee))? $csr2->number_of_meetings_of_csr_committee:''?>" name="meeting" type="number" required/>
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
                                    foreach($committee as $key => $row){ ?>
                                 <tr>
                                    <td><?=$key+1?></td>
                                    <td><?=$row->DIN?></td>
                                    <td><?=$row->name_of_director?></td>
                                    <td><?=(($row->category==1)?'MD':(($row->category==2)?'Executive':(($row->category==3)?'Non-Executive Non Independent':'Non-Executive Independent')))?></td>
                                    <td>
                                       <input class="form-control" type="hidden" name="member_id[]" value="<?=$row->id?>"/>
                                       <input class="form-control" type="number" name="attend[]" value="<?=(isset($row->meeting))? $row->meeting:''?>" required/>
                                    </td>
                                 </tr>
                                 <?php }  ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <?php } ?>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (b) (i) Whether the company has a website *:</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_CSR_policy_displayed == 1)? "checked": ""?> value="1" disabled>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_CSR_policy_displayed == 2)? "checked": ""?>  value="2" disabled>
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6" style='<?=($obligation->is_CSR_policy_displayed != 1)? "display:none": ""?>'>
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (b) (ii)  If Yes, Pgovide web link :</label>
                              <input class="form-control" type="text" value="<?=$obligation->CSR_policy_link?>" style="width:300px" readonly/>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-7">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (b) (iii)Whether following has been disclosed on the website of the company in pursuance of Rule 8 of Companies (CSR Policy) Rules, 2014:</label>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">Composition of CSR committee</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->CSR_committee_constituted_displayed == 1)? "checked": ""?> value="1" disabled>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->CSR_committee_constituted_displayed == 2)? "checked": ""?> value="2" disabled>
                                 <label>No</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=(!$obligation->CSR_committee_constituted_displayed)? "checked": ""?>  value="3" disabled>
                                 <label>Not Applicable</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">CSR Policy:</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_CSR_policy_displayed == 1)? "checked": ""?> value="1" disabled>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_CSR_policy_displayed == 2)? "checked": ""?> value="2" disabled>
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">CSR projects approved by the board:</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" <?=($obligation->CSR_projects_displayed == 1)?"checked":""?> type="radio" name="" value="1" disabled>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" <?=($obligation->CSR_projects_displayed == 2)?"checked":""?> type="radio" name=""  value="2" disabled>
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (c) (i) Whether Impact assessment of CSR projects is carried out in pursuance of sub-rule (3) of Rule 8 of Companies (CSR Policy) Rules,2014, if applicable :</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" name="" value="1">
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" name=""  value="2">
                                 <label>No</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" name=""  value="3">
                                 <label>Not Applicable</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (c) (ii)  If yes, Whether the same has been disclosed in the Board Report :</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" name="" value="1">
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" name=""  value="2">
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (c) (iii)  Provide web-link,if any :</label>
                              <input class="form-control" type="text" name="" >
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-8">
                           <div class="contributor_details">
                              <label class="control-label-closing">4. (d) (ii)  Whether any amount is available for set off in pursuance of sub-rule (3) of Rule 7 of Companies (CSR Policy) Rules,2014 * :</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_CSR_setoff_available == 1)? "checked": ""?> value="1" disabled>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_CSR_setoff_available == 2)? "checked": ""?> value="2" disabled>
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="row">
                           <label class="control-label-closing" style="color:#000;">4. (d) (iii)  If yes, provide details:</label>
                           <div>
                              <div class="col-lg-12">
                                 <div class="row">
                                    <?php if($obligation->is_CSR_setoff_available == 1){ ?>
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
                                                <td>FY-1 (YE <?=$set_one_year->FY_year?>)</td>
                                                <td><?=$set_one_year->set_off_amt_available?></td>
                                                <td><?=$set_one_year->amt_set_off_in_FY?></td>
                                                <td><?=$set_one_year->balance_set_off?></td>
                                             </tr>
                                             <tr>
                                                <td>02</td>
                                                <td>FY-2 (YE <?=$set_two_year->FY_year?>)</td>
                                                <td><?=$set_two_year->set_off_amt_available?></td>
                                                <td><?=$set_two_year->amt_set_off_in_FY?></td>
                                                <td><?=$set_two_year->balance_set_off?></td>
                                             </tr>
                                             <tr>
                                                <td>03</td>
                                                <td>FY-3 (YE <?=$set_three_year->FY_year?>)</td>
                                                <td><?=$set_three_year->set_off_amt_available?></td>
                                                <td><?=$set_three_year->amt_set_off_in_FY?></td>
                                                <td><?=$set_three_year->balance_set_off?></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="contributor_details">
                                       <label class="control-label-closing">5. (a)  Whether the company has completed the period of three financial years since its incorporation *:</label>
                                       <div class="yn">
                                          <input class="form-check-input check_is_committee_constituted" type="radio" <?=($entity->companyHasCompletedYears >= 3)? 'checked':''?> value="1" disabled>
                                          <label>Yes</label>
                                          <input class="form-check-input check_is_committee_constituted" type="radio" <?=(!$entity->companyHasCompletedYears >= 3)? 'checked':''?>  value="2" disabled>
                                          <label>No</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="contributor_details">
                                       <label class="control-label-closing">5. (b) If no, then provéde the number of financial years completed since incorporation :</label>
                                       <input class="form-control" type="text" value="<?=$entity->companyHasCompletedYears?>" style="width:200px" disabled>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-8">
                                 <div class="row">
                                    <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                                       <label class="control-label-closing">5. (c)  Net Profit & Other Details For The Preceding Financial Years: *:</label>
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
                                                   Amount in (₹ Lakhs)
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <th scope="col" colspan="2">
                                                </th>
                                                <th scope="col" class="fy">
                                                   FY -1(YE 31/03/2019)
                                                </th>
                                                <th scope="col" class="fy">
                                                   FY-2(YE 31/03/2020)
                                                </th>
                                                <th scope="col" class="fy">
                                                   FY-3(YE 31/03/2021)
                                                </th>
                                             </tr>
                                          </tbody>
                                          <tbody>
                                             <tr>
                                                <td>01</td>
                                                <td>Profit Before Tax</td>
                                                <td><?=$calculationTwoPreviousYear->NP_before_tax?></td>
                                                <td><?=$calculationOnePreviousYear->NP_before_tax?></td>
                                                <td><?=$calculation->NP_before_tax?></td>
                                             </tr>
                                             <tr>
                                                <td>02</td>
                                                <td>Net Profit Computed under Section 198</td>
                                                <td><?=$calculationTwoPreviousYear->net_profit?></td>
                                                <td><?=$calculationOnePreviousYear->net_profit?></td>
                                                <td><?=$calculation->net_profit?></td>
                                             </tr>
                                             <tr>
                                                <td>03</td>
                                                <td>Total amount adjusted as per rule 2(1)(h) of CSR Policy Rule 2014 </td>
                                                <td><?=$calculationTwoPreviousYear->amt_adjusted?></td>
                                                <td><?=$calculationOnePreviousYear->amt_adjusted?></td>
                                                <td><?=$calculation->amt_adjusted?></td>
                                             </tr>
                                             <tr>
                                                <td>04</td>
                                                <td>Total Net Profit for section 135 (2-3)</td>
                                                <td><?=$calculationTwoPreviousYear->total_net_profit?></td>
                                                <td><?=$calculationOnePreviousYear->total_net_profit?></td>
                                                <td><?=$calculation->total_net_profit?></td>
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
                                          <label class="control-label-closing">5. (d)  Average net profit of the company as per section 135(5) * :</label>
                                          <input class="form-control" type="text" name=""  style="width:150px" value="<?=$total_average=round(($calculationTwoPreviousYear->total_net_profit+$calculationOnePreviousYear->total_net_profit+$calculation->total_net_profit)/3);?>" disabled>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-5">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (a) 2% of Avegage net profit of the company as peg section 135(5) * :</label>
                                          <input class="form-control" type="text" name=""  style="width:150px" value="<?=round(($total_average/100)*2);?>" disabled>
                                       </div>
                                    </div>
                                    <div class="col-md-7">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (b)  Sugplus arising out of the CSR pgojects/programs og activities of the previous financial year, if any* :</label>
                                          <input class="form-control" type="text" name=""  style="width:150px" value="<?= $obligation->surplus_from_CSR_projects;?>" disabled>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-5">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (c)  Amount required to be set off for the financial year, if any *:</label>
                                          <input class="form-control" type="text" name=""  style="width:150px" value="<?=$obligation->amt_to_be_set_off;?>" disabled>
                                       </div>
                                    </div>
                                    <div class="col-md-7">
                                       <div class="contributor_details">
                                          <label class="control-label-closing">6. (d)  Total CSR obligation for the financial year (6a+6b-6c) *:</label>
                                          <input class="form-control" type="text" name=""  style="width:150px" value="<?=round((($calculation->total_net_profit/100)*2)+$obligation->surplus_from_CSR_projects-$obligation->amt_to_be_set_off)?>" disabled>
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
                              <label class="control-label-closing">7. (a)  Whether CSR amount for the financial year has been spent: *:</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" <?=(count($director_report_project_ongoing)>0 || count($director_report_project_other)>0)?'checked':''?> type="radio" disabled value="1">
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" <?=(!count($director_report_project_ongoing)>0 && !count($director_report_project_other)>0)?'checked':''?> type="radio" disabled value="2">
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="contributor_details">
                              <label class="control-label-closing">7. (b)   If Yes, CSR amount has been spent against:</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=(count($director_report_project_ongoing)>0 && !count($director_report_project_other)>0)?'checked':''?> disabled value="1">
                                 <label>Ongoing projects</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=(!count($director_report_project_ongoing)>0 && count($director_report_project_other)>0)?'checked':''?> disabled  value="2">
                                 <label>Other than Ongoing projects</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=(count($director_report_project_ongoing)>0 && count($director_report_project_other)>0)?'checked':''?> disabled  value="3">
                                 <label>Both (Ongoing and other than ongoing projects)</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="csrpolicy">
                           <div>
                              <div class="col-lg-12">
                                 <?php if(count($director_report_project_ongoing)>0 || (isset($previous_ongoing) && count($previous_ongoing)>0)){ ?>
                                 <div class="row">
                                    <div class="form-group col-sm ctcsr" style="display: table;">
                                       <label class="control-label-closing">(i) Details of CSR amount spent against ongoing projects for the financial year:</label></br>
                                       <label class="control-label-closing">Number of Ongoing Projects for the financial year: <?=count($director_report_project_ongoing)?></label>
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
                                             <tr>
                                                <td colspan="5"></td>
                                                <td style="background:#f3f6fc">State</td>
                                                <td style="background:#f3f6fc">District</td>
                                                <td colspan="3"></td>
                                                <td style="background:#f3f6fc">CSR Registration No.</td>
                                                <td style="background:#f3f6fc">Name</td>
                                             </tr>
                                             <?php $total =0;
                                                if((isset($previous_ongoing) && count($previous_ongoing)>0)){
                                                   foreach($previous_ongoing as $key => $row){ ?>
                                             <tr>
                                                <td><?=$key+1?></td>
                                                <td></td>
                                                <td><?=$row->sector?></td>
                                                <td><?=$row->project_name?></td>
                                                <td><?=($row->local_area == 1)? 'Yes':'No' ?></td>
                                                <td><?=$row->location_state;?></td>
                                                <td><?=$row->location_district;?></td>
                                                <td>
                                                   <input type="number" class="form-control" value="<?=$row->project_duration;?>"  name="financial_duration_ongoing" required/>
                                                </td>
                                                <td><?=$total+=$row->amt_spent_in_year?></td>
                                                <td><?=($row->is_direct_implementation == 1)? 'Implementing agency':'Direct' ?></td>
                                                <td><?=(isset($entity->csr_registration->document_number))?$entity->csr_registration->document_number:''?></td>
                                                <td><?=$entity->entity_name?></td>
                                             </tr>
                                             <?php }}else{
                                                foreach($director_report_project_ongoing as $key => $row){if($row->project_type == 'Ongoing'){ ?>
                                             <tr>
                                                <td><?=$key+1?></td>
                                                <td></td>
                                                <td><?=$row->sector?></td>
                                                <td><?=$row->project_activity_name?></td>
                                                <td><?=($row->is_project_location_local == 1)? 'Yes':'No' ?></td>
                                                <td><?php $location = explode(',',$row->project_location_state); echo (count($location)>1)? $location[1]:$location[0];?></td>
                                                <td><?php echo (count($location)>1)? $location[0]:'-';?></td>
                                                <td>
                                                   <input type="number" class="form-control"  name="financial_duration_ongoing" required/>
                                                </td>
                                                <td><?=$total+=$row->direct_expenditure?></td>
                                                <td><?=($row->is_direct_implementation_dir_report == 1)? 'Implementing agency':'Direct' ?></td>
                                                <td><?=(isset($entity->csr_registration->document_number))?$entity->csr_registration->document_number:''?></td>
                                                <td><?=$entity->entity_name?></td>
                                             </tr>
                                             <?php }}
                                                } ?>
                                             <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total</td>
                                                <td><?=$total?></td>
                                                <td></td>
                                                <td></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <?php }if(count($director_report_project_other)>0 || (isset($previous_other) && count($previous_other)>0)){ ?>
                                 <div class="row">
                                    <div class="form-group col-sm ctcsr" style="display: table;">
                                       <label class="control-label-closing">(ii) Details of CSR amount spent against Other than ongoing projects for the financial year:</label></br>
                                       <label class="control-label-closing">Number of  Other than Ongoing Projects for the financial year: <?=count($director_report_project_other)?></label>
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
                                                   CSR Registr ation No. (Agency)
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
                                             <?php $total =0;
                                                if((isset($previous_other) && count($previous_other)>0)){
                                                   foreach($previous_other as $key => $row){ ?>
                                             <tr>
                                                <td><?=$key+1?></td>
                                                <td><?=$row->sector?></td>
                                                <td><?=$row->project_name?></td>
                                                <td><?=($row->local_area == 1)? 'Yes':'No' ?></td>
                                                <td><?=$row->location_state;?></td>
                                                <td><?=$row->location_district;?></td>
                                                <td>
                                                   <input type="number" class="form-control" value="<?=$row->project_duration;?>"  name="financial_duration_other" required/>
                                                </td>
                                                <td><?=$total+=$row->amt_spent_in_year?></td>
                                                <td><?=($row->is_direct_implementation == 1)? 'Implementing agency':'Direct' ?></td>
                                                <td><?=(isset($entity->csr_registration->document_number))?$entity->csr_registration->document_number:''?></td>
                                                <td><?=$entity->entity_name?></td>
                                             </tr>
                                             <?php }}else{ foreach($director_report_project_other as $key => $row){if($row->project_type == 'Other than Ongoing'){ ?>
                                             <tr>
                                                <td><?=$key+1?></td>
                                                <td><?=$row->sector?></td>
                                                <td><?=$row->project_activity_name?></td>
                                                <td><?=($row->is_project_location_local == 1)? 'Yes':'No' ?></td>
                                                <td><?php $location = explode(',',$row->project_location_state); echo (count($location)>1)? $location[1]:$location[0];?></td>
                                                <td><?php echo (count($location)>1)? $location[0]:'-';?></td>
                                                <td>
                                                   <input type="number" class="form-control"  name="financial_duration_other" required/>
                                                </td>
                                                <td><?=$total+=$row->direct_expenditure?></td>
                                                <td><?=($row->is_direct_implementation_dir_report == 1)? 'Implementing agency':'Direct' ?></td>
                                                <td><?=(isset($entity->csr_registration->document_number))?$entity->csr_registration->document_number:''?></td>
                                                <td><?=$entity->entity_name?></td>
                                             </tr>
                                             <?php }}
                                                } ?>
                                             <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total</td>
                                                <td><?=$total?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-5">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (c)  Amount spent in Administrative Overheads *:</label>
                                    <input class="form-control" type="number" name="overhead" value="<?=$obligation->contributor_csr_admin_overheads?>" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (d)  Amount spent on Impact Assessment, if applicable * :</label>
                                    <input class="form-control" type="number" name="assessment" value="<?=$obligation->contributor_impact_assess_expense_amt?>" required>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-5">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (e)   Total amount spent for the Financial Year *:</label>
                                    <input class="form-control" type="number" name="amount_spent" value="<?=$obligation->total_amt_spent_for_FY?>" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (f) Amount unspent/ (excess) spent for the Financial Year [6(d) 7(e)] unspent for Ongoing projects *:</label>
                                    <input class="form-control" type="number" name="amount_unspent" value="<?=$obligation->amt_unspent_excess_for_FY?>" required>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-5">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (g)  Amount eligible fog transfer to Unspent CSR Account for the Financial Year as per Section 135(6) (before adjustments) *:</label>
                                    <input class="form-control" type="number" readonly  value="<?=$obligation->amt_transfer_eligible_unspent_CSR_acc?>">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="contributor_details">
                                    <label class="control-label-closing">7. (h)  Amount to be transferred to Fund specified in Schedule VII fog the Financial Year (if total unspent for the Financial Year is greater than unspent for Ongoing pgojects) *:</label>
                                    <input class="form-control" type="number" readonly  value="<?=$obligation->amt_transfer_fund_specificed_sch7?>">
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
                        <label class="control-label" style="color:#000; margin-bottom:20px;">8. Details of transfer of Unspent CSR amount for the financial year:</label>
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
                                    <td><input type="number" class="form-control" name="csr_amt" value="<?=$obligation->amt_transfer_eligible_unspent_CSR_acc?>" required></td>
                                    <td><input type="number" class="form-control" name="csr_actual" value="<?=$obligation->amt_actual_transfer_unspent_CSR_acc?>" required></td>
                                    <td><input type="date" class="form-control" name="csr_date" value="<?=$obligation->date_of_trasnfer_csr_unspent_acc?>" required></td>
                                    <td><input type="number" class="form-control" name="csr_deficiency" value="<?=$obligation->deficiency_unspent_csr?>" required></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="uspent_csr">
                           <p><label>(b) Transfer to Fund specified in Schedule VII as per second proviso to Section 135(5) for the Financial Year:</label></p>
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
                                    <td><input type="number" class="form-control" name="schedule_amt" value="<?=$obligation->amt_transfer_fund_specificed_sch7?>" required></td>
                                    <td><input type="number" class="form-control" name="schedule_actual" value="<?=$obligation->amt_actual_transfer_fund_specificed_sch7?>" required></td>
                                    <td><input type="date" class="form-control" name="schedule_date" value="<?=$obligation->date_of_trasnfer_fund_specificed_sch7?>" required></td>
                                    <td><input type="number" class="form-control" name="schedule_deficiency" value="<?=$obligation->deficiency_fund_specificed_sch7?>" required></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-10">
                     <div class="row">
                        <div class="uspent_csr">
                           <p><label>9. Specify the reason(s) if the company has failed to spend two per cent of the average net profit as per section 135(5): *</label></p>
                           <span><?=isset($report->reason_failed_to_csr_spend_director_report)?$report->reason_failed_to_csr_spend_director_report:''?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="unspent_amount">
                  <div class="col-lg-12 amount_spent">
                     <div class="row">
                        <div class="col-md-11">
                           <div class="contributor_details">
                              <label class="control-label-closing">Whether any unspent amount of preceding three financial years (financial year ending after 22 January 2021) has been spent in the financial year *:</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1)? 'checked' : '' ?> value="1" disabled>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" type="radio" <?=($obligation->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 2)? 'checked' : '' ?> value="2" disabled>
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php if($obligation->is_unspent_for_preceeding_3_years_after_22_Jan_21 == 1){ ?>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="control-label-closing">10. (a) Details of CSR amount spent in the financial year pertaining to three preceding financial year(s):</label>
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
                                    <th>FY-1 (YE <?=$preceding_one_year->FY_year?>)</th>
                                    <td><?=$preceding_one_year->amt_transferred_to_CSR_account?></td>
                                    <td><?=$preceding_one_year->balance_amt_in_CSR_account?></td>
                                    <td><?=$preceding_one_year->amt_spent_in_FY?></td>
                                    <td><?=$preceding_one_year->amt_transferred_to_fund_account?></td>
                                    <td><?=date('d-m-Y',strtotime($preceding_one_year->date_of_transferred_to_fund_account))?></td>
                                    <td><?=$preceding_one_year->amt_remaining_to_spent?></td>
                                    <td><?=$preceding_one_year->deficiency?></td>
                                 </tr>
                                 <tr>
                                    <th>FY-2 (YE <?=$preceding_two_year->FY_year?>)</th>
                                    <td><?=$preceding_two_year->amt_transferred_to_CSR_account?></td>
                                    <td><?=$preceding_two_year->balance_amt_in_CSR_account?></td>
                                    <td><?=$preceding_two_year->amt_spent_in_FY?></td>
                                    <td><?=$preceding_two_year->amt_transferred_to_fund_account?></td>
                                    <td><?=date('d-m-Y',strtotime($preceding_two_year->date_of_transferred_to_fund_account))?></td>
                                    <td><?=$preceding_two_year->amt_remaining_to_spent?></td>
                                    <td><?=$preceding_two_year->deficiency?></td>
                                 </tr>
                                 <tr>
                                    <th>FY-3 (YE <?=$preceding_three_year->FY_year?>)</th>
                                    <td><?=$preceding_three_year->amt_transferred_to_CSR_account?></td>
                                    <td><?=$preceding_three_year->balance_amt_in_CSR_account?></td>
                                    <td><?=$preceding_three_year->amt_spent_in_FY?></td>
                                    <td><?=$preceding_three_year->amt_transferred_to_fund_account?></td>
                                    <td><?=date('d-m-Y',strtotime($preceding_three_year->date_of_transferred_to_fund_account))?></td>
                                    <td><?=$preceding_three_year->amt_remaining_to_spent?></td>
                                    <td><?=$preceding_three_year->deficiency?></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <?php } ?>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="control-label-closing">10. (b) Details of CSR amount spent in the financial year for ongoing projects of the preceding financial year(s):</label>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                              <p class="control-label" style="margin-bottom:0px">Number of Ongoing Projects <span style="margin-left:10px;"><?=count($ongoing_projects_preceeding_year)?></span></p>
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
                                    <?php foreach($ongoing_projects_preceeding_year as $key => $row){ ?>
                                    <tr>
                                       <th><?=$key+1?></th>
                                       <td><?=$row->project_id?></td>
                                       <td><?=$row->project_name?></td>
                                       <td><?=$row->FY_year_project_commenced?></td>
                                       <td><?=$row->amt_spent_start_of_year?></td>
                                       <td><?=$row->amt_spent_in_year?></td>
                                       <td><?=$row->commutative_amt_spent?></td>
                                       <td><?=$row->project_status?></td>
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
                              <label class="control-label-closing">10. (c) (i) Whether any new CSR project has been undertaken in the financial year from the Unspent amount pertaining to preceding three financial years :</label>
                              <div class="yn">
                                 <input class="form-check-input check_is_committee_constituted" name="new_csr_project" <?=($obligation->is_new_csr_project == 1)? 'checked':''?> type="radio" name="" value="1" required>
                                 <label>Yes</label>
                                 <input class="form-check-input check_is_committee_constituted" name="new_csr_project" <?=($obligation->is_new_csr_project == 2)? 'checked':''?> type="radio" name="" value="2" required>
                                 <label>No</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="new_csr_project_nature" style="<?=($obligation->is_new_csr_project != 1)? 'display:none':''?>">
                        <div class="row">
                           <div class="col-md-11">
                              <div class="contributor_details">
                                 <label class="control-label-closing">10. (c) (ii) If yes, nature of the new CSR Project(s) is/are:</label>
                                 <div class="yn">
                                    <input class="form-check-input check_is_committee_constituted" type="radio" name="new_csr_project_nature" <?=($obligation->new_csr_project_nature == 1)? 'checked':''?> value="1">
                                    <label>Ongoing projects</label>
                                    <input class="form-check-input check_is_committee_constituted" type="radio" name="new_csr_project_nature" <?=($obligation->new_csr_project_nature == 2)? 'checked':''?> value="2">
                                    <label>Other than Ongoing projects</label>
                                    <input class="form-check-input check_is_committee_constituted" type="radio" name="new_csr_project_nature" <?=($obligation->new_csr_project_nature == 3)? 'checked':''?> value="3">
                                    <label>Both (Ongoing and other than ongoing projects)</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row new_csr_project_ongoing" style="<?=(!$obligation->new_csr_project_nature == 1 || !$obligation->new_csr_project_nature == 3)? 'display:none':''?>">
                           <div class="col-md-11">
                              <div class="contributor_details">
                                 <label class="control-label-closing">10. (c) (iii) Details of amount spent against new ongoing CSR project in the financial year:</label>
                              </div>
                           </div>
                        </div>
                        <div class="new_csr_project_ongoing" style="<?=(!$obligation->new_csr_project_nature == 1 || !$obligation->new_csr_project_nature == 3)? 'display:none':''?>">
                           <div class="col-lg-12">
                              <div class="row">
                                 <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                                    <p class="control-label" style="margin-bottom:0px">Number of Other than Ongoing Projects: <span class="box-ongoing-event-count" style="margin-left:10px;"><?=(isset($new_ongoing))? count($new_ongoing):1?></span></p>
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
                                             <th scope="col" colspan="6">
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
                                       <tbody class="box-ongoing">
                                          <?php if(isset($new_ongoing)){  foreach($new_ongoing as $key => $row){  ?>
                                          <tr>
                                             <td>1</td>
                                             <td>
                                                <input type="text" name="project_id[]" value="<?=$row->project_id?>" class="form-control" required/>
                                                <input type="hidden" name="type[]" class="form-control" value="1" required/>
                                             </td>
                                             <td><input type="date" name="pertains[]" value="<?=$row->FY_year_project_commenced?>" class="form-control" required/></td>
                                             <td>
                                                <select name="sector[]" class="form-control" required>
                                                   <option value="">Select Sector</option>
                                                   <?php foreach($sectors as $sec){ ?>
                                                   <option <?=($row->sector==$sec->sector_type)? 'selected':''?> data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="text" name="prject_name[]" value="<?=$row->project_name?>"  class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                             <td>
                                                <select name="area[]" class="form-control" required>
                                                   <option value="">Select</option>
                                                   <option <?=($row->local_area==1)? 'selected':''?> value="1">Yes</option>
                                                   <option <?=($row->local_area==2)? 'selected':''?>  value="2">No</option>
                                                </select>
                                             </td>
                                             <td colspan="2">
                                                <select name="location[]" class="form-control location-select-2" required>
                                                   <option value="">Select Location</option>
                                                   <?php foreach($district as $dst){ ?>
                                                   <option <?=(($row->location_district.','.$row->location_state)==($dst->dst_name.','.$dst->st_name))? 'selected':''?>  value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="number"  value="<?=$row->project_duration?>"  name="duration[]" class="form-control" required/></td>
                                             <td><input type="number"  value="<?=$row->amt_spent_in_year?>"  name="amount[]" class="form-control" required/></td>
                                             <td>
                                                <select name="implementation[]" class="form-control" required>
                                                   <option value="">Select</option>
                                                   <option <?=($row->is_direct_implementation==1)? 'selected':''?> value='1'>Implementing agency</option>
                                                   <option <?=($row->is_direct_implementation==2)? 'selected':''?> value='2'>Direct</option>
                                                </select>
                                             </td>
                                             <td><input type="text" name="registration[]"  value="<?=$row->CSR_reg_no?>"  class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                             <td><input type="text" name="agency[]"  value="<?=$row->implementer_name?>"  class="form-control" required/></td>
                                             <td class="table-delete-icon"></td>
                                          </tr>
                                          <?php }}else{ ?>
                                          <tr>
                                             <td>1</td>
                                             <td>
                                                <input type="text" name="project_id[]" class="form-control"/>
                                                <input type="hidden" name="type[]" class="form-control" value="1" required/>
                                             </td>
                                             <td><input type="date" name="pertains[]" class="form-control"/></td>
                                             <td>
                                                <select name="sector[]" class="form-control">
                                                   <option value="">Select Sector</option>
                                                   <?php foreach($sectors as $sec){ ?>
                                                   <option data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="text" name="prject_name[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/></td>
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
                                                   <?php foreach($district as $dst){ ?>
                                                   <option value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="number" name="duration[]" class="form-control"/></td>
                                             <td><input type="number" name="amount[]" class="form-control"/></td>
                                             <td>
                                                <select name="implementation[]" class="form-control">
                                                   <option value="">Select</option>
                                                   <option value='1'>Implementing agency</option>
                                                   <option value='2'>Direct</option>
                                                </select>
                                             </td>
                                             <td><input type="text" name="registration[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/></td>
                                             <td><input type="text" name="agency[]" class="form-control"/></td>
                                             <td class="table-delete-icon"></td>
                                          </tr>
                                          <?php } ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row new_csr_project_other" style="<?=(!$obligation->new_csr_project_nature == 2 || !$obligation->new_csr_project_nature == 3)? 'display:none':''?>">
                           <div class="col-md-11">
                              <div class="contributor_details">
                                 <label class="control-label-closing">10. (c) (iv) Details of amount spent against new otheg than ongoing CSR project in the financial year:</label>
                              </div>
                           </div>
                        </div>
                        <div class="new_csr_project_other" style="<?=(!$obligation->new_csr_project_nature == 2 || !$obligation->new_csr_project_nature == 3)? 'display:none':''?>">
                           <div class="col-lg-12">
                              <div class="row">
                                 <label class="control-label" style="font-weight:400;font-size:16px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details of amount spent against new other than ongoing projects in the financial year:</label>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="row">
                                 <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                                    <p class="control-label" style="margin-bottom:0px">Number of Other than Ongoing Projects: <span class="box-other-ongoing-event-count" style="margin-left:10px;"><?=(isset($new_other))? count($new_other):1?></span></p>
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
                                          <?php if(isset($new_other)){  foreach($new_other as $key => $row){  ?>
                                          <tr>
                                             <td><?=$key+1?></td>
                                             <td>
                                                <input type="hidden" name="project_id[]" class="form-control"/>
                                                <input type="hidden" name="type[]" class="form-control" value="2" required/>
                                                <input type="date" name="pertains[]" value="<?=$row->FY_year_project_commenced?>" class="form-control" required/>
                                             </td>
                                             <td>
                                                <select name="sector[]" class="form-control" required>
                                                   <option value="">Select Sector</option>
                                                   <?php foreach($sectors as $sec){ ?>
                                                   <option <?=($row->sector==$sec->sector_type)? 'selected':''?> data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="text" name="prject_name[]"  value="<?=$row->project_name?>"  class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                             <td>
                                                <select name="area[]" class="form-control" required>
                                                   <option value="">Select</option>
                                                   <option <?=($row->local_area==1)? 'selected':''?> value="1">Yes</option>
                                                   <option <?=($row->local_area==2)? 'selected':''?> value="2">No</option>
                                                </select>
                                             </td>
                                             <td colspan="2">
                                                <select name="location[]" class="form-control location-select-2" required>
                                                   <option value="">Select Location</option>
                                                   <?php foreach($district as $dst){ ?>
                                                   <option <?=(($row->location_district.','.$row->location_state)==($dst->dst_name.','.$dst->st_name))? 'selected':''?> value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="number" name="duration[]" value="<?=$row->project_duration?>"  class="form-control" required/></td>
                                             <td><input type="number" name="amount[]" value="<?=$row->amt_spent_in_year?>" class="form-control" required/></td>
                                             <td>
                                                <select name="implementation[]" class="form-control" required>
                                                   <option value="">Select</option>
                                                   <option <?=($row->is_direct_implementation==1)? 'selected':''?> value='1'>Implementing agency</option>
                                                   <option <?=($row->is_direct_implementation==2)? 'selected':''?> value='2'>Direct</option>
                                                </select>
                                             </td>
                                             <td><input type="text" name="registration[]" value="<?=$row->CSR_reg_no?>"  class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                             <td><input type="text" name="agency[]" value="<?=$row->implementer_name?>"  class="form-control" required/></td>
                                             <td class="table-delete-icon"></td>
                                          </tr>
                                          <?php }}else{ ?>
                                          <tr>
                                             <td>1</td>
                                             <td>
                                                <input type="hidden" name="project_id[]" class="form-control"/>
                                                <input type="hidden" name="type[]" class="form-control" value="2" required/>
                                                <input type="date" name="pertains[]" class="form-control"/>
                                             </td>
                                             <td>
                                                <select name="sector[]" class="form-control">
                                                   <option value="">Select Sector</option>
                                                   <?php foreach($sectors as $sec){ ?>
                                                   <option data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="text" name="prject_name[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/></td>
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
                                                   <?php foreach($district as $dst){ ?>
                                                   <option value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
                                                   <?php } ?>
                                                </select>
                                             </td>
                                             <td><input type="number" name="duration[]" class="form-control"/></td>
                                             <td><input type="number" name="amount[]" class="form-control"/></td>
                                             <td>
                                                <select name="implementation[]" class="form-control">
                                                   <option value="">Select</option>
                                                   <option value='1'>Implementing agency</option>
                                                   <option value='2'>Direct</option>
                                                </select>
                                             </td>
                                             <td><input type="text" name="registration[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/></td>
                                             <td><input type="text" name="agency[]" class="form-control"/></td>
                                             <td class="table-delete-icon"></td>
                                          </tr>
                                          <?php } ?>
                                       </tbody>
                                    </table>
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
                        <label class="control-label-closing">11 Whether any unspent amount pertaining to FY 2014-15 to FY 2019-20 has been spent in the financial year:</label>
                        <div class="yn">
                           <input class="form-check-input check_is_committee_constituted" <?=($obligation->is_unspent_for_pretaining_2014_15_to_2019_20 == 1)? 'checked':''?> type="radio" name="is_unspent_for_pretaining_2014_15_to_2019_20" value="1" required>
                           <label>Yes</label>
                           <input class="form-check-input check_is_committee_constituted" <?=($obligation->is_unspent_for_pretaining_2014_15_to_2019_20 == 2)? 'checked':''?> type="radio" name="is_unspent_for_pretaining_2014_15_to_2019_20" value="2" required>
                           <label>No</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 target-pretaining-box" style="<?=($obligation->is_unspent_for_pretaining_2014_15_to_2019_20==1)?'display:block':'display:none'?>">
                  <div class="row">
                     <div>
                        <div class="col-lg-12">
                           <div class="row">
                              <label class="control-label" style="font-weight:400;font-size:16px;color:#000;margin-bottom:0px;display:block;width: 100%;">Details of amount spent against CSR projects in the financial year:</label>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="row">
                              <div class="form-group col-sm ctcsr" style="display: table;margin-top:20px">
                                 <p class="control-label" style="margin-bottom:0px">Number of CSR Projects: <span class="box-csr-event-count" style="margin-left:10px;"><?=(isset($csr_project))? count($csr_project):1?></span></p>
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
                                    <tbody class="box-csr">
                                       <?php if(isset($csr_project)){  foreach($csr_project as $key => $row){  ?>
                                       <tr>
                                          <td><?=$key+1?></td>
                                          <td>
                                             <input type="hidden" name="project_id[]" class="form-control"/>
                                             <input type="hidden" name="type[]" class="form-control" value="3" required/>
                                             <input type="date" name="pertains[]"  value="<?=$row->FY_year_project_commenced?>" class="form-control" required/>
                                          </td>
                                          <td>
                                             <select name="sector[]" class="form-control" required>
                                                <option value="">Select Sector</option>
                                                <?php foreach($sectors as $sec){ ?>
                                                <option <?=($row->sector==$sec->sector_type)? 'selected':''?> data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                          <td><input type="text" name="prject_name[]" class="form-control" value="<?=$row->project_name?>" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                          <td>
                                             <select name="area[]" class="form-control" required>
                                                <option value="">Select</option>
                                                <option <?=($row->local_area==1)? 'selected':''?> value="1">Yes</option>
                                                <option <?=($row->local_area==2)? 'selected':''?> value="2">No</option>
                                             </select>
                                          </td>
                                          <td colspan="2">
                                             <select name="location[]" class="form-control location-select-2" required>
                                                <option value="">Select Location</option>
                                                <?php foreach($district as $dst){ ?>
                                                <option <?=(($row->location_district.','.$row->location_state)==($dst->dst_name.','.$dst->st_name))? 'selected':''?> value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                          <td><input type="number" name="duration[]" class="form-control" value="<?=$row->project_duration?>" required/></td>
                                          <td><input type="number" name="amount[]" class="form-control" value="<?=$row->amt_spent_in_year?>"  required/></td>
                                          <td>
                                             <select name="implementation[]" class="form-control" required>
                                                <option value="">Select</option>
                                                <option  <?=($row->is_direct_implementation==1)? 'selected':''?>  value='1'>Implementing agency</option>
                                                <option  <?=($row->is_direct_implementation==2)? 'selected':''?>  value='2'>Direct</option>
                                             </select>
                                          </td>
                                          <td><input type="text" name="registration[]" value="<?=$row->CSR_reg_no?>" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                          <td><input type="text" name="agency[]" value="<?=$row->implementer_name?>" class="form-control" required/></td>
                                          <td class="table-delete-icon"></td>
                                       </tr>
                                       <?php  }}else{ ?>
                                       <tr>
                                          <td>1</td>
                                          <td>
                                             <input type="hidden" name="project_id[]" class="form-control"/>
                                             <input type="hidden" name="type[]" class="form-control" value="3"/>
                                             <input type="date" name="pertains[]" class="form-control"/>
                                          </td>
                                          <td>
                                             <select name="sector[]" class="form-control">
                                                <option value="">Select Sector</option>
                                                <?php foreach($sectors as $sec){ ?>
                                                <option data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                          <td><input type="text" name="prject_name[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/></td>
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
                                                <?php foreach($district as $dst){ ?>
                                                <option value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                          <td><input type="number" name="duration[]" class="form-control"/></td>
                                          <td><input type="number" name="amount[]" class="form-control"/></td>
                                          <td>
                                             <select name="implementation[]" class="form-control">
                                                <option value="">Select</option>
                                                <option value='1'>Implementing agency</option>
                                                <option value='2'>Direct</option>
                                             </select>
                                          </td>
                                          <td><input type="text" name="registration[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/></td>
                                          <td><input type="text" name="agency[]" class="form-control"/></td>
                                          <td class="table-delete-icon"></td>
                                       </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
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
                        <label class="control-label-closing">12. Whether any Capital assets have been created or acquired through CSR spent in the financial year *:</label>
                        <div class="yn">
                           <input class="form-check-input check_is_committee_constituted" <?=($obligation->is_capital_assest_created == 1)? 'checked':''?> type="radio" name="is_capital_assest_created" <?=($obligation->is_capital_assest_created==1)?'checked':''?> value="1" required>
                           <label>Yes</label>
                           <input class="form-check-input check_is_committee_constituted" <?=($obligation->is_capital_assest_created == 2)? 'checked':''?> type="radio" name="is_capital_assest_created" <?=($obligation->is_capital_assest_created==2)?'checked':''?> value="2" required>
                           <label>No</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 target-asset-box" style="<?=($obligation->is_capital_assest_created==1)?'display:block':'display:none'?>">
                     <div class="contributor_details">
                        <label class="control-label-closing">If Yes, enter the number of Capital assets created/acquired :</label>
                        <div class="yn">
                           <input class="form-control" readonly type="text" name="number_of_capital_assets">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 target-asset-box"  style="<?=($obligation->is_capital_assest_created==1)?'display:block':'display:none'?>">
                  <div class="row">
                     <div>
                        <div class="col-lg-12">
                           <div class="row">
                              <label class="control-label" style="font-weight:400;font-size:16px;color:#000;margin-bottom:0px;display:block;width: 100%;">Furnish the details relating to such asset(s) so created or acquired through CSR spent in the financial year:</label>
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
                                             Short particulars of property or asset(s) [Including complete address and location of the property]
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
                                       <?php if(isset($csr_asset)){  foreach($csr_asset as $key => $row){ ?>
                                       <tr>
                                          <td><?=$key+1?></td>
                                          <td>
                                             <input type="text" name="particulars[]" class="form-control" value="<?=$row->asset_details?>" required/>
                                          </td>
                                          <td>
                                             <input type="number" name="pin[]" class="form-control"  value="<?=$row->pincode?>" required/>
                                          </td>
                                          <td>
                                             <input type="date" name="creation[]" class="form-control"  value="<?=$row->date_of_creation?>" required/>
                                          </td>
                                          <td>
                                             <input type="number" name="csr_amount[]" class="form-control"  value="<?=$row->Expense_budget?>" required/>
                                          </td>
                                          <td>
                                             <input type="text" name="owner_registration[]" class="form-control"  value="<?=$row->CSR_reg_no?>" required/>
                                          </td>
                                          <td><input type="text" name="owner_name[]" class="form-control"  value="<?=$row->implrmenter_name?>" required/></td>
                                          <td><input type="text" name="owner_address[]" class="form-control"  value="<?=$row->implementer_registred_address?>" required/></td>
                                          <td class="table-delete-icon"></td>
                                       </tr>
                                       <?php } }else{ ?>
                                       <tr>
                                          <td>01</td>
                                          <td>
                                             <input type="text" name="particulars[]" class="form-control"/>
                                          </td>
                                          <td>
                                             <input type="number" name="pin[]" class="form-control"/>
                                          </td>
                                          <td>
                                             <input type="date" name="creation[]" class="form-control"/>
                                          </td>
                                          <td>
                                             <input type="number" name="csr_amount[]" class="form-control"/>
                                          </td>
                                          <td>
                                             <input type="text" name="owner_registration[]" class="form-control"/>
                                          </td>
                                          <td><input type="text" name="owner_name[]" class="form-control"/></td>
                                          <td><input type="text" name="owner_address[]" class="form-control"/></td>
                                          <td class="table-delete-icon"></td>
                                       </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <div class="save_btns">
      <div class="col-sm-12">
         <div class="wrap_flex_btn">
            <div class="form-group">
               <a href="<?php echo base_url(); ?>/CsrCompliance/dashboard" class="cancelBtn">Cancel</a>
            </div>
            <div class="form-group">
               <a target="_blank" href="<?=base_url()?>CsrCompliance/previewCSRReport?year=<?=$_GET['year']?>&action=pdf" class="draftbtn">Download Pdf</a>
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
   $(".draftbtn").click(function(){
   $('.report_status').val(2);
   setTimeout(() => {
   $('.submitform').click();
   }, 1500);
   });
   $(".saveBtn").click(function(){
   $('.report_status').val(3);
   setTimeout(() => {
   $('.submitform').click();
   }, 1500);
   });
   $(".box-ongoing-event").click(function () {
     $(".location-select-2").select2('destroy');
     var count = Number($(".box-ongoing tr").length);
     $('.box-ongoing-event-count').text(count+1);
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
                                          <?php foreach($sectors as $sec){ ?>
                                             <option data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
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
                                          <?php foreach($district as $dst){ ?>
                                             <option value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
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
                                    <td><input type="text" name="registration[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                    <td><input type="text" name="agency[]" class="form-control" required/></td>
                                    <td class="table-delete-icon">
                                       <a href="javascript:void(0)" class="event-delete-row-project-ongoing">  
                                          <img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
     $(".box-ongoing").append(html);
     $(".location-select-2").select2();
   });
   $(document).on('click','.event-delete-row-project-ongoing',function () {
      $(this).closest('tr').remove();
      var count = Number($(".box-ongoing tr").length);
      $('.box-ongoing-event-count').text(count);
   });
   $(".location-select-2").select2();
   
   $(".box-other-ongoing-event").click(function () {
     $(".location-select-2").select2('destroy');
     var count = Number($(".box-other-ongoing tr").length);
     $('.box-other-ongoing-event-count').text(count+1);
     var html = `<tr>
                                    <td>${count + 1}</td>
                                    <td>
                                       <input type="hidden" name="project_id[]" class="form-control"/>
                                       <input type="hidden" name="type[]" class="form-control" value="2" required/>
                                       <input type="date" name="pertains[]" class="form-control" required/></td>
                                    <td>
                                       <select name="sector[]" class="form-control" required>
                                          <option value="">Select Sector</option>
                                          <?php foreach($sectors as $sec){ ?>
                                             <option data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
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
                                          <?php foreach($district as $dst){ ?>
                                             <option value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
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
                                    <td><input type="text" name="registration[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                    <td><input type="text" name="agency[]" class="form-control" required/></td>
                                    <td class="table-delete-icon">
                                       <a href="javascript:void(0)" class="event-delete-row-project-other">  
                                          <img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
     $(".box-other-ongoing").append(html);
     $(".location-select-2").select2();
   });
   $(document).on('click','.event-delete-row-project-other',function () {
      $(this).closest('tr').remove();
      var count = Number($(".box-other-ongoing tr").length);
      $('.box-other-ongoing-event-count').text(count);
   });
   $(".box-csr-event").click(function () {
     $(".location-select-2").select2('destroy');
     var count = Number($(".box-csr tr").length);
     $('.box-csr-event-count').text(count+1);
     var html = `<tr>
                                    <td>${count + 1}</td>
                                    <td>
                                       <input type="hidden" name="project_id[]" class="form-control"/>
                                       <input type="hidden" name="type[]" class="form-control" value="3" required/>
                                       <input type="date" name="pertains[]" class="form-control" required/></td>
                                    <td>
                                       <select name="sector[]" class="form-control" required>
                                          <option value="">Select Sector</option>
                                          <?php foreach($sectors as $sec){ ?>
                                             <option data-sdgs='<?=$sec->sdgs_id?>' value="<?=$sec->sector_type?>"><?=$sec->sector_type?></option>
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
                                          <?php foreach($district as $dst){ ?>
                                             <option value="<?=$dst->dst_name.','.$dst->st_name?>"><?=$dst->dst_name.','.$dst->st_name?></option>
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
                                    <td><input type="text" name="registration[]" class="form-control" onpaste="return false;" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required/></td>
                                    <td><input type="text" name="agency[]" class="form-control" required/></td>
                                    <td class="table-delete-icon">
                                       <a href="javascript:void(0)" class="event-delete-row-project-csr">  
                                          <img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
     $(".box-csr").append(html);
     $(".location-select-2").select2();
   });
   $(document).on('click','.event-delete-row-project-csr',function () {
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
                                       <input type="number" name="pin[]" class="form-control" required/>
                                    </td>
                                    <td>
                                       <input type="date" name="creation[]" class="form-control" required/>
                                    </td>
                                    <td>
                                       <input type="number" name="csr_amount[]" class="form-control" required/>
                                    </td>
                                    <td>
                                       <input type="text" name="owner_registration[]" class="form-control" required/>
                                    </td>
                                    <td><input type="text" name="owner_name[]" class="form-control" required/></td>
                                    <td><input type="text" name="owner_address[]" class="form-control" required/></td>
                                    <td  class="table-delete-icon">
                                       <a href='javascript:void(0)' class="event-delete-row-asset">  
                                          <img src="`+SKIN_URL+`images/deleteIconsline.svg" alt=""/>
                                       </a>
                                    </td>
                                 </tr>`;
     $(".box-asset").append(html);
     numberOfAsset();
   });
   $(document).on('click','[name="is_capital_assest_created"]',function(){
     var check = $('input[name="is_capital_assest_created"]:checked').val();
     if (check == 1) {
         $('.target-asset-box').find("input").prop('required',true);
         $('.target-asset-box').css('display', 'block');
     } else {
         $('.target-asset-box').find("input").prop('required',false);
         $('.target-asset-box').css('display', 'none');
     }
   });
   $(document).on('click','[name="is_unspent_for_pretaining_2014_15_to_2019_20"]',function(){
     var check = $('input[name="is_unspent_for_pretaining_2014_15_to_2019_20"]:checked').val();
     if (check == 1) {
         $('.target-pretaining-box').find("input,select").prop('required',true);
         $('.target-pretaining-box').css('display', 'block');
     } else {
      $('.target-pretaining-box').find("input,select").prop('required',false);
         $('.target-pretaining-box').css('display', 'none');
     }
   });
   $(document).on('click','[name="new_csr_project"]',function(){
     var check = $('input[name="new_csr_project"]:checked').val();
     if (check == 1) {
         $('.new_csr_project_nature').find("input,select").prop('required',true);
         $('.new_csr_project_nature').css('display', 'block');
     } else {
         $('.new_csr_project_nature').find("input,select").prop('required',false);
         $('.new_csr_project_nature').css('display', 'none');
     }
   });
   $(document).on('click','[name="new_csr_project_nature"]',function(){
     var check = $('input[name="new_csr_project_nature"]:checked').val();
     if (check == 1) {
         $('.new_csr_project_ongoing').css('display', 'block');
         $('.new_csr_project_other').css('display', 'none');
         $('.new_csr_project_other').find("input,select").prop('required',false);
     }else if (check == 2) {
         $('.new_csr_project_other').css('display', 'block');
         $('.new_csr_project_ongoing').css('display', 'none');
         $('.new_csr_project_ongoing').find("input,select").prop('required',false);
     } else {
      $('.new_csr_project_ongoing').css('display', 'block');
      $('.new_csr_project_other').css('display', 'block');
     }
   });
   $(document).on('change','[name="meeting"]',function(){
   $('[name="attend[]"]').val($(this).val());
   });
   function numberOfAsset(){
   $('[name="number_of_capital_assets"]').val(Number($('[name="particulars[]"]').length));
   }
   $('.box-asset').on('click','.event-delete-row-asset',function(){
   $(this).closest('tr').remove();
   numberOfAsset();
   });
   numberOfAsset();
</script>