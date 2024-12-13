<script type="text/javascript" src="<?php echo SKIN_URL;?>js/jquery.mCustomScrollbar.js"></script>
<?php if(($this->router->class == 'project' && $this->router->method=='createProject') || ($this->router->class == 'register' && $this->router->method=='registration') || ($this->router->class == 'discover' && $this->router->method=='index') || ($this->router->class == 'donation' && $this->router->method=='index') || ($this->router->class == 'ngo' && $this->router->method=='ngoEdit') || ($this->router->class == 'company' && $this->router->method=='companyEdit') || ($this->router->class == 'motivator' && $this->router->method=='createcampaign') || ($this->router->class == 'fundraiser' && $this->router->method=='createcampaign') || ($this->router->class == 'project' && $this->router->method=='editProject') || ($this->router->class == 'project' && $this->router->method=='requestEdit') || ($this->router->class == 'myprofile' && $this->router->method=='getRequestForEditView') || ($this->router->class == 'requestedit' && $this->router->method=='getRequestForEditView') || ($this->router->class == 'companyrequestedit' && $this->router->method=='getContributorRequestForEditView') || ($this->router->class == 'motivator' && $this->router->method=='dashboardpreview') || ($this->router->class == 'fundraiserDashboard' && $this->router->method=='dashboardpreview') || ($this->router->class == 'motivator' && $this->router->method=='editcampaign') || ($this->router->class == 'fundraiser' && $this->router->method=='editcampaign') || ($this->router->class == 'reports' && $this->router->method=='create_progress_report')) { ?>		
		<script type="text/javascript">
		$(document).ready(function () {
			$( ".ms-options label" ).append( "<span class='check'></span>" );
		});
		</script>	
	
	<script type="text/javascript" src="<?php echo base_url();?>skin/tinymce/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/tinymce/init.js"></script>
<?php }?>

<!-- Main Quill library -->
	<script src="<?php echo SKIN_URL; ?>js/quill/quill.js"></script>
	<script src="<?php echo SKIN_URL; ?>js/quill/quill.min.js"></script>

<!-- Theme included stylesheets -->
	<link href="<?php echo SKIN_URL; ?>css/quill.snow.css" rel="stylesheet">
	<link href="<?php echo SKIN_URL; ?>css/quill.bubble.css" rel="stylesheet">
	
<!-- Initialize Quilljs editor -->
	<script type="text/javascript" src="<?php echo SKIN_URL; ?>js/quill/quill-textarea.js"></script>	
	<script type="text/javascript" src="<?php echo SKIN_URL; ?>js/quill/form-quilljs.init.js"></script>	
	<!-- <script type="text/javascript" src="<?php echo SKIN_URL; ?>js/quill/form-quilljs.init_duplicate.js"></script>	 -->
	
