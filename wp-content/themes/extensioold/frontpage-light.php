<?php/*Template Name: Frontpage Light*/get_header();?>				<!-- main -->				<div id="main">					<!-- slider -->					<section class="intro2 gallery">						<div class="gallery-holder"<?php if (get_option($shortname.'_slider_image_or_video') != 'No') echo ' id="holder-iframe"'; ?>>													<?php								if (get_option($shortname.'_slider_image_or_video') == 'No') {									$slider_name = get_option($shortname.'_slider_type');									//echo str_replace('.jpg','.png',selected_slider_output($slider_name));									echo selected_slider_output($slider_name);								} else if (get_option($shortname.'_slider_image_or_video') == 'Image') {									echo '<img src="'.get_option($shortname.'_slider_image_or_video_url').'" />';								} else if (get_option($shortname.'_slider_image_or_video') == 'Video') {									echo '<iframe src="'.get_option($shortname.'_slider_image_or_video_url').'" width="990" height="397"></iframe>';								}							?>													</div>					</section>					<?php						if ( (get_option($shortname.'_slider_type') == 'Nivo Slider')  && (get_option($shortname."_slider_image_or_video") == 'No') ) {					?>										<nav class="switcher">						<ul></ul>					</nav>					<?php } ?>										<?php if (have_posts()) : ?>					<?php while (have_posts()) : the_post(); ?>						<?php the_content(); ?>					<?php endwhile; ?>					<?php endif; ?>				</div><?php get_footer(); ?>