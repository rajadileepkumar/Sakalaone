<?php
/*Vendor Functions*/
function my_request_availabulity_username(){
	$userName = $_POST['vuserName'];
	if(username_exists($userName)){
		echo 'User Name Not Available '.$userName;
	}
	else{
		echo 'Username Available '.$userName;
	}
	die();
}
add_action( 'wp_ajax_nopriv_my_request_availabulity_username','my_request_availabulity_username');
add_action( 'wp_ajax_my_request_availabulity_username','my_request_availabulity_username');

add_action( 'wp_ajax_nopriv_my_request_availabulity_email','my_request_availabulity_email');
add_action( 'wp_ajax_my_request_availabulity_email','my_request_availabulity_email');

function my_request_availabulity_email(){
	$email = $_POST['vEmail'];
	$exists = email_exists($email);
	if ($exists) {
	    echo 'Email Id Already Exists '.$email;
	} else {
	    echo 'Email Id Available '.$email;
	}
	die();
}

add_action( 'wp_ajax_nopriv_my_request_availabulity_mobile','my_request_availabulity_mobile');
add_action( 'wp_ajax_my_request_availabulity_mobile','my_request_availabulity_mobile');

function my_request_availabulity_mobile(){
	$vuserName = $_POST['vuserName'];
	$exists = username_exists($vuserName);
	if ($exists) {
	    echo 'Mobile Number Already Exists '.$userName;
	} else {
	    echo 'Mobile Available '.$userName;
	}
	die();
}
?>