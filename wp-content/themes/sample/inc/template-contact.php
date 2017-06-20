<?php
/**
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
 *Template Name:Contact Template
 */
global $post;

$contact_info = ot_get_option('contact_info',array());
get_header(); ?>
<div class="clearfix"></div>
<div class="contact-page">
	<div class="container">
		<div class="contact-block">
			<?php 
				if(have_posts())
					while (have_posts()) {
						the_post();
			?>
			<div class="col-xs-12 col-md-12" style="margin-top: 40px;">
				<?php the_content();?>
			</div>
			<!-- <div class="col-xs-6 col-md-6">
				<?php 
					echo 'Hello Wordpress';
					$contact_info1 = get_post_meta( $post->ID, 'contact_info', true );
					dynamic_sidebar($contact_info1);
				?>
			</div> -->
			<?php }?>
		</div>
	</div>
</div>
<!-- <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0px;padding-right:0px">
	<?php 
		echo get_the_excerpt();
	?>
</div> -->
<style type="text/css">
	.navbar{
		margin-bottom: 0 !important;
	}
</style>
<?php

//get_sidebar();
get_footer();
