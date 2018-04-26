<?php
/**
 * Theme Shortcodes Functions
*/

//[image alt="Image Align Left" imageurl="http://extensio-html.atixscripts.info/extensio-wide/images/portfolio-1.jpg" imagealign="left" width="184" height="97"]
//[image alt="Image Align Right" imageurl="http://extensio-html.atixscripts.info/extensio-wide/images/portfolio-2.jpg" imagealign="right" width="184" height="144"]
function theme_image($atts, $content=null){
	extract(shortcode_atts(array(
		"alt" => "",
		"imageurl" => "",
		"imagealign" => "left", //left, center, right
		"width" => "",
		"height" => "",
		"border" => "yes" //yes, no
    ), $atts));

	$alt = ($alt) ? ' alt="'.$alt.'"' : '';	
	$width = ($width) ? ' width="'.$width.'"' : '';	
	$height = ($height) ? ' height="'.$height.'"' : '';
	$border_style = ($border == 'no') ? '-wb' : '';
	return '<figure class="align-'.$imagealign.$border_style.'"><img src="'.$imageurl.'"'.$alt.$width.$height.' /></figure>';
}
add_shortcode('image', 'theme_image');


//[emptyline]
function theme_emptyline($atts, $content=null){
	return '<p>&nbsp;</p>';
}
add_shortcode('emptyline', 'theme_emptyline');

//[vidline]
function theme_vidline($atts, $content=null){
	return '<section class="content-vid"></section>';
}
add_shortcode('vidline', 'theme_vidline');


//[slogan]<h2>Looking for a professional and unique design?</h2><p>The Extensio is a simple and clean template suitable for companies wishing to increase the profile of their web presence, it's created by using the latest HTML5 and CSS3 techniques.</p>[/slogan]
function theme_slogan($atts, $content=null){
	return '<!-- promo-intro -->
		<section class="promo-intro">
		'.do_shortcode($content).'
		</section>
	';
}
add_shortcode('slogan', 'theme_slogan');

/*
[columns textalign="center"]
	[one_third title="The difference is hand-crafted" titlesize="h5" imageurl="http://extensio-html.atixscripts.info/extensio-wide/images/ico.png" readmore_url="http://www.themeforest.net"]Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit ...[/one_third]
	[one_third title="Built with Standards" titlesize="h5" imageurl="http://extensio-html.atixscripts.info/extensio-wide/images/ico2.png" readmore_url="http://www.activeden.net"]Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ...[/one_third]
	[one_third title="Insanely Easy To Use" titlesize="h5" imageurl="http://extensio-html.atixscripts.info/extensio-wide/images/ico3.png" readmore_url="http://www.codecanyon.net"]Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo nullariatur?[/one_third]
[/columns]
*/
function theme_columns($atts, $content = null) {
	extract(shortcode_atts(array(
		"textalign" => "left"	//left, center, right
    ), $atts));

	$textalign_style = ($textalign != 'left') ? ' style="text-align:'.$textalign.';"' : '';
	
	return '
		<!-- info-columns -->
		<section class="info-columns"><!-- columns -->
			<div class="container"'.$textalign_style.'>
				'.do_shortcode($content).'
			</div>
		</section>
	';
}
add_shortcode('columns', 'theme_columns');
// Columns Shortcode
function theme_column($atts, $content = null, $shortcodename = '') {
	extract(shortcode_atts(array(
		"title" => "",
		"title_url" => "",
		"titletype" => "1", //1, 2 - 2 is for underline title like on social-box section
		"titlesize" => "h4", // h1, h2, h3, h4, h5, h6
		"imageurl" => "",
		"imagealign" => "", //left
		"imageborder" => "no", //yes, no
		"imageaposition" => "abovetitle", //abovetitle, belowtitle, belowcontent, belowreadmorelink
		"readmore_text" => "Read more &raquo;",
		"readmore_url" => "",
		"readmore_button" => "", //yes, no
		"readmore_button_color" => "grey", //grey, green, black, orange, blue, red, magenta
		"firstcolumn" => "no" //yes, no
    ), $atts));
	
	if ($shortcodename == 'one_half') $column_class = 'col-12';
	if ($shortcodename == 'one_third') $column_class = 'col-13';
	if ($shortcodename == 'one_fourth') $column_class = 'col-14';
	if ($shortcodename == 'two_third') $column_class = 'col-23';
	if ($shortcodename == 'three_fourth') $column_class = 'col-34';
	
	$default_imageurl = $imageurl;
	$imageurl = ($imageurl) ? '<img src="'.$imageurl.'" alt="'.$title.'" />' : '';
	$imageurl = ($imagealign == 'left') ? '<img src="'.$default_imageurl.'" alt="'.$title.'" style="float:left; position:relative;" />' : $imageurl;
	$imageholder_start_left = ($imagealign == 'left') ? '<div style="padding-left:52px;">' : '';
	$imageholder_end_left = ($imagealign == 'left') ? '</div>' : '';

	if ($default_imageurl) {
		$imageurl = ($imageborder == "yes") ? '<figure class="visual">'.$imageurl.'</figure>' : '<div class="column_image">'.$imageurl.'</div>';	
	}
	
	$imageaposition_abobetitle = ($imageaposition == 'abovetitle') ? $imageurl : '';
	$imageaposition_belowtitle = ($imageaposition == 'belowtitle') ? $imageurl : '';
	$imageaposition_belowcontent = ($imageaposition == 'belowcontent') ? $imageurl : '';
	$imageaposition_belowreadmorelink = ($imageaposition == 'belowreadmorelink') ? $imageurl : '';

	$title = ($title) ? '<'.$titlesize.'><a href="'.$title_url.'" class="homepagelink">'.$title.'</a></'.$titlesize.'>' : '';
	$title = ($titletype == 2) ? '<div class="headline solid">'.$title.'</div>' : $title;

	$readmore_button_color = ($readmore_button_color) ? 'btn '.$readmore_button_color : 'btn grey';
	$readmore_button = ($readmore_button == 'yes') ? $readmore_button_color : 'more';
	$readmore_url = ($readmore_url) ? '<a class="'.$readmore_button.'" href="'.$readmore_url.'">'.$readmore_text.'</a>' : '';

	$firstcolumn_style = ($firstcolumn == 'yes') ? ' style="margin-left:0; clear:left;"' : '';

	return '<!-- info-item -->
		<article class="'.$column_class.' info-item"'.$firstcolumn_style.'>
			<div>
				'.$imageaposition_abobetitle.'
				'.$imageholder_start_left.'
					'.$title.'
					'.$imageaposition_belowtitle.'
					'.do_shortcode($content).'
					'.$imageaposition_belowcontent.'
					'.$readmore_url.'
					'.$imageaposition_belowreadmorelink.'
				'.$imageholder_end_left.'
			</div>
		</article>
		';
}
add_shortcode('one_half', 'theme_column');
add_shortcode('one_third', 'theme_column');
add_shortcode('one_fourth', 'theme_column');
add_shortcode('two_third', 'theme_column');
add_shortcode('three_fourth', 'theme_column');


//[latestwork title="our latest work" count="14" rows="2"]
function theme_latestwork($atts, $content=null){
    extract(shortcode_atts(array(
		"title" => "",
		"count" => "9",
		"rows" => "1"
    ), $atts));

	global $wp_query, $post;
	
	$type = 'portfolio';
	$args=array(
		'post_type' => $type,
		'post_status' => 'publish',
		'posts_per_page' => $count,
		'sort_column' => 'menu_order',
		'order' => 'desc'
	);

	$temp = $wp_query;  // assign original query to temp variable for later use   
	$wp_query = null;
	$wp_query = new WP_Query($args); 

	$i = 0;
	$portfolio_items_output = '';
	if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();							

		$item_categories = get_the_terms( $post->ID, 'portfolio_entries' );
		if(is_object($item_categories) || is_array($item_categories)) {
			$cat_slug = '';
			foreach ($item_categories as $cat) {
				if (!$cat_slug) $cat_slug = $cat->name;
				if ($cat_slug) $cat_slug .= ', '.$cat->name;
			}
		}
		
		// get full image from featured image if was not see full image url in Portfolio
		$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
		$image_preview_url = $get_custom_options[0];
		$portfolio_image_thumb = get_the_post_thumbnail($post->ID, 'portfolio_3', array('alt' => the_title_attribute('echo=0')));
		
		$custom = get_post_custom($post->ID);
		$portfolio_video_url = $custom["portfolio_video_url"][0];						
		if ($portfolio_video_url) $image_preview_url = $portfolio_video_url;
		
		$portfolio_content_excerpt_length = 78;
		if ($post->post_excerpt) { $post_description = $post->post_excerpt; } else { $post_description = $post->post_content; }
		if ( strlen($post_description) > $portfolio_content_excerpt_length ) {
			$post_description = substr($post_description, 0, $portfolio_content_excerpt_length).'...';
		}
		
		if ($rows == 1) {
			$portfolio_items_output .= '
				<li>
					<div class="visual">
						<div class="note-holder">
							'.$portfolio_image_thumb.'
							<a href="'.$image_preview_url.'" data-rel="prettyPhoto[pp_gallery1]">
								<div class="note">
									<strong>'.get_the_title().'</strong>
									<span>'.$cat_slug.'</span>
								</div>
							</a>
						</div>
					</div>
				</li>
			';
		} else {
			$i++;
 			if ($i == 1) $portfolio_items_output .= '<li>';

			$portfolio_items_output .= '
					<div class="visual">
						<div class="note-holder">
							'.$portfolio_image_thumb.'
							<a href="'.$image_preview_url.'" data-rel="prettyPhoto[pp_gallery1]">
								<div class="note">
									<strong>'.get_the_title().'</strong>
									<span>'.$cat_slug.'</span>
								</div>
							</a>
						</div>
					</div>
			';
			
 			if ($i == $rows) {
				$portfolio_items_output .= '</li>';
				$i = 0;
			}			
		}
		
	endwhile;
	endif;	
	
	$wp_query = null;
	$wp_query = $temp;
	
	$title = ($title) ? '<h3>'.$title.'</h3>' : '';
	return '
		<!-- latest-work -->
		<div class="latest-work">
			<div class="headline solid center">
			'.$title.'	
			</div>
			<div class="holder list_carousel">
				<!-- work-list -->
				<ul class="work-list" id="portfolio_carousel">
					'.$portfolio_items_output.'
				</ul>
			</div>
		</div>
		<!-- switcher -->
		<nav class="carousel_pagination" id="carousel_pager"></nav>
	';
}
add_shortcode('latestwork', 'theme_latestwork');

//[promobox buttonurl="/contact" buttontext="Get A Free Quote Now" button_textcolor="" button_bgcolor=""]<h2>The quality of our work shows through because it is designed with passion.</h2><p>We're always on the look out for new projects and clients so if you've got an idea don't delay.</p>[/promobox]
function theme_promobox($atts, $content=null){
	extract(shortcode_atts( array(
		"buttontext" => "",
		"buttonurl" => "",
		"button_textcolor" => "",
		"button_bgcolor" => ""
	), $atts));

	$button_textcolor = ($button_textcolor) ? 'color:#'.str_replace('#','',$button_textcolor).';' : '';
	$button_bgcolor = ($button_bgcolor) ? 'background:#'.str_replace('#','',$button_bgcolor).';' : '';
	$button_colors_style = ($button_textcolor || $button_bgcolor) ? ' style="'.$button_textcolor.$button_bgcolor.'"' : '';
	return '
		<!-- promo-box -->
		<article class="promo-box">
			<a href="'.$buttonurl.'" class="btn-add"'.$button_colors_style.'>'.$buttontext.'</a>
			'.do_shortcode($content).'
		</article>
	';
}
add_shortcode('promobox', 'theme_promobox');


//[latestposts title="latest from the blog" count="4" mainpost_contentlength="80" otherposts_contentlength="190"]
function theme_latestposts($atts, $content=null){
    extract(shortcode_atts(array(
		"title" => "",
		"count" => "4",
		"mainpost_contentlength" => "80",
		"otherposts_contentlength" => "190",
    ), $atts));

	global $wp_query, $post;
	
	$type = 'post';
	$args=array(
		'post_type' => $type,
		'post_status' => 'publish',
		'posts_per_page' => $count,
		'sort_column' => 'menu_order',
		'order' => 'desc'
	);

	$temp = $wp_query;  // assign original query to temp variable for later use   
	$wp_query = null;
	$wp_query = new WP_Query($args); 

	$i = 0;
	$blog_items_output = '';
	if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();							
		
		// get full image from featured image if was not see full image url in blog post
		$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
		$image_preview_url = $get_custom_options[0];
		$blog_image_thumb = get_the_post_thumbnail($post->ID, 'portfolio_3', array('alt' => the_title_attribute('echo=0')));
		
		/*$custom = get_post_custom($post->ID);
		$blog_video_url = $custom["blog_video_url"][0];						
		if ($blog_video_url) $image_preview_url = $blog_video_url;*/
		
		$blog_content_excerpt_length = 78;
		if ($post->post_excerpt) { $post_description = $post->post_excerpt; } else { $post_description = $post->post_content; }
		if ( strlen($post_description) > $blog_content_excerpt_length ) {
			$post_description = substr($post_description, 0, $blog_content_excerpt_length).'...';
		}
		
		$write_comments = '0 '.__('Comments','extensio');
		$num_comments = 0;
		$num_comments = get_comments_number($post->ID);
		if ( comments_open() ) {
		if($num_comments == 0) {
		  $comments ='0 '.__('Comments','extensio');
			} elseif($num_comments > 1) {
			  $comments = $num_comments.__(' Comments','extensio');
			} else {
			   $comments ='1 '.__('Comment','extensio');
			}
			$write_comments = $comments;
		}
		
		$i++;
		
		if ($i == 1) {
			$content_length = $mainpost_contentlength;
		} else { $content_length = $otherposts_contentlength; }
		
		$content = $post->post_content;
		//$content = apply_filters('the_content', $content);
		$excerpt = str_replace(']]>', ']]>', $content);
		if ( strlen( $excerpt ) > $content_length ) {
			$subex = substr( $excerpt, 0, $content_length - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				$content = substr( $subex, 0, $excut ).' ...';
			} else {
				$content = $subex.' ...';
			}
		} else {
			$content = $excerpt;
		}
		$content = str_replace('<p>','',$content);
		$content = str_replace('</p>','',$content);
		
		$article_post_class = ' style="margin-bottom:25px;"';
		
		if ($i == 1) {
			$blog_items_output .= '
				<article class="post"'.$article_post_class.'>
					<figure class="visual">'.$blog_image_thumb.'</figure>
					<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
					<p>'.$content.'</p>
					<nav class="nav-blog">
						<ul>
							<li><a href="'.get_permalink().'">'.__('Read more','extensio').'</a></li>
<li><a href="'.get_permalink().'#comments">'.$write_comments.'</a></li>
						</ul>
					</nav>
				</article>
				<div class="container">
			';
		} else {
			$article_post_class = ($i == $count) ? ' style="margin-bottom:25px;"' : '';
			$blog_items_output .= '
					<article class="post"'.$article_post_class.'>
						<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
						<p>'.do_shortcode($content).'</p>
						<nav class="nav-blog">
							<ul>
								<li><a href="'.get_permalink().'">'.__('Read more','extensio').'</a></li>
<li><a href="'.get_permalink().'#comments">'.$write_comments.'</a></li>
							</ul>
						</nav>
					</article>
			';
		}
		
	endwhile;
	endif;	
	
	$wp_query = null;
	$wp_query = $temp;
	
	$title = ($title) ? '<h3>'.$title.'</h3>' : '';
	
	return '
		<section class="latest-blog">
			<div class="headline center solid">
				'.$title.'	
			</div>
			<div class="area">	
				'.$blog_items_output.'
				</div>
			</div>
		</section>
	';
}
add_shortcode('latestposts', 'theme_latestposts');


//[latestposts2 title="latest from the blog type 2" count="3" content_length="80"]
function theme_latestposts2($atts, $content=null){
    extract(shortcode_atts(array(
		"title" => "",
		"count" => "4",
		"content_length" => "80"
    ), $atts));

	global $wp_query, $post;
	
	$type = 'post';
	$args=array(
		'post_type' => $type,
		'post_status' => 'publish',
		'posts_per_page' => $count,
		'sort_column' => 'menu_order',
		'order' => 'desc'

	);

	$temp = $wp_query;  // assign original query to temp variable for later use   
	$wp_query = null;
	$wp_query = new WP_Query($args); 

	$blog_items_output = '';
	
	$i = 0;
	if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();					
		
		// get full image from featured image if was not see full image url in blog post
		$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
		$image_preview_url = $get_custom_options[0];
		$blog_image_thumb = get_the_post_thumbnail($post->ID, 'portfolio_3', array('alt' => the_title_attribute('echo=0')));
		
		/*$custom = get_post_custom($post->ID);
		$blog_video_url = $custom["blog_video_url"][0];						
		if ($blog_video_url) $image_preview_url = $blog_video_url;*/
		
		$blog_content_excerpt_length = $content_length;
		if ($post->post_excerpt) { $post_description = $post->post_excerpt; } else { $post_description = $post->post_content; }
		if ( strlen($post_description) > $blog_content_excerpt_length ) {
			$post_description = substr($post_description, 0, $blog_content_excerpt_length).'...';
		}
		
		$write_comments = '0 '.__('Comments','extensio');
		$num_comments = 0;
		$num_comments = get_comments_number($post->ID);
		if ( comments_open() ) {
		if($num_comments == 0) {
		  $comments ='0 '.__('Comments','extensio');
			} elseif($num_comments > 1) {
			  $comments = $num_comments.__(' Comments','extensio');
			} else {
			   $comments ='1 '.__('Comment','extensio');
			}
			$write_comments = $comments;
		}
		
		$i++;		

		$content = $post->post_content;
		//$content = apply_filters('the_content', $content);
		$excerpt = str_replace(']]>', ']]>', $content);
		if ( strlen( $excerpt ) > $content_length ) {
			$subex = substr( $excerpt, 0, $content_length - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				$content = substr( $subex, 0, $excut ).' ...';
			} else {
				$content = $subex.' ...';
			}
		} else {
			$content = $excerpt;
		}
		$content = str_replace('<p>','',$content);
		$content = str_replace('</p>','',$content);
		
		$article_post_class = ( ($i == 3) || ($i == 6) || ($i == 9) || ($i == 12) || ($i == 15)) ? ' style="padding-right:0; margin-bottom:25px;"' : 'style="margin-bottom:25px;"';
			
		$blog_items_output .= '
			<article class="post"'.$article_post_class.'>
				<figure class="visual">'.$blog_image_thumb.'</figure>
				<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
				<p>'.$content.'</p>
				<nav class="nav-blog">
					<ul>
						<li><a href="'.get_permalink().'">'.__('Read more','extensio').'</a></li>
					</ul>
				</nav>
			</article>
		';
		
	endwhile;
	endif;	
	
	$wp_query = null;
	$wp_query = $temp;
	
	$title = ($title) ? '<h3>'.$title.'</h3>' : '';
	
	return '
		<section class="latest-blog">
			<div class="headline center solid">
				'.$title.'	
			</div>
			<div class="area">	
				'.$blog_items_output.'
			</div>
		</section>
	';
}
add_shortcode('latestposts2', 'theme_latestposts2');




//[greysection][/greysection]
//[greysection margintop="yes"][/greysection]
//[greysection margintop="no"][/greysection]
function theme_greysection($atts, $content=null){
	extract(shortcode_atts( array(
		"margintop" => "yes" //no,yes
	), $atts));

	$margintop_style = ($margintop == 'no') ? ' style="margin-top:-22px;' : '';
	
	return '
		<div class="social-box"'.$margintop_style.'>
		'.do_shortcode($content).'
		</div>
	';
}
add_shortcode('greysection', 'theme_greysection');



//[twitter username="adobetutorialz" count="3"]
function theme_twitter($atts, $content=null){
	extract(shortcode_atts( array(
		"username" => "",
		"count" => "3"
	), $atts));
	
	
	return '
		<div id="twitter_update_list_'.$username.'" class="twitter-wrap"></div>
		<!-- twitter start script -->	
		<script type="text/javascript">	
			function twitterCallback_'.$username.'(twitters) {
			  var statusHTML = [];
			  for (var i=0; i<twitters.length; i++){
				var username = twitters[i].user.screen_name;
				var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;\'">\:\s\<\>\)\]\!])/g, function(url) {
				  return \'<a href="\'+url+\'">\'+url+\'</a>\';
				}).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
				  return  reply.charAt(0)+\'<a href="http://twitter.com/\'+reply.substring(1)+\'">\'+reply.substring(1)+\'</a>\';
				});
				statusHTML.push(\'<article class="post"><p>\'+status+\'</p> <footer class="date">\'+relative_time(twitters[i].created_at)+\'</footer></article>\');
			  }
			  document.getElementById(\'twitter_update_list_'.$username.'\').innerHTML = statusHTML.join(\'\');
			}
		</script>
		<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$username.'.json?callback=twitterCallback_'.$username.'&amp;count='.$count.'"></script>
	';

}
add_shortcode('twitter', 'theme_twitter');

//[testimonials] [testimonial imageurl="" imagealt="" name="" url="" sitename=""]Content...[/testimonial] [/testimonials]
function theme_testimonials($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => ""
	), $atts));

	$title_output = ($title) ? '<div class="headline solid"><h3>'.$title.'</h3></div>' : '';
	
	return '
		<!-- testimonials-item -->
		<section class="testimonials-item">
			'.$title_output.'
			'.do_shortcode($content).'
		</section>	
	';
}
add_shortcode('testimonials', 'theme_testimonials');
function theme_testimonial($atts, $content=null){
	extract(shortcode_atts( array(
		"name" => "",
		"siteurl" => "",
		"sitename" => "",	
		"imageurl" => "",
		"imagealt" => ""
	), $atts));

	$name = ($name) ? '- '.$name.' ' : '';
	$sitename = ($sitename) ? $sitename : $siteurl;
	$siteurl = ($siteurl) ? '<a href="'.$siteurl.'">' : '<a href="#">';
	$cite_output = ($sitename || $siteurl || $name) ? '<cite>'.$name.$siteurl.$sitename.'</a></cite>' : '';
	
	
	$image_output = ($imageurl) ? '<div class="img"><img class="rounded-corner-31" src="'.$imageurl.'" width="60" height="60" alt="'.$imagealt.'" ></div>' : '';
	
	return '
		<div class="item">
			'.$image_output.'
			<blockquote>
				<q>'.do_shortcode($content).'</q>
				'.$cite_output.'
			</blockquote>
		</div>
	';
}
add_shortcode('testimonial', 'theme_testimonial');

//[contactform email="atixscripts@gmail.com"]
function theme_contactform($atts, $content=null){
	extract(shortcode_atts( array(
		"email" => ""
	), $atts));

	//==============
	//CONFIGURATION
	//==============

	//IMPORTANT!!
	//Put in your email address below:
	$to = $email;

	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//User info (DO NOT EDIT!)
		$name = stripslashes($_POST['username']); //sender's name
		$email = stripslashes($_POST['email']); //sender's email

		//The subject
		//$subject = stripslashes($_POST['subject']); // the subject
		$message = stripslashes($_POST['message']); //sender's email

		//The message you will receive in your mailbox
		//Each parts are commented to help you understand what it does exaclty.
		//YOU DON'T NEED TO EDIT IT BELOW BUT IF YOU DO, DO IT WITH CAUTION!
		$msg  = __('From:','extensio')." ".$name." \r\n";  //add sender's name to the message
		$msg .= __('e-Mail:','extensio')." ".$email." \r\n\r\n";  //add sender's email to the message
		$msg .= __('---Message---','extensio')." \r\n".stripslashes($_POST['message'])."\r\n\r\n";  //the message itself

		//Extras: User info (Optional!)
		//Delete this part if you don't need it
		//Display user information such as Ip address and browsers information...
		$msg .= __('---User information---','extensio')." \r\n"; //Title
		$msg .= __('User IP:','extensio')." ".$_SERVER["REMOTE_ADDR"]."\r\n"; //Sender's IP
		$msg .= __('Browser info:','extensio')." ".$_SERVER["HTTP_USER_AGENT"]."\r\n"; //User agent
		$msg .= __('User come from:','extensio')." ".$_SERVER["HTTP_REFERER"]; //Referrer
		// END Extras
	}
	
	if ($_SERVER['REQUEST_METHOD'] != 'POST'){
		$self = $_SERVER['PHP_SELF'];
		return '
			<form method="post" class="feedback" id="cont_form" action="#feedback">
				<fieldset>
					<span class="text"><input type="text" id="username" name="username" value="'.__('Your name','extensio').'" class="text validate[required]" ></span>
					<span class="text"><input type="text" id="email" name="email" value="'.__('Your Email','extensio').'" class="text validate[required,custom[email]]" ></span>
					<span class="text"><textarea class="w_focus validate[required]" id="message" name="message" cols="30" rows="10">'.__('Your Message','extensio').'</textarea></span>
					<span class="submit">'.__('Send','extensio').'<input value="'.__('Send','extensio').'" type="submit" ></span>
				</fieldset>
			</form>
		';
	} else {
		if  (mail($to, 'From email '.$email, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n")) { 
			return nl2br('
				<span class="MsgSent" id="feedback">
					<h4>'.__('Congratulations!','extensio').'</h4>'.__('Thank you','extensio').' '.__('Thank you. Your message is sent. I will get back to you as soon as possible.','extensio').'</span>');
		} else {
			// Display error message if the message failed to send
			return '
				<span class="MsgError" id="feedback"><h4>'.__('Error!','extensio').'</h4>'.__('Sorry, your message failed to send. Try later.','extensio').'</span>
			';
		}
	}							
}
add_shortcode('contactform', 'theme_contactform');

//[subscribe feedburner_username="adobetutorialz" title="Sign Up for Our Newsletter"]
function theme_subscribe($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"feedburner_username" => ""
	), $atts));
	
	$title = ($title) ? '<h4>'.$title.'</h4>' : '';
	
	return '
		<!-- newsletter -->
		<section class="newsletter">
			'.$title.'
			<form action="http://feedburner.google.com/fb/a/mailverify?" method="post" target="_blank">
				<fieldset>
					<input type="text" name="email" value="'.__('Email address ...','extensio').'" class="text">
					<input type="hidden" name="uri" value="'.$feedburner_username.'">
					<input type="submit" value="submit" class="submit">
				</fieldset>
			</form>
		</section>	
	';			
}
add_shortcode('subscribe', 'theme_subscribe');

//[social_links]
function theme_social_links($atts, $content=null){

	global $shortname;
	
	$social_links_facebook = get_option($shortname.'_social_links_facebook');
	$social_links_facebook_caption = get_option($shortname.'_social_links_facebook_caption');
	$social_links_facebook = ($social_links_facebook) ? '<li><a class="facebook" href="'.$social_links_facebook.'">'.$social_links_facebook_caption.'</a></li>' : '';
	
	$social_links_twitter = get_option($shortname.'_social_links_twitter');
	$social_links_twitter_caption = get_option($shortname.'_social_links_twitter_caption');
	$social_links_twitter = ($social_links_twitter) ? '<li><a class="twitter" href="'.$social_links_twitter.'">'.$social_links_twitter_caption.'</a></li>' : '';
	
	$social_links_dribbble = get_option($shortname.'_social_links_dribbble');
	$social_links_dribbble_caption = get_option($shortname.'_social_links_dribbble_caption');
	$social_links_dribbble = ($social_links_dribbble) ? '<li><a class="dribbble" href="'.$social_links_dribbble.'">'.$social_links_dribbble_caption.'</a></li>' : '';
	
	$social_links_youtube = get_option($shortname.'_social_links_youtube');
	$social_links_youtube_caption = get_option($shortname.'_social_links_youtube_caption');
	$social_links_youtube = ($social_links_youtube) ? '<li><a class="youtube" href="'.$social_links_youtube.'">'.$social_links_youtube_caption.'</a></li>' : '';
	
	$social_links_googleplus = get_option($shortname.'_social_links_googleplus');
	$social_links_googleplus_caption = get_option($shortname.'_social_links_googleplus_caption');
	$social_links_googleplus = ($social_links_googleplus) ? '<li><a class="google" href="'.$social_links_googleplus.'">'.$social_links_googleplus_caption.'</a></li>' : '';
	
	$social_links_linkedin = get_option($shortname.'_social_links_linkedin');
	$social_links_linkedin_caption = get_option($shortname.'_social_links_linkedin_caption');
	$social_links_linkedin = ($social_links_linkedin) ? '<li><a class="linkedin" href="'.$social_links_linkedin.'">'.$social_links_linkedin_caption.'</a></li>' : '';
	
	return '
		<!-- social-networks -->
		<nav class="social-networks2">
			<ul>
				'.$social_links_facebook.'
				'.$social_links_twitter.'
				'.$social_links_dribbble.'
				'.$social_links_youtube.'
				'.$social_links_googleplus.'
				'.$social_links_linkedin.'
			</ul>
		</nav>
	';
}
add_shortcode('social_links', 'theme_social_links');

//[social_links2]
function theme_social_links2($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => ""
	), $atts));

	$title = ($title) ? '<h3>'.$title.'</h3>' : '';
	
	global $shortname;
	
	$social_links_facebook = get_option($shortname.'_social_links_facebook');
	$social_links_facebook_caption = get_option($shortname.'_social_links_facebook_caption');
	$social_links_facebook = ($social_links_facebook) ? '<li><a class="facebook" href="'.$social_links_facebook.'">'.$social_links_facebook_caption.'</a></li>' : '';
	
	$social_links_twitter = get_option($shortname.'_social_links_twitter');
	$social_links_twitter_caption = get_option($shortname.'_social_links_twitter_caption');
	$social_links_twitter = ($social_links_twitter) ? '<li><a class="twitter" href="'.$social_links_twitter.'">'.$social_links_twitter_caption.'</a></li>' : '';
	
	$social_links_dribbble = get_option($shortname.'_social_links_dribbble');
	$social_links_dribbble_caption = get_option($shortname.'_social_links_dribbble_caption');
	$social_links_dribbble = ($social_links_dribbble) ? '<li><a class="dribbble" href="'.$social_links_dribbble.'">'.$social_links_dribbble_caption.'</a></li>' : '';
	
	$social_links_youtube = get_option($shortname.'_social_links_youtube');
	$social_links_youtube_caption = get_option($shortname.'_social_links_youtube_caption');
	$social_links_youtube = ($social_links_youtube) ? '<li><a class="youtube" href="'.$social_links_youtube.'">'.$social_links_youtube_caption.'</a></li>' : '';
	
	$social_links_googleplus = get_option($shortname.'_social_links_googleplus');
	$social_links_googleplus_caption = get_option($shortname.'_social_links_googleplus_caption');
	$social_links_googleplus = ($social_links_googleplus) ? '<li><a class="google" href="'.$social_links_googleplus.'">'.$social_links_googleplus_caption.'</a></li>' : '';
	
	$social_links_linkedin = get_option($shortname.'_social_links_linkedin');
	$social_links_linkedin_caption = get_option($shortname.'_social_links_linkedin_caption');
	$social_links_linkedin = ($social_links_linkedin) ? '<li><a class="linkedin" href="'.$social_links_linkedin.'">'.$social_links_linkedin_caption.'</a></li>' : '';

	return '
		<!-- social-networks -->
		<nav class="social-networks3">
			'.$title.'
			<ul>
				'.$social_links_facebook.'
				'.$social_links_twitter.'
				'.$social_links_dribbble.'
				'.$social_links_youtube.'
				'.$social_links_googleplus.'
				'.$social_links_linkedin.'
			</ul>
		</nav>
	';
}
add_shortcode('social_links2', 'theme_social_links2');

//[flickr username="24878717@N06" count="9"]
function theme_flickr($atts, $content=null){
	extract(shortcode_atts( array(
		"username" => "",
		"count" => "9"
	), $atts));

	return '
		<!-- flickr -->
		<section class="flickr">
			<script flickr_type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$count.'&amp;flickr_display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$username.'"></script>
		</section>	
	';
}
add_shortcode('flickr', 'theme_flickr');

//[testimonial2 title="CLIENT TESTIMONIALS" name="Vicki" siteurl="http://www.themeforest.net" sitename="The Bright Agency"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.[/testimonial2]
function theme_testimonial2($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"name" => "",
		"siteurl" => "",
		"sitename" => ""
	), $atts));

	$title = ($title) ? '<div class="headline solid center"><h3>'.$title.'</h3></div>' : '';
	$name = ($name) ? $name.' ' : '';
	$sitename = ($sitename) ? $sitename : $siteurl;
	$siteurl = ($siteurl) ? ', <a href="'.$siteurl.'">' : ', <a href="#">';
	$cite_output = ($sitename || $siteurl || $name) ? '<cite>'.$name.$siteurl.$sitename.'</a></cite>' : '';
	
	return '
		<!-- testimonials -->
		<section class="testimonials">
			'.$title.'
			<blockquote>
				<div class="holder">
					<q>'.do_shortcode($content).'</q>
				</div>
				'.$cite_output.'
			</blockquote>
		</section>				
	';
}
add_shortcode('testimonial2', 'theme_testimonial2');



//[headline1]
function theme_headline1($atts, $content=null){
	return '
		<div class="headline"><span>&nbsp;</span></div>
	';
}
add_shortcode('headline1', 'theme_headline1');

//[headline3]
function theme_headline2($atts, $content=null){
	return '
		<div class="headline solid">
			<img src="'.get_template_directory_uri().'/images/zipper.png" width="30" height="21" alt="" >
		</div>
	';
}
add_shortcode('headline2', 'theme_headline2');

//[headline3 text="Back to Top"]
function theme_headline3($atts, $content=null){
	extract(shortcode_atts( array(
		"text" => "Top"
	), $atts));
	return '
		<div class="headline solid">
			<a href="#header" class="skip">'.$text.'</a>
		</div>

	';
}
add_shortcode('headline3', 'theme_headline3');

//[sectiontitle1]Left Section Title 1[/sectiontitle2]
function theme_sectiontitle1($atts, $content=null){
	return '
		<div class="headline solid">
			<h2>'.do_shortcode($content).'</h2>
		</div>
	';
}
add_shortcode('sectiontitle1', 'theme_sectiontitle1');

//[sectiontitle2]Left Section Title 2[/sectiontitle3]
function theme_sectiontitle2($atts, $content=null){
	return '
		<div class="headline solid2">
			<h2>'.do_shortcode($content).'</h2>
		</div>
	';
}
add_shortcode('sectiontitle2', 'theme_sectiontitle2');

//[sectiontitle3]Left Section Title 3[/sectiontitle4]
function theme_sectiontitle3($atts, $content=null){
	return '
		<div class="headline dotted3">
			<h2>'.do_shortcode($content).'</h2>
		</div>
	';
}
add_shortcode('sectiontitle3', 'theme_sectiontitle3');

//[sectiontitle4]Centered Section Title 1[/sectiontitle4]
function theme_sectiontitle4($atts, $content=null){
	return '
		<div class="headline solid center">
			<h2>'.do_shortcode($content).'</h2>
		</div>
	';
}
add_shortcode('sectiontitle4', 'theme_sectiontitle4');

//[sectiontitle5]Centered Section Title 2[/sectiontitle5]
function theme_sectiontitle5($atts, $content=null){
	return '
		<div class="headline solid2 center">
			<h2>'.do_shortcode($content).'</h2>
		</div>
	';
}
add_shortcode('sectiontitle5', 'theme_sectiontitle5');

//[sectiontitle6]Centered Section Title 3[/sectiontitle6]
function theme_sectiontitle6($atts, $content=null){
	return '
		<div class="headline dotted3 center">
			<h2>'.do_shortcode($content).'</h2>
		</div>
	';
}
add_shortcode('sectiontitle6', 'theme_sectiontitle6');


//[list1][/list1]
function theme_list1($atts, $content=null){
	return str_replace('<ul','<ul class="list"',do_shortcode($content));
}
add_shortcode('list1', 'theme_list1');

//[list2][/list2]
function theme_list2($atts, $content=null){
	return str_replace('<ul','<ul class="list2"',do_shortcode($content));
}
add_shortcode('list2', 'theme_list2');

//[list3][/list3]
function theme_list3($atts, $content=null){
	$output =  str_replace('<ol','<ol class="ordered-list"',do_shortcode($content));
	$output = str_replace('<ul','<ol class="ordered-list"',$output);
	$output = str_replace('</ul','</ol',$output);
	return $output;
}
add_shortcode('list3', 'theme_list3');


//[blockquote]Established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.[/blockquote]
function theme_blockquote($atts, $content=null){
	return '
		<blockquote class="blockquote">
			<q>'.do_shortcode($content).'</q>
		</blockquote>
	';
}
add_shortcode('blockquote', 'theme_blockquote');



/*[tabs1 titles="Title 1|Title 2|Title 3|Title 4" ids="1|2|3|4"]
	[tab1 id="1"]
		content...
	[/tab1]
	[tab1 id="2"]
		content...
	[/tab1]
	[tab1 id="3"]
		content...
	[/tab1]
	[tab1 id="4"]
		content...
	[/tab1]
[/tabs1]
*/
function theme_tabs($atts, $content = null) {
    extract(shortcode_atts(array(
		"titles" => "",
		"ids" => "",
		"active" => "no" //yes, no
    ), $atts));
   
	$title_chunks = explode("|", $titles);
	$ids_chunks = explode("|", $ids);
	
	$tabs_output = '
		<!-- tabset -->
		<nav class="tabset">
			<ul class="tabset">

	';
	
	for ($i=0;$i<count($title_chunks);$i++) {
		if ($i == 0) { $class_active =' class="active"'; } else { $class_active =''; }
			$tabs_output .= '
				<li'.$class_active.'><a href="#tab-'.$ids_chunks[$i].'" class="tab1">'.$title_chunks[$i].'</a></li>
			';
	}
	
	$tabs_output .= '
			</ul>
		</nav>'.do_shortcode($content);
		
	return $tabs_output;
}
add_shortcode("tabs", "theme_tabs");
//TAB info shortcode
function theme_tab($atts, $content = null) {
    extract(shortcode_atts(array(
		"id" => ""
    ), $atts));
	
	return '
			<!-- tab-content -->
			<article class="tab-content" id="tab-'.$id.'">
				'.do_shortcode($content).'
			</article>
	';
}
add_shortcode("tab", "theme_tab");




/*[tabs2 titles="Title 1|Title 2|Title 3|Title 4" ids="1|2|3|4"]
	[tab2 id="1" active="yes"]
		content...
	[/tab2]
	[tab2 id="2"]
		content...
	[/tab2]
	[tab2 id="3"]
		content...
	[/tab2]
	[tab2 id="4"]
		content...
	[/tab2]
[/tabs2]
*/
function theme_tabs2($atts, $content = null) {
    extract(shortcode_atts(array(
		"titles" => "",
		"ids" => "",
		"active" => "no" //yes, no
    ), $atts));
   
	$title_chunks = explode("|", $titles);
	$ids_chunks = explode("|", $ids);
	
	$tabs_output = '
		<!-- tabset -->
		<nav class="tabsetnav col-14">
			<ul class="tabset2">
	';
	
	for ($i=0;$i<count($title_chunks);$i++) {
		if ($i == 0) { $class_active =' class="active"'; } else { $class_active =''; }
			$tabs_output .= '
				<li'.$class_active.'><a href="#tab-'.$ids_chunks[$i].'" class="tab1">'.$title_chunks[$i].'</a></li>
			';
	}
	
	$tabs_output .= '
			</ul>
		</nav>
		<div class="txt">
			'.do_shortcode($content).'
		</div>
	';
	return $tabs_output;
}
add_shortcode("tabs2", "theme_tabs2");
//TAB2 info shortcode
function theme_tab2($atts, $content = null) { 
    extract(shortcode_atts(array(
		"id" => "",
		"active" => "no" //yes, no
    ), $atts));
	
	$active_style = ($active == 'no') ?  'style="display:none;" ' : '';
	
	return '
			<!-- tab-content -->
			<article '.$active_style.'class="tab-content2" id="tab-'.$id.'">
				'.do_shortcode($content).'
			</article>
	';
}
add_shortcode("tab2", "theme_tab2");


//[accordions] [accordion fullsize="yes" title="Accordion Title1"]The Content 1[/accordion] [accordion title="Accordion Title2"]The Content 2[/accordion] [accordion title="Accordion Title3"]The Content 3[/accordion] [/accordions]
function theme_accordions($atts, $content=null){
	extract(shortcode_atts( array(
		"fullsize" => "no", //yes, no
	), $atts));
	
	$column_style = ($fullsize == 'yes') ?  'col-1' : 'col-13';	
	return '<ul class="menu '.$column_style.' accordion">
			'.do_shortcode($content).'
		</ul>';

}
add_shortcode('accordions', 'theme_accordions');

function theme_accordion($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"active" => "no", //yes, no
	), $atts));

	$active_tab = ($active == 'yes') ?  ' class="active"' : '';

	return '<li'.$active_tab.'>
			<h4><a href="#" class="opener">'.$title.'</a></h4>
			<div class="case">
				<div class="holder">
					<p>'.do_shortcode($content).'</p>
				</div>
			</div>
		</li>';
}
add_shortcode('accordion', 'theme_accordion');




//[button text="Green Button" url="http://www.themeforest.net" color="green" target="_blank"]
//[button text="Black Button" url="http://www.themeforest.net" color="black" target="_blank"]
//[button text="Orange Button" url="http://www.themeforest.net" color="orange" target="_blank"]
//[button text="Blue Button" url="http://www.themeforest.net" color="blue" target="_blank"]
//[button text="Red Button" url="http://www.themeforest.net" color="red" target="_blank"]
//[button text="Magenta Button" url="http://www.themeforest.net" color="magenta" target="_blank"]
//[button text="Grey Button" url="http://www.themeforest.net" color="grey" target="_blank"]
function theme_button($atts, $content=null){
	extract(shortcode_atts( array(
		"text" => "Submit",
		"url" => "#",
		"color" => "grey", //grey, green, black, orange, blue, red, magenta
		"bgcolor" => "",
		"textcolor" => "",
		"fontsize" => "",
		"padding" => "",
		"radius" => "3", //maximum can be 100px
		"target" => "_self" //_blank, _self
	), $atts));

	$hex_bgcolor = ($bgcolor) ? 'background:#'.str_replace('#','',$bgcolor).';' : '';
	$hex_textcolor = ($textcolor) ? 'color:#'.str_replace('#','',$textcolor).';' : '';
	$button_fontsize = ($fontsize) ? 'font-size:'.str_replace('em','',str_replace('px','',$fontsize)).'px;' : '';
	$button_padding = ($padding) ? 'padding:'.$padding.';' : '';
	$button_radius = ($radius) ? '	-moz-border-radius:'.str_replace('px','',$radius).'px; -webkit-border-radius:'.str_replace('px','',$radius).'px; border-radius:'.str_replace('px','',$radius).'px;' : '';
	
	$cutom_buttoncolor_style = ($hex_bgcolor || $hex_textcolor || $button_fontsize || $button_padding || $button_radius) ? ' style="'.$button_radius.$button_fontsize.$button_padding.$hex_bgcolor.$hex_textcolor.'"' : '';
	
	return '
		<a href="'.$url.'" class="btn '.$color.'"'.$cutom_buttoncolor_style.' target="'.$target.'"><span>'.$text.'</span></a>
	';	
}
add_shortcode('button', 'theme_button');






//[infobox type="information"]Info - Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.[/infobox]
//[infobox type="note"]Info - Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.[/infobox]
//[infobox type="attention"]Info - Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.[/infobox]
//[infobox type="error"]Info - Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.[/infobox]
function theme_infobox($atts, $content = null) {
    extract(shortcode_atts(array(
		"type" => "information", //information, note, attention, error
    ), $atts));

	if ($type == 'information') {
		$type_style = '';
	} else if ($type == 'note') {
			$type_style = ' green';
	} else 	if ($type == 'attention') {
		$type_style =' yellow'; 
	} if ($type == 'error') {
		$type_style = ' red';
	}
	
	return '
		<!-- message-box -->
		<div class="message-box'.$type_style.'">
			'.do_shortcode($content).'
		</div>
	';
}
add_shortcode('infobox','theme_infobox');






/*
[pricing_tables]
[pricing_table column="one_third" title="Starter PACKAGE" price="$19.99" buttontext="Sign Up &raquo;" buttonurl="http://www.themeforest.net/signup" buttoncolor="blue"]
	<ul>
		<li>Free setup</li>
		<li>Unlimited bandwidth</li>
		<li>1 GB Storage</li>
		<li>$100 Google AdWords credit</li>
		<li>$100 Amazon Ad credit</li>
		<li>Unlimited web hosting</li>
		<li>SSL shopping cart (PCI Compliant)</li>
		<li>Easy domain name registration with Discount Code coupon engine</li>
		<li>Plus hundreds of other features!</li>
	</ul>Content... 
[/pricing_table]
[/pricing_tables]
*/
function theme_pricing_tables($atts, $content=null){

	return '
		<section class="prtice-example">
			<div class="container">
				'.do_shortcode($content).'
				<section class="content-vid"></section>
			</div>
		</section>
	';
}
add_shortcode('pricing_tables', 'theme_pricing_tables');
function theme_pricing_table($atts, $content=null){
	extract(shortcode_atts( array(
		"title" => "",
		"price" => "",
		"buttontext" => "Sign Up &raquo;",
		"buttonurl" => "#",
		"buttoncolor" => "", //grey, green, black, orange, blue, red, magenta
		"column" => "one_third" //one_half, one_third, one_fourth, two_third, three_fourth
	), $atts));

	if ($column == 'one_half') { $column_class = 'col-12'; }
	else if ($column == 'one_third') { $column_class = 'col-13'; }
	else if ($column == 'one_fourth') { $column_class = 'col-14'; }
	else if ($column == 'two_third') { $column_class = 'col-23'; }
	else if ($column == 'three_fourth') { $column_class = 'col-34'; }
	
	return '
		<article class="'.$column_class.' price-box">
			<div class="heading">
				<h4>'.$title.'</h4>
				<span class="price">'.$price.'</span>
			</div>
			<div class="holder">
				'.do_shortcode(str_replace('<ul','<ul class="package-list"',$content)).'
				<a href="'.$buttonurl.'" class="btn '.$buttoncolor.'">'.$buttontext.'</a>
			</div>
		</article>
	';
}
add_shortcode('pricing_table', 'theme_pricing_table');



//[gallery id="" width="" height=""]
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'theme_gallery');
function theme_gallery($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => "",
		"width" => "80",
		"height" => "80"
    ), $atts));

	$attachment_args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,       
		'post_status' => null,
		'post_parent' => $id,
		'orderby' => 'menu_order',
		'order' => 'DESC'
	);

	if ($id) {
		
		$output_pagination = '
			<style>
				#gallery-1 {
					margin: auto;
				}
				#gallery-1 .gallery-item {
					float: left;
					margin-top: 10px;
					margin-right: 20px;
					text-align: center;
					width: auto;
				}
				#gallery-1 img {
					border: 2px solid #cfcfcf;
				}
				#gallery-1 .gallery-caption {
					margin-left: 0;
				}
			</style>
		';
	
		$output_pagination .= '
			<div id="gallery-1" class="gallery galleryid-500 gallery-columns-3 gallery-size-thumbnail">
		';
		
		$site_url_images = get_site_url();
		$attachments = get_posts($attachment_args);
		if ($attachments) {
			foreach($attachments as $gallery ) {
				$i++;
				$image_attachment_url = wp_get_attachment_url( $gallery->ID);
				$gallery_thumbnail = get_the_post_thumbnail($gallery->ID, 'gallery');
				
				$output_pagination .= '
					<dl class="gallery-item">
					  <dt class="gallery-icon"> <a href="'.$image_attachment_url.'" data-rel="prettyPhoto[gallery_'.$id.']" title="'.get_the_title($gallery->ID).'"><img src="'.get_bloginfo('template_url').'/functions/timthumb.php?src='.$image_attachment_url.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1" /></a></dt>
					</dl>
				';
			}
		}

		$output_pagination .= '
				<br style="clear: both" />
				<br style="clear: both;" />
			</div>
		';

		return $output_pagination;
	} else return '...You forgot to enter the page ID in the gallery shortcode...';
}
add_shortcode('gallery','theme_gallery');




//[googlemap src="http://maps.google.com/?ie=UTF8&ll=46.774671,-71.220932&spn=0.172821,0.445976&t=h&z=12&output=embed" width="520" height="310"]
function theme_google_map($atts, $content = null) {
	global $shortname;
	extract(shortcode_atts(array(
		"width" => '',
		"height" => '',
		"src" => ''
	), $atts));
   
	if (!$src) { $src = get_option($shortname.'_contact_google_maps'); }
	
	if ($src) {
		return '
			<div class="block_map">
				<div class="block_general_pic" style="padding:0px;">
					<iframe width="'.$width.'" height="'.$height.'" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'" style="color:#0000FF;text-align:left; border:0px solid #ddd; padding:5px; background:#fff;"></iframe>
				</div>
			</div>
		';
   }
}
add_shortcode("googlemap", "theme_google_map");


//[vimeo url="http://player.vimeo.com/video/20245032?title=0&amp;byline=0&amp;portrait=0" width="" height=""]
function theme_vimeo($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '#',
		"width" => '650',
		"height" => '374'
	), $atts));
	
	return '
		<article>
			<iframe src="'.$url.'" width="'.$width.'" height="'.$height.'" ></iframe>
		</article>
	';
}
add_shortcode("vimeo", "theme_vimeo");


//[youtube url="http://player.vimeo.com/video/20245032?title=0&amp;byline=0&amp;portrait=0" width="" height=""]
function theme_youtube($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '#',
		"width" => '650',
		"height" => '374'
	), $atts));
	
	return '
		<article>
			<iframe src="'.$url.'" width="'.$width.'" height="'.$height.'" ></iframe>
		</article>
	';
}
add_shortcode("youtube", "theme_youtube");


//[dailymotion url="http://player.vimeo.com/video/20245032?title=0&amp;byline=0&amp;portrait=0" width="" height=""]
function theme_dailymotion($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '#',
		"width" => '650',
		"height" => '374'
	), $atts));
	
	return '
		<article>
			<iframe src="'.$url.'" width="'.$width.'" height="'.$height.'" ></iframe>
		</article>
	';
}
add_shortcode("dailymotion", "theme_dailymotion");
?>