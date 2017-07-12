<?php 
/**
* Plugin Name: Subscriber And Vendor Register Details
* Plugin URI: https://www.github.com/rajadileepkumar
* Description: Vendor Login Design and Registration add user created
* Version: 1.0.0
* Author: Raja Dileep Kumar
* Author URI: https://github.com/rajadileepkumar
* License: GPL2
*/
define('PATH2',plugin_dir_path(__FILE__ ));
include_once  PATH2.'include/student.php';
include_once  PATH2.'include/vendor.php';
if(!class_exists('Subscriber_Vendor')){
    class Subscriber_Vendor{
    	public function __construct()
        {
            add_action('admin_menu', array($this,'subscriber_vendor_menu'));
        }

        public function subscriber_vendor_menu(){
        	add_menu_page('Registerd Users', 'Registerd Users', 'edit_pages', 'registerd_users', array($this,'registerd_users_page'));
        	add_submenu_page('registerd_users','Vendor Registerd Users','Vendor Registerd Users','edit_pages','vendor_users_page',array($this,'vendor_users_page'));
        }

        public function registerd_users_page(){
			$project_list = new Student_list();
            $project_list->prepare_items();
            ?>
            <div class="top-header"></div>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h2>List Of Students</h2>
                <?php $project_list->views(); ?>
                <form id="persons-table" method="GET">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                    <?php $project_list->prepare_items(); ?>
                    <?php $project_list->display() ?>
                </form>
            </div>
            <?php
        }

        public function vendor_users_page(){
        	$project_list = new Vendor_list();
            $project_list->prepare_items();
            ?>
            <div class="top-header"></div>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h2>List Of Students</h2>
                <?php $project_list->views(); ?>
                <form id="persons-table" method="GET">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                    <?php $project_list->prepare_items(); ?>
                    <?php $project_list->display() ?>
                </form>
            </div>
            <?php
        }
    }
}
$obj = new Subscriber_Vendor();    
?>