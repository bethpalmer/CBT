<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      http://www.designsandcode.com/
 * @copyright 2015 Designs & Code
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

if ( $query->have_posts() )
{
	?>
	
	<div class="pagination">
		
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
	
	<?php
	$countersm = 0;
	$countermd = 0;
	$counterlg = 0;
	//$pagetype = get_post_meta(get_the_ID(),'location_page',true)
	
	while ($query->have_posts())
	{
		$countersm = $countersm + 1;
		$countermd = $countermd + 1;
		$counterlg = $counterlg + 1;
		
		$query->the_post();
		global $post;
		
		$image_var = get_post_meta($post->ID, 'search_image', true);
		$qual_var = get_post_meta($post->ID, 'search_qualifications', true);
		$job_var = get_post_meta($post->ID, 'search_job_title', true);
		
		?>
		<article class="col-14 info-item team-item">
			<div>
				<?php 
					if ( has_post_thumbnail() ) {
				?>
				<p><a href="<?php the_permalink(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo $image_var;?>" class="boxshadow full-size"></a></p>
				<?php		
					}
				?>
				<h2 class="team"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p><?php echo $job_var;?></p>
				<p class="qualifications"><?php echo $qual_var;?></p>
							
			</div>
		</article>
		<?php
		If ($countersm == 2) {
			$countersm = 0;
			echo "<div class='clearfix clearfix-sm'></div>";
		}
		If ($countermd == 3) {
			$countermd = 0;
			echo "<div class='clearfix clearfix-md'></div>";
		}
		If ($counterlg == 4) {
			$counterlg = 0;
			echo "<div class='clearfix clearfix-lg'></div>";
		}
	}
	?>
	
	<div class="pagination">
		
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
	<?php
}
else
{
	echo "There are no Psychologists currently available";
}
?>