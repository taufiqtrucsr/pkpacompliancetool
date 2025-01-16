<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$FooterBlock1 = $this->CommonModel->getCMSPageDataByIdentifier('footer-block1');
$FooterBlock2 = $this->CommonModel->getCMSPageDataByIdentifier('footer-block2');
$FooterBlock3 = $this->CommonModel->getCMSPageDataByIdentifier('footer-block3');

?>
<style type="text/css">
	
#orgVerifyPopup .radio-box input[type="radio"]:checked+label:after {
    left: 26px;
    top: 19.9px;
}
	
/*.radio-box input[type="radio"]:checked+label:after {

     margin-top: 1px;
    display: block;
    content: "";
    display: inline-block;
    width: 25px;
    height: 25px;
    padding: 6px;
    float: left;
    background: #36c;
    border-radius: 100%;
    position: absolute;
    margin-top: 1.5px;
    margin-left: 0.5px;
}
*/

.radio-box input[type="radio"]:checked+label:after {
    content: "";
    display: inline-block;
    width: 5px;
    height: 5px;
    padding: 4px;
    float: left;
    background: #36c;
    border-radius: 100%;
    position: absolute;
    margin-top: 1px;
    margin-left: 0px;
}

.radio-box input[type="radio"]:checked+label:before {
    border: 3px solid #36c;
}
</style>
	<footer class="footer footer-static" style="margin-top: 2%;">
		<div class="container">			
			<div class="col-sm-12">			
				<div class="row">		
					<?php if(isset($FooterBlock1->content)) echo $FooterBlock1->content; ?>	
					<?php if(isset($FooterBlock2->content)) echo $FooterBlock2->content; ?>		
					<?php if(isset($FooterBlock3->content)) echo $FooterBlock3->content; ?>			
				</div><!-- row -->			
			</div><!-- col-sm-12 -->					
		</div><!-- container -->	
	</footer>

	<div class="cookie-policy" style="">
	<div class="cookie-container">
		<p class="cookie-link">
			We use cookies to personalize and improve your browsing experience on our site, analyse traffic and personalize content. 
			By browsing this website, you are accepting the terms & conditions.</p>
		<div class="btn-cookie"> 
		   <span class="close-cookie blue-btn-discover">ACCEPT
		   </span>
		</div>
	</div>
	</div>	
	
<!-- Modal - VerificationPopup -->
<div class="modal fade" id="orgVerifyPopup" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you an Implementer or a Contributor?<br>Please Select</h4>
        </div>
        <div class="modal-body">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-6">
					<div class="radio-box"><input type="radio" value="1" name="org_type" checked="checked"/> <label> Implementer </label></div>
				</div>
				<div class="col-sm-6">
					<div class="radio-box"><input type="radio" value="2" name="org_type"/> <label>Contributor</label> </div>
				</div>
			</div>
		</div>
        <div class="modal-btn-sec">
			<button class="btn btn-primary" onclick="updateOrgType();">Proceed to verification</button>
        </div>
      </div>
      
    </div>
</div>
</div>

<!-- Modal - Motivator and Fundraiser VerificationPopup -->
<div class="modal fade" id="campVerifyPopup" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you an Motivator or a Fundraiser?<br>Please Select</h4>
        </div>
        <div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-6">
					<div class="radio-box"><input type="radio" value="3" name="user_type" checked="checked"/> <label> Motivator </label></div>
				</div>
				<div class="col-sm-6">
					<div class="radio-box"><input type="radio" value="4" name="user_type"/> <label>Fundraiser</label> </div>
				</div>
			</div>
		</div>
        <div class="modal-btn-sec">
			<button class="btn btn-primary" onclick="updateUserType();">Proceed</button>
        </div>
      </div>
      
    </div>
</div>
</div>

<?php if(isset($UserDetails)){?>
<!-- Modal - TermsConditionPopup -->
<div class="modal fade" id="termsConditionsPopup" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Terms & Conditions</h4>
		</div>
		<div class="modal-body">
		<div class="col-sm-12">
			<div class="row">
				<h4 class="modal-title">To continue, you must agree to the truCSR<br>
				<?php 
					if($UserDetails->type == 1){
						$href = '/page/implementer-terms-conditions';
					}else if($UserDetails->type == 2){
						$href = '/page/contributor-terms-conditions';
					}else{
						$href ='';
					}
				?>
				<a href="<?php echo $href; ?>" target="_blank">Terms & Conditions.</a>
				</h4>
			</div>
		</div>
		<div class="modal-btn-sec">
			<div class="col-sm-6">
				<button class="btn" data-dismiss="modal">Cancel</button>
			</div>
			<div class="col-sm-6">
				<button id="step-3-submit" class="btn btn-primary btn-lg" onclick="sendForVerification(<?php echo $UserDetails->id; ?>);">Agree & Continue</button>
			</div>
		</div>
		</div>
	  
		</div>
	</div>
</div>
<?php }?>

<!-- Modal - Common Popup -->
<div class="modal fade" id="truCSRModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" id="truCSRModalContent">
			
		</div>
	</div>
</div>

<?php if(isset($UserDetails)){?>
<!-- Modal - InfoPopup -->
<div class="modal fade" id="orgFreezedInfoPopup" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h5 class="modal-title">
			<div>
				<?php if($UserDetails->type == 1 && $UserDetails->status == 8){
				$ngoData = $this->NgoModel->GetUserNgoInfo($_SESSION['UserId']);
				?>
				<p><?php echo $ngoData->org_name ;?>, your account is under review by the admin. <br>This could be due to the recent changes in your profile related to:</p>
				<br>
				<ul>
					<li>GST Details</li>		
					<li>80G Details</li>		
					<li>FCRA Details</li>		
					<li>35 AC Details or</li>		
					<li>Financial Details</li>		
				</ul>
				<?php }else if($UserDetails->type == 2 && $UserDetails->status == 8){
				$companyData =$this->CompanyModel->GetUserCompanyInfo($_SESSION['UserId']);
				?>
				<p><?php echo $companyData->company_name ;?>, your account is under review by the admin. <br>This could be due to the recent changes in your profile related to:</p>
				<ul>
					<li>GST Details</li>	
				</ul>
				<?php }else{ if(isset($ngoDetails->org_name)){?>
				<p><?php echo $ngoDetails->org_name;?>'s account is under review by the admin. <br>This could be due to the recent changes in their profile related to:</p>
				<br>
				<ul>
					<li>GST Details</li>		
					<li>80G Details</li>		
					<li>FCRA Details</li>		
					<li>35 AC Details or</li>		
					<li>Financial Details</li>		
				</ul>
				<?php } } ?>
				<br>
				<p class="freeze-info">In case of any queries, please contact the admin at <a href="mailto:info@trucsr.in">info@trucsr.in</a></p>
				<br>
			</div>
			</h5>
		</div>
		</div>
	</div>
</div>	
<!-- Modal - Common View Popup -->
<div class="modal fade center" id="truCSRModalView" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
	<!--Content-->
    <div class="modal-content">
		<!--Body-->
		<div class="modal-body">

        <!--Google map-->
        <div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" id="iframe" src="" allowfullscreen="true"></iframe>
		</div>
		</div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-primary btn-md" data-dismiss="modal">Close</button>
      </div>

    </div>
    <!--/.Content-->
	</div>
</div>
<?php } ?>
<div id="loader"></div>
