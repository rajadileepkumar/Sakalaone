<?php
/*
* Template Name:Vendor Student Register
*/
get_header()?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="contnet"class="site-content" role="area">
			<div class="container">
				<?php 
					if(is_user_logged_in()){
						?>
							<div class="row">
								<div class="col-md-12">
									<h1 class="text-center">Student Registration</h1>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form method="post" class="form-horizontal" id="vendorRegisterForm" action="<?php echo site_url('/v-confirm/')?>">
										<div class="form-group">
											<label for="vMobile" class="col-md-4 control-label">Mobile</label><span class="vrequired-field">*</span>
											<div class="col-md-4">
												<input type="text" placeholder="First Name" id="vMobile" class="form-control" name="vMobile">
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
	                                    <label for="qualification" class="col-md-4 control-label">Qualification</label>
		                                    <div class="col-md-8">
		                                        <div class="col-md-3 padding-left">
		                                            <select name="qul" id="qul" class="form-control" onchange="print_qual_sub('qual_sub',this.selectedIndex);">
		                                            </select>
		                                            <script type="text/javascript">print_quly("qul");</script>
		                                        </div>    
		                                        <div class="col-md-3 padding-left">    
		                                            <select class="form-control" name="qual_sub" id="qual_sub" disabled>
		                                            </select>
		                                        </div>    
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
		                                            <input type="submit" class="btn btn-submit sb sb-btn" value="Register" name="vendorRegister" id="vendorRegister" onclick="vendorRegisterClick();"> 
		                                        </div>
		                                    </div>    
                                		</div>
									</form>
								</div>
							</div>
						<?php
					}
					else{
						echo "You Don't Have Permission";
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
</style>
<?php get_footer();?>