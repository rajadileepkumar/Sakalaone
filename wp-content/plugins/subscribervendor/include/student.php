<?php 
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Student_list extends WP_List_Table{
    public function __construct()
    {
        global $status, $page;                
        parent::__construct([
            'singular' => __('Student List'),
            'plural' => __('Student List'),
        ]);
    }

    private function table_data($customvar){
        global $wpdb;
        $data=array();
        $field_name_one = array();
        $field_name_two = array();
        $field_name_three = array();
        $field_name_four = array();
        if($customvar == 'all'){
            $wk_post=$wpdb->get_results("SELECT * from wp_users as u INNER join wp_usermeta as um INNER JOIN wp_users_metadata umm on u.ID = um.user_id and u.ID = umm.id WHERE meta_key = 'wp_capabilities' AND meta_value = 'a:1:{s:10:\"subscriber\";b:1;}'");
        }
        else if ($customvar == 'payementsuccess') {
           $wk_post=$wpdb->get_results("SELECT * from wp_users as u INNER join wp_usermeta as um INNER JOIN wp_users_metadata umm on u.ID = um.user_id and u.ID = umm.id WHERE meta_key = 'wp_capabilities' AND meta_value = 'a:1:{s:10:\"subscriber\";b:1;}' AND umm.paymentstatus = 1 AND umm.checkstatus = 1");
        }
        else if($customvar == 'paymentfailure'){
            $wk_post=$wpdb->get_results("SELECT * from wp_users as u INNER join wp_usermeta as um INNER JOIN wp_users_metadata umm on u.ID = um.user_id and u.ID = umm.id WHERE meta_key = 'wp_capabilities' AND meta_value = 'a:1:{s:10:\"subscriber\";b:1;}' AND umm.paymentstatus = 0 AND umm.checkstatus = 1");
        }
        $i=0;
        foreach ($wk_post as $value) {   
            $field_name_one[] = $value->ID;
            $field_name_two[] = $value->user_login;
            $field_name_three[] = $value->paymentstatus;
            $field_name_four[] = $value->subendate;            
            $data[] = array(
                'ID' => $field_name_one[$i],
                'user_login' => $field_name_two[$i],
                'paymentstatus' => $field_name_three[$i],
                'subendate' => $field_name_four[$i],
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
    public function get_columns()
    {
        $columns = array(
            'ID' => 'ID',
            'user_login' => 'UserLogin',
            'paymentstatus' => 'Payement Status',
            'subendate' => 'Subscription End Data'
        );

        return $columns;
    }

    public function get_hidden_columns(){
        return array();
    }

    public function get_sortable_columns()
    {
        return array('ID' => array('ID',false));
    }

    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    public function search_box($s,$ss){
        ?>
        <p class="search-box">
            <label class="screen-reader-text" for="search_id-search-input">
            search:</label> 
            <input id="search_id-search-input" type="text" name="s" value="" /> 
            <input id="search-submit" class="button" type="submit" name="" value="search" />
        </p>
        <?php
    }

    public  function get_views(){
        $views = array();
           $current = ( !empty($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');
           //All link
           $class = ($current == 'all' ? ' class="current"' :'');
           $all_url = remove_query_arg('customvar');
           $views['all'] = "<a href='{$all_url }' {$class} >All</a>";

           //Foo link
           $foo_url = add_query_arg('customvar','payementsuccess');
           $class = ($current == 'payementsuccess' ? ' class="current"' :'');
           $views['payementsuccess'] = "<a href='{$foo_url}' {$class} >Payement Success</a>";

           //Bar link
           $bar_url = add_query_arg('customvar','paymentfailure');
           $class = ($current == 'paymentfailure' ? ' class="current"' :'');
           $views['paymentfailure'] = "<a href='{$bar_url}' {$class} >Payement Failure</a>";

           return $views;
    }

    /*public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['pid']
        );
    }*/

    /*public function get_bulk_actions()
    {
        $actions = array(
            'edit' => 'Edit',
        );
        return $actions;
    }*/



    /*public function column_id($item) {
        $actions = array(
            'edit'      => sprintf('<a href="?page=employee_list%s&action=%s&id=%s">Edit</a>',$_REQUEST[''],'edit',$item['id'])
        );

        return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions) );
    }*/
}
?>