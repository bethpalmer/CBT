<?php
/*
Template Name: Portfolio Sortable
*/
get_header();
?>

				<!-- main -->
				<div id="main">
					<!-- intro -->
					<section class="intro">
						<?php if (get_option($shortname."_search_portfolio") == 'true') { ?>
						<!-- search -->
						<form action="<?php echo home_url(); ?>" method="get" class="search">
							<fieldset>
								<input type="text" name="s" id="s" value="<?php _e('Click or type here to search','extensio'); ?>" class="text" >
								<input type="submit" value="go" class="submit" >
							</fieldset>
						</form>
						<?php } //end search form ?>
						<p><?php 
							//get page section title
							if (get_post_meta($post->ID, $shortname.'_custom_page_heading',true)) { 
								echo get_post_meta($post->ID, $shortname.'_custom_page_heading',true);
							} else the_title(); ?></p>
					</section>
					<section class="images-example">
						<article class="project">
							<nav class="project-type" id="options">
								<strong>Project Type:</strong>
								<ul id="filters" class="option-set" data-option-key="filter">
									<li><a href="#filter" data-option-value="*">All</a></li>
									
									<?php
										global $shortname;
										$count  = get_option($shortname.'_portfolio_items_count');
										$count = ($count == 'All') ? '-1' : $count;
										$orderby = get_option($shortname.'_portfolio_order_by');
										$order   = get_option($shortname.'_portfolio_order');

										$thePostID = $post->ID;
										$get_custom_options = get_option($shortname.'_portfolio_page_id');
										$cat_inclusion = trim($get_custom_options['portfolio_to_cat_'.$thePostID]);
										
										$type = 'portfolio';
										if ($cat_inclusion) {
											$args=array(
												'post_type' => $type,
												'tax_query' => array(
													array(
														'taxonomy' => 'portfolio_entries',
														'field' => 'id',
														'terms' => $cat_inclusion
													 )
												),
												'post_status' => 'publish',
												'posts_per_page' => $count,
												'orderby' => $orderby,
												'order' => $order,
												'paged' => $paged
											);
										} else {
											$args=array(
												'post_type' => $type,
												'post_status' => 'publish',
												'posts_per_page' => $count,
												'orderby' => $orderby,
												'order' => $order,
												'paged' => $paged
											);
										}
									
										$temp = $wp_query;  // assign original query to temp variable for later use   
										$wp_query = null;

										$cats_ungategorized = array();
										
										$wp_query = new WP_Query($args);
										if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
										
											$item_categories = get_the_terms( $id, 'portfolio_entries' );
											if(is_object($item_categories) || is_array($item_categories)) {
												foreach ($item_categories as $cat) {													
													$duplicate_cat = 0;
													for ($i=0;$i<count($cats_ungategorized);$i++) {
														if ($cats_ungategorized[$i] ==  $cat->slug.'###'.$cat->name) {
															$duplicate_cat = 1;
														}
													}
													if ($duplicate_cat != 1) {
														$cats_ungategorized[] = $cat->slug.'###'.$cat->name;
													} else { $duplicate_cat = 0; }
												}
											}

										endwhile;
										endif;
										$wp_query = null;
										$wp_query = $temp;
										
										asort($cats_ungategorized);
										foreach ($cats_ungategorized as $key => $val) {
											$cats_chunks = explode("###", $val);
											echo '<li><a href="#filter" data-option-value=".'.$cats_chunks[0].'">'.$cats_chunks[1].'</a></li>';
										}										
									?>
									
								</ul>
							</nav>
						</article>							
						<!-- visual-list -->
						<ul class="visual-list" id="works-container">
						
						<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
						<?php endif; ?>
							
						<?php
							$count  = get_option($shortname.'_portfolio_items_count');
							$count = ( $count != 'All' ) ? $count : '-1';
							$orderby = get_option($shortname.'_portfolio_order_by');
							$order   = get_option($shortname.'_portfolio_order');
							
							$thePostID = $post->ID;
							$get_custom_options = get_option($shortname.'_portfolio_page_id');
							$cat_inclusion = trim($get_custom_options['portfolio_to_cat_'.$thePostID]);
							
							$type = 'portfolio';
							if ($cat_inclusion) {
									$args=array(
									'post_type' => $type,
									'tax_query' => array(
										array(
											'taxonomy' => 'portfolio_entries',
											'field' => 'id',
											'terms' => $cat_inclusion
										 )
									),
									'post_status' => 'publish',
									'posts_per_page' => $count,
									'orderby' => $orderby,
									'order' => $order,
									'paged' => $paged
								);
							} else {
								$args=array(
									'post_type' => $type,
									'post_status' => 'publish',
									'posts_per_page' => $count,
									'orderby' => $orderby,
									'order' => $order,
									'paged' => $paged
								);
							}
						
							$temp = $wp_query;  // assign original query to temp variable for later use   
							$wp_query = null;
							
							$wp_query = new WP_Query($args);
							
							if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
							
								// get full image from featured image if was not see full image url in Portfolio
								$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
								$get_custom_image_url = $get_custom_options[0];
								$portfolio_image = get_the_post_thumbnail($post->ID, 'portfolio_3', array('alt' => the_title_attribute('echo=0')));

								$custom = get_post_custom($post->ID);
								$portfolio_video_url = $custom["portfolio_video_url"][0];						
								if ($portfolio_video_url) {
									$get_custom_image_url = $portfolio_video_url;
									$blogpost_video_url = $portfolio_video_url;
									$blogpost_video_url = str_replace('youtube.com/embed/','youtube.com/',$blogpost_video_url);
									$blogpost_video_url = str_replace('youtube.com/','youtube.com/embed/',$blogpost_video_url);
									$blogpost_video_url = str_replace('youtube.com/','youtu.be/',$blogpost_video_url);
									$blogpost_video_url = str_replace('youtu.be/embed/','youtu.be/',$blogpost_video_url);
									$blogpost_video_url = str_replace('vimeo.com','player.vimeo.com/video',$blogpost_video_url);
									$blogpost_video_url = str_replace('www.','',$blogpost_video_url);																		
									$get_custom_image_url = $blogpost_video_url;								
								}
								
								
								$item_categories = get_the_terms( $post->ID, 'portfolio_entries' );
								if(is_object($item_categories) || is_array($item_categories)) {
									$cat_slug = '';
									$sortable_cats = '';
									$cats_count = count($item_categories);
									$cat_number = 0;
									foreach ($item_categories as $cat) {
									
										$sortable_cats .= ' '.$cat->slug;
										
										$cat_number++;
										if ($cats_count == 1) {
											$cat_slug .= '<a href="'.get_term_link($cat->name, 'portfolio_entries').'">'.$cat->name.'</a>'; 
										} else {
											if ($cat_number != $cats_count) {
												$cat_slug .= '<a href="'.get_term_link($cat->name, 'portfolio_entries').'">'.$cat->name.', </a>'; 
											} else {
												$cat_slug .= '<a href="'.get_term_link($cat->name, 'portfolio_entries').'">'.$cat->name.'</a>'; 
											}
										}
										
									}
								}
						?>

							<li class="col-13 element<?php echo $sortable_cats; ?>" data-category="<?php echo $sortable_cats; ?>">
								<div class="visual">
									<div class="note-holder">
										<?php echo $portfolio_image; ?>
										<div class="note">
											<nav class="actions">
												<ul>
													<li><a class="zoom-action" href="<?php echo $get_custom_image_url; ?>" data-rel="prettyPhoto[gallery_<?php echo $post->ID; ?>]"><?php _e('zoom',''); ?></a>
													</li><li><a class="link " href="<?php the_permalink(); ?>"><?php _e('link',''); ?></a></li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
								<?php
									$attachment_args = array(
										'post_type' => 'attachment',
										'numberposts' => -1,       
										'post_status' => null,
										'post_parent' => $post->ID,
										'orderby' => 'menu_order ID'
									);									
									$attachments = get_posts($attachment_args);
									$hidden_image_number = 0;
									if ($attachments) {
										foreach($attachments as $gallery ) {
											$hidden_image_number++;
											if ($hidden_image_number > 0) {
												$current_attachment_url =  wp_get_attachment_url($gallery->ID);
												$image_attachment_url =  $current_attachment_url;
												if ($get_custom_image_url != $current_attachment_url) {
													echo '<a style="visibility:hidden; height:0px; width:0px;" href="'.$image_attachment_url.'" data-rel="prettyPhoto[gallery_'.$post->ID.']" title="'.get_the_title().'"></a>';
												}
											}
										}
									}
								?>								
								<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
								<?php echo $cat_slug; ?>
								
							</li>

						<?php
							endwhile;
							endif;
						?>

					</ul>
						
					<!-- paging -->
					<nav class="paging">
						<ul>
							<?php
								if(function_exists('wp_pagenavi')) { wp_pagenavi(); }								
							?>

						</ul>
					</nav>
					
					<?php

						$wp_query = null;
						$wp_query = $temp;						
					?>					
					
					</section>
				</div>
				<!--/ main -->

<?php get_footer(); ?>