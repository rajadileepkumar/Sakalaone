<?php
/**
* Plugin Name: Payment History
* Plugin URI: https://www.github.com/rajadileepkumar
* Description: Payment History Of Subscribers
* Version: 1.0.0
* Author: Raja Dileep Kumar
* Author URI: https://github.com/rajadileepkumar
* License: GPL2
*/
define('PATH1',plugin_dir_path(__FILE__ ));
include_once  PATH1 .'include/payment_history_list.php';
if(!class_exists('Payment_History')){
    class Payment_History{
    	public function __construct()
        {
            add_action('admin_menu', array($this,'payment_history_menu'));
        }

        public function payment_history_menu(){
        	add_menu_page('Payment History', 'Payment History', 'edit_pages', 'payment_history', array($this,'payment_history_page'));
        }
        public function payment_history_page(){
            global $wpdb;
        	$project_list = new Payment_List();
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
$obj = new Payment_History();

?>