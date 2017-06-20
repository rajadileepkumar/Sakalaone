<?php
/*============Custom Post Type Creative================*/

function creative_post(){

	$labels = array(

		'name'				=>		'Notification',
		'singular_name'		=>		'Notification',
		'add_new'			=>		'Add Notification',
		'all_items'			=>		'All Notification',
		'add_new_items'		=> 		'Add Notification',
		'edit_item'			=>		'Edit Notification',
		'new_item'			=>		'New Notification',
		'view_item'			=>		'View Notification',
		'search_item'		=>		'Search Notification',
		'not_found'			=>		'No Notification Found',
		'not_found_in_trash'=>		'No Notofication found in trash',
		'parent_item_colon'	=>		'Parent Notification',
	);



	$args = array(

		'labels'			=>		$labels,
		'public'			=>		true,
		'has_archive'		=>		true,
		'publicly_queryable'=>		true,		
		'rewrite'			=>		true,
		'capability_type'	=>		'post',
		'menu_icon'			=>		'dashicons-book',
		'heirarchical'		=>		false,
		'taxonomies'		=>		array('Creative-categories','type'),
		'supports'			=>		array(
									'title',
									'editor',
									'excerpt',
									'thumbnail',
									'revisions',
									),
		'exclude_from_search'=>		false,
	);
	register_post_type('creative',$args);
}

add_action('init','creative_post');
	

	register_taxonomy(
        "creative-categories",
        array("creative"),
        array(
            "hierarchical" => true,
            "label" => __("Type",'elos'),
            "singular_label" => __("Type",'elos'),            
            "rewrite" => true,
            'show_admin_column' => true,                       
        )
    );
