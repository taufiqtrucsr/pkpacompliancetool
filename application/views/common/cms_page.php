<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('common/head_common'); ?>

 <body class="cms-page home-bkg <?php echo ($CMSData->id == 2 || $CMSData->id == 3) ? 'cms-contents' : ''; ?> <?php echo isset($UserDetails) ? "" : "home-index"; ?>">
	<?php $this->load->view('common/header'); ?>
	
	<div class="main-wrapper ">
		<div class="main-container clearfix">
			<div class="cmspage-table">
				<div class="content-headname"><strong><?php echo $CMSData->title; ?></strong></div>
				<div class="content-page"><?php echo $CMSData->content; ?></div>
			</div>
		</div>
	</div>


	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>	

	</body>
</html>