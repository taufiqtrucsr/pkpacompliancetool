<div class="contributors-associated">
	<div class="funds-summary">
		<p class="second-heading">CONTRIBUTORS ASSOCIATED WITH THE PROJECT</p>
	</div><!-- funds-summary -->

	<div class="project-images-set">
		<?php 
		    if(isset($projectContributor) && count($projectContributor)>0) { 
		    	//echo "<pre>";print_r($projectContributor);echo "<pre>";
                $contributorCount=count($projectContributor);
                $pageContributorCount=2;
                $noPage=round($contributorCount/$pageContributorCount);
                $array=array();
                for ($i=0; $i < $noPage ; $i++) {
                    $start=$pageContributorCount*$i;
                    $end=($start+$pageContributorCount) -1;
                    //echo "<hr>".$start."<hr>".$end."<hr>";
                
                	for($j=$start;$j<=$end;$j++){
                		if(isset($projectContributor[$j]))
                		$array[$i]['contributorDetails'][]=$projectContributor[$j];
                	}
                	
                }

                //echo "<pre>";print_r($array);echo "<pre>";
                for ($i=0; $i <count($array) ; $i++) { 
                	$contributorDetails=$array[$i]['contributorDetails'];
                	//echo "<pre>";print_r($contributorDetails);echo "<pre>";
                	echo "<div id='contdiv$i' style='display:none'>";
                	for ($j=0; $j < count($contributorDetails) ; $j++) {
                	    //echo "<pre>";print_r($contributorDetails[$j]);echo "<pre>";
                		if($contributorDetails[$j]['company_logo']!=""){
                		?>
	                		<div class="project-img-default">
								<label class="">
									<img src="<?php echo base_url();?>public/uploads/company/company_logo/<?php echo $contributorDetails[$j]['company_logo']?>" style="width: 200px; height: 200px;background: #36c; color: #fff;">
								</label>
							</div><!-- project-img-default -->
						<?php }else{ ?>	
							<div class="project-img-default"
		                    style="padding: 19px 15px;text-align: center; font-size: 38px; width: 150px; height: 200px;background: #36c; color: #fff;">
			                    <?php echo ucfirst($contributorDetails[$j]['company_name'])?>
			                </div>
                		<?php 	
                		}
                	}
                	echo "</div>";
                } 
		    }
		?>	
	</div><!-- project-images-set -->
    <?php if(isset($noPage)) {?>
	<div class="pagination-recent">
		<ul>
			<?php 
			for ($i=0; $i < $noPage ; $i++) 
			    {
			    	$num=$i+1;
			?>
				<li id="liid<?=$i?>" onclick="selectPage(<?=$i?>,<?=$noPage?>)"><a href="javascript:void()"><?=$num?></a></li>
			<?php
	     	    }
	     	?>
		</ul>
	</div><!-- pagination-recent -->
    <?php }?>
</div>    
<script>
	selectPage(0,<?=$noPage?>);
	function selectPage(num,pages){
		for (var i = 0; i < pages; i++) {
			$('#contdiv'+i).hide();
			$("#liid"+i).removeClass("active");
		}
		$("#liid"+num).addClass("active");
        $('#contdiv'+num).show();
	}
</script>	
	