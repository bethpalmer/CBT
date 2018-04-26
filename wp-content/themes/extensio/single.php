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
					<div class="main-holder">
						<!-- content -->
						<section class="col" id="content">
							<!-- article -->
							<article class="article article-alt" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php 
									if (have_posts()) : while (have_posts()) : the_post();
										$thumb_url = get_the_post_thumbnail($post->ID, 'blog_1_3_4', array('alt' => the_title_attribute('echo=0')));
										$this_post_id = $post->ID;
										
									$authorlink = strtolower(get_the_author_meta('user_login'));
$authorlink = str_replace(' ', '-', $authorlink);
$authorlink = $authorlink . "/";

$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/coming-soon1-sm.jpg";
$authorprofile = "http://www.thebritishcbtcounsellingservice.com/meet-the-team/";

if (get_the_author_meta('ID') === 9) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/K-Mollart-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-katherine-mollart/";
} elseif (get_the_author_meta('ID') === 8) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/L-Debrou-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-lisa-debrou/";
} elseif (get_the_author_meta('ID') === 11) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/Dr-Gray-Picture-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-emma-gray/";
} elseif (get_the_author_meta('ID') === 13) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/09/janet-avery-ward-sm2.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/meet-the-team/";
} elseif (get_the_author_meta('ID') === 15) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/09/stephanie-marsh-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/meet-the-team/";
} elseif (get_the_author_meta('ID') === 17) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/IMG_0820.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-martina-paglia/";
} elseif (get_the_author_meta('ID') === 18) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/03/anjan-nathbig.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-anjan-nath/";
} elseif (get_the_author_meta('ID') === 19) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/andrea.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-andrea-clark/";
} elseif (get_the_author_meta('ID') === 20) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/D-Addison.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-dominic-addison/";
} elseif (get_the_author_meta('ID') === 21) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/N-Meechan.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-nicola-meechan/";
} elseif (get_the_author_meta('ID') === 22) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/07/dr-shelley-parkin.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-shelley-parkin/";
} elseif (get_the_author_meta('ID') === 23) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/IMG_7489-1.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/venetia-kotaki/";
} elseif (get_the_author_meta('ID') === 24) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/B-Marais-new-profile-picture.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/beverley-marais/";
} elseif (get_the_author_meta('ID') === 29) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/Amy-Luck-Photo-Jan-15.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-amy-luck/";
} elseif (get_the_author_meta('ID') === 30) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/G-Marinho.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-gisele-marinho/";
} elseif (get_the_author_meta('ID') === 32) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/05/Nikos-Tsigaras-picture-2.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-nikos-tsigaras/";
} elseif (get_the_author_meta('ID') === 33) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/08/Dr-Lucy-Mabbott-Islington_done2.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-lucy-anne-mabbott/";
} elseif (get_the_author_meta('ID') === 34) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/05/maria-tulino-done.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-maria-tulino/";
} elseif (get_the_author_meta('ID') === 35) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/11/Dr-Erin-Ferguson-done.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-erin-ferguson/";
} elseif (get_the_author_meta('ID') === 36) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/11/dr-tessa-hinshaw.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-tessa-hinshaw/";
} elseif (get_the_author_meta('ID') === 37) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2015/12/jessicaradovan.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-jessica-radovan/";
} elseif (get_the_author_meta('ID') === 40) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/05/Daisy-Sunderlingham-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/daisy-sunderalingam/";
} elseif (get_the_author_meta('ID') === 42) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/05/holly-kayha-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-holly-kahya/";
} elseif (get_the_author_meta('ID') === 43) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/05/shakiba-azizi-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/shakiba-azizi/";
} elseif (get_the_author_meta('ID') === 44) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/07/hamira_done-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-hamira-riaz/";
} elseif (get_the_author_meta('ID') === 45) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/07/dr-Drusilla-Joseph_done-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-drusilla-joseph/";
} elseif (get_the_author_meta('ID') === 47) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/09/Antonella-Trotta.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-antonella-trotta/";
} elseif (get_the_author_meta('ID') === 48) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2012/05/anna-marshall-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-anna-marshall/";
} elseif (get_the_author_meta('ID') === 49) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/09/shari-frolich-sm.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-shari-frohlich/";
} elseif (get_the_author_meta('ID') === 50) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/09/kalyco-stobartjpg.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-kalyco-stobart/";
} elseif (get_the_author_meta('ID') === 51) {
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2016/12/dr-melanie-goulden_large_done.jpg";
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-melanie-goulden/";
} elseif (get_the_author_meta('ID') === 52) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/01/Francesca-Palmieri-large.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-francesca-palmieri/"; 
} elseif (get_the_author_meta('ID') === 53) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/01/taylar-ashlin-large.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-taylar-ashlin/"; 
} elseif (get_the_author_meta('ID') === 54) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/03/Annahita-Nezami-lg.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/annahita-nezami/"; 
} elseif (get_the_author_meta('ID') === 55) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/04/Dr-John-Prentice_lg.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/john-prentice/"; 
} elseif (get_the_author_meta('ID') === 56) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/05/dr-siobhan-tierney-sm.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/siobhan-tierney/";
} elseif (get_the_author_meta('ID') === 57) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/05/Caroline-Black-sm.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/meet-the-team/";
} elseif (get_the_author_meta('ID') === 58) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/06/b-Rekhi_sm.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-bandna-rekhi/";
} elseif (get_the_author_meta('ID') === 59) { 
	$authorimage = "http://www.thebritishcbtcounsellingservice.com/wp-content/uploads/2017/06/nicola-williams-lg.jpg"; 
	$authorprofile = "http://www.thebritishcbtcounsellingservice.com/dr-nicola-williams/";
}
								?>
								<div class="area">
									<div class="heading">
										<h2><?php the_title(); ?></h2>	
										
										<?php if ('post' == get_post_type()) { ?><strong class="author"><?php _e('by','extensio'); ?> <?php if (!get_the_author_meta('first_name') && !get_the_author_meta('last_name')) { the_author_posts_link(); } else { echo '<a href="'.home_url()."/author/".$authorlink.'">'.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').'</a>'; } ?></strong><?php } //end check the post type ?>
									 - <?php echo get_the_time('jS F, Y'); ?>
									<nav class="social-networks float-right">
										<ul>
											<li><a href="https://twitter.com/home/?status=<?php the_title(); ?> - <?php echo urlencode(get_permalink($post->ID)); ?>" title="<?php _e('Share on Twitter','extensio'); ?>" rel="nofollow"><?php _e('Share on Twitter','extensio'); ?></a></li>
											<li><a class="facebook" href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php _e('Share on Facebook','extensio'); ?>" rel="nofollow"><?php _e('Share on Facebook','extensio'); ?></a></li>
										</ul>
									</nav>
									</div>
									<nav class="add-info heading">
									<ul>									
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
										<?php comments_popup_link(__('', 'extensio'),__('<li>1 Comment</li>', 'extensio'), __('<li>% Comments</li>', 'extensio')); ?>
										<?php } //ent if the post type is post?>
									</ul>
								</nav>		
								<div>						
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
										<li><a href="https://twitter.com/home/?status=<?php the_title(); ?> - <?php echo urlencode(get_permalink($post->ID)); ?>" title="<?php _e('Share on Twitter','extensio'); ?>" rel="nofollow"><?php _e('Share on Twitter','extensio'); ?></a></li>
										<li><a class="facebook" href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php _e('Share on Facebook','extensio'); ?>" rel="nofollow"><?php _e('Share on Facebook','extensio'); ?></a></li>
									</ul>
								</nav>
							</article>
							<?php endwhile; ?>
							<?php endif; ?>
							
							<?php if (get_option($shortname."_blog_post_authorinfo") == 'true') { ?>
							<!-- about-author -->
							<article class="about-author">
								<div class="img align-left"><a href="/author/<?php echo $authorlink; ?>"><img src="<?php echo $authorimage; ?>" width="80" alt="<?php echo get_the_author_meta('first_name').' '.get_the_author_meta('last_name');?>"></a></div>
								<div class="txt">
									<h3><?php if (!get_the_author_meta('first_name') && !get_the_author_meta('last_name')) { the_author_posts_link(); } else { echo '<a href="/author/'.$authorlink.'" class="aboutauthortitle"><strong>'.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').'</strong></a>'; } ?></h3>
									<?php if (get_the_author_meta('description')) echo '<p>'.get_the_author_meta('description').'</p>'; ?>
								<br>
								<?php
								If ($authorprofile != "http://www.thebritishcbtcounsellingservice.com/meet-the-team/") {
								?>
								<p><a href="<?php echo $authorprofile;?>">Read more about my approach to counselling here...</a></p>
								<?php
								} else {
								?>
<p style="font-style: italic !important;font-weight:bold !important;">The views expressed here are entirely my own and do not necessarily represent the views of the British CBT & Counselling Service</p>
<?php
}
?>
<br><p><a href="/author/<?php echo $authorlink; ?>">View all my other articles here...</a></p>
								</div>
							</article>
							<?php } ?>
							
							<?php if (get_option($shortname."_blog_recent_posts_enable") == 'true') { ?>
							<!-- article-list -->
							<section class="article-list">
								<h3 class="title"><?php _e('Recent Posts by<br/> '.get_the_author_meta('first_name').' '.get_the_author_meta('last_name').':','extensio'); ?></h3>
								<ul>
									<?php  
										query_posts("post_type=post&author=".get_the_author_meta('ID')."&order=desc&showposts=4");
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