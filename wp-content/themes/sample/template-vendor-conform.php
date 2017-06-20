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

get_header();

if($_POST){
	$firstName1 = $_POST['firstName1'];
	$lastName1= $_POST['lastName1'];
	$userName1 = $_POST['userName1'];
	$email1 = $_POST['email1'];
	$mobile1 = $_POST['mobile1'];
	$password1 = $_POST['password1'];
	$conformPassword1 = $_POST['conformPassword1'];	
	
	$WP_array = array (
        'user_login'    =>  $userName1,
        'user_email'    =>  $email1,
        'user_pass'     =>  $password1,
        'first_name'    =>  $firstName1,
        'last_name'     =>  $lastName1,
    ) ;
	print_r($WP_array);
    $id = wp_insert_user( $WP_array ) ;
    $active = 0;
    wp_update_user( array ('ID' => $id, 'role' => 'editor') ) ;
    add_user_meta( $user_id, 'active', $awesome_level);
}

?>
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
							<form method="post" class="form-horizontal" id="vendorRegisterForm">
								<div class="col-md-12">
									<div class="col-md-4">Name : </div>
									<div class="col-md-4">
										<?php echo $firstName;?>
										<?php if(!empty($lastName)){echo $lastName;}?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-4">User Name 	:	</div>
									<div class="col-md-4"><?php echo $userName;?></div>
									<input type="hidden" name="firstName1" id="firstName1" value="<?php echo $firstName?>">
									<input type="hidden" name="lastName1" id="lastName1" value="<?php echo $lastName?>">
									<input type="hidden" name="userName1" id="userName1" value="<?php echo $userName?>">
									<input type="hidden" name="email1" id="email1" value="<?php echo $email?>">
									<input type="hidden" name="mobile1" id="mobile1" value="<?php echo $mobile?>">
									<input type="hidden" name="conformPassword1" id="conformPassword1" value="<?php echo $conformPassword?>">
									<input type="hidden" name="password1" id="password1" value="<?php echo $password?>">
								</div>
								<div class="col-md-12">
									<div class="col-md-4">Email 	:	</div>
									<div class="col-md-4"><?php echo $email ?></div>
								</div>
								<div class="col-md-12">
									<div class="col-md-4">Mobile 	:	</div>
									<div class="col-md-4"><?php echo $mobile ?></div>
								</div>
								<div class="col-md-12">
									<div class="col-md-4">Enter OTP 	: </div>
									<div class="col-md-4"><input type="text" id="vOTP" name="vOTP" class="form-control"></div>
								</div>
								<div class="col-md-12">
									<div class="col-md-3 col-md-offset-4">
										<input type="submit" value="submit" class="btn btn-submit sb sb-btn">
									</div>
								</div>
							</form>
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
<?php get_footer()?>