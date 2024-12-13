<?php 
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	// print_r($actual_link);
	if(isset($actual_link)) {
		$CI =& get_instance();
		$CI->load->model('ShorternModel');
		$result = $CI->ShorternModel->getLinksTable($actual_link);
		// print_r($result);
		if($result != '') {
			echo "<script>window.location.href='$result';</script>";
			exit;
			// header('location'.$result);
		}
		// var_dump($result); die();
	}else{
		redirect(base_url());
	} ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_url =& get_instance(); //  get a reference to CodeIgniter
$CurClass = $current_url->router->fetch_class(); // for Class name or controller 
$CurMethod = $current_url->router->fetch_method(); // for method name

?>
<!DOCTYPE html>
<html lang="en-gb">
	<head>
		<title><?php echo (isset($PageTitle) && $PageTitle != '') ? $PageTitle : 'CSR'; ?></title>
		<meta charset="UTF-8">
		<meta name="theme-color" content="#3366cc" />
		<!-- <meta name="theme-color" content="#3366cc"> -->
		<meta name="Generator" content="EditPlus">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		
		<?php if(isset($PageTitle) && $PageTitle != '') {?><meta property="og:title" content="<?=$PageTitle?>"/><?php }?>
        <meta property="og:type" content="website" />

        <?php if(isset($projectData) && $projectData != '' && isset($projectData->identifier)) {?><meta property="og:url" content="<?=base_url()?>donor-project-details/<?=$projectData->identifier?>"/><?php }?>
        
        <?php if(isset($resources) && $resources != '' && isset($resources['id'])) {?><meta property="og:url" content="<?=base_url()?>resource-details/<?=$resources['id']?>"/><?php }?>

        <?php if(isset($projectData) && $projectData != '' && isset($projectData->cover_image)) { ?><meta property="og:image" content="<?=base_url()?>public/uploads/project/cover_image/<?=$projectData->cover_image?>" /><?php }?>

         <?php if(isset($resources) && $resources != '' && isset($resources['cover_image'])) { ?><meta property="og:image" content="<?php echo base_url();?>public/uploads/resources/cover_image/<?php echo $resources['cover_image']?>" /><?php }?>
       
        <?php if(isset($projectData) && $projectData != '' && isset($projectData->project_description)) { ?><meta property="og:description" content="<?php echo strip_tags($projectData->project_description); ?>" /><?php }?>

         <?php if(isset($resources) && $resources != '' && isset($resources['title'])) { ?><meta property="og:description" content="<?=$resources['title']?>" /><?php }?>
		
		
		<?php if(BASE_URL=="https://www.trucsr.in/") { ?>
			<!-- facebook domain verification  -->
			<meta name="facebook-domain-verification" content="q72b1acerbqn7knylpwf6mfu270j62" />
	    <?php } ?>
     
		<link rel="icon" href="/skin/images/favicon.png" type="image/png" sizes="16x16"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="">

		<!-- Bootstrap style -->
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/bootstrap-select.min.css" >
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/bootstrap-editable.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo SKIN_URL; ?>css/style.css?v=<?php echo JS_CSC_V; ?>" media="all">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jqueryvalidation.css">
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/datepicker.css" >
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>jquery-toast/jquery.toast.min.css" >
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
			
		<link rel="stylesheet" href="<?php echo SKIN_URL.'css/owl.carousel.css'; ?>">
		<link rel="stylesheet" href="<?php echo SKIN_URL.'css/owl.theme.css'; ?>">
		
		<script type="text/javascript">  var BASE_URL = '<?php echo BASE_URL; ?>';</script>  
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>		
		<script src="<?php echo SKIN_URL; ?>js/bootstrap.min.js"></script>
		<script src="<?php echo SKIN_URL; ?>js/jquery.validate.min.js"></script>
		<script src="<?php echo SKIN_URL; ?>js/additional-methods.min.js"></script>
		<!--script src="<?php //echo SKIN_URL; ?>js/jquery-validate.bootstrap-tooltip.min.js"></script-->	
		<script src="<?php echo SKIN_URL; ?>jquery-toast/jquery.toast.min.js"></script>
		<script src="<?php echo SKIN_URL; ?>js/common.js?v=<?php echo JS_CSC_V; ?>"></script>
		<script src="<?php echo SKIN_URL; ?>js/custom.js?v=<?php echo JS_CSC_V; ?>"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<script src="<?php echo SKIN_URL; ?>js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo SKIN_URL; ?>js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo SKIN_URL; ?>js/bootstrap-editable.min.js"></script>
		<script type="text/javascript" src="<?php echo SKIN_URL.'js/owl.carousel.js'; ?>"></script>	
			
		<?php if(($CurClass == 'register' && $CurMethod == 'signin') || ($CurClass == 'register' && $CurMethod == 'signup')) { ?>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<?php } ?>
		<?php //echo $this->router->class."---".$this->router->method; ?>
		<?php if(($this->router->class == 'project' && $this->router->method=='createProject') || ($this->router->class == 'register' && $this->router->method=='registration') || ($this->router->class == 'discover' && $this->router->method=='index') || ($this->router->class == 'donation' && $this->router->method=='index') || ($this->router->class == 'ngo' && $this->router->method=='ngoEdit') || ($this->router->class == 'company' && $this->router->method=='companyEdit') || ($this->router->class == 'motivator' && $this->router->method=='createcampaign') || ($this->router->class == 'fundraiser' && $this->router->method=='createcampaign') || ($this->router->class == 'project' && $this->router->method=='editProject') || ($this->router->class == 'project' && $this->router->method=='requestEdit') || ($this->router->class == 'myprofile' && $this->router->method=='getRequestForEditView') || ($this->router->class == 'requestedit' && $this->router->method=='getRequestForEditView') || ($this->router->class == 'companyrequestedit' && $this->router->method=='getContributorRequestForEditView') || ($this->router->class == 'motivator' && $this->router->method=='dashboardpreview') || ($this->router->class == 'fundraiserDashboard' && $this->router->method=='dashboardpreview') || ($this->router->class == 'motivator' && $this->router->method=='editcampaign') || ($this->router->class == 'fundraiser' && $this->router->method=='editcampaign') || ($this->router->class == 'reports' && $this->router->method=='create_progress_report')) { ?>
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css" >


		<script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>	
		<?php }?>
		
		<script type='text/javascript'>
			window.smartlook||(function(d) {
			var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
			var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
			c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
			})(document);
			smartlook('init', '6e825bc2868c29dec0d6ca37a9c699de5a70d474');
		</script>

		<?php if(BASE_URL=="https://www.trucsr.in/") { ?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-NQW8L8N');</script>
			<!-- End Google Tag Manager -->
			
			<!-- Facebook Pixel Code -->
			<!-- Meta Pixel Code -->
			<script>
			!function(f,b,e,v,n,t,s)
			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '357243969313890');
			fbq('track', 'PageView');
			</script>
			<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=357243969313890&ev=PageView&noscript=1"
			/></noscript>
			<!-- End Meta Pixel Code -->
			<!-- End Facebook Pixel Code -->
	    <?php } ?>
		<script>	
			// getLongUrl();				
			getcookie();
			function getcookie(){
				var user_id = '<?php echo $LoggedInUserId    = isset($_SESSION['UserId'])?$_SESSION['UserId']:''; ?>';
				console.log('getcookie');
				$.ajax({
					url: BASE_URL + 'donation/getcookie',
					type: "POST",
					data: {user_id : user_id},
					dataType: "json",
					success:function(response) {
					}
				});
			}	

			// function getLongUrl(){
			// 	var alias = window.location.href;
			// 	console.log('getLongUrl');
			// 	console.log(alias);
			// 	$.ajax({
			// 		url: BASE_URL + 'donation/getLongUrl',
			// 		// url: BASE_URL + 'donation/demo',
			// 		type: "POST",
			// 		data: {alias : alias},
			// 		dataType: "json",
			// 		beforeSend: function() {
			// 		// 	var spinner = $('#loader');
			// 		$('#loader').show();
			// 		 },
			// 		// complete: function() {
			// 		// 	$('#loader').css('display','none');
			// 		// },
			// 		success:function(response) {
			// 			console.log(response.redirect);
			// 			$('#loader').hide();
			// 			setTimeout(function() {
			// 				window.location.href =response.redirect;
			// 			});
			// 		}
			// 	});
			// }
	
		</script>
		<link rel="stylesheet" href="<?php echo SKIN_URL; ?>/css/myprofile.css">
	</head>

