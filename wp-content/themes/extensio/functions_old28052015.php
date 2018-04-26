<?php	
/**
* @package WordPress
* @subpackage extensio
**/

error_reporting(0);
//error_reporting(E_ALL);

$themename = "EXTENSIO Panel";
$shortname = "mi";

if ( ! isset( $content_width ) ) $content_width = 930;

add_theme_support( 'automatic-feed-links' );

// Make theme available for translation. Translations can be filed in the /languages/ directory
load_theme_textdomain( 'extensio', TEMPLATEPATH . '/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );		
	
add_theme_support('nav-menus');
if ( function_exists( 'register_nav_menus' ) ) {
  	register_nav_menus(
  		array(
  		  'header_menu' => 'Header Menu',
		  'footer_menu' => 'Footer Menu'
  		)
  	);
}

add_custom_background();

add_theme_support('post-thumbnails');
set_post_thumbnail_size( 300, 250, true );

add_image_size( 'slider_onebyone', 990, 397, true ); // OneByOne Slider
add_image_size( 'slider_nivo', 990, 397, true ); // Nivo Slider
add_image_size( 'slider_caroufred', 990, 397, true ); // CarouFredSel Slider
add_image_size( 'slider_accordion', 812, 397, true ); // Accordion Slider
add_image_size( 'slider_piecemaker', 940, 397, true ); // Piecemaker Slider

add_image_size( 'our_team', 200, 200, true ); // Piecemaker Slider

add_image_size( 'portfolio_1', 594, 365, true ); // One Column Portfolio
add_image_size( 'portfolio_2', 434, 265, true ); // Two Columns Portfolio
add_image_size( 'portfolio_3', 274, 165, true ); // Three Columns Portfolio, Sortable Portfolio, Our Latest Work(homepage)
add_image_size( 'portfolio_4', 194, 115, true ); // Four Columns Portfolio
add_image_size( 'portfolio_single', 634, 285, true ); // Portfolio Details Page

add_image_size( 'blog_1_3_4', 474, 234, true ); // Blog 1, Blog 3, Blog 4, Single Post
add_image_size( 'blog_2', 634, 285, true ); // Blog 2
add_image_size( 'popular_posts', 70, 70, true ); // Popular Posts
add_image_size( 'related_posts', 134, 78, true ); // Related Posts
add_image_size( 'featured_project', 220, 160, true ); // Related Posts





// load styles
function my_init_styles() {
	global $shortname;
	
	wp_enqueue_style('style_custom_webfont1', 'http://fonts.googleapis.com/css?family=Merriweather', false, '1.0', 'screen');
	wp_enqueue_style('style_custom_webfont2', 'http://fonts.googleapis.com/css?family=Open+Sans', false, '1.0', 'screen');
	wp_enqueue_style('style_custom_webfont3', 'http://fonts.googleapis.com/css?family=Open+Sans:600', false, '1.0', 'screen');
	wp_enqueue_style('style_custom_webfont4', 'http://fonts.googleapis.com/css?family=Merriweather:300', false, '1.0', 'screen');
	
	if  ( (get_option($shortname."_header_menu_font") != "Open+Sans") && (get_option($shortname."_header_menu_font") != "Merriweather") ) {
		wp_enqueue_style('style_custom_webfont5', 'http://fonts.googleapis.com/css?family='.get_option($shortname.'_header_menu_font'), false, '1.0', 'screen');
	}
	
	
	$theme_background = strtolower(get_option($shortname.'_theme_background'));
	$theme_color_style = strtolower(get_option($shortname.'_theme_color'));
	$theme_color_style = str_replace(' ','-',$theme_color_style);
	//if (isset($_COOKIE["style"])) { $theme_background = $_COOKIE["style"]; }
	if ($theme_color_style) {
		$theme_color_style = $theme_background.'-'.$theme_color_style.'.css';
	} else {
		$theme_color_style = 'wide-green-style.css';
	}
	wp_enqueue_style('style_main', get_template_directory_uri() . '/css/'.$theme_color_style, false, '1.0', 'screen');
	wp_enqueue_style('stylesheet_url', get_bloginfo('stylesheet_url'), false, '1.0', 'screen');
	
	wp_enqueue_style('style_carousel', get_template_directory_uri() . '/css/carousel.css', false, '1.0', 'screen');
	wp_enqueue_style('style_tabs', get_template_directory_uri() . '/css/tabs.css', false, '1.0', 'screen');	
	
	if (is_home() || is_front_page())
	if (get_option($shortname.'_slider_type') == 'Nivo Slider') {
		wp_enqueue_style('style_nivo_default', get_template_directory_uri() . '/js/nivo-slider/themes/default/default.css', false, '1.0', 'screen');
		wp_enqueue_style('style_nivo_slider', get_template_directory_uri() . '/js/nivo-slider/nivo-slider.css', false, '1.0', 'screen');
	}
	
	if (is_page_template('portfolio-three-sortable.php')) {
		wp_enqueue_style('style_isotope', get_template_directory_uri() . '/js/isotope/isotope.css', false, '1.0', 'screen');
	}

	if (is_home() || is_front_page())	
	if (get_option($shortname.'_slider_type') == 'Accordion Slider') {
		wp_enqueue_style('style_accordion', get_template_directory_uri() . '/js/accordion/accordion.css', false, '1.0', 'screen');
	}
	
	if (is_home() || is_front_page())
	if (get_option($shortname.'_slider_type') == 'OneByOne Slider') {
		wp_enqueue_style('style_onebyone', get_template_directory_uri() . '/js/onebyone/css/jquery.onebyone.css', false, '1.0', 'screen');
		wp_enqueue_style('style_onebyone_default', get_template_directory_uri() . '/js/onebyone/css/default.css', false, '1.0', 'screen');
		wp_enqueue_style('style_onebyone_animate', get_template_directory_uri() . '/js/onebyone/css/animate.css', false, '1.0', 'screen');
	}
	
	wp_enqueue_style('style_prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', false, '1.0', 'screen');
	
	wp_enqueue_style('style_contactform', get_template_directory_uri() . '/js/contact/form.css', false, '1.0', 'screen');

}
add_action('wp_print_styles', 'my_init_styles');





function my_init_scripts() {
	if (!is_admin()) {
		global $shortname;
		wp_deregister_script('jquery');
		wp_register_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', false, '1.7.1');
		wp_enqueue_script('jquery');
	
		if (is_home() || is_front_page())	
		if (get_option($shortname.'_slider_type') == 'Piecemaker Slider') {
			wp_enqueue_script('jquery_swfobject', get_template_directory_uri().'/js/piecemaker/swfobject.js', false, '2.1', false);
		}
	
		if (is_page_template('portfolio-three-sortable.php')) {
			wp_enqueue_script('jquery_isotope', get_template_directory_uri().'/js/isotope/jquery.isotope.min.js', false, '1.5.04', false);
		}
		
		wp_enqueue_script('jquery_tabs', get_template_directory_uri().'/js/tabs.js', false, '1.0', false);
		wp_enqueue_script('jquery_tabs2', get_template_directory_uri().'/js/tabs2.js', false, '1.0', false);
		wp_enqueue_script('jquery_accordion', get_template_directory_uri().'/js/jquery.accordion.js', false, '1.0', false);
		
		wp_enqueue_script('jquery_caroufredsel', get_template_directory_uri().'/js/jquery.carouFredSel-5.5.0.js', false, '5.5.0', false);		

		if (is_home() || is_front_page())		
		if (get_option($shortname.'_slider_type') == 'Accordion Slider') {
			wp_enqueue_script('jquery_accordion_slider', get_template_directory_uri().'/js/accordion/accordion.js', false, '5.5.0', false);
		}	

		if (is_home() || is_front_page())
		if (get_option($shortname.'_slider_type') == 'OneByOne Slider') {
			wp_enqueue_script('jquery_onebyone_slider', get_template_directory_uri().'/js/onebyone/jquery.onebyone.js', false, '1.0', false);
			wp_enqueue_script('jquery_touchwipe', get_template_directory_uri().'/js/onebyone/jquery.touchwipe.min.js', false, '1.1.0', false);
		}
		
		wp_enqueue_script('jquery_prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', false, '3.1.3', false);
		wp_enqueue_script('jquery_main', get_template_directory_uri().'/js/main.js', false, '1.1.0', false);
	
		wp_enqueue_script('jquery_validationengine_lang', get_template_directory_uri().'/js/contact/languages/jquery.validationEngine-en.js', false, '1.0', false);
		wp_enqueue_script('jquery_validationengine', get_template_directory_uri().'/js/contact/jquery.validationEngine.js', false, '2.5.1', false);			

	}
}
add_action('wp_print_scripts', 'my_init_scripts');








define('JSLIBS', get_template_directory_uri('template_url') . '/functions/js' );	
function admin_scripts() {
	wp_enqueue_script('color-picker', JSLIBS.'/jscolor/jscolor.js', array('jquery'));
	wp_enqueue_script('slider-add-remove-rows', JSLIBS .'/sidebars_add_remove.js', array('jquery'), '1.0.0');
}
add_action('admin_enqueue_scripts', 'admin_scripts');




require_once( TEMPLATEPATH . '/functions/post-options.php' );
require_once( TEMPLATEPATH . '/functions/page-options.php' );
require_once( TEMPLATEPATH . '/functions/slider-manager.php' ); 
require_once( TEMPLATEPATH . '/functions/portfolio-items.php' );
require_once( TEMPLATEPATH . '/functions/wp-pagenavi.php' );
require_once( TEMPLATEPATH . '/functions/shortcodes.php' );
require_once( TEMPLATEPATH . '/functions/slider-functions.php' );

require_once( TEMPLATEPATH . '/functions/widgets.php' );
require_once( TEMPLATEPATH . '/functions/widget-portfolio-categories.php' );
require_once( TEMPLATEPATH . '/functions/widget-twitter.php' );
require_once( TEMPLATEPATH . '/functions/widget-newsletter-subscribe.php' );
require_once( TEMPLATEPATH . '/functions/widget-search.php' );
require_once( TEMPLATEPATH . '/functions/widget-flickr.php' );
require_once( TEMPLATEPATH . '/functions/widget-popular-posts.php' );
require_once( TEMPLATEPATH . '/functions/widget-recent-posts.php' );
require_once( TEMPLATEPATH . '/functions/widget-featured-project.php' );

require_once( TEMPLATEPATH . '/admin/admin-functions.php' );
require_once( TEMPLATEPATH . '/admin/admin-interface.php' );
require_once( TEMPLATEPATH . '/admin/theme-settings.php' );



if ( !function_exists( 'extensio_comment' ) ) :
	function extensio_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
?>
		
		<li id="li-comment-<?php comment_ID(); ?>">
			<div class="area" id="comment-<?php comment_ID(); ?>">
				<div class="comments-info">
					<strong class="author"><strong class="author"><?php echo comment_author_link(); ?></strong></strong>
					<em class="date"><?php echo get_comment_date(); ?></em>
					<?php comment_reply_link( array_merge( $args, array( 'class' => 'commentreply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					
				</div>
				<div class="txt">
					<?php comment_text(); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<div class="commentreply"><em><?php _e( 'Your comment is awaiting moderation.', 'extensio' ); ?></em></div>
					<?php endif; ?>
				</div>
			</div>
		

<?php
	}
endif;

function comment_form_theme( $args = array(), $post_id = null ) {
	global $user_identity, $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
	
		'author' => '<div class="row"><input class="text" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><label for="author">' . __( 'Your Name','extensio' ) . ' <span>(*)</span>' . '</label></div> ' . ( $req ? '' : '' ),
		
		'email'  => '<div class="row"><input class="text" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><label for="email">' . __( 'Your email','extensio' ) . ' <span>(*)</span>' . '</label></div> ' . ( $req ? '' : '' ),
		
		'url'    => '<div class="row"><input class="text" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><label for="url">' . __( 'Your Website','extensio' ) . '</label></div>'
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="row"><label for="comment">' . __('Your Message','extensio') . ' <span>(*)</span>' . '</label><textarea id="comment" name="comment" cols="30" rows="10" aria-required="true"></textarea></div>',
		'must_log_in'          => '<p style="margin-left:0px;">' .  sprintf( __( "You must be <a href='%s'>logged in</a> to post a comment.", "extensio" ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p style="margin-left:0px;">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'extensio' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply', 'extensio'),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'extensio' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'extensio' ),
		'label_submit'         => __( 'Submit Comment &raquo;', 'extensio' ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<section id="respond" class="reply">
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" class="comments-form" id="the_comment_list">
						<fieldset>
							<div class="headline">
								<h2><?php _e('Leave a Comment','extensio'); ?></h2>
							</div>
							
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php //echo $args['comment_notes_after']; ?>
						
						<span class="submit"><?php _e('Post',''); ?><input type="submit" value="Post" ></span>
						
						<?php comment_id_fields(); ?>
						<?php do_action( 'comment_form', $post_id ); ?>
						<?php echo str_replace('<a','<a class="cancelreply"',get_cancel_comment_reply_link( $args['cancel_reply_link'] )); ?>
						</fieldset>
						
					</form>
				<?php endif; ?>
			</section>
			<!--/ comment form -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}


//add share for facebook and twitter to end or to the begin of the post content
function share_this($content){
global $shortname;
global $post;
$post_content = $content;
$this_post_type = get_post_type($post->ID);

if ($this_post_type == 'post') {

	if ( (get_option($shortname."_hide_blog_post_tweets") == 'false') || (get_option($shortname."_hide_blog_post_facebook") == 'false') ) {
		if (get_option($shortname."_hide_blog_twitter_facebook_ontop") == 'false') {
		
			if( is_single() ) {
			
				$content = $post_content.'<div class="share_this">';

				if (get_option($shortname."_hide_blog_post_tweets") == 'false') {
					$content .= '
							<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
							<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
				}

				if (get_option($shortname."_hide_blog_post_facebook") == 'false') {
					$content .='
							<div class="facebook-share-button">
								<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(get_permalink($post->ID))
									.'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"
									scrolling="no" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
							</div>
							';
				}
				
				$content .= '
						</div>';
			}
		} else {
			if( is_single() ) {
			
				$content = '<div class="share_this">';

				if (get_option($shortname."_hide_blog_post_tweets") == 'false') {
					$content .= '
							<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
							<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
				}

				if (get_option($shortname."_hide_blog_post_facebook") == 'false') {
					$content .='
							<div class="facebook-share-button">
								<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(get_permalink($post->ID))
									.'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"
									scrolling="no" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
							</div>
							';
				}
				
				$content .= '
						</div>'.$post_content;
			}
		}
		return $content;
	  } else return $post_content;
	
	} else if ($this_post_type == 'portfolio') {
	
	if ( (!get_option($shortname."_hide_portfolio_post_tweets")) || (!get_option($shortname."_hide_portfolio_post_facebook")) ) {
		if (!get_option($shortname."_hide_portfolio_twitter_facebook_ontop")) {
		
			if( is_single() ) {
			
				$content = $post_content.'<div class="share_this">';

				if (!get_option($shortname."_hide_portfolio_post_tweets")) {
					$content .= '
							<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
							<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
				}

				if (!get_option($shortname."_hide_portfolio_post_facebook")) {
					$content .='
							<div class="facebook-share-button">
								<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(get_permalink($post->ID))
									.'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"
									scrolling="no" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
							</div>
							';
				}
				
				$content .= '
						</div>';
			}
		} else {
			if( is_single() ) {
			
				$content = '<div class="share_this">';

				if (!get_option($shortname."_hide_portfolio_post_tweets")) {
					$content .= '
							<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
							<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
				}

				if (!get_option($shortname."_hide_portfolio_post_facebook")) {
					$content .='
							<div class="facebook-share-button">
								<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(get_permalink($post->ID))
									.'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"
									scrolling="no" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
							</div>
							';
				}
				
				$content .= '
						</div>'.$post_content;
			}
		}
		return $content;
	  } else return $post_content;
	} else return $post_content;
}
//add_action('the_content', 'share_this');

function add_last_item_class($strHTML) {

	$temp_strHTML = $strHTML;
	$temp_strHTML = str_replace('menu-item-type-post_type ','',$temp_strHTML);
	$temp_strHTML = str_replace('menu-item-object-page ','',$temp_strHTML);
	$temp_strHTML = str_replace('menu-item-object-page ','',$temp_strHTML);
	$temp_strHTML = str_replace('menu-item-type-custom ','',$temp_strHTML);
	$temp_strHTML = str_replace('menu-item-object-custom ','',$temp_strHTML);
	$temp_strHTML = str_replace('current-current_page_item ','active ',$temp_strHTML);
	$temp_strHTML = str_replace('menu-item-home ','',$temp_strHTML);
	
	$intPos = strripos($temp_strHTML,'</ul></div>');
	if ($intPos) {
		$temp_strHTML = substr($temp_strHTML,0,$intPos) . '</ul>'; 
	}
	echo $temp_strHTML;
}
add_filter('wp_nav_menu','add_last_item_class');

function fallback_default_menu() {	
	$all_pages = wp_list_pages("sort_column=menu_order&sort_order=ASC&exclude=&title_li=&echo=0");
	$all_pages = str_replace('page_item ','menu-item menu-item-type-post_type menu-item-object-page ',$all_pages);
	$all_pages = str_replace('page_item','menu-item',$all_pages);
 
    echo '<nav id="nav">
			<ul>
				<li><a href="'.home_url().'">'.__('Home','extensio').'</a></li>
				'.$all_pages.'
			</ul>
		  </nav>';
}

add_filter('next_post_link','add_css_class_to_next_post_link');
function add_css_class_to_next_post_link($link) {
	$link = str_replace("<a ", "<a class='link-next'  ", $link);
	return $link;
}

add_filter('previous_post_link','add_css_class_to_previous_post_link');
function add_css_class_to_previous_post_link($link) {
	$link = str_replace("<a ", "<a class='link-prev'  ", $link);
	return $link;
}

//enable/disable admin bar for site
if (get_option($shortname.'_admin_bar') == 'Yes') {
	add_filter( 'show_admin_bar', '__return_true' );
} else {
	add_filter( 'show_admin_bar', '__return_false' );
}

add_action( 'wp_print_styles', 'deregister_cf7_styles', 100 );
function deregister_cf7_styles() {
    if ( !is_page(100) ) {
        wp_deregister_style( 'contact-form-7' );
    }
}

// Add specific CSS class by filter
add_filter('body_class','my_body_class_class_names');
function my_body_class_class_names($classes) {
	// add 'class-name' to the $classes array
	unset($classes);
	$classes[] = 'custom-background';
	// return the $classes array
	return $classes;
}

// Add specific CSS class by filter
add_filter('the_excerpt','my_the_excerpt');
function my_the_excerpt() {
	$my_excerpt = '<p>'.get_the_excerpt().'</p>';
	return str_replace('[...]', '<br />', $my_excerpt);
}
	
function remove_wpautop($content) {
    $content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

//add featured image as custom column in posts, slider and portfolio sections
add_action("manage_posts_custom_column",  "posts_custom_columns");
function posts_custom_columns($columns){
	global $post;
	
	switch ($columns)
	{
		case "post_image":
			$image_id = get_post_thumbnail_id($post->ID);
			$image_url = wp_get_attachment_image_src($image_id,'', true);
			$get_custom_image_url = $image_url[0];
			echo '<img src="'.$get_custom_image_url.'" height="100px" style="padding: 5px 10px 20px 5px; "/>';
			break;
	}
}

add_filter('manage_posts_columns', 'scompt_columns');
function scompt_columns($defaults) {
    $defaults['post_image'] = __('Featured Image','extensio');
    return $defaults;
}

// Adding Shortcodes to the_excerpt() function
add_filter('the_excerpt', 'do_shortcode');
// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');
?>