<?php
/*
Template Name: Blog Layout 4
*/
get_header();
?>

				<!-- main -->
				<div id="main">
					<!-- intro -->
					<section class="intro">
						<?php if (get_option($shortname."_search_blogs") == 'true') { ?>
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
					<div class="main-holder">
						<!-- content -->
						<section class="col" id="content">
							<?php if (have_posts()) : ?>
							<?php while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
							<?php endif; ?>

							<?php					
								$count  = get_option($shortname.'_blog_posts_count');
								$count = (!$count) ? '-1' : $count;
								$orderby = get_option($shortname.'_blog_order_by');
								$order   = get_option($shortname.'_blog_order');

								$thePostID = $post->ID;
								$get_custom_options = get_option($shortname.'_blog_page_id'); 
								$cat_id_inclusion = trim($get_custom_options['blog_to_cat_'.$thePostID]);
								
								$type = 'post';
								$args=array(
									'post_type' => $type,
									'post_status' => 'publish',
									'posts_per_page' => $count,
									'cat' => $cat_id_inclusion,
									'orderby' => $orderby,
									'order' => $order,
									'paged' => $paged
								);
								$temp = $wp_query;  // assign original query to temp variable for later use   
								$wp_query = null;
								
								$wp_query = new WP_Query($args);
								if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
									
									$thumb_url = get_the_post_thumbnail($post->ID, 'blog_1_3_4', array('alt' => the_title_attribute('echo=0')));
							?>
					
							<!-- article -->							
							<article class="article">
								<footer class="info info-alt2">
									<strong class="date"><?php echo get_the_time('F d, Y'); ?></strong>
									<?php
										$blog4style_title = get_the_title($post->ID);
										$title_chunks = explode(" ", $blog4style_title);
										$blog4style_title_final = '<span>';
										for ($i=0;$i<count($title_chunks);$i++) {
											$blog4style_title_final .= $title_chunks[$i].' ';
											if ($i == 7) $blog4style_title_final .= '</span><br /><span>';
										}
										$blog4style_title_final .= '</span>';
									?>
									<h2><a href="<?php the_permalink(); ?>"><?php echo $blog4style_title_final; ?></a></h2>
									<nav class="info-list">
										<ul>
											<li><?php _e('by','extensio'); ?> <?php if (!get_the_author_meta('first_name') && !get_the_author_meta('last_name')) { the_author_posts_link(); } else { echo '<a href="'.home_url().'?author='.get_the_author_meta('ID').'">'.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').'</a>'; } ?></li>
											<li><?php the_category(', ') ?></li>
											<li><?php comments_popup_link(__('0 Comments', 'extensio'),__('1 Comment', 'extensio'), __('% Comments', 'extensio')); ?></li> 
										</ul>
									</nav>
									<nav class="social-networks">
										<ul>
											<li><a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php echo urlencode(get_permalink($post->ID)); ?>" title="<?php _e('Share on Twitter','extensio'); ?>" rel="nofollow"><?php _e('Share on Twitter','extensio'); ?></a></li><li><a class="facebook" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php _e('Share on Facebook','extensio'); ?>"><?php _e('Share on Facebook','extensio'); ?></a></li>
										</ul>
									</nav>
								</footer>
								<div class="txt">
								
									<?php
										$custom = get_post_custom($post->ID);
										$blogpost_video_url = $custom["blogpost_video_url"][0];
										if ($blogpost_video_url) {
											$blogpost_video_url = str_replace('youtube.com/embed/','youtube.com/',$blogpost_video_url);
											$blogpost_video_url = str_replace('youtube.com/','youtube.com/embed/',$blogpost_video_url);
											$blogpost_video_url = str_replace('youtube.com/','youtu.be/',$blogpost_video_url);
											$blogpost_video_url = str_replace('youtu.be/embed/','youtu.be/',$blogpost_video_url);
											$blogpost_video_url = str_replace('youtu.be/','youtube.com/v/',$blogpost_video_url);
											$blogpost_video_url = str_replace('vimeo.com','player.vimeo.com/video',$blogpost_video_url);
											$blogpost_video_url = str_replace('www.','',$blogpost_video_url);

											$width = '474'; //the video width
											$height = '296'; //the video height
											$pos = strpos($blogpost_video_url,'vimeo.com');
											if($pos === false) {
												$width = '474';
												$height = '296';
											} else {
												$width = '474';
												$height = '270';
											}
											
											$pos = strpos($blogpost_video_url,'vimeo.com');
											if($pos === false) {
									?>
										<figure class="visual">
											<object width='<?php echo $width; ?>' height='<?php echo $height; ?>'>
												<param name='movie' value='<?php echo $blogpost_video_url; ?>'>
												<param name='type' value='application/x-shockwave-flash'>
												<param name='allowfullscreen' value='true'>
												<param name='allowscriptaccess' value='always'>
												<param name="wmode" value="opaque" />
												<embed width='<?php echo $width; ?>' height='<?php echo $height; ?>'
														src='<?php echo $blogpost_video_url; ?>'
														type='application/x-shockwave-flash'
														allowfullscreen='true'
														allowscriptaccess='always'
														wmode="opaque"></embed>
											</object>
										</figure>
									<?php }  else { ?>
										<figure class="visual">
											<iframe src="<?php echo $blogpost_video_url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></iframe>
										</figure>
									<?php
										} // end if the video is youtube
											
										} else {
									?>
										<figure class="visual"><?php echo $thumb_url; ?></figure>
									<?php } ?>
										
									<?php the_excerpt(); ?>
									<a class="more" href="<?php the_permalink(); ?>"><?php _e('Read more ...','extensio'); ?></a>
								</div>
							</article>
						
							<?php 
								endwhile;
								endif;
							?>

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
						<!-- sidebar -->
						<aside class="col" id="sidebar">
						
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?>
							<?php endif; ?>

							<?php 
								$custom = get_post_custom($post->ID);
								$current_sidebar = $custom["current_sidebar"][0];	
								
								if ($current_sidebar) {
									if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($current_sidebar) ) :
									endif;
								}
							?>

						</aside>
					</div>
				</div>
				<!--/ main -->

<?php get_footer(); ?>