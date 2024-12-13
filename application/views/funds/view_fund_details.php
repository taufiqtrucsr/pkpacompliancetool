<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>

<body class="full-page">
	<?php $this->load->view('common/header'); ?>
	<div class="container">
		<div class="col-md-12" id="">
			<?php include('menu.php'); ?>
			<div class="col-sm-9 right-side-bar-dashboard grey-create-project donor-right funding-status">
				<?php include('fund_details.php'); ?>
			</div><!-- funding-status col-sm-9 -->
		</div><!-- col-sm-12 -->
	</div>
	<?php include('fund_received_popup.php'); ?>
	<?php include('fund_utilized_popup.php'); ?>
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>
</body>
</html>
<script>
	function selectProject(){
		$('#projectFundForm').submit();
	}
</script>
