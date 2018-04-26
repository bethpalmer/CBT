<?php
/*
Template Name: Page Right Sidebar
*/
get_header();
?>

				<!-- main -->
				<div id="main">
					<!-- intro -->
					<section class="intro">
						<?php if (get_option($shortname."_search_pages") == 'true') { ?>
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
						<section class="col" id="content">
							<?php if (have_posts()) : ?>
							<?php while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
							<?php endif; ?>
						</section>
						<!-- sidebar -->
						<aside class="col" id="sidebar">

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