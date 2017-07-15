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
ob_start();
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
            add_submenu_page('','Vendor Edit','Vendor Edit','edit_pages','vendor_edit',array($this,'vendor_edit'));
            add_submenu_page('','Vendor Wallet History','Vendor Wallet History','edit_pages','vendor_wallet_history',array($this,'vendor_wallet_history'));
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
                <h2>List Of Vendors</h2>
                <?php $project_list->views(); ?>
                <form id="persons-table" method="GET">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                    <?php $project_list->prepare_items(); ?>
                    <?php $project_list->display() ?>
                </form>
            </div>
            <?php
        }

        public function vendor_edit(){
            $userId = $_GET['user_id'];
            global $wpdb;
            $wp_users = $wpdb->prefix.'users';
            $wp_vendor_metadata = $wpdb->prefix.'vendor_metadata';
            $wp_users_metadata = $wpdb->prefix.'usermeta';
            ?>
                <div class="wrap">
                    <div id="icon-users" class="icon32"></div>
                    <h2>Vendor Edit</h2>
                    <a href="<?php echo admin_url('admin.php?page=vendor_users_page')?>" class="button button-primary">Back</a>
                    <?php
                        $result = $wpdb->get_results("SELECT u.ID,u.user_login,u.user_email,vm.vstatus,vm.vdocument_recevied,vm.vcreated_date FROM $wp_users u INNER JOIN $wp_vendor_metadata as vm on u.ID = vm.vuser_id WHERE u.ID=$userId");
                        foreach ($result as $value) {
                            $id = $value->ID;
                            $userLogin = $value->user_login;
                            $user_email = $value->user_email;
                            $status = $value->vstatus;
                            $document = $value->vdocument_recevied;
                            $createdDate = $value->vcreated_date;
                        }

                        if(isset($_POST)){
                            $statusUpdate = $_POST['updateStatus'];
                            $documentReceived = $_POST['documentReceived'];
                            $statusUpdateQuery = $wpdb->query("UPDATE $wp_users as u INNER JOIN $wp_vendor_metadata as vm ON u.ID = vm.vuser_id SET vm.vstatus=$statusUpdate,vdocument_recevied = $documentReceived WHERE vm.vuser_id = $id");
                            if($statusUpdateQuery){
                                $url = admin_url('admin.php?page=vendor_users_page');
                                wp_safe_redirect($url);
                            }
                            else{
                                $message .="Something Went Wrong";
                            }
                        }
                    ?>
                    <form action="" method="post">
                        <table class="form-table">
                            <tr>
                                <tr class="user-login-wrap">
                                    <th>
                                        <label for="userLogin">User Login</label>
                                    </th>
                                    <td>
                                        <input type="text" name="userLogin" id="userLogin" value="<?php echo $userLogin;?>"/>                
                                    </td>
                                </tr>
                                <tr class="user-email-wrap">
                                    <th>
                                        <label for="email">Email</label>
                                    </th>
                                    <td>
                                        <input type="text" name="userEmail" id="userEmail" value="<?php echo $user_email;?>"/>
                                    </td>
                                </tr>
                                <tr class="user-status-wrap">
                                    <th>
                                        <label for="status">Status</label>
                                    </th>
                                    <td>
                                        <select name="updateStatus">
                                            <option value="">Select Status</option>
                                            <option value="1" <?php echo ($status ==  '1') ? ' selected="selected"' : '';?> >Active</option>
                                            <option value="0" <?php echo ($status ==  '0') ? ' selected="selected"' : '';?> >Deactive</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="user-document-wrap">
                                    <th>
                                        <label for="status">Document Received</label>
                                    </th>
                                    <td>
                                        <input type="checkbox" name="documentReceived" id="documentReceived" value="1" <?php echo ($document ==  '1') ? 'checked="checked"' : '';?>>
                                    </td>
                                </tr>
                        </table>
                        <p>
                            <input type="submit" name="update" id="update" value="Update" class="button button-primary">
                        </p>
                    </form>
                </div>
            <?php
        }

        public function vendor_wallet_history(){
            ?>
                <div class="wrap">
                    <div id="icon-users" class="icon32"></div>
                    <h2>Wallet History</h2>
                    <a href="<?php echo admin_url('admin.php?page=vendor_users_page')?>" class="button button-primary">Back</a>
                </div>
            <?php    
        }
    }
}
$obj = new Subscriber_Vendor();    
ob_flush();
?>