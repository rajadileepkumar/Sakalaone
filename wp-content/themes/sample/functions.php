<?php
/**
 * Sample functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sample
 */
define('PATH',plugin_dir_path(__FILE__ ));
if ( ! function_exists( 'sample_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sample_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sample, use a find and replace
	 * to change 'sample' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sample', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_post_type_support( 'page', 'excerpt' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'sample' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sample_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


}
endif;
add_action( 'after_setup_theme', 'sample_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sample_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sample_content_width', 640 );
}
add_action( 'after_setup_theme', 'sample_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sample_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sample' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Contact Sidebar', 'sample' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sample_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sample_scripts() {
	wp_enqueue_style( 'sample-style', get_stylesheet_uri() );

	wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.css',array(),true,false);

	wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css',array(),true,false);

	wp_register_style('jquery-ui',get_template_directory_uri().'/css/jquery-ui.css');
	wp_enqueue_style('jquery-ui');

       wp_register_style('wpsms-style',get_template_directory_uri().'/css/wpsms.css');
       wp_enqueue_style('wpsms-style');

        wp_register_style('bootstrap-multi-select',get_template_directory_uri().'/css/bootstrap-select.min.css');
       wp_enqueue_style('bootstrap-multi-select');

        wp_register_style('bootstrap-multi-select',get_template_directory_uri().'/css/bootstrap-multiselect.css');
       wp_enqueue_style('bootstrap-select');

	wp_enqueue_script('jquery');

	wp_enqueue_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array(),true,false);

	wp_enqueue_script( 'sample-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_register_script('jquery-ui',get_template_directory_uri().'/js/jquery-ui.js',array(),true,false);
	wp_enqueue_script('jquery-ui');

    wp_register_script('wpsms-script',get_template_directory_uri().'/js/wpsms.js',array(),true,false);
	wp_enqueue_script('wpsms-script');

	wp_register_script('main',get_template_directory_uri().'/js/main.js',array(),true,false);
	wp_enqueue_script('main');


wp_register_script('jquery-validat',get_template_directory_uri().'/js/jquery.validate.min.js',array(),true,false);
	wp_enqueue_script('jquery-validat');

wp_register_script('bootstrap-select-js',get_template_directory_uri().'/js/bootstrap-select.min.js',array(),true,false);
	wp_enqueue_script('bootstrap-select-js');

wp_register_script('bootstrap-multiselect-js',get_template_directory_uri().'/js/bootstrap-multiselect.min.js',array(),true,false);
	wp_enqueue_script('bootstrap-multiselect-js');

wp_register_script('bootstrap-multiselect-js',get_template_directory_uri().'/js/bootstrap-multiselect.min.js',array(),true,false);
	wp_enqueue_script('bootstrap-multiselect-js');

wp_register_script('custom-js',get_template_directory_uri().'/js/custom.js',array(),true,false);
	wp_enqueue_script('custom-js');

wp_register_script('sendOtp-js',get_template_directory_uri().'/js/sendOtp.js',array(),true,false);
  wp_enqueue_script('sendOtp-js');  
  wp_localize_script( 'sendOtp-js', 'ajax_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

wp_register_script('forgot-password',get_template_directory_uri().'/js/forgot-password.js',array(),true,false);
  wp_enqueue_script('forgot-password');  
  wp_localize_script( 'forgot-password', 'ajax_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

  wp_register_script('verifyOtp-js',get_template_directory_uri().'/js/verifyOtp.js',array(),true,false);
  wp_enqueue_script('verifyOtp-js');  
  wp_localize_script( 'verifyOtp-js', 'ajax_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

	wp_register_script('qualification-js',get_template_directory_uri().'/js/qulification.js',array(),true,false);
	wp_enqueue_script('qualification-js');

  wp_register_script('vendor-register',get_template_directory_uri().'/js/vendor-register.js',array(),true,false);
  wp_enqueue_script('vendor-register');
  wp_localize_script( 'vendor-register', 'ajax_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
	wp_enqueue_script( 'sample-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sample_scripts' );
add_action( 'admin_enqueue_scripts', 'wpsms_styles1' );

function wpsms_styles1(){
  wp_register_script('qualification-js',get_template_directory_uri().'/js/qulification.js',array(),true,false);
  wp_enqueue_script('qualification-js');
  wp_register_style('admin-style',get_template_directory_uri().'/css/admin-style.css');
  wp_enqueue_style('admin-style');


}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

require 'custom-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require_once('template-parts/custom-post.php');
require_once('template-parts/custom-meta-box.php');
/*add_filter( 'pre_option_link_manager_enabled', '__return_true' );*/



/**
*---------------Fetured Links
*/



/**
 * WordPress function for redirecting users on login based on user role
 */
function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {
            $url = admin_url();
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );




add_action('template_redirect','register_user');

function register_user(){
  global $wpdb;

    if(isset($_GET['do']) && $_GET['do']=='register') :
        $errors = array();
        
        if(empty($_POST['password']))
            $errors[] = 'Please enter a password.<br>';
        if(empty($_POST['cpassword']))
            $errors[] = 'Please enter a confirm password.<br>';

        if((!empty($_POST['cpassword']) && !empty($_POST['password'])) && ($_POST['password'] != $_POST['cpassword']))
            $errors[] = 'Entered password did not match.';
        if(empty($_POST['qul']))
            $errors = 'Please Select the qualification<br/>';
        if(empty($_POST['qual_sub']))
            $errors = 'Please Select Education.<br/>';

        $user_login = esc_attr($_POST['user']);
        $user_pass = esc_attr($_POST['password']);
        $user_confirm_pass = esc_attr($_POST['cpassword']);
        $resultOTP = $_POST['resultOTP'];
        $qul = esc_attr($_POST['qul']);
        $qual_sub = esc_attr($_POST['qual_sub']);

        
        $sanitized_user_login = sanitize_user($user_login);
        /*username*/
        $user_email = apply_filters('user_registration_email', $user_login);
        $user_login = esc_attr($_POST['user']);
        $user_pass = esc_attr($_POST['password']);
        $user_confirm_pass = esc_attr($_POST['cpassword']);
        $qul = esc_attr($_POST['qul']);
        $qual_sub = esc_attr($_POST['qual_sub']);
        $sanitized_user_login = sanitize_user($user_login);
        $user_email = apply_filters('user_registration_email', $user_email);
        $dt = date("Y-m-d");
        $checkstatus = 1;
        $rtype = 0;
        $expDate = date('Y-m-d', strtotime($dt.'+ 364 days'));
        //echo $expDate;

        $userdata = array(
        	'user_login' => $sanitized_user_login,
        	'user_pass' => $user_pass,
        );
        if(username_exists($user_email) || empty($_POST['user']) || username_exists($sanitized_user_login))
        $errors[] = 'Username $user_email already exists.Choose another username.<br>';

        if(empty($sanitized_user_login) || !validate_username($user_login))
        $errors[] = 'Invalid user name.<br>';
    

    if(empty($errors)):
        $user_id = wp_insert_user($userdata);
        $insertUser = $wpdb->prepare("insert into wp_users_metadata (userId,paymentstatus,rtype,subendate,checkstatus) values(%d,%d,%d,%s,%d)",$user_id,$paymentstatus,$rtype,$expDate,$checkstatus);  
        $wpdb->query($insertUser);
        if(!$user_id):
            $errors[] = 'Registration failed';
        else:
            update_user_option($user_id, 'default_password_nag', true, true);
            wp_new_user_notification($user_id, $user_pass);
            update_user_meta($user_id,'qulification',$qul);
            update_user_meta($user_id,'subqualification',$qual_sub);
            wp_update_user(array('ID' => $user_id,'checksubscription' =>  $checkstatus));
            wp_redirect (home_url('/membership-join/?userid='.$user_id.'&resultOTP='.$resultOTP));
            //wp_redirect (home_url('/login/'));
            do_action ('user_register', $user_id);
        endif;
    endif;

    if(!empty($errors))
        define('REGISTRATION_ERROR', serialize($errors));
    endif;

}

add_action( 'wp_ajax_nopriv_my_request_OTP', 'my_request_OTP' );
add_action( 'wp_ajax_my_request_OTP', 'my_request_OTP' );

function my_request_OTP(){
  global $wpdb;
  echo $mobileNumber = $_GET['number'];
  echo $template = $_GET['template'];
  if($template){
      $sql = "select ID from wp_users where user_login='$mobileNumber'";
      $Id = $wpdb->get_var($sql);
      $newPassword = uniqid();
      if($Id){
          $result = wp_update_user(array('ID' => $Id, 'user_pass' => $newPassword));
          $content ="Your New Password is ".$newPassword.". Please Reset With in 24hrs";
          $url = "http://2factor.in/API/V1/5a55058b-ed5f-11e6-8c71-00163ef91450/SMS/".$mobileNumber."/AUTOGEN/SakalaoneOTP";
      }
  }
  else{
   $url = "http://2factor.in/API/V1/5a55058b-ed5f-11e6-8c71-00163ef91450/SMS/".$mobileNumber."/AUTOGEN/SakalaoneOTP"; 
  }
  $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "{}",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }

  die();
}

add_action( 'wp_ajax_nopriv_my_request_verifyOTP', 'my_request_verifyOTP' );
add_action( 'wp_ajax_my_request_verifyOTP', 'my_request_verifyOTP' );


function my_request_verifyOTP(){
  $otpNumner = $_GET['otpNumner'];
  $sessionId = $_GET['sessionId'];
  $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://2factor.in/API/V1/5a55058b-ed5f-11e6-8c71-00163ef91450/SMS/VERIFY/".$sessionId."/".$otpNumner."",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS => "{}",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  die();
}

add_filter('wp_authenticate_user', 'myplugin_auth_login',10,2);

function myplugin_auth_login ($user, $password) {
      global $wpdb;
      $currentDate = date('Y-m-d');
      $sql = "Select paymentstatus,subendate,checkstatus From wp_users_metadata where userId = $user->ID";
      $result = $wpdb->get_results($sql);

      foreach ($result as $key) {
        $paymentstatus = $key->paymentstatus;
        $subendate = $key->subendate;
        $checkstatus = $key->checkstatus;
      }
      if($checkstatus == 1){
          if ($paymentstatus == 1 && $subendate >= $currentDate) {
            return $user;
          }
          else{
            return wp_redirect (home_url('/membership-join/?userid='.$user->ID));
            //return new WP_Error('Subscription Ended');        
          }
      }else{
          return $user;
      }
}


add_filter( 'register_url', 'my_register_page' );
function my_register_page( $register_url ) {
    return home_url( '/register/' );
}

function guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(0,5), true)));
        $hyphen = chr(45);// "-"
        $uuid = ''// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .'';// "}"
        return $uuid;
    }
}



function paymentSuccess($response){
  //print_r($response);
  $dataSize = sizeof($response);
  
  global $wpdb; 
  $orderId = getValues($response['0']); 
  $pStatus = getValues($response['3']); 
  $trackingId= getValues($response['1']);
  $pDate = date('Y-m-d H:i:s', strtotime(getValues($response['40'])));
  
  $sql = "update wp_payment_history set pStatus='$pStatus',pDate='$pDate',trackingId= '$trackingId' where orderId = '$orderId'";
  $result = $wpdb->query($sql);
  if($pStatus === 'Success'){

     $sql = "Select userId from wp_payment_history where orderId='$orderId'";
     $result1 = $wpdb->get_var($sql1);
     $sql = "update wp_users_metadata set paymentstatus='1'where userId = '$result1'";
     $result2 = $wpdb->query($sql);
  }
}



function insertPaymentHistoryMethod($pAmount,$orderId,$userId,$pStatus,$pDate,$pDescription){

   global $wpdb;
   $insertPaymentHistory = $wpdb->prepare("insert into wp_payment_history (pAmount,pStatus,pDate,pDescription,orderId,userId) values(%d,%s,%s,%s,%s,%d)",$pAmount,$pStatus,$pDate,$pDescription,$orderId,$userId);  
      $result = $wpdb->query($insertPaymentHistory);
   
   
}

function getValues($array){
$a = explode("=", $array);
return $a['1'];
}

 function render_password_lost_form( $attributes, $content = null ) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );
 
    if ( is_user_logged_in() ) {
        return __( 'You are already signed in.', 'personalize-login' );
    } else {
        return $this->get_template_html( 'password_lost_form', $attributes );
    }
}

add_filter( 'lostpassword_url',  'wdm_lostpassword_url', 10, 0 );
function wdm_lostpassword_url() {
    return site_url('/forgot-password/');
}

function sendSms($user_login,$content){
  $api=get_option('wpsms_api1');
  $sender_id=get_option('sender_id');
  $api=str_replace('[TextMessage]',urlencode($content),$api);

  $api=str_replace('[SenderID]',$sender_id,$api);
  $api = str_replace('[Mobile]',trim($user_login),$api);
  $responseArr = wp_remote_request($api);  
  $response = $responseArr->body;
  if($responseArr['body']==="No Sufficient Credits"){
    echo "Something Went Wrong";
  }
  else{
    echo "Password Sent To your Mobile Number";
  }
  //return $response;
}


add_action('template_redirect','forgot_user');

function forgot_user(){
    global $wpdb;
    //$message = "";
    $From=get_option('sender_id');
    if(isset($_GET['do']) && $_GET['do']=='forgot') {
      $errors = array();
      $user_login = $_POST['user_login'];

      $sql = "select ID from wp_users where user_login='$user_login'";
      $Id = $wpdb->get_var($sql);
      $newPassword = uniqid();
      if($Id){
          $result = wp_update_user(array('ID' => $Id, 'user_pass' => $newPassword));
          $content ="Your New Password is ".$newPassword.". Please Reset With in 24hrs";
          echo sendtwofactorsms($From,$user_login,$content);
      }
      else{
          $errors[] = "You are  not registered us";
      }
    }

    if(!empty($errors)):
        define('FORGOT_ERROR', serialize($errors));
    endif;
}

add_action( 'login_form_register', 'redirect_register_action' );

function redirect_register_action()
{
    wp_redirect( home_url( '/register/' ) );
    exit(); // always call `exit()` after `wp_redirect`
}