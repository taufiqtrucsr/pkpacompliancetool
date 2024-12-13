<?php 
    $CI =& get_instance();
    $CI->load->model('ResourceModel');  
    /*
        sanjay oraon
        removed resources_categories table
        $Resource = $CI->ResourceModel->get_single_category();
    */
    $Resource = null;
?>
<?php if(BASE_URL=="https://www.trucsr.in/") { ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQW8L8N"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Facebook Pixel Code -->
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1255816671601684&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<?php } ?>
<header class="top-header new_header">
    <?php 
      if(isset($_SESSION['UserId']))
      {
        $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);              
        //echo $UserDetails->type ."-". $UserDetails->status
        //*******************implementer code*****************************/
        /*
        ----------------START--------------------------
        Sanjay Oraon
        19-06-2023
        Table ngo_details Merged With user_profile
        Table ngo_bord_member Merged With governing_body

       $impsql="SELECT id FROM `ngo_details` WHERE `user_id`='".$UserDetails->id."'";
       $improw =$this->db->query($impsql)->row();
        if(!empty($improw->id)){
             $impsql1="SELECT * FROM `ngo_board_members` WHERE `ngo_id`='".$improw->id."'";
             $impcount =$this->db->query($impsql1)->num_rows();
        }
        */

        if(!empty($UserDetails->profile_id_display)){
                $impsql1="SELECT * FROM `governing_body` WHERE `profile_id`='".$UserDetails->profile_id_display."'";
                $impcount =$this->db->query($impsql1)->num_rows();
        }
        /*
        -----------------------END--------------------
        */
       /*********************end********************/
       /****************write condition for discover page*****************/
    /*
        ----------------START--------------------------
        Sanjay Oraon
        20-06-2023
        Table corporate_details Merged With user_profile
        Table corporate_board_members Merged With governing_body

        $sql ="SELECT id FROM `corporate_details` WHERE `user_id`='".$UserDetails->id."'";
        $row =$this->db->query($sql)->row();
        if(!empty($row->id)){
        $sql="SELECT * FROM `corporate_board_members` WHERE `corporate_id`='".$row->id."'";
        $count =$this->db->query($sql)->num_rows();
        }
        */
       
        if(!empty($UserDetails->profile_id_display)){
            $sql="SELECT * FROM `governing_body` WHERE `profile_id`='".$UserDetails->profile_id_display."'";
            $count =$this->db->query($sql)->num_rows();
            }
            /*
            -----------------------END--------------------
            */
     
     /********************end************/

      }
      ?>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
   <div class="logo-csr">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo SKIN_URL; ?>images/truCSR_logo.png"></a>
            <?php if(isset($_SESSION['UserId']) && $UserDetails->current_active_role == 1) { ?>
            <div class="login-not-reg">IMPLEMENTER</div>
            <?php } else if(isset($_SESSION['UserId']) && $UserDetails->current_active_role == 2) { ?>
            <div class="login-not-reg">CONTRIBUTOR</div>
            <?php } else if(isset($_SESSION['UserId']) && $UserDetails->current_active_role == 3) { ?>
            <div class="login-not-reg">MOTIVATOR</div>
            <?php } else if(isset($_SESSION['UserId']) && $UserDetails->current_active_role == 4) {  ?>
            <div class="login-not-reg">FUNDRAISER</div>

            <?php } else if(isset($_SESSION['UserId']) && $UserDetails->current_active_role == 6) {  ?>
            <div class="login-not-reg">DONOR</div>

            <?php } else if(isset($_SESSION['UserId']) && $UserDetails->current_active_role == 7) {  ?>
            <div class="login-not-reg">CONTRIBUTOR (NON-CSR)</div>
      
            <?php } else if(isset($_SESSION['UserId']) && $UserDetails->current_active_role == 5) {  ?>
            <div class="login-not-reg">MOTIVATOR</div>
            <?php } ?>
        </div>
		<form class="srch_bar form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2 search_nav" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
</button>
    </form>
    <ul class="menuitem">
    <li class="sub-menu-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Explore a cause  <i class="fa fa-chevron-down" aria-hidden="true"></i>
</a>
                        <ul class="submenu-item-nav dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a href="https://trucsr.blogspot.com" target="_blank">Blog</a></li>
                            <li><a href="<?php echo base_url().'newsletter';?>">Newsletter</a></li>
                            <!--
                                sanjay oraon
                                removed resources_categories table
                                <li><a href="<?php echo base_url().'resource/'.$Resource->id;?>">Knowledge Center</a></li>
                             -->
                            <!-- <li><a href="< ?php echo base_url().'resource/'.$Resource->id;?>">Resource</a></li> -->
                        </ul>
                    </li>
    </ul>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i>
</span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
   <div class="right-side-head">
            <div class="header-link">
                <ul class="menuitem">
                    <li><a href="#">Why truCSR?</a></li>
                    <li><a href="#">Services</a></li>
            </ul>
                <ul class="menuitem-1">
                    <?php if(isset($_SESSION['UserId']) && $UserDetails->user_type == 1 && $UserDetails->user_status == 1 ) { ?>
                    
                    <!--permission set by create projects-->
                     <?php if(!empty($impcount)) { ?>
                    <li><a class="create-project" href="<?php  echo base_url().'create-project'; ?>">Create Project</a></li>
                     <?php } else if(!empty($count)) {?>
                    <li><a class="create-project" href="<?php  echo base_url().'create-project'; ?>">Create Project</a></li>
                       <?php }?>  
                    <!-- end -->
                   <?php } elseif (isset($_SESSION['UserId']) && $UserDetails->user_type == 3 ) { ?>
                    <li><a class="create-project" href="<?php  echo base_url().'create-campaign'; ?>">Create Campaign</a></li>
                    <?php } elseif (isset($_SESSION['UserId']) && $UserDetails->user_type == 4 ) { ?>
                    <li><a class="create-project" href="<?php  echo base_url().'fundraiser-create-campaign'; ?>">Create Campaign</a></li>
                    <?php } elseif(isset($_SESSION['UserId']) && $UserDetails->user_type == 0 )  { ?>
                    <li><a class="create-project" href="javascript:void(0)" onclick="openCampaignPopup();">Create Campaign</a>
                    </li>
                    <?php } ?>
                    <?php if(!empty($count)) { ?>
                      <?php if(isset($_SESSION['UserId']) && $UserDetails->user_type == 2 && $UserDetails->user_status == 1 ) { ?>
                    <li><a class="create-project" href="<?php  echo base_url().'discover'; ?>">Discover</a></li>
                      <?php }?>
                  <?php } ?>

                    <li class="sub-menu-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Resources</a>
                        <ul class="submenu-item-nav dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a href="https://trucsr.blogspot.com" target="_blank">Blog</a></li>
                            <li><a href="<?php echo base_url().'newsletter';?>">Newsletter</a></li>
                            <!--
                                sanjay oraon
                                removed resources_categories table
                                <li><a href="<?php echo base_url().'resource/'.$Resource->id;?>">Knowledge Center</a></li>
                             -->
                            <!-- <li><a href="< ?php echo base_url().'resource/'.$Resource->id;?>">Resource</a></li> -->
                        </ul>
                    </li>
                    <?php if(isset($_SESSION['UserId']) && ($UserDetails->user_status == 1  || $UserDetails->user_status == 8)) { ?>
                       
                        <?php if($UserDetails->user_type == 1 || $UserDetails->user_type == 2) { ?>
                     <!--implementer and discover code written by rajesh-->
                        <?php if(!empty($impcount)) { ?>
                        <li><a href="<?php echo base_url().'dashboard/projects/'; ?>">My Dashboard</a></li>
                      <?php } else if(!empty($count)) { ?>
                        <li><a href="<?php echo base_url().'dashboard/projects/'; ?>">My Dashboard</a></li>
                      <?php }?>
                       <!-- end code-->

                        <?php } ?>
                        <?php } ?>
                        <?php if(isset($_SESSION['UserId']) && $UserDetails->user_type == 3) { ?>
                        <li><a href="<?php echo base_url().'motivator/campaigns/'; ?>">My Dashboard</a></li>
                        <?php } else if(isset($_SESSION['UserId']) && $UserDetails->user_type == 4) { ?>
                        <li><a href="<?php echo base_url().'fundraiser/campaigns/'; ?>">My Dashboard</a></li>
                        <?php } else if(isset($_SESSION['UserId']) && $UserDetails->user_type == 6) { ?>
                        <li><a href="<?php echo base_url().'donation/dashboard/'.$_SESSION['UserId']; ?>">My Dashboard</a></li>
                        <?php } ?>
                    <li><a href="<?php echo base_url().'contact'; ?>">Contact</a></li>
                    <li><a id="donate_for_cause_nav_bar_homepage" href="<?php echo base_url().'donation/'; ?>">Donate For A Cause</a></li>
                </ul>
            </div>
            <!-- header-link -->
            <?php if(isset($_SESSION['UserId'])) { ?>
            <div class="notification">
                <?php $this->load->view('common/notifications'); ?>
                <!-- <span id="countdown"></span> -->
            </div>
            <!-- notification-block -->
            <?php } ?>
            <div class="account-info">
                <?php if(isset($_SESSION['UserId'])) {  ?>
                <div class="profile-icon">
                    <a class="click-profile">
                        <?php
                  if($UserDetails->user_type == 1) {
                     /*
                    Sanjay Oraon
	                Date 16-09-2023
	                change function name get_logo and pass $UserDetails->profile_id_display

                    $NgoData = $this->CommonModel->get_ngobylogo($_SESSION['UserId']);
                    */
                   $NgoData = $this->CommonModel->get_logo($UserDetails->profile_id_display);
                                  if(isset($NgoData)){
                      $orgName = $NgoData->entity_name;
                    //   $imageSrc=NGO_LOGO.$NgoData->org_logo; //code commented and add default profile icon
                      $imageSrc=NGO_LOGO.$NgoData->entity_logo?$NgoData->entity_logo:'profile-default.jpg';
                  /*Sanjay Oraon 
                      Date 16-09-2023
                      column removed from db
                      $waveOf = $NgoData->wave_of;
                      */
                                  }else{
                    $orgName = $UserDetails->first_name.' '.$UserDetails->last_name;
                    // $imageSrc = ''; //code commented
                    $imageSrc =NGO_LOGO.'profile-default.jpg';
                  $waveOf = '';
                                  }
                  }elseif($UserDetails->user_type == 2) {
                     /*
                    Sanjay Oraon
	                Date 21-09-2023
	                change function name get_logo and pass $UserDetails->profile_id_display

                    $ComapnayData = $this->CommonModel->get_companybylogo($_SESSION['UserId']);
                    */
                   $ComapnayData = $this->CommonModel->get_logo($UserDetails->profile_id_display);
        
                   if(isset($ComapnayData)){
                       $orgName = $ComapnayData->company_name;
                    //    $imageSrc=COMPANY_LOGO.$ComapnayData->company_logo;  
                    $imageSrc=COMPANY_LOGO.$ComapnayData->company_logo?$ComapnayData->company_logo:'profile-default.jpg';  
                  $waveOf = $ComapnayData->wave_of;
                   }else{
                    $orgName = $UserDetails->first_name.' '.$UserDetails->last_name;
                    // $imageSrc = ''; //code commented
                    $imageSrc =COMPANY_LOGO.'profile-default.jpg';
                  $waveOf= '';
                   }
                  }else{
                  $orgName = $UserDetails->first_name.' '.$UserDetails->last_name;
                  $imageSrc = '';
                  $waveOf = '';
                  }
                  
                  
                  if(!empty($NgoData->org_logo))
                  { 
                  $imageSrc=NGO_LOGO.$NgoData->org_logo;
                  //echo "<img width='100' height='100' src='".$imagengoSrc."' >";  
                  }
                  elseif(!empty($ComapnayData->company_logo))   
                  {
                  $imageSrc=COMPANY_LOGO.$ComapnayData->company_logo;   
                  //echo "<img width='100' height='100' src='".$imageSrc."' >";
                  }
                  
                  if(!empty($NgoData->wave_of))
                  { 
                  $waveOf=$NgoData->wave_of;
                  }
                  elseif(!empty($ComapnayData->wave_of))    
                  {
                  $waveOf=$ComapnayData->wave_of;   
                  }
                  ?>
                        <img src="<?php echo ($imageSrc != '')?$imageSrc:SKIN_URL.'images/profile-default.jpg';?>">
                    </a>
                    <div class="profile-listing-top dropdown-menu">
                        <ul>
                            <li class="profile-head-info-new">
                                <div class="profile-head-info-inner"><img width="100" height="100"
                                        src="<?php echo ($imageSrc != '')?$imageSrc:SKIN_URL.'images/profile-default.jpg';?>">
                                </div>
                                <span class="org-name-t"><?php echo $orgName ;?></span>
                                <span class="org-name-m">+91-<?php echo $UserDetails->phone_no ;?></span>
                            </li>
                            <li><a href="<?php echo base_url().'myprofile'; ?>">My profile</a></li>

                            <a href="<?php echo base_url('user/motivator'); ?>">- Motivator</a>

                            <li><a class="#" href="<?php echo base_url('register/user_type'); ?>"><span>Switch Account</span></a></li>

                            <li style="display:none;"><a class="swtich-account"><span>Switch Account</span> <i class="fa fa-chevron-down"></i></a>

                            <ul class="swtich-account-item">

                                    <?php if ($UserDetails->type == 1) {  
                                            $GetContributorByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],2);
                                            // print_r($GetUserByRoleIdTable);  
                                       if (isset($GetContributorByRoleIdTable) && $GetContributorByRoleIdTable->role_id == 2 && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/contributer'); ?>">- Contributors</a></li>
                                        <?php } else{?>
                                        <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">- Contributors</a></li> -->
                                        <!-- <li><a href="< ?php echo base_url('user/contributer'); ?>">- Contributors</a></li> -->
                                        <!-- <input type="radio" value="2" name="org_type"/> -->
                                        <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="2" name="org_type"/>- Contributor</a><br></button>
                                        <?php } ?>
                                        <li><a href="<?php echo base_url('user/motivator'); ?>">- Motivator</a></li>
                                        <li><a href="<?php echo base_url('user/fundraiser'); ?>">- Fundraiser</a></li>
                                        <li><a href="<?php echo base_url('user/donor'); ?>">- Donor</a></li>
                                    <?php }elseif($UserDetails->type == 2){
                                            $GetUserByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],1);
                                            // print_r($GetUserByRoleIdTable);  
                                       if (isset($GetUserByRoleIdTable) && $GetUserByRoleIdTable->role_id == 1  && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/implementer'); ?>">- Implementer</a></li>
                                        <?php }else{?>
                                        <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">-Implementer</a></li> -->                                       
                                            <!-- <input type="text" value="1" name="org_type" style="display:none"> -->
                                            <!-- <input type="radio" value="1" name="org_type"/> -->
                                            <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="1" name="org_type"/>- Implementer</a><br></button>
                                        <?php } ?>
                                        <li><a href="<?php echo base_url('user/motivator'); ?>">- Motivator</a></li>
                                        <li><a href="<?php echo base_url('user/fundraiser'); ?>">- Fundraiser</a></li>
                                        <li><a href="<?php echo base_url('user/donor'); ?>">- Donor</a></li>
                                    <?php } 
                                
                                    if($UserDetails->type == 3){  
                                       //if ($UserDetails->type == 1) { 
                                        $GetUserByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],1);
                                        if (isset($GetUserByRoleIdTable) && $GetUserByRoleIdTable->role_id == 1 && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/implementer'); ?>">- Implementer</a></li>
                                        <?php } else {?>
                                            <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">-
                                                Implementer</a></li> -->
                                            <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="1" name="org_type"/>- Implementer</a><br></button>
                                            
                                       <?php }
                                        // elseif ($UserDetails->type == 2) {
                                        $GetContributorByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],2);
                                        if (isset($GetContributorByRoleIdTable) && $GetContributorByRoleIdTable->role_id == 2 && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/contributer'); ?>">- Contributor</a></li>
                                        <?php } else{?>
                                            <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">-
                                                Contributor</a></li> -->
                                            <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="2" name="org_type"/>- Contributor</a><br></button>
                                        <?php } ?>
                                        <li><a href="<?php echo base_url('user/fundraiser'); ?>">- Fundraiser</a></li>
                                        <li><a href="<?php echo base_url('user/donor'); ?>">- Donor</a></li>

                                    <?php }elseif($UserDetails->type == 4){ 

                                        $GetUserByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],1);
                                        if (isset($GetUserByRoleIdTable) && $GetUserByRoleIdTable->role_id == 1 && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/implementer'); ?>">- Implementer</a></li>
                                        <?php } else {?>
                                            <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">-
                                                Implementer</a></li> -->
                                            <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="1" name="org_type"/>- Implementer</a><br></button>
                                       <?php }
                                        // elseif ($UserDetails->type == 2) {
                                        $GetContributorByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],2);
                                        if (isset($GetContributorByRoleIdTable) && $GetContributorByRoleIdTable->role_id == 2 && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/contributer'); ?>">- Contributor</a></li>
                                        <?php } else{?>
                                        <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">-
                                                Contributor</a></li> -->
                                            <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="2" name="org_type"/>- Contributor</a><br></button>
                                        <?php } ?>
                                        <li><a href="<?php echo base_url('user/motivator'); ?>">- Motivator</a></li>
                                        <li><a href="<?php echo base_url('user/donor'); ?>">- Donor</a></li>

                                    <?php }elseif($UserDetails->type == 6){  

                                        $GetUserByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],1);
                                        if (isset($GetUserByRoleIdTable) && $GetUserByRoleIdTable->role_id == 1 && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/implementer'); ?>">- Implementer</a></li>
                                        <?php } else {?>
                                        <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">-
                                                Implementer</a></li> -->
                                            <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="1" name="org_type"/>- Implementer</a><br></button>
                                            
                                       <?php }
                                        $GetContributorByRoleIdTable = $this->UserModel->GetUserByRoleIdTable($_SESSION['UserId'],2);
                                        if (isset($GetContributorByRoleIdTable) && $GetContributorByRoleIdTable->role_id == 2 && $UserDetails->user_status == 1) { ?>
                                        <li><a href="<?php echo base_url('user/contributer'); ?>">- Contributor</a></li>
                                        <?php } else{?>
                                        <!-- <li><a href="javascript:void(0)" onclick="openVerificationPopup();">-
                                                Contributor</a></li> -->
                                            <button onclick="updateOrgType();" class="switch_user_btn"><br><a value="testing"><input type="radio" value="2" name="org_type"/>- Contributor</a><br></button>
                                        <?php } ?>
                                        <li><a href="<?php echo base_url('user/motivator'); ?>">- Motivator</a></li>
                                        <li><a href="<?php echo base_url('user/fundraiser'); ?>">- Fundraiser</a></li>
                                    <?php  } ?>
                                </ul>
                            </li>
                            <?php if($UserDetails->user_status == 5 || $UserDetails->user_status == 6 || ($UserDetails->user_status == 1 && $waveOf == 0)){?>
                                <li><a href="<?php echo base_url().'payment'; ?>">My payment</a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url().'logout'; ?>">Log out</a></li>
                        </ul>
                    </div>
                </div>
                <?php } else {
               echo '<a  id="login_nav_bar_homepage"  class="border-link" href="'.base_url().'signup">Login</a>';   
               } ?>
            </div>
            <!-- account-info -->
        </div>
        <!-- right-side-head -->
  </div>
</nav>
    </div>


</header>
<input type="hidden" id="short_url_id" value="" name="short_url_id">
<script type="text/javascript">
$('#campaign_dropdown').change(function() {
    campaignDropdown();
});
</script>
