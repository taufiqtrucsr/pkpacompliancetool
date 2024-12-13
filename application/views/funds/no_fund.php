<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>

<body class="full-page">
	<?php $this->load->view('common/header'); ?>
	<div class="container">
		 <div class="col-md-12">
		 	<?php include('menu.php'); ?>
            <div class="col-sm-9 right-side-bar-dashboard grey-create-project donor-right funding-status">
				<img width="300" src="<?php echo SKIN_URL; ?>images/funds-empty.png">
				<h3>No funds</h3>
				<p>There are no funds being received from any contributor</p>
				<!--a href="<?php //echo BASE_URL ?>create-project"><button class="btn btn-primary create-pro-btn ">Create project</button></a-->

		    </div><!-- funding-status col-sm-9 -->
		</div><!-- col-sm-12 -->
	</div>	
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>
</body>
</html>


