<?php
/**
*** The template for displaying all pages.
**/
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
					</section>
<!-- Evie's added gray bit -->
<div class="social-box">
	<div class="headline solid">
		<h2>Clinic Locations</h2>
	</div>
	<section class="info-columns">
		<div class="container">
			<article class="col-13 info-item">
				<div>
					<p><strong><a href="/richmond-cbt-therapy/">Richmond (Lower Mortlake Road)</a></strong><br />233 Lower Mortlake Rd , Richmond, Surrey, TW9 2LL.</p>
<p><strong><a href="/richmond-upon-thames-lambert-avenue/">Richmond (Lambert Avenue)</a></strong><br />40 Lambert Avenue, Richmond, TW9 4QR</p>
                                        <p><strong><a href="/liverpool-street-cbt-therapy/">Liverpool Street</a></strong><br />London Therapy Rooms, Longcroft House, 2-8 Victoria Avenue, London, EC2M 4NS.</p>
					<p><strong><a href="/clapham-cbt-therapy/">Clapham</a></strong><br />Thurleigh Road GP Practice, 88a Thurleigh Rd, Clapham, London, SW12 8TT.</p>
                                        <p><strong><a href="/marylebone-cbt-therapy/">Marylebone</a></strong><br />West End Medical Practice, 6 Bendall Mews, Marylebone, London, NW1 6SN.</p>
				</div>
			</article>
			<article class="col-13 info-item">
				<div>
<p><strong><a href="/fulham-cbt-therapy/">Fulham</a></strong><br />The Fulham Health Clinic, 286 Munster Road, Fulham, London, SW6 6BQ.</p>
					<p><strong><a href="/islington-cbt-therapy/">Islington</a></strong><br />335 City Road, Angel, London EC1V 1LJ.</p>
                                        <p><strong><a href="/twickenham-cbt-therapy/">Twickenham</a></strong><br />366 Richmond Rd, Twickenham, Middlesex, TW1 2DX.</p>					
<p><strong><a href="/chiswick-cbt-therapy/">Chiswick</a></strong><br />155 Chiswick High Road, Chiswick, London, W4 2DT.</p>
<p><strong><a href="/east-dulwich/">East Dulwich</a></strong><br />The Vale Practice, 64 Grove Vale, London, SE22 8DT.</p>
                                       

				</div>
			</article>
			<article class="col-13 info-item">
				<div>


<p><strong><a href="/great-missenden/">Great Missenden</a></strong><br />Healthy Balance, 51 High Street, Great Missenden, Buckinghamshire, HP16 0AL.</p>

					<p style="margin-bottom:20px;"><strong>Telephone:</strong><br /><span class=""><a href="tel:08000029068">0800 002 9068</a></span></p><p style="margin-bottom:20px;">
<strong>Email:</strong><br /><a href="mailto:info@thebritishcbtcounsellingservice.com">info@thebritishcbtcounsellingservice.com</a></p>
<h4>Online Services</h4>
<ul class="list"><li><a href="http://www.thebritishcbtcounsellingservice.com/contact/">Book an appointment</a></li><li><a href="http://www.thebritishcbtcounsellingservice.com/contact/">Contact Form</a></li></ul>						
				</div>
			</article>
		</div>
	</section>
</div>
<!-- End of Evie's added gray bit -->	

				</div>
				<!--/ main -->

<?php get_footer(); ?>