<?php
/*
Template Name: Page Right Sidebar Team
*/
get_header();
?>

				<!-- main -->
				<div id="main">
					<!-- intro -->
					<section class="intro">
						<?php if (get_option($shortname."_search_pages") == 'true') { ?>
						<!-- search -->
						<form id="search" class="search">
						<input type="text" class="addsearch" placeholder=" Search..."/>
						</form>
						<?php } //end search form ?>
						<p><?php
							//get page section title
							if (get_post_meta($post->ID, $shortname.'_custom_page_heading',true)) { 
								echo get_post_meta($post->ID, $shortname.'_custom_page_heading',true);
							} else the_title(); ?></p>
					</section>
					<div class="main-holder-team">
						<section class="col" id="contentteam">
							<?php if (have_posts()) : ?>
							<?php while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
								
								<!-- article-list -->
							<section class="article-list">
								<?php 
								$authorid = get_post_meta($post->ID, 'custom_authorid', true);
								?>
								<h3><?php echo "Recent Blog Articles by ".get_the_author_meta('first_name',$authorid)." ".get_the_author_meta('last_name',$authorid); ?></h3>
								<ul class="floatnone">
									<?php  
										query_posts("post_type=post&author=".$authorid."&order=desc&showposts=4");
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
								
							<?php endwhile; ?>
							<?php endif; ?>
						</section>
											
						<!-- sidebar -->
						<aside class="col" id="sidebar-team">
<?php 
								$booking_widget = get_post_meta($post->ID, 'Booking_Widget', true);
								$booking_widget = str_replace('width:480px;height:600px;','width:100%; min-width: 270px; margin-bottom: 10px; height: 675px;',$booking_widget);
								$booking_widget = str_replace('<iframe src="//thebritishcbtcounsellingservice.gettimely.com/book/embed?','<h4>Book Online</h4><iframe src="//thebritishcbtcounsellingservice.gettimely.com/book/embed?',$booking_widget);

								echo $booking_widget;
							?>
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Page Sidebar") ) : ?>
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