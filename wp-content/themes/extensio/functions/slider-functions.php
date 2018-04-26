<?php
function selected_slider_output($slider_name) {
    global $wp_query, $meta_box, $post, $shortname;

	$slider_items_count = get_option($shortname.'_slides_count');
		
	$type = 'slider';					
	$args=array(
	'post_type' => $type,
	'post_status' => 'publish',
	'posts_per_page' => $slider_items_count,
	'orderby' => 'menu_order',
	'order' => 'asc'
	);
	
	$temp = $wp_query;  // assign original query to temp variable for later use 
	$n = 0; // variable $n, if $n = 1 then get 1st slider image
	$wp_query = null;
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
		$n++;
		
		if ($slider_name == 'Nivo Slider') {
			$get_attachment_preview_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image_preview', false );
			$slider_image_preview[$n] = $get_attachment_preview_src[0];

			$custom = get_post_custom($post->ID);
			$slider_title[$n] = $custom["slider_title"][0];
			$slider_description[$n] = $custom["slider_description"][0];
			$slider_website_url[$n] = $custom["slider_website_url"][0];			
		}		
		
		if ($slider_name == 'CarouFredSel Slider') {
			$get_attachment_preview_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image_preview', false );
			$slider_image_preview[$n] = $get_attachment_preview_src[0];

		}
		
		if ($slider_name == 'Accordion Slider') {
			$get_attachment_preview_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image_preview', false );
			$slider_image_preview[$n] = $get_attachment_preview_src[0];
			$get_attachment_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider_accordion', false );
			$slider_image_thumb[$n] = $get_attachment_thumb_src[0];
			
			$custom = get_post_custom($post->ID);
			$slider_title[$n] = $custom["slider_title"][0];
			$slider_description[$n] = $custom["slider_description"][0];
			$slider_website_url[$n] = $custom["slider_website_url"][0];
		}
		
		if ($slider_name == 'OneByOne Slider') {
			$get_attachment_preview_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider_onebyone', false );
			$slider_image_preview[$n] = $get_attachment_preview_src[0];
			
			$custom = get_post_custom($post->ID);
			
			//get content align option
			$slider_text_align[$n] = $custom["slider_text_align"][0];
			
			//get title options
			$slider_title[$n] = $custom["slider_title"][0];
			$slider_title_color[$n] = $custom["slider_title_color"][0];
			$slider_title_color_checkbox[$n] = $custom["slider_title_color_checkbox"][0];
			$slider_title_bgcolor[$n] = $custom["slider_title_bgcolor"][0];
			$slider_title_bgcolor_checkbox[$n] = $custom["slider_title_bgcolor_checkbox"][0];
			
			//get subtitle options
			$slider_subtitle[$n] = $custom["slider_subtitle"][0];
			$slider_subtitle_color[$n] = $custom["slider_subtitle_color"][0];
			$slider_subtitle_color_checkbox[$n] = $custom["slider_subtitle_color_checkbox"][0];
			$slider_subtitle_bgcolor[$n] = $custom["slider_subtitle_bgcolor"][0];
			$slider_subtitle_bgcolor_checkbox[$n] = $custom["slider_subtitle_bgcolor_checkbox"][0];

			//get description options
			$slider_description[$n] = $custom["slider_description"][0];
			$slider_description_color[$n] = $custom["slider_description_color"][0];
			$slider_description_color_checkbox[$n] = $custom["slider_description_color_checkbox"][0];
			$slider_description_bgcolor[$n] = $custom["slider_description_bgcolor"][0];
			$slider_description_bgcolor_checkbox[$n] = $custom["slider_description_bgcolor_checkbox"][0];			
			
			//get button options
			$slider_website_url[$n] = $custom["slider_website_url"][0];
			$slider_button_text[$n] = $custom["slider_button_text"][0];
			$slider_button_color[$n] = $custom["slider_button_color"][0];
			$slider_button_color_checkbox[$n] = $custom["slider_button_color_checkbox"][0];
			$slider_button_bgcolor[$n] = $custom["slider_button_bgcolor"][0];
			$slider_button_bgcolor_checkbox[$n] = $custom["slider_button_bgcolor_checkbox"][0];			
		}
	endwhile; endif;
	$wp_query = null;
	$wp_query = $temp;
    
	$slider_output = '';
	$slide_output = '';

	if ($slider_name == 'Piecemaker Slider') {
		$slider_output = '';
		$slider_output .= '
			<div class="block_slider_3D">
				<div id="piecemaker">
				  <p>Put your alternative Non Flash content here.</p>
				</div>
			</div>
		';
	}	
	
	if ($slider_name == 'Nivo Slider') {
		$slider_output = '';
		$slider_output .= '
						<!-- nivo slider -->
						<div id="slider" class="nivoSlider">
		';
		for ($i=1;$i<=$slider_items_count;$i++) {
			$slide_id = ($slider_description[$i]) ? 'id="#slider'.$i.'" ' : '';
			$slider_output .= ($slider_website_url[$i]) ? '
							<a href="'.$slider_website_url[$i].'"><img src="'.$slider_image_preview[$i].'" width="990" height="397" alt="'.$slider_title[$i].'" '.$slide_id.'/></a>
				' : '
							<img src="'.$slider_image_preview[$i].'" width="990" height="397" alt="'.$slider_title[$i].'" />
				';
		}
		$slider_output .= '
						</div>
						<!-- slide text -->
		';
		for ($i=1;$i<=$slider_items_count;$i++) {
			if ($slider_description[$i]) {
				$slider_output .= '
						<div class="nivo-html-caption" id="slider'.$i.'">
							<div class="nivo-html-caption-bg"></div>
							<h3><a href="'.$slider_website_url[$i].'">'.$slider_title[$i].'</a></h3>
							<p>'.$slider_description[$i].'
						</div>
				';
			}
		}			
	}
	
	if ($slider_name == 'CarouFredSel Slider') {
		$slider_output = '';
		$slider_output .= '
				<div class="slider_list_carousel">
					<ul class="gallery-list" id="carouFredSel">
		';
		for ($i=1;$i<=$slider_items_count;$i++) {
		
			$slider_output .= '
						<li><img src="'.$slider_image_preview[$i].'" width="990" height="397" alt="" /></li>
			';
		}
		$slider_output .= '
					</ul>
					<div class="clearfix"></div>
					<div id="timer_carousel" class="timer"></div>
				</div>
		';
	}

	if ($slider_name == 'Accordion Slider') {
		$slider_output = '';
		$slider_output .= '
				<div class="block_slider_accordion">
					<div class="slider_wrapper"> 
						<ul id="slider_accordion_ul">		
		';
		for ($i=1;$i<=$slider_items_count;$i++) {
		
			$slider_output .= '
							<li>
								<a href="'.$slider_image_preview[$i].'" data-rel="prettyPhoto[accordion]" title="'.$slider_title[$i].'">
								   
								   <img src="'.$slider_image_thumb[$i].'" alt="" class="slider_image" />
								</a>
								<div class="accordion_text">
									<div class="short_text">
										<a href="'.$slider_website_url[$i].'">'.$slider_title[$i].'</a><span class="more_text">...</span>
									</div>
									<div class="detail_text">'.$slider_description[$i].'</div>
								</div>
							</li>			
			';
		}
		$slider_output .= '
					</ul>
				</div>
			</div>
		';
	}	
	
	

	
	if ($slider_name == 'OneByOne Slider') {
		$slider_output .= '
			<div id="banner">
				
		';

		for ($i=1;$i<=$slider_items_count;$i++) {
			if ( $slider_title[$i] || $slider_subtitle($i) || $slider_description[$i] || $slider_website_url($i) ) {
				$slide_output .= '
					<div class="oneByOne_item">
						<img src="'.$slider_image_preview[$i].'" class="bigImage" alt="'.$slider_title[$i].'" />
				';
				
				// get the content align option
				$slider_text_align_class = '';
				if ($slider_text_align[$i] == 'left') { $slider_text_align_class = '_left'; }
				
				// get the title options
				$slider_title_colors_checkbox_style = '';
				if ($slider_title_color_checkbox[$i] == 'on') {
					$slider_title_colors_checkbox_style .= 'color:#'.$slider_title_color[$i].';';
				}
				if ($slider_title_bgcolor_checkbox[$i] == 'on') {
					$slider_title_colors_checkbox_style .= 'background:#'.$slider_title_bgcolor[$i].';';
				}
				$slider_title_colors_checkbox_style = 'style="'.$slider_title_colors_checkbox_style.'"';
				if ($slider_title[$i]) $slide_output .= '<span class="slideh2'.$slider_text_align_class.'" '.$slider_title_colors_checkbox_style.'>'.$slider_title[$i].'</span>';
				
				// get the subtitle options
				$slider_subtitle_colors_checkbox_style = '';
				if ($slider_subtitle_color_checkbox[$i] == 'on') {
					$slider_subtitle_colors_checkbox_style .= 'color:#'.$slider_subtitle_color[$i].';';
				}
				if ($slider_subtitle_bgcolor_checkbox[$i] == 'on') {
					$slider_subtitle_colors_checkbox_style .= 'background:#'.$slider_subtitle_bgcolor[$i].';';
				}
				$slider_subtitle_colors_checkbox_style = 'style="'.$slider_subtitle_colors_checkbox_style.'"';
				if ($slider_subtitle[$i]) $slide_output .= '<span class="slideh3'.$slider_text_align_class.'" '.$slider_subtitle_colors_checkbox_style.'>'.$slider_subtitle[$i].'</span>';
				
				// get the description options
				$slider_description_colors_checkbox_style = '';
				if ($slider_description_color_checkbox[$i] == 'on') {
					$slider_description_colors_checkbox_style .= 'color:#'.$slider_description_color[$i].';';
				}
				if ($slider_description_bgcolor_checkbox[$i] == 'on') {
					$slider_description_colors_checkbox_style .= 'background:#'.$slider_description_bgcolor[$i].';';
				}
				$slider_description_colors_checkbox_style = 'style="'.$slider_description_colors_checkbox_style.'"';				
				if ($slider_description[$i]) $slide_output .= '<span class="slideparagraph'.$slider_text_align_class.'" '.$slider_description_colors_checkbox_style.'>'.$slider_description[$i].'</span>';
				
				// get the button options
				$slider_button_colors_checkbox_style = '';
				if ($slider_button_color_checkbox[$i] == 'on') {
					$slider_button_colors_checkbox_style .= 'color:#'.$slider_button_color[$i].';';
				}
				if ($slider_button_bgcolor_checkbox[$i] == 'on') {
					$slider_button_colors_checkbox_style .= 'background:#'.$slider_button_bgcolor[$i].';';
				}
				if ($slider_button_colors_checkbox_style) {
					$slider_button_colors_checkbox_style = 'class="btn-add" style="'.$slider_button_colors_checkbox_style.'"';
				} else { $slider_button_colors_checkbox_style = 'class="btn-add"';}
				
				if ($slider_website_url[$i]) $slide_output .= '<span class="slidebutton'.$slider_text_align_class.'"><a href="'.$slider_website_url[$i].'"  '.$slider_button_colors_checkbox_style.'>'.$slider_button_text[$i].'</a></span>';
				
				$slide_output .= '
					</div>
				';
			} else {
				$slide_output .= '
					<div class="oneByOne_item">
						<img src="'.$slider_image_preview[$i].'" class="bigImage" alt="'.$slider_title[$i].'" />
					</div>				
				';
			}
		}
		
		$slider_output .= $slide_output.'
			</div>
		';
	}
	
	return $slider_output;
}
?>