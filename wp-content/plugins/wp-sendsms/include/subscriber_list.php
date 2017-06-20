<?php 
	if(!class_exists('WP_List_Table')){
    	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}

	class Subscriber_List_Table extends WP_List_Table{
		public $notify='';
    
    function __construct(){
        global $status, $page;
            //Set parent defaults
	        parent::__construct( array(
	            'singular'  => 'subscribe',     //singular name of the listed records
	            'plural'    => 'subscriber`',    //plural name of the listed records
	            'ajax'      => false        //does this table support ajax?
	        ) );
	        
	    }

	    function column_default($item, $column_name){
	        switch($column_name){
	            case 'id':
	            case 'firstname':
				case 'lastname':
				case 'mobile':
				case 'sname':
	                return $item->$column_name;
	            default:
	                return print_r($item,true); //Show the whole array for troubleshooting purposes
	        }
	    }

	    function get_columns(){
	        $columns = array(
	            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
	            'id'     => 'Id',
	            'firstname'    => 'First Name',
	            'lastname'  => 'Last Name',
	            'mobile'	=> 'Mobile',
				'sname'  => 'Subscription List',
	        );
	        return $columns;
	    }

	    function get_sortable_columns() {
	        $sortable_columns = array(
	            'id'     => array('id',false),     //true means its already sorted
	            'firstname'    => array('firstname',false),
				'lastname'  => array('lastname',false),
				'mobile'  => array('mobile',false),
	            'sname'  => array('sname',true)
	        );
	        return $sortable_columns;
	    }

	    function get_bulk_actions() {
	        $actions = array(
	            'delete'    => 'Delete'
	        );
	        return $actions;
	    }

	    function process_bulk_action() {
        
	        //Detect when a bulk action is being triggered...
	        if( 'delete'===$this->current_action() ) {
				$message_ids=$_REQUEST['subscribe'];
				echo $message_ids;
				global $wpdb;
				foreach($message_ids as $message_id) 
				{
					//var_dump("delete from wp_subscriber where a.id = $message_id");
					$wpdb->query("delete from wp_subscriber where id = $message_id");
				}
	            //wp_die('Items deleted (or they would be if we had items to delete)!');
				$this->notify="Successfully Deleted";
				wp_redirect($_REQUEST['_wp_referrer']);
	        }
        
    	}

    	function prepare_items() {
			$per_page = 25; 
			$columns = $this->get_columns();
			$hidden = array();
			$sortable = $this->get_sortable_columns();
			$this->_column_headers = array($columns, $hidden, $sortable);
			$this->process_bulk_action();                
	    
		    global $wpdb;
			$orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to title
		    $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
			$query='select a.id,a.firstname,a.lastname,a.mobile,b.sname from wp_subscriber a,wp_subscription b where a.id = b.aid order by '. $orderby . ' ' .$order;
			//var_dump($query);
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

	    function column_cb($item){
	        return sprintf(
	            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
	            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
	            /*$2%s*/ $item->id                //The value of the checkbox should be the record's id
	        );
	    }


	    function column_name($item) {
		    $actions = array(
		        'edit' => sprintf('<a href="?page=%s&action=%s&=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
		        'delete' => sprintf('<a href="?page=%s&action=%s&=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
		    );
		    return sprintf('%1$s %2$s', $item['Name'], $this->row_actions($actions) );
		}    
	}
?>