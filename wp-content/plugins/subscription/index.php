<?php
/**
 * Plugin Name: Subscription and Packages
 * Plugin URI: https://www.github.com/rajadileepkumar
 * Description: Terms and Conditions Under Settings Page
 * Version: 1.0.0
 * Author: Raja Dileep Kumar
 * Author URI: https://github.com/rajadileepkumar
 * License: GPL2
 */
if(!class_exists('Subscription_Plans')){
    class Subscription_Plans{
        public function  __construct()
        {
            add_action('admin_menu',array($this,'subscription_menu_page'));
        }

        public function subscription_menu_page(){
            add_options_page(__('Subscription Plan Page','textdomain'),__('Payment Settings','textdomain'),'manage_options','subscription_plan_page',array($this,'subscription_plan_page_callback'));
        }

        public function subscription_plan_page_callback(){
            ?>
                <div class="wrap">
                    <h2>Subscription Plans</h2>
                    <form action="options.php" method="post">
                        <?php wp_nonce_field('update-options');?>
                        <p>
                            <strong>Subscription Plan Price:</strong><br>
                            <input type="text" name="s_price" size="45" value="<?php echo get_option('s_price');?>">
                        </p>
                        <p>
                            <strong>Subscription Plan Tax:</strong><br>
                            <input type="text" name="s_tax" size="45" value="<?php echo get_option('s_tax');?>">
                        </p>
                        <p>
                            <input type="submit" value="Save" class="button button-primary">
                        </p>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="page_options" value="s_price,s_tax">
                    </form>
                </div>
            <?php
        }
    }
}

$obj = new Subscription_Plans();
?>
