<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/report-csr-pdf-style.css" />
      <title>Financial Year Closing Report</title>
      <style>
         table td{
            border:1px solid black;
         }
         .float-left{
            float:left;
         }
         .width-50{
            width:50%;
         }
      </style>
   </head>
   <body>
      <div id="main-div-par">
      <h3 class="report-start-title">Annual Report on CSR Activities (For Purpose Of Director’s Report)</h3>
      <div class="container">
      <div class="sec-one-par">
         <div class="row">
            <div class="col-lg-12">
               <div class="row">
                        <div class="width-50 float-left">
                           <label class="control-label-closing">1. (a) CIN *:</label>
                           <p><?=(isset($entity->cin->document_number))?$entity->cin->document_number:''?></p>
                        </div>
                        <div class="width-50 float-left">
                           <label class="control-label-closing">1. (b) Name of the company*:</label>
                           <p><?=$entity->entity_name?></p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="width-50 float-left">
                           <label class="control-label-closing">1. (c) Company Addgess *:</label>
                           <p><?=$entity->entity_address?></p>
                        </div>
                        <div class="width-50 float-left">
                           <label class="control-label-closing">1. (d)  Email *:</label>
                           <p><?=$entity->alternate_email_id?></p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="width-50 float-left">
                           <div class="contributor_details">
                              <label class="control-label-closing">2. (a) FY to which the CSR details pertain *:</label>
                              <ul class="pegtain">
                                 <li><label class="control-label">From : </label><?=(isset($csr2) && isset($csr2->csr_details_pegtain_from))? date('Y-m-d',$csr2->csr_details_pegtain_from):''?></li>
                                 <li><label class="control-label">To : </label><?=(isset($csr2) && isset($csr2->csr_details_pegtain_to))? date('Y-m-d',$csr2->csr_details_pegtain_to):''?></li>
                              </ul>
                           </div>
                        </div>
                        <div class="width-50 float-left">
                           <div class="contributor_details">
                              <label class="control-label-closing">2. (b) SRN of fogm AOC-4/ AoC-4 XBRL/ AoC-4 NBFC filed by the company fog its standalone financial statements *:</label>
                              <ul class="pegtain">
                                 <li><?=(isset($csr2) && isset($csr2->srn))? $csr2->srn:''?></li>
                                 <li><?=(isset($csr2) && isset($csr2->srn_date))? date('Y-m-d',$csr2->srn_date):''?></li>
                              </ul>
                           </div>
                        </div>
                     </div>
            </div>
         </div>
         <!--row-->
         <div class="fincail-table">
            <h5 class="ft-h">3. Financial Details for CSR:</h5>
            <div style="width:100%">
                     <table cellpadding="0" cellspacing="0" width="100%" style="font-size: 11.5px">
                        <thead>
                              <tr>
                                 <td class="text-center">Net Worth (in Rs.)</td>
                                 <td class="text-center">Turnover (in Rs.)	</td>
                                 <td class="text-center">Net Profit (in Rs.)</td>
                                 <td class="text-center">Criteria that triggered CSR applicability</td>
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
            <div class="row">
               <div class="width-50 float-left">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">4.(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div rd-divs-par">
                        <input type="radio" name="radio-btn" <?=($obligation->CSR_committee_constituted == 1)? 'checked':''?>/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn" <?=($obligation->CSR_committee_constituted == 2)? 'checked':''?> /><span class="cus-radio no-radio">No</span>
                        <input type="radio" name="radio-btn" <?=(!$obligation->CSR_committee_constituted)? 'checked':''?> /><span class="cus-radio na-radio">Not Applicable</span>
                     </div>
                  </div>
               </div>
               <div class="width-50 float-left">
                  <div class="form-group mb-3 op-1">
                     <label for="exampleInputEmail1">4. (a) (ii) Number of directors composing CSR Committee:</label>
                     <input type="text" class="form-control text-smcus" value="<?=$obligation->no_of_CSR_directors ?>">
                  </div>
               </div>
            </div>
            <div class="row">
               <div>
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">4. (a) (iii)  Number of meetings of CSR Committee held during the year:</label>
                     <div class="radio-div rd-divs-par">
                        <input class="form-control" style="width:200px" value="<?=(isset($csr2) && isset($csr2->number_of_meetings_of_csr_committee))? $csr2->number_of_meetings_of_csr_committee:''?>" name="meeting" type="number" required/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="table-responsive table-padd">
               <table class="table table-bordered tab-88 cSR-committee-table">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <th>Sr. No </th>
                     <th>DIN</th>
                     <th>Name of Director</th>
                     <th>Category</th>
                     <th>No. of meetings of CSR<br>
                        Committee attended during<br>
                        the year
                     </th>
                  </thead>
                  <tbody>
                     <tr>
                        <td>01</td>
                        <td>12345678 </td>
                        <td class="td-li"> Hemant Panpalia  </td>
                        <td class="td-li"> Chairman </td>
                        <td class="td-li"> <input placeholder="05" class="text-center" type="text"> </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td>12345678</td>
                        <td class="td-li"> Hemant Panpalia  </td>
                        <td class="td-li"> Chairman </td>
                        <td class="td-li"> <input placeholder="05" class="text-center" type="text"> </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td>12345678</td>
                        <td class="td-li"> Hemant Panpalia </td>
                        <td class="td-li"> Chairman </td>
                        <td class="td-li"> <input placeholder="05" class="text-center" type="text"> </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td>12345678</td>
                        <td class="td-li"> Hemant Panpalia  </td>
                        <td class="td-li"> Chairman </td>
                        <td class="td-li"> <input placeholder="05" class="text-center" type="text"> </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group mb-3 op-1">
                     <label for="exampleInputEmail1">(b) Name of the company*:</label>
                     <input type="text" required class="form-control web-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="www.unilever.com ">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <span class="radio-before-span">Composition of CSR committee:</span><input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio na-radio">Not Applicable</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <span class="radio-before-span">Composition of CSR committee:</span>
                        <input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <span class="radio-before-span">CSR projects approved by the board:</span>
                        <input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio na-radio">Not Applicable</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <input type="radio" name="radio-btn" checked/><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"/><span class="cus-radio no-radio">No</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="table-thr">
               <label class="">(d) (éé) If yes, provéde detaéls:</label>
               <div class="table-responsive">
                  <table class="table table-bordered tab-88">
                     <thead class="no-bd ">
                     </thead>
                     <thead class="nd-tab">
                        <th>Sr. No </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                        <th>End Date </th>
                     </thead>
                     <tbody>
                        <tr>
                           <td>01</td>
                           <td>Activity Description </td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                        </tr>
                        <tr>
                           <td>01</td>
                           <td>Activity Description </td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                        </tr>
                        <tr>
                           <td>01</td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                        </tr>
                        <tr>
                           <td>01</td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <!--table-responsive-->
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                     <div class="radio-div">
                        <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Yes</span>
                        <input type="radio" name="radio-btn"><span class="cus-radio no-radio">No</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group mb-3 op-1">
                     <label for="exampleInputEmail1">(b) Name of the company*:</label>
                     <input type="text" class="form-control ss-size" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="1">
                  </div>
               </div>
            </div>
            <div class="table-thr">
               <label class="">5 (c) Net Pgofit & Otheg Details fog the pgeceding financial yeags *:</label>
               <div class="table-responsive">
                  <table class="table table-bordered tab-88 cSR-committee-table">
                     <thead class="no-bd ">
                     </thead>
                     <thead class="nd-tab">
                        <th>Sr. No </th>
                        <th>Particulars</th>
                        <th colspan="3" class="without-border">Amount (in Rs.) </th>
                     </thead>
                     <tbody>
                        <tr>
                           <td></td>
                           <td> </td>
                           <td class="td-li td-bg"> FY 1 (YE 31/03/2019) </td>
                           <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                           <td class="td-li td-bg"> FY 3 (YE 31/03/2019) </td>
                        </tr>
                        <tr>
                           <td>01</td>
                           <td>Activity Description </td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                        </tr>
                        <tr>
                           <td>01</td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                        </tr>
                        <tr>
                           <td>01</td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 01 Jan 2022 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                           <td class="td-li"> 01 Feb 2022 01 </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <!--table-responsive-->
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group mb-3">
                     <label for="exampleInputEmail1">(d)Avegage net pgofit of the company as peg section ô35(5) * :</label>
                     <input type="text" class="form-control size-bf1" id="dummy" aria-describedby="emailHelp" placeholder="c15140MH1933PcC002030 ">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group mb-3 op-1">
                     <label for="exampleInputEmail1">(c) 2% of Avegage net pgofit of the<br> company as peg section ô35(5) * :</label>
                     <input class="form-control size-bf" type="text" placeholder="c15140MH1933PcC002030" "="" aria-label="Disabled input example">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">(d) Sugplus agising out of the CSR pgojects/pgoggams og<br> activities of the pgevious financial yeag, if any* :</label>
                     <input type="text" class="form-control size-bf" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="c15140MH1933PcC002030 ">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group mb-3 op-1">
                     <label for="exampleInputEmail1">(c) Amount gequiged to be set off<br> fog the financial yeag, if any *:</label>
                     <input class="form-control size-bf" type="text" placeholder="c15140MH1933PcC002030" "="" aria-label="Disabled input example">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">(d)  Total CSR obligation for<br> the financial yeag (6a+6b 6c) *:
                     </label>
                     <input type="text" class="form-control size-bf" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="c15140MH1933PcC002030 ">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--secondone-par-->
      <div class="sec-one-par se-one-par-div1">
         <div class="row">
            <div class="col-lg-4">
               <div class="form-group mb-3">
                  <label for="exampleInputEmail1">7. (a) (i) Whetheg CSR Committee has been constituted * :</label>
                  <div class="radio-div">
                     <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Yes</span>
                     <input type="radio" name="radio-btn"><span class="cus-radio no-radio">No</span>
                     <input type="radio" name="radio-btn"><span class="cus-radio na-radio">Not Applicable</span>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group mb-3">
                  <label for="exampleInputEmail1">(a) (i) Whetheg CSR Committee has been constituted * :</label>
                  <div class="radio-div">
                     <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Ongoing projects </span>
                     <input type="radio" name="radio-btn"><span class="cus-radio no-radio">Other than Ongoing projects</span>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 both-col-rel">
               <div class="form-group mb-3">
                  <label for="exampleInputEmail1"></label>
                  <div class="radio-div">
                     <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio wl">Both (Ongoing and other than ongoing projects)</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="table-thr">
            <label class="">(i) Details of CSR amount spent against ongoing projects for the financial year:</label>
            <div class="table-inner-h"><label class="num-text">Number of Ongoing Projects for the financial year: </label> <input class="tabtwo-text" type="text" placeholder="02"/></div>
            <div class="table-responsive">
               <table class="table table-bordered tab-88">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <tr>
                        <th>Sr. No </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                        <th>End Date </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                        <th>End Date </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td></td>
                        <td></td>
                        <td class="td-li">  </td>
                        <td class="td-li">  </td>
                        <td class="td-li">  </td>
                        <td class="td-bg">Activity Description </td>
                        <td class="td-li td-bg"> 01 01 Jan 2022 </td>
                        <td class="td-li"> </td>
                        <td class="td-li"> </td>
                        <td></td>
                        <td class="td-li td-bg"> 01 01 Jan 2022 </td>
                        <td class="td-li td-bg"> 01 Feb 2022 01 </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td> </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td> 01 01 Jan 2022 </td>
                        <td> 01 Feb 2022 01 </td>
                     </tr>
                     <tr>
                        <td>02</td>
                        <td> </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td> 01 01 Jan 2022 </td>
                        <td> 01 Feb 2022 01 </td>
                     </tr>
                     <tr>
                        <td></td>
                        <td> </td>
                        <td class="td-li">  </td>
                        <td class="td-li">  </td>
                        <td class="td-li">  </td>
                        <td> </td>
                        <td class="td-li"></td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td></td>
                        <td> </td>
                        <td> </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
         </div>
         <div class="table-thr">
            <label class="">(i) Details of CSR amount spent against ongoing projects for the financial year:</label>
            <div class="table-inner-h"><label class="num-text">Number of Ongoing Projects for the financial year: </label> <input class="tabtwo-text" type="text" placeholder="02"/></div>
            <div class="table-responsive">
               <table class="table table-bordered tab-88">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <tr>
                        <th>Sr. No </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                        <th>End Date </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td></td>
                        <td></td>
                        <td class="td-li">  </td>
                        <td class="td-li">  </td>
                        <td class="td-bg">Activity Description </td>
                        <td class="td-li td-bg"> 01 01 Jan 2022 </td>
                        <td class="td-li"> </td>
                        <td class="td-li"> </td>
                        <td></td>
                        <td class="td-li td-bg"> 01 01 Jan 2022 </td>
                        <td class="td-li td-bg"> 01 Feb 2022 01 </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td> </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td> 01 01 Jan 2022 </td>
                        <td> 01 Feb 2022 01 </td>
                     </tr>
                     <tr>
                        <td>02</td>
                        <td> </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td class="td-li"> 01 01 Jan 2022 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td>Activity Description </td>
                        <td> 01 01 Jan 2022 </td>
                        <td> 01 Feb 2022 01 </td>
                     </tr>
                     <tr>
                        <td></td>
                        <td> </td>
                        <td class="td-li">  </td>
                        <td class="td-li">  </td>
                        <td> </td>
                        <td class="td-li"></td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td class="td-li"> 01 Feb 2022 01 </td>
                        <td></td>
                        <td> </td>
                        <td> </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
         </div>
         <div class="row">
            <div class="col-lg-6">
               <div class="form-group mb-3">
                  <label for="exampleInputEmail1">f (c) Amount spent in Administgative Ovegheads *:</label>
                  <input type="text" class="form-control det-tab-after-in" id="dummy" aria-describedby="emailHelp" placeholder="c15140MH1933PcC002030 ">
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group mb-3 op-1">
                  <label for="exampleInputEmail1">f (d) Amount spent on Impact Assessment, if applicable * :</label>
                  <input class="form-control det-tab-after-in" type="text" placeholder="c15140MH1933PcC002030" "="" aria-label="Disabled input example">
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group mb-3 op-1">
                  <label for="exampleInputEmail1">f (e) Total amount spent fog the Financial <br> Year *:</label>
                  <input class="form-control det-tab-after-in" type="text" placeholder="c15140MH1933PcC002030" "="" aria-label="Disabled input example">
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group">
                  <label for="exampleInputEmail1">(f) Amount unspent/ (excess) spent fog the Financial <br>Yeag [6(d) 7(e)] unspent fog Ongoing pgojects) *:</label>
                  <input type="text" class="form-control det-tab-after-in" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="c15140MH1933PcC002030 ">
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group mb-3 op-1">
                  <label for="exampleInputEmail1">f (g) Amount eligible fog tgansfeg to Unspent CSR Account fog the Financial Yeag as peg Section ô35(6)<br> (befoge adjustments) *:</label>
                  <input class="form-control det-tab-after-in" type="text" placeholder="c15140MH1933PcC002030" "="" aria-label="Disabled input example">
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group">
                  <label for="exampleInputEmail1">(h) Amount to be tgansfegged to Fund specified in Schedule VII fog the Financial Yeag (if total unspent fog the Financial Yeag is ggeateg than unspent fog Ongoing pgojects) *:
                  </label>
                  <input type="text" class="form-control det-tab-after-in" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="c15140MH1933PcC002030 ">
               </div>
            </div>
         </div>
      </div>
      <!--secondone-par div1-->
      <div class="sec-one-par se-one-par-div2">
         <div class="table-thr">
            <label class="">8. Details of tgansfeg of Unspent CSR amount fog the financial yeag:</label>
            <div class="table-inner-h"><label class="lab-sma">(a) Tgansfeg to Unspent CSR account as peg Section ô35(6): </label></div>
            <div class="table-responsive tbl-cen">
               <table class="table table-bordered tab-88 w-c-t">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <tr>
                        <th>Sr. No </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr class="tr-input-par">
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
         </div>
         <div class="table-thr">
            <div class="table-inner-h"><label class="lab-sma">(a) Tgansfeg to Unspent CSR account as peg Section ô35(6): </label></div>
            <div class="table-responsive tbl-cen">
               <table class="table table-bordered tab-88 w-c-t">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <tr>
                        <th>Sr. No </th>
                        <th>Activity Description</th>
                        <th> Start Date </th>
                        <th>End Date </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr class="tr-input-par">
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                        <td><input type="text" placeholder="10,00,00,000" class="td-input"/></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
         </div>
         <div class="nine-h-div">
            <h5>9. Specify the geason(s) if the company has failed to spend two peg cent of the avegage net pgofit as peg section ô35(5): *:
            </h5>
            <input type="text" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
               has been the industry's standard dummy text ever since the 1500s," class="ipt-lorem"/>
         </div>
      </div>
      <!--se-one-par-div2-->
      <div class="sec-one-par se-one-par-div3">
      <div class="table-thr">
         <label class="">10. f Whetheg any unspent amount of pgeceding thgee financial yeags (financial yeag
         ending afteg 22 Januagy 202ô) has been spent in the financial yeag *:</label>
         <div class="row">
            <div class="col-lg-4">
               <div class="radio-div">
                  <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Yes</span>
                  <input type="radio" name="radio-btn"><span class="cus-radio no-radio">No</span>
                  <input type="radio" name="radio-btn"><span class="cus-radio na-radio">Not Applicable</span>
               </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
         </div>
         <div class="table-responsive">
            <label class="t-s">10. (a) Details of CSR amount spent in the financial yeag pegtaining to thgee pgeceding financial yeag(s):</label>
            <table class="table table-bordered tab-88 w-c-t">
               <thead class="no-bd ">
               </thead>
               <thead class="nd-tab center-th">
                  <tr>
                     <th>Sr. No </th>
                     <th>Activity Description</th>
                     <th> Start Date </th>
                     <th>End Date </th>
                     <th>End Date </th>
                     <th colspan="2">End Date </th>
                     <th>End Date </th>
                     <th>End Date </th>
                  </tr>
               </thead>
               <tbody>
                  <tr class="tr-empty-par">
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>Amount(in Rs.)</td>
                     <td>Amount(in Rs.)</td>
                     <td></td>
                  </tr>
                  <tr class="tr-empty-par">
                     <td>Amount(in Rs.)</td>
                     <td>Amount(in Rs.)</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr class="tr-empty-par">
                     <td>Amount(in Rs.)</td>
                     <td>Amount(in Rs.)</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr class="tr-empty-par">
                     <td>Amount(in Rs.)</td>
                     <td>Amount(in Rs.)</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <!--table-responsive-->
      </div>
      <!--tableth-->
      <div class="table-thr">
         <label class="">(i) Details of CSR amount spent against ongoing projects for the financial year:</label>
         <div class="table-inner-h"><label>Number of Ongoing Projects for the financial year: </label> <input class="tabtwo-text" type="text" placeholder="02"></div>
         <div class="table-responsive">
            <div class="table-responsive">
               <table class="table table-bordered tab-88">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <tr>
                        <th>Sr. No </th>
                        <th>Short particulars of property or asset(s)
                           [Including complete address and
                           location of the property]
                        </th>
                        <th>Pin code of
                           property or
                           asset
                        </th>
                        <th>Date of
                           Creation
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th colspan="2">Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th colspan="2" class="without-border colspan-th">Amount (in Rs.) </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="td-li td-bg"> FY 1 (YE 31/03/2019) </td>
                        <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                        <td> </td>
                        <td></td>
                        <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                        <td class="td-li td-bg"> FY 3 (YE 31/03/2019) </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td>02</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
         </div>
         <label class="">10. f Whetheg any unspent amount of pgeceding thgee financial yeags (financial yeag
         ending afteg 22 Januagy 202ô) has been spent in the financial yeag *:</label>
         <div class="row">
            <div class="col-lg-4">
               <div class="radio-div">
                  <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Yes</span>
                  <input type="radio" name="radio-btn"><span class="cus-radio no-radio">No</span>
               </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
         </div>
         <label class="Ifyes-radio">10.(ii) If yes, natuge of the new CSR Pgoject(s) is/age:</label>
         <div class="row">
            <div class="col-lg-6">
               <div class="radio-div">
                  <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Yes</span>
                  <input type="radio" name="radio-btn"><span class="cus-radio no-radio">No</span>
                  <input type="radio" name="radio-btn"><span class="cus-radio no-radio">Both (Ongoing and other than ongoing projects)</span>
               </div>
            </div>
            <div class="col-lg-6"></div>
         </div>
         <div class="table-thr qwe">
            <label class="">(i) Details of CSR amount spent against ongoing projects for the financial year:</label>
            <div class="table-inner-h"><label>Number of Ongoing Projects for the financial year: </label> <input class="tabtwo-text" type="text" placeholder="02"></div>
            <div class="table-responsive">
               <table class="table table-bordered tab-88">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <tr>
                        <th>Sr. No </th>
                        <th>Short particulars of property or asset(s)
                           [Including complete address and
                           location of the property]
                        </th>
                        <th>Pin code of
                           property or
                           asset
                        </th>
                        <th>Date of
                           Creation
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th colspan="2">Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th colspan="2" class="without-border colspan-th">Amount (in Rs.) </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="td-li td-bg"> FY 1 (YE 31/03/2019) </td>
                        <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                        <td class="td-li td-bg"> FY 3 (YE 31/03/2019) </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>No</td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td>02</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>No</td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
         </div>
         <div class="table-thr">
            <label class="">(i) Details of CSR amount spent against ongoing projects for the financial year:</label>
            <div class="table-inner-h"><label>Number of Ongoing Projects for the financial year: </label> <input type="text" placeholder="02"></div>
            <div class="table-responsive">
               <table class="table table-bordered tab-88">
                  <thead class="no-bd ">
                  </thead>
                  <thead class="nd-tab">
                     <tr>
                        <th>Sr. No </th>
                        <th>Short particulars of property or asset(s)
                           [Including complete address and
                           location of the property]
                        </th>
                        <th>Pin code of
                           property or
                           asset
                        </th>
                        <th>Date of
                           Creation
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th colspan="2">Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th>Amount of
                           CSR spent
                        </th>
                        <th colspan="2" class="without-border colspan-th">Amount (in Rs.) </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="td-li td-bg"> FY 1 (YE 31/03/2019) </td>
                        <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                        <td> </td>
                        <td></td>
                        <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                        <td class="td-li td-bg"> FY 3 (YE 31/03/2019) </td>
                     </tr>
                     <tr>
                        <td>01</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td>02</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!--table-responsive-->
         </div>
      </div>
      <!--se-one-par-div3-->
      <div class="sec-one-par se-one-par-div4">
         <div class="table-thr">
            <label class="">11. Whetheg any unspent amount pegtaining to FY 20ô4-ô5 to FY 20ôý-20 has been spent in the financial yeag:</label>
            <div class="row">
               <div class="col-lg-4">
                  <div class="radio-div">
                     <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Yes</span>
                     <input type="radio" name="radio-btn"><span class="cus-radio no-radio">No</span>
                  </div>
               </div>
               <div class="col-lg-4"></div>
               <div class="col-lg-4"></div>
            </div>
            <div class="table-responsive">
               <label>10. (a) Details of CSR amount spent in the financial yeag pegtaining to thgee pgeceding financial yeag(s):</label>
               <div class="table-responsive">
                  <label class="furnish">Furnish the details relating to such asset(s) so created or acquired through CSR spent in the financial year:
                  </label>
                  <div class="table-responsive">
                     <table class="table table-bordered tab-88">
                        <thead class="no-bd ">
                        </thead>
                        <thead class="nd-tab">
                           <tr>
                              <th>Sr. No </th>
                              <th>Short particulars of property or asset(s)
                                 [Including complete address and
                                 location of the property]
                              </th>
                              <th>Pin code of
                                 property or
                                 asset
                              </th>
                              <th>Date of
                                 Creation
                              </th>
                              <th>Amount of
                                 CSR spent
                              </th>
                              <th colspan="2">Amount of
                                 CSR spent
                              </th>
                              <th>Amount of
                                 CSR spent
                              </th>
                              <th>Amount of
                                 CSR spent
                              </th>
                              <th colspan="2" class="without-border colspan-th">Amount (in Rs.) </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td class="td-li td-bg"> FY 1 (YE 31/03/2019) </td>
                              <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                              <td> </td>
                              <td></td>
                              <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                              <td class="td-li td-bg"> FY 3 (YE 31/03/2019) </td>
                           </tr>
                           <tr>
                              <td>01</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>02</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Total</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <!--table-responsive-->
               </div>
               <!--tableth-->
            </div>
            <!--se-one-par-div4-->
            <div class="sec-one-par se-one-par-div5">
               <div class="table-thr">
                  <div class="row">
                     <div class="col-lg-6">
                        <label class="">12. Whetheg any Capital assets have been cgeated og
                        acquiged thgough CSR spent in the financial yeag *:</label>
                        <div class="radio-div">
                           <input type="radio" name="radio-btn" checked=""><span class="cus-radio yes-radio">Yes</span>
                           <input type="radio" name="radio-btn"><span class="cus-radio no-radio">No</span>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group mb-3 op-1">
                           <label for="exampleInputEmail1">If Yes, enteg the numbeg of Capital assets cgeated/ <br>acquiged :</label>
                           <input type="text" class="form-control one-last-textfield" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0">
                        </div>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <label class="furnish">Furnish the details relating to such asset(s) so created or acquired through CSR spent in the financial year:
                     </label>
                     <div class="table-responsive">
                        <table class="table table-bordered tab-88">
                           <thead class="no-bd ">
                           </thead>
                           <thead class="nd-tab">
                              <tr>
                                 <th>Sr. No </th>
                                 <th>Short particulars of property or asset(s)
                                    [Including complete address and
                                    location of the property]
                                 </th>
                                 <th>Pin code of
                                    property or
                                    asset
                                 </th>
                                 <th>Date of
                                    Creation
                                 </th>
                                 <th>Amount of
                                    CSR spent
                                 </th>
                                 <th colspan="3" class="without-border colspan-th">Amount (in Rs.) </th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td> </td>
                                 <td class="td-li td-bg"> FY 1 (YE 31/03/2019) </td>
                                 <td class="td-li td-bg"> FY 2 (YE 31/03/2019) </td>
                                 <td class="td-li td-bg"> FY 3 (YE 31/03/2019) </td>
                              </tr>
                              <tr>
                                 <td>01</td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td>Total</td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!--table-responsive-->
               </div>
               <!--tableth-->
               <p class="p-hed-table-end"><i class="fa fa-plus"></i> Add details of capital assest</p>
            </div>
            <!--se-one-par-div5-->
            <div class="end-form d-flex justify-content-center space-btn-par">
               <div class="btn-wrap">
                  <a href="#">Edit CSR 2 form</a>
               </div>
               <div class="btn-wrap filled-btn">
                  <a href="#">Save & Preview</a>
               </div>
            </div>
         </div>
         <!--container-->
      </div>
      <!--main-div-par-->
   </body>
</html>