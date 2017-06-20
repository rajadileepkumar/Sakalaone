<?php
/**
 * Plugin Name: Terms and Conditions
 * Plugin URI: https://www.github.com/rajadileepkumar
 * Description: Terms and Conditions Under Settings Page
 * Version: 1.0.0
 * Author: Raja Dileep Kumar
 * Author URI: https://github.com/rajadileepkumar
 * License: GPL2
 */
define('WP_DEBUG',true);
if(!class_exists('Terms_Conditions')){
	class Terms_Conditions{
		public function __construct(){
			add_action('admin_menu',array($this,'terms_conditions_page'));
			add_action('wp_enqueue_scripts',array($this,'terms_condition_scripts'));
		}

		public function terms_conditions_page(){
			add_options_page(__('Terms_Conditions','textdomain'),__('Terms Conditions','textdomain'),'manage_options','terms_condition',array($this,'terms_condition_callback'));
		}

		public function terms_condition_callback(){
			
			?>
				<div class="wrap">
					<h2>Terms and Conditions</h2>
					<form action="options.php" method="post">
						<?php wp_nonce_field('update-options');?>
						<p>
							<strong>Terms And Conditions</strong>
							<textarea cols="50" rows="10" name="terms_conditions" style="vertical-align: middle"><?php echo esc_textarea(get_option('terms_conditions'))?></textarea>
						</p>
                        <p>
                            <strong>Piracy Control</strong>
                            <textarea cols="50" rows="10" name="piracy_term_conditions" style="vertical-align: middle"><?php echo esc_textarea(get_option('piracy_term_conditions'))?></textarea>
                        </p>
						<p>
							<input type="submit" value="Save" class="button button-primary">
						</p>
						<input type="hidden" name="action" value="update">
                    	<input type="hidden" name="page_options" value="terms_conditions,piracy_term_conditions">
					</form>
				</div>
			<?php
		}

		public function terms_condition_scripts(){
			$terms = get_option('terms_conditions');
			$array	= '<div class="modal fade" id="myModal" role="dialog">';
				$array .= '<div class="modal-dialog modal-lg">';
					$array .= '<div class="modal-content">';
						$array .= '<div class="modal-header">';
							$array .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
          					$array .= '<h4 class="modal-title">Terms & Conditions</h4>';
						$array .= '</div>';
						$array .= '<div class="modal-body">';
							$array .= '<p>'.$terms.'</p>';
						$array .= '</div>';
						$array .= '<div class="modal-footer">';
							$array .= '<input type="checkbox" class="btn btn-default" data-dismiss="modal"/> Terms & Conditions';
							$array .='<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
						$array .= '</div>';
					$array .= '</div>';
				$array .= '</div>';
			$array .= '</div>';
			

			// Register the script
			wp_register_script( 'some_handle', plugin_dir_url( __FILE__ ) .'js/myscript.js');
			
			// Localize the script with new data
			
			$translation_array = array('some_string' => $array);
			wp_localize_script('some_handle','object_name',$translation_array );
			wp_enqueue_script('some_handle');
			?>
			
			<?php
		}
	}
}
$terms = new Terms_Conditions();
?>