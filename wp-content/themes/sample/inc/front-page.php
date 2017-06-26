<?php
	/**
 * Template Name:Front Page
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sample
 */

get_header();?>
	<div class="container">
		<div class="col-md-9 col-sm-12 col-xs-12" style="padding-left: 0;">
			<?php 
				$args = array('post_type' => 'creative','paged' => $paged,'order' => 'ASC','posts_per_page' => -1);
				$the_query = new WP_Query( $args );
				if($the_query->have_posts()){
				while($the_query->have_posts()){
					$the_query->the_post();	
			?>
			<div class="col-md-4 col-sm-4 col-xs-12 toggle">
				<div class="panel-group" id="accordion">
				  <div class="panel panel-info">
				    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?php the_ID();?>">
				      	<div class="row">
		            		<div class="col-xs-6">
		                    	<div class="box center-block">
		                    		<?php 
			                    		if ( has_post_thumbnail() ) {
	    									the_post_thumbnail(array('class' => 'img-responsive'),array(500,500));
	    								}
		                    		?>
		                    	</div>
		                	</div>
		                	<div class="col-xs-6 text-right">
		                    	<div class="panel-text text-center"><?php the_title(); ?></div>
		                	</div>
		            	</div>
				    </div>
				    <div id="<?php the_ID();?>" class="panel-collapse collapse">
				      <div class="panel-body text-center" onClick="event.stopPropagation();">
				       	<div class="panel-border text-justify">
				       		<?php the_content();?>
				       	</div>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
			 
			<?php }}?>
		</div>
		<div class="col-md-3 col-sm-12 col-xs-12">
			<h2>Recent Notification</h2>
<?php 
				global $wpdb;
				$table_name = $wpdb->prefix . 'cte';
				$result = "SELECT * FROM $table_name ORDER BY id Desc";
				$item = $wpdb->get_results($result);
				echo '<div class="side-bar">';
                	echo '<div>';    
				        
						echo '<ul class="xoxo blogroll">';
                        	foreach ($item as $data) {
                        		
                        			if($data->age == "Yes"){
                            			echo '<li class="abc">';
                            				echo '<a href="'.$data->email.'" target="_blank">'.$data->name.'</a>';
                            			echo '</li>';
                            		}
                            		if($data->age == "No"){
                            			echo '<li class="xyz">';
                            				echo '<a href="'.$data->email.'" target="_blank">'.$data->name.'</a>';
                            			echo '</li>';
                            		}
                        	}
                        echo '</ul>';
                     echo '</div>';
                echo '</div>';  
			?>
	</div>
	</div>
	<?php 
?>
	
<?php get_footer();?>