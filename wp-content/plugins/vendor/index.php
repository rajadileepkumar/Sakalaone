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
			add_menu_page('Student Registration','Student Registration','manage_wpse_173073','student_register_grid',array($this,'student_register_grid'),'dashicons-admin-users',6);
			add_submenu_page('','Student Registration','Student Registration','manage_wpse_173073','student_registration',array($this,'student_registration'));
			add_submenu_page('','Student Confirmation','Student Confirmation','manage_wpse_173073','student_confirmation',array($this,'student_confirmation'));
			add_action('admin_init',array($this,'add_menu_caps'));
		}

		public function plugin_scripts_admin(){

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

		public function student_register_grid(){
			?>
				<div class="wrap">
					<div id="icon-users" class="icon32"></div>
					<h2>Student Registration<a href="<?php echo admin_url('admin.php?page=student_registration')?>" class="add-new-h2">Add New</a></h2>
					<h2>Students</h2>
				</div>
			<?php	
		}

		public function student_registration(){
			?>
				<div class="wrap">
					<div id="icon-users" class="icon32"></div>
					<h2>Student Registration<a href="<?php echo admin_url('admin.php?page=student_register_grid')?>" class="add-new-h2">Back</a></h2>
					<form action="<?php echo admin_url('?page=student_confirmation')?>" method="post">
						<table class="form-table">
                            <tr class="user-mobile-wrap">
                                <th>
                                    <label for="mobile">Mobile</label>
                                </th>
                                <td>
                                    <input type="text" name="vmobile" id="vmobile" required/>                
                                </td>
                            </tr>
                            <tr class="user-password-wrap">
                                <th>
                                    <label for="password">Password</label>
                                </th>
                                <td>
                                    <input type="password" name="password" id="password" required/>                
                                </td>
                            </tr>
                            <tr class="user-confirm-password-wrap">
                                <th>
                                    <label for="confirm-password">Confirm Password</label>
                                </th>
                                <td>
                                    <input type="password" name="confirm-password" id="confirm-password" required/>                
                                </td>
                            </tr>
                            <tr class="user-qualification-wrap">
                                <th>
                                    <label for="password">Qualification</label>
                                </th>
                                <td>
                                    <select required name="qul" id="qul" class="form-control" onchange="print_qual_sub('qual_sub',this.selectedIndex);">
                                    </select>
                                    <script type="text/javascript">print_quly("qul");</script>
                                    
                                </td>
                                <td>
                                    <select class="form-control" name="qual_sub" id="qual_sub" disabled onchange="print_name(this)">
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <p>
                        	<input type="submit" value="Register" name="register" id="register" class="button button-primary">
                        </p>    
					</form>
				</div>
				<script type="text/javascript">
					var $ = jQuery.noConflict();
					$('#qul').change(function () {
					    if(this.value == -1){
					        $('#qual_sub').prop("disabled",true);
					    }
					    else {
					        $('#qual_sub').prop("disabled",false);
					    }

					});
				</script>
			<?php 
		}

		public function student_confirmation(){
			?>
				<div class="wrap">
					<div id="icon-users" class="icon32"></div>
					<h2>Student Confirmation<a href="<?php echo admin_url('admin.php?page=student_registration')?>" class="add-new-h2">Back</a></h2>
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