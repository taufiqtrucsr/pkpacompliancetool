<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$profile_picture=$this->UserModel->GetUserProfilePicture($UserDetails->user_id);

?>
<?php $this->load->view('common/head_common'); ?>
	<body>
		<div id="barba-wrapper">

			<?php $this->load->view('common/header'); ?>

			<div class="barba-container">
				<div class="o-scroll o-scroll-home" data-module="SmoothScroll" data-scrollbar>
					<main class="c-main-home">	
						 <section class="login-profile">

							<div class="my-profile">
								<div class="profile-name">
									<span><img class="profile-picture" src="<?php echo $profile_picture; ?>"></span>
									<div class="name-profile"><h2>Hi, <?php echo ucfirst($UserDetails->name);?></h2>
									<?php echo $UserDetails->role_type;?><br/>
									<?php echo $UserDetails->email;?><br/>
									<!--<a href="#">Edit Profile</a>-->
									</div>
								</div>

							<div class="profile-profile-tab">
								<ul class="tabs">
									<?php if($UserDetails->role_type=='Salon Owner'){ ?>
									<li class="tab-link current" data-tab="tab-1">My SALONS</li>
									<?php } ?>
									<li class="tab-link" data-tab="tab-2">MY COURSES</li>
									<?php if($UserDetails->role_type=='Salon Owner' || $UserDetails->role_type=='Stylist'){ ?>
									<!--<li class="tab-link" data-tab="tab-3">MY ORDERS</li>-->
									<?php } ?>
								</ul>
								<?php if($UserDetails->role_type=='Salon Owner'){ ?>
									<div id="tab-1" class="tab-content salon1pro current">
										<?php if($UserSalon){?>
											<?php foreach($UserSalon as $row){
												if ($row->cover_picture  != NULL) {
													$cover_picture = WEB_URL.COVER_PIC_URL.$row->cover_picture;
												} else {
													$cover_picture =SALON_OWNER_DEFAULT_COVER_PIC;
												}
													
												?>
												<div class="salon-list">
													<img src="<?php echo $cover_picture; ?>">
													<div class="salondetails">
														<?php echo $row->salon_name; ?><br/>
														<?php echo $row->location; ?>
													</div>
												</div>
											<?php }?> 
										<?php } else{ ?>
											<p class="empty-record">No record found.</p>
										<?php } ?>
									</div>
								
								<?php } ?>
								<div id="tab-2" class="tab-content salon12pro">
									<p class="empty-record">No Courses Found.</p>
								</div>
								<?php if($UserDetails->role_type=='Salon Owner' || $UserDetails->role_type=='Stylist'){ ?>
								<div id="tab-3" class="tab-content salon3pro">
								<?php if($MyOrders){ ?>
										
									<table cellspacing="0" cellpadding="0" width="100%;" class="cart-listing">
											
										<?php foreach($MyOrders as $row){
											$ProductDetails = $this->ProductModel->getProductDetailsByProductId($row->product_id);
										if(isset($ProductDetails->thumbnail_image) && $ProductDetails->thumbnail_image != "" ) {

											$productThumbUrl = PRODUCT_THUMB_PATH.$ProductDetails->thumbnail_image;

										} else {

											$productThumbUrl = PRODUCT_DEFAULT_PIC;
										}

										$productUrl = base_url().'product/view/'.$row->product_id;

									
											
											?>
										  <tr>
												<!--<td><?php echo $row->increment_id; ?></td>-->
												<td class="first"><a href="<?php echo $productUrl; ?>"><img width="60" src="<?php echo $productThumbUrl; ?>"></p><!--<span class="order-item"><?php echo $row->product_name; ?></span>--></td>
												<td><?php echo $row->qty; ?> qty</td>
												<td class="points">-</td>
												<td class="last"><?php echo $row->status; ?></td>
											</tr>
										<?php } ?>
										</table>
										<?php }else {?>
										<p class="empty-record">No orders found.</p>
										<?php } ?>
								</div>
								<?php } ?>
								</div>
							</div>

					  </section>

					<?php $this->load->view('common/footer'); ?>

					</main>
				</div>
			</div>
		</div>
		
<?php $this->load->view('common/footer_js_inner'); ?>
	
		
