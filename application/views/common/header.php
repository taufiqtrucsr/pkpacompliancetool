<?php
$CI =& get_instance();
$CI->load->model('ResourceModel');
/*
    sanjay oraon
    removed resources_categories table
    $Resource = $CI->ResourceModel->get_single_category();
*/
$Resource = null;

$ActiveRole = $this->session->userdata('ActiveRole');
?>
<?php if (BASE_URL == "https://www.trucsr.in/") { ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQW8L8N" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Facebook Pixel Code -->
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1255816671601684&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
<?php } ?>
<header class="top-header">
    <?php
    if (isset($_SESSION['UserId'])) {
        $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
        //echo $UserDetails->type ."-". $UserDetails->status
        //*******************implementer code*****************************/
        /*
        ----------------START--------------------------
        Sanjay Oraon
        15-06-2023
        Table ngo_details Merged With user_profile
        Table ngo_bord_member Merged With governing_body

       $impsql="SELECT id FROM `ngo_details` WHERE `user_id`='".$UserDetails->id."'";
       $improw =$this->db->query($impsql)->row();
        if(!empty($improw->id)){
             $impsql1="SELECT * FROM `ngo_board_members` WHERE `ngo_id`='".$improw->id."'";
             $impcount =$this->db->query($impsql1)->num_rows();
        }
        */

        if (!empty($UserDetails->profile_id_display)) {
            $impsql1 = "SELECT * FROM `governing_body` WHERE `profile_id`='" . $UserDetails->profile_id_display . "'";
            $impcount = $this->db->query($impsql1)->num_rows();
        }
        /*
        -----------------------END--------------------
        */

        /*********************end********************/
        /****************write condition for discover page*****************/

        /*
         ----------------START--------------------------
         Sanjay Oraon
         15-06-2023
         Table corporate_details Merged With user_profile
         Table corporate_board_members Merged With governing_body

         $sql ="SELECT id FROM `corporate_details` WHERE `user_id`='".$UserDetails->id."'";
         $row =$this->db->query($sql)->row();
         if(!empty($row->id)){
         $sql="SELECT * FROM `corporate_board_members` WHERE `corporate_id`='".$row->id."'";
         $count =$this->db->query($sql)->num_rows();
         }
         */

        if (!empty($UserDetails->profile_id_display)) {
            $sql = "SELECT * FROM `governing_body` WHERE `profile_id`='" . $UserDetails->profile_id_display . "'";
            $count = $this->db->query($sql)->num_rows();
        }
        /*
        -----------------------END--------------------
        */


        /********************end************/

    }
    ?>
    <div class="container">
        <div class="head-align">
            <div class="logo-csr">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo SKIN_URL; ?>images/PKPA_Logo.png"></a>
            </div>
            <div class="right-side-head">

                <!-- header-link -->
                <?php if (isset($_SESSION['UserId'])) { ?>
                    <div class="notification">
                        <?php $this->load->view('common/notifications'); ?>
                        <!-- <span id="countdown"></span> -->
                    </div>
                    <!-- notification-block -->
                <?php } ?>
                <div class="account-info">
                    <?php if (isset($_SESSION['UserId'])) { ?>
                        <div class="profile-icon">
                            <a class="click-profile">
                                <?php
                                if ($UserDetails->user_type == 1) {
                                    /*
                                    Sanjay Oraon
                                    Date 16-09-2023
                                    change function name get_logo and pass $UserDetails->profile_id_display

                                    $NgoData = $this->CommonModel->get_ngobylogo($_SESSION['UserId']);
                                    */
                                    $NgoData = $this->CommonModel->get_logo($UserDetails->profile_id_display);
                                    if (isset($NgoData)) {
                                        $orgName = $NgoData->entity_name;
                                        //   $imageSrc=NGO_LOGO.$NgoData->org_logo; //code commented and add default profile icon
                                        $imageSrc = NGO_LOGO . $NgoData->entity_logo ? $NgoData->entity_logo : 'profile-default.jpg';
                                        /*Sanjay Oraon 
                                        Date 16-09-2023
                                        column removed from db
                                        $waveOf = $NgoData->wave_of;
                                        */
                                    } else {
                                        $orgName = $UserDetails->first_name . ' ' . $UserDetails->last_name;
                                        // $imageSrc = ''; //code commented
                                        $imageSrc = NGO_LOGO . 'profile-default.jpg';
                                        /*Sanjay Oraon 
                                          Date 16-09-2023
                                          column removed from db
                                          $waveOf = '';
                                          */
                                    }
                                } elseif ($UserDetails->user_type == 2) {
                                    /*
                                    Sanjay Oraon
                                    Date 21-09-2023
                                    change function name get_logo and pass $UserDetails->profile_id_display

                                    $ComapnayData = $this->CommonModel->get_companybylogo($_SESSION['UserId']);
                                    */
                                    $ComapnayData = $this->CommonModel->get_logo($UserDetails->profile_id_display);
                                    if (isset($ComapnayData)) {
                                        $orgName = $ComapnayData->entity_name;
                                        //    $imageSrc=COMPANY_LOGO.$ComapnayData->company_logo;  
                                        //   $imageSrc=COMPANY_LOGO.$ComapnayData->company_logo?$ComapnayData->company_logo:'profile-default.jpg';  
                                        $imageSrc = COMPANY_LOGO . $ComapnayData->entity_logo ? $ComapnayData->entity_logo : 'profile-default.jpg';

                                        /*Sanjay Oraon 
                                           Date 21-09-2023
                                           column removed from db
                                           $waveOf = $ComapnayData->wave_of;
                                         */
                                    } else {
                                        $orgName = $UserDetails->first_name . ' ' . $UserDetails->last_name;
                                        // $imageSrc = ''; //code commented
                                        $imageSrc = COMPANY_LOGO . 'profile-default.jpg';
                                        $waveOf = '';
                                    }
                                } else {
                                    $orgName = $UserDetails->first_name . ' ' . $UserDetails->last_name;
                                    $imageSrc = '';
                                    /*Sanjay Oraon 
                                        Date 21-09-2023
                                        column removed from db
                                        $waveOf = '';
                                      */

                                }


                                if (!empty($NgoData->entity_logo)) {
                                    $imageSrc = NGO_LOGO . $NgoData->entity_logo;
                                    //echo "<img width='100' height='100' src='".$imagengoSrc."' >";  
                                } elseif (!empty($ComapnayData->company_logo)) {
                                    $imageSrc = COMPANY_LOGO . $ComapnayData->company_logo;
                                    //echo "<img width='100' height='100' src='".$imageSrc."' >";
                                }

                                if (!empty($NgoData->wave_of)) {
                                    $waveOf = $NgoData->wave_of;
                                } elseif (!empty($ComapnayData->wave_of)) {
                                    $waveOf = $ComapnayData->wave_of;
                                }
                                ?>
                                <img
                                    src="<?php echo ($imageSrc != '') ? SKIN_URL . 'images/profile-default.jpg' : SKIN_URL . 'images/profile-default.jpg'; ?>">
                            </a>
                            <div class="profile-listing-top dropdown-menu">
                                <ul>
                                    <li class="profile-head-info-new">
                                        <div class="profile-head-info-inner"><img width="100" height="100"
                                                src="<?php echo ($imageSrc != '') ? $imageSrc : SKIN_URL . 'images/profile-default.jpg'; ?>">
                                        </div>
                                        <span class="org-name-t"><?php echo $orgName; ?></span>
                                        <span class="org-name-m">+91-<?php echo $UserDetails->phone_no; ?></span>
                                    </li>
                                    <li><a href="<?php echo base_url() . 'logout'; ?>">Log out</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php } else {
                        echo '<a  id="login_nav_bar_homepage"  class="border-link" href="' . base_url() . 'signup">Login</a>';
                    } ?>
                </div>
                <!-- account-info -->
            </div>
        </div>

        <!-- right-side-head -->
    </div>


</header>
<input type="hidden" id="short_url_id" value="" name="short_url_id">
<script type="text/javascript">
    $('#campaign_dropdown').change(function () {
        campaignDropdown();
    });
</script>