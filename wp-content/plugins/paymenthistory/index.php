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
        	$payment_list = new Payment_List();
            $payment_list->prepare_items();
            ?>
                <div class="wrap">
                    <div id="icon-users" class="icon32"></div>
                    <h2>Payment History</h2>
                    <p>
                        <?php 
                            $array_count = array('Success','Intiated','Aborted','Failure');
                            global $wpdb;
                            foreach ($array_count as $key) {
                                $sql = "Select count(pStatus) from wp_payment_history as t INNER JOIN wp_users t1 ON t.userId = t1.ID where pStatus='$key'";
                                $result = $wpdb->get_var($sql);
                                echo "<span>Total Payment $key : </span>".$result . "|";
                            }
                        ?>
                    </p>
                    <table class="wp-list-table widefat fixed striped payments">
                        <thead>
                            <tr>
                                <th class="manage-column column-pId column-primary" scope="col" id="pId">PID</th>
                                <th class="manage-column column-user_login" scope="col" id="user_login">Username</th>
                                <th class="manage-column column-pAmount" scope="col" id="pAmount">Amount</th>
                                <th class="manage-column column-pStatus" scope="col" id="pStatus">Status</th>
                                <th class="manage-column column-pDate" scope="col" id="pDate">Date</th>
                                <th class="manage-column column-orderId" scope="col" id="orderId">Orderid</th>
                                <th class="manage-column column-trackingId" scope="col" id="trackingId">CCA reference No</th>
                        </tr>
                        </thead>
                        <tbody id="the-list" data-wp-lists="list:payment">
                            <?php 
                                global $wpdb;
                                $per_page = 50;
                                //$paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
                                if(isset($_GET['paged'])){
                                    $paged = $_GET['paged'];
                                }
                                else{
                                    $paged = 1;
                                }
                                $startFrom = ($paged-1)*$per_page;
                                
                                $sql = "SELECT pId,user_login,pAmount,pStatus,pDate,orderId,trackingId FROM ".$wpdb->prefix."payment_history as t INNER JOIN ".$wpdb->prefix."users as t1 on t.userId = t1.ID";   
                                $sql .= " ORDER BY pId desc";
                                $sql .= " LIMIT $paged,$per_page";
                                $result = $wpdb->get_results($sql);
                                $url =  get_admin_url(get_current_blog_id()).'admin.php?page=payment_history&paged=';
                                /*for ($i=1; $i<=$total_pages; $i++) { 
                                    echo "<a href=".$url."".$i.">".$i."</a>";
                                }*/
                                //echo "<a href='pagination.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
                                foreach ($result as $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $data->pId?></td>
                                        <td><?php echo $data->user_login?></td>
                                        <td><?php echo $data->pAmount?></td>
                                        <td><?php echo $data->pStatus?></td>
                                        <td><?php echo $data->pDate?></td>
                                        <td><?php echo $data->orderId?></td>
                                        <td><?php echo $data->trackingId?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php 
                        /*$sql = "SELECT count(pId) FROM ".$wpdb->prefix."payment_history as t INNER JOIN ".$wpdb->prefix."users as t1 on t.userId = t1.ID";   
                        $result = $wpdb->get_var($sql);
                        $total_pages = ceil($result / $per_page);
                        $pagLink = "<div class='pagination'>";  
                            for ($i=1; $i<=$total_pages; $i++) {  
                                    $pagLink .= "<a href=".$url."".$i.">".$i."</a>";  
                            };  
                        echo $pagLink . "</div>";  */
                    ?>    
                    <form id="persons-table" method="GET">
                        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                        <?php $payment_list->display() ?>
                    </form>
                </div>
            <?php
        } 		
    }
}
$obj = new Payment_History();

?>