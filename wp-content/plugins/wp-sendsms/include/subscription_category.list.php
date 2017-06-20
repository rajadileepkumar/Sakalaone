<?php 
	if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Subscription_List_Table extends WP_List_Table{
	public $notify='';
    
    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'categorie',     //singular name of the listed records
            'plural'    => 'categories',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'id':
            case 'subscription_cat_name':
			    return $item->$column_name;
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_cb($item) {
	  return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item->id                //The value of the checkbox should be the record's id
        );
	}

    function get_columns(){
	  $columns = array(
	  	'cb'        => '<input type="checkbox" />',
	    'id' => 'ID',
	    'subscription_cat_name'    => 'Category Name',
	  );
	  return $columns;
	}

	function get_sortable_columns() {
	  $sortable_columns = array(
	    'id'  => array('id',false),
	    'subscription_cat_name' => array('subscription_cat_name',false),
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
			$categorie_ids=$_REQUEST['categorie'];
			global $wpdb;
			foreach($categorie_ids as $categorie_id) 
			{
				$wpdb->query('delete from wp_subscription_category where id='.$categorie_id);
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
		$orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby']:'subscription_cat_name'; //If no sort, default to title
	    $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
		$query='select * from wp_subscription_category order by ' .$orderby . ' ' .$order;
		//var_dump($query);
	    $data = $wpdb->get_results($query); 
		//echo var_dump($data);
	    $search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
	    $query1 = "select * from wp_subscription_category where id like '%".$search."%' or subscription_cat_name like '%".$search."%' order by " .$orderby . ' ' .$order;
	    //var_dump($query1); 
	    $data1 = $wpdb->get_results($query1);
	    //var_dump($data1);

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


    function no_items() {
	  _e( 'No Categories found.' );
	}


	public function search_box( $text, $input_id ) {
    if ( empty( $_REQUEST['s'] ) && !$this->has_items() )
      return;

    $input_id = $input_id . '-search-input';

    if ( ! empty( $_REQUEST['orderby'] ) )
      echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
    if ( ! empty( $_REQUEST['order'] ) )
      echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
    if ( ! empty( $_REQUEST['post_mime_type'] ) )
      echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
    if ( ! empty( $_REQUEST['detached'] ) )
      echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';
?>
<p class="search-box">
	<label class="screen-reader-text" for="<?php echo $input_id ?>"><?php echo $text; ?>:</label>
	<input type="search" id="<?php echo $input_id ?>" name="s" value="<?php _admin_search_query(); ?>" />
	<?php submit_button( $text, 'button', '', false, array('id' => 'search-submit') ); ?>
</p>
<?php
  }

}

?>