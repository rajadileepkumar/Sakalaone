<?php 
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Vendor_list extends WP_List_Table{
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
        $wp_users = $wpdb->prefix.'users';
        $wp_vendor_metadata = $wpdb->prefix.'vendor_metadata';
        $wp_users_metadata = $wpdb->prefix.'usermeta';
        $data=array();
        $field_name_one = array();
        $field_name_two = array();
        $field_name_three = array();
        $field_name_four = array();
        
        if($customvar == 'all'){
            $wk_post=$wpdb->get_results("SELECT u.ID,u.user_login,u.user_email,vm.vstatus,vm.vcreated_date FROM $wp_users as u INNER JOIN $wp_vendor_metadata as vm INNER JOIN $wp_users_metadata as um ON u.ID = vm.vuser_id AND u.ID = um.user_id WHERE um.meta_key = 'wp_capabilities' AND um.meta_value = 'a:1:{s:6:\"vendor\";b:1;}'");
        }
        else if ($customvar == 'active_vendors') {
           $wk_post=$wpdb->get_results("SELECT u.ID,u.user_login,u.user_email,vm.vstatus,vm.vcreated_date FROM $wp_users as u INNER JOIN $wp_vendor_metadata as vm INNER JOIN $wp_users_metadata as um ON u.ID = vm.vuser_id AND u.ID = um.user_id WHERE um.meta_key = 'wp_capabilities' AND um.meta_value = 'a:1:{s:6:\"vendor\";b:1;}' AND vm.vstatus=1 ORDER BY vm.vid DESC");
        }
        else if($customvar == 'deactive_vendors'){
            $wk_post=$wpdb->get_results("SELECT u.ID,u.user_login,u.user_email,vm.vstatus,vm.vcreated_date FROM $wp_users as u INNER JOIN $wp_vendor_metadata as vm INNER JOIN $wp_users_metadata as um ON u.ID = vm.vuser_id AND u.ID = um.user_id WHERE um.meta_key = 'wp_capabilities' AND um.meta_value = 'a:1:{s:6:\"vendor\";b:1;}' AND vm.vstatus=0 ORDER BY vm.vid DESC");
        }
        $i=0;
        foreach ($wk_post as $value) {   
            $field_name_one[] = $value->ID;
            $field_name_two[] = $value->user_login;
            if($value->vstatus == 0){
                $field_name_three[] = 'Deactive';
            }
            elseif ($value->vstatus == 1){
                $field_name_three[] = 'Active';
            }
            $vmobile = get_user_meta($value->ID,'vmobile',true);
            $field_name_four[] = $value->vcreated_date;
            $field_name_five[] = $value->user_email;
            
            if ($value->vstatus == 1){
                $field_name_six[] =  '<a href="?page=vendor_edit&user_id='.$value->ID.'">Edit</a>'.'<a style="padding-left:10px;" href="?page=vendor_wallet_history&user_id='.$value->ID.'">View</a>';     
            }

            elseif ($value->vstatus == 0){
                $field_name_six[] =  '<a href="?page=vendor_edit&user_id='.$value->ID.'">Edit</a>';     
            }

            $field_name_seven[] = $vmobile;

            $data[] = array(
                'userId' => $field_name_one[$i],
                'user_login' => $field_name_two[$i],
                'vcreated_date' => $field_name_four[$i],
                'user_email' => $field_name_five[$i],
                'vstatus' => $field_name_three[$i],
                'edit' => $field_name_six[$i],
                'vmobile' => $field_name_seven[$i]
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
        usort( $data, array( &$this, 'sort_data' ));
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
        echo $orderby;
        $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'userId'; //If no sort, default to title
        $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
        $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
        return ($order==='asc') ? $result :-$result; //Send final sort direction to usort
    }
    public function get_columns()
    {
        $columns = array(
            'userId' => 'UserId',
            'user_login' => 'Login Name',
            'vmobile' => 'Mobile',
            'user_email' => 'Email',
            'vcreated_date' => 'Created Date',
            'vstatus' => 'Status',
            'edit' => 'Actions',
        );

        return $columns;
    }

    public function get_hidden_columns(){
        return array();
    }

    public function get_sortable_columns()
    {
        return array('userId' => array('userId',false));
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
           $foo_url = add_query_arg('customvar','active_vendors');
           $class = ($current == 'active_vendors' ? ' class="current"' :'');
           $views['active_vendors'] = "<a href='{$foo_url}' {$class} >Active Vendors</a>";

           //Bar link
           $bar_url = add_query_arg('customvar','deactive_vendors');
           $class = ($current == 'deactive_vendors' ? ' class="current"' :'');
           $views['deactive_vendors'] = "<a href='{$bar_url}' {$class} >Deactive Vendors</a>";

           return $views;
    }

    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['pid']
        );
    }

    /*public function get_bulk_actions()
    {
        $actions = array(
            'edit' => 'Edit',
        );
        return $actions;
    }*/



    public function column_id($item) {
        $actions = array(
            'edit'      => sprintf('<a href="?page=employee_list%s&action=%s&id=%s">Edit</a>',$_REQUEST[''],'edit',$item['id'])
        );

        return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions) );
    }
}