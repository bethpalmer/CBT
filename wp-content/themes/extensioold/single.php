<?php
/**
* The Template for displaying all single posts.
**/
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
							<!-- article -->
							<article class="article article-alt" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php 
									if (have_posts()) : while (have_posts()) : the_post();
										$thumb_url = get_the_post_thumbnail($post->ID, 'blog_1_3_4', array('alt' => the_title_attribute('echo=0')));
										$this_post_id = $post->ID;
								?>
								<div class="area">
									<footer class="info info-alt">
										<div class="img"><a href="<?php echo home_url().'?author='.get_the_author_meta('ID'); ?>"><?php echo str_replace("class='avatar","class='rounded-corner-41",get_avatar( get_the_author_meta('email') , $size='80' )); ?></a></div>
										<nav class="info-list">
											<ul>
												<li><?php if (!get_the_author_meta('first_name') && !get_the_author_meta('last_name')) { the_author_posts_link(); } else { echo '<a href="'.home_url().'?author='.get_the_author_meta('ID').'">'.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').'</a>'; } ?><strong class="date"><?php echo get_the_time('F d, Y'); ?></strong></li>
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
										<h2><?php the_title(); ?></h2>
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
										
										<?php the_content(); ?>
									    <br />
									    <?php wp_link_pages('before=<div id="page-links"><span>Pages:</span>&after=</div>&link_before=<div>&link_after=</div>'); ?>										

									</div>
								</div>
								<!-- tags -->
								<?php the_tags('<nav class="tags"><strong class="title">'.__('Tags:','extensio').'</strong><ul><li>',',</li><li>','</li></ul></nav>'); ?>
								<!-- social-networks -->
								<nav class="social-networks">
									<strong class="title"><?php _e('Enjoyed this Post?','extensio'); ?></strong>
									<ul>
										<li><a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php echo urlencode(get_permalink($post->ID)); ?>" title="<?php _e('Share on Twitter','extensio'); ?>" rel="nofollow"><?php _e('Share on Twitter','extensio'); ?></a></li><li><a class="facebook" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php _e('Share on Facebook','extensio'); ?>"><?php _e('Share on Facebook','extensio'); ?></a></li>
									</ul>
								</nav>
							</article>
							<?php endwhile; ?>
							<?php endif; ?>
							
							<?php if (get_option($shortname."_blog_post_authorinfo") == 'true') { ?>
							<!-- about-author -->
							<article class="about-author">
								<div class="img align-left"><a href="<?php echo '?author='.get_the_author_meta('ID'); ?>"><?php echo str_replace("class='avatar","class='rounded-corner-41",get_avatar( get_the_author_meta('email') , $size='80' )); ?></a></div>
								<div class="txt">
									<h3><?php if (!get_the_author_meta('first_name') && !get_the_author_meta('last_name')) { the_author_posts_link(); } else { echo '<a href="?author='.get_the_author_meta('ID').'"><strong>'.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').'</strong></a>'; } ?></h3>
									<?php if (get_the_author_meta('description')) echo '<p>'.get_the_author_meta('description').'</p>'; ?>
								</div>
							</article>
							<?php } ?>
							
							<?php if (get_option($shortname."_blog_recent_posts_enable") == 'true') { ?>
							<!-- article-list -->
							<section class="article-list">
								<h3 class="title"><?php _e('Recent Posts:','extensio'); ?></h3>
								<ul>
									<?php  
										query_posts("post_type=post&order=desc&showposts=5");
										if($id !=0) {
											$count = 0; 
											if (have_posts()) :  while (have_posts()) : the_post(); 
											  if ($post->ID != $this_post_id)
											  if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { 
												$count++;
												if ($count<=3) {
									?> 

										<li>
											<div class="visual">
												<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(array(134, 78));?></a>
											</div>
											<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
										</li>										
								
									<?php 
												}
											}
										endwhile;  else : 
									?>
										<p><?php _e('No posts found.','extensio'); ?></p>
									<?php endif; } ?> 
									<?php  wp_reset_query(); //reset query ?>
								
								</ul>
							</section>
							<?php } ?>

							<?php
								if (get_option($shortname."_blog_post_comments") == 'true') {
									comments_template('', true);
								}
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

<?php get_footer(); ?>