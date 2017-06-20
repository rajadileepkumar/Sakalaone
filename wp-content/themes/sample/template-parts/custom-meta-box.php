<?php

/**
 * Meta boxes definitions
 *
 * @package framework
 * @since framework 1.0
 */

/**
 * Enque scripts for post options metaboxes
 *
 */

global $post;

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
	Custom Meta Box in Creative 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/


add_action('add_meta_boxes','creative_meta');
add_action('save_post','metabox_save');

function creative_meta(){
	//global $meta_box;
	add_meta_box( 'meta-box-id', __( 'Creative Details ', 'textdomain' ), 'wpdocs_my_display_callback', 'creative' );
}

function wpdocs_my_display_callback(){
	// global $meta_box, $page;
	$values= get_post_custom($page->ID);
	$courses = isset( $values['course_one'] ) ? esc_attr( $values['course_one'][0] ) : ''; 
	$icon =	isset( $values['fa_icon'] ) ? esc_attr( $values['fa_icon'][0] ) : ''; 

	
	
    wp_nonce_field( 'metabox_nonce', 'metabox_nonce' ); 

?>
	
	<div>
		<label for="icon"><?php _e('Font Awesome Icon')?></label>
		<p><input type="text" name="fa_icon" id="icon_id" value="<?php echo $icon; ?>"></p>
	</div>

	<div>
		<label for="course"><?php _e('courses Offered ')?></label>
		<p><textarea cols="90" rows="5" name="course_one" id="course_id"><?php echo $courses;?></textarea></p>
	</div>

	
<?php 
}


function metabox_save($page)
{
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;  
    if( !isset( $_POST['metabox_nonce'] ) || !wp_verify_nonce( $_POST['metabox_nonce'], 'metabox_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
        
	

	if(isset($_POST['fa_icon']))
		update_post_meta($page,'fa_icon',esc_attr($_POST['fa_icon']));

	
	

}

