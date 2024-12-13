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
  [type=radio] {
  position: absolute;
  opacity: 0;
  left:0;
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
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
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
 .disableState{
  pointer-events: none;
  background: #f1f1f1;
  border: none;
 }
/* CSS FOR CURSOR POINT ENDS HERE */
  </style>
<link rel="stylesheet" media="all" href="https://harvesthq.github.io/chosen/chosen.css" />
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>/css/implementor.css" />
 <body class="full-page">
  
      <?php
        $this->load->view('common/header');
      ?>	
    <div class="container" style="padding:50px;">

      <?php 

        if(isset($_SESSION['UserId']))
        {
          $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']); 
          $UserDetails->user_type ."-". $UserDetails->status;
        }
      ?>
        <div class="text-center">
            <P class="main_title">What best describe's you ?</P>
        </div>
            <?php if($UserDetails->user_type == 1){$class = "_nonindvidual";}else{$class = "_indvidual";} ?> 
            <div class="col-md-12 main_container">
            <div class="<?php echo $class;?>">
                <?php if($UserDetails->user_type == 1):?>
                <div class="col-md-3 sub_container user_type <?php if($UserDetails->current_active_role == 2){echo "current_act_btn";}?> <?php if (!in_array("2", $asocc_roles_in_array)){echo "disableState";}?>" id="org_contributor" data="button_data">  
                    <label>
                      <input type="radio" value="2" name="org_type" id="org_cont" checked="<?php if($UserDetails->current_active_role == 2){echo "checked";}?>">
                      <img src="<?php echo SKIN_URL; ?>images/corporate_contributor.svg" alt="" style="padding:30px;">  
                      <div class="content_container card-input">
                          <h2 class="main-head"><b>Contributor (CSR)</b></h2>
                          <p>Fund projects aligned to your CSR policies, monitor them & complete your CSR obligations.</p>
                          <br>
                      </div>
                    </label>          
                </div>
                <div class="col-md-3 sub_container user_type <?php if($UserDetails->current_active_role == 7){echo "current_act_btn";}?> <?php if (!in_array("7", $asocc_roles_in_array)){echo "disableState";}?>" id="org_contributor_non_csr" data="button_data">  
                    <label>
                      <input type="radio" value="7" name="org_type"  id="org_cont" <?php if($UserDetails->current_active_role == 7){echo "checked";}?>>
                      <img src="<?php echo SKIN_URL; ?>images/corporate_contributor.svg" alt="" style="padding:30px;">  
                      <div class="content_container card-input">
                          <h2 class="main-head"><b>Contributor (Non-CSR)</b></h2>
                          <p>Be a responsible entity to support Social & Welfare initatives for the society</p>
                          <br>
                      </div>
                    </label>          
                </div>
                <div class="col-sm-3 sub_container user_type <?php if($UserDetails->current_active_role == 1){echo "current_act_btn";}?> <?php if (!in_array("1", $asocc_roles_in_array)){echo "disableState";}?>" id="org_implementer" data="button_data">
                    <label>
                    <input type="radio" value="1" name="org_type" id="org_imp" <?php if($UserDetails->current_active_role == 1){echo "checked";}?>>
                    <img src="<?php echo SKIN_URL; ?>images/implementer.svg" alt="" style="padding:40px;">
                    <div class="content_container card-input">
                        <h2 class="main-head"><b>Implementer (NGO)</b></h2>
                        <p>Create & list impactful social projects; raise CSR funds and/or Donations and Volunteering.</p>
                        <br>
                    </div>
                    </label>
                </div>
              <?php endif ?>

              <div class="col-sm-3 sub_container user_type <?php if($UserDetails->current_active_role == 3){echo "current_act_btn";}?> <?php
              if(count($asocc_roles_in_array) > 0){
               if(!in_array("3", $asocc_roles_in_array)){echo "disableState";}
              }
              ?>" id="user_motivator" data="button_data">
                <label>
                  <input type="radio" value="3" name="user_type" <?php if($UserDetails->current_active_role == 3){echo "checked";}?>>
                  <img src="<?php echo SKIN_URL; ?>images/motivator.svg" alt="" style="padding:30px;">
                  <div class="content_container card-input">
                      <h2 class="main-head"><b>Motivator</b></h2>
                      <p>Be a Motivator and create campaign, onboard fundraisers to raise CSR funds & donations; Volunteering.</p>
                      <br>
                  </div>
                </label>
              </div>

              <div class="col-sm-3 sub_container user_type <?php if($UserDetails->current_active_role == 4){echo "current_act_btn";}?> <?php if(count($asocc_roles_in_array) > 0){if (!in_array("4", $asocc_roles_in_array)){echo "disableState";}}?>" id="user_fundraiser" data="button_data">
                <label>
                  <input type="radio" value="4" name="user_type" <?php if($UserDetails->current_active_role == 4){echo "checked";}?>/>
                  <img src="<?php echo SKIN_URL; ?>images/fundraiser.svg" alt="" style="padding:34px;">
                  <div class="content_container card-input">
                      <h2 class="main-head"><b>Fundraiser</b></h2>
                      <p>Create Campaigns to promote impactful social projects; raise funds through Crowdfunding & CSR"</p>
                  </div>
                </label>
              </div>

               <?php if($UserDetails->user_type == 2):?>
                <div class="col-sm-3 sub_container user_type <?php if($UserDetails->current_active_role == 6){echo "current_act_btn";}?>" id="user_fundraiser" data="button_data">
                  <label>
                    <input type="radio" value="6" name="user_type" <?php if($UserDetails->current_active_role == 6){echo "checked";}?>/>
                    <img src="<?php echo SKIN_URL; ?>images/individualDonar.svg" alt="" style="padding:30px;">
                    <div class="content_container card-input">
                        <h2 class="main-head"><b>Individual Donor</b></h2>
                        <p>Be a social Hero to support 
                        Social initaties that supports 
                        the needy</p>
                    </div>
                  </label>
                </div>

                <div class="col-sm-3 sub_container user_type <?php if($UserDetails->current_active_role == 5){echo "current_act_btn";}?>" id="user_fundraiser" data="button_data">
                  <label>
                    <input type="radio" value="5" name="user_type" <?php if($UserDetails->current_active_role == 5){echo "checked";}?>/>
                    <img src="<?php echo SKIN_URL; ?>images/volunteer.svg" alt="" style="padding:30px;">
                    <div class="content_container card-input voluntr">
                        <h2 class="main-head"><b>Volunteer</b></h2>
                        <p>A social practitioner, driven 
                        through inner strength 
                        to support Social initaties</p>
                    </div>
                  </label>
                </div>
                <?php endif?>
          </div>
            </div>
            <div class="text-center" id="submit_org" style="display:block;">
                <button class="btn btn-primary btn-sm submit_user"  style="width:200px;border-radius:5px;font-family:averta_regular;background:#3366CC;" onclick="UserType();">&nbsp;&nbsp;continue&nbsp;&nbsp;</button>
            </div>
            <div class="text-center" id="submit_user" style="display:none;">
                <button class="btn btn-primary btn-sm submit_user" style="width:200px;border-radius:5px;font-family:averta_regular;background:#3366CC;" onclick="UserType();">&nbsp;&nbsp;continue&nbsp;&nbsp;</button>
            </div>            
    </div>
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
    // code added for page refresh ends here
    //we will auto-triggering js function
		$( document ).ready(function() 
		{
      
			//console.log( "ready!" );
		
			$('#search_project_keyword').keyup(function(e) 
			{
				
				$("#auto_suggestions").empty();
				var existingString = $("#search_project_keyword").val();
				//console.log(existingString);
				if(existingString.length > 1 )
				{
				
				$.ajax
				({
					type: "POST",
					url: BASE_URL + "Discover/getSeachSuggestions", 
					data: {existingString: existingString},
					//dataType: "json",  
					cache:false,
					success: function(response)
						{
						
							let obj = JSON.parse(response);
							let status = obj.status;
							if(status===200)
							{
								let data = obj.data;
								if(data.length > 0 )
								{
									//console.log(data);
									$("#auto_suggestions").css('display','block');
								
									$.each(data, function(index, value) {
									
										//console.log(value);
										$("#auto_suggestions").append('<p onClick="getSearchKeyword(\'' + value.keyword + '\')" id=' + index + '>' + value.keyword + '</p>');
									});
								}
							}
								
						},
					error: function()
					{                      
						//alert('Error while request..');
						console.log('Error while request..');
					}
				});
				}
					return false;
			});
		
		});
		
		
		function getSearchKeyword(value)	
		{
			var searchKeyword = value;
			//console.log(searchKeyword);
			document.getElementById('search_project_keyword').value= searchKeyword;
			$("#auto_suggestions").empty();
			document.getElementById('auto_suggestions').style.display = "none";
		}
		
		$('#mail_sent').delay(8000).fadeOut('slow');
		

        // code start here
        $('.user_type').click(function() {
            var value = $(this).attr("data");
            // alert(value);
            if (value == "button_data") {
                //alert("testing");
                $('.user_type').removeClass("current_act_btn");
                $(this).addClass("current_act_btn");
                // $(this).addClass("currentfs");
            }
        });
        // code ends here
        
      $("#user_motivator,#user_fundraiser").click(function(){
        $("#submit_user").css("display","block");
        $("#submit_org").css("display","none");
      });

      $("#org_implementer,#org_contributor").click(function(){
        $("#submit_org").css("display","block");
        $("#submit_user").css("display","none");
      });

//code ends here

// testing code start here
$('.user_type').click(function() {
  var value = $(this).attr("data");
  // alert(value);
  if (value == "button_data") {
      //alert("testing");
      // $('.user_type').removeClass("current_act_btn");
      $(this).addClass("current_act_btn");
      // $(this).addClass("currentfs");
  }
});
// code ends here  
$("#user_motivator,#user_fundraiser").click(function(){
  $("#submit_user").css("display","block");
  $("#submit_org").css("display","none");
});
// testing code ends here

$(document).ready(function(){
  $("#org_imp").click();
  $("#org_imp").click();
});
$("#org_imp").click(function(){
  $("#org_imp").click();
  $("#org_imp").click();
});

$("#org_cont").click(function(){
  $("org_cont").click();
  $("org_cont").click();
});
// code ends here      
</script>
</body>	  
</html>