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
			add_action('init',array($this,'vendor_plugin_install'));
		}

		public function vendor_plugin_install(){
			add_role( 'vendor', 'Vendor', array(

'read' => true, // true allows this capability
'edit_posts' => true, // Allows user to edit their own posts
'edit_pages' => true, // Allows user to edit pages
'edit_others_posts' => true, // Allows user to edit others posts not just their own
'create_posts' => true, // Allows user to create new posts
'manage_categories' => true, // Allows user to manage post categories
'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
'edit_themes' => false, // false denies this capability. User can’t edit your theme
'install_plugins' => false, // User cant add new plugins
'update_plugin' => false, // User can’t update any plugins
'update_core' => false // user cant perform core updates

));
		}
	}
}
$obj = new Vendor_Design();
?>