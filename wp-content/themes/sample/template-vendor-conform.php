<?php
/**
*Template Name:Vendor Conform
*/
$firstName = $_POST['vFirstName'];
$lastName = $_POST['vLastName'];
$userName = $_POST['vUserName'];
$email = $_POST['vEmail'];
$mobile = $_POST['vMobile'];
$password = $_POST['vPassword'];
$conformPassword = $_POST['vConformPassword'];

get_header();?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if(is_user_logged_in()){?>
							<h4 class="text-center">You Don't have permission To access this page</h4>
							<p class="text-center"><a href="<?php echo site_url();?>">Home</a></p>
						<?php } else{ ?>
							<h4 class="text-center">Vendor Details</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<p>First Name : </p>
									</div>
									<div class="col-md-4">
										<p id="firstName" name="firstName"><?php echo $firstName;?></p>
									</div>
								</div>	
								<div class="col-md-12">
									<?php if(!empty($lastName)){?>
										<div class="col-md-4">
											<p>Last Name : </p>
										</div>
										<div class="col-md-4">
											<p id="lastName" name="lastName"><?php echo $lastName;?></p>
										</div>
									<?php }?>
								</div>
								<div class="col-md-12">
									<div class="col-md-4">
										<p>User Name : </p>
									</div>
									<div class="col-md-4">
										<p id="userName" name="userName"><?php echo $userName;?></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-4">
										<p>Email : </p>
									</div>
									<div class="col-md-4">
										<p id="email" name="email"><?php echo $email; ?></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-4">
										<p>Mobile : </p>
									</div>
									<div class="col-md-4">
										<p name="mobile" id="mobile"><?php echo $mobile?></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-4 hide">
										<p id="password" name="password"><?php echo $password;?></p>
										<p id="homeUrl" name="homeUrl"><?php echo home_url();?></p>	
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-3 col-md-offset-4">
										<input type="button" value="Register" class="btn btn-submit sb sb-btn" id="vendorRegisterConfirm">
									</div>
								</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
.sb-btn{
        width: 100%;
    }
</style>
<script type="text/javascript">
</script>
<?php get_footer()?>