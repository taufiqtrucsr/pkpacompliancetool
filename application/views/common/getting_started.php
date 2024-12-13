<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('common/head_common'); ?>

 <body class="static-page learning-centre-page">
	<?php $this->load->view('common/header'); ?>
	
	<div class="static-container-page getting-started-page clearfix">
		<div class="breadcrumbs clearfix">
			<span><a href="<?php echo base_url(); ?>page/learning-center/">Learning center</a></span><span> > Getting started</span>
		</div>

		<div class="left-menu-tree lfloat ">
					<div class="panel-group" id="accordion">
					
					<div class="panel panel-default">
					  
					  <div class="panel-heading">
						<h4 class="panel-title ">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><span class="number">1.0</span>Introduction</a>
						  
						</h4>
					  </div>
					  <div id="collapse1" class="panel-collapse collapse">
						<ul class="nav nav-list tree">
							<li><a href="#"><span class="number">1.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">1.2</span>Link 2</a></li>
						</ul>
					  </div>
					</div>
					
					<div class="panel panel-default">
					  
					  <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><span class="number">2.0</span>Creating Account</a>
						  
						</h4>
					  </div>

					  <div id="collapse2" class="panel-collapse collapse">
						<ul class="nav nav-list tree">
							<li><a href="#"><span class="number">2.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">2.2</span>Link 2</a></li>
						 </ul>
					</div>
					 </div>

					<div class="panel panel-default">
					   <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><span class="number">3.0</span>Creating Goals</a>
						 
						</h4>
					  </div>
					  <div id="collapse3" class="panel-collapse collapse in">
						 <ul class="nav nav-list tree">
							<li><a href="" class="active"><span class="number">3.1</span>How do i create a goal?</a></li>
							<li><a href="getting-started2.html"><span class="number">3.2</span>Creating a custom goal v/s default goal</a></li>
							<li><a href="#"><span class="number">3.3</span>What is the right target for my goal</a></li>
						 </ul>
					  </div>
					</div>

					<div class="panel panel-default">
					   <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><span class="number">4.0</span>Creating Goals</a>
						 
						</h4>
					  </div>
					  <div id="collapse4" class="panel-collapse collapse">
						 <ul class="nav nav-list tree">
							<li><a href="#"><span class="number">4.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">4.2</span>Link 2</a></li>
						 </ul>
					  </div>
					</div>

					<div class="panel panel-default">
					   <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><span class="number">5.0</span>Creating Goals</a>
						 
						</h4>
					  </div>
					  <div id="collapse5" class="panel-collapse collapse">
						 <ul class="nav nav-list tree">
							<li><a href="#"><span class="number">5.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">5.2</span>Link 2</a></li>
						 </ul>
					  </div>
					</div>

					<div class="panel panel-default">
					   <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><span class="number">6.0</span>Creating Goals</a>
						 
						</h4>
					  </div>
					  <div id="collapse6" class="panel-collapse collapse">
						 <ul class="nav nav-list tree">
							<li><a href="#"><span class="number">6.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">6.2</span>Link 2</a></li>
						 </ul>
					  </div>
					</div>

					<div class="panel panel-default">
					   <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse7"><span class="number">7.0</span>Creating Goals</a>
						 
						</h4>
					  </div>
					  <div id="collapse7" class="panel-collapse collapse">
						 <ul class="nav nav-list tree">
							<li><a href="#"><span class="number">7.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">7.2</span>Link 2</a></li>
						 </ul>
					  </div>
					</div>

					<div class="panel panel-default">
					   <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse8"><span class="number">8.0</span>Creating Goals</a>
						 
						</h4>
					  </div>
					  <div id="collapse8" class="panel-collapse collapse">
						 <ul class="nav nav-list tree">
							<li><a href="#"><span class="number">8.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">8.2</span>Link 2</a></li>
						 </ul>
					  </div>
					</div>


					<div class="panel panel-default">
					   <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse9"><span class="number">9.0</span>Creating Goals</a>
						 
						</h4>
					  </div>
					  <div id="collapse9" class="panel-collapse collapse">
						 <ul class="nav nav-list tree">
							<li><a href="#"><span class="number">9.1</span>Link 1</a></li>
							<li><a href="#"><span class="number">9.2</span>Link 2</a></li>
						 </ul>
					  </div>
					</div>

					
				  </div> 

		<script>
			jQuery(function ($) {
				var $active = $('#accordion .panel-collapse.in').prev().addClass('active');
				$active.find('a').append('<span class="right-icons icon-minus pull-right"></span>');
				$('#accordion .panel-heading').not($active).find('a').prepend('<span class="right-icons icon-plus pull-right"></span>');
				$('#accordion').on('show.bs.collapse', function (e)
				{
					$('#accordion .panel-heading.active').removeClass('active').find('.right-icons').toggleClass('icon-plus icon-minus');
					$(e.target).prev().addClass('active').find('.right-icons').toggleClass('icon-plus icon-minus');
				});
				$('#accordion').on('hide.bs.collapse', function (e)
				{
					$(e.target).prev().removeClass('active').find('.right-icons').removeClass('icon-minus').addClass('icon-plus');
				});
			});
		</script>
	
		</div>
	

		<div class="right-main-started lfloat">
			<h1>Creating Goals</h1>
			<div class="started-content">
				<h2>How do I create a goal?</h2>
				<ul>
					<li><span>1.</span><p>Sign in to ZonesPro on the web portal.</p></li>
					<li><span>2.</span><p>Go to Zone and select any zone area of your choice. For eg.: work</p></li>
					<li><span>3.</span><p>Go to Goal name, type your goal that you want to set. <br>For eg.: Sales target of rupees of 10 lakhs</p></li>
					<li><span>3.</span><p>Set Start Date and End Date for the goal.</p></li>
				</ul>
				<div class="imgmobile-right">
					<img src="<?php echo SKIN_URL; ?>images/getting-started.jpg" border="0" alt="">
				</div>
			</div>
		</div>





	</div>
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>	

	</body>
</html>