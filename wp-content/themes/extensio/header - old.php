<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	wp_head();

	include('functions/custom-functions.php');
	include('functions/custom-css.php');
?>	

	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css"><![endif]-->	
</head>
<body <?php body_class('custom-background'); echo $theme_bodybgcolor_class; ?>>
	<div id="wrapper">

		<?php
			global $shortname;
			if ( is_home() || is_front_page() )
			if ( (get_option($shortname.'_slider_type') == 'Nivo Slider')  && (get_option($shortname."_slider_image_or_video") == 'No') )
			if ( get_option($shortname."_slider_directionNav") == 'true' ) {
		?>
		<div class="nivo-arrows">
			<a href="#" class="prev">prev<span>&nbsp;</span><em>&nbsp;</em></a>
			<a href="#" class="next">next<span>&nbsp;</span><em>&nbsp;</em></a>
		</div>
		<?php } ?>
		
		<div class="w1">
			<div class="w2">
				<!-- header -->
				<?php
					$site_custom_logo = get_option($shortname."_logo");
					$logo_height = get_option($shortname."_logo_height");
					$logo_height = str_replace('px','',$logo_height);
					$logo_height = str_replace('em','',$logo_height);					
					
					$custom_header_style = '';
					if ($site_custom_logo)
					if ($logo_height > 35) {
						$custom_header_height = 100+$logo_height-35;
						$custom_header_style = ' style="height:'.$custom_header_height.'px;"';
					}
				?>
				<div class="line"></div>
				
				<header id="header"<?php echo $custom_header_style; ?>>					
					<!-- logo -->
					<?php 
						if ($site_custom_logo) {
							$logo_width = get_option($shortname."_logo_width");
							$logo_width = str_replace('px','',$logo_width);
							$logo_width = str_replace('em','',$logo_width);
							$logo_style = ' style="width:'.$logo_width.'px;height:'.$logo_height.'px; background: url('.$site_custom_logo.') no-repeat;"'; 
							echo '<h1 class="logo"'.$logo_style.'><a href="'.home_url().'">'.get_bloginfo('name').'</a></h1>';							
						} else {
							echo '<h1 class="logo"><a href="'.home_url().'">'.get_bloginfo('name').'</a></h1>';
						} 
						//end to set the custom logo
					?>
					<div class="call">Call: 0800 002 9068</div>
					<!-- main nav -->
					<?php
						$custom_nav_style = '';
						if ($site_custom_logo)
						if ($logo_height > 35) {
							$custom_nav_topmargin = 43+round(($logo_height-35)/2);
							$custom_nav_style = ' style="top:'.$custom_nav_topmargin.'px;"';
						}
					?>
					<nav id="nav"<?php echo $custom_nav_style; ?>>
					<?php
						wp_nav_menu(array(
						'menu'              => 'Header Menu',
						'container'         => '',
						'container_class'   => '',
						'container_id'      => '',
						'menu_class'        => '',
						'menu_id'           => '',
						'echo'              => true,
						'fallback_cb'       => 'fallback_default_menu',
						'before'            => '',
						'after'             => '',
						'link_before'       => '',
						'link_after'        => '',
						'depth'             => 0,
						'walker'            => '',
						'theme_location'    => 'header_menu'
						));
					?>
					</nav>
				</header>
				<!--/ header -->
