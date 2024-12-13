<div class="select-campaign-details-section">
	<form id="projectFundForm" name="projectFundForm" method="POST">		
	<div class="form-group select-cam">
		<div class="col-sm-12">
			<label class="control-label grey-txt">SELECT PROJECT</label>
			<select id="project_id" name="project_id" placeholder="Select project" class="form-control" onchange="selectProject(this)">
                <?php 
                    if(isset($allActiveProjects) && count($allActiveProjects)>0) { 
                        $projectCounter=0;	
					    foreach($allActiveProjects as $value) {
					        if($selectCounter == $projectCounter)	
			                    echo "<option value='".$value->id."' selected>".$value->project_name."</option>";
			                else
			                	echo "<option value='".$value->id."' >".$value->project_name."</option>";
			               $projectCounter++;
			            } 
			        }
			    ?>   
		    </select>
		</div>
	</div><!-- col-sm-6 -->
    </form>
</div>