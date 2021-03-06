<?php
/**
 * The template for displaying Search Results pages.
*/
get_header();
?>

				<!-- main -->
				<div id="main">
					<!-- intro -->
					<section class="intro">
						<!-- search -->
						<form id="search" class="search">
						<input type="text" class="addsearch" placeholder=" Search..."/>
						</form>
						<p><?php printf( __( 'Search Results for: %s', 'extensio' ), '<strong>' . get_search_query() . '</strong>' ); ?></p>
					</section>
					<div class="main-holder">
						<!-- content -->
						<section class="col" id="content">
							<?php
								$count  = get_option($shortname.'_search_result_items_count');
								$count = ($count == 'All') ? '-1' : $count;

								$thePostID = $post->ID;
								$get_custom_options = get_option($shortname.'_blog_page_id'); 
								$cat_id_inclusion = trim($get_custom_options['blog_to_cat_'.$thePostID]);

								$s = $_GET['s'];

								$type = get_option($shortname."_search_results");
								$posttype_chunks = explode(",", $type);
								$posttype = array();
								for ($i=0;$i<count($posttype_chunks);$i++) {
									$posttype[] = trim($posttype_chunks[$i]);
								}
								
								$args=array(
									'post_type' => $posttype,
									'post_status' => 'publish',
									'posts_per_page' => $count,
									's' => $s,
									'orderby' => 'ID',
									'order' => 'desc',
									'paged' => $paged
								);
								$temp = $wp_query;  // assign original query to temp variable for later use   
								$wp_query = null;
								
								$wp_query = new WP_Query($args);
								if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
									
									$thumb_url = get_the_post_thumbnail($post->ID, 'blog_2', array('alt' => the_title_attribute('echo=0')));
							?>

							<!-- article -->
							<article class="article article-alt">
								<div class="heading">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<?php if ('post' == get_post_type()) { ?><strong class="author"><?php _e('by','extensio'); ?> <?php if (!get_the_author_meta('first_name') && !get_the_author_meta('last_name')) { the_author_posts_link(); } else { echo '<a href="'.home_url().'?author='.get_the_author_meta('ID').'">'.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').'</a>'; } ?></strong><?php } //end check the post type ?>
								</div>
								<nav class="add-info">
									<ul>
										<li><?php echo get_the_time('F d, Y'); ?></li>
										
										<?php if ('post' == get_post_type()) { ?>
										<li class="data"><?php the_category(', ') ?></li>
										<?php 
											} else if ('portfolio' == get_post_type()) { 
										
												$item_categories = get_the_terms( $post->ID, 'portfolio_entries' );
												if(is_object($item_categories) || is_array($item_categories)) {
													$cat_slug = '';
													$cats_count = count($item_categories);
													$cat_number = 0;
													foreach ($item_categories as $cat) {
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
										<li class="data"><?php echo $cat_slug; ?></li>
										<?php } //end if the post type is post or portfolio ?>
										
										<?php if ('post' == get_post_type()) { ?>
										<li class="comments"><?php comments_popup_link(__('0 Comments', 'extensio'),__('1 Comment', 'extensio'), __('% Comments', 'extensio')); ?></li>
										<?php } //ent if the post type is post?>
									</ul>
								</nav>
								<?php if ($thumb_url) { ?><figure class="visual"><?php echo $thumb_url; ?></figure><?php } ?>
								<?php the_excerpt(); ?>
								<a class="more" href="<?php the_permalink(); ?>"><?php _e('Read more ...','extensio'); ?></a>
							</article>

							<?php 
								endwhile; 
									else: 
										_e('<h2>Nothing Found</h2>','extensio');
										echo '<p>'.__( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'extensio' ).'</p>';
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