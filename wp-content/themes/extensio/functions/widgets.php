<?php
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'description' => __('This is the blog sidebar.', 'extensio'),
		'name' => 'Blog Sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));	

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'description' => __('This is the Page sidebar.', 'extensio'),
		'name' => 'Page Sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));	
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'id' => 'portfolio-sidebar',
		'description' => __('This is Portfolio Sidebar widget.', 'extensio'),	
		'name' => 'Portfolio Sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'id' => 'contact-sidebar',
		'description' => __('This is Contact Sidebar widget.', 'extensio'),	
		'name' => 'Contact Sidebar',
		'before_widget' => '',
		'after_widget' => '<section class="box"></section>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'id' => 'contact-form',
		'description' => __('This is Contact Form replacement widget.', 'extensio'),	
		'name' => 'Contact Form',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));		
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'id' => 'footer-column-1',
		'description' => __('This is the footer column 1.', 'extensio'),	
		'name' => 'Footer Column 1',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));		
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'id' => 'footer-column-2',
		'description' => __('This is the footer column 2.', 'extensio'),	
		'name' => 'Footer Column 2',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));			
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'id' => 'footer-column-3',
		'description' => __('This is the footer column 3.', 'extensio'),		
		'name' => 'Footer Column 3',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));			
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'id' => 'footer-column-4',
		'description' => __('This is the footer column 4.', 'extensio'),		
		'name' => 'Footer Column 4',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));	



$get_custom_options = get_option($shortname.'_sidebars_cp');
$sidebarsCount = $get_custom_options['sidebarsCount'];
if ($sidebarsCount >= 1) {
	for($i = 1; $i <= $sidebarsCount; $i++) {
		if ($get_custom_options[$shortname.'_sidebars_cp_url_'.$i]) {
			$sidebar_name = $get_custom_options[$shortname.'_sidebars_cp_url_'.$i];
			if ( function_exists('register_sidebar') )
				register_sidebar(array(
					'id' => strtolower(str_replace(' ','-',$sidebar_name)),
					'description' => $sidebar_name,		
					'name' => $sidebar_name,
					'before_widget' => '',
					'after_widget' => '',
					'before_title' => '<h3>',
					'after_title' => '</h3>',
				));
		}
	}
}



/** Register sidebars by running theme_widgets_init() on the widgets_init hook. */
function my_unregister_widgets() {
	unregister_widget( 'WP_Widget_Search' );
}
add_action( 'widgets_init', 'my_unregister_widgets' );
?>