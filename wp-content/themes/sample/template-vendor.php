<?php
/**
*Template Name:Vendor Register
*/
get_header();?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="contnet"class="site-content" role="area">
			<div class="container">
				<?php 
					if(is_user_logged_in()){
						echo '<h1>Aleready Login</h1>';
					}
					else{
						?>
							<div class="row">
								<div class="col-md-12">
									<h1 class="text-center">Vendor Sign Up</h1>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form method="post" class="form-horizontal" id="vendorRegisterForm" action="<?php echo site_url('/v-confirm/')?>">
										<div class="form-group">
											<label for="vFirstName" class="col-md-4 control-label">First Name</label><span class="vrequired-field">*</span>
											<div class="col-md-4">
												<input type="text" placeholder="First Name" id="vFirstName" class="form-control" name="vFirstName">
											</div>
										</div>
										<div class="form-group">
											<label for="vLastName" class="col-md-4 control-label">Last Name</label>
											<div class="col-md-4">
												<input type="text" placeholder="Last Name" id="vLastName" class="form-control" name="vLastName">
											</div>
										</div>
										<div class="form-group">
											<label for="vUserName" class="col-md-4 control-label">User Name</label><span class="vrequired-field">*</span>
											<div class="col-md-4">
												<input type="text" placeholder="User Name" id="vUserName" class="form-control" name="vUserName">
												<span class="v-available" id="v-available"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="vEmail" class="col-md-4 control-label">Email</label><span class="vrequired-field">*</span>
											<div class="col-md-4">
												<input type="email" placeholder="Email" id="vEmail" class="form-control" name="vEmail">
												<span class="v-email-available" id="v-email-available"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="vMobile" class="col-md-4 control-label">Mobile</label><span class="vrequired-field">*</span>
											<div class="col-md-4">
												<input type="text" placeholder="Mobile" id="vMobile" class="form-control" name="vMobile">
												<span class="v-mobile-available" id="v-mobile-available"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="vPassword" class="col-md-4 control-label">Password</label><span class="vrequired-field">*</span>
											<div class="col-md-4">
												<input type="password" placeholder="Password" id="vPassword" class="form-control" name="vPassword">
											</div>
										</div>
										<div class="form-group">
											<label for="vConfirmPassword" class="col-md-4 control-label">Confirm Password</label><span class="vrequired-field">*</span>
											<div class="col-md-4">
												<input type="password" placeholder="Confirm Password" id="vConfirmPassword" class="form-control" name="vConfirmPassword">
											</div>
										</div>
										<div class="form-group">
		                                    <label class="col-md-4 control-label"></label>
		                                    <div class="col-md-4">
		                                        <input type="checkbox" class="" id="terms" name="terms"> I Accept
		                                        <a class="control-label" data-target="#myModalPrivacy" data-toggle="modal" href="#">Term & Conditions</a>
		                                    </div>    
                                		</div>
                                		<div class="form-group">
		                                    <label class="col-md-4 control-label"></label>
		                                    <div class="col-md-8">
		                                        <div class="col-md-3 padding-left">
		                                            <input type="submit" class="active btn btn-submit sb sb-btn" value="Register" name="vendorRegister" id="vendorRegister" onclick="vendorRegisterClick();"> 
		                                        </div>
		                                    </div>    
                                		</div>
									</form>
								</div>
							</div>
						<?php
					}
				?>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.sb-btn{
        width: 100%;
    }
    .notavailable {
    	border: 3px #C33 solid !important;
	}
	.available {
	    border: 3px #090 solid !important;
	}
</style>
<?php get_footer();?>