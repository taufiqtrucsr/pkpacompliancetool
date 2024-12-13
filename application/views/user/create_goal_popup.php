
<script src="<?php echo SKIN_URL; ?>js/bootstrap-select.min.js"></script>
<form name="create_goal_form" id="create_goal_form" method="POST" >
<!-- Modal Screen 1-->
  <div class="modal fade" id="createanewgoal" role="dialog">
    <div class="modal-dialog fullscreen modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create a new goal</h4>
        </div>
        <div class="modal-body">
			<div class="popup-content">
					<div class="create-page create-width"> 
						
						<ul class="form-create-page">
						<li>
								<div class="field-row zone-block select-block">
									<label>Zone</label>
									
									<div class="btn-group select-box select-box-zones">
									<span class="arrow-dn"><i class="fa fa-angle-down"></i></span>
										<select class="selectpicker  "   name="zone_list" id="zone_list">
										<option  class="choose-zone" value="">Choose Zone</option>
										<?php if(isset($ZonesList) && count($ZonesList) > 0) { 
											foreach($ZonesList as $value) { ?>
											<option class="<?php echo $value['class_code']; ?>"  value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>		 
										<?php }
										} ?>
										 
										</select>
										
									  </div>
									</div>
							</li>
							<li>
								<div class="field-row goal-block select-block">
									<label>Goal Name</label>
									
									  <div class="btn-group select-box select-box-goal">
									  <span class="arrow-dn"><i class="fa fa-angle-down"></i></span>
										<select  class="selectpicker " data-show-subtext="true"  name="goal_list" id="goal_list" disabled>
											<option value="" data-target=""  data-unit=""  data-numeric="" data-subtext="" >What whould you like to accomplish?</option>
											<option value="custom" data-target=""  data-unit=""  data-numeric="" data-subtext="" >Choose Custom Goal</option>										 
										</select>
									  </div>
									
									
									<input style="display:none;" type="text" id="custom_goal" name="custom_goal"  placeholder="Enter your goal" class="text-input">
								</div>
							</li>
							
							
							<li class="width30 time-block">
								<div class="field-row">
									<label>Start date</label>
									<input type="text" readonly name="goal_start_date_calendar" id="goal_start_date_calendar" class="text-input" value="" disabled>
									<input type="hidden" name="goal_start_date" id="goal_start_date" value="" >
									
								</div>

								<div class="field-row">
									<label>End date</label>
									<input type="text" readonly name="goal_end_date_calendar" id="goal_end_date_calendar" class="text-input" value="" disabled>
									<input type="hidden" name="goal_end_date" id="goal_end_date"  value="" >
									
								</div>

								<div class="field-row">
									<label>Goal time</label>
									<input type="text" name="goal_time" maxlength="8" id="goal_time" class="text-input " disabled>
								</div>
							</li>
							
							

							<li class="numeric-goal-main" >
								<p>Do you want to create a numeric goat or a non-numeric goal?</p>
								<div class="numeric-goal-block radioright-style">
									<div class="field-row clearfix numeric-click-area avoid-clicks" >
										<input id="numeric-goal" type="radio" disabled  name="is_numeric" value="1" class="mygroup">
										<label for="numeric-goal">Numeric goal<span></span></label>
									</div>
									<div class="goal-bottom">
										<p class="purple" id="numeric_case_study">eg. Losing 5 kilograms in 2 months is a numeric goal.</p>
										<p id="numeric_description">5 is the target and kilogram is the unit of measurement</p>
									</div>
								</div>
								<div class="non-numeric-goal-block radioright-style">
									<div class="field-row clearfix numeric-click-area avoid-clicks" >
										<input id="non-numeric-goal" disabled type="radio"  name="is_numeric" value="0" class="mygroup" >
										<label for="non-numeric-goal">Non Numeric goal<span></span></label>
									</div>
									<div class="goal-bottom">
										<p class="purple"  id="non_numeric_case_study">eg. Losing 5 kilograms in 2 months is a numeric goal.</p>
										<p id="non_numeric_description">5 is the target and kilogram is the unit of measurement</p>
									</div>
								</div>
							</li>
							
							<li class="width30" id="target-block" style="display:none;">
								<div class="field-row">
									<label>Target</label>
									<input type="text" name="target" maxlength="10" id="target" class="text-input" placeholder="Enter Number" disabled>
								</div>

								<div class="field-row width40">
									<label>Unit of measurement</label>
									<input type="text" name="unit_of_measurement" id="unit_of_measurement" class="text-input" placeholder="Eg. pounds" disabled>
								</div>
							</li>
							
						</ul>
						<div class="button-set bottom-right">
							<input type="button" class="btn-cancel"  value="Cancel">
							<input type="button" id="first-btn-submit" disabled class="btn-submit proceed" value="Next">
						</div>
					</div>
				</div>
        </div>
       
      </div>
    </div>
  </div>
  
  
	<!-- Modal Screen 2-->
   <div class="modal fade" id="createanewgoal2" role="dialog">
    <div class="modal-dialog fullscreen modal-sm">
      <div class="modal-content">
		<div class="modal-header close-right">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<div class="popup-content">
					<div class="create-page create-width"> 
						<p>How many days in a week you would like to schedule actions ?</p>
						<span id="action-days"></span>
						<ul class="form-create-page">
							<li class="checkbox-box checkbox-style checkbox-right width30">
								<div class="field-row">
									<input id="alldays"  type="checkbox" name="checkbox" value="2" checked="checked">
									<label for="alldays">All days<span></span></label>
								</div>
							</li>
							<?php 
							$days = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
							?>

							<li class="checkbox-box checkbox-style checkbox-right">
							
							<?php foreach($days as $key=>$value){?>
								<div class="field-row width25">
									<input id="<?php echo $value; ?>" class="weekdays" type="checkbox" name="schedule_action_days[]" value="<?php echo $value; ?>" checked="checked">
									<label for="<?php echo $value; ?>"><?php echo $value; ?><span></span></label>
								</div>
							<?php } ?>
							</li>



						<!--<li>
								<div class="field-row">
									<label>Add mentor</label>
									<input type="text" name="" placeholder="Create an inspiring name for your goal" class="text-input">
								</div>
						</li>-->

							
						</ul>
						<!--<div class="bottom-content">
							<p>Adding a mentor for your goal will significantly increase your chances of  accomplishing your goal</p>
							<p>*You can add a mentor here only if the mentor has accepted your mentor request earlier</p>
						</div>-->
						<div class="button-set bottom-right">
							<input type="button" class="btn-cancel" value="Cancel">
							<input type="button" id="last-btn-submit" class="btn-submit proceed" value="POST">
						</div>
					</div>
				</div>
        </div>
       
      </div>
    </div>
  </div>
	</form>
  <!-- Modal goal created popup-->
  <div class="success-popup" id="success-popup"></div>
  
  
  