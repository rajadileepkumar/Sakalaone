<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sample
 */
$email = ot_get_option('sample_text');
$mobile = ot_get_option('mobile');
$social_links = ot_get_option('social_links',array());

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87947593-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sample' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div id="top-bar" class="modern navbar-contact-details">
			<div class="container">
				<ul style="margin-left: -38px;">
					<li>
						<i class="fa fa-lg fa-envelope-o"></i>
						<?php echo $email;?>
					</li>
					<li>
						<i class="fa fa-lg fa-phone"></i>
						<?php echo $mobile;?>
					</li>
				</ul> 
				<div class="header-social">
					<ul>
						<?php 
							if(!empty($social_links)){
								foreach($social_links as $social){
									echo '<li id="' . $social['title'] .'"><a  href="' . $social['href'] . '"/><i class="fa fa-'. $social['name'] . '"></i></a></li>';
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
		<nav id="site-navigation" class="main-navigation navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a href="<?php echo site_url();?>" class="navbar-brand"><?php echo bloginfo('name');?></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php 
						$defaults = array(
							'theme_location'  => 'primary',
							'menu'            => '',
							'container'       => 'ul',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'nav navbar-nav navbar-right h-button',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							//'walker'          => new wp_bootstrap_navwalker(),
						);
						wp_nav_menu( $defaults );
					?>		
				</div>
			</div>
		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
