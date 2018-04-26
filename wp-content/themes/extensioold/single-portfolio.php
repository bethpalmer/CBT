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
							if (get_post_meta($post->ID, 'custom_page_heading',true)) { 
								echo get_post_meta($post->ID, 'custom_page_heading',true);
							} else the_title(); ?></p>
					</section>
					
					<div class="main-holder">
						<!-- content -->
						<section class="col" id="content">
							<!-- article -->
							<article class="article article-alt">
								<?php 
									if (have_posts()) : while (have_posts()) : the_post();
										$thumb_url = get_the_post_thumbnail($post->ID, 'portfolio_single', array('alt' => the_title_attribute('echo=0')));
										$get_attachment_preview_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image_preview', false );
										$portfolio_image_preview = $get_attachment_preview_src[0];
										$this_post_id = $post->ID;
								?>
								<div class="area">
									<div class="txt2">
										<h2><?php the_title(); ?></h2>
										<div class="latest-work-portfolio-page">
											<div class="holder list_carousel">
												<!-- work-list -->
												<ul class="work-list-details" id="portfolio_carousel">
													<li>
														<?php
															$custom = get_post_custom($post->ID);
															$portfolio_video_url = $custom["portfolio_video_url"][0];						
															if ($portfolio_video_url) {																
																$portfolio_video_url = str_replace('youtube.com/embed/','youtube.com/',$portfolio_video_url);
																$portfolio_video_url = str_replace('youtube.com/','youtube.com/embed/',$portfolio_video_url);
																$portfolio_video_url = str_replace('youtube.com/','youtu.be/',$portfolio_video_url);
																$portfolio_video_url = str_replace('youtu.be/embed/','youtu.be/',$portfolio_video_url);
																$portfolio_video_url = str_replace('youtu.be/','youtube.com/embed/',$portfolio_video_url);
																$portfolio_video_url = str_replace('vimeo.com','player.vimeo.com/video',$portfolio_video_url);
																$portfolio_video_url = str_replace('www.','',$portfolio_video_url);
																
														?>
															<iframe src="<?php echo $portfolio_video_url; ?>" width="654" height="400"></iframe>
														<?php
																
															} else {
														?>													
															<div class="visual"><div class="note-holder"><img src="<?php echo $portfolio_image_preview; ?>" width="634"><a href="<?php echo $portfolio_image_preview; ?>" data-rel="prettyPhoto[pp_gallery1]"><div class="note zoom"></div></a></div></div>
														<?php } ?>
													</li>
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
																	if ($portfolio_image_preview != $current_attachment_url) {
																		echo '
																			<li>
																				<div class="visual"><div class="note-holder"><img src="'.$image_attachment_url.'" width="634"><a href="'.$image_attachment_url.'" data-rel="prettyPhoto[pp_gallery1]"><div class="note zoom"></div></a></div></div>
																			</li>
																		';
																	}
																}
															}
														}
													?>						
												</ul>
											</div>
											<!-- switcher -->
											<nav class="carousel_pagination" id="carousel_pager"></nav>
										</div>
										<?php the_content(); ?>
									</div>	
								</div>
							</article>
							<?php endwhile; ?>
							<?php endif; ?>
							
							
							<?php if (get_option($shortname."_portfolio_last_items_enable") == 'true') { ?>
							<!-- article-list -->
							<section class="article-list">
								<h3 class="title"><?php _e('Recent Projects:','extensio'); ?></h3>
								<ul>
									<?php  
										query_posts("post_type=portfolio&order=desc&showposts=4");
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
											endwhile;  
												else : 
													echo '<p>'.__('No portfolio items found.','extensio').'</p>';
											endif; 
										}										
										wp_reset_query(); //reset query
									?>
								
								</ul>
							</section>
							<?php } ?>

							<?php
								//comments_template('', true);
							?>
						</section>
						<!-- sidebar -->
						<aside class="col" id="sidebar">
						
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Portfolio Sidebar") ) : ?>
							<?php endif; ?>

							<?php 
								wp_reset_postdata();
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