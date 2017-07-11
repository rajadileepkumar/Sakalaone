<?php
/*Vendor Functions*/
function my_request_availabulity_username(){
	$userName = $_POST['vuserName'];
	if(username_exists($userName)){
		echo 1;
	}
	else{
		echo 0;
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
	    echo 1;
	    //echo 'Email Id Already Exists '.$email;
	} else {
		echo 0;
	    //echo 'Email Id Available '.$email;
	}
	die();
}

add_action( 'wp_ajax_nopriv_my_request_availabulity_mobile','my_request_availabulity_mobile');
add_action( 'wp_ajax_my_request_availabulity_mobile','my_request_availabulity_mobile');

function my_request_availabulity_mobile(){
	global$wpdb;
	$vuserName = $_POST['vuserName'];
	$wp_usermeta = $wpdb->prefix."usermeta";
	//echo "Select COUNT(*) from $wp_usermeta where meta_key = 'vmobile' and meta_value='$vuserName'";
	$result = $wpdb->get_var("Select COUNT(*) from $wp_usermeta where meta_key = 'vmobile' and meta_value='$vuserName'");
	if ($result > 0) {
	    echo 1;
	} else {
		echo 0;
	}
	die();
}

add_action( 'wp_ajax_nopriv_my_request_vendor_register','my_request_vendor_register');
add_action( 'wp_ajax_my_request_vendor_register','my_request_vendor_register');

function my_request_vendor_register(){
	global$wpdb;
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$userName = $_POST['userName'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password = $_POST['password'];
	$vstatus = 0;
	$vdocumentReceived = 0;
	$dt = new DateTime();
	$createdDate = $dt->format('Y-m-d H:i:s');
	//echo $firstName."<br/>".$lastName."<br/>".$userName."<br/>".$email."<br/>".$password;
	$WP_array = array (
        'user_login'    =>  $userName,
        'user_email'    =>  $email,
        'user_pass'     =>  $password,
        'first_name'    =>  $firstName,
        'last_name'     =>  $lastName,
    ) ;
	//print_r($WP_array);
    $id = wp_insert_user($WP_array) ;
    wp_update_user( array ('ID' => $id, 'role' => 'vendor')) ;
    add_user_meta( $id, 'vmobile', $mobile,$unique = true);
    $vendor_metadata = $wpdb->prefix."vendor_metadata";
    $result = $wpdb->insert($vendor_metadata,array("vuser_id" => $id,"vstatus" => $vstatus,"vdocument_recevied" => $vdocumentReceived,"vcreated_date" => $createdDate),array('%d','%d','%d','%s'));
    
    /*$insertVendorMetadata = $wpdb->prepare("insert into $wpdb->prefix.'vendor_metadata'(vuser_id,vstatus,vdocument_received,vcreated_date) values(%d,%d,%d,%s)",$id,$vstatus,$vdocumentReceived,$createdDate);
    $result = $wpdb->query($insertVendorMetadata);*/
    if($result){
    	echo 1;
    }
	die();
}
?>