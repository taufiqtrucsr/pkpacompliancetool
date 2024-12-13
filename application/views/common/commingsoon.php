<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php $this->load->view('common/head_common'); ?>
	<body>
		<div id="barba-wrapper">

			<?php $this->load->view('common/header'); ?>

			<div class="barba-container">
				<div class="o-scroll o-scroll-home" data-module="SmoothScroll" data-scrollbar>
					<main class="c-main-home">	
						  <section class="common-content-page comingsoon">
								<p>The page you are looking for is</p>
								<h2>coming soon</h2>
								<p class="bigfont">stay tuned</p>
								<p><a href="<?php echo base_url();?>">Go back</a></p>
						  </section>
					<?php $this->load->view('common/footer'); ?>

					</main>
				</div>
			</div>
		</div>
		
<?php $this->load->view('common/footer_js'); ?>
	
		
