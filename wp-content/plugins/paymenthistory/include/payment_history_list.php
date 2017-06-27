<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Payment_List extends WP_List_Table{
    public function __construct()
    {
        parent::__construct([
            'singular' => __('Payment'),
            'plural' => __('Payments'),
        ]);
    }

    private function table_data($customvar){
        global $wpdb;
        $data = array();
        $field_name_one = array();
        $field_name_two = array();
        $field_name_three = array();
        $field_name_four = array();
        $field_name_five = array();
        $field_name_six = array();
        $field_name_seven = array();
        $field_name_eight = array();
        if($customvar == 'all'){
            $wk_post=$wpdb->get_results("SELECT * FROM wp_users as wu INNER JOIN wp_payment_history as wp on wu.ID = wp.userId"); 
        }
        if($customvar == 'Success'){
            $wk_post=$wpdb->get_results("SELECT * FROM wp_users as wu INNER JOIN wp_payment_history as wp on wu.ID = wp.userId where wp.pStatus='$customvar'"); 
        }

        if($customvar == 'Intiated'){
            $wk_post=$wpdb->get_results("SELECT * FROM wp_users as wu INNER JOIN wp_payment_history as wp on wu.ID = wp.userId where wp.pStatus='$customvar'"); 
        }

        if($customvar == 'Aborted'){
            $wk_post=$wpdb->get_results("SELECT * FROM wp_users as wu INNER JOIN wp_payment_history as wp on wu.ID = wp.userId where wp.pStatus='$customvar'"); 
        }

        if($customvar == 'Failure'){
            $wk_post=$wpdb->get_results("SELECT * FROM wp_users as wu INNER JOIN wp_payment_history as wp on wu.ID = wp.userId where wp.pStatus='$customvar'"); 
        }

        if($customvar == 'Auto-Cancelled'){
            $wk_post=$wpdb->get_results("SELECT * FROM wp_users as wu INNER JOIN wp_payment_history as wp on wu.ID = wp.userId where wp.pStatus='$customvar'"); 
        }

        $i=0;
        foreach ($wk_post as $value) {   
            $field_name_one[] = $value->pId;
            $field_name_two[] = $value->user_login;
            $field_name_three[] = $value->pAmount;
            $field_name_four[] = $value->pStatus;
            $field_name_five[] = $value->pDate;
            $field_name_six[] = $value->orderId;
            $field_name_seven[] = $value->trackingId;
            $field_name_eight[] = $value->userId;                        
            $data[] = array(
                'pId' => $field_name_one[$i],
                'user_login' => $field_name_two[$i],
                'pAmount' => $field_name_three[$i],
                'pStatus' => $field_name_four[$i],
                'pDate' => $field_name_five[$i],
                'orderId' => $field_name_six[$i],
                'trackingId' => $field_name_seven[$i],
                'userId' => $field_name_eight[$i]
            );
            $i++;
        }
        return $data;

    }

    public function prepare_items()
    {
        global $wpdb;

        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $customvar = ( isset($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');
        $perPage = 10; 
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->process_bulk_action();
        $currentPage = $this->get_pagenum();

        $data = $this->table_data($customvar);
        $totalitems = count($data);
        $this->set_pagination_args( array(
            'total_items' => $totalitems,
            'per_page'    => $perPage
        ) );
        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    private function sort_data($a,$b){
        $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'ID'; //If no sort, default to title
        $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
        $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
        return ($order==='asc') ? $result :-$result; //Send final sort direction to usort
    }

    public  function get_views(){
       $views = array();
       $current = ( !empty($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');
       //All link
       $class = ($current == 'all' ? ' class="current"' :'');
       $all_url = remove_query_arg('customvar');
       $views['all'] = "<a href='{$all_url }' {$class} >All</a>";

       //Foo link
       $foo_url = add_query_arg('customvar','Success');
       $class = ($current == 'Success' ? ' class="current"' :'');
       $views['Success'] = "<a href='{$foo_url}' {$class} >Payement Success</a>";

       //Bar link
       $bar_url = add_query_arg('customvar','Failure');
       $class = ($current == 'Failure' ? ' class="current"' :'');
       $views['Failure'] = "<a href='{$bar_url}' {$class} >Payement Failure</a>";

       $bar_url = add_query_arg('customvar','Intiated');
       $class = ($current == 'Intiated' ? ' class="current"' :'');
       $views['Intiated'] = "<a href='{$bar_url}' {$class} >Payement Intiated</a>";

       $bar_url = add_query_arg('customvar','Aborted');
       $class = ($current == 'Aborted' ? ' class="current"' :'');
       $views['Aborted'] = "<a href='{$bar_url}' {$class} >Payement Aborted</a>";

       $bar_url = add_query_arg('customvar','Auto-Cancelled');
       $class = ($current == 'Auto-Cancelled' ? ' class="current"' :'');
       $views['Auto-Cancelled'] = "<a href='{$bar_url}' {$class} >Auto-Cancelled</a>";

       return $views;
    }


    public function get_columns()
    {
        $columns = array(
            'pId' => 'PID',
            'user_login' => 'Username',
            'pAmount' => 'Amount',
            'pStatus' => 'Status',
            'pDate' => 'Date',
            'orderId' => 'Orderid',
            'trackingId' => 'CCA reference No',
            'userId' => 'User Id'
            
        );

        return $columns;
    }

    public function get_hidden_columns(){
        return array();
    }

    public function get_sortable_columns()
    {
        return array('id' => array('id',false));
    }

    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

}
?>