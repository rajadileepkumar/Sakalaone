<?php
/**
* Plugin Name: Vendor Design
* Plugin URI: https://www.github.com/rajadileepkumar
* Description: Vendor Login Design and Registration add user created
* Version: 1.0.0
* Author: Raja Dileep Kumar
* Author URI: https://github.com/rajadileepkumar
* License: GPL2
*/
define('DIR_PATH_FILE',plugin_dir_path(__FILE__));
if(!class_exists('Vendor_Design')){
	class Vendor_Design{
		public function __construct(){
			add_action('init',array($this,'vendor_menu_pages'));
		}

		public function vendor_menu_pages(){
			add_menu_page('Vendor Recharge','Vendor Passbook','manage_wpse_173073','vendor_passbook',array($this,'vendor_passbook_page'),'dashicons-admin-home',6);
			add_menu_page('Student Registration','Student Registration','manage_wpse_173073','student_register',array($this,'student_passbook_page'),'dashicons-admin-users',6);
			add_action('admin_init',array($this,'add_menu_caps'));
		}

		public function add_menu_caps(){
			// gets the custom role
    		$role = get_role('vendor');
    		$role->add_cap('manage_wpse_173073'); 
		}

		public function vendor_passbook_page(){
			?>
				<div class="wrap">
					<div id="icon-users" class="icon32"></div>
					<h2>Recharge<a target="_blank" href="<?php echo site_url('/vendor-payment/')?>" class="add-new-h2">Add Money</a><p style="float:right;display:inline;">Balance : </p></h2>
					<h2>Passbook</h2>
				</div>
			<?php
		}

		public function student_passbook_page(){
			?>
				<div class="wrap">
					<div id="icon-users" class="icon32"></div>
					<h2>Student Registration<a target="_blank" href="<?php echo site_url('/student-register/')?>" class="add-new-h2">Add New</a></h2>
					<h2>Student Registers</h2>
				</div>
			<?php	
		}
	}
}
$obj = new Vendor_Design();
// Hide the "Please update now" notification
function hide_update_notice() {
   remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action( 'admin_notices', 'hide_update_notice', 1 );
?>