<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('common/head_common'); ?>
  <style>
    .sub_container{
        color:black;
        margin:auto;
        background:white;
        height:270px;
        width:220px;
        border-radius:5px;
        border:1.5px solid #ffff;
        /* border:1px solid #3366cc; */
    }
    .current_act_btn{
        border:1.5px solid #3366cc;
        border-radius:5px;
    }
    .submit_user:hover {
        background-color: #3366cc;
    }
    .btn:focus, .btn.Focus {
     outline: 0;
    }
    .footer{
        display:none;
    }
    .main_container{
        background: #E5E5E5;
        text-align: center;
        display: flex;
        justify-content: center;
        padding: 60px 0px;
        font-family: averta_regular;
    }
    .full-page .col-md-12{
        background:#E5E5E5;
    }
    .full-page{
        background:#E5E5E5;
    }
    .main_title{
        color: #7082A9;
        font-size: 24px;
        font-family: averta_regular;
    }

    /* .content_container{
      position: absolute;
    bottom: 11px;
    width: 86%;
    text-align: center;
    } */
    [type=radio] {
  position: absolute;
  opacity: 0;
  width: 100%;
  height: 100%;
  cursor: pointer;
}
/* media query start here */
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
  /* .full-page {background: red !important;} */
  .main_container{
    display:contents;
  }
  .sub_container{
    margin-bottom:20px;
    margin-top:20px;
  }
  body{
    font-size:12px;
  }
  .main_title{
    font-size:20px;
  }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  /* .full-page {background: green !important;} */
  .main_container{
    display:contents;
  }
  .sub_container{
    margin-bottom:20px;
    margin-top:20px;
  }
  body{
    font-size:14px;
  }
  
}
.error{
  display: none;
  margin-top: 15px;
}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  /* .full-page {background: blue !important;} */
  /* .sub_container{
    height:290px;
    width:200px;
  }
  body{
    font-size:12px ;
  } */
  .main_container{
    display:grid;
  }
} 

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  /* .full-page {background: orange !important;} */
  .main_container{
    display:flex;
    padding: 60px 0px;
  }
  body{
    font-size:13px;
  }
  
  
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  /* .full-page {background: pink !important;} */
  .main_container{
    display:flex;
    padding: 41px 0px !important;
  }
}


/* media query ends here */

/* CSS FOR CURSOR POINT */
label {
    width: 100%;
}

.card-input-element {
    display: none;
}

.card-input {
    margin: 10px;
    padding: 00px;
}

.card-input:hover {
    cursor: pointer;
}

.card-input-element:checked + .card-input {
     box-shadow: 0 0 1px 1px #2ecc71;
 }
.full-width-footer 
{
    background: #fff;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 135px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.submit_user{
    width: 200px;
    height: 40px;
    border-radius: 5px;
    background: #3366CC;
}
/* CSS FOR CURSOR POINT ENDS HERE */
  </style>
 <!-- <body class="full-page" style="background:#E5E5E5;"> -->
 <body class="full-page">
	<?php $this->load->view('common/header'); ?>	
    <!-- code start here for ui part -->
    <div class="container" style="padding:50px;">
      <?php if(isset($_SESSION['UserId']))
      {
        $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);              
      }
      ?>
        <div class="text-center">
            <P class="main_title">Whats your purpose?</P>
        </div>
        <input type="hidden" name="user_type" value="3" />
        <div class="col-md-12 main_container purpose_type_content">
            <div class="col-sm-12">
                <div class="wrap_entity">
                    <div class="col-xl-12 entity_type_center">
                        <div class="col-md-5 purpose_type purpose_type_left"  data="button_data">  
                            <div class="wrap_flex">
                                <input type="checkbox" value="1" name="purpose_entity_1" checked="checked" id="purpose_entity_1">
                                <img src="<?php echo SKIN_URL; ?>images/raising_funds.svg" alt="" style="padding:10px;">  
                                <div class="content_container card-input">
                                    <p><b>Raising Funds</b></p>
                                    <p>Help raise funds towards a project through your influence </p>
                                    <br>
                                </div>
                            </div>          
                        </div>
                        <div class="col-sm-5 purpose_type purpose_type_right" data="button_data">
                            <div class="wrap_flex">
                                <input type="checkbox" value="2" name="purpose_entity_2" id="purpose_entity_2" checked>
                                <img src="<?php echo SKIN_URL; ?>images/hands.svg" alt="" style="padding:10px;">
                                <div class="content_container card-input">
                                    <p><b>Promote Volunteering</b></p>
                                    <p>Create volunteering awareness through your influence </p>
                                    <br>
                                </div>
                            </div>
                      </div>
                     
                    <!-- </div>
                    <div class="col-12 pt-3">
                       <label id="error" for="error" class="error"></label> -->
                    </div>
                    <div class="error text-danger">Please Choose Your Purpose</div>
                </div>
              
            </div>      
        </div>
        <div class="full-width">
            <div class="col-sm-12"  style="margin-top:150px;">
                <div class="wrap_flex_btn">
                  <div class="text-center" id="submit_org" style="display:block;">
                    <button class="btn btn-primary btn-sm submit_user" onclick="SaveSessionPurposeType();">&nbsp;&nbsp;continue&nbsp;&nbsp;</button>
                  </div>
                </div>
            </div>
        </div>
      
           

        <!-- </form> -->


    </div>
    <!-- code ends here for ui part -->
	
<!-- <div class="full-width-footer">
    <div class="full-width">
        <div class="col-sm-12">
            <div class="wrap_flex_btn">
              <div class="text-center" id="submit_org" style="display:block;">
                <button class="btn btn-primary btn-sm submit_user" onclick="SaveSessionPurposeType();">&nbsp;&nbsp;continue&nbsp;&nbsp;</button>
              </div>
            </div>
        </div>
    </div>
</div> -->

	<!--<script type="text/javascript" src="<?php //echo SKIN_URL.'js/discover.js?v='.JS_CSC_V; ?>"></script>-->
	<script type="text/javascript" src="<?php echo SKIN_URL.'js/discover.js?v='.JS_CSC_V; ?>"></script> 
	<?php $this->load->view('common/footer'); ?>
	<?php $this->load->view('common/footer_js'); ?>	
	<script>
    // code added for page refresh
    (function()
    {
      if( window.localStorage )
      {
        //check if reloaded once already 
        if( !localStorage.getItem('firstLoad') )
        {
        //if not reloaded once, then set firstload to true
          localStorage['firstLoad'] = true;
          //reload the webpage using reload() method
          $('#loader').show().delay(3000).fadeOut();//code added here on 22-09-2022
          window.location.reload();
        }  
        else 
          localStorage.removeItem('firstLoad');
      }
    })();


</script>
</body>	  
</html>    