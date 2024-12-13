<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	  <link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/report-pdf-style.css" />
      <title>Financial Year Closing Report</title>
      <style>
          table td{
            border:1px solid black;
         }
      </style>
   </head>
   <body>
      <div id="main-div-par">
	  	  <?php $year = explode('-', $director_report->FY_year);?>
         <h3 class="report-start-title">
		 Annual Report on CSR Activities (For Purpose Of Director’s Report)<br> April
                            <?php echo $year[0]; ?> to March
                            <?php echo $year[1]; ?>
		 </h3>
         <div class="container">
            <div class="sec-one-par">
               <p>A brief outline of the Company’s Corporate Social Responsibilty (CSR) policy, including overview of projects or programmes proposed to
                  be undertaken and a reference to the web-link to the CSR policy and projects or programmes:
               </p>
               <p><?=$director_report->brief_about_director_report?></p>
               <p>The projects undertaken are within the broad framework of Schedule VII of the Companies Act, 2013. Details of the CSR policy and
                  projects or programmes undertaken by the Company are available on links given below:
               </p>
               <?php
								$urlStr = $obligation->CSR_policy_link;
								$parsed = parse_url($urlStr);
								if (empty($parsed['scheme'])) {
									$urlStr = 'http://' . ltrim($urlStr, '/');
								}
						?>
						<a class="csr_policy"  target="_blank"  href="<?php echo $urlStr; ?>">
							<?php echo $obligation->CSR_policy_link; ?>
						</a>
               <div class="dom">
                  <h5>Details of CSR Comittee Members</h5>
                  <?php foreach ($committee as $row) {
                                        echo '<p>' . $row->name_of_director . '</p>';
                    } ?>
               </div>
               <div class="memeber-price-list">
               <table class="table-profit">
							<thead>
								<tr>
                           <th>Avg. net profit of<br>last 3 FY:</th>
                           <th>Prescribed CSR<br> Expenditure:</th>
                           <th>Avg. net profit of<br>last 3 FY:</th>
                           <th>Prescribed CSR<br> Expenditure:</th>
                        </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>₹ <?=round($avg_net_profit->avg_net_profit)?></td>
                        <td>₹ <?=round($obligation->percentage_of_avg_net_profit)?></td>
                        <td>₹ <?=round($obligation->CSR_obligation_current_FY)?></td>
                        <td>₹ <?=round($director_report->amt_unspent_for_FY)?></td>
                     </tr>
                  </tbody>
               </table>
               </div>
               <div class="table-par" style="page-break-before: always;">
                  <h5 class="man-h5">Manner in which amount spent during the financial year:</h5>
                  <div style="width:100%">
                     <table cellpadding="0" cellspacing="0" width="100%" style="font-size: 11.5px">
                        <thead>
                              <tr>
                                 <td class="text-center">Sr. No</td>
                                 <td class="text-center">CSR Project or Activity identified</td>
                                 <td class="text-center">Sector in which project is covered (As in Schedule-VII)</td>
                                 <td class="text-center" colspan="2">Projects or programs (1) Local area or other (2) Specify the State and district where projects or programs was undertaken</td>
                                 <td class="text-center">Amount Outlay (budget) projects or programs wise (₹)</td>
                                 <td class="text-center" colspan="2">Amount spent on the projects or program Subheads : (1) Direct Expenditure on Projects or Programs; (2) Overheads (₹)</td>
                                 <td>Cumulative Expenditure upto the reporting period (₹)</td>
                                 <td>Amount Spent : Direct or through implementing agency</td>
                              </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td colspan="3"></td>
                              <td>Local Area: Y/N ?</td>
                              <td>State & District</td>
                              <td></td>
                              <td>Direct Expenditure on Projects or Programs (₹)</td>
                              <td>Overheads (₹)</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <?php $outlay=0;$direct_expenditure=0;$overheads=0;$cumulative_expense=0; foreach($director_project as $key => $row){ 
                              $outlay += ($row->project_outlay_amt ? $row->project_outlay_amt : 0);
                              $direct_expenditure += ($row->direct_expenditure ? $row->direct_expenditure : 0);
                              $overheads += ($row->overheads ? $row->overheads : 0);
                              $cumulative_expense += ($row->cumulative_expense ? $row->cumulative_expense : 0);
                           ?>
                           <tr>
                              <td><?=++$key?></td>
                              <td><?=$row->project_activity_name?></td>
                              <td><?=($row->sector ? $row->sector : '-')?></td>
                              <td><?=($row->is_project_location_local == 1)? 'Yes':'No' ?></td>
                              <td><?=($row->project_location_state ? $row->project_location_state : '-')?></td>
                              <td><?=($row->project_outlay_amt ? $row->project_outlay_amt : '-')?></td>
                              <td><?=$row->direct_expenditure?></td>
                              <td><?=($row->overheads ? $row->overheads : '-')?></td>
                              <td><?=$row->cumulative_expense?></td>
                              <td><?=($row->is_direct_implementation_dir_report == 1)? 'Implementing agency':'Direct' ?></td>
                           </tr>
                           <?php } ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>Total</th>
                              <td colspan="4"></td>
                              <td><?=$outlay?></td>
                              <td><?=$direct_expenditure?></td>
                              <td><?=$overheads?></td>
                              <td><?=$cumulative_expense?></td>
                              <td></td>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
                  <div class="note-h">
                     <<p><b>Note:</b> With respect to the projects identified by the Company as a part of its CSR
								activities, the Company had an outlay of (₹) <span class="budget-text-display"></span> against which a cumulative expenditure of (₹)
								<span><?=$cumulative_expense?></span> has been incurred upto March 31, <?php echo $year[1]; ?> (financial closing year)
							</p>
                     <?php if($director_report->reason_failed_to_csr_spend_director_report){ ?>
						<div class="reasons">
							<p>
								<label>
									In case the company has failed to spend the 2% of the average net profit of the
									last 3 FY or any part of thereof, the company
									shall provide he reasons for not spending the amount in its Board report.
									(Optional)
								</label>
							</p>
							<div class="note">
								<p class="text-area-content"><?=$director_report->reason_failed_to_csr_spend_director_report?></p>
							</div>
						</div>
						<?php } ?>
						<div class="reasons">
							<p><label>A responsibilty statement of the CSR Committee that the implementation and
									Monitoring
									of CSR Policy, is in compliance with CSR objectives and Policy of the
									company.</label>
							</p>
							<div class="col-md-8">
								<div class="row">
									<table class="table signature">
										<thead>
											<tr>
												<th scope="col">
													Sd/-
												</th>
												<th scope="col">
													Sd/-
												</th>
												<th scope="col">
													Sd/-
												</th>

											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Chief Executive Officer or Managing Director or Director</td>
												<td>Chairman CSR Committee</td>
												<td>(Person specified under clause (d)of sub-section (1) of section 380
													of
													the Act)</td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
                  </div>
               </div>
            </div>
            <?php if($case_study->case_study_title){ ?>
					<div class="additional_information">
						<h2>Additional Information</h2>
						<p class="case_stu">Case Study</p>
						<div class="write_report write_add_info">
							<p><label>Case Study Title</label></p>
							<div class="note mb-35">
								<p class="p-25"><?=$case_study->case_study_title?></p>
							</div>
							<p><label>Case Study Description</label></p>
							<div class="note mb-35">
								<p class="text-area-content p-25"><?=$case_study->case_study?></p>
							</div>
							<p><label>Conclusion</label></p>
							<div class="conclussion mb-35">
								<div class="note">
									<p class="text-area-content p-25"><?=$case_study->conclusion?></p>
								</div>
							</div>
							<div class="add_images">
								<p><label>Images</label></p>
								<?php foreach($case_study_image as $path){ ?>
									<div class="upload_imgs">
										<img src="<?=MEDIA_URL.''.$path->path?>">
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>
               <?php if($testimonials){ ?>
					<div class="additional_information testimonails">
						<h2>Testimonials</h2>
						<div class="additional_information-testimonials">
							<?php foreach($testimonials as $row){ ?>
								<div class="row testimonails-count">
									<div class="col-md-2 image-container">
										<div class="upload_imgs">
											<img src="<?php echo CSR_COMPLIANCE_URL.$row->person_image; ?>">
										</div>
									</div>
									<div class="col-md-10">
										<div class="row">
											<p><?=$row->person_name?> - <?=$row->person_designation?> <?=$row->person_organisation?></p>
											<div class="note">
												<p class="text-area-content"><?=$row->testimonial_description?></p>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
               <div class="additional_information SDGs" style="width:100%;">
						<h2>Sustainable Development Goals (SDGs) </h2>
						<div style="width:100%">
								<?php  foreach ($sdgs as $value) { ?>
              							<img style="width:10%;float:left" src="<?=base_url()?>/public/uploads/project/sdg_image/<?=$value->image?>" alt="img">
            					<?php }  ?> 
						</div>
					</div>
         </div>
         <!--main-div-par-->
      </div>
      </div>
      </div>
   </body>
</html>