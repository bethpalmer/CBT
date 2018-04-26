<?php
/*
Template Name: 404 Error
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
						</section>
					<section class="content">
						<!-- error section -->		
						<section class="error-page">
							<h1><?php _e('Page Not Found','extensio'); ?></h1>
							<p><?php _e("We are sorry, but the page you were looking for doesn't exist.",'extensio'); ?></p>

<p><?php _e("Please use the navigation or search box at the top to continue.",'extensio'); ?></p>
                          

							<?php // if (have_posts()) : ?>
							<?php // while (have_posts()) : the_post(); ?>
								<?php // the_content(); ?>
							<?php // endwhile; ?>
							<?php // endif; ?>

						</section>	
					</section>
				</div>
				<!--/ main -->

<?php get_footer(); ?>