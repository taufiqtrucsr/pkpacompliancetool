<div class="col-sm-3 left-side-bar-dashboard">
	<ul class="create-project-list">
		<li class="project-list <?php echo ($segment == 'projects')?'active':'';?>"> <a href="/dashboard/projects"> Projects </a></li>
		<?php //if($UserDetails->type == 2){ ?>
		<li class="contracts-list <?php echo ($segment == 'contracts')?'active':'';?>"> <a href="/dashboard/contracts"> Contracts </a></li>
		<?php //} ?>
		<?php if($UserDetails->type == 1){ ?>
		<!-- <li class="reports-list < ?php echo ($segment == 'reports')?'active':'';?>"> <a href="/dashboard/reports"> Reports </a></li> -->
		<li class="reports-list <?php echo ($segment == 'reports')?'active':'';?>"> <a href="/dashboard/reports/0"> Reports </a></li>
		<li class="funds-list <?php echo ($segment == 'funds')?'active':'';?>"> <a href="/dashboard/funds"> Funding status </a></li>
		<li class="donation-list <?php echo ($segment == 'donation')?'active':'';?>"> <a href="/dashboard/donation"> Donation </a></li>
		<?php } ?>
	</ul>
</div><!-- col-sm-4 -->
