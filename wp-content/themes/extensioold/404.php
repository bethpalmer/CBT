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
						<form action="<?php echo home_url(); ?>" method="get" class="search">
							<fieldset>
								<input type="text" name="s" id="s" value="<?php _e('Click or type here to search','extensio'); ?>" class="text" >
								<input type="submit" value="go" class="submit" >
							</fieldset>
						</form>
						<?php } //end search form ?>
						<p><?php _e('ERROR 404 - Not Found','extensio'); ?></p>
					</section>
					<section class="content">
						<!-- error section -->		
						<section class="error-page">
							<p>&nbsp;</p>
							<h1><?php _e('ERROR 404','extensio'); ?></h1>
							<p><?php _e("We are sorry, but the page you were looking for doesn't exist.",'extensio'); ?></p>

							<?php if (have_posts()) : ?>
							<?php while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
							<?php endif; ?>

						</section>	
					</section>
				</div>
				<!--/ main -->

<?php get_footer(); ?>