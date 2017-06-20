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

    public function prepare_items()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'payment_history'; // do not forget about tables prefix
        $table_name1 = $wpdb->prefix.'users';

        $columns = $this->get_columns();

        $hidden = $this->get_hidden_columns();

        $sortable = $this->get_sortable_columns();
        $page_number = 1;

        $per_page = 2; // constant, how much records will be shown per page
        // here we configure table headers, defined in our methods

        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->process_bulk_action();

        // will be used in pagination settings
        $total_items = $wpdb->get_var("SELECT COUNT(ID) FROM $table_name as t INNER JOIN $table_name1 as t1 ON t.userId = t1.ID");

        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;

        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'pDate';

        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';
        
        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        //var_dump("SELECT user_login,pAmount,pStatus,pDate,orderId,trackingId,FROM $table_name as t INNER JOIN $table_name1 as t1 on t.userId = t1.ID ORDER BY $orderby $order LIMIT $paged,$per_page"); 
        /*$sql = "SELECT user_login,pAmount,pStatus,pDate,orderId,trackingId FROM $table_name as t INNER JOIN $table_name1 as t1 on t.userId = t1.ID";   
        $sql .= " ORDER BY $orderby $order";
        $sql .= " LIMIT $per_page";
        $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
        $this->items = $wpdb->get_results( $sql, 'ARRAY_A' );
        var_dump($sql);*/

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT pId,user_login,pAmount,pStatus,pDate,orderId,trackingId FROM $table_name as t INNER JOIN $table_name1 as t1 on t.userId = t1.ID ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page,$paged),ARRAY_A);

        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));

    }

    public function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'pId' => 'PID',
            'user_login' => 'Username',
            'pAmount' => 'Amount',
            'pStatus' => 'Status',
            'pDate' => 'Date',
            'orderId' => 'Orderid',
            'trackingId' => 'CCA reference No',
            
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