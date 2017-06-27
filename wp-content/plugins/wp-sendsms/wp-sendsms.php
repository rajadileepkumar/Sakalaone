<?php

/*

Plugin Name: SendSMS

Plugin URI: https://github.com/rajadileepkumar

Description: This Plugin Helps for Sending SMS Using SMS Gateway. For more information Visit http://thedigilife.com

Author: Raja Dileep Kumar

Version: 1.1

Author URI: https://github.com/rajadileepkumar

http://bhashsms.com/api/sendmsg.php?user=success&pass=654321&sender=bshsms&phone=[Mobile]&text=[TextMessage]&priority=ndnd&stype=normal

wp_sent_sms



wp_subscriber



wp_subscription



wp_subscription_category



http://www.javascript-coder.com/form-validation/jquery-form-validation-guide.phtml

*/



define('PATH',plugin_dir_path(__FILE__ ));



include_once PATH .'include/subscription_category.php';

include_once PATH .'include/subscription_category.list.php';

include_once PATH .'include/add_subscriber.php';

include_once PATH .'include/subscriber_list.php';

include_once PATH .'include/update_subscriber.php';



global $wpsms_options;

$wpsms_options=array(

		'wpsms_api1'=>'http://example.com/smsapi.php?mobile=[Mobile]&sms=[TextMessage]&senderid=[SenderID]&scheduledatetime=[ScheduleTime]');

		



register_activation_hook( __FILE__, 'wpsms_activate' );



register_deactivation_hook( __FILE__, 'wpsms_deactivate' );



add_shortcode('wpsms_form', 'sms_form'); 



add_action('init','wpsms_init'); 



//add_action( 'wp_enqueue_scripts', 'wpsms_styles' );





//add_action('wp_enqueue_scripts', 'wpsms_scripts');

//add_action('admin_enqueue_scripts', 'wpsms_scripts'); 



function wpsms_init()

{

	if(!isset($_SESSION))

		session_start();

}

function wpsms_activate()

{

	global $wpdb;

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	// add Default Settings to the options

	$wpsms_options=array(

		'wpsms_api1'=>'http://example.com/smsapi.php?username=yourusername&password=yourpassword&mobile=[Mobile]&sms=[TextMessage]&senderid=[SenderID]',

		'remove_bad_words'=>'1',

		'captcha'=>'1',

		'captcha_width'=>'70',

		'captcha_height'=>'25',

		'captcha_characters'=>'4',

		'maximum_characters'=>'140',

		'confirm_page'=>'1',

		'sender_id'=>'',

		'allow_without_login'=>'0');

	foreach($wpsms_options as $option=>$value)

	{

		add_option($option,$value);

	}

	

	// Create Database Tables 

	$sql='CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'sent_sms (

		`id` INT NOT NULL AUTO_INCREMENT,

		`user_id` INT NOT NULL ,

		`mobile` VARCHAR(15) NOT NULL ,

		`message` TEXT NOT NULL ,

		`response` TEXT NULL ,

		`ip` VARCHAR(20) NOT NULL ,

		`sent_time` DATETIME NOT NULL,

		 PRIMARY KEY  (`id`)

		) ENGINE=InnoDB AUTO_INCREMENT=1';

	

	dbDelta($sql);



	$sql2 =  'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'subscriber(

		id int auto_increment primary key,firstname varchar(50),lastname varchar(50),mobile varchar(13) unique

	)ENGINE=InnoDB AUTO_INCREMENT=1';



	dbDelta($sql2);



	$sql3 = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'subscription(

		sid int auto_increment primary key,sname varchar(200),aid int,foreign key (aid) REFERENCES '.$wpdb->prefix.'subscriber (id) ON DELETE CASCADE 

	)ENGINE=InnoDB AUTO_INCREMENT=1';



	dbDelta($sql3);

}





function wpsms_deactivate()

{

	global $wpsms_options;

	global $wpdb;

	

	$wpdb->query("drop table if exists {$wpdb->prefix}sent_sms");



	$wpdb->query("drop table if exists {$wpdb->prefix}subscriber");



	$wpdb->query("drop table if exists {$wpdb->prefix}subscription");

	

	$wpdb->query("drop table if exists {$wpdb->prefix}subscription_category");



	foreach($wpsms_options as $option=>$value)

	{

		delete_option($option);

	}



}





/*admin menu*/

add_action('admin_menu','sms_admin_menu');



function sms_admin_menu()

{

	

	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

	 $menu = add_menu_page( 'SMS Settings', 'SMS', 'edit_pages', 'sms', 'sms_settings');

	//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

	 add_submenu_page('', __('Categories', 'custom_table_example'), __('Categories', 'custom_table_example'), 'edit_pages', 'categories', 'category_table_example_persons_page_handler');

    // add new will be described in next part

    add_submenu_page('', __('Add New Category', 'custom_table_example'), __('Add New Category', 'custom_table_example'), 'edit_pages', 'category_form', 'category_table_example_persons_form_page_handler');

	//$menu2 = add_submenu_page('sms', __('Add New Subscription', 'custom_table_example'), __('Add New Subscription', 'custom_table_example'), 'edit_pages', 'subscription_form', 'subscription_table_example_persons_form_page_handler');

    $menu4 = add_submenu_page('','Subscribers Lists','Subscribers','edit_pages','subscribe_list','subscribe_list');

	$menu3 = add_submenu_page('','Add Subscriber','Add Subscriber','edit_pages','new_subscriber','add_subscriber');

	$menu5 = add_submenu_page( 'sms', 'Sent SMS', 'Sent SMS', 'edit_pages', 'sent-sms', 'sms_sent');

	$menu6 = add_submenu_page( 'sms', 'Send SMS', 'Send SMS', 'edit_pages', 'send-sms', 'sms_send');

	$menu2 = add_submenu_page('','Update Subscriber','Update Subscriber','edit_pages','update_subscriber','update_subscriber');

	

	

    

	

	add_action('admin_print_styles-'.$menu,'wpsms_styles');

	add_action('admin_print_scripts-'.$menu,'wpsms_scripts');



	

	add_action('admin_print_styles-'.$menu2,'wpsms_styles');

	add_action('admin_print_scripts-'.$menu2,'wpsms_scripts');



	add_action('admin_print_styles-'.$menu3,'wpsms_styles');

	add_action('admin_print_scripts-'.$menu3,'wpsms_scripts');



	add_action('admin_print_styles-'.$menu4,'wpsms_styles');

	add_action('admin_print_scripts-'.$menu4,'wpsms_scripts');



	add_action('admin_print_styles-'.$menu5,'wpsms_styles');

	add_action('admin_print_scripts-'.$menu5,'wpsms_scripts');



	add_action('admin_print_styles-'.$menu6,'wpsms_styles');

	add_action('admin_print_scripts-'.$menu6,'wpsms_scripts');



}





function sms_settings()

{

	require('sms_admin_settings.php');

}

function sms_send()

{	

	require('admin_sendsms.php');

}







function sms_sent()

{

	require('sms_sent.class.php');	

    //Create an instance of our package class...

    $sentSMSListTable = new Sent_SMS_List_Table();

    //Fetch, prepare, sort, and filter our data...

    $sentSMSListTable->prepare_items();   

	?>

	<div class="wrap col-md-12">	

		<div id="icon-users" class="icon32"><br/></div>

		<h2>Sent Messages</h2>

		<?php if(!empty($sentSMSListTable->notify)) { ?>

		<div id="message" class="updated below-h2">

			<p><?php echo $sentSMSListTable->notify; ?></p>

		</div>

		<?php } ?>

		<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->

		<form id="sent-sms-filter" method="get">

			<!-- For plugins, we also need to ensure that the form posts back to our current page -->

			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />

			<!-- Now we can render the completed list table -->

			<?php $sentSMSListTable->display() ?>

		</form>

		

	</div>

	<?php

}



function subscribe_list(){

	global $wpdb;



    $table = new Subscriber_List_Table();

    $table->prepare_items();



    $message = '';

    if ('delete' === $table->current_action()) {

        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'custom_table_example'), count($_REQUEST['id'])) . '</p></div>';

    }

    ?>

<div class="wrap">



    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>

    <h2><?php _e('Subscribers', 'custom_table_example')?> <a class="add-new-h2"

                                 href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=new_subscriber');?>"><?php _e('Add new', 'custom_table_example')?></a>

    </h2>

    <?php echo $message; ?>



    <form id="persons-table" method="GET">

        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>

        <?php $table->display() ?>

    </form>



</div>

<?php

}



function sms_form($args)

{	

	require('sms_form.php');

	return $content;

}

function wpsms_styles() {

	wp_register_style('wpsms-style', WP_PLUGIN_URL.'/wp-sendsms/css/wpsms.css');

	wp_enqueue_style('wpsms-style');

	wp_enqueue_style('bootstrap',plugin_dir_url(__FILE__ ).'css/bootstrap.css');

    wp_enqueue_style('font-awesome',plugin_dir_url(__FILE__ ).'css/font-awesome.css' );

    wp_enqueue_style('style',plugin_dir_url(__FILE__ ).'css/style.css');

    wp_enqueue_style('bootstrap-select',plugin_dir_url(__FILE__ ).'css/bootstrap-select.min.css');

    wp_enqueue_style('bootstrap-multi-select',plugin_dir_url(__FILE__ ).'css/bootstrap-multiselect.css');

}

function wpsms_scripts() {

	wp_register_script('wpsms-script', WP_PLUGIN_URL.'/wp-sendsms/js/wpsms.js', array('jquery'));

	wp_enqueue_script('wpsms-script');

	wp_enqueue_script('jQuery');

	wp_enqueue_script('jquery-validate',plugin_dir_url(__FILE__ ).'js/jquery.validate.min.js');

    wp_enqueue_script('bootstrap-js',plugin_dir_url(__FILE__ ).'js/bootstrap.min.js');

    wp_enqueue_script('bootstrap-select-js',plugin_dir_url(__FILE__ ).'js/bootstrap-select.min.js');

    wp_enqueue_script('bootstrap-multiselect-js',plugin_dir_url(__FILE__ ).'js/bootstrap-multiselect.min.js');

    wp_enqueue_script('custom-js',plugin_dir_url(__FILE__ ).'js/custom.js');

}


function sanitize_badwords($message)

{

	$badwords=file_get_contents(WP_PLUGIN_DIR.'/wp-sendsms/badwords.txt','r');

	$badwords_arr=explode("\r\n",$badwords);

	for($i=0;$i<count($badwords_arr);$i++)

	{

		$message=trim(str_replace($badwords_arr,'',$message));

	}

	return $message;

}







function get_data($url) {

	/*$ch = curl_init();

	$additional_headers = array(                                                                          
   'Accept: application/json',
   'API KEY: 5a55058b-ed5f-11e6-8c71-00163ef91450 ',
   'Host: www.2factor.in',
   'Content-Type: application/json'
);

	$timeout = 120;

	echo $url;


	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers); 
	echo $data = curl_exec($ch);

	curl_close($ch);

	return $data;
*/
}



function wpsms_send_admin()

{

	$api=get_option('wpsms_api1');

	$adminmobile = $_POST['adminmobile'];	

	$mobile = array_chunk($adminmobile, 10);

	$tempMobile = array();

	foreach ($mobile as $key => $value) {

		array_push($tempMobile, implode(",", $value));

		

	}

	

	$adminmessage = filter_var($_POST['adminmessage'],FILTER_SANITIZE_STRING);

	//echo $adminmessage;

	$multiSelectSubscription = filter_var($_POST['multiSelectSubscription'],FILTER_SANITIZE_STRING);

	$sender_id=get_option('sender_id');

	

	/* check for allowing user to send sms without login. */

	$current_user = wp_get_current_user();

	$user_id=$current_user->ID;

	$api=str_replace('[TextMessage]',urlencode($adminmessage),$api);

	$api=str_replace('[SenderID]',$sender_id,$api);

	foreach ($tempMobile as $mobile)

	{

		$api2=str_replace('[Mobile]',trim($mobile),$api);

	}
	echo sendtwofactorsms($sender_id,$mobile,$adminmessage);

	

		/*$responseArr = wp_remote_request($api2);	

		$response = $responseArr->body;

		var_dump($responseArr);

		exit();*/

		

		/* Make Datbase Entry */

		global $wpdb;

		$table=$wpdb->prefix.'sent_sms';

		$data=array('user_id'=>$user_id, 'mobile'=>$mobile, 'message'=>$adminmessage, 'response'=>$response, 'ip'=>$_SERVER['REMOTE_ADDR'], 'sent_time'=>date_i18n('Y-m-d H:i:s'));

		//var_dump($data);

		$wpdb->insert($table, $data);

	//}

	

	/* Set Display response according to setting original or custom */

	if(get_option('custom_response'))

	{

		$response='<p id="sms-response">'.get_option('custom_response_text').'</p>';

	}

	

	return $response;

}







/*send Sms*/








/*send Sms*/



add_action('init', 'adminsms_send');



function adminsms_send()

{

	if(isset($_POST['admin_send_sms_nonce']))

	{

		if (!wp_verify_nonce($_POST['admin_send_sms_nonce'],'admin_send_sms'))

		{

			$errors.='<p>Sorry, Problem in submitting the form.</p>';

		}

		else{

			$adminmobile = implode(",", $_POST['adminmobile']);

			$To = filter_var($adminmobile,FILTER_SANITIZE_STRING);

			$Msg = filter_var($_POST['adminmessage'],FILTER_SANITIZE_STRING);

			$multiSelectSubscription = filter_var($_POST['multiSelectSubscription'],FILTER_SANITIZE_STRING);

			

		}

		if(empty($errors))

		{

			$redirection_url=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];			

			

			//send SMS and Make Database Entry			

			global $admin_sms_response;

			$admin_sms_response=wpsms_send_admin(); // Send SMS

			

			$redirection_url=$_SERVER["REQUEST_URI"];

			if(strpos($redirection_url,'?')) 

				$redirection_url.='&sent=1';

			else	

				$redirection_url.='?sent=1';

			//echo "<script>location.href='$redirection_url';</script>";		

			

		}

	}

}



add_filter( 'widget_text', 'do_shortcode');



add_shortcode('sms_shortcode','add_subscriber');



global $custom_table_example_db_version;

$custom_table_example_db_version = '1.1'; 



function category_table_example_install()

{

    global $wpdb;

    global $custom_table_example_db_version;



    $table_name = $wpdb->prefix . 'category'; // do not forget about tables prefix



    // sql to create your table

    // NOTICE that:

    // 1. each field MUST be in separate line

    // 2. There must be two spaces between PRIMARY KEY and its name

    //    Like this: PRIMARY KEY[space][space](id)

    // otherwise dbDelta will not work

    $sql = "CREATE TABLE " . $table_name . " (

      id int(11) NOT NULL AUTO_INCREMENT,

      name varchar(50),

      PRIMARY KEY  (id)

    );";

	



	// $sql3 = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'subscribers	(

	// 	sid int auto_increment primary key,sname varchar(200),aid int,foreign key (aid) REFERENCES '.$wpdb->prefix.'subscriptions (id) 

	// )ENGINE=InnoDB AUTO_INCREMENT=1';



	

	

    // we do not execute sql directly

    // we are calling dbDelta which cant migrate database

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);

    

    //dbDelta($sql3);



    // save current database version for later use (on upgrade)

    add_option('custom_table_example_db_version', $custom_table_example_db_version);



    /**

     * [OPTIONAL] Example of updating to 1.1 version

     *

     * If you develop new version of plugin

     * just increment $custom_table_example_db_version variable

     * and add following block of code

     *

     * must be repeated for each new version

     * in version 1.1 we change email field

     * to contain 200 chars rather 100 in version 1.0

     * and again we are not executing sql

     * we are using dbDelta to migrate table changes

     */

    $installed_ver = get_option('custom_table_example_db_version');

    if ($installed_ver != $custom_table_example_db_version) {

        $sql = "CREATE TABLE " . $table_name . " (

          id int(11) NOT NULL AUTO_INCREMENT,

          name varchar(50),

          PRIMARY KEY  (id)

        );";



        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($sql);



        // notice that we are updating option, rather than adding it

        update_option('custom_table_example_db_version', $custom_table_example_db_version);

    }

}



register_activation_hook(__FILE__, 'category_table_example_install');





function category_table_example_update_db_check()

{

    global $custom_table_example_db_version;

    if (get_site_option('custom_table_example_db_version') != $custom_table_example_db_version) {

        custom_table_example_install();

    }

}



add_action('plugins_loaded', 'category_table_example_update_db_check');

function sendtwofactorsms($From,$To,$Msg){
$api = get_option('wpsms_api1');
$ch = curl_init();
$post = [
    'From' => $From,
    'To' => $To,
    'Msg'   => $Msg,
];
curl_setopt($ch, CURLOPT_URL,$api);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
$response = curl_exec($ch);
$curl_errno = curl_errno($ch);
$curl_error = curl_error($ch);
curl_close ($ch);
if ($curl_errno > 0) {
                echo "cURL Error ($curl_errno): $curl_error\n";
        } else {
                //echo "Data received:\n";
                
        }
}




function category_table_example_persons_page_handler(){

	global $wpdb;



    $table = new Category_Table_Example_List_Table();

    $table->prepare_items();



    $message = '';

    if ('delete' === $table->current_action()) {

        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'custom_table_example'), count($_REQUEST['id'])) . '</p></div>';

    }

    ?>

<div class="wrap">



    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>

    <h2><?php _e('Categories', 'custom_table_example')?> <a class="add-new-h2"

                                 href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=category_form');?>"><?php _e('Add new', 'custom_table_example')?></a>

    </h2>

    <?php echo $message; ?>



    <form id="persons-table" method="GET">

        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>

        <?php $table->display() ?>

    </form>



</div>

<?php

}




















?>