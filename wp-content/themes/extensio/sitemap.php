<?php
/*
Template Name: Sitemap
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
					<section class="content">
						<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
						<?php endif; ?>
						
						<div class="sitemap-wrapper">
						<ul class="list-sitemap">
							<?php wp_list_pages('exclude=&sort_column=menu_order&title_li='); ?>
						</ul>
						 <br class="sitemap" />
						</div>
						
					</section>
				</div>
				<!--/ main -->

<?php get_footer(); ?>