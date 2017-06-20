<?php
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Sent_SMS_List_Table extends WP_List_Table {   
 
	public $notify='';
    
    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'message',     //singular name of the listed records
            'plural'    => 'messages',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }    
    
    /** ************************************************************************
     * For more detailed insight into how columns are handled, take a look at 
     * WP_List_Table::single_row_columns()
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item, $column_name){
        switch($column_name){
            case 'mobile':
            case 'message':
			case 'ip':
			case 'sent_time':
			case 'response':
                return $item->$column_name;
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }
    
        
    /** ************************************************************************    
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_user_id($item){
        
        //Build row actions
        $actions = array(
            //'edit'      => sprintf('<a href="?page=%s&action=%s&sent_sms=%s">Edit</a>',$_REQUEST['page'],'edit',$item->id),
            //'delete'    => sprintf('<a href="?page=%s&action=%s&sent_sms=%s">Delete</a>',$_REQUEST['page'],'delete',$item->id),
        );
        
        //Return the title contents
		if(!$user_info=get_userdata($item->user_id))
			$user_info->user_login='Anonymous';
        return sprintf('%1$s <span style="color:silver">(ip:%2$s)</span>%3$s',
            /*$1%s*/ $user_info->user_login,
            /*$2%s*/ $item->ip,
            /*$3%s*/ $this->row_actions($actions)
        );
    }
    
    /** ************************************************************************
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item->id                //The value of the checkbox should be the record's id
        );
    }
    
    
    /** ************************************************************************
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'user_id'     => 'User',
            'mobile'    => 'Mobile',
            'message'  => 'Message',
			'response'  => 'Response',
			'sent_time'  => 'Sent Date'
        );
        return $columns;
    }
    
    /** ************************************************************************
     * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
     **************************************************************************/
    function get_sortable_columns() {
        $sortable_columns = array(
            'user_id'     => array('user_id',false),     //true means its already sorted
            'mobile'    => array('mobile',false),
			'message'  => array('message',false),
			'response'  => array('response',false),
            'sent_time'  => array('sent_time',true)
        );
        return $sortable_columns;
    }
    
    
    /** ************************************************************************
     * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }
    
    
    /** ************************************************************************
     * @see $this->prepare_items()
     **************************************************************************/
    function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
			$message_ids=$_REQUEST['message'];
			global $wpdb;
			foreach($message_ids as $message_id) 
			{
				$wpdb->query('delete from wp_sent_sms where id='.$message_id);
			}
            //wp_die('Items deleted (or they would be if we had items to delete)!');
			$this->notify="Successfully Deleted";
			wp_redirect($_REQUEST['_wp_referrer']);
        }
        
    }
    
    
    /** ************************************************************************
     * @uses $this->_column_headers
     * @uses $this->items
     * @uses $this->get_columns()
     * @uses $this->get_sortable_columns()
     * @uses $this->get_pagenum()
     * @uses $this->set_pagination_args()
     **************************************************************************/
    function prepare_items() {
		$per_page = 25; 
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();                
    
	    global $wpdb;
		$orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'sent_time'; //If no sort, default to title
	    $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
		$query='select * from wp_sent_sms order by '. $orderby . ' ' .$order;
	    $data = $wpdb->get_results($query); 
		//echo var_dump($data);
      
        $current_page = $this->get_pagenum();  
        $total_items = count($data); 
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }
    
}
